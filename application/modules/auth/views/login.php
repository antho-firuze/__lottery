<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<title><?php echo $this->session->userdata('app_title');?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/login-style.css">
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery-2.1.1.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery-vegas/jquery.vegas.css" />
	<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-vegas/jquery.vegas.js"></script>
	
</head>
<body>
	<section class="main">
		<form class="form-1" action="<?php echo site_url('auth/login');?>" method="post" accept-charset="utf-8">
			<p class="field">
				<!--
				<input type="text" id="identity" name="identity" placeholder="Username">
				-->
				<?php echo form_input($identity);?>
				<i class="icon-user icon-large"></i>
			</p>
			<p class="field">
				<!--
				<input type="password" name="password" placeholder="Password">
				-->
				<?php echo form_input($password);?>
				<i class="icon-lock icon-large"></i>
			</p>
			<?php if ( $this->config->item('use_captcha', 'ion_auth') ) { ?>
				<center>
				<img src="<?php echo base_url().'captcha/'.$this->session->userdata['image'];?>" width="180" height="50" />
				</center>
				<p class="field">
					<?php echo form_input($captcha);?>
					<i class="icon-lock icon-large"></i>
				</p>
			<?php }?>
			<div id="infoMessage"><?php echo $message;?></div>
			<p class="submit">
				<button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button>
			</p>
		</form>
	</section>
	<div style="top:<?php if ( $this->config->item('use_captcha', 'ion_auth') ) echo '45%'; else echo '35%'; ?>;" class="strip shado"></div>
    <div style="top:<?php if ( $this->config->item('use_captcha', 'ion_auth') ) echo '45%'; else echo '35%'; ?>;" class="strip-2">
		<div class="info-heading text-shado"><br /><?php echo $this->session->userdata('app_title');?></div>
		<div class="info-content">
			<br /> © 2013 All Rights Reserved.
		</div>
    </div>
</body>
<script type="text/javascript"> 
	function changeBackground() {
		var folder = 1 + Math.floor(Math.random() * 2);
		if ( folder==1 )
			var file = 1 + Math.floor(Math.random() * 157);
		else if ( folder==2 )
			var file = 1 + Math.floor(Math.random() * 153);
		else if ( folder==3 )
			var file = 1 + Math.floor(Math.random() * 41);
		
		// $.vegas({ src: '<?php echo base_url();?>assets/images/background/'+folder+'/'+file+'.jpg', fade:1000 });
		// $.vegas({ src: '<?php echo base_url();?>assets/images/background/background-01-bj.jpg', fade:1000 });
		$.vegas({ src: '<?php echo base_url();?>assets/images/background/background-01-xyz.jpg', fade:1000 });
		$.vegas('overlay', { src:'<?php echo base_url();?>assets/jquery-vegas/overlays/01.png' });
	}

	$(function(){
		changeBackground();
		/* setInterval(function() {
			changeBackground();
		}, 5000);  */
	})
	
	$('#form input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form').submit();
		}
	});
</script> 
</html>