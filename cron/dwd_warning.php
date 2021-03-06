<?
	require("/var/www/homie/config/dbconfig.inc.php");
	include "/var/www/homie/includes/simple_html_dom.php";
	include "/var/www/homie/includes/pushover.php";
	
	$dbh = mysql_connect("localhost",$dbusername,$dbpassword) or die("There was a problem with the database connection.");
	$dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the categories.");

	$sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";
	$result = mysql_query($sql);

	$__CONFIG = array();
	
	while($row = mysql_fetch_array($result)) {
		$__CONFIG[$row[0]] = $row[1];
	}

	/* ************************** 
	   DWD Wetterwarnung für den Kreis
	   ************************** */ 
	//$html = file_get_html("http://www.dwd.de/dyn/app/ws/html/reports/TUT_warning_de.html");
	$html = file_get_html($__CONFIG['dwd_url_landkreis']);

	$dwd_warnung = "";
	if(strlen($html) > 0)
	{
		foreach($html->find('div') as $element) 
		{
			if($element->id == "ebp_ws_warning_content")
				$dwd_warnung .= strip_tags(trim($element));
		}
	}

	$sql = "SELECT data from cron_data where name = 'dwd_warning'";
	$result2 = mysql_query($sql);
	$resultObj2 = null;
	if(mysql_num_rows($result2) > 0)
		$resultObj2 = mysql_fetch_object($result2);

	// nur wenn sich die warnung geändert hat
	if($resultObj2 != null && strlen($resultObj2->data) != strlen($dwd_warnung))
	{
		if(strlen(utf8_encode($dwd_warnung)) > 0)
		{
			pushMessageToUsers("Neue Wetterwarnung", $dwd_warnung, 1);
		}
		else
		{	
			pushMessageToUsers("Entwarnung", "Es liegt keine Wetterwarnung mehr vor.", 0);
		}

		$sql = "DELETE FROM cron_data where name = 'dwd_warning'";
		mysql_query($sql);
		$sql = "INSERT INTO cron_data (name, data) values ('dwd_warning','".$dwd_warnung."')";
		mysql_query($sql);
	}
	else if($resultObj2 == null)
	{
		$sql = "DELETE FROM cron_data where name = 'dwd_warning'";
		mysql_query($sql);
		$sql = "INSERT INTO cron_data (name, data) values ('dwd_warning','".$dwd_warnung."')";
		mysql_query($sql);

		if(strlen(utf8_encode($dwd_warnung)) > 0) {
			pushMessageToUsers("Neue Wetterwarnung", $dwd_warnung, 1);
		}
	}

	function pushMessageToUsers($title, $message, $priority)
	{
		$sql ="select * from users join usersettings on usersettings.uid = users.uid where pushover_usertoken is not null and pushover_apptoken is not null";
		$result = mysql_query($sql);

		while($row = mysql_fetch_array($result)) 
		{
			pushMessage($row['pushover_apptoken'], $row['pushover_usertoken'], $title, $message, $priority);
		}
	}
?>