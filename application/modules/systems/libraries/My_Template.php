<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Template 
{
	
    public function __construct()
	{
		$ci = get_instance();
		$ci->load->model('systems/systems_model');
	}
	
	public function fire( $mdl_grp=null, $mdl=null, $data=array() ) 
	{
		$ci = get_instance();
		
		$module = $ci->systems_model->getModules_ByCode($mdl_grp, $mdl);
		
		if ( !$module->is_form )
			$ci->session->set_userdata( array('last_url'=>$module->page_link) );

		$data['title'] 	   = strtoupper($module->module_group_name).' :: '.anchor($module->page_link, strtoupper($module->module_name));
		$data['page_link'] = $module->page_link;
		$data['is_form']   = $module->is_form;
		if ($module->is_form)
			$ci->load->view($mdl_grp.'/'.$mdl);
		else
			$ci->load->view('systems/template/02-content-iframe',$data);
	}

}