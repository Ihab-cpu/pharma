<?php
	function remove_dir($path) {
		if( file_exists($path) && is_dir($path) ) {
			$dirHandle = opendir($path);
			while (false !== ($file = readdir($dirHandle))) {
				if ($file!='.' && $file!='..') {
					$tmpPath=$path.'/'.$file;
					chmod($tmpPath, 0777);
					if (is_dir($tmpPath)) {
						remove_dir($tmpPath);
			   		} else {
			   			if(file_exists($tmpPath)) {
	  						unlink($tmpPath);
						}
	  				}
				}
			}
			closedir($dirHandle);
			if( file_exists($path) ) {
				rmdir($path);
			}
		}
	}
?>