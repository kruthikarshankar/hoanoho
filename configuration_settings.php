 <?php
    include dirname(__FILE__).'/includes/dbconnection.php';
    include dirname(__FILE__).'/includes/sessionhandler.php';
    include dirname(__FILE__).'/includes/getConfiguration.php';

    function displayValue($object)
    {
        	switch ($object->type )
    		{
    			default:
    			case"text":
    				echo "<input type=\"text\" name=\"".$object->configstring."\" value=\"".$object->value."\" placeholder=\"".$object->hint."\" >";
    			break;
    			case"boolean":
    				echo "<select name=\"".$object->configstring."\">";
    				echo "<option ".($object->value == "1" ? "selected" : "")." value=\"1\">Ja</option>";
    				echo "<option ".($object->value == "0" ? "selected" : "")." value=\"0\">Nein</option>";
    				echo "</select>";
    			break;
    			case"password":
    				echo "<input type=\"password\" name=\"".$object->configstring."\" value=\"".$object->value."\">";
    			break;
    			case"dwd_state":
    				echo "<select name=\"".$object->configstring."\" style='width:200px'>";
    				echo "<option ".($object->value == "" ? "selected" : "")." value=\"\">-</option>";
    				echo "<option ".($object->value == "SU" ? "selected" : "")." value=\"SU\">Baden-Württemberg</option>";
    				echo "<option ".($object->value == "MS" ? "selected" : "")." value=\"MS\">Bayern</option>";
    				echo "<option ".($object->value == "PD" ? "selected" : "")." value=\"PD\">Berlin</option>";
    				echo "<option ".($object->value == "PD" ? "selected" : "")." value=\"PD\">Brandenburg</option>";
    				echo "<option ".($object->value == "HN" ? "selected" : "")." value=\"HN\">Bremen</option>";
    				echo "<option ".($object->value == "SG" ? "selected" : "")." value=\"SG\">Hamburg</option>";
    				echo "<option ".($object->value == "OF" ? "selected" : "")." value=\"OF\">Hessen</option>";
    				echo "<option ".($object->value == "RW" ? "selected" : "")." value=\"RW\">Mecklenburg-Vorpommern</option>";
    				echo "<option ".($object->value == "HN" ? "selected" : "")." value=\"HN\">Niedersachsen</option>";
    				echo "<option ".($object->value == "EM" ? "selected" : "")." value=\"EM\">Nordrhein-Westfalen</option>";
    				echo "<option ".($object->value == "TR" ? "selected" : "")." value=\"TR\">Rheinland-Pfalz</option>";
    				echo "<option ".($object->value == "TR" ? "selected" : "")." value=\"TR\">Saarland</option>";
    				echo "<option ".($object->value == "LZ" ? "selected" : "")." value=\"LZ\">Sachsen</option>";
    				echo "<option ".($object->value == "MB" ? "selected" : "")." value=\"MB\">Sachsen-Anhalt</option>";
    				echo "<option ".($object->value == "SG" ? "selected" : "")." value=\"SG\">Schleswig-Holstein</option>";
    				echo "<option ".($object->value == "EF" ? "selected" : "")." value=\"EF\">Thüringen</option>";
    				echo "</select>";
    			break;
    		}
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == "savesettings") {

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

        <?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

        <link rel="apple-touch-icon" href="./img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Einstellungen - Parameter</title>
    </head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <?php
    $sql2 = "SELECT distinct category FROM configuration where dev_id = 0 ORDER BY category ASC";
    $result2 = mysql_query($sql2);
    while ($category = mysql_fetch_object($result2)) {
    ?>
        <section class="main_configuration_settings">
            <h1><span><?php echo $category->category; ?></span></h1>

            <div id="header">
                <div id="text">Name</div>
                <div id="value">Einstellung</div>
            </div>
            <form method="POST" enctype="multipart/form-data" name="configForm<?php echo $category->category; ?>" id="configForm">
            <?php
            $sql = "SELECT * FROM configuration where dev_id = 0 and category = '".$category->category."' ORDER BY configstring ASC";
            $result = mysql_query($sql);
            while ($config = mysql_fetch_object($result)) {
            ?>
                    <div id="listitem">
                        <div id="text"><?php echo $config->title; ?>:</div>
                        <div id="value"><?php displayValue($config); ?></div>
                    </div>
            <?php
            }
            ?>
            <input type="hidden" name="cmd" value="savesettings">
            <div id="submit"><input type="reset" id="greybutton" name="resetbtn" value="Zurücksetzen">&nbsp;&nbsp;&nbsp;<input type="submit" id="greenbutton" name="submit" value="Speichern"></div>
            </form>
        </section>
    <?php
    }
    ?>
</body>
</html>
