<? 

require("/var/www/homie/config/dbconfig.inc.php");
    
$dbh = mysql_connect("localhost",$dbusername,$dbpassword) or die("There was a problem with the database connection.");
$dbs = mysql_select_db($dbname, $dbh) or die("There was a problem selecting the categories.");

$sql = "select configstring, value from configuration where dev_id = 0 order by configstring asc";
$result = mysql_query($sql);

$__CONFIG = array();

while($row = mysql_fetch_array($result)) {
    $__CONFIG[$row[0]] = $row[1];
}





function QueryKlickTelDe($Rufnummer) { 
    $record = false; 
    $pageurl = "http://www.klicktel.de/inverssuche/index/search?method=searchSimple&_dvform_posted=1&phoneNumber=$Rufnummer"; 
    $wsdata = file_get_contents($pageurl);

    if ($wsdata === false) 
    { 
       WriteLogMessage(WARNING, 'Datei: '.__file__.' Zeile: '.__line__, 'Timeout bei Abruf der Webseite '.$pageurl); 
    } 
    else 
    { 
        $data = str_replace(array("\r\n", "\n", "\r"), ' ', $wsdata); 

        if (preg_match('/<strong>(.*)<\/strong>.*<p class="data track">(.*?)([0-9][0-9A-Za-z].*?)<br \/>\s*?([0-9]{5})\s*?(.*?)<\/p>/', $data, $result)) { 
            $record = array( 
                'Name'              => html_entity_decode(trim($result[1])), 
                'Strasse'           => html_entity_decode(trim($result[2])), 
                'Adresse'           => html_entity_decode(trim($result[3])), 
                'PLZ'               => html_entity_decode(trim($result[4])), 
                'Ort'               => html_entity_decode(trim($result[5])), 
                'StrasseHausnummer' => html_entity_decode(trim($result[2]).' '.trim($result[3])), 
                'PLZOrt'            => html_entity_decode(trim($result[4]).' '.trim($result[5])) 
             ); 
        }
    } 

    return $record; 
}


mysql_query("TRUNCATE TABLE callerlist");

$callerlistfile = $__CONFIG['temp_path']."/foncallsdaten.csv";

$file_array = file($callerlistfile);

$i=0;
foreach ($file_array as $line_number => $line)
{
	$i++;

	if($i < 3)
		continue;

    // nur die ersten 50 Datensätze einlesen
	if($i > 52)
	   break;

	$array = explode(';', $line);

	$insert = "(";

	for($j = 0; $j < count($array); $j++)
	{
		// datumskonvertierung
		if($j == 1)
		{
			$insert .= "STR_TO_DATE('".$array[$j]."', '%d.%m.%y %H:%i'),";
		}
		// rückwärtssuche
		else if($j == 2)
		{
			if (strlen($array[$j]) < 1) {
				//$record = QueryKlickTelDe($array[3]);
				//$record = QueryKlickTelDe("057125672");
			}

			//$insert .= "'" . utf8_decode($record['Name']) . "',";
            //$insert .= "'" . utf8_decode($record['StrasseHausnummer']) . " / " . utf8_decode($record['PLZOrt']) . "',";
			$insert .= "'','',";

			continue;
		}
		else
			$insert .= "'" . $array[$j] . "',";
	}

	$insert = substr($insert, 0, strlen($insert)-3);
	$insert .= "')";

	$sql = "INSERT INTO callerlist (typ,date,name,adresse,rufnummer,nebenstelle,eigenerufnummer,dauer) VALUES " . $insert;

	echo $sql."<br>";
	mysql_query($sql);
}

?>