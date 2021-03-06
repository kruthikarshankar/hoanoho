<?

// description: http://openweathermap.org/weather-data

require("/var/www/homie/config/dbconfig.inc.php");

function parseData($key,$in)
{
	global $timestamp;
	$sql = "";

	$_key = $key;
	if(is_object($in) || is_array($in)) {
		foreach($in as $key => $value) {
			if(!empty($_key))
				$key = $_key.".".$key;
			$sql .= parseData($key,$value);
		}
	} 
	else {
		if(stristr($_key, "speed") != false)
			$in = $in*3.6;

		if(is_float($in))
			$in = round($in, 1);

		return "insert into openweathermap_forecast set measuredate = ".$timestamp.", weatherkey = '".$_key."', weathervalue = '".$in."';";
	}

	return $sql;
}

// Connect to the database
// replace "user_name" and "password" with your real login info
$dbh = mysql_connect("localhost",$dbusername,$dbpassword) or die("There was a problem with the database connection.");
$dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the categories.");
$sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";
$result = mysql_query($sql);

$__CONFIG = array();

while($row = mysql_fetch_array($result)) {
    $__CONFIG[$row[0]] = $row[1];
}

$longitude = $__CONFIG['position_latitude'];
$latitude = $__CONFIG['position_longitude'];
$timestamp = time();

// forecast

$url = 'http://api.openweathermap.org/data/2.5/forecast/daily?lat='.$latitude.'&lon='.$longitude.'&lang=de&units=metric&cnt=3&rain&snow';
$curl = curl_init();
$headers = array();
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($curl, CURLOPT_HEADER, 0); 
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($curl, CURLOPT_URL, $url); 
curl_setopt($curl, CURLOPT_TIMEOUT, 30); 
$json = curl_exec($curl); 
curl_close($curl);
$data = json_decode($json);

// parse and insert data
$parsedData = parseData(null,$data);
$parsedData = explode(';', $parsedData);
// delete old data
mysql_query("truncate table openweathermap_forecast");
foreach ($parsedData as $query) {
	mysql_query($query);
}

?>