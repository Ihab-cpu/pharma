<table class="statMenu">
	<tr>
		<td><a {if $smarty.get.p == 'stat_total'} style="color:red;" {/if} href="?p=stat_total">Total</a></td>
		<td><a {if $smarty.get.p == 'stat_referer'} style="color:red;" {/if} href="?p=stat_referer">Referers</a></td>
		<td><a {if $smarty.get.p == 'stat_orders'} style="color:red;" {/if} href="?p=stat_orders">Orders</a></td>
	</tr>
</table>
<br />