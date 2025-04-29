{include file="!header.tpl"}


<div class="row-fluid">
	{if !$config_array.db_ver}
		<div class="alert alert-error">
			<b>Please go to the &laquo;<a href="?p=update">Update DB</a>&raquo; section and click the "Install Update" button. Your shop will be active then.</b>
		</div>
	{/if}
</div><!--/row-->



{include file="!footer.tpl"}