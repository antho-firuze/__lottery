<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/dhtmlxMessage/themes/message_skyblue.css">
<script type="text/javascript" charset="utf-8" src="<?php echo base_url();?>assets/dhtmlxMessage/dhtmlxmessage.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/jquery-easyui/jquery.easyui.min.js"></script>
	
<div id="dlg_change_pwd" class="easyui-dialog" style="padding:8px" data-options="width:310, height:210, closed:true, cache:false, modal:true">
	<form id="form_change_pwd" method="post" autocomplete="off">
		<input type="hidden" id="id" name="id" />
		<table>
			<tr>
				<td style="width:115px;"><label for="username">User Name / ID</label></td> 		
				<td colspan="2"><input class="easyui-validatebox" type="text" id="username" name="username" style="width:150px; border:1px solid #ccc;" data-options="required:true" disabled /></td>
			</tr>
			<tr>
				<td><label for="old">Password (Old)</label></td> 			
				<td colspan="2"><input class="easyui-validatebox" type="password" id="old" name="old" style="width:150px; border:1px solid #ccc;" data-options="required:true" /></td>
			</tr>
			<tr>
				<td><label for="new">Password (New)</label></td> 			
				<td colspan="2"><input class="easyui-validatebox" type="password" id="new" name="new" style="width:150px; border:1px solid #ccc;" data-options="required:true, validType:'length[<?php echo $this->config->item('min_password_length', 'ion_auth');?>, <?php echo $this->config->item('max_password_length', 'ion_auth');?>]'" /></td>
			</tr>
			<tr>
				<td><label for="confirm">Password (Confirm)</label></td> 			
				<td colspan="2"><input class="easyui-validatebox" type="password" id="confirm" style="width:150px; border:1px solid #ccc;" validType="equals['#new']" required="required" /></td>
			</tr>
		</table>
	</form>
</div>

<script type="text/javascript"> 
	var url;

	$(document).on("keydown", function(e){ 
		switch(e.keyCode){
			case 27:	// esc
				$('#dlg_change_pwd').dialog('close');
				break;
		}
	});
		
	// NEXT TO LOAD (THIS VALUE CAN BE CHANGE)
	$(function(){
	
		url = "<?php echo site_url('systems/change_pwd/u');?>";
		$('#form_change_pwd').form('reset'); 
		
		$('#dlg_change_pwd').dialog({
			buttons: [{
				text:'<?php echo l('form_btn_ok');?>',
				iconCls:'icon-ok',
				handler:function(){	btn_save();	}
			},{
				text:'<?php echo l('form_btn_cancel');?>',
				iconCls:'icon-cancel',
				handler:function(){	$('#dlg_change_pwd').dialog('close'); }
			}]
		}).dialog('open').dialog('setTitle',"<?php echo l('form_change_pwd');?>");
		
		$('#username').val("<?php echo sesUser()->username;?>");  
		$('#old').focus();
	});
	
	function btn_save() {  
		$('#form_change_pwd').form('submit',{  
			url: url,  
			onSubmit: function(){  
				
				return $(this).form('validate'); 
				
			},  
			success: function(result){  
				var result = eval('('+result+')');  
				if (result.errorMsg){  
					dhtmlx.alert({ title:"<?php echo l('notification');?>", type:"alert-error", text:result.errorMsg });
				} else {  
					$('#dlg_change_pwd').dialog('close');      // close the dialog  
					dhtmlx.alert({
						title:"<?php echo l('form_change_pwd');?>", text:"<?php echo l('success_chg_pwd');?>", callback: function(r){  
							window.location.href = "<?php echo site_url('systems/logout');?>";
						}
					});
				}  
			}  
		});  
	} 

</script>
