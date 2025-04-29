<?php
	index($global_arr);

	function index($global_arr) {
		
	    include(DB_DIR . '/faq/' . $global_arr['lang'] . '.php');
	    
	    foreach ( $data_arr as $k => $v ) {
    		$data_arr[$k][0] = str_replace("'", '&rsquo;', $data_arr[$k][0]);
			$data_arr[$k][0] = str_replace("\n", ' ', $data_arr[$k][0]);
			$data_arr[$k][0] = str_replace("\r", ' ', $data_arr[$k][0]);
			$data_arr[$k][1] = str_replace("'", '&rsquo;', $data_arr[$k][1]);
			$data_arr[$k][1] = str_replace("\n", ' ', $data_arr[$k][1]);
			$data_arr[$k][1] = str_replace("\r", ' ', $data_arr[$k][1]);
		}
	    $global_arr['smarty']->assign('result_arr', $data_arr);
    
    	$global_arr['smarty']->display('./../global/faq.tpl');
	}
?>