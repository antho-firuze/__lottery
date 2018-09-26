<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<style>
.label			{width:170px;}
.label_col1		{width:100px; vertical-align:text-top;}
.label_col2		{padding-left:10px; width:100px; vertical-align:text-top;}
</style>
<body>
		
<div id="cc" class="easyui-layout">  
	<div data-options="region:'center'">
		<div id="rr" class="easyui-layout" data-options="fit:true">  
			<div data-options="region:'north',split:true" style="height:370px">
				<table id="grid" style='height:100%; width:100%;' toolbar="#tb"></table>
				<div id="tb" style="padding:7px">  
					&nbsp;
					<div style="display:inline;">
						<!--
						<div style="float:left;">
							<label for="is_active">&nbsp;STATUS :&nbsp;</label>
							<select class="easyui-combobox" id="is_active" style="width:110px;" data-options="
								editable:false,panelHeight:'auto',
								onSelect:function(rec){
									goFilter();
								}">
								<option value="ALL">ALL</option>  
								<option value="1">ACTIVE</option>  
								<option value="0">NOT ACTIVE</option>  
							</select> 
						</div> 
						-->
						<div style="float:right;"><input id="ss" class="easyui-searchbox" style="width:300px" data-options="searcher:goFilter, prompt:'Please Input Value',menu:'#mm'"></input></div> 
						<div id="mm" style="width:145px">  
							<div data-options="name:'ALL',iconCls:'icon-ok'">ALL</div>  
							<div data-options="name:'name'">NAME</div>  
							<div data-options="name:'note'">NOTE</div>  
						</div> 
					</div> 
				</div>
			</div>  
			<div data-options="region:'center'">
				<div class="easyui-tabs" style="width:auto;height:auto" data-options="fit:true">
					<div title="PHASE" style="padding:8px">
						<table id="grid2" style='height:100%; width:100%;'></table>
					</div>  
					<div title="RULES" style="padding:8px">
						<table id="grid3" style='height:100%; width:100%;'></table>
					</div>  
				</div>  
			</div>  
		</div>  
	</div>  
</div>

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:600, height:360, closed:true, cache:false, modal:true">
	<form id="forms" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="DATA ENTRY" style="padding:8px">
			<table>
				<tr>
					<td class="label_col1"><label for="id">Period ID</label></td> 	
					<td><input class="easyui-validatebox" id="id" name="id" style="width:145px; border:1px solid #ccc;" disabled /></td>
					<td class="label_col2"><label for="name">Name</label></td> 	
					<td><input class="easyui-validatebox" id="name" name="name" style="width:145px; border:1px solid #ccc;" data-options="required:true" /></td>
				</tr>
				<tr>
					<td><label for="date_from">Date From</label></td> 	
					<td><input class="easyui-datebox" id="date_from" name="date_from" style="width:145px;" data-options="required:true, value:format_dmy()" /></td>
					<td class="label_col2"><label for="date_to">Date To</label></td> 	
					<td><input class="easyui-datebox" id="date_to" name="date_to" style="width:145px;" data-options="required:true, value:format_dmy()" /></td>
				</tr>
				<!--
				<tr>
					<td><label for="coef_rate_value">Coef. Rate Value</label></td> 	
					<td><input class="easyui-numberspinner" id="coef_rate_value" name="coef_rate_value" style="width:145px" data-options="required:false,min:1,precision:0,groupSeparator:',',decimalSeparator:'.',value:100000" /></td>
					<td class="label_col2"><label for="coef_rate_point">Coef. Rate Point</label></td> 	
					<td><input class="easyui-numberspinner" id="coef_rate_point" name="coef_rate_point" style="width:145px" data-options="required:false,min:1,precision:0,groupSeparator:',',decimalSeparator:'.',value:1" /></td>
				</tr>
				-->
				<tr>
					<td><label for="max_receipt_daily">Max Daily Rcp</label></td> 	
					<td><input class="easyui-numberspinner" id="max_receipt_daily" name="max_receipt_daily" style="width:145px" data-options="required:false,min:1,precision:0,groupSeparator:',',decimalSeparator:'.',value:1" /></td>
					<!--
					<td><label for="max_receipt_periodic">Max Periodic Receipt</label></td> 	
					<td><input class="easyui-numberspinner" id="max_receipt_periodic" name="max_receipt_periodic" style="width:145px" data-options="required:false,min:1,precision:0,groupSeparator:',',decimalSeparator:'.',value:30" /></td>
					-->
				</tr>
			</table>
		</div>
		<div title="NOTES" style="padding:8px">
			<table>
				<tr>
					<td class="label_col1"><label for="note">Note</label></td> 		
					<td><textarea id="note" name="note" style="height:150px; width:409px; border:1px solid #ccc;"></textarea></td>
				</tr>
			</table>
		</div>
		<div title="DOCUMENT LOG" style="padding:10px">
			<table>
				<tr>
					<td class="label_col1">Create By</td>			
					<td><input name="create_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
					<td class="label_col2">Create Date</td>			
					<td><input name="create_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
				</tr>
				<tr>
					<td class="label_col1">Update By</td>			
					<td><input name="update_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
					<td class="label_col2">Update Date</td>			
					<td><input name="update_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
				</tr>
			</table>
		</div>
	</div>
	</form>
