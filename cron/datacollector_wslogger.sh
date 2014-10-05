#!/bin/bash
# read and evaluate wslogger.pl output from ISKRA MT681 device and queries the middleware

PATH_TO_WSLOGGER='${HOANOHO_DIR}/cron/wslogger.pl'
PATH_TO_WSLOGGER_LOGFILE='/tmp/wslogger.log'


# set serial device
if [[ "$#" -eq  "0" ]]; then
	echo "./datacollector_wslogger <url_to_middleware>"
	echo "e.g:"
	echo "./datacollector_wslogger http://localhost/datacollector.php?"
	exit
fi

if [[ $1 == '' ]]; then
	echo "specify URL to middleware"
	exit
fi

MIDURL=$1

if [[ `ps -efw | grep "perl $PATH_TO_WSLOGGER" | grep -c -v grep` -eq 0 ]]; then
	PATH_TO_PERL=`whereis perl | cut -d" " -f2`
	$PATH_TO_PERL $PATH_TO_WSLOGGER -p 120 > $PATH_TO_WSLOGGER_LOGFILE nohup &
	sleep 5
fi

OUTPUT=`cat $PATH_TO_WSLOGGER_LOGFILE | tail -n 1`

IFS_OLD=$IFS

#Time    : Current time
#%IH     : % Indoor humidity
#%OH     : % Outdoor humidity
#ITÂ°C    : Indoor temp Celsius
#OTÂ°C    : Outdoor temp Celsius
#DPÂ°C    : Outdoor dew point temp Celsius
#WCÂ°C    : Outdoor wind chill temp Celsius
#Wm/s    : Wind speed
#Gust    : Wind gust
#WD      : Wind direction
#1hr     : Rain 1hr
#24hr    : Rain 24hr
#T       : Rain total
#P       : Abs Pressure
valuenames=('Time' 'IH' 'OH' 'IT' 'OT' 'DP' 'WC' 'Wind' 'Gust' 'WindDir' 'Rain1h' 'Rain24h' 'RainTotal' 'P')
valueunits=('' '%' '%' '°C' '°C' '°C' '°C' 'km/h' 'km/h' '' 'l/qm/h' 'l/qm/h' 'l/qm/h' 'hPa')

JSON="{\"Name\":\"wslogger\", \"Timestamp\":\"`echo $OUTPUT | cut -d":" -f1`\", \"Values\": ["

i=0
IFS=':'
for ITEM in $OUTPUT; do
	IFS=$IFS_OLD
	valuename=${valuenames[$i]}
	valueunit=${valueunits[$i]}

	if [[ ${valuenames[$i]} == "Wind" ]] || [[ ${valuenames[$i]} == "Gust" ]]; then
		value=`echo 'scale=1;'$ITEM'*3.6' | bc` # m/s in km/h
	else
		value=$ITEM
	fi

	JSON=$JSON"{ \"Name\":\"$valuename\", \"Value\":\"$value\", \"Unit\":\"$valueunit\"},"
	let i=i+1
done

# remove last , separator
JSON=`echo $JSON | sed 's/,$//'`

IFS=$IFS_OLD

JSON=$JSON"] }"

echo $JSON

curl -i -X POST -d "json=$JSON" $MIDURL &> /dev/null
