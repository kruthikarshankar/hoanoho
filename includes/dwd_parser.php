<?
	include $_SERVER['DOCUMENT_ROOT'].'/includes/simple_html_dom.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/getConfiguration.php';

	/* ************************** 
	   DWD Wetterreport für das Bundesland
	   ************************** */ 
	//$html = file_get_html("http://www.dwd.de/dyn/app/ws/html/reports/SU_report_de.html");
	$html = file_get_html($__CONFIG['dwd_url_bundesland']);

	if(strlen($html) > 0)
	{
		foreach($html->find('div') as $element) 
		{
			if($element->id == "ebp_ws_report_content")
				$dwd_report = trim($element);
				//$dwd_report = strip_tags(trim($element));
		}
	}
	else
	{
		$dwd_report = "Aktueller Bericht vom DWD konnte nicht geladen werden!";
	}

	       

	/* ************************** 
	   DWD Wetterwarnung für den Kreis
	   ************************** */ 
	//$html = file_get_html("http://www.dwd.de/dyn/app/ws/html/reports/TUT_warning_de.html");
	$html = file_get_html($__CONFIG['dwd_url_landkreis']);

	$dwd_warnung = "";
	if(strlen($html) > 0)
	{
		foreach($html->find('div') as $element) 
		{
			
			if($element->id == "ebp_ws_warning_content")
				$dwd_warnung .= "<div id=\"aktiv\">".strip_tags(trim($element))."<br></div>";
		}
	}
	else
	{
		$dwd_warnung = "Warnungen vom DWD konnten nicht geladen werden!";
	}

	if(strlen($dwd_warnung) == 0)
		$dwd_warnung = "Es liegt aktuell keine Warnung für den Landkreis ".$__CONFIG['dwd_name_landkreis']." vor!";

?>