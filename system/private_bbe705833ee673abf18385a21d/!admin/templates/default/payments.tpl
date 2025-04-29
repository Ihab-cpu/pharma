{include file="!header.tpl"}
	{if $errorsArr|@count > 0}
		<div class="alert alert-error">
			{foreach item=v key=k from=$errorsArr}
				<h4>{$v}</h4>
			{/foreach}
		</div>
	{/if}
	{if $successArr|@count > 0}
		<div class="alert alert-success">
			{foreach item=v key=k from=$successArr}
				<h4>{$v}</h4>
			{/foreach}
		</div>
	{/if}
	<form action="" method="post" id="form_payments">
		<input type="hidden" name="num_now" id="num_now" value="{$resultArr.user_info.0.paymentsystem}">
		<h3>Payments</h3>
		<div class="tabbable" id="form_payments">
			<ul class="nav nav-tabs" id="myTab">
			
				{foreach item=v key=k from=$resultArr.ps name=resultArr}
					<li {if $resultArr.user_info.0.paymentsystem == $k} class="active"{/if}><a href="#{$v.title}">{$v.title}</a></li>
				{/foreach}
			</ul>
			<div class="tab-content" id="tabs_content">
				{*<pre>{$resultArr|@print_r}</pre>*}
				{foreach item=v key=k from=$resultArr.ps name=resultArr}
					<div class="tab-pane{if $resultArr.user_info.0.paymentsystem == $k} active{/if}" id="{$v.title}">
						<input type="text" class="form-control" name="num[{$k}]" data-num="{$k}">
						{*$v|@print_r*}
						<div class="comission">
							|{$resultArr.ps_info.$k.wmnumber}| Comission: {$v.fee} {if $v.fee_type}${else}%{/if}
						</div>
					</div>
				{/foreach}
			</div>
			<input class="btn" type="submit" name="change_def_pay_system" value="Save default payment system" id="change_def_pay_system">
		</div>
		<div>
			<hr>
			<h3>Min payment sum</h3>
			<input type="text" value="{$resultArr.user_info.0.paymentsum}" placeholder="Min payment sum" name="paymentsum" style="position:relative; top:6px;">
			<br>
			
			<input class="btn" type="submit" name="min_payment_sum_btn" value="Save">
		</div>
		<div>
			<hr>
			<h3>Instant payment</h3>
			<input type="text" value="" placeholder="Sum" name="sum" style="">
			<br>
			<select name="instant_payment">
			{foreach item=v key=k from=$resultArr.ps name=resultArr}
				{if $resultArr.ps_info.$k.wmnumber}
					<option value="{$k}">{$v.title}</option>
				{/if}
			{/foreach}
			</select>
			<br>
			<input class="btn" type="submit" name="instant_payment_btn" value="Pay now">
		</div>
	</form>
	{if $historyArr|@count > 0}
		<div class="payments-history">
			
			<table class="table table-default table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Date</th>
						<th>ID payments</th>
						<th>Data</th>
						<th>Sum</th>
					</tr>
				</thead>
				<tbody>
					{foreach item=v key=k from=$historyArr}
					<tr>
						{assign var=pstmp value=$v.payment_system}
						<td>{$v.paymentdate}</td>
						<td>
							{*$v.payment_system*}
							{$resultArr.ps.$pstmp.title}
						</td>
						<td>{$v.payment_data}</td>
						<td>${$v.paid_sum}</td>
					</tr>
					{/foreach}
				</tbody>
			</table>
		</div>
	{/if}
	{if $total_pages > 0}
		<div class="pagination">
			<ul>
				{section name=cu loop=$total_pages start=0 step=1}
					<li{if $smarty.get.page == $smarty.section.cu.iteration} class="active"{/if}>
						<a href="?p=payments&page={$smarty.section.cu.iteration}">{$smarty.section.cu.iteration}</a>
					</li>
				{/section}
			</ul>
		</div>
	{/if}
	
	
{include file="!footer.tpl"}