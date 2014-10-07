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

        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="apple-touch-icon" href="../img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />

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
        <script>
            $(document).ready(function () {
                $('.dropdown-toggle').dropdown();

                connectWebSocket(<?php echo "\"".$__CONFIG['main_socketaddress']."\""; ?>);

                // responsive
                $("#boxitem.wetter_aktuell").load("helper/datacontroller.php?cmd=refresh_current_weather").fadeIn('500');
                var refreshId = setInterval(function () {
                    $("#boxitem.wetter_aktuell").load('helper/datacontroller.php?cmd=refresh_current_weather&' + 1*new Date()).fadeIn('500');
                }, 600000);

                $("#boxitem.wetter_prognose").load("helper/datacontroller.php?cmd=refresh_weather_forecast").fadeIn('500');
                var refreshId = setInterval(function () {
                    $("#boxitem.wetter_prognose").load('helper/datacontroller.php?cmd=refresh_weather_forecast&' + 1*new Date()).fadeIn('500');
                }, 600000);

                $("#boxitem.wetter_report").load("helper/datacontroller.php?cmd=refresh_weather_report").fadeIn('500');
                var refreshId = setInterval(function () {
                    $("#boxitem.wetter_report").load('helper/datacontroller.php?cmd=refresh_weather_report&' + 1*new Date()).fadeIn('500');
                }, 600000);

                $('#titlebar').scrollToFixed();
                $('#footer').scrollToFixed({bottom: 0});
            });

            function connectWebSocket(address)
            {
                // Connect to Socketserver
                var socket = new WebSocket(address);
                socket.binaryType = 'arraybuffer';

                socket.onopen = function () {
                    if($('#titlebar #left #status').attr('class') == "disconnected")
                        $('#titlebar #left #status').switchClass("disconnected", "connected", 500, "easeInOutQuad");
                };

                socket.onclose = function () {
                    //try to reconnect to socketserver in 5 seconds
                    if($('#titlebar #left #status').attr('class') == "connected")
                        $('#titlebar #left #status').switchClass("connected", "disconnected", 500, "easeInOutQuad");

                    setTimeout(function () {connectWebSocket(address)}, 5000);
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

            if(strlen($__CONFIG['dwd_url_bundesland']) > 0)
                print("<div id=\"boxitem\" class=\"large wetter_report\"></div>");
            ?>
        </div>
       <?php include dirname(__FILE__)."/includes/footer.php"; ?>
    </body>
</html>
