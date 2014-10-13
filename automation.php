<?php
    include dirname(__FILE__).'/includes/dbconnection.php';
    include dirname(__FILE__).'/includes/sessionhandler.php';
    include dirname(__FILE__).'/includes/getConfiguration.php';
?>

<html>
    <head>
        <script type="text/javascript" src="./js/jquery.min.js"></script>
        <script type="text/javascript" src="./js/jquery-ui.min.js"></script>

        <script type="text/javascript" src="./js/nogray_js/1.1.5/ng_all.js"></script>
        <script type="text/javascript" src="./js/nogray_js/1.1.5/components/slider.js"></script>
        <script type="text/javascript" src="./js/nogray_js/1.1.5/components/colorpicker.js"></script>
        <script type="text/javascript" src="./js/connectWebsocket.js"></script>
        <script type="text/javascript" src="./js/toggleDevice.js"></script>

        <script type="text/javascript">
        var architecture = "<?php echo $_SERVER['HTTP_USER_AGENT'] ?>";
        var activeModalDiv = "";
        var activeWebcamTimer = "";
        var activeModalIsWebcamLiveStream = "";

        $(document).ready(function () {
                // draggable event
                $(".draggable").draggable({
                    update: function (event, ui) {
                        var newOrder = $(this).draggable('toArray').toString();
                        //$.get('saveSortable.php', {order:newOrder});
                    }
                });
                $(".draggable").stopPropagation();
        });

        window.onload = function () {
            //adding the event listerner for Mozilla
            if (window.addEventListener) {
                document.addEventListener('DOMMouseScroll', preventScrolling, false);
                //document.addEventListener('touchmove',preventScrolling, false); // 07.08.2013: Auskommentiert, da sonst der Slider für die Dimmer nicht funktioniert.
            }

            //for IE/OPERA etc
            document.onmousewheel = preventScrolling;
            window.onscroll = preventScrolling;

            connectWebSocket(<?php echo "\"".$__CONFIG['main_socketaddress']."\""; ?>);

            // create color pickers for philips hue
            <?php
                echo "ng.ready( function () {";
                $sql = "select devices.dev_id, device_types.dtype_id, devices.isStructure, devices.identifier d_identifier, devices.name name, device_floors.name floorname, types.name typename from devices join device_floors on device_floors.floor_id = devices.floor_id join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id";
                $result = mysql_query($sql);
                while ($device = mysql_fetch_object($result)) {
                    if ($device->typename == "Philips Hue") {
                        echo "var clrpk".$device->dev_id." = new ng.ColorPicker({ input: 'color_picker".$device->dev_id."' });";
                    }
                }
                echo "});";
            ?>
        }

        document.onkeydown = function (evt) {
            evt = evt || window.event;
            // Escape Key
            if (evt.keyCode == 27) {
                if (activeModalDiv != "") {
                    // close modal window when open
                    var arrSplit = activeModalDiv.split("_");
                    toggleModal(arrSplit[1], arrSplit[2]);
                }
            }
        };

        // public method for encoding an Uint8Array to base64
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
            if (activeModalDiv != "") {
                if (architecture.indexOf("Android") < 0) {
                    event.preventDefault();
                    document.body.style.overflow ="hidden";
                }
            } else
                document.body.style.overflow ="auto";
        }

        function toggleModal(device_id, device_type)
        {
            var el = document.getElementById("modal-device" + device_id);
            var elbg = document.getElementById("modal-background");

            if (activeModalDiv == "") {
                activeModalDiv = "modal-device_" + device_id + "_" + device_type.toLowerCase();

                if (device_type.toLowerCase() == "webcam") {
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
                }

                MakeCenter(el);
            } else {
                if (device_type.toLowerCase() == "webcam") {
                    window.clearInterval(activeWebcamTimer);
                    activeWebcamTimer = "";
                    if (activeModalIsWebcamLiveStream == "yes") {
                        var imagebox = document.getElementById("webcamstream_img"+device_id);
                        if (imagebox != null) {
                            imagebox.src = "./img/blank.png";
                            activeModalIsWebcamLiveStream = "";
                        }
                    }
                }
                activeModalDiv = "";
            }

            if(elbg.style.display == "" || elbg.style.display == "none")
                elbg.style.display = elbg.style.display = "block";
            else
                $(elbg).fadeOut(300);

            el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";

            return false;
        }

        function updateSliderValue(value,device_id)
        {
            document.getElementById("slider_value"+device_id).value = value;
        }

        function moveCameraStep(direction, ipaddress, port, user, password, camtype)
        {
            var step = 10;

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
                script.src = 'http://' + ipaddress + ':' + port +'/decoder_control.cgi?command=' + command + '&user=' + user + '&pwd=' + password + '&onestep=' + step;
                script.type = "text/javascript";
                document.getElementsByTagName('head')[0].appendChild(script);
                document.getElementsByTagName('head')[0].removeChild(script)
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
                document.getElementsByTagName('head')[0].removeChild(script)
            }
        }

        function stopCamera(direction, ipaddress, port, user, password, camtype)
        {
            if (camtype == "instar") {
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
                document.getElementsByTagName('head')[0].removeChild(script)
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

        <meta charset="UTF-8"; />

        <link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/automation.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <?php
            // dynamically generate base css code for device types
            $sql = "select * from device_types";
            $result = mysql_query($sql);

            print("<style type=\"text/css\">");
            while ($type = mysql_fetch_object($result)) {
                print(".main_automation .type".$type->dtype_id." { background-image: url('./helper/datacontroller.php?cmd=getimage&id=".$type->image_off_id."'); background-repeat: no-repeat; background-position: center; }");
            }
            print("</style>\n");

            // dynamically generate css code for floors
            $sql = "select floor_id, image_id from device_floors order by position asc";
            $result = mysql_query($sql);

            while ($floor = mysql_fetch_object($result)) {
                print("<style type=\"text/css\">");
                print(".main_automation #floor".$floor->floor_id." { width: 640px; height: 480px; background-image: url('./helper/datacontroller.php?cmd=getimage&id=".$floor->image_id."'); background-repeat: no-repeat; background-position: center; background-size: 95%; }");
                print("</style>");
            }

            // dynamically generate css code for fhem devices
            $sql = "select devices.dev_id, devices.identifier, devices.name, pos_x, pos_y, device_types.imagesize, types.name typename from devices join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id where devices.floor_id > 0";
            $result = mysql_query($sql);

            while ($device = mysql_fetch_object($result)) {
                $tooltip_pos_x = $device->pos_x + 29;
                $tooltip_pos_y = $device->pos_y;

                if (strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPod')) {
                    // offset correction for iphones, why the iphone displays the icons with 10px offset in y-axis i dunno
                    $device->pos_y = $device->pos_y + 10;
                    $tooltip_pos_y = $device->pos_y;
                }

                print("<style type=\"text/css\">");

                print("#modal-background { display: none; position: fixed; left: 0px; top:0px; width:100%; height:100%; z-index: 500; background-color: rgba(0,0,0,0.4); }");
                print("#modal-device".$device->dev_id." { visibility: hidden; position: absolute; left: 0px; top:0px; margin-right: 100px; margin-right: 100px; width:100%; height:100%; z-index: 1000;  }");
                print("#modal-device".$device->dev_id." #closebutton { cursor: pointer; z-index: 1; width: 40px; height: 40px; background-image: url('./img/close.png'); margin: 0 auto; margin-top:-32px; margin-left: 495px; background-size: 90%; background-repeat: no-repeat; }");
                print("#modal-device".$device->dev_id." h1 { width: 460px; text-align: center; float: none; font-size: 12px; font-weight: bold; color: #bdb5aa; padding-bottom: 8px; border-bottom: 1px solid #EBE6E2; text-shadow: 0 2px 0 rgba(255,255,255,0.8); box-shadow: 0 1px 0 rgba(255,255,255,0.8); display: inline-block; text-transform: uppercase; color: #6c6763; padding-right: 20px; padding-left: 20px; }");

                print(".main_automation #device".$device->dev_id." { z-index: 1; position: absolute; top: ".$device->pos_y."px; left: ".$device->pos_x."px; margin: auto; -moz-user-select: -moz-none; -khtml-user-select: none; -webkit-user-select: none; -ms-user-select: none; user-select: none; cursor: pointer; width: 28px; height: 28px; background-size: ".$device->imagesize."; background-color: rgba(0,0,0,0.4); border-radius: 5px; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 0px rgba(255,255,255,0.4); }");
                print(".main_automation #device".$device->dev_id.":hover { background-color: rgba(30,30,30,0.6); box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 0px rgba(255,255,255,0.4); }");

                /* Ein/Aus-Schalter, Raspberry Pi GPIO*/
                if ($device->typename == "Ein/Aus-Schalter" || $device->typename == "Raspberry Pi GPIO") {
                    print("#modal-device".$device->dev_id." #section1 { width:500px; margin: 0 auto; background: #fffaf6; border-radius: 4px; color: #7e7975; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 12px rgba(255,255,255,0.4); padding: 10px; z-index: 1000; }");
                    print("#modal-device".$device->dev_id." #section1 #buttons1 { width: 500px; text-align: center; margin-bottom: 15px; }");
                    print("#modal-device".$device->dev_id." #section1 #poweronbutton { width: 120px; height: 45px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #c6ee42; background: -moz-linear-gradient(#c6ee42, #a8ca38); background: -ms-linear-gradient(#c6ee42, #a8ca38); background: -o-linear-gradient(#c6ee42, #a8ca38); background: -webkit-gradient(linear, 0 0, 0 100%, from(#c6ee42), to(#a8ca38)); background: -webkit-linear-gradient(#c6ee42, #a8ca38); background: linear-gradient(#c6ee42, #a8ca38); border: 1px solid #8daa2f; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); }");
                    print("#modal-device".$device->dev_id." #section1 #poweronbutton:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");
                    print("#modal-device".$device->dev_id." #section1 #poweroffbutton { width: 120px; height: 45px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #f49f46; background: -moz-linear-gradient(#f49f46, #f46c46); background: -ms-linear-gradient(#f49f46, #f46c46); background: -o-linear-gradient(#f49f46, #f46c46); background: -webkit-gradient(linear, 0 0, 0 100%, from(#f49f46), to(#f46c46)); background: -webkit-linear-gradient(#f49f46, #f46c46); background: linear-gradient(#f49f46, #f46c46); border: 1px solid #d74319; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); }");
                    print("#modal-device".$device->dev_id." #section1 #poweroffbutton:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");
                }

                /* Temperaturregelung */
                else if ($device->typename == "Temperaturregelung") {
                    print(".main_automation #device".$device->dev_id." #image { position: absolute; width: 28px; height: 28px; background-size: ".$device->imagesize."; float: left; }");

                    print("#modal-device".$device->dev_id." #section2 { width:500px; margin: 0 auto; background: #fffaf6; border-radius: 4px; color: #7e7975; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 12px rgba(255,255,255,0.4); padding: 10px; z-index: 1000; }");
                    print("#modal-device".$device->dev_id." #section2 #display2 { width: 380px; height: 150px; text-align: center; margin-bottom: 15px; margin-right: 25px; float: left; }");
                    print("#modal-device".$device->dev_id." #section2 #display2 #isttemplabel { font: 20px Verdana, 'Lucida Grande'; margin-top: 20px; margin-right: 17px; }");
                    print("#modal-device".$device->dev_id." #section2 #display2 #isttemp { font: 20px Verdana, 'Lucida Grande'; height: 45px; width: 70px; color: #7e7975; margin-top: 20px; border-color: #EBE6E2; border-width: 1px; border-style: solid; padding-left: 5px; padding-right: 5px; text-align: center; }");
                    print("#modal-device".$device->dev_id." #section2 #display2 #solltemplabelv { margin-left: -11px; font: 20px Verdana, 'Lucida Grande'; color: #494644; margin-top: 20px; margin-right: 10px; }");
                    print("#modal-device".$device->dev_id." #section2 #display2 #solltemplabelh { font: 20px Verdana, 'Lucida Grande'; color: #494644; margin-top: 20px; margin-right: 10px; }");
                    print("#modal-device".$device->dev_id." #section2 #display2 #solltemp {  font: 20px Verdana, 'Lucida Grande'; color: #494644; height: 45px; width: 70px; margin-top: 20px; border-color: #EBE6E2; border-width: 1px; border-style: solid; padding-left: 5px; padding-right: 5px; text-align: center; }");
                    print("#modal-device".$device->dev_id." #section2 #buttons2 { width: auto; text-align: center; margin-bottom: 15px; margin-right: 40px; }");
                    print("#modal-device".$device->dev_id." #section2 #buttons2 #tempup { width: 45px; height: 45px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #d77a19; background: -moz-linear-gradient(#d77a19, #d74319); background: -ms-linear-gradient(#d77a19, #d74319); background: -o-linear-gradient(#d77a19, #d74319); background: -webkit-gradient(linear, 0 0, 0 100%, from(#d77a19), to(#d74319)); background: -webkit-linear-gradient(#d77a19, #d74319); background: linear-gradient(#d77a19, #d74319); border: 1px solid #b52d06; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); float: none; }");
                    print("#modal-device".$device->dev_id." #section2 #buttons2 #tempup:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");
                    print("#modal-device".$device->dev_id." #section2 #buttons2 #tempup img { max-width: 20px; max-height: 20px; margin: auto; margin-top: 3px; }");
                    print("#modal-device".$device->dev_id." #section2 #buttons2 #tempdown { width: 45px; height: 45px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #3c90d1; background: -moz-linear-gradient(#3c90d1, #3c48d1); background: -ms-linear-gradient(#3c90d1, #3c48d1); background: -o-linear-gradient(#3c90d1, #3c48d1); background: -webkit-gradient(linear, 0 0, 0 100%, from(#3c90d1), to(#3c48d1)); background: -webkit-linear-gradient(#3c90d1, #3c48d1); background: linear-gradient(#3c90d1, #3c48d1); border: 1px solid #2d379d; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); }");
                    print("#modal-device".$device->dev_id." #section2 #buttons2 #tempdown:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");
                    print("#modal-device".$device->dev_id." #section2 #buttons2 #tempdown img { max-width: 20px; max-height: 20px; margin: auto; margin-top: 3px; }");

                    print("#tooltip-device".$device->dev_id." { opacity: 0; -webkit-transition: none; -moz-transition: none; -o-transition: none; transition: none; width: 180px; position: absolute; z-index: -1; visible; padding: 5px; top: ".$tooltip_pos_y."px; left: ".$tooltip_pos_x."px; margin: auto; color: #e5e4e3; font-weight: bold; -moz-user-select: -moz-none; -khtml-user-select: none; -webkit-user-select: none; -ms-user-select: none; user-select: none; cursor: default; background-color: rgba(30,30,30,0.6); border-bottom-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 0px rgba(255,255,255,0.4); }");
                    print(".main_automation #device".$device->dev_id.":hover { -webkit-transition: all 0.2s ease-in-out; -moz-transition: all 0.2s ease-in-out; -o-transition: all 0.2s ease-in-out; transition: all 0.2s ease-in-out; border-bottom-right-radius: 0px; border-top-right-radius: 0px; }");
                    print(".main_automation #device".$device->dev_id.":hover + #tooltip-device".$device->dev_id." { z-index: 100; opacity: 1; -webkit-transition: all 0.3s ease-in-out; -moz-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; transition: all 0.3s ease-in-out; }");
                }

                /* Jalousie */
                else if ($device->typename == "Jalousie") {
                    print("#modal-device".$device->dev_id." #section3 { width:500px; margin: 0 auto; background: #fffaf6; border-radius: 4px; color: #7e7975; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 12px rgba(255,255,255,0.4); padding: 10px; z-index: 1000; }");
                    print("#modal-device".$device->dev_id." #section3 #display3 { width: 380px; height: 150px; text-align: center; margin-bottom: 15px; margin-left: 15px; margin-right: 15px; float: left; }");
                    print("#modal-device".$device->dev_id." #section3 #display3 #jalousielabel {  font: 20px Verdana, 'Lucida Grande'; margin-top: 50px; margin-right: 17px; }");
                    print("#modal-device".$device->dev_id." #section3 #display3 #jalousievalue { margin-left: -10px; font: 20px Verdana, 'Lucida Grande'; margin-top: 50px; height: 45px; width: 54px; border-color: #EBE6E2; border-width: 1px; border-style: solid; padding-left: 5px; padding-right: 5px; text-align: center; }");
                    print("#modal-device".$device->dev_id." #section3 #buttons3 { width: auto; text-align: center; margin-bottom: 15px; margin-right: 40px; }");
                    print("#modal-device".$device->dev_id." #section3 #buttons3 #buttonup { width: 45px; height: 45px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #fbd568; background: -moz-linear-gradient(#fbd568, #ffb347); background: -ms-linear-gradient(#fbd568, #ffb347); background: -o-linear-gradient(#fbd568, #ffb347); background: -webkit-gradient(linear, 0 0, 0 100%, from(#fbd568), to(#ffb347)); background: -webkit-linear-gradient(#fbd568, #ffb347); background: linear-gradient(#fbd568, #ffb347); border: 1px solid #f4ab4c; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); float: none; }");
                    print("#modal-device".$device->dev_id." #section3 #buttons3 #buttonup:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");
                    print("#modal-device".$device->dev_id." #section3 #buttons3 #buttonup img { max-width: 20px; max-height: 20px; margin: auto; margin-top: 3px; }");
                    print("#modal-device".$device->dev_id." #section3 #buttons3 #buttondown { width: 45px; height: 45px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #fbd568; background: -moz-linear-gradient(#fbd568, #ffb347); background: -ms-linear-gradient(#fbd568, #ffb347); background: -o-linear-gradient(#fbd568, #ffb347); background: -webkit-gradient(linear, 0 0, 0 100%, from(#fbd568), to(#ffb347)); background: -webkit-linear-gradient(#fbd568, #ffb347); background: linear-gradient(#fbd568, #ffb347); border: 1px solid #f4ab4c; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); }");
                    print("#modal-device".$device->dev_id." #section3 #buttons3 #buttondown:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");
                    print("#modal-device".$device->dev_id." #section3 #buttons3 #buttondown img { max-width: 20px; max-height: 20px; margin: auto; margin-top: 3px; }");

                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons { position: relative; height: 200px; width: auto; text-align: center; margin-bottom: 15px; }");
                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons #left { position: relative; height: auto; float: left; width: 250px; z-index: 10; }");
                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons #right { position: relative; height: auto; width: auto; }");
                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons #buttonpreset.disabled { width: 200px; height: 45px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #a8a4a0; background: -moz-linear-gradient(#86817e, #a8a4a0); background: -ms-linear-gradient(#c8c6c4, #a8a4a0); background: -o-linear-gradient(#c8c6c4, #a8a4a0); background: -webkit-gradient(linear, 0 0, 0 100%, from(#c8c6c4), to(#a8a4a0)); background: -webkit-linear-gradient(#c8c6c4, #a8a4a0); background: linear-gradient(#c8c6c4, #a8a4a0); border: 1px solid #97938f; color: #413d3b; text-shadow: 0 1px rgba(255,255,255,0.3); }");
                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons #left #buttonpreset_red { width: 200px; height: 45px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #d77a19; background: -moz-linear-gradient(#d77a19, #d74319); background: -ms-linear-gradient(#d77a19, #d74319); background: -o-linear-gradient(#d77a19, #d74319); background: -webkit-gradient(linear, 0 0, 0 100%, from(#d77a19), to(#d74319)); background: -webkit-linear-gradient(#d77a19, #d74319); background: linear-gradient(#d77a19, #d74319); border: 1px solid #b52d06; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); }");
                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons #right #buttonpreset_red { width: 200px; height: 45px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #d77a19; background: -moz-linear-gradient(#d77a19, #d74319); background: -ms-linear-gradient(#d77a19, #d74319); background: -o-linear-gradient(#d77a19, #d74319); background: -webkit-gradient(linear, 0 0, 0 100%, from(#d77a19), to(#d74319)); background: -webkit-linear-gradient(#d77a19, #d74319); background: linear-gradient(#d77a19, #d74319); border: 1px solid #b52d06; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); }");
                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons #left #buttonpreset_red:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");
                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons #right #buttonpreset_red:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");
                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons #left #buttonpreset { width: 200px; height: 45px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #8f8a86; background: -moz-linear-gradient(#6c6865, #8f8a86); background: -ms-linear-gradient(#b0aca9, #8f8a86); background: -o-linear-gradient(#b0aca9, #8f8a86); background: -webkit-gradient(linear, 0 0, 0 100%, from(#b0aca9), to(#8f8a86)); background: -webkit-linear-gradient(#b0aca9, #8f8a86); background: linear-gradient(#b0aca9, #8f8a86); border: 1px solid #7e7975; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); }");
                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons #right #buttonpreset { width: 200px; height: 45px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #fbd568; background: -moz-linear-gradient(#fbd568, #ffb347); background: -ms-linear-gradient(#fbd568, #ffb347); background: -o-linear-gradient(#fbd568, #ffb347); background: -webkit-gradient(linear, 0 0, 0 100%, from(#fbd568), to(#ffb347)); background: -webkit-linear-gradient(#fbd568, #ffb347); background: linear-gradient(#fbd568, #ffb347); border: 1px solid #f4ab4c; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); }");
                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons #left #buttonpreset:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");
                    print("#modal-device".$device->dev_id." #section3 #aktionbuttons #right #buttonpreset:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");

                    print("#tooltip-device".$device->dev_id." { opacity: 0; -webkit-transition: none; -moz-transition: none; -o-transition: none; transition: none; width: 140px; min-height: 18px; position: absolute; z-index: -1; visible; padding: 5px; top: ".$tooltip_pos_y."px; left: ".$tooltip_pos_x."px; margin: auto; color: #e5e4e3; font-weight: bold; -moz-user-select: -moz-none; -khtml-user-select: none; -webkit-user-select: none; -ms-user-select: none; user-select: none; cursor: default; background-color: rgba(30,30,30,0.6); border-top-right-radius: 5px; border-bottom-right-radius: 5px; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 0px rgba(255,255,255,0.4); }");
                    print(".main_automation #device".$device->dev_id.":hover { -webkit-transition: all 0.2s ease-in-out; -moz-transition: all 0.2s ease-in-out; -o-transition: all 0.2s ease-in-out; transition: all 0.2s ease-in-out; border-bottom-right-radius: 0px; border-top-right-radius: 0px; }");
                    print(".main_automation #device".$device->dev_id.":hover + #tooltip-device".$device->dev_id." { z-index: 100; opacity: 1; -webkit-transition: all 0.3s ease-in-out; -moz-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; transition: all 0.3s ease-in-out; }");
                }

                /* Wertanzeige */
                else if ($device->typename == "Wertanzeige") {
                    print(".main_automation #device".$device->dev_id." #image { position: absolute; width: 28px; height: 28px; background-size: ".$device->imagesize."; float: left; }");
                    print(".main_automation #device".$device->dev_id." #value { position: absolute; width: auto; height: 28px; margin-left: 25px; line-height: 28px; vertical-align: mid; color: #e5e4e3; font-weight: bold; }");
                }

                /* Dimmer */
                else if ($device->typename == "Dimmer") {
                    print("#modal-device".$device->dev_id." #section1 { width:500px; margin: 0 auto; background: #fffaf6; border-radius: 4px; color: #7e7975; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 12px rgba(255,255,255,0.4); padding: 10px; z-index: 1000; }");
                    print("#modal-device".$device->dev_id." #section1 #slider { width: 500px; margin-bottom: 15px; font: 20px Verdana, 'Lucida Grande'; color: #494644; }");
                    print("#modal-device".$device->dev_id." #section1 #slider input[type='range'] { margin-left: 50px; margin-top: 40px; width: 280px; -webkit-appearance: none !important; -webkit-border-radius: 5px; -webkit-box-shadow: inset 0 0 5px #333; background-color: #999; display: block; height: 6px; float: left; }");
                    print("#modal-device".$device->dev_id." #section1 #slider input[type='range']::-webkit-slider-thumb { -webkit-appearance: none !important; -webkit-border-radius: 10px; background-color: #AAA; background-image: -webkit-gradient(linear, left top, left bottom, from(#EEE), to(#AAA)); border: 1px solid #999; height: 20px; width: 20px; }");
                    print("#modal-device".$device->dev_id." #section1 #slider input[type='text'] { font: 20px Verdana, 'Lucida Grande'; color: #494644; height: 45px; width: 70px; margin-top: 20px; margin-left: 20px; border-color: #EBE6E2; border-width: 1px; border-style: solid; padding-left: 5px; padding-right: 5px; text-align: center; }");
                }

                /* Dimmer */
                else if ($device->typename == "Philips Hue") {
                    print("#modal-device".$device->dev_id." #section1 { width:500px; margin: 0 auto; background: #fffaf6; border-radius: 4px; color: #7e7975; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 12px rgba(255,255,255,0.4); padding: 10px; z-index: 1000; }");
                    print("#modal-device".$device->dev_id." #section1 #slider { width: 400px; margin-bottom: 15px; font: 20px Verdana, 'Lucida Grande'; color: #494644; float: left; }");
                    print("#modal-device".$device->dev_id." #section1 #slider input[type='range'] { margin-left: 50px; margin-top: 40px; width: 200px; -webkit-appearance: none !important; -webkit-border-radius: 5px; -webkit-box-shadow: inset 0 0 5px #333; background-color: #999; display: block; height: 6px; float: left; }");
                    print("#modal-device".$device->dev_id." #section1 #slider input[type='range']::-webkit-slider-thumb { -webkit-appearance: none !important; -webkit-border-radius: 10px; background-color: #AAA; background-image: -webkit-gradient(linear, left top, left bottom, from(#EEE), to(#AAA)); border: 1px solid #999; height: 20px; width: 20px; }");
                    print("#modal-device".$device->dev_id." #section1 #slider input[type='text'] { font: 20px Verdana, 'Lucida Grande'; color: #494644; height: 45px; width: 70px; margin-top: 20px; margin-left: 20px; border-color: #EBE6E2; border-width: 1px; border-style: solid; padding-left: 5px; padding-right: 5px; text-align: center;}");
                    print("#modal-device".$device->dev_id." #section1 #color_picker".$device->dev_id." { width: 45px; height: 45px; margin-top: 39px; }");
                }

                /* Webcam */
                else if ($device->typename == "Webcam") {
                    print("#modal-device".$device->dev_id." #section0 { width:500px; margin: 0 auto; background: #fffaf6; border-radius: 4px; color: #7e7975; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 12px rgba(255,255,255,0.4); padding: 10px; z-index: 1000; }");
                    print("#modal-device".$device->dev_id." #section0 div[id*=stream] { width:460px; height: 345px; margin-left: auto; margin-right: auto; margin-top: 25px; margin-bottom: 20px; background-color: #fff; background-repeat: no-repeat; background-position: center; background-size: 98% auto; border: 1px solid #EBE6E2;  text-shadow: 0 2px 0 rgba(255,255,255,0.8); box-shadow: 0 1px 0 rgba(255,255,255,0.8); }");
                    print("#modal-device".$device->dev_id." #section0 div[id*=stream] img { width:450px; height: 335px; margin-left: 5px; margin-top: 5px; background-image: url('/img/testimage.gif'); background-repeat: no-repeat; background-size: 100% auto; background-position: center;}");

                    print("#modal-device".$device->dev_id." #section0 #controlpad { width: auto; text-align: center; margin-top: -25px; }");
                    print("#modal-device".$device->dev_id." #section0 #controlpad #controlbutton { width: 45px; height: 45px; margin-right: 15px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 28px; text-align: center; font-weight: bold; margin-top:20px; margin-left: 1%; background: #8f8a86; background: -moz-linear-gradient(#6c6865, #8f8a86); background: -ms-linear-gradient(#b0aca9, #8f8a86); background: -o-linear-gradient(#b0aca9, #8f8a86); background: -webkit-gradient(linear, 0 0, 0 100%, from(#b0aca9), to(#8f8a86)); background: -webkit-linear-gradient(#b0aca9, #8f8a86); background: linear-gradient(#b0aca9, #8f8a86); border: 1px solid #7e7975; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); }");
                    print("#modal-device".$device->dev_id." #section0 #controlpad #controlbutton:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");
                    print("#modal-device".$device->dev_id." #section0 #controlpad #controlbutton img { max-width: 20px; max-height: 20px; margin: auto; margin-top: 3px; }");

                    print("#modal-device".$device->dev_id." #section0 #controlpad select { width: auto; font: 13px Verdana, 'Lucida Grande'; height: 23px; border-color: #EBE6E2; border-width: 1px; border-style: solid; padding-left: 5px; padding-right: 5px; }");
                } else {
                    print("#modal-device".$device->dev_id." #section0 { width:500px; margin: 0 auto; background: #fffaf6; border-radius: 4px; color: #7e7975; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 12px rgba(255,255,255,0.4); padding: 10px; z-index: 1000; }");

                    print("#tooltip-device".$device->dev_id." { opacity: 0; -webkit-transition: none; -moz-transition: none; -o-transition: none; transition: none; width: 140px; min-height: 18px; position: absolute; z-index: -1; visible; padding: 5px; top: ".$tooltip_pos_y."px; left: ".$tooltip_pos_x."px; margin: auto; color: #e5e4e3; font-weight: bold; -moz-user-select: -moz-none; -khtml-user-select: none; -webkit-user-select: none; -ms-user-select: none; user-select: none; cursor: default; background-color: rgba(30,30,30,0.6); border-top-right-radius: 5px; border-bottom-right-radius: 5px; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 0px rgba(255,255,255,0.4); }");
                    print(".main_automation #device".$device->dev_id.":hover { -webkit-transition: all 0.2s ease-in-out; -moz-transition: all 0.2s ease-in-out; -o-transition: all 0.2s ease-in-out; transition: all 0.2s ease-in-out; border-bottom-right-radius: 0px; border-top-right-radius: 0px; }");
                    print(".main_automation #device".$device->dev_id.":hover + #tooltip-device".$device->dev_id." { z-index: 100; opacity: 1; -webkit-transition: all 0.3s ease-in-out; -moz-transition: all 0.3s ease-in-out; -o-transition: all 0.3s ease-in-out; transition: all 0.3s ease-in-out; }");
                }

                print("</style>\n");
            }
        ?>

        <?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

        <link rel="apple-touch-icon" href="./img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Haussteuerung</title>
    </head>
<body>
    <div id="modal-background">&nbsp;</div>

    <?php
        // dynamically write modal divs for all devices
        $sql = "select rooms.name roomname, devices.dev_id, devices.identifier d_identifier, devices.name name, device_floors.name floorname, types.name typename from devices join device_floors on device_floors.floor_id = devices.floor_id join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id left outer join rooms on rooms.room_id = devices.room_id where devices.floor_id > 0";
        $result = mysql_query($sql);

        while ($device = mysql_fetch_object($result)) {
            if ($device->typename == "Ein/Aus-Schalter" || $device->typename == "Raspberry Pi GPIO") {
                print("<div id=\"modal-device".$device->dev_id."\" class=\"draggable\">");
                    print("<div id=\"section1\">");
                        print("<div id=\"closebutton\" onclick='javascript:toggleModal(" . $device->dev_id . ",\"" . $device->typename . "\");'></div>");
                        print("<h1><span>".$device->roomname." ".$device->name."</span></h1>");
                        print("<div id=\"buttons1\">");
                            print("<button id=\"poweronbutton\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"on\");'>Einschalten</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
                            print("<button id=\"poweroffbutton\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"off\");'>Ausschalten</button>");
                        print("</div>");
                    print("</div>");
                    if ($device->typename == "Raspberry Pi GPIO") {
                        $configResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'gpio_raspi_protocol' and dev_id = " . $device->dev_id));
                        print("<input type=\"hidden\" id=\"gpio_raspi_protocol".$device->dev_id."\" value=\"".$configResult['value']."\">");
                        $configResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'gpio_raspi_address' and dev_id = " . $device->dev_id));
                        print("<input type=\"hidden\" id=\"gpio_raspi_address".$device->dev_id."\" value=\"".$configResult['value']."\">");
                        $configResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'gpio_outputpin' and dev_id = " . $device->dev_id));
                        print("<input type=\"hidden\" id=\"gpio_outputpin".$device->dev_id."\" value=\"".$configResult['value']."\">");
                    }
                print("</div>");
            } elseif ($device->typename == "Temperaturregelung") {
                print("<div id=\"modal-device".$device->dev_id."\" class=\"draggable\">");
                    print("<div id=\"section2\">");
                        print("<div id=\"closebutton\" onclick='javascript:toggleModal(" . $device->dev_id . ",\"" . $device->typename . "\");'></div>");
                        print("<h1><span>".$device->roomname." ".$device->name."</span></h1>");
                        print("<div id=\"display2\">");
                            print("<label id=\"solltemplabelv\">Soll Temperatur:</label><input id=\"solltemp\" name=\"solltemp".$device->dev_id."\" readonly value=\"---\">&nbsp;<label id=\"solltemplabelh\">°C</label><br>");
                            print("<label id=\"isttemplabel\">Ist Temperatur:</label><input id=\"isttemp\" name=\"isttemp".$device->dev_id."\" readonly value=\"---\"\">&nbsp;<label id=\"isttemplabel\">°C</label>");
                        print("</div>");
                        print("<div id=\"buttons2\">");
                            print("<button id=\"tempup\" name=\"tempup\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"up\");'><img src=\"./img/plus.png\"></button>");
                            print("<button id=\"tempdown\" name=\"tempdown\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"down\");'><img src=\"./img/minus.png\"></button>");
                        print("</div>");
                    print("</div>");
                print("</div>");
            } elseif ($device->typename == "Jalousie") {
                print("<div id=\"modal-device".$device->dev_id."\" class=\"draggable\">");
                    print("<div id=\"section3\">");
                        print("<div id=\"closebutton\" onclick='javascript:toggleModal(" . $device->dev_id . ",\"" . $device->typename . "\");'></div>");
                        print("<h1><span>".$device->roomname." ".$device->name."</span></h1>");
                        print("<div id=\"display3\">");
                            print("<label id=\"jalousielabel\">Jalousie ist zu</label><input id=\"jalousiecurvalue\" name=\"jalousiecurvalue".$device->dev_id."\" hidden><input id=\"jalousievalue\" name=\"jalousievalue".$device->dev_id."\" readonly value=\"---\">&nbsp;<label id=\"jalousielabel\">% geöffnet</label>");
                        print("</div>");
                        print("<div id=\"buttons3\">");
                            print("<button id=\"buttonup\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"up\");'><img src=\"./img/up.png\"></button>");
                            print("<button id=\"buttondown\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"down\");'><img src=\"./img/down.png\"></button>");
                        print("</div>");
                    print("<h1><span>Aktionen</span></h1>");
                        print("<div id=\"aktionbuttons\">");
                            print("<div id=\"left\">");
                                print("<button id=\"buttonpreset\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"84\");'>zu 3/4 offen</button>");
                                print("<button id=\"buttonpreset\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"68\");'>zu 1/2 offen</button>");
                                print("<button id=\"buttonpreset\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"52\");'>zu 1/4 offen</button>");
                            print("</div>");
                            print("<div id=\"right\">");
                                print("<button id=\"buttonpreset_red\" name=\"stopbutton\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"stop\");'>STOP!</button>");
                                print("<button id=\"buttonpreset\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"on\");'>Jalousie komplett öffnen</button>");
                                print("<button id=\"buttonpreset\" onclick='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",\"off\");'>Jalousie komplett schließen</button>");
                            print("</div>");
                        print("</div>");
                    print("</div>");
                print("</div>");
            } elseif ($device->typename == "Webcam") {
                print("<div id=\"modal-device".$device->dev_id."\" class=\"draggable\">");
                    print("<div id=\"section0\">");
                        print("<div id=\"closebutton\" onclick='javascript:toggleModal(" . $device->dev_id . ",\"" . $device->typename . "\");'></div>");
                        print("<h1><span>".$device->roomname." ".$device->name."</span></h1>");
                        $cam_vendor = "";

                        $sql = "SELECT value from configuration where configstring = 'vendor' and dev_id = " . $device->dev_id;
                        $result2 = mysql_query($sql);
                        $resultArr = mysql_fetch_assoc($result2);
                        $cam_vendor = $resultArr['value'];

                        if ($cam_vendor == "instar") {
                            $cam_ipaddress = "";
                            $cam_port = "80";
                            $cam_username = "admin";
                            $cam_password = "";

                            $sql = "SELECT value from configuration where configstring = 'ipaddress' and dev_id = " . $device->dev_id;
                            $result2 = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($result2);
                            $cam_ipaddress = $resultArr['value'];

                            $sql = "SELECT value from configuration where configstring = 'port' and dev_id = " . $device->dev_id;
                            $result2 = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($result2);
                            $cam_port = $resultArr['value'];

                            $sql = "SELECT value from configuration where configstring = 'username' and dev_id = " . $device->dev_id;
                            $result2 = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($result2);
                            $cam_username = $resultArr['value'];

                            $sql = "SELECT value from configuration where configstring = 'password' and dev_id = " . $device->dev_id;
                            $result2 = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($result2);
                            $cam_password = $resultArr['value'];

                            $sql = "SELECT value from configuration where configstring = 'invertcontrols' and dev_id = " . $device->dev_id;
                            $result2 = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($result2);
                            $invertcontrols = $resultArr['value'];

                            $sql = "SELECT value from configuration where configstring = 'positionslots' and dev_id = " . $device->dev_id;
                            $result2 = mysql_query($sql);
                            $resultArr = mysql_fetch_assoc($result2);
                            $positionslots = $resultArr['value'];

                            print("<div id=\"stream".$device->dev_id."\"><img id=\"webcamstream_img".$device->dev_id."\" src='/img/blank.png'></div>");
                            if ($positionslots > 0) {
                                print("<br><div id=\"controlpad\">");
                                    print("Gehe zu: <select id=\"position".$device->dev_id."\" onchange=\"javascript:moveCameraPosition(this.value, '".$cam_ipaddress."', '".$cam_port."', '".$cam_username."', '".$cam_password."', '".$cam_vendor."', ".$device->dev_id.")\">");
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
            } elseif ($device->typename == "Dimmer") {
                print("<div id=\"modal-device".$device->dev_id."\" class=\"draggable\">");
                    print("<div id=\"section1\">");
                        print("<div id=\"closebutton\" onclick='javascript:toggleModal(" . $device->dev_id . ",\"" . $device->typename . "\");'></div>");
                        print("<h1><span>".$device->roomname." ".$device->name."</span></h1>");
                        print("<div id=\"slider\">");
                            print("<input type=\"range\" id=\"slider".$device->dev_id."\" min=\"0\" max=\"100\" step=\"5\" onchange='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",this.value);'>");
                            print("<input type=\"text\" id=\"slider_value".$device->dev_id."\" readonly value=\"---\">&nbsp;%");
                        print("</div>");
                    print("</div>");
                print("</div>");
            } elseif ($device->typename == "Philips Hue") {
                print("<div id=\"modal-device".$device->dev_id."\">");
                    print("<div id=\"section1\">");
                        print("<div id=\"closebutton\" onclick='javascript:toggleModal(" . $device->dev_id . ",\"" . $device->typename . "\");'></div>");
                        print("<h1><span>".$device->roomname." ".$device->name."</span></h1>");
                        print("<div id=\"slider\">");
                            print("<input type=\"range\" id=\"slider".$device->dev_id."\" min=\"0\" max=\"100\" step=\"5\" onchange='javascript:toggleDevice(\"".$device->dev_id."\",\"".$device->d_identifier."\",\"".$device->typename."\",this.value);'>");
                            print("<input type=\"text\" id=\"slider_value".$device->dev_id."\" readonly value=\"---\">&nbsp;%");
                        print("</div>");
                        print("<div><input type=\"text\" id=\"color_picker".$device->dev_id."\" style=\"width:0px; height: 0px;\"></div>");
                        print("<div id=\"clear\"></div>");
                    print("</div>");
                print("</div>");
            } else {
                print("<div id=\"modal-device".$device->dev_id."\" class=\"draggable\">");
                    print("<div id=\"section0\">");
                        print("<div id=\"closebutton\" onclick='javascript:toggleModal(" . $device->dev_id . ",\"" . $device->typename . "\");'></div>");
                        print("<h1><span>".$device->roomname." ".$device->name."</span></h1>");
                    print("</div>");
                print("</div>");
            }
        }
    ?>

    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <?php
    $sql = "select * from device_floors where position > 0 order by position asc";
    $result = mysql_query($sql);
    $firstloop = true;
    while ($floor = mysql_fetch_object($result)) {
        // floor
        print("<section class=\"main_automation\">");
        print("<h1><span>".$floor->name."</span></h1>");
        print("<div id=\"floor".$floor->floor_id."\"></div>");

        $sql2 = "select devices.dev_id, device_types.dtype_id, devices.isStructure, devices.isHidden, devices.identifier d_identifier, devices.name name, device_floors.name floorname, types.name typename from devices join device_floors on device_floors.floor_id = devices.floor_id join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id";
        $sql2 .= " where devices.floor_id = ".$floor->floor_id;
        $result2 = mysql_query($sql2);
        while ($device = mysql_fetch_object($result2)) {
            // device
            if ($device->isStructure == "on") {
                if($device->isHidden == "on")
                    continue;

                if ($firstloop) {
                    print("<div id=\"line\"></div>");
                    $firstloop = false;
                }

                print("<button id=\"structurebutton\" onclick='javascript:toggleModal(" . $device->dev_id . ",\"" . $device->typename . "\");'>".$device->name."</button>");
            } else {
                if($device->isHidden == "on")
                    continue;

                if ($device->typename == "Temperaturregelung") {
                    print("<div onclick='javascript:toggleModal(" . $device->dev_id . ",\"" . $device->typename . "\");' id=\"device".$device->dev_id."\" class=\"type".$device->dtype_id."\"></div>");

                    print("<div id=\"tooltip-device".$device->dev_id."\">");
                        print("<div name=\"tooltip-value1".$device->dev_id."\">Ist Temperatur: --- °C</div>");
                        print("<div name=\"tooltip-value2".$device->dev_id."\">Soll Temperatur: --- °C</div>");
                        print("<div name=\"tooltip-value3".$device->dev_id."\">rel. Luftfeuchte: --- %</div>");
                        print("<div name=\"tooltip-value4".$device->dev_id."\">Betriebsmodus: ---</div>");
                        print("<div name=\"tooltip-value5".$device->dev_id."\">Batterie Status: ---</div>");
                    print("</div>");
                } elseif ($device->typename == "Jalousie") {
                    print("<div onclick='javascript:toggleModal(" . $device->dev_id . ",\"" . $device->typename . "\");' id=\"device".$device->dev_id."\" class=\"type".$device->dtype_id."\"></div>");

                    print("<div id=\"tooltip-device".$device->dev_id."\">");
                        print("<div name=\"tooltip-value1".$device->dev_id."\">---% geöffnet</div>");
                    print("</div>");
                } elseif ($device->typename == "Tür/Fenster-Kontakt") {
                    print("<div id=\"device".$device->dev_id."\" class=\"type".$device->dtype_id."\"></div>");

                    print("<div id=\"tooltip-device".$device->dev_id."\">");
                        print("<div name=\"tooltip-value1".$device->dev_id."\">Zustand: ---</div>");
                        print("<div name=\"tooltip-value2".$device->dev_id."\">Batterie Status: ---</div>");
                    print("</div>");
                } else if($device->typename == "Wertanzeige")
                    print("<div id=\"device".$device->dev_id."\"><div class=\"type".$device->dtype_id."\" id=\"image\"></div><div id=\"value\" name=\"temp_value_floorplan".$device->dev_id."\">---</div></div>");
                else if($device->typename == "Brandmelder")
                    print("<div id=\"device".$device->dev_id."\" class=\"type".$device->dtype_id."\"></div>");
                else
                    print("<div onclick='javascript:toggleModal(" . $device->dev_id . ",\"" . $device->typename . "\");' id=\"device".$device->dev_id."\" class=\"type".$device->dtype_id."\"></div>");
            }
        }
        print("<div id=\"clear\"></div>");
        print("</section>");
    }
    ?>
</body>
</html>
