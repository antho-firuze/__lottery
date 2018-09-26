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
			<div data-options="region:'north',split:true" style="height:390px">
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
				<table id="grid2" style='height:100%;'></table>
			</div>  
			<div data-options="region:'east',split:true">
				<table id="grid3" style='height:100%;'></table>
			</div>  
		</div>  
	</div>  
</div>

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:550, height:350, closed:true, cache:false, modal:true">
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
						<td><label for="sqm">Area (sqm)</label></td> 		
						<td><input class="easyui-numberspinner" id="sqm" name="sqm" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:2" /></td>
						<td class="label_col2"><label for="watt">Electric (KW)</label></td> 		
						<td><input class="easyui-numberspinner" id="watt" name="watt" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:2" /></td>
					</tr>
					<tr>
						<td><label for="power_bill">Power Billing</label></td> 			
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
						<td><label for="service_bill">Service Billing</label></td> 			
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
						<td><label for="bill_date">Bill Date</label></td> 		
						<td><input class="easyui-numberspinner" id="bill_date" name="bill_date" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:1,min:1,precision:0" /></td>
						<td class="label_col2"><label for="bill_due">Bill Due</label></td> 		
						<td><input class="easyui-numberspinner" id="bill_due" name="bill_due" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:10,min:1,precision:0" /></td>
					</tr>
				</table>
			</div>
			<div title="ACCOUNT" style="padding:10px">
				<table>
					<tr>
						<td class="label_col1"><label for="coa_pwr_d">Acc. Power (D)</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="coa_pwr_d" name="coa_pwr_d" style="width:120px" data-options="
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:500, panelHeight:300, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:50,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:true}
							]]" /></td>
						<td class="label_col2"><label for="coa_pwr_c">Acc. Power (C)</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="coa_pwr_c" name="coa_pwr_c" style="width:120px" data-options="
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:500, panelHeight:300, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:50,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:true}
							]]" /></td>
					</tr>
					<tr>
						<td><label for="coa_wtr_d">Acc. Water (D)</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="coa_wtr_d" name="coa_wtr_d" style="width:120px" data-options="
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:500, panelHeight:300, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:50,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:true}
							]]" /></td>
						<td class="label_col2"><label for="coa_wtr_c">Acc. Water (C)</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="coa_wtr_c" name="coa_wtr_c" style="width:120px" data-options="
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:500, panelHeight:300, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:50,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:true}
							]]" /></td>
					</tr>
					<tr>
						<td><label for="coa_svc_d">Acc. Service (D)</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="coa_svc_d" name="coa_svc_d" style="width:120px" data-options="
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:500, panelHeight:300, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:50,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:true}
							]]" /></td>
						<td class="label_col2"><label for="coa_svc_c">Acc. Service (C)</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="coa_svc_c" name="coa_svc_c" style="width:120px" data-options="
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:500, panelHeight:300, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:50,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:true}
							]]" /></td>
					</tr>
					<tr>
						<td><label for="coa_gas_d">Acc. Gas (D)</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="coa_gas_d" name="coa_gas_d" style="width:120px" data-options="
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:500, panelHeight:300, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:50,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:true}
							]]" /></td>
						<td class="label_col2"><label for="coa_gas_c">Acc. Gas (C)</label></td> 			
						<td><input class="easyui-combogrid" type="text" id="coa_gas_c" name="coa_gas_c" style="width:120px" data-options="
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:500, panelHeight:300, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:50,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:true}
							]]" /></td>
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
						<td colspan="2"><input class="easyui-validatebox" type="text" id="unit_name" name="unit_name" style="width:175px; border:1px solid #ccc;" data-options="required:false" readonly /></td>
					</tr>
					<tr>
						<td><label for="customer_id">Customer</label></td> 			
						<td colspan="2"><input class="easyui-combogrid" type="text" id="customer_id" name="customer_id" style="width:175px" data-options="
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
						<td class="label_col1"><label for="date_from">Date From</label></td> 		
						<td><input class="easyui-datebox" id="date_from" name="date_from" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:format_dmy()" /></td>
						<td class="label_col2"><label for="date_to">Date To</label></td> 		
						<td><input class="easyui-datebox" id="date_to" name="date_to" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:format_dmy()" /></td>
					</tr>
					<tr>
						<td class="label_col1"><label for="note">Note</label></td> 		
						<td colspan="3"><textarea id="note" name="note" style="width:355px; height:60px; border:1px solid #ccc;"></textarea></td>
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

