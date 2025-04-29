<?php
	 function file_outer($file_name) {
		header("Content-Disposition: attachment; filename=" . basename($file_name));
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
		header("Content-Description: File Transfer");
		header("Content-Length: " . filesize($file_name));
		flush(); // this doesn't really matter.
		$fp = fopen($file_name, "r");
		while (!feof($fp)) {
			echo fread($fp, 65536);
			flush(); // this is essential for large downloads
		}
		fclose($fp);
	 }
?>