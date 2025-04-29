{include file="!header.tpl"}
<div class="cat_list">
{if $result_array|@count == 0 && $result_array_ai|@count == 0}
	<div class="e404">
		{"Nothing found. You may be interested in our Best Sellers"|mytranslate}
	</div>
{/if}
{if $result_array|@count > 0}
	<br />
	
	{foreach item=v key=k from=$result_array}
	    {assign var=keyx value=$v.1}
	    <a href="{$BASE_FOLDER}categories/{$v.2|replace:' ':'-'}/{$config_array.pill_prefix}{$k|replace:' ':'-'}{$config_array.pill_postfix}"><span><span><span>
	        <img src="{$BASE_FOLDER}system/images/{$k|strtolower}.jpg" width="100" height="100" alt="{$k|escape|addslashes}" />
	        <span class="cover">
	            <span class="n">{if $v.newname}{$v.newname}{else}{$k}{/if}</span>
	            <span class="ai">{"Active Ingredient"|mytranslate} <span>{$v.3}</span></span>
	            <span class="p"><i>{$currency_symbol}{$v.0|string_format:"%.2f"}</i> {"for pill"|mytranslate}</span>
	            <span class="d">
	                {$v.1}
	                <i>{"More information"|mytranslate}</i>
	            </span>
	        </span><!-- /cover -->
	        <span class="clear"></span>
	    </span></span></span></a>
	{/foreach}
	<br />
{/if}
{if $result_array_ai|@count > 0}
	<h2>{"Sovpadeniya v aktyvnyh ingridientah:"|mytranslate}</h2>
	<br />
	{foreach item=v key=k from=$result_array_ai}
	    {assign var=keyx value=$v.1}
	    <a href="{$BASE_FOLDER}categories/{$v.2}/{$k}"><span><span><span>
	        <img src="{$BASE_FOLDER}system/images/{$k|strtolower}.jpg" width="100" height="100" alt="#" title="#" />
	        <span class="cover">
	            <span class="n">{$k}</span>
	            <span class="p"><i>{$currency_symbol}{$v.0|string_format:"%.2f"}</i> for pill</span>
	            <span class="d">
	                {$v.1}
	                <i>{"More information"|mytranslate}</i>
	            </span>
	        </span><!-- /cover -->
	        <span class="clear"></span>
	    </span></span></span></a>
	{/foreach}
{/if}
</div>
{include file="!footer.tpl"}