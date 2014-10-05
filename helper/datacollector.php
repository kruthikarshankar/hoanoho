<?php
    require(dirname(__FILE__)."/../config/dbconfig.inc.php");

    $dbh = mysql_connect("localhost",$dbusername,$dbpassword) or die("There was a problem with the database connection.");
    $dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the categories.");

    $sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";
    $result = mysql_query($sql);

    $__CONFIG = array();

    while ($row = mysql_fetch_array($result)) {
        $__CONFIG[$row[0]] = $row[1];
    }

    if (isset($_POST['json'])) {
        $json_decoded = json_decode($_POST['json']);

        for ($i=0; $i < count($json_decoded->Values); $i++) {
            // insert only if value doesnt already exist
            $result = mysql_query("SELECT ddid from device_data where timestamp_unix = '".$json_decoded->Timestamp."' and valuename = '".utf8_decode(str_replace(".", "_", $json_decoded->Values[$i]->Name))."' and deviceident = '".utf8_decode($json_decoded->Name)."'");
            if(mysql_num_rows($result) == 0)
                mysql_query("INSERT INTO device_data (deviceident, timestamp_unix, timestamp, valuename, value, valueunit, year, month, day) VALUES ('".utf8_decode($json_decoded->Name)."', ".$json_decoded->Timestamp.", '".date("Y-m-d H:i:s", $json_decoded->Timestamp)."', '".utf8_decode(str_replace(".", "_", $json_decoded->Values[$i]->Name))."', '".$json_decoded->Values[$i]->Value."', '".utf8_decode($json_decoded->Values[$i]->Unit)."', ".date('Y', $json_decoded->Timestamp).", ".date('m', $json_decoded->Timestamp).", ".date('d', $json_decoded->Timestamp).")");
        }
    }
?>
