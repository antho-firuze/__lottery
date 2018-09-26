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
			</div>  
		</div>  
	</div>  
</div>

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:400, height:250, closed:true, cache:false, modal:true">
	<form id="forms" method="post">
		<input type="hidden" id="id" name="id" />
		<input type="hidden" id="code" name="code" />
		<table>
			<tr>
				<td><div class="label"><label for="code_new">Code</label></div></td> 		<td>:</td>	
				<td colspan="2"><input class="easyui-validatebox" id="code_new" name="code_new" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
			</tr>
			<tr>
				<td><div class="label"><label for="code">Name</label></div></td> 		<td>:</td>	
				<td colspan="2"><input class="easyui-validatebox" id="name" name="name" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
			</tr>
			<tr>
				<td><div class="label"><label for="active">Active</label></div></td> 		<td>:</td>	
				<td colspan="2"><input type="checkbox" id="active" name="active" class="switch" /><label for="active">&nbsp;</label></td>
			</tr>
			<tr>
				<td><div class="label"><label for="show">Show</label></div></td> 		<td>:</td>	
				<td colspan="2"><input type="checkbox" id="show" name="show" class="switch" /><label for="show">&nbsp;</label></td>
			</tr>
		</table>
	</form>
</div>

<div id="dlg2" class="easyui-dialog" style="padding:10px" data-options="width:400, height:270, closed:true, cache:false, modal:true">
	<form id="forms2" method="post">
		<input type="hidden" id="id" name="id" />
		<input type="hidden" id="module_group_id" name="module_group_id" />
		<input type="hidden" id="code" name="code" />
		<table>
			<tr>
				<td><div class="label"><label for="code_new">Code - Active</label></div></td> 		<td>:</td>	
				<td><input class="easyui-validatebox" id="code_new" name="code_new" style="width:180px; border:1px solid #ccc;" data-options="required:true" /></td>
				<td><input type="checkbox" id="active" name="active" class="switch" /><label for="active">&nbsp;</label></td>
			</tr>
			<tr>
				<td><div class="label"><label for="name">Name</label></div></td> 		<td>:</td>	
				<td colspan="2"><input class="easyui-validatebox" id="name" name="name" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
			</tr>
			<tr>
				<td><div class="label"><label for="page_link">Page Link</label></div></td> 		<td>:</td>	
				<td colspan="2"><input class="easyui-validatebox" id="page_link" name="page_link" style="width:250px; border:1px solid #ccc;" data-options="required:false" /></td>
			</tr>
			<tr>
				<td><div class="label"><label for="show_in_menu">Show In Menu</label></div></td> 		<td>:</td>	
				<td colspan="2"><input type="checkbox" id="show_in_menu" name="show_in_menu" class="switch" /><label for="show_in_menu">&nbsp;</label></td>
			</tr>
			<tr>
				<td><div class="label"><label for="separator">Separator</label></div></td> 		<td>:</td>	
				<td colspan="2"><input type="checkbox" id="separator" name="separator" class="switch" /><label for="separator">&nbsp;</label></td>
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
		
	}
	
	function getRowIndex(target){  
		var tr = $(target).closest('tr.datagrid-row');  
		return parseInt(tr.attr('datagrid-row-index'));  
	}  

	function format_checkbox( value, row ) {
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

					if (selected){ window[crud]('c') }
					break;
				case 13:	// enter

					if (selected){ window[crud]('u') }
					break;
				case 46:	// delete

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
	
		$(document).on("keydown", function(e){ 
			switch(e.keyCode){
				case 27:	// esc
					$('#dlg').dialog('close');
					$('#dlg2').dialog('close');
					break;
			}
		});
	});
	
	// GRID 
	$(function(){  
		$("#grid").datagrid({        
			url:'<?php echo site_url('systems/modules_groups/r')?>',	
			columns:[[
				{field:"code", title:'CODE', width:150, sortable:true},
				{field:"name", title:'NAME', width:250, sortable:true},
				{field:"order", title:'ORDER', width:50, sortable:true, align:'center', 
					formatter: function(value, rowData, rowIndex){
						if ( parseInt(rowData.sort_no) == parseInt(rowData.sort_no_min) )
							var u = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						else
							var u = '<a href="#" class="icon-up" title="Move Up" onclick="crud(\'up\', this)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> ';
							
						if ( parseInt(rowData.sort_no) == parseInt(rowData.sort_no_max) )
							var d = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						else
							var d = '<a href="#" class="icon-down" title="Move Down" onclick="crud(\'down\', this)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> ';
						return u+"&nbsp;"+d;
					}
				},
				{field:"sort_no", title:'SORT', width:50, sortable:true, align:'center'},
				{field:"active", title:'ACTIVE', width:60, sortable:true,
					formatter:function( value, rowData, rowIndex ){
						if ( parseInt(value)==1 ) 
							return '<a href="#" onclick="crud(\'active\', this)"><input type="checkbox" class="switch" checked="checked" /><label>&nbsp;</label></a>';
						else 
							return '<a href="#" onclick="crud(\'active\', this)"><input type="checkbox" class="switch" /><label>&nbsp;</label></a>';
					}
				},
				/* {field:"show", title:'SHOW', width:60, sortable:false,
					formatter:function( value, rowData, rowIndex ){
						if ( parseInt(value)==1 ) 
							return '<center><a href="#" onclick="crud(\'show\', this)"><input type="checkbox" class="switch" checked="checked" /><label>&nbsp;</label></a></center>';
						else 
							return '<center><a href="#" onclick="crud(\'show\', this)"><input type="checkbox" class="switch" /><label>&nbsp;</label></a></center>';
					}
				}, */
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField},
				{field:"detail", title:'', width:550, sortable:true}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageSize:50, pageList:[50,100],
			idField:'id', sortName: 'sort_no',	sortOrder: 'asc', multiSort: true,
			onDblClickRow: function(rowIndex, rowData) { crud('u') },
			view: detailview,  
			detailFormatter:function(index,row){  
				return '<div style="padding:2px"><table id="ddv-' + index + '"></table></div>';  
			},  
			onExpandRow: function(index,row){  
				grid2 = $('#ddv-'+index); 
				$('#ddv-'+index).datagrid({  
					url:'<?php echo site_url('systems/modules/r')?>',  
					fitColumns:true,  
					singleSelect:true,  
					rownumbers:true,  
					pagination:true,
					pagePosition:'bottom',
					loadMsg:'',  
					height:'auto',  
					idField:'id', sortName: 'sort_no',	sortOrder: 'asc', multiSort: true,
					onDblClickRow: function(rowIndex, rowData) { 
						grid2 = $('#ddv-'+index); 
						crud2('u', grid2);
					},
					columns:[[  
						{field:'module_group_id', title:'module_group_id', width:30, sortable:true, hidden:true},
						{field:"code", title:'CODE', width:150, sortable:true},
						{field:"name", title:'NAME', width:150, sortable:true},
						{field:"page_link", title:'PAGE LINK', width:250, sortable:true},
						{field:"order", title:'ORDER', width:50, sortable:true, align:'center', 
							formatter: function(value, rowData, rowIndex){
								if ( parseInt(rowData.sort_no) == parseInt(rowData.sort_no_min) )
									var u = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								else
									var u = '<a href="#" class="icon-up" title="Move Up" onclick="crud2(\'up\', $(\'#ddv-'+index+'\'), this)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> ';
									
								if ( parseInt(rowData.sort_no) == parseInt(rowData.sort_no_max) )
									var d = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
								else
									var d = '<a href="#" class="icon-down" title="Move Down" onclick="crud2(\'down\', $(\'#ddv-'+index+'\'), this)">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a> ';
								return u+"&nbsp;"+d;
							}
						},
						{field:"sort_no", title:'SORT', width:50, sortable:true, align:'center'},
						{field:"is_form", title:'IS FORM', width:60, sortable:true,
							formatter:function( value, rowData, rowIndex ){
								if ( value==1 ) 
									return '<a href="#" onclick="crud2(\'is_form\', $(\'#ddv-'+index+'\'), this)"><input type="checkbox" class="switch" checked="checked" /><label>&nbsp;</label></a>';
								else 
									return '<a href="#" onclick="crud2(\'is_form\', $(\'#ddv-'+index+'\'), this)"><input type="checkbox" class="switch" /><label>&nbsp;</label></a>';
							}
						},
						{field:"show_in_menu", title:'SHOW IN MENU', width:100, sortable:false,
							formatter:function( value, rowData, rowIndex ){
								if ( value==1 ) 
									return '<center><a href="#" onclick="crud2(\'show_in_menu\', $(\'#ddv-'+index+'\'), this)"><input type="checkbox" class="switch" checked="checked" /><label>&nbsp;</label></a></center>';
								else 
									return '<center><a href="#" onclick="crud2(\'show_in_menu\', $(\'#ddv-'+index+'\'), this)"><input type="checkbox" class="switch" /><label>&nbsp;</label></a></center>';
							}
						},
						{field:"separator", title:'SEPARATOR', width:90, sortable:false,
							formatter:function( value, rowData, rowIndex ){
								if ( value==1 ) 
									return '<center><a href="#" onclick="crud2(\'separator\', $(\'#ddv-'+index+'\'), this)"><input type="checkbox" class="switch" checked="checked" /><label>&nbsp;</label></a></center>';
								else 
									return '<center><a href="#" onclick="crud2(\'separator\', $(\'#ddv-'+index+'\'), this)"><input type="checkbox" class="switch" onclick="crud2(\'separator\', $(\'#ddv-'+index+'\'), this)" /><label>&nbsp;</label></a></center>';
							}
						},
						{field:"active", title:'ACTIVE', width:60, sortable:true,
							formatter:function( value, rowData, rowIndex ){
								if ( value==1 ) 
									return '<a href="#" onclick="crud2(\'active\', $(\'#ddv-'+index+'\'), this)"><input type="checkbox" class="switch" checked="checked" /><label>&nbsp;</label></a>';
								else 
									return '<a href="#" onclick="crud2(\'active\', $(\'#ddv-'+index+'\'), this)"><input type="checkbox" class="switch" /><label>&nbsp;</label></a>';
							}
						},
						{field:'id', title:'ID', width:50, sortable:true}
					]],  
					onResize:function(){  
						$('#grid').datagrid('fixDetailRowHeight',index);  
					},  
					queryParams: {module_group_id: row.id},
					onLoadSuccess:function(){  
						setTimeout(function(){  
							$('#grid').datagrid('fixDetailRowHeight',index);  
						},0);  
					}  
				});  
				$('#grid').datagrid('fixDetailRowHeight',index);  
				$('#ddv-'+index).datagrid('getPager').pagination({
					buttons:[{  
						text:'<?php echo l('form_btn_create');?>',
						iconCls:'icon-add',  
						handler:function(){ 
							master_id = row.id;
							crud2('c', grid2, row.id); 
						}  
					},{  
						text:'<?php echo l('form_btn_update');?>',
						iconCls:'icon-edit',  
						handler:function(){ crud2('u', grid2) }  
					},{  
						text:'<?php echo l('form_btn_delete');?>',
						iconCls:'icon-remove',  
						handler:function(){ crud2('d', grid2) }  
					},{  
						text:'<?php echo l('form_btn_reorder');?>',
						iconCls:'icon-revised',  
						handler:function(){ 
							master_id = row.id;
							crud2('reorder', grid2); 
						}  
					}]  
				});
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
			},{  
				text:'<?php echo l('form_btn_reorder');?>',
				iconCls:'icon-revised',  
				handler:function(){ crud('reorder') }  
			}]  
		});           

		setKeyTrapping_grid('#grid', 'crud');
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('systems/modules_groups');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'systems', 'modules_groups'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
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
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create_modules_groups');?>");
			
			$('#code_new').focus(); 
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules_groups'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return;

			$('#forms').form('clear'); 
			$('#forms').form('load',row); 
		
			$('#dlg').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save();	}
				},{
					text:'<?php echo l('form_btn_save_next');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save( 2 );	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update_modules_groups');?>");
			
			$('#code_new').val(row.code); 
			$('#active').prop('checked', parseInt(row.active));
			$('#show').prop('checked', parseInt(row.show));
			$('#code_new').focus(); 
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'systems', 'modules_groups'))?1:0; ?>;
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

		if ( mode=='up' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if (target)
				$('#grid').datagrid("selectRow", getRowIndex(target));
				
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return;

			$.post(url,{
			
				id:row.id
			
			}, function(result){  
				if (result.success){  
					$('#grid').datagrid('reload');    // reload the user data  
					dhtmlx.message("<?php echo l('success_up');?>");
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},'json');  
		}

		if ( mode=='down' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if (target)
				$('#grid').datagrid("selectRow", getRowIndex(target));
				
			var row = $('#grid').datagrid('getSelected'); 
			if (!row)
				return;

			$.post(url,{
			
				id:row.id
			
			},function(result){  
				if (result.success){  
					$('#grid').datagrid('reload');    // reload the user data  
					dhtmlx.message("<?php echo l('success_down');?>");
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},'json');  
		}

		if ( mode=='active' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if (target)
				$('#grid').datagrid("selectRow", getRowIndex(target));
				
			var row = $('#grid').datagrid('getSelected'); 
			// console.log(row);
			// return;
			if (!row)
				return;

			$.post(url,{
			
				id:row.id
			
			},function(result){  
				if (result.success){  
					$('#grid').datagrid('reload');    // reload the user data  
					// dhtmlx.message("<?php echo l('success_down');?>");
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},'json');  
		}

		if ( mode=='show' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if (target)
				$('#grid').datagrid("selectRow", getRowIndex(target));
				
			var row = $('#grid').datagrid('getSelected'); 
			if (!row)
				return;

			$.post(url,{
			
				id:row.id
			
			},function(result){  
				if (result.success){  
					$('#grid').datagrid('reload');    // reload the user data  
					// dhtmlx.message("<?php echo l('success_down');?>");
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},'json');  
		}

		if ( mode=='reorder' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_reorder');?>", callback: function(r){  
				if (r){  
					$.post(url,{id:mode},function(result){  
						if (result.success){  
							$('#grid').datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_reorder');?>");
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
						window[crud]('c', grid);
					}
					else if (save_option==2)
					{
						var lastIndex = grid.datagrid('getRows').length-1;
						var selected = grid.datagrid('getSelected');
						if (selected){
							var index = grid.datagrid('getRowIndex', selected);
							if (index==lastIndex) return
							grid.datagrid('selectRow', index+1);
							window[crud]('u', grid);
						}
					}	
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 
	
	var grid2, master_id;
	
	function crud2 ( mode, dg, target ) {
		if(typeof(dg)==='undefined') dg = "";
		if(typeof(target)==='undefined') target = 0;
		
		url = "<?php echo site_url('systems/modules');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms2').form('clear'); 
			
			$('#dlg2').dialog({
				buttons: [{
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
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create_modules');?>");
			
			$('#module_group_id').val(master_id); 
			$('#forms2 #code_new').focus();
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = dg.datagrid('getSelected');   
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
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update_modules');?>");
			
			$('#forms2 #code_new').val(row.code); 
			$('#forms2 #active').prop('checked', parseInt(row.active));
			$('#show_in_menu').prop('checked', parseInt(row.show_in_menu));
			$('#separator').prop('checked', parseInt(row.separator));
			$('#forms2 #code_new').focus();
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = dg.datagrid('getSelected');  
			if (!row)
				return;

			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
				if (r){  
					$.post(url,{id:row.id},function(result){  
						if (result.success){  
							dg.datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_delete');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}

		if ( mode=='up' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if (target)
				dg.datagrid("selectRow", getRowIndex(target));
				
			var row = dg.datagrid('getSelected');  
			if (!row)
				return;

			$.post(url,{
			
				id:row.id
			
			}, function(result){  
				if (result.success){  
					dg.datagrid('reload');    // reload the user data  
					dhtmlx.message("<?php echo l('success_up');?>");
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},'json');  
		}

		if ( mode=='down' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if (target)
				dg.datagrid("selectRow", getRowIndex(target));
				
			var row = dg.datagrid('getSelected'); 
			if (!row)
				return;

			$.post(url,{
			
				id:row.id
			
			},function(result){  
				if (result.success){  
					dg.datagrid('reload');    // reload the user data  
					dhtmlx.message("<?php echo l('success_down');?>");
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},'json');  
		}

		if ( mode=='is_form' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if (target)
				dg.datagrid("selectRow", getRowIndex(target));
				
			var row = dg.datagrid('getSelected'); 
			if (!row)
				return;

			$.post(url,{
			
				id:row.id
			
			},function(result){  
				if (result.success){  
					dg.datagrid('reload');    // reload the user data  
					// dhtmlx.message("<?php echo l('success_down');?>");
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},'json');  
		}

		if ( mode=='active' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if (target)
				dg.datagrid("selectRow", getRowIndex(target));
				
			var row = dg.datagrid('getSelected'); 
			// console.log(row);
			// return;
			if (!row)
				return;

			$.post(url,{
			
				id:row.id
			
			},function(result){  
				if (result.success){  
					dg.datagrid('reload');    // reload the user data  
					// dhtmlx.message("<?php echo l('success_down');?>");
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},'json');  
		}

		if ( mode=='show_in_menu' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if (target)
				dg.datagrid("selectRow", getRowIndex(target));
				
			var row = dg.datagrid('getSelected'); 
			if (!row)
				return;

			$.post(url,{
			
				id:row.id
			
			},function(result){  
				if (result.success){  
					dg.datagrid('reload');    // reload the user data  
					// dhtmlx.message("<?php echo l('success_down');?>");
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},'json');  
		}

		if ( mode=='separator' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if (target)
				dg.datagrid("selectRow", getRowIndex(target));
				
			var row = dg.datagrid('getSelected'); 
			if (!row)
				return;

			$.post(url,{
			
				id:row.id
			
			},function(result){  
				if (result.success){  
					dg.datagrid('reload');    // reload the user data  
					// dhtmlx.message("<?php echo l('success_down');?>");
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},'json');  
		}

		if ( mode=='reorder' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'modules'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_reorder');?>", callback: function(r){  
				if (r){  
					$.post(url,{id:master_id},function(result){  
						if (result.success){  
							dg.datagrid('reload');    // reload the user data  
							dhtmlx.message("<?php echo l('success_reorder');?>");
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
		var grid = grid2;
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
						window[crud]('c', grid, master_id);
					}
					else if (save_option==2)
					{
						var lastIndex = grid.datagrid('getRows').length-1;
						var selected = grid.datagrid('getSelected');
						if (selected){
							var index = grid.datagrid('getRowIndex', selected);
							if (index==lastIndex) return
							grid.datagrid('selectRow', index+1);
							window[crud]('u', grid);
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