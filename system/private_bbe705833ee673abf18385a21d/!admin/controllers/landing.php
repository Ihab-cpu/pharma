<?php
	
	index($global_arr);
	
	function index($global_arr) {
		
		$global_arr['smarty']->assign('name', 'Landing');
		$global_arr['smarty']->display('landing.tpl');
	}
	
	
?>