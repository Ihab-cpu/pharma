<?php /* Smarty version 2.6.30, created on 2025-04-20 17:02:07
         compiled from landing.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	
<div class="row-fluid">
	<?php if (! $this->_tpl_vars['config_array']['db_ver']): ?>
		<div class="alert alert-error">
			<b>Please go to the &laquo;<a href="?p=update">Update DB</a>&raquo; section and click the "Install Update" button. Your shop will be active then.</b>
		</div>
	<?php endif; ?>
	<h2>Easy use with JS</h2>
	<p>Adaptive landing</p>
	<pre>&lt;script type="text/javascript" src="http://<?php echo $_SERVER['HTTP_HOST']; ?>
/categories/Bestsellers/<?php echo $this->_tpl_vars['config_array']['pill_prefix']; ?>
Viagra<?php echo $this->_tpl_vars['config_array']['pill_postfix']; ?>
?landing=1&language=en&maxwidth=900&fulldescr=1"&gt;&lt;/script&gt;</pre>
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
				<script type="text/javascript" src="/categories/Bestsellers/<?php echo $this->_tpl_vars['config_array']['pill_prefix']; ?>
Viagra<?php echo $this->_tpl_vars['config_array']['pill_postfix']; ?>
?landing=1&language=en&fulldescr=1"></script>
			</td>
			</td>
		</tr>

	</table>
</div><!--/row-->

	
	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "!footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>