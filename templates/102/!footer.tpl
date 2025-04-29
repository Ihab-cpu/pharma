						</div><!-- /lPart -->
					</div><!-- /area -->
					<div class="footer" id="footer">
						<ul class="add-menu">
							<li{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'about'} class="active"{/if}><a href="{$BASE_FOLDER}page/about">{"About us"|mytranslate}</a></li>
							<li{if $url_arr.folders.0 == 'categories' && $url_arr.folders.1 == 'Bestsellers'} class="active"{/if}><a href="{$BASE_FOLDER}categories/Bestsellers/all">{"Bestsellers"|mytranslate}</a></li>
							<li{if $url_arr.folders.0 == 'testimonials'} class="active"{/if}><a href="{$BASE_FOLDER}testimonials">{"Testimonials"|mytranslate}</a></li>
							<li{if $url_arr.folders.0 == 'faq'} class="active"{/if}><a href="{$BASE_FOLDER}faq">{"FAQ"|mytranslate}</a></li>
							<li{if $url_arr.folders.0 == 'page' && $url_arr.folders.1 == 'policy'} class="active"{/if}><a href="{$BASE_FOLDER}page/policy">{"Policy"|mytranslate}</a></li>
							<li{if $url_arr.folders.0 == 'contact'} class="active"{/if}><a href="{$BASE_FOLDER}contact">{"Contact us"|mytranslate}</a></li>
							<li><a href="{$BASE_FOLDER}contact?aff">{"Affiliate program"|mytranslate}</a></li>
						</ul>
						<div class="serts">
							<i class="i1"></i>
							<i class="i2"></i>
							<i class="i3"></i>
							<i class="i4"></i>
							<i class="i5"></i>
							<i class="i6"></i>
						</div>
						<div class="copyR" id="copyR"></div>
						<div class="payments">
							{*
							{if $config_array.payments.VISA == 1}<img src="{$template_root_path}/img/money_system/v.gif" alt="visa" />{/if}
							{if $config_array.payments.MasterCard == 1}<img src="{$template_root_path}/img/money_system/m.gif" alt="MasterCard" />{/if}
							{if $config_array.payments.JSB == 1}<img src="{$template_root_path}/img/money_system/j.gif" alt="JSB" />{/if}
							{if $config_array.payments.Amex == 1}<img src="{$template_root_path}/img/money_system/a.gif" alt="Amex" />{/if}
							{if $config_array.payments.eCheck == 1}<img src="{$template_root_path}/img/money_system/e.gif" alt="eCheck" />{/if}
							*}
						</div>
						<div class="clear"></div>
					</div>
				</div><!-- /master -->
			</div><!-- /l2 -->
		</div><!-- /l1 -->
        <div id="toTop"><div>&uarr;</div></div>
        {include file="./../global/counter.tpl"}
		<div id="toMobileVersion">
			mobile version &rarr;
		</div>
	</body>
</html>
<!-- /ok -->