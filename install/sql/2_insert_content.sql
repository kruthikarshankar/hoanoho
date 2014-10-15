SET NAMES utf8 COLLATE utf8_unicode_ci;
SET CHARACTER SET utf8;

INSERT IGNORE INTO `types` (`type_id`, `name`) VALUES
(1, 'Ein/Aus-Schalter'),
(2, 'Temperaturregelung'),
(3, 'Webcam'),
(4, 'Jalousie'),
(5, 'Wertanzeige'),
(6, 'Dimmer'),
(7, 'Tür/Fenster-Kontakt'),
(8, 'Philips Hue'),
(9, 'Brandmelder'),
(10, 'Netzwerkgerät'),
(11, 'Datensammler'),
(12, 'Raspberry Pi GPIO'),
(13, 'PVServer');


INSERT IGNORE INTO `network_os` (`os_id`, `name`, `icon`) VALUES
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


INSERT IGNORE INTO `configuration` (`dev_id`, `configstring`, `value`, `title`, `hint`, `type`, `category`) VALUES
(0, 'main_sitetitle', 'Hoanoho', 'Seitentitel', '', 'text', 'Allgemein'),
(0, 'maintenance_msg', '', 'Systemnachricht', 'Nachricht an Benutzer', 'text', 'Allgemein'),
(0, 'fbox_address', '', 'Fritzbox Adresse', '', 'text', 'Fritzbox'),
(0, 'fbox_user', '', 'Fritzbox Benutzer', 'optional', 'text', 'Fritzbox'),
(0, 'fbox_password', '', 'Fritzbox Passwort', 'optional', 'password', 'Fritzbox'),
(0, 'main_socketaddress', '', 'Websocket Addresse', 'ws://192.168.0.1:8000/ws', 'text', 'Allgemein'),
(0, 'dwd_state', '', 'Bundesland', '', 'dwd_state', 'Wetter'),
(0, 'dwd_region', '', 'Region für Warnungen', '', 'dwd_region', 'Wetter'),
(0, 'fhem_url', 'http://localhost:8083/fhem', 'FHEM Webinterface URL', 'http://localhost:8083/fhem', 'text', 'Allgemein'),
(0, 'dhcp_lease_file', '', 'DHCP Lease Datei', 'Absoluter Pfad zur DHCP Lease Datei', 'text', 'Netzwerk'),
(0, 'position_longitude', '', 'Ortsangabe Längengrad', '13.406091199999992000', 'text', 'Wetter'),
(0, 'position_latitude', '', 'Ortsangabe Breitengrad', '52.519171000000000000', 'text', 'Wetter'),
(0, 'garbageplan_url', '', 'URL zum CSV Abfallkalender', '', 'text', 'Kalender'),
(0, 'accessable_ipranges', '', 'IP-Bereiche mit Zufriffserlaubnis', '192.168.1*, 10.0.0.*', 'text', 'Allgemein'),
(0, 'sharefile_remoteaddress', '', 'Hostname/IP für Dateibereitstellung', 'z.B. cloud.dyndns.org', 'text', 'Allgemein');

INSERT IGNORE INTO `groups` (`gid`, `isAdmin`, `grpname`) VALUES (1, 0, 'Benutzer'), (2, 1, 'Administrator');