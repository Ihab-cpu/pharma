<?php /* Smarty version 2.6.30, created on 2025-04-21 16:02:53
         compiled from contact_aff.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'contact_aff.tpl', 3, false),array('modifier', 'escape', 'contact_aff.tpl', 14, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="border">
	<?php if (count($this->_tpl_vars['errors_arr']) == 0 && $_POST['cw']): ?>
	Thank you. Your message has been sent.
	<?php else: ?>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
page_js?p=aff"></script>
	<div id="result_str"></div>
    <form action="" method="post" class="contact_form">
    	<input type="hidden" value="3" name="you_are">
    	<input type="hidden" value="1" name="aff">
        <table>
            <tr<?php if ($this->_tpl_vars['errors_arr']['name']): ?> class="error_tr"<?php endif; ?>>
                <th>Name: <span class="must">*</span></th>
                <td><div><input type="text" class="i" name="name" value="<?php echo ((is_array($_tmp=$_POST['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></div></td>
                <td class="error_td"><?php echo $this->_tpl_vars['errors_arr']['name']; ?>
</td>
            </tr>
            <tr<?php if ($this->_tpl_vars['errors_arr']['email']): ?> class="error_tr"<?php endif; ?>>
                <th>ICQ / Jabber: <span class="must">*</span></th>
                <td><div><input type="email" class="i" name="email" value="<?php echo ((is_array($_tmp=$_POST['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></div></td>
                <td class="error_td"><?php echo $this->_tpl_vars['errors_arr']['email']; ?>
</td>
            </tr>
            
            <!--tr<?php if ($this->_tpl_vars['errors_arr']['subject']): ?> class="error_tr"<?php endif; ?>>
                <th>:</th>
                <td><div><input type="text" class="i" name="subject" value="<?php echo ((is_array($_tmp=$_POST['subject'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></div></td>
                <td class="error_td"><?php echo $this->_tpl_vars['errors_arr']['subject']; ?>
</td>
            </tr-->
            <tr<?php if ($this->_tpl_vars['errors_arr']['message']): ?> class="error_tr"<?php endif; ?>>
                <th>Message: <span class="must">*</span></th>
                <td><div><textarea cols="20" rows="10" name="message"><?php echo ((is_array($_tmp=$_POST['message'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea></div></td>
                <td class="error_td"><?php echo $this->_tpl_vars['errors_arr']['message']; ?>
</td>
            </tr>
            <tr<?php if ($this->_tpl_vars['errors_arr']['cw']): ?> class="error_tr"<?php endif; ?>>
                <th>Control words:</th>
                <td>
                	<div><input type="text" class="i" name="cw" /></div>
                	<img id="control_image" src="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
contact/?image" width="160"  height="60" alt="CW" title="CW" />
                	<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
contact" id="reloader_of_image">reload image</a>
                </td>
                <td class="error_td"><?php echo $this->_tpl_vars['errors_arr']['cw']; ?>
</td>
            </tr>
            <tr>
                <th></th>
                <td><div><input type="submit" class="btn btn-default" value="send" /></div></td>
            </tr>
        </table>
    </form>
    <?php endif; ?>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>