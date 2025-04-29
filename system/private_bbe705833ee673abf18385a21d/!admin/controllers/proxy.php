<?php
	
	index($global_arr);
	
	function index($global_arr) {
		
		$global_arr['smarty']->assign('name', 'Proxy');
		$global_arr['smarty']->display('proxy.tpl');
	}
	
	
?>