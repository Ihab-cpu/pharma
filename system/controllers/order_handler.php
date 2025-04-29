<?php

	index($global_arr);

	function index($global_arr) {
        
        $inner = $_GET['i'];
        
        //$inner = urldecode($inner);
        //$order_arr = gzuncompress($order_arr, 2);
        //$inner = gzuncompress($inner);
        $global_arr['smarty']->assign('order_post', $inner);
        
		$global_arr['smarty']->display('order_handler.tpl');
	}
?>