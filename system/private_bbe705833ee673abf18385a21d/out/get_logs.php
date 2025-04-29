<?php
	// UDP LOG GET
	// 1 - get to this script
	$log_dir = './../db/logs';
	$log_file = $log_dir . '/log.txt';
	$log_file_copy = $log_dir . '/log_for_send.txt';
	if ( is_file($log_file_copy) ) {
		unlink($log_file_copy);
	}
	
	if ( is_file($log_file) ) {
		if ( rename($log_file, $log_file_copy) ) {
			echo file_get_contents($log_file_copy);
		}
	}
	// 2 - get copy file by BOT
echo "END_DATA_943735";	
?>