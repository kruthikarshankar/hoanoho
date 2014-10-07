<?php
    include dirname(__FILE__).'/includes/dbconnection.php';
    include dirname(__FILE__).'/includes/sessionhandler.php';
    include dirname(__FILE__).'/includes/getConfiguration.php';

    function displayUserGroup($gid)
    {
        $sql = "select * from groups order by grpname asc";

        $result = mysql_query($sql);
        echo "<select name=\"usergroup\">";
        while ($group = mysql_fetch_object($result)) {
            echo "<option ".($gid == $group->gid ? "selected" : "")." value=\"".$group->gid."\">".$group->grpname."</option>";
        }
        echo "</select>";
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == "edituser") {
        $hash = md5($_POST['username'] + $_POST['password'] + time());

        $sql = "update users set username = '" . $_POST['username'] . "', password = '" . md5($_POST['password']) . "', hash = '".$hash."' where uid = ".$_POST['uid'];
        mysql_query($sql);

        $sql = "update usergroups set gid = " . $_POST['usergroup'] . " where uid = ".$_POST['uid'];
        mysql_query($sql);
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
        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Einstellungen - Benutzer</title>

        <script type="text/javascript" src="./js/jquery.min.js"></script>
        <script src="./js/jquery-ui.min.js"></script>

        <script language="javascript">
            function copyToClipboard(text)
            {
                window.prompt ("In die Zwischenablage kopieren: Ctrl+C, Enter", text);
            }

            $(document).ready(function () {
                //##### send addnewuser Ajax request to dataoperator.php #########
                $("#adduserbutton").click(function (e) {
                        e.preventDefault();

                        var myData = 'cmd=addnewuser';
                        jQuery.ajax({
                        type: "POST",
                        url: "helper/datacontroller.php",
                        dataType:"text", // Data type, HTML
                        data:myData, //Form variables
                        success:function (response) {
                            $("#listitems").append(response);
                        },
                        error:function (xhr, ajaxOptions, thrownError) {
                            alert(thrownError);
                        }
                        });
                });

                //##### Send saveuser Ajax request to dataoperator.php #########
                $("#listitems").delegate(".saveuserbutton", "click", function (e) {
                    e.preventDefault();

                    var thiselem = this;
                    var clickedID = thiselem.id.split('-'); //Split ID string (Split works as PHP explode)
                    var DbNumberID = clickedID[1]; //and get number from array

                    // get post parameters
                    var post_username = $("#listitem-"+DbNumberID).find("input[name='username']");
                    var post_password = $("#listitem-"+DbNumberID).find("input[name='password']");
                    var post_usergroup = $("#listitem-"+DbNumberID).find("select[name='usergroup']");

                    var myData = 'cmd=saveuser&uid='+DbNumberID+'&username='+$(post_username).val()+'&password='+$(post_password).val()+'&usergroup='+$(post_usergroup).val(); //build a post data structure
                    jQuery.ajax({
                    type: "POST",
                    url: "helper/datacontroller.php",
                    dataType:"text", // Data type
                    data:myData, //Form variables
                    success:function (response) {
                        $("#listitem-"+DbNumberID).effect("highlight", {color:"#caef59"});
                    },
                    error:function (xhr, ajaxOptions, thrownError) {
                        $("#listitem-"+DbNumberID).effect("highlight", {color:"#ff5f5f"});
                        alert(thrownError);
                    }
                    });
                });

                //##### Send deleteuser Ajax request to dataoperator.php #########
                $("#listitems").delegate(".deleteuserbutton", "click", function (e) {
                    e.preventDefault();

                    if (confirm('Soll dieser Benutzer wirklich gelöscht werden ?') === true) {
                        var thiselem = this;
                        var clickedID = thiselem.id.split('-'); //Split ID string (Split works as PHP explode)
                        var DbNumberID = clickedID[1]; //and get number from array
                        var myData = 'cmd=deleteuser&uid='+DbNumberID; //build a post data structure

                        jQuery.ajax({
                        type: "POST",
                        url: "helper/datacontroller.php",
                        dataType:"text", // Data type
                        data:myData, //Form variables
                        success:function (response) {
                            //on success, hide  element user wants to delete.
                            $('#listitem-'+DbNumberID).fadeOut();
                        },
                        error:function (xhr, ajaxOptions, thrownError) {
                            alert(thrownError);
                        }
                        });
                    }
                });
            });
        </script>
    </head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <section class="main_configuration">
        <h1><span>Benutzer</span></h1>

        <div id="toolbar">
                <div id="left"><a id="adduserbutton" href="#"><img src="./img/add.png">&nbsp;&nbsp;Benutzer hinzufügen</a></div>
        </div>

        <div id="header">
            <div id="username">Benutzername</div>
            <div id="password">Passwort</div>
            <div id="group">Gruppe</div>
            <div id="action">&nbsp;</div>
        </div>

        <div id="listitems">
        <?php
        $sql = "SELECT * FROM users join usergroups on usergroups.uid = users.uid join groups on groups.gid = usergroups.gid ORDER BY username ASC";
        $result = mysql_query($sql);
        while ($user = mysql_fetch_object($result)) {
        ?>
            <div class="listitem" id="listitem-<?php echo $user->uid; ?>">
                <div id="username"><input type="text" name="username" value="<?php echo $user->username; ?>"></div>
                <div id="password"><input type="password" name="password"></div>
                <div id="group"><?php displayUserGroup($user->gid); ?></div>
                <div id="action">
                    <a href="javascript:copyToClipboard('<?php echo "/login.php?login=".$user->hash; ?>')" title="Quick Login"><img src="./img/quicklogin.png"></a>
                    <a class="saveuserbutton" id="saveuserbutton-<?php echo $user->uid; ?>" href="#" title="Änderungen speichern"><img src="./img/save.png"></a>&nbsp;
                    <a class="deleteuserbutton" id="deleteuserbutton-<?php echo $user->uid; ?>" href="#" title="Benutzer löschen"><img src="./img/delete.png"></a>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
    </section>
</body>
</html>
