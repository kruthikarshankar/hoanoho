SET NAMES utf8 COLLATE utf8_unicode_ci;
SET CHARACTER SET utf8;
SET FOREIGN_KEY_CHECKS = 0;

# Dump of table dwd_dienststelle
# ------------------------------------------------------------

INSERT IGNORE INTO `dwd_dienststelle` (`dienststelle_id`, `dienststelle_name`)
VALUES
	('EM','Essen');

INSERT IGNORE INTO `dwd_dienststelle` (`dienststelle_id`, `dienststelle_name`)
VALUES
	('FG','Freiburg');

INSERT IGNORE INTO `dwd_dienststelle` (`dienststelle_id`, `dienststelle_name`)
VALUES
	('HA','Hamburg');

INSERT IGNORE INTO `dwd_dienststelle` (`dienststelle_id`, `dienststelle_name`)
VALUES
	('LZ','Leipzig');

INSERT IGNORE INTO `dwd_dienststelle` (`dienststelle_id`, `dienststelle_name`)
VALUES
	('MS','München');

INSERT IGNORE INTO `dwd_dienststelle` (`dienststelle_id`, `dienststelle_name`)
VALUES
	('OF','Offenbach');

INSERT IGNORE INTO `dwd_dienststelle` (`dienststelle_id`, `dienststelle_name`)
VALUES
	('PD','Potsdam');

INSERT IGNORE INTO `dwd_dienststelle` (`dienststelle_id`, `dienststelle_name`)
VALUES
	('SU','Stuttgart');


# Dump of table dwd_erscheinung
# ------------------------------------------------------------

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(1,'Wind');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(2,'Nebel');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(3,'Starkregen ');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(4,'Dauerregen');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(5,'Schneefall');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(6,'Schneeverwehungen in Lagen bis 800m');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(7,'Glätte');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(8,'Glatteis');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(9,'Örtlich Glatteis');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(10,'Tauwetter');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(11,'Starkes Tauwetter');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(12,'Frost');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(13,'Gewitter');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(14,'Schweres Gewitter');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(15,'Schweres Gewitter mit extremen Orkanböen');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(16,'Schweres Gewitter mit extremem Starkregen');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(17,'Hoher UV-Index');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(18,'Hitze');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(19,'Testwarnung');

INSERT IGNORE INTO `dwd_erscheinung` (`erscheinung_id`, `erscheinung_name`)
VALUES
	(20,'Leiterseilschwingung');


# Dump of table dwd_hoehenstufe
# ------------------------------------------------------------

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('A','0 bis 200 m');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('B','Lagen über 200 m');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('C','Lagen über 400 m');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('D','Lagen über 600 m');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('E','Lagen über 800 m');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('F','Lagen über 1000 m');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('G','Lagen über 1500 m');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('H','Lagen über 2000 m');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('L','Lagen unter 800 m');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('M','Lagen unter 600 m');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('N','Lagen unter 400 m');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('S','Binnenseen');

INSERT IGNORE INTO `dwd_hoehenstufe` (`hoehenstufe_id`, `hoehenstufe_name`)
VALUES
	('X','alle Höhenstufen');


# Dump of table dwd_land
# ------------------------------------------------------------

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('BB','Berlin-Brandenburg');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('BL','Berlin');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('BW','Baden-Württemberg');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('BY','Bayern');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('HA','Hamburg See');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('HB','Bremen');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('HE','Hessen');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('HH','Hamburg');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('MV','Mecklenburg-Vorpommern');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('NRW','Nordrhein-Westfalen');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('NS','Niedersachsen');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('RP','Rheinland-Pfalz');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('SA','Sachsen-Anhalt');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('SH','Schleswig-Holstein');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('SL','Saarland');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('SN','Sachsen');

INSERT IGNORE INTO `dwd_land` (`land_id`, `land_name`)
VALUES
	('TH','Thüringen');


