<?php

include dirname(__FILE__).'/includes/dbconnection.php';
include dirname(__FILE__).'/includes/sessionhandler.php';
include dirname(__FILE__).'/includes/dwd_parser.php';
include dirname(__FILE__).'/includes/getConfiguration.php';

function getCurrentOpenWeatherMapData($in_arr)
{
    $sql = "select * from openweathermap where measuredate = (select measuredate from openweathermap group by measuredate order by measuredate desc limit 1)";
    $weather_result = mysql_query($sql);
    while ($row = mysql_fetch_object($weather_result)) {
      if (isset($row->weatherkey) && $row->weatherkey != "") {
        if (isset($row->weathervalue) && $row->weathervalue != "") {

          // add wind direction
          if ($row->weatherkey == 'wind.deg') {
              if (($row->weathervalue <  22.5) and ($row->weathervalue >= 337.5)) $wdir = "Nord";
              if (($row->weathervalue <  67.5) and ($row->weathervalue >= 22.5))  $wdir = "Nord-Ost";
              if (($row->weathervalue < 125.5) and ($row->weathervalue >= 67.5))  $wdir = "Ost";
              if (($row->weathervalue < 157.5) and ($row->weathervalue >= 125.5)) $wdir = "Süd-Ost";
              if (($row->weathervalue < 202.5) and ($row->weathervalue >= 157.5)) $wdir = "Süd";
              if (($row->weathervalue < 247.5) and ($row->weathervalue >= 202.5)) $wdir = "Süd-West";
              if (($row->weathervalue < 292.5) and ($row->weathervalue >= 247.5)) $wdir = "West";
              if (($row->weathervalue < 337.5) and ($row->weathervalue >= 292.5)) $wdir = "Nord-West";

              $in_arr['wind.dir'] = $wdir;
          }

          $in_arr[$row->weatherkey] = $row->weathervalue;

        } else {
          $in_arr[$row->weatherkey] = "-";
        }
      }
    }

    return $in_arr;
}

function getForecastOpenWeatherMapData($days)
{
    $forecast = array();

    for ($i=0; $i < $days; $i++) {
        $forecast_day = array();

        $sql = "select * from openweathermap_forecast where weatherkey like 'list.".$i.".%'";
        $weather_result = mysql_query($sql);
        while ($row = mysql_fetch_object($weather_result)) {
          if (isset($row->weatherkey) && $row->weatherkey != "") {
            if (isset($row->weathervalue) && $row->weathervalue != "") {

              $explode = explode(".", $row->weatherkey);
              // add wind direction
              if ($explode[2] == 'deg') {
                  if (($row->weathervalue-360) <  22.5 and $row->weathervalue >= 337.5) $wdir = "Nord";
                  else if ($row->weathervalue <  67.5 and $row->weathervalue >= 22.5)  $wdir = "Nord-Ost";
                  else if ($row->weathervalue < 125.5 and $row->weathervalue >= 67.5)  $wdir = "Ost";
                  else if ($row->weathervalue < 157.5 and $row->weathervalue >= 125.5) $wdir = "Süd-Ost";
                  else if ($row->weathervalue < 202.5 and $row->weathervalue >= 157.5) $wdir = "Süd";
                  else if ($row->weathervalue < 247.5 and $row->weathervalue >= 202.5) $wdir = "Süd-West";
                  else if ($row->weathervalue < 292.5 and $row->weathervalue >= 247.5) $wdir = "West";
                  else if ($row->weathervalue < 337.5 and $row->weathervalue >= 292.5) $wdir = "Nord-West";

                  $forecast_day[$explode[0].".".$explode[1].'.dir'] = $wdir;
              }

              $forecast_day[$row->weatherkey] = $row->weathervalue;

            } else {
              $forecast_day[$row->weatherkey] = "-";
            }
          }
        }

        $forecast[] = $forecast_day;
    }

    return $forecast;
}

function getCurrentWeatherDataFromLocalStation($in_arr)
{
    $sql = "select timestamp_unix, valuename, value, valueunit from device_data where timestamp = (select max(timestamp) from device_data where deviceident = 'wslogger') and deviceident = 'wslogger'";
    $result = mysql_query($sql);

    while ($item = mysql_fetch_object($result)) {
        $in_arr['ws_'.$item->valuename] = $item->value;
    }

    return $in_arr;
}

$day = date("w");
$days_relative = array("Heute","Morgen","Übermorgen");

