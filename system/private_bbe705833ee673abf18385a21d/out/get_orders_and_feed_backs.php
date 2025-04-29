<?php
	$out_arr = array();
	$date_u = date('U');
	// Second for not get old orders
	if ( isset($_GET['seconds']) ) {
		$date_u -= $_GET['seconds'];
	}
	error_reporting(0);
	header('Content-Type: text/plain');
	$dir_orders = './../db/orders/';
	$dir_feed_backs = './../db/feed_back/';
	
	
	if ( isset($_GET['delete_old_feed_backs']) ) {
		$fb = $_GET['delete_old_feed_backs'];
		$fb_arr = explode(';', $fb);
		//print_r($fb_arr);
		foreach ( $fb_arr as $k => $v ) {
			if ( $v ) {
				$f = $dir_feed_backs . $v;
				if ( is_file($f) ) {
					unlink($f);
				}
			}
		}
	}
	if ( isset($_GET['delete_old_orders']) ) {
		$orders = $_GET['delete_old_orders'];
		$orders_arr = explode(';', $orders);
		foreach ( $orders_arr as $k => $v ) {
			if ( $v ) {
				$f = $dir_orders . $v;
				if ( is_file($f) ) {
					unlink($f);
				}
			}
		}
	}
	if ( isset($_GET['delete_old_orders']) || isset($_GET['delete_old_feed_backs']) ) {
		echo 'deleted';
		die;
	}
	
	$dir_with_orders = scandir($dir_orders);
	
	foreach ( $dir_with_orders as $k => $v ) {
		if ( $v == '.' || $v == '..' ) {
			unset($dir_with_orders[$k]);
		} else {
			// check date
			if ( $date > $date_u ) {
				$out_arr['orders'][$date][] = file_get_contents($dir_orders . $v);
				$out_arr['orders_names'][$date][] = $v;
				$out_arr['orders_dates'][$date] = date('Y-m-d', $date);
			}
			
		}
	}
	$dir_with_feed_backs = scandir($dir_feed_backs);
	$oblom = false;
	foreach ( $dir_with_feed_backs as $k => $v ) {
		if ( $v == '.' || $v == '..' ) {
			unset($dir_with_feed_backs[$k]);
		} else {
//			if ( !is_writable($dir_feed_backs . $v) ) {
//				$oblom = true;
//				break;
//			}
			$date = substr($v, 0, strlen($v) - 8);
			if ( $date > $date_u ) {
				$out_arr['feed_backs'][$date] = file_get_contents($dir_feed_backs . $v);
				$out_arr['feed_backs_names'][$date] = $v;
			}
		}
	}
	$out_arr = serialize($out_arr);
	
	//echo '<pre>';
	//print_r($out_arr);
	echo $out_arr;
	$out_arr = unserialize($out_arr);
	//print_r($out_arr);
	//die;
	echo '***end***';
	if ( count($dir_with_feed_backs) > 0 ) {
		foreach ( $dir_with_feed_backs as $k => $v ) {
			//if ( !$oblom ) {
			unlink($dir_feed_backs . $v);
			//}
		}
	}
	die;
	// DELETE TODO
	// TIME LIMIT TODO
?>