{include file="!header.tpl"}
	Progress = <span id="progress">0</span>;
	 {literal}
	<script type="text/javascript">
	function checkFileUploadProgress(path_file, total_size) {
		$.get('upload_progress.php?path_file=' + path_file, function( data ) {
		  $( "#progress" ).html( data );
  		  
		  });
		//$('#progress').html('123');
		return false;
	}
		$(document).ready(function(){
			
			
			a = setInterval("checkFileUploadProgress('./../db/update/update_answer_from_server.php',1);", 1300);
			
		});
	</script>
	{/literal}
{include file="!footer.tpl"}