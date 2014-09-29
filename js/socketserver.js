var WebSocketServer = require('ws').Server;
var wss = new WebSocketServer({port: 8000});

var mysql = require('mysql');
var connection = mysql.createConnection({});
var databaseConnectionState = false;


var LOOP_INTERVAL = 1000;
var loopTimer_fhem;
var loopTimer_gpio;
var loopTimer_weatherwarning;
var loopTimer_garbage;

var connectionsArray = [];

var devices = { };

//var sqlquery_fhem = 'SELECT homie.devices.dev_id, homie.bindata.data image, homie.types.name typename, fhem.current.DEVICE, fhem.current.VALUE, fhem.current.UNIT FROM fhem.current JOIN homie.devices ON homie.devices.identifier = fhem.current.DEVICE JOIN homie.device_types ON homie.device_types.dtype_id = homie.devices.dtype_id JOIN homie.bindata ON homie.bindata.binid = CASE WHEN (fhem.current.VALUE = \'on\' or fhem.current.VALUE > 0) AND homie.device_types.image_on_id is not null THEN homie.device_types.image_on_id ELSE homie.device_types.image_off_id END JOIN homie.types on homie.types.type_id = homie.device_types.type_id WHERE fhem.current.TYPE !=  "GLOBAL" and fhem.current.READING = "state"';
var sqlquery_fhem = 'SELECT distinct fhem.current.DEVICE FHEMDEVICE, homie.devices.dev_id, homie.bindata.data image, homie.types.name typename, fhem.current.timestamp, homie.devices.identifier, homie.devices.identifier DEVICE, fhem.current.READING, fhem.current.VALUE, fhem.current.UNIT '+
					'FROM fhem.current ' +
						'JOIN homie.devices ON fhem.current.DEVICE like concat(homie.devices.identifier,\'%\') '+
						'JOIN homie.device_types ON homie.device_types.dtype_id = homie.devices.dtype_id '+
						'LEFT OUTER JOIN homie.bindata ON homie.bindata.binid = '+
							'CASE WHEN (fhem.current.VALUE = \'on\' or fhem.current.VALUE = \'closed\') AND homie.device_types.image_on_id is not null and fhem.current.READING = \'state\' THEN '+
								'homie.device_types.image_on_id '+
							'WHEN (fhem.current.VALUE = \'off\' or fhem.current.VALUE = \'open\') AND homie.device_types.image_on_id is not null and fhem.current.READING = \'state\' THEN '+
								'homie.device_types.image_off_id '+
							'ELSE '+
								'null '+
							'END '+
						'JOIN homie.types on homie.types.type_id = homie.device_types.type_id '+
					'WHERE fhem.current.READING in (SELECT DISTINCT fhem.current.READING FROM fhem.current WHERE fhem.current.type != "GLOBAL")';

var sqlquery_gpio = 'select homie.device_data.VALUE, t1.deviceident DEVICE, homie.types.name typename, homie.bindata.data image, homie.devices.dev_id  from homie.device_data ' +
						'join ( ' +
								'select max(ddid) ddid, deviceident, max(timestamp) from homie.device_data group by deviceident ' +
							  ') t1 on t1.ddid = device_data.ddid ' +
						'join homie.devices on devices.identifier = t1.deviceident ' +
						'join homie.device_types on devices.dtype_id = device_types.dtype_id ' +
						'join homie.types on device_types.type_id = types.type_id ' +
						'join homie.bindata ON homie.bindata.binid = CASE WHEN (VALUE = \'on\' or VALUE > 0) AND homie.device_types.image_on_id is not null THEN homie.device_types.image_on_id ELSE homie.device_types.image_off_id END ' +
						'where types.name = "Raspberry Pi GPIO"';
var sqlquery_weatherwarning = 'select id, name, data from homie.cron_data where name = \'dwd_warning\'';
var sqlquery_garbage = 'select id, date_format(pickupdate, \'%d.%m.%Y\') pickupdate,text from homie.garbageplan where date(NOW()) = pickupdate -INTERVAL 1 DAY';


// helper to count nested objects
Object.prototype.count = function() {
    var that = this,
        count = 0;

    for(property in that) {
        if(that.hasOwnProperty(property)) {
            count++;
        }
    }

    return count;
};



