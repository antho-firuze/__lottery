<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<title></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<script type="text/javascript" src="<?php echo base_url()?>assets/jquery-form/jquery.form.min.js"></script>
</head>
<style>
.label {
	width:100px;
	}
.label2 {
	width:40px;
	}
.set{
	display:block;
	float:left;
	width:230px;
	/* padding: 10px; */
}
div.left {
    width:100px;
    float: left;
}
div.right {
    width: 120px;
    float: right;
}
.textbox {
	width:200px;
	}
.progress { 
	position:relative; 
	width: 100%; 
	border: 1px solid #ddd; 
	padding: 1px; 
	border-radius: 3px; 
	}
.bar { 
	background-color: #B4F5B4; 
	width:0%; 
	height:20px; 
	border-radius: 3px; 
	}
.percent { 
	position: absolute; 
	display: inline-block; 
	top: 3px; 
	left:48%; 
	}
</style>
<body>
		
<div id="cc" class="easyui-layout">  
<div data-options="region:'center'">
	<div class="easyui-layout" data-options="fit:true">  
	<div data-options="region:'north',split:true" style="height:370px">
		<table id="grid" style='height:100%; width:100%;' toolbar="#tb"></table>
	</div>  
	<div data-options="region:'center'">
		<table id="grid2" style='height:100%; width:100%;'></table>
	</div>  
	</div>  
</div>  
</div>

<div id="tb" style="padding:7px"> 
	&nbsp;
	<div style="display:inline;">
		<div style="float:left;">
			<label for="date_f">&nbsp;DATE FROM :&nbsp;</label>	<input id="date_f" class="easyui-datebox" style="width:100px">  
			<label for="date_t">&nbsp;TO :&nbsp;</label><input id="date_t" class="easyui-datebox" style="width:100px">  
			<label for="status_filter">&nbsp;STATUS :&nbsp;</label><select class="easyui-combobox" id="status_filter" style="width:110px;" data-options="editable:false,panelHeight:'auto'">
				<option value="0">ALL STATUS</option>  
				<option value="1">OPEN</option>  
				<option value="2">CALCULATED</option>  
				<option value="3">POSTED</option>  
				<option value="4">CANCEL</option>  
				<option value="5">REVISED/VOID</option>  
			</select> 
		</div>
		<div style="float:left;margin:-3px 0 0 5px;">
			<a href="#" class="easyui-linkbutton" plain="true" onclick="goFilter()">FILTER</a>  
		</div>
		<div style="float:right;"><input id="ss" class="easyui-searchbox" style="width:300px" data-options="searcher:goFilter, prompt:'Please Input Value',menu:'#mm'"></input></div>
	</div>
</div>

<div id="mm" style="width:120px">  
    <div data-options="name:'ALL',iconCls:'icon-ok'">ALL</div>  
    <div data-options="name:'code'">CODE</div>  
    <div data-options="name:'customer'">CUSTOMER</div>  
    <div data-options="name:'note'">NOTE</div>  
</div> 

<!-- ORIGINAL -->
<!--
<div id="dlg" class="easyui-dialog" style="padding:10px"
	data-options="width:450, height:200, closed:true, cache:false, modal:true,
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
	<form id="forms" method="post" autocomplete="off">
	
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="ENTRY FORM" style="padding:8px">
			<input type="hidden" id="id" name="id" />
			<table>
				<tr>
					<td><div class="label"><label for="code">Doc. Code - Date</label></div></td> <td>:</td>	
					<td><input class="easyui-validatebox" type="text" id="code" name="code" style="width:125px; border:1px solid #ccc;" data-options="required:false" disabled /></td>
					<td><input class="easyui-datebox" id="date" name="date" style="width:120px;" data-options="required:true" /></td>
				</tr>
				<tr>
					<td><label for="customer_id">Customer</label></td> <td>:</td>	
					<td colspan=2><input class="easyui-combogrid" type="text" id="customer_id" name="customer_id" style="width:250px" data-options="
						url:'<?php echo site_url('shared/get_customer');?>',
						required:false, panelWidth:600, panelHeight:300, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
						pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
						columns: [[
							{field:'id'	 ,title:'ID',width:20,sortable:true,hidden:true},
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:70,sortable:true}
						]]" /></td>
				</tr>
			</table>
		</div>
		<div title="DOCUMENT LOG" style="padding:10px">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="label_col1">Create By</td>			<td><input type="text" id="create_by_name" name="create_by_name" style="border:1px solid #ccc; width:100px;" disabled /></td>
					<td class="label_col2">Create Date</td>			<td><input type="text" id="create_date" name="create_date" style="border:1px solid #ccc; width:120px;" disabled /></td>
				</tr>
				<tr>
					<td class="label_col1">Update By</td>			<td><input type="text" id="update_by_name" name="update_by_name" style="border:1px solid #ccc; width:100px;" disabled /></td>
					<td class="label_col2">Update Date</td>			<td><input type="text" id="update_date" name="update_date" style="border:1px solid #ccc; width:120px;" disabled /></td>
				</tr>
			</table>
		</div>
	</div>
	</form>
</div>
-->

