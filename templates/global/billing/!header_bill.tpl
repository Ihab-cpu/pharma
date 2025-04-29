<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
    {include file="$template_root_path/../global/fb_pixel_inject.tpl"}
	<head>
	
		<title>{$title}</title>

		<meta name="viewport" content="width=device-width">

		<link rel="stylesheet" href="{$template_root_path}/../global/billing/css/style_bill.css" type="text/css" />
		<link rel="stylesheet" href="{$template_root_path}/../global/billing/css/media.css" type="text/css" />
		<link rel="icon" href="/favicon_order.ico" type="image/x-icon" />
		<script src="{$template_root_path}/../global/billing/js/jquery-1.6.4.min.js" type="text/javascript"></script>
		
		<!--script src="/json.js" type="text/javascript"></script-->
		<script src="{$template_root_path}/../global/billing/js/json2.js" type="text/javascript"></script>
		
		<script type="text/javascript">
			var ajax_path = '{$BASE_FOLDER}ajax/';
			var session_id = '{$session_id}';
			var search_title = '{"Search product"|mytranslate}';
			var search_empty_message = '{"Error. Empty Search product!"|mytranslate}';
			var date_year = '{$date_year}';
			var date_month = '{$date_month}';
			var insurance_price = '{$insurance_price}';
			var insurance_price_user = '{$insurance_price_user}';
			var var_date_y = "{'Y'|date}";
			var var_date_y_l = '{$year_license}';
		</script>
		{if $showuscounter}
		{/if}
		<script type="text/javascript" src="{$template_root_path}/../global/billing/js/js_bill.js"></script>
		<script type="text/javascript" src="{$template_root_path}/../global/billing/js/js_form_validator_bill.js"></script>
	</head>
	<body class="mobile {$step} lang-{$lang}">
		<div id="main">
			<div id="ajax_preloader"></div>
			<!-- language change -->
			<!--form id="billing-lang" action="?language=" method="post">
				<input type="hidden" value="{$serpost}" />
				<select name="language">
					<option value="en" {if $lang == 'en'} selected="selected" {/if}>English</option>
                    <option value="de" {if $lang == 'de'} selected="selected" {/if}>Dutch</option>
                    <option value="fr" {if $lang == 'fr'} selected="selected" {/if}>Franch</option>
                    <option value="it" {if $lang == 'it'} selected="selected" {/if}>Italian</option>
                    <option value="es" {if $lang == 'es'} selected="selected" {/if}>Spanish</option>
				</select>
			</form-->
			<table id="warper">
				<tr>
					
					<td id="main_cell">
						<div class="content" id="content">
							<div class="h1">{"$name"|mytranslate}</div>