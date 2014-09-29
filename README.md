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