<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<script type="text/javascript" src="<?php echo base_url()?>assets/jquery-form/jquery.form.min.js"></script>
	</head>
<style>
	.label		{width:170px;}
	.label_col1		{width:100px;vertical-align:text-top;}
	.label_col2		{padding-left:10px; width:100px;vertical-align:text-top;}
.progress { 
	position:relative; 
	width: 100%; 
	border: 1px solid #ddd; 
	padding: 1px; 
	border-radius: 3px; 
	}
.bar { 
	background-color: #B4F5B4; 
	width:0%; 
	height:20px; 
	border-radius: 3px; 
	}
.percent { 
	position: absolute; 
	display: inline-block; 
	top: 3px; 
	left:48%; 
	}
</style>
<body>
		
<div id="cc" class="easyui-layout">  
	<div data-options="region:'center'">
		<div class="easyui-layout" data-options="fit:true">  
			<div data-options="region:'center'">
				<div class="easyui-tabs" style="height:100%; width:100%;" data-options="fit:true">
					<div title="POWER READING" style="padding:8px">
						<table id="grid_power" style='height:100%; width:100%;' toolbar="#tb"></table>
					</div>
					<div title="WATER READING" style="padding:8px">
						<table id="grid_water" style='height:100%; width:100%;' toolbar="#tb"></table>
					</div>
				</div>
			</div>  
		</div>  
	</div>  
</div>

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

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:550, height:430, closed:true, cache:false, modal:true">
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
						<td colspan="2"><input class="easyui-validatebox" id="period_code" name="period_code" style="width:250px; border:1px solid #ccc;" data-options="required:false" readonly /></td>
					</tr>
					<tr>
						<td><label for="unit_code">Unit</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" id="unit_code" name="unit_code" style="width:250px; border:1px solid #ccc;" data-options="required:false" readonly /></td>
					</tr>
					<tr>
						<td><label for="customer_name">Customer</label></td> 			
						<td colspan="2"><input class="easyui-validatebox" id="customer_name" name="customer_name" style="width:250px; border:1px solid #ccc;" data-options="required:false" readonly /></td>
					</tr>
					<tr class="pwr">
						<td><label for="power_name">Power</label></td> 			
						<td colspan="2"><input class="easyui-validatebox" id="power_name" name="power_name" style="width:250px; border:1px solid #ccc;" data-options="required:false" readonly /></td>
					</tr>
					<tr class="wtr">
						<td><label for="water_name">Water</label></td> 			
						<td colspan="2"><input class="easyui-validatebox" id="water_name" name="water_name" style="width:250px; border:1px solid #ccc;" data-options="required:false" readonly /></td>
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

<div id="dlg_import" class="easyui-dialog" style="padding:10px;" data-options="width:400, height:200, closed:true, cache:false, modal:true, closed:true">
	<form id="forms_import" method="post">
	<table>
		<tr>
			<td>Upload : </td>
			<td><input type="file" id="userfile" name="userfile" style="width:300px; background:white; color:black;" /></td>
		</tr>
		<!--
		<tr>
			<td>&nbsp;</td>
			<td><img id="loading" src="<?php echo base_url();?>assets/images/loading.gif" style="display:none;"></td>
		</tr>
		-->
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="   Submit Data   " /></td>
		</tr>
	</table><br>
	<div class="progress">
		<div class="bar"></div>
		<div class="percent">0%</div>
	</div>
	</form>
</div>

