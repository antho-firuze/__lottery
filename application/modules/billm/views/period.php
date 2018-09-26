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

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:550, height:230, closed:true, cache:false, modal:true">
	<form id="forms" method="post">
		<div class="easyui-tabs" style="width:auto;height:auto">
			<div title="GENERAL" style="padding:8px">
				<input type="hidden" id="id" name="id" />
				<table>
					<tr>
						<td class="label_col1"><label for="code">Code</label></td> 		
						<td colspan="2"><input class="easyui-validatebox" id="code" name="code" style="width:175px;" data-options="required:false, value:77" disabled /></td>
					</tr>
					<tr>
						<td class="label_col1"><label for="period_year">Year</label></td> 			
						<td><input class="easyui-numberspinner" id="period_year" name="period_year" style="width:120px;" data-options="required:true, value:2014, min:2014, max:2017" disabled /></td>
						<td class="label_col2"><label for="period_month">Month</label></td> 			
						<td><input class="easyui-numberspinner" id="period_month" name="period_month" style="width:120px;" data-options="required:true, value:1, min:1, max:12" disabled /></td>
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
	
	// =========================================================================================
	$(function(){  
		$("#grid").datagrid({        
			url:'<?php echo site_url('billm/period/r')?>',	
			columns:[[
				{field:'code', title:'CODE', width:100, sortable:true},
				{field:"date_begin", title:'DATE BEGIN', width:103, sortable:true},
				{field:"date_end", title:'DATE END', width:103, sortable:true},
				{field:"retrieved", title:'RETRIEVED', width:80, sortable:true, align:'center', formatter:format_checkbox},
				// {field:"retrieve_by_name", title:'RETRIEVE BY', width:100, sortable:true},
				{field:"calculated", title:'CALCULATED', width:80, sortable:true, align:'center', formatter:format_checkbox},
				// {field:"calculate_by_name", title:'CALCULATE BY', width:100, sortable:true},
				{field:"generated", title:'GENERATED', width:80, sortable:true, align:'center', formatter:format_checkbox},
				// {field:"generate_by_name", title:'GENERATE BY', width:100, sortable:true},
				{field:"posted", title:'POSTED', width:80, sortable:true, align:'center', formatter:format_checkbox},
				// {field:"post_by_name", title:'POST BY', width:100, sortable:true},
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
			pageNumber:1, pageSize:50, pageList:[50,100], 
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
		
		setKeyTrapping_grid( '#grid', 'crud' );
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('billm/period');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'billm', 'period'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('reset'); 
			
			$('#dlg').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save() }
				},{
					text:'<?php echo l('form_btn_save_new');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save( 2 ) }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_create');?>");
			
			$('#code').val('AUTO');
			$('#period_year').numberspinner('enable');
			$('#period_month').numberspinner('enable');
			$('#period_year').focus();
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'billm', 'period'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return;

			$('#forms').form('reset'); 
			$('#forms').form('load',row); 
			
			$('#dlg').dialog({
				buttons:[{
					text:'<?php echo l('form_btn_save');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save() }
				},{
					text:'<?php echo l('form_btn_save_next');?>',
					iconCls:'icon-save',
					handler:function(){	btn_save( 2 ) }
				},{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close') }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_update');?>");
			
			$('#period_year').numberspinner('disable');
			$('#period_month').numberspinner('disable');
			$('#period_year').focus();
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'billm', 'period'))?1:0; ?>;
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