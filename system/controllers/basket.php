<?php
    include(INC_DIR . '/get_bonus_arr.php');

	index($global_arr);
	
	function index($global_arr) {


        $noBonus = array(
            'Brand Levitra',
            'Brand Cialis',
            'Brand Viagra',
            'Erexin-V',
            'Hoodia',
            'Lipothin',
            'Ginseng',
            'Celadrin',
            'Benfotiamine',
            'Hyaluronic Acid',
            'VPXL',
	'Cialis Extra Dosage',
	'Cialis Black',
	'Red Viagra',
	'Viagra Vigour',
	'Levitra Extra Dosage',
	'Vimax'
        );

		$result_arr = array();
        $global_arr['smarty']->assign('order_total_price_discount_original', $global_arr['order_total_price_discount_original']);
        $global_arr['smarty']->assign('order_total_price_with_shipping_original', $global_arr['order_total_price_with_shipping_original']);

        include(DB_DIR . '/bonus_arr.php');
        $bonus_arr = get_bonus_data_arr();
        
        $bonus_arr = get_bonus_arr($global_arr['order_total_price'], $bonus_arr);



        $discount_error = false;
        if ( isset($_POST['discount']) ) {
        	my_set_cookie('discount_code', $_POST['discount_code'], SECONDS_IN_YEAR);
        	my_set_cookie('discount', 5, SECONDS_IN_YEAR);
            //var_dump(validate_discount($_POST['discount_code'] . "", $global_arr['config_array']));
        	if ( validate_discount($_POST['discount_code'] . "", $global_arr['config_array']) ) {
//                p($_COOKIE);
//                die;
				header('Location: ' . BASE_FOLDER . 'basket?ok');
        		die;
        	} else {
				$discount_error = true;
        	}
        }
        
        
        $form_lang = $_COOKIE['lang'];
        $global_arr['smarty']->assign('form_lang', $form_lang);
        $form_currency = $_COOKIE['currency'];
        
        $global_arr['smarty']->assign('form_currency', $form_currency);
        $form_country = $_COOKIE['country_name'];
        $global_arr['smarty']->assign('form_country', $form_country);
        $form_country_code = $_COOKIE['country_code'];
        $global_arr['smarty']->assign('form_country_code', $form_country_code);

        //my_set_cookie('order', NULL, SECONDS_IN_YEAR);
		if ( isset($_GET['id_pack']) ) {
			if ( $_GET['w'] > 0 ) {
				$global_arr['cookies_unser_order_arr']['order'][$_GET['id_pack']][3] += 1;
			} else {
				$global_arr['cookies_unser_order_arr']['order'][$_GET['id_pack']][3] -= 1;
			}
			$order_str = my_create_order_str($global_arr['cookies_unser_order_arr']['order']);
			my_set_cookie('order', $order_str, SECONDS_IN_YEAR);

			header('Location: ' . BASE_FOLDER . 'basket?ok');
			die;
		}

        if ( isset($_POST['update']) ) {
        	my_set_cookie('shipping', $_POST['shipping'], SECONDS_IN_YEAR);
        	foreach ( $_POST['order_count'] as $k => $v ) {
				$global_arr['cookies_unser_order_arr']['order'][$k][3] = $v;
				if ( $v == 0 ) {
					unset($global_arr['cookies_unser_order_arr']['order'][$k]);
        		}
        	}
        	
        	$order_str = my_create_order_str($global_arr['cookies_unser_order_arr']['order']);
		    my_set_cookie('order', $order_str, SECONDS_IN_YEAR);
		    my_set_cookie('bonus', $_POST['bonus'], SECONDS_IN_YEAR);
        	header('Location: ' . BASE_FOLDER . 'basket?ok');
			die;
        }
        
        
        if ( isset($_POST['checkout']) ) {
        	my_set_cookie('shipping', $_POST['shipping'], SECONDS_IN_YEAR);
        	foreach ( $_POST['order_count'] as $k => $v ) {
				/*
				$global_arr['cookies_unser_order_arr']['order'][$k][3] = $v;
				if ( $v == 0 ) {
					unset($global_arr['cookies_unser_order_arr']['order'][$k]);
        		}
        		*/
        	}
        	//my_set_cookie('order', $order_str, SECONDS_IN_YEAR);
		    my_set_cookie('bonus', $_POST['bonus'], SECONDS_IN_YEAR);
		    
			header('Location: ' . BASE_FOLDER . 'billing');
			die;
        }
        
        if ( isset($_GET['del']) ) {
			// delete from basket
			$e = intval($_GET['del']);
			unset($global_arr['cookies_unser_order_arr']['order'][$e]);
			
			$order_str = my_create_order_str($global_arr['cookies_unser_order_arr']['order']);
			
        	my_set_cookie('order', $order_str, SECONDS_IN_YEAR);
        	
			header('Location: ' . BASE_FOLDER . 'basket?ok');
			die;
        }

        $bonusOfFlag = true;
        if ( isset($global_arr['cookies_unser_order_arr']['order']) && count($global_arr['cookies_unser_order_arr']['order']) > 0 ) {
	        $result_arr = $global_arr['cookies_unser_order_arr']['order'];
	        foreach ( $result_arr as $k => $v ) {
				$result_arr[$k]['price'] = price_handler($result_arr[$k][4]);
                if ( !in_array($v[1], $noBonus) ) {
                    $bonusOfFlag = false;
                }
	        }	
		}
        if ( $bonusOfFlag ) {
            $bonus_arr = array();
        }
        $global_arr['smarty']->assign('bonus_arr', $bonus_arr);
		
		$country_no_ems = array(
			'FR','AF','AL','DZ','AS','AD','AO','AI','AG','AR','AM','AW',
			'AT','AZ','BS','BE','BZ','BJ','BO','BW','BR','BF','BI','CM',
			'CA','CF','TD','CL','CO','KM','CR','CU','CY','CZ','DK','DJ',
			'DM','DO','EC','SV','GQ','EE','FK','FO','FI','GF','PF','GA',
			'GM','DE','GI','GL','GD','GP','GU','GT','GN','GY','HT','HN',
			'IN','ID','IQ','IE','IT','JM','KZ','KI','KW','KG','LV','LB',
			'LS','LR','LY','LI','LT','LU','MG','MY','MV','ML','MT','MH',
			'MQ','MR','MX','MC','MS','MZ','MM','NL','AN','NC','NI','NE',
			'NG','MP','NO','PW','PA','PG','PY','PE','PH','QA','RE','RW',
			'SH','KN','LC','PM','VC','WS','SM','ST','SA','SC','SL','SK',
			'SI','SB','SO','ZA','LK','SR','SZ','SE','SY','TJ','TG','TL',
			'TT','TO','TR','TN','TC','UA','UY','UZ','VU','VE','EH','YE',
			'ZM','ZW','AF','BA','CD','CG','CI','HR','GW','VA','IR','KR',
			'LA','MK','FM','MD','SJ','VG','VI','ES'
		);
		$country_no_ems=array();


		if ( in_array(strtoupper($_COOKIE['country_code']), $country_no_ems) ) {
			unset($global_arr['config_array']['shipping']['EMS']);
		}
		$global_arr['smarty']->assign('config_array', $global_arr['config_array']);
		
		
		
		$global_arr['smarty']->assign('back_link', 'http://' . $_SERVER['HTTP_HOST'] . BASE_FOLDER . 'basket');
        $global_arr['smarty']->assign('result_arr', $result_arr);
        $global_arr['smarty']->assign('discount_error', $discount_error);
        $global_arr['smarty']->assign('title', $global_arr['config_array']['shop_title'] . ': Shopping cart');
        $global_arr['smarty']->assign('name', 'Shopping cart');
        $global_arr['smarty']->assign('cookies_unser_order_arr', $global_arr['cookies_unser_order_arr']);
		if ( isset($_POST['ajax']) ) {
			echo 'ok';
		} else {
			$global_arr['smarty']->display('basket.tpl');
		}

	}
?>