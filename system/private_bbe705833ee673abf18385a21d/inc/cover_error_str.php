<?php
	function cover_error_str($str) {
		$befor = '<span style="color:red;">';
		$after = '</span>';
		$str = $befor . $str . $after;
		return $str;
	}
?>