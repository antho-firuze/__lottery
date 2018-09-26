<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
	<form id="forms3" method="post">
	<table>
		<tr>
			<td><label for="fine-uploader">Filename</label></td>  <td>:</td>	<td><input type="file" id="userfile" name="userfile" /></div></td>
		</tr>
		<tr>
			<td><label for="note3">Note</label></td>  <td>:</td>	<td><textarea class="easyui-validatebox" id="note3" name="note3" style="border:1px solid #ccc; height:50px; width:250px;"></textarea></td>
		</tr>
	</table>
	<input type="submit" id="savedata" value="Save">
	<input type="reset" id="resetdata" value="Reset">
	</form>

<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>assets/jquery/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/AjaxFileUploader/ajaxfileupload.js"></script>
<script>
	$('#savedata').click(function(){
		fileUpload();
		return false;  
	});
	
	function fileUpload() {
		// $("#loading").ajaxStart(function(){
			// $(this).show();
		// }).ajaxComplete(function(){
			// $(this).hide();
		// });

		$.ajaxFileUpload({
			url: '<?php echo site_url('welcome/uploader')?>',
			secureuri: false,
			fileElementId: 'userfile',
			dataType: 'json',
			/* data: { 
				id: "id_1", 
				phd_id: "phd_id_1", 
				note : $('#note3').val() 
			}, */
			success: function (data, status){
				if(typeof(data.error) != 'undefined')
                    {
                        if(data.error != '')
                        {
                            alert(data.error);
                        }else
                        {
                            alert(data.msg);
                        }
                    }				alert(result);
				// var result = eval('('+result+')');  
				// if (result.errorMsg){  
					// alert(result.errorMsg);
				// } else {  
					// alert("success !");
				// }  
			},
			error: function(data, status, e){
				alert(e);
			} 
		})
		return false;
	}
	
</script>
</body>
</html>