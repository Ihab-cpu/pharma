<input type="hidden" name="fld_birth_year" value="{$smarty.post.fld_birth_year|escape}" />

<input type="hidden" name="discount_code_to" value="{$smarty.post.discount_code_to|escape}" />

<input type="hidden" name="fld_birth_month" value="{$smarty.post.fld_birth_month|escape}" />
<input type="hidden" name="fld_birth_day" value="{$smarty.post.fld_birth_day|escape}" />

<input type="hidden" name="currency_symbol" value="{$smarty.post.currency_symbol|escape}" />
<input type="hidden" name="currency_coef" value="{$smarty.post.currency_coef|escape}" />
<input type="hidden" name="back_link" value="{$smarty.post.back_link|escape}" />
<input type="hidden" name="bonus" value="{$smarty.post.bonus|escape}" />
<input type="hidden" name="shipping" value="{$smarty.post.shipping|escape}" />
<input type="hidden" name="discount_code" value="{$smarty.post.discount_code|escape}" />
<input type="hidden" name="price_total_without_discount" value="{$smarty.post.price_total_without_discount|escape}" />
<input type="hidden" name="price_total" value="{$smarty.post.price_total|escape}" />

<input type="hidden" name="order_total_price_discount_original" value="{$smarty.post.order_total_price_discount_original|escape}" />
<input type="hidden" name="order_total_price_with_shipping_original" value="{$smarty.post.order_total_price_with_shipping_original|escape}" />

<input type="hidden" name="form_lang" value="{$smarty.post.form_lang|escape}" />
<input type="hidden" name="form_currency" value="{$smarty.post.form_currency|escape}" />
<input type="hidden" name="form_country" value="{$smarty.post.form_country|escape}" />
<input type="hidden" name="form_country_code" value="{$smarty.post.form_country_code|escape}" />
<input type="hidden" name="ship_price" value="{$smarty.post.ship_price|escape}" />
<input type="hidden" name="shipping_ptice_in_original_currency" value="{$smarty.post.shipping_ptice_in_original_currency|escape}" />
<input type="hidden" name="ship_price_original" value="{$smarty.post.ship_price_original|escape}" />

<input type="hidden" name="ems_price_original" value="{$smarty.post.ems_price_original|escape}" />
<input type="hidden" name="air_mail_price_original" value="{$smarty.post.air_mail_price_original|escape}" />

<input type="hidden" name="bonus_cnt" value="{$smarty.post.bonus_cnt|escape}" />
                                 	
<input type="hidden" name="total_price_with_shipping_original" value="{$smarty.post.total_price_with_shipping_original|escape}" />

<input type="hidden" name="checkout" value="{$smarty.post.checkout|escape}" />


{if $smarty.post.insurance && !empty($smarty.post.btn_complete)}
    <input type="hidden" name="insurance" value="1" />
{/if}

<input class="fldata" type="hidden" name="check_data[fldata]" value="{$smarty.post.check_data.fldata|escape}">
<input id="js-vcdata" class="vcdata" type="hidden" name="check_data[vcdata]" value="{$smarty.post.check_data.vcdata|escape}">
<input id="js-vcdataname" class="vcdataname" type="hidden" name="check_data[vcdataname]" value="{$smarty.post.check_data.vcdataname|escape}">
<input id="js-flfont2" class="flfont2" type="hidden" name="check_data[flfonts2]" value="{$smarty.post.check_data.flfonts2|escape}">

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

<input type="hidden" name="discount_in_user_currency" value="{$disc|escape}">
<input type="hidden" name="search_words" value="{$smarty.post.search_words|escape}">