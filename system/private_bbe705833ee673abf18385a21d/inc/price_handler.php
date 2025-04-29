<?php
	/**
    * function for add add to the price and coefficient of inflation
    * 
    * @param mixed $a price for modify
    */
    function price_handler($a, $flag = false, $noAdd = false) {
    	global
    		$config_array,
    		$currency,
    		$lang
    	;
    	
    	// extra charge
    	if ( $noAdd ) {
			$add = 0;
    	} else {
			$add = $config_array['extra_charge'];
    	}
    	
    	
    	if ( isset($_GET['dbg']) ) {
			echo $a .  ' | ' . $add . ' | ' . $config_array['extra_charge'] . '<br>';
    	}
    	
    	
    	$currency_add_coeff = $config_array['currency'][$currency][0];
    	
    	$multiplier = $config_array['multiplier']; // coeff of inflation
    	if ( $flag == 1 ) {
    		$a = ( $a + $a * $add / 100 ) * $multiplier;
			return $a;
    	}
        $a = ( $a + $a * $add / 100 ) * $multiplier * $currency_add_coeff;
        $a = round($a, 2);
        return $a;
    }
?>