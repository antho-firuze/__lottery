<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-easyui/js/jquery.edatagrid.js"></script>
</head>
<style>
	.label		{width:170px;}
	.label_col1		{width:100px; vertical-align:text-top;}
	.label_col2		{padding-left:10px; width:100px; vertical-align:text-top;}
</style>
<body>
		
<div id="cc" class="easyui-layout">  
	<div data-options="region:'center'">
		<div id="rr" class="easyui-layout" data-options="fit:true">  
			<div data-options="region:'north',split:true" style="height:300px">
				<table id="grid" style='height:100%; width:100%;' toolbar="#tb"></table>
				<div id="tb" style="padding:7px">  
					&nbsp;
					<div style="display:inline;">
						<div style="float:left;">
							<label for="date_f">&nbsp;DATE FROM :&nbsp;</label>	<input id="date_f" class="easyui-datebox" style="width:100px" data-options="
								value:start_month(),
								onSelect:function(date){
									goFilter();
								}">  
							<label for="date_t">&nbsp;TO :&nbsp;</label><input id="date_t" class="easyui-datebox" style="width:100px" data-options="
								value:end_month(),
								onSelect:function(date){
									goFilter();
								}">  
							<!--
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
							-->
						</div> 
						<div style="float:right;"><input id="ss" class="easyui-searchbox" style="width:300px" data-options="searcher:goFilter, prompt:'Please Input Value',menu:'#mm'"></input></div> 
						<div id="mm" style="width:145px">  
							<div data-options="name:'ALL',iconCls:'icon-ok'">ALL FIELDS</div>  
							<div data-options="name:'r.id'">RECEIPT ID</div>  
							<div data-options="name:'pp.name'">PERIOD</div>  
							<div data-options="name:'opt.name'">PAYMENT TYPE</div>  
							<div data-options="name:'s.name'">STORE</div>  
							<div data-options="name:'m.first_name'">FIRST NAME</div>  
							<div data-options="name:'m.last_name'">LAST NAME</div>  
							<div data-options="name:'m.identity_no'">IDENTITY NO</div>  
							<div data-options="name:'r.note'">NOTE</div>  
						</div> 
					</div> 
				</div>
			</div>  
			<div data-options="region:'center'">
				<table id="grid2" style='height:100%;'></table>
			</div>  
		</div>  
	</div>  
