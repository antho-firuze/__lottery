<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<script type="text/javascript" src="<?php echo base_url()?>assets/jquery-easyui/js/datagrid-detailview.js"></script>  
	</head>
<style>
.label		{width:75px;}

input.switch:empty
{
	margin-left: -999px;
}

input.switch:empty ~ label
{
	position: relative;
	float: left;
	line-height: 1.6em;
	text-indent: 4em;
	margin: 0.2em 0;
	cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

input.switch:empty ~ label:before, 
input.switch:empty ~ label:after
{
	position: absolute;
	display: block;
	top: 0;
	bottom: 0;
	left: 0;
	content: ' ';
	width: 3.6em;
	background-color: #c33;
	border-radius: 0.3em;
	box-shadow: inset 0 0.2em 0 rgba(0,0,0,0.3);
	-webkit-transition: all 100ms ease-in;
  transition: all 100ms ease-in;
}

input.switch:empty ~ label:after
{
	width: 1.4em;
	top: 0.1em;
	bottom: 0.1em;
	margin-left: 0.1em;
	background-color: #fff;
	border-radius: 0.15em;
	box-shadow: inset 0 -0.2em 0 rgba(0,0,0,0.2);
}

input.switch:checked ~ label:before
{
	background-color: #393;
}

input.switch:checked ~ label:after
{
	margin-left: 2.1em;
}
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
		<input id="ss" class="easyui-searchbox" style="width:300px" data-options="searcher:goFilter, prompt:'Please Input Value',menu:'#mm'"></input>
	</div> 
</div>

<div id="mm" style="width:120px">  
    <div data-options="name:'ALL',iconCls:'icon-ok'">ALL</div>  
    <div data-options="name:'code'">CODE</div>  
    <div data-options="name:'name'">NAME</div>  
</div> 

<div id="dlg" class="easyui-dialog" style="padding:10px"
	data-options="width:400, height:170, closed:true, cache:false, modal:true,
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
		<input type="hidden" id="id" name="id" />
		<input type="hidden" id="code" name="code" />
		<table>
			<tr>
				<td><div class="label"><label for="code_new">Code</label></div></td> 		<td>:</td>	<td colspan="2"><input class="easyui-validatebox" type="text" id="code_new" name="code_new" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
			</tr>
			<tr>
				<td><div class="label"><label for="code">Name</label></div></td> 		<td>:</td>	<td colspan="2"><input class="easyui-validatebox" type="text" id="name" name="name" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
			</tr>
		</table>
	</form>
</div>

<div id="dlg2" class="easyui-dialog" style="padding:10px"
	data-options="width:400, height:170, closed:true, cache:false, modal:true,
		buttons: [{
			text:'SAVE',
			iconCls:'icon-save',
			handler:function(){	btn_save2();	}
		},{
			text:'CANCEL',
			iconCls:'icon-cancel',
			handler:function(){	$('#dlg2').dialog('close'); }
		}]
	">
	<form id="forms2" method="post">
		<input type="hidden" id="id" name="id" />
		<input type="hidden" id="code" name="code" />
		<table>
			<tr>
				<td><div class="label"><label for="module">Module</label></div></td> 		<td>:</td>	<td colspan="2"><input class="easyui-validatebox" type="text" id="code_new" name="code_new" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
			</tr>
			<tr>
				<td><div class="label"><label for="code">Name</label></div></td> 		<td>:</td>	<td colspan="2"><input class="easyui-validatebox" type="text" id="name" name="name" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
			</tr>
		</table>
	</form>
</div>

<script>
	var url;
	
	$(function(){
		resizelayout();
		$(window).resize(resizelayout);
	});
	
	function goFilter( value, name ) {
		if(typeof(value)==='undefined') value = "";
		if(typeof(name)==='undefined') name = "";
	
		$('#grid').datagrid('load',{  
			findKey: name,
			findVal: value
		});
		
	}
	
	function checkboxFormat( value, row ) {
		if ( value==1 ) 
			return "<center><input type='checkbox' class='switch' checked='checked' /><label>&nbsp;</label></center>";
		else 
			return "<center><input type='checkbox' class='switch' /><label>&nbsp;</label></center>";
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
			url:'<?php echo site_url('systems/groups/r')?>',	
			columns:[[
				{field:"code", title:'CODE', width:150, sortable:true},
				{field:"name", title:'NAME', width:250, sortable:true},
				{field:'id', title:'ID', width:50, sortable:true},
				{field:"detail", title:'', width:350, sortable:true, 
					/* formatter:function( value, rowData, rowIndex ){
							return "<a href='<?php echo site_url('systems/groups_auth')?>/"+rowData.id+"' >View</a>";
					}  */
				}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageSize:50, pageList:[50,100],
			idField:'id', sortName: 'code',	sortOrder: 'asc', multiSort: true,
			onDblClickRow: function(rowIndex, rowData) { crud('u') },
			view: detailview,  
			detailFormatter:function(index,row){  
				return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';  
			},  
			onExpandRow: function(index,row){  
				$('#ddv-'+index).datagrid({  
					url:'<?php echo site_url('systems/groups_auth/r')?>',  
					fitColumns:true,  
					rownumbers:true,  
					singleSelect:true,  
					pagination:true,
					pagePosition:'bottom',
					// pageSize:100, 
					// pageList:[100],
					loadMsg:'',  
					height:'auto',  
					idField:'id', sortName: 'group_code, module_group_code, sort_no', sortOrder: 'asc', multiSort: true,
					onClickCell: function(cellIndex, cellField, cellValue) { 
						$('#ddv-'+index).datagrid("selectRow", cellIndex);
						dg = $('#ddv-'+index); 
						crud2( dg, cellField, cellValue );
					},
					// onDblClickRow: function(rowIndex, rowData) { crud2('u') },
					columns:[[  
						{field:'id', title:'ID', width:30, sortable:true, hidden:true},
						{field:'group_id', title:'group_id', width:30, sortable:true, hidden:true},
						{field:'module_id', title:'module_id', width:30, sortable:true, hidden:true},
						{field:"module_group_name", title:'MODULE GROUP', width:150, sortable:true},
						{field:"module_name", title:'MODULE', width:250, sortable:true},
						{field:"c", title:'CREATE', width:60, sortable:true, formatter:checkboxFormat},
						{field:"r", title:'READ', width:60, sortable:true, formatter:checkboxFormat},
						{field:"u", title:'UPDATE', width:60, sortable:true, formatter:checkboxFormat},
						{field:"d", title:'DELETE', width:60, sortable:true, formatter:checkboxFormat},
						{field:"a", title:'APPROVE', width:60, sortable:true, formatter:checkboxFormat}
					]],  
					onResize:function(){  
						$('#grid').datagrid('fixDetailRowHeight',index);  
					},  
					queryParams: {group_id: row.id},
					onLoadSuccess:function(){  
						setTimeout(function(){  
							$('#grid').datagrid('fixDetailRowHeight',index);  
						},0);  
					}  
				});  
				$('#grid').datagrid('fixDetailRowHeight',index);  
			}  
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
		
		url = "<?php echo site_url('systems/groups');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'systems', 'groups'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_create_groups');?>");
			$('#forms').form('clear'); 
		}
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'groups'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (row){  
				$('#forms').form('clear'); 
			
				$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_update_groups');?>");  
				$('#forms').form('load',row); 
				
				$('#code_new').val(row.code); 
			}
			
			
		}
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'systems', 'groups'))?1:0; ?>;
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

	// var dg, cellField, cellValue;
	function crud2 ( dg, cellField, cellValue ) { // special case for cell editing
		
		url = "<?php echo site_url('systems/groups_auth/u');?>";

		var is_allow = <?php echo (is_allow('u', 'systems', 'groups_auth'))?1:0; ?>;
		if ( !is_allow ) {
			dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
			return false;
		}
		
		if ( cellField != 'c' && cellField != 'r' && cellField != 'u' && cellField != 'd' && cellField != 'a' )
			return false;
		
		var row = dg.datagrid('getSelected');
		// console.log('id:'+row.id);
		// console.log('group_id:'+row.group_id);
		// console.log('module_id:'+row.module_id);
		// console.log(cellField+':'+cellValue);
		// return false;
		$.post(
			url,
			{
				id:row.id, 
				group_id:row.group_id, 
				module_id:row.module_id, 
				cellField:cellField, 
				cellValue:cellValue 
			},
			function(result){  
				if (result.success){  
					dg.datagrid('reload');    // reload the user data  
					dhtmlx.message("<?php echo l('success_saving');?>");
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
		},'json');  
	}
	
</script>

</body>
</html>