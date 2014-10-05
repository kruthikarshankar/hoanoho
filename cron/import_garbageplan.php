<?

	require("/var/www/hoanoho/config/dbconfig.inc.php");
		
	$dbh = mysql_connect("localhost",$dbusername,$dbpassword) or die("There was a problem with the database connection.");
	$dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the categories.");

	$sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";
	$result = mysql_query($sql);

	$__CONFIG = array();

	while($row = mysql_fetch_array($result)) {
		$__CONFIG[$row[0]] = $row[1];
	}

	if(strlen($__CONFIG['garbageplan_url']) == 0)
		exit;

	$planurl = $__CONFIG['garbageplan_url'];
	$planurl = str_replace("%YEAR", date('Y',time()), $planurl);

	$filetype = "";
	$file = "";


	if(strpos($planurl, ".ics"))
		$filetype = "ics";
	else {
		// check file content to determine filetype
		$file = file_get_contents($planurl);

		if(strstr(substr($file, 0, 20),"BEGIN:VCALENDAR"))
			$filetype = "ics";
	}

	if($filetype == "ics")
	{
		include '/var/www/hoanoho/includes/PhpICS/ICS/index.php';

		if($file == "")
			$file = file_get_contents($planurl);

		date_default_timezone_set('Europe/Paris');

		//$icalc = ICS\ICS::open($file);
		$icalc = ICS\ICS::load($file);

		// truncate database table
		if(strlen($icalc) > 0)
		{
			mysql_query("TRUNCATE TABLE garbageplan");

			foreach( $icalc as $event ) {
				mysql_query("INSERT INTO garbageplan (pickupdate, text) VALUES ('".$event->getDateStart('Y-m-d H:i:s')."','".utf8_decode($event->getSummary())."')");
			}
		}
	}

?>