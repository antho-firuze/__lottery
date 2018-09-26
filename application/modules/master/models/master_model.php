<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_Model extends CI_Model
{

	public function __construct(){
		parent::__construct();
		
	}
	
    /**
     * 
     * 
     * @param <type> $params ['table', 'where', 'like', 'page', 'rows', 'sort', 'order', 'req_new' ] 
     * 
     * @return <type>
     */
	function getCustomer($params) {
		
		$params['table'] = 'customer';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as c');
		$this->db->join('users as u1', 'c.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'c.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('c.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as c');
		$this->db->join('users as u1', 'c.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'c.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
    /**
     * 
     * 
     * @param <type> $params ['table', 'where', 'like', 'page', 'rows', 'sort', 'order', 'req_new' ] 
     * 
     * @return <type>
     */
	function getCurrency($params) {
		
		$params['table'] = 'currency';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as c');
		$this->db->join('users as u1', 'c.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'c.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('c.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as c');
		$this->db->join('users as u1', 'c.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'c.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getItem($params) {
		
		$params['table'] = 'item';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as i');
		$this->db->join('users as u1', 'i.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'i.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('i.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as i');
		$this->db->join('users as u1', 'i.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'i.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getItem_Cat($params) {
		
		$params['table'] = 'item_cat';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as i');
		$this->db->join('users as u1', 'i.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'i.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('i.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as i');
		$this->db->join('users as u1', 'i.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'i.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getMeasure($params) {
		
		$params['table'] = 'measure';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as m');
		$this->db->join('users as u1', 'm.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'm.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('m.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as m');
		$this->db->join('users as u1', 'm.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'm.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getOthers($params) {
		
		$params['table'] = 'others';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as o');
		$this->db->join('opt_factor as of', 'o.factor_id = of.id', 'left');
		$this->db->join('users as u1', 'o.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'o.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('o.*, of.code as factor_code, of.name as factor_name, 
			c1d.code as coa_d_code, c1c.code as coa_c_code, 
			u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as o');
		$this->db->join('opt_factor as of', 'o.factor_id = of.id', 'left');
		$this->db->join('coa as c1d', 'o.coa_d = c1d.id', 'left');
		$this->db->join('coa as c1c', 'o.coa_c = c1c.id', 'left');
		$this->db->join('users as u1', 'o.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'o.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getOthers_ById($id) {
		
		$params['table'] = 'others';
		
		$this->db->select('*');
		$this->db->from($params['table']);
		$this->db->where('id', $id);
		$qry = $this->db->get();
		return ($qry->num_rows() > 0) ? $qry->row() : FALSE;
	}
	
	function getParking($params) {
		
		$params['table'] = 'parking';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as p');
		$this->db->join('users as u1', 'p.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'p.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('p.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as p');
		$this->db->join('users as u1', 'p.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'p.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getPower($params) {
		
		$params['table'] = 'power';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as p');
		$this->db->join('users as u1', 'p.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'p.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('p.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as p');
		$this->db->join('users as u1', 'p.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'p.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getSalesman($params) {
		
		$params['table'] = 'salesman';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as s');
		$this->db->join('users as u1', 's.create_by = u1.id', 'left');
		$this->db->join('users as u2', 's.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('s.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as s');
		$this->db->join('users as u1', 's.create_by = u1.id', 'left');
		$this->db->join('users as u2', 's.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getService($params) {
		
		$params['table'] = 'service';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as s');
		$this->db->join('opt_factor as of', 's.factor_id = of.id', 'left');
		$this->db->join('users as u1', 's.create_by = u1.id', 'left');
		$this->db->join('users as u2', 's.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('s.*, of.code as factor_code, of.name as factor_name, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as s');
		$this->db->join('opt_factor as of', 's.factor_id = of.id', 'left');
		$this->db->join('users as u1', 's.create_by = u1.id', 'left');
		$this->db->join('users as u2', 's.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
    /**
     * 
     * 
     * @param <type> $params ['table', 'where', 'like', 'page', 'rows', 'sort', 'order', 'req_new' ] 
     * 
     * @return <type>
     */
	function getSupplier($params) {
		
		$params['table'] = 'supplier';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as s');
		$this->db->join('users as u1', 's.create_by = u1.id', 'left');
		$this->db->join('users as u2', 's.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('s.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as s');
		$this->db->join('users as u1', 's.create_by = u1.id', 'left');
		$this->db->join('users as u2', 's.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getWater($params) {
		
		$params['table'] = 'water';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as w');
		$this->db->join('users as u1', 'w.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'w.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('w.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as w');
		$this->db->join('users as u1', 'w.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'w.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
}