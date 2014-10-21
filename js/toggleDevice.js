var timeout = null;

function toggleDevice(device_id, d_identifier, type, value) {
	var cmdurl = "./helper-client/fhem.php?cmd=set";

	var mygetrequest = new ajaxRequest();
    mygetrequest.onreadystatechange=function()
    {
        if (mygetrequest.readyState == 4) 
        {
            if (mygetrequest.status == 200 || window.location.href.indexOf("http") == -1) 
            {
                var thisdoc = document.getElementById("result")
                if(thisdoc != null)
                    thisdoc.innerHTML = mygetrequest.responseText;
            }
        }
    }

	if(type == "Temperaturregelung") 
	{
		disableValueRefreshForDeviceID = device_id;

		var reading = "desired-temp";
		d_identifier += '_Climate';

		var stepsize = 0.5; // TBD: configure & take out of database

		var setvalue = $("input[name=solltemp"+device_id+"]").val();
		var currentvalue = $("input[name=isttemp"+device_id+"]").val();
		// if there is no connection to the websocket, do nothing
		if(currentvalue == "---" || currentvalue == "NaN")
			return false;

		if(timeout) window.clearTimeout(timeout);

		if(value == "up")
		{
			if(setvalue == "off")
				setvalue = 4.5;

			setvalue = parseFloat(setvalue) + parseFloat(stepsize);

			if(setvalue >= 30.0)
				setvalue = 30.0;

			setvalue = setvalue.toFixed(1);
		}
		else if(value == "down")
		{
			if(currentvalue == "off" || setvalue == "off")
			{
				setvalue = 4.5;
			}

			if(setvalue <= 5.0)
				setvalue = "off";
			else
			{
				setvalue = parseFloat(setvalue) - parseFloat(stepsize);
				setvalue = setvalue.toFixed(1);
			}
		}

		$("input[name=solltemp"+device_id+"]").val(setvalue);

		timeout = setTimeout(function() {
			mygetrequest.open("GET", cmdurl+"&device="+d_identifier+"&value="+setvalue+"&reading="+reading, true);
    		mygetrequest.send(null);
    		setTimeout(function() { disableValueRefreshForDeviceID = null; }, 3000);
    	}, 2000);
	}
	else if(type == "Jalousie") 
	{
		if(timeout) window.clearTimeout(timeout);

		if(value != "on" && value != "off" && value != "stop")
		{
			var direction = value;
			var reading = "pct";

			var stepsize = 5; // TBD: configure & take out of database

			var el_soll = document.getElementsByName("jalousievalue" + device_id)[0];
			var el_ist = document.getElementsByName("jalousiecurvalue" + device_id)[0];

			if(direction == "up")
			{
				value = parseInt(el_soll.value) + parseInt(stepsize);
				if(value > 100)
					value = 100;

				el_soll.value = value;
			}
			else if(direction == "down")
			{
				value = parseInt(el_soll.value) - parseInt(stepsize);
				if(value < 0)
					value = 0;

				el_soll.value = value;
			}
			else
				el_soll.value = value;

			setvalue = el_soll.value;

			timeout = setTimeout(function() {
				mygetrequest.open("GET", cmdurl+"&device="+d_identifier+"&value="+setvalue+"&reading="+reading, true);
				mygetrequest.send(null);
	    	}, 2000);
		}
		else
		{
			var setvalue = value;

			timeout = setTimeout(function() {
				mygetrequest.open("GET", cmdurl+"&device="+d_identifier+"&value="+setvalue, true);
				mygetrequest.send(null);
    		}, 2000);
		}
	}
	else if(type == "Dimmer") 
	{
		if(timeout) window.clearTimeout(timeout);

		var el_soll = document.getElementById("slider_value" + device_id);

		el_soll.value = value;

		value = "dim"+value+"%";

		mygetrequest.open("GET", cmdurl+"&device="+d_identifier+"&value="+value, true);
		mygetrequest.send(null);
	}
	else if(type == "Raspberry Pi GPIO") 
	{
		var el_raspi_address = document.getElementById("gpio_raspi_address" + device_id);
		var el_outputpin = document.getElementById("gpio_outputpin" + device_id);
		var protocol = document.getElementById("gpio_raspi_protocol" + device_id);

		// TODO: check if call is localhost then do call without wrapper
		cmdurl = "./helper-client/gpio_wrapper.php?cmd=set&protocol="+protocol.value+"&remote_addr="+el_raspi_address.value+"&pin="+el_outputpin.value+"&value="+value+"&identifier="+d_identifier;

		mygetrequest.open("GET", cmdurl, true);
        mygetrequest.send(null);

        toggleModal(device_id,type);
	}
	else
	{
		mygetrequest.open("GET", cmdurl+"&device="+d_identifier+"&value="+value, true);
    	mygetrequest.send(null);

    	toggleModal(device_id,type);
	}
	
	return false
}