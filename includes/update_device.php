<?

include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnection.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/sessionhandler.php';

if(isset($_GET['id']) && isset($_GET['pos_x']) && isset($_GET['pos_y']))
{
	

	$sql = "update devices set pos_x = '" . $_GET['pos_x'] . "', pos_y = '" . $_GET['pos_y'] . "' where dev_id = " . $_GET['id'];

	mysql_query($sql);
}

?>