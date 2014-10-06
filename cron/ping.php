<?php
$HOANOHO_DIR = exec('. /etc/environment; echo $HOANOHO_DIR');
require($HOANOHO_DIR."/config/dbconfig.inc.php");

$dbh = mysql_connect($dbhostname,$dbusername,$dbpassword) or die("There was a problem with the database connection.");
$dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the categories.");

$sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";
$result = mysql_query($sql);

$__CONFIG = array();

while ($row = mysql_fetch_array($result)) {
    $__CONFIG[$row[0]] = $row[1];
}

$sql = "select count(nd_id) count from network_devices";
$result = mysql_unbuffered_query($sql);
$count = mysql_fetch_array($result);

if(trim($__CONFIG['dhcp_lease_file']) != "")
    exec("cat ".trim($__CONFIG['dhcp_lease_file']), $leases);

for ($i = 1; $i <= $count[0]; $i++) {
    $sql = "select nd_id, ip, macaddr from network_devices limit " . $i . ",1";
    $result = @mysql_unbuffered_query($sql);
    $resultArr = @mysql_fetch_assoc($result);

    if ($resultArr["ip"] != "DHCP" && $resultArr["ip"] != "") {
        $exec_result = shell_exec('ping -c 1 ' . $resultArr["ip"] . ' | grep transmitted');
        if(stristr($exec_result,"1 received"))
            @mysql_query("update network_devices set state = 1, ip_dhcp = null where nd_id = " . $resultArr["nd_id"]);
        else
            @mysql_query("update network_devices set state = 0, ip_dhcp = null where nd_id = " . $resultArr["nd_id"]);
    } else {
        if (trim($__CONFIG['dhcp_lease_file']) != "" && trim($resultArr["macaddr"]) != "") {
            foreach ($leases as $lease) {
                $splitArr = split(" ", $lease);

                if (strtolower(trim($splitArr[1])) == strtolower(trim($resultArr["macaddr"]))) {
                    $exec_result = shell_exec('ping -c 1 ' . trim($splitArr[2]) . ' | grep transmitted');
                    if(stristr($exec_result,"1 received"))
                        @mysql_query("update network_devices set state = 1, ip_dhcp = '" . trim($splitArr[2]) . "' where nd_id = " . $resultArr["nd_id"]);
                    else
                        @mysql_query("update network_devices set state = 0, ip_dhcp = null where nd_id = " . $resultArr["nd_id"]);
                }
            }
        }
    }

    sleep(0.5);
}
?>