</div>

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:750, height:560, closed:true, cache:false, modal:true">
	<form id="forms" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:175px">
		<div title="DATA ENTRY" style="padding:8px">
			<input type="hidden" id="id" name="id" />
			<table>
				<tr>
					<td class="label_col1"><label for="ids">Receipt No</label></td> 
					<td><input id="ids" name="ids" style="width:145px; border:1px solid #ccc;" disabled /></td>
					<td class="label_col2"><label for="date">Date</label></td> 
					<td><input class="easyui-datebox" id="date" name="date" style="width:145px;" data-options="required:true, value:format_dmy()" /></td>
				</tr>
				<tr>
					<td><label for="period_id">Period</label></td> 		
					<td><input class="easyui-combogrid" id="period_id" name="period_id" style="width:145px" 
						data-options="
							url:'<?php echo site_url('mpoint/pnt_period/r');?>',
							required:true, panelWidth:300, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true,
							columns: [[
								{field:'id'	 ,title:'ID',width:20,sortable:true, hidden:true},
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:50,sortable:true}
							]]" />
					</td>
					<td class="label_col2"><label for="period_phase_id">Phase</label></td> 			
					<td><input class="easyui-combogrid" id="period_phase_id" name="period_phase_id" style="width:145px;" 
						data-options="
							url:'<?php echo site_url('mpoint/pnt_period_phase/r');?>',
							required:false, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:150,sortable:true},
								{field:'id'	 ,title:'ID',width:20,sortable:true, hidden:true}
							]]" />
					</td>
				</tr>
				<tr>
					<td><label for="member_id">Member Code</label></td> 		
					<td><input class="easyui-combogrid" id="member_id" name="member_id" style="width:145px" 
						data-options="
							url:'<?php echo site_url('mpoint/member/r');?>',
							required:true, panelWidth:600, panelHeight:200,	idField:'id', textField:'code',	mode:'remote', loadMsg:'Loading...',
							pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:false, editable:true,
							columns: [[
								{field:'code',title:'CODE',width:150,sortable:true},
								{field:'first_name',title:'FIRST NAME',width:100,sortable:true},
								{field:'last_name',title:'LAST NAME',width:100,sortable:true},
								{field:'identity_no',title:'IDENTITY NO',width:150,sortable:true},
								{field:'id',title:'ID',width:20,sortable:true}
							]],
							onSelect:function(rowIndex, rowData){
								$('#name').val(rowData.first_name+' '+rowData.last_name);
							}" />
					</td>
					<td class="label_col2"><label for="name">Name</label></td> 		
					<td><input id="name" name="name" style="width:145px; border:1px solid #ccc;" disabled /></td>
				</tr>
				<tr>
					<td><label for="total_value">Total Value</label></td> 
					<td><input class="easyui-numberspinner" id="total_value" name="total_value" style="width:145px" data-options="required:false,min:0,precision:2,groupSeparator:',',decimalSeparator:'.',value:0" disabled /></td>
					<td class="label_col2"><label for="total_point">Total Point</label></td> 
					<td><input class="easyui-numberspinner" id="total_point" name="total_point" style="width:145px" data-options="required:false,min:0,precision:0,groupSeparator:',',decimalSeparator:'.',value:0" disabled /> ( AUTOMATIC )</td>
				</tr>
			</table>
		</div>
		<div title="NOTE" style="padding:8px">
			<table>
				<tr>
					<td class="label_col1"><label for="note">Note</label></td> 		
					<td colspan="3"><textarea id="note" name="note" style="height:115px; width:405px; border:1px solid #ccc;"></textarea></td>
				</tr>
			</table>
		</div>
		<div title="DOCUMENT LOG" style="padding:8px">
			<table>
				<tr>
					<td class="label_col1">Create By</td>			<td><input name="create_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
					<td class="label_col2">Create Date</td>			<td><input name="create_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
				</tr>
				<tr>
					<td class="label_col1">Update By</td>			<td><input name="update_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
					<td class="label_col2">Update Date</td>			<td><input name="update_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
				</tr>
			</table>
		</div>
	</div>
	<div id="p" style="width:auto; margin-top:13px; height:272px;">
		<table id="grid3" style='height:270px;'></table>
	</div>
	</form>
</div>

