<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    $filelist = scandir('./sql');
    if ($filelist) {
        for ($i=0; $i < sizeof($filelist) ; $i++) {
            if ($filelist[$i] != "." && $filelist[$i] != "..") {
                $f=fopen("./sql/".$filelist[$i],'r');
                $data="";
                while(!feof($f))
                    $data .= fread($f,1024);
                fclose($f);

                $sqlcommands = explode(';', $data);

                $dbh = mysql_connect($_SESSION['dbhostname'],$_SESSION['dbusername'],$_SESSION['dbpassword']) or die("Could not connect to database server, please check servername and credentials.");
                $dbs = mysql_select_db($_SESSION['dbname'], $dbh) or die("There was a problem selecting the database, please check database name.");

                // insert table contents
                for ($j=0; $j < sizeof($sqlcommands); $j++) {
                    if (strlen(trim($sqlcommands[$j])) > 0) {
                        $result = mysql_query(trim($sqlcommands[$j]));
                        if (!$result) {
                            die('Invalid query: ' . mysql_error());
                        }
                    }
                }
            }
        }

        // add administrator user
        $randompw = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
        $hash = md5("manager" + $randompw + time());
        $_SESSION['adminpw'] = $randompw;
        $result = mysql_query("INSERT INTO users (uid,username,password,hash) VALUES (1,'manager','".md5($randompw)."','".$hash."')");
        if ($result) {
            $result = mysql_query("INSERT INTO usergroups (uid,gid) VALUES (1,2)");
            if (!$result) {
                die('Invalid query: ' . mysql_error());
            } else {
                $result = mysql_query("INSERT INTO usersettings (uid, backgroundimage, notecolor) VALUES (1, '/img/bg/default.png', 'yellow')");
                if (!$result) {
                    die('Invalid query: ' . mysql_error());
                } else {
                    header('Location: ./finish.php');
                    exit;
                }
            }
        } else {
            die('Invalid query: ' . mysql_error());
        }
    }