<div id="dlg" class="easyui-dialog" style="padding:10px"
	data-options="width:800, height:500, closed:true, cache:false, modal:true,
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
	<form id="forms" method="post" autocomplete="off">
	
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="ENTRY FORM" style="padding:8px">
			<input type="hidden" id="id" name="id" />
			<table>
				<tr>
					<td><div class="label"><label for="code">Doc. Code - Date</label></div></td> <td>:</td>	
					<td><input class="easyui-validatebox" type="text" id="code" name="code" style="width:125px; border:1px solid #ccc;" data-options="required:false" disabled /></td>
					<td><input class="easyui-datebox" id="date" name="date" style="width:120px;" data-options="required:true" /></td>
					<td rowspan=2><textarea id="note" name="note" placeholder="Note" style="height:50px; width:250px; border:1px solid #ccc;"></textarea></td>
				</tr>
				<tr>
					<td><label for="customer_id">Customer</label></td> <td>:</td>	
					<td colspan=2><input class="easyui-combogrid" type="text" id="customer_id" name="customer_id" style="width:250px" data-options="
						url:'<?php echo site_url('shared/get_customer');?>',
						required:false, panelWidth:600, panelHeight:300, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
						pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
						columns: [[
							{field:'id'	 ,title:'ID',width:20,sortable:true,hidden:true},
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:70,sortable:true}
						]]" /></td>
				</tr>
				<!--
				<tr>
					<td><label for="note">Note</label></td> 		<td>:</td>	
					<td colspan="2"><textarea id="note" name="note" style="height:50px; width:250px; border:1px solid #ccc;"></textarea></td>
				</tr>
				-->
			</table>
		</div>
		<div title="DOCUMENT LOG" style="padding:10px">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td class="label_col1">Create By</td>			<td><input type="text" id="create_by_name" name="create_by_name" style="border:1px solid #ccc; width:100px;" disabled /></td>
					<td class="label_col2">Create Date</td>			<td><input type="text" id="create_date" name="create_date" style="border:1px solid #ccc; width:120px;" disabled /></td>
				</tr>
				<tr>
					<td class="label_col1">Update By</td>			<td><input type="text" id="update_by_name" name="update_by_name" style="border:1px solid #ccc; width:100px;" disabled /></td>
					<td class="label_col2">Update Date</td>			<td><input type="text" id="update_date" name="update_date" style="border:1px solid #ccc; width:120px;" disabled /></td>
				</tr>
			</table>
		</div>
	</div>
	</form>
	<table id="grid_dt" style="width:auto;height:200px"></table>
	<fieldset>
		<legend>Detail :</legend>
		<form id="forms2" method="post" autocomplete="off">
			<div style="padding:2px">
				<input type="hidden" id="id" name="id" />
				<input type="hidden" id="po_id" name="po_id" />
				<input type="hidden" id="item_cat_id" name="item_cat_id" />
				<table>
					<tr>
						<td><div class="label2"><label for="item_id">Stock</label></div></td>	
						<td colspan=2>:&nbsp;<input class="easyui-combogrid" type="text" id="item_id" name="item_id" style="width:200px" 
							data-options="
								url:'<?php echo site_url('shared/get_item');?>', 
								required:false, panelWidth:600, panelHeight:300, idField:'id', textField:'name', mode:'remote', loadMsg : 'Loading...',
								pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50, 100,200], fitColumns:true, 
								columns: [[
									{field:'id'	 ,title:'ID',width:20,sortable:true,hidden:true},
									{field:'code',title:'CODE',width:40,sortable:true},
									{field:'name',title:'NAME',width:90,sortable:true},
									{field:'item_cat_name',title:'CATEGORY',width:100,sortable:true},
									{field:'price_sell',title:'PRICE',width:100,sortable:true}
								]],
								onSelect:function(rowIndex, rowData){
									$('#item_cat_id').val(rowData.item_cat_id);
									$('#item_cat_name').val(rowData.item_cat_name);
									$('#item_price').numberspinner( 'setValue', rowData.price_sell );
									$('#item_id').next().find('input').focus()
									// $('#stock_val').numberspinner( 'setValue', rowData.stock_val );
								}" /></td>
						<td>&nbsp;</td>
						<td><div class="label2">Price</td>
						<td style="width:82px">:&nbsp;<input class="easyui-combogrid" type="text" id="currency_id" name="currency_id" style="width:75px" data-options="
							url:'<?php echo site_url('shared/get_currency');?>',
							required:false, panelWidth:125, panelHeight:100, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:false, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
							columns: [[
								{field:'id'	 ,title:'ID',width:20,sortable:true,hidden:true},
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:70,sortable:true,hidden:true}
							]]" /></td>
						<td colspan=2><input class="easyui-numberspinner" type="text" id="item_price" name="item_price" style="width:120px" data-options="required:true,min:0,precision:2,
								onChange:function(value){
									calculate_this();
								}" /></td>
						<td>&nbsp;</td>
						<td>Sub Total :</td>
					</tr>
					<tr>
						<td><label for="item_qty">Qty</label></td>	
						<td style="width:106px">:&nbsp;<input class="easyui-numberspinner" type="text" id="item_qty" name="item_qty" style="width:100px" 
							data-options="required:true,min:0,precision:0,
								onChange:function(value){
									calculate_this();
								}" /></td>
						<td style="width:97px"><input class="easyui-combogrid" type="text" id="measure_id" name="measure_id" style="width:95px" 
							data-options="
								url:'<?php echo site_url('master/measure/r');?>',
								required:true, panelWidth:300, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg :'Loading...',
								pagination:false, rownumbers:true, pageNumber:1,	pageSize:50, pageList:[50,100],	fitColumns:true, 
								columns: [[
									{field:'id'	 ,title:'ID',width:10,sortable:true, hidden:true},
									{field:'code',title:'CODE',width:30,sortable:true},
									{field:'name',title:'NAME',width:50,sortable:true}
								]]" /></td>
						<td>&nbsp;</td>
						<td><div class="label2">Discount</td>
						<td colspan=2>:&nbsp;<input class="easyui-numberspinner" type="text" id="disc_percent" name="disc_percent" style="width:100px" 
							data-options="
								required:true,min:0,precision:4,groupSeparator:',',decimalSeparator:'.',
								onChange:function(value){
									var item_price = $('#item_price').numberspinner( 'getValue' );
									var disc_percent = value;
									var disc_amount = item_price * disc_percent;
									$('#disc_amount').numberspinner( 'setValue', disc_amount );
									calculate_this();
								}" /></td>
						<td style="width:95px"><input class="easyui-numberspinner" type="text" id="disc_amount" name="disc_amount" style="width:95px" 
							data-options="
								required:true,min:0,precision:2,groupSeparator:',',decimalSeparator:'.',
								onChange:function(value){
									var item_price = $('#item_price').numberspinner( 'getValue' );
									var disc_amount = value;
									var disc_percent = disc_amount / item_price;
									$('#disc_percent').numberspinner( 'setValue', disc_percent );
									calculate_this();
								}" /></td>
						<td>&nbsp;</td>
						<td><input class="easyui-numberspinner" type="text" id="sub_total" name="sub_total" style="width:100px" data-options="required:true,min:0,precision:2,groupSeparator:',',decimalSeparator:'.'" disabled /></td>
						<td>&nbsp;</td>
						<td><input type="button" id="btn_detail" name="btn_detail" value="Save" style="width:70px" /></td>
					</tr>
				</table>
			</div>
		</form>
	</fieldset>
