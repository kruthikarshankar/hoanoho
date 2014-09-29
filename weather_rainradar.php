<?
	include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnection.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/sessionhandler.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/getConfiguration.php';
?>

<html>
	<head>
		<meta charset="UTF-8" />

		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
		<link rel="stylesheet" href="./css/weather.css" type="text/css" media="screen" title="no title" charset="UTF-8">
		<link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

		<? include $_SERVER['DOCUMENT_ROOT'].'/includes/getUserSettings.php'; ?> 

		<link rel="apple-touch-icon" href="./img/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
		<title><? echo $__CONFIG['main_sitetitle'] ?> - Regenradar</title>
	</head>
<body>
	<? require($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>

	<section class="main_weather">
		<h1><span>Regenradar - Deutschland</span></h1>
			<div id="radar"><img src="http://www.dwd.de/wundk/radar/Radarfilm_WEB_DL.gif"></div>
			<div id="legend"><img src="./img/weather_radar_legend.png"></div>
	</section>
</body>
</html>