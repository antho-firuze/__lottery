<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assetm_Model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		
		// FOR MEMCACHED
		// $this->load->driver('cache');
	}
	
	function getUnit($params) 
	{
		$params['table'] = 'unit';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as u');
		$this->db->join('opt_charge_type as oct1', 'u.power_bill = oct1.id', 'left');
		$this->db->join('opt_charge_type as oct2', 'u.water_bill = oct2.id', 'left');
		$this->db->join('opt_charge_type as oct3', 'u.service_bill = oct3.id', 'left');
		$this->db->join('opt_charge_type as oct4', 'u.gas_bill = oct4.id', 'left');
		$this->db->join('coa as c1d', 'u.coa_pwr_d = c1d.id', 'left');
		$this->db->join('coa as c1c', 'u.coa_pwr_c = c1c.id', 'left');
		$this->db->join('coa as c2d', 'u.coa_wtr_d = c2d.id', 'left');
		$this->db->join('coa as c2c', 'u.coa_wtr_c = c2c.id', 'left');
		$this->db->join('coa as c3d', 'u.coa_svc_d = c3d.id', 'left');
		$this->db->join('coa as c3c', 'u.coa_svc_c = c3c.id', 'left');
		$this->db->join('coa as c4d', 'u.coa_gas_d = c4d.id', 'left');
		$this->db->join('coa as c4c', 'u.coa_gas_c = c4c.id', 'left');
		$this->db->join('users as u1', 'u.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'u.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('u.*, u1.username as create_by_name, u2.username as update_by_name,
			oct1.name as power_bill_name, oct2.name as water_bill_name, oct3.name as service_bill_name, oct4.name as gas_bill_name, 
			c1d.code as coa_pwr_d_code, c1c.code as coa_pwr_c_code, c2d.code as coa_wtr_d_code, c2c.code as coa_wtr_c_code, 
			c3d.code as coa_svc_d_code, c3c.code as coa_svc_c_code, c4d.code as coa_gas_d_code, c4c.code as coa_gas_c_code');
		$this->db->from($params['table'].' as u');
		$this->db->join('opt_charge_type as oct1', 'u.power_bill = oct1.id', 'left');
		$this->db->join('opt_charge_type as oct2', 'u.water_bill = oct2.id', 'left');
		$this->db->join('opt_charge_type as oct3', 'u.service_bill = oct3.id', 'left');
		$this->db->join('opt_charge_type as oct4', 'u.gas_bill = oct4.id', 'left');
		$this->db->join('coa as c1d', 'u.coa_pwr_d = c1d.id', 'left');
		$this->db->join('coa as c1c', 'u.coa_pwr_c = c1c.id', 'left');
		$this->db->join('coa as c2d', 'u.coa_wtr_d = c2d.id', 'left');
		$this->db->join('coa as c2c', 'u.coa_wtr_c = c2c.id', 'left');
		$this->db->join('coa as c3d', 'u.coa_svc_d = c3d.id', 'left');
		$this->db->join('coa as c3c', 'u.coa_svc_c = c3c.id', 'left');
		$this->db->join('coa as c4d', 'u.coa_gas_d = c4d.id', 'left');
		$this->db->join('coa as c4c', 'u.coa_gas_c = c4c.id', 'left');
		$this->db->join('users as u1', 'u.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'u.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnitOwnerAll($params=array()) 
	{
		$params['table'] = 'unit_owner';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as uo');
		$this->db->join('users as u1', 'uo.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'uo.update_by = u2.id', 'left');
		$this->db->join('unit as u', 'uo.unit_id = u.id', 'left');
		$this->db->join('opt_charge_type as oct1', 'u.power_bill = oct1.id', 'left');
		$this->db->join('opt_charge_type as oct2', 'u.water_bill = oct2.id', 'left');
		$this->db->join('opt_charge_type as oct3', 'u.service_bill = oct3.id', 'left');
		$this->db->join('opt_charge_type as oct4', 'u.gas_bill = oct4.id', 'left');
		$this->db->join('customer as c', 'uo.customer_id = c.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('uo.*, u1.username as create_by_name, u2.username as update_by_name, 
			u.code as unit_code, u.name as unit_name, u.desc as unit_desc, u.sqm as unit_sqm, u.watt as unit_watt, 
			oct1.name as power_bill_name, oct2.name as water_bill_name, oct3.name as service_bill_name, oct4.name as gas_bill_name,
			u.bill_date, u.bill_due, 
			c.code as customer_code, c.name as customer_name, c.email, c.contact_person, c.npwp, c.npwp_name, c.npwp_address,
			c.address, c.phone, c.fax, c.bill_address, c.bill_phone, c.bill_fax');
		$this->db->from($params['table'].' as uo');
		$this->db->join('users as u1', 'uo.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'uo.update_by = u2.id', 'left');
		$this->db->join('unit as u', 'uo.unit_id = u.id', 'left');
		$this->db->join('opt_charge_type as oct1', 'u.power_bill = oct1.id', 'left');
		$this->db->join('opt_charge_type as oct2', 'u.water_bill = oct2.id', 'left');
		$this->db->join('opt_charge_type as oct3', 'u.service_bill = oct3.id', 'left');
		$this->db->join('opt_charge_type as oct4', 'u.gas_bill = oct4.id', 'left');
		$this->db->join('customer as c', 'uo.customer_id = c.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnitOwnerDistinctAll($params=array()) 
	{
		$params['table'] = 'unit_owner';
		
		$this->db->select('COUNT(distinct uo.customer_id) AS rec_count');
		$this->db->from($params['table'].' as uo');
		$this->db->join('users as u1', 'uo.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'uo.update_by = u2.id', 'left');
		$this->db->join('unit as u', 'uo.unit_id = u.id', 'left');
		$this->db->join('opt_charge_type as oct1', 'u.power_bill = oct1.id', 'left');
		$this->db->join('opt_charge_type as oct2', 'u.water_bill = oct2.id', 'left');
		$this->db->join('opt_charge_type as oct3', 'u.service_bill = oct3.id', 'left');
		$this->db->join('opt_charge_type as oct4', 'u.gas_bill = oct4.id', 'left');
		$this->db->join('customer as c', 'uo.customer_id = c.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->distinct();
		$this->db->select('uo.customer_id as id, u1.username as create_by_name, u2.username as update_by_name, 
			u.code as unit_code, u.name as unit_name, u.desc as unit_desc, u.sqm as unit_sqm, u.watt as unit_watt, 
			oct1.name as power_bill_name, oct2.name as water_bill_name, oct3.name as service_bill_name, oct4.name as gas_bill_name,
			u.bill_date, u.bill_due, 
			c.code as customer_code, c.name as customer_name, c.email, c.contact_person, c.npwp, c.npwp_name, c.npwp_address,
			c.address, c.phone, c.fax, c.bill_address, c.bill_phone, c.bill_fax');
		$this->db->from($params['table'].' as uo');
		$this->db->join('users as u1', 'uo.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'uo.update_by = u2.id', 'left');
		$this->db->join('unit as u', 'uo.unit_id = u.id', 'left');
		$this->db->join('opt_charge_type as oct1', 'u.power_bill = oct1.id', 'left');
		$this->db->join('opt_charge_type as oct2', 'u.water_bill = oct2.id', 'left');
		$this->db->join('opt_charge_type as oct3', 'u.service_bill = oct3.id', 'left');
		$this->db->join('opt_charge_type as oct4', 'u.gas_bill = oct4.id', 'left');
		$this->db->join('customer as c', 'uo.customer_id = c.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnitTenantAll($params=array()) 
	{
		$params['table'] = 'unit_tenant';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as ut');
		$this->db->join('users as u1', 'ut.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'ut.update_by = u2.id', 'left');
		$this->db->join('unit as u', 'ut.unit_id = u.id', 'left');
		$this->db->join('opt_charge_type as oct1', 'u.power_bill = oct1.id', 'left');
		$this->db->join('opt_charge_type as oct2', 'u.water_bill = oct2.id', 'left');
		$this->db->join('opt_charge_type as oct3', 'u.service_bill = oct3.id', 'left');
		$this->db->join('opt_charge_type as oct4', 'u.gas_bill = oct4.id', 'left');
		$this->db->join('customer as c', 'ut.customer_id = c.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('ut.*, u1.username as create_by_name, u2.username as update_by_name, 
			u.code as unit_code, u.name as unit_name, u.desc as unit_desc, u.sqm as unit_sqm, u.watt as unit_watt, 
			oct1.name as power_bill_name, oct2.name as water_bill_name, oct3.name as service_bill_name, oct4.name as gas_bill_name,
			u.bill_date, u.bill_due, 
			c.code as customer_code, c.name as customer_name, c.email, c.contact_person, c.npwp, c.npwp_name, c.npwp_address,
			c.address, c.phone, c.fax, c.bill_address, c.bill_phone, c.bill_fax');
		$this->db->from($params['table'].' as ut');
		$this->db->join('users as u1', 'ut.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'ut.update_by = u2.id', 'left');
		$this->db->join('unit as u', 'ut.unit_id = u.id', 'left');
		$this->db->join('opt_charge_type as oct1', 'u.power_bill = oct1.id', 'left');
		$this->db->join('opt_charge_type as oct2', 'u.water_bill = oct2.id', 'left');
		$this->db->join('opt_charge_type as oct3', 'u.service_bill = oct3.id', 'left');
		$this->db->join('opt_charge_type as oct4', 'u.gas_bill = oct4.id', 'left');
		$this->db->join('customer as c', 'ut.customer_id = c.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnitTenantDistinctAll($params=array()) 
	{
		$params['table'] = 'unit_tenant';
		
		$this->db->select('COUNT(distinct ut.customer_id) AS rec_count');
		$this->db->from($params['table'].' as ut');
		$this->db->join('users as u1', 'ut.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'ut.update_by = u2.id', 'left');
		$this->db->join('unit as u', 'ut.unit_id = u.id', 'left');
		$this->db->join('opt_charge_type as oct1', 'u.power_bill = oct1.id', 'left');
		$this->db->join('opt_charge_type as oct2', 'u.water_bill = oct2.id', 'left');
		$this->db->join('opt_charge_type as oct3', 'u.service_bill = oct3.id', 'left');
		$this->db->join('opt_charge_type as oct4', 'u.gas_bill = oct4.id', 'left');
		$this->db->join('customer as c', 'ut.customer_id = c.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->distinct();
		$this->db->select('ut.customer_id as id, u1.username as create_by_name, u2.username as update_by_name, 
			u.code as unit_code, u.name as unit_name, u.desc as unit_desc, u.sqm as unit_sqm, u.watt as unit_watt, 
			oct1.name as power_bill_name, oct2.name as water_bill_name, oct3.name as service_bill_name, oct4.name as gas_bill_name,
			u.bill_date, u.bill_due, 
			c.code as customer_code, c.name as customer_name, c.email, c.contact_person, c.npwp, c.npwp_name, c.npwp_address,
			c.address, c.phone, c.fax, c.bill_address, c.bill_phone, c.bill_fax');
		$this->db->from($params['table'].' as ut');
		$this->db->join('users as u1', 'ut.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'ut.update_by = u2.id', 'left');
		$this->db->join('unit as u', 'ut.unit_id = u.id', 'left');
		$this->db->join('opt_charge_type as oct1', 'u.power_bill = oct1.id', 'left');
		$this->db->join('opt_charge_type as oct2', 'u.water_bill = oct2.id', 'left');
		$this->db->join('opt_charge_type as oct3', 'u.service_bill = oct3.id', 'left');
		$this->db->join('opt_charge_type as oct4', 'u.gas_bill = oct4.id', 'left');
		$this->db->join('customer as c', 'ut.customer_id = c.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
}