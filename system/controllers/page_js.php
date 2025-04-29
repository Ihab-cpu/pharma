<?php
	index($global_arr);

	function index($global_arr) {
		
		$c = $_GET['p'];
		$access_arr = array(
			'about',
			'policy',
			'contact',
			'aff',
		);
		if ( !in_array($c, $access_arr) ) {
			die();
		}
		$f = DB_DIR . '/pages/' . $c . '/' . $global_arr['lang'] . '_content.php';
	    $a = file_get_contents($f);
	    $a = str_replace("'", '&rsquo;', $a);
		$a = str_replace("\n", ' ', $a);
		$a = str_replace("\r", ' ', $a);

		$a = str_replace("14.95", SHIPPING_AIR_MAIL_PRICE_CONFIG, $a);
        $a = str_replace("24.95", SHIPPING_EMS_PRICE_CONFIG, $a);

	   
	    $global_arr['smarty']->assign('result_str', $a);
	    $global_arr['smarty']->display('./../global/page.tpl');
	}
    
    
?>