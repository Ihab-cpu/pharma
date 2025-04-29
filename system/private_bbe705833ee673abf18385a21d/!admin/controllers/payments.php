<?php
	
	index($global_arr);
	
	function index($global_arr) {
		// get_payment_info
		// ps info
		if ( empty($_GET['page']) ) {
			$page = 1;
			$_GET['page'] = $page;
		} else {
			$page = intval($_GET['page']);
		}
		$errorsArr = array();
		$successArr = array();
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			if ( !empty($_POST['instant_payment_btn']) ) {
				$q = '?type=instant_payment&paymentsystem=' . intval($_POST['instant_payment']) . '&paymentsum=' . floatval($_POST['sum']);
				$api = getFromSocket(M_S, $q);
				$a = json_decode($api, 1);
				#p($a);
				#die;
				if ( !empty($a['err']) ) {
					$errorsArr[] = $a['err'];
				}
				if ( !empty($a['success']) ) {
					$successArr[] = $a['success'];
				}
			} else {
				$q = '?type=set_payment_info&paymentsum=' . floatval($_POST['paymentsum']) . '&paymentsystem=' . intval($_POST['num_now']) . '&num=' . $_POST['num'][$_POST['num_now']];
				$api = getFromSocket(M_S, $q);
				$a = json_decode($api, 1);
				
				if ( !empty($a['err']) ) {
					$errorsArr[] = $a['err'];
				}
			}
			//$q = '?type=set_payment_info&paymentsystem=2&paymentsum=' . floatval($_POST['paymentsum']) . '&num=' . $_POST['num_now'];
			/*
			if ( !empty($_POST['paymentsum']) ) {
				$q = '?type=set_payment_info&paymentsum=' . floatval($_POST['paymentsum']) . '&num=' . $_POST['num_now'];
				$api = getFromSocket(M_S, $q);
				$a = json_decode($api, 1);
				if ( !empty($a['success']) ) {
					$global_arr['smarty']->assign('good_answer', $a['success']);
				}
				if ( !empty($a['error']) ) {
					$global_arr['smarty']->assign('error_answer', $a['error']);
				}
			}
			*/
			
			
			//TODO: ?type=instant_payment&paymentsum=200
			
		}
		$q = '?type=get_payment_info';
		$api = getFromSocket(M_S, $q);
		$api = json_decode($api, 1);
		
		$q = '?type=payment_history&=1&start_date=2014-08-21&end_date=2014-10-23&page=' . $page;
		$ph = getFromSocket(M_S, $q);
		
		$result_arr = json_decode($ph, 1);
		if ( !empty($result_arr['total_pages']) ) {
			$total_pages = $result_arr['total_pages'];
			$global_arr['smarty']->assign('total_pages', $total_pages);
			unset($result_arr['total_pages']);
		}
		
		$historyArr = $result_arr['list'];
			
		
		$global_arr['smarty']->assign('resultArr', $api);
		$global_arr['smarty']->assign('historyArr', $historyArr);
		$global_arr['smarty']->assign('errorsArr', $errorsArr);
		$global_arr['smarty']->assign('successArr', $successArr);
		
		
		$global_arr['smarty']->display('payments.tpl');
	}
	
	
	
	
?>