<?php
	function cookie_set($name, $value, $time, $path='/', $domain=NULL) {
		// standart
		setcookie($name, $value, $time, $path, $domain);
		$_COOKIE[$name] = $value;
	}
?>