<?php
    include dirname(__FILE__).'/includes/dbconnection.php';
    include dirname(__FILE__).'/includes/sessionhandler.php';
    include dirname(__FILE__).'/includes/getConfiguration.php';
?>

<?php
    function displayNoteColors($notecolor)
    {
        echo "<select id=\"notecolor\" name=\"notecolor\">";
            echo "<option ".($notecolor == "yellow" ? "selected" : "")." value=\"yellow\">Gelb</option>";
            echo "<option ".($notecolor == "blue" ? "selected" : "")." value=\"blue\">Blau</option>";
            echo "<option ".($notecolor == "red" ? "selected" : "")." value=\"red\">Rot</option>";
            echo "<option ".($notecolor == "green" ? "selected" : "")." value=\"green\">Grün</option>";
            echo "<option ".($notecolor == "orange" ? "selected" : "")." value=\"orange\">Orange</option>";
            echo "<option ".($notecolor == "purple" ? "selected" : "")." value=\"purple\">Lila</option>";
            echo "<option ".($notecolor == "pink" ? "selected" : "")." value=\"pink\">Pink</option>";
        echo "</select>&nbsp;";
    }

    function displayMailserverTypes($type)
    {
        echo "<select id=\"mailserver_type\" name=\"mailserver_type\">";
            echo "<option ".($type == "POP3" ? "selected" : "")." value=\"POP3\">POP3</option>";
            echo "<option ".($type == "IMAP" ? "selected" : "")." value=\"IMAP\">IMAP</option>";
        echo "</select>&nbsp;";
    }

    function displayMailserverEncryption($encryption)
    {
        echo "<select id=\"mailserver_encryption\" name=\"mailserver_encryption\">";
            echo "<option ".($encryption == "" ? "selected" : "")." value=\"\">Keine Verschlüsselung</option>";
            echo "<option ".($encryption == "SSL" ? "selected" : "")." value=\"SSL\">SSL</option>";
            echo "<option ".($encryption == "TLS" ? "selected" : "")." value=\"TLS\">TLS</option>";
        echo "</select>&nbsp;";
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == "editpassword") {
        if (strlen(trim($_POST['newpassword'])) > 0) {
            $sql = "SELECT password FROM users where uid = " . $_SESSION['uid'];
            $result = mysql_query($sql);
            while ($user = mysql_fetch_object($result)) {
                if ($user->password == md5($_POST['oldpassword'])) {
                    $sql = "UPDATE users SET password = '" . md5($_POST['newpassword']) . "' where uid = " . $_SESSION['uid'];
                    mysql_query($sql);
                    $successmsg = "Das Kennwort wurde erfolgreich geändert!";
                } else
                    $errormsg = "Das alte Kennwort ist nicht korrekt!";
            }
        } else {
            $errormsg = "Das neue Kennwort darf nicht leer sein!";
        }
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "saveusersettings") {
        $sql = "UPDATE usersettings set notecolor = '" . $_POST['notecolor'] . "' where uid = " . $_SESSION['uid'];
        mysql_query($sql);

        $sql = "UPDATE usersettings set pushover_usertoken = '" . $_POST['pushover_usertoken'] . "' where uid = " . $_SESSION['uid'];
        mysql_query($sql);

        $sql = "UPDATE usersettings set pushover_apptoken = '" . $_POST['pushover_apptoken'] . "' where uid = " . $_SESSION['uid'];
        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "savemailserver") {
        $sql = "UPDATE usersettings set mailserver_type = '" . $_POST['mailserver_type'] . "', mailserver_port = " . $_POST['mailserver_port'] . ", mailserver_host = '" . $_POST['mailserver_host'] . "', mailserver_encryption = '" . $_POST['mailserver_encryption'] . "', mailserver_login = '" . $_POST['mailserver_login'] . "', mailserver_password = '" . $_POST['mailserver_password'] . "' where uid = " . $_SESSION['uid'];
        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "addlink") {
        $sql = "INSERT INTO pinboard_links (uid) values (0)";
        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "deletelink") {
        $sql = "delete from pinboard_links where link_id = " . $_POST['link_id'];
        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "editlink") {
        $uid = 0;
        if (isset($_POST['linkprivate'])) {
            $uid = $_SESSION['uid'];
        }

        $sql = "update pinboard_links set name = '" . $_POST['linkname'] . "', url = '" . $_POST['linkurl'] . "', uid = " . $uid . " where link_id = " . $_POST['link_id'];
        mysql_query($sql);
    }
