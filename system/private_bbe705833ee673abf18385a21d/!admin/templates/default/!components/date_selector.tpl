<!-- ### BEGIN DATE SELECTOR -->
<form action="" class="datePicker">
	
	<input type="hidden" value="{$smarty.get.p|escape}" name="p">
	<input type="hidden" value="{$smarty.get.type|escape}" name="type">
	<table>
		<tr>
			<td>
				<div class="input-prepend">
					<span class="add-on">From</span>
					<input class="span8" type="text" value="{if !$smarty.get.date_start}{$date_start}{else}{$smarty.get.date_start|escape}{/if}" name="date_start" id="date_from">
				</div>
			</td>
			<td>
				<div class="input-prepend">
					<span class="add-on">To</span>
					<input class="span8" type="text"  value="{if !$smarty.get.date_end}{$date_end}{else}{$smarty.get.date_end|escape}{/if}" name="date_end" id="date_to">
				</div>
			</td>
			<td>OR</td>
			<td>
				<div class="input-prepend">
				<select name="diapazon" style="margin: 0 20px 0 40px; width: 145px" id="diapazon">
					<option value="">(select one)</option>
					<option value="d1">Last 2 day</option>
					<option value="d7">Last 7 day</option>
					<option value="m1">Last month</option>
				</select>
				</div>
			</td>
			<td>
				<div class="input-prepend">
				<input type="submit" value="Search"  class="btn" >
				</div>
			</td>
			
		</tr>
	</table>
</form>
