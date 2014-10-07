<?php
    include dirname(__FILE__).'/includes/dbconnection.php';
    include dirname(__FILE__).'/includes/sessionhandler.php';
    include dirname(__FILE__).'/includes/getConfiguration.php';

    function displayBaseTypes($type_id)
    {
        $empty = 0;
        $sql = "select * from types order by name asc";

        $result = mysql_query($sql);
        print("<select name=\"type_id\">");
        while ($type = mysql_fetch_object($result)) {
            if (is_null($type_id) && $empty == 0) {
                print("<option selected value=\"".$type->type_id."\"></option>");
                $empty = 1;
            }

            print("<option ".($type_id == $type->type_id ? "selected" : "")." value=\"".$type->type_id."\">".utf8_encode($type->name)."</option>");
        }
        print("</select>");
    }

    function displayTypes($dev_id, $dtype_id)
    {
        $empty = 0;
        #$sql = "select * from device_types order by name asc";
        $sql = "select dtype_id, device_types.name device_type_name, types.name basetype_name, image_off_id, image_on_id, imagesize from device_types join types on types.type_id = device_types.type_id order by device_types.name asc";

        $result = mysql_query($sql);
        print("<select name=\"dtype_id\" onchange=\"displayFieldsForDeviceModal('".$dev_id."', this.value);\">");
        while ($type = mysql_fetch_object($result)) {
            if (is_null($dtype_id) && $empty == 0) {
                print("<option selected value=\"".$type->dtype_id."\"></option>");
                $empty = 1;
            }

            print("<option ".($dtype_id == $type->dtype_id ? "selected" : "")." value=\"".$type->dtype_id.";".$type->basetype_name."\">".utf8_encode($type->device_type_name)."</option>");
        }
        print("</select>");
    }

    function displayWebcamVendors($vendor, $dev_id)
    {
        print("<select id=\"vendor".$dev_id."\" name=\"vendor\" onchange=\"javascript:displayWebcamModels(this.value, ".$dev_id.");\">");
            print("<option ".($vendor == "" ? "selected" : "")." value=\"\"></option>");
            print("<option ".($vendor == "instar" ? "selected" : "")." value=\"instar\">Instar</option>");
        print("</select>");
    }

    function displayWebcamModels($vendor, $model, $dev_id)
    {
        print("<select id=\"model".$dev_id."\" name=\"model\" onchange=\"javascript:set_webcam_positionslots(".$dev_id.",this.value)\">");
            print("<option ".($model == "" ? "selected" : "")." value=\"\"></option>");
            if ($vendor == "instar") {
                //print("<option ".($model == "IN-2901" ? "selected" : "")." value=\"IN-2901\">IN-2901</option>");
                //print("<option ".($model == "IN-2904" ? "selected" : "")." value=\"IN-2904\">IN-2904</option>");
                //print("<option ".($model == "IN-2905" ? "selected" : "")." value=\"IN-2905\">IN-2905</option>");
                //print("<option ".($model == "IN-2907" ? "selected" : "")." value=\"IN-2907\">IN-2907</option>");
                //print("<option ".($model == "IN-2908" ? "selected" : "")." value=\"IN-2908\">IN-2908</option>");
                //print("<option ".($model == "IN-3001" ? "selected" : "")." value=\"IN-3001\">IN-3001</option>");
                //print("<option ".($model == "IN-3003" ? "selected" : "")." value=\"IN-3003\">IN-3003</option>");
                //print("<option ".($model == "IN-3005" ? "selected" : "")." value=\"IN-3005\">IN-3005</option>");
                print("<option ".($model == "IN-3010" ? "selected" : "")." value=\"IN-3010\">IN-3010</option>");
                //print("<option ".($model == "IN-3011" ? "selected" : "")." value=\"IN-3011\">IN-3011</option>");
                //print("<option ".($model == "IN-4009" ? "selected" : "")." value=\"IN-4009\">IN-4009</option>");
                print("<option ".($model == "IN-4010" ? "selected" : "")." value=\"IN-4010\">IN-4010</option>");
                //print("<option ".($model == "IN-4011" ? "selected" : "")." value=\"IN-4011\">IN-4011</option>");
                //print("<option ".($model == "IN-5907" ? "selected" : "")." value=\"IN-5907\">IN-5907</option>");
                //print("<option ".($model == "IN-6011" ? "selected" : "")." value=\"IN-6011\">IN-6011</option>");
                //print("<option ".($model == "IN-6012" ? "selected" : "")." value=\"IN-6012\">IN-6012</option>");
                //print("<option ".($model == "IN-7011" ? "selected" : "")." value=\"IN-7011\">IN-7011</option>");
            }
        print("</select>");
    }

    function displayGPIOProtocols($dev_id,$protocol)
    {
        print("<select id=\"gpio_raspi_protocol".$dev_id."\" name=\"gpio_raspi_protocol\">");
            print("<option ".($protocol == "" ? "selected" : "")." value=\"\"></option>");
            print("<option ".($protocol == "http" ? "selected" : "")." value=\"http\">HTTP</option>");
            print("<option ".($protocol == "https" ? "selected" : "")." value=\"https\">HTTPS</option>");
        print("</select>");
    }

    function getBinData($bindid)
    {
        $sql = "select data from bindata where binid = ".$bindid;
        $result = mysql_query($sql);
        while ($bindata = mysql_fetch_object($result)) {
            if(stristr($bindata->data, "png") != false)

                return ('data:image/png;base64,' . base64_encode($bindata->data));
            else
                return ('data:image/jpeg;base64,' . base64_encode($bindata->data));
        }
    }

    /*function displayNetworkDevices($nd_id) {
        $sql = "select * from network_devices order by name asc";
        $result = mysql_query($sql);

        print("<select name=\"nd_id\">");
        if($nd_id == "")
            print("<option selected value=\"\"></option>");
        else
            print("<option value=\"\"></option>");

        while ($device = mysql_fetch_object($result)) {
            print("<option ".($nd_id == $device->nd_id ? "selected" : "")." value=\"".$device->nd_id."\">".utf8_encode($device->name)."</option>");
        }

        print("</select>");
    }*/

    /*function displayPinboardCategories($pcat) {
        print("<select name=\"pcat\">");
            print("<option ".($pcat == "Hausüberblick"? "selected" : "")." value=\"Hausüberblick\">Hausüberblick</option>");
            print("<option ".($pcat == "Energie"? "selected" : "")." value=\"Energie\">Energie</option>");
        print("</select>");
    }*/

    function displayRooms($room_id)
    {
        $sql = "select room_id, rooms.name room_name, device_floors.name floor_name from rooms join device_floors on device_floors.floor_id = rooms.floor_id order by device_floors.position asc, rooms.name asc";
        $result = mysql_query($sql);

        print("<select name=\"room_id\">");
        if($room_id == "")
            print("<option selected value=\"\"></option>");
        else
            print("<option value=\"\"></option>");

        while ($room = mysql_fetch_object($result)) {
            print("<option ".($room_id == $room->room_id ? "selected" : "")." value=\"".$room->room_id."\">".utf8_encode($room->floor_name)." - ".utf8_encode($room->room_name)."</option>");
        }

        print("</select>");
    }

    function displayFloors($floor_id)
    {
        $sql = "select * from device_floors order by position asc";
        $result = mysql_query($sql);

        print("<select name=\"floor_id\">");
        if($floor_id == "")
            print("<option selected value=\"null\"></option>");
        else
            print("<option value=\"null\"></option>");

        while ($floor = mysql_fetch_object($result)) {
            print("<option ".($floor_id == $floor->floor_id ? "selected" : "")." value=\"".$floor->floor_id."\">".utf8_encode($floor->name)."</option>");
        }

        print("</select>");
    }

    if (isset($_POST['cmd']) && $_POST['cmd'] == "adddevice") {
        $sql = "select dtype_id from device_types order by name asc limit 1";
        $result = mysql_query($sql);
        while ($devicetype = mysql_fetch_object($result)) {
            $sql = "INSERT INTO devices (name,identifier,dtype_id,floor_id) values ('".utf8_decode("Neues Gerät")."','',".$devicetype->dtype_id.",".$_POST['floor_id'].")";
            mysql_query($sql);
        }
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "editdevice") {
        $isStructure = "";
        $isHidden = "";

        if(isset($_POST['isStructure']))
            $isStructure = $_POST['isStructure'];

        if(isset($_POST['isHidden']))
            $isHidden = $_POST['isHidden'];

        $nd_id = "null";
        if($_POST['nd_id'] != "")
            $nd_id = $_POST['nd_id'];

        $room_id = "null";
        if($_POST['room_id'] != "")
            $room_id = $_POST['room_id'];

        $dtype_id = $_POST['dtype_id'];
        if (strpos($dtype_id,";") !== FALSE) {
            $tmp = explode(';', $dtype_id);
            $dtype_id = $tmp[0];
        }

        $url = "http://localhost/includes/sendMessageToSocketServer.php?command=\"update_device\"&message=\"".$_POST['dev_id']."\"";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_exec($curl);
        curl_close($curl);

        $sql = "update devices set name = '" . utf8_decode($_POST['name']) . "', identifier = '" . utf8_decode($_POST['identifier']) . "', room_id = " . $room_id . ", dtype_id = " . $dtype_id . ", isStructure = '" . $isStructure . "', isHidden = '" . $isHidden . "', nd_id = " . $nd_id . " where dev_id = ".$_POST['dev_id'];
        mysql_query($sql);

        // save device configurations
        // delete all configuration entries before
        $sql = "DELETE from configuration where dev_id = " . $_POST['dev_id'];
        $result = mysql_query($sql);
        // check if keys are already in the database
        foreach ($_POST as $key=>$value) {
            if($key == "cmd" || $key == "submit" || $key == "dev_id" || $key == "identifier" || $key == "dtype_id" || $key == "room_id" || $key == "name" || $key == "datacollector_value")
                continue;

            if (strlen(trim($value)) > 0) {
                $sql = "INSERT INTO configuration (dev_id, configstring, value) VALUES (".$_POST['dev_id'].",'".utf8_decode($key)."','".utf8_decode($value)."')";
                mysql_query($sql);
            } else {
                $sql = "DELETE FROM configuration where dev_id = ".$_POST['dev_id']." and configstring = '".utf8_decode($key)."'";
                mysql_query($sql);
            }
        }
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "deletedevice") {
        $sql = "delete from devices where dev_id = ".$_POST['dev_id'];
        $result = mysql_query($sql);

        // delete configurations too
        $sql = "delete from configuration where dev_id = ".$_POST['dev_id'];
        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "addtype") {
        $sql = "select type_id from types order by type_id asc limit 1";
        $result = mysql_query($sql);
        while ($type = mysql_fetch_object($result)) {
            $sql = "INSERT INTO device_types (name, type_id) values ('".utf8_decode("Neuer Gerätetyp")."', " . $type->type_id . ")";
            mysql_query($sql);
        }
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "edittype") {
        $off_imageid = 0;
        $on_imageid = 0;

        $sql = "update device_types set name = '" . utf8_decode($_POST['name']) . "', type_id = " . $_POST['type_id'] . ", imagesize = '" . utf8_decode($_POST['imagesize']) . "'";

        $sql .= " where dtype_id = ".$_POST['dtype_id'];

        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "deletetype") {
        $sql = "delete from device_types where dtype_id = ".$_POST['dtype_id'];
        $result = mysql_query($sql);

        if (mysql_num_rows($result) > 0) {
            $sql = "DELETE FROM bindata where binid = (SELECT image_off_id from device_types where dtype_id = " . $_POST['dtype_id'] . ")";
            mysql_query($sql);

            $sql = "DELETE FROM bindata where binid = (SELECT image_on_id from device_types where dtype_id = " . $_POST['dtype_id'] . ")";
            mysql_query($sql);
        }
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "addroom") {
        $sql = "INSERT INTO rooms (name) values ('".utf8_decode("Neuer Raum")."')";
        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "editroom") {
        $sql = "update rooms set name = '" . utf8_decode($_POST['name']) . "', floor_id = ".$_POST['floor_id'].", position = " . $_POST['position'];

        $sql .= " where room_id = ".$_POST['room_id'];

        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "deleteroom") {
        $sql = "UPDATE devices set room_id = null where room_id = " . $_POST['room_id'];
        mysql_query($sql);

        $sql = "DELETE FROM rooms where room_id = " . $_POST['room_id'];
        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "addfloor") {
        $sql = "INSERT INTO device_floors (name,position) values ('".utf8_decode("Neue Ebene")."',0)";
        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "editfloor") {
        $sql = "update device_floors set name = '" . utf8_decode($_POST['name']) . "', position = '" . utf8_decode($_POST['position']) . "'";

        $sql .= " where floor_id = ".$_POST['floor_id'];

        mysql_query($sql);
    } elseif (isset($_POST['cmd']) && $_POST['cmd'] == "deletefloor") {
        $sql = "DELETE FROM bindata where binid = (SELECT image_id from device_floors where floor_id = " . $_POST['floor_id'] . ")";
        mysql_query($sql);

        $sql = "DELETE FROM devices where floor_id = " . $_POST['floor_id'];
        mysql_query($sql);

        $sql = "delete from device_floors where floor_id = ".$_POST['floor_id'];
        mysql_query($sql);
    }
