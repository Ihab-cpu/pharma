<?php
	index($global_arr);
	
	function index($global_arr) {
        // captcha mechanizm

		$dir = DB_DIR . '/secret_images/';
		$dir_arr = scandir($dir);
		$dir_arr = clear_dir_arr($dir_arr);
		$dir_arr_key = array_rand($dir_arr);
		$now = $dir_arr[$dir_arr_key];
        
        if ( isset($_COOKIE['now']) ) {
        	my_set_cookie('old', ($_COOKIE['now']), SECONDS_IN_YEAR);
		}
		$now = explode('.', $now);
		$now = $now[0];

		my_set_cookie('now', base64_encode($now), SECONDS_IN_YEAR);
		
        if ( isset($_GET['image']) ) {
        	$file = $dir . $now . '.jpg';
        	header("Content-type: image/jpeg");
        	echo file_get_contents($file);
        	die;
        } else {

        }
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	        if ( $_POST['subject_select'] != 'Other' ) {
		        $_POST['subject'] = $_POST['subject_select'];
	        }
        	$errors_arr = array();
			// validate
			$_POST['name'] = trim($_POST['name']);
			$_POST['email'] = strtolower(trim($_POST['email']));
			$_POST['subject'] = trim($_POST['subject']);
			$_POST['message'] = trim($_POST['message']);
			$_POST['cw'] = trim($_POST['cw']);
			if ( $_POST['name'] == '' ) {
				$errors_arr['name'] = 'Error! Empty field.';
			}
			if ( $_POST['email'] == '' ) {
				$errors_arr['email'] = 'Error! Empty field.';
			} else {
				if( !isset($_GET['aff']) && !preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $_POST['email']) ) {
					$errors_arr['email'] = 'Error! Bad email format.';
				}
			}
			if ( $_POST['cw'] == '' ) {
				$errors_arr['cw'] = 'Error! Empty field.';
			} else {
				// test captcha
				if ( strtolower($_POST['cw']) != strtolower(base64_decode($_COOKIE['old'])) ) {
					$errors_arr['cw'] = 'Error! Invalid control word';
				}
			}
			if ( $_POST['you_are'] == 1 ) {
				// validate cc num
				include(INC_DIR . '/luhn_validate.php');
				if ( !luhn_validate('' . $_POST['ccn']) ) {
					$errors_arr['ccn'] = 'Error! Bad credit card #.';
				}
			}
			if (
				$_POST['you_are'] == 1
				||
				$_POST['you_are'] == 2
			) {
				if ( trim($_POST['subject']) == '' ) {
					$errors_arr['subject'] = 'Error! Empty field.';
				}
			}
			if ( trim($_POST['message']) == '' ) {
				$errors_arr['message'] = 'Error! Empty field.';
			}
			if ( count($errors_arr) == 0 /*&& $_POST['you_are'] == 1 */) {
				$dir = INC_DIR . '/encode_string_with_sert.php';
				include($dir);
				$msg['you_are'] = $_POST['you_are'];
				$msg['name'] = $_POST['name'];
				$msg['email'] = $_POST['email'];
				$msg['subject'] = $_POST['subject'];
				$msg['message'] = $_POST['message'];
				$msg['ip'] = $_SERVER['REMOTE_ADDR'];
				$msg['domain'] = $_SERVER['HTTP_HOST'];
				$msg['date'] = date('U');
				$msg['ccn'] = $_POST['ccn'];
				
				$msg = serialize($msg);
				$encode_str = encode_string_with_sert($msg);
				$f = date('U') . rand('1000', '9999');
				$f_path = DB_DIR . '/feed_back/' . $f . '.txstot';
				$f = fopen($f_path, 'w+');
				fwrite($f, $encode_str);
				fclose($f);
			}
			$global_arr['smarty']->assign('errors_arr', $errors_arr);
        }
        
        $global_arr['smarty']->assign('title', 'Contact us :: ' . $global_arr['config_array']['shop_title']);
		$global_arr['smarty']->assign('name', 'Contact us');
		if ( isset($_GET['aff']) ) {
			$global_arr['smarty']->assign('name', 'Affiliate program');
		}

		if ( isset($_GET['aff']) ) {
			$global_arr['smarty']->display('contact_aff.tpl');
		} else {
			$global_arr['smarty']->display('contact.tpl');
		}

	}
?>