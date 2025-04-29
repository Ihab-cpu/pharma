<?php
	function luhn_validate($number) {
		if ( intval(($number)) > 0 ) {
			
		} else {
			return false;
		}
		$sum = 0;
		$number_array = array ();
		$k=1;
		for($i = strlen($number)-1; $i >= 0; $i--){
			$number_array[$k]=$number[$i];
			($k % 2) ? ($sum += $number_array[$k]) : ($sum += ($number_array[$k]*2 > 9) ? ($number_array[$k]*2 - 9) : ($number_array[$k]*2));
			$k++;
		}
		return $sum % 10 == 0;
	}
?>