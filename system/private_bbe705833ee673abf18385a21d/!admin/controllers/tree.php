<?php

index($global_arr);

function createCustomSerArr($f_path, $f_path_custom) {
	if ( !is_file($f_path_custom) ) {
		//$a = file_get_contents($f_path);
		//file_put_contents($f_path_custom, $a);
		copy($f_path, $f_path_custom);
		//die;
	}
}

function index($global_arr) {
	$f_path = DB_SHOP_DIR . '/tree_ser.php';
	$tree_pills_arr = @read_ser_arr($f_path, true);

	$f_path_custom = DB_SHOP_DIR . '/!custom_relations/tree_ser_custom.php';
	createCustomSerArr($f_path, $f_path_custom);

	$tree_pills_arr_custom = @read_ser_arr($f_path_custom, true);
	if ( !empty($_GET['bestseller']) ) {
		// find in tree this
		// if item in bestsellers => nothng
		//if ( !isset($tree_pills_arr['Bestsellers'][$_GET['bestseller']]) ) {
		$flag = false;
		$key = '';
		foreach ($tree_pills_arr as $k => $v) {
			foreach ($v as $k2 => $v2) {
				if ($_GET['bestseller'] == $k2) {
					$flag = $v2;
					$key = $k2;
					break;
				}
			}
		}
		if ($flag) {
			// test if isset => unset
			if (isset($tree_pills_arr_custom['Bestsellers'][$key])) {
				unset($tree_pills_arr_custom['Bestsellers'][$key]);
			} else {
				$tree_pills_arr_custom['Bestsellers'][$key] = $flag;
			}
			write_ser_arr($f_path_custom, $tree_pills_arr_custom, 1);
			if (isset($_GET['ajax'])) {
				echo 1;
				die;
			}
			//}
		}
	}
	if ( !empty($_GET['up']) ) {
		//p($tree_pills_arr_custom[$_GET['for']]);
		$tmp = array_keys($tree_pills_arr_custom[$_GET['for']]);
		$flag = false;
		foreach ( $tmp as $k => $v ) {
			if (
				$v == $_GET['up']
				&&
				$k != 0
			) {
				$tmp2 = $tmp[$k-1];
				$tmp[$k] = $tmp2;
				$tmp[$k - 1] = $v;
				$flag = true;
				break;
			}
		}
		if ( $flag ) {
			foreach ( $tmp as $k => $v ) {
				$custom[$v] = $tree_pills_arr_custom[$_GET['for']][$v];
			}
			$tree_pills_arr_custom[$_GET['for']] = $custom;
			write_ser_arr($f_path_custom, $tree_pills_arr_custom, 1);
			if ( isset($_GET['ajax']) ) {
				echo 1;
				die;
			}
		}
	}
	if ( !empty($_GET['down']) ) {
		//p($tree_pills_arr_custom[$_GET['for']]);
		$tmp = array_keys($tree_pills_arr_custom[$_GET['for']]);
		$flag = false;
		foreach ( $tmp as $k => $v ) {
			if (
				$v == $_GET['down']
				&&
				$k != count($tmp)
			) {
				$tmp2 = $tmp[$k+1];
				$tmp[$k] = $tmp2;
				$tmp[$k + 1] = $v;
				$flag = true;
				break;
			}
		}
		if ( $flag ) {
			foreach ( $tmp as $k => $v ) {
				$custom[$v] = $tree_pills_arr_custom[$_GET['for']][$v];
			}
			$tree_pills_arr_custom[$_GET['for']] = $custom;
			write_ser_arr($f_path_custom, $tree_pills_arr_custom, 1);
			if ( isset($_GET['ajax']) ) {
				echo 1;
				die;
			}
		}
	}
	if ( is_file($f_path_custom) ) {
		$tree_pills_arr_custom = @read_ser_arr($f_path_custom, true);
		$tree_pills_arr_old = $tree_pills_arr;
		$tree_pills_arr = $tree_pills_arr_custom;
	}


	//p($tree_pills_arr);
	//die;
	unset($tree_pills_arr['ED Sample Packs']);
	$off_arr = explode(',', $global_arr['config_array']['goods_off']);
	foreach ( $off_arr as $k => $v ) {
		$off_arr_keys[$v] = $v;
	}
	if ( is_array($tree_pills_arr) > 0 ) {
		foreach ( $tree_pills_arr as $k => $v ) {
			foreach ( $v as $k2 => $v2 ) {
				if ( array_key_exists($k2, $off_arr_keys) ) {
					unset($tree_pills_arr[$k][$k2]);
				}
			}
		}
	}
	unset($tree_pills_arr['template']);


	if ( isset($_GET['getDescription']) ) {
		echo getDescription($tree_pills_arr, $_GET['getDescription']);
		die;
	}

	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

		// if changed
		$pill_descr = getDescription($tree_pills_arr,  $_POST['pill_name']);
		$pill_descr = json_decode($pill_descr, 1);



		if (
				$pill_descr['small_descr'] !== $_POST['small_description_en']
				||
				$pill_descr['full_descr'] != $_POST['full_description_en']
				||
				$pill_descr['small_descr_de'] != $_POST['small_description_de']
				||
				$pill_descr['full_descr_de'] != $_POST['full_description_de']
				||
				$pill_descr['small_descr_fr'] != $_POST['small_description_fr']
				||
				$pill_descr['full_descr_fr'] != $_POST['full_description_fr']
				||
				$pill_descr['small_descr_es'] != $_POST['small_description_es']
				||
				$pill_descr['full_descr_es'] != $_POST['full_description_es']
				||
				$pill_descr['small_descr_it'] != $_POST['small_description_it']
				||
				$pill_descr['full_descr_it'] != $_POST['full_description_it']
		) {
			foreach ( $tree_pills_arr as $k => $v ) {
				foreach ($v as $k2 => $v2) {
					if ( $k2 == $_POST['pill_name'] ) {
						$path = $k . '/' . $k2;
						$path = DB_SHOP_DIR . '/' . strtolower($path) . '/ser.php';
						$item = file_get_contents($path);
						$item = unserialize($item);
						unset($item['name']);
						unset($item['min_price']);
						unset($item['pack_name']);
						unset($item['type']);
						unset($item['analogs']);
						unset($item['active_ingredients']);
						unset($item['packings']);
						//p($item);
						$item['small_descr'] = $_POST['small_description_en'];
						$item['full_descr'] = $_POST['full_description_en'];
						$item['small_descr_de'] = $_POST['small_description_de'];
						$item['full_descr_de'] = $_POST['full_description_de'];
						$item['small_descr_fr'] = $_POST['small_description_fr'];
						$item['full_descr_fr'] = $_POST['full_description_fr'];
						$item['small_descr_es'] = $_POST['small_description_es'];
						$item['full_descr_es'] = $_POST['full_description_es'];
						$item['small_descr_it'] = $_POST['small_description_it'];
						$item['full_descr_it'] = $_POST['full_description_it'];

						$item = serialize($item);
						$path = DB_SHOP_DIR . '/!custom_relations/' . strtolower($k2);
						if ( !is_dir($path) ) {
							mkdir($path);
						}

						if ( !is_dir($path) ) {
							echo 'Can not create folder';
							echo $path;
							echo "\r\n";
							var_dump(is_dir($path));
							die;
						}


//							$path .= '/' . strtolower($k2);
//							if ( !is_dir($path) ) {
//								mkdir($path);
//							}
						$path .= '/ser.php';
						file_put_contents($path, $item);
					}
				}
			}
		}
		echo 1;
		die;
	}

	if ( isset($_GET['visible']) ) {
		$off_flag = 'off';
		if ( isset($global_arr['config_array']['goods_off2']) ) {
			$off_user_dark = $global_arr['config_array']['goods_off2'];
			$off_user_dark = explode(',', $off_user_dark);
			if ( in_array($_GET['visible'], $off_user_dark) ) {
				foreach ( $off_user_dark as $k => $v ) {
					if ( $v == $_GET['visible'] ) {
						unset($off_user_dark[$k]);
						$off_flag = 'on';
					}
				}
				//$off_user_dark = $tmp;
			} else {
				$off_user_dark[] = $_GET['visible'];
			}

		} else {
			$off_user_dark = array();
			$off_user_dark[] = $_GET['visible'];
		}
		if ( is_array($off_user_dark) ) {
			$off_user_dark = array_unique($off_user_dark);
		}
		foreach ( $off_user_dark as $k => $v ) {
			if ( !$v ) {
				unset($off_user_dark[$k]);
			}
		}
		$global_arr['config_array']['goods_off2'] = implode(',', $off_user_dark);
		write_ser_arr(GLOBAL_CONFIG_PATH, $global_arr['config_array'], true);
		if ( isset($_GET['ajax']) ) {
			echo $off_flag;
			die;
		}
	}

	$off_tmp = $global_arr['config_array']['goods_off2'];
	$off_tmp = explode(',', $off_tmp);
	foreach ( $off_tmp as $k => $v ) {
		$off[$v] = $v;
	}

	$global_arr['smarty']->assign('name', 'Tree');
	$global_arr['smarty']->assign('off_arr', $off);
	$global_arr['smarty']->assign('tree_pills_arr_old', $tree_pills_arr_old);
	$global_arr['smarty']->assign('result_arr', $tree_pills_arr);

	unset($off_tmp);
	unset($tree_pills_arr);
	unset($off_user_dark);
	unset($tree_pills_arr);
	unset($off_arr);
	unset($off_arr_keys);
	$global_arr['smarty']->display('tree.tpl');
}


function getDescription($tree_pills_arr, $itemName) {
	foreach ( $tree_pills_arr as $k => $v ) {
		foreach ( $v as $k2 => $v2 ) {
			if ( strtolower($k2) == strtolower($itemName) ) {
				$pill_path = DB_SHOP_DIR . '/' . strtolower($k) . '/' . strtolower($k2) . '/ser.php';
				$pill_path2 = DB_SHOP_DIR . '/!custom_relations/' . strtolower($k2) . '/ser.php';

				if ( is_file($pill_path2) ) {

					$pill_path  = $pill_path2;
				}
				$pillArr = file_get_contents($pill_path);
				$pillArr = unserialize($pillArr);
				unset($pillArr['packings']);
				unset($pillArr['active_ingredients']);
				unset($pillArr['analogs']);
				unset($pillArr['type']);
				unset($pillArr['pack_name']);
				unset($pillArr['min_price']);
				$pillArr = json_encode($pillArr);
				return $pillArr;
			}
		}
	}
	return false;
}
?>