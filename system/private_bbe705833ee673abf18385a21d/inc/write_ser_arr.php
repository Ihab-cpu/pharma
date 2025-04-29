<?php
function write_ser_arr($file_name, $array, $php_comments=false) {
    if ( is_array($array) ) {


        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if (is_array($v2)) {
                        foreach ($v2 as $k3 => $v3) {
                            if (is_array($v3)) {
                                foreach ($v3 as $k4 => $v4) {
                                    if (!is_array($v4)) {
                                        $array[$k][$k2][$k3][$k4] = serializeValide($array[$k][$k2][$k3][$k4]);
                                    }
                                }
                            } else {
                                $array[$k][$k2][$k3] = serializeValide($array[$k][$k2][$k3]);
                            }
                        }
                    } else {
                        $array[$k][$k2] = serializeValide($array[$k][$k2]);
                    }
                }
            } else {
                $array[$k] = serializeValide($array[$k]);
            }
        }
    }
	$ser = serialize($array);
	if ( $php_comments == true ) {
		$ser = "<?php
/*
" . $ser . "
*/
?>";

	}
	$f = fopen($file_name, 'w+');
	fwrite($f, $ser);
	fclose($f);
	if ( !is_file($file_name) ) {
		return false;
	}
	return true;
}



function serializeValide($s) {
	$s = str_replace("\r", '', $s);
	$s = str_replace("\n", '', $s);
	return $s;
}

?>