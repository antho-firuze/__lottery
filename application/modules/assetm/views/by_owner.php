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

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:550, height:330, closed:true, cache:false, modal:true">
	<form id="forms" method="post">
		<div class="easyui-tabs" style="width:auto;height:auto">
			<div title="GENERAL" style="padding:8px">
				<input type="hidden" id="id" name="id" />
				<table>
					<tr>
						<td class="label_col1"><label for="customer_id">Customer</label></td> 			
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
						<td><label for="unit_id">Unit</label></td> 			
						<td colspan=2><input class="easyui-combogrid" type="text" id="unit_id" name="unit_id" style="width:175px" data-options="
							url:'<?php echo site_url('assetm/unit/r');?>',
							required:true, panelWidth:500, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'sqm',title:'AREA (SQM)',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:5,sortable:false}
							]]" /></td>
					</tr>
					<tr>
						<td class="label_col1"><label for="date_from">Date From</label></td> 		
						<td><input class="easyui-datebox" id="date_from" name="date_from" style="width:120px; border:1px solid #ccc;" data-options="required:true" /></td>
						<td class="label_col2"><label for="date_from">Date To</label></td> 		
						<td><input class="easyui-datebox" id="date_to" name="date_to" style="width:120px; border:1px solid #ccc;" data-options="required:true" /></td>
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

