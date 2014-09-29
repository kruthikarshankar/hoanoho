<?php
	include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnection.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/sessionhandler.php';


	if(isset($_POST['table_name']) && isset($_POST['constraint_column']) && isset($_POST['target_column']) && isset($_POST['target_id']) && isset($_POST['file_id']))
	{
		// delete current file from datastore
		$sql = "delete from bindata where binid = (select " . $_POST['target_column'] . " from " . $_POST['table_name'] . " where " . $_POST['constraint_column'] . " = " . $_POST['target_id'] . ")";
		mysql_query($sql);

		// associate new file
		$sql = "update " . $_POST['table_name'] . " set " . $_POST['target_column'] . " = " . $_POST['file_id'] . " where " . $_POST['constraint_column'] . " = " . $_POST['target_id'];
		mysql_query($sql);
	}
?>