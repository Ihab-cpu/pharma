<?php
	index($global_arr);

	function index($global_arr) {

		$update_file = UPDATE_DIR . '/update.dat';
		if ( is_file($update_file) ) {
			$updateStr = file_get_contents($update_file);
			$updateStr = gzuncompress($updateStr);
			$updateArr = unserialize($updateStr);
		}
		$update_file_smarty = str_replace('../', '', $update_file);
		$update_file_smarty = str_replace('./', '', $update_file_smarty);
        #$firstPackCSVStr = '';
		$global_arr['smarty']->assign('update_file', $update_file_smarty);
		$update_hash_path = UPDATE_DIR . '/hash.php';
		
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			if ( isset($_POST['load_update_file']) ) {
				$ext = $_FILES['file_update']['name'];
				$ext = explode('.', $ext);
				$ext = $ext[count($ext) - 1];
				if ( $ext != 'dat' ) {
					die('This is not update file');
				} else {
					$from = $_FILES['file_update']['tmp_name'];
					$a = file_get_contents($from);
					$b = gzuncompress($a);
					$updateArr = unserialize($b);
					$f = fopen($update_file, 'w+');
					fwrite($f, $a);
					fclose($f);
				}
			}
		}
        if ( isset($_GET['install_update']) ) {
            // pics
            $arr = explode('/**sEpOrAtOr2**/', $updateArr['pics']);
            // delete old file structure in db folder
            $dirArr = scandir(DB_DIR . '/shop_db');
            include_once(INC_DIR . '/remove_dir.php');
            foreach ( $dirArr as $k => $v ) {
                if ( $v == '.' || $v == '..' ) {
                    continue;
                }
                $element = DB_DIR . '/shop_db/' . $v;
                if ( is_dir($element) ) {
                    remove_dir($element);
                } else {
                    unlink($element);
                }
            }
            // CREATE STRUCTURE OF DB
            unset($updateArr['pics']);
//            p($updateArr['db']['Asthma']['drugs']['Ventolin']);
//            die;

//            p($updateArr['db']['Birth Control']['drugs']['Lynoral']);
//            die;
            // create tree
            $tree = array();
            $tree_es = array();
            $tree_de = array();
            $tree_fr = array();
            $tree_it = array();
            $tree_pills = array();
            $errorsArr = array();
            $searchListArr = array();
//            p($updateArr['db']);
//            die;
            $url_redirect_map = array();
            mkdir(DB_DIR . '/shop_db/!custom_relations');
            foreach ( $updateArr['db'] as $k => $v ) {
                $category_dir = DB_DIR . '/shop_db/' . strtolower($k);
                $url_redirect_map[0][str_replace(' ', '-', $k)] = ($k);
                if ( !is_dir($category_dir) ) {
                    mkdir($category_dir);
                    if ( !is_dir($category_dir) ) {
                        $errorsArr[$category_dir] = 'can not create folder';
                    }
                }
                foreach ( $v['drugs'] as $k2 => $v2 ) {
                    $url_redirect_map[1][str_replace(' ', '-', $k2)] = strtolower($k2);
                    $firstPack = reset($v2['packings']);
                    $firstPack = reset($firstPack);
                    $firstPack = $firstPack['id_packing'];
                    $firstPackArr[$firstPack] = $k . '/' . $v2['name'];
                    $firstPackCSVArr[$firstPack] = $v2['name'];

//	                if ( $k2 == 'Malegra FXT' ) {
//
//		                p($v2['analogs']);
//		                die;
//	                }
	                unset($v2['analogs']['']);
                    $searchListArr[$k2] = array();
                    $searchListArr[$k2][0] = '';
                    $searchListArr[$k2][1] = '';
                    $searchListArr[$k2][2] = $k; // category

                    if ( count($v2['packings']) > 0 ) {
                        foreach ( $v2['packings'] as $k3 => $v3 ) {
                            foreach ( $v3 as $k4 => $v4 ) {
                                $v2['packings'][$k3][$k4]['price_per_pill'] = round($updateArr['db'][$k]['drugs'][$k2]['packings'][$k3][$k4]['price_per_pill'], 5) . "";
                            }
                        }
                    }
                    $tree_pills[$k2] = $k;

                    $tree[$k][$k2][0] = $v2['min_price'];
                    $tree[$k][$k2][1] = $v2['small_descr'];

                    $tree_de[$k][$k2][0] = $v2['min_price'];
                    $tree_de[$k][$k2][1] = $v2['small_descr_de'];

                    $tree_es[$k][$k2][0] = $v2['min_price'];
                    $tree_es[$k][$k2][1] = $v2['small_descr_es'];

                    $tree_fr[$k][$k2][0] = $v2['min_price'];
                    $tree_fr[$k][$k2][1] = $v2['small_descr_fr'];

                    $tree_it[$k][$k2][0] = $v2['min_price'];
                    $tree_it[$k][$k2][1] = $v2['small_descr_it'];

                    $categories_de[$k] = $v['name_de'];
                    $categories_es[$k] = $v['name_es'];
                    $categories_it[$k] = $v['name_it'];
                    $categories_fr[$k] = $v['name_fr'];
                    $pill_dir = $category_dir . '/' . strtolower($k2);
                    if ( !is_dir($pill_dir) ) {
                        mkdir($pill_dir);
                        if ( !is_dir($pill_dir) ) {
                            $errorsArr[$pill_dir] = 'can not create folder';
                        }
                        $serCont = serialize($v2);
                        $f = fopen($pill_dir . '/ser.php', 'w+');
                        fwrite($f, $serCont);
                        fclose($f);
                        if ( !is_file($pill_dir . '/ser.php') ) {
                            $errorsArr[$pill_dir . '/ser.php'] = 'can not create file';
                        }
                    }
                }
            }

            //p($url_redirect_map);die;
            $f = DB_DIR . '/shop_db/url_redirect_map.php';
            write_ser_arr($f, $url_redirect_map, false);
            $f = DB_DIR . '/shop_db/categories_de.php';
            write_ser_arr($f, $categories_de, false);
            $f = DB_DIR . '/shop_db/categories_es.php';
            write_ser_arr($f, $categories_es, false);
            $f = DB_DIR . '/shop_db/categories_fr.php';
            write_ser_arr($f, $categories_fr, false);
            $f = DB_DIR . '/shop_db/categories_it.php';
            write_ser_arr($f, $categories_it, false);
            //SAVE TREE
            $f = DB_DIR . '/shop_db/tree_ser.php';
            $f_es = DB_DIR . '/shop_db/tree_ser_es.php';
            $f_de = DB_DIR . '/shop_db/tree_ser_de.php';
            $f_it = DB_DIR . '/shop_db/tree_ser_it.php';
            $f_fr = DB_DIR . '/shop_db/tree_ser_fr.php';

            write_ser_arr($f, $tree, true);
            write_ser_arr($f_es, $tree_es, true);
            write_ser_arr($f_de, $tree_de, true);
            write_ser_arr($f_it, $tree_it, true);
            write_ser_arr($f_fr, $tree_fr, true);

            $f = DB_DIR . '/shop_db/tree_pills.php';
            write_ser_arr($f, $tree_pills, true);
            // AI
            $ai_ser_arr = serialize($updateArr['active_ingridients_drugs']);
            $f = DB_DIR . '/shop_db/ai_drugs_ser.php';
            write_ser_arr($f, $ai_ser_arr, true);
            // Synonims
            $f = DB_DIR . '/shop_db/synonims.php';

            $synonims_arr = serialize($updateArr['synonims']);
            write_ser_arr($f, $synonims_arr, true);

            $f = DB_DIR . '/shop_db/goods.php';
            #$f2 = DB_DIR . '/goods.csv';
            $firstPackArr = json_encode($firstPackArr);
            file_put_contents($f, $firstPackArr);
            #file_put_contents($f2, $firstPackCSVStr);

            // delete old images
            $picDir = ROOT_DIR . '/system/images/';
            $picOldArr = scandir($picDir);
            foreach ( $picOldArr as $k => $v ) {
                if ( $v == '.' || $v == '..' ) {
                    continue;
                }
                unlink($picDir . $v);
            }

            // load new images
            foreach ( $arr as $k => $v ) {
                $tmpArr = explode('/**sEpOrAtOr1**/', $v);
                if ( $tmpArr[0] == '' ) {
                    continue;
                }
                $file = $picDir . $tmpArr[0];
                $f = fopen($file, 'w+');
                fwrite($f, $tmpArr[1]);
                fclose($f);
            }
            if ( count($errorsArr) == 0 ) {
                $global_arr['smarty']->assign('global_status', 'Update is complete.');
            } else {
                $global_arr['smarty']->assign('global_error', 'Update error!');
            }
            // write ver db in config
            $global_arr['config_array']['db_ver'] = $updateArr['ver'];
            $config_path = CONFIG_DIR . '/global.php';
            $global_arr['smarty']->assign('config_array', $global_arr['config_array']);
            if ( !write_ser_arr($config_path, $global_arr['config_array'], true) ) {
                echo 'can not write in config file new version.';
            }
	        foreach ( $updateArr['synonims'] as $kSyn => $vSyn ) {
                if ( !isset($searchListArr[$vSyn][1][0]) ) {
		$searchListArr[$vSyn][1] = array();
		}
		$searchListArr[$vSyn][1][] = $kSyn;
            }
			foreach ( $searchListArr as $kSearch => $vSearch ) {
                foreach ( $updateArr['active_ingridients_drugs'] as $kTest => $vTest ) {

                    if ( !empty($vTest[$kSearch]) ) {
                        if ( !isset($searchListArr[$kSearch][0][0]) ) {
			$searchListArr[$kSearch][0] = array();
			}
			$searchListArr[$kSearch][0][] = strtolower($kTest);
                    }
                }
            }
            $searchListArr = json_encode($searchListArr);
            $f = DB_DIR . '/shop_db/search.php';
	        file_put_contents($f, $searchListArr);
        }

		$global_arr['smarty']->assign('name', 'Update');
		
		if ( is_file($update_file) ) {
			$global_arr['smarty']->assign('update_file_isset', 1);
		} else {
			$global_arr['smarty']->assign('update_file_isset', 0);
		}
		
		
		if ( isset($updateArr['ver']) ) {
			$global_arr['smarty']->assign('update_file_ver', $updateArr['ver']);
		}

		$global_arr['smarty']->display('update.tpl');
	}