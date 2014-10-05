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

	$today = substr(date('D',time()),0,2);

	// tage ins deutsche übersetzen
	switch ($today) {
		case 'Tu':
			$today = "Di";
			break;
		case 'We':
			$today = "Mi";
			break;
		case 'Th':
			$today = "Do";
			break;
		case 'Su':
			$today = "So";
			break;
	}

	$sql = "SELECT scheduler.interval_time, scheduler.dev_state, devices.dev_id, devices.identifier, types.name basetype from scheduler left join devices on devices.dev_id = scheduler.dev_id join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id where scheduler.isActive = 1 and scheduler.days like '%" . $today . "%'";
	$result = mysql_query($sql);

	while ($task = mysql_fetch_object($result)) 
	{
		$time_interval = $task->interval_time;
		if($task->interval_time == "SAUF")
			$time_interval = date_sunrise(time(), SUNFUNCS_RET_STRING, $__CONFIG['position_longitude'], $__CONFIG['position_latitude'], 90+5/6, date("O")/100);
		else if($task->interval_time == "SUNT")
			$time_interval = date_sunset(time(), SUNFUNCS_RET_STRING, $__CONFIG['position_longitude'], $__CONFIG['position_latitude'], 90+5/6, date("O")/100);


		if($time_interval == date('H:i',time()))
		{	
			if($task->basetype == "Raspberry Pi GPIO")
			{
				$configResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'gpio_raspi_protocol' and dev_id = " . $task->dev_id));
				$raspi_protocol = $configResult['value'];

				$configResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'gpio_raspi_address' and dev_id = " . $task->dev_id));
				$raspi_address = $configResult['value'];

				$configResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'gpio_outputpin' and dev_id = " . $task->dev_id));
				$raspi_output_pin = $configResult['value'];

				// TODO: check if call is localhost then do call without wrapper
				$url = $__CONFIG['homie_baseurl']."/helper/gpio_wrapper.php?cmd=set&protocol=".$raspi_protocol."&remote_addr=".$raspi_address."&pin=".$raspi_output_pin."&value=".$task->dev_state."&identifier=".$task->identifier;
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_exec($curl);
				curl_close($curl);
			}
			else
			{
				$reading = "";

				switch ($task->basetype) {
					case 'Jalousie':
						$reading = "pct";
						break;
					case 'Temperaturregelung':
						$reading = "desired-temp";
						break;
					default:
						break;
				}

				if($reading != "")
					fopen($__CONFIG['homie_baseurl']."/includes/fhem.php?cmd=set&device=".$task->identifier."&value=".$task->dev_state."&reading=".$reading, "r");
				else
					fopen($__CONFIG['homie_baseurl']."/includes/fhem.php?cmd=set&device=".$task->identifier."&value=".$task->dev_state, "r");
			}	
		}
	}
?>