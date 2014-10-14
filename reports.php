<?php
    include dirname(__FILE__).'/includes/dbconnection.php';
    include dirname(__FILE__).'/includes/sessionhandler.php';
    include dirname(__FILE__).'/includes/getConfiguration.php';

    if (isset($_POST['cmd']) && $_POST['cmd'] == "deletereport" && isset($_POST['rid']) && strlen($_POST['rid']) > 0) {
        $sql = "DELETE FROM reportdata where rid = " . $_POST['rid'];
        mysql_query($sql);
        $sql = "DELETE FROM reports where rid = " . $_POST['rid'];
        mysql_query($sql);
        $sql = "DELETE from report_configuration where rid = " . $_POST['rid'];
        $result = mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "newreport") {
        $sql = "INSERT INTO reports set name = 'Neue Auswertung'";
        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "updatereport" && isset($_POST['rid']) && strlen($_POST['rid']) > 0) {
        $sql = "UPDATE reports set name = '" . $_POST['reportname'] . "', type = '" . $_POST['reporttype'] . "', unit = '" . $_POST['unit'] . "', unitprice = '" . $_POST['unitprice'] . "', dev_id = " . $_POST['dev_id'] . " where rid = " . $_POST['rid'];
        mysql_query($sql);

        // save report configuration
        // delete all configuration entries before
        $sql = "DELETE from report_configuration where rid = " . $_POST['rid'];
        $result = mysql_query($sql);
        // check if keys are already in the database
        foreach ($_POST as $key=>$value) {
            if($key == "cmd" || $key == "submit" || $key == "rid")
                continue;

            if (strlen(trim($value)) > 0) {
                $sql = "INSERT INTO report_configuration (rid, configstring, value) VALUES (".$_POST['rid'].",'".$key."','".$value."')";
                mysql_query($sql);
            } else {
                $sql = "DELETE FROM configuration where rid = ".$_POST['rid']." and configstring = '".$key."'";
                mysql_query($sql);
            }
        }
    }
?>

<?php
    function displayReportTypes($rtype)
    {
        print("<select name=\"reporttype\" onchange=\"javascript:displayFields(this.value);\">");
            print("<option ".($rtype == "manual" ? "selected" : "")." value=\"manual\">Manuell</option>");
            print("<option ".($rtype == "auto" ? "selected" : "")." value=\"auto\">Automatisch</option>");
        print("</select>");
    }

    function displayUnits($unit)
    {
        print("<select name=\"unit\">");
            print("<option ".($unit == "" ? "selected" : "")." value=\"null\"></option>");
            print("<option ".($unit == "kWh" ? "selected" : "")." value=\"kWh\">kWh</option>");
            print("<option ".($unit == "m&sup3;" ? "selected" : "")." value=\"m&sup3;\">m&sup3;</option>");
        print("</select>");
    }

    function displayDataCollectorDevices($rid, $dev_id)
    {
        $empty = 0;
        $sql = "select devices.dev_id, devices.identifier, devices.name from devices join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id where (types.name = 'Datensammler' or types.name = 'PVServer') order by devices.name asc";

        $result = mysql_query($sql);
        print("<select name=\"dev_id\" id=\"datacollector\" onchange=\"javascript:showIdentifierListForDataCollector(".$rid.", this.value);\">");
        echo "<option ".($dev_id == "null" ? "selected" : "")." value=\"null\"></option>";
        while ($device = mysql_fetch_object($result)) {
            print("<option ".($dev_id == $device->dev_id ? "selected" : "")." value=\"".$device->dev_id."\">".$device->name." [".$device->identifier."] </option>");
        }
        print("</select>");
    }
?>