<div id="dlg2" class="easyui-dialog" style="padding:10px" data-options="width:550, height:330, closed:true, cache:false, modal:true">
	<form id="forms2" method="post">
		<div class="easyui-tabs" style="width:auto;height:auto">
			<div title="GENERAL" style="padding:8px">
				<input type="hidden" id="id" name="id" />
				<table>
					<tr>
						<td class="label_col1"><label for="customer_code">Code</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="customer_code" name="customer_code" style="width:175px; border:1px solid #ccc;" data-options="required:true" disabled /></td>
					</tr>
					<tr>
						<td class="label_col1"><label for="customer_name">Name</label></td> 			
						<td><input class="easyui-validatebox" type="text" id="customer_name" name="customer_name" style="width:175px; border:1px solid #ccc;" data-options="required:true" /></td>
					</tr>
					<tr>
						<td><label for="email">Email</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="email" name="email" style="width:175px; border:1px solid #ccc;" data-options="required:false, validType:'email'" /></td>
					</tr>
					<tr>
						<td><label for="contact_person">Contact Person</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="contact_person" name="contact_person" style="width:175px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
				</table>
			</div>
			<div title="NPWP" style="padding:8px">
				<table>
					<tr>
						<td class="label_col1"><label for="name">NPWP</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="npwp" name="npwp" style="width:175px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td class="label_col1"><label for="npwp_name">NPWP Name</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="npwp_name" name="npwp_name" style="width:175px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td class="label_col1"><label for="npwp_address">NPWP Address</label></td> 		
						<td colspan="3"><textarea id="npwp_address" name="npwp_address" style="height:50px; width:355px; border:1px solid #ccc;"></textarea></td>
					</tr>
				</table>
			</div>
			<div title="ADDRESS" style="padding:8px">
				<table>
					<tr>
						<td class="label_col1"><label for="address">Address</label></td> 		
						<td><textarea id="address" name="address" style="height:50px; width:355px; border:1px solid #ccc;"></textarea></td>
					</tr>
					<tr>
						<td><label for="phone">Phone</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="phone" name="phone" style="width:175px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="fax">Fax</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="fax" name="fax" style="width:175px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<!--
					<tr>
						<td><label for="country">Country</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="country" name="country" style="width:145px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="state">State</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="state" name="state" style="width:145px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="city">City</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="city" name="city" style="width:145px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="zipcode">Zip Code</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="zipcode" name="zipcode" style="width:145px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					-->
				</table>
			</div>
			<div title="BILLING ADDRESS" style="padding:8px">
				<table>
					<tr>
						<td class="label_col1"><label for="bill_address">Address</label></td> 		
						<td><textarea id="bill_address" name="bill_address" style="height:50px; width:355px; border:1px solid #ccc;"></textarea></td>
					</tr>
					<tr>
						<td><label for="bill_phone">Phone</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="bill_phone" name="bill_phone" style="width:175px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="bill_fax">Fax</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="bill_fax" name="bill_fax" style="width:175px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
				</table>
			</div>
			<div title="SHIPPING ADDRESS" style="padding:8px">
				<table>
					<tr>
						<td class="label_col1"><label for="ship_address">Address</label></div></td> 		
						<td><textarea id="ship_address" name="ship_address" style="height:50px; width:355px; border:1px solid #ccc;"></textarea></td>
					</tr>
					<tr>
						<td><label for="ship_phone">Phone</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="ship_phone" name="ship_phone" style="width:175px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="ship_fax">Fax</label></td> 		
						<td><input class="easyui-validatebox" type="text" id="ship_fax" name="ship_fax" style="width:175px; border:1px solid #ccc;" data-options="required:false" /></td>
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

					$(grid).edatagrid('cancelRow')
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
			url:'<?php echo site_url('assetm/by_owner/r')?>',	
			columns:[[
				{field:"customer_code", title:'CODE', width:100, sortable:true},
				{field:"customer_name", title:'NAME', width:200, sortable:true},
				{field:"contact_person", title:'CONTACT PERSON', width:200, sortable:true},
				{field:"phone", title:'PHONE', width:275, sortable:true},
				{field:"fax", title:'FAX', width:175, sortable:true},
				{field:"email", title:'EMAIL', width:250, sortable:true},
				{field:'id', title:'ID', width:50, formatter:greyField}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			idField:'id', sortName: 'c.name', sortOrder: 'asc', multiSort: true,
			onClickRow: function(rowIndex, rowData){

				$("#grid2").datagrid('load', {customer_id: rowData.id});  
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
			}/* ,{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud('d') }  
			} */]  
		});           

		setKeyTrapping_grid('#grid', 'crud');
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('assetm/by_owner');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'assetm', 'by_owner'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#customer_id').combogrid('grid').datagrid( 'load', {q: ''} );
			$('#unit_id').combogrid('grid').datagrid( 'load', {q: ''} );
			$('#forms').form('clear'); 
			
			$('#dlg').dialog({
				buttons: [{
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
			
			$('#customer_id').combogrid('readonly', false);
			$('#customer_id').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'assetm', 'by_owner'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return;

			$('#forms2').form('clear'); 
			$('#forms2').form('load',row); 
		
			$('#dlg2').dialog({
				buttons: [{
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
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");
			
			$('#customer_name').focus();
		}
		
		/* if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'assetm', 'by_owner'))?1:0; ?>;
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
		} */
	}
	
	function btn_save( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg');
		var forms = $('#forms');
		var grid = $('#grid');
		var grid_ = $('#grid2');
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
	$(function(){  

		$("#grid2").datagrid({        
			url:"<?php echo site_url('assetm/by_owner_unit/r')?>",	
			columns:[[
				{field:'unit_code', title:'CODE', width:80, sortable:true},
				{field:'unit_name', title:'NAME', width:250, sortable:true},
				{field:'unit_desc', title:'DESCRIPTION', width:250, sortable:true},
				{field:"date_from", title:'DATE FROM', width:100, sortable:true},
				{field:"date_to", title:'DATE TO', width:100, sortable:true},
				{field:"note", title:'NOTE', width:250, sortable:true},
				{field:'unit_sqm', title:'AREA (SQM)', width:80, sortable:true},
				{field:'unit_watt', title:'ELECTRIC (KW)', width:100, sortable:true},
				{field:'power_bill_name', title:'POWER BILL BY', width:110, sortable:true},
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
			title:'UNIT',
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
		
		url = "<?php echo site_url('assetm/by_owner_unit');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'assetm', 'by_owner'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row) 
				return false;
			
			$('#forms').form('clear'); 
			$('#customer_id').combogrid('grid').datagrid( 'load', {q: row.id} );
			$('#unit_id').combogrid('grid').datagrid( 'load', {q: ''} );
			
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
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create_unit');?>"); 
			
			$('#customer_id').combogrid('setValue', row.id);
			$('#customer_id').combogrid('readonly', true);
			$('#unit_id').focus();
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'assetm', 'by_owner'))?1:0; ?>;
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
				
			$('#forms').form('clear'); 
			$('#forms').form('load',row2);  
			$('#customer_id').combogrid('grid').datagrid( 'load', {q: row2.customer_id} );
			$('#unit_id').combogrid('grid').datagrid( 'load', {q: row2.unit_id} );
			
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
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update_unit');?>"); 
			
			$('#customer_id').combogrid('readonly', true);
			if ( row2.date_from )
				$('#date_from').datebox('setValue', format_dmy(row2.date_from));
			if ( row2.date_to )
				$('#date_to').datebox('setValue', format_dmy(row2.date_to));
			$('#item_name').focus();
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'assetm', 'by_owner'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;
			
			var row2 = $('#grid2').datagrid('getSelected');  
			if (row2){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{ 
						
							id:row2.id
							
						},function(result){  
							if (result.success){  
								$('#grid').datagrid('reload');    // reload the user data  
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
	}
	
	function btn_save2( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg2');
		var forms = $('#forms2');
		var grid = $('#grid');
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
	
</script>

</body>
</html>