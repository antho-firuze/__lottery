<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
        <title></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<style>
	.label		{width:170px;}
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
					<div data-options="name:'full_name'">FULL NAME</div>  
					<div data-options="name:'nick_name'">NICK NAME</div>  
					<div data-options="name:'name_on_card'">NAME ON CARD</div>  
					<div data-options="name:'identity_no'">IDENTITY NO</div>  
				</div> 
			</div>  
		</div>  
	</div>  
</div>

<div id="dlg" class="easyui-dialog" style="padding:10px" data-options="width:550, height:420, closed:true, cache:false, modal:true">
	<form id="forms" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="DATA ENTRY" style="padding:8px">
			<input type="hidden" id="id" name="id" />
			<table>
				<tr>
					<td><label for="period_id">Program Name</label></td> 		<td>:</td>	
					<td colspan=2><input class="easyui-combogrid" id="period_id" name="period_id" style="width:300px" 
						data-options="
							url:'<?php echo site_url('mpoint/pnt_period/r');?>',
							required:false, panelWidth:300, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true,
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:150,sortable:true},
								{field:'id'	 ,title:'ID',width:20,sortable:true}
							]],
							onSelect: function(rowIndex, rowData){
								$('#phase_id').combogrid('grid').datagrid( 'load', {period_id: rowData.id} );								
							}" />
					</td>
				</tr>
				<tr>
					<td><label for="phase_id">Phase</label></td> 		<td>:</td>	
					<td colspan=2><input class="easyui-combogrid" id="phase_id" name="phase_id" style="width:300px" 
						data-options="
							url:'<?php echo site_url('mpoint/pnt_period_phase/r');?>',
							required:false, panelWidth:300, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true,
							columns: [[
								{field:'name',title:'NAME',width:50,sortable:true},
								{field:'id'	 ,title:'ID',width:20,sortable:true}
							]],
							onSelect: function(rowIndex, rowData){
								$('#prize_id').combogrid('grid').datagrid( 'load', {period_id: rowData.id, phase_id:rowData.id} );								
							}" />
					</td>
				</tr>
				<tr>
					<td><label for="prize_id">Prize</label></td> 		<td>:</td>	
					<td colspan=2><input class="easyui-combogrid" id="prize_id" name="prize_id" style="width:300px" 
						data-options="
							url:'<?php echo site_url('mpoint/pnt_prize/r');?>',
							required:true, panelWidth:300, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true,
							columns: [[
								{field:'id'	 ,title:'ID',width:20,sortable:true, hidden:true},
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:50,sortable:true}
							]]" />
					</td>
				</tr>
				<tr>
					<td><div class="label"><label for="number">Winner No.</label></div></td> <td>:</td>	
					<td colspan=2><input class="easyui-numberspinner" id="number" name="number" style="width:145px" data-options="required:false,min:0,precision:0,groupSeparator:',',decimalSeparator:'.',value:1" /></td>
				</tr>
				<tr>
					<td><label for="member_id">Member Code - Name</label></td> 		<td>:</td>	
					<td><input class="easyui-combogrid" id="member_id" name="member_id" style="width:145px" 
						data-options="
							url:'<?php echo site_url('mpoint/member/r');?>',
							required:true, panelWidth:600, panelHeight:200,	idField:'id', textField:'code',	mode:'remote', loadMsg:'Loading...',
							pagination:true, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:false, editable:true,
							columns: [[
								{field:'code',title:'CODE',width:150,sortable:true},
								{field:'name',title:'NAME',width:250,sortable:true},
								{field:'identity_no',title:'IDENTITY NO',width:150,sortable:true},
								{field:'id',title:'ID',width:20,sortable:true}
							]],
							onSelect:function(rowIndex, rowData){
								$('#name').val(rowData.name);
							}" />
					</td>
					<td><input id="name" name="name" style="width:145px; border:1px solid #ccc;" disabled /></td>
				</tr>
				<tr>
					<td><div class="label"><label for="coupon_no">Coupon No</label></div></td> <td>:</td>	
					<td colspan=2><input class="easyui-numberspinner" id="coupon_no" name="coupon_no" style="width:145px" data-options="required:false,min:0,precision:0,groupSeparator:',',decimalSeparator:'.'" /></td>
				</tr>
				<tr>
					<td><div class="label"><label for="show_screen">Show In Screen</label></div></td> <td>:</td>	
					<td colspan=2><input type="checkbox" id="show_screen" name="show_screen" /></td>
				</tr>
				<tr>
					<td><label for="status_id">Status</label></td> 		<td>:</td>	
					<td colspan=2><input class="easyui-combogrid" id="status_id" name="status_id" style="width:300px" 
						data-options="
							url:'<?php echo site_url('mpoint/opt_draw_status/r');?>',
							required:false, panelWidth:300, panelHeight:100,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true, value:1, 
							columns: [[
								{field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:150,sortable:true},
								{field:'id'	 ,title:'ID',width:20,sortable:true},
							]]" />
					</td>
				</tr>
			</table>
		</div>
		<div title="DOCUMENT LOG" style="padding:10px">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:70px">Create By</td>		<td style="width:10px">:</td>	<td><input name="create_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
					<td style="padding-left:7px; width:70px">Create Date</td>		<td style="width:10px">:</td>	<td><input name="create_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
				</tr>
				<tr>
					<td style="width:70px">Update By</td>		<td style="width:10px">:</td>	<td><input name="update_by_name" style="border:1px solid #ccc; width:145px;" disabled /></td>
					<td style="padding-left:7px; width:70px">Update Date</td>		<td style="width:10px">:</td>	<td><input name="update_date" style="border:1px solid #ccc; width:145px;" disabled /></td>
				</tr>
			</table>
		</div>
	</div>
	</form>
