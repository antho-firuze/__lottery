<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<title>:: LOTTERY-WINNER ::</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/login-style.css">
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery-1.8.2.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery-vegas/jquery.vegas.css" />
	<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-vegas/jquery.vegas.js"></script>
	
</head>
<body>
	
	<table>
		<tr>
			<td colspan=6>PERIODE</td>
		</tr>
		<tr>
			<td>NO</td>
			<td>PRIZE</td>
			<td>IDENTITY NO</td>
			<td>MEMBER NAME</td>
			<td>COUPON NO</td>
			<td>STATUS</td>
		</tr>
	</table>

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
		setInterval(function() {
			changeBackground();
		}, 5000); 
	})
	
	$('#form input').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#form').submit();
		}
	});
</script> 
</html>