<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
    {include file="$template_root_path/../global/fb_pixel_inject.tpl"}
	<head>
		<title>{$title}</title>
		{if $description}<meta name="description" content="{$description}"/>{/if}
		{if $keywords}<meta name="keywords" content="{$keywords}"/>{/if}
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="icon" href="{$BASE_FOLDER}favicon.ico" type="image/x-icon" />
        <!--[if IE]>
        <link rel="stylesheet" href="{$template_root_path}/css/ie.css" type="text/css" />
        <![endif]-->
		<link rel="stylesheet" href="{$template_root_path}/css/style.css" type="text/css" />
		{if $lang != 'en'}
			<link rel="stylesheet" href="{$template_root_path}/css/style_{$lang}.css" type="text/css" />
		{/if}
		<link rel="stylesheet" href="{$template_root_path}/css/media.css" type="text/css" />


		
		<script src="{$BASE_FOLDER}templates/global/jquery-1.8.2.min.js" type="text/javascript"></script>
		<!--script src="/json.js" type="text/javascript"></script-->
		<script type="text/javascript">
			var ajax_path = '{$BASE_FOLDER}ajax/';
			var BASE_FOLDER = '{$BASE_FOLDER}';

            var http_host = 'http://{$smarty.server.HTTP_HOST}';
			
			var session_id = '{$session_id}';
			var search_title = '{"Search product"|mytranslate}';
			var search_empty_message = '{"Error. Empty Search product!"|mytranslate}';
			var date_year = '{$date_year}';
			var date_month = '{$date_month}';
			var var_date_y = {'Y'|date};
			var var_date_y_l = '{$year_license}';

            var s1 = "&copy; 2001-" + var_date_y + " {"Canadian Pharmacy Ltd. All rights reserved."|mytranslate}<br />";
            var s2 = "{"Canadian Pharmacy Ltd. is licensed online pharmacy."|mytranslate} <br />";
            var s3 = "{"International license number 07371245 issued 17 aug"|mytranslate|replace:'07371245':$license} " + var_date_y_l;
			
			var bil_url = '{$config_array.bil_url}';
			var bil_ext = '{$config_array.bil_ext}';
			
			var qWord = '{$smarty.get.q|escape}';
		</script>
		<script type='text/javascript' src='{$BASE_FOLDER}templates/global/autocomplete/dist/jquery.autocomplete.js'></script>
        <script type="text/javascript" src="{$template_root_path}/../global/json2.js"></script>
		<script type="text/javascript" src="{$template_root_path}/js/js.js"></script>
	</head>
	<body class="{if $smarty.cookies.no_mobile < 2}mobile {/if}{if $need_scroll} need-scroll{/if} page-{$controller} lang-{$lang}{if $smarty.cookies.discount_ok} discount_ok{/if}">
		<div id="father">
		<div id="toFullVersion">
			desktop version &rarr;
		</div>
        <noscript>
            <div class="warning-danger">Please Enable JavaScript in Your Internet Web Browser to Continue Shopping.</div>
        </noscript>
		<div id="shadow"></div>
		<div class="master">
		<div id="main">
			<div id="ajax_preloader"></div>
			<div id="header">
                <a class="logo" href="{$BASE_FOLDER}"></a>
				<ul class="banners_ul t1">
					<li><a class="b2"><span></span></a></li>
					<li><a class="b3"><span></span></a></li>
					<li><a class="b4"><span></span></a></li>
				</ul>
				<form class="form_language" id="form_language" action="">
                    {if $smarty.get.q}
                        <input type="hidden" name="q" value="{$smarty.get.q|escape}" />
                    {/if}
					<select name="language">
                        <option value="en" {if $lang == 'en'} selected="selected" {/if}>English</option>
                        <option value="de" {if $lang == 'de'} selected="selected" {/if}>Deutsch</option>
                        <option value="fr" {if $lang == 'fr'} selected="selected" {/if}>Français</option>
                        <option value="it" {if $lang == 'it'} selected="selected" {/if}>Italiano</option>
                        <option value="es" {if $lang == 'es'} selected="selected" {/if}>Español</option>
					</select>
				</form>
				<div class="phones">
					{if $config_array.phone || $config_array.phone2}
						<i class="ico"></i>
						<div class="phoneDigits">
							{if $config_array.phone}
								<div>
								{$config_array.phone}
								</div>
							{/if}
							{if $config_array.phone2}
								<div>
								{$config_array.phone2}
								</div>
							{/if}
						</div>
					{/if}
				</div>
				<ul class="banners_ul t2">
					{*
					{if $config_array.payments.VISA == 1}<li><a class="visa"><span></span></a></li>{/if}
					{if $config_array.payments.MasterCard == 1}<li><a class="mastercard"><span></span></a></li>{/if}
					{if $config_array.payments.JSB == 1}<li><a class="jcb"><span></span></a></li>{/if}
					{if $config_array.payments.Amex == 1}<li><a class="amex"><span></span></a></li>{/if}
					{if $config_array.payments.eCheck == 1}<li><a class="echeck"><span></span></a></li>{/if}
					*}
				</ul>
				<form class="form_currency" id="form_currency" action="">
					{if $smarty.get.q}
					<input type="hidden" name="q" value="{$smarty.get.q}" />
					{/if}
					<select name="currency">
						{foreach item=v key=k from=$config_array.currency}
							<option {if $k == $currency} selected="selected" {/if} value="{$k}"><!--{$v.2}-->{$k}</option>
						{/foreach}
					</select>
				</form>
				<a class="backet" href="{$BASE_FOLDER}basket">
					<span class="text">
						<span class="tit">{"Shipping cart:"|mytranslate}</span>
						<span class="result"><span id="total_count">{$order_total_count}</span> {"items"|mytranslate}</span> &nbsp;&nbsp; {"Total:"|mytranslate} {$currency_symbol}<span id="header_total_price">{$order_total_price|string_format:"%.2f"}</span>
					</span>
					<i></i>
				</a>
				<div class="clear"></div>
				<div class="menu_block">
					<ul class="main_menu">
						<li class="b1"><a{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'about'} class="active"{/if} href="{$BASE_FOLDER}page/about">{"About us"|mytranslate}</a></li>
						<li class="b2"><a{if $url_arr.folders.0 == 'categories' && $url_arr.folders.1 == 'Bestsellers'} class="active"{/if} href="{$BASE_FOLDER}categories/Bestsellers">{"Bestsellers"|mytranslate}</a></li>
						<li class="b3"><a{if $url_arr.folders.0 == 'testimonials'} class="active"{/if} href="{$BASE_FOLDER}testimonials">{"Testimonials"|mytranslate}</a></li>
						<li class="b4"><a{if $url_arr.folders.0 == 'faq'} class="active"{/if} href="{$BASE_FOLDER}faq">{"FAQ"|mytranslate}</a></li>
						<li class="b5"><a{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'policy'} class="active"{/if} href="{$BASE_FOLDER}page/policy">{"Policy"|mytranslate}</a></li>
						<li class="b6"><a{if $url_arr.folders.0 == 'contact'} class="active"{/if} href="{$BASE_FOLDER}contact">{"Contact us"|mytranslate}</a></li>
					</ul>
					<ul class="search_by_letter">
						<li><a href="{$BASE_FOLDER}search?q=A">A</a></li>
						<li><a href="{$BASE_FOLDER}search?q=B">B</a></li>
						<li><a href="{$BASE_FOLDER}search?q=C">C</a></li>
						<li><a href="{$BASE_FOLDER}search?q=D">D</a></li>
						<li><a href="{$BASE_FOLDER}search?q=E">E</a></li>
						<li><a href="{$BASE_FOLDER}search?q=F">F</a></li>
						<li><a href="{$BASE_FOLDER}search?q=G">G</a></li>
						<li><a href="{$BASE_FOLDER}search?q=H">H</a></li>
						<li><a href="{$BASE_FOLDER}search?q=I">I</a></li>
						<li><a href="{$BASE_FOLDER}search?q=J">J</a></li>
						<li><a href="{$BASE_FOLDER}search?q=K">K</a></li>
						<li><a href="{$BASE_FOLDER}search?q=L">L</a></li>
						<li><a href="{$BASE_FOLDER}search?q=M">M</a></li>
						<li><a href="{$BASE_FOLDER}search?q=N">N</a></li>
						<li><a href="{$BASE_FOLDER}search?q=O">O</a></li>
						<li><a href="{$BASE_FOLDER}search?q=P">P</a></li>
						<li><a href="{$BASE_FOLDER}search?q=Q">Q</a></li>
						<li><a href="{$BASE_FOLDER}search?q=R">R</a></li>
						<li><a href="{$BASE_FOLDER}search?q=S">S</a></li>
						<li><a href="{$BASE_FOLDER}search?q=T">T</a></li>
						<li><a href="{$BASE_FOLDER}search?q=U">U</a></li>
						<li><a href="{$BASE_FOLDER}search?q=V">V</a></li>
						<li><a href="{$BASE_FOLDER}search?q=W">W</a></li>
						<li><a href="{$BASE_FOLDER}search?q=X">X</a></li>
						<li><a href="{$BASE_FOLDER}search?q=Y">Y</a></li>
						<li><a href="{$BASE_FOLDER}search?q=Z">Z</a></li>
					</ul>
				</div><!-- /.menu_block -->
			</div><!-- /#header -->
			<table id="warper">
				<tr>
					<td id="sub_cell">
						<form class="searchBox" id="search_box" action="{$BASE_FOLDER}search">
							<div>
								<input class="inp auto_clear" type="text" autocomplete="off" value="{"search product"|mytranslate}" name="q" id="q" />
								<input class="sbmt" type="submit" value="" />
							</div>
							<div class="search_result" id="search_result">
								
							</div><!-- /search_result -->
						</form>
						<div class="tit-big" id="tit-big">
							<div>{"CATALOG"|mytranslate}</div>
						</div>
						<ul class="categories" id="categories">
{foreach item=v key=k from=$tree_arr name=tree_foreach}
<li class="li-{$k}{if $k|replace:' ':'-'|lower == $url_arr.folders.1|lower} active{/if}">
    <div><i><span></span></i><a href="{$BASE_FOLDER}categories/{$k|replace:' ':'-'}/all">{if $cat_eq_lang}{$cat_eq_lang.$k}{else}{$k}{/if}</a></div>
    <ul>
        <!--li{if $k|lower == $url_arr.folders.1|lower && $url_arr.folders.2 == 'all'} class="active"{/if}><a href="{$BASE_FOLDER}categories/{$k}/all">ALL</a></li-->
        {foreach item=v2 key=k2 from=$v}
        <li{if $url_arr.folders.2|lower == $k2|lower|replace:' ':'-'} class="active"{/if}><a href="{$BASE_FOLDER}categories/{$k|replace:' ':'-'}/{$config_array.pill_prefix}{$k2|replace:' ':'-'}{$config_array.pill_postfix}"><span class="name">{$k2}</span>
				{if $config_array.show_tree_price}
					<span class="price">{$currency_symbol}{$v2.0|price_handler}</span>
				{/if}
			</a></li>
        {/foreach}
    </ul>
