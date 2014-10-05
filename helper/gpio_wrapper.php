<?php

if ( isset($_GET['cmd']) && isset($_GET['pin']) && isset($_GET['value']) && isset($_GET['remote_addr']) && isset($_GET['identifier']) && isset($_GET['protocol']) ) {
    $url = $_GET['protocol']."://".$_GET['remote_addr']."/helper/gpio.php?cmd=".$_GET['cmd']."&pin=".$_GET['pin']."&value=".$_GET['value']."&identifier=".$_GET['identifier'];
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_exec($curl);
    curl_close($curl);
}

?>
