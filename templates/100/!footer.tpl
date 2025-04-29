{strip}					</div>
					<div class="clearfix"></div>			
				</div><!-- /#content -->
				<div id="footer">
					<div id="rights">
						
					</div>
					<ul>
						<li class="p1{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'about'} active{/if}"><a href="{$BASE_FOLDER}page/about">{"About us"|mytranslate}</a></li>
						<li class="p2{if $url_arr.folders.0 == 'categories' && $url_arr.folders.1 == 'Bestsellers'} active{/if}"><a href="{$BASE_FOLDER}categories/Bestsellers/all">{"Bestsellers"|mytranslate}</a></li>
						<li class="p3{if $url_arr.folders.0 == 'testimonials'}  active{/if}"><a href="{$BASE_FOLDER}testimonials">{"Testimonials"|mytranslate}</a></li>
						<li class="p4{if $url_arr.folders.0 == 'faq'} active{/if}"><a href="{$BASE_FOLDER}faq">{"FAQ"|mytranslate}</a></li>
						<li class="p5{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'policy'} active{/if}"><a href="{$BASE_FOLDER}page/policy">{"Policy"|mytranslate}</a></li>
						<li class="p6{if $url_arr.folders.0 == 'contact'} active{/if}"><a href="{$BASE_FOLDER}contact">{"Contact us"|mytranslate}</a></li>
					</ul>
					<div class="clearfix"></div>
					<div class="b2footer"></div>
				</div>
			</div><!-- /#main -->
		</div>
		<div class="clearfix"></div>
            {*
			<pre>
			{$smarty.cookies.xspy|base64_decode|json_decode|@print_r}
			</pre>
            *}

		<div class="me">
			<a href="{$BASE_FOLDER}contact?aff">{"Affiliate program"|mytranslate}</a>
		</div>
		<div id="toTop"><div>&uarr;</div></div>
        <div class="phone phone-for-mobile">
					{if $config_array.phone || $config_array.phone}
						<i class="ico"></i>
						<span>{"Toll free number"|mytranslate}:</span>
						<div class="phoneDigits">
							{if $config_array.phone}
							<span>
								<i class="i_u"></i>
								<i class="i_s"></i>
								{$config_array.phone}
							</span>
							{/if}
							{if $config_array.phone2}
							<span>
								<div class="clear"></div>
								<i class="i_u"></i>
								<i class="i_k"></i>
								{$config_array.phone2}
							</span>
							{/if}
						</div>

					{/if}
				</div>
        {include file="./../global/counter.tpl"}
        <div id="toMobileVersion">
			mobile version &rarr;
		</div>
	</body>
</html>{/strip}
<!-- /ok -->