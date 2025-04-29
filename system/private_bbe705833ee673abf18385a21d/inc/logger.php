<?php
	function logger($file_name, $type = 1, $data_arr) {
#print_r($_POST);
#die;
		if (
			$_SERVER['REQUEST_URI'] == '/faq_js'
			||
			$_SERVER['REQUEST_URI'] == '/page_js'
			||
			$_SERVER['REQUEST_URI'] == '/testimonials_js'
			||
			isset($_GET['image'])
			||
			isset($_GET['from'])
			||
			isset($_GET['p']) && $_GET['p'] == 'about'
			||
			isset($_GET['p']) && $_GET['p'] == 'policy'
			||
			isset($_GET['p']) && $_GET['p'] == 'contact'
			||
			stripos($_SERVER['REQUEST_URI'],"ajax=1")
			
		) {
			return true;
		}
		if ( $type == 1 ) {
			set_log_string_format1($file_name, $data_arr);
		} else {
			$str = 'other format';
		}
		return true;
	}
	
	function set_log_string_format1($file_name, $data_arr) {

        if ( $_SERVER['REQUEST_URI'] == '/billing' ) {
            $COOKIE_SOURCE = $_POST;
            $data_arr['partner_id']=$_POST['partner_id'];
        } else {
            $COOKIE_SOURCE = $_COOKIE;
        }

		$uniq_flag = '0';
        if ( $_SERVER['REQUEST_URI'] != '/billing' ) {
            if ( !isset($COOKIE_SOURCE['uniq_flag']) ) {
                setcookie('uniq_flag', '1', time() + 86400, '/');
                $_COOKIE['uniq_flag'] = 1;
                $uniq_flag = 1;
            }
        }
		if ( isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ) {
			$accept_lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		} else {
			$accept_lang = '';
		}
		if ( isset($COOKIE_SOURCE['js_test']) ) {
			$js_test = 1;
		} else {
			$js_test = 0;
		}
		$referer = '';
        if ( $_SERVER['REQUEST_URI'] == '/billing' ) {
            $referer = 'self';//$_POST['referer'];
        } else {

            if (!empty($_SERVER['HTTP_REFERER'])) {
                $host = str_replace('www.', '', $_SERVER['HTTP_HOST']);
                $referer_base = $_SERVER['HTTP_REFERER'];
                $referer_base = str_replace('http://', '', $referer_base);
                $referer_base = str_replace('https://', '', $referer_base);
                $referer_base = str_replace('www.', '', $referer_base);
                $referer_base = explode('/', $referer_base);
                $referer_base = $referer_base[0];

                if ( strtolower($referer_base) != strtolower($host) ) {
                    setcookie('referer', $_SERVER['HTTP_REFERER'], time() + 3600 * 24 * 365, '/');
                    $referer = str_replace('http://', '', $_SERVER['HTTP_REFERER']);
                    $referer = str_replace('https://', '', $_SERVER['HTTP_REFERER']);
                    $referer = str_replace('www.', '', $_SERVER['HTTP_REFERER']);                    
                } else {
                    if ($_SERVER['HTTP_REFERER']) {
                        $referer = 'self';
                    } else {
                        $referer = NULL;
                    }
                }
            }
        }

        if ( !empty($COOKIE_SOURCE['trackid']) ) {
			$track_id = $COOKIE_SOURCE['trackid'];
        } else {
			$track_id = '';
        }
        if ( !empty($_GET['trackid']) ) {
            $track_id = $_GET['trackid'];
        }
        if ( !empty($COOKIE_SOURCE['subid']) ) {
			$sub_id = $COOKIE_SOURCE['subid'];
        } else {
			$sub_id = '';
        }
        if ( !empty($_GET['subid']) ) {
            $sub_id = $_GET['subid'];
        }
        $uniq_flag_checkout = 0;
        if (
            !empty($_POST['checkout'])
            &&
            !isset($_POST['back_to_step1'])
            &&
            !isset($_POST['btn_complete'])
            &&
            !isset($_POST['to_confirm'])
        ) {
            if ( empty($_COOKIE['ucheckout']) ) {
                setcookie('ucheckout', 1, time() + 86400);
                $uniq_flag_checkout = 1;
            }
        } else {
            if ( $_SERVER['REQUEST_URI'] == '/billing' ) {
                return true;
            }

        }
        $order = array();

        if ( !empty($_POST['checkout']) ) {

            $order['order']['order_count'] = $_POST['order_count'];
            $order['order']['order_name'] = $_POST['order_name'];
            $order['order']['order_dosage'] = $_POST['order_dosage'];
            $order['order']['order_price'] = $_POST['order_price'];
            $order['order']['order_price_user_currency'] = $_POST['order_price_user_currency'];
            $order['order']['order_type'] = $_POST['order_type'];
            $order['order']['order_pack_name'] = $_POST['order_pack_name'];
            $order['order']['order_count_in_pack'] = $_POST['order_count_in_pack'];
            $order['order']['order_price_per_pill'] = $_POST['order_price_per_pill'];
            $order['shipping'] =  $_POST['shipping'];
            $order['referer'] = $_POST['referer'];
            $order['subid'] = $sub_id;
            $order['track_id'] = $track_id;
            $order['discount'] = $_POST['discount_ok'];
            $order['ship_price'] = $_POST['ship_price_original'];
            $order['total_price'] = $_POST['order_total_price_with_shipping_original'];
	    $order['domain'] = str_replace('www.','',$_POST['shop_http_host']);
#            p($order);
#            die;
            $order = json_encode($order);
            $order = gzcompress($order);
            $order = base64_encode($order);

        }


		$str =
			$_SERVER['REMOTE_ADDR'] . "|*|" .
			date('U') . "|*|" .
			str_replace("www.",'',$_SERVER['HTTP_HOST']) . BASE_FOLDER . "|*|" .
			$referer . "|*|" .
			$track_id . "|*|" .
			$data_arr['template'] . "|*|" .
			$uniq_flag . "|*|" .
			$accept_lang . "|*|" .
			$js_test . "|*|" . 
			$uniq_flag_checkout . "|*|" .
			$_SERVER['REQUEST_URI'] . "|*|" .
			$_SERVER['HTTP_USER_AGENT'] . "|*|" .
			$data_arr['partner_id'] . "|*|" .
			$sub_id . "|*|" .
            $order .
			"\n"
		;
        #p($str);
        #die;
		
		$f = fopen($file_name, 'a+');
		fwrite($f, $str);
		fclose($f);
		return true;
	}
?>