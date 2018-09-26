<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-easyui/js/jquery.edatagrid.js"></script>
	</head>
<style>
	.label			{width:130px;}
	.label_col1		{width:100px; vertical-align:text-top;}
	.label_col2		{padding-left:10px; width:100px; vertical-align:text-top;}
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
						<div style="float:left;">
							<label for="date_f">&nbsp;DATE FROM :&nbsp;</label>	<input id="date_f" class="easyui-datebox" style="width:100px" data-options="value:start_month()">  
							<label for="date_t">&nbsp;TO :&nbsp;</label><input id="date_t" class="easyui-datebox" style="width:100px" data-options="value:end_month()">  
							<label for="status_filter">&nbsp;STATUS :&nbsp;</label><select class="easyui-combobox" id="status_filter" style="width:110px;" data-options="editable:false,panelWidth:'150',panelHeight:'100'">
								<option value="0">ALL STATUS</option>  
								<option value="1">VOID ONLY</option>  
								<option value="2">POSTED ONLY</option>  
							</select> 
							
						</div>
						<div style="float:left;margin:-3px 0 0 5px;">
							<a href="#" class="easyui-linkbutton" plain="true" onclick="goFilter()">FILTER</a>  
						</div>
						<div style="float:right;"><input id="ss" class="easyui-searchbox" style="width:300px" data-options="searcher:goFilter, prompt:'Please Input Value',menu:'#mm'"></input></div>
					</div> 
				</div>
				<div id="mm" style="width:120px">  
					<div data-options="name:'ALL',iconCls:'icon-ok'">ALL</div>  
					<div data-options="name:'code'">CODE</div>  
					<div data-options="name:'name'">NAME</div>  
					<div data-options="name:'contact_person'">CONTACT</div>  
					<div data-options="name:'address'">ADDRESS</div>  
				</div> 
			</div>  
			<div data-options="region:'center'">
				<table id="grid2" style='height:100%;'></table>
			</div>  
		</div>  
	</div>  
