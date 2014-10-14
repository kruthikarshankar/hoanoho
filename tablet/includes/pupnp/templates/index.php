<?php
/**
 * pUPnP, an PHP UPnP MediaControl
 * 
 * Copyright (C) 2012 Mario Klug
 * 
 * This file is part of pUPnP.
 * 
 * pUPnP is free software: you can redistribute it and/or modify it under the terms of the
 * GNU General Public License as published by the Free Software Foundation, either version 2 of the
 * License, or (at your option) any later version.
 * 
 * pUPnP is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * See the GNU General Public License for more details. You should have received a copy of the GNU
 * General Public License along with pUPnP. If not, see <http://www.gnu.org/licenses/>.
 */
use at\mkweb\upnp\Config;
use at\mkweb\upnp\frontend\AuthManager;

require_once('src/at/mkweb/upnp/init.php');

include dirname(__FILE__).'/../../../../includes/dbconnection.php';
include dirname(__FILE__).'/../../../../includes/getConfiguration.php';

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

$javascript = array(
    '3rdparty/phpjs.js',
    'pupnp-helpers.js',
    'pupnp-backend.js',
    'pupnp-gui.js',
    'pupnp-device.js',
    'pupnp-playlist.js',
    'pupnp-favorites.js',
    'pupnp-file.js',
    'pupnp-filemanager.js',
    'pupnp.js',
    'bootstrap.min.js'
);

$css = array(
    'bootstrap.min.css',
    'style.css',
    'lightbox.css',
    'dropdown.css',
    'cdcase.css'
);
?>
<html>
<head>
    <meta charset="UTF-8" />

    <title><? echo $__CONFIG['main_sitetitle']; ?></title>

	<link href="./res/jqueryui/css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css"/>
    <? if(Config::read('minify_css')): ?>

        <link rel="stylesheet" type="text/css" href="./resources.php?css=<?= join('|', $css) ?>" />
    <? else: ?>

        <? foreach($css as $cssfile): ?>

            <link rel="stylesheet" type="text/css" href="./res/css/<?= $cssfile ?>" />
        <? endforeach ?>
    <? endif ?>

    <title><? echo $__CONFIG['main_sitetitle']; ?></title>

    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="shortcut icon" type="image/x-icon" href="../img/favicons/favicon.ico">
    <link rel="apple-touch-icon" sizes="57x57" href="../img/favicons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="../img/favicons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="../img/favicons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="../img/favicons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="../img/favicons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../img/favicons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../img/favicons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../img/favicons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicons/apple-touch-icon-180x180.png">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-title" content="Hoanoho">
    <link rel="icon" type="image/png" href="../img/favicons/favicon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="../img/favicons/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="../img/favicons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="../img/favicons/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="../img/favicons/favicon-32x32.png" sizes="32x32">
    <meta name="msapplication-TileColor" content="#603cba">
    <meta name="msapplication-TileImage" content="../img/favicons/mstile-144x144.png">
    <meta name="msapplication-config" content="../img/favicons/browserconfig4.xml">
    <meta name="application-name" content="Hoanoho">

    <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css" media="screen" title="no title" charset="UTF-8">
    <link rel="stylesheet" href="../../css/bootstrap-theme.min.css" type="text/css" media="screen" title="no title" charset="UTF-8">
    <link rel="stylesheet" href="../../css/bootstrap-custom.css" type="text/css" media="screen" title="no title" charset="UTF-8">
    
    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/jquery-ui.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/clock.js"></script>
    <script src="../../js/jquery-scrolltofixed.js"></script>
    <script src="../../js/standalone.js"></script>
    <script>
        $(document).ready(function() {
            $('.dropdown-toggle').dropdown();

            $('#titlebar').scrollToFixed();
            $('#footer').scrollToFixed({bottom: 0});
        });
    </script>

    

        <? foreach($javascript as $jsfile): ?>

            <script type="text/javascript" src="./res/js/<?= $jsfile ?>"></script>
        <? endforeach ?>

</head>
<body>
    <? include dirname(__FILE__)."/../../header.php"; ?>
    <div id="boxarea">
        <? 
        print("<div id=\"boxitem\" class=\"librarybrowser\">");
            print("<div id=\"title\">Quelle</div>");
            print("<div class=\"deviceSelection\" id=\"ds-src\"></div>");

            print("<div class=\"desc\" id=\"desc-src\"></div>");

            print("<div class=\"properties\" id=\"p-src\"></div>");
        print("</div>");
        print("<div id=\"boxitem\" class=\"musicplayer\">");
            print("<div id=\"title\">Wiedergabegerät</div>");
            print("<div class=\"deviceSelection\" id=\"ds-dst\"></div>");

            print("<div class=\"desc\" id=\"desc-dst\"></div>");

            print("<div class=\"properties\" id=\"p-dst\"></div>");
            /*print("<div id=\"inforow\">");
                print("<div id=\"cover\">");
                    print("<article class=\"cd case\">");
                        print("<div>");
                            print("<div class=\"img\">");
                                print("<span><img id=\"coverart\" name=\"coverart\" src=\"http://upload.wikimedia.org/wikipedia/en/thumb/8/8f/2pacalypse_now.jpg/220px-2pacalypse_now.jpg\"></span>");
                            print("</div>");
                        print("</div>");
                    print("</article>");
                print("</div>");
                print("<div id=\"songinfo\">");
                    print("<div id=\"song_artist\">Iron Maiden</div>");
                    print("<div id=\"song_title\">Heart Bleeds till death</div>");
                    print("<div id=\"song_album\">Undertaker</div>");
                print("</div>");
            print("</div>");
            print("<div id=\"controlrow\">");
                print("<div id=\"controls\">");
                    print("<div id=\"btn_prev\"></div>");
                    print("<div id=\"btn_stop\"></div>");
                    print("<div id=\"btn_play\"></div>");
                    print("<div id=\"btn_next\"></div>");
                print("</div>");
            print("</div>");*/
        print("</div>");
        ?>
    </div>
    <? include dirname(__FILE__)."/../../footer.php"; ?>
</body>


<!-- <div id="error" class="hidden"></div> -->
</html>
