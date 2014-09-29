SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `bindata` (
`binid` int(11) NOT NULL,
  `data` longblob NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `callerlist` (
`id` int(11) NOT NULL,
  `typ` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `rufnummer` varchar(255) NOT NULL,
  `nebenstelle` varchar(255) NOT NULL,
  `eigenerufnummer` varchar(255) NOT NULL,
  `dauer` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `configuration` (
  `dev_id` int(11) NOT NULL,
  `configstring` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(4000) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `hint` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cron_data` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `data` longtext NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `devices` (
`dev_id` int(11) NOT NULL,
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
  `pcat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `device_data` (
`ddid` int(11) unsigned NOT NULL,
  `deviceident` varchar(255) NOT NULL DEFAULT '',
  `timestamp_unix` int(10) NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  `valuename` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(255) NOT NULL DEFAULT '',
  `valueunit` varchar(255) DEFAULT '',
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `day` int(2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `device_floors` (
`floor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `device_types` (
`dtype_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type_id` int(11) NOT NULL,
  `image_off_id` int(11) DEFAULT NULL,
  `image_on_id` int(11) DEFAULT NULL,
  `imagesize` varchar(255) DEFAULT '70%'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `garbageplan` (
`id` int(11) NOT NULL,
  `pickupdate` datetime NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `groups` (
`gid` int(11) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `grpname` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `network_devices` (
`nd_id` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL DEFAULT 'DHCP',
  `subnet` varchar(15) NOT NULL DEFAULT '255.255.255.0',
  `macaddr` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `ndtype_id` int(11) DEFAULT NULL,
  `os_id` int(11) DEFAULT NULL,
  `infos` varchar(255) NOT NULL DEFAULT '-',
  `state` int(1) NOT NULL DEFAULT '0',
  `ip_dhcp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `network_device_types` (
`ndtype_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `network_os` (
`os_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `network_ranges` (
`nr_id` int(11) NOT NULL,
  `iprange` varchar(19) NOT NULL DEFAULT '000.000.000.000-000',
  `subnet` varchar(15) NOT NULL DEFAULT '255.255.255.0',
  `infos` varchar(255) DEFAULT '-'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `notes` (
`no_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text,
  `created_by` int(11) NOT NULL,
  `create_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  `visible_to` varchar(255) NOT NULL DEFAULT 'public',
  `isActive` int(1) NOT NULL DEFAULT '1',
  `papercolor` varchar(255) NOT NULL DEFAULT 'yellow'
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `openweathermap` (
`id` int(11) unsigned NOT NULL,
  `measuredate` int(11) NOT NULL,
  `weatherkey` varchar(255) NOT NULL DEFAULT '',
  `weathervalue` varchar(4000) NOT NULL DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `openweathermap_forecast` (
`id` int(11) unsigned NOT NULL,
  `measuredate` int(11) NOT NULL,
  `weatherkey` varchar(255) NOT NULL DEFAULT '',
  `weathervalue` varchar(4000) NOT NULL DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `pinboard_configuration` (
`id` int(11) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `parentid` int(11) DEFAULT NULL,
  `meta` varchar(4000) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `pinboard_links` (
`link_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `uid` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `reportdata` (
`rd_id` int(11) NOT NULL,
  `savedate` datetime NOT NULL,
  `data` varchar(4000) NOT NULL DEFAULT '',
  `rid` int(11) DEFAULT NULL,
  `startval` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `reports` (
`rid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'manual',
  `unit` varchar(255) DEFAULT '',
  `unitprice` varchar(255) DEFAULT '0',
  `dev_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `report_configuration` (
  `rid` int(11) NOT NULL,
  `configstring` varchar(255) NOT NULL DEFAULT '',
  `value` varchar(4000) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `rooms` (
`room_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '0',
  `floor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `scheduler` (
`sch_id` int(11) NOT NULL,
  `days` varchar(255) DEFAULT NULL,
  `isActive` int(1) NOT NULL DEFAULT '0',
  `interval_type_id` int(11) NOT NULL DEFAULT '1',
  `interval_time` varchar(5) DEFAULT '00:00',
  `dev_id` int(11) DEFAULT NULL,
  `dev_state` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sharedfiles` (
`SID` int(25) NOT NULL,
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
  `File_AccessPasswordPlain` varchar(255) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sharedfiles_accesslog` (
`id` int(11) NOT NULL,
  `accessdate` datetime NOT NULL,
  `accessip` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL,
  `useragent` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `types` (
`type_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `usergroups` (
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users` (
`uid` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


ALTER TABLE `bindata`
 ADD PRIMARY KEY (`binid`);

ALTER TABLE `callerlist`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `configuration`
 ADD KEY `dev_id` (`dev_id`);

ALTER TABLE `cron_data`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `devices`
 ADD PRIMARY KEY (`dev_id`), ADD KEY `loc_id` (`room_id`), ADD KEY `type` (`dtype_id`), ADD KEY `floor_id` (`floor_id`), ADD KEY `room_id` (`room_id`);

ALTER TABLE `device_data`
 ADD PRIMARY KEY (`ddid`);

ALTER TABLE `device_floors`
 ADD PRIMARY KEY (`floor_id`), ADD KEY `image_id` (`image_id`);

ALTER TABLE `device_types`
 ADD PRIMARY KEY (`dtype_id`);

ALTER TABLE `garbageplan`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `groups`
 ADD PRIMARY KEY (`gid`);

ALTER TABLE `network_devices`
 ADD PRIMARY KEY (`nd_id`);

ALTER TABLE `network_device_types`
 ADD PRIMARY KEY (`ndtype_id`);

ALTER TABLE `network_os`
 ADD PRIMARY KEY (`os_id`);

ALTER TABLE `network_ranges`
 ADD PRIMARY KEY (`nr_id`);

ALTER TABLE `notes`
 ADD PRIMARY KEY (`no_id`);

ALTER TABLE `openweathermap`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `openweathermap_forecast`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `pinboard_configuration`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `pinboard_links`
 ADD PRIMARY KEY (`link_id`);

ALTER TABLE `reportdata`
 ADD PRIMARY KEY (`rd_id`);

ALTER TABLE `reports`
 ADD PRIMARY KEY (`rid`);

ALTER TABLE `report_configuration`
 ADD KEY `dev_id` (`rid`);

ALTER TABLE `rooms`
 ADD PRIMARY KEY (`room_id`);

ALTER TABLE `scheduler`
 ADD PRIMARY KEY (`sch_id`);

ALTER TABLE `sharedfiles`
 ADD PRIMARY KEY (`SID`), ADD KEY `File_Date` (`File_Date`);

ALTER TABLE `sharedfiles_accesslog`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `types`
 ADD PRIMARY KEY (`type_id`);

ALTER TABLE `usergroups`
 ADD PRIMARY KEY (`uid`,`gid`), ADD KEY `uid` (`uid`,`gid`), ADD KEY `gid` (`gid`);

ALTER TABLE `users`
 ADD PRIMARY KEY (`uid`), ADD KEY `username` (`username`);


ALTER TABLE `bindata`
MODIFY `binid` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `callerlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `cron_data`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `devices`
MODIFY `dev_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `device_data`
MODIFY `ddid` int(11) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `device_floors`
MODIFY `floor_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `device_types`
MODIFY `dtype_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `garbageplan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `groups`
MODIFY `gid` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `network_devices`
MODIFY `nd_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `network_device_types`
MODIFY `ndtype_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `network_os`
MODIFY `os_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `network_ranges`
MODIFY `nr_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `notes`
MODIFY `no_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `openweathermap`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `openweathermap_forecast`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
ALTER TABLE `pinboard_configuration`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `pinboard_links`
MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `reportdata`
MODIFY `rd_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `reports`
MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `rooms`
MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `scheduler`
MODIFY `sch_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `sharedfiles`
MODIFY `SID` int(25) NOT NULL AUTO_INCREMENT;
ALTER TABLE `sharedfiles_accesslog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `types`
MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `users`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `devices`
ADD CONSTRAINT `devices_ibfk_2` FOREIGN KEY (`floor_id`) REFERENCES `device_floors` (`floor_id`),
ADD CONSTRAINT `devices_ibfk_3` FOREIGN KEY (`dtype_id`) REFERENCES `device_types` (`dtype_id`);

ALTER TABLE `usergroups`
ADD CONSTRAINT `usergroups_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE,
ADD CONSTRAINT `usergroups_ibfk_2` FOREIGN KEY (`gid`) REFERENCES `groups` (`gid`) ON DELETE CASCADE;
