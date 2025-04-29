<?php
	function encode_string_with_sert($string) {
		$sert_file = DIR_SECRET_FOLDER . '/cert.crt';
		$certfile = file_get_contents($sert_file);
		$cnt2 = 0;
		$cnt3 = 0;
		$ln = strlen($string);
		$tmp_arr = array();
		for ( $i = 0; $i < $ln; $i++ ) {
			$cnt2++;
			if (  isset($tmp_arr[$cnt3]) ) {
				$tmp_arr[$cnt3] = $tmp_arr[$cnt3] . $string[$i];
			} else {
				$tmp_arr[$cnt3] = $string[$i];
			}
			if ( $cnt2 == 110 ) {
				$cnt3++;
				$cnt2 = 0;
			}
		}
		foreach ( $tmp_arr as $k => $v ) {
			$encrypte = NULL;
			openssl_public_encrypt($v, $encrypted, openssl_pkey_get_public($certfile));
			$encrypte = base64_encode($encrypted);
			$out_arr[] = $encrypte;
		}
		$out = implode('|x|x|x|', $out_arr);
		//echo $out;
		return $out;
	}
?>