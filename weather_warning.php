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

        <link rel="shortcut icon" type="image/x-icon" href="./img/favicons/favicon.ico">
        <link rel="apple-touch-icon" sizes="57x57" href="./img/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="./img/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="./img/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="144x144" href="./img/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="60x60" href="./img/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="./img/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="./img/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="152x152" href="./img/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="./img/favicons/apple-touch-icon-180x180.png">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-title" content="Hoanoho">
        <link rel="icon" type="image/png" href="./img/favicons/favicon-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="./img/favicons/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="./img/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="./img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="./img/favicons/favicon-32x32.png" sizes="32x32">
        <meta name="msapplication-TileColor" content="#603cba">
        <meta name="msapplication-TileImage" content="./img/favicons/mstile-144x144.png">
        <meta name="msapplication-config" content="./img/favicons/browserconfig.xml">
        <meta name="application-name" content="Hoanoho">

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