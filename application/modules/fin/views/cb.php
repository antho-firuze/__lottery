<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-easyui/js/jquery.edatagrid.js"></script>
	</head>
<style>
	.label			{width:130px;}
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

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:750, height:560, closed:true, cache:false, modal:true">
	<form id="forms" method="post">
		<div class="easyui-tabs" style="width:auto;height:195px">
		<div title="GENERAL" style="padding:8px">
			<input type="hidden" id="id" name="id" />
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="label_col1"><label for="code">Doc. Code</label></td> 	
					<td><input class="easyui-validatebox" id="code" name="code" style="width:175px;" data-options="required:false" disabled /></td>
					<td class="label_col2"><label for="currency_id">Currency</label></td> 	
					<td><input class="easyui-combogrid" id="currency_id" name="currency_id" style="width:180px" data-options="
						url:'<?php echo site_url('systems/currency/r');?>',
						required:true, panelWidth:300, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
						pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, value:1, 
						columns: [[
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:80,sortable:true},
							{field:'id'	 ,title:'ID',width:10,sortable:false}
						]],
						onSelect: function(rowIndex, rowData){
							$('#currency_rate').val(rowData.currency_rate);
						}" /></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="date">Date</label></td> 	
					<td><input class="easyui-datebox" id="date" name="date" style="width:180px;" data-options="required:true, value:format_dmy()" /></td>
					<td class="label_col2"><label for="currency_rate">Exchange Rate</label></td> 	
					<td><input class="easyui-validatebox" id="currency_rate" name="currency_rate" style="width:175px;" data-options="required:false" readonly /></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="paym_recv_id">Type</label></td> 			
					<td><input class="easyui-combogrid" id="paym_recv_id" name="paym_recv_id" style="width:180px" data-options="
						url:'<?php echo site_url('fin/opt_paym_recv/r');?>',
						required:true, panelWidth:300, panelHeight:100, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
						pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, value:1, 
						columns: [[
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:80,sortable:true},
							{field:'id'	 ,title:'ID',width:10,sortable:false}
						]]" /></td>
					<td class="label_col2"><label for="cash_bank_id">Cash/Bank</label></td> 	
					<td><input class="easyui-combogrid" id="cash_bank_id" name="cash_bank_id" style="width:180px" data-options="
						url:'<?php echo site_url('fin/opt_cash_bank/r');?>',
						required:true, panelWidth:300, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
						pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, value:1, 
						columns: [[
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:80,sortable:true},
							{field:'id'	 ,title:'ID',width:10,sortable:false}
						]],
						onSelect: function(rowIndex, rowData){
							if (rowData.code=='CASH')
								$('#payment_type_id').combogrid('disable');
							else
								$('#payment_type_id').combogrid('enable');
						}" /></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="ref_no">Ref. No</label></td> 	
					<td><input class="easyui-validatebox" id="ref_no" name="ref_no" style="width:175px;" data-options="required:false" /></td>
					<td class="label_col2"><label for="coa_id">Account Code</label></td> 	
					<td><input class="easyui-combogrid" id="coa_id" name="coa_id" style="width:180px" data-options="
						url:'<?php echo site_url('acc/coa/r');?>',
						required:false, panelWidth:500, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
						pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
						columns: [[
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:80,sortable:true},
							{field:'id'	 ,title:'ID',width:5,sortable:false}
						]]" /></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="">Note</label></td> 	
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
	function updateActions(cb, index){
		cb.datagrid('updateRow',{
			index: index,
			row:{}
		});
	}
	function getRowIndex(target){
		var tr = $(target).closest('tr.datagrid-row');
		return parseInt(tr.attr('datagrid-row-index'));
	}
	function editrow(cb, target){
		cb.datagrid('beginEdit', getRowIndex(target));
		target = getRowIndex(target);
	}
	function deleterow(cb, target){
		$.messager.confirm('Confirm','Are you sure?',function(r){
			if (r){
				cb.datagrid('deleteRow', getRowIndex(target));
			}
		});
	}
	function saverow(cb, target){
		if (cb[0].id == 'grid2')
		{
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_save');?>", callback: function(r){  
				if (r){  
				
					cb.datagrid('endEdit', getRowIndex(target));
					var rows = cb.datagrid('getSelections');
					
					var url = "<?php echo site_url('fin/cb_dt/u');?>";
					$.post(url,{ 
						
						data:JSON.stringify(rows)
						
					},function(result){  
						if (result.success){  
							$('#grid2').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_saving');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							$('#grid2').datagrid('reload');    // reload the user data  
						}  
					},'json');  
				}
				else
					return;
			}  
			});  
		}
		else
			cb.datagrid('endEdit', getRowIndex(target));
	}
	function cancelrow(cb, target){
		cb.datagrid('cancelEdit', getRowIndex(target));
	}
	function insert(cb){
		var row = cb.datagrid('getSelected');
		if (row){
			var index = cb.datagrid('getRowIndex', row);
		} else {
			index = 0;
		}
		cb.datagrid('insertRow', {
			index: index,
			row:{
				status:'P'
			}
		});
		cb.datagrid('selectRow',index);
		cb.datagrid('beginEdit',index);
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
					$('#dlg2').dialog('close');
					break;
			}
		});
	});
	
	// GRID =====
	$(function(){ 
	
		$("#grid").datagrid({        
			// title:'',
			url:'<?php echo site_url('fin/cb/r')?>',	
			columns:[[
				{field:"code", title:'CODE', width:110, sortable:true},
				{field:"date", title:'DATE', width:80, sortable:true, align:'center'},
				{field:"payment_receive", title:'TYPE', width:100, sortable:true},
				{field:"currency_code", title:'CURR', width:50, sortable:true},
				{field:"cash_bank_code", title:'CASH/BANK', width:75, sortable:true},
				{field:"coa_code", title:'ACCOUNT', width:150, sortable:true},
				{field:"ref_no", title:'REF. NO', width:150, sortable:true},
				{field:"total_amount", title:'TOTAL', width:100, sortable:true, align:'right', formatter:format_price},
				{field:"note", title:'NOTE', width:250, sortable:true, editor:{ type:'textarea' }},
				{field:"void", title:'VOID', width:50, sortable:true, align:'center', formatter:format_checkbox},
				{field:"posted", title:'POSTED', width:60, sortable:true, align:'center', formatter:format_checkbox},
				{field:'id', title:'ID', width:50, formatter:greyField}
			]],
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			idField:'id', sortName: 'id', sortOrder: 'desc', /* multiSort: true, */
			queryParams: { date_f: $('#date_f').datebox('getValue'), date_t: $('#date_t').datebox('getValue'), status: $('#status_filter').combobox('getValue'), findKey: 0, findVal: 0 },
			onDblClickRow: function(rowIndex, rowData) { crud('u') },
			onClickRow: function(rowIndex, rowData){
				$("#grid2").datagrid('load', {cb_id: rowData.id});  
				$("#grid3").datagrid('load', {cb_id: rowData.id});  
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
			},{  
				text:'<?php echo l('form_btn_void');?>',
				iconCls:'icon-void',  
				handler:function(){ crud('v') }  
			},{  
				text:'<?php echo l('form_btn_post');?>',
				iconCls:'icon-post',  
				handler:function(){ crud('p') }  
			},{  
				text:'<?php echo l('form_btn_unpost');?>',
				iconCls:'icon-unpost',  
				handler:function(){ crud('up') }  
			},{  
				text:'<?php echo l('form_btn_report');?>',
				iconCls:'icon-reports',  
				handler:function(){ crud('report') }  
			}]  
		});           

		setKeyTrapping_grid('#grid', 'crud');
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('fin/cb');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'fin', 'cb'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('reset'); 
			$('#coa_id').combogrid('grid').datagrid( 'load', {q: ''} );
			$("#grid3").datagrid('load', {cb_id: ''});  
			
			$('#dlg').dialog({
				width: 850,
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
			$('#currency_id').next().find('input').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'fin', 'cb'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return;
				
			$('#forms').form('reset'); 
			$('#forms').form('load', row); 
			
			$('#dlg').dialog({
				width: 850,
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
			
			$('#date').datebox('setValue', format_dmy(row.date));
			$('#currency_id').next().find('input').focus();
		}
		
		/* if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'fin', 'cb'))?1:0; ?>;
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
			var is_allow = <?php echo (is_allow('u', 'fin', 'cb'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return;
				
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_void');?>", callback: function(r){  
				if (r){  
					$.post(url,{
					
						id:row.id
					
					},function(result){  
						if (result.success){  
							$('#grid').datagrid('reload');    // reload the user data  
							$('#grid2').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_void');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}
		
		if ( mode=='p' ) {
			var is_allow = <?php echo (is_allow('u', 'fin', 'cb'))?1:0; ?>;
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
			var is_allow = <?php echo (is_allow('u', 'fin', 'cb'))?1:0; ?>;
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
			
		url = "<?php echo site_url('fin/cb');?>/"+mode;
		
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
			url:"<?php echo site_url('fin/cb_dt/r')?>",	
			columns:[[
				// {field:"void", title:'VOID', width:50, sortable:true, align:'center', formatter:format_checkbox},
				{field:'coa_id', title:'ACC. CODE', width:150, 
					formatter:function(value, row){
						return row.coa_code;
					},
					editor:{ 
						type:'combogrid', 
						options:{
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:300, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:false}
							]]
						}						
					}
				},
				{field:'ref_no', title:'REF. NO', width:150, sortable:true, editor:{ type:'validatebox' }},
				{field:"note", title:'NOTE', width:200, sortable:true},
				{field:"amount", title:'AMOUNT', width:120, sortable:true, align:'right', formatter:format_price, 
					editor:{
						type:'numberspinner',
						options:{
							required:true,
							min:0,
							precision:2,
							groupSeparator:','
						}  
					}
				},
				/* {field:'action',title:'ACTION',width:80,align:'center',
					formatter:function(value,row,index){
						if (row.editing){
							var s = '<a href="#" class="icon-save" title="Save" onclick="saverow($(\'#grid2\'), this)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> ';
							var c = '<a href="#" class="icon-undo" title="Cancel changes" onclick="cancelrow($(\'#grid2\'), this)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
							return s+'&nbsp;&nbsp;'+c;
						} else {
							var e = '<a href="#" class="icon-edit" title="Edit" onclick="editrow($(\'#grid2\'), this)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> ';
							var d = '<a href="#" class="icon-delete" title="Delete" onclick="deleterow($(\'#grid2\'), this)">Delete</a>';
							if (row.id) return e;
						} 
					}
				}, */
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
			pageNumber:1, pageSize:50, pageList:[50,100], 
			queryParams: { cb_id: 0 },
			onDblClickRow: function(rowIndex, rowData) {
				target = rowIndex;
				$(this).datagrid('beginEdit', rowIndex);
				var ed = $(this).datagrid('getEditor', { index:rowIndex, field:'doc_no' });
				$(ed.target).focus();
			},
			onBeforeEdit:function(index,row){
				row.editing = true;
				updateActions($(this), index);
			},
			onAfterEdit:function(index,row){
				row.editing = false;
				updateActions($(this), index);
			},
			onCancelEdit:function(index,row){
				row.editing = false;
				updateActions($(this), index);
			}
		});
		
	});

	// GRID 3 =====
	var selectIndex;
	
	$(function(){  
	
		$("#grid3").edatagrid({        
			url:'<?php echo site_url('fin/cb_dt/r')?>',	
			saveUrl:'<?php echo site_url('fin/cb_dt/c');?>',
			updateUrl:'<?php echo site_url('fin/cb_dt/u');?>',
			destroyUrl:'<?php echo site_url('fin/cb_dt/d');?>',
			columns:[[
				{field:'coa_id', title:'ACC. CODE', width:150, 
					formatter:function(value, row){
						return row.coa_code;
					},
					editor:{ 
						type:'combogrid', 
						options:{
							url:'<?php echo site_url('acc/coa/r');?>',
							required:false, panelWidth:300, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:false}
							]]
						}						
					}
				},
				{field:'ref_no', title:'REF. NO', width:150, sortable:true, editor:{ type:'validatebox' }},
				{field:"note", title:'NOTE', width:200, sortable:true, editor:{ type:'textarea' }},
				{field:"amount", title:'AMOUNT', width:120, sortable:true, align:'right', formatter:format_price, 
					editor:{
						type:'numberspinner',
						options:{
							required:true,
							min:0,
							precision:2,
							groupSeparator:','
						}  
					}
				},
				{field:'cb_id', title:'cb_id', width:50, sortable:false, hidden:true},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			// title:'',
			fit:false,
			rownumbers:true,
			singleSelect:false,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			idField:'id', sortName: 'id', sortOrder: 'asc', multiSort: true,
			queryParams: { cb_id: $('#id').val() },
			onSelect:function(rowIndex, rowData){ 
				selectIndex = rowIndex 
			},
			onEdit: function(rowIndex, rowData){
				var editors = $('#grid3').edatagrid('getEditors', rowIndex);
				var coa_id = editors[0];
				
				$(coa_id.target).combogrid('grid').datagrid( 'load', {q: rowData.coa_id } );
			},
			onSave: function(index,row){
				dhtmlx.message("<?php echo l('success_saving');?>");
				$("#grid3").datagrid('load', {cb_id: $('#id').val()});  
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
		
		url = "<?php echo site_url('fin/cb_dt');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'fin', 'cb'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if ( $('#id').val() == '' )
			{
				if ( !$('#forms').form('validate') ) 
					return;
					
				$('#forms').form('submit',{ url: "<?php echo site_url('fin/cb/c');?>",  
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
								$('#grid3').edatagrid('addRow', { row:{ cb_id: $('#id').val() } });
								return;
							}
						}  
					}  
				});  
			}
			
			if( $('#id').val() !== '') 
			{
				$('#grid3').edatagrid('addRow', { row:{ cb_id: $('#id').val() } });
				return;
			}
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'fin', 'cb'))?1:0; ?>;
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
			var is_allow = <?php echo (is_allow('u', 'fin', 'cb'))?1:0; ?>;
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