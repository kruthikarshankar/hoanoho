#!/bin/bash
# read and evaluate SML output from ISKRA MT681 device and queries the middleware

PATH_TO_SML_SERVER='/opt/libsml/examples/sml_server'





# set serial device
if [[ "$#" -eq  "0" ]]; then
	echo "./datacollector_mt681 <device> <url_to_middleware>"
	echo "e.g:"
	echo "./datacollector_mt681 /dev/ttyUSB0 http://localhost/datacollector.php?"
	exit
fi

if [[ ! -e $1 ]]; then
	echo "device not found!"
	exit
fi

if [[ $2 == '' ]]; then
	echo "specify URL to middleware"
	exit
fi

INPUT_DEV=$1
MIDURL=$2

#set $INPUT_DEV to 9600 8N1
stty -F $INPUT_DEV 1:0:8bd:0:3:1c:7f:15:4:5:1:0:11:13:1a:0:12:f:17:16:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0:0

OUTPUT=`$PATH_TO_SML_SERVER $INPUT_DEV`

IFS_BAK=$IFS
IFS='
'

JSON="{\"Name\":\"`basename $INPUT_DEV`\", \"Timestamp\":\"`date +%s`\", \"Values\": ["

for line in $OUTPUT; do
	valuename=`echo $line | cut -d" " -f1`
	value=`echo $line | cut -d" " -f2`
	valueunit=`echo $line | cut -d" " -f3`

	if [[ $(echo "if (${value} > 10000.00) 1 else 0" | bc) -eq 1 ]]; then
		value=$(echo "scale=2; $value / 10000" | bc)
		valueunit="k"$valueunit
	fi
	
	JSON=$JSON"{ \"Name\":\"$valuename\", \"Value\":\"$value\", \"Unit\":\"$valueunit\"},"
done

# remove last , separator
JSON=`echo $JSON | sed 's/,$//'`

IFS=$IFS_BAK

JSON=$JSON"] }"

curl -i -X POST -d "json=$JSON" $MIDURL &> /dev/null

