<?php
	function sort_2lvl_assoc_array($my_a, $my_k, $desc = false) {
		if ( $desc == true ) {
			uasort($my_a, 'sort_2lvl_array_cmp_desc');
		} else {
			uasort($my_a, 'sort_2lvl_array_cmp');
		}
		return $my_a;
	}
	
	function sort_2lvl_array_cmp($a, $b) {
		if ($a == $b) {
		return 0;
		}
		return ($a < $b) ? -1 : 1;
	}
	
	function sort_2lvl_array_cmp_desc($a, $b) {
		if ($a == $b) {
		return 0;
		}
		return ($a > $b) ? -1 : 1;
	}
?>