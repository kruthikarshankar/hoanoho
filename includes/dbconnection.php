<?php

require(dirname(__FILE__)."/../config/dbconfig.inc.php");

// Connect to the database
// replace "user_name" and "password" with your real login info

$dbh = mysql_connect($dbhostname,$dbusername,$dbpassword) or die("Could not connect to database server, please check servername and credentials.");
$dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the database, please check database name.");

?>
