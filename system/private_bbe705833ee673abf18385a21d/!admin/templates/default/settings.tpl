{include file="!header.tpl"}
	{if !$config_array.db_ver}
		<div class="alert alert-error">
			<b>Please go to the &laquo;<a href="?p=update">Update DB</a>&raquo; section and click the "Install Update" button. Your shop will be active then.</b>
		</div>
	{/if}
	{if $errorStrSettings}
		<div class="alert alert-error">
			{$errorStrSettings}
		</div>
	{/if}
	<form action="" method="post">
		<table class="table table-bordered table-hover" style="width:auto;">
			<tr>
				<th style="white-space: nowrap">
					<label for="default_template">Default template</label>
				</th>
				<td>
					<div>
						<select class="radius" name="default_template" id="template_change">
							{foreach item=v key=k from=$templatesArr}
								<option {if $smarty.post.default_template == $v || !$smarty.post.default_template && $config_array.default_template == $v} selected="selected"{/if} value="{$v}">{$v}</option>
							{/foreach}
						</select>
					</div>
				</td>
				<td>
					<img src="{$BASE_FOLDER}templates/{$config_array.default_template}/mini.jpg" width="100" style="border:solid 1px #bdbdbd; margin-right:5px; position:relative; top:-3px; border-radius:5px;" alt="" title="" id="template_change_pic" />
				</td>
			</tr>
			<tr>
				<th style="white-space: nowrap">
					<label for="extra_charge" style="padding-top: 5px;">Price extra charge %</label>
				</th>
				<td colspan="2">
					<input type="text" value="{$config_array.extra_charge}" name="extra_charge" id="extra_charge" style="width:40px;">
					<br>
					<div style="display:inline-block; font-size: 12px; line-height:16px; position:relative; top: -4px;">This setting changes price for all products at all of you shops.<br> Setting varies from {$config_array.min_extra_charge|floatval}% to 50%. Recommended value is 0%</div>
				</td>
			</tr>
			<tr>
				<th style="white-space: nowrap">
					<label for="show_tree_price" style="padding-top: 5px;">Show price in sub categories</label>
				</th>
				<td colspan="2">
					<input type="checkbox" {if $config_array.show_tree_price} checked="checked"{/if} name="show_tree_price" id="show_tree_price">
				</td>
			</tr>
			<tr>
				<th style="white-space: nowrap">
					<label for="default_category" style="padding-top: 5px;">Default category</label>
				</th>
				<td colspan="2">
					<select name="default_category" id="default_category">
						{foreach item=v key=k from=$tree}
							<option value="{$v}"{if $config_array.default_category == $v} selected="selected"{/if}>{$v}</option>
						{/foreach}
					</select>
				</td>
			</tr>
			{*
			<tr>
				<th>
					<label for="extra_charge" style="padding-top: 5px;">Title</label>
				</th>
				<td colspan="2">
					<input type="text" value="{$config_array.extra_charge}" name="extra_charge" id="extra_charge">
				</td>
			</tr>
			*}
            <tr>
                <th style="width: 130px; white-space: nowrap">
                    <label>Absolute URL <small>(in href)</small></label>
                </th>
                <td colspan="2">
                    <input type="checkbox" id="url_abs" name="url_abs" value="1" {if $config_array.url_abs} checked="checked"{/if}>
                </td>
            </tr>
            <tr>
                <th style="width: 130px; white-space: nowrap">
                    <label form="pack_reverse">Pack reverse</label>
                </th>
                <td colspan="2">
                    <input type="checkbox" id="pack_reverse" name="pack_reverse" value="1" {if $config_array.pack_reverse} checked="checked"{/if}>
                </td>
            </tr>
		</table>
		<input class="btn" type="submit" name="sbmt_global_settings" value="Save" />
	</form>
	<hr>
	
{include file="!footer.tpl"}