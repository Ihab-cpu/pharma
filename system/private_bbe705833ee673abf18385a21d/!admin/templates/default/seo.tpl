{include file="!header.tpl"}
    {if !$config_array.db_ver}
		<div class="alert alert-error">
			<b>Please go to the &laquo;<a href="?p=update">Update DB</a>&raquo; section and click the "Install Update" button. Your shop will be active then.</b>
		</div>
	{/if}
    {if $errorStrSettings}
        <div class="alert alert-error">
            {$errorStrSettings}
        </div>
    {/if}
	<form action="" method="post">
        <h3>Meta info</h3>
		<div class="tabbable">
			<ul class="nav nav-tabs">
                {foreach item=v key=k from=$structure name=myforeach}
				    <li {if $smarty.foreach.myforeach.iteration == 1} class="active"{/if}><a href="#tab{$k}" data-toggle="tab">{$k|upper}</a></li>
                {/foreach}
			</ul>
			<div class="tab-content">

                {foreach item=v key=k from=$structure name=myforeach}
                    <div class="tab-pane{if $smarty.foreach.myforeach.iteration == 1} active{/if}" id="tab{$k}">
                    {foreach item=vP key=kP from=$tags}
                        <div class="span4">
                            <h4>{$vP.0}</h4>
                            <table class="table table-bordered table-hover" style="width:100%;">
                            {foreach item=vX key=kX from=$v.$kP}
                                <tr>
                                    <th style="width: 130px">
                                        <label for="seo_{$k}_{$kP}_{$kX}" style="padding-top: 5px;">{$vX}</label>
                                    </th>
                                    <td colspan="2">
                                        <input type="text" style="width:95%;" value="{$config_array.seo.$k.$kP.$kX}" name="seo[{$k}][{$kP}][{$kX}]" id="seo_{$k}_{$kP}_{$kX}">
                                    </td>
                                </tr>
                            {/foreach}
                            </table>
                            {if $vP.1}
                                <div class="alert alert-info" style="min-height: 40px;">
                                {foreach item=vX key=kX from=$vP.1 name=eqArr}
                                    <a href="#">{$vX}</a>
                                    {if $smarty.foreach.eqArr.iteration != $smarty.foreach.eqArr.last}
                                        ,
                                    {/if}
                                {/foreach}
                                </div>
                            {/if}

                            <!--pre>{$vP.1|@print_r}</pre-->
                        </div>
                    {/foreach}
                    </div>
                {/foreach}
            </div>
        </div><!-- /tabbable -->
        <h3>Other</h3>
        <div class="row" style="margin: 0">
        <div class="span4">

            <table class="table table-bordered table-hover" style="width:100%;">
                <tr>
                    <th style="width: 130px">Default language</th>
                    <td>
                        <select name="seo[default_lang]">
                            <option value="">Auto</option>
                            <option value="en" {if $config_array.seo.default_lang == 'en'} selected="selected"{/if}>English</option>
                            <option value="de" {if $config_array.seo.default_lang == 'de'} selected="selected"{/if}>Deutsch</option>
                            <option value="fr" {if $config_array.seo.default_lang == 'fr'} selected="selected"{/if}>Français</option>
                            <option value="it" {if $config_array.seo.default_lang == 'it'} selected="selected"{/if}>Italiano</option>
                            <option value="es" {if $config_array.seo.default_lang == 'es'} selected="selected"{/if}>Español</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Default currency</th>
                    <td>
                        <select name="seo[default_currency]">
                            <option value="">Auto</option>
                            <option {if $config_array.seo.default_currency == 'USD'} selected="selected"{/if} value="USD">USD</option>
                            <option {if $config_array.seo.default_currency == 'EUR'} selected="selected"{/if} value="EUR">EUR</option>
                            <option {if $config_array.seo.default_currency == 'AUD'} selected="selected"{/if} value="AUD">AUD</option>
                            <option {if $config_array.seo.default_currency == 'CAD'} selected="selected"{/if} value="CAD">CAD</option>
                            <option {if $config_array.seo.default_currency == 'GBP'} selected="selected"{/if} value="GBP">GBP</option>
                            <option {if $config_array.seo.default_currency == 'CZK'} selected="selected"{/if} value="CZK">CZK</option>
                            <option {if $config_array.seo.default_currency == 'PLN'} selected="selected"{/if} value="PLN">PLN</option>
                            <option {if $config_array.seo.default_currency == 'BGN'} selected="selected"{/if} value="BGN">BGN</option>
                            <option {if $config_array.seo.default_currency == 'HUF'} selected="selected"{/if} value="HUF">HUF</option>
                            <option {if $config_array.seo.default_currency == 'DKK'} selected="selected"{/if} value="DKK">DKK</option>
                            <option {if $config_array.seo.default_currency == 'NOK'} selected="selected"{/if} value="NOK">NOK</option>
                            <option {if $config_array.seo.default_currency == 'SEK'} selected="selected"{/if} value="SEK">SEK</option>
                            <option {if $config_array.seo.default_currency == 'CHF'} selected="selected"{/if} value="CHF">CHF</option>
                            <option {if $config_array.seo.default_currency == 'JPY'} selected="selected"{/if} value="JPY">JPY</option>
                            <option {if $config_array.seo.default_currency == 'RON'} selected="selected"{/if} value="RON">RON</option>
                            <option {if $config_array.seo.default_currency == 'CNY'} selected="selected"{/if} value="USD">CNY</option>

                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <div class="span4">
            <table class="table table-bordered table-hover" style="width:100%;">
                <tr>
                    <th style="width: 130px">
                        Pill URL prefix
                    </th>
                    <td colspan="2">
                        <input type="text" id="pill_prefix" name="pill_prefix" value="{$config_array.pill_prefix}">
                    </td>
                </tr>
                <tr>
                    <th style="width: 130px">
                        Pill URL postfix
                    </th>
                    <td colspan="2">
                        <input type="text" id="pill_postfix" name="pill_postfix" value="{$config_array.pill_postfix}">
                    </td>
                </tr>
                <tr>
                    <th style="width: 130px">
                        Pill img alt prefix
                    </th>
                    <td colspan="2">
                        <input type="text" id="pill_img_prefix" name="seo[pill_img_prefix]" value="{$config_array.seo.pill_img_prefix}">
                    </td>
                </tr>
                <tr>
                    <th style="width: 130px">
                        Pill img alt postfix
                    </th>
                    <td colspan="2">
                        <input type="text" id="pill_img_postfix" name="seo[pill_img_postfix]" value="{$config_array.seo.pill_img_postfix}">
                    </td>
                </tr>

            </table>
        </div>
            <div class="span4">
                <table class="table table-bordered table-hover" style="width:100%;">
                <tr>
                    <th style="width: 130px">Custom HTML code<br> <small>eq: counter</small></th>
                    <td>
                        <textarea cols="40" rows="3" name="html" style="height: 77px; width: 95%;">{include file="./../../../../../templates/global/counter.tpl"}</textarea>
                    </td>
                </tr>
            </table>
        </div>
        </div>
        <input class="btn btn-block btn-large    btn-success" type="submit" name="save" value="Save" />
	</form>


{include file="!footer.tpl"}