switch ($day) {
    case '0':
        $days = array("Sonntag","Montag","Dienstag");
        break;

    case '1':
        $days = array("Montag","Dienstag","Mittwoch");
        break;

    case '2':
        $days = array("Dienstag","Mittwoch","Donnerstag");
        break;

    case '3':
        $days = array("Mittwoch","Donnerstag","Freitag");
        break;

    case '4':
        $days = array("Donnerstag","Freitag","Samstag");
        break;

    case '5':
        $days = array("Freitag","Samstag","Sonntag");
        break;

    case '6':
        $days = array("Samstag","Sonntag","Montag");
        break;

    default:
        $days = array("unbekannt","unbekannt","unbekannt");
        break;
}

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
        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Wetterübersicht</title>
    </head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <?php
        $weather = array();
        $weather = array_merge($weather, getCurrentOpenWeatherMapData($weather));
        $weather = array_merge($weather, getCurrentWeatherDataFromLocalStation($weather));

        $sunrise = date('H:i',$weather['sys.sunrise']);
        $sunset = date('H:i',$weather['sys.sunset']);

        // Temperature
        $temp = (isset($weather['ws_OT']) ? $weather['ws_OT']." °C  (gefühlt ".$weather['ws_WC']." °C)" : $weather['main.temp']." °C");
          
        // Rain
        $rain = (isset($weather['ws_Rain1h']) ? $weather['ws_Rain1h']." l/qm pro h&nbsp;&nbsp;&nbsp;&nbsp;(".$weather['ws_Rain24h']." l/qm pro 24h)" : (isset($weather['rain']) ? $weather['rain']." mm" : "- mm"));

        // humidity
        $humidity = (isset($weather['ws_OH']) ? $weather['ws_OH'] : $weather['main.humidity']);

        // pressure
        $pressure = (isset($weather['ws_P']) ? $weather['ws_P'] : $weather['main.pressure']);

        // wspeed
        $wspeed = (isset($weather['ws_Wind']) ? $weather['ws_Wind'] : $weather['wind.speed']);

        // wdir
        $wdir = (isset($weather['ws_WindDir']) ? $weather['ws_WindDir'] : $weather['wind.dir']);
    ?>

    <section class="main_weather">
        <h1><span>Aktuelle Wetterlage</span></h1>
            <div id="weathericon"><img src="<?php echo "/img/weather/openweathermap/".$weather['weather.0.icon'].".png"; ?>"></div>
            <div id="details">
                <div><b>Beschreibung:</b> <?php echo $weather['weather.0.description']; ?></div>
                <div>&nbsp;</div>
                <div><b>Temperatur:</b> <?php echo $temp; ?></div>
                <div><b>Tages Temperatur Min.:</b> <?php echo $weather['main.temp_min']." °C"; ?></div>
                <div><b>Tages Temperatur Max.:</b> <?php echo $weather['main.temp_max']." °C"; ?></div>
                <div>&nbsp;</div>
                <div><b>Regenmenge:</b> <?php echo $rain; ?></div>
                <div><b>Bewölkung:</b> <?php echo $weather['clouds.all']." %"; ?></div>
                <div><b>Luftfeuchtigkeit:</b> <?php echo $humidity." %"; ?></div>
                <div><b>Luftdruck:</b> <?php echo $pressure." hPa"; ?></div>
                <div>&nbsp;</div>
                <div><b>Windgeschwindigkeit:</b> <?php $wspeed." km/h"; ?></div>
                <div><b>Windrichtung:</b> <?php echo $wdir; ?></div>
                <div>&nbsp;</div>
                <div><b>Sonnenaufgang:</b> <?php echo $sunrise ." Uhr"; ?></div>
                <div><b>Sonnenuntergang:</b> <?php echo $sunset." Uhr"; ?></div>
                <div>&nbsp;</div>
            </div>
            <div id="warnung"><?php echo $dwd_warnung; ?></div>
            <div id="footer"></div>
    </section>

    <section class="main_weather">
        <h1><span>Wetterkarte</span></h1>
        <div id="dwdimage"><img src="http://www.dwd.de/wundk/wetter/de/Deutschland.jpg"></div>
    </section>

    <?php
    $forecast_days = 3;
    $forecast = getForecastOpenWeatherMapData($forecast_days);
    $i = 0;

    for ($i=0; $i < $forecast_days; $i++) {
        echo "<section class=\"main_weather\">";
            echo "<h1><span>Vorhersage für " . $days_relative[$i] . " (".$days[$i].")</span></h1>";

            echo "<div id=\"weathericon\"><img src=\"/img/weather/openweathermap/".$forecast[$i]['list.'.$i.'.weather.0.icon'].".png\"></div>";
            echo "<div id=\"details\">";
                echo "<div>Beschreibung: ".$forecast[$i]['list.'.$i.'.weather.0.description']."</div>";
                echo "<div>&nbsp;</div>";
                echo "<div>Temperatur Morgens: ".$forecast[$i]['list.'.$i.'.temp.morn']." °C</div>";
                echo "<div>Temperatur Tagsüber: ".$forecast[$i]['list.'.$i.'.temp.day']." °C</div>";
                echo "<div>Temperatur Abends: ".$forecast[$i]['list.'.$i.'.temp.eve']." °C</div>";
                echo "<div>Temperatur Nachts: ".$forecast[$i]['list.'.$i.'.temp.night']." °C</div>";
                echo "<div>&nbsp;</div>";
                echo "<div>Temperatur Minimum: ".$forecast[$i]['list.'.$i.'.temp.min']." °C</div>";
                echo "<div>Temperatur Maximum: ".$forecast[$i]['list.'.$i.'.temp.max']." °C</div>";
                echo "<div>&nbsp;</div>";
                echo "<div>Regenmenge: ".(isset($forecast[$i]['list.'.$i.'.rain']) ? $forecast[$i]['list.'.$i.'.rain'] : "0")." l/qm.</div>";
                print("<div>Bewölkung: ".$forecast[$i]['list.'.$i.'.clouds']."%</div>");
                print("<div>Luftfeuchtigkeit: ".$forecast[$i]['list.'.$i.'.humidity']."%</div>");
                print("<div>Luftdruck: ".$forecast[$i]['list.'.$i.'.pressure']." hPa</div>");
                print("<div>&nbsp;</div>");
                print("<div>Windgeschwindigkeit: ".$forecast[$i]['list.'.$i.'.speed']." km/h</div>");
                print("<div>Windrichtung: ".$forecast[$i]['list.'.$i.'.dir']."</div>");
                print("<div>&nbsp;</div>");
            echo "</div>";
        echo "</section>";
    }
    ?>
</body>
</html>
