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
  $dwd_warnung_kurz = "";
  $dwd_name_landkreis = " ";

  if (strlen($html) > 0) {

      $dwd_warning_headline = trim(strip_tags($html->find('h1[class=app_ws_headline]', '0')));
      if (strpos($dwd_warning_headline, "Es ist") !== FALSE || strpos($dwd_warning_headline, "Es sind") !== FALSE) {
        $warning_no = explode(" ", $dwd_warning_headline)[2];

        $p = 0;
        for ($i = "0"; $i < $warning_no; $i++) {
          $dwd_warnung_farbe = explode(":", $html->find('div[class=app_ws_warning_content_text]', $i)->style)[1];

          if ($i == 0) {
            if ($dwd_warnung_farbe != "") {
              $dwd_warnung_kurz = "<p id=\"aktiv\" style=\"color:$dwd_warnung_farbe\">";
            } else {
              $dwd_warnung_kurz = "<p id=\"aktiv\">";
            }
            $dwd_warnung = "<img src=\"http://www.wettergefahren.de/dyn/app/ws/maps/".$__CONFIG['dwd_region']."_timeline.png\" width=\"100%\" /><br /><br />";
          }

          if ($i > 0) {
            $dwd_warnung_kurz .= "<br />";
            $dwd_warnung .= "<p></p>";
          }

          $dwd_warnung_kurz .= trim(strip_tags($html->find('p', $p)));

          if ($dwd_warnung_farbe != "") {
            $dwd_warnung .= "<p id=\"aktiv\" style=\"color:$dwd_warnung_farbe\">".trim(strip_tags($html->find('p', $p)))."</p>";
          } else {
            $dwd_warnung .= "<p id=\"aktiv\">".trim(strip_tags($html->find('p', $p)))."</p>";
          }

          $dwd_warnung .= "<p>".trim(strip_tags($html->find('p', $p+6)))."<br />".trim(strip_tags($html->find('p', $p+7)))."</p>";

          $p = $p+9;
        }
        $dwd_warnung_kurz .= "</p>";

      } else {
        $dwd_name_landkreis = " für ".explode("-", $dwd_warning_headline, 2)[1] . " ";
        $dwd_warnung_kurz = "<p>Es liegt aktuell keine Warnung".$dwd_name_landkreis."vor.</p>";
        $dwd_warnung = "<p>Es liegt aktuell keine Warnung".$dwd_name_landkreis."vor.</p>";
      }

  } else {
    $dwd_warnung_kurz = "<p>DWD Wetterwarnung konnten nicht geladen werden!</p>";
    $dwd_warnung = "<p>DWD Wetterwarnung konnten nicht geladen werden!</p>";
  }


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
