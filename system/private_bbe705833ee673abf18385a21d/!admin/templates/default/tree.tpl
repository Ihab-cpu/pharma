{include file="!header.tpl"}
<!-- Modal -->
	<form action="" method="post" id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-header" id="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="myModalLabel">Modal header</h3>
		</div>
		<div class="modal-body" id="modal-body">
			<input type="hidden" name="p" value="{$smarty.get.p|escape}">
			<input type="hidden" name="pill_name" id="pill_name" value="">
			<div class="tabbable">
				<ul class="nav nav-tabs">
					<li  class="active"><a href="#tabEn" data-toggle="tab">En</a></li>
					<li><a href="#tabDe" data-toggle="tab">De</a></li>
					<li><a href="#tabFr" data-toggle="tab">Fr</a></li>
					<li><a href="#tabIt" data-toggle="tab">It</a></li>
					<li><a href="#tabEs" data-toggle="tab">Es</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tabEn">
						<h4>Small description</h4>
						<div>
							<textarea class="redactor" cols="20" rows="7" name="small_description_en" id="small_description_en"></textarea>
						</div>
						<hr>
						<h4>Full description</h4>
						<div>
							<textarea class="redactor" cols="20" rows="7" name="full_description_en" id="full_description_en"></textarea>
						</div>
					</div>
					<div class="tab-pane" id="tabDe">
						<h4>Small description</h4>
						<div>
							<textarea class="redactor" cols="20" rows="7" name="small_description_de" id="small_description_de"></textarea>
						</div>
						<hr>
						<h4>Full description</h4>
						<div>
							<textarea class="redactor" cols="20" rows="7" name="full_description_de" id="full_description_de"></textarea>
						</div>
					</div>
					<div class="tab-pane" id="tabFr">
						<h4>Small description</h4>
						<div>
							<textarea class="redactor" cols="20" rows="7" name="small_description_fr" id="small_description_fr"></textarea>
						</div>
						<hr>
						<h4>Full description</h4>
						<div>
							<textarea class="redactor" cols="20" rows="7" name="full_description_fr" id="full_description_fr"></textarea>
						</div>
					</div>
					<div class="tab-pane" id="tabIt">
						<h4>Small description</h4>
						<div>
							<textarea class="redactor" cols="20" rows="7" name="small_description_it" id="small_description_it"></textarea>
						</div>
						<hr>
						<h4>Full description</h4>
						<div>
							<textarea class="redactor" cols="20" rows="7" name="full_description_it" id="full_description_it"></textarea>
						</div>
					</div>
					<div class="tab-pane" id="tabEs">
						<h4>Small description</h4>
						<div>
							<textarea class="redactor" cols="20" rows="7" name="small_description_es" id="small_description_es"></textarea>
						</div>
						<hr>
						<h4>Full description</h4>
						<div>
							<textarea class="redactor" cols="20" rows="7" name="full_description_es" id="full_description_es"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer" id="modal-footer">
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			<button id="save" class="btn btn-primary">Save changes</button>
		</div>
	</form>
	<hr>
	{if $result_arr|@count > 0}
	<div class="row">
		<div class="span9">
			<ul class="tree tree_list">
				{foreach item=v key=k from=$result_arr}
					<li class="li-{$k|replace:' ':''|strtolower}">
						<h5>{$k}</h5>
						<ul style="list-style:none;">
						{foreach item=v2 key=k2 from=$v}
							<li{if isset($off_arr.$k2)} class="off_drug"{/if} data-category="{$k}">
								<a class="visible" href="?p=tree&visible={$k2}" data-text="{$k2}">
									<i class="ico {if isset($off_arr.$k2)}icon-eye-close{else}ico icon-eye-open{/if}"></i>
								</a>
								<a class="edit" href="?p=tree&edit={$k2}" title="Edit description">
									<i class="ico icon-edit"></i>
								</a>
								<a class="bestseller {if !$result_arr.Bestsellers.$k2}off{/if}" href="?p=tree&bestseller={$k2}&category={$k}{if $tree_pills_arr_old.Bestsellers.$k2}&danger=1{/if}" title="Bestseller">
									<i style="color: green" class="ico icon-star{if !$result_arr.Bestsellers.$k2}-empty{/if}"></i>
								</a>
								<a class="up" href="?p=tree&for={$k}&up={$k2}" title="Up">
									<i class="ico icon-arrow-up"></i>
								</a>
								<a class="down" href="?p=tree&for={$k}&down={$k2}" title="Down">
									<i class="ico icon-arrow-down"></i>
								</a>

								{$k2}
								<div class="clearfix"></div>
							</li>
						{/foreach}
						</ul>
					</li>
				{/foreach}
			</ul>
		</div>
		<div class="span3">
			<p>
				Click to <i class="icon-eye-open"></i> for disable goods
				<br>
				Click to <i class="icon-edit"></i> for edit description
				<br>
				Click to <i class="icon-star-empty"></i> for adding to Bestsellers
				<br>
				Click to <i class="icon-star"></i> for remove from Bestsellers
			</p>
		</div>
		</div>
	{else}
		<!--div class="alert alert-block">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4>No data base!</h4>
			<br>
			<a href="?p=update">Update the shop &rarr;</a>
		</div-->
		{if !$config_array.db_ver}
			<div class="alert alert-error">
				<h3>This section is not available</h3>
				<p>please install database first</p>
				<p><a href="?p=update">Update the shop &rarr;</p>
			</div>
		{/if}
	{/if}
<link rel="stylesheet" href="{$template_root_path}/js/redactor-js-master/redactor/redactor.css" />
<script src="{$template_root_path}/js/redactor-js-master/redactor/redactor.min.js"></script>
<div class="modal-backdrop">
	<img src="{$template_root_path}/img/ajax_loader.gif" id="ajaxer">
</div>
{include file="!footer.tpl"}