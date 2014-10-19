<?php
    include dirname(__FILE__).'/../../includes/simple_html_dom.php';
    include dirname(__FILE__).'/../../includes/dbconnection.php';
    include dirname(__FILE__).'/../../includes/getConfiguration.php';

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
                                    'rain.3h',
                                    'wind.speed',
                                    'wind.deg',
                                    'clouds.all'
                                   );

        $sql = "select * from openweathermap where measuredate = (select measuredate from openweathermap group by measuredate order by measuredate desc limit 1)";
        $weather_result = mysql_query($sql);
        while ($row = mysql_fetch_object($weather_result)) {
            if (in_array($row->weatherkey, $weatherSelectKeys)) {
                // add wind direction
                if ($row->weatherkey == 'wind.deg') {
                  if ($row->weathervalue < 22.5) {
                    $wdir = "Nord";
                  } elseif ($row->weathervalue < 45) {
                    $wdir = "Nord-Nordost";
                  } elseif ($row->weathervalue < 67.5) {
                    $wdir = "Nord-Ost";
                  } elseif ($row->weathervalue < 90) {
                    $wdir = "Ost";
                  } elseif ($row->weathervalue < 112.5) {
                    $wdir = "Ost-Südost";
                  } elseif ($row->weathervalue < 135) {
                    $wdir = "Südost";
                  } elseif ($row->weathervalue < 157.5) {
                    $wdir = "Süd-Südost";
                  } elseif ($row->weathervalue < 180) {
                    $wdir = "Süd";
                  } elseif ($row->weathervalue < 202.5) {
                    $wdir = "Süd-Südwest";
                  } elseif ($row->weathervalue < 225) {
                    $wdir = "Südwest";
                  } elseif ($row->weathervalue < 247.5) {
                    $wdir = "West-Südwest";
                  } elseif ($row->weathervalue < 270) {
                    $wdir = "West";
                  } elseif ($row->weathervalue < 292.5) {
                    $wdir = "West-Nordwest";
                  } elseif ($row->weathervalue < 315) {
                    $wdir = "Nordwest";
                  } elseif ($row->weathervalue < 337.5) {
                    $wdir = "Nord-Nordwest";
                  } elseif ($row->weathervalue < 361) {
                    $wdir = "Nord";
                  }

                    $in_arr['wind.dir'] = $wdir;
                }

                $in_arr[$row->weatherkey] = $row->weathervalue;
            } else {
                $in_arr[$row->weatherkey] = "-";
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
                if (in_array($row->weatherkey, $weatherSelectKeys)) {
                    $explode = explode(".", $row->weatherkey);
                    // add wind direction
                    if ($explode[2] == 'deg') {
                      if ($row->weathervalue < 22.5) {
                        $wdir = "Nord";
                      } elseif ($row->weathervalue < 45) {
                        $wdir = "Nord-Nordost";
                      } elseif ($row->weathervalue < 67.5) {
                        $wdir = "Nord-Ost";
                      } elseif ($row->weathervalue < 90) {
                        $wdir = "Ost";
                      } elseif ($row->weathervalue < 112.5) {
                        $wdir = "Ost-Südost";
                      } elseif ($row->weathervalue < 135) {
                        $wdir = "Südost";
                      } elseif ($row->weathervalue < 157.5) {
                        $wdir = "Süd-Südost";
                      } elseif ($row->weathervalue < 180) {
                        $wdir = "Süd";
                      } elseif ($row->weathervalue < 202.5) {
                        $wdir = "Süd-Südwest";
                      } elseif ($row->weathervalue < 225) {
                        $wdir = "Südwest";
                      } elseif ($row->weathervalue < 247.5) {
                        $wdir = "West-Südwest";
                      } elseif ($row->weathervalue < 270) {
                        $wdir = "West";
                      } elseif ($row->weathervalue < 292.5) {
                        $wdir = "West-Nordwest";
                      } elseif ($row->weathervalue < 315) {
                        $wdir = "Nordwest";
                      } elseif ($row->weathervalue < 337.5) {
                        $wdir = "Nord-Nordwest";
                      } elseif ($row->weathervalue < 361) {
                        $wdir = "Nord";
                      }

                        $forecast_day[$explode[0].".".$explode[1].'.dir'] = $wdir;
                    }

                    $forecast_day[$row->weatherkey] = $row->weathervalue;
                } else {
                    $forecast_day[$row->weatherkey] = "-";
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

    if ($_GET['cmd'] == 'refresh_weather_for_header') {
        $weather = array();
        $weather['ws_available'] = false;

        $weather = array_merge($weather, getCurrentOpenWeatherMapData($weather));
        $weather = array_merge($weather, getCurrentWeatherDataFromLocalStation($weather));

        if (count($weather) > 1) {
          $weathericon = "null";
          if(strlen($weather['weather.0.icon']) > 0)
              $weathericon = $weather['weather.0.icon'];

          $relPath = "../";
          if (isset($_GET['relPath']) && $_GET['relPath'])
            $relPath = urldecode($_GET['relPath']);

          echo "<img src=\"".$relPath."img/weather/openweathermap/".$weathericon.".png\">".$weather['weather.0.description']." ".$weather['main.temp']. " °C";
        }
    }

    if ($_GET['cmd'] == 'refresh_current_weather') {
        $weather = array();
        $weather['ws_available'] = false;

        $weather = array_merge($weather, getCurrentOpenWeatherMapData($weather));
        $weather = array_merge($weather, getCurrentWeatherDataFromLocalStation($weather));

        if (count($weather) > 1) {
          $sunrise = date('H:i',$weather['sys.sunrise']);
          $sunset = date('H:i',$weather['sys.sunset']);

          $weathericon = "null";
          if(strlen($weather['weather.0.icon']) > 0)
              $weathericon = $weather['weather.0.icon'];

          print("<div id=\"title\"><img src=\"../img/weather/openweathermap/".$weathericon.".png\">Aktuelle Wetterlage</div>");
          print("<div style=\"position: absolute; width: 98%;\"><div id=\"icon\"></div></div>");
          print("<div id=\"rows_left\">");
              print("<div id=\"row_\">");
                  print("<div id=\"text\">Beschreibung:</div><div id=\"value\">".$weather['weather.0.description']."</div>");
              print("</div>");
              print("<div id=\"row_\">&nbsp;</div>");
              print("<div id=\"row_\">");
                  print("<div id=\"text\">Temperatur:</div><div id=\"value\">".($weather['ws_available'] == true ? $weather['ws_OT']."°C  (".$weather['ws_WC']." °C gefühlt)" : $weather['main.temp']." °C")."</div>");
              print("</div>");
              print("<div id=\"row_\">");
                  print("<div id=\"text\">Temperatur Minimum:</div><div id=\"value\">".$weather['main.temp_min']." °C</div>");
              print("</div>");
              print("<div id=\"row_\">");
                  print("<div id=\"text\">Temperatur Maximum:</div><div id=\"value\">".$weather['main.temp_max']." °C</div>");
              print("</div>");
              print("<div id=\"row_\">&nbsp;</div>");
              if ($weather['ws_available'] == true) {
                  print("<div id=\"row_\">");
                      print("<div id=\"text\">Regenmenge pro Stunde:</div><div id=\"value\">".$weather['ws_Rain1h']." l/qm</div>");
                  print("</div>");
                  print("<div id=\"row_\">");
                      print("<div id=\"text\">Regenmenge pro Tag:</div><div id=\"value\">".$weather['ws_Rain24h']." l/qm</div>");
                  print("</div>");
                  print("<div id=\"row_\">&nbsp;</div>");
              } else {
                  print("<div id=\"row_\">");
                      print("<div id=\"text\">Regenmenge:</div><div id=\"value\">".(isset($weather['rain.3h']) ? $weather['rain.3h'] : "0")." l/qm</div>");
                  print("</div>");
              }
              print("<div id=\"row_\">");
                  print("<div id=\"text\">Bewölkung:</div><div id=\"value\">".$weather['clouds.all']." %</div>");
              print("</div>");
              print("<div id=\"row_\">");
                  print("<div id=\"text\">Luftfeuchtigkeit:</div><div id=\"value\">".($weather['ws_available'] == true ? $weather['ws_OH'] : $weather['main.humidity'])." %</div>");
              print("</div>");
              print("<div id=\"row_\">");
                  print("<div id=\"text\">Luftdruck:</div><div id=\"value\">".($weather['ws_available'] == true ? $weather['ws_P'] : $weather['main.pressure'])." hPa</div>");
              print("</div>");
              print("<div id=\"row_\">&nbsp;</div>");
              print("<div id=\"row_\">");
                  print("<div id=\"text\">Windgeschwindigkeit:</div><div id=\"value\">".($weather['ws_available'] == true ? $weather['ws_Wind'] : $weather['wind.speed'])." km/h</div>");
              print("</div>");
              print("<div id=\"row_\">");
                  print("<div id=\"text\">Windrichtung:</div><div id=\"value\">".($weather['ws_available'] == true ? $weather['ws_WindDir'] : $weather['wind.dir'])."</div>");
              print("</div>");
              print("<div id=\"row_\">&nbsp;</div>");
              print("<div id=\"row_\">");
                  print("<div id=\"text\">Sonnenaufgang:</div><div id=\"value\">".$sunrise." Uhr</div>");
              print("</div>");
              print("<div id=\"row_\">");
                  print("<div id=\"text\">Sonnenuntergang:</div><div id=\"value\">".$sunset." Uhr</div>");
              print("</div>");
          print("</div>");

        } else {
          print("<div id=\"title\">Aktuelle Wetterlage</div>");
          print("<div style=\"position: absolute; width: 98%;\"><div id=\"icon\"></div></div>");
        }

        print("<div id=\"rows_right\">");

        if ($__CONFIG['dwd_region'] != "") {
            $dwd = "SELECT dwd_warngebiet.region_id, dwd_region.region_name, dwd_region.karten_region
                    FROM dwd_warngebiet
                    INNER JOIN dwd_region
                    ON dwd_warngebiet.region_id=dwd_region.region_id
                    WHERE dwd_warngebiet.warngebiet_dwd_kennung = '".$__CONFIG['dwd_region']."' LIMIT 1;";
            $dwdresult = mysql_query($dwd);
            $dwdregion = mysql_fetch_object($dwdresult);

          if (isset($dwdregion->karten_region)) {
            print("<div id=\"image\"><img src=\"http://www.wettergefahren.de/wundk/wetter/de/".$dwdregion->karten_region.".jpg\"></div>");
          } else {
            print("<div id=\"image\"><img src=\"http://www.wettergefahren.de/wundk/wetter/de/Deutschland.jpg\"></div>");
          }
        } else {
          print("<div id=\"image\"><img src=\"http://www.wettergefahren.de/wundk/wetter/de/Deutschland.jpg\"></div>");
        }

        print("</div>");
    }

    if ($_GET['cmd'] == 'refresh_weather_forecast') {
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

        if (is_array($forecast) && count($forecast[0]) > 0) {

          print("<div id=\"title\">Vorhersage</div>");
          print("<div style=\"position: absolute; width: 98%;\"><div id=\"icon\"></div></div>");

          for ($i=0; $i < $forecast_days; $i++) {
            if (is_array($forecast[$i]) && count($forecast[$i]) > 0) {
              $weathericon = "null";
              if(strlen($forecast[$i]['list.'.$i.'.weather.0.icon']) > 0)
                  $weathericon = $forecast[$i]['list.'.$i.'.weather.0.icon'];

              print("<div id=\"forecast_".$i."\">");
                  print("<div id=\"title\"><img src=\"../img/weather/openweathermap/".$weathericon.".png\">".$days_relative[$i] . " (".$days[$i].")</div>");
                  print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
                  print("<div id=\"text\">Beschreibung:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.weather.0.description']."</div>");
                  print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
                  print("<div id=\"text\">Temperatur Morgens:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.morn']." °C</div>");
                  print("<div id=\"text\">Temperatur Tagsüber:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.day']." °C</div>");
                  print("<div id=\"text\">Temperatur Abends:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.eve']." °C</div>");
                  print("<div id=\"text\">Temperatur Nachts:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.night']." °C</div>");
                  print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
                  print("<div id=\"text\">Temperatur Minimum:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.min']." °C</div>");
                  print("<div id=\"text\">Temperatur Maximum:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.temp.max']." °C</div>");
                  print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
                  print("<div id=\"text\">Regenmenge:</div><div id=\"value\">".(isset($forecast[$i]['list.'.$i.'.rain']) ? $forecast[$i]['list.'.$i.'.rain'] : "0")." l/qm</div>");
                  print("<div id=\"text\">Bewölkung:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.clouds']." %</div>");
                  print("<div id=\"text\">Luftfeuchtigkeit:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.humidity']." %</div>");
                  print("<div id=\"text\">Luftdruck:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.pressure']." hPa</div>");
                  print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
                  print("<div id=\"text\">Windgeschwindigkeit:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.speed']." km/h</div>");
                  print("<div id=\"text\">Windrichtung:</div><div id=\"value\">".$forecast[$i]['list.'.$i.'.dir']."</div>");
                  print("<div id=\"text\">&nbsp;</div><div id=\"value\">&nbsp;</div>");
              print("</div>");
          }
        }
      }
    }

    if ($_GET['cmd'] == 'refresh_weather_report') {
      if ($__CONFIG['dwd_region'] != "") {
            print("<div id=\"title\">Warnlagebericht</div>");
            print("<div style=\"position: absolute; width: 98%;\"><div id=\"icon\"></div></div>");
            print("<div id=\"rows\">");

            $dwdsql = "SELECT dwd_warngebiet.region_id,land_id,karten_region FROM dwd_warngebiet
                    INNER JOIN dwd_region
                    ON dwd_warngebiet.region_id=dwd_region.region_id
                    WHERE dwd_warngebiet.warngebiet_dwd_kennung = '".$__CONFIG['dwd_region']."' LIMIT 1;";
            $dwdresult = mysql_query($dwdsql);
            $dwd_region = mysql_fetch_object($dwdresult);


            if (isset($dwd_region->region_id) && $dwd_region->region_id != "") {
              $html = file_get_html("http://www.wettergefahren.de/dyn/app/ws/html/reports/".$dwd_region->region_id."_report_de.html");

              if (strlen($html) > 0) {
                $tmp = explode(".", trim(strip_tags($html->find('p', '2'))));
                $dwd_region_report0 = $tmp[0].".";
                $dwd_region_report_warning = "<p>".trim(strip_tags($html->find('p', '2')))."</p>";
                $dwd_region_report_warning .= "<p><i>Entwicklung für die nächsten 24 Stunden</i></p>";

                for ($i = "4"; $i < "10"; $i++) {
                  if (strpos($html->find('p', $i), "Nächste Aktualisierung")) {
                    break;
                  } else {
                    $dwd_region_report_warning .= "<p>".trim(strip_tags($html->find('p', $i)))."</p>";
                  }
                }

              } else {
                  $dwd_region_report_warning = "<p>Aktueller DWD Warnlagebericht konnte nicht geladen werden.</p>";
              }
            }
            print("<div id=\"message\">".$dwd_region_report_warning."</div>");

            print("</div>");
        print("</div>");
      }
    }
