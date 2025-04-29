{include file="!header.tpl"}
	{if !$config_array.db_ver}
		<div class="alert alert-error">
			<b>Please go to the &laquo;<a href="?p=update">Update DB</a>&raquo; section and click the "Install Update" button. Your shop will be active then.</b>
		</div>
	{/if}
	<h2>Generate code</h2>
	<div class="label label-warning">
		<div id="generate_code" style="font-weight:bold; font-size:20px; line-height:25px"></div>
	</div>
	
	<br><br>
	<button id="generate_code-btn" type="submit" class="btn btn-info">Generate</button>
	<br>
{include file="!footer.tpl"}