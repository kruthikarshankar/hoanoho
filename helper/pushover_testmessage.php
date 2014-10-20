<?php

if ( isset($_POST['usertoken']) && isset($_POST['apptoken']) ) {
    curl_setopt_array($ch = curl_init(), array(
        CURLOPT_URL => "https://api.pushover.net/1/messages.json",
        CURLOPT_USERAGENT => "Mozilla/4.0",
        CURLOPT_POSTFIELDS => array(
        "token" => $_POST['apptoken'],
        "user" => $_POST['usertoken'],
        "message" => "Dies ist eine Testnachricht - Pushover wurde erfolgreich eingerichtet!",
    )));
    curl_exec($ch);
    curl_close($ch);
}

?>
