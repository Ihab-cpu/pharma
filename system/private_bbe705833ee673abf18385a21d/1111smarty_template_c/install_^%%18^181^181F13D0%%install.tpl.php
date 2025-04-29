<?php /* Smarty version 2.6.30, created on 2025-04-20 16:59:36
         compiled from install.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'install.tpl', 7, false),)), $this); ?>
<html>
	<head>
		<title>Install</title>
		<link href="install.css" rel="stylesheet" media="all" />
	</head>
	<body>
		<?php if (count($this->_tpl_vars['erros_arr']) > 0): ?>
		<div class="errors">
			<?php $_from = $this->_tpl_vars['erros_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
				<?php echo $this->_tpl_vars['v']; ?>
<br>
			<?php endforeach; endif; unset($_from); ?>
		</div>
		<?php endif; ?>
		<?php if (! $_GET['success']): ?>
			<h2>Shop installation</h2>
			<form action="" method="post" enctype="multipart/form-data">
				<table class="install-table">
					<tr>
						<th><label for="partner_id">Partner id</label></th>
						<td>
                            <input type="text" class="form-control" name="partner_id" id="partner_id" style="width:300px; display:inline-block;" />
                            &nbsp;<small>Log in to the affiliate program. There you can get your PARTNER_ID at the top of the site.</small>
                        </td>
					</tr>
					<tr>
						<th><label for="password">Shop admin password</label></th>
						<td><input type="password" class="form-control" name="password" id="password" style="width:300px; display:inline-block;" /></td>
					</tr>
					<tr>
						<th><label for="private_folder">Private folder name</label></th>
						<td>
                            <input type="text" class="form-control" name="private_folder" id="private_folder" style="width:300px; display:inline-block;" />
                            &nbsp;<small>Add a new domain at the &laquo;Your Servers&raquo; and you will get your private folder.</small>
                        </td>
					</tr>
					<tr>
						<th></th>
						<td>
							<input type="submit" class="btn btn-default" value="Install" >
						</td>
					</tr>
					<tr>
						<th></th>
						<td>

						</td>
					</tr>
				</table>
			</form>
		<?php else: ?>
			<h2>Instalation complete</h2>
            <p>This url is your admin area: <a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>
<?php echo $this->_tpl_vars['relatiive_path']; ?>
system/<?php echo $this->_tpl_vars['secret_folder']; ?>
/!admin">http://<?php echo $_SERVER['HTTP_HOST']; ?>
<?php echo $this->_tpl_vars['relatiive_path']; ?>
system/<?php echo $this->_tpl_vars['secret_folder']; ?>
/!admin</a></p>
            <p>Log in to this admin area and the database will be installed automatically.</p>
		<?php endif; ?>
	</body>
</html>