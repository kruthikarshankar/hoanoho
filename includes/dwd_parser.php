<?php
    include dirname(__FILE__).'/../includes/simple_html_dom.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';

    /* **************************
       DWD Wetterreport für das Bundesland
       ************************** */
    if ($__CONFIG['dwd_region'] != "") {
      $dwdsql = "SELECT region_id FROM dwd_warngebiet WHERE warngebiet_dwd_kennung = '".$__CONFIG['dwd_region']."' LIMIT 1;";
      $dwdresult = mysql_query($dwdsql);
      $dwd_region = mysql_fetch_object($dwdresult);

      if (isset($dwd_region->region_id) && $dwd_region->region_id != "") {
        $html = file_get_html("http://www.dwd.de/dyn/app/ws/html/reports/".$dwd_region->region_id."_report_de.html");

        if (strlen($html) > 0) {
            foreach ($html->find('div') as $element) {
                if($element->id == "ebp_ws_report_content")
                    $dwd_report = trim($element);
                    //$dwd_report = strip_tags(trim($element));
            }
        } else {
            $dwd_report = "Aktueller Bericht vom DWD konnte nicht geladen werden!";
        }
      }
    }

    /* **************************
       DWD Wetterwarnung für den Kreis
       ************************** */

    if ($__CONFIG['dwd_region'] != "") {
      $html = file_get_html("http://www.dwd.de/dyn/app/ws/html/reports/".$__CONFIG['dwd_region']."_warning_de.html");

      $dwd_warnung = "";
      $dwd_name_landkreis = " ";

      if (strlen($html) > 0) {
          foreach ($html->find('div') as $element) {
              if($element->id == "ebp_ws_warning_content")
                  $dwd_warnung .= "<div id=\"aktiv\">".strip_tags(trim($element))."<br></div>";
          }

          foreach ($html->find('h1') as $element) {
              if($element->class == "app_ws_headline") {
                $tmp = strip_tags(trim($element));
                $dwd_name_landkreis = " für ".trim(explode("-", $tmp)[1], 1)." ";
              }
          }
      } else {
          $dwd_warnung = "Warnungen vom DWD konnten nicht geladen werden!";
      }

      if(strlen($dwd_warnung) == 0)
          $dwd_warnung = "Es liegt aktuell keine Warnung".$dwd_name_landkreis."vor.";
    }
