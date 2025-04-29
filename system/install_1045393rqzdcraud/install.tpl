<html>
	<head>
		<title>Install</title>
		<link href="install.css" rel="stylesheet" media="all" />
	</head>
	<body>
		{if $erros_arr|@count > 0}
		<div class="errors">
			{foreach item=v key=k from=$erros_arr}
				{$v}<br>
			{/foreach}
		</div>
		{/if}
		{if !$smarty.get.success }
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
		{else}
			<h2>Instalation complete</h2>
            <p>This url is your admin area: <a href="http://{$smarty.server.HTTP_HOST}{$relatiive_path}system/{$secret_folder}/!admin">http://{$smarty.server.HTTP_HOST}{$relatiive_path}system/{$secret_folder}/!admin</a></p>
            <p>Log in to this admin area and the database will be installed automatically.</p>
		{/if}
	</body>
</html>