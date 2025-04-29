<?php
	function read_ser_arr($file_name,$php_comments=false, $config_array = array()) {
		if ( !is_file($file_name) ) {
			if ( $config_array ) {
				$arr['template'] = $config_array['default_template'];
				$arr['extra_charge'] = $config_array['extra_charge'];
				return $arr;
			}
		}
		if ( $php_comments == 1 ) {
			$f = file($file_name);
			$ser = $f[2];
		} else {
			$ser = file_get_contents($file_name);
		}
		$arr = unserialize($ser);
		return $arr;
	}
?>