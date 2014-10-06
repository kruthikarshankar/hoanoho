<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';

    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

    if (!isset($_GET['dev_id'])) {
        exit;
    }
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

                $('#titlebar').scrollToFixed();
                $('#footer').scrollToFixed({bottom: 0});
            });

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

            function moveCameraStep(direction, ipaddress, port, user, password, camtype)
            {
            var step = 10;

            if (camtype == "instar") {
                console.log("move" + direction);
                var command;

                switch (direction) {
                    case "up":
                        command = 0;
                        break;
                    case "down":
                        command = 2;
                        break;
                    case "left":
                        command = 4;
                        break;
                    case "right":
                        command = 6;
                        break;
                    default:
                        command = 25; // home position
                        break;
                }

                var script = document.createElement('script');
                script.src = 'http://' + ipaddress + ':' + port +'/decoder_control.cgi?command=' + command + '&user=' + user + '&pwd=' + password + '&onestep=' + step;
                script.type = "text/javascript";
                document.getElementsByTagName('head')[0].appendChild(script);
                document.getElementsByTagName('head')[0].removeChild(script);
            }
        }

        function moveCamera(direction, ipaddress, port, user, password, camtype)
        {
            if (camtype == "instar") {
                console.log("move" + direction);
                var command;

                switch (direction) {
                    case "up":
                        command = 0;
                        break;
                    case "down":
                        command = 2;
                        break;
                    case "left":
                        command = 4;
                        break;
                    case "right":
                        command = 6;
                        break;
                    default:
                        command = 25; // home position
                        break;
                }

                var script = document.createElement('script');
                script.src = 'http://' + ipaddress + ':' + port +'/decoder_control.cgi?command=' + command + '&user=' + user + '&pwd=' + password;
                script.type = "text/javascript";
                document.getElementsByTagName('head')[0].appendChild(script);
                document.getElementsByTagName('head')[0].removeChild(script);
            }
        }

        function stopCamera(direction, ipaddress, port, user, password, camtype)
        {
            if (camtype == "instar") {
                console.log("stop" + direction);
                var command;

                switch (direction) {
                    case "up":
                        command = 1;
                        break;
                    case "down":
                        command = 3;
                        break;
                    case "left":
                        command = 5;
                        break;
                    case "right":
                        command = 7;
                        break;
                }

                var script = document.createElement('script');
                script.src = 'http://' + ipaddress + ':' + port +'/decoder_control.cgi?command=' + command + '&user=' + user + '&pwd=' + password;
                script.type = "text/javascript";
                document.getElementsByTagName('head')[0].appendChild(script);
                document.getElementsByTagName('head')[0].removeChild(script);
            }
        }

        function moveCameraPosition(position, ipaddress, port, user, password, camtype, dev_id)
        {
            if (position != "") {
                if (camtype == "instar") {
                    var command = eval("30+" + position + "+" + eval(position + "-1"));
                    var script = document.createElement('script');
                    script.src = 'http://' + ipaddress + ':' + port +'/decoder_control.cgi?command=' + command + '&user=' + user + '&pwd=' + password;
                    script.type = "text/javascript";
                    document.getElementsByTagName('head')[0].appendChild(script);
                    document.getElementsByTagName('head')[0].removeChild(script);
                }
            }
        }
        </script>
    </head>
    <body>
        <?php include "./includes/header.php"; ?>
        <div id="boxarea">
            <div id="boxitem" class="large webcam">
                <?php
                    $sql = "SELECT value from configuration where configstring = 'vendor' and dev_id = " . $_GET['dev_id'];
                    $result2 = mysql_query($sql);
                    $resultArr = mysql_fetch_assoc($result2);
                    $cam_vendor = $resultArr['value'];

                    if ($cam_vendor == "instar") {
                        $cam_ipaddress = "";
                        $cam_port = "80";
                        $cam_username = "admin";
                        $cam_password = "";

                        $sql = "SELECT value from configuration where configstring = 'ipaddress' and dev_id = " . $_GET['dev_id'];
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $cam_ipaddress = $resultArr['value'];

                        $sql = "SELECT value from configuration where configstring = 'port' and dev_id = " . $_GET['dev_id'];
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $cam_port = $resultArr['value'];

                        $sql = "SELECT value from configuration where configstring = 'username' and dev_id = " . $_GET['dev_id'];
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $cam_username = $resultArr['value'];

                        $sql = "SELECT value from configuration where configstring = 'password' and dev_id = " . $_GET['dev_id'];
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $cam_password = $resultArr['value'];

                        $sql = "SELECT value from configuration where configstring = 'invertcontrols' and dev_id = " . $_GET['dev_id'];
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $invertcontrols = $resultArr['value'];

                        $sql = "SELECT value from configuration where configstring = 'positionslots' and dev_id = " . $_GET['dev_id'];
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $positionslots = $resultArr['value'];

                        print("<div id=\"image_left\"><img src='http://".$cam_ipaddress.":".$cam_port."/videostream.cgi?user=".$cam_username."&pwd=".$cam_password."&resolution=32&rate=0'></div>");
                        print("<div id=\"controlpad_right\">");
                        print("<div id=\"controls\">");
                            if ($invertcontrols == "on") {
                                if (!strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') && !strstr($_SERVER['HTTP_USER_AGENT'],'iPod') && !strstr($_SERVER['HTTP_USER_AGENT'],'iPad') && !strstr($_SERVER['HTTP_USER_AGENT'],'Android')) {
                                    // left
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -110px; margin-top: 100px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onmousedown='moveCamera(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera links schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // up
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -50px; margin-top: 50px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onmousedown='moveCamera(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera oben schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-up\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // down
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -50px; margin-top: 150px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onmousedown='moveCamera(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera unten schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-down\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // right
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: 10px; margin-top: 100px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onmousedown='moveCamera(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera rechts schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-right\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                } else {
                                    // left
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -110px; margin-top: 100px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onclick='moveCameraStep(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera links schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // up
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -50px; margin-top: 50px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onclick='moveCameraStep(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera oben schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-up\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // down
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -50px; margin-top: 150px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onclick='moveCameraStep(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera unten schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-down\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // right
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: 10px; margin-top: 100px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onclick='moveCameraStep(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera rechts schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-right\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                }
                            } else {
                                if (!strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') && !strstr($_SERVER['HTTP_USER_AGENT'],'iPod') && !strstr($_SERVER['HTTP_USER_AGENT'],'iPad') && !strstr($_SERVER['HTTP_USER_AGENT'],'Android')) {
                                    // left
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -110px; margin-top: 100px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onmousedown='moveCamera(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera links schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // up
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -50px; margin-top: 50px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onmousedown='moveCamera(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera oben schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-up\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // down
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -50px; margin-top: 150px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onmousedown='moveCamera(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera unten schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-down\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // right
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: 10px; margin-top: 100px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onmousedown='moveCamera(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera rechts schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-right\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                } else {
                                    // left
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -110px; margin-top: 100px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onclick='moveCameraStep(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera links schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-left\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // up
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -50px; margin-top: 50px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onclick='moveCameraStep(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera oben schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-up\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // down
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: -50px; margin-top: 150px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onclick='moveCameraStep(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera unten schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-down\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                    // right
                                    print("<div class=\"btn-group btn-group-lg\" style=\"position: absolute; margin-left: 10px; margin-top: 100px;\">");
                                        print("<button type=\"button\" class=\"btn btn-warning\" onclick='moveCameraStep(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera rechts schwenken\">");
                                            print("&nbsp;<span class=\"glyphicon glyphicon-arrow-right\"></span>&nbsp;");
                                        print("</button>");
                                    print("</div>");
                                }
                            }

                            if ($positionslots > 0) {
                                print("<div class=\"btn-group btn-group-lg dropup\" style=\"position: absolute; margin-left: -100px; margin-top: 240px;\">");
                                    print("<button type=\"button\" class=\"btn btn-custom dropdown-toggle\" data-toggle=\"dropdown\">Gehe zu Position</button>");
                                        print("<ul class=\"dropdown-menu scrollable-menu webcam\" role=\"menu\">");
                                            for ($i=1; $i <= $positionslots ; $i++) {
                                                echo "<li><a href=\"#\" onclick=\"moveCameraPosition(".$i.", '".$cam_ipaddress."', '".$cam_port."', '".$cam_username."', '".$cam_password."', '".$cam_vendor."', ".$_GET['dev_id'].")\">Position ".$i."</a></li>";
                                            }
                                        print("</ul>");
                                    print("</div>");
                                print("</div>");
                            }
                        print("</div>");
                    }
                ?>
            </div>
        </div>
        <?php include "./includes/footer.php"; ?>
    </body>
</html>
