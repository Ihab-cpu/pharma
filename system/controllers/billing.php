<?php
session_start();


	index($global_arr);



	function bill_stop($back = NULL) {
	$out = '<h2>Session expired</h2>';
	if ( $back ) {
	if ( !empty($_COOKIE['back_link']) ) {
	$back = $_COOKIE['back_link'];
	}
	$out .= '<a href="' . htmlspecialchars($back) . '">Back to shop</a>';
	}
	return $out;
	}


	function index($global_arr) {
        $template_flg = false;
        if ( count($_POST) == 0 ) {
        if ( !empty($_SESSION['last_order']) ) {
        $_POST = $_SESSION['last_order'];
        $template_flg = true;
        } else {
        echo bill_stop('javascript:window.history.back(-1);');
        die;
        }
        }
        $alert = array();

		if ( isset($_POST['to_confirm']) ) {
			setcookie('to_confirm', 2, time() + 86400);
		} else {
            setcookie('to_confirm', 1, time() + 86400);
		}



		if ( isset($_POST['serpost']) ) {
			$arr = $_POST['serpost'];
			$arr = base64_decode($arr);
			$arr = unserialize($arr);
			if ( is_array($arr) ) {
				$_POST = $arr;
			}
				#p($arr);
			#die;
			//$_POST =
		}

		$serpost = serialize($_POST);
		$serpost = base64_encode($serpost);
		
		$global_arr['smarty']->assign('serpost', $serpost);

        $disc = $_POST['discount_in_user_currency'];
		$global_arr['smarty']->assign('disc', $disc);
		
        
	    $insurance_price = 4.95;
	    
	    $inner_unser = array();

        #p($global_arr['config_array']['currency'][$global_arr['currency']][0]);

        #p($_POST);
        #die;
        
        $insurance_price_user = $insurance_price * $_POST['currency_coef'];
        $insurance_price = round($insurance_price, 2);
        $insurance_price_user = round($insurance_price_user, 2);
        
        
        $global_arr['smarty']->assign('title', 'Secure Checkout Page: 256-bit secure connection established');
        $date_start = date('Y') - 18;
        $date_end = date('Y') - 100;
        $date_end = $date_start - $date_end;
        $date_now = date('Y');
        $global_arr['smarty']->assign('date_start', $date_start);
        $global_arr['smarty']->assign('date_end', $date_end);
        $global_arr['smarty']->assign('date_now', $date_now);
        
        
        $global_arr['smarty']->assign('insurance_price', $insurance_price);
        $global_arr['smarty']->assign('insurance_price_user', $insurance_price_user);
        $global_arr['smarty']->assign('currency_symbol', ($_POST['currency_symbol']));
        // include country arr
        include(INC_DIR . '/data/country_arr.php');
        include(INC_DIR . '/data/state_arr.php');
        foreach ( $country_arr as $k => $v ) {
            $countryBy2Code[$v[0]] = $v[1];
        }
        $buy_arr = array();
        
        foreach ( $_POST['order_name'] as $k => $v ) {
			$buy_arr[$k]['name'] = $v;
			$buy_arr[$k]['cnt'] = $_POST['order_count'][$k];
			$buy_arr[$k]['pack_name'] = ($_POST['order_pack_name'][$k]);
			$buy_arr[$k]['dosage'] = $_POST['order_dosage'][$k];
			$buy_arr[$k]['type'] = $_POST['order_type'][$k];
			$buy_arr[$k]['cnt_in_pack'] = $_POST['order_count_in_pack'][$k];
			$buy_arr[$k]['price'] = round($_POST['order_price'][$k], 2);
			$buy_arr[$k]['price_user_currency'] = round($_POST['order_price_user_currency'][$k], 2);
			$buy_arr[$k]['price_full'] = round($_POST['order_price'][$k] * $_POST['order_count'][$k], 2);
			$buy_arr[$k]['price_user_currency_full'] = round($_POST['order_price_user_currency'][$k] * $_POST['order_count'][$k], 2);
			$buy_arr[$k]['order_price_per_pill'] = $_POST['order_price_per_pill'][$k];
			//p($buy_arr[$k]['order_price_per_pill']);
		}
		
		
		$bonus_dosage = 100;
		if  ( $_POST['bonus'] != 'Viagra' ) {
			$bonus_dosage = 20;
		}
		if ( !empty($_POST['bonus']) ) {
			$buy_arr['bonus'] = array(
				'name' => $_POST['bonus'],
				'cnt' => 1,
				'pack_name' => ('pills'),
				'dosage' => $bonus_dosage,
				'type' => 'mg',
				'cnt_in_pack' => $_POST['bonus_cnt'],
				'price_full' => '',
				'price_user_currency_full' => '',
			);
		}
		
		if ( empty($buy_arr['shipping']) ) {
			if ( !empty($_POST['shipping']) ) {
				$shipping = $_POST['shipping'];
			} else {
				$shipping = '';
			}
			$buy_arr['shipping'] = array(
				'name' => $shipping,
				'cnt' => 1,
				'pack_name' => '',
				'dosage' => '',
				'type' => '',
				'cnt_in_pack' => '',
				'price' => $_POST['ship_price'],
				'price_user_currency' => $_POST['ship_price'],
				'price_full' => $_POST['ship_price'],
				'price_user_currency_full' => $_POST['ship_price'],
			);
		}
				
		if ( empty($buy_arr['insurance']) ) {
			$buy_arr['insurance'] = array(
				'name' => 'Shipping Insurance',
				'cnt' => 1,
				'pack_name' => '',
				'dosage' => '',
				'type' => '',
				'cnt_in_pack' => 1,
				'price' =>  $insurance_price,
				'price_user_currency' => $insurance_price_user,
				'price_full' => $insurance_price,
				'price_user_currency_full' => $insurance_price_user,
			);
			
		} else {
			
		}
		
		if ( !empty($_POST['insurance']) ) {
			$price_total = $_POST['price_total'] + $insurance_price_user;
			$price_total_original = $_POST['order_total_price_with_shipping_original'] + $insurance_price;
		} else {
			if ( empty($_POST['back_to_step1']) ) {
				if ( !empty($_POST['btn_complete']) || !empty($_POST['to_confirm']) ) {
					$price_total = $_POST['price_total'];
					$price_total_original = $_POST['order_total_price_with_shipping_original'];
				} else {
					
					$price_total = $_POST['price_total'] + $insurance_price_user;
					$price_total_original = $_POST['order_total_price_with_shipping_original'] + $insurance_price;
				}
			} else {
				$price_total = $_POST['price_total'] + $insurance_price_user;
				$price_total_original = $_POST['order_total_price_with_shipping_original'] + $insurance_price;
			}
		}
		
		$global_arr['smarty']->assign('price_total', $price_total);
		$global_arr['smarty']->assign('price_total_original', $price_total_original);
		$global_arr['smarty']->assign('buy_arr', $buy_arr);
		$global_arr['smarty']->assign('countryBy2Code', $countryBy2Code);

        $month_arr = array();
        $years_arr = array();
        $year = date('Y');
        $global_arr['smarty']->assign('date_year', $year);
        $month = date('m');
        $global_arr['smarty']->assign('date_month', $month);
        $year_end = $year + 10;
        for ( $i = $year; $i < $year_end; $i++ ) {
			$years_arr[] = $i;
        }
        $global_arr['smarty']->assign('years_arr', $years_arr);
        for ( $i = 1; $i < 13; $i++ ) {
        	if ( strlen($i) == 1 ) {
				$d = '0' . $i;
        	} else {
				$d = $i;
        	}
			$month_arr[] = $d;
        }
        unset($d);
        $global_arr['smarty']->assign('month_arr', $month_arr);
        if ( $template_flg ) {
        $global_arr['smarty']->display('../global/billing/billing_confirm.tpl');
        die;
        }
        if ( isset($_POST['btn_complete']) || isset($_POST['to_confirm']) ) {
			// check fields
			// preprocessing
			$my_post = array();
			$error_arr = array();
			foreach ( $_POST as $k => $v ) {
				if ( !is_array($v) ) {
					$my_post[$k] = trim($v);
				} else {
					foreach ( $v as $k2 => $v2 ) {
						$my_post[$k][$k2] = trim($v2);
					}
				}
			}

            $validLatin = array(
                'fld_first_name',
                'fld_last_name',
                'fld_city',
                'fld_zip_code',
                'fld_street_adress',
                'fld_card_holder_name',
                'fld_first_name2',
                'fld_last_name2',
                'fld_city2',
                'fld_zip_code2',
                'fld_street_adress2'
            );
            $pattern = "/^[a-z0-9 №[:punct:]]+$/i";
            foreach ( $validLatin as $k => $v ) {
                if ( trim($v) != '' ) {
                    $w = trim($_POST[$v]);
                    $w = str_replace("\n", '', $w);
                    $w = str_replace("\r", '', $w);
                    if ( $w ) {
                        if ( !preg_match($pattern,  $w) ) {
                            $error_arr[$v] = 'Error! Latin only.';
                        }
                    }
                }
            }

			if ( $my_post['fld_first_name'] == '' ) {
				$error_arr['fld_first_name'] = 'Error! Empty field.';
			}
			if ( $my_post['fld_last_name'] == '' ) {
				$error_arr['fld_last_name'] = 'Error! Empty field.';
			}
			if ( $my_post['fld_street_adress'] == '' ) {
				$error_arr['fld_street_adress'] = 'Error! Empty field.';
			}
			if ( $my_post['fld_city'] == '' ) {
				$error_arr['fld_city'] = 'Error! Empty field.';
			}
			if ( $my_post['fld_zip_code'] == '' ) {
				$error_arr['fld_zip_code'] = 'Error! Empty field.';
			}
			if ( $my_post['fld_state'] == '' ) {
				$error_arr['fld_state'] = 'Error! Empty field.';
			}
			if ( $my_post['fld_country'] == '' ) {
				$error_arr['fld_country'] = 'Error! Empty field.';
			}
			if ( $my_post['fld_phone'] == '' ) {
				$error_arr['fld_phone'] = 'Error! Empty field.';
			}
			if ( $my_post['fld_email'] == '' ) {
				$error_arr['fld_email'] = 'Error! Empty field.';
			} else {
				// check email
				if ( !is_numeric(strpos($my_post['fld_email'], '@')) && !is_numeric(strpos($my_post['fld_email'], '.'))  ) {
					$error_arr['fld_email'] = 'Error! Bad format.';
				}
			}
			if ( $my_post['fld_email2'] != '' && !is_numeric(strpos($my_post['fld_email2'], '@')) && !is_numeric(strpos($my_post['fld_email'], '.')) ) {
				// check email 2
				$error_arr['fld_email2'] = 'Error! Bad format.';
			}
			if ( $my_post['fld_payment_type'] == 'fld_payment_type_credit_card' ) {
				// credit card fields check
				if ( $my_post['fld_credit_card_type'] == '' ) {
					$error_arr['fld_credit_card_type'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_card_holder_name'] == '' ) {
					$error_arr['fld_card_holder_name'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_credit_card_no'] == '' ) {
					$error_arr['fld_credit_card_no'] = 'Error! Empty field.';
				} else {
					// luhn validate
					include(INC_DIR . '/luhn_validate.php');
					
					if ( !luhn_validate('' . $my_post['fld_credit_card_no']) ) {
						//echo 1;
						$error_arr['fld_credit_card_no'] = 'Error! Bad credit card #.';
					}
				}
				if ( $my_post['fld_cvc_cvv2'] == '' ) {
					$error_arr['fld_cvc_cvv2'] = 'Error! Empty field.';
				}
				// credit card date validate
				if ( 
					$year > $my_post['fld_exp_date_2']
					||
					( $year == $my_post['fld_exp_date_2'] && $month > $my_post['fld_exp_date_1'] )
				) {
					$error_arr['exp_date'] = 'Error! Bad credit card date';
				}
			} else {
				// eCheck fields check
				if ( $my_post['fld_eCheck_client_name'] == '' ) {
					$error_arr['fld_eCheck_client_name'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_eCheck_bank_name'] == '' ) {
					$error_arr['fld_eCheck_bank_name'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_eCheck_account_num'] == '' ) {
					$error_arr['fld_eCheck_account_num'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_eCheck_bank_routing_num'] == '' ) {
					$error_arr['fld_eCheck_bank_routing_num'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_eCheck_check_num'] == '' ) {
					$error_arr['fld_eCheck_check_num'] = 'Error! Empty field.';
				}
				if ( $my_post['signature'] == '' ) {
					$error_arr['fld_eCheck_signature'] = 'Error! Please sign the check using your mouse.';
				}
			}
			if ( isset($my_post['bill_shipping_is_different']) ) {
				// check shipping fields
				if ( $my_post['fld_first_name2'] == '' ) {
					$error_arr['fld_first_name2'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_last_name2'] == '' ) {
					$error_arr['fld_last_name2'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_street_adress2'] == '' ) {
					$error_arr['fld_street_adress2'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_city2'] == '' ) {
					$error_arr['fld_city2'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_zip_code2'] == '' ) {
					$error_arr['fld_zip_code2'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_state2'] == '' ) {
					$error_arr['fld_state2'] = 'Error! Empty field.';
				}
				if ( $my_post['fld_country2'] == '' ) {
					$error_arr['fld_country2'] = 'Error! Empty field.';
				}
			}
			
			// if all is good

			if ( count($error_arr) == 0 ) {
				
				// step2
				$global_arr['smarty']->assign('step', 'step2');
				if ( !isset($_POST['to_confirm']) ) {
					//$global_arr['smarty']->assign('order_arr', $inner_unser);\
        			$global_arr['smarty']->display('../global/billing/billing_check.tpl');
        			die;
        		}
				// save order and go to confirm 
				#$my_post['servers']['http_host'] = trim($_POST['shop_http_host'], 'www.');
				if (substr($_POST['shop_http_host'],0,4) == 'www.' ) $_POST['shop_http_host'] = substr($_POST['shop_http_host'],4);
				$my_post['servers']['http_host'] = $_POST['shop_http_host'];
				$my_post['servers']['http_accept'] = $_SERVER['HTTP_ACCEPT'];
				if ( !empty($_SERVER['HTTP_ACCEPT_CHARSET']) ) {
					$my_post['servers']['http_accept_charset'] = $_SERVER['HTTP_ACCEPT_CHARSET'];
				}
				
				$my_post['servers']['http_accept_encoding'] = $_SERVER['HTTP_ACCEPT_ENCODING'];
				$my_post['servers']['http_user_agent'] = $_SERVER['HTTP_USER_AGENT'];

				if ( !empty($_COOKIE['referer']) ) {
					$my_post['servers']['http_referer'] = $_COOKIE['referer'];
				} else {
					$my_post['servers']['http_referer'] = '';
				}
				//$my_post['servers']['http_referer'] = $_SERVER['HTTP_REFERER'];
				$my_post['servers']['http_accept_language'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
				if ( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
					$my_post['servers']['http_x_forwarded_for'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
				}
				$my_post['servers']['remote_addr'] = $_SERVER['REMOTE_ADDR'];
				if ( isset($_SERVER['HTTP_FORWARDED']) ) {
					$my_post['headers']['http_forwarded'] = $_SERVER['HTTP_FORWARDED'];
				}
				if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
					$my_post['servers']['http_x_forwarded_for'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
				}
				if ( isset( $_SERVER['HTTP_VIA'] ) ) {
					$my_post['servers']['http_via'] = $_SERVER['HTTP_VIA'];
				}
				if ( isset($_SERVER['HTTP_PROXY_CONNECTION']) ) {
					$my_post['servers']['http_proxy_connection'] = $_SERVER['HTTP_PROXY_CONNECTION'];
				}
				if ( isset($_SERVER['HTTP_CACHE_CONTROL']) ) {
					$my_post['servers']['http_cache_control'] = $_SERVER['HTTP_CACHE_CONTROL'];
				}

				$my_post['shop_settings'] = $global_arr['private_config_array'];

	            //if ( $global_arr['config_array']['extra_charge'] == 0 ) {
	            $my_post['shop_settings']['extra_charge'] = $_POST['extra_charge'];
                $my_post['design'] = $_POST['design'];
                $my_post['partner_id'] = $_POST['partner_id'];
	            //}
	            unset($my_post['extra_charge']);
				$my_post['discount'] = floatval($_POST['discount_ok']);


                if ( $_COOKIE['to_confirm'] == 1 ) {


					include( INC_DIR . '/encode_string_with_sert.php');
					$user['fldata'] = '';
					$fldata = explode("&", substr($my_post['check_data']['fldata'],0,8192));
					foreach ($fldata as $item) {
						if(strpos($item, "fl_fonts=") !== false) {
							$user['fldata'] = $user['fldata'] . "fl_fonts=".md5(substr($item, 9))."&";
						} else {
							$user['fldata'] = $user['fldata'] . $item.'&';
						}
					}
					$my_post['check_data']['fldata'] = $user['fldata'];
					//$my_post['order_total_price_with_shipping_original'] = $my_post['price_total'];
                    #p($my_post);
                    #die;
					if ( !empty($my_post['order_price']['insurance']) ) {
                        #die;
						$my_post['order_total_price_with_shipping_original'] += $my_post['order_price']['insurance'];
					}

					$my_post['currency_symbol'] = $global_arr['config_array']['currency'][$my_post['form_currency']][1];
                    // DEBUG BILLING STEP 3
                    //p(json_decode(base64_decode($my_post['xspy'])));
                    //die;
					$order = serialize($my_post);
					$order = encode_string_with_sert($order);
					$dir = DB_DIR . '/orders/' . date('Y-m-d') . '/';
					if ( !is_dir($dir) ) {
						mkdir($dir);
					}
					
					$f_name = date('U') . rand(1000, 9999);
					$f = fopen($dir . $f_name, 'w+');
					fwrite($f, $order);
					fclose($f);
				} else {
                    $alert[] = bill_stop('javascript:window.history.back(-1);');
                    $global_arr['smarty']->assign('alert', $alert);
				}
				$len = strlen($_POST['fld_credit_card_no']);
				$len_end = $len - 4;
				for ( $i = 0; $i < strlen($_POST['fld_credit_card_no']); $i++ ) {
					if ( $i > 4 && $i < $len_end ) {
						$_POST['fld_credit_card_no'][$i] = '*';
					}
				}
				$my_post['date'] = date('Y-m-d');
                //my_set_cookie('block_dubl', 1, 3600*24*31);
				setcookie('back_link', $_POST['back_link'], time() + 86400 * 365);
				$_SESSION['last_order'] = $_POST;
				header('Location: ?complete');
				die;
				$global_arr['smarty']->display('../global/billing/billing_confirm.tpl');
				die;

			} else {
				$global_arr['smarty']->assign('error_arr', $error_arr);
			}
        }

        //die;
        $global_arr['smarty']->assign('country_arr', $country_arr);
        $global_arr['smarty']->assign('state_arr', $state_arr);
		//$global_arr['smarty']->assign('order_arr', $inner_unser);
        //my_del_cookie('block_dubl');
		$global_arr['smarty']->assign('showuscounter', 1);
        $global_arr['smarty']->display('../global/billing/billing.tpl');
	}
?>