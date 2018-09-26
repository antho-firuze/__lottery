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
					<div id="mm" style="width:120px">  
						<div data-options="name:'ALL',iconCls:'icon-ok'">ALL</div>  
						<div data-options="name:'code'">CODE</div>  
						<div data-options="name:'name'">NAME</div>  
						<div data-options="name:'contact_person'">CONTACT</div>  
						<div data-options="name:'address'">ADDRESS</div>  
					</div> 
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
		<div class="easyui-tabs" style="width:auto;height:175px">
		<div title="GENERAL" style="padding:8px">
			<input type="hidden" id="id" name="id" />
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="label_col1"><label for="code">Doc. Code</label></td> 	
					<td><input class="easyui-validatebox" id="code" name="code" style="width:175px;" data-options="required:false" disabled /></td>
					<td class="label_col2"><label for="journal_type_id">Type</label></td> 			
					<td><input class="easyui-combogrid" id="journal_type_id" name="journal_type_id" style="width:180px" data-options="
						url:'<?php echo site_url('acc/opt_journal_type/r');?>',
						required:true, panelWidth:300, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
						pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, value:1, 
						columns: [[
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:80,sortable:true},
							{field:'id'	 ,title:'ID',width:10,sortable:false}
						]]" /></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="date">Date</label></td> 	
					<td><input class="easyui-datebox" id="date" name="date" style="width:180px;" data-options="required:true, value:format_dmy()" /></td>
					<td class="label_col2"><label for="void">Void</label></td> 	
					<td><input type='checkbox' id='void' name='void' onclick='return false' onkeydown='return false'></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="ref_no">Ref. No</label></td> 	
					<td><input class="easyui-validatebox" id="ref_no" name="ref_no" style="width:175px;" data-options="required:false" /></td>
					<td class="label_col2"><label for="posted">Posted</label></td> 	
					<td><input type='checkbox' id='posted' name='posted' onclick='return false' onkeydown='return false'></td>
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
		<div id="p" style="width:auto; margin-top:13px; height:272px;">
			<table id="grid3" style='height:270px;'></table>
		</div>
	</form>
</div>

