<?
	include dirname(__FILE__).'/../includes/simple_html_dom.php';
	include dirname(__FILE__).'/../includes/dbconnection.php';
	include dirname(__FILE__).'/../includes/getConfiguration.php';

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



	if (!isset($_GET['cmd'])) {
		exit;
	}



	if($_GET['cmd'] == 'refresh_weather_for_header')
	{
		$weather = array();
		$weather['ws_available'] = false;

		$weather = array_merge($weather, getCurrentOpenWeatherMapData($weather));
		$weather = array_merge($weather, getCurrentWeatherDataFromLocalStation($weather));

		$protocol = "http";
		if($_SERVER["HTTPS"] == "on")
	  		$protocol = "https";

		echo "<img src=\"".$protocol."://".$_SERVER['HTTP_HOST']."/img/weather/openweathermap/".$weather['weather.0.icon'].".png\">".$weather['weather.0.description'].", ".$weather['main.temp']. "&deg;C";
	}



	if($_GET['cmd'] == 'refresh_current_weather')
	{
		$weather = array();
		$weather['ws_available'] = false;

		$weather = array_merge($weather, getCurrentOpenWeatherMapData($weather));
		$weather = array_merge($weather, getCurrentWeatherDataFromLocalStation($weather));
		
		$sunrise = date('H:i',$weather['sys.sunrise']);
		$sunset = date('H:i',$weather['sys.sunset']);

		print("<div id=\"title\"><img src=\"../img/weather/openweathermap/".$weather['weather.0.icon'].".png\">Aktuelle Wetterlage</div>");
		print("<div style=\"position: absolute; width: 98%;\"><div id=\"icon\"></div></div>");
		print("<div id=\"rows_left\">");
			print("<div id=\"row_\">");
				print("<div id=\"text\">Beschreibung:</div><div id=\"value\">".$weather['weather.0.description']."</div>");
			print("</div>");
			print("<div id=\"row_\">&nbsp;</div>");
			print("<div id=\"row_\">");
				print("<div id=\"text\">Temperatur:</div><div id=\"value\">".($weather['ws_available'] == true ? $weather['ws_OT']."°C" : $weather['main_temp']."°C")."</div>");
			print("</div>");
			print("<div id=\"row_\">");
				print("<div id=\"text\">Temperatur Minimum:</div><div id=\"value\">".$weather['main.temp_min']."°C</div>");
			print("</div>");
			print("<div id=\"row_\">");
				print("<div id=\"text\">Temperatur Maximum:</div><div id=\"value\">".$weather['main.temp_max']."°C</div>");
			print("</div>");
			print("<div id=\"row_\">&nbsp;</div>");
			if($weather['ws_available'] == true)
			{
				print("<div id=\"row_\">");
					print("<div id=\"text\">Regenmenge pro Stunde:</div><div id=\"value\">".$weather['ws_Rain1h']." l/qm</div>");
				print("</div>");
				print("<div id=\"row_\">");
					print("<div id=\"text\">Regenmenge pro Tag:</div><div id=\"value\">".$weather['ws_Rain24h']." l/qm</div>");
				print("</div>");
				print("<div id=\"row_\">&nbsp;</div>");
			} 
			else
			{
				print("<div id=\"row_\">");
					print("<div id=\"text\">Regenmenge:</div><div id=\"value\">".(isset($weather['rain']) ? $weather['rain'] : "0")." l/qm</div>");
				print("</div>");
			}
			print("<div id=\"row_\">");
				print("<div id=\"text\">Bewölkung:</div><div id=\"value\">".$weather['clouds.all']."%</div>");
			print("</div>");
			print("<div id=\"row_\">");
				print("<div id=\"text\">Luftfeuchtigkeit:</div><div id=\"value\">".($weather['ws_available'] == true ? $weather['ws_OH'] : $weather['main.humidity'])."%</div>");
			print("</div>");
			print("<div id=\"row_\">");
				print("<div id=\"text\">Luftdruck:</div><div id=\"value\">".($weather['ws_available'] == true ? $weather['ws_P'] : $weather['main.pressure'])." hPa</div>");
			print("</div>");
			print("<div id=\"row_\">&nbsp;</div>");
			print("<div id=\"row_\">");
				print("<div id=\"text\">Windgeschwindigkeit:</div><div id=\"value\">".($weather['ws_available'] == true ? $weather['ws_Wind'] : $weather['wind.speed'])." km/h</div>");
			print("</div>");
			print("<div id=\"row_\">");
				print("<div id=\"text\">Windrichtung:</div><div id=\"value\">".($weather['ws_available'] == true ? $weather['ws_WindDir'] : $weather['wind.dir']." (".$weather['wind.deg']."°)")."</div>");
			print("</div>");
			print("<div id=\"row_\">&nbsp;</div>");
			print("<div id=\"row_\">");
				print("<div id=\"text\">Sonnenaufgang:</div><div id=\"value\">".$sunrise." Uhr</div>");
			print("</div>");
			print("<div id=\"row_\">");
				print("<div id=\"text\">Sonnenuntergang:</div><div id=\"value\">".$sunset." Uhr</div>");
			print("</div>");
		print("</div>");
		print("<div id=\"rows_right\">");
			print("<div id=\"image\"><img src=\"http://www.dwd.de/wundk/wetter/de/Deutschland.jpg\"></div>");
		print("</div>");
	}


	if($_GET['cmd'] == 'refresh_weather_forecast')
	{
		$forecast_days = 3;

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

		$forecast = getForecastOpenWeatherMapData($forecast_days);

		print("<div id=\"title\">Vorhersage</div>");
		print("<div style=\"position: absolute; width: 98%;\"><div id=\"icon\"></div></div>");
		
		for ($i=0; $i < $forecast_days; $i++) {
			print("<div id=\"forecast_".$i."\">");
				print("<div id=\"title\"><img src=\"../img/weather/openweathermap/".$forecast[$i]['list.'.$i.'.weather.0.icon'].".png\">".$days_relative[$i] . " (".$days[$i].")</div>");
				print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
				print("<div id=\"text\">Beschreibung:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.weather.0.description']."</div>");
				print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
				print("<div id=\"text\">Temperatur Morgens:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.morn']."°C</div>");
				print("<div id=\"text\">Temperatur Tagsüber:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.day']."°C</div>");
				print("<div id=\"text\">Temperatur Abends:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.eve']."°C</div>");
				print("<div id=\"text\">Temperatur Nachts:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.night']."°C</div>");
				print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
				print("<div id=\"text\">Temperatur Minimum:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.min']."°C</div>");
				print("<div id=\"text\">Temperatur Maximum:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.max']."°C</div>");
				print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
				print("<div id=\"text\">Regenmenge:</div><div id=\"value\">".(isset($forecast[$i]['list.'.$i.'.rain']) ? $forecast[$i]['list.'.$i.'.rain'] : "0")." l/qm</div>");
				print("<div id=\"text\">Bewölkung:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.clouds']."%</div>");
				print("<div id=\"text\">Luftfeuchtigkeit:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.humidity']."%</div>");
				print("<div id=\"text\">Luftdruck:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.pressure']." hPa</div>");
				print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
				print("<div id=\"text\">Windgeschwindigkeit:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.speed']." km/h</div>");
				print("<div id=\"text\">Windrichtung:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.dir']." (".$forecast[$i]['list.'.$i.'.deg']."°)</div>");
				print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
			print("</div>");
		}
	}	


	if($_GET['cmd'] == 'refresh_weather_report')
	{
		print("<div id=\"title\">Report</div>");
			print("<div style=\"position: absolute; width: 98%;\"><div id=\"icon\"></div></div>");
			print("<div id=\"rows\">");
					
			$html = file_get_html($__CONFIG['dwd_url_bundesland']);
			$dwd_report = "";

			if(strlen($html) > 0)
			{
				foreach($html->find('div') as $element) 
				{
					if($element->id == "ebp_ws_report_content")
						$dwd_report = trim($element);
						//$dwd_report = strip_tags(trim($element));
				}

				print("<div id=\"message\">".$dwd_report."</div>");
			}
			else
			{
				print("<div id=\"message\">Aktueller Bericht vom DWD konnte nicht geladen werden!</div>");
			}

			print("</div>");
		print("</div>");
	}
?>