</div>

<div id="dlg2" class="easyui-dialog" style="padding:10px" data-options="width:500, height:200, closed:true, cache:false, modal:true">
	<form id="forms2" method="post" autocomplete="off">
	<div class="easyui-tabs" style="width:auto;height:auto">
		<div title="SET ACTIVE PROGRAM & PHASE" style="padding:8px">
			<table>
				<tr>
					<td><label for="period_id2">Program Name</label></td> 		<td>:</td>	
					<td colspan=2><input class="easyui-combogrid" id="period_id2" name="period_id2" style="width:300px" 
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
								$('#phase_id2').combogrid({ url:'<?php echo site_url('mpoint/get_period_phase');?>/'+rowData.id });
							}" />
					</td>
				</tr>
				<tr>
					<td><label for="phase_id2">Phase</label></td> 		<td>:</td>	
					<td colspan=2><input class="easyui-combogrid" id="phase_id2" name="phase_id2" style="width:300px" 
						data-options="
							url:'<?php echo site_url('mpoint/pnt_period_phase/r');?>',
							required:true, panelWidth:300, panelHeight:200,	idField:'id', textField:'name',	mode:'remote', loadMsg:'Loading...',
							pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, editable:true,
							columns: [[
								{field:'id'	 ,title:'ID',width:20,sortable:true, hidden:true},
								{field:'period_id'	 ,title:'ID',width:20,sortable:true, hidden:true},
								// {field:'code',title:'CODE',width:20,sortable:true, hidden:true},
								{field:'name',title:'NAME',width:50,sortable:true}
							]],
							onSelect: function(rowIndex, rowData){
								// $('#prize_id').combogrid({ url:'<?php echo site_url('mpoint/pnt_prize');?>/'+rowData.period_id+'/'+rowData.id });
							}" />
					</td>
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
		if(typeof(value)==='undefined') value = $('#ss').searchbox('getValue');
		if(typeof(name)==='undefined') name = $('#ss').searchbox('getName');
	
		$('#grid').datagrid('load',{  
			findKey: name,
			findVal: value
		});
	}
	
	function getRowIndex(target){  
		var tr = $(target).closest('tr.datagrid-row');  
		return parseInt(tr.attr('datagrid-row-index'));  
	}  

	function start_month(){
		var date = new Date();
		var y = date.getFullYear();
		var m = date.getMonth();
		
		var f = new Date(y, m, 1);
		var y = f.getFullYear();
		var m = f.getMonth()+1;
		var d = f.getDate();
		
		return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
	}
	
	function end_month(){
		var date = new Date();
		var y = date.getFullYear();
		var m = date.getMonth();
		
		var t = new Date(y, m+1, 0);
		var y = t.getFullYear();
		var m = t.getMonth()+1;
		var d = t.getDate();
		
		return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
	}
	
	function format_price( value, row ) {
		return accounting.formatMoney(value, '');
	}
	
	function format_dmy(tdate){
		if(typeof(tdate)==='undefined') tdate = 0;
		if (tdate==0)
		{
			var f = new Date();
			var y = f.getFullYear();
			var m = f.getMonth()+1;
			var d = f.getDate();
		}
		else
		{
			var ss = tdate.split('-');
			var y = parseInt(ss[0],10);
			var m = parseInt(ss[1],10);
			var d = parseInt(ss[2],10);
		}
		return (d<10?('0'+d):d)+'/'+(m<10?('0'+m):m)+'/'+y;
	}
	
	function greyField( value, row ) {
		if (value)
			return '<span style="color:#ADADAD;">'+value+'</span>'; 
		else
			return value;
	}
	
	function greenField( value, row ) {
		return '<div style="color:#00D900; text-align:center; font-weight:bold;">'+value+'</div>'; 
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
				case 27:	// esc
				
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
			url:'<?php echo site_url('mpoint/pnt_draw/r')?>',	
			columns:[[
				{field:"status_name", title:'STATUS', width:150,
					formatter:function( value, rowData, rowIndex ){
						return '<span style="color:'+rowData.color+';">'+value+'</span>';
					}
				},
				{field:"period_name", title:'PROGRAM NAME', width:200},
				{field:"phase_name", title:'PHASE', width:100},
				{field:"prize_name", title:'PRIZE', width:150},
				{field:"number", title:'WIN. NO', width:60},
				{field:"member_code", title:'MEMBER CODE', width:100},
				{field:"full_name", title:'MEMBER NAME', width:200},
				// {field:"nick_name", title:'NICK NAME', width:100},
				{field:"identity_no", title:'IDENTITY NO', width:170},
				{field:"coupon_no", title:'COUPON NO', width:90},
				{field:"show_screen", title:'SHOW TO SCREEN', width:120,
					formatter:function( value, rowData, rowIndex ){
						if (value)
							return '<center><input type="checkbox" disabled checked /></center>';
						else
							return '<center><input type="checkbox" disabled /></center>';
					}
				},
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
			idField:'id',
			sortName: 'id',
			sortOrder: "desc",
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
			},{  
				text:'PREVIEW ON SCREEN !',
				iconCls:'icon-ok',  
				handler:function(){ crud('preview_draw') }  
			}/* ,{  
				text:'PREVIEW WINNER',
				iconCls:'icon-ok',  
				handler:function(){ crud('preview_winner') }  
			} */]  
		});           
		
		setKeyTrapping_grid('#grid', 'crud');
	})
	
	function crud ( mode, target ) {
		if(typeof(target)==='undefined') target = "";
		
		url = "<?php echo site_url('mpoint/pnt_draw');?>/"+mode;

		if ( mode=='c' ) {
			var is_allow = <?php echo (is_allow('c', 'mpoint', 'pnt_draw'))?1:0; ?>;
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
			
			$('#show_screen').prop('checked', true);
			$('#period_id').combogrid('setValue', <?php echo mpoint_period_default()->id;?>);
			$('#period_id').next().find('input').focus();
		}
		
		if ( mode=='u' ) {
			var is_allow = <?php echo (is_allow('u', 'mpoint', 'pnt_draw'))?1:0; ?>;
			if ( !is_allow ) {
				dhtmlx.alert({title:"<?php echo l('notification');?>", type:"alert-error", text:"<?php echo l('permission_failed_crud');?>"});
				return false;
			}
			
			var row = $('#grid').datagrid('getSelected');   
			if (!row)
				return false;

			$('#forms').form('reset'); 
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
			
			$('#show_screen').prop('checked', row.show_screen);
			$('#period_id').next().find('input').focus();
		}
		
		if ( mode=='d' ) {
			var is_allow = <?php echo (is_allow('d', 'mpoint', 'pnt_draw'))?1:0; ?>;
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
		
		if ( mode=='preview_draw' ) {
			
			$('#dlg2').dialog('open').dialog('setTitle',"PREVIEW ON SCREEN !");  
			setTimeout( function(){ 
				$.post( '<?php echo site_url('point/get_active_period');?>', 
					function( result ) {  
						$('#period_id2').combogrid('setValue', result.period_id);
						// $('#phase_id2').combogrid('setValue', result.phase_id);
					}, 'json'
				); 
			}, 100 );
		}
		
		if ( mode=='preview_winner' ) {
		
			window.open("<?php echo site_url('point/preview_winner');?>");			
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
					
				} else {  
					$('#dlg').dialog('close');      // close the dialog  
					$('#grid').datagrid('reload');    // reload the user data  
					dhtmlx.message("<?php echo l('success_saving');?>");
				}  
			}  
		});  
	} 

	function btn_save2() {  
		$('#forms2').form('submit',{  
			url: url,  
			onSubmit: function(param){  
			
				return $(this).form('validate'); 
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
					
				} else {  
					$('#dlg2').dialog('close');      // close the dialog  
					window.open("<?php echo site_url('point/preview_draw');?>");			
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