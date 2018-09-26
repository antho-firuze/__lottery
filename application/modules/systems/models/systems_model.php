<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Systems_Model extends CI_Model
{

	private $tbl_customer	= 'customer';
		
	public function __construct()
	{
		parent::__construct();
		
		// FOR MEMCACHED
		// $this->load->driver('cache');
	}
	
	function init_app() 
	{
		$sess['app_title'] 		 = ':: G.ENE.SYS ULTIMATE :: ';
		$sess['app_title_short'] = ':: GENESYS SYSTEMS ::';
		$this->session->set_userdata( $sess );
	}
	
	function init_first() 
	{
		$user_id = $this->session->userdata('user_id');
		
		$sess['company_id']    = $this->getDefault_Company();
		$sess['branch_id'] 	   = $this->getDefault_Branch();
		$sess['department_id'] = $this->getDefault_Department();
		$sess['groups_id'] 	   = $this->getUsers_ById($user_id)->u_groups;
		
		$this->load->model('billm/billm_model');
		$sess['period_id'] = $this->billm_model->getPeriodCurrentId();
			
		$this->session->set_userdata( $sess );
	}
	
	function getDefault_Company()
	{
		$this->db->select('company_id');
		$this->db->from('users_company');
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->order_by('user_id, id');
		return $this->db->get()->row()->company_id;
	}
	
	function getDefault_Branch()
	{
		$this->db->select('branch_id');
		$this->db->from('users_branch');
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->order_by('user_id, id');
		return $this->db->get()->row()->branch_id;
	}
	
	function getDefault_Department()
	{
		$this->db->select('department_id');
		$this->db->from('users_department');
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->order_by('user_id, id');
		return $this->db->get()->row()->department_id;
	}
	
	function getCompany_ByUser($params)
	{
		$params['table'] = 'users_company';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('users as u', 'a0.user_id = u.id', 'left');
		$this->db->join('company as c', 'a0.company_id = c.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.*, u.username, c.code as company_code, c.name as company_name');
		$this->db->from($params['table'].' as a0');
		$this->db->join('users as u', 'a0.user_id = u.id', 'left');
		$this->db->join('company as c', 'a0.company_id = c.id', 'left');
		$this->db->order_by('a0.user_id, c.code');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getBranch_ByUser($params)
	{
		$params['table'] = 'users_branch';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('users as u', 'a0.user_id = u.id', 'left');
		$this->db->join('branch as b', 'a0.branch_id = b.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.*, u.username, b.code as branch_code, b.name as branch_name');
		$this->db->from($params['table'].' as a0');
		$this->db->join('users as u', 'a0.user_id = u.id', 'left');
		$this->db->join('branch as b', 'a0.branch_id = b.id', 'left');
		$this->db->order_by('a0.user_id, b.code');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getDepartment_ByUser($params)
	{
		
		$params['table'] = 'users_department';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('users as u', 'a0.user_id = u.id', 'left');
		$this->db->join('department as d', 'a0.department_id = d.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.*, u.username, d.code as department_code, d.name as department_name');
		$this->db->from($params['table'].' as a0');
		$this->db->join('users as u', 'a0.user_id = u.id', 'left');
		$this->db->join('department as d', 'a0.department_id = d.id', 'left');
		$this->db->order_by('a0.user_id, d.code');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUsers_Groups_ByUser($user_id) 
	{
		$params['table'] = 'users';
		
		$this->db->select('u.*, GROUP_CONCAT(DISTINCT ug.group_id ORDER BY ug.id) as u_groups');
		$this->db->from($params['table'].' as u');
		$this->db->join('users_groups as ug', 'u.id = ug.user_id', 'left');
		$this->db->join('groups as g', 'ug.group_id = g.id', 'left');
		$this->db->where('ug.user_id', $user_id);
		$this->db->group_by('u.id, u.username, u.email, u.active, u.first_name, u.last_name, u.phone');
		return $this->db->get()->row();
	}
	
    function getTheme($params)
    {
        return $this->db->get( 'theme' )->result();
    }

    function getTheme_ById($id)
    {
        return $this->db->get_where( 'theme', array('id'=>$id) )->row();
    }

    function getTheme_ByUserId($user_id)
    {
        return $this->db->get_where( 'users_settings', array('user_id'=>$user_id) )->row();
    }

    function updateTheme_ByUser($data, $user_id)
    {
        $this->db->update( 'users_settings', $data, array('user_id'=>$user_id) );
    }

    /**
     * 
     * 
     * @param <type> $params ['table', 'where', 'like', 'page', 'rows', 'sort', 'order', 'req_new' ] 
     * 
     * @return <type>
     */
	function getUsers($params) 
	{
		
		$params['table'] = 'users';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as u');
		$this->db->join('users_groups as ug', 'u.id = ug.user_id', 'left');
		$this->db->join('users_company as uc', 'u.id = uc.user_id', 'left');
		$this->db->join('users_branch as ub', 'u.id = ub.user_id', 'left');
		$this->db->join('users_department as ud', 'u.id = ud.user_id', 'left');
		$this->db->join('groups as g', 'ug.group_id = g.id', 'left');
		$this->db->join('company as c', 'uc.company_id = c.id', 'left');
		$this->db->join('branch as b', 'ub.branch_id = b.id', 'left');
		$this->db->join('department as d', 'ud.department_id = d.id', 'left');
		$this->db->group_by('u.id, u.username, u.email, u.active, u.first_name, u.last_name, u.phone');
		$this->db->where('u.deleted', 0);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('u.*, 
			GROUP_CONCAT(DISTINCT ug.group_id ORDER BY ug.id) as u_groups,
			GROUP_CONCAT(DISTINCT g.code ORDER BY ug.id) as u_grp,
			GROUP_CONCAT(DISTINCT uc.company_id ORDER BY uc.id) as u_company,
			GROUP_CONCAT(DISTINCT c.code ORDER BY uc.id) as u_comp,
			GROUP_CONCAT(DISTINCT ub.branch_id ORDER BY ub.id) as u_branch,
			GROUP_CONCAT(DISTINCT b.code ORDER BY ub.id) as u_br,
			GROUP_CONCAT(DISTINCT ud.department_id ORDER BY ud.id) as u_department,
			GROUP_CONCAT(DISTINCT d.code ORDER BY ud.id) as u_dept,
			');
		$this->db->from($params['table'].' as u');
		$this->db->join('users_groups as ug', 'u.id = ug.user_id', 'left');
		$this->db->join('users_company as uc', 'u.id = uc.user_id', 'left');
		$this->db->join('users_branch as ub', 'u.id = ub.user_id', 'left');
		$this->db->join('users_department as ud', 'u.id = ud.user_id', 'left');
		$this->db->join('groups as g', 'ug.group_id = g.id', 'left');
		$this->db->join('company as c', 'uc.company_id = c.id', 'left');
		$this->db->join('branch as b', 'ub.branch_id = b.id', 'left');
		$this->db->join('department as d', 'ud.department_id = d.id', 'left');
		$this->db->group_by('u.id, u.username, u.email, u.active, u.first_name, u.last_name, u.phone');
		$this->db->where('u.deleted', 0);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUsers_ById($id) 
	{
		
		$params['table'] = 'users';
		
		$this->db->select('u.*, 
			GROUP_CONCAT(DISTINCT ug.group_id ORDER BY ug.id) as u_groups,
			GROUP_CONCAT(DISTINCT g.code ORDER BY ug.id) as u_grp,
			GROUP_CONCAT(DISTINCT uc.company_id ORDER BY uc.id) as u_company,
			GROUP_CONCAT(DISTINCT c.code ORDER BY uc.id) as u_comp,
			GROUP_CONCAT(DISTINCT ub.branch_id ORDER BY ub.id) as u_branch,
			GROUP_CONCAT(DISTINCT b.code ORDER BY ub.id) as u_br,
			GROUP_CONCAT(DISTINCT ud.department_id ORDER BY ud.id) as u_department,
			GROUP_CONCAT(DISTINCT d.code ORDER BY ud.id) as u_dept,
			');
		$this->db->from($params['table'].' as u');
		$this->db->join('users_groups as ug', 'u.id = ug.user_id', 'left');
		$this->db->join('users_company as uc', 'u.id = uc.user_id', 'left');
		$this->db->join('users_branch as ub', 'u.id = ub.user_id', 'left');
		$this->db->join('users_department as ud', 'u.id = ud.user_id', 'left');
		$this->db->join('groups as g', 'ug.group_id = g.id', 'left');
		$this->db->join('company as c', 'uc.company_id = c.id', 'left');
		$this->db->join('branch as b', 'ub.branch_id = b.id', 'left');
		$this->db->join('department as d', 'ud.department_id = d.id', 'left');
		$this->db->where('u.id', $id);
		$this->db->group_by('u.id, u.username, u.email, u.active, u.first_name, u.last_name, u.phone');
		return $this->db->get()->row();
	}
	
	function addUsers_Settings($data=array())
	{
        $this->db->insert( 'users_settings', $data );
		return $this->db->insert_id();
	}
	
	function getGroups($params) 
	{
		
		$params['table'] = 'groups';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table']);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('*');
		$this->db->from($params['table']);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getGroups_Auth($params) 
	{
		
		$params['table'] = 'groups';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as g');
		$this->db->join('modules as m');
		$this->db->join('modules_groups as mg', 'm.module_group_id = mg.id');
		$this->db->join('groups_auth as ga', 'g.id = ga.group_id and m.id = ga.module_id', 'left');
		$this->db->where('mg.active = 1 and m.active = 1');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('g.id AS group_id, g.code AS group_code, g.name AS group_name,
			mg.id AS module_group_id, mg.code AS module_group_code,	mg.name AS module_group_name, 
			m.id AS module_id, m.code AS module_code, m.name AS module_name, m.sort_no, 
			ga.id, ga.c, ga.r, ga.u, ga.d, ga.a');
		$this->db->from($params['table'].' as g');
		$this->db->join('modules as m');
		$this->db->join('modules_groups as mg', 'm.module_group_id = mg.id');
		$this->db->join('groups_auth as ga', 'g.id = ga.group_id and m.id = ga.module_id', 'left');
		$this->db->where('mg.active = 1 and m.active = 1');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getGroups_Auth_ByGroupId($ids) 
	{
		$params['table'] = 'groups';
		
		$this->db->distinct();
		$this->db->select('g.id AS group_id, g.code AS group_code, g.name AS group_name,
			mg.id AS module_group_id, mg.code AS module_group_code,	mg.name AS module_group_name,
			m.id AS module_id, m.code AS module_code, m.name AS module_name, m.sort_no as module_sort_no, 
			m.page_link as module_page_link, m.is_form as module_is_form, m.separator as module_separator,
			ga.id, ga.c, ga.r, ga.u, ga.d, ga.a');
		$this->db->from($params['table'].' as g');
		$this->db->join('modules as m');
		$this->db->join('modules_groups as mg', 'm.module_group_id = mg.id');
		$this->db->join('groups_auth as ga', 'g.id = ga.group_id and m.id = ga.module_id', 'left');
		$this->db->where('mg.active = 1 and m.show_in_menu = 1 and ga.r = 1');
		if ( !empty($ids) ) $this->db->where_in('g.id', $ids);
		$this->db->order_by('mg.sort_no, m.sort_no');
		return $this->db->get()->result();
	}
	
    function getCompany($params) 
	{
	
 		$params['table'] = 'company';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table']);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('*');
		$this->db->from($params['table']);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
    }

    function getCompany_ById($id) 
	{
        return $this->db->get_where( 'company', array('id'=>$id) )->row();
    }

    function getBranch($params) 
	{
	
 		$params['table'] = 'branch';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table']);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('*');
		$this->db->from($params['table']);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
    }

    function getBranch_ById($id) 
	{
        return $this->db->get_where( 'branch', array('id'=>$id) )->row();
    }

    function getDepartment($params) 
	{
	
 		$params['table'] = 'department';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table']);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('*');
		$this->db->from($params['table']);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
    }

    function getDepartment_ById($id) 
	{
        return $this->db->get_where( 'department', array('id'=>$id) )->row();
    }

    function getCurrency($params) 
	{
	
 		$params['table'] = 'currency';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as c');
		$this->db->join('users as u1', 'c.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'c.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('c.*, u1.username as create_by_name, u2.username as update_by_name, 
			COALESCE((select rate from currency_rate as cr where cr.currency_id = c.id and date = curdate()),
			(select rate from currency_rate as cr where cr.currency_id = c.id order by id desc limit 1)) as currency_rate', FALSE);
		$this->db->from($params['table'].' as c');
		$this->db->join('users as u1', 'c.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'c.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
    }

    function getModules_Groups($params) 
	{
	
 		$params['table'] = 'modules_groups';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table']);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('*, 
			(select min(sort_no) from (`modules_groups`)) as sort_no_min, 
			(select max(sort_no) from (`modules_groups`)) as sort_no_max
			');
		$this->db->from($params['table']);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
    }

    function getModules($params) 
	{
	
 		$params['table'] = 'modules';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table']);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('m.*, 
			(select min(sort_no) from (`modules`) where module_group_id = m.module_group_id) as sort_no_min, 
			(select max(sort_no) from (`modules`) where module_group_id = m.module_group_id) as sort_no_max
			');
		$this->db->from($params['table'].' as m');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
    }

    function getModules_ByCode($mg_code, $m_code) 
	{
	
 		$params['table'] = 'modules';
		
		$this->db->select('m.*, m.name as module_name, mg.name as module_group_name');
		$this->db->from($params['table'].' as m');
		$this->db->join('modules_groups as mg', 'm.module_group_id = mg.id', 'left');
		$this->db->where("mg.code = '$mg_code' and m.code = '$m_code'");
		return $this->db->get()->row();
    }

    function getSetup_Documents($params) 
	{
	
 		$params['table'] = 'setup_documents';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as sd');
		$this->db->join('company as c', 'sd.company_id = c.id', 'left');
		$this->db->join('branch as b', 'sd.branch_id = b.id', 'left');
		$this->db->join('department as d', 'sd.department_id = d.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('sd.*, c.code as company_code, c.name as company_name, b.code as branch_code, b.name as branch_name, 
			d.code as department_code, d.name as department_name');
		$this->db->from($params['table'].' as sd');
		$this->db->join('company as c', 'sd.company_id = c.id', 'left');
		$this->db->join('branch as b', 'sd.branch_id = b.id', 'left');
		$this->db->join('department as d', 'sd.department_id = d.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
    }

    function getSetup_Documents_ByCode($code) 
	{
		$this->db->select('sd.*');
		$this->db->from('setup_documents as sd');
		$this->db->where('company_id', $this->session->userdata('company_id'));
		$this->db->where('branch_id', $this->session->userdata('branch_id'));
		$this->db->where('department_id', $this->session->userdata('department_id'));
		$this->db->where('code', $code);
		return $this->db->get()->row();
    }

}