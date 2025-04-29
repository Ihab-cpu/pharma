<?php
	function file_counter_handler($file_name, $way=1) {
		$cnt = file_get_contents($file_name);
		
		if ( $way != 1 ) {
			$cnt = $cnt + $way;
		}
		//echo $cnt;
		$f = fopen($file_name, 'w+');
		fwrite($f, $cnt);
		fclose($f);
		// todo: check file
		return true;
	}
?>