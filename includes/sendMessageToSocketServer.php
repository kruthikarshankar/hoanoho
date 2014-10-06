<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/sessionhandler.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';
?>

<html>
    <head>
        <script language="javascript">
            window.onload = function () {
                connectWebSocket(<?php echo "\"".$__CONFIG['main_socketaddress']."\""; ?>);
            }

            function connectWebSocket(address)
            {
                // Connect to Socketserver
                var socket = new WebSocket(address);
                socket.binaryType = 'arraybuffer';

                socket.onopen = function () {
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
