<?php
    include dirname(__FILE__).'/includes/dbconnection.php';
    include dirname(__FILE__).'/includes/sessionhandler.php';
    include dirname(__FILE__).'/includes/getConfiguration.php';
?>

<html>
    <head>
        <meta charset="UTF-8" />

        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/weather.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

        <link rel="shortcut icon" href="./img/favicons/favicon.ico">
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

        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Regenradar</title>
    </head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <section class="main_weather">
        <h1><span>Deutschland</span></h1>
            <div id="radar"><img src="http://www.dwd.de/wundk/radar/Radarfilm_WEB_DL.gif"></div>
            <div id="legend"><img src="./img/weather_radar_legend.png"></div>
    </section>

    <?php
    if ($__CONFIG['dwd_state'] != "") {

      if (in_array($__CONFIG['dwd_state'], array("SG", "HN"))) {
        $region="Nordwest";
      } elseif (in_array($__CONFIG['dwd_state'], array("PD", "RW"))) {
        $region="Nordost";
      } elseif ($__CONFIG['dwd_state'] == "EM") {
        $region="West";
      } elseif (in_array($__CONFIG['dwd_state'], array("EF", "LZ", "MB"))) {
        $region="Ost";
      } elseif (in_array($__CONFIG['dwd_state'], array("OF", "TR"))) {
        $region="Mitte";
      } elseif ($__CONFIG['dwd_state'] == "MS") {
        $region="Suedost";
      } elseif ($__CONFIG['dwd_state'] == "SU") {
        $region="Suedwest";
      }

      if (isset($region)) {
      ?>

      <section class="main_weather">
          <h1><span><?php echo $region ?> Region</span></h1>
          <div id="radar"><img src="http://www.dwd.de/wundk/radar/Webradar_<?php echo $region ?>.jpg"></div>
      </section>

    <?php
      }
    }
    ?>

</body>
</html>
