{include file="!header.tpl"}
<div class="border">
	{if $errors_arr|@count == 0 && $smarty.post.cw}
	{"Thank you. Your message has been sent."|mytranslate}
	{else}
    <script type="text/javascript" src="{$BASE_FOLDER}page_js?p=contact"></script>
	<div id="result_str"></div>
    <form action="" method="post" class="contact_form">
        <table>
        	<!--tr id="you_are_tr">
                <th>{"You are:"|mytranslate} <span class="must">*</span></th>
                <td>
                	<div>
                		<label>
                			<input class="l_radio" type="radio" value="2" name="you_are" {if $smarty.post.you_are != 1 || !$smarty.post.you_are}checked="checked"{/if}>
                			{"Visitor"|mytranslate}
                		</label>
                		&nbsp;
                		&nbsp;
                		&nbsp;
                		<label>
                			<input class="l_radio" type="radio" value="1" name="you_are"{if $smarty.post.you_are == 1} checked="checked"{/if}>
                			{"Current customer"|mytranslate}
                		</label>
                	</div>
                </td>
                <td class="error_td"></td>
            </tr-->
            <input type="hidden" name="you_are" value="2">
            <tr{if $errors_arr.name} class="error_tr"{/if}>
                <th>{"Name:"|mytranslate} <span class="must">*</span></th>
                <td><div><input type="text" class="i" name="name" value="{$smarty.post.name|escape}" /></div></td>
                <td class="error_td">{$errors_arr.name|mytranslate}</td>
            </tr>
            <tr{if $errors_arr.email} class="error_tr"{/if}>
                <th>{"E-mail:"|mytranslate} <span class="must">*</span></th>
                <td><div><input type="email" class="i" name="email" value="{$smarty.post.email|escape}" /></div></td>
                <td class="error_td">{$errors_arr.email|mytranslate}</td>
            </tr>
            <tr{if $errors_arr.ccn} class="error_tr"{/if} id="ccn_fld" {if $smarty.post.you_are != 1 || !$smarty.post.you_are}style="display:none;"{/if}>
                <th>{"Credit Card Number used:"|mytranslate} <span class="must">*</span></th>
                <td><div><input type="number" class="i" name="ccn" value="{$smarty.post.ccn|escape}" /></div></td>
                <td class="error_td">{$errors_arr.ccn|mytranslate}</td>
            </tr>
            <tr{if $errors_arr.subject} class="error_tr"{/if}>
                <th>{"Subject:"|mytranslate} <span class="must">*</span></th>
                <td>
                    <select id="subject_select" name="subject_select" class="i" style="width: 228px; margin-bottom: 4px;">
                        <option value="">{"Pick one"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Reprocess my credit card'} selected="selected"{/if} value="Reprocess my credit card">{"Reprocess my credit card"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Did not receive my order'} selected="selected"{/if} value="Did not receive my order">{"Did not receive my order"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Resend'} selected="selected"{/if} value="Resend">{"Resend"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Questions regarding medicine'} selected="selected"{/if} value="Questions regarding medicine">{"Questions regarding medicine"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Unsubscribe'} selected="selected"{/if} value="Unsubscribe">{"Unsubscribe"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Call me'} selected="selected"{/if} value="Call me">{"Call me"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Cancel order'} selected="selected"{/if} value="Cancel order">{"Cancel order"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Order status'} selected="selected"{/if} value="Order status">{"Order status"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Wrong shipping address'} selected="selected"{/if} value="Wrong shipping address">{"Wrong shipping address"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Partial order'} selected="selected"{/if} value="Partial order">{"Partial order"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Shipping delay'} selected="selected"{/if} value="Shipping delay">{"Shipping delay"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Received no confirmation'} selected="selected"{/if} value="Received no confirmation">{"Received no confirmation"|mytranslate}</option>
                        <option {if $smarty.post.subject_select == 'Other'} selected="selected"{/if} value="Other">{"Other"|mytranslate}</option>
                    </select>
                    <div id="custom_subject" {if $smarty.post.subject_select == 'Other'} style="display: block;"{/if}><input type="text" class="i" name="subject" placeholder="Your subject" value="{$smarty.post.subject|escape}" /></div>
                </td>
                <td class="error_td">{$errors_arr.subject|mytranslate}</td>
            </tr>
            <tr{if $errors_arr.message} class="error_tr"{/if}>
                <th>{"Message:"|mytranslate} <span class="must">*</span></th>
                <td><div><textarea cols="20" rows="10" name="message">{$smarty.post.message|escape}</textarea></div></td>
                <td class="error_td">{$errors_arr.message|mytranslate}</td>
            </tr>
            <tr{if $errors_arr.cw} class="error_tr"{/if}>
                <th>{"Control words:"|mytranslate}</th>
                <td>
                	<div><input type="text" class="i" name="cw" /></div>
                	<img id="control_image" src="{$BASE_FOLDER}contact/?image" width="160"  height="60" alt="CW" title="CW" />
                	<a href="{$BASE_FOLDER}contact" id="reloader_of_image">{"reload image"|mytranslate}</a>
                </td>
                <td class="error_td">{$errors_arr.cw|mytranslate}</td>
            </tr>
            <tr>
                <th></th>
                <td><div><input type="submit" class="btn btn-default" value="{"send"|mytranslate}" /></div></td>
            </tr>
        </table>
    </form>
    {/if}
</div>
{include file="!footer.tpl"}