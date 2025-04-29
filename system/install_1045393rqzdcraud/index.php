<?php
$domain = $_SERVER['HTTP_HOST'];
$folder = $_SERVER['REQUEST_URI'];
$folder = explode('?', $folder);
$folder = $folder[0];
$folder = explode('/', $folder);

foreach ( $folder as $k => $v ) {
	if ( !$v || $v == 'index.php' || $v == 'system' || is_numeric(strpos($v, 'install')) ) {
		unset($folder[$k]);
	}
}
$flagInFolder = 0;
function install_in_folder_detect($folder) {
	if ( count($folder) > 0 ) {

		return true;
	}
}
if ( install_in_folder_detect($folder) ) {
	$flagInFolder = 1;
}
$errors_arr = array();
// test writeble of .htaccess
$writeHTAFlag = true;

if ( $flagInFolder ) {

	$writeHTAFlag = false;
	$fPath = './../../.htaccess';
	$a = @file_get_contents($fPath);

	if ( !is_numeric(strpos($a, '###')) ) {
		$a = $a . "\n###";

		file_put_contents($fPath, $a);
	}

	$a = @file_get_contents($fPath);
	if ( is_numeric(strpos($a, '###')) ) {
		$writeHTAFlag = true;
	}

}

// clear $_COOKIE
if ( empty($_POST['private_folder']) ) {
	foreach ( $_COOKIE as $k => $v ) {
		setcookie($k, '', time() - 1, '/');
	}
}
$folder = '/' . implode('/', $folder);

$rd = './../../';
$path = './../../system/';
include('./../../defines.php');
#echo PRIVATE_SECRET_FOLDER . '<br>';
define ('SMARTY_DIR', './../../system/' . PRIVATE_SECRET_FOLDER . '/smarty/smarty-2.6.30/libs/');
require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty();
$smarty->template_dir = './';
$smarty->compile_dir = './../../system/' . PRIVATE_SECRET_FOLDER . '/smarty_template_c/';
$smarty->compile_id = 'install_';


