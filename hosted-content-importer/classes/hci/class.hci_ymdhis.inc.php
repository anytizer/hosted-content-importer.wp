<?php
class hci_ymdhis
{
	function age($seconds=0)
	{
		$hours = $seconds/(60 * 60);
		$hours_int = str_pad(floor($hours), 2, '0', STR_PAD_LEFT);
		$minutes_int = str_pad(ceil(($hours-$hours_int)*60), 2, '0', STR_PAD_LEFT);
		return $hours_int.':'.$minutes_int;
	}
}
