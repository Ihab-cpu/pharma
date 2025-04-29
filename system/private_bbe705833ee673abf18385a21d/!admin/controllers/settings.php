<?php
	index($global_arr);
	
	function index($global_arr) {
		$templatesArr = scandir(TEMPLATES_DIR);
		$templatesArr = clear_dir_arr($templatesArr);
		foreach ( $templatesArr as $k => $v ) {
			if ( $v == 'global' ) {
				unset($templatesArr[$k]);
				break;
			}
		}

		$tree = DB_DIR . '/shop_db/tree_ser.php';
		//$tree = file_get_contents($tree);
		$tree = read_ser_arr($tree, 1);
		$tree = array_keys($tree);
		$global_arr['smarty']->assign('tree', $tree);

		$global_arr['smarty']->assign('templatesArr', $templatesArr);
		$settings = $global_arr['config_array'];
		$errorStrSettings = '';
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            if ( !empty($_POST['url_abs']) ) {
                $settings['url_abs'] = 1;
            } else {
                unset($settings['url_abs']);
            }
			if ( !empty($_POST['pack_reverse']) ) {
                $settings['pack_reverse'] = 1;
            } else {
                unset($settings['pack_reverse']);
            }
			if ( !empty($_POST['default_template']) ) {
				if ( !isset($_POST['extra_charge']) ) {
					$_POST['extra_charge'] = 0;
				} else {
					$_POST['extra_charge'] = intval($_POST['extra_charge']);
					if ( $_POST['extra_charge'] > 50 ) {
						$_POST['extra_charge'] = 50;
						$errorStrSettings = 'Error! Extra charge: max 50';
					}
					
					if ( $_POST['extra_charge'] < $settings['min_extra_charge'] ) {
						$_POST['extra_charge'] = $settings['min_extra_charge'];
						$errorStrSettings = 'Error! Extra charge: min ' . $settings['min_extra_charge'];
					}
				}
				if ( isset($_POST['show_tree_price']) ) {
					$settings['show_tree_price'] = 1;
				} else {
					unset($settings['show_tree_price']);
				}

				$settings['default_template'] = $_POST['default_template'];
				$settings['extra_charge'] = $_POST['extra_charge'];
				$settings['default_category'] = $_POST['default_category'];

				write_ser_arr(GLOBAL_CONFIG_PATH, $settings, true);
				$global_arr['smarty']->assign('config_array', $settings);
			}
		}
		
		$global_arr['smarty']->assign('errorStrSettings', $errorStrSettings);
		$global_arr['smarty']->assign('name', 'settings');
		$global_arr['smarty']->display('settings.tpl');
	}
?>