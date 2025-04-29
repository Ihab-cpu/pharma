<?php
	/**
	* date format: 
	* 
	* @param mixed $date1 - date start
	* @param mixed $date2 - date start 2
	* @param mixed $date3 - date start
	* @param mixed $date4 - date start 2
	*/
	function comparison_dates($date1, $date2, $date3, $date4) {
		if (
			$date1[0] == $date1[0] && $date1[1] == $date2[1] && $date1[2] == $date2[2]
			&&
			$date3[0] == $date4[0] && $date3[1] == $date4[1] && $date3[2] == $date4[2]
		) {
			return true;
		} else {
			return false;
		}
	}
?>