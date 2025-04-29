<?php
	
	discount_generator($global_arr);
	
	function discount_generator($global_arr) {
		
		$global_arr['smarty']->assign('name', 'Discount generator');
		$global_arr['smarty']->display('discount_generator.tpl');
	}
?>