?>

<html>
    <head>
        <meta charset="UTF-8" />

        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/configuration.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <script type="text/javascript" src="./js/jquery.min.js"></script>
        <script src="./js/jquery-ui.min.js"></script>

        <script language="javascript">
            $(document).ready(function () {
                //##### send addnewuser Ajax request to dataoperator.php #########
                $(".pushover_testbutton").click(function (e) {
                        e.preventDefault();

                        var usertoken = $("#listitem_container_left").find("input[name='pushover_usertoken']");
                        var apptoken = $("#listitem_container_left").find("input[name='pushover_apptoken']");

                        var myData = 'usertoken='+$(usertoken).val()+'&apptoken='+$(apptoken).val();
                        jQuery.ajax({
                        type: "POST",
                        url: "helper/pushover_testmessage.php",
                        dataType:"text", // Data type, HTML
                        data:myData, //Form variables
                        success:function (response) {
                            alert('Die Testnachricht wurde erfolgreich versendet!')
                        },
                        error:function (xhr, ajaxOptions, thrownError) {
                            alert(thrownError);
                        }
                        });
                });
            });
        </script>

        <script language="javascript">
            function ajaxRequest()
            {
             var activexmodes=["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"] //activeX versions to check for in IE
             if (window.ActiveXObject) { //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
              for (var i=0; i<activexmodes.length; i++) {
               try {
                return new ActiveXObject(activexmodes[i])
               } catch (e) {
                //suppress error
               }
              }
             } else if (window.XMLHttpRequest) // if Mozilla, Safari etc
              return new XMLHttpRequest()
             else
              return false
            }

            function setBackground(uid, backgroundimage, selectedindex)
            {
                var elements = document.getElementsByName("backgroundimage");

                for (var i = 0; i < elements.length; i++) {
                    elements[i].style.backgroundColor = "#fffaf6";
                }

                var elements = document.getElementById("backgroundimage"+selectedindex);
                elements.style.backgroundColor = "#FF9640";

                document.body.style.backgroundImage = "url('"+backgroundimage+"')";

                var mygetrequest = new ajaxRequest();
                mygetrequest.onreadystatechange=function () {
                    if (mygetrequest.readyState == 4) {
                        if (mygetrequest.status == 200 || window.location.href.indexOf("http") == -1) {
                            var thisdoc = document.getElementById("result")
                            if(thisdoc != null)
                                thisdoc.innerHTML = mygetrequest.responseText;
                        }
                    }
                }

                mygetrequest.open("GET", "./includes/update_usersettings.php?uid=" + uid + "&backgroundimage=" + backgroundimage, true);
                mygetrequest.send(null);
            }
        </script>

        <?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

        <link rel="apple-touch-icon" href="./img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Einstellungen - Personalisierung</title>
    </head>

    <body>
        <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

        <?php
        $current_notecolor = "";
        $sql = "SELECT notecolor FROM usersettings where uid = " . $_SESSION['uid'];
        $result = mysql_query($sql);
        while ($row = mysql_fetch_object($result)) {
            $current_notecolor = $row->notecolor;
        }
        ?>
        <section class="main_configuration_personal">
            <h1><span>Allgemeines</span></h1>
            <form method="POST" enctype="multipart/form-data" name="editUserSetttings" id="editForm">
                <div id="listitem">
                    <div id="text">Farbe des Notizzettels:</div>
                    <div id="value"><?php displayNoteColors($current_notecolor); ?></div>
                </div>
                <br>
                <div id="listitem_container_left">
                    <div id="listitem">
                        <div id="text">Pushover Usertoken:</div>
                        <?php $configResult = mysql_fetch_assoc(mysql_query("SELECT pushover_usertoken value from usersettings where uid = " . $_SESSION['uid'])); ?>
                        <div id="value"><input type="text" id="pushover_usertoken" name="pushover_usertoken" value="<?php echo $configResult['value']; ?>"></div>
                    </div>
                    <div id="listitem">
                        <div id="text">Pushover Apptoken:</div>
                        <?php $configResult = mysql_fetch_assoc(mysql_query("SELECT pushover_apptoken value from usersettings where uid = " . $_SESSION['uid'])); ?>
                        <div id="value"><input type="text" id="pushover_apptoken" name="pushover_apptoken" value="<?php echo $configResult['value']; ?>"></div>
                    </div>
                </div>
                <div id="listitem_container_right">
                    <input class="pushover_testbutton" id="greybutton" type="submit" value="Testnachricht">
                </div>
                <div style="clear:both;"></div>
                <input type="hidden" name="cmd" value="saveusersettings">
                <div id="submit"><input id="greybutton" type="submit" value="Einstellungen speichern"></div>
            </form>
        </section>

        <section class="main_configuration_personal">
            <h1><span>Hintergrund</span></h1>
            <?php
                $current_backgroundimage = "";
                $sql = "SELECT backgroundimage FROM usersettings where uid = " . $_SESSION['uid'];
                $result = mysql_query($sql);
                while ($row = mysql_fetch_object($result)) {
                    $current_backgroundimage = $row->backgroundimage;
                }

                $filelist = scandir('./img/bg');
                if ($filelist) {
                    for ($i=0; $i < sizeof($filelist) ; $i++) {
                        if ($filelist[$i] != "." && $filelist[$i] != "..") {
                            if($current_backgroundimage == "/img/bg/".$filelist[$i])
                                echo "<div class=\"backgroundimage_selected".$i."\" id=\"backgroundimage".$i."\" name=\"backgroundimage\" onclick=\"javascript:setBackground(".$_SESSION['uid'].",'/img/bg/" . $filelist[$i] . "'," . $i . ");\"><img src=\"/img/bg/".$filelist[$i]."\" title=\"".$filelist[$i]."\"></div>";
                            else
                                echo "<div class=\"backgroundimage".$i."\" id=\"backgroundimage".$i."\" name=\"backgroundimage\" onclick=\"javascript:setBackground(".$_SESSION['uid'].",'/img/bg/" . $filelist[$i] . "'," . $i . ");\"><img src=\"/img/bg/".$filelist[$i]."\" title=\"".$filelist[$i]."\"></div>";
                        }
                    }
                    echo "<div class=\"backgroundimage\"></div>";
                }
            ?>
        </section>

        <section class="main_configuration_personal">
            <h1><span>Pinnwand Links</span></h1>

            <div id="toolbar">
                <form method="POST" enctype="multipart/form-data" name="addLinkForm" id="addLinkForm">
                    <div id="left"><a href="#" onclick="javascript:document.addLinkForm.submit()"><img src="./img/add.png">&nbsp;&nbsp;Link hinzufügen</a></div>
                    <input type="hidden" name="cmd" value="addlink">
                </form>
            </div>

            <div id="header">
                <div id="linkname">Linkname</div>
                <div id="linkurl">URL</div>
                <?php if ($_SESSION['isAdmin'] == 1) { ?>
                <div id="linkprivate">Privat</div>
                <?php } ?>
                <div id="action">&nbsp;</div>
            </div>

            <?php
            $sql = "SELECT * FROM pinboard_links";
            if($_SESSION['isAdmin'] == 1)
                $sql .= " where (uid = " . $_SESSION['uid'] . " or uid = 0)";
            else
                $sql .= " where uid = " . $_SESSION['uid'];
            $sql .= " ORDER BY name ASC";
            $result = mysql_query($sql);
            while ($link = mysql_fetch_object($result)) {
            ?>
            <div id="listitem">
                <form method="POST" enctype="multipart/form-data" name="editlinkForm<?php echo $link->link_id; ?>" id="editForm">
                    <div id="linkname"><input type="text" name="linkname" value="<?php echo $link->name; ?>"></div>
                    <div id="linkurl"><input type="text" name="linkurl" value="<?php echo $link->url; ?>"></div>
                    <?php if ($_SESSION['isAdmin'] == 1) { ?>
                    <div id="linkprivate"><input type="checkbox" name="linkprivate" <?php if ($link->uid > 0) echo "checked"; ?> ></div>
                    <?php } else { ?>
                    <div id="linkprivate"><input type="hidden" name="linkprivate" value="1"></div>
                    <?php } ?>
                    <input type="hidden" name="cmd" value="editlink">
                    <input type="hidden" name="link_id" value="<?php echo $link->link_id; ?>">
                </form>
                <div id="action">
                    <form method="POST" enctype="multipart/form-data" name="deletelinkForm<?php echo $link->link_id; ?>" id="deleteForm">
                        <input type="hidden" name="cmd" value="deletelink">
                        <input type="hidden" name="link_id" value="<?php echo $link->link_id; ?>">
                    </form>
                    <a href="#" onclick="javascript:document.editlinkForm<?php echo $link->link_id; ?>.submit()" title="Änderungen speichern"><img src="./img/save.png"></a>
                    &nbsp;
                    <a href="javascript:document.deletelinkForm<?php echo $link->link_id; ?>.submit()" title="Benutzer löschen" onclick="javascript:return confirm('Soll der Link \'<?php echo $link->name; ?>\' wirklich gelöscht werden ?');"><img src="./img/delete.png"></a>
                </div>
            </div>
            <?php
            }
            ?>
        </section>

        <section class="main_configuration_personal">
            <h1><span>Mailkonfiguration</span></h1>
            <?php
            $sql = "SELECT mailserver_type, mailserver_encryption, mailserver_host, mailserver_port, mailserver_login, mailserver_password FROM usersettings where uid = " . $_SESSION['uid'];
            $result = mysql_query($sql);
            $mailserver = mysql_fetch_object($result);
            ?>
            <form method="POST" enctype="multipart/form-data" name="editMailserverForm" id="editMailserverForm">
                <div id="listitem">
                    <div id="text">Postfach Typ:</div>
                    <div id="value"><?php displayMailserverTypes($mailserver->mailserver_type); ?>&nbsp;</div>
                </div>
                <div id="listitem">
                    <div id="text">Mailserver:</div>
                    <div id="value"><input type="text" name="mailserver_host" value="<?php echo $mailserver->mailserver_host; ?>"></div>
                </div>
                <div id="listitem">
                    <div id="text">Port:</div>
                    <div id="value"><input type="text" name="mailserver_port" value="<?php echo $mailserver->mailserver_port; ?>"></div>
                </div>
                <div id="listitem">
                    <div id="text">Verschlüsselung:</div>
                    <div id="value"><?php displayMailserverEncryption($mailserver->mailserver_encryption); ?>&nbsp;</div>
                </div>
                <div id="listitem">
                    <div id="text">Login:</div>
                    <div id="value"><input type="text" name="mailserver_login" value="<?php echo $mailserver->mailserver_login; ?>"></div>
                </div>
                <div id="listitem">
                    <div id="text">Passwort:</div>
                    <div id="value"><input type="password" name="mailserver_password" value="<?php echo $mailserver->mailserver_password; ?>"></div>
                </div>
                <input type="hidden" name="cmd" value="savemailserver">
                <div id="submit"><input id="greybutton" type="submit" value="Mailkonfiguration ändern"></div>
            </form>
        </section>

        <section class="main_configuration_personal">
            <h1><span>Kennwort</span></h1>
            <form method="POST" enctype="multipart/form-data" name="editPasswordForm" id="editPasswordForm">
                <div id="listitem">
                    <div id="text">Altes Kennwort:</div>
                    <div id="value"><input type="password" name="oldpassword"></div>
                </div>
                <div id="listitem">
                    <div id="text">Neues Kennwort:</div>
                    <div id="value"><input type="password" name="newpassword"></div>
                </div>
                <?php if (isset($errormsg) {?>
                  <div id="listitem">
                      <div id="errormsg"><center><?php echo $errormsg; ?></center></div>
                  </div>
                <?php } elseif (isset($successmsg) {?>
                  <div id="listitem">
                      <div id="successmsg"><center><?php echo $successmsg; ?></center></div>
                  </div>
                <?php } ?>
                <input type="hidden" name="cmd" value="editpassword">
                <div id="submit"><input id="greybutton" type="submit" value="Kennwort ändern"></div>
            </form>
        </section>
    </body>
</html>
