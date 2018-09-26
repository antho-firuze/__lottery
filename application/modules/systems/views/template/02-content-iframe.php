<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->load->view('template/00-import');?>
	<?php $this->load->view('template/00-import-jquery-easyui');?>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/template.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/dhtmlxMessage/themes/message_skyblue.css">
	<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>assets/dhtmlxMessage/dhtmlxmessage.js"></script>
</head>
<body>
	<?php //echo $is_form; ?>
	<?php if ( !$is_form && !empty($title) ) { ?>
		<div id="header">
			<header class="header">
				<div class="container-fluid">
					<h1 class="page-title"><?php echo $title; ?></h1>
				</div>
			</header>
		</div> <!-- end of header bar -->
	<?php } ?>
	
	<div id="content" class="column">
	
		<?php echo $this->load->view($page_link); ?>
		
	</div>
	
</body>
</html>