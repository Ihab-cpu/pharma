						</div>						
					</td>
				</tr>
			</table>
			<div id="footer">
				<div class="rights" id="rights">
					
				</div>
				<ul class="mainMenu2">
					<li{if $url_arr.folders.0 == 'contact'} class="active"{/if}><a href="{$BASE_FOLDER}contact">{"Contact us"|mytranslate}</a></li>
					<li{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'policy'} class="active"{/if}><a href="{$BASE_FOLDER}page/policy">{"Policy"|mytranslate}</a></li>
					<li{if $url_arr.folders.0 == 'faq'} class="active"{/if}><a href="{$BASE_FOLDER}faq">{"FAQ"|mytranslate}</a></li>
					<li{if $url_arr.folders.0 == 'testimonials'} class="active"{/if}><a href="{$BASE_FOLDER}testimonials">{"Testimonials"|mytranslate}</a></li>
					<li{if $url_arr.folders.0 == 'categories' && $url_arr.folders.1 == 'Bestsellers'} class="active"{/if}><a href="{$BASE_FOLDER}categories/Bestsellers/all">{"Bestsellers"|mytranslate}</a></li>
					<li{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'about'} class="active"{/if}><a href="{$BASE_FOLDER}page/about">{"About us"|mytranslate}</a></li>
				</ul>
				<div class="me">
					<a href="{$BASE_FOLDER}contact?aff">{"Affiliate program"|mytranslate}</a>
				</div>
                <i class="clear"></i>
			</div><!-- /#footer -->
		</div><!-- /#main -->
		</div><!-- /.master -->
        <div id="toTop"><div>&uarr;</div></div>
						<div class="phones phone-for-mobile">
							{if $config_array.phone || $config_array.phone2}
								<i class="ico"></i>
								<div class="phoneDigits">
									{if $config_array.phone}
										<div>
											{$config_array.phone}
										</div>
									{/if}
									{if $config_array.phone2}
										<div>
											{$config_array.phone2}
										</div>
									{/if}
								</div>
							{/if}
						</div>
        {include file="./../global/counter.tpl"}
		</div><!-- /#father -->
		<div id="toMobileVersion">
			mobile version &rarr;
		</div>
	</body>
</html>
<!-- /ok -->