</div>

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:750, height:530, closed:true, cache:false, modal:true">
	<form id="forms" method="post">
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
						<td><a href="#" onclick="crud('form_invoice_selected');" class="easyui-linkbutton" data-options="iconCls:'icon-form'">PRINT SELECTED INVOICE</a></td>	
					</tr>
					<!--
					<tr>
						<td><a href="#" onclick="crud_invoice('form_invoice_all');" class="easyui-linkbutton" data-options="iconCls:'icon-form'">PRINT ALL INVOICE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>	
					</tr>
					-->
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
						<td class="label_rpt"><label for="date_fr">Date From</label></td>	<td>:</td>	
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
			date_f: $('#date_f').datebox('getValue'),  
			date_t: $('#date_t').datebox('getValue'),
			status: $('#status_filter').combobox('getValue'),
			findKey: name,
			findVal: value
		});
	};
	
	function start_month(){
		var date = new Date();
		var y = date.getFullYear();
		var m = date.getMonth();
		
		var f = new Date(y, m, 1);
		var y = f.getFullYear();
		var m = f.getMonth()+1;
		var d = f.getDate();
		
		return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
	}
	
	function end_month(){
		var date = new Date();
		var y = date.getFullYear();
		var m = date.getMonth();
		
		var t = new Date(y, m+1, 0);
		var y = t.getFullYear();
		var m = t.getMonth()+1;
		var d = t.getDate();
		
		return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
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
				case 27:	// esc
				
					$('#grid').edatagrid('cancelRow');
					$('#grid2').datagrid('cancelEdit', target);
					break;
			}
		});
		
	}

	// FUNCTION FOR INLINE EDITING =====
	function getRowIndex(target){
		var tr = $(target).closest('tr.datagrid-row');
		return parseInt(tr.attr('datagrid-row-index'));
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
	
		$(document).on("keydown", function(e){ 
			switch(e.keyCode){
				case 27:	// esc
					$('#dlg').dialog('close');
					$('#dlg_report').dialog('close');
					break;
			}
		});
	});
	
	// GRID =====
	$(function(){ 
	
		$("#grid").datagrid({        
			// title:'',
			url:'<?php echo site_url('billm/invoice/r/0')?>',	
			columns:[[
				{field:"code", title:'CODE', width:150, sortable:true},
				{field:"date", title:'DATE', width:80, sortable:true, align:'center'},
				{field:"due_date", title:'DUE DATE', width:80, sortable:true, align:'center'},
				{field:'unit_name', title:'UNIT', width:100, sortable:true},
				{field:"customer_name", title:'CUSTOMER', width:200, sortable:true},
				{field:'charge_type_code', title:'BILL TO', width:60, sortable:true},				
				{field:'viracc', title:'VIRTUAL ACCOUNT', width:130, sortable:true},
				{field:"note", title:'NOTE', width:250, sortable:true, editor:{ type:'textarea' }},
				{field:'total_amount', title:'TOTAL', width:90, sortable:true, align:"right", formatter:format_price},
				{field:"void", title:'VOID', width:50, sortable:true, align:'center', formatter:format_checkbox},
				{field:"posted", title:'POSTED', width:60, sortable:true, align:'center', formatter:format_checkbox},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
				{field:'id', title:'ID', width:50, formatter:greyField}
			]],
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			idField:'id', sortName: 'id', sortOrder: 'desc', /* multiSort: true, */
			// queryParams: { date_f: $('#date_f').datebox('getValue'), date_t: $('#date_t').datebox('getValue'), status: $('#status_filter').combobox('getValue'), findKey: 0, findVal: 0 },
			queryParams: { period_id: <?php echo $this->session->userdata('period_id');?> },
			onDblClickRow: function(rowIndex, rowData) { crud('u') },
			onClickRow: function(rowIndex, rowData){
				$("#grid2").datagrid('load', {invoice_id: rowData.id});  
				$("#grid3").datagrid('load', {invoice_id: rowData.id});  
			}
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
			}/* ,{  
				text:'<?php echo l('form_btn_save');?>',
				iconCls:'icon-save',  
				handler:function(){ $('#grid').edatagrid('saveRow') }  
			} *//* ,{  
				text:'<?php echo l('form_btn_cancel');?>',
				iconCls:'icon-cancel',  
				handler:function(){ $('#grid').edatagrid('cancelRow') }  
			} *//* ,{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud('d') }  
			} */,{  
				text:'<?php echo l('form_btn_void');?>',
				iconCls:'icon-void',  
				handler:function(){ crud('v') }  
			},{  
				text:'<?php echo l('form_btn_revise');?>',
				iconCls:'icon-revise',  
				handler:function(){ crud('rev') }  
			},{  
				text:'<?php echo l('form_btn_post');?>',
				iconCls:'icon-post',  
				handler:function(){ crud('p') }  
			},/* {  
				text:'<?php echo l('form_btn_unpost');?>',
				iconCls:'icon-unpost',  
				handler:function(){ crud('up') }  
			}, */{  
				text:'<?php echo l('form_btn_report');?>',
				iconCls:'icon-reports',  
				handler:function(){ crud('report') }  
			}]  
		});           

		setKeyTrapping_grid('#grid', 'crud');
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('billm/invoice');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('reset'); 
			$('#unit_id').combogrid('grid').datagrid( 'load', {q: ''} );
			$('#customer_id').combogrid('grid').datagrid( 'load', {q: ''} );
			$("#grid3").datagrid('load', {invoice_id: ''});  
			
			$('#dlg').dialog({
				height:550,
				width:800,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save() }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			
			$('#id').val(''); 
			$('#code').val('AUTO'); 
			$('#date').next().find('input').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return;
				
			$('#forms').form('reset'); 
			$('#forms').form('load',row); 
			$('#unit_id').combogrid('grid').datagrid( 'load', {q: row.unit_id } );
			$('#customer_id').combogrid('grid').datagrid( 'load', {q: row.customer_id } );
			
			$('#dlg').dialog({
				height:550,
				width:800,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save() }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");
			
			$('#date').datebox('setValue', format_dmy(row.date));
			$('#due_date').datebox('setValue', format_dmy(row.due_date));
			$('#date').next().find('input').focus();
		}
		
		/* if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return;

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
		} */
		
		if ( mode=='v' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return;
				
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_void');?>", callback: function(r){  
				if (r){  
					$.post(url,{id:row.id},function(result){  
						if (result.success){  
							$('#grid').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_void');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}
		
		if ( mode=='p' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return;
				
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_posting');?>", callback: function(r){  
				if (r){  
					$.post(url,{id:row.id},function(result){  
						if (result.success){  
							$('#grid').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_posting');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}
		
		if ( mode=='up' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return;
			
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_unposting');?>", callback: function(r){  
				if (r){  
					$.post(url,{id:row.id},function(result){  
						if (result.success){  
							$('#grid').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_unposting');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}

		if ( mode=='report' ) {
		
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
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
			{
				dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:"Please, choose a record !" });
				return;
			}
			
			url = "<?php echo site_url('billm/form_invoice_manual');?>/"+row.period_id+"/"+row.id;
			window.open(url);
			$('#dlg_report').dialog('close');      // close the dialog 
		}
		
	}
	
	function btn_save( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg');
		var forms = $('#forms');
		var grid = $('#grid');
		var grid_ = $('#grid2');
		var crud = 'crud';
		if ( $('#id').val()=='' ) 
			var mode = 'c';
		else
			var mode = 'u';
			
		url = "<?php echo site_url('billm/invoice');?>/"+mode;
		
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
					grid_.datagrid('reload');    // reload the user data  
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
	var target;
	$(function(){  

		$("#grid2").datagrid({        
			title:'DETAIL',
			url:"<?php echo site_url('billm/invoice_dt/r')?>",	
			columns:[[
				{field:'invoice_type_code', title:'INVOICE TYPE', width:100, sortable:true},
				{field:'note', title:'NOTE', width:250, sortable:true},
				{field:'coa_d_code', title:'ACCOUNT (D)', width:100},
				{field:'coa_c_code', title:'ACCOUNT (C)', width:100},
				{field:'amount', title:'AMOUNT', width:120, sortable:true, align:'right', formatter:format_price},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			fit:true,
			// fitColumns:true,
			rownumbers:true,
			singleSelect:true,
			pagination:false,
			pagePosition:'bottom',
			showFooter: 'true',
			idField:'id', sortName: 'id', sortOrder: 'desc', multiSort: true,
			queryParams: { invoice_id: 0 },
			onDblClickRow: function(rowIndex, rowData) { }
		});
		
		setKeyTrapping_grid('#grid2', '');
	});

	// GRID 3 =====
	var selectIndex;
	
	$(function(){  
	
		$("#grid3").edatagrid({        
			url:'<?php echo site_url('billm/invoice_dt/r')?>',	
			saveUrl:'<?php echo site_url('billm/invoice_dt/c');?>',
			updateUrl:'<?php echo site_url('billm/invoice_dt/u');?>',
			destroyUrl:'<?php echo site_url('billm/invoice_dt/d');?>',
			columns:[[
				{field:'ck',checkbox:true},
				{field:"invoice_type_id", title:'INVOICE TYPE', width:100, sortable:true, 
					formatter:function(value, row){
						return row.invoice_type_code;
					},
					editor:{ 
						type:'combogrid', 
						options:{
							url:'<?php echo site_url('billm/opt_invoice_type/r');?>',
							required:true, panelWidth:300, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:false}
							]],
							onSelect: function(rowIndex, rowData){
								var editors = $('#grid3').edatagrid('getEditors', selectIndex);
								var note = editors[1];
								var coa_d = editors[2];
								var coa_c = editors[3];
								
								$(note.target).val(rowData.name);
								$(coa_d.target).combogrid('setValue',rowData.coa_d);
								$(coa_c.target).combogrid('setValue',rowData.coa_c);
								
								// $(note.target).next().find('input').focus();
								$(note.target).focus();
							}
						}						
					}
				},
				{field:'note', title:'NOTE', width:250, sortable:true, editor:{ type:'validatebox' }},
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
				{field:'amount', title:'AMOUNT', width:120, sortable:true, align:'right', formatter:format_price,
					editor:{
						type:'numberbox',
						options:{
							required:true,
							min:0,
							precision:2,
							groupSeparator:','
						}  
					}
				},
				{field:'invoice_id', title:'INV.ID', width:50, sortable:false, hidden:true},
				{field:'id', title:'ID', width:50, sortable:false, formatter:greyField}
			]],
			// title:'',
			fit:false,
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			idField:'id', sortName: 'id', sortOrder: 'asc', multiSort: true,
			queryParams: { invoice_id: $('#id').val() },
			onSelect:function(rowIndex, rowData){ 
				selectIndex = rowIndex 
			},
			onEdit: function(rowIndex, rowData){
				var editors = $('#grid3').edatagrid('getEditors', rowIndex);
				var coa_d = editors[2];
				var coa_c = editors[3];
				
				$(coa_d.target).combogrid('grid').datagrid( 'load', {q: rowData.coa_d } );
				$(coa_c.target).combogrid('grid').datagrid( 'load', {q: rowData.coa_c } );
			},
			onSave: function(index,row){
				dhtmlx.message("<?php echo l('success_saving');?>");
				$("#grid3").datagrid('load', {invoice_id: $('#id').val()});  
			},
			onError: function(index,row){
				dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:row.errorMsg });
			}
		});

		$('#grid3').edatagrid('getPager').pagination({  
			layout:['prev','links','next','refresh'],
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'<?php echo l('form_btn_add');?>',
				iconCls:'icon-add',  
				handler:function(){ crud3('c') }  
			},{  
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
			
			if ( $('#id').val() == '' )
			{
				if ( !$('#forms').form('validate') ) 
					return;
					
				$('#forms').form('submit',{ url: "<?php echo site_url('billm/invoice/c');?>",  
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
							$('#id').val(result.id);
							$('#code').val(result.code); 
							
							if( $('#id').val() !== '') 
							{
								$('#grid3').edatagrid('addRow', { row:{ invoice_id: $('#id').val() } });
								return;
							}
						}  
					}  
				});  
			}
		
			if( $('#id').val() !== '') 
			{
				$('#grid3').edatagrid('addRow', { row:{ invoice_id: $('#id').val() } });
				return;
			}
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if ( $('#id').val() == '' )
				return;
			
			var selected = $('#grid3').datagrid('getSelected');
			var index = $(grid).datagrid('getRowIndex', selected);
			
			$('#grid3').edatagrid('editRow', index);
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'invoice'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if ( $('#id').val() == '' )
				return;
			
			$('#grid3').edatagrid('destroyRow');
		}
	}
	
</script>

</body>
</html>