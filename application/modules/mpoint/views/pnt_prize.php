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
				<div id="tb" style="padding:3px">  
					<div>  
						<input id="ss" class="easyui-searchbox" style="width:300px" data-options="searcher:goFilter, prompt:'Please Input Value',menu:'#mm'"></input>
					</div> 
				</div>
				<div id="mm" style="width:145px">  
					<div data-options="name:'all',iconCls:'icon-ok'">ALL FIELDS</div>  
					<div data-options="name:'id'">PRIZE ID</div>  
					<div data-options="name:'name'">NAME</div>  
					<div data-options="name:'period_name'">PERIOD</div>  
				</div> 
			</div>  
		</div>  
	</div>  
</div>

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:600, height:320, closed:true, cache:false, modal:true">
	<form id="forms" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="DATA ENTRY" style="padding:8px">
			<input type="hidden" id="id" name="id" />
			<table>
				<tr>
					<td class="label_col1"><label for="ids">Prize ID</label></td> 	
					<td><input type="text" id="ids" name="ids" style="width:145px; border:1px solid #ccc;" disabled /></td>
				</tr>
				<tr>
					<td><label for="period_id">Period</label></td> 			
					<td><input class="easyui-combogrid" type="text" id="period_id" name="period_id" style="width:145px" 
						data-options="
							url:'<?php echo site_url('mpoint/pnt_period/r');?>',
							required:true, panelWidth:300, panelHeight:100,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true,
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:150,sortable:true},
								{field:'id'	 ,title:'ID',width:20,sortable:true}
							]],
							onSelect: function(rowIndex, rowData){
								$('#period_phase_id').combogrid({ queryParams:{period_id: rowData.id} });
							}" />
					</td>
					<td class="label_col2"><label for="period_phase_id">Phase</label></td> 			
					<td><input class="easyui-combogrid" type="text" id="period_phase_id" name="period_phase_id" style="width:145px" 
						data-options="
							url:'<?php echo site_url('mpoint/pnt_period_phase/r');?>',
							required:false, panelWidth:300, panelHeight:100,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true,
							columns: [[
								// {field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:150,sortable:true},
								{field:'id'	 ,title:'ID',width:20,sortable:true}
							]]" />
					</td>
				</tr>
				<tr>
					<td><label for="sort">Prize No</label></td> 	
					<td><input class="easyui-numberspinner" type="text" id="sort" name="sort" style="width:145px" data-options="required:false,min:1,precision:0,groupSeparator:',',decimalSeparator:'.',value:1" /></td>
					<td class="label_col2"><label for="qty">Quantity</label></td> 	
					<td><input class="easyui-numberspinner" type="text" id="qty" name="qty" style="width:145px" data-options="required:false,min:1,precision:0,groupSeparator:',',decimalSeparator:'.',value:1" /></td>
				</tr>
				<tr>
					<td><label for="name">Name</label></td> 	
					<td><input class="easyui-validatebox" type="text" id="name" name="name" style="width:145px; border:1px solid #ccc;" data-options="required:true" /></td>
				</tr>
			</table>
		</div>
		<div title="DOCUMENT LOG" style="padding:10px">
			<table>
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
			url:'<?php echo site_url('mpoint/pnt_prize/r')?>',	
			columns:[[
				{field:"period_name", title:'PROGRAM NAME', width:250, sortable:true},
				{field:"phase_name", title:'PHASE', width:150, sortable:true},
				{field:"name", title:'NAME', width:300},
				{field:"sort", title:'PRIZE NO', width:80},
				{field:"qty", title:'QUANTITY', width:80},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
				{field:"update_by_name", title:'UPDATE BY', width:100, sortable:true},
				{field:"update_date", title:'UPDATE DATE', width:103, sortable:true},
				{field:'id', title:'ID', width:50, sortable:true}
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
			idField:'id', sortName: 'id', sortOrder: "desc",
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
			}/* ,{  
				text:'APPROVE',
				iconCls:'icon-ok',  
				handler:function(){ crud('d') }  
			} */]  
		});           
		
		setKeyTrapping_grid('#grid', 'crud');
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('mpoint/pnt_prize');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'mpoint', 'pnt_prize'))?1:0; ?>;
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
			setTimeout( function(){ 
				$.post( '<?php echo site_url('mpoint/get_active_period');?>', 
					function( result ) {  
						$('#period_id').combogrid('setValue', result.period_id);
					}, 'json'
				); 
			}, 100 );
			$('#period_id').next().find('input').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'mpoint', 'pnt_prize'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return false;

			$('#forms').form('reset'); 
			$('#period_phase_id').combogrid({ queryParams:{period_id: row.period_id} });
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
			
			$('#period_id').next().find('input').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'mpoint', 'pnt_prize'))?1:0; ?>;
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
		
		if ( mode=='reports' ) {
			$('#date_fr').datebox('setValue', start_month());
			$('#date_to').datebox('setValue', end_month());
			
			$('#dlg_report').dialog('open').dialog('setTitle',"<?php echo l('form_phd_reports');?>");  
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