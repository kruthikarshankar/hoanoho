<?
	include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnection.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/getConfiguration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/tablet/includes/device_optimizer.php';

	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
?>

<html>
	<head>
		<meta charset="UTF-8" />

		<title><? echo $__CONFIG['main_sitetitle']; ?></title>

		<meta name="apple-mobile-web-app-capable" content="yes" /> 
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

		<link rel="apple-touch-icon" href="../img/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />

		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
		<link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css" media="screen" title="no title" charset="UTF-8">
		<link rel="stylesheet" href="./css/bootstrap-theme.min.css" type="text/css" media="screen" title="no title" charset="UTF-8">
		<link rel="stylesheet" href="./css/bootstrap-custom.css" type="text/css" media="screen" title="no title" charset="UTF-8">
		
		<script type="text/javascript" src="./js/jquery.min.js"></script>
		<script src="./js/jquery-ui.min.js"></script>
		<script src="./js/bootstrap.min.js"></script>
		<script src="./js/clock.js"></script>
		<script src="./js/jquery-scrolltofixed.js"></script>
		<script src="./js/standalone.js"></script>
		<script>
			$(document).ready(function() {
				$('.dropdown-toggle').dropdown();

				$('#titlebar').scrollToFixed();
  				$('#footer').scrollToFixed({bottom: 0});
			});

			$(document).ready(function(){
				connectWebSocket(<? echo "\"ws://".$__CONFIG['main_socketaddress'].":".$__CONFIG['main_socketport']."\""; ?>);
			});


			function ajaxRequest(){
				var activexmodes=["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"] //activeX versions to check for in IE
				
				if (window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
					for (var i=0; i<activexmodes.length; i++){
						try{
							return new ActiveXObject(activexmodes[i])
						}
						catch(e){
							//suppress error
						}
					}
				}
				else if (window.XMLHttpRequest) // if Mozilla, Safari etc
					return new XMLHttpRequest()
				else
					return false
			}

			function connectWebSocket(address) {
				// Connect to Socketserver
				var socket = new WebSocket(address);
				socket.binaryType = 'arraybuffer';

				var last_weatherwarning = null;

				socket.onopen = function(){
					if($('#titlebar #left #status').attr('class') == "disconnected")
						$('#titlebar #left #status').switchClass("disconnected", "connected", 500, "easeInOutQuad");
				};

				socket.onclose = function(){
			        if($('#titlebar #left #status').attr('class') == "connected")
			        	$('#titlebar #left #status').switchClass("connected", "disconnected", 500, "easeInOutQuad");
			        
			        //try to reconnect to socketserver in 5 seconds
			        setTimeout(function(){connectWebSocket(address)}, 5000);
			    };

			    socket.onmessage = function(message) {
			    	if($('#titlebar #left #status').attr('class') == "disconnected")
			    		$('#titlebar #left #status').switchClass("disconnected", "connected", 500, "easeInOutQuad");

			    	var messageObj = JSON.parse(message['data']);
			    	console.log(messageObj);

			    	var el_value = document.getElementById("value_" + messageObj['dev_id']);

			    	var value = "---";
			    	
			    	if(el_value != null)
			    	{
				    	if(messageObj['typename'] == "Raspberry Pi GPIO")
				    	{
				    		if(messageObj['value'] == "1")
				    			el_value.innerHTML = "Eingeschaltet";
				    		else if(messageObj['value'] == "0")
				    			el_value.innerHTML = "Ausgeschaltet";
				    		else
				    			el_value.innerHTML = "---";
				    	}
				    	else if(messageObj['typename'] == "Temperaturregelung")
				    	{
				    		var split = [];
				    		var splitSign = ", ";

				    		value = el_value.firstChild.nodeValue;
				    		if(value != "---")
				    			split = value.split(splitSign);

				    		var index = "";
				    		var postfix = "";
				    		switch(messageObj['reading']) {
				    			case 'desired-temp':
				    				index = "sT:";
				    				postfix = "\xB0C";

				    				break;
				    			case 'measured-temp':
				    				index = "rT:";
				    				postfix = "\xB0C";

				    				break;
				    			case 'controlMode':
				    				index = "M:";
				    				postfix = "";

				    				break;
				    			case 'humidity':
				    				index = "H:";
									postfix = "%";

				    				break;
				    			default:
				    				break;
				    		}

				    		if(index.length > 0)
			    			{
			    				if(split.length > 0)
			    				{
			    					var indexFound = false;
				    				for (var i = split.length - 1; i >= 0; i--) {
				    					if(split[i].indexOf(index) >= 0)
				    					{
				    						indexFound = true;
				    						split[i] = index+" "+messageObj['value']+postfix;
				    					}
				    				};

				    				if(!indexFound)
				    					split[split.length] = index+" "+messageObj['value']+postfix;
				    			}
				    			else
				    				split[0] = index+" "+messageObj['value']+postfix;

				    			split.sort();

				    			value = "";
				    			for (var i = split.length - 1; i >= 0; i--) {
					    			value += split[i]+splitSign;
					    		};

					    		value = value.substring(0, value.length - splitSign.length);
			    			}

			    			el_value.innerHTML = value;
				    	}
				    	else if(messageObj['typename'] == "Jalousie")
				    	{
				    		switch(messageObj['reading']) {
                				case 'pct':
				    				if(messageObj['value'] == 100)
						    			el_value.innerHTML = "Offen";
						    		else if(messageObj['value'] == 0)
						    			el_value.innerHTML = "Geschlossen";
						    		else
						    			el_value.innerHTML = messageObj['value']+"%";

						    		el_value.innerHTML = "---";
				    				break;
				    			case 'motor':
				    				var movement = ""
			                        if(messageObj['value'].indexOf('up:') > -1)
			                            movement = "hoch";
			                        if(messageObj['value'].indexOf('down:') > -1)
			                            movement = "runter";

				    				value = 'Fährt '+movement+' ...';

				    				el_value.innerHTML = "---";
				    				break;
				    			default:
                    				break;
                    		}
				    	}
				    	else
				    	{
				    		switch(messageObj['reading'])
				    		{
				    			case 'state':
				    				if(messageObj['value'] == "on")
						    			el_value.innerHTML = "Eingeschaltet";
						    		else if(messageObj['value'] == "off")
						    			el_value.innerHTML = "Ausgeschaltet";
						    		else if(messageObj['value'] == "open")
						    			el_value.innerHTML = "Offen";
						    		else if(messageObj['value'] == "closed")
						    			el_value.innerHTML = "Geschlossen";
						    		else
						    			el_value.innerHTML = messageObj['value'];

						    		break;
						    	default:
						    		break;
				    		}
				    	}
			    	}

			    	if(messageObj['typename'] == "dwd_warning") {
			    		var element = $('#griditem #boxitem.alarm.weather');
			    		var message = messageObj['value'];

			    		if($('#boxitem.alarm.weather','#griditem').length == 0 && message.length > 0)
			    		{
			    			last_weatherwarning = message;

			    			if(message.length > 180)
			    			{
			    				// cut message
			    				message = message.substring(0, 180)+" [...]";
			    			}

			    			// display warning box
			    			var content = '<div id="griditem">'+
			    							'<div id="flipcontainer" class="flip-container">'+
			    								'<div class="flipper">'+
			    									'<div class="front">'+
			    										'<div id="boxitem" class="alarm weather">'+
														  '<div id="title">Wetterwarnung</div>'+
														  '<div id="icon" class="alarm"></div>'+
														  '<div id="rows">'+
														  	'<div id="message">'+message+'</div>'+
														  '</div>'+
										  				'</div>'+
										  			'</div>'+
										  			'<div class="back"></div>'+
										  		'</div>'+
										  	'</div>'+
										  '</div>';
							$('#griditem').before(content);
			    		}
			    		else if($('#boxitem.alarm.weather','#griditem').length > 0 && message.length > 0 && message != last_weatherwarning)
			    		{
			    			last_weatherwarning = message;

			    			// refresh warning box
			    			if(message.length > 180)
			    			{
			    				// cut message
			    				message = message.substring(0, 180)+" [...]";
			    			}

			    			$('#boxitem.alarm.weather #rows #message','#griditem').html(message);

			    			console.log('refresh');
			    		}
			    		else if($('#boxitem.alarm.weather','#griditem').length > 0 && message.length == 0)
			    		{
			    			// delete warning box
			    			$('#boxitem.alarm.weather','#griditem').parent().parent().parent().parent().remove();
			    			last_weatherwarning = null;
			    		}
				    }
				    else if(messageObj['typename'] == "garbage") {
			    		var element = $('#griditem #boxitem.info.garbage');
			    		var garbageid = messageObj['value']['id'];
			    		var message = messageObj['value']['text'];

			    		message2 = "Am "+messageObj['value']['pickupdate']+" wird "+message+" abgeholt!";

			    		if($('#boxitem.info.garbage','#griditem').length == 0 && message.length > 0)
			    		{
			    			// display info box
			    			var content = '<div id="griditem">'+
			    							'<div id="flipcontainer" class="flip-container">'+
			    								'<div class="flipper">'+
			    									'<div class="front">'+
			    										'<div id="boxitem" class="info garbage">'+
															'<div id="title">Abfallentsorgung</div>'+
															'<div id="icon" class="info"></div>'+
															'<div id="rows">'+
															'<div id="message_'+garbageid+'">'+message2+'</div>'+
														'</div>'+
										  			'</div>'+
										  		'</div>'+
										  	'</div>'+
										  '</div>';
							$('#griditem').before(content);
			    		}
			    		else if($('#boxitem.info.garbage','#griditem').length != 0 && message.length > 0)
			    		{
			    			// append message
			    			if($('#boxitem.info.garbage #message_'+garbageid,'#griditem').length == 0)
							{
								$('#boxitem.info.garbage #rows','#griditem').append('<div id="message_'+garbageid+'">'+message2+'</div>');
							}
			    		}
			    		else
			    		{
			    			// delete warning box
			    			$('#boxitem.info.garbage','#griditem').parent().parent().parent().parent().remove();
			    		}
				    }
			    };			    
			}
		</script>
	</head>
	<body>
		<? include "./includes/header.php"; ?>
		<div id="boxarea">
			<div id="griditem" style="display:none"><div id="boxitem"></div></div>
			<div id="griditem">
				<div id="boxitem" class="praesenz">
					<div id="title">Präsenz</div><div id="pages">&nbsp;</div>
					<div id="icon"></div>
					<div id="buttons">
						<div id="btn_absend" class="btn-group" style="margin-top: 20px; margin-left: 15px;">
							<button type="button" class="btn btn-danger btn-lg" onclick="setpresence(0)">Abwesend setzen</button>
						</div>
						<div id="btn_presence" class="btn-group" style="margin-top: 20px; margin-left: 15px; display:none">
							<button type="button" class="btn btn-success btn-lg" onclick="setpresence(1)">Anwesend setzen</button>
						</div>
					</div>
				</div>
			</div>
			<?
			$sql = "select * from pinboard_configuration where owner='page_left' and parentid is null order by position asc";
			$result = mysql_query($sql);
			while($block = mysql_fetch_object($result))
			{
				$block_meta = json_decode($block->meta);

				// skip garbage info when garbage is picked up
				//$sql = "select pickupdate,text from garbageplan where date(NOW()) = pickupdate -INTERVAL 1 DAY";
				//$sql = "select date_format(pickupdate, '%d.%m.%Y') pickupdate,text from garbageplan where '16.07.2014' = date_format(pickupdate, '%d.%m.%Y')";
				//if($block_meta->type == 2 && mysql_num_rows(mysql_query($sql)) == 0)
				//	continue;

				// skip missed calls when no call is missed
				$sql = "select concat(lpad(day(date),2,0),'.',lpad(month(date),2,0),'.',year(date),' ', lpad(hour(date),2,0),':',lpad(minute(date),2,0)) date, rufnummer  from callerlist where date_format(date, '%d.%m.%Y') = date_format(now(), '%d.%m.%Y') and typ = 2";
				if($block_meta->type == 3 && mysql_num_rows(mysql_query($sql)) == 0)
					continue;

				// skip unread mails because theres no user logged in
				if($block_meta->type == 4)
					continue;


				if($block_meta->type == 1)
				{
					print("<div id=\"griditem\">");
						print("<div id=\"boxitem\" class=\"block_".$block_meta->type."\">");
							print("<div id=\"title\">".$block_meta->title."</div><div id=\"pages\">&nbsp;</div>");
							print("<div id=\"icon\"></div>");
							print("<div id=\"rows\">");
							$sql = "select * from pinboard_configuration where owner='appendRows-".$block->id."' and parentid = ".$block->id." order by position asc";
							$result2 = mysql_query($sql);
							while($row = mysql_fetch_object($result2))
							{
								$row_meta = json_decode($row->meta);

								print("<div id=\"row_".$row_meta->dev_id."\">");
									$sql = "select devices.dev_id, devices.identifier, devices.name, types.name typename from devices join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id where dev_id = ".$row_meta->dev_id." order by devices.name asc";
									$device = mysql_fetch_object(mysql_query($sql));
									if($device->typename == "Datensammler" || $device->typename == "PVServer")
									{
										$sql = "select value, valueunit from device_data where deviceident = '".$device->identifier."' and valuename = '".$row_meta->dev_value."' order by ddid desc limit 0,1";
										$data = mysql_fetch_object(mysql_query($sql));
										print("<div id=\"text\">".$row_meta->title."</div><div id=\"value_".$device->dev_id."\" name=\"value_".$device->dev_id."\">".$data->value." ".$data->valueunit."</div>");
									}
									else
									{
										print("<div id=\"text\">".$row_meta->title."</div><div id=\"value_".$device->dev_id."\" name=\"value_".$device->dev_id."\">---</div>");
									}
								print("</div>");
							}
							print("</div>");
						print("</div>");
					print("</div>");
				}
				/*else if($block_meta->type == 2)
				{
					print("<div id=\"boxitem\" class=\"block_".$block_meta->type." info\">");
						print("<div id=\"title\">".$block_meta->title."</div><div id=\"pages\">&nbsp;</div>");
						print("<div id=\"icon\"></div>");
						print("<div id=\"rows\">");
							$sql = "select date_format(pickupdate, '%d.%m.%Y') pickupdate,text from garbageplan where date(NOW()) = pickupdate -INTERVAL 1 DAY";
							//$sql = "select date_format(pickupdate, '%d.%m.%Y') pickupdate,text from garbageplan where '16.07.2014' = date_format(pickupdate, '%d.%m.%Y')";
							$result_item = mysql_query($sql);
							while($item = mysql_fetch_object($result_item))
							{
								print("<div id=\"message\">Am ".$item->pickupdate." wird ".explode(":",utf8_encode($item->text))[0]." abgeholt!</div>");
							}
						print("</div>");
					print("</div>");
				}*/
				else if($block_meta->type == 3)
				{
					print("<div id=\"griditem\">");
						print("<div id=\"boxitem\" class=\"block_".$block_meta->type."\">");
							print("<div id=\"title\">".$block_meta->title."</div><div id=\"pages\">&nbsp;</div>");
							print("<div id=\"icon\"></div>");
							print("<div id=\"rows\">");
								print("<div id=\"row_\">");
									$sql = "select concat(lpad(day(date),2,0),'.',lpad(month(date),2,0),'.',year(date),' ', lpad(hour(date),2,0),':',lpad(minute(date),2,0)) date, rufnummer  from callerlist where date_format(date, '%d.%m.%Y') = date_format(now(), '%d.%m.%Y') and typ = 2";
									$result_item = mysql_query($sql);
									while($item = mysql_fetch_object($result_item))
									{
										$rufnummer = "unbekannt";
										if($item->rufnummer != "")
											$rufnummer = $item->rufnummer;

										print("<div id=\"text\">".$item->date."</div><div id=\"value\">".$rufnummer."</div>");
									}
								print("</div>");
							print("</div>");
						print("</div>");
					print("</div>");
				}
			}
			?>
		</div>	
		<? include "./includes/footer.php"; ?>
	</body>
</html>

