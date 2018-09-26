<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acc_Model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		
		// FOR MEMCACHED
		// $this->load->driver('cache');
		// $this->load->helper('billm');
	}
	
	function AddNewCOA($data) 
	{
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		
		$data['company_id'] = $company_id;
		$data['branch_id']	= $branch_id;
		
		$this->db->insert('coa', $data);
		return array('id'=>$this->db->insert_id());
	}
	
	function AddNewGL($data) 
	{
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		
		$data['company_id'] = $company_id;
		$data['branch_id']	= $branch_id;
		
		// $Opt_Ledger_Type 	= $this->getOpt_Ledger_Type_ById($data['journal_type_id']);
		
		$data['code'] 		= get_doc_code($company_id, $branch_id, NULL, 'GL', 1);
		
		$this->db->insert('gl', $data);
		return array('id'=>$this->db->insert_id(), 'code'=>$data['code']);
	}
	
	function getOpt_Ledger_Type($params=NULL) 
	{
	
		$params['table'] = 'opt_journal_type';
		
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
	
	function getOpt_Ledger_Type_ById($id)
	{
		$params['table'] = 'opt_journal_type';
		
		$this->db->select('*');
		$this->db->from($params['table']);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
	
	function getCOA($params=NULL) 
	{
	
		$params['table'] = 'coa';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as c');
		$this->db->join('currency as cur', 'c.currency_id = cur.id', 'left');
		$this->db->join('opt_coa_type as oct', 'c.coa_type_id = oct.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);

		$this->db->select('c.*, cur.code as currency_code, cur.name as currency_name, oct.code as coa_type_code, oct.name as coa_type_name');
		$this->db->from($params['table'].' as c');
		$this->db->join('currency as cur', 'c.currency_id = cur.id', 'left');
		$this->db->join('opt_coa_type as oct', 'c.coa_type_id = oct.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getCOA_ById($id)
	{
		$params['table'] = 'coa';
		
		$this->db->select('c.*, u1.username as create_by_name, u2.username as update_by_name, 
			cur.code as currency_code, cur.name as currency_name');
		$this->db->from($params['table'].' as c');
		$this->db->join('users as u1', 'c.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'c.update_by = u2.id', 'left');
		$this->db->join('currency as cur', 'c.currency_id = cur.id', 'left');
		$this->db->where('c.id', $id);
		return $this->db->get()->row();
	}
	
	function getGL($params=NULL) 
	{
	
		$params['table'] = 'gl';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as g');
		$this->db->join('users as u1', 'g.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'g.update_by = u2.id', 'left');
		$this->db->join('opt_journal_type as ojt', 'g.journal_type_id = ojt.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);

		$this->db->select('g.*, u1.username as create_by_name, u2.username as update_by_name, 
			ojt.code as ledger_type_code, ojt.name as ledger_type_name');
		$this->db->from($params['table'].' as g');
		$this->db->join('users as u1', 'g.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'g.update_by = u2.id', 'left');
		$this->db->join('opt_journal_type as ojt', 'g.journal_type_id = ojt.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getGL_ById($id)
	{
		$params['table'] = 'gl';
		
		$this->db->select('g.*, u1.username as create_by_name, u2.username as update_by_name, 
			ojt.code as ledger_type_code, ojt.name as ledger_type_name');
		$this->db->from($params['table'].' as g');
		$this->db->join('users as u1', 'g.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'g.update_by = u2.id', 'left');
		// $this->db->join('currency as cur', 'g.currency_id = cur.id', 'left');
		$this->db->join('opt_journal_type as ojt', 'g.journal_type_id = ojt.id', 'left');
		$this->db->where('g.id', $id);
		return $this->db->get()->row();
	}
	
	function getGL_Dt($params=NULL) 
	{
	
		$params['table'] = 'gl_dt';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as gd');
		$this->db->join('coa as c', 'gd.coa_id = c.id', 'left');
		$this->db->join('currency as cu', 'gd.currency_id = cu.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);

		$this->db->select('gd.*, c.code as coa_code, c.name as coa_name, cu.code as currency_code, cu.name as currency_name');
		$this->db->from($params['table'].' as gd');
		$this->db->join('coa as c', 'gd.coa_id = c.id', 'left');
		$this->db->join('currency as cu', 'gd.currency_id = cu.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
}