$folderTmp = $folder;
if ( $flagInFolder ) {
	$folderTmp = $folderTmp . '/';
}
$smarty->assign('relatiive_path', $folderTmp);
install();
function install() {
	global $smarty, $folder, $flagInFolder, $writeHTAFlag;
	//var_dump($writeHTAFlag);
	$errors_arr = array();
	// mod rew check
	//ob_end_flush();
	/*
	ob_start();
	phpinfo(8);
	$inf = ob_get_contents();
	ob_end_clean();
	// mr_test
	if (preg_match('/Loaded Modules.*mod_rewrite/i', $inf)) {
		 //$errors_arr[] = '<br><span style="color:green">mod rewrite supported</span><br><br>';
	} else {
		$errors_arr[] = 'no mod rewrite';
	}
	*/
	$on_detect = 1;
	$smarty->assign('secret_folder', PRIVATE_SECRET_FOLDER);
	$rwDirs = array(
			'./../install/',
			'./../../system/' . PRIVATE_SECRET_FOLDER,
			'./../../system/' . PRIVATE_SECRET_FOLDER . '/smarty_template_c/',
			'./../../system/' . PRIVATE_SECRET_FOLDER . '/db/',
			'./../../system/' . PRIVATE_SECRET_FOLDER . '/db/orders/',
			'./../../system/' . PRIVATE_SECRET_FOLDER . '/db/logs/',
			'./../../system/' . PRIVATE_SECRET_FOLDER . '/db/info/',
			'./../../system/' . PRIVATE_SECRET_FOLDER . '/db/feed_back/',
			'./../../system/' . PRIVATE_SECRET_FOLDER . '/db/shop_db/',
			'./../../system/' . PRIVATE_SECRET_FOLDER . '/db/update/',
			'./test_rename_folder/',
			'./../../system/images/',
	);
	$rwFiles = array(
			'./../../system/' . PRIVATE_SECRET_FOLDER . '/db/logs/log.txt',
		//'./../../.htaccess',
			'./../../system/' . PRIVATE_SECRET_FOLDER . '/config/domains.txt',
			'./../../templates/global/counter.tpl',
	);
	foreach ( $rwDirs as $k => $v ) {
		chmod($v, 0755);
		$pdir = decoct(fileperms($v));
		$per = substr($v, -3);
	}

	if ( !$writeHTAFlag ) {
		$errors_arr[] =  '.htaccess not writable - ./../../.htaccess<br>';
	}

	foreach ( $rwFiles as $k => $v ) {
		chmod($v, 0755);
		if ( !is_writable($v) ) {
			$errors_arr[] =  'Set 777 permission for file ' . $v . '<br>';
		}
	}
	foreach ( $rwDirs as $k => $v ) {
		if ( !is_writable($v) ) {
			$errors_arr[] =  'Set 777 permission for dir ' . $v . '<br>';
		}
	}
	if ( strlen($folder) > 1 && $folder[strlen($folder)] != '/' ) {
		$folder = $folder . '/';
	}
	if ( $flagInFolder && $folder != '/' ) {
		$ht = @file_get_contents('./htaccess_folder.htaccess');
		$ht = str_replace('{$$$$$}', $folder, $ht);
		file_put_contents('./../../.htaccess', $ht);
		$f = fopen('./../../base_dir.dat', 'w+');
		fwrite($f, $folder);
		fclose($f);
	}
	$page_link = 'http://' . $_SERVER['HTTP_HOST'] . $folder . 'contact?xxx';
	$page = @file_get_contents($page_link);
	if ( !is_numeric(strpos($page, '/contact/?image')) && $_SERVER['REQUEST_METHOD'] != 'POST' && empty($_GET['success']) ) {
		echo ('<div style="color:red">No mod_rewrite. Can not open <a href="' . $page_link . '" target="_blank">' . $page_link . '</a></div>');
	}
	test_user_rights($rwDirs, $rwFiles);
	$smarty->assign('erros_arr', $errors_arr);
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		if ( empty($_POST['password']) ) {
			$errors_arr[] = 'Empty password';
		}
		if (
				empty($_POST['partner_id'])
				||
				!is_numeric($_POST['partner_id'])
				||
				strlen($_POST['partner_id']) < 1
				||
				strlen($_POST['partner_id']) == 2
				||
				strlen($_POST['partner_id']) > 4
		) {
			$errors_arr[] = 'Bad partner ID';
		}
		if ( empty($_POST['private_folder']) ) {
			$errors_arr[] = 'Empty Private folder name';
		} else if ( substr($_POST['private_folder'], 0, 8) != 'private_' ) {
			$errors_arr[] = 'Private folder error format';
		}
		// Install in folder .htaccess rules

		if ( count($errors_arr) == 0 ) {
			$private_folder_dir = './../../system/';
			/*
			if ( $folder == '/' ) {
				//$folder = '';
				//$ht = @file_get_contents('./htaccess_index.htaccess');
			} else {

			}
			*/


			// rename secret folder
			rename($private_folder_dir. PRIVATE_SECRET_FOLDER, $private_folder_dir . $_POST['private_folder']);

			include($private_folder_dir . $_POST['private_folder'] . '/inc/read_ser_arr.php');
			include($private_folder_dir . $_POST['private_folder'] . '/inc/write_ser_arr.php');
			$global_config_path = $private_folder_dir . $_POST['private_folder'] . '/config/global.php';
			$f = fopen($private_folder_dir . $_POST['private_folder'] . '/config/domains.txt', 'w+');
			fclose($f);
			$a = read_ser_arr($global_config_path, 1);
			$a['password'] = md5($_POST['password']);
			$a['partner_id'] = $_POST['partner_id'];
			// change config file
			// set md5 password
			// set partner id
			write_ser_arr($global_config_path, $a, 1);
			header('Location: ?success=1');
			die;
		} else {
			$smarty->assign('erros_arr', $errors_arr);
		}
	}
}

function test_user_rights($rwDirs, $rwFiles) {
	if ( !is_dir('./test_rename_folder') ) {
		return true;
	}
	$d = './test_rename_folder';
	$d2 = './test_rename_folder_2/';
	$f = './test_rename_folder_2/1.txt';
	$f2 = './test_rename_folder_2/2.txt';
	@rename($d, $d2);
	$die_flag = 0;
	if ( !is_dir($d2) ) {
		/*
		echo '<b style="color:red">Can not rename folders:</b><br>';
		foreach ( $rwDirs as $k => $v ) {
			if ( !is_writable($v) ) {
				$v = str_replace('./..', '', $v);
				echo $v . '<br>';
			}

		}
		*/
		$die_flag = 1;

	}
	@rename($f, $f2);
	if ( !is_file($f2) ) {
		/*
		echo '<b style="color:red">Can not rename files:</b><br>';

		foreach ( $rwFiles as $k => $v ) {
			if ( !is_writable($v) ) {
				$v = str_replace('./..', '', $v);
				echo $v . '<br>';
			}
		}
		*/
		$die_flag = 1;
	}
	@rename($f2, $f);
	@rename($d2, $d);
	if ( $die_flag ) {
		echo '
			<h2 style="color:red">Bad permission</h2>
			<span style="font-size:18px;">Please set "apache" owner to &laquo;/install&raquo; and &laquo;/system&raquo; folders</span>
			';
		die();
	}
}

function p($a) {
	echo '<pre>';
	print_r($a);
	echo '</pre>';
}
$smarty->display('install.tpl');