{include file="!header.tpl"}{strip}
{if $smarty.get.e404}
<div class="e404">
	{"Nothing found. You may be interested in our Best Sellers"|mytranslate}
</div>
{/if}
<div class="area catalog">
	<div class="line">
    {foreach item=v key=k from=$resultArr name=resultArr}


	    <a class="e" href="{$BASE_FOLDER}categories/{$current_cat|replace:' ':'-'}/{$config_array.pill_prefix}{$k|replace:' ':'-'}{$config_array.pill_postfix}">
	        <img src="{$BASE_FOLDER}system/images/{$k|strtolower}.jpg" width="80" alt="{$config_array.seo.pill_img_prefix}{$k|escape|addslashes}{$config_array.seo.pill_img_postfix}" />
	        <span>
	            <i class="name">{$k}</i>
	            {if $v.2}<i class="ai">{"Active ingredient:"|mytranslate} <span>{$v.2}</span></i>{/if}
	            <i class="price">
            		<i>{$currency_symbol}{$v.0|string_format:"%.2f"}</i> {"for pill"|mytranslate}
	            </i>
	            <i class="add-to-cart"></i>
	        </span>
	        <i class="small-descr">
            	{$v.1|truncate:160:" ..."}
	        </i>
	    </a>
	    {if $smarty.foreach.resultArr.iteration is div by 2}
			</div>
			<div class="line">
		{/if}
    {/foreach}
    </div>
</div>
{/strip}{include file="!footer.tpl"}