<html>
    <head>
        <meta charset="UTF-8" />

        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/report.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

        <script type="text/javascript" src="./js/jscolor/jscolor.js"></script>

        <link rel="shortcut icon" type="image/x-icon" href="./img/favicons/favicon.ico">
        <link rel="apple-touch-icon" sizes="57x57" href="./img/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="./img/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="./img/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="144x144" href="./img/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="60x60" href="./img/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="./img/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="./img/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="152x152" href="./img/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="./img/favicons/apple-touch-icon-180x180.png">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-title" content="Hoanoho">
        <link rel="icon" type="image/png" href="./img/favicons/favicon-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="./img/favicons/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="./img/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="./img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="./img/favicons/favicon-32x32.png" sizes="32x32">
        <meta name="msapplication-TileColor" content="#603cba">
        <meta name="msapplication-TileImage" content="./img/favicons/mstile-144x144.png">
        <meta name="msapplication-config" content="./img/favicons/browserconfig.xml">
        <meta name="application-name" content="Hoanoho">

        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Auswertungsübersicht</title>

        <script type="text/javascript">
            function hideAllFields()
            {
                var elem = document.getElementById("block_auto");
                elem.style.display = "none";

                elem = document.getElementById("datacollector");
                elem.options.selectedIndex = 0;
            }

            function displayFields(displayType, rid, dev_id)
            {
                // display all needed fields for type auto
                if (displayType == "auto") {
                    showIdentifierListForDataCollector(rid, dev_id);

                    var elem = document.getElementById("block_auto");
                    elem.style.display = "block";
                } else {
                    hideAllFields();
                }
            }

            function showIdentifierListForDataCollector(rid,dev_id)
            {
                if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                    var xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }

                xmlhttp.onreadystatechange=function () {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                        document.getElementById("replacetxt").innerHTML=xmlhttp.responseText;
                        jscolor.init();
                    }
                }
                xmlhttp.open("GET","helper/report_getIdentifiersForConfigurationInterface.php?dev_id="+dev_id+"&rid="+rid,true);
                xmlhttp.send();
            }
        </script>
    </head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <?php
    // editiermodus

    if (isset($_POST['cmd']) && ($_POST['cmd'] == "editreport" || $_POST['cmd'] == "newreport" )) {
        $title = ($_POST['cmd'] == "newreport") ? "Report hinzufügen" : "Report bearbeiten";

        if (isset($_POST['rid'])) {
            $sql = "SELECT rid, name, type, unit, unitprice, dev_id FROM reports where rid = " . $_POST['rid'];
        } else {
            $sql = "SELECT rid, name, type, unit, unitprice, dev_id FROM reports where rid = " . mysql_insert_id();
        }
    ?>
        <section class="main_report">
            <span><h1><?php echo $title ?></h1></span>
            <?php
            $result = mysql_query($sql);
            while ($report = mysql_fetch_object($result)) {
            ?>
                <form method="POST" enctype="multipart/form-data" name="editReportForm" id="editReportForm">
                <div id="edit">
                    <div id="space">&nbsp;</div>
                    <div id="text">Name der Auswertung:</div><div id="value"><input id="reportname" name="reportname" value="<?php echo $report->name; ?>"></div>
                    <div id="text">Erfassungsart:</div><div id="value"><?php displayReportTypes($report->type); ?></div>
                    <div id="space">&nbsp;</div>
                    <div id="block_auto" style="display:none;">
                        <div id="text" style="margin-top:3px;">Gerät:</div><div id="value"><?php displayDataCollectorDevices($report->rid,$report->dev_id); ?></div>
                        <div id="replacetxt"></div>
                    </div>
                    <div id="space">&nbsp;</div>
                    <div id="text">Einheit:</div><div id="value"><?php displayUnits($report->unit); ?></div>
                    <div id="text">Entgeld pro Einheit:</div><div id="value"><input id="unitprice" name="unitprice" value="<?php echo $report->unitprice; ?>"></div>
                    <div id="space">&nbsp;</div>
                    <div id="submit"><input type="button" id="greybutton" name="backbtn" value="Zurück" onclick="self.location.href='reports.php'">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="greybutton" name="resetbtn" value="Zurücksetzen" onclick="editReportForm.reset();">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="greenbutton" name="submit" value="Speichern"></div>
                    <input type="hidden" id="rid" name="rid" value="<?php echo $report->rid; ?>"><input type="hidden" id="cmd" name="cmd" value="updatereport">
                </div>
                </form>
            <?php
            echo "<script type=\"text/javascript\">displayFields('".$report->type."','".$report->rid."','".$report->dev_id."');</script>";
            }
            ?>
        </section>
        <?php
    } else {
        // zeige übersichtslisten
        $sql = "SELECT rid,name,type FROM reports order by name asc";
    ?>
        <section class="main_report">
            <h1><span>Auswertungen</span></h1>

            <div id="toolbar">
                <form method="POST" enctype="multipart/form-data" name="addReportForm" id="addReportForm">
                    <a href="#" onclick="javascript:document.addReportForm.submit()"><div id="left"><img src="./img/add.png">&nbsp;&nbsp;Auswertung hinzufügen</div></a>
                    <input type="hidden" name="cmd" value="newreport">
                </form>
            </div>

            <div id="header">
                <div id="icon">&nbsp;</div>
                <div id="name">Auswertungsname</div>
                <div id="type">Typ</div>
                <div id="action">&nbsp;</div>
            </div>
            <?php
            $result = mysql_query($sql);
            while ($report = mysql_fetch_object($result)) {
            ?>
            <div id="listitem">
                <a href="./report_display.php?rid=<?php echo $report->rid; ?>"><div id="icon"><img src="./img/report.png"></div><div id="name"><?php echo $report->name; ?></div>
                <div id="type"><?php echo $report->type; ?></div></a>
                <div id="action">
                        <form method="POST" enctype="multipart/form-data" name="editReportForm<?php echo $report->rid; ?>" id="editReportForm">
                            <input type="hidden" name="cmd" value="editreport">
                            <input type="hidden" name="rid" value="<?php echo $report->rid; ?>">
                        </form>
                        <form method="POST" enctype="multipart/form-data" name="deleteReportForm<?php echo $report->rid; ?>" id="deleteReportForm">
                            <input type="hidden" name="cmd" value="deletereport">
                            <input type="hidden" name="rid" value="<?php echo $report->rid; ?>">
                        </form>
                        <a href="#" onclick="javascript:document.editReportForm<?php echo $report->rid; ?>.submit()" title="Report editieren"><img src="./img/edit.png"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="javascript:document.deleteReportForm<?php echo $report->rid; ?>.submit()" title="Report löschen" onclick="javascript:return confirm('Soll der Report \'<?php echo $report->name; ?>\' wirklich gelöscht werden ?');"><img src="./img/delete.png"></a>
                </div>
            </div>
            <?php
            }
            ?>
        </section>
    <?php
    }
    ?>
</body>
</html>
