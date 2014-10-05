<?php
$HOANOHO_DIR = exec('. /etc/environment; echo $HOANOHO_DIR');
require($HOANOHO_DIR."/config/dbconfig.inc.php");

$sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";

// Connect to the database
// replace "user_name" and "password" with your real login info

$dbh = mysql_connect("localhost",$dbusername,$dbpassword) or die("There was a problem with the database connection.");
$dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the categories.");

$result = mysql_query($sql);

$__CONFIG = array();

while($row = mysql_fetch_array($result)) {
  $__CONFIG[$row[0]] = $row[1];
}

$sql = "select devices.dev_id, devices.identifier from devices join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id where types.name = 'PVServer'";
$result = mysql_query($sql);
while($device = mysql_fetch_object($result))
{     
  $interfaceURL = "";
  $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'pvserver_url' and dev_id = " . $device->dev_id));
  if($deviceResult)
        $interfaceURL = $deviceResult['value'];

  $interfaceUsername = "";
  $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'pvserver_username' and dev_id = " . $device->dev_id));
  if($deviceResult)
        $interfaceUsername = $deviceResult['value'];

  $interfacePassword = "";
  $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'pvserver_password' and dev_id = " . $device->dev_id));
  if($deviceResult)
        $interfacePassword = $deviceResult['value'];

  $context = stream_context_create(array(
      'http' => array(
          'header'  => "Authorization: Basic " . base64_encode("$interfaceUsername:$interfacePassword")
      )
  ));

  $doc = new DOMDocument();
  $doc->loadHTML(file_get_contents($interfaceURL, false, $context));

  $data = array();
  $i = 0;
  $j = 0;
  $elements = $doc->getElementsByTagName('td');
  foreach($elements as $element)
  {
        // strip out &nbsp tag
        $nodevalue = htmlentities($element->nodeValue);
        $nodevalue = str_replace('&amp;nbsp', "", $nodevalue);

        //echo $i.": ".trim(strip_tags($element->nodeValue))."<br>";
        // valuename
        if($i == 13 || $i == 16 || $i == 25)
        {
              $data[] = array();
              $data[$j][0] = trim($nodevalue);
        }
        // value
        else if($i == 14 || $i == 17 || $i == 26)
        {
              $data[$j][1] = trim($nodevalue);
        }
        // valueunit
        else if($i == 15 || $i == 18 || $i == 27)
        {
              $data[$j][2] = trim($nodevalue);
              $j++;
        }

        $i++;
  }

  // form json object for handover to datacollector middleware
  $JSON="{\"Name\":\"".$device->identifier."\", \"Timestamp\":\"".time()."\", \"Values\": [";
  foreach($data as $dataelement)
  {
        $JSON=$JSON."{ \"Name\":\"".$dataelement[0]."\", \"Value\":\"".$dataelement[1]."\", \"Unit\":\"".$dataelement[2]."\"},";
  }

  $JSON=rtrim($JSON, ",");

  $JSON=$JSON."] }";

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, "http://localhost/helper/datacollector.php");
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
  curl_setopt($curl, CURLOPT_POSTFIELDS, "json=".$JSON);
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
  curl_exec($curl);
  curl_close($curl);
}
?>    


