<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/sessionhandler.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';
?>

<html>
    <head>
		<script type="text/javascript" src="../js/cookie.js"></script>
        <script language="javascript">
            window.onload = function () {
                connectWebSocket(<?php echo "\"".$__CONFIG['main_socketport']."\""; ?>);
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

                socket.onopen = function () {
					// set cookie
					setCookie("websocketProtocol", connectWebSocket.connectProt);
				
                    var param_command = <?php echo $_GET['command'] ?>;
                    var param_message = <?php echo $_GET['message'] ?>;
                    socket.send(JSON.stringify({command: param_command, message: param_message}));
                };

            }
        </script>

        <meta charset="UTF-8" />
    </head>
    <body>
    </body>
</html>
