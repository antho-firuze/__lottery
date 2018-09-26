<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-easyui/js/jquery.edatagrid.js"></script>
	</head>
<style>
	.label		{width:170px;}
	.label_col1		{width:100px;vertical-align:text-top;}
	.label_col2		{padding-left:10px; width:100px;vertical-align:text-top;}
</style>
<body>
		
<div id="cc" class="easyui-layout" data-options="fit:false" style="height:300px;">  
	<div data-options="region:'north'" data-options="split:false,fit:true" style="height:50px;padding:8px;">
		<table>
			<tr>
				<td class="label"><label for="period_id">SELECT PERIOD</label></td> 			
				<td><input class="easyui-combogrid" id="period_id" name="period_id" style="width:175px" data-options="
					url:'<?php echo site_url('billm/period/r');?>',
					required:false, panelWidth:400, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
					pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
					columns: [[
						{field:'code',title:'CODE',width:50,sortable:true},
						{field:'posted',title:'STATUS',width:60,sortable:true, 
							formatter:function(value, rowData, rowIndex){ 
								if ( parseInt(value) )
									return 'CLOSED';
								else
									return 'OPEN';
							} 
						},
						{field:'id'	 ,title:'ID',width:10,sortable:true}
					]],
					onClickRow: function(rowIndex, rowData){
						goFilter();
					}
					" /></td>
				<td>&nbsp;</td>
				<td><a id="btn-retrieve" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok'">RETRIEVE</a></td>
				<!--
				<td><a id="btn-calculate" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok'">CALCULATE</a></td>
				-->
				<td><a id="btn-generate" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok'">GENERATE</a></td>
				<td><a id="btn-posting" href="#" class="easyui-linkbutton" data-options="iconCls:'icon-ok'">POSTING</a></td>
			</tr>
		</table>
	</div>  
	<div data-options="region:'center'">
		<div id="rr" class="easyui-layout" data-options="fit:true">  
			<div data-options="region:'north',split:true,title:'FILTER'" style="height:75px;padding:8px;">
				<div id="tb" style="padding:3px">  
					<div>  
						<div style="float:right;"><input id="ss" class="easyui-searchbox" style="width:300px" data-options="searcher:goFilter, prompt:'Please Input Value',menu:'#mm'"></input></div>
					</div> 
				</div>
			</div>  
			<div data-options="region:'center'">
				<div class="easyui-tabs" style="height:100%; width:100%;" data-options="fit:true">
					<div title="POWER CALCULATION" style="padding:8px">
						<table id="grid_power" style='height:100%; width:100%;'></table>
					</div>
					<div title="WATER CALCULATION" style="padding:8px">
						<table id="grid_water" style='height:100%; width:100%;'></table>
					</div>
					<div title="SERVICE CALCULATION" style="padding:8px">
						<table id="grid_service" style='height:100%; width:100%;'></table>
					</div>
					<div title="OTHERS CALCULATION" style="padding:8px">
						<table id="grid_others" style='height:100%; width:100%;'></table>
					</div>
					<div title="I N V O I C E" style="padding:8px">
						<div id="vv" class="easyui-layout" data-options="fit:true">  
							<div data-options="region:'center'">
								<table id="grid_invoice" style='height:100%; width:100%;'></table>
							</div>
							<div data-options="region:'east',split:true">
								<table id="grid_invoice_dt" style='height:100%; width:100%;'></table>
							</div>
						</div>
					</div>
				</div>  
			</div>  
		</div>  
	</div>  
</div>

<div id="mm" style="width:150px">  
    <div data-options="name:'ALL',iconCls:'icon-ok'">ALL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>  
    <div data-options="name:'unit_name'">UNIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>  
    <div data-options="name:'customer_name'">OWNER / TENANT</div>  
</div> 

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:550, height:330, closed:true, cache:false, modal:true">
	<form id="forms" method="post">
		<div class="easyui-tabs" style="width:auto;height:auto">
			<div title="GENERAL" style="padding:8px">
				<input type="hidden" id="id" name="id" />
				<input type="hidden" id="period_id" name="period_id" />
				<input type="hidden" id="unit_id" name="unit_id" />
				<input type="hidden" id="power_id" name="power_id" />
				<input type="hidden" id="water_id" name="water_id" />
				<input type="hidden" id="customer_id" name="customer_id" />
				<table>
					<tr>
						<td class="label_col1"><label for="period_code">Period</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" id="period_code" name="period_code" style="width:175px; border:1px solid #ccc;" data-options="required:false" readonly /></td>
					</tr>
					<tr>
						<td><label for="unit_code">Unit</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" id="unit_code" name="unit_code" style="width:175px; border:1px solid #ccc;" data-options="required:false" readonly /></td>
					</tr>
					<tr>
						<td><label for="customer_name">Customer</label></td> 			
						<td colspan="2"><input class="easyui-validatebox" id="customer_name" name="customer_name" style="width:175px; border:1px solid #ccc;" data-options="required:false" readonly /></td>
					</tr>
					<tr class="pwr">
						<td><label for="power_name">Power</label></td> 			
						<td colspan="2"><input class="easyui-validatebox" id="power_name" name="power_name" style="width:175px; border:1px solid #ccc;" data-options="required:false" readonly /></td>
					</tr>
					<tr class="wtr">
						<td><label for="water_name">Water</label></td> 			
						<td colspan="2"><input class="easyui-validatebox" id="water_name" name="water_name" style="width:175px; border:1px solid #ccc;" data-options="required:false" readonly /></td>
					</tr>
					<tr class="curr_val">
						<td class="label_col1"><label for="last_value">Last Value</label></td> 		
						<td><input class="easyui-numberspinner" id="last_value" name="last_value" style="width:120px; border:1px solid #ccc;" data-options="required:false,min:0,precision:0" disabled /></td>
						<td class="label_col2"><label for="last_value">Current Value</label></td> 		
						<td><input class="easyui-numberspinner" id="curr_value" name="curr_value" style="width:120px; border:1px solid #ccc;" data-options="required:true,min:0,precision:0,
							onChange:function(value){
								var last = $('#last_value').numberspinner('getValue');
								var curr = value;
								$('#usage_value').numberspinner('setValue', curr-last);
							}" /></td>
					</tr>
					<tr>
						<td><label for="usage_value">Usage Value</label></td> 		
						<td><input class="easyui-numberspinner" id="usage_value" name="usage_value" style="width:120px; border:1px solid #ccc;" data-options="required:false,min:0,precision:0" disabled /></td>
					</tr>
				</table>
			</div>
			<div title="DOCUMENT LOG" style="padding:10px">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td class="label_col1">Create By</td>			<td><input type="text" name="create_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
						<td class="label_col2">Create Date</td>			<td><input type="text" name="create_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
					</tr>
					<tr>
						<td class="label_col1">Update By</td>			<td><input type="text" name="update_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
						<td class="label_col2">Update Date</td>			<td><input type="text" name="update_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
					</tr>
				</table>
			</div>
		</div>
	</form>
