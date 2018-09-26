<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<title></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
<style>
	.label		{width:100px;}
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
				<input type="hidden" id="code" name="code" />
				<table>
					<tr>
						<td><div class="label"><label for="code_new">Code</label></div></td> 	<td>:</td>	
						<td colspan="2"><input class="easyui-validatebox" type="text" id="code_new" name="code_new" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
					</tr>
					<tr>
						<td><label for="name">Name</label></td> 		<td>:</td>	
						<td colspan="2"><input class="easyui-validatebox" type="text" id="name" name="name" style="width:250px; border:1px solid #ccc;" data-options="required:true" /></td>
					</tr>
					<tr>
						<td><label for="item_cat_id">Category</label></td> <td>:</td>	
						<td colspan="2"><input class="easyui-combogrid" type="text" id="item_cat_id" name="item_cat_id" style="width:250px" data-options="
							url:'<?php echo site_url('master/item_cat/r');?>',
							required:true, panelWidth:250, panelHeight:150, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:false, 
							columns: [[
								{field:'id',title:'ID',width:50,sortable:true,hidden:true},
								{field:'code',title:'CODE',width:70,sortable:true},
								{field:'name',title:'NAME',width:150,sortable:true}
							]]" /></td>
					</tr>
					<tr>
						<td><label for="measure_id">Measure</label></td> <td>:</td>	
						<td colspan="2"><input class="easyui-combogrid" type="text" id="measure_id" name="measure_id" style="width:250px" data-options="
							url:'<?php echo site_url('master/measure/r');?>',
							required:true, panelWidth:250, panelHeight:150, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:false, 
							columns: [[
								{field:'id',title:'ID',width:50,sortable:true,hidden:true},
								{field:'code',title:'CODE',width:70,sortable:true},
								{field:'name',title:'NAME',width:150,sortable:true}
							]]" /></td>
					</tr>
					<tr>
						<td><label for="price_buy">Price Buy - Price Sell</label></td> 		<td>:</td>	
						<td><input class="easyui-numberspinner" type="text" id="price_buy" name="price_buy" style="width:120px; border:1px solid #ccc;" data-options="required:true,min:0,precision:2,groupSeparator:',',decimalSeparator:'.'" /></td>
						<td><input class="easyui-numberspinner" type="text" id="price_sell" name="price_sell" style="width:125px; border:1px solid #ccc;" data-options="required:true,min:0,precision:2,groupSeparator:',',decimalSeparator:'.'" /></td>
					</tr>
					<tr>
						<td><label for="expired_date">Expired Date</label></td> 		 <td>:</td>	
						<td colspan="2"><input class="easyui-datebox" id="expired_date" name="expired_date" style="width:120px;" data-options="required:true" /></td>
					</tr>
					<tr>
						<td><label for="stock_val">Stock Value</label></td> 		<td>:</td>	
						<td colspan="2"><input class="easyui-numberspinner" type="text" id="stock_val" name="stock_val" style="width:120px; border:1px solid #ccc;" data-options="required:true,min:0" /></td>
					</tr>
					<tr>
						<td><label for="stock_min">Stock Min - Stock Max</label></td> 		<td>:</td>	
						<td><input class="easyui-numberspinner" type="text" id="stock_min" name="stock_min" style="width:120px; border:1px solid #ccc;" data-options="required:true,min:0" /></td>
						<td><input class="easyui-numberspinner" type="text" id="stock_max" name="stock_max" style="width:125px; border:1px solid #ccc;" data-options="required:true,min:0" /></td>
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

