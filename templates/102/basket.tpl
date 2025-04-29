{include file="!header.tpl"}{strip}
<div class="strong-sides">
    <table>
        <tr>
            <td><div><i></i><div>{"No Prescription Required"|mytranslate}</div></div></td>
            <td><div><i></i><div>{"100% MoneyBack Guarentee"|mytranslate}</div></div></td>
            <td><div><i></i><div>{"Discreet packaging"|mytranslate}</div></div></td>
        </tr>
    </table>
</div>
{if $result_arr|@count > 0}
<form action="{$config_array.bil_url}/billing" method="post" class="backet_form" id="backet_form">
	<div class="backet_table_block">
		<table class="backet_table" id="backet_table">
			<thead>
			<tr class="first_tr">
				<th class="l"><span>{"Product name"|mytranslate}</span></th>
				<th>{"Package"|mytranslate}</th>
				<th style="width:150px;">{"Qty"|mytranslate}</th>
				<th>{"Per pack"|mytranslate}</th>
				<th class="r"><!-- del --></th>
			</tr>
			</thead>
			<tbody>
			{foreach item=v key=k from=$result_arr name=result_arr_foreach}
			<tr>
				<td class="l"><a href="{$BASE_FOLDER}categories/{$v.0|stripslashes|replace:' ':'-'}/{$config_array.pill_prefix}{$v.1|stripslashes|replace:' ':'-'}{$config_array.pill_postfix}">{$v.1|escape}</a></td>
				<td>{$v.2|escape}{$v.5|escape} &times; {$v.7|escape}{$v.6|escape|mytranslate}</td>
				<td>
					<span class="id_pack" style="display:none;">{$k}</span>
					
					<div class="cnt_control">
                        <input class="btn-micro b_minus" type="button" value="" />
						<div class="inpX">
							<div>
								<input class="cnt" name="order_count[{$k}]" type="text" value="{$v.3|escape}" readonly="readonly" />
								<input type="hidden" name="order_name[{$k}]" value="{$v.1|escape}" />
								<input type="hidden" name="order_dosage[{$k}]" value="{$v.2|escape}" />
								<input type="hidden" name="order_price[{$k}]" value="{$v.4|escape}" />
								<input type="hidden" name="order_price_user_currency[{$k}]" value="{$v.price|escape}" />
								<input type="hidden" name="order_type[{$k}]" value="{$v.5|escape}" />
								<input type="hidden" name="order_pack_name[{$k}]" value="{$v.6|escape}" />
								<input type="hidden" name="order_count_in_pack[{$k}]" value="{$v.7|escape}" />
								<input type="hidden" name="order_price_per_pill[{$k}]" value="{$v.8|escape}" />
							</div>
						</div>
                        <input class="btn-micro b_plus" type="button" value="" />

					</div>
				</td>
				<td class="cell_price">
					{$currency_symbol}<span>{$v.price|escape|string_format:"%.2f"}</span>
				</td>
				<td class="r"><a class="del" href="?del={$k}" title="Delete"></a></td>
			</tr>
			{/foreach}
			</tbody>
		</table>
	</div><!-- /backet_table_block -->
    {if $bonus_arr|@count > 0}
	<div class="h1">{"Select free bonus"|mytranslate}</div>
	<div class="bonusBox" id="bonus">
		<div><div><div><div>
			<div class="e">
				<input type="radio" name="bonus" {if $smarty.cookies.bonus == ''} checked="checked" {/if} value="" id="bonus_no" />
				<label for="bonus_no">{"No bonus"|mytranslate}</label>
			</div>
			{foreach item=v key=k from=$bonus_arr}
			<div class="e">
				<input {if $smarty.cookies.bonus == $k} checked="checked"{/if} type="radio" value="{$k}" name="bonus" id="bonus_{$k}" />
				<label for="bonus_{$k}">{$k} {$v.1} {$v.2} &times; <span id="bbonus_{$k}">{$v.0}</span> {$v.3|mytranslate}</label>
				{assign var=bonus_cnt value=$v.0 }
			</div>
			{/foreach}
			
			<input type="hidden" name="bonus_cnt" value="{$bonus_cnt}" id="bonus_cnt" />
			
			<div class="clear"></div>
		</div></div></div></div>
	</div><!-- /bocusBox -->
	{/if}
	<div class="h1">{"Select shipping"|mytranslate}</div>
	<div class="shipping">
		<div>
			<div>
				<div>
					<table id="shipping">
						<tr class="metka_AirMail">
							<td class="cell1"><input name="shipping" type="radio" value="AirMail" {if $smarty.cookies.shipping == 'AirMail'} checked="checked" {/if} /></td>
							<td class="cell2">
								<i>{"AirMail (World Wide)"|mytranslate}</i>
								<div>{"The delivery may take up to 2-3 business weeks for for AirMail. Unfortunately Online Tracking is not available for Airmail."|mytranslate}</div>
								<span>{"We provide Free AirMail shipping for orders over"|mytranslate} ${$SHIPPING_AIR_MAIL_FREE}.</span>
							</td>
							<td class="cell3">{$currency_symbol}<span>{$config_array.shipping.AirMail}</span></td>
						</tr>
                        {if isset($config_array.shipping.EMS)}
							<tr class="metka_EMS">
								<td class="cell1"><input name="shipping" type="radio" value="EMS" {if $smarty.cookies.shipping == 'EMS'} checked="checked" {/if} /></td>
								<td class="cell2">
									<i>{"EMS (World Wide)"|mytranslate}</i>
									<div>{"EMS (Express Mail Service) is the fastest available shipping method. You will receive your shipping track id as soon as the package is shipped.The waiting period for EMS lasts 3-8 business days."|mytranslate}</div>
									<span>{"We provide Free EMS shipping for orders over"|mytranslate} ${$SHIPPING_EMS_FREE}.</span>
								</td>
								<td class="cell3">{$currency_symbol}<span>{$config_array.shipping.EMS}</span></td>
							</tr>
						{/if}
					</table>
				</div>
			</div>
		</div>
	</div><!-- /shipping -->
	<div class="result_price_and_discount_block">
			{if $smarty.cookies.discount_ok}
				<span class="old thr">{$currency_symbol}<span>{$order_total_price|string_format:"%.2f"}</span></span>
				<span class="new_price">
					
					<i>{"with discount"|mytranslate} {$smarty.cookies.discount_ok|intval}%</i>
					<br>
					{$currency_symbol}{$order_total_price_discount|string_format:"%.2f"}
				</span>
			{/if}
            <div class="totalPrice">
                <i style="font-style: normal; white-space: nowrap">
			        {"Your order sum is:"|mytranslate}<span>

			        {$currency_symbol}<span id="result_price">{$order_total_price_with_shipping|string_format:"%.2f"}</span>
                </i>

            </span>
					</div>

        <div class="clear"></div>
								
								
		
	</div><!-- /result_price_and_discount_block -->
	<div class="result_buttons">
        {if $smarty.cookies.discount_code}
            <input type="hidden" value="{$smarty.cookies.discount_code_to|escape}" name="discount_code" />
        {/if}
        {if $smarty.cookies.xspy}
            <input type="hidden" id="xspy_cov" name="xspy_cov" value='{$smarty.cookies.xspy}'>
        {/if}
		<input type="hidden" id="price_total_hidden" name="price_total" value="{$order_total_price_with_shipping|string_format:"%.2f"}">
		<input type="hidden" id="order_total_price_with_shipping_original_hidden" name="order_total_price_with_shipping_original" value="{$order_total_price_with_shipping_original|string_format:"%.2f"}">
		<input type="hidden" value="{$form_lang}" name="form_lang" />
		<input type="hidden" value="{$smarty.cookies.search_words}" name="search_words" />
		<input type="hidden" value="{$form_currency}" name="form_currency" />
		<input type="hidden" value="{$form_country}" name="form_country" />
		<input type="hidden" value="{$form_country_code}" name="form_country_code" />
		{assign var=ship_type value=$smarty.cookies.shipping}
		<input type="hidden" name="ship_price" value="{$config_array.shipping.$ship_type}" id="ship_price" />

        <input type="hidden" name="coeff_of_inflation" value="{$config_array.currency.$currency.0}" id="coeff_of_inflation" />

		<input type="hidden" name="shipping_ptice_in_original_currency" value="{$shipping_original_price}" id="shipping_ptice_in_original_currency" />
		<input type="hidden" id="ems_price_original" name="ems_price_original" value="{$config_array.shipping.EMS}" />
		<input type="hidden" id="extra_charge" name="extra_charge" value="{$config_array.extra_charge}" />
		<input type="hidden" id="air_mail_price_original" name="air_mail_price_original" value="{$config_array.shipping.EMS}" />
		<input type="hidden" name="ship_price_original" value="{$shipping_original_price}" />
		<input type="hidden" name="total_price_with_shipping_original" id="total_price_with_shipping_original" value="{$order_total_price_with_shipping_original|escape}" />
		<input type="hidden" name="partner_id" value="{$config_array.partner_id}" />
		<input type="hidden" name="design" value="{$config_array.default_template}" />
		{if $smarty.cookies.discount_ok}


            <input type="hidden" name="discount_in_user_currency" value="{$order_total_price-$order_total_price_discount|string_format:"%.2f"}">
			<input type="hidden" id="price_total_without_discount_hidden" name="price_total_without_discount" value="{$order_total_price|string_format:"%.2f"}">
			<input type="hidden" id="order_total_price_discount_original_hidden" name="order_total_price_discount_original" value="{$order_total_price_discount_original|string_format:"%.2f"}">
			<input type="hidden" name="discount_ok" value="{$smarty.cookies.discount_ok|escape}" />
			<input type="hidden" name="discount" value="{$smarty.cookies.discount|escape}" />
		{/if}
		<input type="hidden" name="referer" value="{$smarty.cookies.referer|escape}" />
		<input type="hidden" name="uniq_flag" value="{$smarty.cookies.uniq_flag|escape}" />
		<input type="hidden" name="js_test" value="{$smarty.cookies.js_test|escape}" />
		<input type="hidden" name="trackid" value="{$smarty.cookies.trackid|escape}" />
		<input type="hidden" name="subid" value="{$smarty.cookies.subid|escape}" />
		<input type="hidden" name="ucheckout" value="{$smarty.cookies.ucheckout|escape}" />

		<input type="hidden" name="currency_symbol" value="{$currency_symbol}" />
		<input type="hidden" name="currency_coef" value="{$currency_coeff}" />
		<input type="hidden" name="back_link" value="{$back_link}" />
		<input type="hidden" name="shop_http_host" value="{$smarty.server.HTTP_HOST}" />
		
		<input class="btn btn-default continue" type="button" value="{"CONTINUE SHOPPING"|mytranslate}" onclick="window.location = '{$BASE_FOLDER}categories/Bestsellers/all';" />
		<input class="btn btn-default btn-success" type="submit" value="{"CHECKOUT"|mytranslate}" name="checkout" id="checkout" />
		
		<input class="btn btn-default" type="submit" value="{"UPDATE"|mytranslate}" name="update" id="update_button" />
	</div>
