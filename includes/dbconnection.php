<?

require($_SERVER['DOCUMENT_ROOT']."/config/dbconfig.inc.php");

// Connect to the database
// replace "user_name" and "password" with your real login info

$dbh = mysql_connect($dbhostname,$dbusername,$dbpassword) or die("There was a problem with the database connection.");
$dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the categories.");

?>