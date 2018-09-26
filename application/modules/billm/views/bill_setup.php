<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
<style>
	.label		{width:170px;}
	.label_col1		{width:100px;vertical-align:text-top;}
	.label_col2		{padding-left:10px; width:100px;vertical-align:text-top;}
</style>
<body>
		
<div id="cc" class="easyui-layout">  
	<div data-options="region:'center'">
		<div id="rr" class="easyui-layout" data-options="fit:true">  
			<div data-options="region:'north',split:true" style="height:300px">
				<table id="grid" style='height:100%; width:100%;' toolbar="#tb"></table>
				<div id="tb" style="padding:3px">  
					<div>  
						&nbsp;  
						<div style="float:right;"><input id="ss" class="easyui-searchbox" style="width:300px" data-options="searcher:goFilter, prompt:'Please Input Value',menu:'#mm'"></input></div>
					</div> 
				</div>
				<div id="mm" style="width:120px">  
					<div data-options="name:'ALL',iconCls:'icon-ok'">ALL</div>  
					<div data-options="name:'code'">CODE</div>  
					<div data-options="name:'name'">NAME</div>  
				</div> 
			</div>  
			<div data-options="region:'center'">
				<div class="easyui-tabs" style="height:100%; width:100%;" data-options="fit:true">
					<div title="POWER SETUP" style="padding:8px">
						<table id="grid_power" style='height:100%;'></table>
					</div>
					<div title="WATER SETUP" style="padding:8px">
						<table id="grid_water" style='height:100%;'></table>
					</div>
					<div title="SERVICE SETUP" style="padding:8px">
						<table id="grid_service" style='height:100%;'></table>
					</div>
					<!--
					<div title="PARKING SETUP" style="padding:8px">
						<table id="grid_parking" style='height:100%;'></table>
					</div>
					-->
					<div title="OTHERS CHARGES SETUP" style="padding:8px">
						<table id="grid_others" style='height:100%;'></table>
					</div>
				</div>
			</div>  
		</div>  
	</div>  
</div>

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:550, height:370, closed:true, cache:false, modal:true">
	<form id="forms" method="post">
		<div class="easyui-tabs" style="width:auto;height:auto">
			<div title="GENERAL" style="padding:8px">
				<input type="hidden" id="id" name="id" />
				<input type="hidden" id="code" name="code" />
				<table>
					<tr>
						<td class="label_col1"><label for="code_new">Code</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="code_new" name="code_new" style="width:175px; border:1px solid #ccc;" data-options="required:true" /></td>
					</tr>
					<tr>
						<td><label for="name">Name</label></td> 			
						<td colspan="2"><input class="easyui-validatebox" type="text" id="name" name="name" style="width:175px; border:1px solid #ccc;" data-options="required:true" /></td>
					</tr>
					<tr>
						<td class="label_col1"><label for="desc">Description</label></td> 			
						<td colspan="3"><textarea id="desc" name="desc" style="width:355px; border:1px solid #ccc;" data-options="required:true"></textarea></td>
					</tr>
					<tr>
						<td class="label_col1"><label for="sqm">Area (sqm)</label></td> 		
						<td><input class="easyui-numberspinner" id="sqm" name="sqm" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:1,min:0,precision:2" /></td>
						<td class="label_col2"><label for="sqm">Electric (KW)</label></td> 		
						<td><input class="easyui-numberspinner" id="watt" name="watt" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:1,min:0,precision:2" /></td>
					</tr>
					<tr>
						<td class="label_col1"><label for="power_bill">Power Billing</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="power_bill" name="power_bill" style="width:120px" data-options="
							url:'<?php echo site_url('billm/opt_charge_type/r');?>',
							required:false, panelWidth:300, panelHeight:100, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, value:1, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true},
								{field:'name',title:'NAME',width:40,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:true}
							]]" /></td>
						<td class="label_col2"><label for="water_bill">Water Billing</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="water_bill" name="water_bill" style="width:120px" data-options="
							url:'<?php echo site_url('billm/opt_charge_type/r');?>',
							required:false, panelWidth:300, panelHeight:100, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, value:1, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true},
								{field:'name',title:'NAME',width:40,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:true}
							]]" /></td>
					</tr>
					<tr>
						<td class="label_col1"><label for="service_bill">Service Billing</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="service_bill" name="service_bill" style="width:120px" data-options="
							url:'<?php echo site_url('billm/opt_charge_type/r');?>',
							required:false, panelWidth:300, panelHeight:100, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, value:1, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true},
								{field:'name',title:'NAME',width:40,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:true}
							]]" /></td>
						<td class="label_col2"><label for="gas_bill">Gas Billing</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="gas_bill" name="gas_bill" style="width:120px" data-options="
							url:'<?php echo site_url('billm/opt_charge_type/r');?>',
							required:false, panelWidth:300, panelHeight:100, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, value:1,
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true},
								{field:'name',title:'NAME',width:40,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:true}
							]]" /></td>
					</tr>
					<tr>
						<td class="label_col1"><label for="bill_date">Bill Date</label></td> 		
						<td><input class="easyui-numberspinner" id="bill_date" name="bill_date" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:1,min:1,precision:0" /></td>
						<td class="label_col2"><label for="bill_date">Bill Due</label></td> 		
						<td><input class="easyui-numberspinner" id="bill_due" name="bill_due" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:15,min:1,precision:0" /></td>
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

