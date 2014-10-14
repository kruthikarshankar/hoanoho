<?php
    include dirname(__FILE__).'/includes/dbconnection.php';
    include dirname(__FILE__).'/includes/sessionhandler.php';
    include dirname(__FILE__).'/includes/dwd_parser.php';
    include dirname(__FILE__).'/includes/getConfiguration.php';
?>

<html>
    <head>
        <meta charset="UTF-8" />

        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/weather.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

        <link rel="apple-touch-icon" href="./img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Wetterwarnungen</title>
    </head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <section class="main_weather">
        <h1><span>Wetter (Unwetter-) Warnungen</span></h1>
            <?php
            if ($__CONFIG['dwd_state'] != "") {
            ?>

            <div id="radar"><a href="http://www.dwd.de/bvbw/appmanager/bvbw/dwdwwwDesktop?_nfpb=true&_windowLabel=T14600649251144330032285&_urlType=action&_pageLabel=_dwdwww_wetter_warnungen_warnungen&WEEKLY_REPORT_VIEW=false&TIME=x&SHOW_HEIGHT_SEL=true&MAP_VIEW=true&MOVIE_VIEW=false&TABLE_VIEW=false&HEIGHT=x&SHOW_TIME_SEL=true&STATIC_CONTENT_VIEW=false&WARNING_TYPE=0&_state=maximized&LAND_CODE=<?= $__CONFIG['dwd_state'] ?>" target="_blank"><img src="http://www.dwd.de/dyn/app/ws/maps/<?= $__CONFIG['dwd_state'] ?>_x_x_0.gif"></a></div>

            <?php
            }

            if (isset($dwd_warnung) && $dwd_warnung != "") {
            ?>
            <div id="title">Warnung</div>
            <div id="text"><?php echo $dwd_warnung; ?></div>
            <?php
            }

            if (isset($dwd_report) && $dwd_report != "") {
            ?>
            <div id="title">Report</div>
            <div id="text"><?php echo $dwd_report; ?></div>
            <?php
            }
            ?>
    </section>
</body>
</html>