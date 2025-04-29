<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
    {include file="/global/fb_pixel_inject.tpl"}
	<head>
		<title>{$title}</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">

		{if $description}<meta name="description" content="{$description}"/>{/if}
		{if $keywords}<meta name="keywords" content="{$keywords}"/>{/if}
		<link rel="stylesheet" href="{$template_root_path}/css/reset.css" type="text/css" />
		<link rel="stylesheet" href="{$template_root_path}/css/style.css" type="text/css" />
		<link rel="stylesheet" href="{$template_root_path}/css/media.css" type="text/css" />
        <!--[if IE]>
        <link rel="stylesheet" href="{$template_root_path}/css/ie.css" type="text/css" />
        <![endif]-->
		{if $lang != 'en'}
			<link rel="stylesheet" href="{$template_root_path}/css/style_{$lang}.css" type="text/css" />
		{/if}
		<script src="{$template_root_path}/js/jquery-1.8.2.min.js" type="text/javascript"></script>
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
			
			var bil_url = '{$config_array.bil_url}';
			var bil_ext = '{$config_array.bil_ext}';
			
			var s1 = "&copy; 2001-" + var_date_y + " {"Canadian Pharmacy Ltd. All rights reserved."|mytranslate}<br />";
			var s2 = "{"Canadian Pharmacy Ltd. is licensed online pharmacy."|mytranslate} <br />";
			var s3 = "{"International license number 07371245 issued 17 aug"|mytranslate|replace:'07371245':$license} " + var_date_y_l;
			
			var qWord = '{$smarty.get.q|escape}';
		</script>
		<script type='text/javascript' src='{$BASE_FOLDER}templates/global/autocomplete/dist/jquery.autocomplete.js'></script>
        <script type="text/javascript" src="{$template_root_path}/../global/json2.js"></script>
		<script type="text/javascript" src="{$template_root_path}/js/js.js"></script>
	</head>
	<body class="{if $smarty.cookies.no_mobile < 2}mobile{/if}{if $need_scroll} need-scroll{/if} page-{$controller} lang-{$lang}{if $smarty.cookies.discount_ok} discount_ok{/if}">
		<div id="toFullVersion">
			desktop version &rarr;
		</div>
        <noscript>
            <div class="warning-danger">Please Enable JavaScript in Your Internet Web Browser to Continue Shopping.</div>
        </noscript>
		<div id="ajax_preloader"></div>
		<div class="l1">
			<div class="l2">
				<div class="master">
					<div class="header">
						<a class="logo" href="{$BASE_FOLDER}"><img src="{$template_root_path}/img/logo{if $lang != 'en'}_{$lang|escape}{/if}.gif" width="268" height="69" alt=""></a>
						<div class="phones">
							{if $config_array.phone || $config_array.phone}
								<div class="phoneDigits">
									{if $config_array.phone}
										<span>
									{$config_array.phone}
							</span>
									{/if}
									{if $config_array.phone2}
										<span>
								<div class="clear"></div>
											{$config_array.phone2}
							</span>
									{/if}
								</div>

							{/if}
						</div>
						<div class="lang-and-currency">
							<div class="tit tit-blue">{"Language"|mytranslate} & {"Currency"|mytranslate}</div>
							<form action="" method="get" id="change_language">
                                {if $smarty.get.q}
                                    <input type="hidden" name="q" value="{$smarty.get.q|escape}" />
                                {/if}
								<select name="language" id="language">
                                    <option value="en" {if $lang == 'en'} selected="selected" {/if}>English</option>
                                    <option value="de" {if $lang == 'de'} selected="selected" {/if}>Deutsch</option>
                                    <option value="fr" {if $lang == 'fr'} selected="selected" {/if}>Français</option>
                                    <option value="it" {if $lang == 'it'} selected="selected" {/if}>Italiano</option>
                                    <option value="es" {if $lang == 'es'} selected="selected" {/if}>Español</option>
								</select>
							</form>
							<form class="currency" action="" id="form_currency">
								{if $smarty.get.q}
									<input type="hidden" id="q_hidden" name="q" value="{$smarty.get.q}" />
								{/if}
								<select name="currency">
									{foreach item=v key=k from=$config_array.currency}
										<option {if $k == $currency} selected="selected" {/if} value="{$k}"><!--{$v.2}-->{$k}</option>
									{/foreach}
								</select>
							</form>
						</div>
						<a class="shopping-cart" href="{$BASE_FOLDER}basket">
							<span class="tit tit-blue">{"Shipping cart:"|mytranslate}</span>
							<i><span id="total_count">{$order_total_count}</span> {"items"|mytranslate}</i> <span class="total">{$currency_symbol}<span id="header_total_price">{$order_total_price|string_format:"%.2f"}</span></span>
						</a>
						<div class="best-sides">
							<div class="e">
								<i class="i1"></i>

								<div class="tit tit-green">{"Free Shipping"|mytranslate}</div>
								{"on all orders above"|mytranslate} $200
							</div>
							<div class="e">
								<i class="i2"></i>

								<div class="tit tit-green">{"Free Pills"|mytranslate}</div>
								{"with every order"|mytranslate}
							</div>
							<div class="e">
								<i class="i3"></i>

								<div class="tit tit-green">1,000,000 {"customers"|mytranslate}</div>
								{"quality, privacy, secure"|mytranslate}
							</div>
							<div class="e">
								<i class="i4"></i>

								<div class="tit tit-green">{"Low Prices"|mytranslate}</div>
								{"best price on the web"|mytranslate}
							</div>
							<div class="clear"></div>
						</div>
						<ul class="main-menu">
							<li class="b1"><a{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'about'} class="active"{/if} href="{$BASE_FOLDER}page/about">{"About us"|mytranslate}</a></li>
							<li class="b2"><a{if $url_arr.folders.0 == 'categories' && $url_arr.folders.1 == 'Bestsellers'} class="active"{/if} href="{$BASE_FOLDER}categories/Bestsellers">{"Bestsellers"|mytranslate}</a></li>
							<li class="b3"><a{if $url_arr.folders.0 == 'testimonials'} class="active"{/if} href="{$BASE_FOLDER}testimonials">{"Testimonials"|mytranslate}</a></li>
							<li class="b4"><a{if $url_arr.folders.0 == 'faq'} class="active"{/if} href="{$BASE_FOLDER}faq">{"FAQ"|mytranslate}</a></li>
							<li class="b5"><a{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'policy'} class="active"{/if} href="{$BASE_FOLDER}page/policy">{"Policy"|mytranslate}</a></li>
							<li class="b6"><a{if $url_arr.folders.0 == 'contact'} class="active"{/if} href="{$BASE_FOLDER}contact">{"Contact us"|mytranslate}</a></li>
						</ul>
						<div class="search-by-letters">
							<a href="{$BASE_FOLDER}search?q=A">A</a>
							<a href="{$BASE_FOLDER}search?q=B">B</a>
							<a href="{$BASE_FOLDER}search?q=C">C</a>
							<a href="{$BASE_FOLDER}search?q=D">D</a>
							<a href="{$BASE_FOLDER}search?q=E">E</a>
							<a href="{$BASE_FOLDER}search?q=F">F</a>
							<a href="{$BASE_FOLDER}search?q=G">G</a>
							<a href="{$BASE_FOLDER}search?q=H">H</a>
							<a href="{$BASE_FOLDER}search?q=I">I</a>
							<a href="{$BASE_FOLDER}search?q=J">J</a>
							<a href="{$BASE_FOLDER}search?q=K">K</a>
							<a href="{$BASE_FOLDER}search?q=L">L</a>
							<a href="{$BASE_FOLDER}search?q=M">M</a>
							<a href="{$BASE_FOLDER}search?q=N">N</a>
							<a href="{$BASE_FOLDER}search?q=O">O</a>
							<a href="{$BASE_FOLDER}search?q=P">P</a>
							<a href="{$BASE_FOLDER}search?q=Q">Q</a>
							<a href="{$BASE_FOLDER}search?q=R">R</a>
							<a href="{$BASE_FOLDER}search?q=S">S</a>
							<a href="{$BASE_FOLDER}search?q=T">T</a>
							<a href="{$BASE_FOLDER}search?q=U">U</a>
							<a href="{$BASE_FOLDER}search?q=V">V</a>
							<a href="{$BASE_FOLDER}search?q=W">W</a>
							<a href="{$BASE_FOLDER}search?q=X">X</a>
							<a href="{$BASE_FOLDER}search?q=Y">Y</a>
							<a href="{$BASE_FOLDER}search?q=Z">Z</a>
						</div>
						<div class="clear"></div>
					</div><!-- /header -->
					<div class="area">
						<div class="lPart">
							<div class="tit-big">{"CATALOG"|mytranslate}</div>
                            <form class="search" id="search_box" action="{$BASE_FOLDER}search">

								<input class="inp auto_clear" autocomplete="off" type="text" value="" placeholde="Search product" name="q" id="q">
								<input class="btn" type="submit" value="">
							</form>
							<ul class="sub-menu" id="categories">
								{foreach item=v key=k from=$tree_arr name=tree_foreach}
									<li class="li-{$k}{if $k|lower|replace:' ':'-' == $url_arr.folders.1|lower} active{/if}">
										<i></i><a href="{$BASE_FOLDER}categories/{$k|replace:' ':'-'}/all">{if $cat_eq_lang}{$cat_eq_lang.$k}{else}{$k}{/if}</a>
										<ul>
											<!--li{if $k|lower == $url_arr.folders.1|lower && $url_arr.folders.2 == 'all'} class="active"{/if}><a href="{$BASE_FOLDER}categories/{$k}/all">ALL</a></li-->
											{foreach item=v2 key=k2 from=$v}
												<li{if $url_arr.folders.2|lower == $k2|lower|replace:' ':'-'} class="active"{/if}><a href="{$BASE_FOLDER}categories/{$k|replace:' ':'-'}/{$config_array.pill_prefix}{$k2|replace:' ':'-'}{$config_array.pill_postfix}">
														<span class="name">{$k2}</span>
														{if $config_array.show_tree_price}
															<span class="price">{$currency_symbol}{$v2.0|price_handler}</span>
														{/if}
													</a></li>
											{/foreach}
										</ul>
									</li>
								{/foreach}
							</ul>
							<div class="social">
								<div></div>
								<div></div>
								<div></div>
								<div></div>
								<div></div>
							</div>
							<div class="delivery-icons">
								<i class="i1"></i>
								<i class="i2"></i>
								<i class="i3"></i>
							</div>
						</div><!-- /lPart -->
						<div class="rPart">
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
							<h1 class="tit-big">
								{if
								$urlArr.folders.0 == 'testimonials'
								||
								$urlArr.folders.0 == 'faq'
								||
								$urlArr.folders.0 == 'contact'
								||
								$urlArr.folders.0 == 'basket'
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
							</h1>





