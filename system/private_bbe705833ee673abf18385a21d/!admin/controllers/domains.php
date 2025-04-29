<?php
	
	index($global_arr);
	
	function domainCutter($s) {
		if ( substr($s, 0, 7) == 'http://' ) {
			$s = substr($s, 7);
		}
		if ( substr($s, 0, 8) == 'https://' ) {
			$s = substr($s, 8);
		}
		if ( substr($s, 0, 4) == 'www.' ) {
			$s = substr($s, 4);
		}
		return $s;
	}
	
	function index($global_arr) {
		$templatesArr = scandir(TEMPLATES_DIR);
		$templatesArr = clear_dir_arr($templatesArr);
		foreach ( $templatesArr as $k => $v ) {
			if ( $v == 'global' ) {
				unset($templatesArr[$k]);
				break;
			}
		}
		$domains_file = CONFIG_DIR . '/domains.txt';
		$issetDomains = file_get_contents($domains_file);
		$issetDomains = trim($issetDomains);
		$issetDomains = str_replace("\r", '', $issetDomains);
		$issetDomains = explode("\n", $issetDomains);
		
		if ( count($issetDomains) == 1 && !$issetDomains[0] ) {
			$issetDomains = array();
			//unset($issetDomains[0]);
			//die;
		}
		
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			if ( isset($_POST['add_domains']) && trim($_POST['new_domains']) ) {
				$_POST['new_domains'] = str_replace("\r", '', $_POST['new_domains']);
				$domains = explode("\n", $_POST['new_domains']);
				
				foreach ( $domains as $k => $v ) {
					$issetDomains[] = $_POST['template'] . '|' . domainCutter($v);
				}
				$issetDomains = implode("\n", $issetDomains);
				$result_before = strlen(file_get_contents($domains_file));
				$result = file_put_contents($domains_file, $issetDomains);
				if ( $result_before > $result || $result == $result_before ) {
					$global_arr['smarty']->assign('global_error', 'Can not write: ' . $domains_file);
				} else {
					$global_arr['smarty']->assign('global_status', 'Save settings is complete.');
				}
			} else if ( isset($_POST['save_domains']) ) {
				$_POST['isset_domains'] = str_replace("\r", '', $_POST['isset_domains']);
				$domains = $_POST['isset_domains'];
				$domains = explode("\n", $domains);
				foreach ( $domains as $k => $v ) {
					if ( !is_numeric(strpos($v, '|')) ) {
						unset($domains[$k]);
					}
					$tmp = explode('|', $v);
					if ( !empty($tmp[1]) ) {
						$tmp[1] = domainCutter($tmp[1]);
					}
					$domains[$k] = implode('|', $tmp);
				}
				$issetDomains = implode("\n", $domains);
				file_put_contents($domains_file, $issetDomains);
				$global_arr['smarty']->assign('global_status', 'Save settings is complete.');
			}
		}
		if ( is_array($issetDomains) ) {
			$issetDomains = implode("\n", $issetDomains);
		}
		$global_arr['smarty']->assign('issetDomains', $issetDomains);
		$global_arr['smarty']->assign('templatesArr', $templatesArr);
		$global_arr['smarty']->display('domains.tpl');
	}
?>