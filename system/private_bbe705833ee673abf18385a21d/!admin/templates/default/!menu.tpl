{strip}<li{if $smarty.get.p == 'tree'} class="active"{/if}><a href="?p=tree"><i class="icon-th-list"></i> Tree</a></li>
<li{if $smarty.get.p == 'domains'} class="active"{/if}><a href="?p=domains"><i class="icon-picture"></i> Design</a></li>
<li{if $smarty.get.p == 'update'} class="active"{/if}><a href="?p=update"><i class="icon-download-alt"></i> Update DB</a></li>
<li{if $smarty.get.p == 'discount_generator'} class="active"{/if}><a href="?p=discount_generator"><i class="icon-tags"></i> Coupons</a></li>
<li{if $smarty.get.p == 'settings'} class="active"{/if}><a href="?p=settings"><i class="icon-check"></i> Settings</a></li>
<li{if $smarty.get.p == 'seo'} class="active"{/if}><a href="?p=seo"><i class="icon-flag"></i> SEO</a></li>
<li{if $smarty.get.p == 'proxy'} class="active"{/if}><a href="?p=proxy"><i class="icon-globe"></i> Proxy</a></li>
<li{if $smarty.get.p == 'landing'} class="active"{/if}><a href="?p=landing"><i class="icon-globe"></i> Landing</a></li>{/strip}