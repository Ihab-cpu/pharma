<?php
	function my_del_cookie($name, $path = '/') {
		setcookie($name, '', -1, $path);
        unset($_COOKIE[$name]);
	}
?>