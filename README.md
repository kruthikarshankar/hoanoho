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
Just put these files into your webserver root directory and went through the installer located under **http://yourhostname/install** .

You should also edit the Database credentials in the following files:
js/socketserver.js

### Cron Jobs
Weather:
*/15 * * * * root php -f /var/www/homie/cron/datacollector_openweathermap.php &> /dev/null
*/15 * * * * root php -f /var/www/homie/cron/datacollector_openweathermap_forecast.php &> /dev/null
*/5 * * * * root php -f /var/www/homie/cron/dwd_warning.php &> /dev/null

Fritzbox callerlist:
*/10 * * * * root bash /var/www/homie/cron/getCallerlistFromFritzbox.sh &> /dev/null

Garbage:
0 18,20 * * * root php -f /var/www/homie/cron/check_garbageplan.php &> /dev/null
0 1 * * * root php -f /var/www/homie/cron/import_garbageplan.php &> /dev/null

Scheduler:
*/1 * * * * root php -f /var/www/homie/cron/scheduler.php &> /dev/null

State of network devices:
*/1 * * * * root php -f /var/www/homie/cron/ping.php &> /dev/null

DLNA Device Scan:
*/5 * * * * root curl -s http://yourhostname/tablet/includes/pupnp/cronjob.php &> /dev/null

Check Batteries:
0 8,20 * * * root php -f /var/www/homie/cron/check_batteries.php &> /dev/null


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

## About the Developer Team

#### Daniel Schaefer

Father of Hoanoho, Core Developer

* [Daniel Schaefer aka @gotteshand](http://twitter.com/gotteshand)
* [schaefer2.de](http://schaefer2.de)
