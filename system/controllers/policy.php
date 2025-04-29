<?php

	index($global_arr);

	function index($global_arr) {

		$global_arr['smarty']->assign('title', 'Policy :: ' . $global_arr['config_array']['shop_title']);
        $global_arr['smarty']->assign('name', 'Policy');
		$global_arr['smarty']->display('policy.tpl');

	}
?>