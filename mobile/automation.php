<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/sessionhandler.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="stylesheet" href="./css/ratchet.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <link rel="apple-touch-icon" href="../img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico" />

        <script src="./js/ratchet.js"></script>
        <script src="./js/standalone.js"></script>

        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Steuerung</title>
    </head>
    <body>
        <header class="bar-title">
            <h1 class="title">Steuerung</h1>
        </header>

        <div class="content">
            <ul class="list">
                <?php
                    $sql = "SELECT * FROM device_floors WHERE position = 0 order by position asc";
                    $result = mysql_query($sql);
                    while ($floor = mysql_fetch_object($result)) {
                        echo "<li class=\"list-divider\">".utf8_encode($floor->name)."</li>";
                        $sql2 = "SELECT * FROM devices where floor_id = ".$floor->floor_id." and isHidden != 'on' order by name asc";
                        $result2 = mysql_query($sql2);
                        while ($device = mysql_fetch_object($result2)) {
                            echo "<li><a href=\"device.php?device=".$device->dev_id."\" data-transition=\"slide-in\" data-ignore=\"push\">".utf8_encode($device->name)."</a>";
                              echo "<span class=\"chevron\"></span></li>";
                        }
                    }

                    $sql = "SELECT *, (select count(room_id) from rooms where rooms.floor_id = device_floors.floor_id) as roomcount FROM device_floors WHERE position > 0 order by position asc";
                    $result = mysql_query($sql);
                    while ($floor = mysql_fetch_object($result)) {
                        echo "<li class=\"list-divider\">".utf8_encode($floor->name)."</li>";
                        $sql2 = "SELECT * FROM rooms where floor_id = ".$floor->floor_id." order by name asc";
                        $result2 = mysql_query($sql2);
                        while ($room = mysql_fetch_object($result2)) {
                            echo "<li><a href=\"room.php?room=".$room->room_id."\" data-transition=\"slide-in\">".utf8_encode($room->name)."</a>";
                              echo "<span class=\"chevron\"></span></li>";
                        }
                    }
                ?>
            </ul>
            <br><br><br>
        </div>
        <?php include "includes/nav.php"; ?>
    </body>
</html>
