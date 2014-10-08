<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';
    include dirname(__FILE__).'/../includes/sessionhandler.php';

    function saveImage($imagedata)
    {
        $imagedata = addslashes(base64_decode(split(',',$imagedata)[1]));

        // insert new image
        $sql = "INSERT INTO bindata set data = '".$imagedata."'";
        mysql_query($sql);

        return mysql_insert_id();
    }

    function getImage($id)
    {
        $sql = "select data from bindata where binid = ".$id;
        $que = mysql_query($sql);

        if (is_object($que)) {
          $obj = mysql_fetch_object($que);
          return $obj->data;
        } else {
          return NULL;
        }
    }

    function deleteImage($id)
    {
        $sql = "delete from bindata where binid = ".$id;
        mysql_query($sql);
    }

    /*
    * COMMON
    */
    if (isset($_GET['cmd']) && $_GET['cmd'] == "getimage" && isset($_GET['id'])) {
        header("Content-Type: image/jpeg");
        echo getImage($_GET['id']);
    }

    /*
    * PINBOARD NOTES
    */
    if (isset($_POST['cmd']) && $_POST['cmd'] == "savenote") {
        $title = $_POST['title'];
        $content = $_POST['content'];

        if (strlen($title) > 0 || strlen($content) > 0) {
            // #FIXME - make this more dynamic as domains not always start with www ...
            // set urls to real hyperlinks
            $content = preg_replace('@((https?://)?([-\w]+\.[-\w\.]+)+\w(:\d+)?(/([-\w/_\.]*(\?\S+)?)?)*)@', '<a href="$1" target="blank">$1</a>', $content);
            $content = str_replace("href=\"www.","href=\"http://www.",$content);

            $sql = "INSERT INTO notes set title = '" . $title . "', content = '" . str_replace("\n", "<br/>", $content) . "', created_by = " . $_SESSION['uid'] . ", create_date = now(), modified_date = now(), papercolor = '" . $_POST['papercolor'] . "'";
            $retVal = mysql_query($sql);
            if ($retVal) {
                $newid = mysql_insert_id();

                $sql = "SELECT no_id, title, content, DATE_FORMAT(create_date , '%d.%m.%Y') create_date, DATE_FORMAT(create_date , '%H:%i') create_time, papercolor, users.username from notes join users on users.uid = notes.created_by where notes.isActive = 1 and (notes.visible_to = 'public' or notes.visible_to like '%".$_SESSION['uid']."%') and no_id = ".$newid." order by create_date desc";
                $result = mysql_query($sql);
                while ($note = mysql_fetch_object($result)) {
                    // random pin cap
                    $pin = rand(1,5);
                    // random pin rotation
                    $rotation_pin = rand(-45,0);
                    // random note rotation
                    $rotation_note = rand(-3,3);
                    // random note margin-top;
                    $margin_note = rand(-1,20);

                    print("<div class=\"note_".$note->papercolor."\" style=\"-webkit-transform:rotate(".$rotation_note."deg); margin-top:".$margin_note."px\" id=\"note-".$note->no_id."\">");
                        print("<div id=\"pin".$pin."\" style=\"-webkit-transform:rotate(".$rotation_pin."deg);\"></div>");
                        print("<div class=\"closenote\" id=\"closenote-".$note->no_id."\"></div>");
                        print("<div id=\"title\">".$note->title."</div>");
                        print("<div id=\"content\">".$note->content."</div>");
                        print("<div id=\"footer\">".$note->username." am ".$note->create_date." um ".$note->create_time."</div>");
                    print("</div>");
                }
            }
        }
    }
    if (isset($_POST['cmd']) && $_POST['cmd'] == "closenote" && isset($_POST['id'])) {
        $sql = "UPDATE notes SET isActive = 0 where no_id = " . $_POST['id'];
        mysql_query($sql);
    }

    /*
    * CONFIGURATION_PINBOARD
    */
    function displayBlockTypes($type)
    {
        $return = "<select name=\"type\" class=\"directsave\">";
            $return .= "<option ".($type == "1"? "selected" : "")." value=\"1\">Wertanzeige</option>";
            $return .= "<option ".($type == "2"? "selected" : "")." value=\"2\">Abfallmeldung</option>";
            $return .= "<option ".($type == "3"? "selected" : "")." value=\"3\">Anrufe in Abwesenheit</option>";
            $return .= "<option ".($type == "4"? "selected" : "")." value=\"4\">Ungelesene Mails</option>";
            $return .= "<option ".($type == "5"? "selected" : "")." value=\"5\">Wettermeldungen</option>";
        $return .= "</select>";

        return $return;
    }
    function displayDevices($dev_id)
    {
        $return = "";

        $selected = false;
        $sql = "select devices.dev_id, devices.name devicename, devices.identifier, types.name typename from devices join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id order by identifier asc";

        $result = mysql_query($sql);
        $return .= "<select name=\"dev_id\" class=\"directsave\">";
        $return .= "<option ".($dev_id == -1 ? "selected" : "")." value=\"-1\"></option>";
        while ($device = mysql_fetch_object($result)) {
            if ($device->typename == "Webcam") {
                continue;
            }

            if(strlen($device->identifier) > 0)
                $return .= "<option ".($dev_id == $device->dev_id ? "selected" : "")." value=\"".$device->dev_id.";".utf8_encode($device->typename)."\">".utf8_encode($device->devicename)."&emsp;[".$device->identifier."]</option>";
            else
                $return .= "<option ".($dev_id == $device->dev_id ? "selected" : "")." value=\"".$device->dev_id.";".utf8_encode($device->typename)."\">".utf8_encode($device->devicename)."</option>";
        }

        $return .= "</select>";

        return $return;
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == "pinboard_getmetainfo") {
        if (isset($_POST['id'])) {
            $sql = "select meta from pinboard_configuration where id=".$_POST['id'];
            $result = mysql_fetch_object(mysql_query($sql));

            echo $result->meta;
        }
    }
    if (isset($_POST['cmd']) && $_POST['cmd'] == "pinboard_updateposition") {
        if (isset($_POST['block'])) {
            $pos = 0;
            foreach ($_POST['block'] as $id) {
                $sql = "update pinboard_configuration set position = ".$pos." where id = ".$id;
                mysql_query($sql);

                $pos++;
            }
        } elseif (isset($_POST['row'])) {
            $pos = 0;
            foreach ($_POST['row'] as $id) {
                $sql = "update pinboard_configuration set position = ".$pos." where id = ".$id;
                mysql_query($sql);

                $pos++;
            }
        }
    }
    if (isset($_POST['cmd']) && $_POST['cmd'] == "pinboard_update") {
        if (isset($_POST['updateid']) && isset($_POST['updatekey']) && isset($_POST['updatevalue'])) {
            $sql = "select meta from pinboard_configuration where id = ".$_POST['updateid'];
            $obj = mysql_fetch_object(mysql_query($sql));
            $meta = json_decode($obj->meta);

            $meta->{$_POST['updatekey']} = htmlentities(trim($_POST['updatevalue']));

            $sql = "update pinboard_configuration set meta = '".json_encode($meta)."' where id = ".$_POST['updateid'];
            mysql_query($sql);
        }
    }
    if (isset($_POST['cmd']) && $_POST['cmd'] == "pinboard_getdevicedata") {
        if (isset($_POST['id'])) {
            $dev_value = "";
            if (isset($_POST['dev_value'])) {
                $dev_value = $_POST['dev_value'];
            }

            echo "<option value=\"\" ".($selection == "" ? "selected" : "")."></option>";
            $result = mysql_query("select identifier from devices where dev_id = ".$_POST['id']);
            while ($device_identifier = mysql_fetch_object($result)) {
                $result2 = mysql_query("select distinct valuename from device_data where deviceident = '".$device_identifier->identifier."' order by valuename");
                while ($identifier = mysql_fetch_object($result2)) {
                    $sql = "select value name from configuration where configstring = '@".utf8_encode($identifier->valuename)."' and dev_id = ".$_POST['id'];
                    $translation = mysql_fetch_object(mysql_query($sql));
                    echo "<option value=\"".$identifier->valuename."\" ".($dev_value == $identifier->valuename ? "selected" : "").">".(strlen($translation->name) > 0 ? "".utf8_encode($translation->name)."" : $identifier->valuename)."</option>";
                }
            }
        }
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == "pinboard_block_new") {
        if (isset($_POST['owner'])) {
            $meta = array(
                'title' =>htmlentities('{Titel}'),
                'iconid' => -1,
                'type' => 1
                );

            // get new insert position
            $sql = "select case when max(position) is null then 0 else max(position)+1 end newposition from pinboard_configuration where owner = '".$_POST['owner']."' and parentid is null";
            $result = mysql_fetch_object(mysql_query($sql));
            $newPosition = $result->newposition;

            $sql = "insert into pinboard_configuration set owner = '".$_POST['owner']."', meta = '".json_encode($meta)."', position = ".$newPosition;
            $retVal = mysql_query($sql);
            if ($retVal) {
                print("<div id=\"block-".mysql_insert_id()."\">");
                    print("<div class=\"icon\" id=\"headline_icon\"></div><div id=\"headline\">".$meta['title']."</div><div id=\"headline_type\">".displayBlockTypes($meta['type'])."</div><div id=\"headline_action\"><a href=\"#\" class=\"newRowButton\" title=\"Gerät hinzufügen\"><img src=\"./img/add.png\"></a>&nbsp;&nbsp;<a href=\"#\" class=\"deleteBlockButton\" title=\"Bereich löschen\"><img src=\"./img/delete.png\"></a></div>");
                    print("<div id=\"appendRows-".mysql_insert_id()."\" class=\"sortable\">");
                    print("</div>");
                print("</div>");
            }
        }
    }
    if (isset($_POST['cmd']) && $_POST['cmd'] == "pinboard_block_delete") {
        if (isset($_POST['id'])) {
            // delete rows as well
            $sql = "delete from pinboard_configuration where parentid = ".$_POST['id'];
            mysql_query($sql);

            // delete referenced icons as well
            $sql = "select meta from pinboard_configuration where id = ".$_POST['id'];
            $obj = mysql_fetch_object(mysql_query($sql));
            $meta = json_decode($obj->meta);
            if ($meta->iconid != -1) {
                $sql = "delete from bindata where binid = ".$meta->iconid;
                mysql_query($sql);
            }

            // delete block
            $sql = "delete from pinboard_configuration where id = ".$_POST['id'];
            mysql_query($sql);
        }
    }
    if (isset($_POST['cmd']) && $_POST['cmd'] == "pinboard_block_saveimage" && isset($_POST['assignid'])) {
        $imageid = saveImage($_POST['data']);

        // assign imageid to block icon
        if ($imageid != NULL) {
            $sql = "select meta from pinboard_configuration where id = ".$_POST['assignid'];
            $result = mysql_fetch_object(mysql_query($sql));
            $meta = json_decode($result->meta);

            // delete old icon
            if ($meta->iconid != -1) {
                deleteImage($meta->iconid);
            }

            $meta->iconid = $imageid;
            $sql = "update pinboard_configuration set meta = '".json_encode($meta)."' where id = ".$_POST['assignid'];
            mysql_query($sql);
        }
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == "pinboard_row_new") {
        if (isset($_POST['owner']) && isset($_POST['parentid'])) {
            $meta = array(
                'title' => htmlentities('{Bezeichner}'),
                'dev_id' => -1,
                'dev_value' => ""
                );

            // get new insert position
            $sql = "select case when max(position) is null then 0 else max(position)+1 end newposition from pinboard_configuration where owner = '".$_POST['owner']."'";
            $result = mysql_fetch_object(mysql_query($sql));
            $newPosition = $result->newposition;

            $sql = "insert into pinboard_configuration set owner = '".$_POST['owner']."', meta = '".json_encode($meta)."', parentid = ".$_POST['parentid'].", position = ".$newPosition;
            $retVal = mysql_query($sql);
            if ($retVal) {
                print("<div id=\"row-".mysql_insert_id()."\"><div id=\"text\">".$meta['title']."</div><div id=\"value\">".displayDevices($meta['dev_id'])."<select id=\"dev_value\" name=\"dev_value\" class=\"directsave\"></select></div><div id=\"action\"><a href=\"#\" class=\"deleteRowButton\" title=\"Gerät löschen\"><img src=\"./img/delete.png\"></a></div></div>");
            }
        }
    }
    if (isset($_POST['cmd']) && $_POST['cmd'] == "pinboard_row_delete") {
        if (isset($_POST['id'])) {
            $sql = "delete from pinboard_configuration where id = ".$_POST['id'];
            mysql_query($sql);
        }
    }

    /*
    * CONFIGURATION USERS
    */
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

    if (isset($_POST['cmd']) && $_POST['cmd'] == "addnewuser") {
        $sql = "INSERT INTO users (username,password) values ('Neuer Benutzer','')";
        mysql_query($sql);

        $uid = mysql_insert_id();

        $sql = "INSERT INTO usergroups (uid,gid) values (".$uid.",1)";
        mysql_query($sql);

        $sql = "INSERT INTO usersettings (uid) values (".$uid.")";
        mysql_query($sql);

        print("<div class=\"listitem\" id=\"listitem-".$uid."\">");
            print("<div id=\"username\"><input type=\"text\" name=\"username\" value=\"Neuer Benutzer\"></div>");
            print("<div id=\"password\"><input type=\"password\" name=\"password\" value=\"\"></div>");
            print("<div id=\"group\">");
            displayUserGroup('1');
            print("</div>");
            print("<div id=\"action\">");
                print("<a href=\"javascript:copyToClipboard('')\" title=\"Quick Login\"><img src=\"./img/quicklogin.png\"></a>&nbsp;");
                print("<a class=\"saveuserbutton\" id=\"saveuserbutton-".$uid."\" href=\"#\" title=\"Änderungen speichern\"><img src=\"./img/save.png\"></a>&nbsp;&nbsp;");
                print("<a class=\"deleteuserbutton\" id=\"deleteuserbutton-".$uid."\" href=\"#\" title=\"Benutzer löschen\"><img src=\"./img/delete.png\"></a>");
            print("</div>");
        print("</div>");
    }
    if (isset($_POST['cmd']) && $_POST['cmd'] == "saveuser") {
        if ($_SESSION['uid'] != $_POST['uid']) {
            $hash = md5($_POST['username'] + $_POST['password'] + time());

            $sql = "update users set username = '" . $_POST['username'] . "', password = '" . md5($_POST['password']) . "', hash = '".$hash."' where uid = ".$_POST['uid'];
            mysql_query($sql);

            $sql = "update usergroups set gid = " . $_POST['usergroup'] . " where uid = ".$_POST['uid'];
            mysql_query($sql);
        }
    }
    if (isset($_POST['cmd']) && $_POST['cmd'] == "deleteuser") {
        if ($_SESSION['uid'] != $_POST['uid']) {
            $sql = "delete from users where uid = ".$_POST['uid'];
            mysql_query($sql);

            $sql = "delete from usergroups where uid = ".$_POST['uid'];
            mysql_query($sql);

            $sql = "delete from usersettings where uid = ".$_POST['uid'];
            mysql_query($sql);
        }
    }
?>
