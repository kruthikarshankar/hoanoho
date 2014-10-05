<?php
	include dirname(__FILE__).'/..//includes/dbconnection.php';

	$sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";
	$result = mysql_query($sql);

	$__CONFIG = array();
	
	while($row = mysql_fetch_array($result)) {
		$__CONFIG[$row[0]] = $row[1];
	}
?>