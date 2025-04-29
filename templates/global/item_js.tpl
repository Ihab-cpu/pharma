{strip}
    <style type="text/css">
        {$css}
    </style>
    <div class="{$mysjprefix}main {$mysjprefix}-lang-{$language}">
    <div class="{$mysjprefix}payments">
        {*
	{if !isset($smarty.get.noVISA) && $config_array.payments.VISA == 1}<a class="visa"><img src="{$BASE_FOLDER}templates/102/img/money_system/v.gif" alt="visa" /></a>{/if}
        {if !isset($smarty.get.noMasterCard) && $config_array.payments.MasterCard == 1}<a class="mastercard"><img src="{$BASE_FOLDER}templates/102/img/money_system/m.gif" alt="MasterCard" /></a>{/if}
        {if !isset($smarty.get.noJSB) && $config_array.payments.JSB == 1}<a class="jcb"><img src="{$BASE_FOLDER}templates/102/img/money_system/j.gif" alt="JSB" /></a>{/if}
        {if !isset($smarty.get.noAmex) && $config_array.payments.Amex == 1}<a class="amex"><img src="{$BASE_FOLDER}templates/102/img/money_system/a.gif" alt="Amex" /></a>{/if}
        {if !isset($smarty.get.noeCheck) && $config_array.payments.eCheck == 1}<a class="echeck"><img src="{$BASE_FOLDER}templates/102/img/money_system/e.gif" alt="eCheck" /></a>{/if}
	*}
    </div>

    <div class="{$mysjprefix}current_product" style="{if $smarty.get.maxwidth}max-width: {$smarty.get.maxwidth|intval}px{/if}">
        <div class="{$mysjprefix}strong-sides">
            <table>
                <tr>
                    <td><div><i></i><div>{"No Prescription Required"|mytranslate}</div></div></td>
                    <td><div><i></i><div>{"100% MoneyBack Guarentee"|mytranslate}</div></div></td>
                    <td><div><i></i><div>{"Discreet packaging"|mytranslate}</div></div></td>
                </tr>
            </table>
        </div>
        <div class="{$mysjprefix}header">
            <div class="{$mysjprefix}menu">
                <ul class="{$mysjprefix}menu_ul">
                    <li class="{$mysjprefix}b1"><a{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'about'} class="active"{/if} href="{$BASE_FOLDER}page/about"><span>{"About us"|mytranslate}</span></a></li>
                    <li class="{$mysjprefix}b2"><a{if $url_arr.folders.0 == 'categories' && $url_arr.folders.1 == 'Bestsellers'} class="active"{/if} href="{$BASE_FOLDER}categories/Bestsellers"><span>{"Bestsellers"|mytranslate}</span></a></li>
                    <li class="{$mysjprefix}b3"><a{if $url_arr.folders.0 == 'testimonials'} class="active"{/if} href="{$BASE_FOLDER}testimonials"><span>{"Testimonials"|mytranslate}</span></a></li>
                    <li class="{$mysjprefix}b4"><a{if $url_arr.folders.0 == 'faq'} class="active"{/if} href="{$BASE_FOLDER}faq"><span>{"FAQ"|mytranslate}</span></a></li>
                    <li class="{$mysjprefix}b5"><a{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'policy'} class="active"{/if} href="{$BASE_FOLDER}page/policy"><span>{"Policy"|mytranslate}</span></a></li>
                    <li class="{$mysjprefix}b6"><a{if $url_arr.folders.0 == 'contact'} class="active"{/if} href="{$BASE_FOLDER}contact"><span>{"Contact us"|mytranslate}</span></a></li>
                </ul>
            </div>
        </div>
        <div class="{$mysjprefix}current_product_content">
	    <div class="{$mysjprefix}product_descr">
            <div class="{$mysjprefix}h1">{$name}</div>
        <table class="{$mysjprefix}product_descr_tbl">
            <tr>
                <td class="{$mysjprefix}pic_td"><div title="{$resultArr.name|htmlspecialchars}"><img src="{$BASE_FOLDER}system/images/{$url_arr.folders.2|strtolower}.jpg" width="100" height="100" alt="{$resultArr.name|htmlspecialchars}" /></div></td>
                <td>

                    <div class="{$mysjprefix}descr">{$resultArr.small_descr}</div>
                    <div class="{$mysjprefix}ai">{if $active_ingredients}{"Active Ingredient"|mytranslate}: <span>{$active_ingredients}</span>{/if}</div>
                    <div class="{$mysjprefix}av">{"Availability:"|mytranslate} <span>{"In Stock"|mytranslate} ({$availability} {"packes"|mytranslate})</span></div>
                    <!--div class="{$mysjprefix}ex">Exp. Date: Approx. {$approx_date} </div-->
                    <div class="{$mysjprefix}clear"></div>
                    <!--a class="{$mysjprefix}tstmls" href="#">Testimonials</a-->
                </td>
            </tr>
        </table>
	    </div>
	    <div class="{$mysjprefix}mega-discount">
		    <div>{"Save your money"|mytranslate}</div>
		    {"Mega Discounts on Big Packs"|mytranslate}
		    <i></i>
	    </div>
        <div class="{$mysjprefix}clear"></div>
        <div class="{$mysjprefix}analogs">
        	{if $resultArr.analogs|@count > 0}
        	<span class="{$mysjprefix}oneLineHeight">
        		<span class="{$mysjprefix}viewAll"><i></i>{"View all"|mytranslate}</span>
	        	<span class="{$mysjprefix}nowHeight">
            		<div class="{$mysjprefix}tit">{"Analogs of"|mytranslate} {$resultArr.name}: </div>
            		{foreach item=v key=k from=$resultArr.analogs}
		                <a href="{$BASE_FOLDER}categories/{$v}/{$config_array.pill_prefix}{$k}{$config_array.pill_postfix}">{$k}</a>
		            {/foreach}
            	</span>
                <span class="{$mysjprefix}clearfix"></span>
            </span>
            
            
            {/if}
            {if $resultArr.synonims|@count > 0}
        		<div class="{$mysjprefix}clear"></div>
        		<span class="{$mysjprefix}oneLineHeight">
        			<span class="{$mysjprefix}viewAll"><i></i>{"View all"|mytranslate}</span>
	        		<span class="{$mysjprefix}nowHeight">
				        <div class="{$mysjprefix}tit">{"Other names of"|mytranslate} {$resultArr.name}:</div>
				        {foreach item=v key=k from=$resultArr.synonims}
                            <a href="{$BASE_FOLDER}categories/{$url_arr.folders.1}/{$config_array.pill_prefix}{$url_arr.folders.2}{$config_array.pill_postfix}/{$v}">{$v}</a>
				        {/foreach}
                        <span class="{$mysjprefix}clear"></span>
				    </span>
                    <div class="{$mysjprefix}clear"></div>
				</span>
	        {/if}
        </div>
        
        <div class="{$mysjprefix}clear"></div>

        <div class="{$mysjprefix}dosages">

            {foreach item=v key=k from=$resultArr.packings}
                <div class="{$mysjprefix}val">{$resultArr.name} {$k}{$resultArr.type}</div>
	            <div class="{$mysjprefix}dosage-box">
                <table class="{$mysjprefix}dosage_table">
                    <tr class="{$mysjprefix}zebra">
                        <th class="{$mysjprefix}center-text"><span>{"Product name"|mytranslate}</span></th>
                        <th class="{$mysjprefix}center-text">{"Per Pill"|mytranslate}</th>

                        <th class="{$mysjprefix}center-text">{"Savings"|mytranslate}<span> ({"only today"|mytranslate})</span></th>
	                    <th class="{$mysjprefix}center-text">{"Per Pack"|mytranslate}</th>
                        <th></th>
                    </tr>
                    {foreach item=v2 key=k2 from=$v name=myForeach}
                    <tr{if $smarty.foreach.myForeach.iteration % 2 == 0} class="{$mysjprefix}zebra"{/if}>
                        <td class="{$mysjprefix}center-text"><b>{$v2.count} {$resultArr.pack_name|mytranslate}</b></td>
                        <td class="{$mysjprefix}center-text">{$currency_symbol}{$v2.price_per_pill|string_format:"%.2f"}</td>
                        <td class="{$mysjprefix}center-text color1">{if $v2.save != ''}{*<span class="{$mysjprefix}saving-percent">20% {"off"|mytranslate}</span>*}{$currency_symbol}{$v2.save|string_format:"%.2f"}{/if}</td>
	                    <td class="{$mysjprefix}center-text">{if $v2.save != ''}<span class="{$mysjprefix}old">{$currency_symbol}{$v2.save+$v2.pack_price|string_format:"%.2f"}</span> {/if}<b>{$currency_symbol}{$v2.pack_price|string_format:"%.2f"}</b></td>
                        <td class="{$mysjprefix}center-text buy-td"><a class="{$mysjprefix}add-to-cart" href="{$BASE_FOLDER}categories/{$url_arr.folders.1}/{$config_array.pill_prefix}{$url_arr.folders.2}{$config_array.pill_postfix}/?buy={$k2}">{"Add to cart"|mytranslate}</a></td>
                    </tr>
                    {/foreach}
                </table>
	            </div>
            {/foreach}
            {if !empty($smarty.get.fulldescr)}
            <div class="{$mysjprefix}addPillBox border">
                <div class="{$mysjprefix}clear"></div>
                <ul class="{$mysjprefix}items">
                    <li class="{$mysjprefix}item active">
                        {$resultArr.full_descr}
                    </li>
                </ul>
            </div>
            {/if}
        </div>
        </div>
    </div>
    </div>
{/strip}