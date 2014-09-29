<?
	include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnection.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/sessionhandler.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/dwd_parser.php';
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
		<title><? echo $__CONFIG['main_sitetitle'] ?> - Wetterwarnungen</title>
	</head>
<body>
	<? require($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>

	<section class="main_weather">
		<h1><span>Wetter (Unwetter-) Warnungen</span></h1>
			<div id="radar"><a href="http://www.dwd.de/bvbw/appmanager/bvbw/dwdwwwDesktop?_nfpb=true&_windowLabel=T14600649251144330032285&_urlType=action&T14600649251144330032285_LAND_CODE=SU&T14600649251144330032285_HEIGHT=x&T14600649251144330032285_TIME=x&T14600649251144330032285_WARNING_TYPE=0&T14600649251144330032285_TABLE_VIEW=false&T14600649251144330032285_MAP_VIEW=true&T14600649251144330032285_MOVIE_VIEW=false&T14600649251144330032285_WEEKLY_REPORT_VIEW=false&T14600649251144330032285_STATIC_CONTENT_VIEW=false&T14600649251144330032285_SHOW_TIME_SEL=true&T14600649251144330032285_SHOW_HEIGHT_SEL=true&_pageLabel=_dwdwww_wetter_warnungen_warnungen" target="_blank"><img src="http://www.dwd.de/dyn/app/ws/maps/SU_x_x_0.gif"></a></div>
			<div id="title">Warnung</div>
			<div id="text"><? echo $dwd_warnung; ?></div>
			<div id="title">Report</div>
			<div id="text"><? echo $dwd_report; ?></div>
	</section>
</body>
</html>