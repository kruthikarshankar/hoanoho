<?php
    include dirname(__FILE__).'/includes/dbconnection.php';
    include dirname(__FILE__).'/includes/sessionhandler.php';
    include dirname(__FILE__).'/includes/getConfiguration.php';

    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
?>

<html>
    <head>
        <script type="text/javascript" src="./js/jquery.min.js"></script>

        <script type="text/javascript">
        var architecture = "<?php echo $_SERVER['HTTP_USER_AGENT'] ?>";
        var activeModalDiv = "";
        var activeWebcamTimer = "";
        var activeModalIsWebcamLiveStream = "";

        window.onload = function () {
            //adding the event listerner for Mozilla
            if (window.addEventListener) {
                document.addEventListener('DOMMouseScroll', preventScrolling, false);
                document.addEventListener('touchmove',preventScrolling, false);
            }

            //for IE/OPERA etc
            document.onmousewheel = preventScrolling;
            window.onscroll = preventScrolling;
        }

        document.onkeydown = function (evt) {
            evt = evt || window.event;
            // Escape Key
            if (evt.keyCode == 27) {
                if (activeModalDiv != "") {
                    // close modal window when open
                    var arrSplit = activeModalDiv.split("_");
                    toggleModal(arrSplit[1]);
                }
            }
        };

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

        function MakeCenter(object)
        {
            if (object !=null) {
                var left=(object.offsetParent.clientWidth/2)-(object.clientWidth/2)+object.offsetParent.scrollLeft;
                var top=((object.offsetParent.clientHeight/2)-(object.clientHeight/2)+object.offsetParent.scrollTop + (window.innerHeight/2)) - (object.offsetHeight/4);
                object.style.top = top;
                object.style.left = left;
            }
        }

        function preventScrolling(event)
        {
            if(activeModalDiv == "")
                document.body.style.overflow ="auto";
        }

        function toggleModal(device_id)
        {
            var el = document.getElementById("modal-webcam"+device_id);
            var elbg = document.getElementById("modal-background");

            if (activeModalDiv == "") {
                activeModalDiv = "modal-webcam_"+device_id+"_webcam";

                <?php
                    $sql = "SELECT dev_id from devices left join device_types on device_types.dtype_id = devices.dtype_id left join types on types.type_id = device_types.type_id where types.name = 'Webcam'";
                    $result = mysql_query($sql);
                    echo "var imagebox = null;";
                    while ($webcam = mysql_fetch_object($result)) {
                        $sql = "SELECT value from configuration where configstring = 'vendor' and dev_id = " . $webcam->dev_id;
                        $config_result = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($config_result);
                        $cam_vendor = $resultArr['value'];

                        if ($cam_vendor == "instar") {
                            $cam_ipaddress = "";
                            $cam_port = "80";
                            $cam_username = "admin";
                            $cam_password = "";

                            $sql = "SELECT value from configuration where configstring = 'ipaddress' and dev_id = " . $webcam->dev_id;
                            $config_result = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($config_result);
                            $cam_ipaddress = $resultArr['value'];

                            $sql = "SELECT value from configuration where configstring = 'port' and dev_id = " . $webcam->dev_id;
                            $config_result = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($config_result);
                            $cam_port = $resultArr['value'];

                            $sql = "SELECT value from configuration where configstring = 'username' and dev_id = " . $webcam->dev_id;
                            $config_result = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($config_result);
                            $cam_username = $resultArr['value'];

                            $sql = "SELECT value from configuration where configstring = 'password' and dev_id = " . $webcam->dev_id;
                            $config_result = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($config_result);
                            $cam_password = $resultArr['value'];

                            echo "activeModalIsWebcamLiveStream = \"yes\";";
                            echo "imagebox = document.getElementById(\"webcamstream_img".$webcam->dev_id."\");";
                            echo "if (imagebox != null && device_id == ".$webcam->dev_id.") {";
                            echo "	imagebox.src = 'http://".$cam_ipaddress.":".$cam_port."/videostream.cgi?user=".$cam_username."&pwd=".$cam_password."&resolution=32&rate=0';";
                            echo "}";
                        }
                    }
                ?>

                MakeCenter(el);
            } else {
                window.clearInterval(activeWebcamTimer);
                activeWebcamTimer = "";
                activeModalDiv = "";
                if (activeModalIsWebcamLiveStream == "yes") {
                    var imagebox = document.getElementById("webcamstream_img"+device_id);
                    if (imagebox != null) {
                        imagebox.src = "./img/blank.png";
                        activeModalIsWebcamLiveStream = "";
                    }
                }
            }

            if(elbg.style.display == "" || elbg.style.display == "none")
                elbg.style.display = elbg.style.display = "block";
            else
                $(elbg).fadeOut(300);

            el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";

            return false;
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
                    position = position.split(' ');
                    var command = eval("30+" + position[1] + "+" + eval(position[1] + "-1"));
                    var script = document.createElement('script');
                    script.src = 'http://' + ipaddress + ':' + port +'/decoder_control.cgi?command=' + command + '&user=' + user + '&pwd=' + password;
                    script.type = "text/javascript";
                    document.getElementsByTagName('head')[0].appendChild(script);
                    document.getElementsByTagName('head')[0].removeChild(script);

                    var elem = document.getElementById("position"+dev_id);
                    elem.selectedIndex = 0;
                }
            }
        }
        </script>

        <meta charset="UTF-8" />
        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/webcam.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

        <link rel="apple-touch-icon" href="./img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />

        <title><?php echo $__CONFIG['main_sitetitle'] . " - Webcamübersicht"?></title>
    </head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <div id="modal-background">&nbsp;</div>

    <?php
        $sql = "SELECT dev_id,devices.name from devices left join device_types on device_types.dtype_id = devices.dtype_id left join types on types.type_id = device_types.type_id where types.name = 'Webcam'";
        $result = mysql_query($sql);

        while ($webcam = mysql_fetch_object($result)) {
            print("<div id=\"modal-webcam".$webcam->dev_id."\">");
                print("<div id=\"section0\">");
                    print("<div id=\"closebutton\" onclick='javascript:toggleModal(" . $webcam->dev_id . ");'></div>");
                    print("<h1><span>".$webcam->name."</span></h1>");

                    $sql = "SELECT value from configuration where configstring = 'vendor' and dev_id = " . $webcam->dev_id;
                    $result2 = mysql_query($sql);
                    $resultArr = mysql_fetch_assoc($result2);
                    $cam_vendor = $resultArr['value'];

                    if ($cam_vendor == "instar") {
                        $cam_ipaddress = "";
                        $cam_port = "80";
                        $cam_username = "admin";
                        $cam_password = "";

                        $sql = "SELECT value from configuration where configstring = 'ipaddress' and dev_id = " . $webcam->dev_id;
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $cam_ipaddress = $resultArr['value'];

                        $sql = "SELECT value from configuration where configstring = 'port' and dev_id = " . $webcam->dev_id;
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $cam_port = $resultArr['value'];

                        $sql = "SELECT value from configuration where configstring = 'username' and dev_id = " . $webcam->dev_id;
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $cam_username = $resultArr['value'];

                        $sql = "SELECT value from configuration where configstring = 'password' and dev_id = " . $webcam->dev_id;
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $cam_password = $resultArr['value'];

                        $sql = "SELECT value from configuration where configstring = 'invertcontrols' and dev_id = " . $webcam->dev_id;
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $invertcontrols = $resultArr['value'];

                        $sql = "SELECT value from configuration where configstring = 'positionslots' and dev_id = " . $webcam->dev_id;
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $positionslots = $resultArr['value'];

                        //print("<div id=\"webcamstream".$webcam->dev_id."\"><img src='http://".$cam_ipaddress.":".$cam_port."/videostream.cgi?user=".$cam_username."&pwd=".$cam_password."&resolution=32&rate=0'></div>");
                        print("<div id=\"webcamstream".$webcam->dev_id."\"><img id=\"webcamstream_img".$webcam->dev_id."\" src='/img/blank.png'></div>");
                        if ($positionslots > 0) {
                            print("<br><div id=\"controlpad\">");
                                print("Gehe zu: <select id=\"position".$webcam->dev_id."\" onchange=\"javascript:moveCameraPosition(this.value, '".$cam_ipaddress."', '".$cam_port."', '".$cam_username."', '".$cam_password."', '".$cam_vendor."', ".$webcam->dev_id.")\">");
                                print("<option></option>");
                                for ($i=1; $i <= $positionslots ; $i++) {
                                    print("<option>Position ".$i."</option>");
                                }
                                print("</select>");
                            print("</div><br>");
                        }
                        print("<div id=\"controlpad\">");
                            if ($invertcontrols == "on") {
                                if (!strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') && !strstr($_SERVER['HTTP_USER_AGENT'],'iPod') && !strstr($_SERVER['HTTP_USER_AGENT'],'iPad') && !strstr($_SERVER['HTTP_USER_AGENT'],'Android')) {
                                    print("<button id=\"controlbutton\" onmousedown='moveCamera(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera links schwenken\"><img src=\"./img/left.png\"></button>");
                                    print("<button id=\"controlbutton\" onmousedown='moveCamera(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera oben schwenken\"><img src=\"./img/up.png\"></button>");
                                    print("<button id=\"controlbutton\" onmousedown='moveCamera(\"home\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera zentrieren\"><img src=\"./img/dot.png\"></button>");
                                    print("<button id=\"controlbutton\" onmousedown='moveCamera(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera unten schwenken\"><img src=\"./img/down.png\"></button>");
                                    print("<button id=\"controlbutton\" onmousedown='moveCamera(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera rechts schwenken\"><img src=\"./img/right.png\"></button>");
                                } else {
                                    print("<button id=\"controlbutton\" onclick='moveCameraStep(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera links schwenken\"><img src=\"./img/left.png\"></button>");
                                    print("<button id=\"controlbutton\" onclick='moveCameraStep(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera oben schwenken\"><img src=\"./img/up.png\"></button>");
                                    print("<button id=\"controlbutton\" onclick='moveCameraStep(\"home\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera zentrieren\"><img src=\"./img/dot.png\"></button>");
                                    print("<button id=\"controlbutton\" onclick='moveCameraStep(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera unten schwenken\"><img src=\"./img/down.png\"></button>");
                                    print("<button id=\"controlbutton\" onclick='moveCameraStep(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera rechts schwenken\"><img src=\"./img/right.png\"></button>");
                                }
                            } else {
                                if (!strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') && !strstr($_SERVER['HTTP_USER_AGENT'],'iPod') && !strstr($_SERVER['HTTP_USER_AGENT'],'iPad') && !strstr($_SERVER['HTTP_USER_AGENT'],'Android')) {
                                    print("<button id=\"controlbutton\" onmousedown='moveCamera(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera links schwenken\"><img src=\"./img/left.png\"></button>");
                                    print("<button id=\"controlbutton\" onmousedown='moveCamera(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera oben schwenken\"><img src=\"./img/up.png\"></button>");
                                    print("<button id=\"controlbutton\" onmousedown='moveCamera(\"home\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera zentrieren\"><img src=\"./img/dot.png\"></button>");
                                    print("<button id=\"controlbutton\" onmousedown='moveCamera(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera unten schwenken\"><img src=\"./img/down.png\"></button>");
                                    print("<button id=\"controlbutton\" onmousedown='moveCamera(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' onmouseup='stopCamera(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera rechts schwenken\"><img src=\"./img/right.png\"></button>");
                                } else {
                                    print("<button id=\"controlbutton\" onclick='moveCameraStep(\"left\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera links schwenken\"><img src=\"./img/left.png\"></button>");
                                    print("<button id=\"controlbutton\" onclick='moveCameraStep(\"up\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera oben schwenken\"><img src=\"./img/up.png\"></button>");
                                    print("<button id=\"controlbutton\" onclick='moveCameraStep(\"home\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera zentrieren\"><img src=\"./img/dot.png\"></button>");
                                    print("<button id=\"controlbutton\" onclick='moveCameraStep(\"down\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera unten schwenken\"><img src=\"./img/down.png\"></button>");
                                    print("<button id=\"controlbutton\" onclick='moveCameraStep(\"right\",\"".$cam_ipaddress."\",\"".$cam_port."\",\"".$cam_username."\",\"".$cam_password."\",\"".$cam_vendor."\")' title=\"Kamera rechts schwenken\"><img src=\"./img/right.png\"></button>");
                                }
                            }
                        print("</div><br>");
                    }
                print("</div>");
            print("</div>");
        }
    ?>

    <section class="main_webcam">
        <h1><span>Webcam Übersicht</span></h1>
        <div id="outer_wrapper">
        <?php
            $sql = "SELECT dev_id,devices.name from devices left join device_types on device_types.dtype_id = devices.dtype_id left join types on types.type_id = device_types.type_id where types.name = 'Webcam'";
            $result = mysql_query($sql);
            if (mysql_num_rows($result) > 0) {
                while ($webcam = mysql_fetch_object($result)) {
                    echo "<div onclick='javascript:toggleModal(" . $webcam->dev_id . ");' id=\"webcam_wrapper\">";
                        echo "<div id=\"webcam_headline\">".$webcam->name."</div>";
                        $sql = "SELECT value from configuration where configstring = 'vendor' and dev_id = " . $webcam->dev_id;
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $cam_vendor = $resultArr['value'];

                        if ($cam_vendor == "instar") {
                            $cam_ipaddress = "";
                            $cam_port = "80";
                            $cam_username = "admin";
                            $cam_password = "";

                            $sql = "SELECT value from configuration where configstring = 'ipaddress' and dev_id = " . $webcam->dev_id;
                            $result2 = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($result2);
                            $cam_ipaddress = $resultArr['value'];

                            $sql = "SELECT value from configuration where configstring = 'port' and dev_id = " . $webcam->dev_id;
                            $result2 = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($result2);
                            $cam_port = $resultArr['value'];

                            $sql = "SELECT value from configuration where configstring = 'username' and dev_id = " . $webcam->dev_id;
                            $result2 = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($result2);
                            $cam_username = $resultArr['value'];

                            $sql = "SELECT value from configuration where configstring = 'password' and dev_id = " . $webcam->dev_id;
                            $result2 = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($result2);
                            $cam_password = $resultArr['value'];

                            print("<div id=\"webcam_stream".$webcam->dev_id."\"><img src='http://".$cam_ipaddress.":".$cam_port."/videostream.cgi?user=".$cam_username."&pwd=".$cam_password."&resolution=32&rate=0'></div>");
                        }
                    echo "</div>";
                }

                echo "<div id=\"clear\"></div>";
            } else {
                print("<div id=\"error\">Es wurde noch kein Gerät vom Grundtyp 'Webcam' in der <a href=\"./configuration_automation.php\">Steuerungskonfiguration</a> angelegt!</div>");
            }
        ?>
        </div>
    </section>

</body>
</html>
