<?php
	$total_size = $_GET['total'];
	$path_file = $_GET['path_file'];
	
	$now_size = 400;
	
	echo filesize($path_file);
?>