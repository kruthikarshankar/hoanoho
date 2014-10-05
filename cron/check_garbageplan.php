<?
$HOANOHO_DIR = exec('. /etc/environment; echo $HOANOHO_DIR');
require($HOANOHO_DIR."/config/dbconfig.inc.php");
include($HOANOHO_DIR."/includes/pushover.php");

$dbh = mysql_connect("localhost",$dbusername,$dbpassword) or die("There was a problem with the database connection.");
$dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the categories.");


function pushMessageToUsers($title, $message, $priority)
{
	$sql ="select * from users join usersettings on usersettings.uid = users.uid where pushover_usertoken is not null and pushover_apptoken is not null";
	$result = mysql_query($sql);

	while($row = mysql_fetch_array($result)) 
	{
		pushMessage($row['pushover_apptoken'], $row['pushover_usertoken'], $title, $message, $priority);
	}
}


$sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";
$result = mysql_query($sql);

$__CONFIG = array();

while($row = mysql_fetch_array($result)) {
	$__CONFIG[$row[0]] = $row[1];
}


$result = mysql_query("select pickupdate,text from garbageplan where date(NOW()) = pickupdate -INTERVAL 1 DAY");
while ($pickup = mysql_fetch_object($result)) 
{
	$message = utf8_encode($pickup->text);
	$message = explode(":",utf8_encode($pickup->text))[0];

	pushMessageToUsers("Erinnerung: Abfall bereitstellen", $message, 0);
}
?>