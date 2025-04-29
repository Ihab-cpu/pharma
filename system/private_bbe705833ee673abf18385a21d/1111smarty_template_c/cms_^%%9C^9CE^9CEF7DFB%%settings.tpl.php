<?php /* Smarty version 2.6.30, created on 2025-04-20 17:01:51
         compiled from settings.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'floatval', 'settings.tpl', 38, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if (! $this->_tpl_vars['config_array']['db_ver']): ?>
		<div class="alert alert-error">
			<b>Please go to the &laquo;<a href="?p=update">Update DB</a>&raquo; section and click the "Install Update" button. Your shop will be active then.</b>
		</div>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['errorStrSettings']): ?>
		<div class="alert alert-error">
			<?php echo $this->_tpl_vars['errorStrSettings']; ?>

		</div>
	<?php endif; ?>
	<form action="" method="post">
		<table class="table table-bordered table-hover" style="width:auto;">
			<tr>
				<th style="white-space: nowrap">
					<label for="default_template">Default template</label>
				</th>
				<td>
					<div>
						<select class="radius" name="default_template" id="template_change">
							<?php $_from = $this->_tpl_vars['templatesArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
								<option <?php if ($_POST['default_template'] == $this->_tpl_vars['v'] || ! $_POST['default_template'] && $this->_tpl_vars['config_array']['default_template'] == $this->_tpl_vars['v']): ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['v']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select>
					</div>
				</td>
				<td>
					<img src="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
templates/<?php echo $this->_tpl_vars['config_array']['default_template']; ?>
/mini.jpg" width="100" style="border:solid 1px #bdbdbd; margin-right:5px; position:relative; top:-3px; border-radius:5px;" alt="" title="" id="template_change_pic" />
				</td>
			</tr>
			<tr>
				<th style="white-space: nowrap">
					<label for="extra_charge" style="padding-top: 5px;">Price extra charge %</label>
				</th>
				<td colspan="2">
					<input type="text" value="<?php echo $this->_tpl_vars['config_array']['extra_charge']; ?>
" name="extra_charge" id="extra_charge" style="width:40px;">
					<br>
					<div style="display:inline-block; font-size: 12px; line-height:16px; position:relative; top: -4px;">This setting changes price for all products at all of you shops.<br> Setting varies from <?php echo ((is_array($_tmp=$this->_tpl_vars['config_array']['min_extra_charge'])) ? $this->_run_mod_handler('floatval', true, $_tmp) : floatval($_tmp)); ?>
% to 50%. Recommended value is 0%</div>
				</td>
			</tr>
			<tr>
				<th style="white-space: nowrap">
					<label for="show_tree_price" style="padding-top: 5px;">Show price in sub categories</label>
				</th>
				<td colspan="2">
					<input type="checkbox" <?php if ($this->_tpl_vars['config_array']['show_tree_price']): ?> checked="checked"<?php endif; ?> name="show_tree_price" id="show_tree_price">
				</td>
			</tr>
			<tr>
				<th style="white-space: nowrap">
					<label for="default_category" style="padding-top: 5px;">Default category</label>
				</th>
				<td colspan="2">
					<select name="default_category" id="default_category">
						<?php $_from = $this->_tpl_vars['tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
							<option value="<?php echo $this->_tpl_vars['v']; ?>
"<?php if ($this->_tpl_vars['config_array']['default_category'] == $this->_tpl_vars['v']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
			            <tr>
                <th style="width: 130px; white-space: nowrap">
                    <label>Absolute URL <small>(in href)</small></label>
                </th>
                <td colspan="2">
                    <input type="checkbox" id="url_abs" name="url_abs" value="1" <?php if ($this->_tpl_vars['config_array']['url_abs']): ?> checked="checked"<?php endif; ?>>
                </td>
            </tr>
            <tr>
                <th style="width: 130px; white-space: nowrap">
                    <label form="pack_reverse">Pack reverse</label>
                </th>
                <td colspan="2">
                    <input type="checkbox" id="pack_reverse" name="pack_reverse" value="1" <?php if ($this->_tpl_vars['config_array']['pack_reverse']): ?> checked="checked"<?php endif; ?>>
                </td>
            </tr>
		</table>
		<input class="btn" type="submit" name="sbmt_global_settings" value="Save" />
	</form>
	<hr>
	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>