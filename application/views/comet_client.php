<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Test Comet Client</title>

	<script type="text/javascript" src="<?php echo base_url();?>assets/jquery/jquery-1.8.3.js"></script>
</head>
<body>

<h1>Getting server updates</h1>
<div id="result"></div>

<script type="text/javascript">

	function pusher(event) {
		if(typeof(event)==='undefined') { return }
		if (event.data.trim().length<1) { return }
		
		document.getElementById("result").innerHTML=event.data;
	}


	if(typeof(EventSource)!=="undefined"){
		var sse = new EventSource('<?php echo site_url('common_functions/comet_server'); ?>');
		sse.onmessage = pusher;
	} else {
		document.getElementById("result").innerHTML="Sorry, your browser does not support server-sent events...";
	}

</script>

</body>
</html>