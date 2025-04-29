<?php

	index($global_arr);

	function index($global_arr) {
        $global_arr['smarty']->assign('title', 'FAQ :: ' . $global_arr['config_array']['shop_title']);
        $global_arr['smarty']->assign('name', 'FAQ');
		$global_arr['smarty']->display('faq.tpl');
	}
?>