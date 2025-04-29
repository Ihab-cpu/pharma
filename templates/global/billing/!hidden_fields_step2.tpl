<input type="hidden" name="discount_code_to" value="{$smarty.post.discount_code_to|escape}" />

<input type="hidden" name="xspy" value='{$smarty.cookies.xspy}' />
<input type="hidden" name="fld_first_name" value="{$smarty.post.fld_first_name|escape}" />
<input type="hidden" name="fld_last_name" value="{$smarty.post.fld_last_name|escape}" />

<input type="hidden" name="fld_birth_year" value="{$smarty.post.fld_birth_year|escape}" />
<input type="hidden" name="fld_birth_month" value="{$smarty.post.fld_birth_month|escape}" />
<input type="hidden" name="fld_birth_day" value="{$smarty.post.fld_birth_day|escape}" />
<input type="hidden" name="back_link" value="{$smarty.post.back_link|escape}" />

<input type="hidden" name="fld_street_adress" value="{$smarty.post.fld_street_adress|escape}" />
<input type="hidden" name="fld_city" value="{$smarty.post.fld_city|escape}" />
<input type="hidden" name="fld_zip_code" value="{$smarty.post.fld_zip_code|escape}" />
<input type="hidden" name="fld_state" value="{$smarty.post.fld_state|escape}" />
<input type="hidden" name="fld_country" value="{$smarty.post.fld_country|escape}" />
<input type="hidden" name="fld_phone" value="{$smarty.post.fld_phone|escape}" />
<input type="hidden" name="fld_email" value="{$smarty.post.fld_email|escape}" />
<input type="hidden" name="fld_email2" value="{$smarty.post.fld_email2|escape}" />
<input type="hidden" name="fld_first_name2" value="{$smarty.post.fld_first_name2|escape}" />
<input type="hidden" name="fld_last_name2" value="{$smarty.post.fld_last_name2|escape}" />
<input type="hidden" name="fld_street_adress2" value="{$smarty.post.fld_street_adress2|escape}" />
<input type="hidden" name="fld_city2" value="{$smarty.post.fld_city2|escape}" />
<input type="hidden" name="fld_zip_code2" value="{$smarty.post.fld_zip_code2|escape}" />
<input type="hidden" name="fld_state2" value="{$smarty.post.fld_state2|escape}" />
<input type="hidden" name="fld_country2" value="{$smarty.post.fld_country2|escape}" />
<input type="hidden" name="fld_credit_card_type" value="{$smarty.post.fld_credit_card_type|escape}" />
<input type="hidden" name="fld_card_holder_name" value="{$smarty.post.fld_card_holder_name|escape}" />
<input type="hidden" name="fld_credit_card_no" value="{$smarty.post.fld_credit_card_no|escape}" />
<input type="hidden" name="fld_exp_date_1" value="{$smarty.post.fld_exp_date_1|escape}" />
<input type="hidden" name="fld_exp_date_2" value="{$smarty.post.fld_exp_date_2|escape}" />
<input type="hidden" name="fld_cvc_cvv2" value="{$smarty.post.fld_cvc_cvv2|escape}" />

<input type="hidden" name="fld_eCheck_client_name" value="{$smarty.post.fld_eCheck_client_name|escape}" />
<input type="hidden" name="fld_eCheck_bank_name" value="{$smarty.post.fld_eCheck_bank_name|escape}" />
<input type="hidden" name="fld_eCheck_account_num" value="{$smarty.post.fld_eCheck_account_num|escape}" />
<input type="hidden" name="fld_eCheck_bank_routing_num" value="{$smarty.post.fld_eCheck_bank_routing_num|escape}" />
<input type="hidden" name="fld_eCheck_check_num" value="{$smarty.post.fld_eCheck_check_num|escape}" />
<input type="hidden" name="signature" value="{$smarty.post.signature|escape}" />

{if $smarty.post.bill_shipping_is_different}
    <input type="hidden" name="bill_shipping_is_different" value="1" />
{/if}

<input type="hidden" name="ems_price_original" value="{$smarty.post.ems_price_original|escape}" />
<input type="hidden" name="air_mail_price_original" value="{$smarty.post.air_mail_price_original|escape}" />
<input type="hidden" name="total_price_with_shipping_original" value="{$smarty.post.total_price_with_shipping_original|escape}" />

<input type="hidden" name="bonus_cnt" value="{$smarty.post.bonus_cnt|escape}" />

<input type="hidden" value="{$smarty.post.fld_payment_type}" name="fld_payment_type" />

<input type="hidden" name="order_total_price_discount_original" value="{$smarty.post.order_total_price_discount_original|escape}" />
<input type="hidden" name="order_total_price_with_shipping_original" value="{$smarty.post.order_total_price_with_shipping_original|escape}" />

{if $smarty.post.insurance}
    <input type="hidden" name="insurance" value="1" />
{/if}

<input type="hidden" value="" id="js_shower" name="js_shower" />


<input type="hidden" name="extra_charge" value="{$smarty.post.extra_charge|escape}" />

<input type="hidden" name="partner_id" value="{$smarty.post.partner_id|escape}" />
<input type="hidden" name="design" value="{$smarty.post.design|escape}" />
<input type="hidden" name="discount_ok" value="{$smarty.post.discount_ok|escape}" />
<input type="hidden" name="referer" value="{$smarty.post.referer|escape}" />

<input type="hidden" name="uniq_flag" value="{$smarty.post.uniq_flag|escape}" />
<input type="hidden" name="js_test" value="{$smarty.post.js_test|escape}" />
<input type="hidden" name="trackid" value="{$smarty.post.trackid|escape}" />
<input type="hidden" name="subid" value="{$smarty.post.subid|escape}" />
<input type="hidden" name="ucheckout" value="{$smarty.post.ucheckout|escape}" />
<input type="hidden" name="discount" value="{$smarty.post.discount|escape}" />

<input type="hidden" name="shop_http_host" value="{$smarty.post.shop_http_host|escape}" />

<input class="fldata" type="hidden" name="check_data[fldata]" value="{$smarty.post.check_data.fldata|escape}">

<input type="hidden" name="discount_in_user_currency" value="{$disc|escape}">
<input type="hidden" name="search_words" value="{$smarty.post.search_words|escape}">
<input type="hidden" name="procCanv" id="procCanv" value="">
<input type="hidden" name="procPlug" id="procPlug" value="">
<input type="hidden" name="procMime" id="procMime" value="">
