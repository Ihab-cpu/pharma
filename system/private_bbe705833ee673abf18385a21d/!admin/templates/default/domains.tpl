{include file="!header.tpl"}
{if !$config_array.db_ver}
		<div class="alert alert-error">
			<b>Please go to the &laquo;<a href="?p=update">Update DB</a>&raquo; section and click the "Install Update" button. Your shop will be active then.</b>
		</div>
	{/if}
	<form action="" method="post">
		<div class="alert alert-info">
			If you want to use a design not set as a default for some domains, enter the list of the domains by means of a newline
		</div>
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">Add</a></li>
				<li><a href="#" href="#tab2" data-toggle="tab">Edit settings</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">
					<table>
						<tr>
							<td style="vertical-align:top;">
								<textarea id="textarea_new_domains" name="new_domains" cols="10" rows="6" placeholder="" data-noclick="1">Example:
domain1.com
domain2.com</textarea>
							</td>
							<td rowspan="2" class="template-td" style="padding-left: 10px;">
								<img src="{$BASE_FOLDER}templates/{if !$smarty.get.template}{$config_array.default_template}{else}{$smarty.get.template|escape}{/if}/mini.jpg" width="200" style="border:solid 1px #bdbdbd; margin-right:5px; position:relative; top:-3px; border-radius:5px;" alt="" title="" id="template_change_pic" />
								<br>
								<span style="display:inline-block; position:relative; top: -4px;">Template:</span>
								<select name="template" style="margin-right:10px; width:137px" id="template_change">
									{foreach item=v key=k from=$templatesArr}
										<option {if $smarty.get.template == $v || !$smarty.get.template && $config_array.default_template == $v} selected="selected"{/if} value="{$v}">{$v}</option>
									{/foreach}
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" value="Set not default design" name="add_domains" class="btn btn-info" id="add_domains_btn">
							</td>
					</table>
					<hr>
				</div>
				<div class="tab-pane" id="tab2">
					<table>
						<tr>
							<td style="vertical-align:top;">
								Format: Design|Domain
								<br>
								<textarea name="isset_domains" cols="10" rows="11">{$issetDomains}</textarea>
								<br>
								<input type="submit" value="Save settings" name="save_domains" class="btn btn-info">
							</td>
							<td style="vertical-align:top; padding-left: 10px;">
								
							</td>
						</tr>
					</table>
					<hr>
				</div>
			</div>
	</form>
{include file="!footer.tpl"}