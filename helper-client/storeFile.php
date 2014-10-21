<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/sessionhandler.php';

    if (isset($_POST['data'])) {
        $imagedata = addslashes(base64_decode(split(',',$_POST['data'])[1]));

        // insert new image
        $sql = "INSERT INTO bindata set data = '" . $imagedata . "'";
        mysql_query($sql);
        echo mysql_insert_id();
    }
