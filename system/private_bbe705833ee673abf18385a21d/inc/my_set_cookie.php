<?php
	function my_set_cookie($name, $value, $additional_time, $path = '/', $domain = '') {
		$time = time() + $additional_time;
		setcookie($name, $value, $time, $path, $domain);
        $_COOKIE[$name] = $value;
	}
?>