<div id="dlg_report" class="easyui-dialog" style="padding:5px"
	data-options="width:400, height:300, closed:true, cache:false, modal:true,
		buttons: [{
			text:'<?php echo l('form_btn_ok');?>',
			iconCls:'icon-ok',
			handler:function(){	btn_report(); }
		},{
			text:'<?php echo l('form_btn_cancel');?>',
			iconCls:'icon-cancel',
			handler:function(){	$('#dlg_report').dialog('close'); }
		}]
	">
	<form id="form_report" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="REPORTS" style="padding:8px">
			<div style="padding:2px">
				<table>
					<tr>
						<td colspan=5>
						<fieldset>
							<legend>Type :</legend>
							<label><input type="radio" name="report_type" value="1" id="report_type_1" checked>Stock Expired</label><br>
							<label><input type="radio" name="report_type" value="2" id="report_type_2">TOP 50 Best Seller</label>
						</fieldset>
						</td>
					</tr>
					<tr>
						<td><div class="label"><label for="date_fr">Date From</label></div></td>	<td class="separator">:</td>	
						<td style="width:52px"><input id="date_fr" name="date_fr" class="easyui-datebox" style="width:100px" data-options="required:true" /></td>
						<td colspan="2">&nbsp;To :&nbsp;<input id="date_to" name="date_to" class="easyui-datebox" style="width:100px" data-options="required:true" /></td>
					</tr>
				</table>
			</div>
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
	
	// =========================================================================================
	
	$(function(){  
		$("#grid").datagrid({        
			url:'<?php echo site_url('master/item/r')?>',	
			columns:[[
				{field:'code', title:'CODE', width:150, sortable:true},
				{field:'name', title:'NAME', width:350, sortable:true},
				{field:'item_cat_name', title:'CATEGORY', width:250, sortable:true},
				{field:'measure_name', title:'MEASURE', width:150, sortable:true},
				{field:'price_buy', title:'PRICE BUY', width:100, sortable:true},
				{field:'price_sell', title:'PRICE SELL', width:100, sortable:true},
				{field:"expired_date", title:'EXPIRED DATE', width:103, sortable:true},
				{field:"stock_val", title:'STOCK', width:100, sortable:true},
				{field:"stock_min", title:'MIN', width:100, sortable:true},
				{field:"stock_max", title:'MAX', width:100, sortable:true},
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
			},{  
				text:'<?php echo l('form_btn_report');?>',
				iconCls:'icon-ok',  
				handler:function(){ crud('report') }  
			}]  
		});           

		setKeyTrapping_grid('#grid', 'crud');
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('master/item');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'master', 'item'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_create_item');?>");
			$('#forms').form('clear'); 
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'master', 'item'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (row){  
				$('#forms').form('clear'); 
			
				$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_update_item');?>");  
				$('#forms').form('load',row); 
				
				$('#code_new').val(row.code); 
				if ( row.expired_date ) {
					var ss = row.expired_date.split('-');
					var y = parseInt(ss[0],10);
					var m = parseInt(ss[1],10);
					var d = parseInt(ss[2],10);
				} else {
					var f = new Date();
					var y = f.getFullYear();
					var m = f.getMonth()+1;
					var d = f.getDate();
				}
				$('#expired_date').datebox('setValue', (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
			}
			
			
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'master', 'item'))?1:0; ?>;
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

		if ( mode=='report' ) {
			var date = new Date(), y = date.getFullYear(), m = date.getMonth();
			var f = new Date(y, m, 1);
			var t = new Date(y, m+1, 0);
			
			var y = f.getFullYear();
			var m = f.getMonth()+1;
			var d = f.getDate();
			$('#date_fr').datebox('setValue', (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
			
			var y = t.getFullYear();
			var m = t.getMonth()+1;
			var d = t.getDate();
			$('#date_to').datebox('setValue', (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
			
			$('#dlg_report').dialog('open').dialog('setTitle',"<?php echo l('form_report_item');?>");  
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

	$(function(){
		$("input[name='report_type']").change(function(){
			report_type($(this).val());
		});
		setTimeout(function(){
			report_type(1);
		},1);
	});
	
	function report_type(no){
		if (no==1){
			$("#date_fr").datebox('disable');
			$("#date_to").datebox('disable');
		}
		if (no==2){
			$("#date_fr").datebox('enable');
			$("#date_to").datebox('enable');
		}
	}
	
	function btn_report() { 
		var date = new Date(), y = date.getFullYear(), m = date.getMonth()+1, d = date.getDate();
		today = y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d)

		var report_type = $("input[name='report_type']:checked").val();
		if ( report_type==1 ) {
			url = '<?php echo site_url('master/item_expired_pdf/');?>/'+today;
			window.open(url);
			$('#dlg_report').dialog('close');      // close the dialog 
			return;
		} else if ( report_type==2 ) {
			var date_f = $("#date_fr").datebox('getValue').split("/");
			date_f = date_f[2]+"-"+date_f[1]+"-"+date_f[0];
			var date_t = $("#date_to").datebox('getValue').split("/");
			date_t = date_t[2]+"-"+date_t[1]+"-"+date_t[0];
			
			url = '<?php echo site_url('master/item_top_50_pdf/');?>/'+date_f+'/'+date_t;
			window.open(url);
			$('#dlg_report').dialog('close');      // close the dialog 
			return;
		} else {
			url = '<?php echo site_url('master/');?>';
		}

		$('#form_report').form('submit',{  
			url: url,  
			onSubmit: function(){  
				return $(this).form('validate'); 
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ width:"400px", title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
					return false;
				} else {  
					$('#dlg_report').dialog('close');      // close the dialog 
					$('#form_report').form('submit',{ url: url+'/1' });  
				} 
			}  
		});  
	} 

</script>

</body>
</html>