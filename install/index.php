<?php
    if (!isset($_POST['cmd'])) {
      if (isset($_SESSION)) {
          session_unset();
          session_destroy();
      }
    } elseif ($_POST['cmd'] == "checkdb") {
        $dbh = mysql_connect($_POST['dbhostname'],$_POST['dbusername'],$_POST['dbpassword']);
        $dbs = mysql_select_db($_POST['dbname'], $dbh);
        $dbf = mysql_select_db($_POST['fhem_dbname'], $dbh);

        if (!$dbh) {
            $errormsg = "Benutzername oder Passwort fehlerhaft, bitte überprüfen!";
        } elseif (!$dbs) {
            $errormsg = "Datenbankname ".$_POST['dbname']." fehlerhaft, bitte überprüfen!";
        } elseif (!$dbf) {
            $errormsg = "Datenbankname ".$_POST['fhem_dbname']." fehlerhaft, bitte überprüfen!";
        } else {
            $fp = fopen(dirname(__FILE__).'/../config/dbconfig.inc.php', 'w');

            if ($fp) {
                // write database configuration include file
                $filecontent = "<?\n";
                $filecontent .= "\t\$dbusername = '" . $_POST['dbusername'] . "';\n";
                $filecontent .= "\t\$dbpassword = '" . $_POST['dbpassword'] . "';\n";
                $filecontent .= "\t\$dbhostname = '" . $_POST['dbhostname'] . "';\n";
                $filecontent .= "\t\$dbname = '" . $_POST['dbname'] . "';\n";
                $filecontent .= "\t\$fhem_dbname = '" . $_POST['fhem_dbname'] . "';\n";
                $filecontent .= "?>\n";

                fwrite($fp, $filecontent);
                fclose($fp);

                session_start();

                // store POST into SESSION for further processing
                $_SESSION['dbusername'] = $_POST['dbusername'];
                $_SESSION['dbpassword'] = $_POST['dbpassword'];
                $_SESSION['dbhostname'] = $_POST['dbhostname'];
                $_SESSION['dbname'] = $_POST['dbname'];
                $_SESSION['fhem_dbname'] = $_POST['fhem_dbname'];

                header('Location: ./prepdb.php');
                exit;
            }
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8" />

        <link rel="stylesheet" href="./style.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <link rel="shortcut icon" type="image/x-icon" href="../img/favicons/favicon.ico">
        <link rel="apple-touch-icon" sizes="57x57" href="../img/favicons/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="../img/favicons/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="../img/favicons/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="144x144" href="../img/favicons/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="60x60" href="../img/favicons/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="../img/favicons/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="../img/favicons/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="152x152" href="../img/favicons/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="../img/favicons/apple-touch-icon-180x180.png">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-title" content="Hoanoho">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="../img/favicons/favicon-32x32.png" sizes="32x32">
        <meta name="msapplication-TileColor" content="#603cba">
        <meta name="msapplication-TileImage" content="../img/favicons/mstile-144x144.png">
        <meta name="msapplication-config" content="../img/favicons/browserconfig2.xml">
        <meta name="application-name" content="Hoanoho">

        <title>Installation</title>
    </head>
<body>
    <section class="install_main">
        <form class="install" action="index.php" method="post">
            <h1><span class="log-in">Voraussetzungen</span></h1>
			<h2>PHP Module</h2>
			<div class="value">php5-curl:    <?php if(extension_loaded('curl'))    { ?> OK <?php } else { ?> Nicht geladen <?php } ?></div>
			<div class="value">php5-gd:      <?php if(extension_loaded('gd'))      { ?> OK <?php } else { ?> Nicht geladen <?php } ?></div>
			<div class="value">php5-imagick: <?php if(extension_loaded('imagick')) { ?> OK <?php } else { ?> Nicht geladen <?php } ?></div>
			<div class="value">php5-imap:    <?php if(extension_loaded('imap'))    { ?> OK <?php } else { ?> Nicht geladen <?php } ?></div>
			<div class="value">php5-mysql:   <?php if(extension_loaded('mysql'))   { ?> OK <?php } else { ?> Nicht geladen <?php } ?></div>
			
			<p class="clearfix">&nbsp;</p>
			<h2>Berechtigungen</h2>
			<div class="value"><?php echo dirname(__DIR__); ?>: <?php if(is_writeable(dirname(__DIR__))) { ?> Beschreibbar <?php } else { ?> Nicht beschreibbar <?php } ?></div>
			<div class="value"><?php echo dirname(__DIR__)."/config"; ?>: <?php if(is_writeable(dirname(__DIR__)."/config")) { ?> Beschreibbar <?php } else { ?> Nicht beschreibbar <?php } ?></div>
			
			<p class="clearfix">&nbsp;</p>
			<h1><span class="log-in">Datenbankkonfiguration</span></h1>
            <?php if (!file_exists(dirname(__FILE__).'/../config/dbconfig.inc.php')) { ?>
                <?php if (strlen($errormsg) > 0) { ?>
                    <div class="errormsg"><?php echo $errormsg; ?></div>
                <?php } ?>
                <div class="name">MySQL Server IP-Adresse / Hostname</div><div class="value"><input type="text" name="dbhostname" value="<?php echo $_POST['dbhostname']; ?>"></div>
                <div class="name">MySQL Benutzername</div><div class="value"><input type="text" name="dbusername" value="<?php echo $_POST['dbusername']; ?>"></div>
                <div class="name">MySQL Passwort</div><div class="value"><input type="password" name="dbpassword" value="<?php echo $_POST['dbpassword']; ?>"></div>
                <div class="name">MySQL Datenbankname:</div><div class="value"><input type="text" name="dbname" value="<?php echo $_POST['dbname']; ?>"></div>
                <div class="name">MySQL FHEM DB Name:</div><div class="value"><input type="text" name="fhem_dbname" value="<?php echo $_POST['fhem_dbname']; ?>"></div>
                <p class="clearfix">
                    <input type="submit" name="submit" value="Weiter">
                </p>
                <input type="hidden" name="cmd" value="checkdb">
            <?php } else { ?>
                <div class="value">Die Konfiguration wurde bereits abgeschlossen!</div>
            <?php } ?>
        </form>​​
    </section>
</body>
</html>
