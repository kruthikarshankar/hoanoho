var disableValueRefreshForDeviceID = null;
var devicesWithLowBattery = [];

function connectWebSocket(port) {

	if (typeof connectWebSocket.connectCnt == 'undefined') {
		connectWebSocket.connectCnt = 0;
	}
	if (typeof connectWebSocket.connectProt == 'undefined') {
		connectWebSocket.connectProt = getCookie("websocketProtocol");

		if (connectWebSocket.connectProt == null) {
			if (window.location.protocol == "http:") {
				connectWebSocket.connectProt = "wss";
			} else if(window.location.protocol == "https:") {
				connectWebSocket.connectProt = "wss";
			}
		}
	}
	var host = window.location.hostname;
	var address = connectWebSocket.connectProt + "://" + host +  ":" + port + "/ws";

	// Connect to Socketserver
	var socket = new WebSocket(address);
	socket.binaryType = 'arraybuffer';

	socket.onclose = function(){
        //try to reconnect to socketserver in 5 seconds
        setTimeout(function(){connectWebSocket(port)}, 5000);
    };
	
	socket.onerror = function () {
		connectWebSocket.connectCnt++;
		if(connectWebSocket.connectCnt >= 4 && connectWebSocket.connectProt == "wss") {
			connectWebSocket.connectProt = "ws";
			connectWebSocket.connectCnt = 0;
		}
	};
	
	socket.onopen = function () {
		// set cookie
		setCookie("websocketProtocol", connectWebSocket.connectProt);
	};

    socket.onmessage = function(message) {
    	var messageObj = JSON.parse(message['data']);

    	// disable refresh when some value is being changed
    	if(disableValueRefreshForDeviceID != null && disableValueRefreshForDeviceID == messageObj['dev_id'])
    		return false;

        var doUpdateIcon = false;
    	var el_image = document.getElementById("device" + messageObj['dev_id']);

    	if (messageObj['reading'] == 'battery' && messageObj['value'] != "ok") 
			devicesWithLowBattery.push(messageObj['dev_id']);
		else if (messageObj['reading'] == 'battery' && messageObj['value'] == "ok")
			devicesWithLowBattery.splice($.inArray(messageObj['dev_id'], devicesWithLowBattery),1);
			
        if(messageObj['typename'] == "Jalousie")
        {
            switch(messageObj['reading']) {
                case 'pct': // set blinds
                    var postfix = '';
                    var value = messageObj['value'];

                    if(value != "off" && value != "on" && value != "stop")
                    {
                        postfix = '% offen';
                        value = parseInt(value);
                    }

                    $('input[name=jalousievalue'+messageObj['dev_id']+']').val(value);
                    $('input[name=jalousiecurvalue'+messageObj['dev_id']+']').val(value);
                    $('div[name=tooltip-value1'+messageObj['dev_id']+']').html(value+postfix);
                    break;
                case 'motor': // motor movement
                    if(messageObj['value'].indexOf('stop:') > -1)
                    {
                        // unlock controls
                        $('#modal-device'+messageObj['dev_id']).find(':button').prop('disabled', false);
                    }
                    else
                    {
                        // lock controls excluding stop button
                        $('#modal-device'+messageObj['dev_id']).find(':button').prop('disabled', true);
                        $('#modal-device'+messageObj['dev_id']).find('button[name=stopbutton]').prop('disabled', false);

                        var movement = ""
                        if(messageObj['value'].indexOf('up:') > -1)
                            movement = "hoch";
                        if(messageObj['value'].indexOf('down:') > -1)
                            movement = "runter";

                        $('div[name=tooltip-value1'+messageObj['dev_id']+']').html('Fährt '+movement+' ...');
                    }
                    
                    break;
                default:
                    break;
            }
        }
    	else if(messageObj['typename'] == "Temperaturregelung")
    	{
    		switch(messageObj['reading']) {
    			case 'desired-temp': // set temperature
    				var postfix = '';
    				if(messageObj['value'] != "off")
    					postfix = '\xB0C';

    				$('input[name=solltemp'+messageObj['dev_id']+']').val(messageObj['value']);
    				$('div[name=tooltip-value1'+messageObj['dev_id']+']').html("Soll Temperatur: "+messageObj['value']+postfix);
    				break;
    			case 'measured-temp': // current temperature
    				$('input[name=isttemp'+messageObj['dev_id']+']').val(messageObj['value']);
    				$('div[name=tooltip-value2'+messageObj['dev_id']+']').html("Ist Temperatur: "+messageObj['value']+'\xB0C');
    				break;
                case 'controlMode': // control mode
                    $('div[name=tooltip-value4'+messageObj['dev_id']+']').html("Betriebsmodus: "+messageObj['value']);
                    break;
    			case 'battery': // battery status
                    $('div[name=tooltip-value5'+messageObj['dev_id']+']').html("Batterie Status: "+messageObj['value']);
    				break;
    			case 'humidity': // current humidity
    				$('div[name=tooltip-value3'+messageObj['dev_id']+']').html("rel. Luftfeuchte: "+messageObj['value']+'%');
    				break;
    			default:
    				break;
    		}
    	}
    	else if(messageObj['typename'] == "Dimmer")
    	{
            console.warn(messageObj);

            switch (messageObj['reading']) {
                case 'state':
                    var value = messageObj['value'].replace('dim','').replace('%','');

                    if(value == "on")
                        value = "100";
                    else if(value == "off")
                        value = "0";

                    var slider = document.getElementById("slider"+messageObj['dev_id']).value = value
                    var slider_value = document.getElementById("slider_value"+messageObj['dev_id']).value = value;  

                    break;
                default:
                    break;
            }
    	}
        else if(messageObj['typename'] == 'Tür/Fenster-Kontakt')
        {
            switch(messageObj['reading']) {
                case 'state':
                    doUpdateIcon = true;
                    $('div[name=tooltip-value1'+messageObj['dev_id']+']').html("Zustand: "+messageObj['value']);
                    break;
                case 'battery':
                    $('div[name=tooltip-value2'+messageObj['dev_id']+']').html("Batterie Status: "+messageObj['value']);
                    break;
            }
        }
        else
        {
            switch(messageObj['reading']) {
                case 'state':
                    doUpdateIcon = true;
                break;
            }
        }
        

    	if(el_image != null && doUpdateIcon)
    	{
    		if($.inArray(messageObj['dev_id'], devicesWithLowBattery) == -1)
    		{
	    		var arrayBuffer = messageObj['image'];
			    var bytes = new Uint8Array(arrayBuffer);

			    var image = document.createElement('img');
			    image.src = "data:image/jpeg;base64,"+encode(bytes);

	    		el_image.style.backgroundImage = "url('data:image/jpeg;base64,"+encode(bytes)+"')";
	    		el_image.style.backgroundColor = "rgba(0,0,0,0.4)";
    		}
    		else
    		{
    			el_image.style.backgroundImage = "url('./img/battery_warning.png')";
				el_image.style.backgroundColor = 'rgba(255,147,111,0.4)';
    		}
    	}
    };
}