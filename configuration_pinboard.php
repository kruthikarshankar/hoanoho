<?php
include dirname(__FILE__).'/includes/dbconnection.php';
include dirname(__FILE__).'/includes/sessionhandler.php';
include dirname(__FILE__).'/includes/getConfiguration.php';

function generateNoteColors()
{
    echo "<div id=\"colorchooser_yellow\">&nbsp;</div>";
    echo "<div id=\"colorchooser_orange\">&nbsp;</div>";
    echo "<div id=\"colorchooser_red\">&nbsp;</div>";
    echo "<div id=\"colorchooser_pink\">&nbsp;</div>";
    echo "<div id=\"colorchooser_green\">&nbsp;</div>";
    echo "<div id=\"colorchooser_blue\">&nbsp;</div>";
    echo "<div id=\"colorchooser_purple\">&nbsp;</div>";
}

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
    $return .= "<select id=\"device\" name=\"dev_id\" class=\"directsave\">";
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

function displayDeviceData($dev_id, $dev_value)
{
    $return .= "<option value=\"\" ".($selection == "" ? "selected" : "")."></option>";
    $result = mysql_query("select identifier from devices where dev_id = ".$dev_id);
    while ($device_identifier = mysql_fetch_object($result)) {
        $result2 = mysql_query("select distinct valuename from device_data where deviceident = '".$device_identifier->identifier."' order by valuename");
        while ($identifier = mysql_fetch_object($result2)) {
            $sql = "select value name from configuration where configstring = '@".utf8_encode($identifier->valuename)."' and dev_id = ".$dev_id;
            $translation = mysql_fetch_object(mysql_query($sql));
            $return .= "<option value=\"".$identifier->valuename."\" ".($dev_value == $identifier->valuename ? "selected" : "").">".(strlen($translation->name) > 0 ? "".utf8_encode($translation->name)."" : $identifier->valuename)."</option>";
        }
    }

    return $return;
}
?>