</div>

<!--
<div id="dlg2" class="easyui-dialog" style="padding:10px"
	data-options="width:450, height:300, closed:true, cache:false, modal:true,
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
	">
	<form id="forms2" method="post" autocomplete="off">
		<div style="padding:2px">
			<input type="hidden" id="id" name="id" />
			<input type="hidden" id="po_id" name="po_id" />
			<input type="hidden" id="item_cat_id" name="item_cat_id" />
			<table>
				<tr>
					<td><div class="label2"><label for="item_id">Stock</label></div></td> 	<td>:</td>	
					<td colspan=2><input class="easyui-combogrid" type="text" id="item_id" name="item_id" style="width:250px" 
						data-options="
							url:'<?php echo site_url('shared/get_item');?>', 
							required:false, panelWidth:600, panelHeight:300, idField:'id', textField:'name', mode:'remote', loadMsg : 'Loading...',
							pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50, 100,200], fitColumns:true, 
							columns: [[
								{field:'id'	 ,title:'ID',width:20,sortable:true,hidden:true},
								{field:'code',title:'CODE',width:40,sortable:true},
								{field:'name',title:'NAME',width:90,sortable:true},
								{field:'item_cat_name',title:'CATEGORY',width:100,sortable:true},
								{field:'price_sell',title:'PRICE',width:100,sortable:true}
							]],
							onSelect:function(rowIndex, rowData){
								$('#item_cat_id').val(rowData.item_cat_id);
								$('#item_cat_name').val(rowData.item_cat_name);
								$('#item_price').numberspinner( 'setValue', rowData.price_sell );
								// $('#stock_val').numberspinner( 'setValue', rowData.stock_val );
							}" /></td>
				</tr>
				<tr>
					<td><label for="item_qty">Quantity - Measure</label></td>	<td>:</td>	
					<td><input class="easyui-numberspinner" type="text" id="item_qty" name="item_qty" style="width:120px" 
						data-options="required:true,min:0,precision:0,
							onChange:function(value){
								calculate_this();
							}" /></td>
					<td><input class="easyui-combogrid" type="text" id="measure_id" name="measure_id" style="width:125px" 
						data-options="
							url:'<?php echo site_url('master/measure/r');?>',
							required:true, panelWidth:300, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg :'Loading...',
							pagination:false, rownumbers:true, pageNumber:1,	pageSize:50, pageList:[50,100],	fitColumns:true, 
							columns: [[
								{field:'id'	 ,title:'ID',width:10,sortable:true, hidden:true},
								{field:'code',title:'CODE',width:30,sortable:true},
								{field:'name',title:'NAME',width:50,sortable:true}
							]]" /></td>
				</tr>
				<tr>
					<td><label for="item_price">Price - Currency</label></td> 	<td>:</td>	
					<td><input class="easyui-numberspinner" type="text" id="item_price" name="item_price" style="width:120px" data-options="required:true,min:0,precision:2,
							onChange:function(value){
								calculate_this();
							}" /></td>
					<td><input class="easyui-combogrid" type="text" id="currency_id" name="currency_id" style="width:125px" data-options="
						url:'<?php echo site_url('shared/get_currency');?>',
						required:false, panelWidth:125, panelHeight:100, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
						pagination:false, rownumbers:false, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, 
						columns: [[
							{field:'id'	 ,title:'ID',width:20,sortable:true,hidden:true},
							{field:'code',title:'CODE',width:30,sortable:true},
							{field:'name',title:'NAME',width:70,sortable:true,hidden:true}
						]]" /></td>
				</tr>
				<tr>
					<td><label for="disc_percent">Disc. (%) - Amount</label></td>	<td>:</td>	
					<td><input class="easyui-numberspinner" type="text" id="disc_percent" name="disc_percent" style="width:120px" 
						data-options="
							required:true,min:0,precision:4,groupSeparator:',',decimalSeparator:'.',
							onChange:function(value){
								var item_price = $('#item_price').numberspinner( 'getValue' );
								var disc_percent = value;
								var disc_amount = item_price * disc_percent;
								$('#disc_amount').numberspinner( 'setValue', disc_amount );
								calculate_this();
							}" /></td>
					<td><input class="easyui-numberspinner" type="text" id="disc_amount" name="disc_amount" style="width:125px" 
						data-options="
							required:true,min:0,precision:2,groupSeparator:',',decimalSeparator:'.',
							onChange:function(value){
								var item_price = $('#item_price').numberspinner( 'getValue' );
								var disc_amount = value;
								var disc_percent = disc_amount / item_price;
								$('#disc_percent').numberspinner( 'setValue', disc_percent );
								calculate_this();
							}" /></td>
				</tr>
				<tr>
					<td><label for="sub_total">Sub Total</label></td>	<td>:</td>	
					<td colspan=2><input class="easyui-numberspinner" type="text" id="sub_total" name="sub_total" style="width:250px" data-options="required:true,min:0,precision:2,groupSeparator:',',decimalSeparator:'.'" disabled /></td>
				</tr>
			</table>
		</div>
	</form>
