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
(10, 'NetzwerkgerÃ¤t'),
(11, 'Datensammler'),
(12, 'Raspberry Pi GPIO'),
(13, 'PVServer');

INSERT IGNORE INTO `configuration` (`dev_id`, `configstring`, `value`, `title`, `hint`, `type`, `category`) VALUES
(0, 'main_sitetitle', 'Hoanoho', 'Seitentitel', '', 'text', 'Allgemein'),
(0, 'maintenance_msg', '', 'Systemnachricht', 'Nachricht an Benutzer', 'text', 'Allgemein'),
(0, 'fbox_address', '', 'Fritzbox Adresse', '', 'text', 'Fritzbox'),
(0, 'fbox_user', '', 'Fritzbox Benutzer', 'optional', 'text', 'Fritzbox'),
(0, 'fbox_password', '', 'Fritzbox Passwort', '', 'password', 'Fritzbox'),
(0, 'main_socketport', '8000', 'Websocket Port', '8000', 'text', 'Allgemein'),
(0, 'dwd_region', '', 'Region', '', 'dwd_region', 'Wetter'),
(0, 'fhem_url', 'http://localhost:8083/fhem', 'FHEM Webinterface URL', 'http://localhost:8083/fhem', 'text', 'Allgemein'),
(0, 'position_longitude', '', 'Ortsangabe Längengrad', '13.406091199999992000', 'text', 'Wetter'),
(0, 'position_latitude', '', 'Ortsangabe Breitengrad', '52.519171000000000000', 'text', 'Wetter'),
(0, 'garbageplan_url', '', 'URL zum CSV Abfallkalender', '', 'text', 'Kalender'),
(0, 'accessable_ipranges', '', 'IP-Bereiche mit Zufriffserlaubnis', '192.168.1*, 10.0.0.*', 'text', 'Allgemein'),
(0, 'sharefile_remoteaddress', '', 'Hostname/IP für Dateibereitstellung', 'z.B. cloud.dyndns.org', 'text', 'Allgemein');

INSERT IGNORE INTO `groups` (`gid`, `isAdmin`, `grpname`) VALUES (1, 0, 'Benutzer'), (2, 1, 'Administrator');
