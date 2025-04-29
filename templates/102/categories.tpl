{include file="!header.tpl"}{strip}
{if $smarty.get.e404}
<div class="e404">
	{"Nothing found. You may be interested in our Best Sellers"|mytranslate}
</div>
{/if}
<div class="catalog">
	<div class="line">
    {foreach item=v key=k from=$resultArr name=resultArr}
    	
    
	    <a class="e {if $smarty.foreach.resultArr.iteration is div by 3} last{/if}" href="{$BASE_FOLDER}categories/{$current_cat|replace:' ':'-'}/{$config_array.pill_prefix}{$k|replace:' ':'-'}{$config_array.pill_postfix}">

	            <i class="name">{$k}</i>
		        {if $v.2}<i class="ai">{"Active ingredient:"|mytranslate} <span>{$v.2}</span></i>{/if}
		        <img src="{$BASE_FOLDER}system/images/{$k|strtolower}.jpg" width="80" alt="{$config_array.seo.pill_img_prefix}{$k|escape|addslashes}{$config_array.seo.pill_img_postfix}" />

	            <i class="price">
            		<span>{$currency_symbol}{$v.0|string_format:"%.2f"}</span> {"for pill"|mytranslate}
	            </i>

		        {*
			    <i class="descr">
				    {$v.1}
			    </i>
				*}
		        <i class="descr"></i>
	            <i class="buy">{"Buy Now"|mytranslate}</i>
	    </a>
	    {if $smarty.foreach.resultArr.iteration is div by 3}
			</div>
			{if $smarty.foreach.resultArr.iteration == 3}
				<a class="special-offer" href="{$BASE_FOLDER}categories/ED-Sample-Packs/all">
					<span>
						{$currency_symbol}{$special_offer_price}
					</span>
				</a>
			{/if}
			<div class="line">
		{/if}
    {/foreach}
    </div>
</div>
{/strip}{include file="!footer.tpl"}