<div id="dlg_report" class="easyui-dialog" style="padding:5px" data-options="width:550, height:340, closed:true, cache:false, modal:true">
	<form id="forms_report" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="FORMS" style="padding:8px">
				<table>
					<tr>
						<td><a href="#" onclick="crud('form_journal_voucher');" class="easyui-linkbutton" data-options="iconCls:'icon-form'">PRINT SELECTED JOURNAL</a></td>	
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
			url:'<?php echo site_url('acc/gl/r')?>',	
			columns:[[
				{field:"code", title:'CODE', width:150, sortable:true},
				{field:"date", title:'DATE', width:80, sortable:true, align:'center'},
				{field:"ledger_type_name", title:'VOUCHER', width:150, sortable:true},
				{field:"ref_no", title:'REF. NO', width:250, sortable:true},
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
				$("#grid2").datagrid('load', {gl_id: rowData.id});  
				$("#grid3").datagrid('load', {gl_id: rowData.id});  
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
				handler:function(){ crud('post') }  
			},{  
				text:'<?php echo l('form_btn_unpost');?>',
				iconCls:'icon-unpost',  
				handler:function(){ crud('unpost') }  
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
		
		url = "<?php echo site_url('acc/gl');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'acc', 'gl'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('reset'); 
			$('#journal_type_id').combogrid('grid').datagrid( 'load', {q: ''} );
			$("#grid3").datagrid('load', {gl_id: ''});  
			
			$('#dlg').dialog({
				width: 950,
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
			$('#journal_type_id').next().find('input').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'acc', 'gl'))?1:0; ?>;
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
				width: 950,
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
			$('#void').prop('checked', parseInt(row.void));
			$('#posted').prop('checked', parseInt(row.posted));
			$('#journal_type_id').next().find('input').focus();
		}
		
		/* if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'acc', 'gl'))?1:0; ?>;
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
			var is_allow = <?php echo (is_allow('u', 'acc', 'gl'))?1:0; ?>;
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
		
		if ( mode=='post' ) {
			var is_allow = <?php echo (is_allow('u', 'acc', 'gl'))?1:0; ?>;
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
		
		if ( mode=='unpost' ) {
			var is_allow = <?php echo (is_allow('u', 'acc', 'gl'))?1:0; ?>;
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

		if ( mode=='form_journal_voucher' ) {
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
			{
				dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:"Please, choose a record !" });
				return;
			}
			
			url = "<?php echo site_url('acc/form_journal_voucher');?>/"+row.id;
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
			
		url = "<?php echo site_url('acc/gl');?>/"+mode;
		
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
			url:"<?php echo site_url('acc/gl_dt/r')?>",	
			columns:[[
				// {field:"void", title:'VOID', width:50, sortable:true, align:'center', formatter:format_checkbox},
				{field:'coa_code', title:'ACC. CODE', width:125},
				// {field:'ref_no', title:'REF. NO', width:150, sortable:true, editor:{ type:'validatebox' }},
				{field:"note", title:'NOTE', width:200, sortable:true},
				{field:'dc', title:'D/C', width:30},
				{field:'currency_code', title:'CURR', width:50},
				{field:"currency_rate", title:'RATE', width:90, sortable:true, align:'right', 
					formatter:function(value, rowData, rowIndex){
						if (rowData.id) return accounting.formatMoney(value, '');
					}
				},
				{field:"currency_amount", title:'AMOUNT', width:120, sortable:true, align:'right', formatter:format_price},
				{field:"debit", title:'DEBIT', width:120, sortable:true, align:'right', formatter:format_price},
				{field:"credit", title:'CREDIT', width:120, sortable:true, align:'right',  formatter:format_price},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			fit:true,
			// fitColumns:true,
			rownumbers:true,
			singleSelect:true,
			pagination:false,
			pagePosition:'bottom',
			showFooter: 'true',
			idField:'id', sortName: 'id', sortOrder: 'asc', multiSort: true,
			pageNumber:1, pageSize:50, pageList:[50,100], 
			queryParams: { gl_id: 0 },
			onDblClickRow: function(rowIndex, rowData) {}
		});
		
	});

	// GRID 3 =====
	var selectIndex;
	
	$(function(){  
	
		$("#grid3").edatagrid({        
			url:'<?php echo site_url('acc/gl_dt/r')?>',	
			saveUrl:'<?php echo site_url('acc/gl_dt/c');?>',
			updateUrl:'<?php echo site_url('acc/gl_dt/u');?>',
			destroyUrl:'<?php echo site_url('acc/gl_dt/d');?>',
			columns:[[
				{field:'coa_id', title:'ACC. CODE', width:125, 
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
							]],
							onSelect: function(rowIndex, rowData){
								var editors = $('#grid3').edatagrid('getEditors', selectIndex);
								$(editors[1].target).focus();
							}
						}						
					}
				},
				// {field:'ref_no', title:'REF. NO', width:150, sortable:true, editor:{ type:'validatebox' }},
				{field:"note", title:'NOTE', width:200, sortable:true, editor:{ type:'textarea' }},
				{field:'dc', title:'D/C', width:50,
					editor:{
						type:'combobox',
						height:10,
						options:{
							panelHeight:55, 
							valueField:'dc',
							textField:'dc',
							data:[{dc:'D'},{dc:'C'}],
							required:true,
							onSelect: function(rowIndex, rowData){
								var editors = $('#grid3').edatagrid('getEditors', selectIndex);
								$(editors[3].target).focus();
							}
						}
					}
				},
				{field:'currency_id', title:'CURR', width:50, 
					formatter:function(value, row){
						return row.currency_code;
					},
					editor:{ 
						type:'combogrid', 
						options:{
							url:'<?php echo site_url('systems/currency/r');?>',
							required:true, panelWidth:300, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, value:1, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:false}
							]],
							onSelect: function(rowIndex, rowData){
								var editors = $('#grid3').edatagrid('getEditors', selectIndex);
								var currency_rate = editors[3];
								var debit = editors[4];
								
								$(currency_rate.target).val(rowData.currency_rate);
								
								$(debit.target).focus();
							}
						}						
					}
				},
				{field:"currency_rate", title:'RATE', width:90, sortable:true, align:'right', formatter:format_price, 
					editor:{
						type:'numberspinner',
						options:{
							required:true,
							min:1,
							precision:2,
							groupSeparator:','
						}  
					}
				},
				{field:"currency_amount", title:'AMOUNT', width:120, sortable:true, align:'right', formatter:format_price, 
					editor:{
						type:'numberspinner',
						options:{
							value:0,
							required:true,
							min:0,
							precision:2,
							groupSeparator:','
						}  
					}
				},
				{field:"debit", title:'DEBIT', width:120, sortable:true, align:'right', formatter:format_price},
				{field:"credit", title:'CREDIT', width:120, sortable:true, align:'right', formatter:format_price},
				{field:'gl_id', title:'gl_id', width:50, sortable:false, hidden:true},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			// title:'',
			fit:false,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			showFooter: 'true',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			idField:'id', sortName: 'id', sortOrder: 'asc', multiSort: true,
			queryParams: { gl_id: $('#id').val() },
			onDblClickRow: function(rowIndex, rowData) { crud3('u') },
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
				$("#grid3").datagrid('load', {gl_id: $('#id').val()});  
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
		
		url = "<?php echo site_url('acc/gl_dt');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'acc', 'gl'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if ( $('#id').val() == '' )
			{
				if ( !$('#forms').form('validate') ) 
					return;
					
				$('#forms').form('submit',{ url: "<?php echo site_url('acc/gl/c');?>",  
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
								$('#grid3').edatagrid('addRow', { 
									row:{ 
										gl_id: $('#id').val(), 
										dc:'D', 
										currency_id:1, 
										currency_rate:1, 
										currency_amount:0, 
										debit:0, credit:0 
									} 
								});
								return;
							}
						}  
					}  
				});  
			}
			
			if( $('#id').val() !== '') 
			{
				$('#grid3').edatagrid('addRow', { 
					row:{ 
						gl_id: $('#id').val(), 
						dc:'D', 
						currency_id:1, 
						currency_rate:1, 
						currency_amount:0, 
						debit:0, credit:0 
					} 
				});
				return;
			}
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'acc', 'gl'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if ( $('#id').val() == '' )
				return;
			
			var selected = $('#grid3').edatagrid('getSelected');
			var index = $('#grid3').edatagrid('getRowIndex', selected);
			
			$('#grid3').edatagrid('editRow', index);
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'acc', 'gl'))?1:0; ?>;
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