<?php
session_start();

$template = 'index';

if(isset($_GET['mode']) && file_exists(dirname(__FILE__) . '/templates/' . $_GET['mode'] . '.php')) {

    $template = $_GET['mode'];
}

$flash = '';
if(isset($_SESSION['flash'])) {

    $flash = '<div class="flash">' . $_SESSION['flash'] . '</div>';
    unset($_SESSION['flash']);
}

require_once(dirname(__FILE__) . '/templates/' . $template . '.php');
