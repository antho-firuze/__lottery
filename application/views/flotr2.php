<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Test Comet Client</title>

	<!-- load jquery ui css theme -->
    <link type="text/css" href="<?php echo base_url();?>assets/jquery-sDashboard/css/jquery-ui.css" rel="stylesheet" />

	<!-- load gitter css -->
	<link href="<?php echo base_url();?>assets/jquery-sDashboard/css/gitter/css/jquery.gritter.css" rel="stylesheet">

	<!-- load the sDashboard css -->
    <link href="<?php echo base_url();?>assets/jquery-sDashboard/sDashboard.css" rel="stylesheet">

    <!-- load jquery library -->
    <script src="<?php echo base_url();?>assets/jquery/jquery.min.js" type="text/javascript"></script>
	<!--
    <script src="<?php echo base_url();?>assets/jquery-sDashboard/libs/jquery/jquery-1.8.2.js" type="text/javascript"></script>
	-->
	
    <!-- load jquery ui library -->
    <script src="<?php echo base_url();?>assets/jquery-sDashboard/libs/jquery/jquery-ui.js" type="text/javascript"></script>

	<!-- load touch punch library to enable dragging on touch based devices -->
	<script src="<?php echo base_url();?>assets/jquery-sDashboard/libs/touchpunch/jquery.ui.touch-punch.js" type="text/javascript"> </script>

	<!-- load gitter notification library -->	
	<script src="<?php echo base_url();?>assets/jquery-sDashboard/libs/gitter/jquery.gritter.js" type="text/javascript"> </script>		
	
    <!-- load datatables library -->
    <script src="<?php echo base_url();?>assets/jquery-sDashboard/libs/datatables/jquery.dataTables.js"></script>

    <!-- load flot charting library -->
    <script src="<?php echo base_url();?>assets/jquery-sDashboard/libs/flotr2/flotr2.js" type="text/javascript"></script>

    <!-- load sDashboard library -->
    <script src="<?php echo base_url();?>assets/jquery-sDashboard/jquery-sDashboard.js" type="text/javascript"></script>

</head>
<style>
.chart123{
width:300px;
    height:300px;
}  

.container{
width:300px;
    height:300px;
    display: block;
}</style>
<body>

<h1>FLOTR2</h1>

<div class="chart123"></div>

<script type="text/javascript">

    var chartContainer = $("<div/>").addClass("container");

    var chart = $(".chart123");
    chart.append(chartContainer);	
	
	var pieChartOptions = {
		HtmlText : false,
		grid : {
			verticalLines : false,
			horizontalLines : false
		},
		xaxis : {
			showLabels : false
		},
		yaxis : {
			showLabels : false
		},
		pie : {
			show : true,
			explode : 6
		},
		mouse : {
			track : true
		},
		legend : {
			position : "se",
			backgroundColor : "#D2E8FF"
		}
	};

	$(function() {

		// var f = null;
		$.getJSON('<?php echo site_url('common_functions/dashboard_total_phd_all')?>', function(data) {
			f = Flotr.draw(chartContainer[0], data, pieChartOptions);
			console.log(data);
		});
	});

</script>

</body>
</html>