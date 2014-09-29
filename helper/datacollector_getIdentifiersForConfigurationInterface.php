<?
	include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnection.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/sessionhandler.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/getConfiguration.php';

	if (isset($_GET['dev_id']))
	{
		$result = mysql_query("select identifier from devices where dev_id = " . $_GET['dev_id']);
		while ($device_identifier = mysql_fetch_object($result)) 
		{
			$result2 = mysql_query("select distinct valuename from device_data where deviceident = '".$device_identifier->identifier."' order by valuename ");

			if(mysql_num_rows($result2) > 0) {
				$i=1;
				print("<div id=\"headline\"><div id=\"text\">&nbsp;</div><div id=\"value_ident\">Kennung</div><div id=\"value_label\">Bezeichnung</div></div>");
				while ($valuerow = mysql_fetch_object($result2)) 
				{
					$translation = "";
					$translation_result = mysql_query("select value from configuration where dev_id = ".$_GET['dev_id']." and configstring = '@".utf8_encode($valuerow->valuename)."'");
					while ($trans = mysql_fetch_object($translation_result)) {
						$translation = utf8_encode($trans->value);
					}

					print("<div id=\"row\"><div id=\"text\">Wert ".$i.":</div><div id=\"value_ident\"><input name=\"datacollector_value\" value=\"".utf8_encode($valuerow->valuename)."\" readonly></div><div id=\"value_label\"><input name=\"@".utf8_encode($valuerow->valuename)."\" value=\"".$translation."\"></div></div>");
					$i++;
				}
			} else {
				print("<div id=\"row\"><div id=\"message\">Es wurden noch keine Werte in der Datenbank erfasst! Bitte einen Moment warten und <a href=\"javascript:showDataCollectorIdentifierList(".$_GET['dev_id'].");\">aktualisieren</a> oder die eingegebene Kennung überprüfen.</div></div>");
			}	
		}
	}
?>