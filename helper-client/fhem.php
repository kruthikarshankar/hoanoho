<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/sessionhandler.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';

    if (isset($_GET['cmd']) && isset($_GET['device']) && isset($_GET['value'])) {
        if ($_GET['cmd'] == "set") {
            if ($_GET['value'] == "toggle") {
                // get actual value
                $sql = "SELECT value FROM fhem.current WHERE DEVICE = '".$_GET['device']."' and READING = 'state' limit 1";
                $result = mysql_query($sql);
                while ($current = mysql_fetch_object($result)) {
                    if($current->value == "on")
                        $value = "off";
                    else
                        $value = "on";
                }

                echo $value;
            } else
                $value = $_GET['value'];

            // Example URL:
            // http://localhost:8083/fhem?cmd=set%20az_THERMOSTAT_Climate%20desired-temp%2010
            if(isset($_GET['reading']))
                fopen($__CONFIG['fhem_url']."?cmd=set%20".$_GET['device']."%20".$_GET['reading']."%20".$value, "r");
            else
                fopen($__CONFIG['fhem_url']."?cmd=set%20".$_GET['device']."%20".$value, "r");
        }
    }
?>