<html>
<head>
    <script type="text/javascript" src="./js/jquery.min.js"></script>
    <script src="./js/jquery-ui.min.js"></script>

    <script type="text/javascript">
    function encode(input)
    {
        var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
        var output = "";
        var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
        var i = 0;

        while (i < input.length) {
            chr1 = input[i++];
            chr2 = i < input.length ? input[i++] : Number.NaN; // Not sure if the index
            chr3 = i < input.length ? input[i++] : Number.NaN; // checks are needed here

            enc1 = chr1 >> 2;
            enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
            enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
            enc4 = chr3 & 63;

            if (isNaN(chr2)) {
                enc3 = enc4 = 64;
            } else if (isNaN(chr3)) {
                enc4 = 64;
            }
            output += keyStr.charAt(enc1) + keyStr.charAt(enc2) + keyStr.charAt(enc3) + keyStr.charAt(enc4);
        }

        return output;
    }

    $(document).ready(function () {
                // draggable event
                /*$(".draggable").draggable({
                    update: function (event, ui) {
                        var newOrder = $(this).draggable('toArray').toString();
                        console.log(newOrder);
                        //$.get('saveSortable.php', {order:newOrder});
                    }
                });*/
                // sortable event
                $(".sortable").sortable({
                    update: function (event, ui) {
                        var data = $(this).sortable('serialize');

                        var myData = 'cmd=pinboard_updateposition&'+data;
                        jQuery.ajax({
                            type: "POST",
                            url: "helper/datacontroller.php",
                            dataType:"text", // Data type, HTML
                            data:myData, //Form variables
                            success:function (response) {
                            },
                            error:function (xhr, ajaxOptions, thrownError) {
                                alert(thrownError);
                            }
                        });
                    }
                });

                // icon upload
                var image_replace = "";
                $('body').delegate(".icon", "dblclick", function (e) {
                    image_replace = $(this).parent().attr('id');

                    $('input[type=file]').click();
                });
                $('input[type=file]').on("change", function () {
                    var file = this.files[0];
                    name = file.name;
                    size = file.size;
                    type = file.type;

                    if (file.name.length < 1) {
                    } else if (file.size > 100000) {
                        alert("Datei ist zu groß!");
                    } else if (file.type != 'image/png' && file.type != 'image/jpg' && !file.type != 'image/gif' && file.type != 'image/jpeg') {
                        alert("Datei ist kein Bild!");
                    } else {
                        var reader = new FileReader();
                        var storeData = new FormData();

                        reader.onload = function (e) {
                            var storeRequest = new XMLHttpRequest();

                            var assignid = image_replace.split('-');
                            assignid = assignid[1];

                            storeData.append('cmd', 'pinboard_block_saveimage');
                            storeData.append('data', e.target.result);
                            storeData.append('assignid', assignid);

                            storeRequest.onreadystatechange = function () {
                                if (storeRequest.readyState == 4 && storeRequest.status == 200) {
                                      // replace image of image_replace
                                      $('#'+image_replace).find('#headline_icon').css("background-image", "url('"+e.target.result+"')");
                                      $('#'+image_replace).effect("highlight", {color:"#caef59"});
                                  }
                            };

                            storeRequest.open('POST', 'helper/datacontroller.php', true);
                            storeRequest.send(storeData);
                        };

                        reader.readAsDataURL(file);
                    }
                });

                // edit title on the fly
                var previousValue;
                $("#appendBlock").delegate("#headline, #text", "dblclick", function (e) {
                    e.stopPropagation();
                    var element = $(this);
                    var currentValue = $(this).html();
                    previousValue = currentValue;

                    $(element).html('<input id="editvalue" type="text" value="' + currentValue + '" />');
                    $("#editvalue").focus();

                    // on escape set old value
                    $(element).keyup(function (event) {
                        if (event.keyCode == 27) {
                            if ($(element).find("#editvalue").length) {
                                $(element).html(previousValue);
                            }
                        }
                    });
                    // on enter set new value
                    $(element).keyup(function (event) {
                        if (event.keyCode == 13) {
                            if ($(element).find("#editvalue").length) {
                                if ($(element).find("#editvalue").val().length > 0) {
                                    $(element).html($("#editvalue").val().trim());
                                    // save new value into database
                                    var updateid = $(element).parent().attr('id').split('-'); // block-123
                                    updateid = updateid[1]; // 123

                                    var myData = 'cmd=pinboard_update&updateid='+updateid+'&updatekey=title&updatevalue='+$(element).html();
                                    jQuery.ajax({
                                        type: "POST",
                                        url: "helper/datacontroller.php",
                                        dataType:"text", // Data type, HTML
                                        data:myData, //Form variables
                                        success:function (response) {
                                            $(element).parent().effect("highlight", {color:"#caef59"});
                                        },
                                        error:function (xhr, ajaxOptions, thrownError) {
                                            $(element).html(previousValue);
                                            $(element).parent().effect("highlight", {color:"#ff5f5f"});
                                        }
                                    });
                                } else {
                                    $(element).html(previousValue);
                                }
                            }
                        }
                    });
                    // on click into document set new value
                    $(document).click(function () {
                        if ($(element).find("#editvalue").length) {
                            if ($(element).find("#editvalue").val().length > 0) {
                                $(element).html($("#editvalue").val().trim());
                                // save new value into database
                                var updateid = $(element).parent().attr('id').split('-'); // block-123
                                updateid = updateid[1]; // 123

                                var myData = 'cmd=pinboard_update&updateid='+updateid+'&updatekey=title&updatevalue='+$(element).html();
                                jQuery.ajax({
                                    type: "POST",
                                    url: "helper/datacontroller.php",
                                    dataType:"text", // Data type, HTML
                                    data:myData, //Form variables
                                    success:function (response) {
                                        $(element).parent().effect("highlight", {color:"#caef59"});
                                    },
                                    error:function (xhr, ajaxOptions, thrownError) {
                                        $(element).html(previousValue);
                                        $(element).parent().effect("highlight", {color:"#ff5f5f"});
                                    }
                                });
                            } else {
                                $(element).html(previousValue);
                            }
                        }
                    });
                });

                // select option changed save directly
                $("#appendBlock").delegate(".directsave", "change", function (e) {
                    var element = $(this);
                    var updateid = $(element).parent().parent().attr('id').split('-');
                    updateid = updateid[1];

                    var value = "";
                    var information = "";
                    if ($(element).val().indexOf(';') != -1) {
                        // in case value from select element is of type value;information
                        value = $(element).val().split(';');
                        information = value[1];
                        value = value[0];
                    } else
                        value = $(element).val();

                    var myData = 'cmd=pinboard_update&updateid='+updateid+'&updatekey='+$(element).attr('name')+'&updatevalue='+value;
                    jQuery.ajax({
                        type: "POST",
                        url: "helper/datacontroller.php",
                        dataType:"text", // Data type, HTML
                        data:myData, //Form variables
                        success:function (response) {
                            $(element).parent().parent().effect("highlight", {color:"#caef59"});

                            // fill dev_value dynamically for the case multiple data is aquired by device
                            var select = $(element).parent().find('#dev_value');
                            if (information != "") {
                                if (information == 'PVServer' || information == "Datensammler") {
                                    var myData = 'cmd=pinboard_getdevicedata&id='+value;
                                    jQuery.ajax({
                                        type: "POST",
                                        url: "helper/datacontroller.php",
                                        dataType:"text", // Data type, HTML
                                        data:myData, //Form variables
                                        success:function (response) {
                                            $(select).html(response);
                                        }
                                    });
                                } else {
                                    // remove data informations when not necessary
                                    $(select).html('');
                                    // delete dev_value from metadata when not necessary
                                    var myData = 'cmd=pinboard_update&updateid='+updateid+'&updatekey=dev_value&updatevalue=';
                                    jQuery.ajax({
                                        type: "POST",
                                        url: "helper/datacontroller.php",
                                        dataType:"text", // Data type, HTML
                                        data:myData //Form variables
                                    });
                                }
                            }
                        },
                        error:function (xhr, ajaxOptions, thrownError) {
                            $(element).parent().parent().effect("highlight", {color:"#ff5f5f"});
                        }
                    });
                });

                // Block alias Bereich
                $("#newBlockButton").click(function (e) {
                    e.preventDefault();

                    var myData = 'cmd=pinboard_block_new&owner=page_left';
                    jQuery.ajax({
                        type: "POST",
                        url: "helper/datacontroller.php",
                        dataType:"text", // Data type, HTML
                        data:myData, //Form variables
                        success:function (response) {
                            $("#appendBlock").append(response);
                        },
                        error:function (xhr, ajaxOptions, thrownError) {
                            alert(thrownError);
                        }
                    });
                });
                $("#appendBlock").delegate(".deleteBlockButton", "click", function (e) {
                    e.preventDefault();
                    var element = $(this).parent().parent();
                    var id = $(this).parent().parent().attr('id').split('-');
                    id = id[1];

                    var myData = 'cmd=pinboard_block_delete&id='+id;
                    jQuery.ajax({
                        type: "POST",
                        url: "helper/datacontroller.php",
                        dataType:"text", // Data type, HTML
                        data:myData, //Form variables
                        success:function (response) {
                            $(element).fadeOut();
                        },
                        error:function (xhr, ajaxOptions, thrownError) {
                            alert(thrownError);
                        }
                    });
                });

                // Row alias Gerät
                $("#appendBlock").delegate(".newRowButton", "click", function (e) {
                    e.preventDefault();
                    var owner = $(this).parent().parent().find("[id^=appendRows-]");

                    var parentid = $(owner).attr('id').split('-');
                    parentid = parentid[1];

                    var myData = 'cmd=pinboard_row_new&owner='+$(owner).attr('id')+'&parentid='+parentid;
                    jQuery.ajax({
                        type: "POST",
                        url: "helper/datacontroller.php",
                        dataType:"text", // Data type, HTML
                        data:myData, //Form variables
                        success:function (response) {
                            $(owner).append(response);
                        },
                        error:function (xhr, ajaxOptions, thrownError) {
                            alert(thrownError);
                        }
                    });
                });
                $("#appendBlock").delegate(".deleteRowButton", "click", function (e) {
                    e.preventDefault();
                    var element = $(this).parent().parent();
                    var id = $(this).parent().parent().attr('id').split('-');
                    id = id[1];

                    var myData = 'cmd=pinboard_row_delete&id='+id;
                    jQuery.ajax({
                        type: "POST",
                        url: "helper/datacontroller.php",
                        dataType:"text", // Data type, HTML
                        data:myData, //Form variables
                        success:function (response) {
                            $(element).fadeOut();
                        },
                        error:function (xhr, ajaxOptions, thrownError) {
                            alert(thrownError);
                        }
                    });
                });
            });
