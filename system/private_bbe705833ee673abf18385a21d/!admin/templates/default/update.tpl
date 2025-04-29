{include file="!header.tpl"}
	<div class="row-fluid">
		<div class="span12">
				{if !$config_array.db_ver}
					<div class="alert alert-error">
						<b>No database is installed</b>
					</div>
				{else}
					<span class="label">
						{if $config_array.db_ver}{$config_array.db_ver|date_format:"%Y-%m-%d %H:%M:%S"}{else}-{/if}
					</span> - Your update version
					<br>
				{/if}
			{if $update_file_isset}
				<span class="label label-success">{$update_file_ver|date_format:"%Y-%m-%d %H:%M:%S"}</span> - Local version of update file &laquo;{$update_file}&raquo;
			{else}
				<span class="label">You have no update file in &laquo;/{$update_file}&raquo;</span>
			{/if}
		</div>
	</div>

	<div class="clearfix"></div>
	<hr>
	<br>
	{if !$smarty.post.install_update && !$global_error || isset($smarty.get.need_update)}
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab2" data-toggle="tab">Manual update</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab2">
					<ol>
						<li>
						    <form action="" method="post" enctype="multipart/form-data">

                                      <p>
                                        <input type="file" name="file_update" id="file_update" class="btn btn-small" style="padding:0; line-height: 8px"> <input type="submit" value="Upload" name="load_update_file" class="btn btn-info" id="load_file_btn">
                                        OR
                                        <strong>upload update file via FTP to &laquo;{$update_file}&raquo;</strong>
                                    </p>
                                    <hr>
                            </form>
						</li>
						<li>
						    <form action="" method="get">
						        <input type="hidden" value="update" name="p">
							    <input class="btn btn-success" {if !$update_file_isset}  disabled="disabled" {/if} type="submit" name="install_update" value=" Install Update " />
							</form>
						</li>
					</ol>
				</div>
			</div>
		</div>
		<hr>
	</form>
	{/if}
{include file="!footer.tpl"}