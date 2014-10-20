<?php
    include dirname(__FILE__).'/../../includes/sessionhandler.php';
    include dirname(__FILE__).'/../../includes/getConfiguration.php';

    // check automation configuration
    $sql_automation = "select * from device_floors where position > 0 order by position asc";
    $result_automation = mysql_query($sql_automation);

    // check webcam configuration
    $sql_webcam = "SELECT dev_id,devices.name from devices left join device_types on device_types.dtype_id = devices.dtype_id left join types on types.type_id = device_types.type_id where types.name = 'Webcam'";
    $result_webcam = mysql_query($sql_webcam);
?>

<nav class="bar-tab">
    <ul class="tab-inner">
        <li class="tab-item">
            <a href="index.php" data-ignore="push">
                <img class="tab-icon" src="../img/pinboard.png">
                <div class="tab-label">Pinnwand</div>
            </a>
        </li>
    <?php if (mysql_num_rows($result_automation) > 0) { ?>
        <li class="tab-item">
            <a href="automation.php" data-ignore="push">
                <img class="tab-icon" src="../img/home.png">
                <div class="tab-label">Steuerung</div>
            </a>
        </li>
    <?php } ?>
    <?php if (mysql_num_rows($result_webcam) > 0) { ?>
        <li class="tab-item">
            <a href="webcam.php">
                <img class="tab-icon" src="../img/webcam.png">
                <div class="tab-label">Webcams</div>
            </a>
        </li>
    <?php } ?>
        <li class="tab-item">
            <a href="weather.php">
                <img class="tab-icon" src="../img/weather.png">
                <div class="tab-label">Wetter</div>
            </a>
        </li>
        <li class="tab-item">
            <a href="login.php?cmd=logout">
                <img class="tab-icon" src="../img/logout.png">
                <div class="tab-label">Abmelden</div>
            </a>
        </li>
    </ul>
</nav>
