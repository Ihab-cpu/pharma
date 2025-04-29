<?php /* Smarty version 2.6.30, created on 2025-04-20 17:00:32
         compiled from update.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'update.tpl', 10, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div class="row-fluid">
		<div class="span12">
				<?php if (! $this->_tpl_vars['config_array']['db_ver']): ?>
					<div class="alert alert-error">
						<b>No database is installed</b>
					</div>
				<?php else: ?>
					<span class="label">
						<?php if ($this->_tpl_vars['config_array']['db_ver']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['config_array']['db_ver'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
<?php else: ?>-<?php endif; ?>
					</span> - Your update version
					<br>
				<?php endif; ?>
			<?php if ($this->_tpl_vars['update_file_isset']): ?>
				<span class="label label-success"><?php echo ((is_array($_tmp=$this->_tpl_vars['update_file_ver'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%m-%d %H:%M:%S") : smarty_modifier_date_format($_tmp, "%Y-%m-%d %H:%M:%S")); ?>
</span> - Local version of update file &laquo;<?php echo $this->_tpl_vars['update_file']; ?>
&raquo;
			<?php else: ?>
				<span class="label">You have no update file in &laquo;/<?php echo $this->_tpl_vars['update_file']; ?>
&raquo;</span>
			<?php endif; ?>
		</div>
	</div>

	<div class="clearfix"></div>
	<hr>
	<br>
	<?php if (! $_POST['install_update'] && ! $this->_tpl_vars['global_error'] || isset ( $_GET['need_update'] )): ?>
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab2" data-toggle="tab">Manual update</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab2">
					<ol>
						<li>
						    <form action="" method="post" enctype="multipart/form-data">

                                      <p>
                                        <input type="file" name="file_update" id="file_update" class="btn btn-small" style="padding:0; line-height: 8px"> <input type="submit" value="Upload" name="load_update_file" class="btn btn-info" id="load_file_btn">
                                        OR
                                        <strong>upload update file via FTP to &laquo;<?php echo $this->_tpl_vars['update_file']; ?>
&raquo;</strong>
                                    </p>
                                    <hr>
                            </form>
						</li>
						<li>
						    <form action="" method="get">
						        <input type="hidden" value="update" name="p">
							    <input class="btn btn-success" <?php if (! $this->_tpl_vars['update_file_isset']): ?>  disabled="disabled" <?php endif; ?> type="submit" name="install_update" value=" Install Update " />
							</form>
						</li>
					</ol>
				</div>
			</div>
		</div>
		<hr>
	</form>
	<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>