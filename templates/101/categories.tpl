{include file="!header.tpl"}{strip}
{if $smarty.get.e404}
<div class="e404">
	{"Nothing found. You may be interested in our Best Sellers"|mytranslate}
</div>
{/if}
<div class="cat_list">
    {foreach item=v key=k from=$resultArr}
    <a href="{$BASE_FOLDER}categories/{$current_cat|replace:' ':'-'}/{$config_array.pill_prefix}{$k|replace:' ':'-'}{$config_array.pill_postfix}"><span><span><span>
        <img src="{$BASE_FOLDER}system/images/{$k|strtolower}.jpg" width="100" height="100" alt="{$config_array.seo.pill_img_prefix}{$k|escape|addslashes}{$config_array.seo.pill_img_postfix}" />
        <span class="cover">
            <span class="n">{$k}</span>
            {if $v.2}<span class="ai">{"Active Ingredient"|mytranslate} <span>{$v.2}</span></span>{/if}
            <span class="p"><i>{$currency_symbol}{$v.0|string_format:"%.2f"}</i> {"for pill"|mytranslate}</span>
            <span class="d">
                {$v.1}
            </span>
        </span><!-- /cover -->
        <span class="clear"></span>
        <span class="buy">{"Buy Now"|mytranslate}</span>
    </span></span></span></a>
    {/foreach}
</div>
{/strip}{include file="!footer.tpl"}