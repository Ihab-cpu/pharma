<?php

	index($global_arr);

	function index($global_arr) {

        if ( isset($global_arr['urlArr']['folders'][1]) ) {
            $db = $global_arr['urlArr']['folders'][1];
            $f = DB_DIR . '/pages/' . $db . '/' . $global_arr['lang'] . '_title.php';
            $name = file_get_contents($f);
            $global_arr['smarty']->assign('name', $name);
            $global_arr['smarty']->assign('title', $name . ' :: ' . $global_arr['config_array']['shop_title']);
        }
        #p($global_arr['smarty']);
        #die;
		$global_arr['smarty']->display('page.tpl');
	}
?>