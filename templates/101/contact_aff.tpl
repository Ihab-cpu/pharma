{include file="!header.tpl"}
<div class="text">
	{if $errors_arr|@count == 0 && $smarty.post.cw}
	Thank you. Your message has been sent.
	{else}
    <script type="text/javascript" src="{$BASE_FOLDER}page_js?p=aff"></script>
    <br>
	<div id="result_str"></div>
	<br>
    <form action="" method="post" class="contact_form">
    	<input type="hidden" value="3" name="you_are">
    	<input type="hidden" value="1" name="aff">
        <table>
        	
            <tr{if $errors_arr.name} class="error_tr"{/if}>
                <th>Name: <span class="must">*</span></th>
                <td><div><input type="text" class="i" name="name" value="{$smarty.post.name|escape}" /></div></td>
                <td class="error_td">{$errors_arr.name}</td>
            </tr>
            <tr{if $errors_arr.email} class="error_tr"{/if}>
                <th>ICQ / Jabber: <span class="must">*</span></th>
                <td><div><input type="email" class="i" name="email" value="{$smarty.post.email|escape}" /></div></td>
                <td class="error_td">{$errors_arr.email}</td>
            </tr>
            <tr{if $errors_arr.message} class="error_tr"{/if}>
                <th>Message: <span class="must">*</span></th>
                <td><div><textarea cols="20" rows="10" name="message">{$smarty.post.message|escape}</textarea></div></td>
                <td class="error_td">{$errors_arr.message}</td>
            </tr>
            <tr{if $errors_arr.cw} class="error_tr"{/if}>
                <th>Control words:</th>
                <td>
                	<div><input type="text" class="i" name="cw" /></div>
                	<img id="control_image" src="{$BASE_FOLDER}contact/?image" width="160"  height="60" alt="CW" title="CW" />
                	<a href="{$BASE_FOLDER}contact" id="reloader_of_image">reload image</a>
                </td>
                <td class="error_td">{$errors_arr.cw}</td>
            </tr>
            <tr>
                <th></th>
                <td><div><input type="submit" class="b" value="send" /></div></td>
            </tr>
        </table>
    </form>
    {/if}
</div>
{include file="!footer.tpl"}