<?
	include dirname(__FILE__).'/..//includes/dbconnection.php';
	include dirname(__FILE__).'/..//includes/sessionhandler.php';
	include dirname(__FILE__).'/..//includes/getConfiguration.php';
	include dirname(__FILE__).'/..//includes/dwd_parser.php';

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

		<title><? echo $__CONFIG['main_sitetitle'] . " - Wetter" ?></title>
	</head>
	<body>
		<header class="bar-title">
	    	<h1 class="title">Wetter</h1>
	  	</header>

	  	<div class="content">
	  		<br>
		    <ul class="list inset">
		    	<?
		    		$weather = array();
					$weather['ws_available'] = false;

					$weather = array_merge($weather, getCurrentOpenWeatherMapData($weather));
					$weather = array_merge($weather, getCurrentWeatherDataFromLocalStation($weather));

		    		$sunrise = date('H:i',$weather['sys.sunrise']);
					$sunset = date('H:i',$weather['sys.sunset']);
		    	?>
		    	<li class="list-divider">Aktuelle Wetterlage</li>
		    	<li>Beschreibung: <? echo $weather['weather.0.description']; ?></li>
		    	<li>Temperatur: <? echo ($weather['ws_available'] == true ? $weather['ws_OT']."°C  (".$weather['ws_WC']."°C gefühlt)" : $weather['main_temp']."°C"); ?></li>
		    	<li>Temperatur Minimum: <? echo $weather['main.temp_min']."°C"; ?></li>
		    	<li>Temperatur Maximum: <? echo $weather['main.temp_max']."°C"; ?></li>
		    	<?
		    	if($weather['ws_available'] == true)
		    	{
		    		echo "<li>Regenmenge pro Stunde: ".$weather['ws_Rain1h']." l/qm</li>";
		    		echo "<li>Regenmenge pro Tag: ".$weather['ws_Rain24h']." l/qm</li>";
		    	}
		    	else
		    	{
		    		echo "<li>Regenmenge: ".(isset($weather['rain']) ? $weather['rain'] : "0")." l/qm</li>";
		    	}
		    	?>
		    	<li>Bewölkung: <? echo $weather['clouds.all']."%"; ?></li>
		    	<li>Luftfeuchtigkeit: <? echo ($weather['ws_available'] == true ? $weather['ws_OH'] : $weather['main.humidity'])."%"; ?></li>
		    	<li>Luftdruck: <? echo ($weather['ws_available'] == true ? $weather['ws_P'] : $weather['main.pressure'])." hPa"; ?></li>
		    	<li>Windgeschwindigkeit: <? echo ($weather['ws_available'] == true ? $weather['ws_Wind'] : $weather['wind.speed'])." km/h"; ?></li>
		    	<li>Windrichtung: <? echo ($weather['ws_available'] == true ? $weather['ws_WindDir'] : $weather['wind.dir']." (".$weather['wind.deg']."°)"); ?></li>
		    	<li>Sonnenaufgang: <? echo $sunrise." Uhr"; ?></li>
		    	<li>Sonnenuntergang: <? echo $sunset." Uhr"; ?></li>
		    	<li class="list-divider">Wetterkarte</li>
		    	<li class="weather"><img src="http://www.dwd.de/wundk/wetter/de/Deutschland.jpg"></li>
		    	<li class="list-divider">Wetterwarnung</li>
		    	<? if(stripos($dwd_warnung, "Es liegt aktuell keine Warnung") != FALSE) { ?>
		    		<li class="weatherwarning alarm"><? echo $dwd_warnung; ?></li>
		    	<? } else { ?>
		    		<li class="weatherwarning"><? echo $dwd_warnung; ?></li>
		    	<? } ?>
		    	<li class="list-divider">Report</li>
		    	<li class="weatherwarning"><? echo $dwd_report; ?></li>
		    </ul>
		    <br><br><br>
		</div>
		
		<? include "includes/nav.php"; ?>
	</body>
</html>