# Dump of table dwd_warngebiet
# ------------------------------------------------------------

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(1,'1','NRW','ACX','StädteRegion Aachen','EM','AC',2,'StädteRegion Aachen','','StädteRegion Aachen','Umbenennung Kreis 2009',5354,105354000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(2,'2','NRW','BIX','Stadt Bielefeld','EM','BI',1,'Bielefeld','','Bielefeld',NULL,5711,105711000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(3,'3','NRW','BMX','Rhein-Erft-Kreis','EM','BM',2,'Rhein-Erft-Kreis','','Rhein-Erft-Kreis',NULL,5362,105362000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(4,'4','NRW','BNX','Bundesstadt Bonn','EM','BN',2,'Bundesstadt Bonn','','Bundesstadt Bonn',NULL,5314,105314000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(5,'5','NRW','BOR','Kreis Borken','EM','BOR',2,'Borken','','Borken',NULL,5554,105554000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(6,'6','NRW','BOT','Stadt Bottrop','EM','BOT',1,'Bottrop','','Bottrop',NULL,5512,105512000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(7,'7','NRW','BOX','Stadt Bochum','EM','BO',1,'Bochum','','Bochum',NULL,5911,105911000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(8,'8','NRW','COE','Kreis Coesfeld','EM','COE',2,'Coesfeld','','Coesfeld',NULL,5558,105558000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(9,'9','NRW','DNX','Kreis Düren','EM','DN',2,'Düren','','Düren',NULL,5358,105358000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(10,'10','NRW','DOX','Stadt Dortmund','EM','DO',1,'Dortmund','','Dortmund',NULL,5913,105913000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(11,'11','NRW','DUX','Stadt Duisburg','EM','DU',1,'Duisburg','','Duisburg',NULL,5112,105112000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(12,'12','NRW','DXX','Stadt Düsseldorf','EM','D',1,'Düsseldorf','','Düsseldorf',NULL,5111,105111000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(13,'13','NRW','ENX','Ennepe-Ruhr-Kreis','EM','EN',2,'Ennepe-Ruhr-Kreis','','Ennepe-Ruhr-Kreis',NULL,5954,105954000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(14,'14','NRW','EUS','Kreis Euskirchen','EM','EUS',2,'Euskirchen','','Euskirchen','kein EU - historisch begründet',5366,105366000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(15,'15','NRW','EXX','Stadt Essen','EM','E',1,'Essen','','Essen',NULL,5113,105113000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(16,'16','NRW','GEX','Stadt Gelsenkirchen','EM','GE',1,'Gelsenkirchen','','Gelsenkirchen',NULL,5513,105513000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(17,'17','NRW','GLX','Rheinisch-Bergischer Kreis','EM','GL',2,'Rheinisch-Bergischer Kreis','','Rheinisch-Bergischer Kreis',NULL,5378,105378000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(18,'18','NRW','GMX','Oberbergischer Kreis','EM','GM',2,'Oberbergischer Kreis','','Oberbergischer Kreis',NULL,5374,105374000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(19,'19','NRW','GTX','Kreis Gütersloh','EM','GT',2,'Gütersloh','','Gütersloh',NULL,5754,105754000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(20,'20','NRW','HAM','Kreis Hamm','EM','HAM',2,'Hamm','','Hamm',NULL,5915,105915000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(21,'21','NRW','HAX','Stadt Hagen','EM','HA',1,'Hagen','','Hagen',NULL,5914,105914000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(22,'22','NRW','HER','Stadt Herne','EM','HER',1,'Herne','','Herne',NULL,5916,105916000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(23,'23','NRW','HFX','Kreis Herford','EM','HF',2,'Herford','','Herford',NULL,5758,105758000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(24,'24','NRW','HSK','Hochsauerlandkreis','EM','HSK',2,'Hochsauerlandkreis','','Hochsauerlandkreis',NULL,5958,105958000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(25,'25','NRW','HSX','Kreis Heinsberg','EM','HS',2,'Heinsberg','','Heinsberg',NULL,5370,105370000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(26,'26','NRW','HXX','Kreis Höxter','EM','HX',2,'Höxter','','Höxter',NULL,5762,105762000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(27,'27','NRW','KLE','Kreis Kleve','EM','KLE',2,'Kleve','','Kleve',NULL,5154,105154000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(28,'28','NRW','KRX','Stadt Krefeld','EM','KR',1,'Krefeld','','Krefeld',NULL,5114,105114000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(29,'29','NRW','KXX','Stadt Köln','EM','K',1,'Köln','','Köln',NULL,5315,105315000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(30,'30','NRW','LEV','Stadt Leverkusen','EM','LEV',1,'Leverkusen','','Leverkusen',NULL,5316,105316000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(31,'31','NRW','LIP','Kreis Lippe','EM','LIP',2,'Lippe','','Lippe',NULL,5766,105766000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(32,'32','NRW','MEX','Kreis Mettmann','EM','ME',2,'Mettmann','','Mettmann',NULL,5158,105158000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(33,'33','NRW','MGX','Stadt Mönchengladbach','EM','MG',1,'Mönchengladbach','','Mönchengladbach',NULL,5116,105116000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(34,'34','NRW','MHX','Stadt Mülheim an der Ruhr','EM','MH',1,'Mülheim an der Ruhr','','Mülheim an der Ruhr',NULL,5117,105117000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(35,'35','NRW','MIX','Kreis Minden-Lübbecke','EM','MI',2,'Minden-Lübbecke','','Minden-Lübbecke',NULL,5770,105770000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(36,'36','NRW','MKX','Märkischer Kreis','EM','MK',2,'Märkischer Kreis','','Märkischer Kreis',NULL,5962,105962000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(37,'37','NRW','MSX','Stadt Münster','EM','MS',1,'Münster','','Münster',NULL,5515,105515000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(38,'38','NRW','NEX','Rhein-Kreis Neuss','EM','NE',2,'Rhein-Kreis Neuss','','Rhein-Kreis Neuss',NULL,5162,105162000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(39,'39','NRW','OBX','Stadt Oberhausen','EM','OB',1,'Oberhausen','','Oberhausen',NULL,5119,105119000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(40,'40','NRW','OEX','Kreis Olpe','EM','OE',2,'Olpe','','Olpe',NULL,5966,105966000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(41,'41','NRW','PBX','Kreis Paderborn','EM','PB',2,'Paderborn','','Paderborn',NULL,5774,105774000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(42,'42','NRW','REX','Kreis Recklinghausen','EM','RE',2,'Recklinghausen','','Recklinghausen',NULL,5562,105562000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(43,'43','NRW','RSX','Stadt Remscheid','EM','RS',1,'Remscheid','','Remscheid',NULL,5120,105120000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(44,'44','NRW','SGX','Stadt Solingen','EM','SG',1,'Solingen','','Solingen',NULL,5122,105122000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(45,'45','NRW','SIX','Kreis Siegen-Wittgenstein','EM','SI',2,'Siegen-Wittgenstein','','Siegen-Wittgenstein',NULL,5970,105970000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(46,'46','NRW','SOX','Kreis Soest','EM','SO',2,'Soest','','Soest',NULL,5974,105974000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(47,'47','NRW','STX','Kreis Steinfurt','EM','ST',2,'Steinfurt','','Steinfurt',NULL,5566,105566000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(48,'48','NRW','SUX','Rhein-Sieg-Kreis','EM','SU',2,'Rhein-Sieg-Kreis','','Rhein-Sieg-Kreis',NULL,5382,105382000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(49,'49','NRW','UNX','Kreis Unna','EM','UN',2,'Unna','','Unna',NULL,5978,105978000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(50,'50','NRW','VIE','Kreis Viersen','EM','VIE',2,'Viersen','','Viersen',NULL,5166,105166000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(51,'51','NRW','WAF','Kreis Warendorf','EM','WAF',2,'Warendorf','','Warendorf',NULL,5570,105570000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(52,'52','NRW','WES','Kreis Wesel','EM','WES',2,'Wesel','','Wesel',NULL,5170,105170000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(53,'53','NRW','WXX','Stadt Wuppertal','EM','W',1,'Wuppertal','','Wuppertal',NULL,5124,105124000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(54,'54','HB','HBX','Hansestadt Bremen','HA','HB',1,'Hansestadt Bremen','','Hansestadt Bremen',NULL,4011,104011000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(55,'55','HB','BHV','Stadt Bremerhaven','HA','BHV',1,'Bremerhaven','','Bremerhaven','met. Anforderung',4012,104012000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(56,'56','HH','HHX','Hansestadt Hamburg','HA','HH',1,'Hansestadt Hamburg','','Hansestadt Hamburg',NULL,2000,102000000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(57,'57','NS','AUI','Kreis Aurich - Binnenland','HA','AUR',2,'Aurich','- Binnenland','Aurich - Binnenland','ab Februar 2012',3452,903452001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(58,'58','NS','AUK','Kreis Aurich - Küste','HA','AUR',2,'Aurich','- Küste','Aurich - Küste','ab Februar 2012',3450,903452002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(59,'59','NS','BRI','Kreis Wesermarsch - Binnenland','HA','BRA',2,'Wesermarsch','- Binnenland','Wesermarsch - Binnenland','ab Februar 2012',3461,903461001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(60,'60','NS','BRK','Kreis Wesermarsch - Küste','HA','BRA',2,'Wesermarsch','- Küste','Wesermarsch - Küste','ab Februar 2012',3465,903461002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(61,'61','NS','BSX','Stadt Braunschweig','HA','BS',1,'Braunschweig','','Braunschweig',NULL,3101,103101000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(62,'62','NS','CEL','Kreis Celle','HA','CE',2,'Celle','','Celle','kein CE - historisch begründet',3351,103351000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(63,'63','NS','CLP','Kreis Cloppenburg','HA','CLP',2,'Cloppenburg','','Cloppenburg',NULL,3453,103453000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(64,'64','NS','CUI','Kreis Cuxhaven - Binnenland','HA','CUX',2,'Cuxhaven','- Binnenland','Cuxhaven - Binnenland','ab Februar 2012',3352,903352001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(65,'65','NS','CUK','Kreis Cuxhaven - Küste','HA','CUX',2,'Cuxhaven','- Küste','Cuxhaven - Küste','ab Februar 2012',3350,903352002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(66,'66','NS','DAN','Kreis Lüchow-Dannenberg','HA','DAN',2,'Lüchow-Dannenberg','','Lüchow-Dannenberg',NULL,3354,103354000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(67,'67','NS','DEL','Stadt Delmenhorst','HA','DEL',1,'Delmenhorst','','Delmenhorst',NULL,3401,103401000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(68,'68','NS','DHX','Kreis Diepholz','HA','DH',2,'Diepholz','','Diepholz',NULL,3251,103251000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(69,'69','NS','ELX','Kreis Emsland','HA','EL',2,'Emsland','','Emsland',NULL,3454,103454000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(70,'70','NS','EMD','Stadt Emden','HA','EMD',1,'Emden','','Emden',NULL,3402,103402000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(71,'71','NS','FRB','Kreis Friesland - Binnenland','HA','FRI',2,'Friesland','- Binnenland','Friesland - Binnenland','ab Februar 2012',3455,903455001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(72,'72','NS','FRK','Kreis Friesland - Küste','HA','FRI',2,'Friesland','- Küste','Friesland - Küste','ab Februar 2012',3449,903455002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(73,'73','NS','GIF','Kreis Gifhorn','HA','GF',2,'Gifhorn','','Gifhorn','kein GF - historisch begründet',3151,103151000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(74,'74','NS','GOE','Kreis und Stadt Göttingen','HA','GÖ',2,'Göttingen','und Stadt','Göttingen','GÖX technisch unsicher',3152,103152000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(75,'75','NS','GSX','Kreis Goslar','HA','GS',2,'Goslar','','Goslar',NULL,3153,103153000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(76,'76','NS','HAN','Region Hannover','HA','H',2,'Hannover','und Stadt','Hannover','H(XX) nicht umgesetzt wegen Dopplung mit Höxter HX(X)',3241,103241000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(77,'77','NS','HBO','Insel Borkum','HA','HBO',2,'Insel Borkum','','Insel Borkum','met. Anforderung',3463,903457002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(78,'78','NS','HEX','Kreis Helmstedt','HA','HE',2,'Helmstedt','','Helmstedt',NULL,3154,103154000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(79,'79','NS','HIX','Kreis Hildesheim','HA','HI',2,'Hildesheim','','Hildesheim',NULL,3254,103254000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(80,'80','NS','HMX','Kreis Hameln-Pyrmont','HA','HM',2,'Hameln-Pyrmont','','Hameln-Pyrmont',NULL,3252,103252000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(81,'81','NS','HOL','Kreis Holzminden','HA','HOL',2,'Holzminden','','Holzminden',NULL,3255,103255000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(82,'82','NS','LER','Kreis Leer','HA','LER',2,'Leer','','Leer',NULL,3457,903457001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(83,'83','NS','LGX','Kreis Lüneburg','HA','LG',2,'Lüneburg','','Lüneburg',NULL,3355,103355000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(84,'84','NS','NIX','Kreis Nienburg','HA','NI',2,'Nienburg','','Nienburg',NULL,3256,103256000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(85,'85','NS','NOH','Kreis Grafschaft Bentheim','HA','NOH',2,'Grafschaft Bentheim','','Grafschaft Bentheim',NULL,3456,103456000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(86,'86','NS','NOM','Kreis Northeim','HA','NOM',2,'Northeim','','Northeim',NULL,3155,103155000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(87,'87','NS','OHA','Kreis Osterode am Harz','HA','OHA',2,'Osterode am Harz','','Osterode am Harz',NULL,3156,103156000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(88,'88','NS','OHZ','Kreis Osterholz','HA','OHZ',2,'Osterholz','','Osterholz',NULL,3356,103356000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(89,'89','NS','OLX','Kreis und Stadt Oldenburg','HA','OL',2,'Oldenburg','und Stadt','Oldenburg','Unterscheidung Stadt/Land nicht erforderlich',3458,103458000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(90,'90','NS','OSX','Kreis und Stadt Osnabrück','HA','OS',2,'Osnabrück','und Stadt','Osnabrück','Unterscheidung Stadt/Land nicht erforderlich',3459,103459000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(91,'91','NS','PEX','Kreis Peine','HA','PE',2,'Peine','','Peine',NULL,3157,103157000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(92,'92','NS','ROW','Kreis Rotenburg (Wümme)','HA','ROW',2,'Rotenburg (Wümme)','','Rotenburg (Wümme)',NULL,3357,103357000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(93,'93','NS','SFA','Heidekreis','HA','SFA',2,'Heidekreis','','Heidekreis','Umbenennung von Kreis Soltau-Fallingbostel in Heidekreis zum 01.08.2011, DWD-Kennung bleibt b.a.W.',3358,103358000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(94,'94','NS','SHG','Kreis Schaumburg','HA','SHG',2,'Schaumburg','','Schaumburg',NULL,3257,103257000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(95,'95','NS','STD','Kreis Stade','HA','STD',2,'Stade','','Stade',NULL,3359,103359000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(96,'96','NS','SZX','Stadt Salzgitter','HA','SZ',1,'Salzgitter','','Salzgitter',NULL,3102,103102000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(97,'97','NS','UEL','Kreis Uelzen','HA','UE',2,'Uelzen','','Uelzen','kein UE - historisch begründet',3360,103360000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(98,'98','NS','VEC','Kreis Vechta','HA','VEC',2,'Vechta','','Vechta',NULL,3460,103460000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(99,'99','NS','VER','Kreis Verden','HA','VER',2,'Verden','','Verden',NULL,3361,103361000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(100,'100','NS','WFX','Kreis Wolfenbüttel','HA','WF',2,'Wolfenbüttel','','Wolfenbüttel',NULL,3158,103158000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(101,'101','NS','WHV','Stadt Wilhelmshaven','HA','WHV',1,'Wilhelmshaven','','Wilhelmshaven',NULL,3405,103405000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(102,'102','NS','WLX','Kreis Harburg','HA','WL',2,'Harburg','','Harburg',NULL,3353,103353000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(103,'103','NS','WOB','Stadt Wolfsburg','HA','WOB',1,'Wolfsburg','','Wolfsburg',NULL,3103,103103000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(104,'104','NS','WST','Kreis Ammerland','HA','WST',2,'Ammerland','','Ammerland',NULL,3451,103451000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(105,'105','NS','WTI','Kreis Wittmund - Binnenland','HA','WTM',2,'Wittmund','- Binnenland','Wittmund - Binnenland','ab Februar 2012',3462,903462001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(106,'106','NS','WTK','Kreis Wittmund - Küste','HA','WTM',2,'Wittmund','- Küste','Wittmund - Küste','ab Februar 2012',3466,903462002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(107,'107','SH','FLX','Stadt Flensburg','HA','FL',1,'Flensburg','','Flensburg',NULL,1001,101001000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(108,'108','SH','HEB','Kreis Dithmarschen - Binnenland','HA','HEI',2,'Dithmarschen','- Binnenland','Dithmarschen - Binnenland','ab Februar 2012',1051,901051001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(109,'109','SH','HEK','Kreis Dithmarschen - Küste','HA','HEI',2,'Dithmarschen','- Küste','Dithmarschen - Küste','ab Februar 2012',1052,901051002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(110,'110','SH','HLX','Hansestadt Lübeck','HA','HL',2,'Hansestadt Lübeck','','Hansestadt Lübeck',NULL,1003,101003000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(111,'111','SH','IZX','Kreis Steinburg','HA','IZ',2,'Steinburg','','Steinburg',NULL,1061,101061000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(112,'112','SH','KIX','Stadt Kiel','HA','KI',1,'Kiel','','Kiel',NULL,1002,101002000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(113,'113','SH','NFI','Kreis Nordfriesland - Binnenland','HA','NF',2,'Nordfriesland','- Binnenland','Nordfriesland - Binnenland','ab Februar 2012',1054,901054001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(114,'114','SH','NFK','Kreis Nordfriesland - Küste','HA','NF',2,'Nordfriesland','- Küste','Nordfriesland - Küste','ab Februar 2012',1049,901054002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(115,'115','SH','NMS','Stadt Neumünster','HA','NMS',1,'Neumünster','','Neumünster',NULL,1004,101004000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(116,'116','SH','ODX','Kreis Stormarn','HA','OD',2,'Stormarn','','Stormarn',NULL,1062,101062000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(117,'117','SH','OHI','Kreis Ostholstein - Binnenland','HA','OH',2,'Ostholstein','- Binnenland','Ostholstein - Binnenland','ab Februar 2012',1055,901055001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(118,'118','SH','OHK','Kreis Ostholstein - Küste','HA','OH',2,'Ostholstein','- Küste','Ostholstein - Küste','ab Februar 2012',1050,901055002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(119,'119','SH','PIH','Insel Helgoland','HA','PI',2,'Insel Helgoland','','Insel Helgoland','met. Anforderung',1063,901056002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(120,'120','SH','PIX','Kreis Pinneberg','HA','PI',2,'Pinneberg','','Pinneberg','ohne Helgoland',1056,901056001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(121,'121','SH','PLI','Kreis Plön - Binnenland','HA','PLÖ',2,'Plön','- Binnenland','Plön - Binnenland','met. Anforderung',1057,901057001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(122,'122','SH','PLK','Kreis Plön - Küste','HA','PLÖ',2,'Plön','- Küste','Plön - Küste','met. Anforderung',1097,901057002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(123,'123','SH','RDI','Kreis Rendsburg-Eckernförde - Binnenland','HA','RD',2,'Rendsburg-Eckernförde','- Binnenland','Rendsburg-Eckernförde - Binnenland','met. Anforderung',1058,901058001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(124,'124','SH','RDK','Kreis Rendsburg-Eckernförde - Küste','HA','RD',2,'Rendsburg-Eckernförde','- Küste','Rendsburg-Eckernförde - Küste','met. Anforderung',1098,901058002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(125,'125','SH','RZX','Kreis Herzogtum Lauenburg','HA','RZ',2,'Herzogtum Lauenburg','','Herzogtum Lauenburg',NULL,1053,101053000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(126,'126','SH','SEX','Kreis Segeberg','HA','SE',2,'Segeberg','','Segeberg',NULL,1060,101060000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(127,'127','SH','SLI','Kreis Schleswig-Flensburg - Binnenland','HA','SL',2,'Schleswig-Flensburg','- Binnenland','Schleswig-Flensburg - Binnenland','met. Anforderung',1059,901059001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(128,'128','SH','SLK','Kreis Schleswig-Flensburg - Küste','HA','SL',2,'Schleswig-Flensburg','- Küste','Schleswig-Flensburg - Küste','met. Anforderung',1099,901059002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(129,'129','SA','ABI','Kreis Anhalt-Bitterfeld','LZ','ABI',2,'Anhalt-Bitterfeld','','Anhalt-Bitterfeld',NULL,15082,115082000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(130,'130','SA','BLK','Kreis Burgenland','LZ','BLK',2,'Burgenland','','Burgenland',NULL,15084,115084000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(131,'131','SA','BOE','Kreis Börde','LZ','BK',2,'Börde','','Börde','BK bei Festlegung nicht bekannt',15083,115083000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(132,'132','SA','DEX','Stadt Dessau-Roßlau','LZ','DE',1,'Dessau-Roßlau','','Dessau-Roßlau',NULL,15001,115001000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(133,'133','SA','HAL','Stadt Halle (Saale)','LZ','HAL',1,'Halle (Saale)','','Halle (Saale)',NULL,15002,115002000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(134,'134','SA','HZH','Kreis Harz - Bergland (Oberharz)','LZ','HZ',2,'Harz','- Bergland (Oberharz)','Harz - Bergland (Oberharz)','Höhenlagen über 400 m, met. Anforderung',15080,915085002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(135,'135','SA','HZX','Kreis Harz - Tiefland','LZ','HZ',2,'Harz','- Tiefland','Harz - Tiefland','Lagen unter 400 m, met. Anforderung',15085,915085001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(136,'136','SA','JLX','Kreis Jerichower Land','LZ','JL',2,'Jerichower Land','','Jerichower Land',NULL,15086,115086000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(137,'137','SA','MDX','Stadt Magdeburg','LZ','MD',1,'Magdeburg','','Magdeburg',NULL,15003,115003000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(138,'138','SA','MSH','Kreis Mansfeld-Südharz','LZ','MSH',2,'Mansfeld-Südharz','','Mansfeld-Südharz',NULL,15087,115087000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(139,'139','SA','SAL','Salzlandkreis','LZ','SAL',2,'Salzlandkreis','','Salzlandkreis','SLK bei Kreisgründung schon vergeben (Schleswig-Küste)',15089,115089000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(140,'140','SA','SAW','Altmarkkreis Salzwedel','LZ','SAW',2,'Altmarkkreis Salzwedel','','Altmarkkreis Salzwedel',NULL,15081,115081000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(141,'141','SA','SDL','Kreis Stendal','LZ','SDL',2,'Stendal','','Stendal',NULL,15090,115090000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(142,'142','SA','SKX','Saalekreis','LZ','SK',2,'Saalekreis','','Saalekreis',NULL,15088,115088000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(143,'143','SA','WBX','Kreis Wittenberg','LZ','WB',2,'Wittenberg','','Wittenberg',NULL,15091,115091000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(144,'144','SN','BZF','Kreis Bautzen - Tiefland','LZ','BZ',2,'Bautzen','- Tiefland','Bautzen - Tiefland','Lagen unter 400 m der alten Kreise Bautzen, Kamenz, Hoyerswerda, met. Anforderung',14625,914625001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(145,'145','SN','BZH','Kreis Bautzen - Bergland','LZ','BZ',2,'Bautzen','- Bergland','Bautzen - Bergland','Höhenlagen über 400 m der alten Kreise Bautzen, Kamenz, Hoyerswerda, met. Anforderung',14623,914625002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(146,'146','SN','CXX','Stadt Chemnitz','LZ','C',1,'Chemnitz','','Chemnitz',NULL,14511,114511000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(147,'147','SN','DDX','Stadt Dresden','LZ','DD',1,'Dresden','','Dresden',NULL,14612,114612000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(148,'148','SN','EKX','Erzgebirgskreis','LZ','EK',2,'Erzgebirgskreis','','Erzgebirgskreis','ERZ bei Festlegung nicht bekannt: alte Kreise Annaberg, Stollberg, Mittlerer Erzgebirgskreis, Aue-Schwarzenberg',14521,114521000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(149,'149','SN','FGF','Kreis Mittelsachsen - Tiefland','LZ','FG',2,'Mittelsachsen','- Tiefland','Mittelsachsen - Tiefland','Lagen unter 400 m der alten Kreise Döbeln, Freiberg, Mittweida, met. Anforderung',14522,914522001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(150,'150','SN','FGH','Kreis Mittelsachsen - Bergland','LZ','FG',2,'Mittelsachsen','- Bergland','Mittelsachsen - Bergland','Höhenlagen über 400 m der alten Kreise Döbeln, Freiberg, Mittweida, met. Anforderung',14527,914522002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(151,'151','SN','GRF','Kreis Görlitz - Tiefland','LZ','GR',2,'Görlitz','- Tiefland','Görlitz - Tiefland','Lagen unter 400 m der alten Kreise Löbau-Zittau, Görlitz, Niederschlesischer Oberlausitzkreis, met. Anforderung',14626,914626001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(152,'152','SN','GRH','Kreis Görlitz - Bergland','LZ','GR',2,'Görlitz','- Bergland','Görlitz - Bergland','Höhenlagen über 400 m der alten Kreise Löbau-Zittau, Görlitz, Niederschlesischer Oberlausitzkreis, met. Anforderung',14624,914626002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(153,'153','SN','LLK','Kreis Leipzig','LZ','LLK',2,'Leipzig','','Leipzig','alte Kreise Leipziger Land, Muldentalkreis, met. Anforderung',14729,114729000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(154,'154','SN','LXX','Stadt Leipzig','LZ','L',1,'Leipzig','','Leipzig (Stadt)',NULL,14713,114713000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(155,'155','SN','MEI','Kreis Meißen','LZ','MEI',2,'Meißen','','Meißen','alte Kreise Meißen, Riesa-Großenhain',14627,114627000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(156,'156','SN','PIF','Kreis Sächsische Schweiz-Osterzgebirge - Tiefland','LZ','PIR',2,'Sächsische Schweiz-Osterzgebirge','- Tiefland','Sächsische Schweiz-Osterzgebirge - Tiefland','Lagen unter 400 m der alten Landkreise Sächsische Schweiz, Weißeritzkreis, met. Anforderung',14628,914628001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(157,'157','SN','PIO','Kreis Sächsische Schweiz-Osterzgebirge - ostelbisc','LZ','PIR',2,'Sächsische Schweiz-Osterzgebirge','- ostelbisches Bergland','Sächsische Schweiz-Osterzgebirge - ostelbisches Be','östliche Höhenlagen über 400 m der alten Landkreise Sächsische Schweiz, Weißeritzkreis, met. Anforderung',14630,914628003);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(158,'158','SN','PIW','Kreis Sächsische Schweiz-Osterzgebirge - westelbis','LZ','PIR',2,'Sächsische Schweiz-Osterzgebirge','- westelbisches Bergland','Sächsische Schweiz-Osterzgebirge - westelbisches B','westliche Höhenlagen über 400 m der alten Landkreise Sächsische Schweiz, Weißeritzkreis, met. Anforderung',14629,914628002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(159,'159','SN','TON','Kreis Nordsachsen - Nord','LZ','TDO',2,'Nordsachsen','- Nord','Nordsachsen - Nord','alte Kreise Delitzsch, Torgau-Oschatz (nördliche Teile), met. Anforderung',14730,914730001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(160,'160','SN','TOS','Kreis Nordsachsen - Süd','LZ','TDO',2,'Nordsachsen','- Süd','Nordsachsen - Süd','alte Kreise Delitzsch, Torgau-Oschatz (südliche Teile), met. Anforderung',14731,914730002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(161,'161','SN','VXF','Vogtlandkreis - Tiefland','LZ','V',2,'Vogtlandkreis','- Tiefland','Vogtlandkreis - Tiefland','Lagen unter 400 m Vogtlandkreis, met. Anforderung',14523,914523001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(162,'162','SN','VXH','Vogtlandkreis - Bergland','LZ','V',2,'Vogtlandkreis','- Bergland','Vogtlandkreis - Bergland','Höhenlagen über 400 m Vogtlandkreis, met. Anforderung',14524,914523002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(163,'163','SN','ZXF','Kreis Zwickau - Tiefland','LZ','Z',2,'Zwickau','- Tiefland','Zwickau - Tiefland','Lagen unter 400 m der alten Kreise Chemnitzer Land, Zwickauer Land, Zwickau, met. Anforderung',14525,914524001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(164,'164','SN','ZXH','Kreis Zwickau - Bergland','LZ','Z',2,'Zwickau','- Bergland','Zwickau - Bergland','Höhenlagen über 400 m der alten Kreise Chemnitzer Land, Zwickauer Land, Zwickau, met. Anforderung',14526,914524002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(165,'165','TH','ABG','Kreis Altenburger Land','LZ','ABG',2,'Altenburger Land','','Altenburger Land',NULL,16077,116077000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(166,'166','TH','APX','Kreis Weimarer Land','LZ','AP',2,'Weimarer Land','','Weimarer Land',NULL,16071,116071000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(167,'167','TH','EAX','Stadt Eisenach','LZ','EA',1,'Eisenach','','Eisenach',NULL,16056,116056000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(168,'168','TH','EFX','Stadt Erfurt','LZ','EF',1,'Erfurt','','Erfurt',NULL,16051,116051000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(169,'169','TH','EIC','Kreis Eichsfeld','LZ','EIC',2,'Eichsfeld','','Eichsfeld',NULL,16061,116061000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(170,'170','TH','GRZ','Kreis Greiz','LZ','GRZ',2,'Greiz','','Greiz',NULL,16076,116076000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(171,'171','TH','GTH','Kreis Gotha','LZ','GTH',2,'Gotha','','Gotha',NULL,16067,116067000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(172,'172','TH','GXX','Stadt Gera','LZ','G',1,'Gera','','Gera',NULL,16052,116052000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(173,'173','TH','HBN','Kreis Hildburghausen','LZ','HBN',2,'Hildburghausen','','Hildburghausen',NULL,16069,116069000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(174,'174','TH','IKX','Ilm-Kreis','LZ','IK',2,'Ilm-Kreis','','Ilm-Kreis',NULL,16070,116070000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(175,'175','TH','JXX','Stadt Jena','LZ','J',1,'Jena','','Jena',NULL,16053,116053000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(176,'176','TH','KYF','Kyffhäuserkreis','LZ','KYF',2,'Kyffhäuserkreis','','Kyffhäuserkreis',NULL,16065,116065000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(177,'177','TH','NDH','Kreis Nordhausen','LZ','NDH',2,'Nordhausen','','Nordhausen',NULL,16062,116062000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(178,'178','TH','SHK','Saale-Holzland-Kreis','LZ','SHK',2,'Saale-Holzland-Kreis','','Saale-Holzland-Kreis',NULL,16074,116074000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(179,'179','TH','SHL','Stadt Suhl','LZ','SHL',1,'Suhl','','Suhl',NULL,16054,116054000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(180,'180','TH','SLF','Kreis Saalfeld-Rudolstadt','LZ','SLF',2,'Saalfeld-Rudolstadt','','Saalfeld-Rudolstadt',NULL,16073,116073000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(181,'181','TH','SMX','Kreis Schmalkalden-Meiningen','LZ','SM',2,'Schmalkalden-Meiningen','','Schmalkalden-Meiningen',NULL,16066,116066000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(182,'182','TH','SOK','Saale-Orla-Kreis','LZ','SOK',2,'Saale-Orla-Kreis','','Saale-Orla-Kreis',NULL,16075,116075000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(183,'183','TH','SOM','Kreis Sömmerda','LZ','SÖM',2,'Sömmerda','','Sömmerda','SÖM technisch unsicher',16068,116068000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(184,'184','TH','SON','Kreis Sonneberg','LZ','SON',2,'Sonneberg','','Sonneberg',NULL,16072,116072000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(185,'185','TH','UHX','Unstrut-Hainich-Kreis','LZ','UH',2,'Unstrut-Hainich-Kreis','','Unstrut-Hainich-Kreis',NULL,16064,116064000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(186,'186','TH','WAK','Wartburgkreis','LZ','WAK',2,'Wartburgkreis','','Wartburgkreis',NULL,16063,116063000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(187,'187','TH','WEX','Stadt Weimar','LZ','WE',1,'Weimar','','Weimar',NULL,16055,116055000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(188,'188','BY','AXX','Kreis und Stadt Augsburg','MS','A',2,'Augsburg','und Stadt','Augsburg','Unterscheidung Stadt/Land nicht erforderlich',9772,109772000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(189,'189','BY','ABX','Kreis und Stadt Aschaffenburg','MS','AB',2,'Aschaffenburg','und Stadt','Aschaffenburg','Unterscheidung Stadt/Land nicht erforderlich',9671,109671000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(190,'190','BY','AIC','Kreis Aichach-Friedberg','MS','AIC',2,'Aichach-Friedberg','','Aichach-Friedberg',NULL,9771,109771000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(191,'191','BY','AMX','Stadt Amberg','MS','AM',1,'Amberg','','Amberg',NULL,9361,109361000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(192,'192','BY','ANX','Kreis und Stadt Ansbach','MS','AN',2,'Ansbach','und Stadt','Ansbach','Unterscheidung Stadt/Land nicht erforderlich',9571,109571000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(193,'193','BY','AOX','Kreis Altötting','MS','AÖ',2,'Altötting','','Altötting','AÖ technisch unsicher',9171,109171000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(194,'194','BY','ASX','Kreis Amberg-Sulzbach','MS','AS',2,'Amberg-Sulzbach','','Amberg-Sulzbach',NULL,9371,109371000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(195,'195','BY','BAX','Kreis und Stadt Bamberg','MS','BA',2,'Bamberg','und Stadt','Bamberg','Unterscheidung Stadt/Land nicht erforderlich',9471,109471000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(196,'196','BY','BGL','Kreis Berchtesgadener Land','MS','BGL',2,'Berchtesgadener Land','','Berchtesgadener Land',NULL,9172,109172000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(197,'197','BY','BTX','Kreis und Stadt Bayreuth','MS','BT',2,'Bayreuth','und Stadt','Bayreuth','Unterscheidung Stadt/Land nicht erforderlich',9472,109472000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(198,'198','BY','CHA','Kreis Cham','MS','CHA',2,'Cham','','Cham',NULL,9372,109372000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(199,'199','BY','COX','Kreis und Stadt Coburg','MS','CO',2,'Coburg','und Stadt','Coburg','Unterscheidung Stadt/Land nicht erforderlich',9473,109473000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(200,'200','BY','DAH','Kreis Dachau','MS','DAH',2,'Dachau','','Dachau',NULL,9174,109174000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(201,'201','BY','DEG','Kreis Deggendorf','MS','DEG',2,'Deggendorf','','Deggendorf',NULL,9271,109271000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(202,'202','BY','DGF','Kreis Dingolfing-Landau','MS','DGF',2,'Dingolfing-Landau','','Dingolfing-Landau',NULL,9279,109279000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(203,'203','BY','DLG','Kreis Dillingen a.d.Donau','MS','DLG',2,'Dillingen a.d.Donau','','Dillingen a.d.Donau',NULL,9773,109773000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(204,'204','BY','DON','Kreis Donau-Ries','MS','DON',2,'Donau-Ries','','Donau-Ries',NULL,9779,109779000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(205,'205','BY','EBE','Kreis Ebersberg','MS','EBE',2,'Ebersberg','','Ebersberg',NULL,9175,109175000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(206,'206','BY','EDX','Kreis Erding','MS','ED',2,'Erding','','Erding',NULL,9177,109177000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(207,'207','BY','EIX','Kreis Eichstätt','MS','EI',2,'Eichstätt','','Eichstätt',NULL,9176,109176000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(208,'208','BY','ERX','Stadt Erlangen','MS','ER',1,'Erlangen','','Erlangen',NULL,9562,109562000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(209,'209','BY','ERH','Kreis Erlangen-Höchstadt','MS','ERH',2,'Erlangen-Höchstadt','','Erlangen-Höchstadt',NULL,9572,109572000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(210,'210','BY','FFB','Kreis Fürstenfeldbruck','MS','FFB',2,'Fürstenfeldbruck','','Fürstenfeldbruck',NULL,9179,109179000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(211,'211','BY','FOX','Kreis Forchheim','MS','FO',2,'Forchheim','','Forchheim',NULL,9474,109474000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(212,'212','BY','FRG','Kreis Freyung-Grafenau','MS','FRG',2,'Freyung-Grafenau','','Freyung-Grafenau',NULL,9272,109272000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(213,'213','BY','FSX','Kreis Freising','MS','FS',2,'Freising','','Freising',NULL,9178,109178000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(214,'214','BY','FUE','Kreis und Stadt Fürth','MS','FÜ',2,'Fürth','und Stadt','Fürth','FÜ technisch unsicher',9573,109573000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(215,'215','BY','GAP','Kreis Garmisch-Partenkirchen','MS','GAP',2,'Garmisch-Partenkirchen','','Garmisch-Partenkirchen',NULL,9180,109180000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(216,'216','BY','GZX','Kreis Günzburg','MS','GZ',2,'Günzburg','','Günzburg',NULL,9774,109774000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(217,'217','BY','HAS','Kreis Haßberge','MS','HAS',2,'Haßberge','','Haßberge',NULL,9674,109674000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(218,'218','BY','HOX','Kreis und Stadt Hof','MS','HO',2,'Hof','und Stadt','Hof','Unterscheidung Stadt/Land nicht erforderlich',9475,109475000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(219,'219','BY','INX','Stadt Ingolstadt','MS','IN',1,'Ingolstadt','','Ingolstadt',NULL,9161,109161000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(220,'220','BY','KCX','Kreis Kronach','MS','KC',2,'Kronach','','Kronach',NULL,9476,109476000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(221,'221','BY','KEX','Stadt Kempten (Allgäu)','MS','KE',1,'Kempten (Allgäu)','','Kempten (Allgäu)',NULL,9763,109763000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(222,'222','BY','KEH','Kreis Kelheim','MS','KEH',2,'Kelheim','','Kelheim',NULL,9273,109273000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(223,'223','BY','KFX','Stadt Kaufbeuren','MS','KF',1,'Kaufbeuren','','Kaufbeuren',NULL,9762,109762000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(224,'224','BY','KGX','Kreis Bad Kissingen','MS','KG',2,'Bad Kissingen','','Bad Kissingen',NULL,9672,109672000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(225,'225','BY','KTX','Kreis Kitzingen','MS','KT',2,'Kitzingen','','Kitzingen',NULL,9675,109675000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(226,'226','BY','KUX','Kreis Kulmbach','MS','KU',2,'Kulmbach','','Kulmbach',NULL,9477,109477000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(227,'227','BY','LAX','Kreis und Stadt Landshut','MS','LA',2,'Landshut','und Stadt','Landshut','Unterscheidung Stadt/Land nicht erforderlich',9274,109274000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(228,'228','BY','LAU','Kreis Nürnberger Land','MS','LAU',2,'Nürnberger Land','','Nürnberger Land',NULL,9574,109574000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(229,'229','BY','LIX','Kreis Lindau','MS','LI',2,'Lindau','','Lindau',NULL,9776,109776000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(230,'230','BY','LIF','Kreis Lichtenfels','MS','LIF',2,'Lichtenfels','','Lichtenfels',NULL,9478,109478000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(231,'231','BY','LLX','Kreis Landsberg am Lech','MS','LL',2,'Landsberg am Lech','','Landsberg am Lech',NULL,9181,109181000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(232,'232','BY','MXX','Kreis und Stadt München','MS','M',2,'München','und Stadt','München','Unterscheidung Stadt/Land nicht erforderlich',9184,109184000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(233,'233','BY','MBX','Kreis Miesbach','MS','MB',2,'Miesbach','','Miesbach',NULL,9182,109182000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(234,'234','BY','MIL','Kreis Miltenberg','MS','MIL',2,'Miltenberg','','Miltenberg',NULL,9676,109676000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(235,'235','BY','MMX','Stadt Memmingen','MS','MM',1,'Memmingen','','Memmingen',NULL,9764,109764000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(236,'236','BY','MNX','Kreis Unterallgäu','MS','MN',2,'Unterallgäu','','Unterallgäu',NULL,9778,109778000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(237,'237','BY','MSP','Kreis Main-Spessart','MS','MSP',2,'Main-Spessart','','Main-Spessart',NULL,9677,109677000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(238,'238','BY','MUE','Kreis Mühldorf a. Inn','MS','MÜ',2,'Mühldorf a. Inn','','Mühldorf a. Inn','MÜ technisch unsicher',9183,109183000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(239,'239','BY','NXX','Stadt Nürnberg','MS','N',1,'Nürnberg','','Nürnberg',NULL,9564,109564000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(240,'240','BY','NDX','Kreis Neuburg-Schrobenhausen','MS','ND',2,'Neuburg-Schrobenhausen','','Neuburg-Schrobenhausen',NULL,9185,109185000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(241,'241','BY','NEA','Kreis Neustadt a. d. Aisch - Bad Windsheim','MS','NEA',2,'Neustadt a. d. Aisch - Bad Windsheim','','Neustadt a. d. Aisch - Bad Windsheim',NULL,9575,109575000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(242,'242','BY','NES','Kreis Rhön-Grabfeld','MS','NES',2,'Rhön-Grabfeld','','Rhön-Grabfeld',NULL,9673,109673000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(243,'243','BY','NEW','Kreis Neustadt a.d. Waldnaab','MS','NEW',2,'Neustadt a.d. Waldnaab','','Neustadt a.d. Waldnaab',NULL,9374,109374000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(244,'244','BY','NMX','Kreis Neumarkt i.d.OPf.','MS','NM',2,'Neumarkt i.d.OPf.','','Neumarkt i.d.OPf.',NULL,9373,109373000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(245,'245','BY','NUX','Kreis Neu-Ulm','MS','NU',2,'Neu-Ulm','','Neu-Ulm',NULL,9775,109775000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(246,'246','BY','OAX','Kreis Oberallgäu','MS','OA',2,'Oberallgäu','','Oberallgäu',NULL,9780,109780000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(247,'247','BY','OAL','Kreis Ostallgäu','MS','OAL',2,'Ostallgäu','','Ostallgäu',NULL,9777,109777000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(248,'248','BY','PAX','Kreis und Stadt Passau','MS','PA',2,'Passau','und Stadt','Passau','Unterscheidung Stadt/Land nicht erforderlich',9275,109275000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(249,'249','BY','PAF','Kreis Pfaffenhofen a.d.Ilm','MS','PAF',2,'Pfaffenhofen a.d.Ilm','','Pfaffenhofen a.d.Ilm',NULL,9186,109186000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(250,'250','BY','PAN','Kreis Rottal-Inn','MS','PAN',2,'Rottal-Inn','','Rottal-Inn',NULL,9277,109277000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(251,'251','BY','RXX','Kreis und Stadt Regensburg','MS','R',2,'Regensburg','und Stadt','Regensburg','Unterscheidung Stadt/Land nicht erforderlich',9375,109375000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(252,'252','BY','REG','Kreis Regen','MS','REG',2,'Regen','','Regen',NULL,9276,109276000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(253,'253','BY','RHX','Kreis Roth','MS','RH',2,'Roth','','Roth',NULL,9576,109576000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(254,'254','BY','ROX','Kreis und Stadt Rosenheim','MS','RO',2,'Rosenheim','und Stadt','Rosenheim','Unterscheidung Stadt/Land nicht erforderlich',9187,109187000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(255,'255','BY','SAD','Kreis Schwandorf','MS','SAD',2,'Schwandorf','','Schwandorf',NULL,9376,109376000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(256,'256','BY','SCX','Stadt Schwabach','MS','SC',1,'Schwabach','','Schwabach',NULL,9565,109565000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(257,'257','BY','SRX','Kreis Straubing-Bogen und Stadt Straubing','MS','SR',2,'Straubing-Bogen','und Stadt Straubing','Straubing-Bogen und Stadt Straubing','Unterscheidung Stadt/Land nicht erforderlich',9278,109278000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(258,'258','BY','STA','Kreis Starnberg','MS','STA',2,'Starnberg','','Starnberg',NULL,9188,109188000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(259,'259','BY','SWX','Kreis und Stadt Schweinfurt','MS','SW',2,'Schweinfurt','und Stadt','Schweinfurt','Unterscheidung Stadt/Land nicht erforderlich',9678,109678000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(260,'260','BY','TIR','Kreis Tirschenreuth','MS','TIR',2,'Tirschenreuth','','Tirschenreuth',NULL,9377,109377000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(261,'261','BY','TOL','Kreis Bad Tölz-Wolfratshausen','MS','TÖL',2,'Bad Tölz-Wolfratshausen','','Bad Tölz-Wolfratshausen','TÖL technisch unsicher',9173,109173000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(262,'262','BY','TSX','Kreis Traunstein','MS','TS',2,'Traunstein','','Traunstein',NULL,9189,109189000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(263,'263','BY','WEN','Stadt Weiden in der Oberpfalz','MS','WEN',1,'Weiden in der Oberpfalz','','Weiden in der Oberpfalz',NULL,9363,109363000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(264,'264','BY','WMX','Kreis Weilheim-Schongau','MS','WM',2,'Weilheim-Schongau','','Weilheim-Schongau',NULL,9190,109190000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(265,'265','BY','WUE','Kreis und Stadt Würzburg','MS','WÜ',2,'Würzburg','und Stadt','Würzburg','WÜ technisch unsicher, Unterscheidung Stadt/Land nicht erforderlich',9679,109679000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(266,'266','BY','WUG','Kreis Weißenburg-Gunzenhausen','MS','WUG',2,'Weißenburg-Gunzenhausen','','Weißenburg-Gunzenhausen',NULL,9577,109577000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(267,'267','BY','WUN','Kreis Wunsiedel','MS','WUN',2,'Wunsiedel','','Wunsiedel',NULL,9479,109479000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(268,'268','HE','DAX','Kreis Darmstadt-Dieburg und Stadt Darmstadt','OF','DA',2,'Darmstadt-Dieburg','und Stadt Darmstadt','Darmstadt-Dieburg und Stadt Darmstadt','Unterscheidung Stadt/Land nicht erforderlich',6432,106432000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(269,'269','HE','ERB','Odenwaldkreis','OF','ERB',2,'Odenwaldkreis','','Odenwaldkreis',NULL,6437,106437000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(270,'270','HE','ESW','Werra-Meissner-Kreis','OF','ESW',2,'Werra-Meissner-Kreis','','Werra-Meissner-Kreis',NULL,6636,106636000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(271,'271','HE','FBX','Wetteraukreis','OF','FB',2,'Wetteraukreis','','Wetteraukreis',NULL,6440,106440000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(272,'272','HE','FDX','Kreis Fulda','OF','FD',2,'Fulda','','Fulda',NULL,6631,106631000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(273,'273','HE','FXX','Stadt Frankfurt am Main','OF','F',1,'Frankfurt am Main','','Frankfurt am Main',NULL,6412,106412000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(274,'274','HE','GGX','Kreis Groß-Gerau','OF','GG',2,'Groß-Gerau','','Groß-Gerau',NULL,6433,106433000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(275,'275','HE','GIX','Kreis Gießen','OF','GI',2,'Gießen','','Gießen',NULL,6531,106531000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(276,'276','HE','HEF','Kreis Hersfeld-Rotenburg','OF','HEF',2,'Hersfeld-Rotenburg','','Hersfeld-Rotenburg',NULL,6632,106632000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(277,'277','HE','HGX','Hochtaunuskreis','OF','HG',2,'Hochtaunuskreis','','Hochtaunuskreis',NULL,6434,106434000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(278,'278','HE','HPX','Kreis Bergstraße','OF','HP',2,'Bergstraße','','Bergstraße',NULL,6431,106431000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(279,'279','HE','HRX','Schwalm-Eder-Kreis','OF','HR',2,'Schwalm-Eder-Kreis','','Schwalm-Eder-Kreis',NULL,6634,106634000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(280,'280','HE','HUX','Main-Kinzig-Kreis und Stadt Hanau','OF','MKK',1,'Hanau','und','Hanau','Kennung MKK nicht nachgeführt, Unterscheidung Stadt/Land nicht erforderlich',6435,106435000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(281,'281','HE','KBX','Kreis Waldeck-Frankenberg','OF','KB',2,'Waldeck-Frankenberg','','Waldeck-Frankenberg',NULL,6635,106635000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(282,'282','HE','KSX','Kreis und Stadt Kassel','OF','KS',2,'Kassel','und Stadt','Kassel','Unterscheidung Stadt/Land nicht erforderlich',6633,106633000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(283,'283','HE','LDK','Lahn-Dill-Kreis','OF','LDK',2,'Lahn-Dill-Kreis','','Lahn-Dill-Kreis',NULL,6532,106532000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(284,'284','HE','LMX','Kreis Limburg-Weilburg','OF','LM',2,'Limburg-Weilburg','','Limburg-Weilburg',NULL,6533,106533000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(285,'285','HE','MRX','Kreis Marburg-Biedenkopf','OF','MR',2,'Marburg-Biedenkopf','','Marburg-Biedenkopf',NULL,6534,106534000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(286,'286','HE','MTK','Main-Taunus-Kreis','OF','MTK',2,'Main-Taunus-Kreis','','Main-Taunus-Kreis',NULL,6436,106436000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(287,'287','HE','OFX','Kreis und Stadt Offenbach','OF','OF',2,'Offenbach','und Stadt','Offenbach','Unterscheidung Stadt/Land nicht erforderlich',6438,106438000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(288,'288','HE','RUD','Rheingau-Taunus-Kreis','OF','RÜD',2,'Rheingau-Taunus-Kreis','','Rheingau-Taunus-Kreis','RÜD technisch unsicher',6439,106439000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(289,'289','HE','VBX','Vogelsbergkreis','OF','VB',2,'Vogelsbergkreis','','Vogelsbergkreis',NULL,6535,106535000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(290,'290','HE','WIX','Stadt Wiesbaden','OF','WI',1,'Wiesbaden','','Wiesbaden',NULL,6414,106414000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(291,'291','RP','AKX','Kreis Altenkirchen','OF','AK',2,'Altenkirchen','','Altenkirchen',NULL,7132,107132000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(292,'292','RP','AWX','Kreis Ahrweiler','OF','AW',2,'Ahrweiler','','Ahrweiler',NULL,7131,107131000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(293,'293','RP','AZX','Kreis Alzey-Worms','OF','AZ',2,'Alzey-Worms','','Alzey-Worms',NULL,7331,107331000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(294,'294','RP','BIR','Kreis Birkenfeld','OF','BIR',2,'Birkenfeld','','Birkenfeld',NULL,7134,107134000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(295,'295','RP','BIT','Eifelkreis Bitburg-Prüm','OF','BIT',2,'Eifelkreis Bitburg-Prüm','','Eifelkreis Bitburg-Prüm',NULL,7232,107232000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(296,'296','RP','COC','Kreis Cochem-Zell','OF','COC',2,'Cochem-Zell','','Cochem-Zell',NULL,7135,107135000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(297,'297','RP','DAU','Kreis Vulkaneifel','OF','DAU',2,'Vulkaneifel','','Vulkaneifel',NULL,7233,107233000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(298,'298','RP','DUW','Kreis Bad Dürkheim','OF','DÜW',2,'Bad Dürkheim','','Bad Dürkheim','DÜW technisch unsicher',7332,107332000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(299,'299','RP','EMS','Rhein-Lahn-Kreis','OF','EMS',2,'Rhein-Lahn-Kreis','','Rhein-Lahn-Kreis',NULL,7141,107141000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(300,'300','RP','FTX','Stadt Frankenthal','OF','FT',1,'Frankenthal','','Frankenthal',NULL,7311,107311000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(301,'301','RP','GER','Kreis Germersheim','OF','GER',2,'Germersheim','','Germersheim',NULL,7334,107334000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(302,'302','RP','KHX','Kreis Bad Kreuznach','OF','KH',2,'Bad Kreuznach','','Bad Kreuznach',NULL,7133,107133000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(303,'303','RP','KIB','Donnersbergkreis','OF','KIB',2,'Donnersbergkreis','','Donnersbergkreis',NULL,7333,107333000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(304,'304','RP','KLX','Kreis und Stadt Kaiserslautern','OF','KL',2,'Kaiserslautern','und Stadt','Kaiserslautern','Unterscheidung Stadt/Land nicht erforderlich',7335,107335000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(305,'305','RP','KOX','Stadt Koblenz','OF','KO',1,'Koblenz','','Koblenz',NULL,7111,107111000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(306,'306','RP','KUS','Kreis Kusel','OF','KUS',2,'Kusel','','Kusel',NULL,7336,107336000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(307,'307','RP','LDX','Stadt Landau in der Pfalz','OF','LD',1,'Landau in der Pfalz','','Landau in der Pfalz',NULL,7313,107313000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(308,'308','RP','LUX','Rhein-Pfalz-Kreis und Stadt Ludwigshafen','OF','RP',1,'Ludwigshafen','und','Ludwigshafen','Kennung RP nicht nachgeführt, Unterscheidung Stadt/Land nicht erforderlich',7338,107338000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(309,'309','RP','MYK','Kreis Mayen-Koblenz','OF','MYK',2,'Mayen-Koblenz','','Mayen-Koblenz',NULL,7137,107137000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(310,'310','RP','MZX','Kreis Mainz-Bingen und Stadt Mainz','OF','MZ',2,'Mainz-Bingen','und Stadt Mainz','Mainz-Bingen und Stadt Mainz','Unterscheidung Stadt/Land nicht erforderlich',7339,107339000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(311,'311','RP','NRX','Kreis Neuwied','OF','NR',2,'Neuwied','','Neuwied',NULL,7138,107138000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(312,'312','RP','NWX','Stadt Neustadt an der Weinstraße','OF','NW',1,'Neustadt an der Weinstraße','','Neustadt an der Weinstraße',NULL,7316,107316000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(313,'313','RP','PSX','Kreis Südwestpfalz und Stadt Pirmasens','OF','PS',2,'Südwestpfalz','und Stadt Pirmasens','Südwestpfalz und Stadt Pirmasens','Unterscheidung Stadt/Land nicht erforderlich',7340,107340000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(314,'314','RP','SIM','Rhein-Hunsrück-Kreis','OF','SIM',2,'Rhein-Hunsrück-Kreis','','Rhein-Hunsrück-Kreis',NULL,7140,107140000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(315,'315','RP','SPX','Stadt Speyer','OF','SP',1,'Speyer','','Speyer',NULL,7318,107318000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(316,'316','RP','SUW','Kreis Südliche Weinstraße','OF','SÜW',2,'Südliche Weinstraße','','Südliche Weinstraße','SÜW technisch unsicher',7337,107337000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(317,'317','RP','TRX','Kreis Trier-Saarburg und Stadt Trier','OF','TR',2,'Trier-Saarburg','und Stadt Trier','Trier-Saarburg und Stadt Trier','Unterscheidung Stadt/Land nicht erforderlich',7235,107235000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(318,'318','RP','WIL','Kreis Bernkastel-Wittlich','OF','WIL',2,'Bernkastel-Wittlich','','Bernkastel-Wittlich',NULL,7231,107231000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(319,'319','RP','WOX','Stadt Worms','OF','WO',1,'Worms','','Worms',NULL,7319,107319000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(320,'320','RP','WWX','Westerwaldkreis','OF','WW',2,'Westerwaldkreis','','Westerwaldkreis',NULL,7143,107143000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(321,'321','RP','ZWX','Stadt Zweibrücken','OF','ZW',1,'Zweibrücken','','Zweibrücken',NULL,7320,107320000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(322,'322','SL','HOM','Saarpfalz-Kreis','OF','HOM',2,'Saarpfalz-Kreis','','Saarpfalz-Kreis',NULL,10045,110045000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(323,'323','SL','MZG','Kreis Merzig-Wadern','OF','MZG',2,'Merzig-Wadern','','Merzig-Wadern',NULL,10042,110042000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(324,'324','SL','NKX','Kreis Neunkirchen','OF','NK',2,'Neunkirchen','','Neunkirchen',NULL,10043,110043000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(325,'325','SL','SBX','Regionalverband Saarbrücken','OF','SB',2,'Regionalverband Saarbrücken','','Regionalverband Saarbrücken',NULL,10041,110041000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(326,'326','SL','SLS','Kreis Saarlouis','OF','SLS',2,'Saarlouis','','Saarlouis',NULL,10044,110044000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(327,'327','SL','WND','Kreis St. Wendel','OF','WND',2,'St. Wendel','','St. Wendel',NULL,10046,110046000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(328,'328','BB','BAR','Kreis Barnim','PD','BAR',2,'Barnim','','Barnim',NULL,12060,112060000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(329,'329','BB','BRB','Stadt Brandenburg','PD','BRB',1,'Brandenburg','','Brandenburg',NULL,12051,112051000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(330,'330','BB','CBX','Stadt Cottbus','PD','CB',1,'Cottbus','','Cottbus',NULL,12052,112052000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(331,'331','BB','EEX','Kreis Elbe-Elster','PD','EE',2,'Elbe-Elster','','Elbe-Elster',NULL,12062,112062000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(332,'332','BB','FFX','Stadt Frankfurt (Oder)','PD','FF',1,'Frankfurt (Oder)','','Frankfurt (Oder)',NULL,12053,112053000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(333,'333','BB','HVL','Kreis Havelland','PD','HVL',2,'Havelland','','Havelland',NULL,12063,112063000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(334,'334','BB','LDS','Kreis Dahme-Spreewald','PD','LDS',2,'Dahme-Spreewald','','Dahme-Spreewald',NULL,12061,112061000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(335,'335','BB','LOS','Kreis Oder-Spree','PD','LOS',2,'Oder-Spree','','Oder-Spree',NULL,12067,112067000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(336,'336','BB','MOL','Kreis Märkisch-Oderland','PD','MOL',2,'Märkisch-Oderland','','Märkisch-Oderland',NULL,12064,112064000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(337,'337','BB','OHV','Kreis Oberhavel','PD','OHV',2,'Oberhavel','','Oberhavel',NULL,12065,112065000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(338,'338','BB','OPR','Kreis Ostprignitz-Ruppin','PD','OPR',2,'Ostprignitz-Ruppin','','Ostprignitz-Ruppin',NULL,12068,112068000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(339,'339','BB','OSL','Kreis Oberspreewald-Lausitz','PD','OSL',2,'Oberspreewald-Lausitz','','Oberspreewald-Lausitz',NULL,12066,112066000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(340,'340','BB','PMX','Kreis Potsdam-Mittelmark','PD','PM',2,'Potsdam-Mittelmark','','Potsdam-Mittelmark',NULL,12069,112069000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(341,'341','BB','PRX','Kreis Prignitz','PD','PR',2,'Prignitz','','Prignitz',NULL,12070,112070000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(342,'342','BB','PXX','Stadt Potsdam','PD','P',1,'Potsdam','','Potsdam',NULL,12054,112054000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(343,'343','BB','SPN','Kreis Spree-Neiße','PD','SPN',2,'Spree-Neiße','','Spree-Neiße',NULL,12071,112071000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(344,'344','BB','TFX','Kreis Teltow-Fläming','PD','TF',2,'Teltow-Fläming','','Teltow-Fläming',NULL,12072,112072000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(345,'345','BB','UMX','Kreis Uckermark','PD','UM',2,'Uckermark','','Uckermark',NULL,12073,112073000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(346,'346','BL','BXX','Land Berlin','PD','B',1,'Land Berlin','','Land Berlin',NULL,11000,111000000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(347,'347','MV','GDN','Kreis Rostock - Binnenland Nord','PD','LRO',2,'Rostock','- Binnenland Nord','Rostock - Binnenland Nord','ab Februar 2012, enthält Altkreis Bad Doberan - Binnenland',13021,913072001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(348,'348','MV','GDK','Kreis Rostock - Küste','PD','LRO',2,'Rostock','- Küste','Rostock - Küste','ab Februar 2012, enthält Altkreis Bad Doberan - Küste',13022,913072002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(349,'349','MV','GDS','Kreis Rostock - Binnenland Süd','PD','LRO',2,'Rostock','- Binnenland Süd','Rostock - Binnenland Süd','ab Februar 2012, enthält Altkreis Güstrow',13023,913072003);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(350,'350','MV','HRO','Hansestadt Rostock','PD','HRO',2,'Hansestadt Rostock','','Hansestadt Rostock',NULL,13003,113003000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(351,'351','MV','LPO','Kreis Ludwigslust-Parchim - Ost','PD','XX1',2,'Ludwigslust-Parchim','- Ost','Ludwigslust-Parchim - Ost','ab Februar 2012, enthält Altkreis Parchim',13062,913076002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(352,'352','MV','LPW','Kreis Ludwigslust-Parchim - West','PD','XX2',2,'Ludwigslust-Parchim','- West','Ludwigslust-Parchim - West','ab Februar 2012, enthält Altkreis Ludwigslust',13061,913076001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(353,'353','MV','OWB','Kreis Nordwestmecklenburg - Binnenland','PD','XX6',2,'Nordwestmecklenburg','- Binnenland','Nordwestmecklenburg - Binnenland','ab Februar 2012, enthält Altkreis Nordwestmecklenburg - Binnenland ',13041,913074001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(354,'354','MV','OWK','Kreis Nordwestmecklenburg - Küste','PD','XX7',2,'Nordwestmecklenburg','- Küste','Nordwestmecklenburg - Küste','ab Februar 2012, enthält Altkreis Nordwestmecklenburg - Küste und Stadt Wismar',13042,913074002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(355,'355','MV','SNX','Stadt Schwerin','PD','SN',1,'Schwerin','','Schwerin',NULL,13004,113004000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(356,'356','MV','VGN','Kreis Vorpommern-Greifswald - Binnenland Nord','PD','VG',2,'Vorpommern-Greifswald','- Binnenland Nord','Vorpommern-Greifswald - Binnenland Nord','ab Februar 2012, enthält Altkreis Ostvorpommern - Binnenland und nordöstlichen Teil des Altkreises Demmin',13051,913075001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(357,'357','MV','VGS','Kreis Vorpommern-Greifswald - Binnenland Süd','PD','VG',2,'Vorpommern-Greifswald','- Binnenland Süd','Vorpommern-Greifswald - Binnenland Süd','ab Februar 2012, enthält Altkreis Uecker-Randow - Binnenland',13053,913075003);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(358,'358','MV','VGK','Kreis Vorpommern-Greifswald - Küste Nord','PD','VG',2,'Vorpommern-Greifswald','- Küste Nord','Vorpommern-Greifswald - Küste Nord','ab Februar 2012, enthält Altkreis Ostvorpommern - Küste und Stadt Greifswald',13052,913075002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(359,'359','MV','VGO','Kreis Vorpommern-Greifswald - Küste Süd','PD','VG',2,'Vorpommern-Greifswald','- Küste Süd','Vorpommern-Greifswald - Küste Süd','ab Februar 2012, enthält Altkreis Uecker-Randow - Küste',13054,913075004);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(360,'360','MV','VON','Kreis Mecklenburgische Seenplatte - Nord','PD','XX3',2,'Mecklenburgische Seenplatte','- Nord','Mecklenburgische Seenplatte - Nord','ab Februar 2012, enthält Altkreis Demmin (ohne nordöstlichen Teil)',13011,913071001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(361,'361','MV','VOS','Kreis Mecklenburgische Seenplatte - Südost','PD','XX4',2,'Mecklenburgische Seenplatte','- Südost','Mecklenburgische Seenplatte - Südost','ab Februar 2012, enthält Altkreis Mecklenburg-Strelitz und Stadt Neubrandenburg',13013,913071003);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(362,'362','MV','VOW','Kreis Mecklenburgische Seenplatte - West','PD','XX5',2,'Mecklenburgische Seenplatte','- West','Mecklenburgische Seenplatte - West','ab Februar 2012, enthält Altkreis Müritz',13012,913071002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(363,'363','MV','VRB','Kreis Vorpommern-Rügen - Binnenland','PD','VR',2,'Vorpommern-Rügen','- Binnenland','Vorpommern-Rügen - Binnenland','ab Februar 2012, enthält Altkreis Nordvorpommern - Binnenland',13031,913073001);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(364,'364','MV','VRR','Kreis Vorpommern-Rügen - Insel Rügen','PD','VR',2,'Vorpommern-Rügen','- Insel Rügen','Vorpommern-Rügen - Insel Rügen','ab Februar 2012, enthält Altkreis Rügen',13033,913073003);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(365,'365','MV','VRK','Kreis Vorpommern-Rügen - Küste','PD','VR',2,'Vorpommern-Rügen','- Küste','Vorpommern-Rügen - Küste','ab Februar 2012, enthält Altkreis Nordvorpommern - Küste und Stadt Stralsund',13032,913073002);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(366,'366','BW','AAX','Ostalbkreis','SU','AA',2,'Ostalbkreis','','Ostalbkreis',NULL,8136,108136000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(367,'367','BW','BAD','Stadt Baden-Baden','SU','BAD',1,'Baden-Baden','','Baden-Baden',NULL,8211,108211000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(368,'368','BW','BBX','Kreis Böblingen','SU','BB',2,'Böblingen','','Böblingen',NULL,8115,108115000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(369,'369','BW','BCX','Kreis Biberach','SU','BC',2,'Biberach','','Biberach',NULL,8426,108426000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(370,'370','BW','BLX','Zollernalbkreis','SU','BL',2,'Zollernalbkreis','','Zollernalbkreis',NULL,8417,108417000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(371,'371','BW','CWX','Kreis Calw','SU','CW',2,'Calw','','Calw',NULL,8235,108235000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(372,'372','BW','EMX','Kreis Emmendingen','SU','EM',2,'Emmendingen','','Emmendingen',NULL,8316,108316000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(373,'373','BW','ESX','Kreis Esslingen','SU','ES',2,'Esslingen','','Esslingen',NULL,8116,108116000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(374,'374','BW','FDS','Kreis Freudenstadt','SU','FDS',2,'Freudenstadt','','Freudenstadt',NULL,8237,108237000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(375,'375','BW','FNX','Bodenseekreis','SU','FN',2,'Bodenseekreis','','Bodenseekreis',NULL,8435,108435000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(376,'376','BW','FRX','Kreis Breisgau-Hochschwarzwald und Stadt Freiburg','SU','FR',2,'Breisgau-Hochschwarzwald','und Stadt Freiburg','Breisgau-Hochschwarzwald und Stadt Freiburg','Unterscheidung nicht erforderlich',8315,108315000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(377,'377','BW','GPX','Kreis Göppingen','SU','GP',2,'Göppingen','','Göppingen',NULL,8117,108117000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(378,'378','BW','HDX','Rhein-Neckar-Kreis und Stadt Heidelberg','SU','HD',2,'Rhein-Neckar-Kreis','und Stadt Heidelberg','Rhein-Neckar-Kreis und Stadt Heidelberg','Unterscheidung nicht erforderlich',8226,108226000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(379,'379','BW','HDH','Kreis Heidenheim','SU','HDH',2,'Heidenheim','','Heidenheim',NULL,8135,108135000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(380,'380','BW','HNX','Kreis und Stadt Heilbronn','SU','HN',2,'Heilbronn','und Stadt','Heilbronn','Unterscheidung nicht erforderlich',8125,108125000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(381,'381','BW','KAX','Kreis und Stadt Karlsruhe','SU','KA',2,'Karlsruhe','und Stadt','Karlsruhe','Unterscheidung nicht erforderlich',8215,108215000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(382,'382','BW','KNX','Kreis Konstanz','SU','KN',2,'Konstanz','','Konstanz',NULL,8335,108335000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(383,'383','BW','KUN','Hohenlohekreis','SU','KÜN',2,'Hohenlohekreis','','Hohenlohekreis','KÜN technisch unsicher',8126,108126000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(384,'384','BW','LBX','Kreis Ludwigsburg','SU','LB',2,'Ludwigsburg','','Ludwigsburg',NULL,8118,108118000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(385,'385','BW','LOE','Kreis Lörrach','SU','LÖ',2,'Lörrach','','Lörrach','LÖ technisch unsicher',8336,108336000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(386,'386','BW','MAX','Stadt Mannheim','SU','MA',1,'Mannheim','','Mannheim',NULL,8222,108222000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(387,'387','BW','MOS','Neckar-Odenwald-Kreis','SU','MOS',2,'Neckar-Odenwald-Kreis','','Neckar-Odenwald-Kreis',NULL,8225,108225000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(388,'388','BW','OGX','Ortenaukreis','SU','OG',2,'Ortenaukreis','','Ortenaukreis',NULL,8317,108317000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(389,'389','BW','PFX','Enzkreis und Stadt Pforzheim','SU','PF',2,'Enzkreis','und Stadt Pforzheim','Enzkreis und Stadt Pforzheim','Unterscheidung nicht erforderlich',8236,108236000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(390,'390','BW','RAX','Kreis Rastatt','SU','RA',2,'Rastatt','','Rastatt',NULL,8216,108216000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(391,'391','BW','RTX','Kreis Reutlingen','SU','RT',2,'Reutlingen','','Reutlingen',NULL,8415,108415000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(392,'392','BW','RVX','Kreis Ravensburg','SU','RV',2,'Ravensburg','','Ravensburg',NULL,8436,108436000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(393,'393','BW','RWX','Kreis Rottweil','SU','RW',2,'Rottweil','','Rottweil',NULL,8325,108325000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(394,'394','BW','SXX','Stadt Stuttgart','SU','S',1,'Stuttgart','','Stuttgart',NULL,8111,108111000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(395,'395','BW','SHA','Kreis Schwäbisch Hall','SU','SHA',2,'Schwäbisch Hall','','Schwäbisch Hall',NULL,8127,108127000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(396,'396','BW','SIG','Kreis Sigmaringen','SU','SIG',2,'Sigmaringen','','Sigmaringen',NULL,8437,108437000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(397,'397','BW','TBB','Main-Tauber-Kreis','SU','TBB',2,'Main-Tauber-Kreis','','Main-Tauber-Kreis',NULL,8128,108128000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(398,'398','BW','TUE','Kreis Tübingen','SU','TÜ',2,'Tübingen','','Tübingen','TÜ technisch unsicher',8416,108416000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(399,'399','BW','TUT','Kreis Tuttlingen','SU','TUT',2,'Tuttlingen','','Tuttlingen',NULL,8327,108327000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(400,'400','BW','ULX','Alb-Donau-Kreis und Stadt Ulm','SU','UL',2,'Alb-Donau-Kreis','und Stadt Ulm','Alb-Donau-Kreis und Stadt Ulm','Unterscheidung nicht erforderlich',8425,108425000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(401,'401','BW','VSX','Schwarzwald-Baar-Kreis','SU','VS',2,'Schwarzwald-Baar-Kreis','','Schwarzwald-Baar-Kreis',NULL,8326,108326000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(402,'402','BW','WNX','Rems-Murr-Kreis','SU','WN',2,'Rems-Murr-Kreis','','Rems-Murr-Kreis',NULL,8119,108119000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(403,'403','BW','WTX','Kreis Waldshut','SU','WT',2,'Waldshut','','Waldshut',NULL,8337,108337000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(404,'R','BB','DWPD','Brandenburg/Berlin','PD','',3,'Brandenburg/Berlin','','Brandenburg/Berlin','alle Kreise in Berlin und Brandenburg',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(405,'R','BL','DWPD','Brandenburg/Berlin','PD','',3,'Brandenburg/Berlin','','Brandenburg/Berlin','alle Kreise in Berlin und Brandenburg',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(406,'R','BW','DWSU','Baden-Würtemberg','SU','',3,'Baden-Würtemberg','','Baden-Würtemberg','alle Kreise in Baden-Württemberg',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(407,'R','BW','RFR','Regierungsbezirk Freiburg','SU','',3,'Regierungsbezirk Freiburg','','Regierungsbezirk Freiburg','EMX, FRX, KNX, LOE, OGX, RWX, TUT, VSX, WTX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(408,'R','BW','RKA','Regierungsbezirk Karlsruhe','SU','',3,'Regierungsbezirk Karlsruhe','','Regierungsbezirk Karlsruhe','BAD, CWX, FDS, HDX, KAX, MAX, MOS, PFX, RAX ',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(409,'R','BW','RSU','Regierungsbezirk Stuttgart','SU','',3,'Regierungsbezirk Stuttgart','','Regierungsbezirk Stuttgart','AAX, BBX, ESX, GPX, HDH, HNX, KUN, LBX, SHA, SXX, TBB, WNX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(410,'R','BW','RTU','Regierungsbezirk Tübingen','SU','',3,'Regierungsbezirk Tübingen','','Regierungsbezirk Tübingen','BCX, BLX, FNX, RTX, RVX, SIG, TUE, ULX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(411,'R','BY','DWMS','Bayern','MS','',3,'Bayern','','Bayern','Nordbayern und Südbayern',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(412,'R','BY','MFM','Mittelfranken','MS','',3,'Mittelfranken','','Mittelfranken','ANX, ERH, ERX, FUE, LAU, NEA, NXX, RHX, SCX, WUG',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(413,'R','BY','NIM','Niederbayern','MS','',3,'Niederbayern','','Niederbayern','DEG, DGF, FRG, KEH, LAX, PAN, PAX, REG, SRX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(414,'R','BY','OBM','Oberbayern','MS','',3,'Oberbayern','','Oberbayern','AOX, BGL, DAH, EBE, EDX, EIX,FFB, FSX, GAP, INX, LLX, MBX, MUE, MXX, NDX, PAF, ROX, STA, TOL, TSX, WMX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(415,'R','BY','OFM','Oberfranken','MS','',3,'Oberfranken','','Oberfranken','BAX, BTX, COX, FOX, KCX, KUX, LIF, WUN',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(416,'R','BY','OPM','Oberpfalz','MS','',3,'Oberpfalz','','Oberpfalz','AMX, ASX, CHA, NEW, NMX, RXX, SAD, TIR, WEN',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(417,'R','BY','SWM','Schwaben','MS','',3,'Schwaben','','Schwaben','AXX, AIC,DLG, DON, GZX, KEX, KFX, LIX, MNX, NUX, OAL, OAX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(418,'R','BY','UFM','Unterfranken','MS','',3,'Unterfranken','','Unterfranken','ABX, HAS, KGX, KTX, MIL, MSP, NES, SWX, WUE',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(419,'R','HB','DWHB','Niedersachsen/Bremen','HA','',3,'Niedersachsen/Bremen','','Niedersachsen/Bremen','alle Kreise in Niedersachsen und Bremen',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(420,'R','HB','HHB','Hansestadt Bremen','HA','',3,'Hansestadt Bremen','','Hansestadt Bremen','HBX, BHV',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(421,'R','HE','DWOF','Hessen','OF','',3,'Hessen','','Hessen','alle Landkreise in Hessen',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(422,'R','HE','HUX','Main-Kinzig-Kreis und Stadt Hanau','OF','MKK',2,'Main-Kinzig-Kreis','','Main-Kinzig-Kreis','Unterscheidung Stadt/Land nicht erforderlich',6435,106435000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(423,'R','HE','KZT','Kinzig-Region','OF','',3,'Kinzig-Region','','Kinzig-Region','HUX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(424,'R','HE','MHE','Mittelhessen','OF','',3,'Mittelhessen','','Mittelhessen','FBX, GIX, VBX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(425,'R','HE','NHE','Nordhessen','OF','',3,'Nordhessen','','Nordhessen','HRX, KBX, KSX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(426,'R','HE','OHE','Rhön','OF','',3,'Rhön','','Rhön','FDX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(427,'R','HE','ONH','Nordosthessen','OF','',3,'Nordosthessen','','Nordosthessen','ESW, HEF',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(428,'R','HE','RMX','Rhein-Main-Gebiet','OF','',3,'Rhein-Main-Gebiet','','Rhein-Main-Gebiet','DAX, FXX, GGX, OFX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(429,'R','HE','SHX','Odenwald/Bergstraße','OF','',3,'Odenwald/Bergstraße','','Odenwald/Bergstraße','ERB, HPX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(430,'R','HE','TUX','Taunus','OF','',3,'Taunus','','Taunus','HGX, MTK, RUD, WIX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(431,'R','HE','WWB','Westerwald/Biedenkopf','OF','',3,'Westerwald/Biedenkopf','','Westerwald/Biedenkopf','LDK, LMX, MRX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(432,'R','HH','DWHA','Norddeutschland','HA','',3,'Norddeutschland','','Norddeutschland','Hamburg, Bremen, Niedersachsen und Schleswig-Holstein (als SMS derzeit nicht vorgesehen)',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(433,'R','HH','DWHC','Schleswig-Holstein/Hamburg','HA','',3,'Schleswig-Holstein/Hamburg','','Schleswig-Holstein/Hamburg','alle Kreise in Schleswig-Holstein und Hamburg',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(434,'R','HH','DWHH','Hamburg','HA','',3,'Hamburg','','Hamburg','HHX',2000,102000000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(435,'R','HH','HHH','Hamburg','HA','',3,'Hamburg','','Hamburg','HHX',2000,102000000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(436,'R','MV','DWRW','Mecklenburg-Vorpommern','PD','',3,'Mecklenburg-Vorpommern','','Mecklenburg-Vorpommern','alle Kreise in Mecklenburg-Vorpommern',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(437,'R','MV','GDX','Kreis Rostock','PD','LRO',2,'Rostock','','Rostock','ab Februar 2012, GDN, GDK, GDS',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(438,'R','MV','LPX','Kreis Parchim-Ludwigslust','PD','XXA',2,'Parchim-Ludwigslust','','Parchim-Ludwigslust','ab Februar 2012, LPW, LPO',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(439,'R','MV','OWX','Kreis Nordwestmecklenburg','PD','XXC',2,'Nordwestmecklenburg','','Nordwestmecklenburg','ab Februar 2012, OWB, OWK',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(440,'R','MV','VGX','Kreis Vorpommern-Greifswald','PD','VG',2,'Vorpommern-Greifswald','','Vorpommern-Greifswald','ab Februar 2012, VGN, VGK, VGS, VGO',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(441,'R','MV','VOX','Kreis Mecklenburgische Seenplatte','PD','XXB',2,'Mecklenburgische Seenplatte','','Mecklenburgische Seenplatte','ab Februar 2012, VON, VOS, VOW',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(442,'R','MV','VRX','Kreis Vorpommern-Rügen','PD','VR',2,'Vorpommern-Rügen','','Vorpommern-Rügen','ab Februar 2012, VRB, VRK, VRR',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(443,'R','NRW','BAB','Regierungsbezirk Arnsberg','EM','',3,'Regierungsbezirk Arnsberg','','Regierungsbezirk Arnsberg','BOX, DOX, ENX, HAX, HAM, HER, HSK, MKX, OEX, SIX, SOX, UNX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(444,'R','NRW','BDE','Regierungsbezirk Detmold','EM','',3,'Regierungsbezirk Detmold','','Regierungsbezirk Detmold','BIX, GTX, HFX, HXX, LIP, MIX, PBX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(445,'R','NRW','BDU','Regierungsbezirk Düsseldorf','EM','',3,'Regierungsbezirk Düsseldorf','','Regierungsbezirk Düsseldorf','DUX, DXX, EXX, KLE, KRX, MEX,MGX, MHX, NEX, OBX, RSX, SGX, VIE, WES, WXX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(446,'R','NRW','BEL','Bergisches Land','EM','',3,'Bergisches Land','','Bergisches Land','ENX, HAX, GLX, GMX, MEX, RSX, SGX, WXX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(447,'R','NRW','BKO','Regierungsbezirk Köln','EM','',3,'Regierungsbezirk Köln','','Regierungsbezirk Köln','EUS, ACX, BNX, DNX, BMX, HSX, KXX, LEVX, GMX, GLX, SUX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(448,'R','NRW','BMU','Regierungsbezirk Münster','EM','',3,'Regierungsbezirk Münster','','Regierungsbezirk Münster','BOR, BOT, COE, GEX, MSX, REX, STX, WAFX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(449,'R','NRW','DWEM','Nordrhein-Westfalen','EM','',3,'Nordrhein-Westfalen','','Nordrhein-Westfalen','alle Kreise in NRW',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(450,'R','NRW','EIF','Eifel','EM','',3,'Eifel','','Eifel','EUSX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(451,'R','NRW','HAA','Haarstrang','EM','',3,'Haarstrang','','Haarstrang','SOX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(452,'R','NRW','KNB','Köln-Niederrheinische Bucht','EM','',3,'Köln-Niederrheinische Bucht','','Köln-Niederrheinische Bucht','BMX, DXX, DNX, HSX, KXX, LEV, MGX, NEX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(453,'R','NRW','NRR','Niederrhein','EM','',3,'Niederrhein','','Niederrhein','KLE, KRX, VIE, WES',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(454,'R','NRW','NRW','Nordrhein-Westfalen','EM','',3,'Nordrhein-Westfalen','','Nordrhein-Westfalen','alle Kreise in NRW (SMS ohne Höhenstufen, immer \"X\")',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(455,'R','NRW','NWB','Nördliches Weserbergland','EM','',3,'Nördliches Weserbergland','','Nördliches Weserbergland','BIX, HFX, LIP, MIX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(456,'R','NRW','OMU','Östliches Münsterland','EM','',3,'Östliches Münsterland','','Östliches Münsterland','GTX, WAF',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(457,'R','NRW','ORU','Östliches Ruhrgebiet','EM','',3,'Östliches Ruhrgebiet','','Östliches Ruhrgebiet','DOX, HAM, UNX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(458,'R','NRW','RSK','Rhein-Sieg Kreis','EM','',3,'Rhein-Sieg Kreis','','Rhein-Sieg Kreis','BNX, SUX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(459,'R','NRW','SAU','Sauerland','EM','',3,'Sauerland','','Sauerland','HSK, MKX, OEX, SIX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(460,'R','NRW','SWB','Südliches Weserbergland','EM','',3,'Südliches Weserbergland','','Südliches Weserbergland','HXX, PBX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(461,'R','NRW','WMU','Westliches Münsterland','EM','',3,'Westliches Münsterland','','Westliches Münsterland','BOR, COE, MSX, REX, STX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(462,'R','NRW','WRU','Westliches Ruhrgebiet','EM','',3,'Westliches Ruhrgebiet','','Westliches Ruhrgebiet','BOT, BOX, DUX, EXX, GEX, HER, MHX, OBX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(463,'R','NS','DWHB','Niedersachsen/Bremen','HA','',3,'Niedersachsen/Bremen','','Niedersachsen/Bremen','alle Kreise in Niedersachsen und Bremen',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(464,'R','NS','HNB','Weser-Leine-Bergland','HA','',3,'Weser-Leine-Bergland','','Weser-Leine-Bergland','GOE, HMX, HOL, NOM',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(465,'R','NS','HNE','Weser-Ems-Gebiet','HA','',3,'Weser-Ems-Gebiet','','Weser-Ems-Gebiet','CLP, DEL, DHX, ELX, NOH, OLX, VEC, WST, LER, BRI, AUI, WTI, FRB',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(466,'R','NS','HNH','Niedersachsen - südlich der Aller','HA','',3,'Niedersachsen - südlich der Aller','','Niedersachsen - südlich der Aller','BSX, HAN, HEX, HIX, NIX, PEX, SZX, SHG, WFX, WOB, BSX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(467,'R','NS','HNK','Niedersachsen - Küste','HA','',3,'Niedersachsen - Küste','','Niedersachsen - Küste','ab Februar 2012: AUK, BHV, CUK, EMD, FRK, HBO, BRK, WHV, WTK',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(468,'R','NS','HNL','Niedersachsen - nördlich der Aller','HA','',3,'Niedersachsen - nördlich der Aller','','Niedersachsen - nördlich der Aller','CEL, GIF, WLX, DAN, LGX, SFA, UEL',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(469,'R','NS','HNO','Osnabrücker Raum','HA','',3,'Osnabrücker Raum','','Osnabrücker Raum','OSX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(470,'R','NS','HNW','Elbe-Weser-Gebiet','HA','',3,'Elbe-Weser-Gebiet','','Elbe-Weser-Gebiet','ab Februar 2012: HBX, OHZ, ROW, STD, VER, CUI',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(471,'R','NS','HNZ','Harz','HA','',3,'Harz','','Harz','GSX, OHA',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(472,'R','RP','DWTR','Rheinland-Pfalz/Saarland','OF','',3,'Rheinland-Pfalz/Saarland','','Rheinland-Pfalz/Saarland','alle Landkreise in Rheinland-Pfalz und im Saarland',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(473,'R','RP','HUR','Hunsrück-Mosel','OF','',3,'Hunsrück-Mosel','','Hunsrück-Mosel','BIR, COC, KOX, MYK, SIM, TRX, WIL',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(474,'R','RP','LUX','Rhein-Pfalz-Kreis und Stadt Ludwigshafen','OF','RP',2,'Rhein-Pfalz-Kreis','','Rhein-Pfalz-Kreis','Unterscheidung Stadt/Land nicht erforderlich',7338,107338000);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(475,'R','RP','NRL','Nördliches Rheinland-Pfalz','OF','',3,'Nördliches Rheinland-Pfalz','','Nördliches Rheinland-Pfalz','AKX, EMS, NRX, WWX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(476,'R','RP','RHE','Rheinhessen','OF','',3,'Rheinhessen','','Rheinhessen','AZX, KHX, MZX, WOX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(477,'R','RP','SRL','Südliches Rheinland-Pfalz','OF','',3,'Südliches Rheinland-Pfalz','','Südliches Rheinland-Pfalz','DUW, FTX, GER, KIB, KLX, KUS, LDX, LUX, NWX, PSX, SPX, SUW, ZWX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(478,'R','RP','WRL','Eifel','OF','',3,'Eifel','','Eifel','AWX, BIT, DAU',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(479,'R','SA','HZG','Kreis Harz','LZ','HZ',2,'Harz','','Harz','HZX, HZH',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(480,'R','SA','LSA','Sachsen-Anhalt','LZ','',3,'Sachsen-Anhalt','','Sachsen-Anhalt','alle Kreise in Sachsen-Anhalt',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(481,'R','SA','RAM','Sachsen-Anhalt - Mitte','LZ','',3,'Sachsen-Anhalt - Mitte','','Sachsen-Anhalt - Mitte','BOE, JLX, MDX, HZX, HZG, SAL',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(482,'R','SA','RAN','Sachsen-Anhalt - Nord','LZ','',3,'Sachsen-Anhalt - Nord','','Sachsen-Anhalt - Nord','SAW, SDL',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(483,'R','SA','RAO','Sachsen-Anhalt - Ost','LZ','',3,'Sachsen-Anhalt - Ost','','Sachsen-Anhalt - Ost','ABI, DEX, WBX',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(484,'R','SA','RAS','Sachsen-Anhalt - Süd','LZ','',3,'Sachsen-Anhalt - Süd','','Sachsen-Anhalt - Süd','MSH, SKX, HAL, BLK',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(485,'R','SH','DWHC','Schleswig-Holstein/Hamburg','HA','',3,'Schleswig-Holstein/Hamburg','','Schleswig-Holstein/Hamburg','alle Kreise in Schleswig-Holstein und Hamburg',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(486,'R','SH','DWSG','Schleswig-Holstein','HA','',3,'Schleswig-Holstein','','Schleswig-Holstein','alle Kreise in Schleswig-Holstein ',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(487,'R','SH','HSB','Schleswig-Holstein - Binnenland','HA','',3,'Schleswig-Holstein - Binnenland','','Schleswig-Holstein - Binnenland','ab Februar 2012: PLI, RDI, SLI, RZX, NMS, PIX, SEX, IZX, ODX, OHI, NFI, HEB',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(488,'R','SH','HSH','Helgoland','HA','',3,'Helgoland','','Helgoland','PIH',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(489,'R','SH','HSN','Schleswig-Holstein - Küste (Nordsee)','HA','',3,'Schleswig-Holstein - Küste (Nordsee)','','Schleswig-Holstein - Küste (Nordsee)','ab Februar 2012: HEK, NFK',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(490,'R','SH','HSO','Schleswig-Holstein - Küste (Ostsee)','HA','',3,'Schleswig-Holstein - Küste (Ostsee)','','Schleswig-Holstein - Küste (Ostsee)','ab Februar 2012: FLX, HLX, KIX, OHK, PLK, RDK, SLK',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(491,'R','SL','DWTR','Rheinland-Pfalz/Saarland','OF','',3,'Rheinland-Pfalz/Saarland','','Rheinland-Pfalz/Saarland','alle Landkreise in Rheinland-Pfalz und im Saarland',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(492,'R','SL','SAR','Saar-Region','OF','',3,'Saar-Region','','Saar-Region','HOM, MZG, NKX, SBX, SLS, WND',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(493,'R','SN','BZX','Kreis Bautzen','LZ','BZ',2,'Bautzen','','Bautzen','Landkreis Bautzen Tiefland (BZF) und Bergland (BZH)',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(494,'R','SN','FGX','Kreis Mittelsachsen','LZ','FG',2,'Mittelsachsen','','Mittelsachsen','Landkreis Mittelsachsen Tiefland (FGF) und Bergland (FGH)',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(495,'R','SN','GRX','Kreis Görlitz','LZ','GR',2,'Görlitz','','Görlitz','Landkreis Görlitz Tiefland (GRF) und Bergland (GRH)',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(496,'R','SN','LSN','Sachsen','LZ','',3,'Sachsen','','Sachsen','alle Kreise in Sachsen',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(497,'R','SN','PIR','Kreis Sächsische Schweiz-Osterzgebirge','LZ','PIR',2,'Sächsische Schweiz-Osterzgebirge','','Sächsische Schweiz-Osterzgebirge','Landkreis Sächsischen Schweiz-Osterzgebirge Tiefland (PIF) und Bergland (PIO, PIW)',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(498,'R','SN','TOX','Kreis Nordsachsen','LZ','TDO',2,'Nordsachsen','','Nordsachsen','Landkreis Nordsachsen gesamt (Nordteil TON, Südteil TOS)',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(499,'R','SN','VXX','Vogtlandkreis','LZ','V',3,'Vogtlandkreis','','Vogtlandkreis','Vogtlandkreis Tiefland (VXF) und Bergland (VXH)',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(500,'R','SN','ZXX','Kreis Zwickau','LZ','Z',2,'Zwickau','','Zwickau','Landkreis Zwickau Tiefland (ZXF) und Bergland (ZXH)',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(501,'R','TH','RTN','Thüringen - Mitte-Nord','LZ','',3,'Thüringen - Mitte-Nord','','Thüringen - Mitte-Nord','APX, GTH, EFX, WEX, EIC, KYF, UHX, SOM, IKX, NDH',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(502,'R','TH','RTO','Thüringen - Ost','LZ','',3,'Thüringen - Ost','','Thüringen - Ost','ABG, SHK, JXX, GXX, GRZ, SLF, SOK',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(503,'R','TH','RTS','Thüringen - Süd','LZ','',3,'Thüringen - Süd','','Thüringen - Süd','WAK, GTH, EAX, SMX, SLF, SHL, HBN, SON',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(504,'R','TH','THL','Thüringen','LZ','',3,'Thüringen','','Thüringen','alle Kreise in Thüringen',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(505,'N','HA','DBN','Deutsche Bucht','HA','',4,'Deutsche Bucht','','Deutsche Bucht','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(506,'N','HA','DGN','Dogger','HA','',4,'Dogger','','Dogger','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(507,'N','HA','ELB','Elbe von Hamburg bis Cuxhaven','HA','',4,'Elbe von Hamburg bis Cuxhaven','','Elbe von Hamburg bis Cuxhaven','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(508,'N','HA','ELM','Elbmündung','HA','',4,'Elbmündung','','Elbmündung','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(509,'N','HA','FIN','Fischer','HA','',4,'Fischer','','Fischer','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(510,'N','HA','FON','Forties','HA','',4,'Forties','','Forties','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(511,'N','HA','HEL','Seegebiet Helgoland','HA','',4,'Seegebiet Helgoland','','Seegebiet Helgoland','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(512,'N','HA','IJN','Ijsselmeer','HA','',4,'Ijsselmeer','','Ijsselmeer','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(513,'N','HA','KON','Englischer Kanal Ostteil','HA','',4,'Englischer Kanal Ostteil','','Englischer Kanal Ostteil','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(514,'N','HA','KWN','Englischer Kanal Westteil','HA','',4,'Englischer Kanal Westteil','','Englischer Kanal Westteil','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(515,'N','HA','NOF','Nordfriesische Küste','HA','',4,'Nordfriesische Küste','','Nordfriesische Küste','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(516,'N','HA','OSF','Ostfriesische Küste','HA','',4,'Ostfriesische Küste','','Ostfriesische Küste','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(517,'N','HA','SKN','Skagerrak','HA','',4,'Skagerrak','','Skagerrak','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(518,'N','HA','SNN','Südwestliche Nordsee','HA','',4,'Südwestliche Nordsee','','Südwestliche Nordsee','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(519,'N','HA','UTN','Utsira','HA','',4,'Utsira','','Utsira','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(520,'N','HA','VIN','Viking','HA','',4,'Viking','','Viking','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(521,'O','HA','BOO','Boddengewässer Ost','HA','',5,'Boddengewässer Ost','','Boddengewässer Ost','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(522,'O','HA','BSO','Belte und Sund','HA','',5,'Belte und Sund','','Belte und Sund','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(523,'O','HA','FER','östlich Fehmarn bis Rügen','HA','',5,'östlich Fehmarn bis Rügen','','östlich Fehmarn bis Rügen','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(524,'O','HA','FLF','Flensburg bis Fehmarn','HA','',5,'Flensburg bis Fehmarn','','Flensburg bis Fehmarn','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(525,'O','HA','KAO','Kattegat','HA','',5,'Kattegat','','Kattegat','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(526,'O','HA','NOO','Nördliche Ostsee','HA','',5,'Nördliche Ostsee','','Nördliche Ostsee','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(527,'O','HA','OOO','Südöstliche Ostsee','HA','',5,'Südöstliche Ostsee','','Südöstliche Ostsee','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(528,'O','HA','OSR','östlich Rügen','HA','',5,'östlich Rügen','','östlich Rügen','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(529,'O','HA','RBO','Rigaischer Meerbusen','HA','',5,'Rigaischer Meerbusen','','Rigaischer Meerbusen','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(530,'O','HA','SKO','Skagerrak','HA','',5,'Skagerrak','','Skagerrak','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(531,'O','HA','SOO','Südliche Ostsee','HA','',5,'Südliche Ostsee','','Südliche Ostsee','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(532,'O','HA','WOO','Westliche Ostsee','HA','',5,'Westliche Ostsee','','Westliche Ostsee','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(533,'O','HA','ZOO','Zentrale Ostsee','HA','',5,'Zentrale Ostsee','','Zentrale Ostsee','Region (plus X) nur in Verbindung mit WWHA50',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(534,'B','BW','BMT','Bodensee - Mitte','SU','',6,'Bodensee - Mitte','','Bodensee - Mitte',NULL,8438,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(535,'B','BW','BSG','Bodensee','SU','',6,'Bodensee','','Bodensee','Bodensee gesamt in Planung (inkl. Schweiz + Österreich)',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(536,'B','BW','BST','Bodensee - Ost','SU','',6,'Bodensee - Ost','','Bodensee - Ost',NULL,8440,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(537,'B','BW','BWT','Bodensee - West','SU','',6,'Bodensee - West','','Bodensee - West',NULL,8439,NULL);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(538,'B','BY','ALT','Altmühlsee/Brombachsee/Igelsbachsee','MS','',6,'Altmühlsee/Brombachsee/Igelsbachsee','','Altmühlsee/Brombachsee/Igelsbachsee',NULL,9901,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(539,'B','BY','BNB','Nordbayern Zusammenfassung','MS','',6,'Nordbayern Zusammenfassung','','Nordbayern Zusammenfassung','ALT, ROT',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(540,'B','BY','BSB','Südbayern Zusammenfassung','MS','',6,'Südbayern Zusammenfassung','','Südbayern Zusammenfassung','BSS, FOR, LLA, LLP, MBT, ROS, STB, STR, TOW, TSC, TSW',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(541,'B','BY','BSS','Schliersee','MS','',6,'Schliersee','','Schliersee',NULL,9911,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(542,'B','BY','FOR','Forggensee','MS','',6,'Forggensee','','Forggensee',NULL,9903,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(543,'B','BY','LLA','Ammersee','MS','',6,'Ammersee','','Ammersee',NULL,9905,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(544,'B','BY','LLP','Wörthsee','MS','',6,'Wörthsee','','Wörthsee','Warnung Pilsensee entfällt, nur noch Wörthsee',9906,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(545,'B','BY','MBT','Tegernsee','MS','',6,'Tegernsee','','Tegernsee',NULL,9910,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(546,'B','BY','ROS','Simssee','MS','',6,'Simssee','','Simssee',NULL,9912,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(547,'B','BY','ROT','Rothsee','MS','',6,'Rothsee','','Rothsee',NULL,9902,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(548,'B','BY','STB','Starnberger See','MS','',6,'Starnberger See','','Starnberger See',NULL,9904,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(549,'B','BY','STR','Staffel-/Riegsee','MS','',6,'Staffel-/Riegsee','','Staffel-/Riegsee',NULL,9909,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(550,'B','BY','TOW','Walchensee','MS','',6,'Walchensee','','Walchensee',NULL,9908,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(551,'B','BY','TSC','Chiemsee','MS','',6,'Chiemsee','','Chiemsee',NULL,9913,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(552,'B','BY','TSW','Waginger/Tachinger See','MS','',6,'Waginger/Tachinger See','','Waginger/Tachinger See',NULL,9914,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(553,'B','HE','ZED','Edersee','OF','',6,'Edersee','','Edersee','in Planung',6638,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(554,'B','HH','HAR','Alster','HA','',6,'Alster','','Alster','in Planung',NULL,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(555,'B','MV','MUR','Müritz','PD','',6,'Müritz','','Müritz','voraussichtlich ab 2012',13010,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(556,'B','NS','DSH','Dümmer See','HA','',6,'Dümmer See','','Dümmer See',NULL,3258,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(557,'B','NS','HSM','Steinhuder Meer','HA','',6,'Steinhuder Meer','','Steinhuder Meer',NULL,3259,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(558,'B','NS','HZM','Zwischenahner Meer','HA','',6,'Zwischenahner Meer','','Zwischenahner Meer',NULL,3464,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(559,'B','NS','NSH','Northeimer Seenplatte','HA','',6,'Northeimer Seenplatte','','Northeimer Seenplatte',NULL,3159,0);

INSERT IGNORE INTO `dwd_warngebiet` (`warngebiet_id`, `dwd_id`, `land_id`, `warngebiet_dwd_kennung`, `warngebiet_name`, `dienststelle_id`, `warngebiet_kfz`, `typ_id`, `warngebiet_kreis_stadt_name`, `warngebiet_zusatz`, `warngebiet_kurz`, `warngebiet_anmerkung`, `warngebiet_cellID`, `warngebiet_warnCellID`)
VALUES
	(560,'B','SH','HOS','Ostholsteinische Seen','HA','',6,'Ostholsteinische Seen','','Ostholsteinische Seen',NULL,1068,0);


# Dump of table dwd_warngebiet_typ
# ------------------------------------------------------------

INSERT IGNORE INTO `dwd_warngebiet_typ` (`typ_id`, `typ_bezeichnung`)
VALUES
	(1,'Stadt');

INSERT IGNORE INTO `dwd_warngebiet_typ` (`typ_id`, `typ_bezeichnung`)
VALUES
	(2,'Kreis');

INSERT IGNORE INTO `dwd_warngebiet_typ` (`typ_id`, `typ_bezeichnung`)
VALUES
	(3,'Regionen');

INSERT IGNORE INTO `dwd_warngebiet_typ` (`typ_id`, `typ_bezeichnung`)
VALUES
	(4,'Nordsee');

INSERT IGNORE INTO `dwd_warngebiet_typ` (`typ_id`, `typ_bezeichnung`)
VALUES
	(5,'Ostsee');

INSERT IGNORE INTO `dwd_warngebiet_typ` (`typ_id`, `typ_bezeichnung`)
VALUES
	(6,'Gewässer');


# Dump of table dwd_warntyp
# ------------------------------------------------------------

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('21',12,'Bodenfrost','ganzjährig; spezielle Wetterwarnung, keine Grundversorgung',NULL);

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('22',12,'Frost','ganzjährig; spezielle Wetterwarnung, zusätzlich Warnung zur Grundversorgung, Basis für WW..81 (im DWD-Internet)','Lufttemperratur unter dem Gefrierpunkt bis -9 °C');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('23',7,'Glätte durch überfrierende Nässe, Schneeregen, durch sehr starke Reifablagerungen','vom 01.11. bis 31.03., für Glätte gem. ww84; spezielle Wetterwarnung, keine Grundversorgung',NULL);

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('24',7,'Glätte durch Reif, überfrierende Nässe, Schneematsch','ganzjährig; spezielle Wetterwarnung, keine Grundversorgung',NULL);

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('25',7,'Glätte durch Reif, überfrierende Nässe, Schneematsch','für Kombiwarnungen mit Glätte gem. ww24, ganzjährig; spezielle Wetterwarnung, keine Grundversorgung',NULL);

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('31',13,'Gewitter','nur elektr. Entladung, auch mit Windböen','bei Auftreten (Elektrische Entladung, auch in Verbindung mit Windböen bzw. (schweren) Sturmböen, Starkregen oder Hagel bis 1,5 cm)');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('33',13,'Starkes Gewitter mit Sturmböen oder schweren Sturmböen',NULL,'bei Auftreten (Elektrische Entladung, auch in Verbindung mit Windböen bzw. (schweren) Sturmböen, Starkregen oder Hagel bis 1,5 cm)');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('34',13,'Starkes Gewitter mit Starkregen',NULL,'bei Auftreten (Elektrische Entladung, auch in Verbindung mit Windböen bzw. (schweren) Sturmböen, Starkregen oder Hagel bis 1,5 cm)');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('36',13,'Starkes Gewitter mit Sturmböen oder schweren Sturmböen und Starkregen',NULL,'bei Auftreten (Elektrische Entladung, auch in Verbindung mit Windböen bzw. (schweren) Sturmböen, Starkregen oder Hagel bis 1,5 cm)');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('38',13,'Starkes Gewitter mit Sturmböen oder schweren Sturmböen, Starkregen und Hagel',NULL,'bei Auftreten (Elektrische Entladung, auch in Verbindung mit Windböen bzw. (schweren) Sturmböen, Starkregen oder Hagel bis 1,5 cm)');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('40',14,'Schweres Gewitter mit orkanartigen Böen oder Orkanböen',NULL,'Mindestens eine (begleitende) Wettererscheinung erfüllt das Unwetterkriterium');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('41',15,'Schweres Gewitter mit extremen Orkanböen',NULL,'Mindestens eine (begleitende) Wettererscheinung erfüllt das Unwetterkriterium, Orkanböen > 140 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('42',14,'Schweres Gewitter mit schweren Sturmböen und heftigem Starkregen',NULL,'Mindestens eine (begleitende) Wettererscheinung erfüllt das Unwetterkriterium');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('44',14,'Schweres Gewitter mit orkanartigen Böen oder Orkanböen und heftigem Starkregen',NULL,'Mindestens eine (begleitende) Wettererscheinung erfüllt das Unwetterkriterium');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('45',15,'Schweres Gewitter mit extremen Orkanböen und heftigem Starkregen',NULL,'Mindestens eine (begleitende) Wettererscheinung erfüllt das Unwetterkriterium, Orkanböen > 140 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('46',14,'Schweres Gewitter mit schweren Sturmböen, heftigem Starkregen und Hagel',NULL,'Mindestens eine (begleitende) Wettererscheinung erfüllt das Unwetterkriterium');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('47',18,'Hitzewarnung','Hitzewarnung KU1FG für Internet','Hitzeperioden mit gefühlter Temperatur > 32 °C bzw. > 38 °C (extreme Hitze)');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('48',14,'Schweres Gewitter mit orkanartigen Böen oder Orkanböen, heftigem Starkregen und Hagel',NULL,'Mindestens eine (begleitende) Wettererscheinung erfüllt das Unwetterkriterium');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('49',15,'Schweres Gewitter mit extremen Orkanböen, heftigem Starkregen und Hagel',NULL,'Mindestens eine (begleitende) Wettererscheinung erfüllt das Unwetterkriterium, Orkanböen > 140 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('50',1,'Starkwind an Nord- und Ostsee',NULL,NULL);

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('51',1,'Windböen',NULL,'ab 50 bis 64 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('52',1,'Sturmböen',NULL,'65 bis 89 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('53',1,'Schwere Sturmböen',NULL,'90 bis 104 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('54',1,'Orkanartige Böen',NULL,'105 bis 119 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('55',1,'Orkanböen',NULL,'120 bis 139 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('56',1,'Extreme Orkanböen',NULL,'ab 140 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('57',1,'Starkwindwarnung für Bodensee und Bayerische Binnenseen',NULL,NULL);

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('58',1,'Sturmwarnung für Bodensee und Bayerische Binnenseen',NULL,NULL);

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('59',2,'Nebel mit Sichtweite unter 150 m',NULL,'Sichtweite unter 150 m');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('61',3,'Starkregen',NULL,'15 bis 25 l/m² in 1 Stunde\n20 bis 35 l/m² in 6 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('62',3,'Heftiger Starkregen',NULL,'25 bis 40 l/m² in 1 Stunde\n35 bis 60 l/m² in 6 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('63',4,'Dauerregen',NULL,'25 bis 40 l/m² in 12 Stunden\n30 bis 50 l/m² in 24 Stunden\n40 bis 60 l/m² in 48 Stunden\n60 bis 90 l/m² in 72 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('64',4,'Ergiebiger Dauerregen',NULL,'40 bis 70 l/m² in 12 Stunden\n50 bis 80 l/m² in 24 Stunden\n60 bis 90 l/m² in 48 Stunden\n> 90 l/m² in 72 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('65',4,'Extrem ergiebiger Dauerregen',NULL,'> 70 l/m² in 12 Stunden\n> 80 l/m² in 24 Stunden\n> 90 l/m² in 48 Stunden\n> 120 l/m² in 72 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('66',3,'Extrem heftiger Starkregen',NULL,'> 40 l/m² in 1 Stunde\n> 60 l/m² in 6 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('70',5,'Leichter Schneefall',NULL,'bis 5 cm in 6 Stunden\nbis 10 cm in 12 Stunden\nbis 15 cm in 24 Stunden\nbis 20 cm in 48/72 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('71',5,'Schneefall',NULL,'bis 800 m:\n5 bis 10 cm in 6 Stunden\n10 bis 15 cm in 12 Stunden\n15 bis 30 cm in 24 Stunden\n20 bis 40 cm in 48/72 Stunden\n\nüber 800 m:\n5 bis 20 cm in 6 Stunden\n10 bis 30 cm in 12 Stunden\n15 bis 40 cm in 24 Stunden\n20 bis 50 cm in 48/72 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('72',5,'Starker Schneefall',NULL,'bis 800 m:\n10 bis 20 cm in 6 Stunden\n15 bis 25 cm in 12 Stunden\n30 bis 40 cm in 24 Stunden\n40 bis 50 cm in 48/72 Stunden\n\nüber 800 m:\n20 bis 30 cm in 6 Stunden\n30 bis 50 cm in 12 Stunden\n40 bis 60 cm in 24 Stunden\n50 bis 70 cm in 48/72 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('73',5,'Extrem starker Schneefall',NULL,'bis 800 m:\n> 20 cm in 6 Stunden\n> 25 cm in 12 Stunden\n> 40 cm in 24 Stunden\n> 50 cm in 48/72 Stunden\n\nüber 800 m:\n> 30 cm in 6 Stunden\n> 50 cm in 12 Stunden\n> 60 cm in 24 Stunden\n> 70 cm in 48/72 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('74',6,'Schneeverwehung in Verbindung mit Schneefall',NULL,'Neuschnee oder lockere Schneedecke 5 bis 10 cm und wiederholt Windböen von 39 bis 64 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('75',6,'Starke Schneeverwehung in Verbindung mit starkem Schneefall',NULL,'Neuschnee oder lockere Schneedecke 10 bis 25 cm und wiederholt Windböen > 65 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('76',6,'Schneeverwehung in Verbindung mit Schneefall',NULL,'Neuschnee oder lockere Schneedecke 5 bis 10 cm und wiederholt Windböen von 39 bis 64 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('77',6,'Starke Schneeverwehung in Verbindung mit starkem Schneefall',NULL,'Neuschnee oder lockere Schneedecke 10 bis 25 cm und wiederholt Windböen > 65 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('78',6,'Extrem starke Schneeverwehung in Verbindung mit extrem starken Schneefall',NULL,'Neuschnee oder lockere Schneedecke > 25 cm und wiederholt Windböen > 65 km/h');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('79',20,'Leiterseilschwingung','spezielle Wetterwarnung, keine Grundversorgung',NULL);

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('81',12,'Frost','vom 01.04. bis 31.10.',NULL);

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('82',12,'Strenger Frost','ganzjährig','Lufttemperatur unter -10 °C');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('84',7,'Glätte durch überfrierende Nässe, Schneeregen, durch sehr starke Reifablagerungen',NULL,'verbreitet durch überfrierende Nässe und/oder starke Reifablagerungen');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('85',8,'verbreitet Glatteis am Boden oder an Gegenständen bei gefrierendem Regen; erhebliche Verkehrsbehinderungen','im Einzelfall auch bei verbreitetem Auftreten von überfrierender Nässe','verbreitet Glatteisbildung am Boden oder an Gegenständen bei gefrierendem Regen, in Einzelfallentscheidung auch bei verbreitetem Auftreten von überfrierender Nässe mit erheblichen Verkehrsbehinderungen');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('87',9,'kurzzeitige/kleinräumige Glätte durch gefrierenden Regen oder Sprühregen','auch bei überfrierender Nässe nach Regen','kurzzeitig oder kleinräumig durch gefrierenden Regen oder Sprühregen, auch bei überfrierender Nässe mit erheblichen Verkehrsbehinderungen');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('88',10,'Tauwetter',NULL,'bei steigenden Temperaturen Abflussmenge durch flüssigen Niederschlag und Wasserabgabe aus der Schneedecke (Niederschlagsdargebot):\r25 bis 40 l/m² in 12 Stunden\r30 bis 50 l/m² in 24 Stunden\r40 bis 60 l/m² in 48 Stunden \r60 bis 90 l/m² in 72 Stunden ');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('89',11,'Starkes Tauwetter',NULL,'bei steigenden Temperaturen Abflussmenge durch flüssigen Niederschlag und Wasserabgabe aus der Schneedecke (Niederschlagsdargebot):\n> 40 l/m² in 12 Stunden\n> 50 l/m² in 24 Stunden\n> 60 l/m² in 48 Stunden\n> 90 l/m² in 72 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('94',14,'Schweres Gewitter mit Sturmböen und heftigem Starkregen',NULL,'Mindestens eine (begleitende) Wettererscheinung erfüllt das Unwetterkriterium');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('95',16,'Schweres Gewitter mit Sturmböen, extrem heftigem Starkregen und Hagel',NULL,'Mindestens eine (begleitende) Wettererscheinung erfüllt das Unwetterkriterium Starkregen:\n> 40 l/m² in 1 Stunde\n> 60 l/m² in 6 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('96',16,'Schweres Gewitter mit Orkanböen, extrem heftigem Starkregen und Hagel',NULL,'Mindestens eine (begleitende) Wettererscheinung erfüllt das Unwetterkriterium Starkregen:\n> 40 l/m² in 1 Stunde\n> 60 l/m² in 6 Stunden');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('98',19,'Testwarnung','für Testzwecke',NULL);

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('99',19,'Testwarnung','für Testzwecke',NULL);

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('WWFG46',17,'Hoher UV-Index',NULL,'Warnung vor UV-Index > 5 und dünner Ozonschicht im Frühling, UV-Index > 8 im Sommer');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('WWFG47',18,'Hitzewarnung',NULL,'Hitzeperioden mit gefühlter Temperatur > 32 °C bzw. > 38 °C (extreme Hitze)');

INSERT IGNORE INTO `dwd_warntyp` (`warntyp_id`, `erscheinung_id`, `warntyp_ereignis`, `warntyp_anmerkung`, `warntyp_schwelle`)
VALUES
	('WWFG49',18,'Hitzewarnung heute und morgen',NULL,'Hitzeperioden mit gefühlter Temperatur > 32 °C bzw. > 38 °C (extreme Hitze)');


# Dump of table dwd_warnungsart
# ------------------------------------------------------------

INSERT IGNORE INTO `dwd_warnungsart` (`warnart_id`, `warnart_name`)
VALUES
	('HP','Vorabinformation Unwetter für SMS');

INSERT IGNORE INTO `dwd_warnungsart` (`warnart_id`, `warnart_name`)
VALUES
	('HU','Unwetterwarnung für SMS');

INSERT IGNORE INTO `dwd_warnungsart` (`warnart_id`, `warnart_name`)
VALUES
	('HW','Wetterwarnung für SMS');

INSERT IGNORE INTO `dwd_warnungsart` (`warnart_id`, `warnart_name`)
VALUES
	('WP','Vorabinformation Unwetter');

INSERT IGNORE INTO `dwd_warnungsart` (`warnart_id`, `warnart_name`)
VALUES
	('WU','Unwetterwarnung');

INSERT IGNORE INTO `dwd_warnungsart` (`warnart_id`, `warnart_name`)
VALUES
	('WW','Wetterwarnung');


SET FOREIGN_KEY_CHECKS = 1;
