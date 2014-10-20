<?php
$HOANOHO_DIR = exec('. /etc/environment; echo $HOANOHO_DIR');
require			$HOANOHO_DIR."/config/dbconfig.inc.php";
require_once 	$HOANOHO_DIR.'/includes/fritzbox_api/fritzbox_api.class.php';
include 		$HOANOHO_DIR."/includes/pushover.php";

	## functions ##
function pushMessageToUsers($title, $message, $priority)
{
	global $mysqli;
	$sql ="select * from users join usersettings on usersettings.uid = users.uid where pushover_usertoken is not null and pushover_apptoken is not null";
	$result = $mysqli->query($sql);

	while ($row = $result->fetch_array()) {
		pushMessage($row['pushover_apptoken'], $row['pushover_usertoken'], $title, $message, $priority);
	}
}

	## Datenbank ##
$mysqli = new mysqli($dbhostname, $dbusername, $dbpassword, $dbname);
$mysqli->set_charset('utf8');
if (mysqli_connect_errno($mysqli))
{
	die("Failed to connect to MySQL: " . mysqli_connect_error());
}

	## get fritzbox calllist ##
try
{
	$fritz = new fritzbox_api();
	$params = array(
		'getpage' => '/fon_num/foncalls_list.lua',
		'csv' => '',
	);
	$output = $fritz->doGetRequest($params);

	$output = explode("\n", $output);
	unset($output[0]); // delet : sep=;
	unset($output[1]); // delet : Typ;Datum;Name;Rufnummer;Nebenstelle;Eigene Rufnummer;Dauer
}
catch (Exception $e)
{
	die("Error: The phone list could not be downloaded");
}
	## delet all entrys ##
$mysqli->query("TRUNCATE TABLE callerlist");

	## entrys go to mysql ##
$i=0;
foreach ($output as $line_number => $line)
{
	$i++;
	## limit 50 entrys ##
	if($i > 52) break;

	list($typ,$date,$name,$number,$fon,$own_number,$duration) = explode(';', $line);
	if(isset($insert))
	{
		$insert .= ",\n";
	}else{
		$insert = null;
	}
	$insert .= "(";
	$insert .= "'$typ',";
	$insert .= "STR_TO_DATE('".$date."', '%d.%m.%y %H:%i'),";
	$insert .= "'$name',";
	$insert .= "'$number',";
	$insert .= "'$fon',";
	$insert .= "'$own_number',";
	$insert .= "'$duration'";
	$insert .= ")";

}
$sql = "INSERT INTO callerlist (typ,date,name,rufnummer,nebenstelle,eigenerufnummer,dauer) VALUES \n" . $insert;
$mysqli->query($sql);

	## pushover notification ##
$result = $mysqli->query("select name,rufnummer,date from callerlist where date >= date_sub(NOW(), interval 10 MINUTE) and typ = 2");
while ($row = $result->fetch_object()) {
	if(empty($row->name))
	{
		$message = $row->rufnummer;
	}else{
		$message = $row->name." (".$row->rufnummer.")";
	}
	pushMessageToUsers("Neuer verpasster Anruf", $message, 0);
}