<script>
	var url;
	
	$(function(){
		resizelayout();
		$(window).resize(resizelayout);
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
	
	function format_price( value, row ) {
		return accounting.formatMoney(value, '');
	}
	
	function format_checkbox( value, row ) {
		if ( parseInt(value) )
			return "<input type='checkbox' onclick='return false' onkeydown='return false' checked>";
		else
			return "<input type='checkbox' onclick='return false' onkeydown='return false'>";
	}
	
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
	
	// GRID POWER READING
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
				{field:'id', title:'ID', width:50, sortable:true}
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
			queryParams: { period_id: <?php echo $this->session->userdata('period_id');?> },
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
			},{  
				text:'<?php echo l('form_btn_download');?>',
				iconCls:'icon-download',  
				handler:function(){ crud_power('download') }  
			},{  
				text:'<?php echo l('form_btn_upload');?>',
				iconCls:'icon-upload',  
				handler:function(){ crud_power('upload') }  
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
			$('#curr_value').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_power').datagrid('getSelected');  
			if (!row)
				return;
				
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

		if ( mode=='download' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_download');?>", callback: function(r){  
				if (r){  
					
					window.location = url+'/'+<?php echo $this->session->userdata('period_id'); ?>;
					/* $.ajax({ 
						type: "POST", 
						url: url, 
						data: { 
							period_id: <?php echo $this->session->userdata('period_id'); ?> 
						},
						success: function(result) {
							var result = eval('(' + result + ')');
							if (result.success){  
								$('#grid_power').datagrid('reload');    // reload the user data  
								dhtmlx.message("<?php echo l('success_delete');?>");
							} else {  
								dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							}  
						}
					}); */
					
					// $('#forms').form('submit',{ url: url });
					
					/* $.post(url,{
					
						period_id: <?php echo $this->session->userdata('period_id'); ?>
					
					},function(result){ 
					
						dhtmlx.message("<?php echo l('success_download');?>");
						
					},'json');  */ 
				}}  
			});  
		}

		if ( mode=='upload' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms_import').form('reset'); 
			$('#forms_import').form('load',row); 
			
			$('#dlg_import').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg_import').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_import_power');?>");
			
			$('#forms_import').submit( btn_file_upload('power') );
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

	function btn_file_upload( type ) { 
		if(typeof(type)==='undefined') type = 'power';
		
		var bar = $('.bar');
		var percent = $('.percent');
		
		var dlg = $('#dlg_import');
		var forms = $('#forms_import');
		if ( type == 'power' ) 
			var grid = $('#grid_power');
		else
			var grid = $('#grid_water');
		
		forms.ajaxForm({
			url: url, 
			dataType: 'json',
			/* data: { 
				id: $('#form3 #id').val()
			}, */
			beforeSubmit: function(formData, jqForm, options) {
				if (!formData[0].value) {
					alert('Please choose a filename !'); 
					return false; 
				}
			},
			beforeSend: function() {
				var percentVal = '0%';
				bar.width(percentVal);
				percent.html(percentVal);
			},
			uploadProgress: function(event, position, total, percentComplete) {
				var percentVal = percentComplete + '%';
				bar.width(percentVal);
				percent.html(percentVal);
			},
			error: function(result) {
				var percentVal = '0%';
				bar.width(percentVal);
				percent.html(percentVal);
				
				if (result.responseText) {
					dhtmlx.alert({ width:400, title:"<?php echo l('notification');?>", type:"alert-error", text:result.responseText });
				}
			},
			success: function(result) {
				var percentVal = '100%';
				bar.width(percentVal);
				percent.html(percentVal);
				
				if (result.errorMsg){  
					var percentVal = '0%';
					bar.width(percentVal);
					percent.html(percentVal);
					
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					var percentVal = '0%';
					bar.width(percentVal);
					percent.html(percentVal);
					
					dlg.dialog('close');
					grid.datagrid('reload');
					dhtmlx.message("<?php echo l('success_upload');?>");
				}  
			},
			complete: function(xhr) {
				// status.html(xhr.responseText);
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
				{field:'id', title:'ID', width:50, sortable:true}
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
			queryParams: { period_id: <?php echo $this->session->userdata('period_id');?> },
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
			},{  
				text:'<?php echo l('form_btn_download');?>',
				iconCls:'icon-download',  
				handler:function(){ crud_water('download') }  
			},{  
				text:'<?php echo l('form_btn_upload');?>',
				iconCls:'icon-upload',  
				handler:function(){ crud_water('upload') }  
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
			$('#curr_value').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid_water').datagrid('getSelected');  
			if (!row)
				return;

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

		if ( mode=='download' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_download');?>", callback: function(r){  
				if (r){  
					
					window.location = url+'/'+<?php echo $this->session->userdata('period_id'); ?>;
					/* $.ajax({ 
						type: "POST", 
						url: url, 
						data: { 
							period_id: <?php echo $this->session->userdata('period_id'); ?> 
						},
						success: function(result) {
							var result = eval('(' + result + ')');
							if (result.success){  
								$('#grid_power').datagrid('reload');    // reload the user data  
								dhtmlx.message("<?php echo l('success_delete');?>");
							} else {  
								dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							}  
						}
					}); */
					
					// $('#forms').form('submit',{ url: url });
					
					/* $.post(url,{
					
						period_id: <?php echo $this->session->userdata('period_id'); ?>
					
					},function(result){ 
					
						dhtmlx.message("<?php echo l('success_download');?>");
						
					},'json');  */ 
				}}  
			});  
		}

		if ( mode=='upload' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'bill_calc'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms_import').form('reset'); 
			$('#forms_import').form('load',row); 
			
			$('#dlg_import').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg_import').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_import_water');?>");
			
			$('#forms_import').submit( btn_file_upload('water') );
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

</script>

</body>
</html>