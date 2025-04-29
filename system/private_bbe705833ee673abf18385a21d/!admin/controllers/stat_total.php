<?php
	
	index($global_arr);
	
	function index($global_arr) {
		
		
		if ( empty($_GET['page']) ) {
			$page = 1;
			$_GET['page'] = $page;
		} else {
			$page = intval($_GET['page']);
		}
		
		if ( isset($_GET['date_start']) ) {
			$_SESSION['date_start'] = $_GET['date_start'];
		}
		if ( isset($_GET['date_end']) ) {
			$_SESSION['date_end'] = $_GET['date_end'];
		}
		#p($_SESSION);die;
		
		$result_arr = array();
		
		//$global_arr['config_array']['servers'][0] = define_revers($global_arr['config_array']['servers'][0], $decode_pass, 1);
		//p($global_arr['config_array']['servers']);
		//die;
		
		if ( !empty($_GET['type']) && !empty($_GET['date_start']) && !empty($_GET['date_end']) ) {
			$q = '/?type=' . urlencode(trim(stripslashes($_GET['type']))) . '&start_date=' . $_GET['date_start'] . '&end_date=' . $_GET['date_end'] . '&page=' . $page;
			
			$query = getFromSocket(M_S, $q);
			
			$result_arr = json_decode($query, 1);
			if ( !is_array($result_arr) ) {
				$global_arr['smarty']->assign('date_range_error', $query);
			}
			
			if ( !($query['q_result']) ) {
				$global_arr['smarty']->assign('no_data', 1);
			}
			
			//$answer = file_get_contents($query);
			
		}
		
		
		if ( !empty($result_arr['total_pages']) ) {
			$total_pages = $result_arr['total_pages'];
			$global_arr['smarty']->assign('total_pages', $total_pages);
			unset($result_arr['total_pages']);
		}
		if ( !empty($result_arr['stat']) ) {
			unset($result_arr['stat']);
		}
		if ( !empty($result_arr['q_result']) ) {	
			unset($result_arr['q_result']);
		}
		$global_arr['smarty']->assign('result_arr', $result_arr);
		
		if ( empty($_GET['type']) ) {	
			//$_GET['type'] = 1;
			$time = date('U');
			$end_date = date('Y-m-d', $time);
			$start_date = date('Y-m-d', $time - 3600 * 24 * 1);
			
			if ( !empty($_SESSION['date_start']) && !empty($_SESSION['date_end']) ) {
				$start_date = $_SESSION['date_start'];
				$end_date = $_SESSION['date_end'];
			}
			
			//$start_date = '2014-02-01';
			//$end_date = '2014-02-28';
			$url = '?p=stat_total&type=stat_date&date_start=' . $start_date . '&date_end=' . $end_date;
			die;
			header('Location: ' . $url);
			die;
		}
		
		$total_arr = array();
		if ( !empty($_GET['type']) ) {
			$type = $_GET['type'];
			if ( $type == 'stat_date' || $type == 'stat_shop' ) {
				$total_arr = array(
					'raw' => '',
					'uniq' => '',
					'bot' => '',
					'checkout' => '',
					'uniqcheckout' => '',
					'or' => '',
					'orc' => '',
					'ord' => '',
					'ro' => '',
					'total' => '',
					'turnover' => '',
					't_ratio' => '',
					'c_ratio' => '',
				
				);
				#p($query);
				#json_decode($query, 1);
				#p($result_arr);
				#die;
				if ( count($result_arr) > 0 ) {
					
					
					
					foreach ( $result_arr as $k => $v ) {
						$total_arr['raw'] += $v['raw'];
						$total_arr['uniq'] += $v['uniq'];
						$total_arr['bot'] += $v['bot'];
						$total_arr['checkout'] += $v['checkout'];
						$total_arr['uniqcheckout'] += $v['uniqcheckout'];
						$total_arr['or'] += $v['or'];
						if ( $v['orc'] < 0 ) {
							$v['orc'] = 0;
							$result_arr[$k]['orc'] = 0;
						}
						$total_arr['orc'] += $v['orc'];
						$total_arr['ord'] += $v['ord'];
						$total_arr['ro'] += $v['ro'];
						$total_arr['total'] += $v['total'];
						$total_arr['turnover'] += $v['turnover'];
						$tmp_sum = $v['or'] + $v['ro'] + $v['orc'] + $v['ord'];
						if ( $tmp_sum != 0 ) {
							$result_arr[$k]['t_ratio'] = $v['uniq'] / ( $tmp_sum );
							$result_arr[$k]['c_ratio'] = $v['uniqcheckout'] / ( $tmp_sum );
							$total_arr['t_ratio'] += $result_arr[$k]['t_ratio'];
							$total_arr['c_ratio'] += $result_arr[$k]['c_ratio'];
						} else {
							$result_arr[$k]['t_ratio'] = ' - ';
							$result_arr[$k]['c_ratio'] = ' - ';
						}
						
						
					}
					$total_arr['t_ratio'] = round($total_arr['t_ratio'] / count($result_arr), 0);
					$total_arr['c_ratio'] = round($total_arr['c_ratio'] / count($result_arr), 1);
					$global_arr['smarty']->assign('result_arr', $result_arr);
					$global_arr['smarty']->assign('total_arr', $total_arr);
				}
				//p($total_arr);
				//p($result_arr);
				//die;
				$global_arr['smarty']->display('stat_date.tpl');
			} else if ( $type == 'checkouts' ) {
				$global_arr['smarty']->display('stat_checkout.tpl');
			} else if ( $type == 'referer_url' || $type == 'referer_domain' ) {
				
				if ( count($result_arr) > 0 ) {
					foreach ( $result_arr as $k => $v ) {
						if ( $v['or'] != 0 ) {
							$result_arr[$k]['ratio'] = $v['referercount'] / ( $v['or'] );
						} else {
							$result_arr[$k]['ratio'] = 0;
						}
						if ( empty($total_arr['referercount']) ) {
							$total_arr['referercount'] = $v['referercount'];
						} else {
							$total_arr['referercount'] += $v['referercount'];
						}
						if ( empty($total_arr['or']) ) {
							$total_arr['or'] = $v['or'];
						} else {
							$total_arr['or'] += $v['or'];
						}
						if ( empty($total_arr['profit']) ) {
							if ( !empty($v['profit']) ) {
								$total_arr['profit'] = $v['profit'];
							}
							
						} else {
							$total_arr['profit'] += $v['profit'];
						}
						if ( empty($total_arr['total']) ) {
							$total_arr['total'] = $v['total'];
						} else {
							$total_arr['total'] += $v['total'];
						}
					}
					
					$global_arr['smarty']->assign('result_arr', $result_arr);
					$global_arr['smarty']->assign('total_arr', $total_arr);
				}
				$global_arr['smarty']->display('stat_ref.tpl');
			} else if ( $type == 'track' ) {
				p($answer);
				die;
			} else if ( $type == 'orders_products' ) {
				$global_arr['smarty']->display('stat_orders.tpl');
			} else if ( $type == 'orders_top' ) {
				p($answer);
				die;
				$global_arr['smarty']->display('stat_orders.tpl');
			} else if ( $type == 'user_info' ) {
				$global_arr['smarty']->display('stat_user_info.tpl');
			} else {
				p($answer);
				die;
			}
			
		}
			
	}
	
	function sort_data($data, $attr, $to) {
		
	}
	
	function groupe_data($data, $attr) {
		
	}	
?>