<div id="dlg_point" class="easyui-dialog" style="padding:10px" data-options="width:600, height:430, closed:true, cache:false, modal:true">
	<form id="form_point" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="DATA ENTRY" style="padding:8px">
			<table>
			<tr>
				<td><label for="period_id">Period</label></td> 		
				<td><input class="easyui-combogrid" id="period_id" name="period_id" style="width:145px" 
					data-options="
						url:'<?php echo site_url('mpoint/pnt_period/r');?>',
						required:true, panelWidth:300, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
						pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true,
						columns: [[
							{field:'id'	 ,title:'ID',width:20,sortable:true, hidden:true},
							{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
							{field:'name',title:'NAME',width:50,sortable:true}
						]],
						onSelect: function(rowIndex, rowData){
							$('#form_point #period_phase_id').combogrid({ queryParams:{period_id: rowData.id} });
						}" />
				</td>
				<td class="label_col2"><label for="period_phase_id">Phase</label></td> 			
				<td><input class="easyui-combogrid" id="period_phase_id" name="period_phase_id" style="width:145px;" 
					data-options="
						url:'<?php echo site_url('mpoint/pnt_period_phase/r');?>',
						required:false, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
						pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true, 
						columns: [[
							{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
							{field:'name',title:'NAME',width:150,sortable:true},
							{field:'id'	 ,title:'ID',width:20,sortable:true, hidden:true}
						]]" />
				</td>
			</tr>
			<tr>
				<td><label for="member_id">Member Code</label></td> 		
				<td><input class="easyui-combogrid" id="member_id" name="member_id" style="width:145px" 
					data-options="
						url:'<?php echo site_url('mpoint/member/r');?>',
						required:true, panelWidth:600, panelHeight:200,	idField:'id', textField:'code',	mode:'remote', loadMsg:'Loading...',
						pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:false, editable:true,
						columns: [[
							{field:'code',title:'CODE',width:150,sortable:true},
							{field:'first_name',title:'FIRST NAME',width:100,sortable:true},
							{field:'last_name',title:'LAST NAME',width:100,sortable:true},
							{field:'identity_no',title:'IDENTITY NO',width:150,sortable:true},
							{field:'id',title:'ID',width:20,sortable:true}
						]],
						onSelect:function(rowIndex, rowData){
							$('#form_point #name').val(rowData.first_name+' '+rowData.last_name);
						}" />
				</td>
				<td class="label_col2"><label for="name">Name</label></td> 		
				<td><input id="name" name="name" style="width:145px; border:1px solid #ccc;" disabled /></td>
			</tr>
			<tr>
				<td class="label_col1"><label for="date">Date</label></td> 
				<td><input class="easyui-datebox" id="date" name="date" style="width:145px;" data-options="required:true, value:format_dmy()" /></td>
			</tr>
			<tr>
				<td colspan="4"><hr><a href="#" onclick="crud('point', 'get');" class="easyui-linkbutton" data-options="iconCls:'icon-ok'">OK</a></td>
			</tr>
			</table>
		</div>
	</div>
	<table border="1" style="width:100%; height:155px;">
		<tr>
			<td style="width:50%; text-align:center;"><h3>POINT THIS DAY</h3></td>
			<td style="width:50%; text-align:center;"><h3>POINT THIS PERIOD</h3></td>
		</tr>
		<tr>
			<td style="height:100%; text-align:center; vertical-align:center;"><div id="point_this_day"><h1>-</h1></div></td>
			<td style="height:100%; text-align:center; vertical-align:center;"><div id="point_this_period"><h1>-</h1></div></td>
		</tr>
	</table>
	</form>
</div>

<script>
	var url;
	
	function resizelayout2(){
		$("#rr").layout('panel', 'north').panel('resize',{height:$(window).height()*0.5});
		$("#rr").layout('resize');
	}
	
	$(function(){
		resizelayout();
		$(window).resize(resizelayout);
		
		resizelayout2();
		$(window).resize(resizelayout2);
	});
	
	function goFilter( value, name ) {
		if(typeof(value)==='undefined') value = $('#ss').searchbox('getValue');
		if(typeof(name)==='undefined') name = $('#ss').searchbox('getName');
	
		$('#grid').datagrid('load',{  
			date_f: $('#date_f').datebox('getValue'),  
			date_t: $('#date_t').datebox('getValue'),
			findKey: name,
			findVal: value
		});
	}
	
	$.extend($.fn.datagrid.defaults.editors, {
		numberspinner: {
			init: function(container, options){
				var input = $('<input type="text">').appendTo(container);
				return input.numberspinner(options);
			},
			destroy: function(target){
				$(target).numberspinner('destroy');
			},
			getValue: function(target){
				return $(target).numberspinner('getValue');
			},
			setValue: function(target, value){
				$(target).numberspinner('setValue',value);
			},
			resize: function(target, width){
				$(target).numberspinner('resize',width);
			}
		}, 
		combogrid: {
			init: function(container, options){
				var input = $('<input type="text">').appendTo(container);
				return input.combogrid(options);
			},
			destroy: function(target){
				$(target).combogrid('destroy');
			},
			getValue: function(target){
				return $(target).combogrid('getValue');
			},
			setValue: function(target, value){
				$(target).combogrid('setValue',value);
			},
			resize: function(target, width){
				$(target).combogrid('resize',width);
			}
		}
	});
		
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
			url:'<?php echo site_url('mpoint/pnt_receipt/r')?>',	
			columns:[[
				{field:"period_name", title:'PERIOD', width:130},
				{field:"period_phase_name", title:'PHASE', width:130},
				{field:"member_code", title:'MEMBER CODE', width:100},
				{field:"member_first_name", title:'FIRST NAME', width:100},
				{field:"member_last_name", title:'LAST NAME', width:100},
				{field:"member_identity_no", title:'IDENTITY NO', width:150},
				{field:"date", title:'RECEIPT DATE', width:100},
				{field:"total_value", title:'TOTAL VALUE', width:100},
				{field:"total_point", title:'TOTAL POINT', width:100, formatter:greenField},
				{field:"max_receipt_daily", title:'MAX. RCPT (DAY)', width:100, formatter:greyField},
				{field:"note", title:'NOTE', width:250},
				{field:"create_by_name", title:'CREATE BY', width:100, sortable:true, formatter:greyField},
				{field:"create_date", title:'CREATE DATE', width:103, sortable:true, formatter:greyField},
				{field:"update_by_name", title:'UPDATE BY', width:100, sortable:true, formatter:greyField},
				{field:"update_date", title:'UPDATE DATE', width:103, sortable:true, formatter:greyField},
				{field:'id', title:'ID', width:60, sortable:true, formatter:greyField}
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
			queryParams: { date_f: $('#date_f').datebox('getValue'), date_t: $('#date_t').datebox('getValue'), findKey: 0, findVal: 0 },
			onDblClickRow: function(rowIndex, rowData) { crud('u') }, 
			onClickRow: function(rowIndex, rowData){
				$("#grid2").datagrid('load', {receipt_id: rowData.id});  
				$("#grid3").datagrid('load', {receipt_id: rowData.id});  
			}
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
			},{  
				text:'CHECK POINT',
				iconCls:'icon-ok',  
				handler:function(){ crud('point') }  
			}]  
		});           
		
		setKeyTrapping_grid('#grid', 'crud');
	})

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('mpoint/pnt_receipt');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'mpoint', 'pnt_receipt'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#forms').form('reset'); 
			$("#grid3").datagrid('load', {receipt_id: ''});  
			
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
			
			$('#ids').val('AUTO');
			$('#period_id').combogrid('setValue', <?php echo mpoint_period_default()->id;?>);
			$('#period_phase_id').combogrid({ queryParams:{period_id: $('#period_id').combogrid('getValue')} });
			$('#period_id').next().find('input').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'mpoint', 'pnt_receipt'))?1:0; ?>;
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
			$('#member_id').combogrid('grid').datagrid('load', {q: row.member_id});
			
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
			
			$('#ids').val(row.id);
			$('#date').datebox('setValue', format_dmy(row.date));
			$('#period_id').next().find('input').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'mpoint', 'pnt_receipt'))?1:0; ?>;
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
							$('#grid2').datagrid({ queryParams:{receipt_id: 0} });    // reload the user data  
							dhtmlx.message("<?php echo l('success_delete');?>");
						} else {  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
						}  
					},'json');  
				}}  
			});  
		}
		
		if ( mode=='point' ) {
			
			if (target=='get'){
				$.post( "<?php echo site_url('mpoint/check_point');?>", {
				
					period_id: $('#form_point #period_id').combogrid('getValue'),
					period_phase_id: $('#form_point #period_phase_id').combogrid('getValue'),
					member_id: $('#form_point #member_id').combogrid('getValue'),
					date: $('#form_point #date').datebox('getValue')
					
				}, function(result){  
					if (result.success){
						$('#point_this_day').html('<h1 style="font-size:30pt">'+result.this_day+'</h1>');
						$('#point_this_period').html('<h1 style="font-size:30pt">'+result.this_period+'</h1>');
					} else {  
						dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
					}  
				},'json');  
				return false;
			}
			
			$('#form_point').form('reset'); 
			$('#dlg_point').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg_point').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_check_point');?>");
		}
		
		if ( mode=='reports' ) {
		}
	}
	
	function btn_save( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg');
		var forms = $('#forms');
		var grid = $('#grid');
		var grid_ = $('#grid2');
		var crud = 'crud';
		if ( $('#id').val()=='' ) 
			var mode = 'c';
		else
			var mode = 'u';
			
		url = "<?php echo site_url('mpoint/pnt_receipt');?>/"+mode;
		
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
					grid_.datagrid('reload');    // reload the user data 
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

	function btn_point() {  
		$('#form_point').form('submit',{  
			url: url,  
			onSubmit: function(param){  
			
				return $(this).form('validate'); 
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
					
				} else {  
					dhtmlx.alert({title:"MEMBER CHECK POINT", type:"alert-error", text:"TOTAL THIS DAY : "+result.total_this_day+"<br>TOTAL THIS PERIOD : "+result.total_this_period}); 
				}  
			}  
		});  
	} 

	// GRID 2 =====
	var target;
	
	$(function(){  

		$("#grid2").datagrid({        
			title:'DETAIL',
			url:"<?php echo site_url('mpoint/pnt_receipt_dt/r')?>",	
			columns:[[
				{field:'payment_type_name', title:'PAYMENT TYPE', width:125},
				{field:"store_name", title:'STORE', width:200, sortable:true},
				{field:"store_type_name", title:'STORE TYPE', width:200, sortable:true},
				{field:"value", title:'VALUE', width:90, sortable:true, align:'right', formatter:format_price},
				// {field:"point", title:'POINT', width:90, sortable:true, align:'right', formatter:format_price},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			fit:true,
			// fitColumns:true,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			showFooter: 'true',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			idField:'id', sortName: 'id', sortOrder: 'asc', multiSort: true,
			queryParams: { receipt_id: 0 },
			onDblClickRow: function(rowIndex, rowData) {}
		});
		
	});

	// GRID 3 =====
	var selectIndex;
	
	$(function(){  
	
		$("#grid3").edatagrid({        
			url:'<?php echo site_url('mpoint/pnt_receipt_dt/r')?>',	
			saveUrl:'<?php echo site_url('mpoint/pnt_receipt_dt/c');?>',
			updateUrl:'<?php echo site_url('mpoint/pnt_receipt_dt/u');?>',
			destroyUrl:'<?php echo site_url('mpoint/pnt_receipt_dt/d');?>',
			columns:[[
				{field:'payment_type_id', title:'PAYMENT TYPE', width:125, 
					formatter:function(value, row){
						return row.payment_type_name;
					},
					editor:{ 
						type:'combogrid', 
						options:{
							url:'<?php echo site_url('mpoint/opt_payment_type/r');?>',
							required:false, panelWidth:300, panelHeight:200, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:false}
							]],
							onSelect: function(rowIndex, rowData){
								var editors = $('#grid3').edatagrid('getEditors', selectIndex);
								$(editors[1].target).focus();
							}
						}						
					}
				},
				{field:'store_id', title:'STORE', width:125, 
					formatter:function(value, row){
						return row.store_name;
					},
					editor:{ 
						type:'combogrid', 
						options:{
							url:'<?php echo site_url('mpoint/store/r');?>',
							required:true, panelWidth:350, panelHeight:200, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'name',title:'NAME',width:80,sortable:true},
								{field:'store_type_name',title:'CATEGORY',width:100,sortable:true},
								{field:'id'	 ,title:'ID',width:10,sortable:false}
							]],
							onSelect: function(rowIndex, rowData){
								var editors = $('#grid3').edatagrid('getEditors', selectIndex);
								$(editors[2].target).focus();
							}
						}						
					}
				},
				{field:"store_type_name", title:'STORE TYPE', width:125, sortable:true},
				{field:"value", title:'VALUE', width:120, sortable:true, align:'right', formatter:format_price, 
					editor:{
						type:'numberspinner',
						options:{
							value:0,
							required:true,
							min:0,
							precision:2,
							groupSeparator:','
						}  
					}
				},
				// {field:"point", title:'POINT', width:90, sortable:true, align:'right', formatter:format_price},
				{field:'receipt_id', title:'receipt_id', width:50, sortable:false, hidden:true},
				{field:'id', title:'ID', width:50, sortable:true, formatter:greyField}
			]],
			// title:'',
			fit:false,
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			showFooter: 'true',
			pageNumber:1, pageSize:50, pageList:[50,100], 
			idField:'id', sortName: 'id', sortOrder: 'asc', multiSort: true,
			queryParams: { receipt_id: $('#id').val() },
			onDblClickRow: function(rowIndex, rowData) { crud3('u') },
			onSelect:function(rowIndex, rowData){ 
				selectIndex = rowIndex 
			},
			onEdit: function(rowIndex, rowData){
				var editors = $('#grid3').edatagrid('getEditors', rowIndex);
				// var feditor = editors[0];
				
				$(editors[0].target).combogrid('grid').datagrid( 'load', {q: rowData.payment_type_id } );
				$(editors[1].target).combogrid('grid').datagrid( 'load', {q: rowData.store_id } );
			},
			onSave: function(index,row){
				dhtmlx.message("<?php echo l('success_saving');?>");
				$("#grid3").datagrid('load', {receipt_id: $('#id').val()});  
			},
			onError: function(index,row){
				dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:row.errorMsg });
			}
		});

		$('#grid3').edatagrid('getPager').pagination({  
			layout:['prev','links','next','refresh'],
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'<?php echo l('form_btn_add');?>',
				iconCls:'icon-add',  
				handler:function(){ crud3('c') }  
			},{  
				text:'<?php echo l('form_btn_edit');?>',
				iconCls:'icon-edit',  
				handler:function(){ crud3('u') }  
			},{  
				text:'<?php echo l('form_btn_save');?>',
				iconCls:'icon-save',  
				handler:function(){ $('#grid3').edatagrid('saveRow') }  
			},{  
				text:'<?php echo l('form_btn_cancel');?>',
				iconCls:'icon-cancel',  
				handler:function(){ $('#grid3').edatagrid('cancelRow') }  
			},{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud3('d') }  
			}]  
		});           
		
		setKeyTrapping_grid('#grid3', 'crud3');
	});
	
	function crud3 ( mode ) {
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'mpoint', 'pnt_receipt'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if ( $('#id').val() == '' )
			{
				if ( !$('#forms').form('validate') ) 
					return;
					
				$('#forms').form('submit',{ url: "<?php echo site_url('mpoint/pnt_receipt/c');?>",  
					onSubmit: function(param){  
						
						return $(this).form('validate'); 
						
					},  
					success: function(result){  
						var result = eval('('+result+')');  
						if (result.errorMsg)
						{  
							dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							return;
						} 
						else 
						{  
							$('#id').val(result.id);
							$('#ids').val(result.id);
							if( $('#id').val() !== '') 
							{
								$('#grid3').edatagrid('addRow', { 
									row:{ 
										receipt_id: $('#id').val(), 
										payment_type_id:4, 
										store_id:0, 
										value:0 
									} 
								});
								return;
							}
						}  
					}  
				});  
			}
			
			if( $('#id').val() !== '') 
			{
				$('#grid3').edatagrid('addRow', { 
					row:{ 
						receipt_id: $('#id').val(), 
						payment_type_id:4, 
						store_id:0, 
						value:0 
					} 
				});
				return;
			}
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'mpoint', 'pnt_receipt'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if ( $('#id').val() == '' )
				return;
			
			var selected = $('#grid3').edatagrid('getSelected');
			var index = $('#grid3').edatagrid('getRowIndex', selected);
			
			$('#grid3').edatagrid('editRow', index);
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'mpoint', 'pnt_receipt'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			if ( $('#id').val() == '' )
				return;
			
			$('#grid3').edatagrid('destroyRow');
		}
	}
	
</script>

</body>
</html>