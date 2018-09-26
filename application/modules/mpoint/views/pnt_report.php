<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/dhtmlxMessage/themes/message_skyblue.css">
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>assets/dhtmlxMessage/dhtmlxmessage.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-easyui/jquery.easyui.min.js"></script>
	
<div id="dlg_pnt_report" class="easyui-dialog" style="padding:5px" data-options="width:450, height:500, closed:true, cache:false, modal:true">
	<form id="form_pnt_report" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="REPORTS" style="padding:8px">
			<table style="width:100%;height:100%">
			<tr>
				<td colspan="5">
				<fieldset>
					<legend>Output Type :</legend>
					<label><input type="radio" name="output_type" value="1" id="output_type_1" checked>XLS</label>
					<!--
					<label><input type="radio" name="output_type" value="2" id="output_type_2">PDF</label>
					-->
				</fieldset>
				</td>
			</tr>
			<tr>
				<td colspan="5">
				<fieldset>
					<legend>Type :</legend>
					<label><input type="radio" name="report_type" value="1" id="report_type_1" checked>Transaction By Customer</label><br>
					<label><input type="radio" name="report_type" value="2" id="report_type_2">Transaction By Proffesion</label><br>
					<label><input type="radio" name="report_type" value="3" id="report_type_3">Transaction By Age</label><br>
					<label><input type="radio" name="report_type" value="4" id="report_type_4">Transaction By Payment Type</label><br>
					<label><input type="radio" name="report_type" value="5" id="report_type_5">Transaction By Store</label><br>
					<label><input type="radio" name="report_type" value="6" id="report_type_6">Transaction By Value</label>
				</fieldset>
				</td>
			</tr>
			<tr>
				<td class="label_col1"><label for="period_id">Period</label></td>		
				<td><input class="easyui-combogrid" id="period_id" name="period_id" style="width:228px" data-options="
					url:'<?php echo site_url('mpoint/pnt_period/r');?>',
					required:true, panelWidth:350, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
					pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:false, multiple: false,
					columns: [[
						// {field:'code',title:'CODE',width:50,sortable:true},
						{field:'name',title:'NAME',width:250,sortable:true},
						{field:'id'	 ,title:'ID',width:50,sortable:true}
					]]" /></td>
			</tr>
			<tr>
				<td class="label_col1"><label for="option">Option</label></td>		
				<td><select class="easyui-combobox" id="option" name="option" style="width:228px;" data-options="editable:false,panelHeight:'100'">
					<option value="10">TOP 10</option>
					<option value="20">TOP 20</option>
					<option value="50">TOP 50</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="5"><br><hr><a href="#" onclick="crud_report('1');" class="easyui-linkbutton" data-options="iconCls:'icon-ok'">OK</a></td>
			</tr>
			</table>
		</div>
	</div>
	</form>
</div>

<div id="dlg_progress" class="easyui-dialog" style="padding:5px" data-options="width:400, height:100, closed:true, cache:false, modal:true">
	 We are preparing your report, please wait...
	<div class="progress_bar" style="width: 100%; height:22px; margin-top: 20px;"></div>
</div>

<script type="text/javascript"> 
	var url;

	$(document).on("keydown", function(e){ 
		switch(e.keyCode){
			case 27:	// esc
				$('#dlg_pnt_report').dialog('close');
				break;
		}
	});
		
	// NEXT TO LOAD (THIS VALUE CAN BE CHANGE)
	$(function(){
		$('#dlg_pnt_report').dialog({
			buttons: [/* {
				text:'<?php echo l('form_btn_ok');?>',
				iconCls:'icon-ok',
				handler:function(){	btn_report(); }
			}, */{
				text:'<?php echo l('form_btn_cancel');?>',
				iconCls:'icon-cancel',
				handler:function(){	$('#dlg_pnt_report').dialog('close'); }
			}]
		}).dialog('open').dialog('setTitle',"<?php echo l('form_report');?>");
	});
	
	function crud_report ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('marketing/mkt_report');?>/"+mode;

		if ( mode=='1' ) {
			
			$('#dlg_mkt_report').dialog('close');
			
			var $preparingFileModal = $("#dlg_progress");
			$preparingFileModal.dialog({ width: 400, height: 120}).dialog('open').dialog('setTitle', "Preparing report...");

			$.fileDownload(url, { 
				httpMethod:'POST', 
				data: {
					output_type: $("[name='output_type']:checked").val(),
					report_type: $("[name='report_type']:checked").val(),
					date_f: $('#date_f').datebox('getValue'),  
					date_t: $('#date_t').datebox('getValue')
				},
				successCallback: function (url) {

					$preparingFileModal.dialog('close');
					<?php setcookie("fileDownload", "true", time()-3600, "/"); ?>
				},
				failCallback: function (result, url) {
					var result = eval('('+result+')');  
					$preparingFileModal.dialog('close');
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
					<?php setcookie("fileDownload", "true", time()-3600, "/"); ?>
				} 
			});
		}
	}
	

</script>
