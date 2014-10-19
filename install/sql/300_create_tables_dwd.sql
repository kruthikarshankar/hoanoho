SET FOREIGN_KEY_CHECKS = 0;


# Dump of table dwd_dienststelle
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dwd_dienststelle` (
  `dienststelle_id` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dienststelle_name` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`dienststelle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table dwd_erscheinung
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dwd_erscheinung` (
  `erscheinung_id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `erscheinung_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`erscheinung_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table dwd_hoehenstufe
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dwd_hoehenstufe` (
  `hoehenstufe_id` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `hoehenstufe_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`hoehenstufe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table dwd_region
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dwd_region` (
  `region_id` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `region_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `karten_region` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table dwd_urls
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dwd_urls` (
  `url_id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `url_lang` enum('DE','EN') COLLATE utf8_unicode_ci NOT NULL,
  `url_section` enum('alerts','climate','forecasts','maritime','observations','radar','satpics','satweather','warnings','') COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `order` tinyint(4) DEFAULT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url_value` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`url_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table dwd_warnart
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dwd_warnart` (
  `warnart_id` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `warnart_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`warnart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table dwd_warngebiet
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dwd_warngebiet` (
  `warngebiet_id` smallint(3) NOT NULL AUTO_INCREMENT,
  `dwd_id` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `land_id` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `warngebiet_dwd_kennung` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `warngebiet_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dienststelle_id` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `region_id` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `warngebiet_kfz` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `typ_id` tinyint(1) NOT NULL,
  `warngebiet_kreis_stadt_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `warngebiet_zusatz` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `warngebiet_kurz` varchar(60) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `warngebiet_anmerkung` tinytext COLLATE utf8_unicode_ci,
  `warngebiet_cellID` smallint(5) unsigned DEFAULT NULL,
  `warngebiet_warnCellID` int(9) unsigned DEFAULT NULL,
  PRIMARY KEY (`warngebiet_id`),
  UNIQUE KEY `dwd_kennung` (`warngebiet_dwd_kennung`,`typ_id`,`land_id`),
  KEY `dienststelle_id` (`dienststelle_id`),
  KEY `typ_id` (`typ_id`),
  KEY `land_id` (`land_id`),
  CONSTRAINT `dwd_warngebiet_ibfk_1` FOREIGN KEY (`typ_id`) REFERENCES `dwd_warngebiet_typ` (`typ_id`) ON UPDATE CASCADE,
  CONSTRAINT `dwd_warngebiet_ibfk_3` FOREIGN KEY (`dienststelle_id`) REFERENCES `dwd_dienststelle` (`dienststelle_id`) ON UPDATE CASCADE,
  CONSTRAINT `dwd_warngebiet_ibfk_4` FOREIGN KEY (`land_id`) REFERENCES `geo_state` (`dwd_land_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table dwd_warngebiet_abo
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dwd_warngebiet_abo` (
  `warnabo_id` int(11) NOT NULL AUTO_INCREMENT,
  `warngebiet_id` smallint(3) NOT NULL,
  PRIMARY KEY (`warnabo_id`),
  KEY `warngebiet_id` (`warngebiet_id`),
  CONSTRAINT `dwd_warngebiet_abo_ibfk_1` FOREIGN KEY (`warngebiet_id`) REFERENCES `dwd_warngebiet` (`warngebiet_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table dwd_warngebiet_typ
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dwd_warngebiet_typ` (
  `typ_id` tinyint(1) NOT NULL AUTO_INCREMENT,
  `typ_bezeichnung` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`typ_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table dwd_warntyp
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `dwd_warntyp` (
  `warntyp_id` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `erscheinung_id` tinyint(2) NOT NULL,
  `warntyp_ereignis` varchar(120) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `warntyp_anmerkung` tinytext COLLATE utf8_unicode_ci,
  `warntyp_schwelle` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`warntyp_id`),
  KEY `erscheinung_id` (`erscheinung_id`),
  CONSTRAINT `dwd_warntyp_ibfk_1` FOREIGN KEY (`erscheinung_id`) REFERENCES `dwd_erscheinung` (`erscheinung_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table geo_city
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `geo_city` (
  `city_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `state_id` tinyint(2) NOT NULL,
  `county_id` smallint(3) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `state_id` (`state_id`),
  KEY `county_id` (`county_id`),
  CONSTRAINT `geo_city_ibfk_2` FOREIGN KEY (`county_id`) REFERENCES `geo_county` (`county_id`) ON UPDATE CASCADE,
  CONSTRAINT `geo_city_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `geo_state` (`state_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table geo_county
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `geo_county` (
  `county_id` smallint(3) NOT NULL AUTO_INCREMENT,
  `state_id` tinyint(2) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`county_id`),
  KEY `state_id` (`state_id`),
  CONSTRAINT `geo_county_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `geo_state` (`state_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table geo_district
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `geo_district` (
  `district_id` smallint(4) NOT NULL AUTO_INCREMENT,
  `city_id` smallint(5) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `geo_district_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `geo_city` (`city_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table geo_state
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `geo_state` (
  `state_id` tinyint(2) NOT NULL AUTO_INCREMENT,
  `dwd_land_id` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dwd_region_id` char(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`state_id`),
  UNIQUE KEY `dwd_land_id` (`dwd_land_id`),
  KEY `dwd_region_id` (`dwd_region_id`),
  CONSTRAINT `geo_state_ibfk_1` FOREIGN KEY (`dwd_region_id`) REFERENCES `dwd_region` (`region_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table geo_zipcode
# ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS `geo_zipcode` (
  `zipcode_id` smallint(4) NOT NULL AUTO_INCREMENT,
  `city_id` smallint(5) NOT NULL,
  `district_id` smallint(4) DEFAULT NULL,
  `zipcode` mediumint(5) NOT NULL,
  PRIMARY KEY (`zipcode_id`),
  KEY `district_id` (`district_id`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `geo_zipcode_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `geo_city` (`city_id`) ON UPDATE CASCADE,
  CONSTRAINT `geo_zipcode_ibfk_2` FOREIGN KEY (`district_id`) REFERENCES `geo_district` (`district_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


SET FOREIGN_KEY_CHECKS = 1;