</div>

<div id="dlg2" class="easyui-dialog" style="padding:10px" data-options="width:550, height:430, closed:true, cache:false, modal:true">
	<form id="forms2" method="post">
		<div class="easyui-tabs" style="width:auto;height:auto">
			<div title="GENERAL" style="padding:8px">
				<input type="hidden" id="id" name="id" />
				<input type="hidden" id="unit_id" name="unit_id" />
				<input type="hidden" id="service_id" name="service_id" />
				<input type="hidden" id="others_id" name="others_id" />
				<table>
					<tr>
						<td><div class="label"><label for="unit_name">Unit</label></div></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="unit_name" name="unit_name" style="width:175px; border:1px solid #ccc;" data-options="required:true" readonly /></td>
					</tr>
					<tr>
						<td><label for="customer_id">Customer</label></td> 			
						<td colspan=2><input class="easyui-combogrid" type="text" id="customer_id" name="customer_id" style="width:175px" data-options="
							url:'<?php echo site_url('master/customer/r');?>',
							required:true, panelWidth:500, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:false}
							]]" /></td>
					</tr>
					<tr>
						<td><label for="date_from">Date From - Date To</label></td> 		
						<td><input class="easyui-datebox" id="date_from" name="date_from" style="width:120px; border:1px solid #ccc;" data-options="required:true" /></td>
						<td><input class="easyui-datebox" id="date_to" name="date_to" style="width:120px; border:1px solid #ccc;" data-options="required:true" /></td>
					</tr>
					<tr>
						<td style="vertical-align:text-top;"><label for="note">Note</label></td> 		
						<td colspan=2><textarea id="note" name="note" style="width:175px; height:60px; border:1px solid #ccc;"></textarea></td>
					</tr>
				</table>
			</div>
			<div title="DOCUMENT LOG" style="padding:10px">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td class="label_col1">Create By</td>			<td><input type="text" name="create_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
						<td class="label_col2">Create Date</td>			<td><input type="text" name="create_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
					</tr>
					<tr>
						<td class="label_col1">Update By</td>			<td><input type="text" name="update_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
						<td class="label_col2">Update Date</td>			<td><input type="text" name="update_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
					</tr>
				</table>
			</div>
		</div>
	</form>
</div>

<div id="dlg_invoice" class="easyui-dialog" style="padding:10px" data-options="width:750, height:530, closed:true, cache:false, modal:true">
	<form id="forms_invoice" method="post">
		<div class="easyui-tabs" style="width:auto;height:185px">
		<div title="GENERAL" style="padding:8px">
			<input type="hidden" id="id" name="id" />
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="label_col1"><label for="code">Doc. Code</label></td> 	
					<td><input class="easyui-validatebox" id="code" name="code" style="width:175px;" data-options="required:false" disabled /></td>
					<td class="label_col2"><label for="rev_no">Rev. No</label></td> 	
					<td><input class="easyui-validatebox" id="rev_no" name="rev_no" style="width:175px;" data-options="required:false" disabled /></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="date">Date</label></td> 	
					<td><input class="easyui-datebox" id="date" name="date" style="width:180px;" data-options="required:true, value:format_dmy()" /></td>
					<td class="label_col2"><label for="due_date">Due Date</label></td> 	
					<td><input class="easyui-datebox" id="due_date" name="due_date" style="width:180px;" data-options="required:false" disabled /></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="unit_id">Unit</label></td> 			
					<td><input class="easyui-combogrid" type="text" id="unit_id" name="unit_id" style="width:180px" data-options="
						url:'<?php echo site_url('assetm/unit/r');?>',
						required:false, panelWidth:500, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
						pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
						columns: [[
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:80,sortable:true},
							{field:'sqm',title:'AREA (SQM)',width:80,sortable:true},
							{field:'id'	 ,title:'ID',width:5,sortable:false}
						]]" /></td>
					<td class="label_col2"><label for="viracc">Vir. Account</label></td> 	
					<td><input class="easyui-validatebox" id="viracc" name="viracc" style="width:175px;" data-options="required:false" disabled /></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="customer_id">Customer</label></td> 			
					<td><input class="easyui-combogrid" id="customer_id" name="customer_id" style="width:180px" data-options="
						url:'<?php echo site_url('master/customer/r');?>',
						required:true, panelWidth:500, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
						pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
						columns: [[
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:80,sortable:true},
							{field:'id'	 ,title:'ID',width:5,sortable:false}
						]],
						onSelect: function(rowIndex, rowData){
							$('#charge_type_id').next().find('input').focus();
						}" /></td>
					<td class="label_col2"><label for="charge_type_id">Bill To</label></td> 	
					<td><input class="easyui-combogrid" type="text" id="charge_type_id" name="charge_type_id" style="width:180px" data-options="
						url:'<?php echo site_url('billm/opt_charge_type/r');?>',
						required:false, panelWidth:300, panelHeight:100, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
						pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
						columns: [[
							{field:'code',title:'CODE',width:20,sortable:true},
							{field:'name',title:'NAME',width:40,sortable:true},
							{field:'id'	 ,title:'ID',width:5,sortable:true}
						]]" /></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="note">Note</label></td> 		
					<td colspan="3"><textarea id="note" name="note" style="width:465px; border:1px solid #ccc;"></textarea></td>
				</tr>
			</table>
		</div>
		<div title="DOCUMENT LOG" style="padding:10px">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="label_col1">Create By</td>			<td><input name="create_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
					<td class="label_col2">Create Date</td>			<td><input name="create_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
				</tr>
				<tr>
					<td class="label_col1">Update By</td>			<td><input name="update_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
					<td class="label_col2">Update Date</td>			<td><input name="update_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
				</tr>
			</table>
		</div>
		</div>
		<div id="p" style="width:auto; margin-top:13px; height:252px;">
			<table id="grid3" style='height:250px;'></table>
		</div>
	</form>
