<?

include dirname(__FILE__).'/includes/dbconnection.php';
include dirname(__FILE__).'/includes/sessionhandler.php';
include dirname(__FILE__).'/includes/dwd_parser.php';
include dirname(__FILE__).'/includes/getConfiguration.php';

function getCurrentOpenWeatherMapData($in_arr)
{
	// select which data should be returned
	$weatherSelectKeys = array('sys.sunrise', 
								'sys.sunset', 
								'weather.0.icon', 
								'weather.0.description', 
								'main.temp', 
								'main.temp_min', 
								'main.temp_max',
								'main.humidity', 
								'main.pressure', 
								'wind.speed', 
								'wind.deg',
								'clouds.all'
							   );
	
	$sql = "select * from openweathermap where measuredate = (select measuredate from openweathermap group by measuredate order by measuredate desc limit 1)";
	$weather_result = mysql_query($sql);
	while ($row = mysql_fetch_object($weather_result)) {
		if(in_array($row->weatherkey, $weatherSelectKeys))
		{
			// add wind direction
			if($row->weatherkey == 'wind.deg')
			{
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
		}
	}

	return $in_arr;
}

function getForecastOpenWeatherMapData($days)
{
	$forecast = array();

	// select which data should be returned
	$weatherSelectKeys = array();
	for ($i=0; $i < $days; $i++) {
		$weatherSelectKeys[] = "list.".$i.".temp.day";
		$weatherSelectKeys[] = "list.".$i.".temp.min";
		$weatherSelectKeys[] = "list.".$i.".temp.max";
		$weatherSelectKeys[] = "list.".$i.".temp.night";
		$weatherSelectKeys[] = "list.".$i.".temp.eve";
		$weatherSelectKeys[] = "list.".$i.".temp.morn";
		$weatherSelectKeys[] = "list.".$i.".pressure";
		$weatherSelectKeys[] = "list.".$i.".humidity";
		$weatherSelectKeys[] = "list.".$i.".weather.0.description";
		$weatherSelectKeys[] = "list.".$i.".weather.0.icon";
		$weatherSelectKeys[] = "list.".$i.".speed";
		$weatherSelectKeys[] = "list.".$i.".deg";
		$weatherSelectKeys[] = "list.".$i.".clouds";
		$weatherSelectKeys[] = "list.".$i.".rain";
		$weatherSelectKeys[] = "list.".$i.".snow";
	}
	
	for ($i=0; $i < $days; $i++) { 
		$forecast_day = array();

		$sql = "select * from openweathermap_forecast where weatherkey like 'list.".$i.".%'";
		$weather_result = mysql_query($sql);
		while ($row = mysql_fetch_object($weather_result)) {
			if(in_array($row->weatherkey, $weatherSelectKeys))
			{
				$explode = explode(".", $row->weatherkey);
				// add wind direction
				if($explode[2] == 'deg')
				{
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

	if(mysql_num_rows($result) > 0)
		$in_arr['ws_available'] = true;

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

		<? include dirname(__FILE__).'/includes/getUserSettings.php'; ?> 

		<link rel="apple-touch-icon" href="./img/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
		<title><? echo $__CONFIG['main_sitetitle'] ?> - Wetterübersicht</title>
	</head>
<body>
	<? require(dirname(__FILE__).'/includes/nav.php'); ?>

	<?
		$weather = array();
		$weather['ws_available'] = false;

		$weather = array_merge($weather, getCurrentOpenWeatherMapData($weather));
		$weather = array_merge($weather, getCurrentWeatherDataFromLocalStation($weather));

		$sunrise = date('H:i',$weather['sys.sunrise']);
		$sunset = date('H:i',$weather['sys.sunset']);
	?>

	<section class="main_weather">
		<h1><span>Aktuelle Wetterlage</span></h1>
			<div id="weathericon"><img src="<? echo "/img/weather/openweathermap/".$weather['weather.0.icon'].".png"; ?>"></div>
			<div id="details">
				<div><b>Beschreibung:</b> <? echo $weather['weather.0.description']; ?></div>
				<div>&nbsp;</div>
				<div><b>Temperatur:</b> <? echo ($weather['ws_available'] == true ? $weather['ws_OT']."°C  (".$weather['ws_WC']."°C gefühlt)" : $weather['main_temp']."°C"); ?></div>
				<div><b>Tages Temperatur Min.:</b> <? echo $weather['main.temp_min']."°C"; ?></div>
				<div><b>Tages Temperatur Max.:</b> <? echo $weather['main.temp_max']."°C"; ?></div>
				<div>&nbsp;</div>
				<div><b>Regenmenge:</b> <? echo ($weather['ws_available'] == true ? $weather['ws_Rain1h']." l/qm pro h&nbsp;&nbsp;&nbsp;&nbsp;(".$weather['ws_Rain24h']." l/qm pro 24h)" : (isset($weather['ws_rain1h'])." l/qm/h" ? $weather['rain'] : "0")." l/qm"); ?></div>
				<div><b>Bewölkung:</b> <? echo $weather['clouds.all']."%"; ?></div>
				<div><b>Luftfeuchtigkeit:</b> <? echo ($weather['ws_available'] == true ? $weather['ws_OH'] : $weather['main.humidity'])."%"; ?></div>
				<div><b>Luftdruck:</b> <? echo ($weather['ws_available'] == true ? $weather['ws_P'] : $weather['main.pressure'])." hPa"; ?></div>
				<div>&nbsp;</div>
				<div><b>Windgeschwindigkeit:</b> <? echo ($weather['ws_available'] == true ? $weather['ws_Wind'] : $weather['wind.speed'])." km/h"; ?></div>
				<div><b>Windrichtung:</b> <? echo ($weather['ws_available'] == true ? $weather['ws_WindDir'] : $weather['wind.dir']." (".$weather['wind.deg']."°)"); ?></div>
				<div>&nbsp;</div>
				<div><b>Sonnenaufgang:</b> <? echo $sunrise ." Uhr"; ?></div>
				<div><b>Sonnenuntergang:</b> <? echo $sunset." Uhr"; ?></div>
				<div>&nbsp;</div>
			</div>
			<div id="warnung"><? echo $dwd_warnung; ?></div>
			<div id="footer"></div>
	</section>

	<section class="main_weather">
		<h1><span>Wetterkarte</span></h1>
		<div id="dwdimage"><img src="http://www.dwd.de/wundk/wetter/de/Deutschland.jpg"></div>
	</section>


	<?
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
				echo "<div>Temperatur Morgens: ".$forecast[$i]['list.'.$i.'.temp.morn']."°C</div>";
				echo "<div>Temperatur Tagsüber: ".$forecast[$i]['list.'.$i.'.temp.day']."°C</div>";
				echo "<div>Temperatur Abends: ".$forecast[$i]['list.'.$i.'.temp.eve']."°C</div>";
				echo "<div>Temperatur Nachts: ".$forecast[$i]['list.'.$i.'.temp.night']."°C</div>";
				echo "<div>&nbsp;</div>";
				echo "<div>Temperatur Minimum: ".$forecast[$i]['list.'.$i.'.temp.min']."°C</div>";
				echo "<div>Temperatur Maximum: ".$forecast[$i]['list.'.$i.'.temp.max']."°C</div>";
				echo "<div>&nbsp;</div>";
				echo "<div>Regenmenge: ".(isset($forecast[$i]['list.'.$i.'.rain']) ? $forecast[$i]['list.'.$i.'.rain'] : "0")." l/qm.</div>";
				print("<div>Bewölkung: ".$forecast[$i]['list.'.$i.'.clouds']."%</div>");
				print("<div>Luftfeuchtigkeit: ".$forecast[$i]['list.'.$i.'.humidity']."%</div>");
				print("<div>Luftdruck: ".$forecast[$i]['list.'.$i.'.pressure']." hPa</div>");
				print("<div>&nbsp;</div>");
				print("<div>Windgeschwindigkeit: ".$forecast[$i]['list.'.$i.'.speed']." km/h</div>");
				print("<div>Windrichtung: ".$forecast[$i]['list.'.$i.'.dir']." (".$forecast[$i]['list.'.$i.'.deg']."°)</div>");
				print("<div>&nbsp;</div>");
			echo "</div>";
		echo "</section>";
	}
	?>
</body>
</html>