{include file="!header.tpl"}
{*
<div class="text list_type_1">
    {foreach item=v key=k from=$result_arr}
         <div class="e">
            <div class="q">{$v.0}</div>
            <div class="a">
                {$v.1}
            </div>
        </div>
    {/foreach}
</div>
*}
<script type="text/javascript" src="{$BASE_FOLDER}faq_js"></script>
<div class="text list_type_1" id="list_type_1"></div>
{include file="!footer.tpl"}