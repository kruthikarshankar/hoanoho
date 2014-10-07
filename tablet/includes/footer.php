<?php
// #FIXME - what is this for? $floor_id is never used anywhere afterwards
$floor_id = null;
if (!isset($_GET['floor'])) {
    $sql = "select floor_id from device_floors order by position asc limit 0,1";
    $result = mysql_fetch_object(mysql_query($sql));
    $floor_id = $result->floor_id
      if (isset($result->floor_id));
} else
    $floor_id = $_GET['floor'];
?>

<script lang="text/javascript">
    $(document).ready(function () {
      $('.scrollable-menu').css('max-height', $(window).height()/2);
    });

    $(document).ready(function () {
      $('.scrollable-menu.webcam').css('max-height', '230px');
    });
</script>

<div id="footer">
    <div id="left">
        <div class="btn-group" style="margin-left: 20px; margin-right: 20px">
            <?php echo "<a href=\"/tablet/index.php\"><button type=\"button\" class=\"btn btn-custom\">"; ?>
                &nbsp;<span class="glyphicon glyphicon-home"></span>&nbsp;
            </button></a>
        </div>
        <div class="btn-group dropup" style="margin-right: 20px">
            <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">Ebenen</button>
            <ul class="dropdown-menu scrollable-menu" role="menu">
                <?php
                $sql = "select floor_id, name from device_floors order by position asc";
                $result = mysql_query($sql);
                while ($floor = mysql_fetch_object($result)) {
                    //echo "<li><a href=\"#\" onclick=\"navigate('floor',".$floor->floor_id.",null)\">".utf8_encode($floor->name)."</a></li>";
                    echo "<li><a href=\"/tablet/floor.php?floor=".$floor->floor_id."\">".utf8_encode($floor->name)."</a></li>";
                }
                ?>
            </ul>
        </div>
        <div class="btn-group dropup" style="margin-right: 20px">
            <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">Räume</button>
            <ul class="dropdown-menu scrollable-menu" role="menu">
                <?php
                $sql = "select room_id, name from rooms order by name asc";
                $result = mysql_query($sql);
                while ($room = mysql_fetch_object($result)) {
                    //echo "<li><a href=\"#\" onclick=\"navigate('room',".$floor_id.",".$room->room_id.")\">".utf8_encode($room->name)."</a></li>";
                    echo "<li><a href=\"/tablet/room.php?room=".$room->room_id."\">".utf8_encode($room->name)."</a></li>";
                }
                ?>
            </ul>
        </div>
        <div class="btn-group dropup">
            <button type="button" class="btn btn-custom dropdown-toggle" data-toggle="dropdown">Gerätetypen</button>
            <ul class="dropdown-menu scrollable-menu" role="menu">
                <?php
                $sql = "select dtype_id, name from device_types order by name asc";
                $result = mysql_query($sql);
                while ($type = mysql_fetch_object($result)) {
                    //echo "<li><a href=\"#\" onclick=\"navigate('dtype',null,null,".$type->dtype_id.")\">".utf8_encode($type->name)."</a></li>";
                    echo "<li><a href=\"/tablet/dtype.php?dtype=".$type->dtype_id."\">".utf8_encode($type->name)."</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
    <div id="right">
        <div class="btn-group" style="margin-right: 20px;">
            <?php echo "<a href=\"/tablet/includes/pupnp/index.php\"><button type=\"button\" class=\"btn btn-custom\">"; ?>
                Musik
            </button></a>
        </div>
        <div class="btn-group" style="margin-right: 20px">
            <?php echo "<a href=\"/tablet/weather.php\"><button type=\"button\" class=\"btn btn-custom\">"; ?>
                Wetter
            </button></a>
        </div>
    </div>
</div>
