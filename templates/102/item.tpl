{include file="!header.tpl"}{strip}
    <div class="current_product">
	    <div class="product_descr">
        <table>
            <tr>
                <td class="pic_td">
                    <div class="pic{if $noZoom} noZoom{/if}" title="{$resultArr.name|htmlspecialchars}">
                        <i class="zoom-bg"></i>
                        <div class="zoom-ico"></div>
                        <div class="zoom-image"><img src="{$imgZoom}"></div>
                        <img src="{$BASE_FOLDER}system/images/{$resultArr.name|strtolower}.jpg" width="100" height="100" alt="{$config_array.seo.pill_img_prefix}{$resultArr.name|escape}{$config_array.seo.pill_img_postfix}" />
                    </div>
                </td>
                <td>
                    
                    <div class="descr">{$resultArr.small_descr}</div>
                    <div class="ai">{if $active_ingredients}{"Active Ingredient"|mytranslate}: <span>{$active_ingredients}</span>{/if}</div>
                    <div class="av">{"Availability:"|mytranslate} <span>{"In Stock"|mytranslate} ({$availability} {"packes"|mytranslate})</span></div>
                    <!--div class="ex">Exp. Date: Approx. {$approx_date} </div-->
                    <div class="clear"></div>
                    <!--a class="tstmls" href="#">Testimonials</a-->
                </td>
            </tr>
        </table>
	    </div>
	    <div class="mega-discount">
		    <div>{"Save your money"|mytranslate}</div>
		    {"Mega Discounts on Big Packs"|mytranslate}
		    <i></i>
	    </div>
        <div class="clear"></div>
        <div class="analogs">
        	{if $resultArr.analogs|@count > 0}
        	<span class="oneLineHeight">
        		<span class="viewAll"><i></i>{"View all"|mytranslate}</span>
	        	<span class="nowHeight">
            		<div class="tit">{"Analogs of"|mytranslate} {$resultArr.name}: </div>
            		{foreach item=v key=k from=$resultArr.analogs}
		                <a href="{$BASE_FOLDER}categories/{$v|replace:' ':'-'}/{$config_array.pill_prefix}{$k|replace:' ':'-'}{$config_array.pill_postfix}">{$k}</a>
		            {/foreach}
            	</span>
                <span class="clearfix"></span>
            </span>
            
            
            {/if}
            {if $resultArr.synonims|@count > 0}
        		<div class="clear"></div>
        		<span class="oneLineHeight">
        			<span class="viewAll"><i></i>{"View all"|mytranslate}</span>
	        		<span class="nowHeight">
				        <div class="tit">{"Other names of"|mytranslate} {$resultArr.name}:</div>
				        {foreach item=v key=k from=$resultArr.synonims}
                            <a href="{$BASE_FOLDER}categories/{$url_arr.folders.1|replace:' ':'-'}/{$config_array.pill_prefix}{$url_arr.folders.2|replace:' ':'-'}{$config_array.pill_postfix}/{$v}">{$v}</a>
				        {/foreach}
                        <span class="clear"></span>
				    </span>
                    <div class="clear"></div>
				</span>
	        {/if}
        </div>
        
        <div class="clear"></div>

        <div class="dosages">

            {foreach item=v key=k from=$resultArr.packings}
                <div class="val">{$resultArr.name} {$k}{$resultArr.type}</div>
	            <div class="dosage-box">
                <table class="dosage_table">
                    <tr class="zebra">
                        <th class="center-text"><span>{"Product name"|mytranslate}</span></th>
                        <th class="center-text">{"Per Pill"|mytranslate}</th>

                        <th class="center-text">{"Savings"|mytranslate}<span> ({"only today"|mytranslate})</span></th>
	                    <th class="center-text">{"Per Pack"|mytranslate}</th>
                        <th></th>
                    </tr>
                    {foreach item=v2 key=k2 from=$v name=myForeach}
                    <tr{if $smarty.foreach.myForeach.iteration % 2 == 0} class="zebra"{/if}>
                        <td class="center-text"><b>{$v2.count} {$resultArr.pack_name|mytranslate}</b></td>
                        <td class="center-text">{$currency_symbol}{$v2.price_per_pill|string_format:"%.2f"}</td>
                        <td class="center-text color1">{if $v2.save != ''}{*<span class="saving-percent">20% {"off"|mytranslate}</span>*}{$currency_symbol}{$v2.save|string_format:"%.2f"}{/if}</td>
	                    <td class="center-text">{if $v2.save != ''}<span class="old">{$currency_symbol}{$v2.save+$v2.pack_price|string_format:"%.2f"}</span> {/if}<b>{$currency_symbol}{$v2.pack_price|string_format:"%.2f"}</b></td>
                        <td class="center-text buy-td"><a class="add-to-cart" href="{$BASE_FOLDER}categories/{$url_arr.folders.1}/{$config_array.pill_prefix}{$url_arr.folders.2}{$config_array.pill_postfix}/?buy={$k2}">{"Add to cart"|mytranslate}</a></td>
                    </tr>
                    {/foreach}
                </table>
	            </div>
            {/foreach}
            
            <div class="addPillBox border">
                <div class="clear"></div>
                <ul class="items">
                    <li class="item active">
                        {$resultArr.full_descr}
                    </li>
                </ul>
            </div>
        </div>
    </div>
{/strip}{include file="!footer.tpl"}