<?php
	define('SECONDS_IN_YEAR', 31536000);
	
	$rndArr = array(
		'B', 'C', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'V', 'W', 'X', 'Y', 'Z', 'A', 'E', 'I', 'O', 'U',
		0,1,2,3,4,5,6,7,8,9
	);

	$ps = array();
	if ( empty($_COOKIE['RNPS']) ) {
		for ( $i = 0; $i < 21; $i++ ) {
			$ps[$i] = $rndArr[array_rand($rndArr)];
		}
		$ps = implode('', $ps);
		setcookie('RNPS', $ps);
	} else {
		$ps = $_COOKIE['RNPS'];
	}
	define('PS', $ps);
	
	if ( empty($rd) ) {
		if ( is_numeric(strpos($_SERVER['REQUEST_URI'], '!admin')) ) {
			$rd  = './../../..';
		} else {
			$rd = ".";
		}
		if ( isset($_POST['ajax']) ) {
			$rd = './../';
		}
	}
	
	define('ROOT_DIR', $rd);
	// constants
	$base_folder = $rd . '/base_dir.dat';
	if ( is_file($base_folder) ) {
		$base_folder = file_get_contents($base_folder);
	} else {
		$base_folder = '/';
	}
	
	/*
	if ( is_file('./base_dir.dat') ) {
		
		if ( !$base_folder ) {
			$base_folder = '/';
		}
	} else {
		$base_folder = '/';
	}
	*/
	define('BASE_FOLDER', $base_folder);
	define('ROOT_URL', BASE_FOLDER);
	
	
	include(ROOT_DIR . '/system/config.php'); // include PRIVATE_SECRET_FOLDER
	
	define('IMAGES_FOLDER', ROOT_DIR . '/images');
	define('TEMPLATES_DIR', ROOT_DIR . '/' . 'templates');
	define('SYSTEM_DIR', ROOT_DIR . '/system');
	define('SMARTY_TEMPLATE_C_DIR', ROOT_DIR . '/' . PRIVATE_SECRET_FOLDER . '/smarty_template_c');
	define('INC_DIR', ROOT_DIR . '/system/' . PRIVATE_SECRET_FOLDER . '/inc');
	define('DB_DIR', ROOT_DIR . '/system/' . PRIVATE_SECRET_FOLDER . '/db');
	define('DB_TICKETS_DIR', ROOT_DIR . '/system/' . PRIVATE_SECRET_FOLDER . '/db/tickets');
	define('DB_SHOP_DIR', DB_DIR . '/shop_db');
	define('DB_NEWS_DIR', DB_DIR . '/news');
	define('CONFIG_DIR', ROOT_DIR . '/system/' . PRIVATE_SECRET_FOLDER . '/config');
	define('CACHE_DIR', ROOT_DIR . '/system/' . PRIVATE_SECRET_FOLDER . '/cache');
	define('DIR_SECRET_FOLDER', ROOT_DIR . '/system/' . PRIVATE_SECRET_FOLDER);
	define('CONTROLLERS_DIR',  BASE_FOLDER . 'system/controllers');
	define('UPDATE_DIR', DB_DIR . '/update');
	
	
	define('FILE_DB_NEWS_SER', DB_DIR . '/news/news_ser.php');
	define('FILE_DB_NEWS_CNT', DB_DIR . '/news/cnt.php');
	define('FILE_DB_NEWS_READ', DB_DIR . '/news/read.php');
	
	define('FILE_DB_TICKETS_SUBJECTS_CNT', DB_DIR . '/tickets/cnt.php');
	define('FILE_DB_TICKETS_SUBJECTS_SER', DB_DIR . '/tickets/subjects_ser.php');
	define('FILE_DB_TICKETS_CLIENTS_NEW_MESSAGES', DB_DIR . '/tickets/subjects_with_client_new_messages.php');
	define('FILE_DB_TICKETS_SUPPORT_MESSAGES', DB_DIR . '/tickets/subjects_with_support_new_messages.php');
	
	define('GLOBAL_CONFIG_PATH', CONFIG_DIR . '/global.php');
	define('PRIVATE_CONFIG_PATH', CONFIG_DIR . '/domains/' . $domain);
	// for admin only
	
	define('ADMIN_ROOT_DIR', ROOT_DIR . '/system/' . PRIVATE_SECRET_FOLDER . '/!admin');
	define('ADMIN_ROOT_URL', ROOT_URL . 'system/' . PRIVATE_SECRET_FOLDER . '/!admin');
	define('ADMIN_CONTROLLERS_DIR', ADMIN_ROOT_DIR . '/controllers');
?>