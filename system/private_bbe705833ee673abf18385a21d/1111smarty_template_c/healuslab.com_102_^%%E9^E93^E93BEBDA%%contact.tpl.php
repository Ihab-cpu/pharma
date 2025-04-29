<?php /* Smarty version 2.6.30, created on 2025-04-21 07:08:08
         compiled from contact.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'contact.tpl', 3, false),array('modifier', 'mytranslate', 'contact.tpl', 4, false),array('modifier', 'escape', 'contact.tpl', 32, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="border">
	<?php if (count($this->_tpl_vars['errors_arr']) == 0 && $_POST['cw']): ?>
	<?php echo ((is_array($_tmp="Thank you. Your message has been sent.")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>

	<?php else: ?>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
page_js?p=contact"></script>
	<div id="result_str"></div>
    <form action="" method="post" class="contact_form">
        <table>
        	<!--tr id="you_are_tr">
                <th><?php echo ((is_array($_tmp="You are:")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
 <span class="must">*</span></th>
                <td>
                	<div>
                		<label>
                			<input class="l_radio" type="radio" value="2" name="you_are" <?php if ($_POST['you_are'] != 1 || ! $_POST['you_are']): ?>checked="checked"<?php endif; ?>>
                			<?php echo ((is_array($_tmp='Visitor')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>

                		</label>
                		&nbsp;
                		&nbsp;
                		&nbsp;
                		<label>
                			<input class="l_radio" type="radio" value="1" name="you_are"<?php if ($_POST['you_are'] == 1): ?> checked="checked"<?php endif; ?>>
                			<?php echo ((is_array($_tmp='Current customer')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>

                		</label>
                	</div>
                </td>
                <td class="error_td"></td>
            </tr-->
            <input type="hidden" name="you_are" value="2">
            <tr<?php if ($this->_tpl_vars['errors_arr']['name']): ?> class="error_tr"<?php endif; ?>>
                <th><?php echo ((is_array($_tmp="Name:")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
 <span class="must">*</span></th>
                <td><div><input type="text" class="i" name="name" value="<?php echo ((is_array($_tmp=$_POST['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></div></td>
                <td class="error_td"><?php echo ((is_array($_tmp=$this->_tpl_vars['errors_arr']['name'])) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</td>
            </tr>
            <tr<?php if ($this->_tpl_vars['errors_arr']['email']): ?> class="error_tr"<?php endif; ?>>
                <th><?php echo ((is_array($_tmp="E-mail:")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
 <span class="must">*</span></th>
                <td><div><input type="email" class="i" name="email" value="<?php echo ((is_array($_tmp=$_POST['email'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></div></td>
                <td class="error_td"><?php echo ((is_array($_tmp=$this->_tpl_vars['errors_arr']['email'])) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</td>
            </tr>
            <tr<?php if ($this->_tpl_vars['errors_arr']['ccn']): ?> class="error_tr"<?php endif; ?> id="ccn_fld" <?php if ($_POST['you_are'] != 1 || ! $_POST['you_are']): ?>style="display:none;"<?php endif; ?>>
                <th><?php echo ((is_array($_tmp="Credit Card Number used:")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
 <span class="must">*</span></th>
                <td><div><input type="number" class="i" name="ccn" value="<?php echo ((is_array($_tmp=$_POST['ccn'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></div></td>
                <td class="error_td"><?php echo ((is_array($_tmp=$this->_tpl_vars['errors_arr']['ccn'])) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</td>
            </tr>
            <tr<?php if ($this->_tpl_vars['errors_arr']['subject']): ?> class="error_tr"<?php endif; ?>>
                <th><?php echo ((is_array($_tmp="Subject:")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
 <span class="must">*</span></th>
                <td>
                    <select id="subject_select" name="subject_select" class="i" style="width: 228px; margin-bottom: 4px;">
                        <option value=""><?php echo ((is_array($_tmp='Pick one')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Reprocess my credit card'): ?> selected="selected"<?php endif; ?> value="Reprocess my credit card"><?php echo ((is_array($_tmp='Reprocess my credit card')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Did not receive my order'): ?> selected="selected"<?php endif; ?> value="Did not receive my order"><?php echo ((is_array($_tmp='Did not receive my order')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Resend'): ?> selected="selected"<?php endif; ?> value="Resend"><?php echo ((is_array($_tmp='Resend')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Questions regarding medicine'): ?> selected="selected"<?php endif; ?> value="Questions regarding medicine"><?php echo ((is_array($_tmp='Questions regarding medicine')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Unsubscribe'): ?> selected="selected"<?php endif; ?> value="Unsubscribe"><?php echo ((is_array($_tmp='Unsubscribe')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Call me'): ?> selected="selected"<?php endif; ?> value="Call me"><?php echo ((is_array($_tmp='Call me')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Cancel order'): ?> selected="selected"<?php endif; ?> value="Cancel order"><?php echo ((is_array($_tmp='Cancel order')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Order status'): ?> selected="selected"<?php endif; ?> value="Order status"><?php echo ((is_array($_tmp='Order status')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Wrong shipping address'): ?> selected="selected"<?php endif; ?> value="Wrong shipping address"><?php echo ((is_array($_tmp='Wrong shipping address')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Partial order'): ?> selected="selected"<?php endif; ?> value="Partial order"><?php echo ((is_array($_tmp='Partial order')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Shipping delay'): ?> selected="selected"<?php endif; ?> value="Shipping delay"><?php echo ((is_array($_tmp='Shipping delay')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Received no confirmation'): ?> selected="selected"<?php endif; ?> value="Received no confirmation"><?php echo ((is_array($_tmp='Received no confirmation')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                        <option <?php if ($_POST['subject_select'] == 'Other'): ?> selected="selected"<?php endif; ?> value="Other"><?php echo ((is_array($_tmp='Other')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</option>
                    </select>
                    <div id="custom_subject" <?php if ($_POST['subject_select'] == 'Other'): ?> style="display: block;"<?php endif; ?>><input type="text" class="i" name="subject" placeholder="Your subject" value="<?php echo ((is_array($_tmp=$_POST['subject'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></div>
                </td>
                <td class="error_td"><?php echo ((is_array($_tmp=$this->_tpl_vars['errors_arr']['subject'])) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</td>
            </tr>
            <tr<?php if ($this->_tpl_vars['errors_arr']['message']): ?> class="error_tr"<?php endif; ?>>
                <th><?php echo ((is_array($_tmp="Message:")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
 <span class="must">*</span></th>
                <td><div><textarea cols="20" rows="10" name="message"><?php echo ((is_array($_tmp=$_POST['message'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea></div></td>
                <td class="error_td"><?php echo ((is_array($_tmp=$this->_tpl_vars['errors_arr']['message'])) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</td>
            </tr>
            <tr<?php if ($this->_tpl_vars['errors_arr']['cw']): ?> class="error_tr"<?php endif; ?>>
                <th><?php echo ((is_array($_tmp="Control words:")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</th>
                <td>
                	<div><input type="text" class="i" name="cw" /></div>
                	<img id="control_image" src="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
contact/?image" width="160"  height="60" alt="CW" title="CW" />
                	<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
contact" id="reloader_of_image"><?php echo ((is_array($_tmp='reload image')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a>
                </td>
                <td class="error_td"><?php echo ((is_array($_tmp=$this->_tpl_vars['errors_arr']['cw'])) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</td>
            </tr>
            <tr>
                <th></th>
                <td><div><input type="submit" class="btn btn-default" value="<?php echo ((is_array($_tmp='send')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
" /></div></td>
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