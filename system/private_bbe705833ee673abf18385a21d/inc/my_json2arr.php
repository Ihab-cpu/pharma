<?php
	function my_json2arr($json){
		$json_array = false;
		$json = substr($json, 1, -1);
		$json = str_replace(array(":", "{", "[", "}", "]"), array("=>", "array(", "array(", ")", ")"), $json);
		@eval("\$json_array = array({$json});");
		return $json_array;
	}
?>