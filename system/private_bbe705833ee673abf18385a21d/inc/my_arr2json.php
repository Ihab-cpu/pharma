<?php
	function my_arr2json($arr){
		$json = array();
		foreach($arr as $k=>$val) $json[] = '"'.$k.'":'.php2js($val);
		if(!empty($json) && count($json) > 0) return '{'.implode(',', $json).'}';
		else return '';
	}
?>