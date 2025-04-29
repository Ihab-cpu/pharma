<?php
	//$private_folder = name_of_secret_folder();
	
	function name_of_secret_folder($path = './system/') {
		$dir = $path;
		$dirArr = scandir($dir);
		foreach ( $dirArr as $k => $v ) {
			if ( $v == '.' || $v == '..' ) {
				
			} else {
				if ( is_numeric(strpos($v, 'private_folder')) ) {
					
					return $v;
				}
			}
		}
		return false;
	}
	
	define('PRIVATE_SECRET_FOLDER', name_of_secret_folder($path));
	
	
?>