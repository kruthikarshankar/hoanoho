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

        <link rel="apple-touch-icon" href="./img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
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