</form>
<form class="discount_form" action="" method="post">
	{*if !$smarty.cookies.discount_ok}
		<div class="h1">{"Coupon Code:"|mytranslate}</div>
	{/if*}
    <br>

	<table class="discount_table{if $smarty.cookies.discount_ok == true} off{/if}">
		<tr>
			<td colspan="2">
				<div class="h1">{"Coupon Code:"|mytranslate}</div>
			</td>
		</tr>
		<tr>
			{if $discount_error}
				<td class="b">
					<div class="error" style="white-space: nowrap;">{"Bad code!"|mytranslate}</div>
				</td>
			{/if}
        </tr>
        <tr>
			<td>
				<input style="width: 130px; min-width: 80px;" name="discount_code" type="text" value="" class="i" value="{"APPLY DISCOUNT"|mytranslate}" placeholder="" />
			</td>

			<td><div><input class="btn btn-discount" type="submit" name="discount" value="{"APPLY DISCOUNT"|mytranslate}" /></div></td>
			<!--td>
				{if $smarty.cookies.discount_ok}
					{$currency_symbol}<span>{$order_total_price_discount|string_format:"%.2f"}</span>
				{/if}
			</td-->
		</tr>
	</table>
</form>
{else}
	<div class="empty">{"Empty shopping cart."|mytranslate} <a href="{$BASE_FOLDER}categories/Bestsellers/all">{"Bestsellers"|mytranslate}</a></div>
{/if}
{/strip}{include file="!footer.tpl"}