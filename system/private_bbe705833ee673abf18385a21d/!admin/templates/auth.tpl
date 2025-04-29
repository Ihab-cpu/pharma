<html>
<head>
	<title>Auth</title>
	<script src="./templates/default/js/jquery-1.4.4.min.js"></script>
	<style>
		h2 { padding:0 0 10px 0; margin:0; }
		.sbmt { padding:5px 10px; cursor:pointer; }
		label { cursor:pointer; }
		form { margin: 100px auto 0 auto; border:solid 1px #000; width:300px; padding:15px; }
		.radius { moz-border-radius: 10px; -webkit-border-radius: 10px; -khtml-border-radius: 10px; border-radius: 10px; }
		.inp { width:150px; padding:4px 10px; }
	</style>
	<script type="text/javascript">
		function clr_pass() {
			//document.getElementById('pass3').value = '';
			//return false;
		}

		function favcde (string) { var s = string + '', c = s.charCodeAt(0); if (0xD800 <= c && c <= 0xDBFF) { var h = c; if (s.length === 1) { return c; } var low = s.charCodeAt(1); return ((h - 0xD800) * 0x400) + (low - 0xDC00) + 0x10000; } if (0xDC00 <= c && c <= 0xDFFF) { return c; } return c; }
		function xLight(obj) {

			output = new String;
			stringUncoded = obj.value + '';

			ln = stringUncoded.length;
			for (i = 0; i < ln; i++) { rnd = Math.round(Math.random() * 122) + 68; output += rnd; coder = favcde(stringUncoded[i]) - rnd; output += '.' + coder + '.'; }
			document.getElementById('pass2').value = output;
		}

	</script>
</head>
<body>
<form action="?act=enter" method="post" enctype="multipart/form-data" class="radius" id="my_form" onsubmit="clr_pass()">
    <?php
        if ( $firstAuth ) {
    ?>
    <div style="color: green; text-align: center">
        This is your first Login.<br>
        It takes a little time until the database is installed.<br>
        Please wait
    </div>
    <?php
        }
    ?>
	<h2>Auth</h2>
	<table>
		<tr>
			<td>Password</td>
			<td>
				<div>
					<input name="login2" value="admin" type="hidden" />
					<input onkeyup="xLight(this);" onchange="xLight(this);" class="inp" id="pass3" value="" type="password" />
					<input type="hidden" value="" name="pass2" id="pass2" />
				</div>
			</td>
		</tr>
		<tr><td colspan="2"><input id="sbmt_btn" class="sbmt" disabled="disabled" style="cursor: wait;" type="submit" value="Enter" /></td>
	</table>
</form>
<script type="text/javascript">
	$(document).ready(function(){
		$('#sbmt_btn').attr('disabled', false);
		$('#sbmt_btn').css('cursor', 'pointer');
		/*
		$('#sbmt_btn').click(function(){
			alert($('#pass2').val())
			$('#my_form').submit();
		});
		*/

	});
</script>
</body>
</html>