?>

<html>
    <head>
        <script type="text/javascript" src="./js/jquery.min.js"></script>
        <script type="text/javascript" src="./js/Events.js"></script>
        <script type="text/javascript" src="./js/Dragdrop.js"></script>

        <script language="javascript">
        var activeModalDiv = "";

        window.onload = function () {
            //adding the event listerner for Mozilla
            if (window.addEventListener) {
                document.addEventListener('DOMMouseScroll', preventScrolling, false);
                document.addEventListener('touchmove',preventScrolling, false);
            }

            //for IE/OPERA etc
            document.onmousewheel = preventScrolling;
            window.onscroll = preventScrolling;

            // file upload event for floorplan image upload
            $('#floorplan_filebutton').click(function () {
                $('input[name="image_id"]').click();
             });

            $('#type_filebutton_on').click(function () {
                $('input[name="image_on_id"]').click();
             });

            $('#type_filebutton_off').click(function () {
                $('input[name="image_off_id"]').click();
             });
        }

        /* ******************************* */
        /* GENERAL HELPER FUNCTIONS        */
        /* ******************************* */
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

        function uploadFile(input)
        {
            var storeURL = "./includes/storeFile.php";
            var associateURL = "./includes/associateFile.php";

            var associate_id = document.getElementById("modal-image_associate_id").value;

            var target_column = input.name;
            var type = document.getElementById("modal-image_type").value;

            var inserted_image_id = null;

            var reader = new FileReader();
            var storeData = new FormData();

            reader.onload = function (e) {
                var storeRequest = new ajaxRequest();

                storeRequest.onreadystatechange = function () {
                    if (storeRequest.readyState == 4 && storeRequest.status == 200) {
                        if (storeRequest.responseText != "") {
                            var associateData = new FormData();

                            if (type == "floor") {
                                associateData.append('table_name', "device_floors");
                                associateData.append('constraint_column', "floor_id");
                            } else {
                                associateData.append('table_name', "device_types");
                                associateData.append('constraint_column', "dtype_id");
                            }

                            associateData.append('target_column', target_column);
                            associateData.append('target_id', associate_id);
                            associateData.append('file_id', storeRequest.responseText);
                            inserted_image_id = storeRequest.responseText;

                            var associateRequest = new ajaxRequest();
                            associateRequest.open("POST", associateURL, true);

                            associateRequest.send(associateData);

                            // refresh image
                              associateRequest.onreadystatechange = function () {
                                  if (associateRequest.readyState == 4 && associateRequest.status == 200) {
                                    var update_image_frame = null;

                                    if (type == "floor") {
                                        update_image_frame = document.getElementById("modal-image_image");
                                    } else {
                                        update_image_frame = document.getElementsByName("modal-image_icon");

                                        if(target_column == "image_off_id")
                                            update_image_frame[0].style.backgroundImage = "url(./helper/datacontroller.php?cmd=getimage&id="+inserted_image_id+")";
                                        else if(target_column == "image_on_id")
                                            update_image_frame[1].style.backgroundImage = "url(./helper/datacontroller.php?cmd=getimage&id="+inserted_image_id+")";
                                    }
                                }
                            };
                        }
                    }
                };

                storeData.append('data', e.target.result);

                storeRequest.open("POST", storeURL, true);
                storeRequest.send(storeData);
            };

            reader.readAsDataURL(input.files[0]);

            input.value = "";

            return false;
        }

        /* ************************************ */
        /* HELPERS FOR DISPLAYING MODAL WINDOWS */
        /* ************************************ */
        //window.onscroll = function () { window.scrollTo(0, 0); };

        function MakeCenter(object)
        {
            if (object !=null) {
                var left=(object.offsetParent.clientWidth/2)-(object.clientWidth/2)+object.offsetParent.scrollLeft;
                var top=((object.offsetParent.clientHeight/2)-(object.clientHeight/2)+object.offsetParent.scrollTop + (window.innerHeight/2)) - (object.offsetHeight/4);
                object.style.top = top;
                object.style.left = left;
            }
        }

        function preventScrolling(event)
        {
            if (activeModalDiv != "") {
                event.preventDefault();
                document.body.style.overflow ="hidden";
            } else
                document.body.style.overflow ="auto";
        }

        function toggleModal(modal_name, module, device_id, associate_id, current_image_ids)
        {
            if(device_id != null)
                var el = document.getElementById(modal_name + device_id);
            else
                var el = document.getElementById(modal_name);

            var elbg = document.getElementById("modal-background");

            if (activeModalDiv == "") {
                if(device_id != null)
                    activeModalDiv = modal_name + device_id;
                else
                    activeModalDiv = modal_name;

                MakeCenter(el);
            } else {
                activeModalDiv = "";
            }

            if (module == "floor" || module == "type") {
                var title = document.getElementById("modaltitle");
                var eltmp = null;

                eltmp = document.getElementById("modal-image_type");
                eltmp.value = module;

                eltmp = document.getElementById("modal-image_associate_id");
                eltmp.value = associate_id;
            }

            if (module == "floor") {
                title.innerHTML = "Grundriss";

                eltmp = document.getElementById("section_floor");
                eltmp.style.display = "block";
                eltmp = document.getElementById("section_type");
                eltmp.style.display = "none";

                eltmp = document.getElementById("modal-image_image");

                if(current_image_ids.length > 0)
                    eltmp.style.backgroundImage = "url(./helper/datacontroller.php?cmd=getimage&id="+current_image_ids[0]+")";
                else {
                    eltmp.style.backgroundSize = "60% auto";
                    eltmp.style.backgroundImage = "url(./img/photo_placeholder.png)";
                }
            } else if (module == "type") {
                title.innerHTML = "Gerätetyp Icons";

                eltmp = document.getElementById("section_floor");
                eltmp.style.display = "none";
                eltmp = document.getElementById("section_type");
                eltmp.style.display = "block";

                if (current_image_ids.length > 0) {
                    var eltmp2 = document.getElementsByName("modal-image_icon");
                    eltmp2[1].style.backgroundImage = "url(./helper/datacontroller.php?cmd=getimage&id="+current_image_ids[0]+")";
                    eltmp2[0].style.backgroundImage = "url(./helper/datacontroller.php?cmd=getimage&id="+current_image_ids[1]+")";
                } else {
                    var eltmp2 = document.getElementsByName("modal-image_icon");
                    eltmp2[0].style.backgroundSize = "60% auto";
                    eltmp2[0].style.backgroundImage = "url(./img/photo_placeholder.png)";
                    eltmp2[1].style.backgroundSize = "60% auto";
                    eltmp2[1].style.backgroundImage = "url(./img/photo_placeholder.png)";
                }
            } else {
                eltmp = document.getElementById("section_floor");
                eltmp.style.display = "none";
                eltmp = document.getElementById("section_type");
                eltmp.style.display = "none";
            }

            if(elbg.style.display == "" || elbg.style.display == "none")
                elbg.style.display = elbg.style.display = "block";
            else
                $(elbg).fadeOut(300);

            el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";

            return false;
        }

        /* ******************************* */
        /* HIDE AND SHOW ADDITIONAL FIELDS */
        /* ******************************* */
        function hideAllFieldsForDeviceModal(dev_id, input)
        {
            if (input.indexOf(";") > -1) {
                var exploded_input = input.split(";");
                var basetype = exploded_input[1];
            } else {
                var basetype = input;
            }

            var elem = document.getElementById("properties_webcam_"+dev_id);
            elem.style.display = "none";

            var elem = document.getElementById("properties_datacollector_"+dev_id);
            elem.style.display = "none";

            var elem = document.getElementById("properties_gpio_"+dev_id);
            elem.style.display = "none";
        }

        function displayFieldsForDeviceModal(dev_id, input)
        {
            if (input.indexOf(";") > -1) {
                var exploded_input = input.split(";");
                var basetype = exploded_input[1];
            } else {
                var basetype = input;
            }

            hideAllFieldsForDeviceModal(dev_id, input);

            // display all needed fields for type auto
            if (basetype == "Webcam") {
                var elem = document.getElementById("properties_webcam_"+dev_id);
                elem.style.display = "block";
            } else if (basetype == "Datensammler") {
                showDataCollectorIdentifierList(dev_id);

                var elem = document.getElementById("properties_datacollector_"+dev_id);
                elem.style.display = "block";
            } else if (basetype == "Raspberry Pi GPIO") {
                var elem = document.getElementById("properties_gpio_"+dev_id);
                elem.style.display = "block";
            } else {
                hideAllFieldsForDeviceModal(dev_id, input);
            }
        }

        function showDataCollectorIdentifierList(dev_id)
        {
            if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
                var xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xmlhttp.onreadystatechange=function () {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    document.getElementById("replacetxt_"+dev_id).innerHTML=xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","helper/datacollector_getIdentifiersForConfigurationInterface.php?dev_id="+dev_id,true);
            xmlhttp.send();
        }

        function displayWebcamModels(model, dev_id)
        {
            var elem = document.getElementById("model"+dev_id);
            elem.options.length = 0;

            elem.options[elem.options.length] = new Option('', '');
            if (model == "instar") {
                //elem.options[elem.options.length] = new Option('IN-2901', 'IN-2901');
                //elem.options[elem.options.length] = new Option('IN-2905', 'IN-2905');
                //elem.options[elem.options.length] = new Option('IN-2907', 'IN-2907');
                //elem.options[elem.options.length] = new Option('IN-2908', 'IN-2908');
                //elem.options[elem.options.length] = new Option('IN-3001', 'IN-3001');
                //elem.options[elem.options.length] = new Option('IN-3003', 'IN-3003');
                //elem.options[elem.options.length] = new Option('IN-3005', 'IN-3005');
                elem.options[elem.options.length] = new Option('IN-3010', 'IN-3010');
                //elem.options[elem.options.length] = new Option('IN-3011', 'IN-3011');
                //elem.options[elem.options.length] = new Option('IN-4009', 'IN-4009');
                elem.options[elem.options.length] = new Option('IN-4010', 'IN-4010');
                //elem.options[elem.options.length] = new Option('IN-4011', 'IN-4011');
                //elem.options[elem.options.length] = new Option('IN-5907', 'IN-5907');
                //elem.options[elem.options.length] = new Option('IN-6011', 'IN-6011');
                //elem.options[elem.options.length] = new Option('IN-6012', 'IN-6012');
                //elem.options[elem.options.length] = new Option('IN-7011', 'IN-7011');
            }
        }

        function set_webcam_positionslots(dev_id, model)
        {
            var elem = document.getElementById("positionslots"+dev_id);
            if(model == "IN-3010")
                elem.value = 15;
            else if(model == "IN-4010")
                elem.value = 8;
            else
                elem.value = "";
        }
        </script>

        <meta charset="UTF-8" />

        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/configuration.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <?php
            // dynamically generate base css code for device types
            $sql = "select * from device_types";
            $result = mysql_query($sql);

            print("<style type=\"text/css\">");
            while ($type = mysql_fetch_object($result)) {
                print(".main_configuration_automation .type".$type->dtype_id." { background-image: url('./helper/datacontroller.php?cmd=getimage&id=".$type->image_off_id."'); background-repeat: no-repeat; background-position: center; }");
            }
            print("</style>");

            // dynamically generate css code for floors
            $sql = "select floor_id, image_id from device_floors order by position asc";
            $result = mysql_query($sql);

            print("<style type=\"text/css\">");
            while ($floor = mysql_fetch_object($result)) {
                print(".main_configuration_automation #floor".$floor->floor_id." { width: 640px; height: 480px; background-image: url('./helper/datacontroller.php?cmd=getimage&id=".$floor->image_id."'); background-repeat: no-repeat; background-position: center; background-size: 95%; }");
            }
            print("</style>");

            // dynamically generate css code for fhem devices and modal windows
            $sql = "select devices.dev_id, devices.identifier, devices.name, pos_x, pos_y, device_types.imagesize, types.name typename, devices.isStructure, devices.isHidden from devices join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id";
            $result = mysql_query($sql);

            print("<style type=\"text/css\">");
            while ($device = mysql_fetch_object($result)) {
                print("#modal-background { display: none; position: fixed; left: 0px; top:0px; width:100%; height:100%; z-index: 500; background-color: rgba(0,0,0,0.4); }");
                print("#modal-device".$device->dev_id." { visibility: hidden; position: absolute; left: 0px; top:0px; margin-right: 100px; margin-right: 100px; width:100%; height:100%; z-index: 1000;  }");
                print("#modal-device".$device->dev_id." a { color: #ff9300; }");
                print("#modal-device".$device->dev_id." a:hover { text-decoration: underline; }");
                print("#modal-device".$device->dev_id." #closebutton { cursor: pointer; z-index: 1; width: 40px; height: 40px; background-image: url('./img/close.png'); margin: 0 auto; margin-top:-32px; margin-left: 495px; background-size: 90%; background-repeat: no-repeat; }");
                print("#modal-device".$device->dev_id." h1 { width: 460px; text-align: center; float: none; font-size: 12px; font-weight: bold; color: #bdb5aa; padding-bottom: 8px; border-bottom: 1px solid #EBE6E2; text-shadow: 0 2px 0 rgba(255,255,255,0.8); box-shadow: 0 1px 0 rgba(255,255,255,0.8); display: inline-block; text-transform: uppercase; color: #6c6763; padding-right: 20px; padding-left: 20px; }");
                print("#modal-device".$device->dev_id." #section0 { width:500px; margin: 0 auto; background: #fffaf6; border-radius: 4px; color: #7e7975; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 12px rgba(255,255,255,0.4); padding: 10px; z-index: 1000; }");
                print("#modal-device".$device->dev_id." #section0 #text { width: 200px; float: left; margin-top: 12px; text-align: right; padding-right: 5px; }");
                print("#modal-device".$device->dev_id." #section0 #value { width: auto; margin-top: 10px; }");
                print("#modal-device".$device->dev_id." #section0 #value input { font: 13px Verdana, 'Lucida Grande'; width: 200px; height: 23px; border-color: #EBE6E2; border-width: 1px; border-style: solid; padding-left: 5px; padding-right: 5px; }");
                print("#modal-device".$device->dev_id." #section0 #value select { width: 200px; font: 13px Verdana, 'Lucida Grande'; height: 23px; border-color: #EBE6E2; border-width: 1px; border-style: solid; margin-left: -1px; }");
                print("#modal-device".$device->dev_id." #section0 #value input[type=checkbox] { margin-left: -2px; margin-top: 4px; height: 15px; }");
                print("#modal-device".$device->dev_id." #section0 input[id=greybutton] { margin-left: 115px; margin-right: auto; margin-top: 20px; width: 130px; height: 32px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 18px; text-align: center; background: #c0bebb; background: -moz-linear-gradient(#e1e0de, #c0bebb); background: -ms-linear-gradient(#e1e0de, #c0bebb); background: -o-linear-gradient(#e1e0de, #c0bebb); background: -webkit-gradient(linear, 0 0, 0 100%, from(#e1e0de), to(#c0bebb)); background: -webkit-linear-gradient(#e1e0de, #c0bebb); background: linear-gradient(#e1e0de, #c0bebb); border: 1px solid #7e7975; color: #262423; text-shadow: 0 1px rgba(255,255,255,0.3); }");
                print("#modal-device".$device->dev_id." #section0 input[id=greybutton]:hover { box-shadow: inset 0 1px rgba(255,255,255,0.8), inset 0 20px 40px rgba(255,255,255,0.5); }");
                print("#modal-device".$device->dev_id." #section0 input[id=greenbutton] { clear: left; margin-right: auto; margin-top: 20px; width: 130px; height: 32px; position: relative; box-shadow: inset 0 1px rgba(255,255,255,0.3); border-radius: 3px; cursor: pointer; font-size: 12px; line-height: 18px; text-align: center; background: #c6ee42; background: -moz-linear-gradient(#c6ee42, #a8ca38); background: -ms-linear-gradient(#c6ee42, #a8ca38); background: -o-linear-gradient(#c6ee42, #a8ca38); background: -webkit-gradient(linear, 0 0, 0 100%, from(#c6ee42), to(#a8ca38)); background: -webkit-linear-gradient(#c6ee42, #a8ca38); background: linear-gradient(#c6ee42, #a8ca38); border: 1px solid #8daa2f; color: #262423;  text-shadow: 0 1px rgba(255,255,255,0.3); }");
                print("#modal-device".$device->dev_id." #section0 input[id=greenbutton]:hover { box-shadow: inset 0 1px rgba(255,255,255,0.3), inset 0 20px 40px rgba(255,255,255,0.15); }");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." { width: 100%; }");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." #headline { width: 100%; font-weight: bold; margin-top: 5px; margin-bottom: 5px; }");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." #headline #text { margin-top: 0px; width: 97px; float: left; text-align: right; padding-right: 5px; }");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." #headline #value_ident { width: 150px; ; margin-right: 5px; float: left; }");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." #headline #value_label { width: auto; }");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." #row { width: 100%; clear: left; margin-bottom: 5px;}");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." #row #message { margin-top: 5px; margin-left: 15px; margin-right: 15px; width: auto; }");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." #row #text { margin-top: 3px; width: 97px; float: left; text-align: right; padding-right: 5px; }");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." #row #value_ident { width: 150px; ; margin-right: 5px; float: left; }");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." #row #value_label { width: auto; }");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." #row input { font: 13px Verdana, 'Lucida Grande'; width: 150px; height: 23px; border-color: #EBE6E2; border-width: 1px; border-style: solid; padding-left: 5px; padding-right: 5px; }");
                print("#modal-device".$device->dev_id." #section0 #properties_datacollector_".$device->dev_id." #replacetxt_".$device->dev_id." #row input[readonly] { background-color: #f0f0f0; }");

                if ($device->typename == "Temperaturregelung") {
                    print(".main_configuration_automation #device".$device->dev_id." { position: absolute; top: ".$device->pos_y."px; left: ".$device->pos_x."px; margin: auto; -moz-user-select: -moz-none; -khtml-user-select: none; -webkit-user-select: none; -ms-user-select: none; user-select: none; cursor: move; width: 28px; height: 28px; background-size: ".$device->imagesize."; border-radius: 5px; background-color: rgba(0,0,0,0.4); box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 0px rgba(255,255,255,0.4); }");
                    print(".main_configuration_automation #device".$device->dev_id.":hover { background-color: rgba(30,30,30,0.6); }");
                } elseif ($device->typename == "Wertanzeige") {
                    print(".main_configuration_automation #device".$device->dev_id." { position: absolute; width: 75px; height: 28px; top: ".$device->pos_y."px; left: ".$device->pos_x."px; margin: auto; -moz-user-select: -moz-none; -khtml-user-select: none; -webkit-user-select: none; -ms-user-select: none; user-select: none; cursor: move; background-color: rgba(0,0,0,0.4); border-radius: 5px; box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 0px rgba(255,255,255,0.4); }");
                    print(".main_configuration_automation #device".$device->dev_id.":hover { background-color: rgba(30,30,30,0.6); }");
                    print(".main_configuration_automation #device".$device->dev_id." #image { position: absolute; width: 28px; height: 28px; background-size: ".$device->imagesize."; float: left; }");
                    print(".main_configuration_automation #device".$device->dev_id." #value { position: absolute; width: auto; height: 28px; margin-left: 25px; line-height: 28px; vertical-align: mid; color: #e5e4e3; font-weight: bold; }");
                } elseif ($device->typename == "Dimmer") {
                    print(".main_configuration_automation #device".$device->dev_id." { position: absolute; top: ".$device->pos_y."px; left: ".$device->pos_x."px; margin: auto; -moz-user-select: -moz-none; -khtml-user-select: none; -webkit-user-select: none; -ms-user-select: none; user-select: none; cursor: move; width: 28px; height: 28px; background-size: ".$device->imagesize."; border-radius: 5px; background-color: rgba(0,0,0,0.4); box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 0px rgba(255,255,255,0.4); }");
                    print(".main_configuration_automation #device".$device->dev_id.":hover { background-color: rgba(30,30,30,0.6); }");
                } else {
                    print(".main_configuration_automation #device".$device->dev_id." { position: absolute; top: ".$device->pos_y."px; left: ".$device->pos_x."px; margin: auto; -moz-user-select: -moz-none; -khtml-user-select: none; -webkit-user-select: none; -ms-user-select: none; user-select: none; cursor: move; width: 28px; height: 28px; background-size: ".$device->imagesize."; border-radius: 5px; background-color: rgba(0,0,0,0.4); box-shadow: 0 2px 2px rgba(0,0,0,0.2), 0 1px 5px rgba(0,0,0,0.2), 0 0 0 0px rgba(255,255,255,0.4); }");
                    print(".main_configuration_automation #device".$device->dev_id.":hover { background-color: rgba(30,30,30,0.6); }");
                }

                // css code for device highlighting on floormap
                print(".main_configuration_automation #device".$device->dev_id.":hover ~ #device_listitem".$device->dev_id." { background-color: #f2edea; }");
            }
            print("</style>");
        ?>

        <?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

        <link rel="apple-touch-icon" href="./img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Einstellungen - Haussteuerung</title>
    </head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php');

    print("<div id=\"modal-background\">&nbsp;</div>");

    // Modal window for image upload
    print("<div id=\"modal-image\">");
        print("<div id=\"section0\">");
            print("<div id=\"closebutton\" onclick='javascript:toggleModal(\"modal-image\",null,\"\",null,null);'></div>");
            print("<h1><span id=\"modaltitle\"></span></h1>");

            print("<input type=\"hidden\" id=\"modal-image_type\">");
            print("<input type=\"hidden\" id=\"modal-image_associate_id\">");

            print("<div id=\"section_floor\">");
                print("<div id=\"center\">");
                    print("<div id=\"modal-image_image\"></div>");
                    print("<input type=\"button\" id=\"floorplan_filebutton\" value=\"Grundriss hochladen\"><input type=\"file\" id=\"fileuploadbutton\" name=\"image_id\" onchange=\"javascript:uploadFile(this);\">");
                print("</div>");
            print("</div>");

            print("<div id=\"section_type\">");
                print("<div id=\"icon_off\">");
                    print("<div id=\"modal-image_text\">Status 'Aus' (Standard):</div>");
                    print("<div id=\"modal-image_icon\" name=\"modal-image_icon\"></div>");
                        print("<input type=\"button\" id=\"type_filebutton_off\" value=\"Icon hochladen\"><input type=\"file\" id=\"fileuploadbutton\" name=\"image_off_id\" onchange=\"javascript:uploadFile(this);\">");
                print("</div>");

                print("<div id=\"spacer\">&nbsp;</div>");

                print("<div id=\"icon_on\">");
                    print("<div id=\"modal-image_text\">Status 'Ein':</div>");
                    print("<div id=\"modal-image_icon\" name=\"modal-image_icon\"></div>");
                        print("<input type=\"button\" id=\"type_filebutton_on\" value=\"Icon hochladen\"><input type=\"file\" id=\"fileuploadbutton\" name=\"image_on_id\" onchange=\"javascript:uploadFile(this);\">");
                print("</div>");

            print("</div>");

            print("<div id=\"spacer\"></div>");
        print("</div>");
    print("</div>");

    // Modal windows for fhem devices configuration dialog
    $sql = "select devices.dev_id, devices.identifier, devices.name, devices.nd_id, devices.room_id, devices.pos_x, devices.pos_y, devices.isStructure, devices.isHidden, types.name typename, device_types.dtype_id from devices left outer join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id";
    $result = mysql_query($sql);

    while ($device = mysql_fetch_object($result)) {
        // get additional configuration for device
        $sql_config = "SELECT * from configuration where dev_id = " . $device->dev_id;
        $result_config = mysql_query($sql_config);
        while ($device_config = mysql_fetch_object($result_config)) {

        }

        print("<div id=\"modal-device".$device->dev_id."\">");
            print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"editDeviceForm".$device->dev_id."\" id=\"editDeviceForm".$device->dev_id."\">");
            print("<div id=\"section0\">");
                print("<div id=\"closebutton\" onclick='javascript:editDeviceForm".$device->dev_id.".reset(); toggleModal(\"modal-device\",\"device\",".$device->dev_id.",\"\",null,null);'></div>");
                print("<h1><span>".utf8_encode($device->name)."</span></h1>");
                print("<div id=\"text\">Gerätename:</div><div id=\"value\"><input type=\"text\" name=\"name\" value=\"".utf8_encode($device->name)."\"></div>");
                print("<div id=\"text\">Kennung:</div><div id=\"value\"><input type=\"text\" name=\"identifier\" value=\"".utf8_encode($device->identifier)."\"></div>");
                print("<div id=\"text\">Gerätetyp:</div><div id=\"value\">");
                    displayTypes($device->dev_id, $device->dtype_id);
                print("</div>");
                print("<div id=\"clear\"></div>");
                print("<div id=\"clear\"></div>");
                print("<div id=\"text\">Raumzuordnung:</div><div id=\"value\">");
                    displayRooms($device->room_id);
                print("</div>");
                print("<div id=\"clear\"></div>");
                print("<div id=\"text\">Verstecken:</div><div id=\"value\"><input type=\"checkbox\" name=\"isHidden\" ".($device->isHidden == "on" ? "checked" : "")."></div>");
                print("<div id=\"text\">ist eine Gruppenschaltung:</div><div id=\"value\"><input type=\"checkbox\" name=\"isStructure\" ".($device->isStructure == "on" ? "checked" : "")."></div>");
                // additional settings
                // datacollector
                print("<div id=\"properties_datacollector_".$device->dev_id."\" style=\"display:".($device->typename == "Datensammler" ? "block" : "none").";\">");
                    print("<div id=\"clear\">&nbsp;</div>");
                    print("<h1><span>Felddefinitionen</span></h1>");
                    print("<div id=\"replacetxt_".$device->dev_id."\"></div>");
                print("</div>");
                // pvserver
                print("<div id=\"properties_pvserver_".$device->dev_id."\" style=\"display:".($device->typename == "PVServer" ? "block" : "none").";\">");
                    print("<div id=\"clear\">&nbsp;</div>");
                    print("<h1><span>Eigenschaften für PVServer</span></h1>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'pvserver_url' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">Web Interface URL:</div><div id=\"value\">");
                        print("<input type=\"text\" id=\"pvserver_url".$device->dev_id."\" name=\"pvserver_url\" value=\"".$deviceResult['value']."\">");
                    print("</div>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'pvserver_username' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">Benutzername:</div><div id=\"value\">");
                        print("<input type=\"text\" id=\"pvserver_username".$device->dev_id."\" name=\"pvserver_username\" value=\"".$deviceResult['value']."\">");
                    print("</div>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'pvserver_password' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">Passwort:</div><div id=\"value\">");
                        print("<input type=\"password\" id=\"pvserver_password".$device->dev_id."\" name=\"pvserver_password\" value=\"".$deviceResult['value']."\">");
                    print("</div>");
                print("</div>");
                // webcam
                print("<div id=\"properties_webcam_".$device->dev_id."\" style=\"display:".($device->typename == "Webcam" ? "block" : "none").";\">");
                    print("<div id=\"clear\">&nbsp;</div>");
                    print("<h1><span>Eigenschaften für Webcam</span></h1>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'vendor' and dev_id = " . $device->dev_id));
                    $webcam_vendor = $deviceResult['value'];
                    print("<div id=\"text\">Hersteller:</div><div id=\"value\">");
                        displayWebcamVendors($deviceResult['value'], $device->dev_id);
                    print("</div>");
                    print("<div id=\"clear\"></div>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'model' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">Modell:</div><div id=\"value\">");
                        displayWebcamModels($webcam_vendor, $deviceResult['value'], $device->dev_id);
                    print("</div>");
                    print("<div id=\"clear\"></div>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'ipaddress' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">IP-Adresse:</div><div id=\"value\">");
                        print("<input type=\"text\" id=\"ipaddress".$device->dev_id."\" name=\"ipaddress\" value=\"".$deviceResult['value']."\">");
                    print("</div>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'port' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">Port:</div><div id=\"value\">");
                        print("<input type=\"text\" id=\"port".$device->dev_id."\" name=\"port\" value=\"".$deviceResult['value']."\">");
                    print("</div>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'username' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">Benutzername:</div><div id=\"value\">");
                        print("<input type=\"text\" id=\"username".$device->dev_id."\" name=\"username\" value=\"".$deviceResult['value']."\">");
                    print("</div>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'password' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">Passwort:</div><div id=\"value\">");
                        print("<input type=\"password\" id=\"password".$device->dev_id."\" name=\"password\" value=\"".$deviceResult['value']."\">");
                    print("</div>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'invertcontrols' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">Steuerung invertieren:</div><div id=\"value\">");
                        print("<input type=\"checkbox\" id=\"invertcontrols".$device->dev_id."\" name=\"invertcontrols\" ".($deviceResult['value'] == 'on' ? "checked" : "").">");
                    print("</div>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'positionslots' and dev_id = " . $device->dev_id));
                    print("<input type=\"hidden\" id=\"positionslots".$device->dev_id."\" name=\"positionslots\">");
                print("</div>");
                // raspberry pi gpio
                print("<div id=\"properties_gpio_".$device->dev_id."\" style=\"display:".($device->typename == "Datensammler" ? "block" : "none").";\">");
                    print("<div id=\"clear\">&nbsp;</div>");
                    print("<h1><span>GPIO Konfiguration</span></h1>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'gpio_raspi_protocol' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">Protokoll:</div><div id=\"value\">");
                        displayGPIOProtocols($device->dev_id, $deviceResult['value']);
                    print("</div>");
                    print("<div id=\"clear\"></div>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'gpio_raspi_address' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">Raspberry IP-Adresse:</div><div id=\"value\">");
                        print("<input type=\"text\" id=\"gpio_raspi_address".$device->dev_id."\" name=\"gpio_raspi_address\" value=\"".$deviceResult['value']."\">");
                    print("</div>");
                    $deviceResult = mysql_fetch_assoc(mysql_query("SELECT value from configuration where configstring = 'gpio_outputpin' and dev_id = " . $device->dev_id));
                    print("<div id=\"text\">Ausgang Pin:</div><div id=\"value\">");
                        print("<input type=\"text\" id=\"gpio_outputpin".$device->dev_id."\" name=\"gpio_outputpin\" value=\"".$deviceResult['value']."\">");
                    print("</div>");
                print("</div>");
                print("<div id=\"clear\">&nbsp;</div>");
                print("<input type=\"hidden\" name=\"cmd\" value=\"editdevice\">");
                print("<input type=\"hidden\" name=\"dev_id\" value=\"".$device->dev_id."\">");
                print("<input type=\"reset\" id=\"greybutton\" name=\"resetbtn\" value=\"Zurücksetzen\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"button\" id=\"greenbutton\" value=\"Speichern\" onclick=\"javascript:editDeviceForm".$device->dev_id.".submit()\">");
                print("<div id=\"clear\">&nbsp;</div>");
            print("</div>");
            print("</form>");
        print("</div>");
    }

    // Floors
    print("<section class=\"main_configuration_automation\">");
    print("<h1><span>Gebäude Ebenen</span></h1>");

    print("<div id=\"toolbar\">");
        print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"addFloorForm\" id=\"addFloorForm\">");
            print("<input type=\"hidden\" name=\"cmd\" value=\"addfloor\">");
            print("<div id=\"left\"><a onclick=\"javascript:document.addFloorForm.submit();\" href=\"#\"><img src=\"./img/add.png\">&nbsp;&nbsp;Ebene hinzufügen</a></div>");
        print("</form>");
    print("</div>");

    print("<div id=\"headline\">");
        print("<div id=\"name\">Ebenenname</div>");
        print("<div id=\"floor_image_button\">Grundriss</div>");
        print("<div id=\"floor_position\">Position</div>");
        print("<div id=\"action\">&nbsp;</div>");
    print("</div>");

    $sql = "select * from device_floors order by position asc";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) > 0) {
        while ($floor = mysql_fetch_object($result)) {
            print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"editFloorForm".$floor->floor_id."\" id=\"editFloorForm".$floor->floor_id."\">");
            print("<div id=\"listitem\">");
                print("<div id=\"name\"><input type=\"text\" name=\"name\" value=\"".utf8_encode($floor->name)."\"></div>");
                print("<div id=\"floor_image_button\"><input type=\"button\" id=\"button\" onclick='javascript:var image_ids = [".$floor->image_id."]; toggleModal(\"modal-image\",\"floor\",null,".$floor->floor_id.",image_ids);' value='Verwalten'></div>");
                print("<div id=\"floor_position\"><input type=\"text\" name=\"position\" value=\"".utf8_encode($floor->position)."\"></div>");
                print("<input type=\"hidden\" name=\"cmd\" value=\"editfloor\">");
                print("<input type=\"hidden\" name=\"floor_id\" value=\"".$floor->floor_id."\">");
            print("</form>");
                print("<div id=\"action\">");
                print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"deleteFloorForm".$floor->floor_id."\" id=\"deleteFloorForm\">");
                    print("<input type=\"hidden\" name=\"cmd\" value=\"deletefloor\">");
                    print("<input type=\"hidden\" name=\"floor_id\" value=\"".$floor->floor_id."\">");
                print("</form>");
                print("<a href=\"#\" onclick=\"javascript:document.editFloorForm".$floor->floor_id.".submit()\" title=\"Änderungen speichern\"><img src=\"./img/save.png\"></a>&nbsp;&nbsp;&nbsp;&nbsp;");
                print("<a href=\"javascript:document.deleteFloorForm".$floor->floor_id.".submit()\" title=\"Ebene löschen\" onclick=\"javascript:return confirm('Soll die Ebene \'".utf8_encode($floor->name)."\' wirklich gelöscht werden ?');\"><img src=\"./img/delete.png\"></a>");
                print("</div>");
            print("</div>");
        }
    } else
        print("<div id=\"noentry\">Es wurden noch keine Gebäude Ebenen definiert!</div>");
    print("</section>");
    ?>

    <?php
    // Rooms
    print("<section class=\"main_configuration_automation\">");
    print("<h1><span>Räume</span></h1>");

    print("<div id=\"toolbar\">");
        print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"addRoomForm\" id=\"addRoomForm\">");
            print("<input type=\"hidden\" name=\"cmd\" value=\"addroom\">");
            print("<div id=\"left\"><a onclick=\"javascript:document.addRoomForm.submit();\" href=\"#\"><img src=\"./img/add.png\">&nbsp;&nbsp;Raum hinzufügen</a></div>");
        print("</form>");
    print("</div>");

    print("<div id=\"headline\">");
        print("<div id=\"room_name\">Raumname</div>");
        print("<div id=\"room_floor\">Ebene</div>");
        print("<div id=\"room_position\">Position</div>");
        print("<div id=\"action\">&nbsp;</div>");
    print("</div>");

    $sql = "select * from rooms order by name asc";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) > 0) {
        while ($room = mysql_fetch_object($result)) {
            print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"editRoomForm".$room->room_id."\" id=\"editRoomForm".$room->room_id."\">");
            print("<div id=\"listitem\">");
                print("<div id=\"room_name\"><input type=\"text\" name=\"name\" value=\"".utf8_encode($room->name)."\"></div>");
                print("<div id=\"room_floor\">");
                    displayFloors($room->floor_id);
                print("</div>");
                print("<div id=\"room_position\"><input type=\"text\" name=\"position\" value=\"".utf8_encode($room->position)."\"></div>");
                print("<input type=\"hidden\" name=\"cmd\" value=\"editroom\">");
                print("<input type=\"hidden\" name=\"room_id\" value=\"".$room->room_id."\">");
            print("</form>");
                print("<div id=\"action\">");
                print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"deleteRoomForm".$room->room_id."\" id=\"deleteRoomForm\">");
                    print("<input type=\"hidden\" name=\"cmd\" value=\"deleteroom\">");
                    print("<input type=\"hidden\" name=\"room_id\" value=\"".$room->room_id."\">");
                print("</form>");
                print("<a href=\"#\" onclick=\"javascript:document.editRoomForm".$room->room_id.".submit()\" title=\"Änderungen speichern\"><img src=\"./img/save.png\"></a>&nbsp;&nbsp;&nbsp;&nbsp;");
                print("<a href=\"javascript:document.deleteRoomForm".$room->room_id.".submit()\" title=\"Raum löschen\" onclick=\"javascript:return confirm('Soll der Raum \'".utf8_encode($room->name)."\' wirklich gelöscht werden ?');\"><img src=\"./img/delete.png\"></a>");
                print("</div>");
            print("</div>");
        }
    } else
        print("<div id=\"noentry\">Es wurden noch keine Räume definiert!</div>");
    print("</section>");
    ?>

    <?php
    // Types
    print("<section class=\"main_configuration_automation\">");
    print("<h1><span>Gerätetypen</span></h1>");

    print("<div id=\"toolbar\">");
        print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"addTypeForm\" id=\"addTypeForm\">");
            print("<input type=\"hidden\" name=\"cmd\" value=\"addtype\">");
            print("<div id=\"left\"><a onclick=\"javascript:document.addTypeForm.submit();\" href=\"#\"><img src=\"./img/add.png\">&nbsp;&nbsp;Gerätetyp hinzufügen</a></div>");
        print("</form>");
    print("</div>");

    print("<div id=\"headline\">");
        print("<div id=\"name\">Typname</div>");
        print("<div id=\"basetype\">Grundtyp</div>");
        print("<div id=\"image\">Icons</div>");
        print("<div id=\"imagesize\">Skalierung</div>");
        print("<div id=\"action\">&nbsp;</div>");
    print("</div>");

    $sql = "select * from device_types order by device_types.name asc";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) > 0) {
        while ($type = mysql_fetch_object($result)) {
            print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"editTypeForm".$type->dtype_id."\" id=\"editTypeForm".$type->dtype_id."\">");
            print("<div id=\"listitem\">");
                print("<div id=\"name\"><input type=\"text\" name=\"name\" value=\"".utf8_encode($type->name)."\"></div>");
                print("<div id=\"basetype\">");
                    displayBaseTypes($type->type_id);
                print("</div>");
                print("<div id=\"image\"><input type=\"button\" id=\"button\" onclick='javascript: var image_ids = [".$type->image_on_id.",".$type->image_off_id."]; toggleModal(\"modal-image\",\"type\",null,".$type->dtype_id.",image_ids);' value='Verwalten'></div>");
                print("<div id=\"imagesize\"><input type=\"text\" name=\"imagesize\" value=\"".utf8_encode($type->imagesize)."\"></div>");
                print("<input type=\"hidden\" name=\"cmd\" value=\"edittype\">");
                print("<input type=\"hidden\" name=\"dtype_id\" value=\"".$type->dtype_id."\">");
            print("</form>");
                print("<div id=\"action\">");
                print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"deleteTypeForm".$type->dtype_id."\" id=\"deleteTypeForm\">");
                    print("<input type=\"hidden\" name=\"cmd\" value=\"deletetype\">");
                    print("<input type=\"hidden\" name=\"dtype_id\" value=\"".$type->dtype_id."\">");
                print("</form>");
                print("<a href=\"#\" onclick=\"javascript:document.editTypeForm".$type->dtype_id.".submit()\" title=\"Änderungen speichern\"><img src=\"./img/save.png\"></a>&nbsp;&nbsp;&nbsp;&nbsp;");
                print("<a href=\"javascript:document.deleteTypeForm".$type->dtype_id.".submit()\" title=\"Gerätetyp löschen\" onclick=\"javascript:return confirm('Soll der Gerätetyp \'".utf8_encode($type->name)."\' wirklich gelöscht werden ?');\"><img src=\"./img/delete.png\"></a>");
                print("</div>");
            print("</div>");
        }
    } else
        print("<div id=\"noentry\">Es wurden noch keine Gerätetypen definiert!</div>");
    print("</section>");
    ?>

    <?php
    // Plans
    $sql = "select * from device_floors order by position asc";
    $result = mysql_query($sql);
    while ($floor = mysql_fetch_object($result)) {
        // floor
        print("<section class=\"main_configuration_automation\">");
        print("<h1><span>".utf8_encode($floor->name)."</span></h1>");
        if($floor->position > 0)
            print("<div id=\"floor".$floor->floor_id."\"></div>");

        $sql2 = "select devices.dev_id, devices.identifier, devices.name, devices.pos_x, devices.pos_y, types.name typename, devices.isStructure, devices.isHidden, device_types.dtype_id from devices left outer join device_types on device_types.dtype_id = devices.dtype_id left outer join types on types.type_id = device_types.type_id";
        $sql2 .= " where devices.floor_id = ".$floor->floor_id;
        $result2 = mysql_query($sql2);
        while ($device = mysql_fetch_object($result2)) {
            if($device->isStructure == "on" || $device->isHidden == "on" || $floor->position == 0)
                continue;

            // device
            if($device->typename == "Temperaturregelung")
                print("<div id=\"device".$device->dev_id."\" class=\"type".$device->dtype_id."\"></div>");
            else if($device->typename == "Wertanzeige")
                print("<div id=\"device".$device->dev_id."\"><div class=\"type".$device->dtype_id."\" id=\"image\"></div><div id=\"value\">---</div></div>");
            else
                print("<div id=\"device".$device->dev_id."\" class=\"type".$device->dtype_id."\"></div>");
        }

        print("<div id=\"line\"></div>");

        // Devices
        print("<div id=\"toolbar\">");
            print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"addDeviceForm".$floor->floor_id."\" id=\"addDeviceForm".$floor->floor_id."\">");
                print("<input type=\"hidden\" name=\"floor_id\" value=\"".$floor->floor_id."\">");
                print("<input type=\"hidden\" name=\"cmd\" value=\"adddevice\">");
                print("<div id=\"left\"><a onclick=\"javascript:document.addDeviceForm".$floor->floor_id.".submit();\" href=\"#".utf8_encode($floor->name)."\"><img src=\"./img/add.png\">&nbsp;&nbsp;Gerät hinzufügen</a></div>");
            print("</form>");
        print("</div>");

        print("<div id=\"headline\">");
            print("<div id=\"device_icon\">&nbsp;</div>");
            print("<div id=\"device_room\">Raum</div>");
            print("<div id=\"device_name\">Gerätename</div>");
            print("<div id=\"device_identifier\">Kennung</div>");
            print("<div id=\"action\">&nbsp;</div>");
        print("</div>");

        $sql2 = "select rooms.name roomname, devices.dev_id, devices.identifier, devices.name, devices.pos_x, devices.pos_y, devices.isStructure, devices.isHidden, device_types.name typename, device_types.dtype_id, device_types.image_off_id, types.name basetypename from devices left outer join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id left outer join rooms on devices.room_id = rooms.room_id";
        $sql2 .= " where devices.floor_id = ".$floor->floor_id . " order by rooms.name asc, devices.name asc";
        $result2 = mysql_query($sql2);
        if (mysql_num_rows($result2) > 0) {
            while ($device = mysql_fetch_object($result2)) {
                print("<div id=\"device_listitem".$device->dev_id."\">");
                    print("<div id=\"device_icon\"><img src='".getBinData($device->image_off_id)."'></div>");
                    print("<div id=\"device_room\">".utf8_encode($device->roomname)."</div>");
                    print("<div id=\"device_name\">".utf8_encode($device->name)."</div>");
                    print("<div id=\"device_identifier\">".utf8_encode($device->identifier)."</div>");
                    print("<input type=\"hidden\" name=\"cmd\" value=\"editdevice\">");
                    print("<input type=\"hidden\" name=\"dev_id\" value=\"".$device->dev_id."\">");
                    print("<form method=\"POST\" enctype=\"multipart/form-data\" name=\"deleteDeviceForm".$device->dev_id."\" id=\"deleteDeviceForm\">");
                            print("<input type=\"hidden\" name=\"cmd\" value=\"deletedevice\">");
                            print("<input type=\"hidden\" name=\"dev_id\" value=\"".$device->dev_id."\">");
                    print("</form>");
                    print("<div id=\"action\">");
                    print("<a href=\"#".utf8_encode($floor->name)."\" onclick='javascript:displayFieldsForDeviceModal(".$device->dev_id.",\"".$device->basetypename."\");toggleModal(\"modal-device\",\"device\",".$device->dev_id.",null,null);' title=\"Gerät bearbeiten\"><img src=\"./img/edit.png\"></a>&nbsp;&nbsp;&nbsp;&nbsp;");
                    print("<a href=\"javascript:document.deleteDeviceForm".$device->dev_id.".submit()\" title=\"Gerät löschen\" onclick=\"javascript:return confirm('Soll das Gerät \'".utf8_encode($device->name)."\' mit der Kennung \'".utf8_encode($device->identifier)."\' wirklich gelöscht werden ?');\"><img src=\"./img/delete.png\"></a>");
                    print("</div>");
                print("</div>");
            }
        } else
            print("<div id=\"noentry\">Es wurden noch keine Geräte definiert!</div>");

        print("</section>");
    }
    ?>

    <?php
        // drag & drop
        $jsdragdevices_def = "";
        $jsdragdevices_act = "";
        $sql = "select devices.dev_id, types.name typename from devices join device_types on device_types.dtype_id = devices.dtype_id join types on types.type_id = device_types.type_id";
        $result = mysql_query($sql);
        while ($device = mysql_fetch_object($result)) {
            if($device->typename == "Gruppe")
                continue;

            $jsdragdevices_def .= "device".$device->dev_id." = document.getElementById('device".$device->dev_id."'),";
            $jsdragdevices_act .= "dragdrop.set(device".$device->dev_id.", {minX: 13, maxX: 652, minY: 43, maxY: 522});";
        }
        $jsdragdevices_def = substr($jsdragdevices_def, 0, strlen($jsdragdevices_def)-1);
    ?>

    <script>
    "use strict";
    var evt         = new Event(),
        dragdrop    = new Dragdrop(evt)
        <?php if (isset($jsdragdevices_def) && $jsdragdevices_def != "") { print(",".$jsdragdevices_def); } ?>
        <?php if (isset($jsdragdevices_act) && $jsdragdevices_act != "") { print(",".$jsdragdevices_act); } ?>
        ;
    </script>
</body>
</html>
