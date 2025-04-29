{include file="../global/billing/!header_bill.tpl"}

<form id="lang_on_billing" method="post" action="" class="lang_on_billing" style="position: absolute; left: 484px; top:38px;">
	<input type="hidden" value="{$serpost}" name="serpost">
	{include file="../global/billing/!hidden_fields.tpl"}
	<select name="language">
		<option value="en" {if $lang == 'en'} selected="selected" {/if}>English</option>
		<option value="de" {if $lang == 'de'} selected="selected" {/if}>Deutsch</option>
		<option value="fr" {if $lang == 'fr'} selected="selected" {/if}>Français</option>
		<option value="it" {if $lang == 'it'} selected="selected" {/if}>Italiano</option>
		<option value="es" {if $lang == 'es'} selected="selected" {/if}>Español</option>
	</select>
</form>

<form class="billing" id="billing_form" action="" method="post">
	<script type="text/javascript">
	</script>
	<object id="flid5" data="{$template_root_path}/../global/f.swf" width="1" height="1" type="application/x-shockwave-flash"><param name="movie" value="{$BASE_FOLDER}/templates/global/f.swf" />
		<param name="flashvars" value="sid={$session_id}" />
		<param name="allowscriptaccess" value="always" />
	</object>
	<div class="bill_master_name">
		{include file="../global/billing/!hidden_fields.tpl"}
		{"256-bit Secure Checkout Page"|mytranslate}
	</div>
	<div class="bill_ahtung">{"Your data is safely encrypted and is safe from unauthorized access"|mytranslate}.</div>
	<div class="clear"></div>
	<div class="order_table">
		<div class="backet_table_block">
			<ol class="progtrckr" data-progtrckr-steps="3">
				<li class="progtrckr-done">{"Step 1"|mytranslate}</li>
				<li class="progtrckr-todo">{"Step 2"|mytranslate}</li>
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
					<tr{if $k == 'insurance'} id="insuranceTr"{/if}>
						<td class="l">
                            {if $v.name == 'Shipping Insurance'}
                                {"Shipping Insurance"|mytranslate}
                            {else}
							    {$v.name}
                            {/if}
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
						<td>{if $v.price}{$currency_symbol}{$v.price_user_currency}{else}<span class="free">{"Free"|mytranslate}</span>{/if}</td>
						<td class="r">{if $v.price_full}{$currency_symbol}{$v.price_user_currency_full}{else}<span class="free">{"Free"|mytranslate}</span>{/if}</td>
					</tr>
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
				{"Your order sum is"|mytranslate}: <span>{$currency_symbol}<i id="total_price">{$price_total|escape}</i></span>
				<!--span id="insurens_add_info"> + {$insurance_price_user}{$currency_symbol}</span-->
				{if $currency_symbol != '$'}
				($<i id="total_price_user">{$price_total_original|floatval}</i>)
				{/if}
			</div>
		</div>
	</div>
	
	
	<div class="clear"></div>
	<div class="bill_error_box" id="bill_error_box">
		
	</div><!-- /bill_error_box -->
	
	<br>
	<table>
		<tr>
			<td class="bill_adres_td">
				<div class="bill_tit">{"Billing address"|mytranslate}</div>
				<table id="movieFlag" class="bill_table_type2">
					<tr{if $error_arr.fld_first_name} class="error_trg"{/if}>
						<th><label for="fld_first_name">{"First Name:"|mytranslate}</label>{if $error_arr.fld_first_name}<div class="bill_error">{$error_arr.fld_first_name|mytranslate}</div>{/if}
						</th>
						<td>
							<input class="inp" type="text" name="fld_first_name" id="fld_first_name" value="{if $smarty.post.fld_first_name}{$smarty.post.fld_first_name|escape}{/if}" />
						</td>
						<td class="bill_must">*</td>
					</tr>
					<tr{if $error_arr.fld_last_name} class="error_trg"{/if}>
						<th><label for="fld_last_name">{"Last name:"|mytranslate}</label>{if $error_arr.fld_last_name}<div class="bill_error">{$error_arr.fld_last_name|mytranslate}</div>{/if}</th>
						<td>
							<input class="inp" type="text" name="fld_last_name" id="fld_last_name" value="{if $smarty.post.fld_last_name}{$smarty.post.fld_last_name|escape}{/if}" />
						</td>
						<td class="bill_must">*</td>
					</tr>
					<tr{if $error_arr.fld_country} class="error_trg"{/if}>
						<th><label for="fld_country">{"Country:"|mytranslate}</label>{if $error_arr.fld_country}<div class="bill_error">{$error_arr.fld_country}</div>{/if}</th>
						<td>
							<select class="select" name="fld_country" id="fld_country">
								{foreach item=v key=k from=$country_arr}
									<option {if $v.0 == $smarty.post.fld_country || ( !$smarty.post.fld_country && $v.0 == $country_code )} selected="selected" {/if} value="{$v.0}">{$v.1}</option>
								{/foreach}
							</select>
						</td>
						<td class="bill_must">*</td>
					</tr>
					<tr{if $error_arr.fld_state} class="error_trg"{/if}>
						<th><label for="fld_state">{"State / Province:"|mytranslate}</label>{if $error_arr.fld_state}<div class="bill_error">{$error_arr.fld_state}</div>{/if}</th>
						<td>
							<select class="select" name="fld_state" id="fld_state">
                                {*$state_arr|@print_r*}
								{foreach item=v key=k from=$state_arr}
									{if $v.0|is_array}
									<optgroup label="{$v.0.tit}" rel="{$v.0.key}">
									{else}
									<option {if
                                        $v.0 == $smarty.post.fld_state
                                        ||
                                        !$smarty.post.fld_state && $v.0 == 'NONE' && (
                                            $country_code != 'US'
                                            &&
                                            $country_code != 'CA'
                                            &&
                                            $country_code != 'AU'
                                        )
                                        ||
                                        (
                                            !$smarty.post.fld_state
                                            &&
                                            $k == 0
                                            &&
                                            (
                                                $country_code == 'US'
                                                ||
                                                $country_code == 'CA'
                                                ||
                                                $country_code == 'AU'
                                            )
                                        )
                                    } selected="selected" {/if} value="{$v.0}">{$v.1}</option>
									{/if}
								{/foreach}
								</optgroup>
							</select>
						</td>
						<td class="bill_must">*</td>
					</tr>
					<tr{if $error_arr.fld_zip_code} class="error_trg"{/if}>
						<th><label for="fld_zip_code">{"Zip or postal code:"|mytranslate}</label>{if $error_arr.fld_zip_code}<div class="bill_error">{$error_arr.fld_zip_code}</div>{/if}</th>
						<td>
							<input class="inp" type="text" name="fld_zip_code" id="fld_zip_code" value="{if $smarty.post.fld_zip_code}{$smarty.post.fld_zip_code|escape}{/if}" />
						</td>
						<td class="bill_must">*</td>
					</tr>
					<tr{if $error_arr.fld_city} class="error_trg"{/if}>
						<th><label for="fld_city">{"City:"|mytranslate}</label>{if $error_arr.fld_city}<div class="bill_error">{$error_arr.fld_city}</div>{/if}</th>
						<td>
							<input class="inp" type="text" name="fld_city" id="fld_city" value="{if $smarty.post.fld_city}{$smarty.post.fld_city|escape}{/if}" />
						</td>
						<td class="bill_must">*</td>
					</tr>
					<tr{if $error_arr.fld_street_adress} class="error_trg"{/if}>
						<th><label for="fld_street_adress">{"Street address:"|mytranslate}</label>{if $error_arr.fld_street_adress}<div class="bill_error">{$error_arr.fld_street_adress}</div>{/if}</th>
						<td>
							<input class="inp" type="text" name="fld_street_adress" id="fld_street_adress" value="{if $smarty.post.fld_street_adress}{$smarty.post.fld_street_adress|escape}{/if}" />
						</td>
						<td class="bill_must">*</td>
					</tr>
					<tr{if $error_arr.fld_phone} class="error_trg"{/if}>
						<th><label for="fld_phone">{"Phone:"|mytranslate}</label>{if $error_arr.fld_phone}<div class="bill_error">{$error_arr.fld_phone}</div>{/if}</th>
						<td>
							<input class="inp" type="text" name="fld_phone" id="fld_phone" value="{if $smarty.post.fld_phone}{$smarty.post.fld_phone|escape}{/if}" />
							<div class="bill_example_text">{"Format:"|mytranslate} 1(111)111-1111</div>
						</td>
						<td class="bill_must">*</td>
					</tr>
					<tr{if $error_arr.fld_email} class="error_trg"{/if}>
						<th><label for="fld_email">{"E-mail:"|mytranslate}</label>{if $error_arr.fld_email}<div class="bill_error">{$error_arr.fld_email}</div>{/if}</th>
						<td>
							<input class="inp" type="email" name="fld_email" id="fld_email" value="{if $smarty.post.fld_email}{$smarty.post.fld_email|escape}{/if}" />
						</td>
						<td class="bill_must">*</td>
					</tr>
					<tr{if $error_arr.fld_email2} class="error_trg"{/if}>
						<th><label for="fld_email2">{"Alternative E-mail:"|mytranslate}</label>{if $error_arr.fld_email2}<div class="bill_error">{$error_arr.fld_email2}</div>{/if}</th>
						<td>
							<input class="inp" type="email" name="fld_email2" id="fld_email2" value="{if $smarty.post.fld_email2}{$smarty.post.fld_email2|escape}{/if}" />
						</td>
						<td class="bill_must">&nbsp;</td>
					</tr>
				</table>
			</td>
			<td class="bill_pay_method">
				<div class="bill_tit">{"Payment information"|mytranslate}</div>
				<div class="bill_corner_box_t1">
					<div class="bill_corner_box_t1_1">
						<div class="bill_corner_box_t1_2">
							<div class="bill_corner_box_t1_3">
								<div class="bill_fix_padding bill_bot_line">
									<table class="bill_actual_list">
										<tr>
											{foreach item=v key=k from=$config_array.payments}
												<td>{if $v == 1 && $k != 'eCheck'}<span class="pill_pay_ico {$k}" title="{$k}"></span>{/if}</td>
											{/foreach}
										</tr>
									</table>
								</div>
								<div class="bill_fix_padding">
									<table class="bill_table_type2 first">
										<tr>
											<th>{"Payment method:"|mytranslate}</th>
											<td colspan="2">
												<div class="bill_pay_select">
													<input type="radio" value="fld_payment_type_credit_card" name="fld_payment_type" id="fld_payment_type_credit_card" {if !$smarty.post.fld_payment_type || $smarty.post.fld_payment_type == 'fld_payment_type_credit_card'} checked="checked" {/if} />
													<label for="fld_payment_type_credit_card">{"Credit Card"|mytranslate}</label>
													{if $config_array.payments.eCheck == 1}
														<input type="radio" value="fld_payment_type_eCheck" name="fld_payment_type" id="fld_payment_type_eCheck" {if $smarty.post.fld_payment_type == 'fld_payment_type_eCheck'} checked="checked" {/if} />
														<label for="fld_payment_type_eCheck">{"Online Check"|mytranslate}</label>
													{/if}
												</div>
											</td>
										</tr>
									</table>
									<div class="pay_bay_credit_card_box" id="pay_bay_credit_card_box">
										<div id="credit_card_helper"></div>
										<table class="bill_table_type2">
											<tr{if $error_arr.fld_credit_card_type} class="error_trg"{/if}>
												<th><label for="fld_credit_card_type">{"Credit card type:"|mytranslate}</label>{if $error_arr.fld_credit_card_type}<div class="bill_error">{$error_arr.fld_credit_card_type}</div>{/if}</th>
												<td colspan="2">
													<div>
														<select class="select" name="fld_credit_card_type" id="fld_credit_card_type">
															{foreach item=v key=k from=$config_array.payments}
															
																{if $v == 1 && $k != 'eCheck'}<option {if $k == $smarty.post.fld_credit_card_type} selected="selected" {/if} value="{$k}">{$k}</option>{/if}
															{/foreach}
														</select>
													</div>
												</td>
												<td class="bill_must">*</td>
											</tr>
											<tr{if $error_arr.fld_card_holder_name} class="error_trg"{/if}>
												<th><label for="fld_card_holder_name">{"Cardholder name:"|mytranslate}</label>{if $error_arr.fld_card_holder_name}<div class="bill_error">{$error_arr.fld_card_holder_name}</div>{/if}</th>
												<td colspan="2">
													<div><input class="inp" type="text" name="fld_card_holder_name" id="fld_card_holder_name" value="{if $smarty.post.fld_card_holder_name}{$smarty.post.fld_card_holder_name|escape}{/if}" /></div>
												</td>
												<td class="bill_must">*</td>
											</tr>
											<tr{if $error_arr.fld_last_name} class="error_trg"{/if}>
												<th><label for="fld_birth_year">{"Birth date:"|mytranslate}</label>{if $error_arr.fld_last_name}<div class="bill_error">{$error_arr.fld_birth_date}</div>{/if}</th>
												<td colspan="2">
													<select class="select" name="fld_birth_year" id="fld_birth_year" style="width:70px;">
														<option value="">{"Year"|mytranslate}</option>
														{section name=bar loop=$date_end step=1}
															{assign var=cur_year value=$date_now-$smarty.section.bar.index-18}
															<option {if $smarty.post.fld_birth_year|intval == $cur_year} selected="selected"{/if} value="{$cur_year}">{$cur_year}</option>
														{/section}
													</select>
													<select class="select" name="fld_birth_month" id="fld_birth_month" style="width:70px;">
														<option value="">{"Month"|mytranslate}</option>
														{section name=bar start=1 loop=13 max=13 step=1}
															{if $smarty.section.bar.index|@strlen == 1}
																{assign var=digit value='0'}
															{else}
																{assign var=digit value=''}
															{/if}
															<option {if $smarty.post.fld_birth_month|intval == $smarty.section.bar.index} selected="selected"{/if} value="{$digit}{$smarty.section.bar.index}">{$digit}{$smarty.section.bar.index}</option>
														{/section}
													</select>
													<select class="select" name="fld_birth_day" id="fld_birth_day" style="width:60px;">
														<option value="">{"Day"|mytranslate}</option>
														{section name=bar start=1 loop=32 max=32 step=1}
															{if $smarty.section.bar.index|@strlen == 1}
																{assign var=digit value='0'}
															{else}
																{assign var=digit value=''}
															{/if}
															<option value="{$digit}{$smarty.section.bar.index}" {if $smarty.post.fld_birth_day|intval == $smarty.section.bar.index} selected="selected"{/if}>{$digit}{$smarty.section.bar.index}</option>
														{/section}
													</select>
												</td>
												<td class="bill_must">*</td>
											</tr>
											<tr{if $error_arr.fld_credit_card_no} class="error_trg"{/if}>
												<th><label for="fld_credit_card_no">{"Credit card No:"|mytranslate}</label>{if $error_arr.fld_credit_card_no}<div class="bill_error">{$error_arr.fld_credit_card_no}</div>{/if}</th>
												<td colspan="2">
													<div><input class="inp" type="text" name="fld_credit_card_no" id="fld_credit_card_no" value="{if $smarty.post.fld_credit_card_no}{$smarty.post.fld_credit_card_no|escape}{/if}" /></div>
													<div class="bill_example_text">{"Example:"|mytranslate} 4444222244448888</div>
												</td>
												<td class="bill_must">*</td>
											</tr>
											<tr{if $error_arr.exp_date} class="error_trg"{/if}>
												<th>
													<label for="fld_exp_date_1">{"Expiration date:"|mytranslate}</label><div class="bill_error">{if $error_arr.exp_date}{$error_arr.exp_date}{/if}</div>
												</th>
												<td class="mob_flag1">
													
														<select class="select short" name="fld_exp_date_1" id="fld_exp_date_1">
															<option value="">{"month"|mytranslate}</option>
															{foreach item=v key=k from=$month_arr}
																<option {if $v == $smarty.post.fld_exp_date_1} selected="selected" {/if} value="{$v}">{$v}</option>
															{/foreach}
														</select>
													
												</td>
												<td class="mob_flag2">
													
														<select class="select short" name="fld_exp_date_2" id="fld_exp_date_2">
															<option value="">{"year"|mytranslate}</option>
															{foreach item=v key=k from=$years_arr}
																<option {if $v == $smarty.post.fld_exp_date_2} selected="selected" {/if} value="{$v}">{$v}</option>
															{/foreach}
														</select>
													
												</td>
												<td class="bill_must">*</td>
											</tr>
											<tr{if $error_arr.fld_cvc_cvv2} class="error_trg"{/if}>
												<th class="mob_flag3"><label for="fld_cvc_cvv2">CVC2/CVV2:</label>{if $error_arr.fld_cvc_cvv2}<div class="bill_error">{$error_arr.fld_cvc_cvv2}</div>{/if}</th>
												<td>
													<div style="float:left;">
														<input class="inp short" type="text" name="fld_cvc_cvv2" id="fld_cvc_cvv2" maxlength="4" value="{if $smarty.post.fld_cvc_cvv2}{$smarty.post.fld_cvc_cvv2|escape}{/if}" />
													</div>
													<div class="bill_must">&nbsp;*</div>
												</td>
												<td><div class="help"></div></td>
											</tr>
										</table>
									</div><!-- /pay_bay_credit_card_box -->
									<div class="pay_bay_credit_eChceck_box" id="pay_bay_credit_eChceck_box" style="display:none;">
										<div id="echeck_helper"></div>
										<table class="bill_table_type2">
											<tr{if $error_arr.fld_eCheck_client_name} class="error_trg"{/if}>
												<th><label for="fld_eCheck_name">{"Your Name:"|mytranslate}</label>{if $error_arr.fld_eCheck_client_name}<div class="bill_error">{$error_arr.fld_eCheck_client_name}</div>{/if}</th>
												<td colspan="2">
													<div><input class="inp" type="text" name="fld_eCheck_client_name" id="fld_eCheck_client_name" value="{if $smarty.post.fld_eCheck_client_name}{$smarty.post.fld_eCheck_client_name|escape}{/if}" /></div>
												</td>
												<td class="bill_must">*</td>
											</tr>
											<tr{if $error_arr.fld_eCheck_bank_name} class="error_trg"{/if}>
												<th><label for="fld_eCheck_bank_name">{"Bank Name:"|mytranslate}</label>{if $error_arr.fld_eCheck_bank_name}<div class="bill_error">{$error_arr.fld_eCheck_bank_name}</div>{/if}</th>
												<td colspan="2">
													<div><input class="inp" type="text" name="fld_eCheck_bank_name" id="fld_eCheck_bank_name" value="{if $smarty.post.fld_eCheck_bank_name}{$smarty.post.fld_eCheck_bank_name|escape}{/if}" /></div>
												</td>
												<td class="bill_must">*</td>
											</tr>
											
											<tr{if $error_arr.fld_eCheck_account_num} class="error_trg"{/if}>
												<th><label for="fld_eCheck_account_num">{"Account #:"|mytranslate}</label>{if $error_arr.fld_eCheck_account_num}<div class="bill_error">{$error_arr.fld_eCheck_account_num}</div>{/if}</th>
												<td colspan="2">
													<div><input class="inp" type="text" name="fld_eCheck_account_num" id="fld_eCheck_account_num" value="{if $smarty.post.fld_eCheck_account_num}{$smarty.post.fld_eCheck_account_num|escape}{/if}" /></div>
												</td>
												<td class="bill_must">*</td>
											</tr>
											<tr{if $error_arr.fld_eCheck_bank_routing_num} class="error_trg"{/if}>
												<th><label for="fld_eCheck_bank_routing_num">{"Bank Routing #:"|mytranslate}</label>{if $error_arr.fld_eCheck_bank_routing_num}<div class="bill_error">{$error_arr.fld_eCheck_bank_routing_num}</div>{/if}</th>
												<td colspan="2">
													<div><input class="inp" type="text" maxlength="9" name="fld_eCheck_bank_routing_num" id="fld_eCheck_bank_routing_num" value="{if $smarty.post.fld_eCheck_bank_routing_num}{$smarty.post.fld_eCheck_bank_routing_num|escape}{/if}" /></div>
												</td>
												<td class="bill_must">*</td>
											</tr>
											<tr{if $error_arr.fld_eCheck_check_num} class="error_trg"{/if}>
												<th><label for="fld_eCheck_check_num">{"Check Number #:"|mytranslate}</label>{if $error_arr.fld_eCheck_check_num}<div class="bill_error">{$error_arr.fld_eCheck_check_num}</div>{/if}</th>
												<td colspan="2">
													<div><input class="inp" type="text" name="fld_eCheck_check_num" maxlength="9" id="fld_eCheck_check_num" value="{if $smarty.post.fld_eCheck_check_num}{$smarty.post.fld_eCheck_check_num|escape}{/if}" /></div>
												</td>
												<td class="bill_must">*</td>
											</tr>
											<tr>
												<td colspan="4">
													<div class="signature_block">
														<div class="signature_text1">
															{"Please sign the check below using your mouse"|mytranslate}
															<i>{"Signature should be the same as you signed at your bank"|mytranslate}</i>
														</div>
														<div id="signature">
															<canvas class="pad" width="380" height="84" ></canvas>
															{if $error_arr.fld_eCheck_signature}<div class="bill_error">{$error_arr.fld_eCheck_signature}</div>{/if}
															<input type="hidden" name="signature" class="output" id="signatureHid" />
															<input type="hidden" name="submit" value="1" />
															<div class="clear"></div>
															<button class="clearSig clearButton sbmtX">{"Clear Signature"|mytranslate} </button>
															<label for="canNotCreateSig">
																{"Signature is required. If the signature field does not work, use another browser or upgrade it to the latest version."|mytranslate}
															</label>
														</div><!-- /#signature -->
														
													</div><!-- /signature_text1 -->
												</td>
											</tr>
										</table>
									</div><!-- /pay_bay_credit_eChceck_box -->
								</div><!-- /bill_fix_padding -->
							</div>
						</div>
					</div>
				</div><!-- /bill_corner_box_t1 -->
			</td>
		</tr>
	</table>
	<div class="bill_note_line">
		<span>{"Please note: fields starting with"|mytranslate} <span class="bill_must">*</span> {"are required to complete your order."|mytranslate}</span>
	</div>
	
	<div id="movie1" class="bill_tit">{"shipping address"|mytranslate}</div>
	<div id="movie2" class="bill_shipping_is_different">
		<input type="checkbox" value="1" {if $smarty.post.bill_shipping_is_different == 1} checked="checked" {/if} name="bill_shipping_is_different" id="bill_shipping_is_different" />
		<label for="bill_shipping_is_different">{"My shipping info Is not the same as my billing info"|mytranslate}</label>
		
		<div class="insurance">
			<label>
				{"Insurance"|mytranslate} <span>{$insurance_price_user}</span>{$currency_symbol}&nbsp;<input id="insurance_man" type="checkbox" value="1" checked="checked" name="insurance" />
			</label>
		</div>
		<div class="clear"></div>
	</div><!-- /bill_shipping_is_different -->
	<div id="movie3" class="bill_shipping_different_block">
		<table class="bill_adres_td shippng-td">
			<tr{if $error_arr.fld_first_name2} class="error_trg"{/if}>
				<th><label for="fld_first_name2">{"First Name:"|mytranslate}</label>{if $error_arr.fld_first_name2}<div class="bill_error">{$error_arr.fld_first_name2}</div>{/if}</th>
				<td>
					<input class="inp" type="text" name="fld_first_name2" id="fld_first_name2" value="{if $smarty.post.fld_first_name2}{$smarty.post.fld_first_name2|escape}{/if}" />
				</td>
				<td class="bill_must">*</td>
			</tr>
			<tr{if $error_arr.fld_last_name2} class="error_trg"{/if}>
				<th><label for="fld_last_name2">{"Last name:"|mytranslate}</label>{if $error_arr.fld_last_name2}<div class="bill_error">{$error_arr.fld_last_name2}</div>{/if}</th>
				<td>
					<input class="inp" type="text" name="fld_last_name2" id="fld_last_name2" value="{if $smarty.post.fld_last_name2}{$smarty.post.fld_last_name2|escape}{/if}" />
				</td>
				<td class="bill_must">*</td>
			</tr>
			<tr{if $error_arr.fld_country2} class="error_trg"{/if}>
				<th><label for="fld_country2">{"Country:"|mytranslate}</label>{if $error_arr.fld_country2}<div class="bill_error">{$error_arr.fld_country2}</div>{/if}</th>
				<td>
					<select class="select" name="fld_country2" id="fld_country2">
						{foreach item=v key=k from=$country_arr}
							<option {if $v.0 == $smarty.post.fld_country2 || ( !$smarty.post.fld_country && $v.0 == $country_code )} selected="selected" {/if} value="{$v.0}">{$v.1}</option>
						{/foreach}
					</select>
				</td>
				<td class="bill_must">*</td>
			</tr>
			<tr{if $error_arr.fld_state2} class="error_trg"{/if}>
				<th><label for="fld_state2">{"State / Province:"|mytranslate}</label>{if $error_arr.fld_state2}<div class="bill_error">{$error_arr.fld_state2}</div>{/if}</th>
				<td>
					<select class="select" name="fld_state2" id="fld_state2">
{foreach item=v key=k from=$state_arr}
{if $v.0|is_array}
<optgroup label="{$v.0.tit}" rel="{$v.0.key}">
{else}
<option {if
$v.0 == $smarty.post.fld_state2
||
!$smarty.post.fld_state2 && $v.0 == 'NONE' && (
$country_code != 'US'
&&
$country_code != 'CA'
&&
$country_code != 'AU'
)
||
(
!$smarty.post.fld_state2
&&
$k == 0
&&
(
$country_code == 'US'
||
$country_code == 'CA'
||
$country_code == 'AU'
)
)
} selected="selected" {/if} value="{$v.0}">{$v.1}</option>
{/if}
{/foreach}
						</optgroup>
					</select>
				</td>
				<td class="bill_must">*</td>
			</tr>
			<tr{if $error_arr.fld_zip_code2} class="error_trg"{/if}>
				<th><label for="fld_zip_code2">{"Zip or postal code:"|mytranslate}</label>{if $error_arr.fld_zip_code2}<div class="bill_error">{$error_arr.fld_zip_code2}</div>{/if}</th>
				<td>
					<input class="inp" type="text" name="fld_zip_code2" id="fld_zip_code2" value="{if $smarty.post.fld_zip_code2}{$smarty.post.fld_zip_code2|escape}{/if}" />
				</td>
				<td class="bill_must">*</td>
			</tr>
			<tr{if $error_arr.fld_city2} class="error_trg"{/if}>
				<th><label for="fld_city2">{"City:"|mytranslate}</label>{if $error_arr.fld_city2}<div class="bill_error">{$error_arr.fld_city2}</div>{/if}</th>
				<td>
					<input class="inp" type="text" name="fld_city2" id="fld_city2" value="{if $smarty.post.fld_city2}{$smarty.post.fld_city2|escape}{/if}" />
				</td>
				<td class="bill_must">*</td>
			</tr>
			<tr{if $error_arr.fld_street_adress2} class="error_trg"{/if}>
				<th><label for="fld_street_adress2">{"Street address:"|mytranslate}</label>{if $error_arr.fld_street_adress2}<div class="bill_error">{$error_arr.fld_street_adress2}</div>{/if}</th>
				<td>
					<input class="inp" type="text" name="fld_street_adress2" id="fld_street_adress2" value="{if $smarty.post.fld_street_adress2}{$smarty.post.fld_street_adress2|escape}{/if}" />
				</td>
				<td class="bill_must">*</td>
			</tr>
			
			
			
		</table>
	</div>
	
	<div class="clear"></div>
	<hr />
	<div class="clear"></div>
	<div class="btn_complete_box">
		<input type="submit" name="btn_complete" id="btn_complete" value="{"Next step"|mytranslate} &rarr;" />
	</div>
	<br />
	<div class="backToShop">
		<a href="{$smarty.post.back_link|escape}">&larr; {"Back to shop"|mytranslate}</a>
	</div>
	<br />
	<div class="clear"></div>
	<!--div class="debug_win">
		
	</div-->
	
</form>
<script src="{$template_root_path}/../global/billing/js/jquery.signaturepad.js"></script>
{literal}
<script>
	jQuery(window).load(function() {
		jQuery('#signature').signaturePad({
			displayOnly: false,
			drawOnly:true,
			bgColour:'#cdffbf',
			validateFields:false,
			lineTop:60,
			penWidth:1,
			penColour: '#020304',
			lineColour:'#fff',
			lineMargin:0
		});
	});
</script>
{/literal}

{include file="../global/billing/!footer_bill.tpl"}