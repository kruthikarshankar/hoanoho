<?
	include $_SERVER['DOCUMENT_ROOT'].'/includes/dbconnection.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/sessionhandler.php';
	include $_SERVER['DOCUMENT_ROOT'].'/includes/getConfiguration.php';

	
	if ($_POST['cmd'] == "deletedevice" && strlen($_POST['nd_id']) > 0) 
	{
		$sql = "DELETE FROM network_devices where nd_id = " . $_POST['nd_id'];
		mysql_query($sql);
	}
	else if ($_POST['cmd'] == "deleterange" && strlen($_POST['nr_id']) > 0) 
	{
		$sql = "DELETE FROM network_ranges where nr_id = " . $_POST['nr_id'];
		mysql_query($sql);
	}
	else if($_POST['cmd'] == "newdevice")
	{
		$sql = "INSERT INTO network_devices set name = '" . utf8_decode('Neues Netzwerkgerät') . "'";
		mysql_query($sql);
	}
	else if($_POST['cmd'] == "newrange")
	{
		$sql = "INSERT INTO network_ranges set iprange = '" . utf8_decode('000.000.000.000-000') . "'";
		mysql_query($sql);
	}
	else if($_POST['cmd'] == "updaterange")
	{
		$sql = "UPDATE network_ranges set iprange = '" . utf8_decode($_POST['iprange']) . "', subnet = '" . utf8_decode($_POST['subnet']) . "', infos = '" . utf8_decode($_POST['infos']) . "' where nr_id = " . $_POST['nr_id'];
		mysql_query($sql);
	}
	else if ($_POST['cmd'] == "updatedevice" && strlen($_POST['nd_id']) > 0)
	{
		$sql = "UPDATE network_devices set name = '" . utf8_decode($_POST['devicename']) . "', macaddr = '" . utf8_decode($_POST['macaddr']) . "', ip = '" . utf8_decode($_POST['ip']) . "', subnet = '" . utf8_decode($_POST['subnet']) . "', infos = '" . utf8_decode($_POST['infos']) . "', ndtype_id = " . $_POST['ndtype_id'] . ", os_id = " . $_POST['os_id'] . " where nd_id = " . $_POST['nd_id']; 
		mysql_query($sql);
	}
?>

<?
	function displayDeviceTypes($ndtype_id) {
		$selected = false;
		$sql = "select ndtype_id, name from network_device_types order by name asc";

		$result = mysql_query($sql);
		echo "<select id=\"ndtype_id\" name=\"ndtype_id\" onchange=\"javascript:prepareAdditionalFields(this);\">";
			echo "<option ".($ndtype_id == "null" ? "selected" : "")." value=\"null\"></option>";
		while ($type = mysql_fetch_object($result)) 
		{
			echo "<option ".($ndtype_id == $type->ndtype_id ? "selected" : "")." value=\"".$type->ndtype_id."\">".$type->name."</option>";

			if($ndtype_id == $type->ndtype_id)
				$selected = true;
		}
		echo "</select>";
	}

	function displayOS($os_id) {
		$selected = false;
		$sql = "select os_id, name from network_os order by name asc";

		$result = mysql_query($sql);
		echo "<select id=\"os_id\" name=\"os_id\">";
			echo "<option ".($os_id == "null" ? "selected" : "")." value=\"null\"></option>";
		while ($os = mysql_fetch_object($result)) 
		{
			echo "<option ".($os_id == $os->os_id ? "selected" : "")." value=\"".$os->os_id."\">".$os->name."</option>";

			if($os_id == $os->os_id)
				$selected = true;
		}
		echo "</select>";
	}
?>

<html>
	<head>
		<meta charset="UTF-8" />

		<link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
		<link rel="stylesheet" href="./css/network.css" type="text/css" media="screen" title="no title" charset="UTF-8">
		<link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

		<? include $_SERVER['DOCUMENT_ROOT'].'/includes/getUserSettings.php'; ?> 

		<script type="text/javascript" src="./js/nicEdit.js"></script>
		<script type="text/javascript">
			bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });

			function prepareAdditionalFields(field)
			{
				if(field.options[field.selectedIndex].text == "Switch")
				{
					document.getElementById("switch").style.display = "block";
				}
				else
				{
					document.getElementById("switch").style.display = "none";
					document.getElementById("vendor").value = "null";
					document.getElementById("switchports").value = "";
					document.getElementById("switchsfpports").value = "";
				}
			}
		</script>

		<link rel="apple-touch-icon" href="./img/favicon.ico"/>
		<link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
		<title><? echo $__CONFIG['main_sitetitle'] ?> - Netzwerk - Übersicht</title>
	</head>