var loop_fhem = function () {
	if(databaseConnectionState == true)
	{
		var query = connection.query(sqlquery_fhem);
		//var query_gpio = connection.query(sqlquery_gpio);
		
		query
		.on('result',function(result)
		{
			if(result.DEVICE.length > 0)
			{
				if(!devices[result.DEVICE+"_"+result.FHEMDEVICE+"_"+result.READING] || devices[result.DEVICE+"_"+result.FHEMDEVICE+"_"+result.READING].value != result.VALUE)
				{
					devices[result.DEVICE+"_"+result.FHEMDEVICE+"_"+result.READING] = {device:result.DEVICE, fhemdevice:result.FHEMDEVICE, typename:result.typename, reading:result.READING, value:result.VALUE, dev_id:result.dev_id, image:result.image};

					connectionsArray.forEach(function(tmpSocket){
						if(tmpSocket != null)
							sendMessage(tmpSocket, devices[result.DEVICE+"_"+result.FHEMDEVICE+"_"+result.READING]);
				    });
				}
			}
		})

		.on('end',function()
		{
	        if(connectionsArray.length) {
	            loopTimer_fhem = setTimeout( loop_fhem, LOOP_INTERVAL );
	        }
	    });
    }
}

var loop_gpio = function () {
	if(databaseConnectionState == true)
	{
		var query_gpio = connection.query(sqlquery_gpio);

	    query_gpio
		.on('result',function(result)
		{			
			if(!devices[result.DEVICE] || devices[result.DEVICE].value != result.VALUE)
			{
				devices[result.DEVICE] = {device:result.DEVICE, typename:result.typename, value:result.VALUE, dev_id:result.dev_id, image:result.image};

				connectionsArray.forEach(function(tmpSocket){
					if(tmpSocket != null)
						sendMessage(tmpSocket, devices[result.DEVICE]);
			    });
			}
		})

		.on('end',function()
		{
	        if(connectionsArray.length) {
	            loopTimer_gpio = setTimeout( loop_gpio, LOOP_INTERVAL );
	        }
	    });
    }
}

var loop_weatherwarning = function () {
	if(databaseConnectionState == true)
	{
		var query_weatherwarning = connection.query(sqlquery_weatherwarning);

	    query_weatherwarning
		.on('result',function(result)
		{
			if(!devices['weatherwarn_'+result.id] || devices['weatherwarn_'+result.id].value != utf8_decode(result.data))
			{
				devices['weatherwarn_'+result.id] = {device:result.name, typename:result.name, value:utf8_decode(result.data), dev_id:result.id, image:null};

				connectionsArray.forEach(function(tmpSocket){
					if(tmpSocket != null)
						sendMessage(tmpSocket, devices['weatherwarn_'+result.id]);
			    });
			}
		})

		.on('end',function()
		{
	        if(connectionsArray.length) {
	            loopTimer_weatherwarning = setTimeout( loop_weatherwarning, LOOP_INTERVAL );
	        }
	    });
    }
}

var loop_garbage = function () {
	if(databaseConnectionState == true)
	{
		var query_garbage = connection.query(sqlquery_garbage);

	    query_garbage
		.on('result',function(result)
		{
			if(!devices['garbage'+result.id] || devices['garbage'+result.id].value.length != result.length)
			{
				devices['garbage'+result.id] = {device:'garbage', typename:'garbage', value:result, dev_id:null, image:null};

				connectionsArray.forEach(function(tmpSocket){
					if(tmpSocket != null)
						sendMessage(tmpSocket, devices['garbage'+result.id]);
			    });
			}
		})

		.on('end',function()
		{
	        if(connectionsArray.length) {
	            loopTimer_garbage = setTimeout( loop_garbage, LOOP_INTERVAL );
	        }
	    });
    }
}


// Message stuff

function sendMessage(socket, message)
{
	try {
		socket.send(JSON.stringify(message));
		//console.log("sending message: " + message);
	} catch (e) {
		console.log("socket send error: "+e);
	}
};
 



// Socket stuff

