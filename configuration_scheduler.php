<?php
  include dirname(__FILE__).'/includes/dbconnection.php';
  include dirname(__FILE__).'/includes/sessionhandler.php';
  include dirname(__FILE__).'/includes/getConfiguration.php';
?>
<script language="javascript">
    function displayDeviceStates(device, sch_id, value)
    {
        // [0] = device_id
        // [1] = devicetype name als klartext
        var deviceArr = device.split(";");

        var div = document.getElementById("devicestate"+sch_id);

        div.innerHTML = "";

        if(value == null)
            value = "";

        if (deviceArr[1] == "Ein/Aus-Schalter" || deviceArr[1] == "Raspberry Pi GPIO") {
            div.innerHTML = "<select id='dev_state"+sch_id+"' name='dev_state'></select>";
            var selectobj = document.getElementById("dev_state"+sch_id);

            selectobj.options[selectobj.options.length] = new Option('aus','off');
            selectobj.options[selectobj.options.length] = new Option('an','on');

            if(value == "off")
                selectobj.options.selectedIndex = 0;
            else if(value == "on")
                selectobj.options.selectedIndex = 1;
        } else if (deviceArr[1] == "Dimmer") {
            div.innerHTML = "<select id='dev_state"+sch_id+"' name='dev_state'></select>";
            var selectobj = document.getElementById("dev_state"+sch_id);

            selectobj.options[selectobj.options.length] = new Option('aus',0);

            for (var i=10; i<=100; i=i+10) {
                selectobj.options[selectobj.options.length] = new Option(i+'%',i);
            }

            if(value == "0")
                selectobj.options.selectedIndex = 0;
            else if(value == "10")
                selectobj.options.selectedIndex = 1;
            else if(value == "20")
                selectobj.options.selectedIndex = 2;
            else if(value == "30")
                selectobj.options.selectedIndex = 3;
            else if(value == "40")
                selectobj.options.selectedIndex = 4;
            else if(value == "50")
                selectobj.options.selectedIndex = 5;
            else if(value == "60")
                selectobj.options.selectedIndex = 6;
            else if(value == "70")
                selectobj.options.selectedIndex = 7;
            else if(value == "80")
                selectobj.options.selectedIndex = 8;
            else if(value == "90")
                selectobj.options.selectedIndex = 9;
            else if(value == "100")
                selectobj.options.selectedIndex = 10;
        } else if (deviceArr[1] == "Temperaturregelung") {
            div.innerHTML = "<select id='dev_state"+sch_id+"' name='dev_state'></select>";
            var selectobj = document.getElementById("dev_state"+sch_id);

            selectobj.options[selectobj.options.length] = new Option('aus', 'off');

            for (var i=18.0; i<=30.0; i=i+0.5) {
                selectobj.options[selectobj.options.length] = new Option(i.toFixed(1).toString()+'\u00B0C', i.toFixed(1));
            }

            if(value == "0")
                selectobj.options.selectedIndex = 0;
            else if(value == "18.0")
                selectobj.options.selectedIndex = 1;
            else if(value == "18.5")
                selectobj.options.selectedIndex = 2;
            else if(value == "19.0")
                selectobj.options.selectedIndex = 3;
            else if(value == "19.5")
                selectobj.options.selectedIndex = 4;
            else if(value == "20.0")
                selectobj.options.selectedIndex = 5;
            else if(value == "20.5")
                selectobj.options.selectedIndex = 6;
            else if(value == "21.0")
                selectobj.options.selectedIndex = 7;
            else if(value == "21.5")
                selectobj.options.selectedIndex = 8;
            else if(value == "22.0")
                selectobj.options.selectedIndex = 9;
            else if(value == "22.5")
                selectobj.options.selectedIndex = 10;
            else if(value == "23.0")
                selectobj.options.selectedIndex = 11;
            else if(value == "23.5")
                selectobj.options.selectedIndex = 12;
            else if(value == "24.0")
                selectobj.options.selectedIndex = 13;
            else if(value == "24.5")
                selectobj.options.selectedIndex = 14;
            else if(value == "25.0")
                selectobj.options.selectedIndex = 15;
            else if(value == "25.5")
                selectobj.options.selectedIndex = 16;
            else if(value == "26.0")
                selectobj.options.selectedIndex = 17;
            else if(value == "26.5")
                selectobj.options.selectedIndex = 18;
            else if(value == "27.0")
                selectobj.options.selectedIndex = 19;
            else if(value == "27.5")
                selectobj.options.selectedIndex = 20;
            else if(value == "28.0")
                selectobj.options.selectedIndex = 21;
            else if(value == "28.5")
                selectobj.options.selectedIndex = 22;
            else if(value == "29.0")
                selectobj.options.selectedIndex = 23;
            else if(value == "29.5")
                selectobj.options.selectedIndex = 24;
            else if(value == "30.0")
                selectobj.options.selectedIndex = 25;
        } else {
            div.innerHTML = "<input id='dev_state"+sch_id+"' name='dev_state' value='"+value+"'>";
        }
    }