<div id="dlg2" class="easyui-dialog" style="padding:10px" data-options="width:550, height:330, closed:true, cache:false, modal:true">
	<form id="forms2" method="post">
		<div class="easyui-tabs" style="width:auto;height:auto">
			<div title="GENERAL" style="padding:8px">
				<input type="hidden" id="id" name="id" />
				<input type="hidden" id="unit_id" name="unit_id" />
				<table>
					<tr>
						<td class="label_col1"><label for="unit_name">Unit</label></td> 			
						<td colspan="2"><input class="easyui-validatebox" id="unit_name" name="unit_name" style="width:175px; border:1px solid #ccc;" readonly /></td>
					</tr>
					<tr id="pwr">
						<td><label for="power_id">Power</label></td> 			
						<td colspan=2><input class="easyui-combogrid" id="power_id" name="power_id" style="width:175px" data-options="
							url:'<?php echo site_url('master/power/r');?>',
							required:false, panelWidth:400, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true},
								{field:'name',title:'NAME',width:40,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:true}
							]]" /></td>
					</tr>
					<tr id="wtr">
						<td><label for="water_id">Water</label></td> 			
						<td colspan=2><input class="easyui-combogrid" id="water_id" name="water_id" style="width:175px" data-options="
							url:'<?php echo site_url('master/water/r');?>',
							required:false, panelWidth:400, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true},
								{field:'name',title:'NAME',width:40,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:true}
							]]" /></td>
					</tr>
					<tr id="par">
						<td><label for="parking_id">Parking</label></td> 			
						<td colspan=2><input class="easyui-combogrid" id="parking_id" name="parking_id" style="width:175px" data-options="
							url:'<?php echo site_url('master/parking/r');?>',
							required:false, panelWidth:400, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true},
								{field:'name',title:'NAME',width:40,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:true}
							]]" /></td>
					</tr>
					<tr id="srv">
						<td><label for="service_id">Service</label></td> 			
						<td colspan=2><input class="easyui-combogrid" id="service_id" name="service_id" style="width:175px" data-options="
							url:'<?php echo site_url('master/service/r');?>',
							required:false, panelWidth:400, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true},
								{field:'name',title:'NAME',width:40,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:true}
							]]" /></td>
					</tr>
					<tr class="oth">
						<td><label for="others_id">Fix Charge</label></td> 			
						<td colspan=2><input class="easyui-combogrid" type="text" id="others_id" name="others_id" style="width:175px" data-options="
							url:'<?php echo site_url('master/others/r');?>',
							required:false, panelWidth:400, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true},
								{field:'name',title:'NAME',width:40,sortable:true},
								// {field:'tariff',title:'tariff',width:40,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:true}
							]],
							onSelect: function(rowIndex, rowData){
								$('#note').val(rowData.name);
								$('#tariff').numberspinner('setValue', rowData.tariff);
								$('#factor_id').combogrid('setValue', rowData.factor_id);
								$('#coa_d').combogrid('setValue', rowData.coa_d);
								$('#coa_c').combogrid('setValue', rowData.coa_c);
								
								$('#coa_d').combogrid('grid').datagrid( 'load', {q: rowData.coa_d } );
								$('#coa_c').combogrid('grid').datagrid( 'load', {q: rowData.coa_c } );
							}" /></td>
					</tr>
					<tr class="oth">
						<td class="label_col1"><label for="note">Note</label></td> 			
						<td colspan="3"><textarea id="note" name="note" style="width:355px; border:1px solid #ccc;"></textarea></td>
					</tr>
					<tr class="oth">
						<td><label for="charge_type_id">Bill To</label></td> 			
						<td colspan=2><input class="easyui-combogrid" type="text" id="charge_type_id" name="charge_type_id" style="width:175px" data-options="
							url:'<?php echo site_url('billm/opt_charge_type/r');?>',
							required:false, panelWidth:300, panelHeight:100, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true},
								{field:'name',title:'NAME',width:40,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:true}
							]]" /></td>
					</tr>
					<!--
					<tr id="last_val">
						<td><label for="last_value">Last Value</label></td> 		
						<td colspan="2"><input class="easyui-numberspinner" id="last_value" name="last_value" style="width:175px; border:1px solid #ccc;" data-options="required:false,value:0,min:0,precision:0" /></td>
					</tr>
					-->
					<tr class="date_begin_end">
						<td>&nbsp;</td> 	
						<td>Period :</td>
					</tr>
					<tr class="date_begin_end">
						<td class="label_col1"><label for="date_begin">Date Begin</label></td> 		
						<td><input class="easyui-datebox" id="date_begin" name="date_begin" style="width:120px; border:1px solid #ccc;" data-options="required:false" /></td>
						<td class="label_col2"><label for="date_end">Date End</label></td> 		
						<td><input class="easyui-datebox" id="date_end" name="date_end" style="width:120px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr class="oth">
						<td class="label_col1"><label for="tariff">Tariff</label></td> 			
						<td><input class="easyui-numberspinner" id="tariff" name="tariff" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:2,groupSeparator:','" /></td>
						<td class="label_col2"><label for="factor_id">Factor</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="factor_id" name="factor_id" style="width:120px" data-options="
							url:'<?php echo site_url('billm/opt_factor/r');?>',
							required:true, panelWidth:500, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, value:1,
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:false}
							]]" /></td>
					</tr>
					<tr class="oth">
						<td class="label_col1"><label for="coa_d">Account (D)</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="coa_d" name="coa_d" style="width:120px" data-options="
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:500, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:false}
							]]" /></td>
						<td class="label_col2"><label for="coa_c">Account (C)</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="coa_c" name="coa_c" style="width:120px" data-options="
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:500, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:false}
							]]" /></td>
					</tr>
					<tr class="oth">
						<td><label for="bill_period">Bill Period</label></td> 			
						<td colspan=2>Per &nbsp;<input class="easyui-numberspinner" id="bill_period" name="bill_period" style="width:100px; border:1px solid #ccc;" data-options="required:true,value:1,min:1,max:12,precision:0" />  &nbsp;Month(s)</td>
					</tr>
				</table>
			</div>
		</div>
	</form>
