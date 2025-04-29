<?php

define('HOST', 'domain.com OR IP');
define('FLAG_CACHE', 1);
define('FOLDER_CACHE', 'proxy_cache');
//$_COOKIE['id'] = 1;//fix partner id


//-----------------------------------------
	$_COOKIE['proxy'] = "2001088";
	$a = explode(':', HOST);
	if ( isset($a[1]) ) {
		$port = $a[1];
	} else {
		$port = 80;
	}
	define('MY_HOST', $a[0]);
	define('MY_PORT', $port);
	
	
	$can_not_cache = false;
	
	if ( FLAG_CACHE ) {
		if ( !is_dir(FOLDER_CACHE) ) {
			@mkdir(FOLDER_CACHE);
		}
		if ( !is_dir(FOLDER_CACHE) ) {
			die('Can not create cache folder: ' . FOLDER_CACHE);
			$can_not_cache = true;
		}
	} else {
		$can_not_cache = true;
	}
	
	$ext = explode(".", $_SERVER['REQUEST_URI']);
	$ext = strtolower($ext[count($ext) - 1]);
	
	if ( $ext == 'jpg' || $ext == 'jpeg' ) {
		header('Content-type: image/jpeg');
	} else if ( $ext == 'gif' ) {
		header('Content-type: image/gif');
	} else if ( $ext == 'png' ) {
		header('Content-type: image/png');
	} else if ( $ext == 'css' ) {
		header('Content-type: text/css');
	} else if ( $ext == 'js' ) {
		header('Content-type: text/javascript');
	} else {
		header('Content-type: text/plain');
	}
	if ( 
		$ext == 'jpg'
		||
		$ext == 'jpeg'
		||
		$ext == 'gif'
		||
		$ext == 'png'
		||
		$ext == 'css'
		||
		$ext == 'js'
		||
		$ext == 'swf'
		
	 ) {
	 	
	 	$url_path = 'http://' . MY_HOST . ':' . MY_PORT . '/' . $_SERVER['REQUEST_URI'];
	 	$dirsArr = explode('/', $_SERVER['REQUEST_URI']);
	 	$f_name = $dirsArr[count($dirsArr) - 1];
	 	unset($dirsArr[count($dirsArr) - 1]);
	 	$path = '';
	 	#p($dirsArr);
	 	$dirsArr[0] = FOLDER_CACHE;
	 	#die;
	 	foreach ( $dirsArr as $k => $v ) {
			if ( $v == '' ) {
				unset($dirsArr[$k]);
				continue;
			} else {
				$path .= '/' . $v;
				if ( FLAG_CACHE ) {
					if ( !is_dir('.' . $path) ) {
						mkdir('.' . $path);
					}
				}
			}
	 	}
	 	#die;
	 	
	 	
	 	$file_path = str_replace('.', '_dot_', $_SERVER['REQUEST_URI']);
	 	$file_path = str_replace('?', '_q_', $file_path);
	 	$file_path = './' . FOLDER_CACHE . '/' . MY_HOST  . ':' . MY_PORT . '___' . str_replace('/', '___', $file_path);
	 	
	 	
	 	$file_path = './' . $path  . '/' . $f_name;
	 	
	 	
	 	
	 	if ( $file_path == 'index.php' ) {
			 die('die');
	 	}
	 	if ( is_file($file_path) && !$can_not_cache ) {
			$cont = file_get_contents($file_path);
	 	} else {
	 		$fp = @fsockopen (MY_HOST, MY_PORT, $errno, $errstr, 30);
			if (!$fp) {
				echo "Connect error";
				die;
			}
	 		$query = "GET {$_SERVER['REQUEST_URI']} HTTP/1.0\r\n";
			$query .= "Host: " . MY_HOST . ':' . MY_PORT . "\r\n";
			$query .= "Connection: Close\r\n";
			$query .= "\r\n";
			
			fwrite($fp, $query);
			$cont = '';
	 		while (!feof($fp)) {
				$cont .= fgets($fp, 4000);
			}
			fclose($fp);
			$cont = explode("\r\n\r\n", $cont, 2);
			$cont = $cont[1];
			if ( $cont ) {
				file_put_contents($file_path, $cont);
			}
	 	}
		echo $cont;
	} else {
		if ( empty($page[1]) ) {
			$page = array();
			$page[0] ='';
			$page[1] = '';
		}
		if ( is_file('.' . $_SERVER['REQUEST_URI'] . $page[1]) && !$can_not_cache ) {
			if ($_SERVER['REQUEST_URI']!="/index.php") echo file_get_contents('.' . $_SERVER['REQUEST_URI'] . $page[1]);
			die;
		}
		getPage();
	}
	
	
	function getPage() {
		/*session_start();*/
		$address = MY_HOST;
		$fp = @fsockopen (MY_HOST, MY_PORT, $errno, $errstr, 30);
		if (!$fp) {
			echo "Connect error";
			die;
		}
		$request = '/';//'?PHPSESSID=' . $_COOKIE['PHPSESSID'];
		if ( $_SERVER['REQUEST_URI'] != '/' ) {
			$request = $_SERVER['REQUEST_URI'];
		}
		$post_headers = '';
		$method = 'GET';
		if ( count($_POST) > 0 ) {
			$method = 'POST';
			foreach ( $_POST as $k => $v ) {
				if ( is_array($v) ) {
					foreach ( $v as $k2 => $v2 ) {
						$tmp[] = $k . '[' . $k2 . ']' . '=' . urlencode($v2);
					}
					$post_headers[] = implode('&', $tmp);
				} else {
					
					$post_headers[] = $k . '=' . urlencode($v);
				}
				
			}
			$post_headers = implode('&', $post_headers);
		}
		$query = "{$method} {$request} HTTP/1.0\r\n";
		$query .= "Host: " . MY_HOST . ':' . MY_PORT . "\r\n";
		$cookie_arr = array();
		if ( count($_COOKIE) > 0 ) {
			foreach ( $_COOKIE as $k => $v ) {
				if ( !is_numeric(strpos('history=', $k)) ) {
					$cookie_arr[] = urlencode($k) . '=' . urlencode(trim($v));
				}
			}
		}
		if ( isset($_SERVER['HTTP_REFERER']) ) {
			$query .= "REFERER2: " . $_SERVER['HTTP_REFERER'] . "\r\n";
		}
		if ( isset($_SERVER['HTTP_ACCEPT']) ) {
			$query .= "ACCEPT: " . $_SERVER['HTTP_ACCEPT'] . "\r\n";
		}
		if ( isset($_SERVER['HTTP_ACCEPT_CHARSET']) ) {
			$query .= "ACCEPTCHARSET: " . $_SERVER['HTTP_ACCEPT_CHARSET'] . "\r\n";
		}
		if ( isset($_SERVER['HTTP_ACCEPT_ENCODING']) ) {
			$query .= "ACCEPTENCODING: " . $_SERVER['HTTP_ACCEPT_ENCODING'] . "\r\n";
		}
		if ( isset($_SERVER['HTTP_USER_AGENT']) ) {
			$query .= "USERAGENT: " . $_SERVER['HTTP_USER_AGENT'] . "\r\n";
		}
		if ( isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ) {
			$query .= "ACCEPTLANGUAGE: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "\r\n";
		}
		if ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
			$query .= "XFORWARDEDFOR: " . $_SERVER['HTTP_X_FORWARDED_FOR'] . "\r\n";
		}
		if ( isset($_SERVER['HTTP_FORWARDED']) ) {
			$query .= "FORWARDED2: " . $_SERVER['HTTP_FORWARDED'] . "\r\n";
		}
		if ( isset($_SERVER['HTTP_VIA']) ) {
			$query .= "VIA: " . $_SERVER['HTTP_VIA'] . "\r\n";
		}
		if ( isset($_SERVER['HTTP_PROXY_CONNECTION']) ) {
			$query .= "PROXYCONNECTION: " . $_SERVER['HTTP_PROXY_CONNECTION'] . "\r\n";
		}
		if ( isset($_SERVER['HTTP_CACHE_CONTROL']) ) {
			$query .= "CACHECONTROL: " . $_SERVER['HTTP_CACHE_CONTROL'] . "\r\n";
		}
		$query .= "REMOTEADDR2: " . $_SERVER['REMOTE_ADDR'] . "\r\n";
		$query .= "REMOTEHOST2: " . $_SERVER['HTTP_HOST'] . "\r\n";
		
		/*
		$query .= "X_FORWARDED_FOR: " . 'TEST X_FORWARDED_FOR' . "\r\n";
		$query .= "FORWARDED: " . 'TEST FORWARDED' . "\r\n";
		$query .= "VIA: " . 'TEST VIA' . "\r\n";
		$query .= "PROXY_CONNECTION: " . 'TEST PROXY_CONNECTION' . "\r\n";
		$query .= "CACHE_CONTROL: " . 'TEST CACHE_CONTROL' . "\r\n";
		*/
		
		
		if ( count($cookie_arr) > 0 ) {
			$query .= "Cookie: " . implode('; ', $cookie_arr) . ";\r\n";
		}
		
		if ( $post_headers ) {
			$query .= "Content-type: application/x-www-form-urlencoded\n";
			$query .= "Content-length: ".strlen($post_headers)."\n\n";
			$query .= $post_headers . " \r\n";
		}
		$query .= "\r\n";
		
		fwrite($fp, $query);
		
		$page = '';
		$limitter = 2;
		while (!feof($fp)) {
			$limitter--;
			$page .= fgets($fp, 4000);
		}
		fclose($fp);
		
		$page = explode("\r\n\r\n", $page, 2);
		
		$headers = $page[0];
		
		unset($page[0]);
		$headersArr = explode("\n", str_replace($address, $_SERVER['HTTP_HOST'], $headers));
		
		$locationArr = array();
		foreach ( $headersArr as  $k => $v ) {
			if ( is_numeric(strpos($v, 'Transfer-Encoding: chunked')) ) {
				unset($headersArr[$k]);
			}
			if ( is_numeric(strpos($v, 'Set-Cookie:')) ) {
				$tmp = explode(';', $v);
				if ( !empty($tmp[3]) ) {
					unset($tmp[3]);
				}
				$v = implode(';', $tmp);
				$headersArr[$k] = $v;
			}
		}
		foreach ( $headersArr as $k => $v ) {
			header($v, false);
		}
		
		echo $page[1];
		
		if ( $_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php' ) {
			//die('selfkill');
		} else {
			$file_path = MY_HOST . ':' . MY_PORT . '___' . str_replace('/', '___', $_SERVER['REQUEST_URI']);
	 		$file_path = str_replace('?', '_q_', $file_path);
	 		$file_path = str_replace('.', '_dot_', $file_path);
		}
		
		die;
		
		$page = explode("<!DOCTYPE", $page);
		if ( count($page) > 1 ) {
			unset($page[0]);
			echo '<!DOCTYPE' . $page[1];
			die;
		} else {
			echo '<!DOCTYPE' . $page[0];
			die;
		}
	
	}
	function p($a) {
		echo '<pre>';
		print_r($a);
		echo '/<pre>';
	}
	
?>