# Hoanoho
Hoanoho is Maori and means Roommate. Hoanoho is a beautiful state of the art Frontend for FHEM.
It is designed to run a Raspberry Pi.


## Prerequisites

You need a fully working installation of FHEM and the corresponding actuators in your home environment.

A local web server together with PHP5 and also a working node.js installation.

PHP needs the following modules to be installed:

* php5-curl
* php5-gd
* php5-imagick
* php5-imap
* php5-mysql

node.js needs the following modules to be installed:

* mysql
* socket.io
* ws

## Installation
Just put these files into your webserver root directory and go through the installer located under **http://yourhostname/install**.
Installation in a subdirectory might not be fully supported at this stage.
The installer will setup the initial database structure as well as store database credentials in /config/dbconfig.inc.php.

You should also edit the Database credentials in file **js/socketserver.js**.
Daemonize the Socketserver by using the template startup file in /init.d/socketserver.
The socketserver runs on port 8000, ensure this is accessible from external (e.g. open your firewall).

Give write access to folders named **pupnp**.

### Cron Jobs
**Weather**:

*/15 * * * * root php -f /path_to_install/cron/datacollector_openweathermap.php &> /dev/null
*/15 * * * * root php -f /path_to_install/cron/datacollector_openweathermap_forecast.php &> /dev/null
*/5 * * * * root php -f /path_to_install/cron/dwd_warning.php &> /dev/null

**Fritzbox callerlist**:

*/10 * * * * root bash /path_to_install/cron/getCallerlistFromFritzbox.sh &> /dev/null

**Garbage**:

0 18,20 * * * root php -f /path_to_install/cron/check_garbageplan.php &> /dev/null
0 1 * * * root php -f /path_to_install/cron/import_garbageplan.php &> /dev/null

**Scheduler**:

*/1 * * * * root php -f /path_to_install/cron/scheduler.php &> /dev/null

**State of network devices**:

*/1 * * * * root php -f /path_to_install/cron/ping.php &> /dev/null

**DLNA Device Scan**:

*/5 * * * * root curl -s http://yourhostname/tablet/includes/pupnp/cronjob.php &> /dev/null

**Check Batteries**:

0 8,20 * * * root php -f /path_to_install/cron/check_batteries.php &> /dev/null

**Collect data from PVServer**:

*/5 * * * * root php -f /path_to_install/cron/datacollector_pvserver.php

**Power meter**:

*/5 * * * * root bash  /path_to_install/cron/datacollector_mt681.sh /dev/ttyUSB0 http://yourhostname/helper/datacollector.php

**Push phonecalls**:

*/10 * * * * root php -f /path_to_install/cron/check_phonecalls.php &> /dev/null 

## Compatibility List

Currently the following devices are supported:

### Actuators:
* Homematic HM-LC-Sw1PBU-FM
* Homematic HM-LC-Bl1PBU-FM
* Homematic HM-TC-IT-WM-W-EU
* Homematic HM-ES-PMSw1-Pl
* Homematic HM-LC-SW1-FM
* Homematic HM-Sec-TiS
* Homematic HM-SEC-SC-2

### Weather Stations
* Froggit WH1080

### Photovoltaics
* PVserver

### Power Meter / Energy Meter
* Iskra MT681

### Lawn Sprinkler
* Gardena selfbuild via Raspberry PI GPIO
