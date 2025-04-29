<?php /* Smarty version 2.6.30, created on 2025-04-20 17:09:25
         compiled from %21header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'mytranslate', '!header.tpl', 28, false),array('modifier', 'date', '!header.tpl', 32, false),array('modifier', 'replace', '!header.tpl', 40, false),array('modifier', 'escape', '!header.tpl', 42, false),array('modifier', 'string_format', '!header.tpl', 106, false),array('modifier', 'lower', '!header.tpl', 183, false),array('modifier', 'price_handler', '!header.tpl', 191, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<head>
		<title><?php echo $this->_tpl_vars['title']; ?>
</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php if ($this->_tpl_vars['description']): ?><meta name="description" content="<?php echo $this->_tpl_vars['description']; ?>
"/><?php endif; ?>
		<?php if ($this->_tpl_vars['keywords']): ?><meta name="keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
"/><?php endif; ?>
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root_path']; ?>
/css/reset.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root_path']; ?>
/css/style.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root_path']; ?>
/css/media.css" type="text/css" />
        <!--[if IE]>
        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root_path']; ?>
/css/ie.css" type="text/css" />
        <![endif]-->
		<?php if ($this->_tpl_vars['lang'] != 'en'): ?>
			<link rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root_path']; ?>
/css/style_<?php echo $this->_tpl_vars['lang']; ?>
.css" type="text/css" />
		<?php endif; ?>
		<script src="<?php echo $this->_tpl_vars['template_root_path']; ?>
/js/jquery-1.8.2.min.js" type="text/javascript"></script>
		<!--script src="/json.js" type="text/javascript"></script-->
		<script type="text/javascript">
			var ajax_path = '<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
ajax/';
			var BASE_FOLDER = '<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
';

            var http_host = 'http://<?php echo $_SERVER['HTTP_HOST']; ?>
';
			
			var session_id = '<?php echo $this->_tpl_vars['session_id']; ?>
';
			var search_title = '<?php echo ((is_array($_tmp='Search product')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
';
			var search_empty_message = '<?php echo ((is_array($_tmp="Error. Empty Search product!")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
';
			var date_year = '<?php echo $this->_tpl_vars['date_year']; ?>
';
			var date_month = '<?php echo $this->_tpl_vars['date_month']; ?>
';
			var var_date_y = <?php echo ((is_array($_tmp='Y')) ? $this->_run_mod_handler('date', true, $_tmp) : date($_tmp)); ?>
;
			var var_date_y_l = '<?php echo $this->_tpl_vars['year_license']; ?>
';
			
			var bil_url = '<?php echo $this->_tpl_vars['config_array']['bil_url']; ?>
';
			var bil_ext = '<?php echo $this->_tpl_vars['config_array']['bil_ext']; ?>
';
			
			var s1 = "&copy; 2001-" + var_date_y + " <?php echo ((is_array($_tmp="Canadian Pharmacy Ltd. All rights reserved.")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
<br />";
			var s2 = "<?php echo ((is_array($_tmp="Canadian Pharmacy Ltd. is licensed online pharmacy.")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
 <br />";
			var s3 = "<?php echo ((is_array($_tmp=((is_array($_tmp='International license number 07371245 issued 17 aug')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, '07371245', $this->_tpl_vars['license']) : smarty_modifier_replace($_tmp, '07371245', $this->_tpl_vars['license'])); ?>
 " + var_date_y_l;
			
			var qWord = '<?php echo ((is_array($_tmp=$_GET['q'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
';
		</script>
		<script type='text/javascript' src='<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
templates/global/autocomplete/dist/jquery.autocomplete.js'></script>
        <script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root_path']; ?>
/../global/json2.js"></script>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root_path']; ?>
/js/js.js"></script>
	</head>
	<body class="<?php if ($_COOKIE['no_mobile'] < 2): ?>mobile<?php endif; ?><?php if ($this->_tpl_vars['need_scroll']): ?> need-scroll<?php endif; ?> page-<?php echo $this->_tpl_vars['controller']; ?>
 lang-<?php echo $this->_tpl_vars['lang']; ?>
<?php if ($_COOKIE['discount_ok']): ?> discount_ok<?php endif; ?>">
		<div id="toFullVersion">
			desktop version &rarr;
		</div>
        <noscript>
            <div class="warning-danger">Please Enable JavaScript in Your Internet Web Browser to Continue Shopping.</div>
        </noscript>
		<div id="ajax_preloader"></div>
		<div class="l1">
			<div class="l2">
				<div class="master">
					<div class="header">
						<a class="logo" href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
"><img src="<?php echo $this->_tpl_vars['template_root_path']; ?>
/img/logo<?php if ($this->_tpl_vars['lang'] != 'en'): ?>_<?php echo ((is_array($_tmp=$this->_tpl_vars['lang'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php endif; ?>.gif" width="268" height="69" alt=""></a>
						<div class="phones">
							<?php if ($this->_tpl_vars['config_array']['phone'] || $this->_tpl_vars['config_array']['phone']): ?>
								<div class="phoneDigits">
									<?php if ($this->_tpl_vars['config_array']['phone']): ?>
										<span>
									<?php echo $this->_tpl_vars['config_array']['phone']; ?>

							</span>
									<?php endif; ?>
									<?php if ($this->_tpl_vars['config_array']['phone2']): ?>
										<span>
								<div class="clear"></div>
											<?php echo $this->_tpl_vars['config_array']['phone2']; ?>

							</span>
									<?php endif; ?>
								</div>

							<?php endif; ?>
						</div>
						<div class="lang-and-currency">
							<div class="tit tit-blue"><?php echo ((is_array($_tmp='Language')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
 & <?php echo ((is_array($_tmp='Currency')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</div>
							<form action="" method="get" id="change_language">
                                <?php if ($_GET['q']): ?>
                                    <input type="hidden" name="q" value="<?php echo ((is_array($_tmp=$_GET['q'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
                                <?php endif; ?>
								<select name="language" id="language">
                                    <option value="en" <?php if ($this->_tpl_vars['lang'] == 'en'): ?> selected="selected" <?php endif; ?>>English</option>
                                    <option value="de" <?php if ($this->_tpl_vars['lang'] == 'de'): ?> selected="selected" <?php endif; ?>>Deutsch</option>
                                    <option value="fr" <?php if ($this->_tpl_vars['lang'] == 'fr'): ?> selected="selected" <?php endif; ?>>Français</option>
                                    <option value="it" <?php if ($this->_tpl_vars['lang'] == 'it'): ?> selected="selected" <?php endif; ?>>Italiano</option>
                                    <option value="es" <?php if ($this->_tpl_vars['lang'] == 'es'): ?> selected="selected" <?php endif; ?>>Español</option>
								</select>
							</form>
							<form class="currency" action="" id="form_currency">
								<?php if ($_GET['q']): ?>
									<input type="hidden" id="q_hidden" name="q" value="<?php echo $_GET['q']; ?>
" />
								<?php endif; ?>
								<select name="currency">
									<?php $_from = $this->_tpl_vars['config_array']['currency']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
										<option <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['currency']): ?> selected="selected" <?php endif; ?> value="<?php echo $this->_tpl_vars['k']; ?>
"><!--<?php echo $this->_tpl_vars['v']['2']; ?>
--><?php echo $this->_tpl_vars['k']; ?>
</option>
									<?php endforeach; endif; unset($_from); ?>
								</select>
							</form>
						</div>
						<a class="shopping-cart" href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
basket">
							<span class="tit tit-blue"><?php echo ((is_array($_tmp="Shipping cart:")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</span>
							<i><span id="total_count"><?php echo $this->_tpl_vars['order_total_count']; ?>
</span> <?php echo ((is_array($_tmp='items')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</i> <span class="total"><?php echo $this->_tpl_vars['currency_symbol']; ?>
<span id="header_total_price"><?php echo ((is_array($_tmp=$this->_tpl_vars['order_total_price'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span></span>
						</a>
						<div class="best-sides">
							<div class="e">
								<i class="i1"></i>

								<div class="tit tit-green"><?php echo ((is_array($_tmp='Free Shipping')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</div>
								<?php echo ((is_array($_tmp='on all orders above')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
 $200
							</div>
							<div class="e">
								<i class="i2"></i>

								<div class="tit tit-green"><?php echo ((is_array($_tmp='Free Pills')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</div>
								<?php echo ((is_array($_tmp='with every order')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>

							</div>
							<div class="e">
								<i class="i3"></i>

								<div class="tit tit-green">1,000,000 <?php echo ((is_array($_tmp='customers')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</div>
								<?php echo ((is_array($_tmp="quality, privacy, secure")) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>

							</div>
							<div class="e">
								<i class="i4"></i>

								<div class="tit tit-green"><?php echo ((is_array($_tmp='Low Prices')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</div>
								<?php echo ((is_array($_tmp='best price on the web')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>

							</div>
							<div class="clear"></div>
						</div>
						<ul class="main-menu">
							<li class="b1"><a<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'page' && $this->_tpl_vars['url_arr']['folders']['1'] == 'about'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
page/about"><?php echo ((is_array($_tmp='About us')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
							<li class="b2"><a<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'categories' && $this->_tpl_vars['url_arr']['folders']['1'] == 'Bestsellers'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
categories/Bestsellers"><?php echo ((is_array($_tmp='Bestsellers')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
							<li class="b3"><a<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'testimonials'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
testimonials"><?php echo ((is_array($_tmp='Testimonials')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
							<li class="b4"><a<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'faq'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
faq"><?php echo ((is_array($_tmp='FAQ')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
							<li class="b5"><a<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'page' && $this->_tpl_vars['url_arr']['folders']['1'] == 'policy'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
page/policy"><?php echo ((is_array($_tmp='Policy')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
							<li class="b6"><a<?php if ($this->_tpl_vars['url_arr']['folders']['0'] == 'contact'): ?> class="active"<?php endif; ?> href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
contact"><?php echo ((is_array($_tmp='Contact us')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</a></li>
						</ul>
						<div class="search-by-letters">
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=A">A</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=B">B</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=C">C</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=D">D</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=E">E</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=F">F</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=G">G</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=H">H</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=I">I</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=J">J</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=K">K</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=L">L</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=M">M</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=N">N</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=O">O</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=P">P</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=Q">Q</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=R">R</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=S">S</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=T">T</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=U">U</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=V">V</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=W">W</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=X">X</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=Y">Y</a>
							<a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search?q=Z">Z</a>
						</div>
						<div class="clear"></div>
					</div><!-- /header -->
					<div class="area">
						<div class="lPart">
							<div class="tit-big"><?php echo ((is_array($_tmp='CATALOG')) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>
</div>
                            <form class="search" id="search_box" action="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
search">

								<input class="inp auto_clear" autocomplete="off" type="text" value="" placeholde="Search product" name="q" id="q">
								<input class="btn" type="submit" value="">
							</form>
							<ul class="sub-menu" id="categories">
								<?php $_from = $this->_tpl_vars['tree_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tree_foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tree_foreach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
        $this->_foreach['tree_foreach']['iteration']++;
?>
									<li class="li-<?php echo $this->_tpl_vars['k']; ?>
<?php if (((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')) == ((is_array($_tmp=$this->_tpl_vars['url_arr']['folders']['1'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp))): ?> active<?php endif; ?>">
										<i></i><a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
categories/<?php echo ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
/all"><?php if ($this->_tpl_vars['cat_eq_lang']): ?><?php echo $this->_tpl_vars['cat_eq_lang'][$this->_tpl_vars['k']]; ?>
<?php else: ?><?php echo $this->_tpl_vars['k']; ?>
<?php endif; ?></a>
										<ul>
											<!--li<?php if (((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == ((is_array($_tmp=$this->_tpl_vars['url_arr']['folders']['1'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) && $this->_tpl_vars['url_arr']['folders']['2'] == 'all'): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
categories/<?php echo $this->_tpl_vars['k']; ?>
/all">ALL</a></li-->
											<?php $_from = $this->_tpl_vars['v']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k2'] => $this->_tpl_vars['v2']):
?>
												<li<?php if (((is_array($_tmp=$this->_tpl_vars['url_arr']['folders']['2'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['k2'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-'))): ?> class="active"<?php endif; ?>><a href="<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
categories/<?php echo ((is_array($_tmp=$this->_tpl_vars['k'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
/<?php echo $this->_tpl_vars['config_array']['pill_prefix']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['k2'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '-') : smarty_modifier_replace($_tmp, ' ', '-')); ?>
<?php echo $this->_tpl_vars['config_array']['pill_postfix']; ?>
">
														<span class="name"><?php echo $this->_tpl_vars['k2']; ?>
</span>
														<?php if ($this->_tpl_vars['config_array']['show_tree_price']): ?>
															<span class="price"><?php echo $this->_tpl_vars['currency_symbol']; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['v2']['0'])) ? $this->_run_mod_handler('price_handler', true, $_tmp) : price_handler($_tmp)); ?>
</span>
														<?php endif; ?>
													</a></li>
											<?php endforeach; endif; unset($_from); ?>
										</ul>
									</li>
								<?php endforeach; endif; unset($_from); ?>
							</ul>
							<div class="social">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
							<div class="delivery-icons">
								<i class="i1"></i>
								<i class="i2"></i>
								<i class="i3"></i>
							</div>
						</div><!-- /lPart -->
						<div class="rPart">
							<div class="social-icons">
								<script type="text/javascript">
									idlink = '<?php echo $this->_tpl_vars['config_arr']['partner_id']; ?>
';
									document.write('<div title="Facebook" class="bookmark_ico facebook"><a rel="nofollow" target="_blank" href="http://www.facebook.com/sharer.php?u=http://<?php echo $_SERVER['HTTP_HOST']; ?>
/?id=' + idlink + '&amp;t=<?php echo $this->_tpl_vars['config_array']['shop_title']; ?>
 @ <?php echo $_SERVER['HTTP_HOST']; ?>
 - <?php echo $this->_tpl_vars['name']; ?>
"></a></div>');
									document.write('<div title="Twitter" class="bookmark_ico twitter"><a rel="nofollow" target="_blank" href="http://www.twitter.com/home?status=<?php echo $this->_tpl_vars['config_array']['shop_title']; ?>
 @ <?php echo $_SERVER['HTTP_HOST']; ?>
 - <?php echo $this->_tpl_vars['name']; ?>
"></a></div>');
									document.write('<div title="Google+" class="bookmark_ico google"><a rel="nofollow" target="_blank" href="http://www.google.com/bookmarks/mark?op=add&amp;bkmk=http://<?php echo $_SERVER['HTTP_HOST']; ?>
/?id=' + idlink + '&amp;title=<?php echo $this->_tpl_vars['config_array']['shop_title']; ?>
 @ <?php echo $_SERVER['HTTP_HOST']; ?>
 - <?php echo $this->_tpl_vars['name']; ?>
"></a></div>');
									document.write('<div title="Digg" class="bookmark_ico digg"><a rel="nofollow" target="_blank" href="http://www.digg.com/submit?phase=2&url=http://<?php echo $_SERVER['HTTP_HOST']; ?>
/?id=' + idlink + '&amp;title=<?php echo $this->_tpl_vars['config_array']['shop_title']; ?>
 @ <?php echo $_SERVER['HTTP_HOST']; ?>
 - <?php echo $this->_tpl_vars['name']; ?>
"></a></div>');
									document.write('<div title="Delicious" class="bookmark_ico icio"><a rel="nofollow" target="_blank" href="http://del.icio.us/post?url=http://<?php echo $_SERVER['HTTP_HOST']; ?>
/?id=' + idlink + '&amp;title=<?php echo $this->_tpl_vars['config_array']['shop_title']; ?>
 @ <?php echo $_SERVER['HTTP_HOST']; ?>
 - <?php echo $this->_tpl_vars['name']; ?>
"></a></div>');
									document.write('<div title="LinkedIn" class="bookmark_ico linkedin"><a rel="nofollow" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2F<?php echo $_SERVER['HTTP_HOST']; ?>
/?id=' + idlink + '&title=<?php echo $this->_tpl_vars['config_array']['shop_title']; ?>
 @ <?php echo $_SERVER['HTTP_HOST']; ?>
 - <?php echo $this->_tpl_vars['name']; ?>
"></a></div>');
									document.write('<div title="Livejournal" class="bookmark_ico lj"><a rel="nofollow" target="_blank" href="http://www.livejournal.com/update.bml?subject=<?php echo $this->_tpl_vars['config_array']['shop_title']; ?>
 @ <?php echo $_SERVER['HTTP_HOST']; ?>
 - <?php echo $this->_tpl_vars['name']; ?>
"></a></div>');
									document.write('<div title="Surfingbird" class="bookmark_ico surfingbird"><a rel="nofollow" target="_blank" href="https://surfingbird.ru/share/login?back=/share?url=http://<?php echo $_SERVER['HTTP_HOST']; ?>
&title=<?php echo $this->_tpl_vars['config_array']['shop_title']; ?>
 @ <?php echo $_SERVER['HTTP_HOST']; ?>
 - <?php echo $this->_tpl_vars['name']; ?>
"></a></div>');
									document.write('<div title="Whatsapp" class="bookmark_ico whatsapp"><a rel="nofollow" target="_blank" href="whatsapp://send?text=<?php echo $this->_tpl_vars['config_array']['shop_title']; ?>
 @ <?php echo $_SERVER['HTTP_HOST']; ?>
 - <?php echo $this->_tpl_vars['name']; ?>
"></a></div>');
									document.write('<div title="Viber" class="bookmark_ico viber"><a rel="nofollow" target="_blank" href="viber://forward?text=<?php echo $this->_tpl_vars['config_array']['shop_title']; ?>
 @ <?php echo $_SERVER['HTTP_HOST']; ?>
 - <?php echo $this->_tpl_vars['name']; ?>
"></a></div>');
								</script>
							</div>
							<h1 class="tit-big">
								<?php if ($this->_tpl_vars['urlArr']['folders']['0'] == 'testimonials' || $this->_tpl_vars['urlArr']['folders']['0'] == 'faq' || $this->_tpl_vars['urlArr']['folders']['0'] == 'contact' || $this->_tpl_vars['urlArr']['folders']['0'] == 'basket' || ( $this->_tpl_vars['urlArr']['folders']['0'] == 'page' && $this->_tpl_vars['urlArr']['folders']['1'] == 'policy' ) || ( $this->_tpl_vars['urlArr']['folders']['0'] == 'page' && $this->_tpl_vars['urlArr']['folders']['1'] == 'about' ) || ( $this->_tpl_vars['urlArr']['folders']['0'] == 'categories' && $this->_tpl_vars['urlArr']['folders']['2'] == 'all' )): ?>
									<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('mytranslate', true, $_tmp) : smarty_modifier_mytranslate($_tmp)); ?>

								<?php else: ?>
									<?php echo $this->_tpl_vars['name']; ?>

								<?php endif; ?>
							</h1>




