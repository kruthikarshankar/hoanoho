<?php
$HOANOHO_DIR = exec('. /etc/environment; echo $HOANOHO_DIR');
require($HOANOHO_DIR."/config/dbconfig.inc.php");
include($HOANOHO_DIR."/includes/simple_html_dom.php");
include($HOANOHO_DIR."/includes/pushover.php");

$dbh = mysql_connect($dbhostname,$dbusername,$dbpassword) or die("Could not connect to database server, please check servername and credentials.");
$dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the database, please check database name.");

$sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";
$result = mysql_query($sql);

$__CONFIG = array();

while ($row = mysql_fetch_array($result)) {
    $__CONFIG[$row[0]] = $row[1];
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
            $dwd_warnung .= strip_tags(trim($element));
    }

    foreach ($html->find('h1') as $element) {
        if($element->class == "app_ws_headline") {
          $tmp = strip_tags(trim($element));
          $dwd_name_landkreis = " für ".trim(explode("-", $tmp)[1], 1);
        }
    }
}

$sql = "SELECT data from cron_data where name = 'dwd_warning'";
$result2 = mysql_query($sql);
$resultObj2 = null;
if(mysql_num_rows($result2) > 0)
    $resultObj2 = mysql_fetch_object($result2);

// nur wenn sich die warnung geändert hat
if ($resultObj2 != null && strlen($resultObj2->data) != strlen($dwd_warnung)) {
    if (strlen($dwd_warnung) > 0) {
        pushMessageToUsers("Geänderte Wetterwarnung".$dwd_name_landkreis, $dwd_warnung, 1);
    } else {
        pushMessageToUsers("Entwarnung", "Es liegt keine Wetterwarnung mehr".$dwd_name_landkreis." vor.", 0);
    }

    $sql = "DELETE FROM cron_data where name = 'dwd_warning'";
    mysql_query($sql);
    $sql = "INSERT INTO cron_data (name, data) values ('dwd_warning','".$dwd_warnung."')";
    mysql_query($sql);
} elseif ($resultObj2 == null) {
    $sql = "DELETE FROM cron_data where name = 'dwd_warning'";
    mysql_query($sql);
    $sql = "INSERT INTO cron_data (name, data) values ('dwd_warning','".$dwd_warnung."')";
    mysql_query($sql);

    if (strlen($dwd_warnung) > 0) {
        pushMessageToUsers("Neue Wetterwarnung".$dwd_name_landkreis, $dwd_warnung, 1);
    }
}

function pushMessageToUsers($title, $message, $priority)
{
    $sql ="select * from users join usersettings on usersettings.uid = users.uid where pushover_usertoken is not null and pushover_apptoken is not null";
    $result = mysql_query($sql);

    while ($row = mysql_fetch_array($result)) {
        pushMessage($row['pushover_apptoken'], $row['pushover_usertoken'], $title, $message, $priority);
    }
}
?>
