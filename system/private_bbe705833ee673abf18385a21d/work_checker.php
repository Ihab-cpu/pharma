<?php
	//http://shop2/system/private_folder/work_checker.php?phpver=5.0.0
	function p($a) {
		echo '<pre>';
		print_r($a);
		echo '</pre>';
	}


	//rights check
	include('./inc/read_ser_arr.php');
	include('./inc/cover_error_str.php');
	include('./inc/cover_good_str.php');
	$r_w_folders_arr = array(
        './',
        './smarty_template_c/',
        './db/',
        './db/orders/',
        './db/logs/',
        './db/info/',
        './db/feed_back/',
        './db/shop_db/',
        './db/update/',
        './../images/',
	);
	
	// must isset and rw files
	$r_w_files_arr = array(
		'config/global.php',
		'config/global_recovery.php',
		'db/domains/',
		'db/faq/',
	);
	
	$global_config_path = 'config/global.php';
	$config_array = read_ser_arr($global_config_path, 1);
	foreach ( $r_w_folders_arr as $k => $v ) {
		if ( is_writable($v) ) {
			$out_pull_arr[] = cover_good_str($v . ' - ok');
		} else {
			$out_pull_arr[] = cover_error_str($v . ' - not writable');
		}
	}
	if (version_compare(phpversion(), $_GET['phpver'], '<') == true) {
		$out_pull_arr[] = cover_error_str('PHP version - ' . phpversion());
	} else {
		$out_pull_arr[] = cover_good_str('PHP version - ' . phpversion());
	}
	
	
	$ver_of_db = './db/update/ver.txt';
	$ver = file_get_contents($ver_of_db);
	if ( $ver ) {
		$out_pull_arr[] = cover_good_str('DB version - ' . $ver);
	} else {
		$out_pull_arr[] = cover_error_str('Not isset ' . $ver_of_db);
	}
	
	
	
	
	
	// OUTPUT
	foreach ( $out_pull_arr as $k => $v ) {
		echo $v . '<br>';
	}
	p($config_array);
?>