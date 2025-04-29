<?php /* Smarty version 2.6.30, created on 2025-04-21 00:31:09
         compiled from %21footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'mytranslate', '!footer.tpl', 5, false),)), $this); ?>
						</div><!-- /lPart -->
					</div><!-- /area -->
					<div class="footer" id="footer">
						<ul class="add-menu">
							<li<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'page' && $this->_tpl_vars['url_arr']['folders']['1'] == 'about'): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
page/about"><?php echo ((is_array($_tmp='About us')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
							<li<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'categories' && $this->_tpl_vars['url_arr']['folders']['1'] == 'Bestsellers'): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
categories/Bestsellers/all"><?php echo ((is_array($_tmp='Bestsellers')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
							<li<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'testimonials'): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
testimonials"><?php echo ((is_array($_tmp='Testimonials')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
							<li<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'faq'): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
faq"><?php echo ((is_array($_tmp='FAQ')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
							<li<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'page' && $this->_tpl_vars['url_arr']['folders']['1'] == 'policy'): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
page/policy"><?php echo ((is_array($_tmp='Policy')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
							<li<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'contact'): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
contact"><?php echo ((is_array($_tmp='Contact us')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
							<li><a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
contact?aff"><?php echo ((is_array($_tmp='Affiliate program')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
						</ul>
						<div class="serts">
							<i class="i1"></i>
							<i class="i2"></i>
							<i class="i3"></i>
							<i class="i4"></i>
							<i class="i5"></i>
							<i class="i6"></i>
						</div>
						<div class="copyR" id="copyR"></div>
						<div class="payments">
													</div>
						<div class="clear"></div>
					</div>
				</div><!-- /master -->
			</div><!-- /l2 -->
		</div><!-- /l1 -->
        <div id="toTop"><div>&uarr;</div></div>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "./../global/counter.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<div id="toMobileVersion">
			mobile version &rarr;
		</div>
	</body>
</html>
<!-- /ok -->