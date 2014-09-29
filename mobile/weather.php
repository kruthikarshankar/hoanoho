<?
	include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnection.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/sessionhandler.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/getConfiguration.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/dwd_parser.php';

	function getCurrentOpenWeatherMapData()
	{
		$weather = array();

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
					if (($row->weathervalue-360) <  22.5 and $row->weathervalue >= 337.5) $wdir = "Nord"; 
					else if ($row->weathervalue <  67.5 and $row->weathervalue >= 22.5)  $wdir = "Nord-Ost"; 
					else if ($row->weathervalue < 125.5 and $row->weathervalue >= 67.5)  $wdir = "Ost"; 
					else if ($row->weathervalue < 157.5 and $row->weathervalue >= 125.5) $wdir = "Süd-Ost"; 
					else if ($row->weathervalue < 202.5 and $row->weathervalue >= 157.5) $wdir = "Süd"; 
					else if ($row->weathervalue < 247.5 and $row->weathervalue >= 202.5) $wdir = "Süd-West"; 
					else if ($row->weathervalue < 292.5 and $row->weathervalue >= 247.5) $wdir = "West"; 
					else if ($row->weathervalue < 337.5 and $row->weathervalue >= 292.5) $wdir = "Nord-West";

					$weather['wind.dir'] = $wdir;
				}

				$weather[$row->weatherkey] = $row->weathervalue;
			}
		}

		return $weather;
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
		    		$weather = getCurrentOpenWeatherMapData();
		    		$sunrise = date('H:i',$weather['sys.sunrise']);
					$sunset = date('H:i',$weather['sys.sunset']);
		    	?>
		    	<li class="list-divider">Aktuelle Wetterlage</li>
		    	<li>Beschreibung: <? echo $weather['weather.0.description']; ?></li>
		    	<li>Temperatur: <? echo $weather['main.temp']."°C"; ?></li>
		    	<li>Temperatur Minimum: <? echo $weather['main.temp_min']."°C"; ?></li>
		    	<li>Temperatur Maximum: <? echo $weather['main.temp_max']."°C"; ?></li>
		    	<li>Regenmenge: <? echo (isset($weather['rain']) ? $weather['rain'] : "0")." l/qm"; ?></li>
		    	<li>Bewölkung: <? echo $weather['clouds.all']."%"; ?></li>
		    	<li>Luftfeuchtigkeit: <? echo $weather['main.humidity']."%"; ?></li>
		    	<li>Luftdruck: <? echo $weather['main.pressure']." hPa"; ?></li>
		    	<li>Windgeschwindigkeit: <? echo $weather['wind.speed']." km/h"; ?></li>
		    	<li>Windrichtung: <? echo $weather['wind.dir']." (".$weather['wind.deg']."°)"; ?></li>
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