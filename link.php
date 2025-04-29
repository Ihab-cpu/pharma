<?php
	//p($_SERVER['HTTP_REFERER']);
	$a = explode('/', $_SERVER['HTTP_REFERER']);

	
	if ( $a[2] != $_SERVER['SERVER_NAME'] ) {
		die('err');
	}
$path = './system/';
include('./defines.php');
//echo $base_folder;
//echo $_GET['url'];
$url = $base_folder . $_GET['url'];
$url = str_replace('/catalog/', '/categories/', $url);
//echo $url;
//die;
	echo '<html>
		<head>
			<script type="text/javascript">
				window.location.href = "' . $url . '"
			</script>
		</head>
		<body>
			
		</body>
	</html>';
	//header('Location: ' . $_GET['q']);
	die;
	
	function p($a) {
		echo '<pre>';
		print_r($a);
		echo '</pre>';
	}
?>