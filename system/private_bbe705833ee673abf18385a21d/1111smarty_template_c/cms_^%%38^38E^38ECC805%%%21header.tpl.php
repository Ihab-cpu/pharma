<?php /* Smarty version 2.6.30, created on 2025-04-20 17:00:32
         compiled from %21header.tpl */ ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
		<title>Shop.CMS - <?php echo $this->_tpl_vars['name']; ?>
</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0">
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root_path']; ?>
bootstrap/css/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root_path']; ?>
bootstrap/css/bootstrap-responsive.min.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root_path']; ?>
css/main.css" />
		<link type="text/css" rel="stylesheet" href="<?php echo $this->_tpl_vars['template_root_path']; ?>
css/smoothness/jquery-ui-1.10.2.custom.min.css" />
		<!--[if IE]><link href="<?php echo $this->_tpl_vars['template_root_path']; ?>
css/ie.css" rel="stylesheet" type="text/css" /><![endif]-->
		<!--[if IE 6]><link href="<?php echo $this->_tpl_vars['template_root_path']; ?>
css/ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
		<!--[if IE 7]><link href="<?php echo $this->_tpl_vars['template_root_path']; ?>
css/ie7.css" rel="stylesheet" type="text/css" /><![endif]-->

		<!--script src="<?php echo $this->_tpl_vars['template_root_path']; ?>
js/jquery-ui-1.8.15.custom/js/jquery-1.6.2.min.js"></script-->
		<script src="<?php echo $this->_tpl_vars['template_root_path']; ?>
js/jquery-bootstrap.js"></script>
		<!--script src="<?php echo $this->_tpl_vars['template_root_path']; ?>
js/jquery-1.4.4.min.js"></script>
		<script src="<?php echo $this->_tpl_vars['template_root_path']; ?>
js/bootstrap-modal.js"></script>
		<script src="http://getbootstrap.com/2.3.2/assets/js/jquery.js"></script-->

		<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root_path']; ?>
js/jquery-ui-1.10.2.custom.min.js"></script>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root_path']; ?>
js/jquery.zclip.min.js"></script>

		<script type="text/javascript" src="<?php echo $this->_tpl_vars['template_root_path']; ?>
js/js.js"></script>
		<script type="text/javascript">
		var templates_path = '<?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
' + 'templates/';
		</script>
	</head>
	<body>
		<div class="navbar"><!--  navbar-fixed-top -->
			<div class="navbar-inner">
				<div class="container-fluid">
					<a class="btn btn-navbar" id="main_menu_reactor" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</a>
					<a class="brand" href="?p=index">Shop.CMS</a>
					<div class="nav-collapse collapse" id="main_menu_base">
						<p class="navbar-text pull-right"><a href="?logout" class="navbar-link">Logout</a></p>
						<ul class="nav">
							<li><a href="<?php if ($this->_tpl_vars['BASE_FOLDER']): ?><?php echo $this->_tpl_vars['BASE_FOLDER']; ?>
<?php else: ?>/<?php endif; ?>" target="_blank">To shop &rarr;</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span2">
					<div class="well sidebar-nav">
						<ul class="nav nav-list">
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						</ul>
					</div><!--/.well -->
				</div><!--/span-->
				<div class="span10" style="position:relative">
					<?php if ($this->_tpl_vars['global_status']): ?>
						<br>
						<div class="alert alert-success">
							<?php echo $this->_tpl_vars['global_status']; ?>

						</div>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['global_error']): ?>
						<br>
						<div class="alert <?php if ($this->_tpl_vars['global_error_color_blue']): ?> alert-info<?php else: ?>alert-error<?php endif; ?>">
							<?php echo $this->_tpl_vars['global_error']; ?>

						</div>
					<?php endif; ?>