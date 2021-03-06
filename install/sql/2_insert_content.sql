INSERT INTO `types` (`type_id`, `name`) VALUES
(1, 'Ein/Aus-Schalter'),
(2, 'Temperaturregelung'),
(3, 'Webcam'),
(4, 'Jalousie'),
(5, 'Wertanzeige'),
(6, 'Dimmer'),
(7, 'Tuer/Fenster-Kontakt'),
(8, 'Philips Hue'),
(9, 'Rauch- / Feuermelder'),
(10, 'Netzwerkgerät'),
(11, 'Datensammler'),
(12, 'Raspberry Pi GPIO'),
(13, 'PVServer');


INSERT INTO `network_os` (`os_id`, `name`, `icon`) VALUES
(1, 'Windows', 'windows.png'),
(2, 'Mac OS X', 'osx.png'),
(3, 'Linux', 'linux.png'),
(4, 'Debian Linux', 'debian.png'),
(5, 'Arch Linux', 'arch.png'),
(6, 'Suse Linux', 'suse.png'),
(7, 'Gentoo Linux', 'gentoo.png'),
(8, 'Fedora Linux', 'fedora.png'),
(9, 'Ubuntu Linux', 'ubuntu.png'),
(10, 'VMware ESX/ESXi', 'esx.png'),
(11, 'Android', 'android.png');


INSERT INTO `configuration` (`dev_id`, `configstring`, `value`, `title`, `hint`, `type`, `category`) VALUES
(0, 'main_sitetitle', 'Homie', 'Seitentitel', '', 'text', 'Allgemein'),
(0, 'fbox_address', '', 'Fritzbox Adresse', '', 'text', 'Fritzbox'),
(0, 'fbox_password', '', 'Fritzbox Passwort', '', 'password', 'Fritzbox'),
(0, 'main_socketaddress', '', 'Websocket Addresse', 'localhost', 'text', 'Allgemein'),
(0, 'main_socketport', '', 'Websocket Port', '8000', 'text', 'Allgemein'),
(0, 'dwd_url_bundesland', '', 'DWD URL für das Bundesland', 'http://www.dwd.de/dyn/app/ws/html/reports/SU_report_de.html', 'text', 'Wetter'),
(0, 'dwd_url_landkreis', '', 'DWD URL für den Landkreis', 'http://www.dwd.de/dyn/app/ws/html/reports/TUT_warning_de.html', 'text', 'Wetter'),
(0, 'dwd_name_landkreis', '', 'Name des Landkreises', '', 'text', 'Wetter'),
(0, 'fhem_url', '', 'FHEM Webinterface URL', 'http://localhost:8083', 'text', 'Allgemein'),
(0, 'temp_path', '/tmp', 'Temp Verzeichnispfad', 'z.B. /tmp', 'text', 'Allgemein'),
(0, 'dhcp_lease_file', '', 'DHCP Lease Datei', 'Absoluter Pfad zur DHCP Lease Datei', 'text', 'Netzwerk'),
(0, 'position_longitude', '', 'Ortsangabe Breitengrad', '52.4827', 'text', 'Wetter'),
(0, 'position_latitude', '', 'Ortsangabe Längengrad', '13.2905', 'text', 'Wetter'),
(0, 'garbageplan_url', '', 'URL zum CSV Abfallkalender', '', 'text', 'Kalender'),
(0, 'accessable_ipranges', '', 'IP-Bereiche mit Zufriffserlaubnis', '192.168.1*, 10.0.0.*', 'text', 'Allgemein'),
(0, 'sharefile_remoteaddress', '', 'Hostname/IP für Dateibereitstellung', 'z.B. cloud.dyndns.org', 'text', 'Allgemein'),
(0, 'homie_baseurl', '', 'Basis URL', 'http://localhost', 'text', 'Allgemein');

INSERT INTO `groups` (`gid`, `isAdmin`, `grpname`) VALUES (1, 0, 'Benutzer'), (2, 1, 'Administrator');