</script>

<?php
    function displayDevices($dev_id,$sch_id)
    {
        $selected = false;
        $sql = "select devices.dev_id, devices.name devicename, devices.identifier, types.name typename from devices join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id order by identifier asc";

        $result = mysql_query($sql);
        echo "<select id=\"device\" name=\"device\" onchange=\"javascript:displayDeviceStates(this.value,".$sch_id.");\">";
        while ($device = mysql_fetch_object($result)) {
            if ($device->typename == "Webcam" || $device->typename == "Wertanzeige" || $device->typename == "Datensammler") {
                continue;
            }

            if(strlen($device->identifier) > 0)
                echo "<option ".($dev_id == $device->dev_id ? "selected" : "")." value=\"".$device->dev_id.";".$device->typename."\">".$device->devicename."&emsp;[".$device->identifier."]</option>";
            else
                echo "<option ".($dev_id == $device->dev_id ? "selected" : "")." value=\"".$device->dev_id.";".$device->typename."\">".$device->devicename."</option>";

            if($dev_id == $device->dev_id)
                $selected = true;
        }

        if(!$selected)
            echo "<option selected value=\"null\"></option>";

        echo "</select>";
    }

    function displayDays($inDays,$weekend)
    {
        if(!$weekend)
            $days = array("mo","di","mi","do","fr");
        else
            $days = array("sa","so");

        for ($i=0; $i < sizeof($days); $i++) {
            echo "<input type=\"checkbox\" name=\"day_".$days[$i]."\" value=\"1\" ".(strstr($inDays, $days[$i]) ? "checked" : "").">";
        }
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == "addplan") {
        $sql = "INSERT INTO scheduler (interval_type_id, interval_time) values (1, '00:00')";
        $result = mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "editplan") {
        $device_arr = explode(';', $_POST['device']);
        $device = $device_arr[0];

        $days = "";
        if (isset($_POST['day_mo'])) {
            $days = $days . "mo,";
        }
        if (isset($_POST['day_di'])) {
            $days = $days . "di,";
        }
        if (isset($_POST['day_mi'])) {
            $days = $days . "mi,";
        }
        if (isset($_POST['day_do'])) {
            $days = $days . "do,";
        }
        if (isset($_POST['day_fr'])) {
            $days = $days . "fr,";
        }
        if (isset($_POST['day_sa'])) {
            $days = $days . "sa,";
        }
        if (isset($_POST['day_so'])) {
            $days = $days . "so,";
        }

        $isActive = 0;
        if (isset($_POST['isActive'])) {
            $isActive = 1;
        }

        $sql = "update scheduler set days = '" . $days . "', isActive = " . $isActive . ", dev_id = " . $device . ", dev_state = '" . $_POST['dev_state'] . "', interval_time = '".$_POST['interval_time']."' where sch_id = " . $_POST['sch_id'];
        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "deleteplan") {
        if (isset($_POST['uid']) && $_SESSION['uid'] != $_POST['uid']) {
            $sql = "delete from scheduler where sch_id = ".$_POST['sch_id'];
            mysql_query($sql);
        }
    }
?>

