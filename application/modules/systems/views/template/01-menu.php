<nav class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<a href="#" onclick="top.frames['content'].location = '<?php echo site_url('main/home');?>';" class="brand" title="Dashboard"><?php echo $this->session->userdata('app_title_short');?></a>
		<div style="padding:3px;">
			<span style="float:right;">
				<span style="color:white;font-weight:bold;position:relative;top:3px;">PERIOD: &nbsp;</span>
				<input class="easyui-combogrid" type="text" id="period_id" name="period_id" style="width:120px" data-options="
					url:'<?php echo site_url('billm/get_period_active');?>',
					editable:false, required:false, panelWidth:200, panelHeight:150, idField:'id', textField:'code', mode:'remote', loadMsg:'Loading...',
					pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true, onChange:onChangePeriod,
					columns: [[
						{field:'id'	 ,title:'ID',width:20,sortable:true,hidden:true},
						{field:'code',title:'PERIOD',width:60,sortable:true},
						{field:'posted',title:'STATUS',width:70,sortable:true, 
							formatter:function(value, rowData, rowIndex){ 
								if ( parseInt(value) )
									return 'CLOSED';
								else
									return 'OPEN';
							} 
						}
					]]" />
				<div style="display:none">
				<input type="text" class="easyui-combogrid" id="company" name="company" style="width:75px" data-options="
					url:'<?php echo site_url('systems/get_company_by_user');?>',
					editable:false, required:false, panelWidth:300, panelHeight:150, idField:'company_id', textField:'company_code', mode:'remote', 
					pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true,
					onChange:onChangeCompany,
					columns: [[
						{field:'id'	 ,title:'ID',width:20,sortable:true,hidden:true},
						{field:'company_id'	 ,title:'company_id',width:20,sortable:true,hidden:true},
						{field:'company_code',title:'CODE',width:30,sortable:true},
						{field:'company_name',title:'NAME',width:70,sortable:true}
					]]" />
				<input type="text" class="easyui-combogrid" id="branch" name="branch" style="width:75px" data-options="
					url:'<?php echo site_url('systems/get_branch_by_user');?>',
					editable:false, required:false, panelWidth:300, panelHeight:150, idField:'branch_id', textField:'branch_code', mode:'remote', 
					pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true,
					onChange:onChangeBranch,
					columns: [[
						{field:'id'	 ,title:'ID',width:20,sortable:true,hidden:true},
						{field:'branch_id'	 ,title:'branch_id',width:20,sortable:true,hidden:true},
						{field:'branch_code',title:'CODE',width:30,sortable:true},
						{field:'branch_name',title:'NAME',width:70,sortable:true}
					]]" />
				<input type="text" class="easyui-combogrid" id="department" name="department" style="width:75px" data-options="
					url:'<?php echo site_url('systems/get_department_by_user');?>',
					editable:false, required:false, panelWidth:300, panelHeight:150, idField:'department_id', textField:'department_code', mode:'remote', 
					pagination:false, rownumbers:true, pageNumber:1, pageSize:50, pageList:[50,100], fitColumns:true,
					onChange:onChangeDepartment,
					columns: [[
						{field:'id'	 ,title:'ID',width:20,sortable:true,hidden:true},
						{field:'department_id'	 ,title:'department_id',width:20,sortable:true,hidden:true},
						{field:'department_code',title:'CODE',width:30,sortable:true},
						{field:'department_name',title:'NAME',width:70,sortable:true}
					]]" />
				</div>
				<!--
				-->
			</span>
			<?php 
			// MENU
			$module_group_id = 0;
			$closed_sub_menu = 0;
			foreach ($menus as $menu)
			{
				if ($module_group_id != $menu->module_group_id)
				{
					if ($closed_sub_menu) echo "</div>";
						
					$module_group_id   = $menu->module_group_id;
					echo "<a href='#' class='easyui-menubutton' data-options='menu:\"#mm$module_group_id\"'>".$menu->module_group_name."</a>";
					
					// SUB MENU HEADER
					echo "<div id=\"mm$module_group_id\" style='width:175px;'>";
					
					// SUB MENU DETAIL
					$module_page_link = site_url($menu->module_page_link);
					if ($menu->module_separator)
						echo "<div class='menu-sep'></div>";
						
					if ($menu->module_is_form) 
						echo "<div onclick='show_dlg(\"$module_page_link\"); return false;'>".$menu->module_name."</div>";
					else 
						echo "<div onclick='top.frames[\"content\"].location = \"$module_page_link\"'>".$menu->module_name."</div>";
						
					$closed_sub_menu = 1;
					
				}
				else
				{
					$module_group_id   = $menu->module_group_id;
					
					// SUB MENU DETAIL
					$module_page_link = site_url($menu->module_page_link);
					if ($menu->module_separator)
						echo "<div class='menu-sep'></div>";
						
					if ($menu->module_is_form) 
						echo "<div onclick='show_dlg(\"$module_page_link\"); return false;'>".$menu->module_name."</div>";
					else 
						echo "<div onclick='top.frames[\"content\"].location = \"$module_page_link\"'>".$menu->module_name."</div>";
				}
			}
			?>
		</div>
	</div>
