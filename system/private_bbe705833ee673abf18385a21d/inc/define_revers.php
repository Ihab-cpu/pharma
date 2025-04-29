<?php
	function define_revers($string, $p,$flag=false) {
		//return true;
		$method = 'aes-256-cbc';
		$iv="3c2a574150a2b65d";
		if ( $flag == true ) {
			$a = base64_decode($string);// openssl_decrypt ($string, $method, $p, false, $iv);
		} else {
			$a = base64_encode($string);//$a = openssl_encrypt($string, $method, $p, false, $iv);
		}
		return $a;
	}
?>