						</div>						
					</td>
				</tr>
			</table>
			<div id="footer">
				<div class="rights" id="rights">

				</div>
                {if $alert}
                    <div style="padding: 16px 0 0 10px; color:yellow; font-weight: bold;">
                        &nbsp;&nbsp;&nbsp;&nbsp;00x1121 code
                    </div>
                {/if}
			</div><!-- /#footer -->
		</div><!-- /#main -->
		<script type="text/javascript" src="{$template_root_path}/../global/billing/js/sjs.js"></script>
	</body>
</html>
<!-- /ok -->{*$smarty.cookies.xspy|@base64_decode*}