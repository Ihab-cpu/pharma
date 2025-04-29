<?php
    $global_arr = array();
	$domain = $_SERVER['HTTP_HOST'];
	$price_for_discount = 200;
	$discount = 5;
	session_start();
	$id_pack = $_POST['id_pack'];
	$path = './../system/';
	include('./../defines.php');
	include(INC_DIR . '/read_ser_arr.php');
	include(INC_DIR . '/my_set_cookie.php');
	include(INC_DIR . '/php2js.php');
	include(INC_DIR . '/my_arr2json.php');
	include(INC_DIR . '/my_json2arr.php');
	
	include(INC_DIR . '/my_create_order_str.php');
	include(INC_DIR . '/my_get_order_array.php');
	
	include(DB_DIR . '/bonus_arr.php');
	include(INC_DIR . '/get_bonus_arr.php');
	
	
	
	$cookies_unser_order_arr['order'] = my_get_order_array($_COOKIE['order']);
	$cookies_unser_order_arr['order'][$id_pack][3] = $_POST['to'] + $cookies_unser_order_arr['order'][$id_pack][3];
	
	$config_path = CONFIG_DIR . '/global.php';
	$config_array = read_ser_arr($config_path, 1);
	
	// CONFIG FOR DEVELOP MODE *** #2
	$currency = $_COOKIE['currency'];
	$order_total_count = 0;
	$order_total_price = 0;
	if ( isset($cookies_unser_order_arr['order']) && count($cookies_unser_order_arr['order']) > 0 ) {
		foreach ( $cookies_unser_order_arr['order'] as $k => $v ) {
			$order_total_count += $v[3];
			$order_total_price += $v[4] * $v[3];
		}
	}
	$order_str = my_create_order_str($cookies_unser_order_arr['order']);
	my_set_cookie('order', $order_str, SECONDS_IN_YEAR);
	
	// disciunt shipping
	$air_mail_price = 14.95;
	$ems_price = 24.95;
	if ( ($order_total_price) > 200 ) {
		$config_array['shipping']['AirMail'] = $air_mail_price = 0;
		$config_array['shipping']['EMS'] = $ems_price = 14.95;
	}
	if ( ($order_total_price) > 300 ) {
		$config_array['shipping']['AirMail'] = $air_mail_price = 0;
		$config_array['shipping']['EMS'] = $ems_price = 0;
	}
	
	// discount 5%
	$order_total_price_discount = $order_total_price;
	
	if (
		isset($_COOKIE['discount_code']) && validate_discount($_COOKIE['discount_code'])
		||
		$order_total_price > $price_for_discount
	) {
		$order_total_price_discount = $order_total_price - $order_total_price / 100 * 5;
		my_set_cookie('discount_ok', true, SECONDS_IN_YEAR);
		$discount_cookie = true;
	} else {
		my_set_cookie('discount_ok', false, SECONDS_IN_YEAR);
		$discount_cookie = false;
	}
	
	$order_total_price_with_shipping =
		price_handler($order_total_price_discount)
		+
		$config_array['shipping'][$_COOKIE['shipping']]
	;
	
	$out['total_price'] = price_handler($order_total_price);
	
	$out['total_price_discount'] = price_handler($order_total_price_discount);
	$out['total_price_with_shipping'] = ($order_total_price_with_shipping);
	$out['total_price_with_shipping_original'] = round($order_total_price_discount + $config_array['shipping'][$_COOKIE['shipping']], 2);
	$out['discount_ok'] = $discount_cookie;
	
	$out['air_mail_price_original'] = $config_array['shipping']['AirMail'];
	$out['ems_price'] = $config_array['shipping']['EMS'];
	
	$out['ems_price_original'] = $out['ems_price'];
	$out['ems_price'] = price_handler($out['ems_price'], false, 1);
	
	
	$out['air_mail_price'] = price_handler($config_array['shipping']['AirMail'], false, 1);
	
	$bonus_arr = get_bonus_data_arr();
	
    $bonus_arr = get_bonus_arr($order_total_price, $bonus_arr);
	
	$out['bonus'] = $bonus_arr;
	
	$cnt = 0;
	foreach ( $cookies_unser_order_arr['order'] as $k => $v ) {
		$cnt += $v[3];
	}
	$out['total_count'] = $cnt;
	$out = json_encode($out);
	
	// test discount
	
	echo $out;
	die;
	
	
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
    
    
    function p($a) {
		echo '<pre>';
		print_r($a);
		echo '</pre>';
	}
	
	
	function validate_discount($code) {
		//$code = $_SESSION['discount_code'];
	    $valid = false;
	    if ( strlen($code) == 7 ) {
			if ( !is_numeric($code[0]) && !is_numeric($code[1]) ) {
				if ( $code[2] == '-' ) {
					if ( is_numeric($code[3]) && is_numeric($code[4]) && is_numeric($code[5]) && is_numeric($code[6]) ) {
						$digits = substr($code, 3);
						if ( $digits % 2 == 0 ) {
							$valid = true;
						}
					}
				}
			}
		}
		return $valid;
    }
?>
