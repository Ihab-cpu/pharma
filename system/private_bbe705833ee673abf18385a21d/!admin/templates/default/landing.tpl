{include file="!header.tpl"}
	
	
<div class="row-fluid">
	{if !$config_array.db_ver}
		<div class="alert alert-error">
			<b>Please go to the &laquo;<a href="?p=update">Update DB</a>&raquo; section and click the "Install Update" button. Your shop will be active then.</b>
		</div>
	{/if}
	<h2>Easy use with JS</h2>
	<p>Adaptive landing</p>
	<pre>&lt;script type="text/javascript" src="http://{$smarty.server.HTTP_HOST}/categories/Bestsellers/{$config_array.pill_prefix}Viagra{$config_array.pill_postfix}?landing=1&language=en&maxwidth=900&fulldescr=1"&gt;&lt;/script&gt;</pre>
	<hr>
	<h4>GET paramentrs:</h4>
	<b>fulldescr</b> - if you want see full description on landing page
	<br>
	<b>maxwidth</b> - max width of your landing area
	<br>
	<b>language</b> - <b>en de fr it es</b>(if empty - automatic)
	<br>
	<b>template</b> - <b>100 or 101 or 102</b> (if empty - automatic)
	<br>
	<b>currency</b> -
	<b>USD	EUR	AUD	CAD	GBP	CZK	PLN	BGN	HUF	DKK	NOK	SEK	CHF	JPY	RON	CNY</b> (if empty - automatic)
	<br>
	<b>subid</b>
	<br>
	<b>trackid</b>
	<br>
	<b>noVisa</b> - off VISA in landing
	<br>
	<b>noAmex</b> - off AMEX in landing
	<br>
	<b>noMasterCard</b> - off MasterCard in landing
	<br>
	<b>noeCheck</b> - off eCheck in landing
	<br>
	<hr>
	<h4>Example:</h4>
	<table>
		<tr>
			<td>
				<script type="text/javascript" src="/categories/Bestsellers/{$config_array.pill_prefix}Viagra{$config_array.pill_postfix}?landing=1&language=en&fulldescr=1"></script>
			</td>
			</td>
		</tr>

	</table>
</div><!--/row-->

	
	
{include file="!footer.tpl"}