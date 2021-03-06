<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
<style>
	.label		{width:170px;}
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
    <div data-options="name:'kva'">KVA</div>  
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
				<input type="hidden" id="code" name="code" />
				<table>
					<tr>
						<td><div class="label"><label for="code_new">Code - Name</label></div></td> 	<td>:</td>	
						<td><input class="easyui-validatebox" id="code_new" name="code_new" style="width:120px; border:1px solid #ccc;" data-options="required:true" /></td>
						<td><input class="easyui-validatebox" id="name" name="name" style="width:120px; border:1px solid #ccc;" data-options="required:true" /></td>
					</tr>
					<tr>
						<td><label for="kva">KVA - Load Tariff</label></td> 	<td>:</td>	
						<td><input class="easyui-numberspinner" id="kva" name="kva" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:2" /></td>
						<td><input class="easyui-numberspinner" id="load_tariff" name="load_tariff" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:0" /></td>
					</tr>
					<tr>
						<td><label for="rm_hours">RM Hours - RM KWH</label></td> 	<td>:</td>	
						<td><input class="easyui-numberspinner" id="rm_hours" name="rm_hours" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:40,min:0,precision:0" /></td>
						<td><input class="easyui-numberspinner" id="rm_kwh" name="rm_kwh" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:0" /></td>
					</tr>
					<tr>
						<td><label for="saving_hours">Saving Hours</label></td> 		<td>:</td>	
						<td colspan="2"><input class="easyui-numberspinner" id="saving_hours" name="saving_hours" style="width:250px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:4" /></td>
					</tr>
					<tr>
						<td><label for="blok1">Blok 1 Amount - Blok 1 KWH</label></td> 	<td>:</td>	
						<td><input class="easyui-numberspinner" id="blok1" name="blok1" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:0" /></td>
						<td><input class="easyui-numberspinner" id="blok1_kwh" name="blok1_kwh" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:0" /></td>
					</tr>
					<tr>
						<td><label for="blok2">Blok 2 Amount - Blok 2 KWH</label></td> 	<td>:</td>	
						<td><input class="easyui-numberspinner" id="blok2" name="blok2" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:0" /></td>
						<td><input class="easyui-numberspinner" id="blok2_kwh" name="blok2_kwh" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:0" /></td>
					</tr>
					<tr>
						<td><label for="blok3">Blok 3 Amount - Blok 3 KWH</label></td> 	<td>:</td>	
						<td><input class="easyui-numberspinner" id="blok3" name="blok3" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:0" /></td>
						<td><input class="easyui-numberspinner" id="blok3_kwh" name="blok3_kwh" style="width:120px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:0" /></td>
					</tr>
					<tr>
						<td><label for="ppj_percent">PPJ PERCENT</label></td> 		<td>:</td>	
						<td colspan="2"><input class="easyui-numberspinner" id="ppj_percent" name="ppj_percent" style="width:250px; border:1px solid #ccc;" data-options="required:true,value:0.03,min:0,precision:4" /></td>
					</tr>
					<tr>
						<td><label for="admin_amount">Admin Amount</label></td> 		<td>:</td>	
						<td colspan="2"><input class="easyui-numberspinner" id="admin_amount" name="admin_amount" style="width:250px; border:1px solid #ccc;" data-options="required:true,value:0,min:0,precision:2" /></td>
					</tr>
					<tr>
						<td><label for="max_value">Max Value</label></td> 		<td>:</td>	
						<td colspan="2"><input class="easyui-numberspinner" id="max_value" name="max_value" style="width:250px; border:1px solid #ccc;" data-options="required:true,value:999999999,min:0,precision:0" /></td>
					</tr>
					<tr>
						<td><label for="active">Active</label></td> 		<td>:</td>	
						<td colspan="2"><input type="checkbox" id="active" name="active" value=1 checked /><label for="active">&nbsp;</label></td>
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
	
	function format_price( value, row ) {
		return accounting.formatMoney(value, '');
	}
	
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
			url:'<?php echo site_url('master/power/r')?>',	
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
				{field:'max_value', title:'MAX VALUE', width:90, sortable:true, align:"right"},
				{field:'active', title:'ACTIVE', width:90, sortable:true, align:'center', 
					formatter:function(value, rowData, rowIndex){ 
						if ( parseInt(value) )
							return "<input type='checkbox' onclick='return false' onkeydown='return false' checked>";
						else
							return "<input type='checkbox' onclick='return false' onkeydown='return false'>";
					} 
				},
				// {field:'desc', title:'DESCRIPTION', width:250, sortable:true},
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
			pageSize:50, 
			idField:'id',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
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
		
		url = "<?php echo site_url('master/power');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'master', 'power'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('reset'); 
			$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			$('#code_new').focus();
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'master', 'power'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return;

			$('#forms').form('reset'); 
			$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");  
			$('#forms').form('load',row); 
			$('#code_new').val(row.code); 
			$('#code_new').focus();
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'master', 'power'))?1:0; ?>;
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