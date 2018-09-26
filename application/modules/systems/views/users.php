<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
<style>
.label		{width:115px;}
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
						&nbsp;  
						<div style="float:right;"><input id="ss" class="easyui-searchbox" style="width:300px" data-options="searcher:goFilter, prompt:'Please Input Value',menu:'#mm'"></input></div>
					</div> 
				</div>
				<div id="mm" style="width:120px">  
					<div data-options="name:'ALL',iconCls:'icon-ok'">ALL</div>  
					<div data-options="name:'username'">USER NAME</div>  
				</div> 
			</div>  
		</div>  
	</div>  
</div>

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:420, height:450, closed:true, cache:false, modal:true">
	<form id="form_user" method="post" autocomplete="off">
		<input type="hidden" id="id" name="id" />
		<input type="hidden" id="username" name="username" />
		<table>
			<tr>
				<td colspan="4">
				<fieldset>
					<legend>User Login :</legend>
					<table border=0>
					<tr>
						<td class="label"><label for="username_new">User Name</label></td> 	<td>:</td>	
						<td colspan="2"><input class="easyui-validatebox" type="text" id="username_new" name="username_new" style="width:150px; border:1px solid #ccc;" data-options="required:true" /></td>
						<td style="width:52px"><div style="float:left;"><input type="checkbox" id="active" name="active" class="switch" /><label for="active">&nbsp;</label></div></td>
					</tr>
					<tr>
						<td><label for="password_new">Pass. & Confirm</label></td> 		<td>:</td>	
						<td style="width:81pt"><input class="easyui-validatebox" type="password" id="password_new" name="password_new" style="width:100px; border:1px solid #ccc;" data-options="required:true, validType:'length[<?php echo $this->config->item('min_password_length', 'ion_auth');?>, <?php echo $this->config->item('max_password_length', 'ion_auth');?>]'" /></td>
						<td colspan="2"><input class="easyui-validatebox" type="password" id="password_confirm" style="width:105px; border:1px solid #ccc;" validType="equals['#password_new']" required="required" /></td>
					</tr>
					<tr>
						<td><label for="groups">Group(s)</label></td> <td>:</td>	
						<td colspan="3"><input class="easyui-combogrid" type="text" id="groups" name="groups" style="width:220px" data-options="
							url:'<?php echo site_url('systems/groups/r');?>',
							required:true, panelWidth:450, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...', 
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, multiple:false, editable:false,
							columns: [[
								{field:'code',title:'CODE',width:100,sortable:true},
								{field:'name',title:'NAME',width:250,sortable:true},
								{field:'id',title:'ID',width:30,sortable:true}
							]]" /></td>
					</tr>
					</table>
				</fieldset>
				</td>
			</tr>
			<tr>
				<td colspan="4">
				<fieldset>
					<legend>User Info :</legend>
					<table>
					<tr>
						<td><div class="label"><label for="first_name">First & Last Name</label></div></td> 	<td>:</td>	
						<td><input class="easyui-validatebox" type="text" id="first_name" name="first_name" style="width:100px; border:1px solid #ccc;" data-options="required:true" /></td>
						<td align="right"><input class="easyui-validatebox" type="text" id="last_name" name="last_name" style="width:110px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="email">Email</label></td> 		<td>:</td>	
						<td colspan="2"><input class="easyui-validatebox" type="text" id="email" name="email" style="width:220px; border:1px solid #ccc;" data-options="required:false, validType:'email'" /></td>
					</tr>
					<tr>
						<td><label for="phone">Phone</label></td> 	<td>:</td>	
						<td colspan="2"><input class="easyui-validatebox" type="text" id="phone" name="phone" style="width:220px; border:1px solid #ccc;" data-options="required:false" /></td>
					</tr>
					<tr>
						<td><label for="companies">Company</label></td> <td>:</td>	
						<td colspan="2"><input class="easyui-combogrid" type="text" id="companies" name="companies" style="width:220px" data-options="
							url:'<?php echo site_url('systems/get_company');?>',
							required:true, panelWidth:300, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...', pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:false, multiple:true, editable:false,
							columns: [[
								{field:'id',title:'ID',width:50,sortable:true,hidden:true},
								{field:'code',title:'CODE',width:70,sortable:true},
								{field:'name',title:'NAME',width:150,sortable:true}
							]]" /></td>
					</tr>
					<tr>
						<td><label for="branch">Branch</label></td> <td>:</td>	
						<td colspan="2"><input class="easyui-combogrid" type="text" id="branch" name="branch" style="width:220px" data-options="
							url:'<?php echo site_url('systems/get_branch');?>',
							required:true, panelWidth:300, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...', pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:false, multiple:true, editable:false,
							columns: [[
								{field:'id',title:'ID',width:50,sortable:true,hidden:true},
								{field:'code',title:'CODE',width:70,sortable:true},
								{field:'name',title:'NAME',width:150,sortable:true}
							]]" /></td>
					</tr>
					<tr>
						<td><label for="department">Department</label></td> <td>:</td>	
						<td colspan="2"><input class="easyui-combogrid" type="text" id="department" name="department" style="width:220px" data-options="
							url:'<?php echo site_url('systems/get_department');?>',
							required:true, panelWidth:300, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...', pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:false, multiple:true, editable:false,
							columns: [[
								{field:'id',title:'ID',width:50,sortable:true,hidden:true},
								{field:'code',title:'CODE',width:70,sortable:true},
								{field:'name',title:'NAME',width:150,sortable:true}
							]]" /></td>
					</tr>
					</table>
				</fieldset>
				</td>
			</tr>
		</table>
	</form>
