<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/sessionhandler.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';
    include dirname(__FILE__).'/../includes/dwd_parser.php';
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="stylesheet" href="./css/ratchet.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <link rel="shortcut icon" type="image/x-icon" href="../img/favicons/favicon.ico">
        <link rel="apple-touch-icon" sizes="57x57" href="../img/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../img/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../img/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../img/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../img/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../img/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../img/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../img/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../img/favicons/apple-touch-icon-180x180.png">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-title" content="Hoanoho">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-32x32.png" sizes="32x32">
        <meta name="msapplication-TileColor" content="#603cba">
        <meta name="msapplication-TileImage" content="../img/favicons/mstile-144x144.png">
        <meta name="msapplication-config" content="../img/favicons/browserconfig2.xml">
        <meta name="application-name" content="Hoanoho">

        <script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/cookie.js"></script>

        <script src="./js/ratchet.js"></script>
        <script src="./js/standalone.js"></script>

        <script language="javascript">
            window.onload = function () {
                connectWebSocket(<?php echo "\"".$__CONFIG['main_socketport']."\""; ?>);
            }

            function encode(input)
            {
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

            function ajaxRequest()
            {
                var activexmodes=["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"] //activeX versions to check for in IE

                if (window.ActiveXObject) { //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
                    for (var i=0; i<activexmodes.length; i++) {
                        try {
                            return new ActiveXObject(activexmodes[i])
                        } catch (e) {
                            //suppress error
                        }
                    }
                } else if (window.XMLHttpRequest) // if Mozilla, Safari etc

                    return new XMLHttpRequest()
                else
                    return false
            }

            function connectWebSocket(port)
            {
				if (typeof connectWebSocket.connectCnt == 'undefined') {
					connectWebSocket.connectCnt = 0;
				}
				if (typeof connectWebSocket.connectProt == 'undefined') {
					connectWebSocket.connectProt = getCookie("websocketProtocol");
			
					if (connectWebSocket.connectProt == null) {
						if (window.location.protocol == "http:") {
							connectWebSocket.connectProt = "ws";
						} else if(window.location.protocol == "https:") {
							connectWebSocket.connectProt = "wss";
						}
					}
				}
				var host = window.location.hostname;
      	if (port == "80" || port == "443") {
      	  var address = connectWebSocket.connectProt + "://" + host + "/ws";
        } else {
        	var address = connectWebSocket.connectProt + "://" + host +  ":" + port + "/ws";
        }
			
                // Connect to Socketserver
                var socket = new WebSocket(address);
                socket.binaryType = 'arraybuffer';

                socket.onclose = function () {

                    // special handling for Safari to fall back to HTTP/WS
                    // in case self-signed certificate is used
                		if(navigator.userAgent.indexOf('Safari') != -1 &&
                      navigator.userAgent.indexOf('Chrome') == -1 &&
                      event.wasClean == false &&
                      connectWebSocket.connectProt == "wss") {
                			connectWebSocket.connectProt = "ws";
                			connectWebSocket.connectCnt = 0;
                		}

                    //try to reconnect to socketserver in 5 seconds
                    setTimeout(function () {connectWebSocket(port)}, 5000);
                };
				
				socket.onopen = function () {
					// set cookie
					setCookie("websocketProtocol", connectWebSocket.connectProt);
				};

                socket.onmessage = function (message) {
                    var messageObj = JSON.parse(message['data']);

                    var el_value = document.getElementById("value_" + messageObj['dev_id']);

                    var value = "---";

                    if (el_value != null) {
                        if (messageObj['typename'] == "Raspberry Pi GPIO") {
                            if(messageObj['value'] == "1")
                                value = "Eingeschaltet";
                            else if(messageObj['value'] == "0")
                                value = "Ausgeschaltet";
                            else
                                value = "---";

                            el_value.innerHTML = value;
                        } else if (messageObj['typename'] == "Temperaturregelung") {
                            var split = [];
                            var splitSign = ", ";

                            value = el_value.firstChild.nodeValue;
                            if(value != "---")
                                split = value.split(splitSign);

                            var index = "";
                            var postfix = "";
                            switch (messageObj['reading']) {
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

                            if (index.length > 0) {
                                if (split.length > 0) {
                                    var indexFound = false;
                                    for (var i = split.length - 1; i >= 0; i--) {
                                        if (split[i].indexOf(index) >= 0) {
                                            indexFound = true;
                                            split[i] = index+" "+messageObj['value']+postfix;
                                        }
                                    };

                                    if(!indexFound)
                                        split[split.length] = index+" "+messageObj['value']+postfix;
                                } else
                                    split[0] = index+" "+messageObj['value']+postfix;

                                split.sort();

                                value = "";
                                for (var i = split.length - 1; i >= 0; i--) {
                                    value += split[i]+splitSign;
                                };

                                value = value.substring(0, value.length - splitSign.length);
                            }

                            el_value.innerHTML = value;
                        } else if (messageObj['typename'] == "Jalousie") {
                            switch (messageObj['reading']) {
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
                        } else {
                            switch (messageObj['reading']) {
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

        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Pinnwand</title>
    </head>
    <body>
        <header class="bar-title">
            <h1 class="title">Pinnwand</h1>
            <a class="button" href="javascript:redirectToURL('<?php echo "../index.php?full=yes"; ?>');" data-ignore="push">Desktop</a>
        </header>

        <div class="content">
            <ul class="list">
                <?php
                $sql = "select * from pinboard_configuration where owner='page_left' and parentid is null order by position asc";
                $result = mysql_query($sql);
                while ($block = mysql_fetch_object($result)) {
                    $block_meta = json_decode($block->meta);

                    // value
                    if ($block_meta->type == 1) {
                        echo "<li class=\"list-divider\">".$block_meta->title."</li>";

                        $sql = "select * from pinboard_configuration where owner='appendRows-".$block->id."' and parentid = ".$block->id." order by position asc";
                        $result2 = mysql_query($sql);
                        while ($row = mysql_fetch_object($result2)) {
                            $row_meta = json_decode($row->meta);

                            echo "<li>".$row_meta->title;

                            $sql = "select devices.dev_id, devices.identifier, devices.name, types.name typename from devices join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id where dev_id = ".$row_meta->dev_id." order by devices.name asc";
                            $device = mysql_fetch_object(mysql_query($sql));
                            if ($device->typename == "Datensammler" || $device->typename == "PVServer") {
                                $sql = "select value, valueunit from device_data where deviceident = '".$device->identifier."' and valuename = '".$row_meta->dev_value."' order by ddid desc limit 0,1";
                                $data = mysql_fetch_object(mysql_query($sql));
                                echo "<span class=\"device_status\" id=\"value_".$device->dev_id."\">".$data->value." ".$data->valueunit."</span></li>";
                            } else {
                                echo "<span class=\"device_status\" id=\"value_".$device->dev_id."\">---</span></li>";
                            }
                        }
                    }
                    // garbage
                    else if ($block_meta->type == 2) {
                        $sql = "select date_format(pickupdate, '%d.%m.%Y') pickupdate,text from garbageplan where date(NOW()) = pickupdate -INTERVAL 1 DAY";
                        $result2 = mysql_query($sql);
                        if (mysql_num_rows($result2) > 0) {
                            echo "<li class=\"list-divider\">".$block_meta->title."</li>";

                            while ($item = mysql_fetch_object($result2)) {
                                echo "<li><div class=\"full-length\">Am ".$item->pickupdate." wird ".explode(":",$item->text)[0]." abgeholt!</div></li>";
                            }
                        }
                    }
                    // missed calls
                    else if ($block_meta->type == 3) {
                        $lastlogin = date("Y.m.d H:i",$_SESSION['logintime']);

                        //$lastlogin = '2013.12.01 00:00';
                        $sql = "select concat(lpad(day(date),2,0),'.',lpad(month(date),2,0),'.',year(date),' ', lpad(hour(date),2,0),':',lpad(minute(date),2,0)) date, rufnummer  from callerlist where date > '".$lastlogin."' and typ = 2";
                        $result2 = mysql_query($sql);
                        if (mysql_num_rows($result2) > 0) {
                            echo "<li class=\"list-divider\">".$block_meta->title."</li>";

                            while ($callmissed = mysql_fetch_object($result2)) {
                                $rufnummer = "unbekannt";
                                if($callmissed->rufnummer != "")
                                    $rufnummer = $callmissed->rufnummer;

                                echo "<li><div class=\"full-length\">".$callmissed->date.": ".$rufnummer."</div></li>";
                            }
                        }
                    }
                    // unread mails
                    else if ($block_meta->type == 4) {
                    }
                    // weather warning
                    else if ($block_meta->type == 5) {
                      if ($__CONFIG['dwd_region'] != "") {
                        // Warnings (DWD)
                        if (stristr($dwd_warnung_kurz, "Es liegt aktuell keine Warnung") === FALSE) {
                            echo "<li class=\"list-divider\">".$block_meta->title."</li>";
                            echo "<li class=\"weatherwarning alarm\"><div class=\"full-length\"><a href=\"weather.php#warnmeldung\">$dwd_warnung_kurz</a></div></li>";
                        }
                      }
                    }
                }
                ?>

                <li class="list-divider">Suchen ...</li>
                <li class="login"><form action="http://www.google.com/search" name="searchForm1"><input type="text" name="q" placeholder="bei Google"></input></form></li>
            </ul>
            <br><br><br>
        </div>
        <?php include "includes/nav.php"; ?>
    </body>
</html>
