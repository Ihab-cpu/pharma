<?php /* Smarty version 2.6.30, created on 2025-04-21 07:02:22
         compiled from index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<div class="row-fluid">
	<?php if (! $this->_tpl_vars['config_array']['db_ver']): ?>
		<div class="alert alert-error">
			<b>Please go to the &laquo;<a href="?p=update">Update DB</a>&raquo; section and click the "Install Update" button. Your shop will be active then.</b>
		</div>
	<?php endif; ?>
</div><!--/row-->



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>