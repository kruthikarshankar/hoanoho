<?

include dirname(__FILE__).'/../includes/dbconnection.php';
include dirname(__FILE__).'/../includes/sessionhandler.php';

if(isset($_GET['id']) && isset($_GET['pos_x']) && isset($_GET['pos_y']))
{
	

	$sql = "update devices set pos_x = '" . $_GET['pos_x'] . "', pos_y = '" . $_GET['pos_y'] . "' where dev_id = " . $_GET['id'];

	mysql_query($sql);
}

?>