<?php
	// This file has to be included _AFTER_ the css declaration of the fatherdocument because it may overwrite global css strings

	include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnection.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/sessionhandler.php';
	
	$sql = "select * from usersettings where uid = " . $_SESSION['uid'];
	$result = mysql_query($sql);

	$__USERCONFIG = array();
	while($row = mysql_fetch_assoc($result)) {
		// backgroundimage
		print("<style type=\"text/css\">");
		print("body { background-image: url('" . $row['backgroundimage'] . "'); }");
		print("</style>");
	}
?>