</div>

<div id="dlg2" class="easyui-dialog" style="padding:10px" data-options="width:550, height:260, closed:true, cache:false, modal:true">
	<form id="forms2" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="DATA" style="padding:8px">
			<input type="hidden" id="id" name="id" />
			<input type="hidden" id="period_id" name="period_id" />
			<table>
				<tr>
					<td class="label_col1"><label for="name">Phase Name</label></td> 	
					<td><input class="easyui-validatebox" id="name" name="name" style="width:145px; border:1px solid #ccc;" data-options="required:true" /></td>
				</tr>
				<tr>
					<td><label for="date_from">Date From</label></td> 	
					<td><input class="easyui-datebox" id="date_from" name="date_from" style="width:145px;" data-options="required:true, value:start_month()" /></td>
					<td class="label_col2"><label for="date_from">Date To</label></td> 	
					<td><input class="easyui-datebox" id="date_to" name="date_to" style="width:145px;" data-options="required:true, value:end_month()" /></td>
				</tr>
			</table>
		</div>
	</div>
	</form>
</div>

<div id="dlg3" class="easyui-dialog" style="padding:10px" data-options="width:600, height:360, closed:true, cache:false, modal:true">
	<form id="forms3" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="DATA" style="padding:8px">
			<input type="hidden" id="id" name="id" />
			<input type="hidden" id="period_id" name="period_id" />
			<table>
				<tr>
					<td class="label_col1"><label for="period_name">Period</label></td> 			
					<td><input class="easyui-validatebox" id="period_name" name="period_name" style="width:145px; border:1px solid #ccc;" data-options="required:true" disabled /></td>
					<td class="label_col2"><label for="period_phase_id">Phase</label></td> 			
					<td><input class="easyui-combogrid" id="period_phase_id" name="period_phase_id" style="width:145px;" 
						data-options="
							url:'<?php echo site_url('mpoint/pnt_period_phase/r');?>',
							required:false, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:150,sortable:true},
								{field:'id'	 ,title:'ID',width:20,sortable:true, hidden:true}
							]]" />
					</td>
				</tr>
				<tr>
					<td class="label_col1"><label for="coef_rate_value">Rate Value</label></td> 	
					<td><input class="easyui-numberspinner" id="coef_rate_value" name="coef_rate_value" style="width:145px" data-options="required:true,min:0,precision:2,groupSeparator:',',decimalSeparator:'.',value:100000" /></td>
					<td class="label_col2"><label for="coef_rate_point">Rate Point</label></td> 	
					<td><input class="easyui-numberspinner" id="coef_rate_point" name="coef_rate_point" style="width:145px" data-options="required:true,min:0,precision:0,groupSeparator:',',decimalSeparator:'.',value:1" /></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="payment_type_cond">Payment Type</label></td> 			
					<td colspan="3">
						<select class="easyui-combobox" id="payment_type_cond" name="payment_type_cond" style="width:90px;" data-options="editable:false,panelHeight:'auto'">
							<option value="0">IS IN</option>  
							<option value="1">IS NOT IN</option>  
						</select> 
						<input class="easyui-combogrid" id="payment_type" name="payment_type" style="width:320px" 
							data-options="
								url:'<?php echo site_url('mpoint/opt_payment_type/r');?>',
								required:false, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...', 
								pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:false,
								multiple:true, multiline:true, 
								columns: [[
									{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
									{field:'name',title:'NAME',width:150,sortable:true},
									{field:'id'	 ,title:'ID',width:20,sortable:true}
								]]" />
					</td>
				</tr>
				<tr>
					<td class="label_col1"><label for="store_type_cond">Store Type</label></td> 			
					<td colspan="3">
						<select class="easyui-combobox" id="store_type_cond" name="store_type_cond" style="width:90px;" data-options="editable:false,panelHeight:'auto'">
							<option value="0">IS IN</option>  
							<option value="1">IS NOT IN</option>  
						</select> 
						<input class="easyui-combogrid" id="store_type" name="store_type" style="width:320px" 
						data-options="
							url:'<?php echo site_url('mpoint/opt_store_type/r');?>',
							required:false, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:false,
							multiple:true, multiline:true, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:150,sortable:true},
								{field:'id'	 ,title:'ID',width:20,sortable:true}
							]]" />
					</td>
				</tr>
				<tr>
					<td class="label_col1"><label for="store_cond">Store</label></td> 			
					<td colspan="3">
						<select class="easyui-combobox" id="store_cond" name="store_cond" style="width:90px;" data-options="editable:false,panelHeight:'auto'">
							<option value="0">IS IN</option>  
							<option value="1">IS NOT IN</option>  
						</select> 
						<input class="easyui-combogrid" id="store" name="store" style="width:320px" 
						data-options="
							url:'<?php echo site_url('mpoint/store/r');?>',
							required:false, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:false,
							multiple:true, multiline:true, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:150,sortable:true},
								{field:'id'	 ,title:'ID',width:20,sortable:true}
							]]" />
					</td>
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
	
	function goFilter( value, name ) {
		if(typeof(value)==='undefined') value = $('#ss').searchbox('getValue');
		if(typeof(name)==='undefined') name = $('#ss').searchbox('getName');
	
		$('#grid').datagrid('load',{  
			findKey: name,
			findVal: value
		});
	}
	
	// NEXT TO LOAD (THIS VALUE CAN BE CHANGE)
	$(function(){  
	
		$(document).on("keydown", function(e){ 
			switch(e.keyCode){
				case 27:	// esc
					$('#dlg').dialog('close');
					break;
			}
		});
	});
	
	// GRID =====
	$(function(){  
		$("#grid").datagrid({        
			url:'<?php echo site_url('mpoint/pnt_period/r')?>',	
			columns:[[
				{field:'default', title:'DEFAULT', width:60, sortable:true, 
					formatter:function( value, rowData, rowIndex ){
						if ( parseInt(rowData.default) )
							return '<center><span class="icon-ok">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></center>';
					}
				},
				{field:"name", title:'PERIOD NAME', width:200},
				{field:"date_from", title:'DATE FROM', width:100},
				{field:"date_to", title:'DATE TO', width:100},
				// {field:"coef_rate_value", title:'COEF. RATE VALUE', width:150},
				// {field:"coef_rate_point", title:'COEF. RATE POINT', width:150},
				{field:"max_receipt_daily", title:'MAX RECEIPT (DAILY)', width:150},
				// {field:"max_receipt_periodic", title:'MAX RECEIPT (PERIODIC)', width:150},
				{field:"note", title:'NOTE', width:250},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
				{field:"update_by_name", title:'UPDATE BY', width:100, sortable:true},
				{field:"update_date", title:'UPDATE DATE', width:103, sortable:true},
				{field:'id', title:'ID', width:60, sortable:true,formatter:greyField}
			]],
			// title:'PHD',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50, 100,200],
			idField:'id', sortName: 'id', sortOrder: "desc", multiSort: true,
			onDblClickRow: function(rowIndex, rowData) { crud('u') }, 
			onClickRow: function(rowIndex, rowData){ 
				$("#grid2").datagrid('load', {period_id: rowData.id});  
				$("#grid3").datagrid('load', {period_id: rowData.id});  
			}
		});

		$('#grid').datagrid('getPager').pagination({  
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'ADD',
				iconCls:'icon-add',  
				handler:function(){ crud('c') }  
			},{  
				text:'EDIT',
				iconCls:'icon-edit',  
				handler:function(){ crud('u') }  
			},{  
				text:'DELETE',
				iconCls:'icon-remove',  
				handler:function(){ crud('d') }  
			},{  
				text:'SET DEFAULT',
				iconCls:'icon-ok',  
				handler:function(){ crud('default') }  
			}]  
		});           
		
		setKeyTrapping_grid('#grid', 'crud');
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('mpoint/pnt_period');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'mpoint', 'pnt_period'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('reset'); 
			
			$('#dlg').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save();	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			
			$('#id').val('AUTO NUMBER');
			$('#name').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'mpoint', 'pnt_period'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return false;

			$('#forms').form('reset'); 
			$('#forms').form('load',row);  
			
			$('#dlg').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save();	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");
			
			$('#date_from').datebox('setValue', format_dmy(row.date_from));
			$('#date_to').datebox('setValue', format_dmy(row.date_to));
			$('#name').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'mpoint', 'pnt_period'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;

			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
				if (r){  
					$.post( url, {
						id:row.id
					}, function(result){  
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
		
		if ( mode=='default' ) {
			var is_allow = <?php echo (is_allow('u', 'mpoint', 'pnt_period'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;

			$.post( url, {
				id:row.id
			}, function(result){  
				if (result.success){  
					$('#grid').datagrid('reload');    // reload the user data  
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},'json');  
		}
		
		if ( mode=='reports' ) {
			// $('#date_fr').datebox('setValue', start_month());
			// $('#date_to').datebox('setValue', end_month());
		}
	}
	
	function btn_save() {  
		$('#forms').form('submit',{  
			url: url,  
			onSubmit: function(param){  
				if ( $(this).form('validate') ) {
					$('#id').attr('disabled', false);
				} else {
					$('#id').attr('disabled', true);
				}
			
				return $(this).form('validate'); 
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
					$('#id').attr('disabled', true);
					
				} else {  
					$('#dlg').dialog('close');      // close the dialog  
					$('#grid').datagrid('reload');    // reload the user data  
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 

	/* function btn_report() { 
		$('#forms4').form('submit',{  
			url: "<?php echo site_url('reports/rpt_phd_01');?>",  
			onSubmit: function(){  
				return $(this).form('validate'); 
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					$('#dlg4').dialog('close');      // close the dialog 
					$('#forms4').form('submit',{  
						url: "<?php echo site_url('reports/rpt_phd_01/1');?>"  
					});  
					// window.open("<?php echo site_url('reports/rpt_phd_01/1');?>");
				}  
			}  
		});  
	}  */
	
	// GRID 2 =====
	$(function(){  
		$("#grid2").datagrid({        
			url:"<?php echo site_url('mpoint/pnt_period_phase/r')?>",
			columns:[[
				{field:"name", title:'NAME', width:200},
				{field:"date_from", title:'DATE FROM', width:100},
				{field:"date_to", title:'DATE TO', width:100},
				{field:'id', title:'PHA ID', width:60, sortable:true, formatter:greyField}
			]],
			// title:'PHASE',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50, 100,200],
			idField:'id', sortName: 'id', sortOrder: "desc",
			queryParams: { period_id: 0 },
			onDblClickRow: function(rowIndex, rowData) { crud2('u') }
		});

		$('#grid2').datagrid('getPager').pagination({  
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
		
		url = "<?php echo site_url('mpoint/pnt_period_phase');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'mpoint', 'pnt_period'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;

			$('#forms2').form('reset');  
			$('#dlg2').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save2();	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create_detail');?>");
			
			$('#forms2 #period_id').val(row.id);  
			$('#forms2 #name').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'mpoint', 'pnt_period'))?1:0; ?>;
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
			
			$('#forms2').form('reset'); 
			$('#forms2').form('load',row2);  
			
			$('#dlg2').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save2();	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg2').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update_detail');?>");
			
			$('#forms2 #date_from').datebox('setValue', format_dmy(row2.date_from));
			$('#forms2 #date_to').datebox('setValue', format_dmy(row2.date_to));
			$('#forms2 #name').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'mpoint', 'pnt_period'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;

			var row = $('#grid2').datagrid('getSelected');  
			if (!row)
				return false;

			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
				if (r){  
					$.post(url,{id:row.id},function(result){  
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
	
	function btn_save2() {  
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
					$('#grid2').datagrid('reload');    // reload the user data  
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 
	
	// GRID 3 =====
	$(function(){  
		$("#grid3").datagrid({        
			url:"<?php echo site_url('mpoint/pnt_period_rule/r')?>",
			columns:[[
				{field:"coef_rate_value", title:'VALUE', width:100},
				{field:"coef_rate_point", title:'POINT', width:100},
				{field:"phase_name", title:'PHASE', width:100},
				{field:"payment_type_names", title:'PAYMENT TYPE', width:250, 
					formatter:function( value, rowData, rowIndex ){
						if ( value != null ) 
							if ( parseInt(rowData.payment_type_cond) )
								return 'IS NOT IN ( '+value+' )';
							else
								return 'IS IN ( '+value+' )';
						else 
							return '';
					}
				},
				{field:"store_type_names", title:'STORE TYPE', width:250, 
					formatter:function( value, rowData, rowIndex ){
						if ( value != null ) 
							if ( parseInt(rowData.store_type_cond) )
								return 'IS NOT IN ( '+value+' )';
							else
								return 'IS IN ( '+value+' )';
						else 
							return '';
					}
				},
				{field:"store_names", title:'STORE NAME', width:250, 
					formatter:function( value, rowData, rowIndex ){
						if ( value != null ) 
							if ( parseInt(rowData.store_cond) )
								return 'IS NOT IN ( '+value+' )';
							else
								return 'IS IN ( '+value+' )';
						else 
							return '';
					}
				},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField},
			]],
			// title:'PHASE',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50, 100,200],
			idField:'id', sortName: 'id', sortOrder: "desc",
			queryParams: { period_id: 0 },
			onDblClickRow: function(rowIndex, rowData) { crud3('u') }
		});

		$('#grid3').datagrid('getPager').pagination({  
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
		
		url = "<?php echo site_url('mpoint/pnt_period_rule');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'mpoint', 'pnt_period'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;

			$('#forms3').form('reset'); 
			$('#forms3 #period_phase_id').combogrid({ queryParams:{period_id: row.id} });
			
			$('#dlg3').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save3();	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg3').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create_detail');?>");
			
			$('#forms3 #period_id').val(row.id);  
			$('#forms3 #period_name').val(row.name);  
			$('#forms3 #period_phase_id').next().find('input').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'mpoint', 'pnt_period'))?1:0; ?>;
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
			
			$('#forms3').form('reset'); 
			$('#forms3 #period_phase_id').combogrid({ queryParams:{period_id: row.id} });
			$('#forms3').form('load',row2);  
			
			$('#dlg3').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save3();	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg3').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update_detail');?>");
			
			if (row2.payment_type_ids)
				$('#forms3 #payment_type').combogrid('setValues', row2.payment_type_ids.split(','));
			if (row2.store_type_ids)
				$('#forms3 #store_type').combogrid('setValues', row2.store_type_ids.split(','));
			if (row2.store_ids)
				$('#forms3 #store').combogrid('setValues', row2.store_ids.split(','));
			$('#forms3 #period_phase_id').next().find('input').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'mpoint', 'pnt_period'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;

			var row = $('#grid3').datagrid('getSelected');  
			if (!row)
				return false;

			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
				if (r){  
					$.post(url,{id:row.id},function(result){  
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
	
	function btn_save3() {  
		$('#forms3').form('submit',{  
			url: url,  
			onSubmit: function(param){  
				param.payment_type  = $('#forms3 #payment_type').combogrid('getValues');
				param.store_type  	= $('#forms3 #store_type').combogrid('getValues');
				param.store  	 	= $('#forms3 #store').combogrid('getValues');

				return $(this).form('validate');  
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
					
				} else {  
					$('#dlg3').dialog('close');      // close the dialog  
					$('#grid3').datagrid('reload');    // reload the user data  
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 
	
</script>

</body>
</html>