wss.on('connection', function(socket) 
{
	// on receiving message from client
	socket.on('message', function(message) 
	{
		var messageObj = JSON.parse(message);

		if(messageObj['command'] == "update_device")
		{
			for(var device in devices) {
		    	if(device != "count") {
		    		if(devices[device].dev_id == messageObj['message'])
		    		{
		    			delete devices[device];
		    		}
		    	}
		    }
		}
	});

	socket.on('close', function() 
	{
		if(connectionsArray.length > 0)
		{
			connectionsArray.splice(connectionsArray.indexOf(socket),1);
			console.log('Client getrennt - Verbindungsanzahl: ' + connectionsArray.length);
		}
	});

	

	if (!connectionsArray.length) {
        loop_fhem();
        loop_gpio();
        loop_weatherwarning();
        loop_garbage();
    }

    if(databaseConnectionState)
    {
		connectionsArray.push(socket);
		console.log('Client verbunden - Verbindungsanzahl: ' + connectionsArray.length);

		if(devices.count() > 0)
		{
		    for(var device in devices) {
		    	if(device != "count") {
		    		sendMessage(socket, devices[device]);
		    	}
		    }
		}
	}
	else
	{
		// close this socket connection
		socket.close();
	}
});


function disconnectAllConnectedClients() {
	connectionsArray.forEach(function(tmpSocket){
		if(tmpSocket != null){
			tmpSocket.close();
		}
	});
}


/* Database stuff */

function connectDatabase() {
	connection  = mysql.createConnection({
        host        : 'localhost',
        user        : '',
        password    : '',
        database    : 'fhem'
    });

    connection.on('close', function (err) {
		console.log("Connection to database closed.")
		databaseConnectionState = false;

		// close all socket connections
		disconnectAllConnectedClients();
	});

	connection.on('error', function (err) {
		console.log('database error: ' + err);
		databaseConnectionState = false;

		// close all socket connections
		disconnectAllConnectedClients();
	});
}

var dbConnChecker = setInterval(function(){
  if(!databaseConnectionState)
  {
    console.log('Database not connected, attempting to connect ...');
   
   	connectDatabase();

    connection.connect(function(err) {
		//if(err != null)
			//console.log(err);
		if(!err) //else
		{
			console.log("Connection to database established.");
			databaseConnectionState = true;

			var query_fhem = connection.query(sqlquery_fhem);
			var query_gpio = connection.query(sqlquery_gpio);
			var query_weatherwarning = connection.query(sqlquery_weatherwarning);
			var query_garbage = connection.query(sqlquery_garbage);


			query_fhem
			.on('result',function(result)
			{	
				if(result.DEVICE.length > 0)
				{
					if(!devices[result.DEVICE+"_"+result.FHEMDEVICE+"_"+result.READING] || devices[result.DEVICE+"_"+result.FHEMDEVICE+"_"+result.READING].value != result.VALUE)
					{
						devices[result.DEVICE+"_"+result.FHEMDEVICE+"_"+result.READING] = {device:result.DEVICE, fhemdevice:result.FHEMDEVICE, typename:result.typename, reading:result.READING, value:result.VALUE, dev_id:result.dev_id, image:result.image};

						connectionsArray.forEach(function(tmpSocket){
							if(tmpSocket != null)
								sendMessage(tmpSocket, devices[result.DEVICE+"_"+result.FHEMDEVICE+"_"+result.READING]);
					    });
					}
				}
			})

			query_gpio
			.on('result',function(result)
			{	
				if(!devices[result.DEVICE] || devices[result.DEVICE].value != result.VALUE)
				{
					devices[result.DEVICE] = {device:result.DEVICE, typename:result.typename, value:result.VALUE, dev_id:result.dev_id, image:result.image};

					connectionsArray.forEach(function(tmpSocket){
						if(tmpSocket != null)
							sendMessage(tmpSocket, devices[result.DEVICE]); 
				    });
				}
			})

			query_weatherwarning
			.on('result',function(result)
			{	
				if(!devices['weatherwarn_'+result.id] || devices['weatherwarn_'+result.id].value != utf8_decode(result.data))
				{
					devices['weatherwarn_'+result.id] = {device:result.name, typename:result.name, value:utf8_decode(result.data), dev_id:result.id, image:null};

					connectionsArray.forEach(function(tmpSocket){
						if(tmpSocket != null)
							sendMessage(tmpSocket, devices['weatherwarn_'+result.id]);
				    });
				}
			})

			query_garbage
			.on('result',function(result)
			{	
				if(!devices['garbage'+result.id] || devices['garbage'+result.id].value.length != result.length)
				{
					devices['garbage'+result.id] = {device:'garbage', typename:'garbage', value:result, dev_id:null, image:null};

					connectionsArray.forEach(function(tmpSocket){
						if(tmpSocket != null)
							sendMessage(tmpSocket, devices['garbage'+result.id]); 
				    });
				}
			})
		}
	});
  }
}, 2000);

























