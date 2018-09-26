<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="<?php echo base_url()?>assets/jquery-FileDownload/jquery.fileDownload.js"></script>
</head>
<style>
.label			{width:170px;}
.label_col1		{width:100px; vertical-align:text-top;}
.label_col2		{padding-left:10px; width:100px; vertical-align:text-top;}
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
				<div id="tb" style="padding:7px">  
					&nbsp;
					<div style="display:inline;">
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
						<div style="float:right;"><input id="ss" class="easyui-searchbox" style="width:300px" data-options="searcher:goFilter, prompt:'Please Input Value',menu:'#mm'"></input></div> 
						<div id="mm" style="width:145px">  
							<div data-options="name:'ALL',iconCls:'icon-ok'">ALL</div>  
							<div data-options="name:'code'">CODE</div>  
							<div data-options="name:'name'">NAME</div>  
						</div> 
					</div> 
				</div>
			</div>  
		</div>  
	</div>  
</div>

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:600, height:320, closed:true, cache:false, modal:true">
	<form id="forms" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="GENERAL" style="padding:8px">
			<input type="hidden" id="id" name="id" />
			<!--
			<input type="hidden" id="code" name="code" />
			-->
			<table>
				<tr>
					<!--
					<td class="label_col1"><label for="code_new">Code</label></td> 	
					<td><input class="easyui-validatebox" id="code_new" name="code_new" style="width:145px; border:1px solid #ccc;" data-options="required:true" /></td>
					-->
					<td class="label_col1"><label for="name">Name</label></td> 	
					<td><input class="easyui-validatebox" id="name" name="name" style="width:145px; border:1px solid #ccc;" data-options="required:true" /></td>
				</tr>
				<tr>
					<td><label for="store_type_id">Type</label></td> 		
					<td><input class="easyui-combogrid" id="store_type_id" name="store_type_id" style="width:145px" 
						data-options="
							url:'<?php echo site_url('mpoint/opt_store_type/r');?>',
							required:false, panelWidth:300, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true, value:0, 
							columns: [[
								{field:'id'	 ,title:'ID',width:20,sortable:true, hidden:true},
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:50,sortable:true}
							]]" />
					</td>
				</tr>
				<tr>
					<td><label for="store_floor_id">Floor</label></td> 		
					<td><input class="easyui-combogrid" id="store_floor_id" name="store_floor_id" style="width:145px" 
						data-options="
							url:'<?php echo site_url('mpoint/opt_store_floor/r');?>',
							required:false, panelWidth:300, panelHeight:100,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true, value:0, 
							columns: [[
								{field:'id'	 ,title:'ID',width:20,sortable:true, hidden:true},
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:50,sortable:true}
							]]" />
					</td>
					<td class="label_col2"><label for="store_block_id">Block</label></td> 		
					<td><input class="easyui-combogrid" id="store_block_id" name="store_block_id" style="width:145px" 
						data-options="
							url:'<?php echo site_url('mpoint/opt_store_block/r');?>',
							required:false, panelWidth:300, panelHeight:100,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true, value:0, 
							columns: [[
								{field:'id'	 ,title:'ID',width:20,sortable:true, hidden:true},
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:50,sortable:true}
							]]" />
					</td>
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

<div id="dlg_report" class="easyui-dialog" style="padding:5px" data-options="width:430, height:330, closed:true, cache:false, modal:true">
	<form id="form_report" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<!--
		<div title="FORMS" style="padding:8px">
				<table>
					<tr>
						<td><a href="#" onclick="btn_report('form_phd_mkt_ans_branch');" class="easyui-linkbutton" data-options="iconCls:'icon-form'">FORM PHD ANSWER&nbsp;</a></td>	
					</tr>
				</table>
		</div>
		-->
		<div title="REPORTS" style="padding:8px">
			<div style="padding:2px">
				<table>
					<tr>
						<td colspan=5>
						<fieldset>
							<legend>Output Type :</legend>
							<label><input type="radio" name="output_type" value="1" id="output_type_1" checked>XLS</label>
							<!--
							<label><input type="radio" name="output_type" value="2" id="output_type_2">PDF</label>
							-->
						</fieldset>
						</td>
					</tr>
					<tr>
						<td><br><a href="#" onclick="crud('listing');" class="easyui-linkbutton" data-options="iconCls:'icon-ok'">OK</a></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	</form>
</div>

<div id="dlg_progress" class="easyui-dialog" style="padding:5px" data-options="width:400, height:100, closed:true, cache:false, modal:true">
	 We are preparing your report, please wait...
	<div class="progress_bar" style="width: 100%; height:22px; margin-top: 20px;"></div>
