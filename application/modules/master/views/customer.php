<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
<style>
	.label		{width:170px;}
	.label_col1		{width:100px; vertical-align:text-top;}
	.label_col2		{padding-left:10px; width:100px; vertical-align:text-top;}
</style>
<body>
		
<div id="cc" class="easyui-layout">  
	<div data-options="region:'center'">
		<div class="easyui-layout" data-options="fit:true">  
			<div data-options="region:'center'">
				<table id="grid" style='height:100%; width:100%;' toolbar="#tb"></table>
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

<div id="dlg" class="easyui-dialog" style="padding:10px"
	data-options="width:550, height:430, closed:true, cache:false, modal:true,
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
	">
	<form id="forms" method="post">
		<div class="easyui-tabs" style="width:auto;height:auto">
			<div title="GENERAL" style="padding:8px">
				<input type="hidden" id="id" name="id" />
				<table>
					<tr>
						<td class="label_col1"><label for="code">Code</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="code" name="code" style="width:250px; border:1px solid #ccc;" data-options="required:true" disabled /></td>
					</tr>
					<tr>
						<td><label for="name">Name</label></td> 			
						<td colspan="2"><input class="easyui-validatebox" type="text" id="name" name="name" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
					</tr>
					<tr>
						<td><label for="name">NPWP</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="npwp" name="npwp" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="npwp_name">NPWP Name</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="npwp_name" name="npwp_name" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="npwp_address">NPWP Address</label></td> 		
						<td colspan="2"><textarea id="npwp_address" name="npwp_address" style="height:50px; width:250px; border:1px solid #ccc;"></textarea></td>
					</tr>
					<tr>
						<td><label for="email">Email</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="email" name="email" style="width:250px; border:1px solid #ccc;" data-options="required:false, validType:'email'" /></td>
					</tr>
					<tr>
						<td><label for="contact_person">Contact Person</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="contact_person" name="contact_person" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
				</table>
			</div>
			<div title="ADDRESS" style="padding:8px">
				<table>
					<tr>
						<td class="label_col1"><label for="address">Address</label></td> 		
						<td colspan="2"><textarea id="address" name="address" style="height:50px; width:250px; border:1px solid #ccc;"></textarea></td>
					</tr>
					<tr>
						<td><label for="phone">Phone</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="phone" name="phone" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="fax">Fax</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="fax" name="fax" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<!--
					<tr>
						<td><label for="country">Country</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="country" name="country" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="state">State</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="state" name="state" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="city">City</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="city" name="city" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="zipcode">Zip Code</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="zipcode" name="zipcode" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					-->
				</table>
			</div>
			<div title="BILLING ADDRESS" style="padding:8px">
				<table>
					<tr>
						<td class="label_col1"><label for="bill_address">Address</label></td> 		
						<td colspan="2"><textarea id="bill_address" name="bill_address" style="height:50px; width:250px; border:1px solid #ccc;"></textarea></td>
					</tr>
					<tr>
						<td><label for="bill_phone">Phone</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="bill_phone" name="bill_phone" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="bill_fax">Fax</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="bill_fax" name="bill_fax" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
				</table>
			</div>
			<div title="SHIPPING ADDRESS" style="padding:8px">
				<table>
					<tr>
						<td class="label_col1"><label for="ship_address">Address</label></td> 		
						<td colspan="2"><textarea id="ship_address" name="ship_address" style="height:50px; width:250px; border:1px solid #ccc;"></textarea></td>
					</tr>
					<tr>
						<td><label for="ship_phone">Phone</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="ship_phone" name="ship_phone" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="ship_fax">Fax</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" type="text" id="ship_fax" name="ship_fax" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
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
	
	// GRID =====
	$(function(){  
		$("#grid").datagrid({        
			url:'<?php echo site_url('master/customer/r')?>',	
			columns:[[
				{field:'code', title:'CODE', width:80, sortable:true},
				{field:'name', title:'NAME', width:250, sortable:true},
				{field:'address', title:'ADDRESS', width:300, sortable:true},
				{field:'phone', title:'PHONE', width:150, sortable:true},
				{field:'fax', title:'FAX', width:150, sortable:true},
				{field:'email', title:'EMAIL', width:150, sortable:true},
				{field:'contact_person', title:'CONTACT PERSON', width:150, sortable:true},
				{field:'npwp', title:'NPWP', width:150, sortable:true},
				{field:'npwp_name', title:'NPWP NAME', width:150, sortable:true},
				{field:'npwp_address', title:'NPWP ADDRESS', width:150, sortable:true},
				{field:'term_id', title:'TERM', width:100, sortable:true},
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
			sortName: 'name',
			sortOrder: 'asc', multiSort: true,
			onDblClickRow: function(rowIndex, rowData) { crud('u') }
		});

		$('#grid').datagrid('getPager').pagination({  
			buttons:[{  
				text:'<?php echo l('form_btn_create');?>',
				iconCls:'icon-add',  
				handler:function(){ crud('c') }  
			},{  
				text:'<?php echo l('form_btn_update');?>',
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
		
		url = "<?php echo site_url('master/customer');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'master', 'customer'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_create_customer');?>");
			$('#forms').form('clear'); 
			$('#code').val('AUTO CODE');
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'master', 'customer'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (row){  
				$('#forms').form('clear'); 
			
				$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_update_customer');?>");  
				$('#forms').form('load',row); 
				
				$('#code_new').val(row.code); 
			}
			
			
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'master', 'customer'))?1:0; ?>;
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

</script>

</body>
</html>