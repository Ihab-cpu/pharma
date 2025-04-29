<?php
	
	function auth_function($global_arr) {
		if ( isset($_GET['logout']) ) {
			auth_clear();
			return;
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['act']) && $_GET['act'] == 'enter') {
			auth_switch();
			return;
		}
		$name = 'admin';
		$pwd = $global_arr['config_array']['password'];
		if (
			isset($_COOKIE['logUser'])
			&&
			( $_COOKIE['logUser'] == $name )
			&&
			isset($_COOKIE['passUser'])
			&&
			( md5(define_revers($_COOKIE['passUser'], PS . SALT, 1)) == $pwd)
		) {
			$result = true;
		} else {
			$result = false;
		}
		return $result;
	}
	
	
	function auth_clear() {
//		cookie_clear('logUser');
//		cookie_clear('passUser');
		cookie_set('logUser', '', time() - 3600);
		cookie_set('passUser', '', time() - 3600);
		header("Location: index.php");
		exit();
	}
	
	function auth_switch() {
		if ( $_POST['login2'] && $_POST['pass2'] ) {
			cookie_set('logUser', $_POST['login2'], time() + 3600*24*33);
			$pass = stripslashes($_POST['pass2']);
			$pass = explode(".", $pass);
			foreach ( $pass as $k => $v ) {
				if ( !$v ) {
					unset($pass[$k]);
					continue;
				}
				if ( $k % 2 == 0 ) {
					$temp[] = $pass[$k];
				} else {
					$temp2[] = $pass[$k];
				}
			}
			$x = '';
			foreach ( $temp as $k => $v ) {		
				$tmp = $temp[$k] + $temp2[$k];
				$x .= chr($tmp);
			}
			$_POST['pass2'] = $x;
			$c = define_revers($_POST['pass2'], PS . SALT);
			cookie_set('passUser', $c, 0);
			//$_COOKIE[''] = );

			header("Location: " . str_replace('?act=enter', '', $_SERVER['REQUEST_URI']));
		}
	}
?>