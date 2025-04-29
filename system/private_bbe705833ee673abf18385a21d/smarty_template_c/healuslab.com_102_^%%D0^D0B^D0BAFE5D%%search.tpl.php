<?php /* Smarty version 2.6.30, created on 2025-04-21 12:18:43
         compiled from search.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'search.tpl', 3, false),array('modifier', 'mytranslate', 'search.tpl', 5, false),array('modifier', 'replace', 'search.tpl', 13, false),array('modifier', 'strtolower', 'search.tpl', 16, false),array('modifier', 'escape', 'search.tpl', 16, false),array('modifier', 'addslashes', 'search.tpl', 16, false),array('modifier', 'string_format', 'search.tpl', 18, false),array('modifier', 'truncate', 'search.tpl', 24, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="catalog">
<?php if (count($this->_tpl_vars['result_array']) == 0 && count($this->_tpl_vars['result_array_ai']) == 0): ?>
	<div class="e404">
		<?php echo ((is_array($_tmp="Nothing found. You may be interested in our Best Sellers")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>

	</div>
<?php endif; ?>
<?php if (count($this->_tpl_vars['result_array']) > 0): ?>

	<div class="line">
	<?php $_from = $this->_tpl_vars['result_array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['resultArr'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['resultArr']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['resultArr']['iteration']++;
?>
	    <?php $this->assign('keyx', $this->_tpl_vars['v']['1']); ?>
	    <a class="e <?php if (!($this->_foreach['resultArr']['iteration'] % 3)): ?> last<?php endif; ?>" href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
categories/<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['2'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
/<?php echo $this->_tpl_vars['config_array']['pill_prefix']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
<?php echo $this->_tpl_vars['config_array']['pill_postfix']; ?>
">
		    <i class="name"><?php echo $this->_tpl_vars['k']; ?>
</i>
            <?php if ($this->_tpl_vars['v']['3']): ?><span class="ai"><?php echo ((is_array($_tmp="Active ingredient:")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
 <span><?php echo $this->_tpl_vars['v']['3']; ?>
</span></span><?php endif; ?>
	        <img src="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
system/images/<?php echo ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('strtolower', true, $_tmp) : strtolower($_tmp)); ?>
.jpg" width="80" alt="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
" />
		    <i class="price">
			    <span><?php echo $this->_tpl_vars['currency_symbol']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['v']['0'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span> <?php echo ((is_array($_tmp='for pill')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>

		    </i>



		    <i class="descr">
			    <?php echo ((is_array($_tmp=$this->_tpl_vars['v']['1'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 110, " ...") : smarty_modifier_truncate($_tmp, 110, " ...")); ?>

	        </i>
		    <i class="buy"><?php echo ((is_array($_tmp='Buy Now')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</i>
	    </a>
	    <?php if (!($this->_foreach['resultArr']['iteration'] % 3)): ?>
			</div>
			<div class="line">
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</div>
	
<?php endif; ?>


</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>