<script>
	// FIRST LOAD (DO NOT CHANGE THIS ROUTINES)
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
	
		$(document).on("keydown", function(e){ 
			switch(e.keyCode){
				case 27:	// esc
					$('#dlg').dialog('close');
					$('#dlg2').dialog('close');
					$('#dlg3').dialog('close');
					break;
			}
		});
	});
	
	// GRID =====
	$(function(){  
	
		$("#grid").datagrid({        
			url:'<?php echo site_url('assetm/by_unit/r')?>',	
			columns:[[
				{field:'code', title:'CODE', width:80, sortable:true},
				{field:'name', title:'NAME', width:150, sortable:true},
				{field:'desc', title:'DESCRIPTION', width:250, sortable:true},
				{field:'sqm', title:'AREA (SQM)', width:80, sortable:true},
				{field:'watt', title:'ELECTRIC (KW)', width:100, sortable:true},
				{field:'power_bill_name', title:'POWER BILL TO', width:110, sortable:true},
				{field:'water_bill_name', title:'WATER BILL TO', width:110, sortable:true},
				{field:'service_bill_name', title:'SERVICE BILL TO', width:110, sortable:true},
				{field:'gas_bill_name', title:'GAS BILL TO', width:110, sortable:true},
				{field:'bill_date', title:'BILL DATE', width:80, sortable:true, align:'center'},
				{field:'bill_due', title:'BILL DUE', width:80, sortable:true, align:'center'},
				{field:'coa_pwr_d_code', title:'ACCOUNT POWER (D)', width:140},
				{field:'coa_pwr_c_code', title:'ACCOUNT POWER (C)', width:140},
				{field:'coa_wtr_d_code', title:'ACCOUNT WATER (D)', width:140},
				{field:'coa_wtr_c_code', title:'ACCOUNT WATER (C)', width:140},
				{field:'coa_svc_d_code', title:'ACCOUNT SERVICE (D)', width:140},
				{field:'coa_svc_c_code', title:'ACCOUNT SERVICE (C)', width:140},
				{field:'coa_gas_d_code', title:'ACCOUNT GAS (D)', width:140},
				{field:'coa_gas_c_code', title:'ACCOUNT GAS (C)', width:140},
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
			idField:'id', sortName: 'id', sortOrder: 'desc', multiSort: true,
			onClickRow: function(rowIndex, rowData){
			
				$("#grid2").datagrid('load', {unit_id: rowData.id});  
				$("#grid3").datagrid('load', {unit_id: rowData.id});  
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
		
		url = "<?php echo site_url('assetm/by_unit');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'assetm', 'by_unit'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('reset'); 
			$('#dlg').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save() }
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save( 1 ) }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			
			// $('#code_new').attr('readonly', true);
			// $('#code_new').val('AUTO CODE');
			$('#code_new').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'assetm', 'by_unit'))?1:0; ?>;
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
					handler:function(){	btn_save() }
				},{
					text:'<?php echo l('form_btn_save_next');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save( 2 ) }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");
			
			// $('#code_new').attr('readonly', false);
			$('#code_new').val(row.code); 
			$('#code_new').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'assetm', 'by_unit'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;

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
	
	function btn_save( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg');
		var forms = $('#forms');
		var grid = $('#grid');
		var crud = 'crud';
		
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

	// GRID 2 =====
	$(function(){  

		$("#grid2").datagrid({        
			url:"<?php echo site_url('assetm/by_unit_owner/r')?>",	
			columns:[[
				// {field:'sent_to_destiny', title:'FORWARD', width:70, align:'center', 
					// formatter:function(value, rowData, rowIndex){ 
						// if ( parseInt(value) )
							// return "<input type='checkbox' onclick='return false' onkeydown='return false' checked>";
						// else
							// return "<input type='checkbox' onclick='return false' onkeydown='return false'>";
					// } 
				// },
				// {field:'optional', title:'OPTION', width:50, align:'center', 
					// formatter:function(value, rowData, rowIndex){ 
						// if ( parseInt(value) )
							// return "<input type='checkbox' onclick='return false' onkeydown='return false' checked>";
						// else
							// return "<input type='checkbox' onclick='return false' onkeydown='return false'>";
					// } 
				// },
				{field:"customer_name", title:'NAME', width:200, sortable:true},
				{field:"contact_person", title:'CONTACT PERSON', width:200, sortable:true},
				{field:"phone", title:'PHONE', width:275, sortable:true},
				{field:"fax", title:'FAX', width:175, sortable:true},
				{field:"date_from", title:'DATE FROM', width:100, sortable:true},
				{field:"date_to", title:'DATE TO', width:100, sortable:true},
				{field:"note", title:'NOTE', width:250, sortable:true},
				{field:'id', title:'ID', width:50, formatter:greyField}
			]],
			title:'OWNER',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			idField:'id', sortName: 'id', sortOrder: 'desc', multiSort: true,
			// rowStyler: function(index,row){  
				// if (row.answered == 1 && row.save_option == 1){  
					// return 'color:#4DB849;font-weight:bold;';  
				// }  
				// if (row.save_option == 1){  
					// return 'color:#4DB849;font-weight:bold;';  
				// }  
				// if (row.answered == 1){  
					// return 'color:#98D7FF;font-weight:bold;';  
				// }  
			// },
			onDblClickRow: function(rowIndex, rowData) { crud2('u') }
		});
	
		$('#grid2').datagrid('getPager').pagination({  
			layout:['prev','links','next','refresh'],
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'ADD',
				iconCls:'icon-add',  
				handler:function(){ crud2('c') }  
			},{  
				text:'EDIT',
				iconCls:'icon-edit',  
				handler:function(){ crud2('u') }  
			},{  
				text:'DELETE',
				iconCls:'icon-remove',  
				handler:function(){ crud2('d') }  
			}]  
		});           
		
		setKeyTrapping_grid('#grid2', 'crud2');
	})

	function crud2 ( mode ) {
		
		url = "<?php echo site_url('assetm/by_unit_owner');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'assetm', 'by_unit'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			$('#forms2').form('reset'); 
			$('#customer_id').combogrid('grid').datagrid( 'load', {q: ''} );
			
			$('#dlg2').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save2();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save2( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create_unit_owner');?>");
			
			$('#unit_id').val(row.id);
			$('#unit_name').val(row.name);
			$('#customer_id').focus();
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'assetm', 'by_unit'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			var row2 = $('#grid2').datagrid('getSelected');  
			if (!row2)
				return false;
				
			$('#dlg2').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save2();	}
				},{
					text:'<?php echo l('form_btn_save_next');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save2( 2 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update_unit_owner');?>"); 
			
			$('#forms2').form('reset'); 
			$('#forms2').form('load',row2);  
			$('#customer_id').combogrid('grid').datagrid( 'load', {q: row2.customer_id} );
			
			if ( row2.date_from )
				$('#date_from').datebox('setValue', format_dmy(row2.date_from));
			if ( row2.date_to )
				$('#date_to').datebox('setValue', format_dmy(row2.date_to));
			$('#item_name').focus();
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'assetm', 'by_unit'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;
			
			var row2 = $('#grid2').datagrid('getSelected');  
			if (!row2)
				return false;

			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
				if (r){  
					$.post(url,{ 
					
						id:row2.id
						
					},function(result){  
						if (result.success){  
							$('#grid2').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_delete');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}
	}
	
	function btn_save2( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg2');
		var forms = $('#forms2');
		var grid = $('#grid2');
		var crud = 'crud2';
		
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
	
	// GRID 3 =====
	$(function(){  

		$("#grid3").datagrid({        
			url:"<?php echo site_url('assetm/by_unit_tenant/r')?>",	
			columns:[[
				// {field:'sent_to_destiny', title:'FORWARD', width:70, align:'center', 
					// formatter:function(value, rowData, rowIndex){ 
						// if ( parseInt(value) )
							// return "<input type='checkbox' onclick='return false' onkeydown='return false' checked>";
						// else
							// return "<input type='checkbox' onclick='return false' onkeydown='return false'>";
					// } 
				// },
				// {field:'optional', title:'OPTION', width:50, align:'center', 
					// formatter:function(value, rowData, rowIndex){ 
						// if ( parseInt(value) )
							// return "<input type='checkbox' onclick='return false' onkeydown='return false' checked>";
						// else
							// return "<input type='checkbox' onclick='return false' onkeydown='return false'>";
					// } 
				// },
				{field:"customer_name", title:'NAME', width:200, sortable:true},
				{field:"contact_person", title:'CONTACT PERSON', width:200, sortable:true},
				{field:"phone", title:'PHONE', width:275, sortable:true},
				{field:"fax", title:'FAX', width:175, sortable:true},
				{field:"date_from", title:'DATE FROM', width:100, sortable:true},
				{field:"date_to", title:'DATE TO', width:100, sortable:true},
				{field:"note", title:'NOTE', width:250, sortable:true},
				{field:'id', title:'ID', width:50, formatter:greyField}
			]],
			title:'TENANT',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			idField:'id', sortName: 'id', sortOrder: 'desc', multiSort: true,
			// rowStyler: function(index,row){  
				// if (row.answered == 1 && row.save_option == 1){  
					// return 'color:#4DB849;font-weight:bold;';  
				// }  
				// if (row.save_option == 1){  
					// return 'color:#4DB849;font-weight:bold;';  
				// }  
				// if (row.answered == 1){  
					// return 'color:#98D7FF;font-weight:bold;';  
				// }  
			// },
			onDblClickRow: function(rowIndex, rowData) { crud3('u') }
		});
	
		$('#grid3').datagrid('getPager').pagination({  
			layout:['prev','links','next','refresh'],
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'ADD',
				iconCls:'icon-add',  
				handler:function(){ crud3('c') }  
			},{  
				text:'EDIT',
				iconCls:'icon-edit',  
				handler:function(){ crud3('u') }  
			},{  
				text:'DELETE',
				iconCls:'icon-remove',  
				handler:function(){ crud3('d') }  
			}]  
		});           
		
		setKeyTrapping_grid('#grid3', 'crud3');
	})

	function crud3 ( mode ) {
		
		url = "<?php echo site_url('assetm/by_unit_tenant');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'assetm', 'by_unit'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			$('#forms2').form('reset'); 
			$('#customer_id').combogrid('grid').datagrid( 'load', {q: ''} );
			
			$('#dlg2').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save3();	}
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save3( 1 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create_unit_tenant');?>");  
			
			$('#unit_id').val(row.id);
			$('#unit_name').val(row.name);
			$('#customer_id').focus();
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'assetm', 'by_unit'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			var row2 = $('#grid3').datagrid('getSelected');  
			if (!row2)
				return false;
				
			$('#forms2').form('reset'); 
			$('#forms2').form('load',row2);  
			$('#customer_id').combogrid('grid').datagrid( 'load', {q: row2.customer_id} );
			
			$('#dlg2').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save3();	}
				},{
					text:'<?php echo l('form_btn_save_next');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save3( 2 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update_unit_tenant');?>"); 
			
			if ( row2.date_from )
				$('#date_from').datebox('setValue', format_dmy(row2.date_from));
			if ( row2.date_to )
				$('#date_to').datebox('setValue', format_dmy(row2.date_to));
			$('#item_name').focus();
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'assetm', 'by_unit'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;
			
			var row2 = $('#grid3').datagrid('getSelected');  
			if (!row2)
				return false;

			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
				if (r){  
					$.post(url,{ 
					
						id:row2.id
						
					},function(result){  
						if (result.success){  
							$('#grid3').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_delete');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}
	}
	
	function btn_save3( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg2');
		var forms = $('#forms2');
		var grid = $('#grid3');
		var crud = 'crud3';
		
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
	
</script>

</body>
</html>