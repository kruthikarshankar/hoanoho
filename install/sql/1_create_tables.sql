SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET FOREIGN_KEY_CHECKS = 0;


CREATE TABLE IF NOT EXISTS `bindata` (
  `binid` int(11) NOT NULL AUTO_INCREMENT,
  `data` longblob NOT NULL,
  PRIMARY KEY (`binid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `callerlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typ` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `rufnummer` varchar(255) NOT NULL,
  `nebenstelle` varchar(255) NOT NULL,
  `eigenerufnummer` varchar(255) NOT NULL,
  `dauer` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `configuration` (
  `dev_id` int(11) NOT NULL,
  `configstring` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(4000) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `hint` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `category` varchar(255) DEFAULT NULL,
  KEY `dev_id` (`dev_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `cron_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `devices` (
  `dev_id` int(11) NOT NULL AUTO_INCREMENT,
  `identifier` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dtype_id` int(11) DEFAULT NULL,
  `floor_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `pos_x` varchar(255) NOT NULL DEFAULT '10',
  `pos_y` varchar(255) NOT NULL DEFAULT '40',
  `isStructure` varchar(11) NOT NULL DEFAULT '',
  `isHidden` varchar(11) NOT NULL DEFAULT '',
  `nd_id` int(11) DEFAULT NULL,
  `pcat_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`dev_id`),
  KEY `loc_id` (`room_id`),
  KEY `type` (`dtype_id`),
  KEY `floor_id` (`floor_id`),
  KEY `room_id` (`room_id`),
  CONSTRAINT `devices_ibfk_2` FOREIGN KEY (`floor_id`) REFERENCES `device_floors` (`floor_id`),
  CONSTRAINT `devices_ibfk_3` FOREIGN KEY (`dtype_id`) REFERENCES `device_types` (`dtype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `device_data` (
  `ddid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `deviceident` varchar(255) NOT NULL DEFAULT '',
  `timestamp_unix` int(10) NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  `valuename` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT '',
  `valueunit` varchar(255) DEFAULT '',
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `day` int(2) NOT NULL,
  PRIMARY KEY (`ddid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `device_floors` (
  `floor_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`floor_id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `device_types` (
  `dtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `image_off_id` int(11) DEFAULT NULL,
  `image_on_id` int(11) DEFAULT NULL,
  `imagesize` varchar(255) DEFAULT '70%',
  PRIMARY KEY (`dtype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `garbageplan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pickupdate` datetime NOT NULL,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `groups` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `isAdmin` tinyint(1) NOT NULL,
  `grpname` varchar(255) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `network_devices` (
  `nd_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL DEFAULT 'DHCP',
  `subnet` varchar(15) NOT NULL DEFAULT '255.255.255.0',
  `macaddr` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `ndtype_id` int(11) DEFAULT NULL,
  `os_id` int(11) DEFAULT NULL,
  `infos` varchar(255) NOT NULL DEFAULT '-',
  `state` int(1) NOT NULL DEFAULT '0',
  `ip_dhcp` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `network_device_types` (
  `ndtype_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`ndtype_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `network_os` (
  `os_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  PRIMARY KEY (`os_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `network_ranges` (
  `nr_id` int(11) NOT NULL AUTO_INCREMENT,
  `iprange` varchar(19) NOT NULL DEFAULT '192.168.0.0/24',
  `subnet` varchar(15) NOT NULL DEFAULT '255.255.255.0',
  `infos` varchar(255) DEFAULT '-',
  PRIMARY KEY (`nr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `notes` (
  `no_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text,
  `created_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `visible_to` varchar(255) NOT NULL DEFAULT 'public',
  `isActive` int(1) NOT NULL DEFAULT '1',
  `papercolor` varchar(255) NOT NULL DEFAULT 'yellow',
  PRIMARY KEY (`no_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `openweathermap` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `measuredate` int(11) NOT NULL,
  `weatherkey` varchar(255) NOT NULL DEFAULT '',
  `weathervalue` varchar(4000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `openweathermap_forecast` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `measuredate` int(11) NOT NULL,
  `weatherkey` varchar(255) NOT NULL DEFAULT '',
  `weathervalue` varchar(4000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `pinboard_configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(255) NOT NULL,
  `parentid` int(11) DEFAULT NULL,
  `meta` varchar(4000) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `pinboard_links` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;


CREATE TABLE IF NOT EXISTS `reportdata` (
  `rd_id` int(11) NOT NULL AUTO_INCREMENT,
  `savedate` datetime NOT NULL,
  `data` varchar(4000) NOT NULL DEFAULT '',
  `rid` int(11) DEFAULT NULL,
  `startval` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `reports` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'manual',
  `unit` varchar(255) DEFAULT '',
  `unitprice` varchar(255) DEFAULT '0',
  `dev_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `report_configuration` (
  `rid` int(11) NOT NULL,
  `configstring` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(4000) NOT NULL DEFAULT '',
  KEY `dev_id` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `floor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `scheduler` (
  `sch_id` int(11) NOT NULL AUTO_INCREMENT,
  `days` varchar(255) DEFAULT NULL,
  `isActive` int(1) NOT NULL DEFAULT '0',
  `interval_type_id` int(11) NOT NULL DEFAULT '1',
  `interval_time` varchar(5) DEFAULT '00:00',
  `dev_id` int(11) DEFAULT NULL,
  `dev_state` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `sharedfiles` (
  `SID` int(25) NOT NULL AUTO_INCREMENT,
  `Hash` varchar(255) NOT NULL,
  `File_Name` varchar(255) NOT NULL DEFAULT '',
  `File_Type` varchar(15) NOT NULL DEFAULT '',
  `File_Size` varchar(45) NOT NULL DEFAULT '',
  `File_Content` longblob NOT NULL,
  `File_Extension` varchar(10) NOT NULL DEFAULT '',
  `File_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `File_ValidDate` timestamp NULL DEFAULT NULL,
  `File_AccessPassword` varchar(255) DEFAULT NULL,
  `File_LastAccessDate` datetime DEFAULT NULL,
  `File_LastAccessIP` varchar(16) DEFAULT NULL,
  `File_AccessCounter` int(11) NOT NULL DEFAULT '0',
  `uid` int(11) NOT NULL,
  `File_AccessPasswordPlain` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SID`),
  KEY `File_Date` (`File_Date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `sharedfiles_accesslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accessdate` datetime NOT NULL,
  `accessip` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL,
  `useragent` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `types` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `usergroups` (
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  PRIMARY KEY (`uid`,`gid`),
  KEY `uid` (`uid`,`gid`),
  KEY `gid` (`gid`),
  CONSTRAINT `usergroups_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
  CONSTRAINT `usergroups_ibfk_2` FOREIGN KEY (`gid`) REFERENCES `groups` (`gid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `usersettings` (
  `uid` int(11) NOT NULL,
  `backgroundimage` varchar(255) NOT NULL DEFAULT '/img/bg/default.png',
  `notecolor` varchar(255) NOT NULL DEFAULT 'yellow',
  `mailserver_type` varchar(255) DEFAULT NULL,
  `mailserver_login` varchar(255) DEFAULT NULL,
  `mailserver_password` varchar(255) DEFAULT NULL,
  `mailserver_host` varchar(255) DEFAULT NULL,
  `mailserver_port` int(11) DEFAULT NULL,
  `mailserver_encryption` varchar(255) DEFAULT NULL,
  `pushover_usertoken` varchar(255) DEFAULT NULL,
  `pushover_apptoken` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8  DEFAULT COLLATE utf8_unicode_ci;


SET FOREIGN_KEY_CHECKS = 1;
