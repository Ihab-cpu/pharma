<?php

	index($global_arr);

	function index($global_arr) {
		
        
        $global_arr['smarty']->assign('name', 'Page not found');
        $global_arr['smarty']->assign('title', 'Canadian Pharmacy: Page not found');
        
		$global_arr['smarty']->display('404.tpl');
	}
?>