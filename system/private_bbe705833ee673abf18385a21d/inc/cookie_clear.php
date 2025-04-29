<?php
	function cookie_clear($name, $path = '/') {
		if ( array_key_exists($name, $_COOKIE) ) {
			setcookie($name, NULL, time()-100, $path);
		}
	}
?>
