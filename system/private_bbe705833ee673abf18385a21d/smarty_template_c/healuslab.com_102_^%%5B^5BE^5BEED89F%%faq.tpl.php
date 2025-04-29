<?php /* Smarty version 2.6.30, created on 2025-04-21 16:02:59
         compiled from ./../global/faq.tpl */ ?>
var result_str = '';

<?php $_from = $this->_tpl_vars['result_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['my_result_foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['my_result_foreach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['my_result_foreach']['iteration']++;
?>
	result_str += '<div class="e"><div class="q"><?php echo $this->_tpl_vars['v']['0']; ?>
</div><div class="a"><?php echo $this->_tpl_vars['v']['1']; ?>
</div></div>'
	<?php if ($this->_foreach['my_result_foreach']['iteration'] != ($this->_foreach['my_result_foreach']['iteration'] == $this->_foreach['my_result_foreach']['total'])): ?>
	,
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>;
 
<?php echo '
$(\'document\').ready(function(){
	$(\'#list_type_1\').html(result_str);
});
'; ?>