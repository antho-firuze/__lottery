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

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:550, height:430, closed:true, cache:false, modal:true">
	<form id="forms" method="post">
		<div class="easyui-tabs" style="width:auto;height:auto">
			<div title="GENERAL" style="padding:8px">
				<input type="hidden" id="id" name="id" />
				<input type="hidden" id="code" name="code" />
				<table>
				<tr>
					<td class="label_col1"><label for="code_new">Code</label></td> 		
					<td colspan="2"><input class="easyui-validatebox" type="text" id="code_new" name="code_new" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
				</tr>
				<tr>
					<td><label for="name">Name</label></td> 			
					<td colspan="2"><input class="easyui-validatebox" type="text" id="name" name="name" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
				</tr>
				<tr>
					<td class="label_col1"><label for="depth_level">Depth Level</label></td> 			
					<td><input class="easyui-combogrid" type="text" id="coa_d" name="coa_d" style="width:120px" data-options="
						url:'<?php echo site_url('acc/coa/r');?>',
						required:false, panelWidth:500, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
						pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
						columns: [[
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:80,sortable:true},
							{field:'id'	 ,title:'ID',width:5,sortable:false}
						]]" /></td>
					<td class="label_col2"><label for="coa_c">Account (C)</label></td> 			
					<td><input class="easyui-combogrid" type="text" id="coa_c" name="coa_c" style="width:120px" data-options="
						url:'<?php echo site_url('acc/coa/r');?>',
						required:false, panelWidth:500, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
						pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
						columns: [[
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:80,sortable:true},
							{field:'id'	 ,title:'ID',width:5,sortable:false}
						]]" /></td>
				</tr>
				</table>
			</div>
			<div title="DOCUMENT LOG" style="padding:10px">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td class="label_col1">Create By</td>			<td><input type="text" name="createby_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
						<td class="label_col2">Create Date</td>			<td><input type="text" name="createdate" style="border:1px solid #ccc; width:145px;" disabled /></td>
					</tr>
					<tr>
						<td class="label_col1">Update By</td>			<td><input type="text" name="updateby_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
						<td class="label_col2">Update Date</td>			<td><input type="text" name="updatedate" style="border:1px solid #ccc; width:145px;" disabled /></td>
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
		if ( !isNaN(parseFloat(value)) && isFinite(value) )
			return accounting.formatMoney(value, '');
	}
	
	function format_checkbox( value, row ) {
		if ( !isNaN(parseFloat(value)) && isFinite(value) )
			if ( parseInt(value) )
				return "<input type='checkbox' onclick='return false' onkeydown='return false' checked>";
			else
				return "<input type='checkbox' onclick='return false' onkeydown='return false'>";
	}
	
	function greyField( value, row ) {
		if (value != null)
			return '<span style="color:#ADADAD;">'+value+'</span>'; 
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
			url:'<?php echo site_url('acc/coa/r')?>',	
			columns:[[
				{field:'code', title:'CODE', width:100, sortable:true},
				{field:'name', title:'NAME', width:250, sortable:true},
				// {field:"parent_id", title:'PARENT', width:60, align:'right'},
				{field:"depth_level", title:'DEPTH', width:60, align:'center'},
				{field:"has_child", title:'HAS CHILD', width:60, align:'center'},
				{field:"is_default", title:'DEFAULT', width:60, sortable:true, align:'center'},
				{field:"is_cash", title:'IS CASH', width:60, align:'center'},
				{field:"is_debit", title:'IS DEBIT', width:60, align:'center'},
				{field:"is_balance", title:'IS BALANCE', width:90, align:'center'},
				{field:"is_profit_lost", title:'IS PROFIT', width:65, align:'center'},
				{field:"currency_code", title:'CURR', width:50},
				{field:"beginning_balance_d", title:'BEG. BALANCE (D)', width:100, align:'right'},
				{field:"beginning_balance_c", title:'BEG. BALANCE (C)', width:100, align:'right'},
				{field:"mutasi_d", title:'MUTASI (D)', width:100, align:'right'},
				{field:"mutasi_c", title:'MUTASI (C)', width:100, align:'right'},
				{field:"final_balance_d", title:'FINAL BALANCE (D)', width:100, align:'right'},
				{field:"final_balance_c", title:'FINAL BALANCE (C)', width:100, align:'right'},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
				{field:"update_by_name", title:'UPDATE BY', width:100, sortable:true},
				{field:"update_date", title:'UPDATE DATE', width:103, sortable:true},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			// title:'',
			fit:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			pageSize:50, 
			idField:'id', sortName: 'code', sortOrder: 'asc', multiSort: false,
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
		
		url = "<?php echo site_url('acc/coa');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'acc', 'coa'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('clear'); 
			$('#dlg').dialog({
				height: 250,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save() }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'acc', 'coa'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return false;

			$('#forms').form('clear'); 
			$('#forms').form('load',row); 
			$('#coa_d').combogrid('grid').datagrid( 'load', {q: row.coa_d_code } );
			$('#coa_c').combogrid('grid').datagrid( 'load', {q: row.coa_c_code } );
		
			$('#dlg').dialog({
				height: 250,
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save() }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");
			
			$('#code_new').val(row.code); 
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'acc', 'coa'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (!row)
				return false;

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