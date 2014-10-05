 <?
	include dirname(__FILE__).'/includes/dbconnection.php';
	include dirname(__FILE__).'/includes/sessionhandler.php';
	include dirname(__FILE__).'/includes/getConfiguration.php';

	function displayValue($object) {
			if($object->type == "text")
			{
				echo "<input type=\"text\" name=\"".$object->configstring."\" value=\"".utf8_encode($object->value)."\" placeholder=\"".utf8_encode($object->hint)."\" >";
			}
			else if($object->type == "boolean")
			{
				echo "<select name=\"".$object->configstring."\">";
				echo "<option ".($object->value == "1" ? "selected" : "")." value=\"1\">Ja</option>";
				echo "<option ".($object->value == "0" ? "selected" : "")." value=\"0\">Nein</option>";
				echo "</select>";
			}
			else if($object->type == "password")
			{
				echo "<input type=\"password\" name=\"".$object->configstring."\" value=\"".utf8_encode($object->value)."\">";
			}
			else
			{
				echo "<input type=\"text\" name=\"".$object->configstring."\" value=\"".utf8_encode($object->value)."\" placeholder=\"".utf8_encode($object->hint)."\">";
			}
	}


	if(isset($_POST['cmd']) && $_POST['cmd'] == "savesettings") {

		foreach ($_POST as $key => $value) {
			if($key == "cmd" || $key == "submit")
				continue;

			$sql = "update configuration set value = '".$value."' where configstring = '".$key."'; ";
			mysql_query($sql);
		}
	}
?>

<html>
	<head>
		<meta charset="UTF-8" />

		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
		<link rel="stylesheet" href="./css/configuration.css" type="text/css" media="screen" title="no title" charset="UTF-8">
		<link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

		<? include dirname(__FILE__).'/includes/getUserSettings.php'; ?> 

		<link rel="apple-touch-icon" href="./img/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
		<title><? echo $__CONFIG['main_sitetitle'] ?> - Einstellungen - Parameter</title>
	</head>
<body>
	<? require(dirname(__FILE__).'/includes/nav.php'); ?>

	<?
	$sql2 = "SELECT distinct category FROM configuration where dev_id = 0 ORDER BY category ASC";
	$result2 = mysql_query($sql2);
	while ($category = mysql_fetch_object($result2)) 
	{
	?>
		<section class="main_configuration_settings">
			<h1><span><? echo $category->category; ?></span></h1>
			
			<div id="header">
				<div id="text">Name</div>
				<div id="value">Einstellung</div>
			</div>
			<form method="POST" enctype="multipart/form-data" name="configForm<? echo $category->category; ?>" id="configForm">
			<?
			$sql = "SELECT * FROM configuration where dev_id = 0 and category = '".$category->category."' ORDER BY configstring ASC";
			$result = mysql_query($sql);
			while ($config = mysql_fetch_object($result)) 
			{
			?>
					<div id="listitem">
						<div id="text"><? echo utf8_encode($config->title); ?>:</div>
						<div id="value"><? displayValue($config); ?></div>
					</div>
			<?
			}
			?>
			<input type="hidden" name="cmd" value="savesettings">
			<div id="submit"><input type="reset" id="greybutton" name="resetbtn" value="Zurücksetzen">&nbsp;&nbsp;&nbsp;<input type="submit" id="greenbutton" name="submit" value="Speichern"></div>
			</form>
		</section>
	<?
	}
	?>
</body>
</html>