</div>

<script>
	var url;
	
	function resizelayout2(){
		$("#rr").layout('panel', 'north').panel('resize',{height:$(window).height()*0.5});
		$("#rr").layout('resize');
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
	
		$('#grid').datagrid('load',{  
			findKey: name,
			findVal: value
		});
		
	};
	
	function getRowIndex(target){  
		var tr = $(target).closest('tr.datagrid-row');  
		return parseInt(tr.attr('datagrid-row-index'));  
	}  

	function format_price( value, row ) {
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
				case 27:	// esc
				
					break;
			}
		});
		
	}

	// NEXT TO LOAD (THIS VALUE CAN BE CHANGE)
	$(function(){  
	
		// var date = new Date();
		// var y = date.getFullYear();
		// var m = date.getMonth();
		
		// var f = new Date(y, m, 1);
		// var y = f.getFullYear();
		// var m = f.getMonth()+1;
		// var d = f.getDate();
		// $('#date_f').datebox('setValue', (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
		
		// var t = new Date(y, m+1, 0);
		// var y = t.getFullYear();
		// var m = t.getMonth()+1;
		// var d = t.getDate();
		// $('#date_t').datebox('setValue', (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);

		$(document).on("keydown", function(e){ 
			switch(e.keyCode){
				case 27:	// esc
					$('#dlg').dialog('close');
					$('#dlg2').dialog('close');
					break;
			}
		});
	});
	
	// GRID =====
	$(function(){  
	
		$("#grid").datagrid({        
			url:'<?php echo site_url('billm/bill_setup/r')?>',	
			columns:[[
				{field:'code', title:'CODE', width:80, sortable:true},
				{field:'name', title:'NAME', width:150, sortable:true},
				{field:'desc', title:'DESCRIPTION', width:150, sortable:true},
				{field:'sqm', title:'AREA (SQM)', width:80, sortable:true},
				{field:'watt', title:'ELECTRIC (KW)', width:100, sortable:true},
				{field:'power_bill_name', title:'POWER BILL TO', width:110, sortable:true},
				{field:'water_bill_name', title:'WATER BILL TO', width:110, sortable:true},
				{field:'service_bill_name', title:'SERVICE BILL TO', width:110, sortable:true},
				{field:'gas_bill_name', title:'GAS BILL TO', width:110, sortable:true},
				{field:'bill_date', title:'BILL DATE', width:80, sortable:true, align:'center'},
				{field:'bill_due', title:'BILL DUE', width:80, sortable:true, align:'center'},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
				{field:"update_by_name", title:'UPDATE BY', width:100, sortable:true},
				{field:"update_date", title:'UPDATE DATE', width:103, sortable:true},
				{field:'id', title:'ID', width:50, sortable:true}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			idField:'id',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			onClickRow: function(rowIndex, rowData){
			
				$("#grid_power").datagrid('load', {unit_id: rowData.id});  
				$("#grid_water").datagrid('load', {unit_id: rowData.id});  
				$("#grid_service").datagrid('load', {unit_id: rowData.id});  
				// $("#grid_parking").datagrid('load', {unit_id: rowData.id});  
				$("#grid_others").datagrid('load', {unit_id: rowData.id});  
			},
			onDblClickRow: function(rowIndex, rowData) { crud('u') }
		});

		$('#grid').datagrid('getPager').pagination({  
			buttons:[{  
				text:'<?php echo l('form_btn_add');?>',
				iconCls:'icon-add',  
				handler:function(){ crud('c') }  
			},{  
				text:'<?php echo l('form_btn_edit');?>',
				iconCls:'icon-edit',  
				handler:function(){ crud('u') }  
			},{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud('d') }  
			}]  
		});           

		setKeyTrapping_grid('#grid', 'crud');
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('billm/bill_setup');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('reset'); 
			
			$('#dlg').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create');?>"); 
			
			// $('#code_new').attr('readonly', true);
			// $('#code_new').val('AUTO CODE');
			$('#code_new').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return;

			$('#forms').form('reset'); 
			$('#forms').form('load',row); 
		
			$('#dlg').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save( 2 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>"); 
			
			// $('#code_new').attr('readonly', false);
			$('#code_new').val(row.code); 
			$('#code_new').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (row){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{id:row.id},function(result){  
							if (result.success){  
								$('#grid').datagrid('reload');    // reload the user data  
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
	
	function btn_save( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		$('#forms').form('submit',{  
			url: url,  
			onSubmit: function(param){  
				return $(this).form('validate'); 
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					$('#dlg').dialog('close');      // close the dialog  
					$('#grid').datagrid('reload');    // reload the user data  
					if (save_option==1) 
						crud('c');
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 

	// GRID POWER =====
	$(function(){  

		$("#grid_power").datagrid({        
			url:"<?php echo site_url('billm/bill_setup_power/r')?>",	
			columns:[[
				{field:'code', title:'CODE', width:100, sortable:true},
				{field:'name', title:'NAME', width:250, sortable:true},
				{field:'kva', title:'KVA', width:70, sortable:true, align:"right", formatter:format_price},
				{field:'load_tariff', title:'LOAD TARIFF', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'rm_hours', title:'RM HOURS', width:90, sortable:true, align:"right"},
				{field:'rm_kwh', title:'RM KWH', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'saving_hours', title:'SAVING HOURS', width:90, sortable:true, align:"right"},
				{field:'blok1', title:'BLOK 1', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'blok2', title:'BLOK 2', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'blok3', title:'BLOK 3', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'blok1_kwh', title:'BLOK 1 KWH', width:90, sortable:true, align:"right"},
				{field:'blok2_kwh', title:'BLOK 2 KWH', width:90, sortable:true, align:"right"},
				{field:'blok3_kwh', title:'BLOK 3 KWH', width:90, sortable:true, align:"right"},
				{field:'ppj_percent', title:'PPJ PERCENT', width:90, sortable:true, align:"right"},
				{field:'admin_amount', title:'ADMIN AMOUNT', width:90, sortable:true, align:"right", formatter:format_price},
				// {field:'last_value', title:'LAST VALUE', width:90, sortable:true, align:"right"},
				{field:'max_value', title:'MAX VALUE', width:90, sortable:true, align:"right"},
				{field:'active', title:'ACTIVE', width:90, sortable:true, align:'center', 
					formatter:function(value, rowData, rowIndex){ 
						if ( parseInt(value) )
							return "<input type='checkbox' onclick='return false' onkeydown='return false' checked>";
						else
							return "<input type='checkbox' onclick='return false' onkeydown='return false'>";
					} 
				},
				{field:'id', title:'ID', width:50, sortable:true}
			]],
			// title:'',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			queryParams: { unit_id: 0 },
			onDblClickRow: function(rowIndex, rowData) { crud_power('u') }
		});
	
		$('#grid_power').datagrid('getPager').pagination({  
			layout:['prev','links','next','refresh'],
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'ADD',
				iconCls:'icon-add',  
				handler:function(){ crud_power('c') }  
			},{  
				text:'EDIT',
				iconCls:'icon-edit',  
				handler:function(){ crud_power('u') }  
			},{  
				text:'DELETE',
				iconCls:'icon-remove',  
				handler:function(){ crud_power('d') }  
			}]  
		});           

		setKeyTrapping_grid('#grid_power', 'crud_power');
	})

	function crud_power ( mode ) {
		
		url = "<?php echo site_url('billm/bill_setup_power');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			$('#dlg2').dialog({
				height:200,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_power();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_power( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			});
			
			$('#pwr').show();
			$('#wtr').hide();
			$('#par').hide();
			$('#srv').hide();
			$('.oth').hide();
			// $('#last_val').show();
			$('.date_begin_end').hide();
			$('#forms2').form('reset'); 
			$('#power_id').combogrid('grid').datagrid( 'load', {q: ''} );

			$('#dlg2').dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");  
			
			$('#unit_id').val(row.id);
			$('#unit_name').val(row.name);
			$('#power_id').next().find('input').focus()
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			var row2 = $('#grid_power').datagrid('getSelected');  
			if (!row2)
				return false;
				
			$('#dlg2').dialog({
				height:200,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_power();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_power( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			});
			
			$('#pwr').show();
			$('#wtr').hide();
			$('#par').hide();
			$('#srv').hide();
			$('.oth').hide();
			// $('#last_val').show();
			$('.date_begin_end').hide();
			$('#forms2').form('reset'); 
			$('#power_id').combogrid('grid').datagrid( 'load', {q: row2.power_id} );
			
			$('#dlg2').dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");  
			$('#forms2').form('load',row2);  
			
			$('#unit_name').val(row.name);
			$('#power_id').next().find('input').focus()
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;
			
			var row2 = $('#grid_power').datagrid('getSelected');  
			if (row2){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{ 
						
							id:row2.id
							
						},function(result){  
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
		
		$('#forms2').form('submit',{  
			url: url,  
			onSubmit: function(param){  
				
				return $(this).form('validate');  
				
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					$('#dlg2').dialog('close');      // close the dialog  
					$('#grid_power').datagrid('reload');    // reload the user data  
					if (save_option==1) 
						crud_power('c');
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 
	
	// GRID WATER =====
	$(function(){  
	
		$("#grid_water").datagrid({        
			url:"<?php echo site_url('billm/bill_setup_water/r')?>",	
			columns:[[
				{field:'code', title:'CODE', width:100, sortable:true},
				{field:'name', title:'NAME', width:250, sortable:true},
				{field:'tariff', title:'TARIFF', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'min_usage', title:'MIN. USAGE', width:90, sortable:true, align:"right"},
				// {field:'last_value', title:'LAST VALUE', width:90, sortable:true, align:"right"},
				{field:'max_value', title:'MAX. VALUE', width:90, sortable:true, align:"right"},
				{field:'id', title:'ID', width:50, sortable:true}
			]],
			// title:'',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			queryParams: { unit_id: 0 },
			onDblClickRow: function(rowIndex, rowData) { crud_water('u') }
		});
	
		$('#grid_water').datagrid('getPager').pagination({  
			layout:['prev','links','next','refresh'],
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'ADD',
				iconCls:'icon-add',  
				handler:function(){ crud_water('c') }  
			},{  
				text:'EDIT',
				iconCls:'icon-edit',  
				handler:function(){ crud_water('u') }  
			},{  
				text:'DELETE',
				iconCls:'icon-remove',  
				handler:function(){ crud_water('d') }  
			}]  
		});           

		setKeyTrapping_grid('#grid_water', 'crud_water');
	})

	function crud_water ( mode ) {
		
		url = "<?php echo site_url('billm/bill_setup_water');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			$('#dlg2').dialog({
				height:200,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_water();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_water( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			});
			
			$('#pwr').hide();
			$('#wtr').show();
			$('#par').hide();
			$('#srv').hide();
			$('.oth').hide();
			// $('#last_val').show();
			$('.date_begin_end').hide();
			$('#forms2').form('reset'); 
			$('#water_id').combogrid('grid').datagrid( 'load', {q: ''} );
			
			$('#dlg2').dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");  
			
			$('#unit_id').val(row.id);
			$('#unit_name').val(row.name);
			$('#water_id').next().find('input').focus()
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			var row2 = $('#grid_water').datagrid('getSelected');  
			if (!row2)
				return false;
				
			$('#dlg2').dialog({
				height:200,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_water();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_water( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			});
			
			$('#pwr').hide();
			$('#wtr').show();
			$('#par').hide();
			$('#srv').hide();
			$('.oth').hide();
			// $('#last_val').show();
			$('.date_begin_end').hide();
			$('#forms2').form('reset'); 
			$('#water_id').combogrid('grid').datagrid( 'load', {q: row2.water_id} );
			
			$('#dlg2').dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");  
			$('#forms2').form('load',row2);  
			
			$('#unit_name').val(row.name);
			$('#water_id').next().find('input').focus()
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;
			
			var row2 = $('#grid_water').datagrid('getSelected');  
			if (row2){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{ 
						
							id:row2.id
							
						},function(result){  
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
		
		$('#forms2').form('submit',{  
			url: url,  
			onSubmit: function(param){  
			
				return $(this).form('validate');  
				
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					$('#dlg2').dialog('close');      // close the dialog  
					$('#grid_water').datagrid('reload');    // reload the user data  
					if (save_option==1) 
						crud_water('c');
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 
	
	// GRID PARKING =====
	/* $(function(){  

		$("#grid_parking").datagrid({        
			url:"<?php echo site_url('billm/bill_setup_parking/r')?>",	
			columns:[[
				{field:'code', title:'CODE', width:100, sortable:true},
				{field:'name', title:'NAME', width:250, sortable:true},
				{field:'desc', title:'DESCRIPTION', width:250, sortable:true},
				{field:'lot', title:'LOT', width:70, sortable:true},
				{field:'id', title:'ID', width:50, sortable:true}
			]],
			// title:'',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			queryParams: { unit_id: 0 },
			onDblClickRow: function(rowIndex, rowData) { crud_parking('u') }
		});
	
		$('#grid_parking').datagrid('getPager').pagination({  
			layout:['prev','links','next','refresh'],
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'ADD',
				iconCls:'icon-add',  
				handler:function(){ crud_parking('c') }  
			},{  
				text:'EDIT',
				iconCls:'icon-edit',  
				handler:function(){ crud_parking('u') }  
			},{  
				text:'DELETE',
				iconCls:'icon-remove',  
				handler:function(){ crud_parking('d') }  
			}]  
		});           

		setKeyTrapping_grid('#grid_parking', 'crud_parking');
	}) */

	/* function crud_parking ( mode ) {
		
		url = "<?php echo site_url('billm/bill_setup_parking');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			$('#dlg2').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_parking();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_parking( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			});
			
			$('#pwr').hide();
			$('#wtr').hide();
			$('#par').show();
			$('#srv').hide();
			$('.oth').hide();
			// $('#last_val').hide();
			$('.date_begin_end').hide();
			$('#forms2').form('reset'); 
			$('#parking_id').combogrid('grid').datagrid( 'load', {q: ''} );
			
			$('#dlg2').dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");  
			
			$('#unit_id').val(row.id);
			$('#unit_name').val(row.name);
			$('#parking_id').next().find('input').focus()
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			var row2 = $('#grid_parking').datagrid('getSelected');  
			if (!row2)
				return false;
				
			$('#dlg2').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_parking();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_parking( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			});
			
			$('#pwr').hide();
			$('#wtr').hide();
			$('#par').show();
			$('#srv').hide();
			$('.oth').hide();
			// $('#last_val').hide();
			$('.date_begin_end').hide();
			$('#forms2').form('reset'); 
			$('#parking_id').combogrid('grid').datagrid( 'load', {q: row2.parking_id} );
			
			$('#dlg2').dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");  
			$('#forms2').form('load',row2);  
			
			$('#unit_name').val(row.name);
			$('#parking_id').next().find('input').focus()
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;
			
			var row2 = $('#grid_parking').datagrid('getSelected');  
			if (row2){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{ 
						
							id:row2.id
							
						},function(result){  
							if (result.success){  
								$('#grid_parking').datagrid('reload');    // reload the user data  
								dhtmlx.message("<?php echo l('success_delete');?>");
							} else {  
								dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							}  
						},'json');  
					}}  
				});  
			}  
		}
	} */
	
	/* function btn_save_parking( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		$('#forms2').form('submit',{  
			url: url,  
			onSubmit: function(param){  
			
				return $(this).form('validate');  
				
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					$('#dlg2').dialog('close');      // close the dialog  
					$('#grid_parking').datagrid('reload');    // reload the user data  
					if (save_option==1) 
						crud_parking('c');
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} */ 
	
	// GRID SERVICE =====
	$(function(){  

		$("#grid_service").datagrid({        
			url:"<?php echo site_url('billm/bill_setup_service/r')?>",	
			columns:[[
				{field:'code', title:'CODE', width:150, sortable:true},
				{field:'name', title:'NAME', width:250, sortable:true},
				{field:'tariff', title:'TARIFF', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'factor_name', title:'FACTOR', width:150, sortable:true},
				{field:'bill_period', title:'BILL PERIOD', width:90, sortable:true, align:"right"},
				{field:'date_begin', title:'DATE BEGIN', width:90},
				{field:'date_end', title:'DATE END', width:90},
				{field:'id', title:'ID', width:50, sortable:true}
			]],
			// title:'',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			queryParams: { unit_id: 0 },
			onDblClickRow: function(rowIndex, rowData) { crud_service('u') }
		});
	
		$('#grid_service').datagrid('getPager').pagination({  
			layout:['prev','links','next','refresh'],
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'ADD',
				iconCls:'icon-add',  
				handler:function(){ crud_service('c') }  
			},{  
				text:'EDIT',
				iconCls:'icon-edit',  
				handler:function(){ crud_service('u') }  
			},{  
				text:'DELETE',
				iconCls:'icon-remove',  
				handler:function(){ crud_service('d') }  
			}]  
		});           

		setKeyTrapping_grid('#grid_service', 'crud_service');
	})

	function crud_service ( mode ) {
		
		url = "<?php echo site_url('billm/bill_setup_service');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			$('#forms2').form('reset'); 
			$('#service_id').combogrid('grid').datagrid( 'load', {q: ''} );

			$('#dlg2').dialog({
				height:300,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_service();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_service( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			
			$('#pwr').hide();
			$('#wtr').hide();
			$('#par').hide();
			$('#srv').show();
			$('.oth').hide();
			// $('#last_val').hide();
			$('.date_begin_end').show();
			
			$('#unit_id').val(row.id);
			$('#unit_name').val(row.name);
			$('#date_begin').datebox('setValue', format_dmy());
			$('#service_id').next().find('input').focus()
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			var row2 = $('#grid_service').datagrid('getSelected');  
			if (!row2)
				return false;
				
			$('#forms2').form('reset'); 
			$('#forms2').form('load',row2);  
			$('#service_id').combogrid('grid').datagrid( 'load', {q: row2.service_id} );
			
			$('#dlg2').dialog({
				height:300,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_service();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_service( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");
			
			$('#pwr').hide();
			$('#wtr').hide();
			$('#par').hide();
			$('#srv').show();
			$('.oth').hide();
			// $('#last_val').hide();
			$('.date_begin_end').show();
			
			$('#date_begin').datebox('setValue', format_dmy(row2.date_begin));
			$('#date_end').datebox('setValue', (row2.date_end)?format_dmy(row2.date_end):'');
			$('#unit_name').val(row.name);
			$('#service_id').next().find('input').focus()
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;
			
			var row2 = $('#grid_service').datagrid('getSelected');  
			if (row2){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{ 
						
							id:row2.id
							
						},function(result){  
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
		
		$('#forms2').form('submit',{  
			url: url,  
			onSubmit: function(param){  
			
				return $(this).form('validate');  
				
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					$('#dlg2').dialog('close');      // close the dialog  
					$('#grid_service').datagrid('reload');    // reload the user data  
					if (save_option==1) 
						crud_service('c');
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 
	
	// GRID OTHERS =====
	$(function(){  

		$("#grid_others").datagrid({        
			url:"<?php echo site_url('billm/bill_setup_others/r')?>",	
			columns:[[
				{field:'code', title:'CODE', width:150, sortable:true},
				{field:'note', title:'NOTE', width:250, sortable:true},
				{field:'charge_type_name', title:'BILL TO', width:120, sortable:true},
				{field:'tariff', title:'TARIFF', width:90, sortable:true, align:"right", formatter:format_price},
				{field:'factor_name', title:'FACTOR', width:150, sortable:true},
				{field:'bill_period', title:'BILL PERIOD', width:90, sortable:true, align:"right"},
				{field:'date_begin', title:'DATE BEGIN', width:90},
				{field:'date_end', title:'DATE END', width:90},
				{field:'coa_d_code', title:'ACCOUNT DEBET', width:120},
				{field:'coa_c_code', title:'ACCOUNT CREDIT', width:120},
				{field:'id', title:'ID', width:50, sortable:true}
			]],
			// title:'',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			queryParams: { unit_id: 0 },
			onDblClickRow: function(rowIndex, rowData) { crud_others('u') }
		});
	
		$('#grid_others').datagrid('getPager').pagination({  
			layout:['prev','links','next','refresh'],
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'ADD',
				iconCls:'icon-add',  
				handler:function(){ crud_others('c') }  
			},{  
				text:'EDIT',
				iconCls:'icon-edit',  
				handler:function(){ crud_others('u') }  
			},{  
				text:'DELETE',
				iconCls:'icon-remove',  
				handler:function(){ crud_others('d') }  
			}]  
		});           

		setKeyTrapping_grid('#grid_others', 'crud_others');
	})

	function crud_others ( mode ) {
		
		url = "<?php echo site_url('billm/bill_setup_others');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			$('#forms2').form('reset'); 
			$('#others_id').combogrid('grid').datagrid( 'load', {q: ''} );
			$('#coa_d').combogrid('grid').datagrid( 'load', {q: ''} );
			$('#coa_c').combogrid('grid').datagrid( 'load', {q: ''} );
			
			$('#dlg2').dialog({
				height:450,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_others();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_others( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");  
			
			$('#pwr').hide();
			$('#wtr').hide();
			$('#par').hide();
			$('#srv').hide();
			$('#oth').show();
			// $('#last_val').hide();
			$('.date_begin_end').show();
			
			$('#unit_id').val(row.id);
			$('#unit_name').val(row.name);
			$('#date_begin').datebox('setValue', format_dmy());
			$('#others_id').next().find('input').focus()
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			var row2 = $('#grid_others').datagrid('getSelected');  
			if (!row2)
				return false;
				
			$('#forms2').form('reset'); 
			$('#forms2').form('load',row2);  
			
			$('#others_id').combogrid('grid').datagrid( 'load', {q: row2.others_id} );
			$('#coa_d').combogrid('grid').datagrid( 'load', {q: row2.coa_d_code } );
			$('#coa_c').combogrid('grid').datagrid( 'load', {q: row2.coa_c_code } );
			
			$('#dlg2').dialog({
				height:450,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_others();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save_others( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>"); 
			
			$('#pwr').hide();
			$('#wtr').hide();
			$('#par').hide();
			$('#srv').hide();
			$('.oth').show();
			// $('#last_val').hide();
			$('.date_begin_end').show();
			
			$('#date_begin').datebox('setValue', format_dmy(row2.date_begin));
			$('#date_end').datebox('setValue', (row2.date_end)?format_dmy(row2.date_end):'');
			$('#unit_name').val(row.name);
			$('#others_id').next().find('input').focus()
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_setup'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;
			
			var row2 = $('#grid_others').datagrid('getSelected');  
			if (row2){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{ 
						
							id:row2.id
							
						},function(result){  
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
		
		$('#forms2').form('submit',{  
			url: url,  
			onSubmit: function(param){  
			
				return $(this).form('validate');  
				
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					$('#dlg2').dialog('close');      // close the dialog  
					$('#grid_others').datagrid('reload');    // reload the user data  
					if (save_option==1) 
						crud_others('c');
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 
	
</script>

</body>
</html>