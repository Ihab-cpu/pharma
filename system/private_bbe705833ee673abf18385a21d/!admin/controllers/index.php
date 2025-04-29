<?php
	index($global_arr);
	
	function index($global_arr) {
		$date = date('U');
		$dateNow = date('Y-m-d', $date);
		$dateLast = $date - 3600*24*2;
		$dateLast = date('Y-m-d', $dateLast);
		$url = '?p=stat_total&type=stat_date&date_start=' . $dateLast . '&date_end=' . $dateNow;
		$global_arr['smarty']->assign('name', 'CMS - Main page');
		$global_arr['smarty']->display('index.tpl');
	}
?>