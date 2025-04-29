{include file="../global/billing/!header_bill.tpl"}

<form class="billing check_step" id="billing_form" action="" method="post">
	<div class="bill_master_name">

		{include file="../global/billing/!hidden_fields.tpl"}
		{include file="../global/billing/!hidden_fields_step2.tpl"}
		{"Check your order and confirm"|mytranslate}
	</div>
	<div class="bill_ahtung">{"Your data is safely encrypted and is safe from unauthorized access."|mytranslate}</div>
	<div class="clear"></div>
	
	<div class="order_table">
		<div class="backet_table_block">
			<ol class="progtrckr" data-progtrckr-steps="3">
				<li class="progtrckr-done">{"Step 1"|mytranslate}</li>
				<li class="progtrckr-done">{"Step 2"|mytranslate}</li>
				<li class="progtrckr-todo">{"Confirm"|mytranslate}</li>
			</ol>
			<table class="backet_table" id="backet_table">
				<thead>
				<tr class="first_tr">
					<th class="l">{"Product name"|mytranslate}</th>
					<th>{"Package"|mytranslate}</th>
					<th>{"Qty"|mytranslate}</th>
					<th>{"Per Pack"|mytranslate}</th>
					<th class="r">{"Price"|mytranslate}</th>
				</tr>
				</thead>
				<tbody>
					{foreach item=v key=k from=$buy_arr}
						{if $k != 'insurance' || $k == 'insurance' && $smarty.post.insurance== 1}
							<tr>
								<td class="l">
									{$v.name}
									<input type="hidden" name="order_count[{$k}]" value="{$v.cnt|escape}" />
									<input type="hidden" name="order_name[{$k}]" value="{$v.name|escape}" />
									<input type="hidden" name="order_dosage[{$k}]" value="{$v.dosage|escape}" />
									<input type="hidden" name="order_price[{$k}]" value="{$v.price|escape}" />
									<input type="hidden" name="order_price_user_currency[{$k}]" value="{$v.price_user_currency|escape}" />
									<input type="hidden" name="order_type[{$k}]" value="{$v.type|escape}" />
									<input type="hidden" name="order_pack_name[{$k}]" value="{$v.pack_name|escape}" />
									<input type="hidden" name="order_count_in_pack[{$k}]" value="{$v.cnt_in_pack|escape}" />
									<input type="hidden" name="order_price_per_pill[{$k}]" value="{$v.order_price_per_pill|escape}" />
								</td>
								<td>{if $v.dosage}{$v.dosage}{$v.type} &times; {$v.cnt_in_pack}{$v.pack_name|mytranslate}{/if}</td>
								<td>{$v.cnt}</td>
								<td>{if $v.price}{$currency_symbol}{$v.price_user_currency}{else}<span class="free">Free</span>{/if}</td>
								<td class="r">{if $v.price_full}{$currency_symbol}{$v.price_user_currency_full}{else}<span class="free">Free</span>{/if}</td>
							</tr>
						{/if}
					{/foreach}
                    {if $smarty.cookies.discount_ok || $smarty.post.discount_ok}
                        <tr>
                            <td class="l">{"Discount"|mytranslate}</td>
                            <td></td>
                            <td>1</td>
                            <td><span class="free">{$smarty.post.discount_ok|escape}%</span></td>
                            <td class="r">
                                -{$currency_symbol}{$disc|abs}
                            </td>
                        </tr>
                    {/if}
				</tbody>
			</table>
		</div><!-- /backet_table_block -->
	</div>
	<div class="bill_banners_of_security">
		<div class="bill_b1"></div>
		<div class="bill_b2"></div>
	</div>
	<div class="bill_result_price">
		<div class="bill_corn_1">
			<div class="bill_corn_2">
				{"Your order sum is"|mytranslate}: <span>{$currency_symbol}<i>{$price_total|escape}</i></span>
				{if $currency_symbol != '$'}
				(${$price_total_original|floatval})
				{/if}
			</div>
		</div>
	</div>
	
	
	<div class="clear"></div>
	<div class="bill_error_box" id="bill_error_box">
		
	</div><!-- /bill_error_box -->
	
	<br>
	<table class="chech_table" id="chech_table  ">
		<tr>
			<td class="bill_adres_td">
				<div class="bill_tit">{"Billing"|mytranslate}{if $smarty.post.bill_shipping_is_different != 1}/{"Shipping"|mytranslate} {/if} {"address"|mytranslate}</div>
				<table class="bill_table_type2">
					<tr>
						<th>{"First Name:"|mytranslate}</th>
						<td>{$smarty.post.fld_first_name|escape}</td>
					</tr>
					<tr>
						<th>{"Last name:"|mytranslate}</th>
						<td>{$smarty.post.fld_last_name|escape}</td>
					</tr>
					<tr>
						<th>{"Country:"|mytranslate}</th>
						<td>{$countryBy2Code[$smarty.post.fld_country]}</td>
					</tr>
					<tr>
						<th>{"State / Province:"|mytranslate}</th>
						<td>{$smarty.post.fld_state|escape}</td>
					</tr>
					<tr>
						<th>{"Zip or postal code:"|mytranslate}</th>
						<td>{$smarty.post.fld_zip_code|escape}</td>
					</tr>
					<tr>
						<th>{"City:"|mytranslate}</th>
						<td>{$smarty.post.fld_city|escape}</td>
					</tr>
					<tr>
						<th>{"Street address:"|mytranslate}</th>
						<td>{$smarty.post.fld_street_adress|escape}</td>
					</tr>
					<tr>
						<th>{"Phone:"|mytranslate}</th>
						<td>{$smarty.post.fld_phone|escape}</td>
					</tr>
					<tr>
						<th>{"E-mail:"|mytranslate}</th>
						<td>{$smarty.post.fld_email|escape}</td>
					</tr>
					<tr>
						<th>{"Alternative E-mail:"|mytranslate}</th>
						<td>{$smarty.post.fld_email2|escape}</td>
					</tr>
				</table>
			</td>
			<td class="bill_pay_method">
				<div class="bill_tit">{"Payment information"|mytranslate}</div>
				<div class="bill_corner_box_t1">
					<div class="bill_corner_box_t1_1">
						<div class="bill_corner_box_t1_2">
							<div class="bill_corner_box_t1_3">
								<div class="bill_fix_padding">
									{if $smarty.post.fld_payment_type == 'fld_payment_type_credit_card'}
										<table class="bill_table_type2 first">
											<tr>
												<th style="padding:2px 6px 0 0;">{"Credit card type:"|mytranslate}</th>
												<td>{$smarty.post.fld_credit_card_type|escape}</td>
											</tr>
											<tr>
												<th style="white-space: nowrap; padding:2px 6px 0 0;">{"Cardholder name:"|mytranslate}</th>
												<td>{$smarty.post.fld_card_holder_name|escape}</td>
											</tr>
											<tr>
												<th style="padding:2px 6px 0 0;">{"Credit card No:"|mytranslate}</th>
												<td>{$smarty.post.fld_credit_card_no|escape}</td>
											</tr>
											<tr>
												<th style="padding:2px 6px 0 0;">{"Expiration date:"|mytranslate}</th>
												<td>{$smarty.post.fld_exp_date_1} / {$smarty.post.fld_exp_date_2}</td>
											</tr>
											<tr>
												<th style="padding:2px 6px 0 0;">{"CVC2/CVV2:"|mytranslate}</th>
												<td>{$smarty.post.fld_cvc_cvv2|escape}</td>
											</tr>
										</table>
									{elseif $smarty.post.fld_payment_type == 'fld_payment_type_eCheck'}
										<table class="bill_table_type2 first">
											<tr>
												<th style="padding:2px 6px 0 0;">{"Your Name:"|mytranslate}</th>
												<td>{$smarty.post.fld_eCheck_client_name|escape}</td>
											</tr>
											<tr>
												<th style="padding:2px 6px 0 0;">{"Bank Name:"|mytranslate}</th>
												<td>{$smarty.post.fld_eCheck_bank_name|escape}</td>
											</tr>
											<tr>
												<th style="padding:2px 6px 0 0;">{"Account #:"|mytranslate}</th>
												<td>{$smarty.post.fld_eCheck_account_num|escape}</td>
											</tr>
											<tr>
												<th style="padding:2px 6px 0 0;">{"Bank Routing #:"|mytranslate}</th>
												<td>{$smarty.post.fld_eCheck_bank_routing_num|escape}</td>
											</tr>
											<tr>
												<th style="padding:2px 6px 0 0;">{"Check Number #:"|mytranslate}</th>
												<td>{$smarty.post.fld_eCheck_check_num|escape}</td>
											</tr>
										</table>
									{/if}
								</div><!-- /bill_fix_padding -->
							</div>
						</div>
					</div>
				</div><!-- /bill_corner_box_t1 -->
			</td>
		</tr>
	</table>
	<div id="shipping_is_other" class="shipping_is_other{if $smarty.post.bill_shipping_is_different != 1} yes {/if}">
		<br>
		<br>
		<div class="bill_tit">{"shipping address"|mytranslate}</div>
		<!--div class="bill_shipping_is_different">
			<input type="checkbox" value="1" {if $smarty.post.bill_shipping_is_different == 1} checked="checked" {/if} id="bill_shipping_is_different" />
			<label for="bill_shipping_is_different">My shipping info Is not the same as my billing info</label>
			<div class="clear"></div>
		</div--><!-- /bill_shipping_is_different -->
	
		<!--div class="bill_shipping_different_block"-->
			<table class="bill_adres_td">
				<tr>
					<th>{"First Name:"|mytranslate}</th>
					<td>{$smarty.post.fld_first_name2|escape}</td>
				</tr>
				<tr>
					<th>{"Last name:"|mytranslate}</th>
					<td>{$smarty.post.fld_last_name2|escape}</td>
				</tr>
				<tr>
					<th>{"Country:"|mytranslate}</th>
					<td>{$countryBy2Code[$smarty.post.fld_country2]}</td>
				</tr>
				<tr>
					<th>{"State / Province:"|mytranslate}</th>
					<td>{$smarty.post.fld_state2|escape}</td>
				</tr>
				<tr>
					<th>{"Zip or postal code:"|mytranslate}</th>
					<td>{$smarty.post.fld_zip_code2|escape}</td>
				</tr>
				<tr>
					<th>{"City2:"|mytranslate}</th>
					<td>{$smarty.post.fld_city2|escape}</td>
				</tr>
				<tr>
					<th>{"Street address:"|mytranslate}</th>
					<td>{$smarty.post.fld_street_adress2|escape}</td>
				</tr>
			</table>
		<!--/div-->
	</div><!-- /shipping_is_other -->
	<div class="clear"></div>
	<hr />
	<div class="clear"></div>
	<div class="btn_complete_box">
		<input type="submit" name="back_to_step1" id="back_to_step1" value="&larr; {"Edit order"|mytranslate}" />
		<input type="submit" name="to_confirm" id="btn_complete" value="{"Place Order"|mytranslate}" class="check" />
	</div>
	{if !$smarty.post.btn_complete}
	<br />
	<div class="backToShop">
		<a href="{$smarty.post.back_link|escape}">&larr; {"Back to shop"|mytranslate}</a>
	</div>
	{/if}
	<br />
	<div class="clear"></div>
	<!--div class="debug_win">
		
	</div-->
</form>
{include file="../global/billing/!footer_bill.tpl"}