</div>

<div id="dlg_report" class="easyui-dialog" style="padding:5px" data-options="width:550, height:340, closed:true, cache:false, modal:true">
	<form id="forms_report" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="FORMS" style="padding:8px">
				<table>
					<tr>
						<td><a href="#" onclick="crud_invoice('form_invoice_selected');" class="easyui-linkbutton" data-options="iconCls:'icon-form'">PRINT SELECTED INVOICE</a></td>	
					</tr>
					<tr>
						<td><a href="#" onclick="crud_invoice('form_invoice_all');" class="easyui-linkbutton" data-options="iconCls:'icon-form'">PRINT ALL INVOICE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>	
					</tr>
				</table>
		</div>
		<!--
		<div title="REPORTS" style="padding:8px">
			<div style="padding:2px">
				<table>
					<tr>
						<td colspan=5>
						<fieldset>
							<legend>Type :</legend>
							<label><input type="radio" name="report_type" value="1" id="report_type_1" checked>Summary</label>
							<label><input type="radio" name="report_type" value="2" id="report_type_2">Detail</label>
						</fieldset>
						</td>
					</tr>
					<tr>
						<td class="label_rpt"><label for="date_fr">Date From</label></td>		
						<td style="width:52px"><input id="date_fr" name="date_fr" class="easyui-datebox" style="width:100px" data-options="required:true, value:format_dmy()" /></td>
						<td colspan="2">&nbsp;To :&nbsp;<input id="date_to" name="date_to" class="easyui-datebox" style="width:100px" data-options="required:true" /></td>
					</tr>
				</table>
			</div>
		</div>
		-->
	</div>
	</form>
</div>

