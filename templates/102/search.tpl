{include file="!header.tpl"}
<div class="catalog">
{if $result_array|@count == 0 && $result_array_ai|@count == 0}
	<div class="e404">
		{"Nothing found. You may be interested in our Best Sellers"|mytranslate}
	</div>
{/if}
{if $result_array|@count > 0}

	<div class="line">
	{foreach item=v key=k from=$result_array name=resultArr}
	    {assign var=keyx value=$v.1}
	    <a class="e {if $smarty.foreach.resultArr.iteration is div by 3} last{/if}" href="{$BASE_FOLDER}categories/{$v.2|replace:' ':'-'}/{$config_array.pill_prefix}{$k|replace:' ':'-'}{$config_array.pill_postfix}">
		    <i class="name">{$k}</i>
            {if $v.3}<span class="ai">{"Active ingredient:"|mytranslate} <span>{$v.3}</span></span>{/if}
	        <img src="{$BASE_FOLDER}system/images/{$k|strtolower}.jpg" width="80" alt="{$k|escape|addslashes}" />
		    <i class="price">
			    <span>{$currency_symbol}{$v.0|string_format:"%.2f"}</span> {"for pill"|mytranslate}
		    </i>



		    <i class="descr">
			    {$v.1|truncate:110:" ..."}
	        </i>
		    <i class="buy">{"Buy Now"|mytranslate}</i>
	    </a>
	    {if $smarty.foreach.resultArr.iteration is div by 3}
			</div>
			<div class="line">
		{/if}
	{/foreach}
	</div>
	
{/if}


</div>
{include file="!footer.tpl"}