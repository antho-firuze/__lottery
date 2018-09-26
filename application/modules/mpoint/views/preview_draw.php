<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<title>:: LOTTERY-DRAW ::</title>
	<!--
	<meta http-equiv="refresh" content="5">
	-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/login-style.css">
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery-1.8.2.min.js"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/jquery-vegas/jquery.vegas.css" />
	<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-vegas/jquery.vegas.js"></script>
	
<style>
	table.draw,table.draw thead,table.draw th,table.draw tbody,table.draw td { 
		text-align: center;
		border: 1px solid #ccc;
		border-collapse: collapse;
	}
	table.draw {
		border-collapse: collapse;
	}

	table.draw th,table.draw td {
		padding: 0.4em;
	}

	table.draw th {
		// width: 100px;
		padding: 10px;
		font-size: 12px;
		font-weight: normal;
		color: #FFFFFF;
		background-color: #990000;
	}

	table.draw td {
		// width: 125px;
		padding: 7px;
		font-size: 12px;
		font-weight: bold;
		background-color: #FFFFFF;
	}
	table.draw .nowrap {
		white-space: nowrap;
	}
</style>
</head>
<body>

<div style="position:relative;top:100px;" align="center">
	<table class="draw" width="1024px" border="0">
	  <tr>
		<th style="padding:15px" colspan="7"><h1>PROGRAM : <?php echo $this->session->userdata('period_name');?> - PERIODE : <?php echo $this->session->userdata('phase_name');?></h1></th>
	  </tr>
	  <tr>
		<th width="25"><h2>NO</h2></th>
		<th width="300"><h2>PRIZE</h2></th>
		<th width="200"><h2>MEMBER CODE</h2></th>
		<th width="250"><h2>MEMBER NAME</h2></th>
		<th width="200"><h2>IDENTITY NO</h2></th>
		<th width="150"><h2>COUPON NO</h2></th>
		<th width="140"><h2>STATUS</h2></th>
	  </tr>
	  <?php 
		$qry = $this->db->get_where('vlot_draw', array('period_id'=>$this->session->userdata('period_id'), 'show_screen'=>1));
		if ( $qry->num_rows > 0 ) {
			$i = 1;
			foreach ($qry->result() as $row) {
				$name = strtoupper($row->full_name);
				echo "<tr>";
				echo "<td style='text-align:right;'><h3>$i</h3></td>";
				echo "<td class='nowrap' style='text-align:left;'><h3>$row->prize_name</h3></td>";
				echo "<td style='font-size:15pt; font-weight:bold;'><h3>$row->member_code</h3></td>";
				echo "<td class='nowrap' style='text-align:left;'><h3>$name</h3></td>";
				echo "<td><h3>$row->identity_no</h3></td>";
				echo "<td><h3>$row->coupon_no</h3></td>";
				echo "<td style='color:$row->color' class='nowrap'><h3>$row->status_name</h3></td>";
				echo "</tr>";
			}
		}
	  ?>
	</table>
</div>
	
</body>

<script type="text/javascript"> 
	function changeBackground() {
		// var folder = 1 + Math.floor(Math.random() * 2);
		// if ( folder==1 )
			// var file = 1 + Math.floor(Math.random() * 157);
		// else if ( folder==2 )
			// var file = 1 + Math.floor(Math.random() * 153);
		// else if ( folder==3 )
			// var file = 1 + Math.floor(Math.random() * 41);
		
		// $.vegas({ src: '<?php echo base_url();?>assets/images/background/'+folder+'/'+file+'.jpg', fade:1000 });
		$.vegas({ src: '<?php echo base_url();?>assets/images/background/Gedung BJ (1024x786).jpg', fade:1000 });
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

<script type="text/javascript"> 

	var sse = new EventSource('<?php echo site_url('common_functions/comet_server'); ?>');
	sse.onmessage = pusher;
	
	// This function will be called every time the server pushes a new event.
	function pusher(event) {
		if(typeof(event)==='undefined') { return }
		if (event.data.trim().length<1) { return }
		
		var data = event.data.trim();
		if (data == 'phd_header') {
			goFilter();
		} else 
		if (data == 'phd_detail') {
			goFilter();
		} else 
		if (data == 'phd_files') {
			$('#grid3').datagrid('reload');      
		} else 
		if (data == 'suppliers') {
			$('#supplier_id').combogrid('reload');
		} else 
		if (data == 'measure') {
			$('#measure_id').combogrid('reload');
		} 
	}
	
</script>

</html>