</div>
-->

<div id="dlg4" class="easyui-dialog" style="padding:5px"
	data-options="width:400, height:340, closed:true, cache:false, modal:true,
		buttons: [{
			text:'OK',
			iconCls:'icon-ok',
			handler:function(){	btn_save4(); }
		},{
			text:'CANCEL',
			iconCls:'icon-cancel',
			handler:function(){	$('#dlg4').dialog('close'); }
		}]
	">
	<form id="forms4" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="FORMS" style="padding:8px">
				<table>
					<tr>
						<td><a href="#" onclick="crud('form_phd_pur_princ');" class="easyui-linkbutton" data-options="iconCls:'icon-form'">FORM PRINCIPAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>	
					</tr>
					<tr>
						<td><a href="#" onclick="crud('form_phd_pur_nprinc');" class="easyui-linkbutton" data-options="iconCls:'icon-form'">FORM NON PRINCIPAL</a></td>	
					</tr>
					<tr>
						<td><a href="#" onclick="crud('form_phd_pur_ans');" class="easyui-linkbutton" data-options="iconCls:'icon-form'">FORM JAWABAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>	
					</tr>
				</table>
		</div>
		<div title="REPORTS" style="padding:8px">
			<div style="padding:2px">
				<table>
					<tr>
						<td colspan=5>
						<fieldset>
							<legend>Type :</legend>
							<label><input type="radio" name="report_type" value="1" id="report_type_1" checked>Summary</label>
							<label><input type="radio" name="report_type" value="2" id="report_type_2">Detail</label>
						</fieldset>
						</td>
					</tr>
					<tr>
						<td><div class="label"><label for="date_fr">Date From</label></div></td>	<td class="separator">:</td>	
						<td style="width:52px"><input id="date_fr" name="date_fr" class="easyui-datebox" style="width:100px" data-options="required:true" /></td>
						<td colspan="2">&nbsp;To :&nbsp;<input id="date_to" name="date_to" class="easyui-datebox" style="width:100px" data-options="required:true" /></td>
					</tr>
					<tr>
						<td><div class="label"><label for="group">Category</label></div></td>	<td class="separator">:</td>	
						<td colspan="2"><input class="easyui-combogrid" type="text" id="group" name="group" style="width:170px" 
							data-options="
								url:'<?php echo site_url('master/item_cat/r');?>',
								required:true, panelWidth:300, panelHeight:250, idField:'code', textField:'name', mode:'remote', loadMsg:'Loading...',
								pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:false, 
								columns: [[
									{field:'id'	 ,title:'ID',width:50,sortable:true,hidden:true},
									{field:'code',title:'CODE',width:50,sortable:true},
									{field:'name',title:'NAME',width:200,sortable:true}
								]]" /></td>
						<td style="width:65px;"><input type="checkbox" id="all_cat" name="all_cat" /><label for="all_cat">All</label></td>
					</tr>
					<!--
					<tr>
						<td><div class="label"><label for="status">Status</label></div></td>	<td class="separator">:</td>	
						<td colspan="2"><input class="easyui-combogrid" type="text" id="status" name="status" style="width:170px" 
							data-options="
								url:'<?php echo site_url('shared/get_opt_phd_status_for_central');?>',
								required:true, panelWidth:300, panelHeight:250, idField:'id', textField:'name', mode:'remote', loadMsg:'Loading...',
								pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:false, 
								columns: [[
									{field:'id'	 ,title:'ID',width:50,sortable:true,hidden:true},
									{field:'code',title:'CODE',width:50,sortable:true},
									{field:'name',title:'NAME',width:200,sortable:true}
								]]" /></td>
						<td style="width:65px;"><input type="checkbox" id="all_status" name="all_status" /><label for="all_status">All</label></td>
					</tr>
					-->
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
	
	$(function(){
		var date = new Date(), y = date.getFullYear(), m = date.getMonth();
		var f = new Date(y, m, 1);
		var t = new Date(y, m+1, 0);
		
		var y = f.getFullYear();
		var m = f.getMonth()+1;
		var d = f.getDate();
		$('#date_f').datebox('setValue', (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
		
		var y = t.getFullYear();
		var m = t.getMonth()+1;
		var d = t.getDate();
		$('#date_t').datebox('setValue', (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
	});
	
	function goFilter( value, name ) {
		if(typeof(value)==='undefined') value = $('#ss').searchbox('getValue');
		if(typeof(name)==='undefined') name = $('#ss').searchbox('getName');
	
		var s = $('#date_f').datebox('getValue');
		var ss = s.split('/');
		var d = parseInt(ss[0],10);
		var m = parseInt(ss[1],10);
		var y = parseInt(ss[2],10);
		var f = new Date(y,m-1,d);
		var ff = y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
		
		var s = $('#date_t').datebox('getValue');
		var ss = s.split('/');
		var d = parseInt(ss[0],10);
		var m = parseInt(ss[1],10);
		var y = parseInt(ss[2],10);
		var t = new Date(y,m-1,d);
		var tt = y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
		// alert(f);
		if ( f > t ) {
			dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", width:"400px", text:"<?php echo l('error_filter_date');?>"});
			return false;
		}

		$('#grid').datagrid('load',{  
			date_f: ff,  
			date_t: tt,
			status: $('#status_filter').combobox('getValue'),
			findKey: name,
			findVal: value
		});
	}
	
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

	function greyField( value, row ) {
		if (value)
			return '<span style="color:#ADADAD;">'+value+'</span>'; 
		else
			return value;
	}
	
	$(function(){  
		$("#grid").datagrid({        
			url:'<?php echo site_url('purchase/po/r')?>',	
			columns:[[
					{field:"code", title:'DOC CODE', width:125, sortable:true},
					{field:"date", title:'DATE', width:100, sortable:true, align:"center"},
					{field:"customer_name", title:'CUSTOMER', width:250, sortable:true},
					{field:"status_name", title:'STATUS', width:150, sortable:true, 
						formatter:function( value, rowData, rowIndex ){
							if ( parseInt(rowData.status_id) == 2 )
								return '<a href="#" onclick="crud(\'a\', this)"><span style="color:'+rowData.color+';">'+value+'</span></a>';
							else
								return '<span style="color:'+rowData.color+';">'+value+'</span>';
						}
					},
					{field:"note", title:'NOTE', width:350, sortable:true},
					{field:"create_by_name", title:'CREATE BY', width:100, sortable:true},
					{field:"create_date", title:'CREATE DATE', width:103, sortable:true},
					{field:"update_by_name", title:'UPDATE BY', width:100, sortable:true},
					{field:"update_date", title:'UPDATE DATE', width:103, sortable:true},
					{field:"id", title:'ID', width:50, sortable:true}
			]],
			// title:'PHD',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			idField:'id',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			onSelect: function(rowIndex, rowData){	//diganti ke onClickRow, karena setiap call goFilter() onSelect ke Fire.
				// open_detail( rowData.id );
			},
			onClickRow: function(rowIndex, rowData){
				open_detail( rowData.id );
			},
			onDblClickRow: function(rowIndex, rowData) { crud('u') }
		});

		$('#grid').datagrid('getPager').pagination({  
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'<?php echo l('form_btn_insert');?>',
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
				text:'<?php echo l('form_btn_recalc');?>',
				iconCls:'icon-ok',  
				handler:function(){ crud('recalc') }  
			}/* ,{  
				text:'<?php echo l('form_btn_posting');?>',
				iconCls:'icon-ok',  
				handler:function(){ crud('p') }  
			} */,{  
				text:'<?php echo l('form_btn_report');?>',
				iconCls:'icon-ok',  
				handler:function(){ crud('report') }  
			}]  
		});           

		$('#grid').datagrid('getPanel').panel('panel').attr('tabindex',1).bind('keydown',function(e){
			switch(e.keyCode){
				case 38:	// up
					var selected = $('#grid').datagrid('getSelected');
					if (selected){
						var index = $('#grid').datagrid('getRowIndex', selected);
						$('#grid').datagrid('selectRow', index-1);
					} else {
						$('#grid').datagrid('selectRow', 0);
					}
					break;
				case 40:	// down
					var selected = $('#grid').datagrid('getSelected');
					if (selected){
						var index = $('#grid').datagrid('getRowIndex', selected);
						$('#grid').datagrid('selectRow', index+1);
					} else {
						$('#grid').datagrid('selectRow', 0);
					}
					break;
				case 45:	// insert
					var selected = $('#grid').datagrid('getSelected');
					if (selected){ crud('c') }
					break;
				case 13:	// enter
					var selected = $('#grid').datagrid('getSelected');
					if (selected){ crud('u') }
					break;
				case 46:	// delete
					var selected = $('#grid').datagrid('getSelected');
					if (selected){ crud('d') }
					break;
			}
		});
		
		$(document).on("keydown", function(e){ 
			switch(e.keyCode){
				case 27:	// esc
					$('#dlg').dialog('close');
					$('#dlg2').dialog('close');
					$('#dlg3').dialog('close');
				break;
			}
		});
		
		setTimeout(function() {
			goFilter();
		}, 1000);	
	})

	function getRowIndex(target){  
		var tr = $(target).closest('tr.datagrid-row');  
		return parseInt(tr.attr('datagrid-row-index'));  
	}  

	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('purchase/po');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'purchase', 'po'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_create_po');?>");
			$('#forms').form('clear'); 
			
			var f = new Date();
			var y = f.getFullYear();
			var m = f.getMonth()+1;
			var d = f.getDate();
			$('#date').datebox('setValue', (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
			$('#code').val('AUTO CODE');
			
			$('#measure_id').combogrid('setValue', 2);
			$('#item_price').numberspinner('setValue', 0);  
			$('#item_qty').numberspinner('setValue', 0);  
			$('#currency_id').combogrid('setValue', 1);
			$('#disc_amount').numberspinner('setValue', 0);  
			$('#disc_percent').numberspinner('setValue', 0);  

			$("#grid_dt").datagrid({        
				url:'<?php echo site_url('sales/po_dt/r')?>',	
				columns:[[
					{field:"item_name", title:'STOCK NAME', width:150, sortable:true},
					// {field:"item_cat_name", title:'STOCK CATEGORY', width:150, sortable:true},
					{field:"item_price", title:'UNIT PRICE', width:100, sortable:true, align:'right', formatter:format_price},
					{field:"item_qty", title:'QTY', width:50, sortable:true, align:'right',editor:{type:'numberbox',options:{precision:0}}},
					{field:"measure_name", title:'MEASURE', width:105, sortable:true},
					{field:"currency_code", title:'CURR.', width:50, sortable:true},
					{field:"currency_rate", title:'RATE', width:100, sortable:true, align:'right', formatter:format_price,editor:{type:'numberbox',options:{precision:2}}},
					{field:"disc_percent", title:'DISC (%)', width:125, sortable:true, align:'right', formatter:format_percent,editor:{type:'numberbox',options:{precision:4}}},
					{field:"disc_amount", title:'DISC AMOUNT', width:125, sortable:true, align:'right', formatter:format_price,editor:{type:'numberbox',options:{precision:2}}}, 
					{field:"sub_total", title:'SUB TOTAL', width:125, sortable:true, align:'right', formatter:format_price}, 
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="#" onclick="saverow(this)">Save</a>&nbsp;&nbsp;';
								var c = '<a href="#" onclick="cancelrow(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="#" onclick="editrow(this)">Edit</a>&nbsp;&nbsp;';
								var d = '<a href="#" onclick="deleterow(this)">Delete</a>';
								return e+d;
							}
						}
					},
					{field:'id', title:'ID', width:50, hidden:true}
				]],
				// title:'PHD',
				// fit:true,
				// fitColumns:true,
				loadMsg : '',
				rownumbers:true,
				singleSelect:true,
				pagination:true,
				pagePosition:'bottom',
				idField:'id',
				sortName: 'id',
				sortOrder: 'desc', multiSort: true,
				onBeforeEdit:function(index,row){
					row.editing = true;
					updateActions(index);
				},
				onAfterEdit:function(index,row){
					row.editing = false;
					updateActions(index);
				},
				onCancelEdit:function(index,row){
					row.editing = false;
					updateActions(index);
				}
			});
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'purchase', 'po'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (row){  
					
				$('#forms').form('clear'); 
			
				$('#customer_id').combogrid('grid').datagrid(
					'load', {q: row.customer_name}
				);
				
				$('#dlg').dialog('open').dialog('setTitle',"<?php echo l('form_update_po');?>");  
				$('#forms').form('load',row);  
				
				if ( row.date ) {
					var ss = row.date.split('-');
					var y = parseInt(ss[0],10);
					var m = parseInt(ss[1],10);
					var d = parseInt(ss[2],10);
				} else {
					var f = new Date();
					var y = f.getFullYear();
					var m = f.getMonth()+1;
					var d = f.getDate();
				}
				$('#date').datebox('setValue', (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y);
			}  
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'purchase', 'po'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (row){  
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
					if (r){  
						$.post(url,{ id:row.id, status_id:row.status_id },function(result){  
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

		if ( mode=='recalc' ) {
			var is_allow = <?php echo (is_allow('a', 'purchase', 'po'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>" });
				return false;
			}
			
			if (target)
				$("#grid").datagrid("selectRow", getRowIndex(target));
				
			var row = $('#grid').datagrid('getSelected'); 
			if (row) {
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", text:"<?php echo l('confirm_recalc');?>", callback: function(r){  
					if (r){  
						$.post(url,{ id:row.id, status_id:row.status_id },function(result){  
							if (result.success){  
								$('#grid').datagrid('reload');    // reload the user data  
								dhtmlx.message("<?php echo l('success_recalc');?>");
							} else {  
								dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
							}  
						},'json');  
					}}  
				});  
			}
		}

		if ( mode=='p' ) {
			var is_allow = <?php echo (is_allow('a', 'purchase', 'po'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>" });
				return false;
			}
			
			if (target)
				$("#grid").datagrid("selectRow", getRowIndex(target));
				
			var row = $('#grid').datagrid('getSelected'); 
			if (row) {
				dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", text:"<?php echo l('confirm_posting');?>", callback: function(r){  
					if (r){  
						$.post(url,{ id:row.id, status_id:row.status_id },function(result){  
							if (result.success){  
								$('#grid').datagrid('reload');    // reload the user data  
								dhtmlx.message("<?php echo l('success_posting');?>");
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
			
			$('#group').combogrid('setValue', 'MCS');
			$('#status').combogrid('setValue', 6);
			
			$('#dlg4').dialog('open').dialog('setTitle',"<?php echo l('form_phd_reports');?>");  
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
					dhtmlx.alert({ width:"400px", title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					$('#dlg').dialog('close');      // close the dialog  
					$('#grid').datagrid('reload');    // reload the user data  
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 

	function btn_save4() { 
		if ( $("[name='report_type']:checked").val()==1 )
			url = '<?php echo site_url('sales/rpt_phd_list/summary');?>';
		else
			url = '<?php echo site_url('sales/rpt_phd_list/detail');?>';

		$('#forms4').form('submit',{  
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
					$('#dlg4').dialog('close');      // close the dialog 
					$('#forms4').form('submit',{ url: url+'/1' });  
				} 
				
			}  
		});  
		
		/* if ( $("[name='report_type']:checked").val()==1 )
			url = '<?php echo site_url('sales/rpt_phd_list/summary');?>';
		else
			url = '<?php echo site_url('sales/rpt_phd_list/detail');?>';
		
		$.post(
			url,
			{
				// type:$("[name='report_type']:checked").val(), 
				date_fr:$("#date_fr").datebox('getValue'), 
				date_to:$("#date_to").datebox('getValue'), 
				group:$("#group").combogrid('getValue'), 
				all_cat:$("#all_cat").prop('checked')
			},
			function(result){  
				if (result.success){  
					$('#dlg4').dialog('close');      // close the dialog 
					$('#forms4').form('submit',{  
						url: "<?php echo site_url('sales/rpt_phd_list/summary');?>"  
					});  
				} else {  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				}  
			},
		'json');   */
	} 

	//================================================================================grid2=====================
	$(function(){  
		open_detail( 0 );
	})

	function format_price( value, row ) {
		return accounting.formatMoney(value, '');
	}
	/* 
	* Usage: accounting.formatMoney(number, symbol, precision, thousandsSep, decimalSep, format)
	* defaults: (0, "$", 2, ",", ".", "%s%v")
	*/
	function format_percent( value, row ) {
		return accounting.formatMoney(value, '', 4);
	}
	
	function open_detail( id_master ) {

		$("#grid2").datagrid({        
			url:"<?php echo site_url('purchase/po_dt/r')?>/"+id_master,	
			columns:[[
				{field:"item_name", title:'STOCK NAME', width:275, sortable:true},
				{field:"item_cat_name", title:'STOCK CATEGORY', width:175, sortable:true},
				{field:"item_price", title:'UNIT PRICE', width:100, sortable:true, align:'right', formatter:format_price},
				{field:"item_qty", title:'QTY', width:50, sortable:true, align:'right'},
				{field:"measure_name", title:'MEASURE', width:105, sortable:true},
				{field:"currency_code", title:'CURR.', width:50, sortable:true},
				{field:"currency_rate", title:'RATE', width:100, sortable:true, align:'right', formatter:format_price},
				{field:"disc_percent", title:'DISC (%)', width:125, sortable:true, align:'right', formatter:format_percent},
				{field:"disc_amount", title:'DISC AMOUNT', width:125, sortable:true, align:'right', formatter:format_price}, 
				{field:"sub_total", title:'SUB TOTAL', width:125, sortable:true, align:'right', formatter:format_price}, 
				{field:'id', title:'ID', width:50, formatter:greyField}
			]],
			title:'DETAIL',
			fit:true,
			// fitColumns:true,
			loadMsg : '',
			rownumbers:true,
			singleSelect:true,
			pagination:true,
			pagePosition:'bottom',
			sortName: 'id',
			sortOrder: 'desc', multiSort: true,
			rowStyler: function(index,row){  
				if (row.answered == 1 && row.ready_to_send == 1){  
					return 'color:#4DB849;font-weight:bold;';  
					// return 'background-color:#6293BB;color:#fff;font-weight:bold;';  
				}  
				if (row.ready_to_send == 1){  
					return 'color:#4DB849;font-weight:bold;';  
				}  
				if (row.answered == 1){  
					return 'color:#98D7FF;font-weight:bold;';  
				}  
			},
			onDblClickRow: function(rowIndex, rowData) { crud2('u') }
		});
	
		$('#grid2').datagrid('getPager').pagination({  
			displayMsg: ' {total} item(s)',
			buttons:[{  
				text:'<?php echo l('form_btn_insert');?>',
				iconCls:'icon-add',  
				handler:function(){ crud2('c') }  
			},{  
				text:'<?php echo l('form_btn_update');?>',
				iconCls:'icon-edit',  
				handler:function(){ crud2('u') }  
			},{  
				text:'<?php echo l('form_btn_delete');?>',
				iconCls:'icon-remove',  
				handler:function(){ crud2('d') }  
			}]  
		});           


		$('#grid2').datagrid('getPanel').panel('panel').attr('tabindex',1).bind('keydown',function(e){
			switch(e.keyCode){
				case 38:	// up
					var selected = $('#grid2').datagrid('getSelected');
					if (selected){
						var index = $('#grid2').datagrid('getRowIndex', selected);
						$('#grid2').datagrid('selectRow', index-1);
					} else {
						$('#grid2').datagrid('selectRow', 0);
					}
					break;
				case 40:	// down
					var selected = $('#grid2').datagrid('getSelected');
					if (selected){
						var index = $('#grid2').datagrid('getRowIndex', selected);
						$('#grid2').datagrid('selectRow', index+1);
					} else {
						$('#grid2').datagrid('selectRow', 0);
					}
					break;
				case 45:	// insert
					var selected = $('#grid2').datagrid('getSelected');
					if (selected){ crud2('c') }
					break;
				case 13:	// enter
					var selected = $('#grid2').datagrid('getSelected');
					if (selected){ crud2('u') }
					break;
				/* case 46:	// delete
					var selected = $('#grid2').datagrid('getSelected');
					if (selected){ crud2('d') }
					break; */
			}
		});
	}

	
	function calculate_this() {
		var item_price = $('#item_price').numberspinner( 'getValue' );
		var item_qty = $('#item_qty').numberspinner( 'getValue' );
		var disc_amount = $('#disc_amount').numberspinner( 'getValue' );
		// var currency_rate = $('#currency_rate').val(); 
		var sub_total = (item_price - disc_amount) * item_qty;
		
		$('#disc_amount').numberspinner( 'setValue', disc_amount );
		$('#sub_total').numberspinner( 'setValue', sub_total );
		// alert(item_price+' '+item_qty+' '+disc_amount+' '+currency_rate+' '+item_price+' '+);
	}
	
	function crud2 ( mode ) {
		
		url = "<?php echo site_url('purchase/po_dt');?>/"+mode;
		
		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('u', 'purchase', 'po_dt'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (row){  
				if ( (row.status_id != 1) && (row.status_id != 2) )  //1=>ENTRY OR 2=>NEED APPROVAL
					return false;
					
				$('#dlg2').dialog('open').dialog('setTitle',"<?php echo l('form_create_detail');?>");
				$('#forms2').form('clear');  
				
				$('#dlg2').dialog('dialog').attr('tabIndex','-1').bind('keydown',function(e){
					if ( e.which === 83 && e.altKey ){
						btn_save2();
					} else if ( e.which === 78 && e.altKey ){
						btn_save2( 1 );
					}
				});

				$('#po_id').val(row.id);  
				$('#measure_id').combogrid('setValue', 0);
				$('#currency_id').combogrid('setValue', 1);
				$('#item_price').numberspinner('setValue', 0);  
				$('#item_qty').numberspinner('setValue', 0);  
				$('#currency_rate').numberspinner('setValue', 1);  
				$('#disc_amount').numberspinner('setValue', 0);  
				$('#disc_percent').numberspinner('setValue', 0);  
				$('#sub_total').numberspinner('setValue', 0);  
				
				setTimeout(function() {
					$('#item_id').next().find('input').focus()
				}, 100);	
			}
		}

		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'purchase', 'po'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row2 = $('#grid2').datagrid('getSelected');  
			if (row2) {
			
				$('#forms2').form('clear'); 
				$('#item_id').combogrid('grid').datagrid(
					'load', {q: row2.item_id}
				);
				
				$('#dlg2').dialog('open').dialog('setTitle',"<?php echo l('form_update_detail');?>");  
				$('#forms2').form('load',row2);  
			}
		}

		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('u', 'purchase', 'po_dt'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');  
			if (row){  
				var row2 = $('#grid2').datagrid('getSelected');  
				if (row2){  
					dhtmlx.confirm({ title:"<?php echo l('confirm');?>", type:"confirm-warning", width:"350px", text:"<?php echo l('confirm_delete');?>", callback: function(r){  
						if (r){  
							$.post(url,{ id:row2.id, status_id:row.status_id },function(result){  
								if (result.success){  
									$('#grid2').datagrid('reload');    // reload the user data  
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
	}
	
	function btn_save2( save_option ) {  
		if(typeof(save_option)==='undefined') save_option = 0;
		
		var dlg = $('#dlg2');
		var forms = $('#forms2');
		var grid = $('#grid2');
		var grid_ = $('#grid');
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
					grid_.datagrid('reload');    // reload the user data  
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

<script>

	var sse = new EventSource('<?php echo site_url('shared/comet_server'); ?>');
	sse.onmessage = pusher;
	
	// This function will be called every time the server pushes a new event.
	function pusher(event) {
		if(typeof(event)==='undefined') { return }
		if (event.data.trim().length<1) { return }
		
		var data = event.data.trim();
		if (data == 'po_header') {
			goFilter();
		} else 
		if (data == 'po_dt') {
			goFilter();
		} else 
		if (data == 'item') {
			// $('#item_id').combogrid('reload');
		} else 
		if (data == 'item_cat') {
			$('#item_cat_id').combogrid('reload');
		} else 
		if (data == 'customer') {
			$('#customer_id').combogrid('reload');
		} else 
		if (data == 'measure') {
			$('#measure_id').combogrid('reload');
		} 
	}
	
</script>

</body>
</html>