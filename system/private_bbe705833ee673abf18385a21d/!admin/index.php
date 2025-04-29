<?php
	
	global $result;
	$result = false;
	set_time_limit(100000);

    define('SALT', 'fdf423ffdvv3rt4324d232dsasd132');

    $rnad_key = rand(10000, 99999) . rand(10000, 99999);


	//error_reporting(-1);
	
	//error_reporting(0); // off logs for clients
	//ini_set('display_errors', '0'); // off logs for Apache
	header('Content-type: text/html; charset=utf-8');
	/* DOMAIN NAME FOUND START */
	$domain = $_SERVER['HTTP_HOST'];
	/* DOMAIN NAME FOUND END */
	
	// constants
	$path = './../../../system/';
	include('./../../../defines.php');
	include(INC_DIR . '/read_ser_arr.php');
	include(INC_DIR . '/write_ser_arr.php');
	include(INC_DIR . '/clear_dir_arr.php');
	include(INC_DIR . '/file_counter_handler.php');
	include(INC_DIR . '/define_revers.php');
	include(INC_DIR . '/cookie_set.php');
	
	$update_file = UPDATE_DIR . '/update.dat';
	
	if ( !is_file($update_file) && !isset($_GET['need_update']) && ( isset($_GET['act']) && $_GET['act'] != 'enter' ) ) {
		header('Location: ?p=update&need_update=1');
		die;
	}
	
	$config_path = CONFIG_DIR . '/global.php';
	$config_array = read_ser_arr($config_path, 1);
	
	$decode_pass = '';
	if ( !empty($_COOKIE['passUser']) ) {
		$decode_pass = define_revers($_COOKIE['passUser'], PS . SALT, 1);
	}
	// CONFIG FOR DEVELOP MODE *** #3
	// AUTH START
	$global_arr = array(
        'config_array'	=>	$config_array,
        'domain'		=>	$domain,
	);
    $firstAuth = false;
    if ( is_dir(ROOT_DIR . '/system/install/') ) {
        $firstAuth = true;
    }

	include(ADMIN_CONTROLLERS_DIR . '/auth.php');
	if ( !auth_function($global_arr) ) {
		include('./templates/auth.tpl');
		die();
	}
	// Smarty
	define ('SMARTY_DIR', ROOT_DIR . '/system/' . PRIVATE_SECRET_FOLDER . '/smarty/smarty-2.6.30/libs/');
	require_once(SMARTY_DIR . 'Smarty.class.php');
	$smarty = new Smarty(); // new object Smarty
	$global_arr['smarty'] = $smarty;
	$smarty->template_dir = ADMIN_ROOT_DIR . '/templates/default/';
	$smarty->compile_dir = DIR_SECRET_FOLDER . '/smarty_template_c/';
	$smarty->compile_id = 'cms_';
	$smarty->assign('config_array', $config_array);
	$smarty->assign('template_root_path', ADMIN_ROOT_URL . '/templates/default/');
	
	$smarty->assign('BASE_FOLDER', BASE_FOLDER);
	if ( isset($_GET['p']) ) {
		$modul = $_GET['p'];
	} else {
		$modul = 'index';
	}
	// no access without servers end
	$first_enter = 0;
	if ( is_dir(ROOT_DIR . '/system/install/') ) {
		$first_enter = 1;
		$symbols_arr = array('q', 'w', 'e', 'r', 't', 'y', 't', 'u', 'i', 'o', 'p', 'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'z', 'x', 'c', 'v', 'b', 'n', 'm');
		$new_name =
			'system/install_' .
			rand(1000000, 9999999) .
			$symbols_arr[array_rand($symbols_arr)] . 
			$symbols_arr[array_rand($symbols_arr)] . 
			$symbols_arr[array_rand($symbols_arr)] . 
			$symbols_arr[array_rand($symbols_arr)] . 
			$symbols_arr[array_rand($symbols_arr)] . 
			$symbols_arr[array_rand($symbols_arr)] . 
			$symbols_arr[array_rand($symbols_arr)] . 
			$symbols_arr[array_rand($symbols_arr)] . 
			$symbols_arr[array_rand($symbols_arr)]
		;
		if ( !rename(ROOT_DIR . '/system/install/', ROOT_DIR . '/' . $new_name . '/') ) {
            $rename_secret_folder =  '&laquo;install&raquo; folder was not renamed to <b>' . $new_name . '</b>';
            #setcookie('rename_secret_folder', $rename_secret_folder);
			$smarty->assign('global_error', $rename_secret_folder);
		} else {
            setcookie('rename_secret_folder', '&laquo;install&raquo; folder was renamed to <b>' . $new_name . '</b>.  Your shop is ready.');
            header('Location: ?p=update&install_update=1');
            die;
		}
	}

    if ( isset($_COOKIE['rename_secret_folder']) ) {
        $smarty->assign('global_error', $_COOKIE['rename_secret_folder']);
        $smarty->assign('global_error_color_blue', 1);
        setcookie('rename_secret_folder', '', time()-200);
    }
	$modulPath = ADMIN_ROOT_DIR . '/controllers/' . $modul . '.php';
	if ( is_file($modulPath) ) {
		include($modulPath);
	} else {
		die('404');
	}
	/* CONTROLLER HANDLER END */
	die;
	function check_connect($a, $timeout) {
		
		$proxy = explode(':', $a);
		if ( empty($proxy[1]) ) {
			$proxy[1] = 80;
		}
		$fp = @fsockopen($proxy[0], $proxy[1], $errno, $errstr, 3);
		if ( !$fp ) {
			return false;
		}
		$date = time();
		stream_set_timeout($fp, $timeout);
		
		$query = "GET /faq HTTP/1.0\r\nHost: " . $proxy[0] . "\r\n";
		$query .="User-Agent: Isk3Sbn3jSk487GSb3lJSvg34\r\n";
		$query .="\r\n";
		#echo $query;
		#die;
		fwrite ($fp, $query);
		$content ="";
		$cnt = 0;
    	while (!feof($fp)) {
    		$cnt++;
    		$content .= fgets($fp, 4096);
    		if ( time() - $date > $timeout ) {
    			fclose($fp);
    			return false;
				break;
    		}
    		if ( strpos($content, '<end_tag> -->') ) {
				break; 
    		}
		}
		
		fclose($fp);
		if ( !$content ) {
			return false;
		}
		
		$content = str_replace("\r", '', $content);
		$content = explode("\n", $content);
		//p($content);
		if ( !$content[count($content) - 1] ) {
			unset($content[count($content) - 1]);
		}
		$content = $content[count($content) - 1];
		$content = explode('<end_tag>', $content);
		if ( count($content) > 0 && isset($content[1]) && $content[1] > 0 ) {
			return true;
		} else {
			return false;
		}
	}
	
	function p($a) {
		echo '<pre>';
		print_r($a);
		echo '</pre>';
	}
?>