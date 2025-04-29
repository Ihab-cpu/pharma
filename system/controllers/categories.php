<?php
    if ( isset($urlArr['folders'][2]) && $urlArr['folders'][2] != 'all' ) {
        currenct_category($global_arr);
    } else {
        all_categories($global_arr);
    }
	
    function currenct_category($global_arr) {
        global
            $config_array,
            $tree,
            $urlArr,
            $lang,
            $currency,
            $cookies_unser_order_arr
        ;
        $url_decode_arr = read_ser_arr(DB_DIR . '/shop_db/url_redirect_map.php');
        if ( !empty($url_decode_arr[0][$urlArr['folders'][1]]) ) {
            $urlArr['folders'][1] = $url_decode_arr[0][$urlArr['folders'][1]];
        }
        if ( !empty($url_decode_arr[1][$urlArr['folders'][2]]) ) {
            $urlArr['folders'][2] = $url_decode_arr[1][$urlArr['folders'][2]];
        }
        $f = DB_DIR . '/shop_db/' . strtolower($urlArr['folders'][1]) . '/' . strtolower($urlArr['folders'][2]) . '/ser.php';



	    if ( !is_file($f) ) {
		    foreach ( $tree as $k => $v ) {
			    foreach ( $v as $k2 => $v2 ) {
				    //p(strtolower($k2));
				    if ( strtolower($k2) == strtolower($urlArr['folders'][2]) ) {
					    $urlArr['folders'][1] = strtolower($k);
					    
					    $f = DB_DIR . '/shop_db/' . strtolower($urlArr['folders'][1]) . '/' . strtolower($urlArr['folders'][2]) . '/ser.php';
					    break;
				    }
			    }
		    }


	    }

	    $f2 = DB_DIR . '/shop_db/!custom_relations/' . '' . strtolower($urlArr['folders'][2]) . '/ser.php';

        $resultArr = read_ser_arr($f);
        if ( is_file($f2) ) {
            $resultArr2 = read_ser_arr($f2);
            foreach ( $resultArr2 as $k => $v ) {
                $resultArr[$k] = $v;
            }
        }
        if ( !empty($resultArr['synonims']) ) {
            natsort($resultArr['synonims']);
        }

	    if ( !empty($resultArr['analogs']) ) {
            $sort = array_keys($resultArr['analogs']);
            natsort($sort);
            $newSort = array();
            foreach ( $sort as $k => $v ) {
                $newSort[$v] = $resultArr['analogs'][$v];
            }
            $resultArr['analogs'] = $newSort;
        }

        
		
        
        
        //Date: Approx uniq system
        $eps_random_immitator = strlen($resultArr['full_descr']);
        
        
        
        $approx_date = date('U') + 3600 * 24 * 365 * 2;
        if ( $eps_random_immitator % 7 == 0 ) {
			$approx_date = $approx_date + 3600 * 24 * 31 * 2;
        }
        if ( $eps_random_immitator % 6 == 0 ) {
			$approx_date = $approx_date + 3600 * 24 * 31 * 3;
        }
        if ( $eps_random_immitator % 5 == 0 ) {
			$approx_date = $approx_date + 3600 * 24 * 31 * 1;
        }
        if ( $eps_random_immitator % 4 == 0 ) {
			$approx_date = $approx_date + 3600 * 24 * 31 * 2;
        }
        
        $approx_date = date('M Y', $approx_date);
        $global_arr['smarty']->assign('approx_date', $approx_date);
        
        // count in stock uniq system
        
        //echo date('H');
        //echo count($resultArr['packings']);
        $counter = 0;
        if ( count($resultArr['packings']) > 0 ) {
	        foreach ( $resultArr['packings'] as $k => $v ) {
				$counter += count($v);
	        }
		}
		
		$coeff = 285;
        //echo '$counter - ' . $counter . '<br />';
        if ( $counter == 1 ) {
			
        } else if ( $counter > 1 && $counter < 3 ) {
			$coeff = 10;
        } else if ( $counter > 2 && $counter < 5 ) {
			$coeff = 15;
        } else if ( $counter > 4 && $counter < 7 ) {
			$coeff = 20;
		} else if ( $counter > 6 && $counter < 10 ) {
			$coeff = 25;
		} else if ( $counter > 9 && $counter < 15 ) {
			$coeff = 20;
        } else {
			$coeff = 10;
        }
        
        $h = date('H');
        
        $h = 22;
        if ( $h > 0 && $h < 4 ) {
			$coeff2 = 40;
        } else if ( $h > 3 && $h < 8 ) {
			$coeff2 = 45;
        } else if ( $h > 7 && $h < 12 ) {
			$coeff2 = 50;
        } else if ( $h > 11 && $h < 16 ) {
			$coeff2 = 60;
        } else if ( $h > 16 && $h < 19 ) {
			$coeff2 = 70;
        } else if ( $h > 18 && $h < 22 ) {
			$coeff2 = 80;
        } else {
			$coeff2 = 86;
        }
        /*
        echo '$h - ' . $h . '<br />';
        echo '$coeff2 - ' . $coeff2 . '<br />';
        echo '$coeff - ' . $coeff . '<br />';
        */
        $count = $counter * $coeff;
        $count = $count - $count * $coeff2 / 100;
        $count = round($count, 0);
        
        $global_arr['smarty']->assign('availability', $count);;
        
        //echo '$count - ' . $count . '<br />';
        //DIE;
        $flag = false;
        if ( !is_file($f) ) {

        }
        if ( $flag ) {
            header('Location: ' . BASE_FOLDER . 'categories/Bestsellers?e404=1');
            die;
        }
        // debug
        // kill save 
        foreach ( $resultArr['packings'] as  $k => $v ) {
        	$start = reset($resultArr['packings'][$k]);
        	$max_price_per_pill = $start['price_per_pill'];
			foreach ( $v as  $k2 => $v2 ) {
				$resultArr['packings'][$k][$k2]['pack_price'] = $v2['count'] * $v2['price_per_pill'];
				$resultArr['packings'][$k][$k2]['save'] = ( $max_price_per_pill - $v2['price_per_pill'] ) * $v2['count'];
			}
        }
        if ( isset($_GET['buy']) ) {
            foreach ( $resultArr['packings'] as $k => $v ) {
            	
                foreach ( $v as $k2 => $v2 ) {
                    if ( $v2['id_packing'] == $_GET['buy'] ) {
                    	
                        $price_per_pack = $v2['pack_price'];
                        $dosage = $v2['dosage'];
                        $name = $v2['name'];
                        $count_in_pack = $v2['count'];
                        
                        $price_per_pill = ($v2['price_per_pill'] + $v2['price_per_pill']/100*$config_array['extra_charge']);
                        #p($price_per_pill);
                        #die;
                        $pack_name = $resultArr['pack_name'];
                        $type = $resultArr['type'];
                        // search parent category
                        $parent = '';
                        
                    	//$price_per_pill = round($price_per_pill, 2);
                    	
                        foreach ( $tree as $k => $v ) {
                            if ( isset($v[$name]) ) {
                                $parent = $k;
                                break;
                            }
                        }
                        
	                    if ( !isset($cookies_unser_order_arr['order'][intval($_GET['buy'])]) ) {
                        	// create order array
                        	// to JSON string and compile to cookies
                        	$order_arr['order'] = $cookies_unser_order_arr['order'];
                        	$order_arr['order'][intval($_GET['buy'])] = array(
		                        0 => $parent, //parent
		                        1 => $name, //name
		                        2 => $dosage, //dosage
		                        3 => 1, //count
		                        4 => "" . $price_per_pack, //price
		                        5 => $type, //type
		                        6 => $pack_name, //pack_name
		                        7 => $count_in_pack, //count_in_pack,
		                        8 => $price_per_pill // pr pill
		                    );
		                    
		                    
		                    $order_str = my_create_order_str($order_arr['order']);
		                    my_set_cookie('order', $order_str, SECONDS_IN_YEAR);
	                    }
                    }
                }
            }
            
            $from = $urlArr['folders']['1'] . '/' . $urlArr['folders']['2'];
            $from = urlencode($from);
            //die;
            header('Location: ' . BASE_FOLDER . 'basket?from=' . $from);
            die;
        }
        
        foreach ( $resultArr['packings'] as  $k => $v ) {
			foreach ( $v as $k2 => $v2 ) {
				$resultArr['packings'][$k][$k2]['price_per_pill'] = price_handler($resultArr['packings'][$k][$k2]['price_per_pill']);
				$resultArr['packings'][$k][$k2]['pack_price'] = price_handler($resultArr['packings'][$k][$k2]['pack_price']);
				$resultArr['packings'][$k][$k2]['save'] = price_handler($resultArr['packings'][$k][$k2]['save']);
			}
            if ( !empty($global_arr['config_array']['pack_reverse']) ) {
                $resultArr['packings'][$k] = array_reverse($resultArr['packings'][$k]);
            }
        }
        $path = DB_DIR . '/shop_db/ai_drugs_ser.php';
        $aiArr = read_ser_arr($path, 1);
        $aiArr = unserialize($aiArr);
        /*
        foreach ( $aiArr as $k => $v ) {
			
        }
        */
        #p(array_keys($global_arr));
        $cat = $global_arr['urlArr']['folders'][1];
        //p($aiArr);
        //p($url_decode_arr[1]);
        $ai = array();
	    //p($aiArr);die;
        foreach ( $aiArr as $k => $v ) {
        	if ( $ai ) {
				//break;
        	}
			foreach ( $v as $k2 => $v2 ) {
                //$url_decode_arr[1]
                //p($k2);

				if (
                    $k2 == $global_arr['urlArr']['folders'][2]
                    ||
                    strtolower($k2) == $url_decode_arr[1][$global_arr['urlArr']['folders'][2]]
                ) {

                    #echo 11;
					$ai[$k] = $k;
					break;
				}
			}
        }
        
        if ( isset($urlArr['folders'][3]) ) {
			$name = $urlArr['folders'][1] . ' - ' . htmlspecialchars($urlArr['folders'][3]) . ' (Brand name: ' . htmlspecialchars($urlArr['folders'][2]) . ')';
			$resultArr['small_descr'] = str_replace($urlArr['folders'][2] . ' ', $urlArr['folders'][3] . ' ', $resultArr['small_descr']);
			$resultArr['full_descr'] = str_replace($urlArr['folders'][2] . ' ', $urlArr['folders'][3] . ' ', $resultArr['full_descr']);
        } else {
        	$name = /*$urlArr['folders'][1] . ' - ' . */htmlspecialchars($urlArr['folders'][2]);
        }



        $imgZoomDir = BASE_FOLDER . 'system/images/' . strtolower($resultArr['name']) . '_.jpg';
        $noZoom = false;
        if ( is_file($_SERVER['DOCUMENT_ROOT'] . $imgZoomDir) ) {
            $imgZoom = ROOT_URL . 'system/images/' . strtolower($resultArr['name']) . '_.jpg';
        } else {
            $imgZoom = ROOT_URL . 'system/images/' . strtolower($resultArr['name']) . '.jpg';
            $noZoom = true;
        }
        $global_arr['smarty']->assign('imgZoom', $imgZoom);
        $global_arr['smarty']->assign('noZoom', $noZoom);


        if ( $lang != 'en' ) {
            if ( !empty($resultArr['small_descr_' . $lang]) ) {
                $resultArr['small_descr'] = $resultArr['small_descr_' . $lang];
            }
            if ( !empty($resultArr['full_descr_' . $lang]) ) {
                $resultArr['full_descr'] = $resultArr['full_descr_' . $lang];
            }

        }
	    
//	    p($ai);die;
	$ai_seo=implode(', ', $ai);
//        $ai = '<a href="/search?q=' . implode(', ', $ai) . '">' . implode(', ', $ai) . '</a>';
        $ai = '<a href="' . $global_arr['smarty']->_tpl_vars['BASE_FOLDER'] . 'search?q=' . implode(', ', $ai) . '">' . implode(', ', $ai) . '</a>';


        if ( !empty($global_arr['config_array']['seo'][$lang]['item']['tit']) ) {
            if ( $lang != 'en' ) {
                $clang = '_' . $lang;
            } else {
                $clang = '';
            }

            $last = end(end($resultArr['packings']));

            $title = $global_arr['config_array']['seo'][$lang]['item']['tit'];

            $title = str_replace('%pill_name%', $name, $title);
            $title = str_replace('%category_name%', htmlspecialchars($urlArr['folders'][1]), $title);
            $title = str_replace('%active_ingr%', $ai_seo, $title);
            $title = str_replace('%synonyms%', implode(',', $resultArr['synonims']), $title);
            $title = str_replace('%price_per_pill%', $last['price_per_pill'], $title);
            $title = str_replace('%price_per_pack%', $last['pack_price'], $title);
            $title = str_replace('%small_description%', $resultArr['small_descr' . $clang], $title);
            $title = str_replace('%domain%', $_SERVER['HTTP_HOST'], $title);
        } else {
            if ( empty($global_arr['private_config_array']['shop_name']) ) {
                $shop_name = $global_arr['config_array']['shop_title'];
            } else {
                $shop_name = $global_arr['private_config_array']['shop_name'];
            }
            $title = $resultArr['name'] . ' - ' . $urlArr['folders'][1] . ' :: ' . $shop_name;
        }
        if ( !empty($global_arr['config_array']['seo'][$lang]['item']['kw']) ) {
            $keywords = $global_arr['config_array']['seo'][$lang]['item']['kw'];
            $keywords = str_replace('%pill_name%', $name, $keywords);
            $keywords = str_replace('%category_name%', htmlspecialchars($urlArr['folders'][1]), $keywords);
            $keywords = str_replace('%active_ingr%', $ai_seo, $keywords);
            $keywords = str_replace('%synonyms%', implode(',', $resultArr['synonims']), $keywords);
            $keywords = str_replace('%price_per_pill%', $last['price_per_pill'], $keywords);
            $keywords = str_replace('%price_per_pack%', $last['pack_price'], $keywords);
            $keywords = str_replace('%small_description%', $resultArr['small_descr' . $clang], $keywords);
            $keywords = str_replace('%domain%', $_SERVER['HTTP_HOST'], $keywords);
        }

        if ( !empty($global_arr['config_array']['seo'][$lang]['item']['desc']) ) {
            $description = $global_arr['config_array']['seo'][$lang]['item']['desc'];
            $description = str_replace('%pill_name%', $name, $description);
            $description = str_replace('%category_name%', htmlspecialchars($urlArr['folders'][1]), $description);

            $description = str_replace('%active_ingr%', $ai_seo, $description);
            $description = str_replace('%synonyms%', implode(',', $resultArr['synonims']), $description);
            $description = str_replace('%price_per_pill%', $last['price_per_pill'], $description);
            $description = str_replace('%price_per_pack%', $last['pack_price'], $description);
            $description = str_replace('%small_description%', $resultArr['small_descr' . $clang], $description);
            $description = str_replace('%domain%', $_SERVER['HTTP_HOST'], $description);
        }

        $global_arr['smarty']->assign('title', $title);
        $global_arr['smarty']->assign('keywords', $keywords);
        $global_arr['smarty']->assign('description', $description);
	    
        $global_arr['smarty']->assign('active_ingredients', $ai);
        $global_arr['smarty']->assign('resultArr', $resultArr);
        $global_arr['smarty']->assign('name', $name);
        if ( !isset($_GET['landing']) ) {
            $global_arr['smarty']->display('item.tpl');
        } else {
            $template = $global_arr['config_array']['default_template'];
            if ( isset($_GET['template']) ) {
                $template = intval($_GET['template']);
            }
            $css = TEMPLATES_DIR . '/global/landing/' . $template . '.css';
            $css = file_get_contents($css);
            $css = str_replace("\t", '', $css);
            $css = str_replace("\n", '', $css);
            $css = str_replace("\r", '', $css);
            $css = str_replace("  ", ' ', $css);
            $css = str_replace("  ", ' ', $css);
            $css = str_replace("  ", ' ', $css);
            $css = str_replace("  ", ' ', $css);
            $css = str_replace('{$BASE_FOLDER}', 'http://' . $_SERVER['HTTP_HOST'] . BASE_FOLDER, $css);
                $css .= 'strong,b{font-weight:bold !important;}';

            $jsprefix = 'sserc3dsds_';
            if ( isset($_GET['mysjprefix']) ) {
                $jsprefix = substr($_GET['mysjprefix'], 0, 10) . '_';
            }
            $jsprefix = 'mysjprefix_';

            $resultArr['full_descr'] = str_replace("\n", '', $resultArr['full_descr']);
            $resultArr['full_descr'] = str_replace("\r", '', $resultArr['full_descr']);
            $global_arr['smarty']->assign('resultArr', $resultArr);
            
            $global_arr['smarty']->assign('css', $css);
            $global_arr['smarty']->assign('mysjprefix', $jsprefix);
            $x = $global_arr['smarty']->fetch('../global/item_js.tpl');
            $x = "var " . $jsprefix . "template = '"  . str_replace("'", "\'", $x) . "'; document.write(" . $jsprefix . "template);";

            echo $x;
            die;
            //
        }

    }

	function all_categories($global_arr) {

		global
            $tree,
            $urlArr,
            $lang,
            $currency,
            $cookies_unser_order_arr
        ;

        

        $url_decode_arr = read_ser_arr(DB_DIR . '/shop_db/url_redirect_map.php');
        if ( !empty($url_decode_arr[0][$urlArr['folders'][1]]) ) {
            $urlArr['folders'][1] = $url_decode_arr[0][$urlArr['folders'][1]];
        }

        $current_cat = $urlArr['folders'][1];


        
        //$current_cat = strtolower($current_cat);
        //echo $current_cat;
        $resultArr = array();
        if ( !empty($tree[$current_cat]) ) {
			$resultArr = $tree[$current_cat];
        }
        
        // set new price
        $path = DB_DIR . '/shop_db/ai_drugs_ser.php';
        $ai_arr = read_ser_arr($path, true);
		$ai_arr = unserialize($ai_arr);
		$ai = array();
		foreach ( $ai_arr as $k => $v ) {
			foreach ( $v as $k2 => $v2 ) {
				$ai[$k2] = $k;
			}
		}
		
		
        if ( count($resultArr) > 0 ) {
        	
	        foreach ( $resultArr as $k => $v ) {
				$resultArr[$k][0] = price_handler($v[0]);
				$resultArr[$k][2] = $ai[$k];
	        }
		}
        $global_arr['smarty']->assign('current_cat', $current_cat);
        /*
        if ( empty($global_arr['private_config_array']['shop_name']) ) {
			$title = 'Canadian Pharmacy - Big Sale and Fast Delivery!';
		} else {
			
		}
		*/
		if ( empty($global_arr['private_config_array']['shop_name']) ) {
			$shop_name = $global_arr['config_array']['shop_title'];
		} else {
			$shop_name = $global_arr['private_config_array']['shop_name'];
		}

		$title = $current_cat . ' :: ' . $global_arr['config_array']['shop_title'];
        $keywords = '';
        $description = '';

        if (
            $urlArr['folders'][0] == 'categories'
            &&
            $urlArr['folders'][1] == 'Bestsellers'
            &&
            !is_numeric(strpos($_SERVER['REQUEST_URI'], $urlArr['folders'][1]))
        ) {
        	$title = $shop_name;//'Big Sale: -80% off on all meds. Time Limited Offer.';
            if ( !empty($global_arr['config_array']['seo'][$lang]['main']['tit']) ) {
                $title = $global_arr['config_array']['seo'][$lang]['main']['tit'];
                $title = str_replace('%domain%', $_SERVER['HTTP_HOST'], $title);
            }
            if ( !empty($global_arr['config_array']['seo'][$lang]['main']['kw']) ) {
                $keywords = $global_arr['config_array']['seo'][$lang]['main']['kw'];
                $keywords = str_replace('%domain%', $_SERVER['HTTP_HOST'], $keywords);
            }
            if ( !empty($global_arr['config_array']['seo'][$lang]['main']['desc']) ) {
                $description = $global_arr['config_array']['seo'][$lang]['main']['desc'];
                $description = str_replace('%domain%', $_SERVER['HTTP_HOST'], $description);
            }
        } else {
            if (!empty($global_arr['config_array']['seo'][$lang]['cat']['tit'])) {
                $title = $global_arr['config_array']['seo'][$lang]['cat']['tit'];
                $title = str_replace('%domain%', $_SERVER['HTTP_HOST'], $title);
                $title = str_replace('%category_name%', $current_cat, $title);
            }
            if (!empty($global_arr['config_array']['seo'][$lang]['cat']['kw'])) {
                $keywords = $global_arr['config_array']['seo'][$lang]['cat']['kw'];
                $keywords = str_replace('%domain%', $_SERVER['HTTP_HOST'], $keywords);
                $keywords = str_replace('%category_name%', $current_cat, $keywords);
            }
            if (!empty($global_arr['config_array']['seo'][$lang]['cat']['desc'])) {
                $description = $global_arr['config_array']['seo'][$lang]['cat']['desc'];
                $description = str_replace('%domain%', $_SERVER['HTTP_HOST'], $description);
                $description = str_replace('%category_name%', $current_cat, $description);
            }
        }

		$global_arr['smarty']->assign('title', $title);
		$global_arr['smarty']->assign('keywords', $keywords);
		$global_arr['smarty']->assign('description', $description);

        $global_arr['smarty']->assign('name', $current_cat);
        $global_arr['smarty']->assign('resultArr', $resultArr);
		$global_arr['smarty']->display('categories.tpl');

	}
?>