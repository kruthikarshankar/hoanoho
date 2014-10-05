<?
include dirname(__FILE__).'/..//includes/dbconnection.php';

if(isset($_GET['cmd']))
{
	if($_GET['cmd'] == "set" && isset($_GET['pin']) && isset($_GET['value']))
	{
		$portPresent = file_exists('/sys/class/gpio/gpio'.trim($_GET['pin']));
		if (!$portPresent) {
			// initialize port
			shell_exec('sudo '.getcwd().'/gpio.sh enable out '.trim($_GET['pin']));
		}

		switch (trim($_GET['value'])) {
			case 'on':
				$value = '1';
				break;
			case 'off':
				$value = '0';
				break;
			default:
				$value = trim($_GET['value']);
				break;
		}

		$execution_time = time();

		shell_exec('sudo '.getcwd().'/gpio.sh set out '.trim($_GET['pin']).' '.$value);
		mysql_query("insert into device_data (deviceident, timestamp_unix, timestamp, valuename, value, year, month, day) values ('".$_GET['identifier']."',".$execution_time.", '".date("Y-m-d H:i:s", $execution_time)."', 'gpio_pin_".$_GET['pin']."', '".$value."', ".date('Y', $execution_time).", ".date('m', $execution_time).", ".date('d', $execution_time).")");
	}
	else if($_GET['cmd'] == "get" && isset($_GET['pin']))
	{
		echo exec('cat /sys/class/gpio/gpio'.trim($_GET['pin']).'/value');
	}
}

?>