<?php /* Smarty version 2.6.30, created on 2025-04-21 07:08:03
         compiled from ./../global/page.tpl */ ?>
var result_str = '<?php echo $this->_tpl_vars['result_str']; ?>
';
<?php echo '
$(\'document\').ready(function(){
	$(\'#result_str\').html(result_str);
});
'; ?>