<body>
	<? require($_SERVER['DOCUMENT_ROOT'].'/includes/nav.php'); ?>


	<?
	// editiermodus

	if (isset($_POST['cmd']) && ($_POST['cmd'] == "editdevice" || $_POST['cmd'] == "newdevice" )) 
	{
		$title = ($_POST['cmd'] == "newdevice") ? "Gerät hinzufügen" : "Gerät bearbeiten";

		if(isset($_POST['nd_id']))
		{
			$sql = "SELECT network_devices.nd_id, network_devices.name devicename, network_devices.macaddr, network_devices.ip, network_devices.subnet, network_device_types.ndtype_id, network_device_types.name devicetypename, network_os.os_id, network_os.name osname, network_devices.infos infos FROM network_devices left outer join network_device_types on network_device_types.ndtype_id = network_devices.ndtype_id left outer join network_os on network_os.os_id = network_devices.os_id where network_devices.nd_id = " . $_POST['nd_id'];
		}
		else
		{
			$sql = "SELECT network_devices.nd_id, network_devices.name devicename, network_devices.macaddr, network_devices.ip, network_devices.subnet, network_device_types.ndtype_id, network_device_types.name devicetypename, network_os.os_id, network_os.name osname, network_devices.infos infos FROM network_devices left outer join network_device_types on network_device_types.ndtype_id = network_devices.ndtype_id left outer join network_os on network_os.os_id = network_devices.os_id where network_devices.nd_id = " . mysql_insert_id();
		}
	?>
		<section class="main_network">
			<span><h1><? echo $title ?></h1></span>
			<?
			$result = mysql_query($sql);
			while ($device = mysql_fetch_object($result)) 
			{
			?>
				<form method="POST" enctype="multipart/form-data" name="editDeviceForm" id="editForm">
				<div id="edit">
					<div id="space">&nbsp;</div>
					<div id="text">Gerätename:</div><div id="value"><input id="devicename" name="devicename" value="<? echo utf8_encode($device->devicename); ?>"></div>
					<div id="text">Gerätetyp:</div><div id="value"><? displayDeviceTypes($device->ndtype_id); ?></div>
					<div id="text">Betriebsystem:</div><div id="value"><? displayOS($device->os_id); ?></div>
					<div id="text">MAC Adresse:</div><div id="value"><input id="macaddr" name="macaddr" value="<? echo utf8_encode($device->macaddr); ?>"></div>
					<div id="space">&nbsp;</div>
					<div id="text">IP-Adresse:</div><div id="value"><input id="ip" name="ip" value="<? echo utf8_encode($device->ip); ?>"></div>
					<div id="text">Subnetz:</div><div id="value"><input id="subnet" name="subnet" value="<? echo utf8_encode($device->subnet); ?>"></div>
					<div id="space">&nbsp;</div>
					<div id="text">Bemerkungen:</div><div id="value"><input id="infos" name="infos" value="<? echo utf8_encode($device->infos); ?>"></div>
					<div id="space">&nbsp;</div>
					<div id="submit"><input type="button" id="greybutton" name="backbtn" value="Zurück" onclick="self.location.href='network.php'">&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" id="greybutton" name="resetbtn" value="Zurücksetzen" onclick="editDeviceForm.reset(); prepareAdditionalFields(document.getElementById('ndtype_id'));">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="greenbutton" name="submit" value="Speichern"></div>
					<input type="hidden" id="nd_id" name="nd_id" value="<? echo $device->nd_id; ?>"><input type="hidden" id="cmd" name="cmd" value="updatedevice">
				</div>
				</form>
			<?
			}
			?>
		</section>
		<?
		echo "<script type=\"text/javascript\">prepareAdditionalFields(document.getElementById('ndtype_id'));</script>";
	}
	else if (isset($_POST['cmd']) && ($_POST['cmd'] == "editrange" || $_POST['cmd'] == "newrange" ))
	{
		$title = ($_POST['cmd'] == "newrange") ? "Bereich hinzufügen" : "Bereich bearbeiten";
		?>
		<section class="main_network">
			<h1><span><? echo $title ?></span></h1>
			<?
			if(isset($_POST['nr_id']))
			{
				$sql = "SELECT * from network_ranges where nr_id = " . $_POST['nr_id'];
			}
			else
			{
				$sql = "SELECT * from network_ranges where nr_id = " . mysql_insert_id();
			}

			$result = mysql_query($sql);
			while ($range = mysql_fetch_object($result)) 
			{
			?>
				<form method="POST" enctype="multipart/form-data" name="editRangeForm" id="editForm">
				<div id="edit">
					<div id="space">&nbsp;</div>
					<div id="text">IP-Adresse:</div><div id="value"><input id="iprange" name="iprange" value="<? echo utf8_encode($range->iprange); ?>"></div>
					<div id="text">Subnetz:</div><div id="value"><input id="subnet" name="subnet" value="<? echo utf8_encode($range->subnet); ?>"></div>
					<div id="space">&nbsp;</div>
					<div id="text">Bemerkungen:</div><div id="value"><input id="infos" name="infos" value="<? echo utf8_encode($range->infos); ?>"></div>
					<div id="space">&nbsp;</div>
					<div id="submit"><input type="button" id="greybutton" name="backbtn" value="Zurück" onclick="self.location.href='network.php'">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" id="greybutton" name="resetbtn" value="Zurücksetzen">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" id="greenbutton" name="submit" value="Speichern"></div>
					<input type="hidden" id="nr_id" name="nr_id" value="<? echo $range->nr_id; ?>"><input type="hidden" id="cmd" name="cmd" value="updaterange">
				</div>
				</form>
			<?
			}
			?>
		</section>
		<?
	}
	else
	{
		// zeige übersichtslisten
		$sql = "SELECT * from network_ranges order by iprange asc";
	?>
		<section class="main_network_range">
			<h1><span>Netzbereiche</span></h1>

			<div id="toolbar">
				<form method="POST" enctype="multipart/form-data" name="addRangeForm" id="addRangeForm">
					<a href="#" onclick="javascript:document.addRangeForm.submit()"><div id="left"><img src="./img/add.png">&nbsp;&nbsp;Bereich hinzufügen</div></a>
					<input type="hidden" name="cmd" value="newrange">
				</form>
			</div>

			<div id="header">
				<div id="ipbereich">IP-Bereich</div>
				<div id="subnet">Subnetz</div>
				<div id="infos">Verwendung</div>
				<div id="action">&nbsp;</div>
			</div>
			<?
			$result = mysql_query($sql);
			while ($range = mysql_fetch_object($result)) 
			{
			?>
			<div id="listitem">
				<div id="ipbereich"><? echo utf8_encode($range->iprange); ?></div>
				<div id="subnet"><? echo utf8_encode($range->subnet); ?></div>
				<div id="infos"><? echo utf8_encode($range->infos); ?></div>
				<div id="action">
						<form method="POST" enctype="multipart/form-data" name="editRangeForm<? echo $range->nr_id; ?>" id="editRangeform">
							<a href="#" onclick="javascript:document.editRangeForm<? echo $range->nr_id; ?>.submit()" title="Bereich editieren"><img src="./img/edit.png"></a>
							<input type="hidden" name="cmd" value="editrange">
							<input type="hidden" name="nr_id" value="<? echo $range->nr_id; ?>">
						</form>
						<form method="POST" enctype="multipart/form-data" name="deleteRangeForm<? echo $range->nr_id; ?>" id="deleteRangeForm">
							<a href="javascript:document.deleteRangeForm<? echo $range->nr_id; ?>.submit()" title="Bereich löschen" onclick="javascript:return confirm('Soll der Bereich \'<? echo utf8_encode($range->iprange."/".$range->subnet); ?>\' wirklich gelöscht werden ?');"><img src="./img/delete.png"></a>
							<input type="hidden" name="cmd" value="deleterange">
							<input type="hidden" name="nr_id" value="<? echo $range->nr_id; ?>">
						</form>
				</div>
			</div>
			<?
			}
			?>
		</section>

		<?
		// suchabfrage - suchen in name und text 
		if( $_POST['cmd'] == "search" && strlen($_POST['query']) > 0 )
		{
			$sql = "SELECT network_devices.state, network_devices.nd_id, network_devices.name devicename, network_devices.ip, network_devices.ip_dhcp, network_devices.subnet, network_device_types.name devicetypename, network_device_types.icon devicetypeicon, network_os.name osname, network_os.icon osicon, network_devices.infos infos FROM network_devices left outer join network_device_types on network_device_types.ndtype_id = network_devices.ndtype_id left outer join network_os on network_os.os_id = network_devices.os_id where network_devices.ip like '%".$_POST['query']."%' or network_devices.name like '%".$_POST['query']."%' or network_device_types.name like '%".$_POST['query']."%' or network_os.name like '%".$_POST['query']."%' or network_devices.infos like '%".$_POST['query']."%' order by network_devices.ip asc, network_devices.name asc";
		}
		else
		{
			$sql = "SELECT network_devices.state, network_devices.nd_id, network_devices.name devicename, network_devices.ip, network_devices.ip_dhcp, network_devices.subnet, network_device_types.name devicetypename, network_device_types.icon devicetypeicon, network_os.name osname, network_os.icon osicon, network_devices.infos infos FROM network_devices left outer join network_device_types on network_device_types.ndtype_id = network_devices.ndtype_id left outer join network_os on network_os.os_id = network_devices.os_id order by network_devices.ip asc, network_devices.name asc";
		}
		?>
		<section class="main_network">
			<h1><span>Geräteübersicht</span></h1>
			
			<div id="toolbar">
				<form method="POST" enctype="multipart/form-data" name="addForm" id="addForm">
					<a href="#" onclick="javascript:document.addForm.submit()"><div id="left"><img src="./img/add.png">&nbsp;&nbsp;Gerät hinzufügen</div></a>
					<input type="hidden" name="cmd" value="newdevice">
				</form>
				<form method="POST" enctype="multipart/form-data" name="searchForm" id="searchForm">
					<div id="right"><input id="query" placeholder="Suchbegriff(e) eingeben" type="text" name="query"><a href="#" onclick="javascript:document.searchForm.submit()"><img src="./img/searchbutton.png"></a></div>
					<input type="hidden" name="cmd" value="search">
				</form>
			</div>
			
			<div id="header">
				<div id="state">&nbsp;</div>
				<div id="ip">IP-Adresse</div>
				<div id="name">Name</div>
				<div id="type">Typ</div>
				<div id="os">OS</div>
				<div id="infos">Bemerkungen</div>
				<div id="action">&nbsp;</div>
			</div>
			<?
			$result = mysql_query($sql);
			while ($device = mysql_fetch_object($result)) 
			{
			?>
			<div id="listitem">
				<div id="state"><img src="./img/network/state<? echo $device->state; ?>.png" title="<? if($device->state == 0) { echo "Ausgeschaltet"; } else { echo "Eingeschaltet"; }?>"></div>
				<div id="ip"><? if($device->ip != "DHCP" || $device->ip_dhcp == "") { echo utf8_encode($device->ip); } else if ($device->ip_dhcp != "") { echo $device->ip_dhcp; } ?></div>
				<div id="name"><? echo utf8_encode($device->devicename); ?></div>
				<div id="type"><? if(strlen($device->devicetypeicon) > 0) { echo "<img src=\"./img/network/".$device->devicetypeicon."\" title=\"".$device->devicetypename."\">"; } else { echo "&nbsp;"; } ?></div>
				<div id="os"><? if(strlen($device->osicon) > 0) { echo "<img src=\"./img/network/".$device->osicon."\" title=\"".$device->osname."\">"; } else { echo "&nbsp;"; } ?></div>
				<div id="infos"><? echo utf8_encode($device->infos); ?></div>
				<div id="action">
						<form method="POST" enctype="multipart/form-data" name="editForm<? echo $device->nd_id; ?>" id="editForm">
							<a href="#" onclick="javascript:document.editForm<? echo $device->nd_id; ?>.submit()" title="Gerät editieren"><img src="./img/edit.png"></a>
							<input type="hidden" name="cmd" value="editdevice">
							<input type="hidden" name="nd_id" value="<? echo $device->nd_id; ?>">
						</form>
						<form method="POST" enctype="multipart/form-data" name="deleteForm<? echo $device->nd_id; ?>" id="deleteForm">
							<a href="javascript:document.deleteForm<? echo $device->nd_id; ?>.submit()" title="Gerät löschen" onclick="javascript:return confirm('Soll das Gerät \'<? echo utf8_encode($device->devicename); ?>\' wirklich gelöscht werden ?');"><img src="./img/delete.png"></a>
							<input type="hidden" name="cmd" value="deletedevice">
							<input type="hidden" name="nd_id" value="<? echo $device->nd_id; ?>">
						</form>
				</div>
			</div>
			<?
			}
			?>
		</section>
	<?
	}
	?>
</body>
</html>