<script>

	// FIRST LOAD (DO NOT CHANGE THIS ROUTINES)
	var url;
	
	function resizelayout2(){
		$("#vv").layout('panel', 'east').panel('resize',{width:$(window).width()/3});
		$("#vv").layout('resize');
	}
	
	$(function(){
		resizelayout();
		$(window).resize(resizelayout);
		
		resizelayout2();
		$(window).resize(resizelayout2);
	});
	
	$.fn.datebox.defaults.formatter = function(date){
		var y = date.getFullYear();
		var m = date.getMonth()+1;
		var d = date.getDate();
		return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
	};
	
	$.fn.datebox.defaults.parser = function(s){
		if (!s) return new Date();
		var ss = s.split('/');
		var d = parseInt(ss[0],10);
		var m = parseInt(ss[1],10);
		var y = parseInt(ss[2],10);
		if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
			return new Date(y,m-1,d);
		} else {
			return new Date();
		}
	};
	
	function goFilter( value, name ) {
		if(typeof(value)==='undefined') value = "";
		if(typeof(name)==='undefined') name = "";
	
		$('#grid_power').datagrid('load',{  
			findKey: name,
			findVal: value,
			period_id: $('#period_id').combogrid('getValue')
		});
		$('#grid_water').datagrid('load',{  
			findKey: name,
			findVal: value,
			period_id: $('#period_id').combogrid('getValue')
		});
		$('#grid_service').datagrid('load',{  
			findKey: name,
			findVal: value,
			period_id: $('#period_id').combogrid('getValue')
		});
		$('#grid_others').datagrid('load',{  
			findKey: name,
			findVal: value,
			period_id: $('#period_id').combogrid('getValue')
		});
		$('#grid_invoice').datagrid('load',{  
			findKey: name,
			findVal: value,
			period_id: $('#period_id').combogrid('getValue')
		});
	};
	
	function getRowIndex(target){  
		var tr = $(target).closest('tr.datagrid-row');  
		return parseInt(tr.attr('datagrid-row-index'));  
	}  

	function format_price( value, row ) {
		if ( !isNaN(parseFloat(value)) && isFinite(value) )
			return accounting.formatMoney(value, '');
	}
	
	function format_dmy(tdate){
		if(typeof(tdate)==='undefined') tdate = 0;
		if (tdate==0)
		{
			var f = new Date();
			var y = f.getFullYear();
			var m = f.getMonth()+1;
			var d = f.getDate();
		}
		else
		{
			var ss = tdate.split('-');
			var y = parseInt(ss[0],10);
			var m = parseInt(ss[1],10);
			var d = parseInt(ss[2],10);
		}
		return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
	}
	
	function format_checkbox( value, row ) {
		if ( !isNaN(parseFloat(value)) && isFinite(value) )
			if ( parseInt(value) )
				return "<input type='checkbox' onclick='return false' onkeydown='return false' checked>";
			else
				return "<input type='checkbox' onclick='return false' onkeydown='return false'>";
	}
	
	function greyField( value, row ) {
		if (value != null)
			return '<span style="color:#ADADAD;">'+value+'</span>'; 
	}
	
	function setKeyTrapping_grid( grid, crud ){
		if(typeof(crud)==='undefined') crud = "";
		
		$(grid).datagrid('getPanel').panel('panel').attr('tabindex',1).bind('keydown',function(e){
			var selected = $(grid).datagrid('getSelected');
			switch(e.keyCode)
			{
				case 38:	// up

					if (selected){
						var index = $(grid).datagrid('getRowIndex', selected);
						if (index==0) return
						$(grid).datagrid('selectRow', index-1);
					} else {
						$(grid).datagrid('selectRow', 0);
					}
					break;
				case 40:	// down
					var lastIndex = $(grid).datagrid('getRows').length-1;
					if (selected){
						var index = $(grid).datagrid('getRowIndex', selected);
						if (index==lastIndex) return
						$(grid).datagrid('selectRow', index+1);
					} else {
						$(grid).datagrid('selectRow', 0);
					}
					break;
				case 45:	// insert

					if (crud=="") return;
					if (selected){ window[crud]('c') }
					break;
				case 13:	// enter

					if (crud=="") return;
					if (selected){ window[crud]('u') }
					break;
				case 46:	// delete

					if (crud=="") return;
					if (selected){ window[crud]('d') }
					break;
			}
		});
	}

	$.extend($.fn.datagrid.defaults.editors, {
		numberspinner: {
			init: function(container, options){
				var input = $('<input type="text">').appendTo(container);
				return input.numberspinner(options);
			},
			destroy: function(target){
				$(target).numberspinner('destroy');
			},
			getValue: function(target){
				return $(target).numberspinner('getValue');
			},
			setValue: function(target, value){
				$(target).numberspinner('setValue',value);
			},
			resize: function(target, width){
				$(target).numberspinner('resize',width);
			}
		}, 
		combogrid: {
			init: function(container, options){
				var input = $('<input type="text">').appendTo(container);
				return input.combogrid(options);
			},
			destroy: function(target){
				$(target).combogrid('destroy');
			},
			getValue: function(target){
				return $(target).combogrid('getValue');
			},
			setValue: function(target, value){
				$(target).combogrid('setValue',value);
			},
			resize: function(target, width){
				$(target).combogrid('resize',width);
			}
		}
	});
		
	// NEXT TO LOAD (THIS VALUE CAN BE CHANGE)
	$(function(){  
		$('#period_id').combogrid('setValue', "<?php echo $this->session->userdata('period_id');?>");
		
		$('#btn-retrieve').bind('click', function(){ data_process( 'retrieve' ) });
		$('#btn-generate').bind('click', function(){ data_process( 'generate' ) });
		$('#btn-posting').bind('click', function(){ data_process( 'posting' ) });
		
		$(document).on("keydown", function(e){ 
			switch(e.keyCode){
				case 27:	// esc
					$('#dlg').dialog('close');
					$('#dlg2').dialog('close');
					$('#dlg_invoice').dialog('close');
					$('#dlg_report').dialog('close');
				break;
			}
		});
		
	});
	
	// PERIOD PROCESS =====
	function data_process( mode ){
	
		url = "<?php echo site_url('billm/bill_calc');?>/"+mode;

		if ( mode=='retrieve' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_retrieve');?>", callback: function(r){  
				if (r){  
					$.post(url,{
					
						period_id: $('#period_id').combogrid('getValue')
						
					},function(result){  
						if (result.success){  
							$('#grid_power').datagrid('reload');    // reload the user data  
							$('#grid_water').datagrid('reload');    // reload the user data  
							$('#grid_service').datagrid('reload');    // reload the user data  
							$('#grid_others').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_retrieve');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}
		
		if ( mode=='generate' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_generate');?>", callback: function(r){  
				if (r){  
					$.post(url,{
					
						period_id: $('#period_id').combogrid('getValue')
						
					},function(result){  
						if (result.success){  
							$('#grid_invoice').datagrid('reload');    // reload the user data  
							$('#grid_invoice_dt').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_generate');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}
		
		if ( mode=='posting' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_posting');?>", callback: function(r){  
				if (r){  
					$.post(url,{
					
						period_id: $('#period_id').combogrid('getValue')
						
					},function(result){  
						if (result.success){  
							$('#grid_invoice').datagrid('reload');    // reload the user data  
							$('#grid_invoice_dt').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_posting');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}
		
	}
	
	// GRID POWER =====
	$(function(){  
		$('#grid_power').datagrid({        
			url:'<?php echo site_url('billm/bill_calc_power/r')?>',	
			columns:[[
				{field:'unit_name', title:'UNIT', width:100, sortable:true},
				{field:'customer_name', title:'CUSTOMER', width:250, sortable:true},
				{field:'charge_type_code', title:'BILL TO', width:70, sortable:true},
				{field:'power_name', title:'POWER', width:100, sortable:true},
				{field:'kva', title:'KVA', width:70, sortable:true, align:"right", formatter:format_price},
				// {field:'load_tariff', title:'LOAD TARIFF', width:90, sortable:true, align:"right", formatter:format_price},
				// {field:'rm_hours', title:'RM HOURS', width:90, sortable:true, align:"right"},
				// {field:'rm_kwh', title:'RM KWH', width:90, sortable:true, align:"right", formatter:format_price},
				// {field:'saving_hours', title:'SAVING HOURS', width:90, sortable:true, align:"right"},
				// {field:'blok1', title:'BLOK 1', width:90, sortable:true, align:"right", formatter:format_price},
				// {field:'blok2', title:'BLOK 2', width:90, sortable:true, align:"right", formatter:format_price},
				// {field:'blok3', title:'BLOK 3', width:90, sortable:true, align:"right", formatter:format_price},
				// {field:'blok1_kwh', title:'BLOK 1 KWH', width:90, sortable:true, align:"right"},
				// {field:'blok2_kwh', title:'BLOK 2 KWH', width:90, sortable:true, align:"right"},
				// {field:'blok3_kwh', title:'BLOK 3 KWH', width:90, sortable:true, align:"right"},
				// {field:'ppj_percent', title:'PPJ PERCENT', width:90, sortable:true, align:"right"},
				// {field:'admin_amount', title:'ADMIN AMOUNT', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'last_value', title:'LAST', width:90, sortable:true, align:"right"},
				{field:'curr_value', title:'CURRENT', width:90, sortable:true, align:"right"},
				{field:'usage_value', title:'USAGE', width:90, sortable:true, align:"right"},
				// {field:'max_value', title:'MAX VALUE', width:90, sortable:true, align:"right"},
				{field:'blok1_amount', title:'BLOK1', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'blok2_amount', title:'BLOK2', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'blok3_amount', title:'BLOK3', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'ppj_amount', title:'PPJ', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'stampduty_amount', title:'STAMP DUTY', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'total_amount', title:'TOTAL', width:90, sortable:true, align:"right", formatter:format_price},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
				{field:"update_by_name", title:'UPDATE BY', width:100, sortable:true},
				{field:"update_date", title:'UPDATE DATE', width:103, sortable:true},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			multiSort:true,
			idField:'id',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			queryParams: { period_id: $('#period_id').combogrid('getValue') },
			onDblClickRow: function(rowIndex, rowData) { crud_power('u') }
		});

		$('#grid_power').datagrid('getPager').pagination({  
			buttons:[/* {  
				text:'<?php echo l('form_btn_add');?>',
				iconCls:'icon-add',  
				handler:function(){ crud_power('c') }  
			}, */{  
				text:'<?php echo l('form_btn_edit');?>',
				iconCls:'icon-edit',  
				handler:function(){ crud_power('u') }  
			},{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud_power('d') }  
			}]  
		});           
		
		setKeyTrapping_grid( '#grid_power', 'crud_power' );
	})

	function crud_power( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('billm/bill_calc_power');?>/"+mode;

		/* if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('reset'); 
			$('#dlg').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_power() }
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_power( 1 ) }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			
			// $('#code_new').attr('readonly', true);
			// $('#code_new').val('AUTO CODE');
			$('#code_new').focus();
		} */
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_power').datagrid('getSelected');   
			if (!row)
				return;

			$('#forms').form('reset'); 
			$('#forms').form('load',row); 
			
			$('#dlg').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_power() }
				},{
					text:'<?php echo l('form_btn_save_next');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_power( 2 ) }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");
			
			$('.pwr').show();
			$('.wtr').hide();
			$('.curr_val').show();
			$('.curr_value').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_power').datagrid('getSelected');  
			if (row){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{id:row.id},function(result){  
							if (result.success){  
								$('#grid_power').datagrid('reload');    // reload the user data  
								dhtmlx.message("<?php echo l('success_delete');?>");
							} else {  
								dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							}  
						},'json');  
					}}  
				});  
			}  
		}

	}
	
	function btn_save_power( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg');
		var forms = $('#forms');
		var grid = $('#grid_power');
		var crud = 'crud_power';
		
		forms.form('submit',{  
			url: url,  
			onSubmit: function(param){  
				return $(this).form('validate'); 
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					dlg.dialog('close');      // close the dialog  
					grid.datagrid('reload');    // reload the user data  
					if (save_option==1) 
					{
						window[crud]('c');
					}
					else if (save_option==2)
					{
						var lastIndex = grid.datagrid('getRows').length-1;
						var selected = grid.datagrid('getSelected');
						if (selected){
							var index = grid.datagrid('getRowIndex', selected);
							if (index==lastIndex) return
							grid.datagrid('selectRow', index+1);
							window[crud]('u');
						}
					}	
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 

	// GRID WATER =====
	$(function(){  
		$('#grid_water').datagrid({        
			url:'<?php echo site_url('billm/bill_calc_water/r')?>',	
			columns:[[
				{field:'unit_name', title:'UNIT', width:100, sortable:true},
				{field:'customer_name', title:'CUSTOMER', width:250, sortable:true},
				{field:'charge_type_code', title:'BILL TO', width:70, sortable:true},				{field:'water_name', title:'WATER', width:100, sortable:true},
				{field:'tariff', title:'TARIFF', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'min_usage', title:'MIN. USAGE', width:90, sortable:true, align:"right"},
				{field:'last_value', title:'LAST', width:90, sortable:true, align:"right"},
				{field:'curr_value', title:'CURRENT', width:90, sortable:true, align:"right"},
				{field:'usage_value', title:'USAGE', width:90, sortable:true, align:"right"},
				// {field:'max_value', title:'MAX. VALUE', width:90, sortable:true, align:"right"},
				{field:'total_amount', title:'TOTAL', width:90, sortable:true, align:"right", formatter:format_price},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
				{field:"update_by_name", title:'UPDATE BY', width:100, sortable:true},
				{field:"update_date", title:'UPDATE DATE', width:103, sortable:true},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			multiSort:true,
			idField:'id',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			queryParams: { period_id: $('#period_id').combogrid('getValue') },
			onDblClickRow: function(rowIndex, rowData) { crud_water('u') }
		});

		$('#grid_water').datagrid('getPager').pagination({  
			buttons:[/* {  
				text:'<?php echo l('form_btn_add');?>',
				iconCls:'icon-add',  
				handler:function(){ crud_water('c') }  
			}, */{  
				text:'<?php echo l('form_btn_edit');?>',
				iconCls:'icon-edit',  
				handler:function(){ crud_water('u') }  
			},{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud_water('d') }  
			}]  
		});           
		
		setKeyTrapping_grid( '#grid_water', 'crud_water' );
	})

	function crud_water( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('billm/bill_calc_water');?>/"+mode;

		/* if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('reset'); 
			$('#dlg').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_water() }
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_water( 1 ) }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			
			// $('#code_new').attr('readonly', true);
			// $('#code_new').val('AUTO CODE');
			$('#code_new').focus();
		} */
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_water').datagrid('getSelected');   
			if (!row)
				return;

			$('#forms').form('reset'); 
			$('#forms').form('load',row); 
		
			$('#dlg').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_water() }
				},{
					text:'<?php echo l('form_btn_save_next');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_water( 2 ) }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");
			
			$('.pwr').hide();
			$('.wtr').show();
			$('.curr_val').show();
			$('.curr_value').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_water').datagrid('getSelected');  
			if (row){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{id:row.id},function(result){  
							if (result.success){  
								$('#grid_water').datagrid('reload');    // reload the user data  
								dhtmlx.message("<?php echo l('success_delete');?>");
							} else {  
								dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							}  
						},'json');  
					}}  
				});  
			}  
		}

	}
	
	function btn_save_water( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg');
		var forms = $('#forms');
		var grid = $('#grid_water');
		var crud = 'crud_water';
		
		forms.form('submit',{  
			url: url,  
			onSubmit: function(param){  
				return $(this).form('validate'); 
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					dlg.dialog('close');      // close the dialog  
					grid.datagrid('reload');    // reload the user data  
					if (save_option==1) 
					{
						window[crud]('c');
					}
					else if (save_option==2)
					{
						var lastIndex = grid.datagrid('getRows').length-1;
						var selected = grid.datagrid('getSelected');
						if (selected){
							var index = grid.datagrid('getRowIndex', selected);
							if (index==lastIndex) return
							grid.datagrid('selectRow', index+1);
							window[crud]('u');
						}
					}	
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 

	// GRID SERVICE =====
	$(function(){  
		$('#grid_service').datagrid({        
			url:'<?php echo site_url('billm/bill_calc_service/r')?>',	
			columns:[[
				{field:'unit_name', title:'UNIT', width:100, sortable:true},
				{field:'customer_name', title:'CUSTOMER', width:250, sortable:true},
				{field:'charge_type_code', title:'BILL TO', width:70, sortable:true},				
				{field:'date', title:'DATE', width:90},
				{field:'service_name', title:'SERVICE', width:250, sortable:true},
				{field:'tariff', title:'TARIFF', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'factor_name', title:'FACTOR BY', width:150, sortable:true},
				{field:'factor', title:'FACTOR', width:70, sortable:true, align:"right", formatter:format_price},
				{field:'bill_period', title:'BILL PERIOD', width:90, sortable:true, align:"right"},
				{field:'total_amount', title:'TOTAL', width:90, sortable:true, align:"right", formatter:format_price},
				// {field:'date_end', title:'DATE END', width:90},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
				{field:"update_by_name", title:'UPDATE BY', width:100, sortable:true},
				{field:"update_date", title:'UPDATE DATE', width:103, sortable:true},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			multiSort:true,
			idField:'id',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			queryParams: { period_id: $('#period_id').combogrid('getValue') },
			onDblClickRow: function(rowIndex, rowData) { /* crud_service('u') */ }
		});

		$('#grid_service').datagrid('getPager').pagination({  
			buttons:[/* {  
				text:'<?php echo l('form_btn_add');?>',
				iconCls:'icon-add',  
				handler:function(){ crud_service('c') }  
			}, *//* {  
				text:'<?php echo l('form_btn_edit');?>',
				iconCls:'icon-edit',  
				handler:function(){ crud_service('u') }  
			}, */{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud_service('d') }  
			}]  
		});           
		
		setKeyTrapping_grid( '#grid_service', 'crud_service' );
	})

	function crud_service( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('billm/bill_calc_service');?>/"+mode;

		/* if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			$('#forms').form('reset'); 
			
			// $('#code_new').attr('readonly', true);
			// $('#code_new').val('AUTO CODE');
			$('#code_new').focus();
		} */
		
		/* if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_service').datagrid('getSelected');   
			if (!row)
				return;
			
			$('#forms').form('reset'); 
			$('#forms').form('load',row); 
		
			$('#dlg').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_water() }
				},{
					text:'<?php echo l('form_btn_save_next');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_water( 2 ) }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");
			
			$('.pwr').hide();
			$('.wtr').hide();
			$('.curr_val').hide();
		} */
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_service').datagrid('getSelected');  
			if (row){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{id:row.id},function(result){  
							if (result.success){  
								$('#grid_service').datagrid('reload');    // reload the user data  
								dhtmlx.message("<?php echo l('success_delete');?>");
							} else {  
								dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							}  
						},'json');  
					}}  
				});  
			}  
		}

	}
	
	function btn_save_service( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg');
		var forms = $('#forms');
		var grid = $('#grid_service');
		var crud = 'crud_service';
		
		forms.form('submit',{  
			url: url,  
			onSubmit: function(param){  
				return $(this).form('validate'); 
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					dlg.dialog('close');      // close the dialog  
					grid.datagrid('reload');    // reload the user data  
					if (save_option==1) 
					{
						window[crud]('c');
					}
					else if (save_option==2)
					{
						var lastIndex = grid.datagrid('getRows').length-1;
						var selected = grid.datagrid('getSelected');
						if (selected){
							var index = grid.datagrid('getRowIndex', selected);
							if (index==lastIndex) return
							grid.datagrid('selectRow', index+1);
							window[crud]('u');
						}
					}	
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 

	// GRID OTHERS =====
	$(function(){  
		$('#grid_others').datagrid({        
			url:'<?php echo site_url('billm/bill_calc_others/r')?>',	
			columns:[[
				{field:'unit_name', title:'UNIT', width:100, sortable:true},
				{field:'customer_name', title:'CUSTOMER', width:250, sortable:true},
				{field:'charge_type_code', title:'BILL TO', width:70, sortable:true},				
				{field:'others_name', title:'OTHERS', width:200, sortable:true},
				{field:'date', title:'DATE', width:90},
				{field:'tariff', title:'TARIFF', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'factor_name', title:'FACTOR BY', width:150, sortable:true},
				{field:'factor', title:'FACTOR', width:70, sortable:true, align:"right", formatter:format_price},
				{field:'bill_period', title:'BILL PERIOD', width:90, sortable:true, align:"right"},
				// {field:'date_end', title:'DATE END', width:90},
				{field:'total_amount', title:'TOTAL', width:90, sortable:true, align:"right", formatter:format_price},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
				{field:"update_by_name", title:'UPDATE BY', width:100, sortable:true},
				{field:"update_date", title:'UPDATE DATE', width:103, sortable:true},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			multiSort:true,
			idField:'id',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			queryParams: { period_id: $('#period_id').combogrid('getValue') },
			onDblClickRow: function(rowIndex, rowData) { /* crud_others('u') */ }
		});

		$('#grid_others').datagrid('getPager').pagination({  
			buttons:[/* {  
				text:'<?php echo l('form_btn_add');?>',
				iconCls:'icon-add',  
				handler:function(){ crud_others('c') }  
			}, *//* {  
				text:'<?php echo l('form_btn_edit');?>',
				iconCls:'icon-edit',  
				handler:function(){ crud_others('u') }  
			}, */{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud_others('d') }  
			}]  
		});           
		
		setKeyTrapping_grid( '#grid_others', 'crud_others' );
	})

	function crud_others( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('billm/bill_calc_others');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			$('#forms').form('reset'); 
			
			// $('#code_new').attr('readonly', true);
			// $('#code_new').val('AUTO CODE');
			$('#code_new').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_others').datagrid('getSelected');   
			if (row){  
				$('#forms').form('reset'); 
			
				$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");  
				$('#forms').form('load',row); 
				
				// $('#code_new').attr('readonly', false);
				$('#code_new').val(row.code); 
				$('#code_new').focus();
			}
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_others').datagrid('getSelected');  
			if (row){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{id:row.id},function(result){  
							if (result.success){  
								$('#grid_others').datagrid('reload');    // reload the user data  
								dhtmlx.message("<?php echo l('success_delete');?>");
							} else {  
								dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							}  
						},'json');  
					}}  
				});  
			}  
		}

	}
	
	function btn_save_others( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg');
		var forms = $('#forms');
		var grid = $('#grid_others');
		var crud = 'crud_others';
		
		forms.form('submit',{  
			url: url,  
			onSubmit: function(param){  
				return $(this).form('validate'); 
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					dlg.dialog('close');      // close the dialog  
					grid.datagrid('reload');    // reload the user data  
					if (save_option==1) 
					{
						window[crud]('c');
					}
					else if (save_option==2)
					{
						var lastIndex = grid.datagrid('getRows').length-1;
						var selected = grid.datagrid('getSelected');
						if (selected){
							var index = grid.datagrid('getRowIndex', selected);
							if (index==lastIndex) return
							grid.datagrid('selectRow', index+1);
							window[crud]('u');
						}
					}	
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 

	// GRID INVOICE =====
	$(function(){  
		$('#grid_invoice').datagrid({        
			url:'<?php echo site_url('billm/invoice/r')?>',	
			columns:[[
				{field:'unit_name', title:'UNIT', width:100, sortable:true},
				{field:'customer_name', title:'CUSTOMER', width:200, sortable:true},
				{field:'charge_type_code', title:'BILL TO', width:60, sortable:true},				
				{field:'viracc', title:'VIRTUAL ACCOUNT', width:130, sortable:true},
				{field:'date', title:'DATE', width:70, sortable:true},
				{field:'code', title:'CODE', width:150, sortable:true},
				{field:'rev_no', title:'REV.NO', width:50, sortable:true, align:"center"},
				{field:'total_amount', title:'TOTAL', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'paid_amount', title:'PAID', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'balance_amount', title:'BALANCE', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'void', title:'VOID', width:50, sortable:true, align:"center", formatter:format_checkbox},
				{field:'posted', title:'POSTED', width:60, sortable:true, align:"center", formatter:format_checkbox},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
				{field:"void_by_name", title:'VOID BY', width:100, sortable:true},
				{field:"void_date", title:'VOID DATE', width:103, sortable:true},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			multiSort:true,
			idField:'id',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			onClickRow: function(rowIndex, rowData){
				$("#grid_invoice_dt").datagrid('load', {invoice_id: rowData.id});  
				$("#grid3").datagrid('load', {invoice_id: rowData.id});  
			},
			queryParams: { period_id: $('#period_id').combogrid('getValue') },
			onDblClickRow: function(rowIndex, rowData) { crud_invoice('u') }
		});

		$('#grid_invoice').datagrid('getPager').pagination({  
			buttons:[{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud_invoice('d') }  
			},{  
				text:'<?php echo l('form_btn_void');?>',
				iconCls:'icon-void',  
				handler:function(){ crud_invoice('void') }  
			},{  
				text:'REPORTS',
				iconCls:'icon-reports',  
				handler:function(){ crud_invoice('report')	}  
			}]  
		});           
		
		setKeyTrapping_grid( '#grid_invoice', 'crud_invoice' );
	})

	function crud_invoice( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('billm/invoice');?>/"+mode;

		/* if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			$('#forms').form('reset'); 
			
			// $('#code_new').attr('readonly', true);
			// $('#code_new').val('AUTO CODE');
			$('#code_new').focus();
		} */
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_invoice').datagrid('getSelected');   
			if (!row)
				return;
				
			$('#forms_invoice').form('reset'); 
			$('#forms_invoice').form('load',row); 
			$('#forms_invoice #unit_id').combogrid('grid').datagrid( 'load', {q: row.unit_id } );
			$('#forms_invoice #customer_id').combogrid('grid').datagrid( 'load', {q: row.customer_id } );
			
			$('#dlg_invoice').dialog({
				height:550,
				width:800,
				buttons:[{
					text:'<?php echo l('form_btn_close');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg_invoice').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");
			
			$('#date').datebox('setValue', format_dmy(row.date));
			$('#due_date').datebox('setValue', format_dmy(row.due_date));
			$('#date').next().find('input').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_invoice').datagrid('getSelected');  
			if (!row)
				return;

			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
				if (r){  
					$.post(url,{id:row.id},function(result){  
						if (result.success){  
							$('#grid_invoice').datagrid('reload');    // reload the user data  
							$('#grid_invoice_dt').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_delete');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}

		if ( mode=='void' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_invoice').datagrid('getSelected');  
			if (!row)
				return;

			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_void');?>", callback: function(r){  
				if (r){  
					$.post(url,{id:row.id},function(result){  
						if (result.success){  
							$('#grid_invoice').datagrid('reload');    // reload the user data  
							$('#grid_invoice_dt').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_delete');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}

		if ( mode=='report' ) {
			var date = new Date(), y = date.getFullYear(), m = date.getMonth();
			var f = new Date(y, m, 1);
			var t = new Date(y, m+1, 0);
			
			var y = f.getFullYear();
			var m = f.getMonth()+1;
			var d = f.getDate();
			$('#date_fr').datebox('setValue', (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
			
			var y = t.getFullYear();
			var m = t.getMonth()+1;
			var d = t.getDate();
			$('#date_to').datebox('setValue', (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
			
			$('#dlg_report').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_ok');?>',
					iconCls:'icon-ok',
					handler:function(){	btn_report(); }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg_report').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_report');?>");
		}

		if ( mode=='form_invoice_selected' ) {
			var row = $('#grid_invoice').datagrid('getSelected');  
			if (!row)
			{
				dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:"Please, choose a record !" });
				return;
			}
			
			url = "<?php echo site_url('billm/form_invoice_auto');?>/"+row.period_id+"/"+row.id;
			window.open(url);
			$('#dlg_report').dialog('close');      // close the dialog 
		}
		
		if ( mode=='form_invoice_all' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_print_all');?>", callback: function(r){  
				if (r)
				{  
					url = "<?php echo site_url('billm/form_invoice_auto');?>/"+$('#period_id').combogrid('getValue')+"/0/0";
					window.open(url);
					$('#dlg_report').dialog('close');      // close the dialog 
				}}  
			});  
			
		}
		
	}
	
	// GRID INVOICE DT =====
	$(function(){  
		$('#grid_invoice_dt').datagrid({        
			url:'<?php echo site_url('billm/invoice_dt/r')?>',	
			columns:[[
				{field:'note', title:'DESC', width:250, sortable:true},
				{field:'amount', title:'AMOUNT', width:150, sortable:true, align:"right", formatter:format_price},
				{field:'coa_d_code', title:'ACC. (D)', width:100, sortable:true},
				{field:'coa_c_code', title:'ACC. (C)', width:100, sortable:true},
				{field:'posted', title:'POSTED', width:60, align:"center", formatter:format_checkbox},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			idField:'id', sortName: 'id', sortOrder: 'desc', multiSort: true,
			showFooter: true,
			onDblClickRow: function(rowIndex, rowData) { /* crud_invoice_dt('u') */ }
		});

		$('#grid_invoice_dt').datagrid('getPager').pagination({  
			showPageList: false,
			layout:['prev','links','next','refresh'],
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud_invoice_dt('d') }  
			}]  
		});           
		
		setKeyTrapping_grid( '#grid_invoice_dt', '' );
	})

	function crud_invoice_dt( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('billm/invoice_dt');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			$('#forms').form('reset'); 
			
			// $('#code_new').attr('readonly', true);
			// $('#code_new').val('AUTO CODE');
			$('#code_new').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_invoice_dt').datagrid('getSelected');   
			if (row){  
				$('#forms').form('reset'); 
			
				$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");  
				$('#forms').form('load',row); 
				
				// $('#code_new').attr('readonly', false);
				$('#code_new').val(row.code); 
				$('#code_new').focus();
			}
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_invoice_dt').datagrid('getSelected');  
			if (row){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{id:row.id},function(result){  
							if (result.success){  
								$('#grid_invoice_dt').datagrid('reload');    // reload the user data  
								dhtmlx.message("<?php echo l('success_delete');?>");
							} else {  
								dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							}  
						},'json');  
					}}  
				});  
			}  
		}

	}
	
	// GRID 3 =====
	var selectIndex;
	
	$(function(){  
	
		$("#grid3").edatagrid({        
			url:'<?php echo site_url('billm/invoice_dt/r')?>',	
			saveUrl:'<?php echo site_url('billm/invoice_dt/c');?>',
			updateUrl:'<?php echo site_url('billm/invoice_dt/u');?>',
			destroyUrl:'<?php echo site_url('billm/invoice_dt/d');?>',
			columns:[[
				// {field:'ck',checkbox:true},
				{field:"invoice_type_code", title:'INVOICE TYPE', width:100, sortable:true},
				{field:'note', title:'NOTE', width:250, sortable:true},
				{field:"coa_d", title:'ACCOUNT (D)', width:100, 
					formatter:function(value, row){
						return row.coa_d_code;
					},
					editor:{ 
						type:'combogrid', 
						options:{
							url:'<?php echo site_url('acc/coa/r');?>',
							required:true, panelWidth:300, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:false}
							]]
						}						
					}
				},
				{field:"coa_c", title:'ACCOUNT (C)', width:100, 
					formatter:function(value, row){
						return row.coa_c_code;
					},
					editor:{ 
						type:'combogrid', 
						options:{
							url:'<?php echo site_url('acc/coa/r');?>',
							required:true, panelWidth:300, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:false}
							]]
						}						
					}
				},
				{field:'amount', title:'AMOUNT', width:120, sortable:true, align:'right', formatter:format_price},
				{field:'posted', title:'POSTED', width:60, align:"center", formatter:format_checkbox},
				{field:'invoice_id', title:'INV.ID', width:50, sortable:false, hidden:true},
				{field:'id', title:'ID', width:50, sortable:false, formatter:greyField}
			]],
			// title:'',
			fit:false,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			idField:'id', sortName: 'id', sortOrder: 'asc', multiSort: true,
			queryParams: { invoice_id: $('#forms_invoice #id').val() },
			onSelect:function(rowIndex, rowData){ 
				selectIndex = rowIndex 
			},
			onEdit: function(rowIndex, rowData){
				var editors = $('#grid3').edatagrid('getEditors', rowIndex);
				var coa_d = editors[0];
				var coa_c = editors[1];
				
				$(coa_d.target).combogrid('grid').datagrid( 'load', {q: rowData.coa_d } );
				$(coa_c.target).combogrid('grid').datagrid( 'load', {q: rowData.coa_c } );
				$(coa_d.target).next().find('input').focus();
			},
			onSave: function(index,row){
				dhtmlx.message("<?php echo l('success_saving');?>");
				$("#grid3").datagrid('load', {invoice_id: $('#forms_invoice #id').val()});  
			},
			onError: function(index,row){
				dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:row.errorMsg });
			}
		});

		$('#grid3').edatagrid('getPager').pagination({  
			layout:['prev','links','next','refresh'],
			displayMsg: ' {total} item(s)',
			buttons:[/* {  
				text:'<?php echo l('form_btn_add');?>',
				iconCls:'icon-add',  
				handler:function(){ crud3('c') }  
			}, */{  
				text:'<?php echo l('form_btn_edit');?>',
				iconCls:'icon-edit',  
				handler:function(){ crud3('u') }  
			},{  
				text:'<?php echo l('form_btn_save');?>',
				iconCls:'icon-save',  
				handler:function(){ $('#grid3').edatagrid('saveRow') }  
			},{  
				text:'<?php echo l('form_btn_cancel');?>',
				iconCls:'icon-cancel',  
				handler:function(){ $('#grid3').edatagrid('cancelRow') }  
			},{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud3('d') }  
			}]  
		});           
		
		setKeyTrapping_grid('#grid3', 'crud3');
	});
	
	function crud3 ( mode ) {
		
		url = "<?php echo site_url('billm/invoice_dt');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if ( $('#forms_invoice #id').val() == '' )
			{
				if ( !$('#forms_invoice').form('validate') ) 
					return;
					
				$('#forms_invoice').form('submit',{ url: "<?php echo site_url('billm/invoice/c');?>",  
					onSubmit: function(param){  
						
						return $(this).form('validate'); 
						
					},  
					success: function(result){  
						var result = eval('('+result+')');  
						if (result.errorMsg)
						{  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							return;
						} 
						else 
						{  
							$('#forms_invoice #id').val(result.id);
							$('#forms_invoice #code').val(result.code); 
							
							if( $('#forms_invoice #id').val() !== '') 
							{
								$('#grid3').edatagrid('addRow', { row:{ invoice_id: $('#forms_invoice #id').val() } });
								return;
							}
						}  
					}  
				});  
			}
		
			if( $('#forms_invoice #id').val() !== '') 
			{
				$('#grid3').edatagrid('addRow', { row:{ invoice_id: $('#forms_invoice #id').val() } });
				return;
			}
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if ( $('#forms_invoice #id').val() == '' )
				return;
			
			var selected = $('#grid3').datagrid('getSelected');
			var index = $('#grid3').datagrid('getRowIndex', selected);
			
			$('#grid3').edatagrid('editRow', index);
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if ( $('#forms_invoice #id').val() == '' )
				return;
			
			$('#grid3').edatagrid('destroyRow');
		}
	}
	
</script>

</body>
</html>