<?php
	function php2js($val){
		if(is_array($val)) return my_arr2json($val);
		if(is_string($val)) return '"'.addslashes($val).'"';
		if(is_bool($val)) return 'Boolean('.(int) $val.')';
		if(is_null($val)) return '""';
		return $val;
	}
?>