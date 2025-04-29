<?php



	index($global_arr);

	function index($global_arr) {

		$q = $_GET['q'];
        $search_result = searcher($global_arr, $q);
        /*
        if ( !$search_result ) {
            $q = explode(" ", $q);
            foreach ( $q as $qK => $qV ) {
                $tmp2 = searcher($global_arr, $qV);
                foreach ( $tmp2 as $k => $v ) {
                    $search_result[$k] = $v;
                }

            }
            #p($search_result);

            #p($q);
            #die;
        }
        */

        if ( isset($_GET['ajax']) ) {
            if ( count($search_result) != 0 ) {
                $out['suggestions'] = $search_result;
                echo json_encode($out);
            } else {
                echo false;
            }
            die;
        }
        if ( count($search_result) == 1 && !isset($_GET['ajax']) ) {
            $a = reset($search_result);
			$path = BASE_FOLDER . 'categories/' . $a['data'] . '/' . $a['originalname'];
			header('Location: ' . $path);
			die;
		}
        foreach ( $search_result as $k => $v ) {
            $result_result[$k] = $global_arr['tree'][$v['data']][$k];
            $result_result[$k][2] = $v['data'];
            $result_result[$k][3] = $v['ai'];
            $result_result[$k][0] = price_handler($result_result[$k][0]);
        }
//        p($result_result);die;
        if ( !$result_result ) {
            header('Location: ' . BASE_FOLDER . 'categories/Bestsellers?e404=1');
            die;
        }

        $global_arr['smarty']->assign('result_array', $result_result);
        $global_arr['smarty']->assign('title', $global_arr['config_array']['shop_title'] . ': Search - ' . htmlspecialchars($_GET['q']));
        if ( isset($_GET['qoriginal']) ) {
            $name = 'Search - &laquo;' . htmlspecialchars($_GET['qoriginal']) . '&raquo;';
        } else {
            $name = mytranslate_inner('search product') . ' - &laquo;' . htmlspecialchars($_GET['q']) . '&raquo;';
        }
        $global_arr['smarty']->assign('name', $name);

        $global_arr['smarty']->display('search.tpl');
	}

    function searcher($global_arr, $q) {

        $needLen = 3;
        $max_cnt = 99;
        if ( isset($_GET['ajax']) ) {
            $needLen = 0;
            $max_cnt = 19;
        }

        $replace_array = array(
            '-', ',', '%20', '+', '/', '.', '\'', '"'
        );
        $q = explode('-', $q);

        foreach ( $q as $k => $v ) {
            foreach ( $replace_array as $k2 => $v2 ) {
                $q[$k] = str_replace($v2, ' ', $v);
            }
        }
        $tmp = '';
        foreach ( $q as $k => $v ) {
            if ( strlen($v) < 3 ) {
                $tmp .= '-';
            } else {
                $tmp .= ' ';
            }
            $tmp .= $v;
        }
        $tmp = trim($tmp);
	$tmp = trim($tmp, '-');
$q = $tmp;
        if ( !$q ) {
            return false;
        }
        $q = strtolower($q);
        $search_arr = explode(' ', $q);

        // clear empty
        foreach ( $search_arr as $k => $v ) {
            $search_arr[$k] = trim($v);
            if ( !$search_arr[$k] ) {
                unset($search_arr[$k]);
            }
        }
        /*if ( count($search_arr) > 1 ) {
            foreach ( $search_arr as $k => $v ) {
                if ( strlen($v) < 2 ) {
                    unset($search_arr[$k]);
                }

            }
        }*/

        // search
        $f = DB_DIR . '/shop_db/search.php';
        
        $search_list_arr = json_decode(file_get_contents($f), 1);
        foreach ( $global_arr['smarty']->_tpl_vars['tree_arr'] as $k => $v ) {
            foreach ( $v as $k2 => $v2 ) {
                $tmp_tree[$k2] = '';
            }
        }
        // disable goods by config
        if ( !empty($global_arr['config_array']['goods_off']) ) {
            $goods_off = explode(",", $global_arr['config_array']['goods_off']);
            foreach ( $goods_off as $k => $v ) {
                unset($search_list_arr[$v]);
            }
        }
        $q = implode(' ', $search_arr);
//        p($q);die;
        $cnt = 0;
        $out = array();

        if ( strlen($q) == 1 || count($search_arr) == 1 ) {
            // In drug name
            $len = strlen($q);

            foreach ($search_list_arr as $k2 => $v2) {
                if (!isset($tmp_tree[$k2])) {
                    continue;
                }

                if ( $cnt > $max_cnt ) {
                    break;
                }

                $flag = false;
                if ( strlen($q) > 2 ) {
                    if ( is_numeric(strpos(strtolower($k2), $q)) ) {
                        $flag = true;
                    }
                } else {
                    $forEqName = strtolower(substr($k2, 0, $len));
                    if ( $forEqName == $q ) {
                        $flag = true;
                    }
                }
                if ( $flag ) {
                    $cnt++;
                    $out[$k2]['data'] = $v2[2];
                    $out[$k2]['value'] = $k2;
                    $out[$k2]['originalname'] = $global_arr['config_array']['pill_prefix'] . $k2 . $global_arr['config_array']['pill_postfix'];
                    $out[$k2]['ai'] = implode(', ', $v2[0]);
                }
            }
//            p($q);
//            p($search_arr);
//            die;

            if ( strlen($q) > 2 ) {


                foreach ($search_list_arr as $k2 => $v2) {
                    foreach ($v2[0] as $k3 => $v3) {
                        if ($len > strlen($v3)) {
                            continue;
                        }
                        $forEqName = strtolower(substr($v3, 0, $len));
                        $flag = false;
                        if (strlen($q) > 2) {
                            if (is_numeric(strpos(strtolower($v3), $q))) {
                                $flag = true;
                            }
                        } else {
                            $forEqName = strtolower(substr($v3, 0, $len));
                            if ($forEqName == $q) {
                                $flag = true;
                            }
                        }
                        if ($flag) {
                            $cnt++;
                            $out[$k2]['data'] = $v2[2];
                            $out[$k2]['originalname'] = $global_arr['config_array']['pill_prefix'] . $k2 . $global_arr['config_array']['pill_postfix'];
                            $out[$k2]['value'] = $k2 . ' (' . implode(', ', $v2[0]) . ')';
                            $out[$k2]['ai'] = implode(', ', $v2[0]);
                        }
                        if ($forEqName == $q) {
                            if (isset($out[$k2])) {
                                continue;
                            }
                        }
                    }
                }
                foreach ($search_list_arr as $k2 => $v2) {
                    foreach ($v2[1] as $k3 => $v3) {
                        if ($len > strlen($v3)) {
                            continue;
                        }
                        $forEqName = strtolower(substr($v3, 0, $len));
                        if ($forEqName == $q) {
                            if (isset($out[$k2])) {
                                continue;
                            }
                            $cnt++;
                            $out[$k2]['data'] = $v2[2];
                            $out[$k2]['originalname'] = $global_arr['config_array']['pill_prefix'] . $k2 . $global_arr['config_array']['pill_postfix'];
                            $out[$k2]['value'] = $k2 . ' (' . ucfirst($v3) . ')';
                            $out[$k2]['ai'] = implode(', ', $v2[0]);
                        }
                    }
                }
                // active ingredient
                if ( $cnt > $max_cnt ) {
                    return $out;
                    die;
                }
            }
        } else if ( count($search_arr) == 2 || count($search_arr) > 2 ) {
            $len = strlen($q);
            foreach ($search_list_arr as $k2 => $v2) {
                if (!isset($tmp_tree[$k2])) {
                    continue;
                }
                if ( $cnt > $max_cnt ) {
                    break;
                }
                $flag = false;
                if ( strlen($q) > 2 ) {
                    if ( is_numeric(strpos(strtolower($k2), $q)) ) {
                        $flag = true;
                    }
                } else {
                    $forEqName = strtolower(substr($k2, 0, $len));
                    if ( $forEqName == $q ) {
                        $flag = true;
                    }
                }
                if ( $flag ) {
                    $cnt++;
                    $out[$k2]['data'] = $v2[2];
                    $out[$k2]['value'] = $k2;
                    $out[$k2]['originalname'] = $global_arr['config_array']['pill_prefix'] . $k2 . $global_arr['config_array']['pill_postfix'];
                    $out[$k2]['ai'] = implode(', ', $v2[0]);
                }
            }
            foreach ($search_list_arr as $k2 => $v2) {
                if (!isset($tmp_tree[$k2])) {
                    continue;
                }
                if ($cnt > $max_cnt) {
                    break;
                }
                $flag = true;
                foreach ( $search_arr as $k3 => $v3 ) {
                    $tmp = strtolower(implode('', $v2[0]));
                    if ( !is_numeric(strpos($tmp, strtolower($v3))) ) {
                        $flag = false;
                    }
                }
                if ( $flag ) {
                    $cnt++;
                    $out[$k2]['data'] = $v2[2];
                    $out[$k2]['value'] = $k2 . ' (' . implode(', ', $v2[0]) . ')';
                    $out[$k2]['originalname'] = $global_arr['config_array']['pill_prefix'] . $k2 . $global_arr['config_array']['pill_postfix'];
                    $out[$k2]['ai'] = implode(', ', $v2[0]);
                }
            }
        }

        $flag2fail = false;


        if ( !count($out) && count($search_arr) == 2 ) {
            $flag2fail = true;
        }
        if ( strlen($q) > 1 && ( $flag2fail || (count($search_arr) > 2 && count($search_arr) < 6) ) ) {
            // In drug name

            foreach ( $search_arr as $searchWord ) {
                foreach ($search_list_arr as $k2 => $v2) {
                    if (!isset($tmp_tree[$k2])) {
                        continue;
                    }
                    if ($cnt > $max_cnt) {
                        break;
                    }
                    if (
                        is_numeric(strpos(strtolower($k2), $searchWord))
                    ) {
                        $cnt++;
                        $out[$k2]['data'] = $v2[2];
                        $out[$k2]['value'] = $k2;
                        $out[$k2]['originalname'] = $global_arr['config_array']['pill_prefix'] . $k2 . $global_arr['config_array']['pill_postfix'];
                        $out[$k2]['ai'] = implode(', ', $v2[0]);
                    }
                }
            }
            // In synonyms
            foreach ( $search_arr as $searchWord ) {

                foreach ($search_list_arr as $k2 => $v2) {
                    if (!isset($tmp_tree[$k2])) {
                        continue;
                    }
                    if ($cnt > $max_cnt) {
                        break;
                    }
                    if (strlen($searchWord) > 3) {
                        $tmp = implode('', $v2[1]);
                        if ( is_numeric(strpos($tmp, strtolower($searchWord))) ) {
                            $cnt++;
                            $out[$k2]['data'] = $v2[2];
                            $out[$k2]['value'] = $k2 . ' (' . $searchWord . ')';
                            $out[$k2]['originalname'] = $global_arr['config_array']['pill_prefix'] . $k2 . $global_arr['config_array']['pill_postfix'];
                            $out[$k2]['ai'] = implode(', ', $v2[0]);
                        }
                    }
                }
            }
            // In active ingredient
            foreach ( $search_arr as $searchWord ) {
                $searchWord = strtolower($searchWord);
                //p($searchWord);
                foreach ($search_list_arr as $k2 => $v2) {
                    $tmp = strtolower(implode(', ', $v2[0]));
                    if ( is_numeric(strpos($tmp, $searchWord)) ) {
                        $cnt++;
                        $out[$k2]['data'] = $v2[2];
                        $out[$k2]['originalname'] = $global_arr['config_array']['pill_prefix'] . $k2 . $global_arr['config_array']['pill_postfix'];
                        $out[$k2]['value'] = $k2 . ' (' . implode(', ', $v2[0]) . ')';
                        $out[$k2]['ai'] = implode(', ', $v2[0]);

                    }

                }
            }
        }
        return $out;
        p($out);
        die;












        foreach ( $search_arr as $k => $searchWord ) {

            $len = strlen($searchWord);
            $searchWord = strtolower($searchWord);

            foreach ( $search_list_arr as $k2 => $v2 ) {
                if ( !isset($tmp_tree[$k2]) ) {
                    continue;
                }
                if ( $cnt > $max_cnt ) {
                    break;
                }
                // search in pill name
                if ( $len > strlen($k2)  ) {
                    continue;
                }
                $forEqName = strtolower(substr($k2, 0, $len));

                if (
                    $forEqName == $searchWord
                    ||
                    is_numeric(strpos(strtolower($k2), $searchWord))
                ) {
                    $flagTmp = true;
                    foreach ( $search_arr as $kTmp => $vTmp ) {
//                        p($vTmp);die;
                        if ( !is_numeric(strpos(strtolower($k2), strtolower($vTmp))) ) {
//                            p($k2);
//                            die;
                            $flagTmp = false;
                        }
                    }
//                    p($search_arr);
//                    die;
//                    var_dump($flagTmp);
                    if ( $flagTmp ) {
//p($k2);
                        $cnt++;
                        $out[$k2]['data'] = $v2[2];
                        $out[$k2]['value'] = $k2;
                        $out[$k2]['originalname'] = $global_arr['config_array']['pill_prefix'] . $k2 . $global_arr['config_array']['pill_postfix'];
                        $out[$k2]['ai'] = implode(', ', $v2[0]);
                    }
                }
            }
            $flag2 = false;
            if ( $cnt < $max_cnt && $len > $needLen ) {
                foreach ( $search_list_arr as $k2 => $v2 ) {
                    foreach ( $v2[0] as $k3 => $v3 ) {
                        if ($len > strlen($v3)) {
                            continue;
                        }
                        $forEqName = strtolower(substr($v3, 0, $len));
                        if ($forEqName == $searchWord) {
                            if (isset($out[$k2])) {
                                continue;
                            }
                            $cnt++;
                            $out[$k2]['data'] = $v2[2];
                            $out[$k2]['originalname'] = $global_arr['config_array']['pill_prefix'] . $k2 . $global_arr['config_array']['pill_postfix'];
                            $out[$k2]['value'] = $k2 . ' (' . implode(', ', $v2[0]) . ')';
                            $out[$k2]['ai'] = implode(', ', $v2[0]);
                            $flag = true;
                            foreach ( $search_arr as $k33 => $v33 ) {
                                if ( !is_numeric(strpos(strtolower($out[$k2]['ai']), strtolower($v33))) ) {
                                    $flag = false;
                                } else {
                                    $flag2 = true;
                                }
                            }
                            if ( !$flag ) {
                                unset($out[$k2]);
                            }
                        }
                    }
                    if ( $flag2 && count($search_arr) > 1 ) {
                        //p($search_arr);
                        //die;

                    foreach ( $v2[1] as $k3 => $v3 ) {
                        if ( $len > strlen($v3)  ) {
                            continue;
                        }
                        $forEqName = strtolower(substr($v3, 0, $len));
                        if ( $forEqName == $searchWord ) {
                            if ( isset($out[$k2]) ) {
                                continue;
                            }
                            $cnt++;
                            $out[$k2]['data'] = $v2[2];
                            $out[$k2]['originalname'] = $global_arr['config_array']['pill_prefix'] . $k2 . $global_arr['config_array']['pill_postfix'];
                            $out[$k2]['value'] = $k2 . ' (' . ucfirst($v3) . ')';
                            $out[$k2]['ai'] = implode(', ', $v2[0]);
                        }
                    }
                    }
                }
            }
        }
        return $out;
    }
?>