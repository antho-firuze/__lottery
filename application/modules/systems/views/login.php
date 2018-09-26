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
			<div id="infoMessage"><?php echo $message;?></div>
			<p class="submit">
				<button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button>
			</p>
		</form>
	</section>
	<div class="strip shado"></div>
    <div class="strip-2">
		<div class="info-heading text-shado"><br /><?php echo $this->session->userdata('app_title');?></div>
		<div class="info-content">
			<br /> © 2013 All Rights Reserved.
			<br /><?php echo $this->db->hostname .' ( '.$this->db->database.' )';?>
		</div>
    </div>
<!--
<div id="container">
	<div id="header">
		<div class="div1">
			<div class="div2"><img src="<?php echo site_url();?>/../assets/images/logo.png" title="Administration" onclick="location = '#'"></div>
		</div>
	</div>
	<div id="content">
		<div class="box" style="width: 400px; min-height: 300px; margin-top: 40px; margin-left: auto; margin-right: auto;">
			<div id="infoMessage"><?php echo $message;?></div>
			<div class="heading">
				<h1><img src="<?php echo site_url();?>/../assets/images/lockscreen.png" alt=""> Please enter your login details.</h1>
			</div>
			
			<div class="content" style="min-height: 150px; overflow: hidden;">
				<?php echo form_open("auth/login");?>
				<table style="width: 100%;">
				<tbody>
					<tr>
						<td style="text-align: center;" rowspan="5"><img src="<?php echo site_url();?>/../assets/images/login.png" alt="Please enter your login details."></td>
					</tr>
					<tr>
						<td><label for="identity">Email/Username:</label><br>
						<?php echo form_input($identity);?>
						<br>
						<br>
						<label for="password">Password:</label><br>
						<?php echo form_input($password);?>
						<br>
						<br>
						<label for="remember">Remember Me:</label>
						<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td><input type="submit" id="login" value="Login" class="button ui-button ui-widget ui-state-default ui-corner-all" role="button" aria-disabled="false"></td>
					</tr>
					<tr>
						<td><a href="forgot_password">Forgot your password?</a></td>
					</tr>
				</tbody></table>
				<?php echo form_close();?>
			</div>
			
		</div>
	</div>
</div>
-->

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
		
		$.vegas({ src: '<?php echo base_url();?>assets/images/background/'+folder+'/'+file+'.jpg', fade:1000 });
		$.vegas('overlay', { src:'<?php echo base_url();?>assets/jquery-vegas/overlays/01.png' });
	}

	$(function(){
		// changeBackground();
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