function utf8_encode(argString) {
  //  discuss at: http://phpjs.org/functions/utf8_encode/
  // original by: Webtoolkit.info (http://www.webtoolkit.info/)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: sowberry
  // improved by: Jack
  // improved by: Yves Sucaet
  // improved by: kirilloid
  // bugfixed by: Onno Marsman
  // bugfixed by: Onno Marsman
  // bugfixed by: Ulrich
  // bugfixed by: Rafal Kukawski
  // bugfixed by: kirilloid
  //   example 1: utf8_encode('Kevin van Zonneveld');
  //   returns 1: 'Kevin van Zonneveld'

  if (argString === null || typeof argString === 'undefined') {
    return '';
  }

  var string = (argString + ''); // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");
  var utftext = '',
    start, end, stringl = 0;

  start = end = 0;
  stringl = string.length;
  for (var n = 0; n < stringl; n++) {
    var c1 = string.charCodeAt(n);
    var enc = null;

    if (c1 < 128) {
      end++;
    } else if (c1 > 127 && c1 < 2048) {
      enc = String.fromCharCode(
        (c1 >> 6) | 192, (c1 & 63) | 128
      );
    } else if ((c1 & 0xF800) != 0xD800) {
      enc = String.fromCharCode(
        (c1 >> 12) | 224, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
      );
    } else { // surrogate pairs
      if ((c1 & 0xFC00) != 0xD800) {
        throw new RangeError('Unmatched trail surrogate at ' + n);
      }
      var c2 = string.charCodeAt(++n);
      if ((c2 & 0xFC00) != 0xDC00) {
        throw new RangeError('Unmatched lead surrogate at ' + (n - 1));
      }
      c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
      enc = String.fromCharCode(
        (c1 >> 18) | 240, ((c1 >> 12) & 63) | 128, ((c1 >> 6) & 63) | 128, (c1 & 63) | 128
      );
    }
    if (enc !== null) {
      if (end > start) {
        utftext += string.slice(start, end);
      }
      utftext += enc;
      start = end = n + 1;
    }
  }

  if (end > start) {
    utftext += string.slice(start, stringl);
  }

  return utftext;
}

function utf8_decode(str_data) {
  //  discuss at: http://phpjs.org/functions/utf8_decode/
  // original by: Webtoolkit.info (http://www.webtoolkit.info/)
  //    input by: Aman Gupta
  //    input by: Brett Zamir (http://brett-zamir.me)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Norman "zEh" Fuchs
  // bugfixed by: hitwork
  // bugfixed by: Onno Marsman
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: kirilloid
  //   example 1: utf8_decode('Kevin van Zonneveld');
  //   returns 1: 'Kevin van Zonneveld'

  var tmp_arr = [],
    i = 0,
    ac = 0,
    c1 = 0,
    c2 = 0,
    c3 = 0,
    c4 = 0;

  str_data += '';

  while (i < str_data.length) {
    c1 = str_data.charCodeAt(i);
    if (c1 <= 191) {
      tmp_arr[ac++] = String.fromCharCode(c1);
      i++;
    } else if (c1 <= 223) {
      c2 = str_data.charCodeAt(i + 1);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
      i += 2;
    } else if (c1 <= 239) {
      // http://en.wikipedia.org/wiki/UTF-8#Codepage_layout
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
      i += 3;
    } else {
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      c4 = str_data.charCodeAt(i + 3);
      c1 = ((c1 & 7) << 18) | ((c2 & 63) << 12) | ((c3 & 63) << 6) | (c4 & 63);
      c1 -= 0x10000;
      tmp_arr[ac++] = String.fromCharCode(0xD800 | ((c1 >> 10) & 0x3FF));
      tmp_arr[ac++] = String.fromCharCode(0xDC00 | (c1 & 0x3FF));
      i += 4;
    }
  }

  return tmp_arr.join('');
}