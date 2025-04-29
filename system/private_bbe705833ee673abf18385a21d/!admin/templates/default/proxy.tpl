{include file="!header.tpl"}
	
	
<div class="row-fluid">
	{if !$config_array.db_ver}
		<div class="alert alert-error">
			<b>Please go to the &laquo;<a href="?p=update">Update DB</a>&raquo; section and click the "Install Update" button. Your shop will be active then.</b>
		</div>
	{/if}
	<h2>Easy shop in two files</h2>
	1. You should have a working shop<br>
	2. Upload proxy files index.php and htaccess on any your host<br>
	Path for proxy files: system/private_folder_xxx/proxy<br>
	3. Edit index.php and indicate the address of any of your working shop<br>
	eg: define('HOST', 'domain.com OR IP');<br>
	
	Your new shop is ready!<br>
</div><!--/row-->

	
	
{include file="!footer.tpl"}