<?php
	index($global_arr);

	function index($global_arr) {
		
		include(DB_DIR . '/testimonials/en.php');
		foreach ( $data_arr as $k => $v ) {
			$data_arr[$k][2] = htmlspecialchars($data_arr[$k][2]);
			$data_arr[$k][2] = str_replace("'", '&rsquo;', $data_arr[$k][2]);
		}
		$global_arr['smarty']->assign('result_arr', $data_arr);
		$global_arr['smarty']->display('./../global/testimonials.tpl');
	}
?>