</div>

<div id="dlg_reset_pwd" class="easyui-dialog" style="padding:10px" data-options="width:350, height:220, closed:true, cache:false, modal:true">
	<form id="form_reset_pwd" method="post" autocomplete="off">
		<input type="hidden" id="id" name="id" />
		<table>
		<tr>
			<td class="label_col01"><label for="password_new">New Password</label></td>
			<td><input class="easyui-validatebox" type="password" id="password_new" name="password_new" style="width:145px; border:1px solid #ccc;" data-options="required:true, validType:'length[<?php echo $this->config->item('min_password_length', 'ion_auth');?>, <?php echo $this->config->item('max_password_length', 'ion_auth');?>]'" /></td>
		</tr>
		<tr>
			<td class="label_col01"><label for="password_confirm">Confirm New Password</label></td>
			<td><input class="easyui-validatebox" type="password" id="password_confirm" name="password_confirm" style="width:145px; border:1px solid #ccc;" validType="equals['#form_reset_pwd #password_new']" required="required" /></td>
		</tr>
		<tr>
			<td colspan="4"><br><hr><a href="#" onclick="crud('reset_pwd', 'go');" class="easyui-linkbutton" data-options="iconCls:'icon-ok'">OK</a></td>
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
	
	$.extend($.fn.validatebox.defaults.rules, {  
		equals: {  
			validator: function(value,param){  
				return value == $(param[0]).val();  
			},  
			message: 'Confirm do not match.'  
		}  
	});  

	function goFilter( value, name ) {
		if(typeof(value)==='undefined') value = "";
		if(typeof(name)==='undefined') name = "";
	
		$('#grid').datagrid('load',{  
			findKey: name,
			findVal: value
		});
		
	};
	
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
			url:'<?php echo site_url('systems/users/r')?>',	
			columns:[[
				{field:'username', title:'USER NAME', width:100, sortable:true},
				{field:'email', title:'EMAIL', width:150, sortable:true},
				{field:'active', title:'ACTIVE', width:50, sortable:true,					
					formatter:function( value, rowData, rowIndex ){
						if ( value==1 ) 
							return "<center><input type='checkbox' class='switch' checked='checked' /><label>&nbsp;</label></center>";
						else 
							return "<center><input type='checkbox' class='switch' /><label>&nbsp;</label></center>";
					}
				},
				{field:'first_name', title:'FIRST NAME', width:150, sortable:true},
				{field:'last_name', title:'LAST NAME', width:150, sortable:true},
				{field:'phone', title:'PHONE', width:150, sortable:true},
				{field:'theme', title:'THEME', width:150, sortable:true, hidden:true},
				{field:'u_grp', title:'GROUPS', width:150, sortable:true},
				{field:'u_comp', title:'COMPANY', width:150, sortable:true},
				{field:'u_br', title:'BRANCH', width:150, sortable:true},
				{field:'u_dept', title:'DEPARTMENT', width:150, sortable:true},
				{field:'u_groups', title:'groups', width:150, sortable:true, hidden:true},
				{field:'u_company', title:'company', width:150, sortable:true, hidden:true},
				{field:'u_branch', title:'branch', width:150, sortable:true, hidden:true},
				{field:'u_department', title:'department', width:150, sortable:true, hidden:true},
				{field:'id', title:'ID', width:30, sortable:true}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageSize:50, 
			pageList:[50,100],
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
			},{  
				text:'RESET PASSWORD',
				iconCls:'icon-revised',  
				handler:function(){ crud('reset_pwd') }  
			}]  
		});           

		setKeyTrapping_grid('#grid', 'crud');
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('systems/users');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'systems', 'users'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#form_user').form('reset'); 
			
			$('#dlg').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save(1);	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create_users');?>");
			
			$('#password_new').validatebox({required:true}); 
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'systems', 'users'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return false;

			$('#form_user').form('reset'); 
			$('#form_user').form('load',row); 
		
			$('#dlg').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_save_next');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save(2);	}
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update_users');?>");
			
			$('#username_new').val(row.username); 
			$('#password_new').validatebox({required:false}); 
			$('#password_confirm').validatebox({required:false}); 
			if (row.u_groups)
				$('#groups').combogrid('setValues', row.u_groups.split(','));
			if (row.u_company)
				$('#companies').combogrid('setValues', row.u_company.split(','));
			if (row.u_branch)
				$('#branch').combogrid('setValues', row.u_branch.split(','));
			if (row.u_department)
				$('#department').combogrid('setValues', row.u_department.split(','));
			if ( row.active==1 )
				$('#active').prop('checked', 1);
			else
				$('#active').prop('checked', 0);
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'systems', 'users'))?1:0; ?>;
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

		if ( mode=='reset_pwd' ) {
			var is_allow = <?php echo (is_allow('a', 'systems', 'users'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;

			if (target=='go') {
				
				if ( !$('#form_reset_pwd').form('validate') ) return false;
				
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_rst_pwd');?>", callback: function(r){  
					if (r){  
						$.post("<?php echo site_url('systems/reset_pwd');?>",{
						
							id: row.id,
							pwd: $('#form_reset_pwd #password_new').val() 
							
						},function(result){  
							if (result.success){  
								$('#dlg_reset_pwd').dialog('close');
								dhtmlx.message("<?php echo l('success_rst_pwd');?>");
							} else {  
								dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							}  
						},'json');  
					}}
				});  
				return false;
			}
			
			$('#form_reset_pwd').form('reset'); 
			
			$('#dlg_reset_pwd').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg_reset_pwd').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"RESET PASSWORD");
			
			$('#form_reset_pwd #id').val(row.id); 
			$('#form_reset_pwd #password_new').focus(); 
		}

	}
	
	function btn_save( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg');
		var forms = $('#form_user');
		var grid = $('#grid');
		var crud = 'crud';
		
		forms.form('submit',{  
			url: url,  
			onSubmit: function(param){  
				param.groups  	 = $('#groups').combogrid('getValues');
				param.companies  = $('#companies').combogrid('getValues');
				param.branch 	 = $('#branch').combogrid('getValues');
				param.department = $('#department').combogrid('getValues');
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