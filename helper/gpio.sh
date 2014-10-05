#!/bin/bash
#
# this script allows www-data user to enable and disable gpio ports as root
#
# required /etc/sudoers Entry:
#  www-data ALL=NOPASSWD:/var/www/hoanoho/helper/shellexec.sh
#
# parameters:
# 1: command (enable/disable/set)
# 2: direction (in/out)
# 3: pinnumber
# 4: value (optional)

case "$1" in
    enable) echo $3 > /sys/class/gpio/export; sleep 1; echo $2 > /sys/class/gpio/gpio$3/direction ;;
    disable) echo $3 > /sys/class/gpio/unexport ;;
	set) echo $4 > /sys/class/gpio/gpio$3/value ;; 
    *) exit 1 ;;
esac

exit 0