<html>
    <head>
        <meta charset="utf-8">

        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <link rel="stylesheet" href="./css/configuration.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <?php
        if(strpos($_SERVER['HTTP_USER_AGENT'], "Android"))
            echo '<link rel="stylesheet" href="./css/configuration-android.css" type="text/css" media="screen" title="no title" charset="UTF-8">';
        else if(strpos($_SERVER['HTTP_USER_AGENT'], "iPhone") || strpos($_SERVER['HTTP_USER_AGENT'], "iPad"))
            echo '<link rel="stylesheet" href="./css/configuration-ios.css" type="text/css" media="screen" title="no title" charset="UTF-8">';
        ?>

        <link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

        <link rel="apple-touch-icon" href="./img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Einstellungen - Zeitplaner</title>
    </head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <section class="main_configuration_scheduler">
        <h1><span>Zeitpläne</span></h1>

        <div id="toolbar">
            <form method="POST" enctype="multipart/form-data" name="addPlanForm" id="addPlanForm">
                <div id="left"><a href="#" onclick="javascript:document.addPlanForm.submit()"><img src="./img/add.png">&nbsp;&nbsp;Zeitplan hinzufügen</a></div>
                <input type="hidden" name="cmd" value="addplan">
            </form>
        </div>

        <div id="header">
            <div id="days">Wochentag</div>
            <div id="interval">Uhrzeit</div>
            <div id="device">Gerät</div>
            <div id="devicestate">Gerätestatus</div>
            <div id="isActive">Aktiv</div>
            <div id="action">&nbsp;</div>
        </div>

        <div id="header_weekdays">
            <div id="day1">Mo</div>
            <div id="day2">Di</div>
            <div id="day3">Mi</div>
            <div id="day4">Do</div>
            <div id="day5">Fr</div>
            <div id="day6">Sa</div>
            <div id="day7">So</div>
        </div>
        <?php
        $sql = "SELECT scheduler.*, types.name typename FROM scheduler left join devices on devices.dev_id = scheduler.dev_id left join device_types on device_types.dtype_id = devices.dtype_id left join types on types.type_id = device_types.type_id ORDER BY interval_type_id ASC, isActive DESC";
        $result = mysql_query($sql);
        while ($scheduler = mysql_fetch_object($result)) {
        ?>
        <div id="listitem">
            <form method="POST" enctype="multipart/form-data" name="editPlanForm<?php echo $scheduler->sch_id; ?>" id="editForm">
                <div id="days">
                    <div id="weekday">
                        <?php displayDays($scheduler->days,false); ?>
                    </div>
                    &nbsp;&nbsp;<?php displayDays($scheduler->days,true); ?>
                </div>
                <div id="interval<?php echo $scheduler->sch_id ?>"><input id="interval_time" name="interval_time" maxlength="5" value="<?php echo $scheduler->interval_time; ?>"></div>
                <div id="device"><?php displayDevices($scheduler->dev_id,$scheduler->sch_id); ?></div>
                <div id="devicestate<?php echo $scheduler->sch_id ?>"></div>
                <div id="isActive"><input type="checkbox" name="isActive" <?php if ($scheduler->isActive == 1) echo "checked"; ?>></div>
                <input type="hidden" name="cmd" value="editplan">
                <input type="hidden" name="sch_id" value="<?php echo $scheduler->sch_id; ?>">
            </form>
            <div id="action">
                <form method="POST" enctype="multipart/form-data" name="deletePlanForm<?php echo $scheduler->sch_id; ?>" id="deleteForm">
                    <input type="hidden" name="cmd" value="deleteplan">
                    <input type="hidden" name="sch_id" value="<?php echo $scheduler->sch_id; ?>">
                </form>
                <a href="#" onclick="javascript:document.editPlanForm<?php echo $scheduler->sch_id; ?>.submit()" title="Änderungen speichern"><img src="./img/save.png"></a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:document.deletePlanForm<?php echo $scheduler->sch_id; ?>.submit()" title="Zeitplan löschen" onclick="javascript:return confirm('Soll der Zeitplan wirklich gelöscht werden ?');"><img src="./img/delete.png"></a>
            </div>
        </div>
        <?php
            echo "<script type=\"text/javascript\">displayDeviceStates('".$scheduler->dev_id.";".$scheduler->typename."',".$scheduler->sch_id.",'".$scheduler->dev_state."');</script>";
        }
        ?>
    </section>
</body>
</html>
