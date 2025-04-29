<?php
	function clear_dir_arr($arr) {
		$badSymbolsArr = array(
			'.',
			'..',
			'.htaccess',
			'index.html',
			'index.php'
		);
		
		if ( count($arr) > 0 ) {
			foreach ( $arr as $k => $v ) {
				if ( in_array($v, $badSymbolsArr) ) {
					unset($arr[$k]);
				}
			}
		}
		
		return $arr;
	}
?>