</script>

<meta charset="UTF-8" />

<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
<link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">
<link rel="stylesheet" href="./css/configuration_pinboard.css" type="text/css" media="screen" title="no title" charset="UTF-8">

<?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

<link rel="apple-touch-icon" href="./img/favicon.ico"/>
<link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
<title><?php echo $__CONFIG['main_sitetitle'] . " - Pinnwand" ?></title>
</head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <section class="board">
        <div class="draggable" id="notes">
            <div id="closebutton" style="margin-left: 878px"></div>
            <form method="POST" enctype="multipart/form-data" name="newNoteForm" id="newNoteForm">
                <div class="note_blue" style="-webkit-transform:rotate(-3deg); margin-top: 20px;" id="newnote">
                    <div id="pin5"></div>
                    <div id="title"><input type="text" id="notetitle" disabled></div>
                    <div id="content"><textarea id="notecontent" disabled></textarea></div>
                    <div id="footer"><?php generateNoteColors(); ?><div id="savenote" title="Notiz veröffentlichen">&nbsp;</div><div id="savingnote" title="Notiz veröffentlichen" style="display:none;">&nbsp;</div></div>
                    <input type="hidden" name="papercolor" id="papercolor" value="">
                </div>
            </form>
        </div>

        <div id="page_left" class="draggable">
            <div id="closebutton" style="margin-left: 530px"></div>
            <div id="page" class="lined_paper">
                <div id="pin_ul"></div><div id="pin_ur"></div>
                <div id="toolbar">
                    <div id="left"><a id="newBlockButton" href="#"><img src="./img/add.png"><div id="linktext">&nbsp;&nbsp;Bereich hinzufügen</div></a></div>
                </div>
                <div id="appendBlock" class="sortable">
                    <?php
                    $sql = "select * from pinboard_configuration where owner='page_left' and parentid is null order by position asc";
                    $result = mysql_query($sql);
                    while ($block = mysql_fetch_object($result)) {
                        $block_meta = json_decode($block->meta);

                        print("<div id=\"block-".$block->id."\">");
                            if($block_meta->iconid != -1)
                                print("<div class=\"icon\" id=\"headline_icon\" style=\"background-image: url('helper/datacontroller.php?cmd=getimage&id=".$block_meta->iconid."')\"></div><div id=\"headline\">".$block_meta->title."</div><div id=\"headline_type\">".displayBlockTypes($block_meta->type)."</div><div id=\"headline_action\"><a href=\"#\" class=\"newRowButton\" title=\"Gerät hinzufügen\"><img src=\"./img/add.png\"></a>&nbsp;&nbsp;<a href=\"#\" class=\"deleteBlockButton\" title=\"Bereich löschen\"><img src=\"./img/delete.png\"></a></div>");
                            else
                                print("<div class=\"icon\" id=\"headline_icon\"></div><div id=\"headline\">".$block_meta->title."</div><div id=\"headline_type\">".displayBlockTypes($block_meta->type)."</div><div id=\"headline_action\"><a href=\"#\" class=\"newRowButton\" title=\"Gerät hinzufügen\"><img src=\"./img/add.png\"></a>&nbsp;&nbsp;<a href=\"#\" class=\"deleteBlockButton\" title=\"Bereich löschen\"><img src=\"./img/delete.png\"></a></div>");

                            print("<div id=\"appendRows-".$block->id."\" class=\"sortable\">");
                                $sql = "select * from pinboard_configuration where owner='appendRows-".$block->id."' and parentid = ".$block->id." order by position asc";
                                $result2 = mysql_query($sql);
                                while ($row = mysql_fetch_object($result2)) {
                                    $row_meta = json_decode($row->meta);

                                    print("<div id=\"row-".$row->id."\"><div id=\"text\">".$row_meta->title."</div><div id=\"value\">".displayDevices($row_meta->dev_id)."<select id=\"dev_value\" name=\"dev_value\" class=\"directsave\">".displayDeviceData($row_meta->dev_id, $row_meta->dev_value)."</select></div><div id=\"action\"><a href=\"#\" class=\"deleteRowButton\" title=\"Gerät löschen\"><img src=\"./img/delete.png\"></a></div></div>");
                                }
                            print("</div>");
                        print("</div>");
                    }
                    ?>
                </div>
                <div id="block_last"></div>
            </div>
        </div>

        <div id="page_right" class="draggable">
            <div id="closebutton" style="margin-left: 178px"></div>
            <div id="page" class="paper_yellow">
                <div id="pin"></div>
            </div>
        </div>

    </section>
    <input type="file" style="visibility:hidden;"/>
</body>
</html>
