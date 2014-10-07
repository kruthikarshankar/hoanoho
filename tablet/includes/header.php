<?php

$weather = array();
$weatherSelectKeys = array('weather.0.icon', 'main.temp', 'weather.0.description');
$sql = "select * from openweathermap where measuredate = (select measuredate from openweathermap group by measuredate order by measuredate desc limit 1)";
$header_weather_result = mysql_query($sql);
while ($row = mysql_fetch_object($header_weather_result)) {
    if(in_array($row->weatherkey, $weatherSelectKeys))
        $weather[$row->weatherkey] = $row->weathervalue;
}

$title = "";
$connstate = "disconnected";

if (stristr($_SERVER['SCRIPT_NAME'], 'pupnp')) {
    $title = "Musik";
} else if(basename($_SERVER['SCRIPT_NAME']) == "index.php")
    $title = "Übersicht";
else if(basename($_SERVER['SCRIPT_NAME']) == "weather.php")
    $title = "Wetter";
else if (basename($_SERVER['SCRIPT_NAME']) == "floor.php") {
    if (isset($_GET['floor'])) {
        $sql = "select name from device_floors where floor_id = ".$_GET['floor'];
        $headerresult = mysql_fetch_object(mysql_query($sql));
        $title = utf8_encode($headerresult->name);
    }
} elseif (basename($_SERVER['SCRIPT_NAME']) == "room.php") {
    if (isset($_GET['room'])) {
        $sql = "select name from rooms where room_id = ".$_GET['room'];
        $headerresult = mysql_fetch_object(mysql_query($sql));
        $title = utf8_encode($headerresult->name);
    }
} elseif (basename($_SERVER['SCRIPT_NAME']) == "dtype.php") {
    if (isset($_GET['dtype'])) {
        $sql = "select name from device_types where dtype_id = ".$_GET['dtype'];
        $headerresult = mysql_fetch_object(mysql_query($sql));
        $title = utf8_encode($headerresult->name);
    }
} elseif (basename($_SERVER['SCRIPT_NAME']) == "webcam.php") {
    $connstate = "disconnected";

    if (isset($_GET['dev_id'])) {
        $sql = "select devices.name devicename, device_floors.name floorname, rooms.name roomname from devices join rooms on rooms.room_id = devices.room_id join device_floors on device_floors.floor_id = devices.floor_id where dev_id = ".$_GET['dev_id'];
        $headerresult = mysql_fetch_object(mysql_query($sql));
        $title = utf8_encode($headerresult->roomname).": ".utf8_encode($headerresult->devicename);
    }
}

$weekday = array("So.", "Mo.", "Di.", "Mi.", "Do.", "Fr.", "Sa.");
$date = $weekday[date('w')]." ".date('d.m.Y');
$clock = date('H:i');
$week = date('W');

?>

<script language="javascript">
    $(document).ready(function () {
        $("#weather").load("/tablet/helper/datacontroller.php?cmd=refresh_weather_for_header");
        var refreshId = setInterval(function () {
            $("#weather").load('/tablet/helper/datacontroller.php?cmd=refresh_weather_for_header&' + 1*new Date());
        }, 200000);
    });
</script>
<div id="titlebar">
    <div id="left">
        <div id="status" class="<?php echo $connstate; ?>">&nbsp;</div>
        <div id="date"><?php echo $date; ?></div>
        <div id="time"><?php echo $clock; ?> Uhr</div>
        <div id="week">KW <?php echo $week; ?></div>
    </div>
    <div id="middle">
        <div id="title"><?php echo $title; ?></div>
    </div>
    <div id="right">
        <div id="weather"></div>
    </div>
</div>
