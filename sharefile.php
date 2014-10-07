<?php
    include dirname(__FILE__).'/includes/dbconnection.php';
    include dirname(__FILE__).'/includes/sessionhandler.php';
    include dirname(__FILE__).'/includes/getConfiguration.php';

    function rotateImage($content, $type, $orientation)
    {
        $deg = 0;

        ob_start();
        $image = imagecreatefromstring($content);

        switch ($orientation) {
            case 3:
                $deg = 180;
                break;
            case 6:
                $deg = -90;
                break;
            case 8:
                $deg = 90;
                break;
        }

        $image = imagerotate($image, $deg, 0);

        if($type = "image/jpeg")
            imagejpeg($image);
        else if($type = "image/png")
            imagepng($image);
        else if($type = "image/gif")
            imagegif($image);

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    $calcfactor = 0;
    preg_match('/[0-9]+/', ini_get('post_max_size'), $maxsize_value);
    preg_match('/[a-z,A-Z]+/', ini_get('post_max_size'), $maxsize_unit);
    if ($maxsize_unit[0] == "K") {
        $calcfactor = 1024;
        $maxsize_unit_human = "KByte";
    } elseif ($maxsize_unit[0] == "M") {
        $calcfactor = (1024*1024);
        $maxsize_unit_human = "MByte";
    } elseif ($maxsize_unit[0] == "G") {
        $calcfactor = (1024*1024*1024);
        $maxsize_unit_human = "GByte";
    }

    $MAX_FILE_SIZE = $maxsize_value[0]*$calcfactor;

    if (isset($_POST['cmd']) && $_POST['cmd'] == "uploadfile") {
        if ($_FILES && $_FILES['file']['name']) {
            //make sure the file has a valid file extension

            $file_info = pathinfo($_FILES['file']['name']);
            $acceptable_ext = 0;

            if ($_FILES['file']['size'] > $MAX_FILE_SIZE) {
                header('Location: ./sharefile.php?r=1');
            }

            $hash = md5(utf8_encode($_FILES['file']['name']).time());
            $fileName = utf8_encode($_FILES['file']['name']);
            $tmpName  = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileType = $_FILES['file']['type'];

            // Slurp the content of the file into a variable
            $fp = fopen($tmpName, 'r');
            $content = fread($fp, filesize($tmpName));
            fclose($fp);

            // read exifdata and rotate the image if needed
            if (strstr($fileType, "image")) {
                $exif_data = exif_read_data($_FILES['file']['tmp_name']);

                if($exif_data !== false)
                    $content = rotateImage($content, $fileType, $exif_data['Orientation']);
            }

            $content = addslashes($content);

            if (!get_magic_quotes_gpc()) {
                $fileName = addslashes($fileName);
            }

            $filePassword = "null";
            if(strlen($_POST['password']) > 0)
                $filePassword = "'".md5($_POST['password'])."'";

            $file_info = pathinfo($_FILES['file']['name']);

            $sql = "INSERT INTO sharedfiles SET Hash = '".$hash."', File_Name = '".$fileName."', File_Type = '".$fileType."', File_Size = '".$fileSize."', File_Content = '".$content."', File_Extension = '".$file_info['extension']."', File_Date = NOW(),  File_ValidDate = NOW()+INTERVAL 1 WEEK, File_AccessPassword = ".$filePassword.", File_AccessPasswordPlain = '".$_POST['password']."', uid = " . $_SESSION['uid'];
            mysql_query($sql);

            header('Location: ./sharefile.php?r=0&h='.$hash);
        }
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "deletefile" && isset($_POST['sid'])) {
        $sql = "DELETE FROM sharedfiles where sid = " . $_POST['sid'];
        mysql_query($sql);
    } elseif (isset($_GET['cmd']) && $_GET['cmd'] == "extendfile" && isset($_GET['sid']) && strlen($_GET['sid']) > 0) {
         $sql = "UPDATE sharedfiles SET File_ValidDate = NOW()+INTERVAL 1 WEEK WHERE sid = " . $_GET['sid'];
         mysql_query($sql);
    }
?>

<html>
    <head>
        <meta charset="UTF-8" />

        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/sharefile.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

        <script type="text/javascript" src="./js/nicEdit.js"></script>

        <link rel="apple-touch-icon" href="./img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Netzwerk - Übersicht</title>

        <script language="javascript">
            function copyToClipboard(text)
            {
                window.prompt ("In die Zwischenablage kopieren: Ctrl+C, Enter", text);
            }
        </script>
    </head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <?php if (isset($_GET['sid']) && !isset($_GET['cmd'])) { ?>
        <section class="main">
            <h1><span>Zugriffsübersicht</span></h1>

            <div id="toolbar">
                    <a href="sharefile.php"><div id="left"><img src="./img/back.png">&nbsp;&nbsp;Zurück</div></a>
            </div>

            <div id="header">
                <div id="accessdate">Zugriffsdatum</div>
                <div id="accessip">Zugriff von IP</div>
                <div id="browser">Browser</div>
            </div>

            <?php
            $sql = "SELECT date_format(accessdate, '%d.%m.%Y %H:%i:%S') as accessdate, accessip, useragent FROM sharedfiles_accesslog WHERE sid = " . $_GET['sid'] . " ORDER BY accessdate desc";
            $result = mysql_query($sql);
            while ($log = mysql_fetch_object($result)) {
                if($log->useragent == "")
                    $useragent = "&nbsp;";
                else
                    $useragent = $log->useragent;

                echo "<div id=\"listitem\">";
                    echo "<div id=\"accessdate\">".$log->accessdate."</div>";
                    echo "<div id=\"accessip\">".$log->accessip."</div>";
                    echo "<div id=\"browser\">".$useragent."</div>";
                echo "</div>";
            }
            ?>
        </section>
    <?php } else { ?>
        <section class="main">
            <span><h1>Datei bereitstellen</h1></span>
                <form method="POST" enctype="multipart/form-data" name="uploadFileForm" id="uploadFileForm">
                <div id="edit">
                    <div id="space">&nbsp;</div>
                    <?php if (!isset($_GET['r'])) { ?>
                        <div id="text">Datei auswählen:</div><div id="value"><input id="file" name="file" type="file"> (Max. <?php echo $maxsize_value[0]." ".$maxsize_unit_human; ?>)</div>
                        <div id="text">Passwort für Zugriff:</div><div id="value"><input id="password" name="password" value="<?php if (isset($report->name)) { echo utf8_encode($report->name);} ?>"></div>
                        <div id="space">&nbsp;</div>
                        <div id="submit"><input type="submit" id="greenbutton" name="submit" value="Bereitstellen"></div>
                        <input type="hidden" id="cmd" name="cmd" value="uploadfile">
                    <?php } else { ?>
                        <?php if ($_GET['r'] == 1) { ?>
                            <div id="message">Die Datei konnte nicht bereitgestellt werden. Eventuell überschreitet sie die maximale Dateigröße von <?php echo $maxsize_value[0]." ".$maxsize_unit_human; ?></div>
                        <?php } elseif ($_GET['r'] == 0) { ?>
                            <div id="message">Die Datei wurde erfolgreich bereitgestellt: <br><br><a target="_blank" href="<?php echo "http://".$__CONFIG['sharefile_remoteaddress']."/?f=".$_GET['h']; ?>"><?php echo "http://".$__CONFIG['sharefile_remoteaddress']."/?f=".$_GET['h']; ?></a></div>
                            <div id="space">&nbsp;</div>
                            <div id="space">&nbsp;</div>
                            <div id="submit"><input type="button" id="greybutton" name="submit" value="eine weitere Datei bereitstellen" onclick="self.location.href='sharefile.php'"></div>
                        <?php } ?>
                    <?php } ?>
                </div>
                </form>
        </section>

        <section class="main">
            <h1><span>Bereitgestellte Dateien</span></h1>
            <div id="space">&nbsp;</div>
            <div id="header">
                <div id="name">Dateiname</div>
                <div id="status">Status</div>
                <div id="counter">Zugriffe</div>
                <div id="lastaccess">Letzter Zugriff</div>
                <div id="action">&nbsp;</div>
            </div>
            <?php
            $sql = "SELECT *, date_format(File_ValidDate, '%d.%m.%Y %H:%i:%S') validuntil, (select date_format(accessdate, '%d.%m.%Y %H:%i:%S') from sharedfiles_accesslog where sid = sharedfiles.sid order by accessdate desc limit 0,1) lastaccessdate, (select count(id) from sharedfiles_accesslog where sid = sharedfiles.sid) accesscounter, case when File_ValidDate >= NOW() then 0 else 1 end as status, case when File_AccessPassword is not null then 1 else 0 end protected FROM sharedfiles where uid = ".$_SESSION['uid']." order by file_date desc, file_name asc";
            $result = mysql_query($sql);
            $nooresults = mysql_num_rows($result);
            if ($nooresults > 0) {
                while ($file = mysql_fetch_object($result)) {
                    if(!$file->lastaccessdate)
                        $LastAccessDate = "bisher kein Zugriff";
                    else
                        $LastAccessDate = $file->lastaccessdate;

                    if($file->status == 0)
                        $status = "<img src=\"./img/valid.png\" title=\"gültig bis ".$file->validuntil."\">";
                    else
                        $status = "<img src=\"./img/invalid.png\" title=\"ungültig seit ".$file->validuntil."\">";

                    if($file->protected == 1)
                        $protected = "<img src=\"./img/lock.png\" title=\"Passwortgeschützt\nPasswort: ".$file->File_AccessPasswordPlain."\">";
                    else
                        $protected = "";
                ?>
                    <div id="listitem">
                        <div id="name"><a href="<?php echo "http://".$__CONFIG['sharefile_remoteaddress']."/?f=".$file->Hash; ?>" target="_blank" title="<?php echo "Dateityp: ".$file->File_Type."\nDateigröße: ".$file->File_Size." Byte"; ?>"><?php echo utf8_decode($file->File_Name); ?></a></div>
                        <div id="status"><?php echo $status.$protected; ?></div>
                        <div id="counter"><?php echo $file->accesscounter; ?></div>
                        <div id="lastaccess"><?php echo $LastAccessDate; ?></div>
                        <div id="action">
                                <form method="POST" enctype="multipart/form-data" name="deleteFileForm<?php echo $file->SID; ?>" id="deleteFileForm">
                                    <input type="hidden" name="cmd" value="deletefile">
                                    <input type="hidden" name="sid" value="<?php echo $file->SID; ?>">
                                </form>
                                <a href="javascript:copyToClipboard('<?php echo "http://".$__CONFIG['sharefile_remoteaddress']."/?f=".$file->Hash; ?>')" title="Link kopieren"><img src="./img/link.png"></a>&nbsp;&nbsp;&nbsp;
                                <a href="sharefile.php?sid=<?php echo $file->SID; ?>" title="Zugriffsübersicht"><img src="./img/log.png"></a>&nbsp;&nbsp;&nbsp;
                                <a href="sharefile.php?cmd=extendfile&sid=<?php echo $file->SID; ?>" title="Zugriff verlängern"><img src="./img/extend_file.png"></a>&nbsp;&nbsp;&nbsp;
                                <a href="javascript:document.deleteFileForm<?php echo $file->SID; ?>.submit()" title="Bereitstellung aufheben" onclick="javascript:return confirm('Soll die Bereitstellung für die Datei \'<?php echo utf8_encode($file->File_Name); ?>\' wirklich aufgehoben werden ?');"><img src="./img/delete.png"></a>
                        </div>
                    </div>
                <?php
                }
                ?>
            <?php } else { ?>
                <div id="listitem">
                    <div id="message">Es sind im Moment keine Dateien bereitgestellt.</div>
                </div>
            <?php } ?>
        </section>
    <?php } ?>
</body>
</html>
