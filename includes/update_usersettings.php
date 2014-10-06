<?php

include dirname(__FILE__).'/../includes/dbconnection.php';

if (isset($_GET['uid']) && isset($_GET['backgroundimage'])) {
    $sql = "update usersettings set backgroundimage = '" . $_GET['backgroundimage'] . "' where uid = " . $_GET['uid'];

    mysql_query($sql);
}

?>
