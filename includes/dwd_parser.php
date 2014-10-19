<?php
include dirname(__FILE__).'/../includes/simple_html_dom.php';
include dirname(__FILE__).'/../includes/dbconnection.php';
include dirname(__FILE__).'/../includes/getConfiguration.php';

if ($__CONFIG['dwd_region'] != "") {

$dwdsql = "SELECT dwd_warngebiet.region_id,land_id,karten_region FROM dwd_warngebiet
        INNER JOIN dwd_region
        ON dwd_warngebiet.region_id=dwd_region.region_id
        WHERE dwd_warngebiet.warngebiet_dwd_kennung = '".$__CONFIG['dwd_region']."' LIMIT 1;";
$dwdresult = mysql_query($dwdsql);
$dwd_region = mysql_fetch_object($dwdresult);


/* **************************
   DWD Warnlagebericht für die Region
   ************************** */
  $dwd_region_report_warning = "";
  $dwd_region_report0 = "";

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


/* **************************
   DWD Wetterwarnung für den Kreis
   ************************** */

  $html = file_get_html("http://www.wettergefahren.de/dyn/app/ws/html/reports/".$__CONFIG['dwd_region']."_warning_de.html");

  $dwd_warnung = "";
  $dwd_name_landkreis = " ";

  if (strlen($html) > 0) {
      foreach ($html->find('div') as $element) {
          if($element->id == "ebp_ws_warning_content")
              $dwd_warnung .= "<div id=\"aktiv\">".strip_tags(trim($element))."</div>";
      }

      foreach ($html->find('h1') as $element) {
          if ($element->class == "app_ws_headline") {
            $tmp = trim(strip_tags($element));
            $dwd_name_landkreis = " für ".trim(explode("-", $tmp)[1], 1)." ";
          }
      }
  } else {
      $dwd_warnung = "DWD Wetterwarnung konnten nicht geladen werden!";
  }

  if(strlen($dwd_warnung) == 0)
      $dwd_warnung = "Es liegt aktuell keine Warnung".$dwd_name_landkreis."vor.";


/* **************************
   DWD Wettervorhersage für die Region
   ************************** */
  if (isset($dwd_region->karten_region) && isset($dwd_region->land_id)) {
    $land = strtolower($dwd_region->land_id);
    if ($land == "ns")
      $land = "ni_hb";
    if ($land == "hb")
      $land = "ni_hb";
    if ($land == "sh")
      $land = "sh_hh";
    if ($land == "hh")
      $land = "sh_hh";
    if ($land == "bb")
      $land = "bb_be";
    if ($land == "bl")
      $land = "bb_be";
    if ($land == "sa")
      $land = "st";
    if ($land == "rp")
      $land = "rp_sl";
    if ($land == "sl")
      $land = "rp_sl";

    $html0 = file_get_html("http://www.wettergefahren.de/wetter/region/".strtolower($dwd_region->karten_region)."/heute/bericht_".$land.".html");
    $html1 = file_get_html("http://www.wettergefahren.de/wetter/region/".strtolower($dwd_region->karten_region)."/morgen/bericht_".$land.".html");
    $html2 = file_get_html("http://www.wettergefahren.de/wetter/region/".strtolower($dwd_region->karten_region)."/ueberm/bericht_".$land.".html");

    for ($i = "0"; $i < "3"; $i++) {
      if (strlen(${"html".$i}) > 0) {

        for ($i2 = "0"; $i2 < "10"; $i2++) {
          if (strpos(${"html".$i}->find('p', $i2), "Letzte Aktualisierung")) {
            break;
          } else {
            $dwd_region_report[$i] .= "<p>".trim(strip_tags(${"html".$i}->find('p', $i2)))."</p>";
          }
        }

      }
    }
  }
  if(strlen($dwd_region_report[0]) == 0)
    $dwd_region_report[0] = "-";
  if(strlen($dwd_region_report[1]) == 0)
    $dwd_region_report[1] = "-";
  if(strlen($dwd_region_report[2]) == 0)
    $dwd_region_report[2] = "-";


}
