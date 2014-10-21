<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';
    include dirname(__FILE__).'/../includes/dwd_parser.php';

    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
?>

<html>
    <head>
        <meta charset="UTF-8" />

        <title><?php echo $__CONFIG['main_sitetitle']; ?></title>

        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

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

        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/bootstrap-theme.min.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/bootstrap-custom.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <script src="./js/jquery.min.js"></script>
        <script src="./js/jquery-ui.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
        <script src="./js/clock.js"></script>
        <script src="./js/jquery-scrolltofixed.js"></script>
        <script src="./js/standalone.js"></script>
		<script type="text/javascript" src="../js/cookie.js"></script>
        <script>
            $(document).ready(function () {
                $('.dropdown-toggle').dropdown();

                connectWebSocket(<?php echo "\"".$__CONFIG['main_socketport']."\""; ?>);

                // responsive
                $("#boxitem.wetter_aktuell").load("helper-client/datacontroller.php?cmd=refresh_current_weather").fadeIn('500');
                var refreshId = setInterval(function () {
                    $("#boxitem.wetter_aktuell").load('helper-client/datacontroller.php?cmd=refresh_current_weather&' + 1*new Date()).fadeIn('500');
                }, 600000);

                $("#boxitem.wetter_prognose").load("helper-client/datacontroller.php?cmd=refresh_weather_forecast").fadeIn('500');
                var refreshId = setInterval(function () {
                    $("#boxitem.wetter_prognose").load('helper-client/datacontroller.php?cmd=refresh_weather_forecast&' + 1*new Date()).fadeIn('500');
                }, 600000);

                $("#boxitem.wetter_report").load("helper-client/datacontroller.php?cmd=refresh_weather_report").fadeIn('500');
                var refreshId = setInterval(function () {
                    $("#boxitem.wetter_report").load('helper-client/datacontroller.php?cmd=refresh_weather_report&' + 1*new Date()).fadeIn('500');
                }, 600000);

                $('#titlebar').scrollToFixed();
                $('#footer').scrollToFixed({bottom: 0});
            });

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

                socket.onopen = function () {
					// set cookie
					setCookie("websocketProtocol", connectWebSocket.connectProt);
					
                    if($('#titlebar #left #status').attr('class') == "disconnected")
                        $('#titlebar #left #status').switchClass("disconnected", "connected", 500, "easeInOutQuad");
                };

                socket.onclose = function () {
                    //try to reconnect to socketserver in 5 seconds
                    if($('#titlebar #left #status').attr('class') == "connected")
                        $('#titlebar #left #status').switchClass("connected", "disconnected", 500, "easeInOutQuad");

                    // special handling for Safari to fall back to HTTP/WS
                    // in case self-signed certificate is used
                		if(navigator.userAgent.indexOf('Safari') != -1 &&
                      navigator.userAgent.indexOf('Chrome') == -1 &&
                      event.wasClean == false &&
                      connectWebSocket.connectProt == "wss") {
                			connectWebSocket.connectProt = "ws";
                			connectWebSocket.connectCnt = 0;
                		}

                    setTimeout(function () {connectWebSocket(port)}, 5000);
                };

                socket.onmessage = function (message) {
                    if($('#titlebar #left #status').attr('class') == "disconnected")
                        $('#titlebar #left #status').switchClass("disconnected", "connected", 500, "easeInOutQuad");

                    var messageObj = JSON.parse(message['data']);

                    if (messageObj['typename'] == "dwd_warning") {
                        var element = $('#boxitem.large.alarm.weather');
                        var message = messageObj['value'];

                        if ($('#boxitem.alarm.weather').length == 0 && message.length > 0) {
                            // display warning box
                            var content = '<div id="boxitem" class="large alarm weather">'+
                                              '<div id="title">Wetterwarnung</div>'+
                                              '<div style="position: absolute; width: 98%;"><div id="icon" class="alarm"></div></div>'+
                                              '<div id="rows">'+
                                                '<div id="message">'+message+'</div>'+
                                              '</div>'+
                                          '</div>';
                            $('#boxitem').before(content);
                        } else if ($('#boxitem.alarm.weather').length > 0 && message.length == 0) {
                            // delete warning box
                            $('#boxitem.large.alarm.weather').remove();
                        }
                    }
                };
            }
        </script>
    </head>
    <body>
        <?php include dirname(__FILE__)."/includes/header.php"; ?>
        <div id="boxarea">
            <?php
            print("<div id=\"boxitem\" class=\"block_ large wetter_aktuell\"></div>");

            print("<div id=\"boxitem\" class=\"large wetter_prognose\"></div>");

            if(strlen($__CONFIG['dwd_region']) > 0)
                print("<div id=\"boxitem\" class=\"large wetter_report\"></div>");
            ?>
        </div>
       <?php include dirname(__FILE__)."/includes/footer.php"; ?>
    </body>
</html>
