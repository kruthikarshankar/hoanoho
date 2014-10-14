<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';
    include dirname(__FILE__).'/../tablet/includes/device_optimizer.php';

    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

    if (!isset($_GET['room'])) {
        exit;
    }

    $sql = "select name from rooms where room_id = ".$_GET['room'];
    $return = mysql_fetch_object(mysql_query($sql));
    $roomname = $return->name;
?>

<html>
    <head>
        <meta charset="UTF-8" />

        <title><?php echo $__CONFIG['main_sitetitle']; ?></title>

        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="shortcut icon" href="../img/favicons/favicon.ico">
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
        <link rel="stylesheet" href="./css/flip.css" type="text/css" media="screen" title="no title" charset="UTF-8">

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

                connectWebSocket(<?php echo "\"".$__CONFIG['main_socketaddress']."\""; ?>);
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

            var disableValueRefreshForDeviceID = null;
            var devicesWithLowBattery = [];
            function connectWebSocket(address)
            {
                // Connect to Socketserver
                var socket = new WebSocket(address);
                socket.binaryType = 'arraybuffer';

                var last_weatherwarning = null;

                socket.onopen = function () {
                    if($('#titlebar #left #status').attr('class') == "disconnected")
                        $('#titlebar #left #status').switchClass("disconnected", "connected", 500, "easeInOutQuad");
                };

                socket.onclose = function () {
                    if($('#titlebar #left #status').attr('class') == "connected")
                        $('#titlebar #left #status').switchClass("connected", "disconnected", 500, "easeInOutQuad");

                    //try to reconnect to socketserver in 5 seconds
                    setTimeout(function () {connectWebSocket(address)}, 5000);
                };

                socket.onmessage = function (message) {
                    if($('#titlebar #left #status').attr('class') == "disconnected")
                        $('#titlebar #left #status').switchClass("disconnected", "connected", 500, "easeInOutQuad");

                    var messageObj = JSON.parse(message['data']);

                    // disable refresh when some value is being changed
                    if(disableValueRefreshForDeviceID != null && disableValueRefreshForDeviceID == messageObj['dev_id'])

                        return false;

                    var el_value = document.getElementById("value_" + messageObj['dev_id']);

                    if (el_value != null) {
                        if (messageObj['typename'] == "Ein/Aus-Schalter" || messageObj['typename'] == "Raspberry Pi GPIO") {
                            switch (messageObj['reading']) {
                                case 'state':
                                    if (messageObj['value'] == "on" || messageObj['value'] == "1") {
                                        css_class = "toggle active";
                                    } else if (messageObj['value'] == "off" || messageObj['value'] == "0") {
                                        css_class = "toggle";
                                    } else {
                                        css_class = "toggle";
                                    }

                                    el_value.className = css_class;
                                    // workaround: toggle will not move if it was clicked before websocket event comes in
                                    el_value.innerHTML = "<div class=\"toggle-handle\"></div>";
                                    break;
                            }
                        } else if (messageObj['typename'] == "Temperaturregelung") {
                            var postfix = ' \xB0C';

                            switch (messageObj['reading']) {
                                case 'desired-temp': // set temperature
                                    if(messageObj['value'] == "off")
                                        postfix = '';

                                    el_value.value = messageObj['value']+postfix;
                                    $('#desired-temp'+messageObj['dev_id']).text(messageObj['value']+postfix);
                                    break;
                                case 'measured-temp': // current temperature
                                    $('#measured-temp'+messageObj['dev_id']).text(messageObj['value']+postfix);
                                    break;
                                case 'battery': // battery status
                                    $('#battery'+messageObj['dev_id']).text(messageObj['value']);
                                    break;
                                case 'humidity': // current humidity
                                    $('#humidity'+messageObj['dev_id']).text(messageObj['value']+'%');
                                    break;
                                case 'controlMode': // current humidity
                                    $('#controlMode'+messageObj['dev_id']).text(messageObj['value']);
                                    break;
                                default:
                                    break;
                            }
                        } else if (messageObj['typename'] == "Tür/Fenster-Kontakt") {
                            switch (messageObj['reading']) {
                                case 'state':
                                    var translated_value = "";
                                    if (messageObj['value'] == 'open') {
                                        $('#value_'+messageObj['dev_id']).removeClass('green').addClass('red');
                                        translated_value = "Offen";
                                    } else {
                                        $('#value_'+messageObj['dev_id']).removeClass('red').addClass('green');
                                        translated_value = "Geschlossen";
                                    }

                                    $('#state'+messageObj['dev_id']).text(translated_value);
                                    break;
                                case 'battery':
                                    $('#battery'+messageObj['dev_id']).text(messageObj['value']);
                                    break;
                            }
                        } else if (messageObj['typename'] == "Jalousie") {
                            switch (messageObj['reading']) {
                                case 'pct': // set blinds
                                    var postfix = '';
                                    var value = messageObj['value'];

                                    if (value != "off" && value != "on" && value != "stop") {
                                        postfix = '%';
                                        value = parseInt(value);
                                    }

                                    $('#value_'+messageObj['dev_id']).val(value+postfix);
                                    $('#value_cur_'+messageObj['dev_id']).val(value);
                                    //$('div[name=tooltip-value1'+messageObj['dev_id']+']').html(value+postfix);
                                    break;
                                case 'motor': // motor movement
                                    if (messageObj['value'].indexOf('stop:') > -1) {
                                        // unlock controls
                                        $('#controls', '#flipcontainer'+messageObj['dev_id']).find(':button').prop('disabled', false);
                                    } else {
                                        // lock controls excluding stop button
                                        $('#controls', '#flipcontainer'+messageObj['dev_id']).find(':button').prop('disabled', true);
                                        //$('#modal-device'+messageObj['dev_id']).find('button[name=stopbutton]').prop('disabled', false);

                                        var movement = ""
                                        if(messageObj['value'].indexOf('up:') > -1)
                                            movement = "hoch";
                                        if(messageObj['value'].indexOf('down:') > -1)
                                            movement = "runter";

                                        //$('div[name=tooltip-value1'+messageObj['dev_id']+']').html('Fährt '+movement+' ...');
                                    }

                                    break;
                                default:
                                    break;
                            }
                        } else {
                            el_value.value = messageObj['value'];
                        }
                    }

                    if (messageObj['typename'] == "dwd_warning") {
                        var element = $('#griditem #boxitem.alarm.weather');
                        var message = messageObj['value'];

                        if ($('#boxitem.alarm.weather','#griditem').length == 0 && message.length > 0) {
                            last_weatherwarning = message;

                            if (message.length > 180) {
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
                        } else if ($('#boxitem.alarm.weather','#griditem').length > 0 && message.length > 0 && message != last_weatherwarning) {
                            last_weatherwarning = message;

                            // refresh warning box
                            if (message.length > 180) {
                                // cut message
                                message = message.substring(0, 180)+" [...]";
                            }

                            $('#boxitem.alarm.weather #rows #message','#griditem').html(message);

                            console.log('refresh');
                        } else if ($('#boxitem.alarm.weather','#griditem').length > 0 && message.length == 0) {
                            // delete warning box
                            $('#boxitem.alarm.weather','#griditem').parent().parent().parent().parent().remove();
                            last_weatherwarning = null;
                        }
                    } else if (messageObj['typename'] == "garbage") {
                        var element = $('#griditem #boxitem.info.garbage');
                        var garbageid = messageObj['value']['id'];
                        var message = messageObj['value']['text'];

                        message2 = "Am "+messageObj['value']['pickupdate']+" wird "+message+" abgeholt!";

                        if ($('#boxitem.info.garbage','#griditem').length == 0 && message.length > 0) {
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
                        } else if ($('#boxitem.info.garbage','#griditem').length != 0 && message.length > 0) {
                            // append message
                            if ($('#boxitem.info.garbage #message_'+garbageid,'#griditem').length == 0) {
                                $('#boxitem.info.garbage #rows','#griditem').append('<div id="message_'+garbageid+'">'+message2+'</div>');
                            }
                        } else {
                            // delete warning box
                            $('#boxitem.info.garbage','#griditem').parent().parent().parent().parent().remove();
                        }
                    }
                };
            }

            var timeout = null;
            function toggleDevice(device_id, d_identifier, type, value)
            {
                var cmdurl = "../includes/fhem.php?cmd=set&device="+d_identifier+"&value=";

                var mygetrequest = new ajaxRequest();
                mygetrequest.onreadystatechange=function () {
                    if (mygetrequest.readyState == 4) {
                        if (mygetrequest.status == 200 || window.location.href.indexOf("http") == -1) {
                            var thisdoc = document.getElementById("result")
                            if(thisdoc != null)
                                thisdoc.innerHTML = mygetrequest.responseText;
                        }
                    }
                }

                if (type == "Temperaturregelung") {
                    var reading = "desired-temp";
                    d_identifier += '_Climate';

                    var stepsize = 0.5; // TBD: configure & take out of database

                    var el_soll = document.getElementById("value_" + device_id);

                    var setvalue = el_soll.value.split("°")[0];

                    if(setvalue == "---" || setvalue == "NaN")

                        return false

                    if(timeout) window.clearTimeout(timeout);

                    var postfix = "";
                    if (value == "up") {
                        postfix = " \u00B0C";
                        if(setvalue == "off")
                            setvalue = 4.5;

                        setvalue = parseFloat(setvalue) + parseFloat(stepsize);

                        if(setvalue > 30.0)
                            setvalue = 30.0;

                        setvalue = setvalue.toFixed(1);

                        el_soll.value = setvalue+postfix;
                    } else if (value == "down") {
                        if(setvalue == "off")
                            setvalue = 4.5;

                        if(setvalue <= 5.0)
                            setvalue = "off";
                        else {
                            postfix = " \u00B0C";
                            setvalue = parseFloat(setvalue) - parseFloat(stepsize);
                            setvalue = setvalue.toFixed(1);
                        }

                        el_soll.value = setvalue+postfix;
                    }

                    timeout = setTimeout(function () {
                        mygetrequest.open("GET", cmdurl+"&device="+d_identifier+"&value="+setvalue+"&reading="+reading, true);
                        mygetrequest.send(null);
                    }, 2000);
                } else if (type == "Jalousie") {
                    if(timeout) window.clearTimeout(timeout);

                    console.log(value);

                    if (value != "on" && value != "off" && value != "stop") {
                        var direction = value;
                        var reading = "pct";

                        var stepsize = 5; // TBD: configure & take out of database

                        var el_soll = document.getElementById("value_" + device_id);
                        var el_ist = document.getElementById("value_cur_" + device_id);

                        if (direction == "up") {
                            if(el_soll.value.indexOf('%') > -1)
                                value = el_soll.value.split("%")[0];

                            value = parseInt(value) + parseInt(stepsize);
                            if(value > 100)
                                value = 100;

                            el_soll.value = value+'%';
                        } else if (direction == "down") {
                            if(el_soll.value.indexOf('%') > -1)
                                value = el_soll.value.split("%")[0];

                            value = parseInt(value) - parseInt(stepsize);
                            if(value < 0)
                                value = 0;

                            el_soll.value = value+'%';
                        } else
                            el_soll.value = value+'%';

                        if(el_soll.value.indexOf('%') > -1)
                            setvalue = el_soll.value.split("%")[0];
                        else
                            setvalue = el_soll.value;

                        timeout = setTimeout(function () {
                            mygetrequest.open("GET", cmdurl+"&device="+d_identifier+"&value="+setvalue+"&reading="+reading, true);
                            mygetrequest.send(null);
                        }, 2000);
                    } else {
                        var setvalue = value;

                        timeout = setTimeout(function () {
                            mygetrequest.open("GET", cmdurl+"&device="+d_identifier+"&value="+setvalue, true);
                            mygetrequest.send(null);
                        }, 2000);
                    }
                } else if (type == "Dimmer") {
                    var el_soll = document.getElementById("slider_value" + device_id);

                    el_soll.value = value;

                    if(timeout) window.clearTimeout(timeout);

                    timeout = setTimeout(function () {
                        mygetrequest.open("GET", cmdurl+value, true);
                        mygetrequest.send(null);
                    }, 2000);
                } else if (type == "Raspberry Pi GPIO") {
                    var el_raspi_address = document.getElementById("gpio_raspi_address" + device_id);
                    var el_outputpin = document.getElementById("gpio_outputpin" + device_id);

         			if(isset($_SERVER['HTTPS']))
         			{
         				cmdurl = "https://"+el_raspi_address.value+"/helper/gpio.php?cmd=set&pin="+el_outputpin.value+"&value="+value+"&identifier="+d_identifier+"&t=0";
         			}else{
         				cmdurl = "http://"+el_raspi_address.value+"/helper/gpio.php?cmd=set&pin="+el_outputpin.value+"&value="+value+"&identifier="+d_identifier+"&t=0";
         			}

                    mygetrequest.open("GET", cmdurl+value, true);
                    mygetrequest.send(null);
                } else {
                    mygetrequest.open("GET", cmdurl+value, true);
                    mygetrequest.send(null);
                }

                return false;
            }
        </script>

        <?php
        if (stripos($_SERVER['HTTP_USER_AGENT'], "ipad") !== FALSE || stripos($_SERVER['HTTP_USER_AGENT'], "iphone") !== FALSE) {
            // toggle trigger helper for touch events
            echo "<script src=\"./js/toggle.js\"></script>";
        }
        ?>
    </head>
    <body>
        <?php include dirname(__FILE__)."/includes/header.php"; ?>
        <div id="boxarea">
            <div id="griditem" style="display:none"><div id="boxitem"></div></div>
            <?php
            $sql = "SELECT rooms.name roomname, devices.dev_id, devices.name, devices.identifier, devices.isStructure, devices.isHidden, devices.nd_id, device_types.name typename, types.name basetype FROM devices join device_types on devices.dtype_id = device_types.dtype_id join types on device_types.type_id = types.type_id left outer join rooms on rooms.room_id = devices.room_id where rooms.room_id = " . $_GET['room'] . " and devices.isHidden != 'on' order by types.name asc";
            $result = mysql_query($sql);
            while ($device = mysql_fetch_object($result)) {
                $basetype = str_replace(array(" ", "_", "-", "/"), "", strtolower($device->basetype));
                $class = $basetype;

                if ($class == "einausschalter") {
                    if(stristr($device->name, "licht"))
                        $class = "licht";
                    else if(stristr($device->name, "beleuchtung"))
                        $class = "licht";
                    else if(stristr($device->name, "lampe"))
                        $class = "licht";
                }

                $hasbackside = false;
                switch ($basetype) {
                    case 'temperaturregelung':
                        $hasbackside = true;
                        break;
                    case 'tuerfensterkontakt':
                        $hasbackside = true;
                        break;
                    case 'jalousie':
                        $hasbackside = true;
                        break;
                }
            ?>
            <div id="griditem">
                <div id="flipcontainer<?php echo $device->dev_id; ?>" class="flip-container">
                    <div class="flipper">
                        <div class="front">
                            <div id="boxitem" class="<?php echo $class;?>">
                                <div id="title"><?php echo $device->name; ?></div><div id="pages"><?php echo ($hasbackside == true ? "1/2" : "&nbsp;"); ?></div>
                                <div id="icon"  <?php echo ($hasbackside == true ? "onclick=\"document.querySelector('div[id=flipcontainer".$device->dev_id."]').classList.toggle('flip')\"":""); ?>></div>
                                <div id="controls">
                                    <?php if ($basetype == "temperaturregelung") {
                                    ?>
                                    <div id="buttons">
                                        <div class="btn-group" style="margin-top: 10px;">
                                            <button type="button" class="btn btn-danger" onclick="javascript:toggleDevice('<?php echo $device->dev_id; ?>','<?php echo $device->identifier; ?>','<?php echo $device->basetype; ?>', 'up');">
                                                &nbsp;<span class="glyphicon glyphicon-plus"></span>&nbsp;
                                            </button>
                                        </div><br><br>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" onclick="javascript:toggleDevice('<?php echo $device->dev_id; ?>','<?php echo $device->identifier; ?>','<?php echo $device->basetype; ?>', 'down');">
                                                &nbsp;<span class="glyphicon glyphicon-minus"></span>&nbsp;
                                            </button>
                                        </div>
                                    </div>
                                    <div id="value">
                                        <input id="value_<?php echo $device->dev_id; ?>" readonly value="--- &deg;C">
                                    </div>
                                    <?php
                                    } elseif ($basetype == "einausschalter") {
                                    ?>
                                    <div id="buttons">
                                        <div id="value_<?php echo $device->dev_id; ?>" class="toggle"><div class="toggle-handle"></div></div>
                                    </div>
                                    <?php
                                    } elseif ($basetype == "tuerfensterkontakt") {
                                    ?>
                                    <div id="buttons">
                                        <div id="value_<?php echo $device->dev_id; ?>" class="indicator grey"></div>
                                    </div>
                                    <?php
                                    } elseif ($basetype == "jalousie") {
                                    ?>
                                    <div id="buttons">
                                        <div class="btn-group" style="margin-top: 10px;">
                                            <button type="button" class="btn btn-warning" onclick="javascript:toggleDevice('<?php echo $device->dev_id; ?>','<?php echo $device->identifier; ?>','<?php echo $device->basetype; ?>', 'up');">
                                                &nbsp;<span class="glyphicon glyphicon-chevron-up"></span>&nbsp;
                                            </button>
                                        </div><br><br>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning" onclick="javascript:toggleDevice('<?php echo $device->dev_id; ?>','<?php echo $device->identifier; ?>','<?php echo $device->basetype; ?>', 'down');">
                                                &nbsp;<span class="glyphicon glyphicon-chevron-down"></span>&nbsp;
                                            </button>
                                        </div>
                                    </div>
                                    <div id="value">
                                        <input id="value_cur_<?php echo $device->dev_id; ?>" hidden>
                                        <input id="value_<?php echo $device->dev_id; ?>" readonly value="---">
                                    </div>
                                    <?php
                                    } elseif ($basetype == "raspberrypigpio") {
                                    ?>
                                    <div id="buttons">
                                        <div id="value_<?php echo $device->dev_id; ?>" class="toggle"><div class="toggle-handle"></div></div>
                                        <?php
                                        $configResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'gpio_raspi_address' and dev_id = " . $device->dev_id));
                                        print("<input type=\"hidden\" id=\"gpio_raspi_address".$device->dev_id."\" value=\"".$configResult['value']."\">");
                                        $configResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'gpio_outputpin' and dev_id = " . $device->dev_id));
                                        print("<input type=\"hidden\" id=\"gpio_outputpin".$device->dev_id."\" value=\"".$configResult['value']."\">");
                                        ?>
                                    </div>
                                    <?php
                                    } elseif ($basetype == "webcam") {
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

                                            print("<a href=\"webcam.php?dev_id=".$device->dev_id."\"><div id=\"image\"><img src='http://".$cam_ipaddress.":".$cam_port."/videostream.cgi?user=".$cam_username."&pwd=".$cam_password."&resolution=32&rate=0'></div></a>");
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="back">
                            <div id="boxitem" class="<?php echo $class; ?>">
                                <div id="title"><?php echo $device->name; ?></div><div id="pages"><?php echo ($hasbackside == true ? "2/2" : "&nbsp;"); ?></div>
                                <div id="icon"  onclick="document.querySelector('div[id=flipcontainer<?php echo $device->dev_id; ?>]').classList.toggle('flip')"></div>
                                <div id="rows">
                                    <?php if ($basetype == "temperaturregelung") {
                                    print("<div id=\"row\">");
                                        print("<div id=\"text\">Soll Temperatur:</div><div id=\"desired-temp".$device->dev_id."\">--- °C</div>");
                                        print("<div id=\"text\">Raumtemperatur:</div><div id=\"measured-temp".$device->dev_id."\">--- °C</div>");
                                        print("<div id=\"text\">rel. Luftfeuchte:</div><div id=\"humidity".$device->dev_id."\">---%</div>");
                                        print("<div id=\"text\">Betriebsmodus:</div><div id=\"controlMode".$device->dev_id."\">ss</div>");
                                        print("<div id=\"text\">Batterie Status:</div><div id=\"battery".$device->dev_id."\">---</div>");
                                    print("</div>");
                                    } elseif ($basetype == "tuerfensterkontakt") {
                                    print("<div id=\"row\">");
                                        print("<div id=\"text\">Zustand:</div><div id=\"state".$device->dev_id."\">---</div>");
                                        print("<div id=\"text\">Batterie Status:</div><div id=\"battery".$device->dev_id."\">---</div>");
                                    print("</div>");
                                    } elseif ($basetype == "jalousie") {
                                    print("<div id=\"controls\">");
                                        print("<div id=\"presets\">");
                                            print("<div class=\"btn-group\" style=\"margin-top: 10px;\">");
                                                print("<button type=\"button\" class=\"btn btn-custom\" onclick=\"javascript:toggleDevice('<?php echo $device->dev_id; ?>','<?php echo $device->identifier; ?>','<?php echo $device->basetype; ?>', 'on');\">Öffnen</button>");
                                                print("<button type=\"button\" class=\"btn btn-custom\" onclick=\"javascript:toggleDevice('<?php echo $device->dev_id; ?>','<?php echo $device->identifier; ?>','<?php echo $device->basetype; ?>', 'off');\">Schließen</button>");
                                            print("</div><br>");
                                            print("<div class=\"btn-group\" style=\"margin-top: 10px;\">");
                                                print("<button type=\"button\" class=\"btn btn-custom\" onclick=\"javascript:toggleDevice('<?php echo $device->dev_id; ?>','<?php echo $device->identifier; ?>','<?php echo $device->basetype; ?>', '68');\">1/4</button>");
                                                print("<button type=\"button\" class=\"btn btn-custom\" onclick=\"javascript:toggleDevice('<?php echo $device->dev_id; ?>','<?php echo $device->identifier; ?>','<?php echo $device->basetype; ?>', '68');\">1/2</button>");
                                                print("<button type=\"button\" class=\"btn btn-custom\" onclick=\"javascript:toggleDevice('<?php echo $device->dev_id; ?>','<?php echo $device->identifier; ?>','<?php echo $device->basetype; ?>', '68');\">3/4</button>");
                                            print("</div>");
                                        print("</div>");
                                    print("</div>");
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script language="javascript">
                var useragent = '<?php echo $_SERVER['HTTP_USER_AGENT'] ?>';
                if ("<?php echo $device->basetype; ?>" == "Ein/Aus-Schalter" || "<?php echo $device->basetype; ?>" == "Raspberry Pi GPIO") {
                    document.querySelector('#value_<?php echo $device->dev_id; ?>').addEventListener('toggle', function myFunction() {
                        var el_value = document.querySelector('#value_<?php echo $device->dev_id; ?>');

                        var value = "off";
                        if(el_value.className == 'toggle active')
                            value = "on";

                        toggleDevice('<?php echo $device->dev_id; ?>','<?php echo $device->identifier; ?>','<?php echo $device->basetype; ?>', value);
                    });
                    if (useragent.indexOf("Macintosh") >= 0 || useragent.indexOf("Windows") >= 0 || useragent.indexOf("Linux") >= 0) {
                        $(document).ready(function () {
                            $('#value_<?php echo $device->dev_id; ?>').on('click', function () {
                                var value = "on";
                                if($(this).attr('class') == 'toggle active')
                                    value = "off";

                                toggleDevice('<?php echo $device->dev_id; ?>','<?php echo $device->identifier; ?>','<?php echo $device->basetype; ?>', value);
                            });
                        });
                    }
                }
            </script>
            <?php
            }
            ?>
        </div>
        <?php include dirname(__FILE__)."/includes/footer.php"; ?>
    </body>
</html>
