var result_str = '';

{foreach item=v key=k from=$result_arr name=my_result_foreach}
	result_str += '<div class="e"><div class="q">{$v.0}</div><div class="a">{$v.1}</div></div>'
	{if $smarty.foreach.my_result_foreach.iteration != $smarty.foreach.my_result_foreach.last}
	,
	{/if}
{/foreach};
 
{literal}
$('document').ready(function(){
	$('#list_type_1').html(result_str);
});
{/literal}