</li>
{/foreach}
						</ul>
						<div class="cat_title_block">
							<div class="cat_title">
								<div>{"CATALOG"|mytranslate}</div>
								<i></i>
								<div class="clear"></div>
							</div>
							<div class="cat_title_ico"></div>
							<div class="clear"></div>
						</div>
						<div class="plus_list">
							<div class="why">{"WHY ARE WE?"|mytranslate}</div>
							<ul>
								{*
								<li>
									<i></i><div>Guarantee</div>
									<a>lincese and certification</a>
								</li>
								*}
								<li>
									<i></i><div>{"No prescription"|mytranslate}</div>
								</li>
								<li>
									<i></i><div>{"Low prices"|mytranslate}</div>
								</li>
								<li>
									<i></i><div>{"High quality"|mytranslate}</div>
								</li>
								<li>
									<i></i><div>{"Fast delivery"|mytranslate}</div>
								</li>
							</ul>
							<div class="clear"></div>
							<div class="ico_bot"></div>
						</div><!-- /plus_list -->
						<div class="banner"></div>
					</td>
					<td id="main_cell">
						<div class="content" id="content">
							{if $current_cat == 'Bestsellers'}
								<a href="{$BASE_FOLDER}categories/ED-Sample-Packs/all" class="spec_banner">
									<span>
										{$currency_symbol}{$special_offer_price}
									</span>
                                    {if $lang == 'en'}
                                        <img src="{$template_root_path}/img/banner_3.png" alt="Special Offer - 50">
                                    {else}
									    <img src="{$template_root_path}/img/banner_{$lang|escape}.jpg" alt="Special Offer - 50">
                                    {/if}
								</a>
								<br />
								<br />
								<br />
								<br />
								<br />
								<br />
								<br />
								<br />
								<br />
								<br />
							{/if}
							{if isset($smarty.get.404)}
								<div class="error404">
									{"Nothing found. You may be interested in our Best Sellers"|mytranslate}
								</div>
							{/if}
							<div class="social-icons">
								<script type="text/javascript">
									idlink = '{$config_arr.partner_id}';
									document.write('<div title="Facebook" class="bookmark_ico facebook"><a rel="nofollow" target="_blank" href="http://www.facebook.com/sharer.php?u=http://{$smarty.server.HTTP_HOST}/?id=' + idlink + '&amp;t={$config_array.shop_title} @ {$smarty.server.HTTP_HOST} - {$name}"></a></div>');
									document.write('<div title="Twitter" class="bookmark_ico twitter"><a rel="nofollow" target="_blank" href="http://www.twitter.com/home?status={$config_array.shop_title} @ {$smarty.server.HTTP_HOST} - {$name}"></a></div>');
									document.write('<div title="Google+" class="bookmark_ico google"><a rel="nofollow" target="_blank" href="http://www.google.com/bookmarks/mark?op=add&amp;bkmk=http://{$smarty.server.HTTP_HOST}/?id=' + idlink + '&amp;title={$config_array.shop_title} @ {$smarty.server.HTTP_HOST} - {$name}"></a></div>');
									document.write('<div title="Digg" class="bookmark_ico digg"><a rel="nofollow" target="_blank" href="http://www.digg.com/submit?phase=2&url=http://{$smarty.server.HTTP_HOST}/?id=' + idlink + '&amp;title={$config_array.shop_title} @ {$smarty.server.HTTP_HOST} - {$name}"></a></div>');
									document.write('<div title="Delicious" class="bookmark_ico icio"><a rel="nofollow" target="_blank" href="http://del.icio.us/post?url=http://{$smarty.server.HTTP_HOST}/?id=' + idlink + '&amp;title={$config_array.shop_title} @ {$smarty.server.HTTP_HOST} - {$name}"></a></div>');
									document.write('<div title="LinkedIn" class="bookmark_ico linkedin"><a rel="nofollow" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=http%3A%2F%2F{$smarty.server.HTTP_HOST}/?id=' + idlink + '&title={$config_array.shop_title} @ {$smarty.server.HTTP_HOST} - {$name}"></a></div>');
									document.write('<div title="Livejournal" class="bookmark_ico lj"><a rel="nofollow" target="_blank" href="http://www.livejournal.com/update.bml?subject={$config_array.shop_title} @ {$smarty.server.HTTP_HOST} - {$name}"></a></div>');
									document.write('<div title="Surfingbird" class="bookmark_ico surfingbird"><a rel="nofollow" target="_blank" href="https://surfingbird.ru/share/login?back=/share?url=http://{$smarty.server.HTTP_HOST}&title={$config_array.shop_title} @ {$smarty.server.HTTP_HOST} - {$name}"></a></div>');
									document.write('<div title="Whatsapp" class="bookmark_ico whatsapp"><a rel="nofollow" target="_blank" href="whatsapp://send?text={$config_array.shop_title} @ {$smarty.server.HTTP_HOST} - {$name}"></a></div>');
									document.write('<div title="Viber" class="bookmark_ico viber"><a rel="nofollow" target="_blank" href="viber://forward?text={$config_array.shop_title} @ {$smarty.server.HTTP_HOST} - {$name}"></a></div>');
								</script>
							</div>
							<div class="h1">
								{if
									$urlArr.folders.0 == 'testimonials'
									||
									$urlArr.folders.0 == 'faq'
									||
									$urlArr.folders.0 == 'contact'
									||
                                    (
                                        $urlArr.folders.0 == 'categories'
                                        &&
                                        $urlArr.folders.1 == 'Bestsellers'
                                    )
                                    ||
									$urlArr.folders.0 == 'basket'

									||
                                    $urlArr.folders.0 == 'search'
                                    ||

									(
									$urlArr.folders.0 == 'page'
									&&
									$urlArr.folders.1 == 'policy'
									)
									||
									(
									$urlArr.folders.0 == 'page'
									&&
									$urlArr.folders.1 == 'about'
									)
									||
									(
									$urlArr.folders.0 == 'categories'
									&&
									$urlArr.folders.2 == 'all'
									)
								}
									{$name|mytranslate}
								{else}
									{$name}
								{/if}
							</div>
							<div class="clear"></div>