</div>

<script>
	var url;
	
	$(function(){
		resizelayout();
		$(window).resize(resizelayout);
	});
	
	function goFilter( value, name ) {
		if(typeof(value)==='undefined') value = $('#ss').searchbox('getValue');
		if(typeof(name)==='undefined') name = $('#ss').searchbox('getName');
	
		$('#grid').datagrid('load',{  
			is_active: $('#is_active').combobox('getValue'),
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
			url:'<?php echo site_url('mpoint/store/r')?>',	
			columns:[[
				{field:"is_active", title:'ACTIVE', width:50,
					formatter:function( value, rowData, rowIndex ){
						if ( parseInt(value)==1 ) 
							return '<a href="#" onclick="crud(\'active\', this)"><center><input type="checkbox" class="switch" checked="checked" /><label>&nbsp;</label></center></a>';
						else 
							return '<a href="#" onclick="crud(\'active\', this)"><center><input type="checkbox" class="switch" /><label>&nbsp;</label></center></a>';
					}
				},
				// {field:"code", title:'CODE', width:130},
				{field:"name", title:'NAME', width:250},
				{field:"store_type_name", title:'STORE TYPE', width:150},
				{field:"store_floor_name", title:'STORE FLOOR', width:150},
				{field:"store_block_name", title:'STORE BLOCK', width:150},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
				{field:"update_by_name", title:'UPDATE BY', width:100, sortable:true},
				{field:"update_date", title:'UPDATE DATE', width:103, sortable:true},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			// title:'PHD',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageNumber:1, pageSize:50, pageList:[50, 100, 200],
			idField:'id', sortName: 'id', sortOrder: "desc",
			queryParams: { is_active: $('#is_active').combobox('getValue'), findKey: 0, findVal: 0 },
			onDblClickRow: function(rowIndex, rowData) { crud('u') }/* , 
			onClickRow: function(rowIndex, rowData){
				open_detail( rowData.id );
			} */
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
			}]  
		});           

		setKeyTrapping_grid('#grid', 'crud');
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('mpoint/store');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'mpoint', 'store'))?1:0; ?>;
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
			
			$('#code_new').focus();
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'mpoint', 'store'))?1:0; ?>;
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
			
			$('#code_new').val(row.code);
			$('#code_new').focus();
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'mpoint', 'store'))?1:0; ?>;
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

		if ( mode=='report' ) {
		
			$('#dlg_report').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg_report').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_report');?>");
		}

		if ( mode=='listing' ) {
			
			var row = $('#grid').datagrid('getRows').length;  
			if (row<1){
				dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('report_no_data');?>" });
				return;
			}
			
			$('#dlg_report').dialog('close');
			
			$('#form_report').form('submit',{  
				onSubmit: function(event){
				
					var $preparingFileModal = $("#dlg_progress");
					
					$preparingFileModal.dialog({ width: 400, height: 120 })
					.dialog('open').dialog('setTitle', "Preparing report...");
					
					$.fileDownload(url, { 
						httpMethod:'POST', 
						data: {
							output_type: $("[name='output_type']:checked").val(),
							date_f: $('#date_f').datebox('getValue'),  
							date_t: $('#date_t').datebox('getValue'),
							is_active: $('#is_active').combobox('getValue'),
							findKey: $('#ss').searchbox('getName'),
							findVal: $('#ss').searchbox('getValue')
						},
						successCallback: function (url) {
							$preparingFileModal.dialog('close');
							<?php setcookie("fileDownload", "true", time()-3600); ?>
						},
						failCallback: function (result, url) {
							var result = eval('('+result+')');  
							$preparingFileModal.dialog('close');
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							<?php setcookie("fileDownload", "true", time()-3600); ?>
						} 
					});
				}
			});
		}
	}
	
	function btn_save() {  
		$('#forms').form('submit',{  
			url: url,  
			onSubmit: function(param){  
			
				return $(this).form('validate'); 
				
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
					
				} else {  
					$('#dlg').dialog('close');      // close the dialog  
					$('#grid').datagrid('reload');    // reload the user data  
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 

	/* function btn_report() { 
		$('#forms_report').form('submit',{  
			url: "<?php echo site_url('reports/rpt_phd_01');?>",  
			onSubmit: function(){  
				return $(this).form('validate'); 
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					$('#dlg_report').dialog('close');      // close the dialog 
					$('#forms_report').form('submit',{  
						url: "<?php echo site_url('reports/rpt_phd_01/1');?>"  
					});  
					// window.open("<?php echo site_url('reports/rpt_phd_01/1');?>");
				}  
			}  
		});  
	}  */
	
</script>

</body>
</html>