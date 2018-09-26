<div id="startbar">
	<div style="padding-left:15px">
		<div id="tray_icon_acc" style="border-left: 1px solid #bac0cd;" class="icon-setting startbar_button bar_left" title="&nbsp;<?php echo strtoupper($this->session->userdata('identity')); ?>&nbsp;&nbsp;&nbsp;"></div>
		<div id="tray_icon_db" class="icon-server startbar_button bar_right" title="&nbsp;<?php echo $this->db->hostname .' ( '.$this->db->database.' )';?>&nbsp;&nbsp;&nbsp;"></div>
	</div>
</div>

<div id="dlg_acc" class="tray" style="padding:5px;display:none;left:14px;">
	<div class="traytitle">
		<div class="traytab">Application</div>
	</div>

	<div id="traycontent">
		<img src="<?php echo base_url();?>assets/images/no_photo.jpg" width="103" height="122">
		<div class="info">
			<?php echo strtoupper($this->session->userdata('identity')); ?>
		</div>		
	</div>
	<div class="traybottom">
		<div style="padding-right:10px; float:right;">
			<a href="<?php echo site_url('systems/logout');?>" class="easyui-linkbutton">Logout</a>
		</div>
	</div>
</div> 

<div id="dlg_conn" class="tray" style="padding:5px;display:none;right:1px;">
	<div class="traytitle">
		<div class="traytab">Connection Info</div>
	</div>

	<div id="traycontent">
		<div class="info">
			Server&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $this->db->hostname ?> <br>
			Database: <?php echo $this->db->database ?> <br><br>
			@ Copyright 2012
		</div>		
	</div>
</div> 

<script>
	$("#tray_icon_acc").click(function(){
		if ( $("#dlg_acc").is(":hidden") )
			$("#dlg_acc").slideToggle("slow");
		else
			$("#dlg_acc").slideToggle("slow");
	});

	$("#tray_icon_db").click(function(){
		if ( $("#dlg_conn").is(":hidden") )
			$("#dlg_conn").slideToggle("slow");
		else
			$("#dlg_conn").slideToggle("slow");
	});
	
	var i = 0;
	$(function(){
		var dlg = $("#dlg_conn");
		var ico = $("#tray_icon_db");
		// ico.hover(function(e){
			// dlg.slideToggle("slow");
		// }, function(){ // Hover off event
			// dlg.slideToggle("slow");
		// });
		ico.mouseleave(function(){
			dlg.slideUp("slow");
		});
		dlg.mouseleave(function(){
			dlg.slideUp("slow");
		});
	});

</script>