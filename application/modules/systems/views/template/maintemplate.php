<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $this->session->userdata('app_title');?></title>
	<link rel="Shortcut Icon" type="image/ico" href="<?php echo base_url();?>assets/images/favicon.ico" />

	<?php $this->load->view('template/00-import');?>
	<?php $this->load->view('template/00-import-jquery-easyui');?>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/template.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/dhtmlxMessage/themes/message_skyblue.css">
	<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>assets/dhtmlxMessage/dhtmlxmessage.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url()?>assets/jquery-FileDownload/jquery.fileDownload.js"></script>
</head>
<style>
	#content { width:100%; position:relative; margin-top:32px }
	.label		{width:170px;}
	.label_col1		{width:100px;vertical-align:text-top;}
	.label_col2		{padding-left:10px; width:100px;vertical-align:text-top;}
	.progress_bar {
		background: url("<?php echo base_url()?>assets/images/animated-overlay.gif");
		height: 100%;
		opacity: 0.25;
		}
</style>
<body>
	<div id="container">
	
		<?php $this->load->view('template/01-menu'); ?>
		
		<iframe id="content" name="content" src="about:blank" frameborder="0" scrolling="no"></iframe>
		
		<?php $this->load->view('template/04-footer'); ?>
		
	</div> <!-- end of container -->
	<div id="bottom"></div>
</body>
<script>

	function resize_content()
	{
		var ll = $("#content");
		ll.height($(window).height()-62);
		// ll.layout('resize');
	}
	
	$(function(){
		resize_content();
		$(window).resize(resize_content);
	});
	
	$(function(){
		$('#content').load(function(){ 
			$.post("<?php echo site_url('systems/get_login');?>", function(result) {
				result = eval('('+result+')');
				if (result.login==0)
					window.location.href = "<?php echo site_url('main/home');?>";
			});
		});
		
		<?php  if ( empty($is_form) ) { ?>
			top.frames['content'].location = '<?php	echo site_url($this->session->userdata('last_url'));?>';
		<?php } ?>
		
	});
	
</script>
</html>