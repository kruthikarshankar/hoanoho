<?php
// description: http://openweathermap.org/weather-data

$HOANOHO_DIR = exec('. /etc/environment; echo $HOANOHO_DIR');
require($HOANOHO_DIR."/config/dbconfig.inc.php");

function parseData($key,$in)
{
    global $timestamp;
    $sql = "";

    $_key = $key;
    if (is_object($in) || is_array($in)) {
        foreach ($in as $key => $value) {
            if(!empty($_key))
                $key = $_key.".".$key;
            $sql .= parseData($key,$value);
        }
    } else {
        if(stristr($_key, "speed") != false)
            $in = $in*3.6;

        if(is_float($in))
            $in = round($in, 1);

        if (isset($_key) && $_key != "")
          return "insert into openweathermap set measuredate = ".$timestamp.", weatherkey = '".$_key."', weathervalue = '".$in."';";
    }

    return $sql;
}

// Connect to the database
// replace "user_name" and "password" with your real login info
$dbh = mysql_connect($dbhostname,$dbusername,$dbpassword) or die("Could not connect to database server, please check servername and credentials.");
$dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the database, please check database name.");
$sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";
$result = mysql_query($sql);

$__CONFIG = array();

while ($row = mysql_fetch_array($result)) {
    $__CONFIG[$row[0]] = $row[1];
}

// current weather
if ($__CONFIG['position_latitude'] != "" && $__CONFIG['position_longitude'] != "") {
  $latitude = $__CONFIG['position_latitude'];
  $longitude = $__CONFIG['position_longitude'];
  $timestamp = time();

  $url = 'http://api.openweathermap.org/data/2.5/weather?lat='.$latitude.'&lon='.$longitude.'&lang=de&units=metric';
  $curl = curl_init();
  $headers = array();
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_HEADER, 0);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_TIMEOUT, 30);
  curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0");
  $json = curl_exec($curl);
  curl_close($curl);
  $data = json_decode($json);
  print_r($data);

  // parse and insert data
  $parsedData = parseData(null,$data);
  if ($parsedData != "") {
    $parsedData = explode(';', $parsedData);

    foreach ($parsedData as $query) {
        mysql_query($query);
    }
  }

} else {
  // delete old data
  mysql_query("TRUNCATE TABLE openweathermap;");
}
?>
