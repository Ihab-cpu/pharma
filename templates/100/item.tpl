{include file="!header.tpl"}{strip}
    <div class="text current_product">
        <table class="product_descr_tbl">
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
                    <div class="av">{"Availability:"|mytranslate} <span>{"In Stock"|mytranslate} ({$availability} {"packs"|mytranslate})</span></div>
                    <!--div class="ex">Exp. Date: Approx. {$approx_date} </div-->
                    <div class="clear"></div>
                    <!--a class="tstmls" href="#">Testimonials</a-->
                </td>
            </tr>
        </table>
        
        <div class="analogs">
        	{if $resultArr.analogs|@count > 0}
        	<span class="oneLineHeight">
        		<span class="viewAll"><i></i>{"View all"|mytranslate}</span>
	        	<span class="nowHeight">
            		<div class="tit">{"Analogs of"|mytranslate}: {$resultArr.name}&nbsp;</div>
            		{foreach item=v key=k from=$resultArr.analogs}
		                <a href="{$BASE_FOLDER}categories/{$v|replace:' ':'-'}/{$config_array.pill_prefix}{$k|replace:' ':'-'}{$config_array.pill_postfix}">{$k}</a>&nbsp;
		            {/foreach}
            	</span>
            </span>
            
            
            {/if}
            {if $resultArr.synonims|@count > 0}
        		<div class="clear"></div>
        		<div style="height: 7px;"></div>
        		<span class="oneLineHeight">
        			<span class="viewAll"><i></i>{"View all"|mytranslate}</span>
	        		<span class="nowHeight">
				        <div class="tit">{"Other names of"|mytranslate} {$resultArr.name}:&nbsp;</div>
				        {foreach item=v key=k from=$resultArr.synonims}
                            <a href="{$BASE_FOLDER}categories/{$url_arr.folders.1|replace:' ':'-'}/{$config_array.pill_prefix}{$url_arr.folders.2|replace:' ':'-'}{$config_array.pill_postfix}/{$v}">{$v}</a>&nbsp;
				        {/foreach}
				    </span>
				</span>
	        {/if}
        </div>
        
        <div class="clear"></div>

        <div class="dosages">

            {foreach item=v key=k from=$resultArr.packings}
                <div class="val">{$resultArr.name} {$k}{$resultArr.type}</div>

                <table class="dosage_table">
                    <tr>
                        <th class="l"><span>{"Product name"|mytranslate}</span></th>
                        <th>{"Per Pill"|mytranslate}</th>
                        <th>{"Savings"|mytranslate}</th>
                        <th>{"Per Pack"|mytranslate}</th>
                        <th>{"Order"|mytranslate}</th>
                    </tr>
                    {foreach item=v2 key=k2 from=$v}
                    <tr>
                        <td class="l b">{$v2.count} {$resultArr.pack_name|mytranslate}</td>
                        <td>{$currency_symbol}{$v2.price_per_pill|string_format:"%.2f"}</td>
                        <td class="b color1">{if $v2.save != ''}{$currency_symbol}{$v2.save|string_format:"%.2f"}{/if}</td>
                        <td>{if $v2.save != ''}<span class="old-price">{$currency_symbol}{$v2.save+$v2.pack_price|string_format:"%.2f"}</span> {/if}<b>{$currency_symbol}{$v2.pack_price|string_format:"%.2f"}</b></td>

                        <td class="buy-td"><a class="add-to-cart" href="{$BASE_FOLDER}categories/{$url_arr.folders.1}/{$config_array.pill_prefix}{$url_arr.folders.2}{$config_array.pill_postfix}/?buy={$k2}"><span>{"Add to cart"|mytranslate}</span></a></td>
                    </tr>
                    {/foreach}
                </table>
            {/foreach}
            
            <div class="addPillBox">
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