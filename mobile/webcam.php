<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/sessionhandler.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="stylesheet" href="./css/ratchet.css" type="text/css" media="screen" title="no title" charset="UTF-8">

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

        <script src="./js/ratchet.js"></script>
        <script src="./js/standalone.js"></script>

        <title><?php echo $__CONFIG['main_sitetitle'] . " - Webcams"; ?></title>
    </head>
    <body>
        <header class="bar-title">
            <h1 class="title">Webcams</h1>
        </header>

        <div class="content">
            <ul class="list">
                <?php
                    $sql = "SELECT devices.dev_id, devices.name, rooms.name roomname, rooms.room_id FROM devices join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id left join rooms on rooms.room_id = devices.room_id where types.name = 'Webcam'";
                    $result = mysql_query($sql);
                    while ($device = mysql_fetch_object($result)) {
                        echo "<li><a href=\"device.php?room=".$device->room_id."&device=".$device->dev_id."&prevsite=webcam\" data-transition=\"slide-in\">".$device->name." [".$device->roomname."]</a>";
                          echo "<span class=\"chevron\"></span></li>";
                    }
                ?>
            </ul>
            <br><br><br>
        </div>

        <?php include "includes/nav.php"; ?>
    </body>
</html>
