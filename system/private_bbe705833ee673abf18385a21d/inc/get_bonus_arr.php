<?php
	function get_bonus_arr($order_total_price, $bonus_arr) {
		if ( $order_total_price > 0 && $order_total_price < 200 || $order_total_price == 200 ) {
			foreach ( $bonus_arr as $k => $v ) {
				$bonus_arr[$k][0] = 2;
			}
        } else if ( $order_total_price > 200 && $order_total_price < 300.001 ) {
			foreach ( $bonus_arr as $k => $v ) {
				$bonus_arr[$k][0] = 4;
			}
        } else {
			foreach ( $bonus_arr as $k => $v ) {
				$bonus_arr[$k][0] = 10;
			}
        }
		return $bonus_arr;
	}
?>