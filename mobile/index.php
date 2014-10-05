<?
	include dirname(__FILE__).'/..//includes/dbconnection.php';
	include dirname(__FILE__).'/..//includes/sessionhandler.php';
	include dirname(__FILE__).'/..//includes/getConfiguration.php';
	include dirname(__FILE__).'/..//includes/dwd_parser.php';

	$protocol = "http";
	if($_SERVER["HTTPS"] == "on")
	  $protocol = "https";
?>

<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="apple-mobile-web-app-capable" content="yes" />  
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
		
		<link rel="stylesheet" href="./css/ratchet.css" type="text/css" media="screen" title="no title" charset="UTF-8">

		<link rel="apple-touch-icon" href="../img/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />

		<script type="text/javascript" src="../js/jquery.min.js"></script>

		<script src="./js/ratchet.js"></script>
		<script src="./js/standalone.js"></script>

		<script language="javascript">
			window.onload = function()
			{
				connectWebSocket(<? echo "\"".$__CONFIG['main_socketaddress']."\""; ?>);
			}

			function encode(input) {
			    var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
			    var output = "";
			    var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
			    var i = 0;

			    while (i < input.length) {
					chr1 = input[i++];
					chr2 = i < input.length ? input[i++] : Number.NaN; // Not sure if the index 
					chr3 = i < input.length ? input[i++] : Number.NaN; // checks are needed here
					
					enc1 = chr1 >> 2;
					enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
					enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
					enc4 = chr3 & 63;

			        if (isNaN(chr2)) {
			            enc3 = enc4 = 64;
			        } else if (isNaN(chr3)) {
			            enc4 = 64;
			        }
			        output += keyStr.charAt(enc1) + keyStr.charAt(enc2) + keyStr.charAt(enc3) + keyStr.charAt(enc4);
			    }
			    return output;
			}

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

				socket.onclose = function(){
			        //try to reconnect to socketserver in 5 seconds
			        setTimeout(function(){connectWebSocket(address)}, 5000);
			    };

			    socket.onmessage = function(message) {
			    	var messageObj = JSON.parse(message['data']);

			    	var el_value = document.getElementById("value_" + messageObj['dev_id']);

			    	var value = "---";
			    	
			    	if(el_value != null)
			    	{
			    		if(messageObj['typename'] == "Raspberry Pi GPIO")
				    	{
				    		if(messageObj['value'] == "1")
				    			value = "Eingeschaltet";
				    		else if(messageObj['value'] == "0")
				    			value = "Ausgeschaltet";
				    		else
				    			value = "---";

				    		el_value.innerHTML = value;
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
						    			value = "Offen";
						    		else if(messageObj['value'] == 0)
						    			value = "Geschlossen";
						    		else
						    			value = messageObj['value']+"%";

						    		el_value.innerHTML = value;
				    				break;
				    			case 'motor':
				    				var movement = ""
			                        if(messageObj['value'].indexOf('up:') > -1)
			                            movement = "hoch";
			                        if(messageObj['value'].indexOf('down:') > -1)
			                            movement = "runter";

				    				value = 'Fährt '+movement+' ...';

				    				el_value.innerHTML = value;
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
						    			value = "Eingeschaltet";
						    		else if(messageObj['value'] == "off")
						    			value = "Ausgeschaltet";
						    		else if(messageObj['value'] == "open")
						    			value = "Offen";
						    		else if(messageObj['value'] == "closed")
						    			value = "Geschlossen";
						    		else
						    			value = messageObj['value'];

						    		el_value.innerHTML = value;
						    		break;
						    	default:
						    		break;
				    		}
				    	}
			    	}
			    };			    
			}

			function redirectToURL(URL)
			{
				window.location.href = URL;
			}
		</script>

		<title><? echo $__CONFIG['main_sitetitle'] ?> - Übersicht</title>
	</head>
	<body>
		<header class="bar-title">
	    	<h1 class="title">Übersicht</h1>
	    	<a class="button" href="javascript:redirectToURL('<? echo $protocol . "://" . $_SERVER['HTTP_HOST'] . "/index.php?full=yes"; ?>');" data-ignore="push">Desktop</a>
	  	</header>

	  	<div class="content">
		    <ul class="list">
		    	<?
		    	$sql = "select * from pinboard_configuration where owner='page_left' and parentid is null order by position asc";
				$result = mysql_query($sql);
				while($block = mysql_fetch_object($result))
				{
					$block_meta = json_decode($block->meta);

					// value
					if($block_meta->type == 1)
					{
						echo "<li class=\"list-divider\">".$block_meta->title."</li>";

						$sql = "select * from pinboard_configuration where owner='appendRows-".$block->id."' and parentid = ".$block->id." order by position asc";
						$result2 = mysql_query($sql);
						while($row = mysql_fetch_object($result2))
						{
							$row_meta = json_decode($row->meta);

							echo "<li>".$row_meta->title;

							$sql = "select devices.dev_id, devices.identifier, devices.name, types.name typename from devices join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id where dev_id = ".$row_meta->dev_id." order by devices.name asc";
							$device = mysql_fetch_object(mysql_query($sql));
							if($device->typename == "Datensammler" || $device->typename == "PVServer")
							{
								$sql = "select value, valueunit from device_data where deviceident = '".$device->identifier."' and valuename = '".$row_meta->dev_value."' order by ddid desc limit 0,1";
								$data = mysql_fetch_object(mysql_query($sql));
								echo "<span class=\"device_status\" id=\"value_".$device->dev_id."\">".$data->value." ".$data->valueunit."</span></li>";
							}
							else
							{
		    					echo "<span class=\"device_status\" id=\"value_".$device->dev_id."\">---</span></li>";
							}
						}
					}
					// garbage
					else if($block_meta->type == 2)
					{
						$sql = "select date_format(pickupdate, '%d.%m.%Y') pickupdate,text from garbageplan where date(NOW()) = pickupdate -INTERVAL 1 DAY";
						$result2 = mysql_query($sql);
						if(mysql_num_rows($result2) > 0) {
							echo "<li class=\"list-divider\">".$block_meta->title."</li>";

							while($item = mysql_fetch_object($result2))
							{
								echo "<li><div class=\"full-length\">Am ".$item->pickupdate." wird ".explode(":",utf8_encode($item->text))[0]." abgeholt!</div></li>";
							}
						}
					}
					// missed calls
					else if($block_meta->type == 3)
					{
						$lastlogin = date("Y.m.d H:i",$_SESSION['logintime']);
				
						//$lastlogin = '2013.12.01 00:00';
						$sql = "select concat(lpad(day(date),2,0),'.',lpad(month(date),2,0),'.',year(date),' ', lpad(hour(date),2,0),':',lpad(minute(date),2,0)) date, rufnummer  from callerlist where date > '".$lastlogin."' and typ = 2";
						$result2 = mysql_query($sql);
						if(mysql_num_rows($result2) > 0) {
							echo "<li class=\"list-divider\">".$block_meta->title."</li>";

							while($callmissed = mysql_fetch_object($result2))
							{
								$rufnummer = "unbekannt";
								if($callmissed->rufnummer != "")
									$rufnummer = $callmissed->rufnummer;

								echo "<li><div class=\"full-length\">".$callmissed->date.": ".$rufnummer."</div></li>";
							}
						}
					}
					// unread mails
					else if($block_meta->type == 4)
					{
					}
					// weather warning
					else if($block_meta->type == 5)
					{
						// Warnings (DWD)
				    	if(!stristr($dwd_warnung, "Es liegt aktuell keine Warnung"))
				    	{
							echo "<li class=\"list-divider\">".$block_meta->title."</li>";
							echo "<li class=\"alarm weatherwarning\"><div class=\"full-length\">$dwd_warnung</div></li>";
						}
					}
				}
				?>
		    	
		    	<li class="list-divider">Suchen ...</li>
	    		<li class="login"><form action="http://www.google.com/search" name="searchForm1"><input type="text" name="q" placeholder="bei Google"></input></form></li>
				<? if($_SESSION['isAdmin'] == 1) { ?>
				<li class="login"><form action="http://wiki.springfield.lan/index.php" name="searchForm2"><input type="text" name="search" id="search" placeholder="in Wiki (IT)"></input></form></li>
				<? } ?>
				<li class="login"><form action="http://wiki2.springfield.lan/index.php" name="searchForm3"><input type="text" name="search" placeholder="in Wiki (Haus)"></input></form></li>
			</ul>
			<br><br><br>
		</div>
		<? include "includes/nav.php"; ?>
	</body>
</html>