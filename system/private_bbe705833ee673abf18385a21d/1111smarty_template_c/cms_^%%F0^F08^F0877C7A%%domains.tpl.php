<?php /* Smarty version 2.6.30, created on 2025-04-20 17:00:44
         compiled from domains.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'domains.tpl', 26, false),)), $this); ?>
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
	<form action="" method="post">
		<div class="alert alert-info">
			If you want to use a design not set as a default for some domains, enter the list of the domains by means of a newline
		</div>
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">Add</a></li>
				<li><a href="#" href="#tab2" data-toggle="tab">Edit settings</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<table>
						<tr>
							<td style="vertical-align:top;">
								<textarea id="textarea_new_domains" name="new_domains" cols="10" rows="6" placeholder="" data-noclick="1">Example:
domain1.com
domain2.com</textarea>
							</td>
							<td rowspan="2" class="template-td" style="padding-left: 10px;">
								<img src="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
templates/<?php if (! $_GET['template']): ?><?php echo $this->_tpl_vars['config_array']['default_template']; ?>
<?php else: ?><?php echo ((is_array($_tmp=$_GET['template'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php endif; ?>/mini.jpg" width="200" style="border:solid 1px #bdbdbd; margin-right:5px; position:relative; top:-3px; border-radius:5px;" alt="" title="" id="template_change_pic" />
								<br>
								<span style="display:inline-block; position:relative; top: -4px;">Template:</span>
								<select name="template" style="margin-right:10px; width:137px" id="template_change">
									<?php $_from = $this->_tpl_vars['templatesArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
										<option <?php if ($_GET['template'] == $this->_tpl_vars['v'] || ! $_GET['template'] && $this->_tpl_vars['config_array']['default_template'] == $this->_tpl_vars['v']): ?> selected="selected"<?php endif; ?> value="<?php echo $this->_tpl_vars['v']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
									<?php endforeach; endif; unset($_from); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" value="Set not default design" name="add_domains" class="btn btn-info" id="add_domains_btn">
							</td>
					</table>
					<hr>
				</div>
				<div class="tab-pane" id="tab2">
					<table>
						<tr>
							<td style="vertical-align:top;">
								Format: Design|Domain
								<br>
								<textarea name="isset_domains" cols="10" rows="11"><?php echo $this->_tpl_vars['issetDomains']; ?>
</textarea>
								<br>
								<input type="submit" value="Save settings" name="save_domains" class="btn btn-info">
							</td>
							<td style="vertical-align:top; padding-left: 10px;">
								
							</td>
						</tr>
					</table>
					<hr>
				</div>
			</div>
	</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>