<?php
	index($global_arr);
	function index($global_arr) {
		
        $global_arr['smarty']->assign('title', 'Big Sale: -80% off on all meds. Time Limited Offer.');
		$global_arr['smarty']->display('index.tpl');
		//echo 'Hello! I am index.php controller.';
	}
?>