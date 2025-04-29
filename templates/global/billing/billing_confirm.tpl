{include file="../global/billing/!header_bill.tpl"}

<form class="billing" action="" method="post">
	<div class="bill_master_name" style="float:none;text-align:center;">
		{"Dear"|mytranslate} {$smarty.post.fld_first_name|escape} {$smarty.post.fld_last_name|escape}, {"Thank you for your order!"|mytranslate}
	</div>
	<!--div class="bill_ahtung">Your data is safely encrypted and is safe from unauthorized access.</div-->
	<div class="clear"></div>
	<br>
	{if $smarty.post.fld_credit_card_no != '44442*******8888'}
	<p style="font-size:16px;text-align:center;padding-left:100px;padding-right:100px; line-height:20px;">
		{"We will process your order within 24 hours and a send you  a confirmation e-mail."|mytranslate}
		<br>
		{"Attention:  it is necessary for you to save an address of our customer support site:"|mytranslate}
		<br>
		<b><a style="display:block; padding: 8px 0 11px 0; font-size:18px;" href="{$config_array.support_site}" target="_blank">{$config_array.support_site}</a></b>
		{"In case of not getting a confirmation e-mail because of  spam-filters, you will be"|mytranslate}
		<br>
		{"able to look up your order status and receive your shipping track ID on this site."|mytranslate}
        {if $lang == 'en'}
        <br>
        If you order is not approved within 24 hours your credit card might be blocked for internet transactions. Please get in touch with your bank and ask to remove the block.
        {/if}
	</p>
	<br>
	{/if}
	<div class="order_table">
		<div class="backet_table_block">
			<ol class="progtrckr" data-progtrckr-steps="3">
				<li class="progtrckr-done">{"Step 1"|mytranslate}</li>
				<li class="progtrckr-done">{"Step 2"|mytranslate}</li>
				<li class="progtrckr-done">{"Confirm"|mytranslate}</li>
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
						{if $k != 'insurance' || $k == 'insurance' && $smarty.post.insurance == 1}
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
	<br>
	<table style="width:100%">
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
				
				{if $smarty.post.bill_shipping_is_different == 1}
					<tr>
						<td class="shipping_adrr_td_100" colspan="2"><br><br><br><div class="bill_tit">{"shipping address"|mytranslate}</div></td>
					</tr>
						
					<tr>
						<th>{"First Name:"|mytranslate}</th>
						<td>{$smarty.post.fld_first_name2|escape}</td>
					</tr>
					<tr>
						<th>{"Last name:"|mytranslate}</th>
						<td>{$smarty.post.fld_last_name2|escape}</td>
					</tr>
					<tr>
						<th>Country:</th>
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
				{/if}
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
												<th style="padding:2px 6px 0 0;">{"Cardholder name:"|mytranslate}</th>
												<td>{$smarty.post.fld_card_holder_name|escape}</td>
											</tr>
											<tr>
												<th style="padding:2px 6px 0 0;">{"Credit card No:"|mytranslate}</th>
												<td>
													{$smarty.post.fld_credit_card_no|escape}
												</td>
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
	<input id="print_btn" type="button" value="{"Print page"|mytranslate}" class="btn" style="float:right;" />
	<p><b>{"Please print or save this page for your records"|mytranslate}</b></p>
</form>

{* FB Purchase event *}
<script>
  fire('Purchase',{
      value: '{$price_total|escape}',
      currency: '{$currency_symbol|escape}'
  });
</script>

{include file="../global/billing/!footer_bill.tpl"}