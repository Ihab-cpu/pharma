<?php

	index($global_arr);

	function index($global_arr) {
		
        $global_arr['smarty']->assign('title', 'Testimonials :: ' . $global_arr['config_array']['shop_title']);
        $global_arr['smarty']->assign('name', 'Testimonials');
		$global_arr['smarty']->display('testimonials.tpl');
	}
?>