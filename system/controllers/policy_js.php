<?php
	index($global_arr);

	function index($global_arr) {
		
	    $a = file_get_contents(DB_DIR . '/pages/policy/' . $global_arr['lang'] . '_content.php');
	    $a = str_replace("'", '&rsquo;', $a);
		$a = str_replace("\n", ' ', $a);
		$a = str_replace("\r", ' ', $a);
		
	    $global_arr['smarty']->assign('result_str', $a);
	    $global_arr['smarty']->display('./../global/policy.tpl');
	}
?>