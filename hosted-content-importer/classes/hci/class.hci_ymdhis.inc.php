<?php

final class hci_ymdhis
{
	/**
	 * Converts age (in seconds) into HM:MM format
	 * @param int $seconds
	 *
	 * @return string
	 */
	public function age($seconds = 0)
	{
		$hours = $seconds / (60 * 60);
		$hours_int = floor($hours);
		$minutes_int = ceil(($hours - $hours_int) * 60);

		return str_pad($hours_int, 2, '0', STR_PAD_LEFT) . ':' . str_pad($minutes_int, 2, '0', STR_PAD_LEFT);
	}
}
