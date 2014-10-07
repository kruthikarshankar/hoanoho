<?php
    if (!isset($_POST['cmd'])) {
      if (isset($_SESSION)) {
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

        <link rel="apple-touch-icon" href="./img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
        <title>Installation</title>
    </head>
<body>
    <section class="install_main">
        <form class="install" action="index.php" method="post">
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