</nav>	

<script type="text/javascript"> 
	var url;
	var $company, $branch, $department, $period_id;
	
	function init_this(){
		$('#company').combogrid('setValue', "<?php echo $this->session->userdata('company_id');?>");
		$('#branch').combogrid('setValue', "<?php echo $this->session->userdata('branch_id');?>");
		$('#department').combogrid('setValue', "<?php echo $this->session->userdata('department_id');?>");
		$('#period_id').combogrid('setValue', "<?php echo $this->session->userdata('period_id');?>");
		$company 	= $('#company').combogrid('getValue');
		$branch 	= $('#branch').combogrid('getValue');
		$department = $('#department').combogrid('getValue');
		$period_id  = $('#period_id').combogrid('getValue');
	}
	
	function set_this(){
		$('#company').combogrid('setValue', $company);;
		$('#branch').combogrid('setValue', $branch);
		$('#department').combogrid('setValue', $department);
		$('#period_id').combogrid('setValue', $period_id);
	}
	
	$(document).ready(function() {
		$("#company").hide(); 
		$("#branch").hide(); 
		$("#department").hide(); 
		$("#bottom").hide(); 
		init_this();
	});
	
	function show_dlg ( urls ) { 
		$( "#bottom" ).load( urls, function() {
			set_this();
		}); 
		// if($("#bottom"))  $("#bottom").empty(); 
		// $('<div id="bottom"></div>').appendTo('body').load( urls, function() {
		// $('<iframe id="bottom" name="bottom" src="about:blank" frameborder="0" scrolling="no"></iframe>').appendTo('body').hide();
		// top.frames['bottom'].location = urls;
		// $("#bottom").show(); 
		/* $("#bottom").hide();
		
		if (url == urls) {
			$('#dlg').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_report');?>");
			return false;
		}
		
		$( "#bottom" ).load( urls, function() {
			url = urls;
			
			$('#dlg').dialog({
				buttons: [{
					text:'<?php echo l('form_btn_cancel');?>',
					iconCls:'icon-cancel',
					handler:function(){	$('#dlg').dialog('close'); }
				}]
			}).dialog('open').dialog('setTitle',"<?php echo l('form_report');?>");
			
			init_this();
		}); */
		return false;
	}
	
	function onChangeCompany(id){
	
		$.post("<?php echo site_url('systems/set_company_by_user');?>", {"company_id" : id});
		$company 	= $('#company').combogrid('getValue');
	}
	
	function onChangeBranch(id){
	
		$.post("<?php echo site_url('systems/set_branch_by_user');?>", {"branch_id" : id});
		$branch 	= $('#branch').combogrid('getValue');
	}
	
	function onChangeDepartment(id){
	
		$.post("<?php echo site_url('systems/set_department_by_user');?>", {"department_id" : id});
		$department = $('#department').combogrid('getValue');
	}
	
	function onChangePeriod(id){
	
		$.post("<?php echo site_url('billm/set_period_active');?>", {"period_id" : id});
		$period_id = $('#period_id').combogrid('getValue');
	}
	
	function onChangeTheme(theme){
		var link 	= $('#easyui').find('link:first');
		
		$.post("<?php echo site_url('systems/set_themes');?>", {"themes_code" : theme});
		
		if (theme == 'defaults') theme = 'default';
		if (theme == 'black') {
			link.attr('href', '<?php echo base_url();?>assets/jquery-easyui/themes/'+theme+'/easyui.css');
		} else {
			link.attr('href', 'http://www.jeasyui.com/easyui/themes/'+theme+'/easyui.css');
		}
	}
	
</script>

