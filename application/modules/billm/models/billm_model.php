<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Billm_Model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		
		// FOR MEMCACHED
		// $this->load->driver('cache');
		$this->load->helper('billm');
	}
	
	function coba()
	{
		return $this->coba1('abc');
	}
	
	function coba1($a)
	{
		$period_y = 2014;
		$period_m = 4;
		$arr = array('abc_id'=>"$period_y-$period_m");
		return $arr[$a.'_id'];
		// return implode('|', 'key1', 'key2');
	}

	function config()
	{
		$config = new stdClass();
		$qry = $this->db->get('billm_config');
		foreach ($qry->result() as $row)
		{
			$config->{$row->k} = $row->v;
		}
		return $config;
	}
	
	function checkPeriodExists( $y, $m ) 
	{
		$qry = $this->db->get_where( 'period', array('period_year'=>$y, 'period_month'=>$m) );
		if ($qry->num_rows > 0)
			return TRUE;

		return FALSE;
	}
	
	function addNewPeriod( $data=array() ) 
	{

		// VALIDITY SECTION:
		if ( $this->checkPeriodExists($data['period_year'], $data['period_month']) == TRUE )
			return array('success'=>0, 'errorMsg'=>'error_period_duplicate');
			
		$this->db->insert('period', $data);
		return array('id'=>$this->db->insert_id());
	}
	
    /**
     * 
     * 
     * @param <type> $params ['table', 'where', 'like', 'page', 'rows', 'sort', 'order', 'req_new' ] 
     * 
     * @return <type>
     */
	function getPeriod($params=array()) 
	{
		$params['table'] = 'period';
		
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
	
	function getPeriodCurrentId() 
	{
		$params['table'] = 'period';
		
		$this->db->select('p.*');
		$this->db->from($params['table'].' as p');
		$this->db->where('period_year', date('Y'));
		$this->db->where('period_month', date('m'));
		$qry = $this->db->get();
		if ($qry->num_rows() > 0)
		{
			return $qry->row()->id;
		}
		else
		{
			$this->db->select_max('id');
			$qry = $this->db->get($params['table']);
			return $qry->row()->id;
		}
	}
	
	function getPeriod_ById($id) 
	{
		$params['table'] = 'period';
		
		$this->db->select('*');
		$this->db->from($params['table']);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
	
	function getOpt_Charge_Type($params) 
	{
		$params['table'] = 'opt_charge_type';
		
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
	
	function getOpt_Factor($params) 
	{
		$params['table'] = 'opt_factor';
		
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
	
	function getOpt_Invoice_Type($params) 
	{
		$params['table'] = 'opt_invoice_type';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as oit');
		$this->db->join('coa as c1', 'oit.coa_d = c1.id', 'left');
		$this->db->join('coa as c2', 'oit.coa_c = c2.id', 'left');
		$this->db->join('users as u1', 'oit.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'oit.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('oit.*, u1.username as create_by_name, u2.username as update_by_name,
			c1.code as coa_d_code, c2.code as coa_c_code');
		$this->db->from($params['table'].' as oit');
		$this->db->join('coa as c1', 'oit.coa_d = c1.id', 'left');
		$this->db->join('coa as c2', 'oit.coa_c = c2.id', 'left');
		$this->db->join('users as u1', 'oit.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'oit.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getOpt_Invoice_Type_ById($id) 
	{
		$params['table'] = 'opt_invoice_type';
		
		$this->db->select('*');
		$this->db->from($params['table']);
		$this->db->where('id', $id);
		return $this->db->get()->row();
	}
	
    /**
     * 
     * 
     * @param <type> $table 		('power' or 'water')
     * @param <type> $period_id  
     * @param <type> $unit_id  		optional
     * @param <type> $calc_id  		optional (power_id or water_id)
     * 
     * @return <type> array()
     */
	function get_last_value_array( $table, $period_id, $unit_id=NULL, $calc_id=NULL )
	{
	
		$result = array();
		
		// PROCESS GETTING PREVIOUS PERIOD
		$qry = $this->db->get_where( 'period', array('id'=>$period_id) );
		if ($qry->num_rows() < 1)
			return $result;
		
		$period_y = $qry->row()->period_year;
		$period_m = $qry->row()->period_month;
		list($year, $month) = explode('-', add_date('Y-m', "$period_y-$period_m", 0, -1, 0));
		
		$qry = $this->db->get_where( 'period', array('period_year'=>$year, 'period_month'=>$month) );
		if ($qry->num_rows() < 1)
			return $result;
		
		$prev_period_id = $qry->row()->id;
		
		// POPULATE LAST VALUE TO ARRAY
		$filter['period_id'] = $prev_period_id;
		if ( !empty($unit_id) ) $filter['unit_id'] = $unit_id;
		if ( !empty($calc_id) ) $filter[$table.'_id'] = $calc_id;
		$qry = $this->db->get_where( 'unit_'.$table.'_calc', $filter );
		foreach ($qry->result_array() as $row) 
		{
			$key = implode('|', array($row['unit_id'], $row[$table.'_id']));
			$val = $row['curr_value'];
			$result[$key] = $val;
		}
		return $result;
	}
	
	function getRetrieve_Power()
	{
		$params['table'] = 'unit_power_setup';
		
		$this->db->select('ups.*, 0 as last_value, 0 as curr_value, 0 as usage_value, 
			(case u.power_bill when 1 then u.viracc_owner when 2 then u.viracc_tenant end) as viracc,
			(case u.power_bill 
			when 1 then 
				(select uo.customer_id from unit_owner as uo where uo.unit_id = ups.unit_id and uo.date_from <= curdate() and uo.date_to >= curdate() limit 1)
			when 2 then
				(select ut.customer_id from unit_tenant as ut where ut.unit_id = ups.unit_id and ut.date_from <= curdate() and ut.date_to >= curdate() limit 1)
			end) as customer_id, 
			u.bill_date, u.bill_due, u.power_bill as charge_type_id, u.coa_pwr_d as coa_d, u.coa_pwr_c as coa_c, 
			p.code, p.name, p.kva, p.load_tariff, p.rm_hours, p.rm_kwh, p.saving_hours,
			p.blok1, p.blok2, p.blok3, p.blok1_kwh, p.blok2_kwh, p.blok3_kwh, p.ppj_percent, p.admin_amount, p.max_value', FALSE);
		$this->db->from($params['table'].' as ups');
		$this->db->join('unit as u', 'ups.unit_id = u.id', 'left');
		$this->db->join('power as p', 'ups.power_id = p.id', 'left');
		$this->db->where('u.power_bill <> 0');
		$this->db->where('(case u.power_bill 
			when 1 then 
				(select uo.customer_id from unit_owner as uo where uo.unit_id = ups.unit_id and uo.date_from <= curdate() and uo.date_to >= curdate() limit 1)
			when 2 then
				(select ut.customer_id from unit_tenant as ut where ut.unit_id = ups.unit_id and ut.date_from <= curdate() and ut.date_to >= curdate() limit 1)
			end) is not null
		');
		return $this->db->get()->result();
	}
	
	function getRetrieve_Water()
	{
		$params['table'] = 'unit_water_setup';
		
		$this->db->select('uws.*, uws.last_value as curr_value, 0 as usage_value, 
			(case u.water_bill when 1 then u.viracc_owner when 2 then u.viracc_tenant end) as viracc,
			(case u.water_bill 
			when 1 then 
				(select uo.customer_id from unit_owner as uo where uo.unit_id = uws.unit_id and uo.date_from <= curdate() and uo.date_to >= curdate() limit 1)
			when 2 then
				(select ut.customer_id from unit_tenant as ut where ut.unit_id = uws.unit_id and ut.date_from <= curdate() and ut.date_to >= curdate() limit 1)
			end) as customer_id, 
			u.bill_date, u.bill_due, u.water_bill as charge_type_id, u.coa_wtr_d as coa_d, u.coa_wtr_c as coa_c, 
			w.code, w.name, w.tariff, w.min_usage, w.max_value', FALSE);
		$this->db->from($params['table'].' as uws');
		$this->db->join('unit as u', 'uws.unit_id = u.id', 'left');
		$this->db->join('water as w', 'uws.water_id = w.id', 'left');
		$this->db->where('u.water_bill <> 0');
		$this->db->where('(case u.water_bill 
			when 1 then 
				(select uo.customer_id from unit_owner as uo where uo.unit_id = uws.unit_id and uo.date_from <= curdate() and uo.date_to >= curdate() limit 1)
			when 2 then
				(select ut.customer_id from unit_tenant as ut where ut.unit_id = uws.unit_id and ut.date_from <= curdate() and ut.date_to >= curdate() limit 1)
			end) is not null
		');
		return $this->db->get()->result();
	}
	
	/* function getRetrieveGasAll()
	{
		$params['table'] = 'unit_service_setup';
		
		$this->db->select('uss.*, 
			(case u.service_bill when 1 then u.viracc_owner when 2 then u.viracc_tenant end) as viracc,
			(case u.service_bill 
			when 1 then 
				(select uo.customer_id from unit_owner as uo where uo.unit_id = uss.unit_id and uo.date_from <= curdate() and uo.date_to >= curdate() limit 1)
			when 2 then
				(select ut.customer_id from unit_tenant as ut where ut.unit_id = uss.unit_id and ut.date_from <= curdate() and ut.date_to >= curdate() limit 1)
			end) as customer_id, 
			u.bill_date, u.bill_due, u.service_bill as charge_type_id, u.coa_svc_d as coa_d, u.coa_svc_c as coa_c, 
			s.code, s.name, s.tariff, s.factor_id, s.bill_period,
			(case s.factor_id when 1 then u.sqm else 1 end) as factor,
			((case s.factor_id when 1 then u.sqm else 1 end) * s.tariff * s.bill_period) as total_amount', FALSE);
		$this->db->from($params['table'].' as uss');
		$this->db->join('unit as u', 'uss.unit_id = u.id', 'left');
		$this->db->join('service as s', 'uss.service_id = s.id', 'left');
		$this->db->where('u.service_bill <> 0');
		$this->db->where('uss.date_begin is not null');
		$this->db->where('(case u.service_bill 
			when 1 then 
				(select uo.customer_id from unit_owner as uo where uo.unit_id = uss.unit_id and uo.date_from <= curdate() and uo.date_to >= curdate() limit 1)
			when 2 then
				(select ut.customer_id from unit_tenant as ut where ut.unit_id = uss.unit_id and ut.date_from <= curdate() and ut.date_to >= curdate() limit 1)
			end) is not null
		');
		return $this->db->get()->result();
	} */
	
	function getRetrieve_Service()
	{
		$params['table'] = 'unit_service_setup';
		
		$this->db->select('uss.*, 
			(case u.service_bill when 1 then u.viracc_owner when 2 then u.viracc_tenant end) as viracc,
			(case u.service_bill 
			when 1 then 
				(select uo.customer_id from unit_owner as uo where uo.unit_id = uss.unit_id and uo.date_from <= curdate() and uo.date_to >= curdate() limit 1)
			when 2 then
				(select ut.customer_id from unit_tenant as ut where ut.unit_id = uss.unit_id and ut.date_from <= curdate() and ut.date_to >= curdate() limit 1)
			end) as customer_id, 
			u.bill_date, u.bill_due, u.service_bill as charge_type_id, u.coa_svc_d as coa_d, u.coa_svc_c as coa_c, 
			s.code, s.name, s.tariff, s.factor_id, s.bill_period,
			(case s.factor_id when 1 then u.sqm else 1 end) as factor,
			((case s.factor_id when 1 then u.sqm else 1 end) * s.tariff * s.bill_period) as total_amount', FALSE);
		$this->db->from($params['table'].' as uss');
		$this->db->join('unit as u', 'uss.unit_id = u.id', 'left');
		$this->db->join('service as s', 'uss.service_id = s.id', 'left');
		$this->db->where('u.service_bill <> 0');
		$this->db->where('uss.date_begin is not null');
		$this->db->where('(case u.service_bill 
			when 1 then 
				(select uo.customer_id from unit_owner as uo where uo.unit_id = uss.unit_id and uo.date_from <= curdate() and uo.date_to >= curdate() limit 1)
			when 2 then
				(select ut.customer_id from unit_tenant as ut where ut.unit_id = uss.unit_id and ut.date_from <= curdate() and ut.date_to >= curdate() limit 1)
			end) is not null
		');
		return $this->db->get()->result();
	}
	
	function getRetrieve_Others()
	{
		$params['table'] = 'unit_others_setup';
		
		$this->db->select('uos.*, 
			(case uos.charge_type_id when 1 then u.viracc_owner when 2 then u.viracc_tenant end) as viracc,
			(case uos.charge_type_id 
			when 1 then 
				(select uo.customer_id from unit_owner as uo where uo.unit_id = uos.unit_id and uo.date_from <= curdate() and uo.date_to >= curdate() limit 1)
			when 2 then
				(select ut.customer_id from unit_tenant as ut where ut.unit_id = uos.unit_id and ut.date_from <= curdate() and ut.date_to >= curdate() limit 1)
			end) as customer_id, 
			u.bill_date, u.bill_due,  
			o.code, o.name, 
			(case uos.factor_id when 1 then u.sqm else 1 end) as factor,
			((case uos.factor_id when 1 then u.sqm else 1 end) * uos.tariff * uos.bill_period) as total_amount', FALSE);
		$this->db->from($params['table'].' as uos');
		$this->db->join('unit as u', 'uos.unit_id = u.id', 'left');
		$this->db->join('others as o', 'uos.others_id = o.id', 'left');
		$this->db->where('uos.charge_type_id <> 0');
		$this->db->where('uos.date_begin is not null');
		$this->db->where('(case uos.charge_type_id 
			when 1 then 
				(select uo.customer_id from unit_owner as uo where uo.unit_id = uos.unit_id and uo.date_from <= curdate() and uo.date_to >= curdate() limit 1)
			when 2 then
				(select ut.customer_id from unit_tenant as ut where ut.unit_id = uos.unit_id and ut.date_from <= curdate() and ut.date_to >= curdate() limit 1)
			end) is not null
		');
		return $this->db->get()->result();
	}
	
	function getUnit_Power_Setup($params=array()) 
	{
		$params['table'] = 'unit_power_setup';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as ups');
		$this->db->join('power as p', 'ups.power_id = p.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('ups.*, 
			p.code, p.name, p.kva, p.load_tariff, p.rm_hours, p.rm_kwh, p.saving_hours,
			p.blok1, p.blok2, p.blok3, p.blok1_kwh, p.blok2_kwh, p.blok3_kwh, p.ppj_percent, p.admin_amount, p.max_value');
		$this->db->from($params['table'].' as ups');
		$this->db->join('power as p', 'ups.power_id = p.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnit_Water_Setup($params=array()) 
	{
		$params['table'] = 'unit_water_setup';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as uws');
		$this->db->join('water as w', 'uws.water_id = w.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('uws.*, 
			w.code, w.name, w.tariff, w.min_usage, w.max_value');
		$this->db->from($params['table'].' as uws');
		$this->db->join('water as w', 'uws.water_id = w.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnit_Service_Setup($params=array()) 
	{
		$params['table'] = 'unit_service_setup';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as uss');
		$this->db->join('service as s', 'uss.service_id = s.id', 'left');
		$this->db->join('opt_factor as of', 's.factor_id = of.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('uss.*,
			s.code, s.name, s.tariff, s.factor_id, s.bill_period,
			of.code as factor_code, of.name as factor_name');
		$this->db->from($params['table'].' as uss');
		$this->db->join('service as s', 'uss.service_id = s.id', 'left');
		$this->db->join('opt_factor as of', 's.factor_id = of.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnit_Others_Setup($params=array()) 
	{
		$params['table'] = 'unit_others_setup';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as uos');
		$this->db->join('others as o', 'uos.others_id = o.id', 'left');
		$this->db->join('opt_factor as of', 'o.factor_id = of.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('uos.*, 
			o.code, o.name, coa1.code as coa_d_code, coa2.code as coa_c_code, 
			oct.name as charge_type_name, of.code as factor_code, of.name as factor_name');
		$this->db->from($params['table'].' as uos');
		$this->db->join('others as o', 'uos.others_id = o.id', 'left');
		$this->db->join('opt_factor as of', 'uos.factor_id = of.id', 'left');
		$this->db->join('opt_charge_type as oct', 'uos.charge_type_id = oct.id', 'left');
		$this->db->join('coa as coa1', 'uos.coa_d = coa1.id', 'left');
		$this->db->join('coa as coa2', 'uos.coa_c = coa2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnit_Parking_Setup($params=array()) 
	{
		$params['table'] = 'unit_parking_setup';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as ups');
		$this->db->join('parking as p', 'ups.parking_id = p.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('ups.*,
			p.code, p.name, p.desc, p.lot');
		$this->db->from($params['table'].' as ups');
		$this->db->join('parking as p', 'ups.parking_id = p.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnit_Power_Calc($params=array()) 
	{
		$params['table'] = 'unit_power_calc';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as upc');
		$this->db->join('users as u1', 'upc.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'upc.update_by = u2.id', 'left');
		$this->db->join('period as pe', 'upc.period_id = pe.id', 'left');
		$this->db->join('unit as u', 'upc.unit_id = u.id', 'left');
		$this->db->join('power as p', 'upc.power_id = p.id', 'left');
		$this->db->join('customer as c', 'upc.customer_id = c.id', 'left');
		$this->db->join('opt_charge_type as oct', 'upc.charge_type_id = oct.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('upc.*, u1.username as create_by_name, u2.username as update_by_name, 
			pe.code as period_code, pe.name as period_name, u.code as unit_code, u.name as unit_name,
			c.code as customer_code, c.name as customer_name, oct.code as charge_type_code, oct.name as charge_type_name, 
			p.code as power_code, p.name as power_name');
		$this->db->from($params['table'].' as upc');
		$this->db->join('users as u1', 'upc.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'upc.update_by = u2.id', 'left');
		$this->db->join('period as pe', 'upc.period_id = pe.id', 'left');
		$this->db->join('unit as u', 'upc.unit_id = u.id', 'left');
		$this->db->join('power as p', 'upc.power_id = p.id', 'left');
		$this->db->join('customer as c', 'upc.customer_id = c.id', 'left');
		$this->db->join('opt_charge_type as oct', 'upc.charge_type_id = oct.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnit_Water_Calc($params=array()) 
	{
		$params['table'] = 'unit_water_calc';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as uwc');
		$this->db->join('users as u1', 'uwc.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'uwc.update_by = u2.id', 'left');
		$this->db->join('period as pe', 'uwc.period_id = pe.id', 'left');
		$this->db->join('unit as u', 'uwc.unit_id = u.id', 'left');
		$this->db->join('water as w', 'uwc.water_id = w.id', 'left');
		$this->db->join('customer as c', 'uwc.customer_id = c.id', 'left');
		$this->db->join('opt_charge_type as oct', 'uwc.charge_type_id = oct.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('uwc.*, u1.username as create_by_name, u2.username as update_by_name, 
			pe.code as period_code, pe.name as period_name, u.code as unit_code, u.name as unit_name,
			c.code as customer_code, c.name as customer_name, oct.code as charge_type_code, oct.name as charge_type_name, 
			w.code as water_code, w.name as water_name');
		$this->db->from($params['table'].' as uwc');
		$this->db->join('users as u1', 'uwc.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'uwc.update_by = u2.id', 'left');
		$this->db->join('period as pe', 'uwc.period_id = pe.id', 'left');
		$this->db->join('unit as u', 'uwc.unit_id = u.id', 'left');
		$this->db->join('water as w', 'uwc.water_id = w.id', 'left');
		$this->db->join('customer as c', 'uwc.customer_id = c.id', 'left');
		$this->db->join('opt_charge_type as oct', 'uwc.charge_type_id = oct.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnit_Service_Calc($params=array()) 
	{
		$params['table'] = 'unit_service_calc';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as usc');
		$this->db->join('users as u1', 'usc.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'usc.update_by = u2.id', 'left');
		$this->db->join('period as pe', 'usc.period_id = pe.id', 'left');
		$this->db->join('unit as u', 'usc.unit_id = u.id', 'left');
		$this->db->join('service as w', 'usc.service_id = w.id', 'left');
		$this->db->join('customer as c', 'usc.customer_id = c.id', 'left');
		$this->db->join('opt_charge_type as oct', 'usc.charge_type_id = oct.id', 'left');
		$this->db->join('opt_factor as of', 'usc.factor_id = of.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('usc.*, u1.username as create_by_name, u2.username as update_by_name, 
			pe.code as period_code, pe.name as period_name, u.code as unit_code, u.name as unit_name,
			c.code as customer_code, c.name as customer_name, oct.code as charge_type_code, oct.name as charge_type_name, 
			s.code as service_code, s.name as service_name, of.code as factor_code, of.name as factor_name');
		$this->db->from($params['table'].' as usc');
		$this->db->join('users as u1', 'usc.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'usc.update_by = u2.id', 'left');
		$this->db->join('period as pe', 'usc.period_id = pe.id', 'left');
		$this->db->join('unit as u', 'usc.unit_id = u.id', 'left');
		$this->db->join('service as s', 'usc.service_id = s.id', 'left');
		$this->db->join('customer as c', 'usc.customer_id = c.id', 'left');
		$this->db->join('opt_charge_type as oct', 'usc.charge_type_id = oct.id', 'left');
		$this->db->join('opt_factor as of', 'usc.factor_id = of.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getUnit_Others_Calc($params=array()) 
	{
		$params['table'] = 'unit_others_calc';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as uoc');
		$this->db->join('users as u1', 'uoc.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'uoc.update_by = u2.id', 'left');
		$this->db->join('period as pe', 'uoc.period_id = pe.id', 'left');
		$this->db->join('unit as u', 'uoc.unit_id = u.id', 'left');
		$this->db->join('others as w', 'uoc.others_id = w.id', 'left');
		$this->db->join('unit_others_setup as uos', 'uoc.unit_id = uos.unit_id and uoc.others_id = uos.others_id and uoc.charge_type_id = uos.charge_type_id', 'left');
		$this->db->join('customer as c', 'uoc.customer_id = c.id', 'left');
		$this->db->join('opt_charge_type as oct', 'uoc.charge_type_id = oct.id', 'left');
		$this->db->join('opt_factor as of', 'uoc.factor_id = of.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('uoc.*, u1.username as create_by_name, u2.username as update_by_name, 
			pe.code as period_code, pe.name as period_name, u.code as unit_code, u.name as unit_name,
			c.code as customer_code, c.name as customer_name, oct.code as charge_type_code, oct.name as charge_type_name, 
			o.code as others_code, uos.note as others_name, of.code as factor_code, of.name as factor_name');
		$this->db->from($params['table'].' as uoc');
		$this->db->join('users as u1', 'uoc.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'uoc.update_by = u2.id', 'left');
		$this->db->join('period as pe', 'uoc.period_id = pe.id', 'left');
		$this->db->join('unit as u', 'uoc.unit_id = u.id', 'left');
		$this->db->join('others as o', 'uoc.others_id = o.id', 'left');
		$this->db->join('unit_others_setup as uos', 'uoc.unit_id = uos.unit_id and uoc.others_id = uos.others_id and uoc.charge_type_id = uos.charge_type_id', 'left');
		$this->db->join('customer as c', 'uoc.customer_id = c.id', 'left');
		$this->db->join('opt_charge_type as oct', 'uoc.charge_type_id = oct.id', 'left');
		$this->db->join('opt_factor as of', 'uoc.factor_id = of.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function addNewInvoice( $data=array() ) 
	{
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		
		$data['company_id'] = $company_id;
		$data['branch_id']	= $branch_id;

		if ( $data['auto']==1 )
		{
			$filter['company_id']  = $company_id;
			$filter['branch_id']   = $branch_id;
			$filter['period_id']   = $data['period_id'];
			$filter['unit_id'] 	   = $data['unit_id'];
			$filter['customer_id'] = $data['customer_id'];
			$filter['charge_type_id'] = $data['charge_type_id'];
			$this->db->order_by('id', 'DESC');
			$qry = $this->db->get_where( 'invoice', $filter, 1 );
			// 1. NO RECORD
			if ($qry->num_rows() < 1)
			{
				$data['code'] 	= get_invoice_code($company_id, $branch_id, NULL, 'INV-MON', $data['date_from'], (($data['charge_type_id']==1)?'O':'T'), number_code($data['unit_id'], 5));
				$data['rev_no'] = 0;
				$this->db->insert('invoice', $data);
				$invoice_id = $this->db->insert_id();
				
				// AUTO: FILL PREVIOUS BALANCE
				$filter['invoice_id'] = $invoice_id;
				$this->procFillPreviousBalance($filter);
				
				return array('id'=>$invoice_id, 'code'=>$data['code']);
			}
			else
			{
			// 2. EXIST + VOID(0)
				$invoice = $qry->row();
				if ( $invoice->void==0 )
				{
					return array('id'=>$invoice->id, 'code'=>$invoice->code, 'rev_no'=>$invoice->rev_no);
				}
			// 3. EXIST + VOID(1)
				else
				{
					$data['code'] 	= get_invoice_code($company_id, $branch_id, NULL, 'INV-MON', $data['date_from'], (($data['charge_type_id']==1)?'O':'T'), number_code($data['unit_id'], 5));
					$data['rev_no'] = $invoice->rev_no+1;
					$this->db->insert('invoice', $data);
					$invoice_id = $this->db->insert_id();
					
					// AUTO: FILL PREVIOUS BALANCE
					$filter['invoice_id'] = $invoice_id;
					$this->procFillPreviousBalance($filter);
					
					return array('id'=>$invoice_id, 'code'=>$data['code']);
				}
			}
		}
		else
		{
			$data['code'] 	= get_doc_code($company_id, $branch_id, NULL, 'INV');
			$data['rev_no'] = 0;
			$this->db->insert('invoice', $data);
			return array('id'=>$this->db->insert_id(), 'code'=>$data['code']);
		}
		
	}
			
	function addNewInvoiceDt( $data=array() ) 
	{

		$filter['invoice_id']   = $data['invoice_id'];
		$filter['invoice_type_id'] = $data['invoice_type_id'];
		$filter['ref_id'] 	    = $data['ref_id'];
		$qry = $this->db->get_where( 'invoice_dt', $filter );
		if ($qry->num_rows() < 1)
			$this->db->insert('invoice_dt', $data);
			
		return array('id'=>$this->db->insert_id());
	}
	
	function getInvoice($params=array()) 
	{
		$params['table'] = 'invoice';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as i');
		$this->db->join('users as u1', 'i.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'i.update_by = u2.id', 'left');
		$this->db->join('unit as u', 'i.unit_id = u.id', 'left');
		$this->db->join('customer as c', 'i.customer_id = c.id', 'left');
		$this->db->join('opt_charge_type as oct', 'i.charge_type_id = oct.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('i.*, u1.username as create_by_name, u2.username as update_by_name, u.code as unit_code, u.name as unit_name,
			c.code as customer_code, c.name as customer_name, oct.code as charge_type_code, oct.name as charge_type_name');
		$this->db->from($params['table'].' as i');
		$this->db->join('users as u1', 'i.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'i.update_by = u2.id', 'left');
		$this->db->join('unit as u', 'i.unit_id = u.id', 'left');
		$this->db->join('customer as c', 'i.customer_id = c.id', 'left');
		$this->db->join('opt_charge_type as oct', 'i.charge_type_id = oct.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getInvoice_Dt($params=array()) 
	{
		$params['table'] = 'invoice_dt';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as id');
		$this->db->join('opt_invoice_type as oit', 'id.invoice_type_id = oit.id', 'left');
		$this->db->join('coa as c1d', 'id.coa_d = c1d.id', 'left');
		$this->db->join('coa as c1c', 'id.coa_c = c1c.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('id.*, oit.code as invoice_type_code, oit.name as invoice_type_name, 
			c1d.code as coa_d_code, c1c.code as coa_c_code');
		$this->db->from($params['table'].' as id');
		$this->db->join('opt_invoice_type as oit', 'id.invoice_type_id = oit.id', 'left');
		$this->db->join('coa as c1d', 'id.coa_d = c1d.id', 'left');
		$this->db->join('coa as c1c', 'id.coa_c = c1c.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getCustomerListAR($params=NULL)
	{
	
		$params['table'] = 'invoice';
		
		$this->db->select('COUNT(distinct i.customer_id) AS rec_count');
		$this->db->from($params['table'].' as i');
		$this->db->join('customer as c', 'i.customer_id = c.id', 'left');
		$this->db->where('((select ifnull(sum(id.amount), 0) from invoice as i LEFT JOIN invoice_dt as id on i.id = id.invoice_id where i.void = 0 and i.customer_id = c.id) - 
			(select ifnull(sum(ad.amount), 0) from ar as a left join ar_dt as ad on a.id = ad.ar_id where ad.void = 0 and a.customer_id = i.customer_id)) > 0', NULL, FALSE);
		$num_row = $this->shared_model->get_rec_count($params);

		$this->db->distinct();
		$this->db->select('c.id, c.code, c.name');
		$this->db->from($params['table'].' as i');
		$this->db->join('customer as c', 'i.customer_id = c.id', 'left');
		$this->db->where('((select ifnull(sum(id.amount), 0) from invoice as i LEFT JOIN invoice_dt as id on i.id = id.invoice_id where i.void = 0 and i.customer_id = c.id) - 
			(select ifnull(sum(ad.amount), 0) from ar as a left join ar_dt as ad on a.id = ad.ar_id where ad.void = 0 and a.customer_id = i.customer_id)) > 0', NULL, FALSE);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getInvoiceListAR($params=array()) 
	{
		$params['table'] = 'invoice_dt';
		$params['where']['void'] = 0;
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as id');
		$this->db->join('invoice as i', 'id.invoice_id = i.id', 'left');
		$this->db->join('opt_invoice_type as oit', 'id.invoice_type_id = oit.id', 'left');
		$this->db->join('unit as u', 'i.unit_id = u.id', 'left');
		$this->db->join('coa as c1', 'id.coa_d = c1.id', 'left');
		$this->db->join('coa as c2', 'id.coa_c = c2.id', 'left');
		$this->db->where('(id.amount - IFNULL((select sum(ad.amount) from ar_dt as ad where ad.void = 0 and ad.invoice_dt_id = id.id), 0)) > 0', NULL, FALSE);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('id.*, 
			c1.name as coa_d_name, c2.name as coa_c_name, 
			oit.code as invoice_type_code, oit.name as invoice_type_name, i.code as invoice_code, u.code as unit_code,
			IFNULL((select sum(ad.amount) from ar_dt as ad where ad.void = 0 and ad.invoice_dt_id = id.id), 0) as paid_amount,
			(id.amount - IFNULL((select sum(ad.amount) from ar_dt as ad where ad.void = 0 and ad.invoice_dt_id = id.id), 0)) as balance_amount,
			(id.amount - IFNULL((select sum(ad.amount) from ar_dt as ad where ad.void = 0 and ad.invoice_dt_id = id.id), 0)) as pay_amount', FALSE);
		$this->db->from($params['table'].' as id');
		$this->db->join('invoice as i', 'id.invoice_id = i.id', 'left');
		$this->db->join('opt_invoice_type as oit', 'id.invoice_type_id = oit.id', 'left');
		$this->db->join('unit as u', 'i.unit_id = u.id', 'left');
		$this->db->join('coa as c1', 'id.coa_d = c1.id', 'left');
		$this->db->join('coa as c2', 'id.coa_c = c2.id', 'left');
		$this->db->where('(id.amount - IFNULL((select sum(ad.amount) from ar_dt as ad where ad.void = 0 and ad.invoice_dt_id = id.id), 0)) > 0', NULL, FALSE);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function procRetrievePower( $period_id )
	{

		if ( empty($period_id) )
			return;
	
		$last_value_array = $this->get_last_value_array('power', $period_id);
		
		$rows = $this->getRetrieve_Power();
		foreach ($rows as $row) {
			$data = array();
			$data['period_id'] 	   	= $period_id; 	
			$data['unit_id'] 	   	= $row->unit_id; 	
			$data['power_id'] 		= $row->power_id; 	
			$data['customer_id'] 	= $row->customer_id; 	
			
			$key = implode('|', array($row->unit_id, $row->power_id));
			
			$qry2 = $this->db->get_where( 'unit_power_calc', $data );
			if ($qry2->num_rows() > 0)
				continue;
							
			$data['charge_type_id'] = $row->charge_type_id; 	
			$data['viracc'] 		= $row->viracc; 	
			$data['coa_d'] 			= $row->coa_d; 	
			$data['coa_c'] 			= $row->coa_c; 	
			$data['bill_date'] 		= $row->bill_date; 	
			$data['bill_due'] 		= $row->bill_due; 	
			$data['max_value'] 		= $row->max_value; 	
			$data['last_value'] 	= array_key_exists($key, $last_value_array) ? $last_value_array[$key] : 0; 	
			$data['curr_value'] 	= array_key_exists($key, $last_value_array) ? $last_value_array[$key] : 0;	
			$data['usage_value'] 	= 0; 	
			$data['kva'] 			= $row->kva; 	
			$data['rm_hours'] 		= $row->rm_hours; 	
			$data['rm_kwh'] 		= $row->rm_kwh; 	
			$data['saving_hours'] 	= $row->saving_hours; 	
			$data['load_tariff'] 	= $row->load_tariff; 	
			$data['blok1'] 			= $row->blok1; 	
			$data['blok2'] 			= $row->blok2; 	
			$data['blok3'] 			= $row->blok3; 	
			$data['blok1_kwh'] 		= $row->blok1_kwh; 	
			$data['blok2_kwh'] 		= $row->blok2_kwh; 	
			$data['blok3_kwh'] 		= $row->blok3_kwh; 	
			$data['ppj_percent'] 	= $row->ppj_percent; 	
			// $data['saving_kwh'] 	= $row->saving_kwh; 	
			// $data['load_amount'] = $row->power_id; 	
			// $data['blok1_amount'] = $row->power_id; 	
			// $data['blok2_amount'] = $row->power_id; 	
			// $data['blok3_amount'] = $row->power_id; 	
			// $data['sub_amount1'] = $row->power_id; 	
			// $data['ppj_amount'] 	= $row->power_id; 	
			// $data['sub_amount2'] = $row->power_id; 	
			// $data['stampduty_amount'] = $row->power_id; 	
			// $data['total_amount'] = $row->power_id; 	
			$data['create_by'] 		= sesUser()->id; 	
			$data['create_date'] 	= date('Y-m-d H:i:s');
			$this->db->insert( 'unit_power_calc', $data );
		}
		return;
	}

	function procRetrieveWater( $period_id )
	{
	
		if ( empty($period_id) )
			return FALSE;
	
		$last_value_array = $this->get_last_value_array('water', $period_id);
		
		$rows = $this->getRetrieve_Water();
		foreach ($rows as $row) 
		{
			$data = array();
			$data['period_id'] 	   	= $period_id; 	
			$data['unit_id'] 	   	= $row->unit_id; 	
			$data['water_id'] 		= $row->water_id; 	
			$data['customer_id'] 	= $row->customer_id; 	
			
			$key = implode('|', array($row->unit_id, $row->water_id));
			
			$qry2 = $this->db->get_where( 'unit_water_calc', $data );
			if ($qry2->num_rows() > 0)
				continue;
							
			$data['charge_type_id'] = $row->charge_type_id; 	
			$data['viracc'] 		= $row->viracc; 	
			$data['coa_d'] 			= $row->coa_d; 	
			$data['coa_c'] 			= $row->coa_c; 	
			$data['bill_date'] 		= $row->bill_date; 	
			$data['bill_due'] 		= $row->bill_due; 	
			$data['max_value'] 		= $row->max_value; 	
			$data['last_value'] 	= array_key_exists($key, $last_value_array) ? $last_value_array[$key] : 0; 	
			$data['curr_value'] 	= array_key_exists($key, $last_value_array) ? $last_value_array[$key] : 0;	
			$data['usage_value'] 	= 0; 	
			$data['tariff'] 		= $row->tariff; 	
			$data['min_usage'] 		= $row->min_usage; 	
			$data['create_by'] 		= sesUser()->id; 	
			$data['create_date'] 	= date('Y-m-d H:i:s');
			$this->db->insert( 'unit_water_calc', $data );
		}
		return;
	}

	function procRetrieveService( $period_id )
	{
	
		if ( empty($period_id) )
			return;
	
		
		$qry = $this->db->get_where( 'period', array('id'=>$period_id) );
		if ($qry->num_rows() < 1)
			return;
		
		$period = $qry->row();
		
		$rows = $this->getRetrieve_Service();
		foreach ($rows as $row) 
		{
			$data = array();
			
			$date_begin = add_date(NULL, $row->date_begin, 0, $row->bill_period, 0);
			
			// CHECK 1 OF 4
			// if ($row->date_begin > $period->date_end)
			if ($date_begin > $period->date_end)
				continue;
			
			// CHECK 2 OF 4
			if ( !empty($row->date_end) )
			{
				if ($row->date_end < $period->date_begin)
					continue;
			}
			
			// CHECK 3 OF 4
			if ($row->date_begin !== $row->date_end)
			{
				$date = $row->date_begin;
				for ($x=0, $y=$row->bill_period; $date < $period->date_begin; $x+=$y) 
				{
					$date = add_date(NULL, $row->date_begin, 0, $x, 0);
				}
				// CHECK FOR BILL PERIOD OVER THAN A MONTH
				if ( !date_on_period($date, $period->date_begin, $period->date_end) )
					continue;
			}
			
			// CHECK 4 OF 4
			// ONE TIME ONLY (LIKE: DEPOSIT, ETC.)

			$data['period_id'] 	   	= $period_id; 	
			$data['unit_id'] 	   	= $row->unit_id; 	
			$data['service_id'] 	= $row->service_id; 	
			$data['customer_id'] 	= $row->customer_id; 	
			
			$qry2 = $this->db->get_where( 'unit_service_calc', $data );
			if ($qry2->num_rows() > 0)
				continue;
							
			$data['charge_type_id'] = $row->charge_type_id; 	
			$data['viracc'] 		= $row->viracc; 
			$data['coa_d'] 			= $row->coa_d; 	
			$data['coa_c'] 			= $row->coa_c; 	
			$data['bill_date'] 		= $row->bill_date; 	
			$data['bill_due'] 		= $row->bill_due; 	
			$data['date'] 			= $date; 	
			$data['tariff'] 		= $row->tariff; 	
			$data['factor_id'] 		= $row->factor_id; 	
			$data['factor'] 		= $row->factor; 	
			$data['bill_period'] 	= $row->bill_period; 	
			$data['total_amount'] 	= $row->total_amount; 	
			$data['date_begin'] 	= $row->date_begin; 	
			$data['date_end'] 		= $row->date_end; 	
			$data['create_by'] 		= sesUser()->id; 	
			$data['create_date'] 	= date('Y-m-d H:i:s');
			$this->db->insert( 'unit_service_calc', $data );
		}
		return;
	}

	function procRetrieveOthers( $period_id )
	{
	
		if ( empty($period_id) )
			return;
	
		
		$qry = $this->db->get_where( 'period', array('id'=>$period_id) );
		if ($qry->num_rows() < 1)
			return;
		
		$period = $qry->row();
		
		$rows = $this->getRetrieve_Others();
		foreach ($rows as $row) 
		{
			$data = array();
			
			$date_begin = add_date(NULL, $row->date_begin, 0, $row->bill_period, 0);
			
			// CHECK 1 OF 4
			// if ($row->date_begin > $period->date_end)
			if ($date_begin > $period->date_end)
				continue;
			
			// CHECK 2 OF 4
			if ( !empty($row->date_end) )
			{
				if ($row->date_end < $period->date_begin)
					continue;
			}
			
			// CHECK 3 OF 4
			if ($row->date_begin !== $row->date_end)
			{
				$date = $row->date_begin;
				for ($x=0, $y=$row->bill_period; $date < $period->date_begin; $x+=$y) 
				{
					$date = add_date(NULL, $row->date_begin, 0, $x, 0);
				}
				// CHECK FOR BILL PERIOD OVER THAN A MONTH
				if ( !date_on_period($date, $period->date_begin, $period->date_end) )
					continue;
			}
			
			// CHECK 4 OF 4
			// ONE TIME ONLY (LIKE: DEPOSIT, ETC.)

			$data['period_id'] 	   	= $period_id; 	
			$data['unit_id'] 	   	= $row->unit_id; 	
			$data['others_id'] 		= $row->others_id; 	
			$data['customer_id'] 	= $row->customer_id; 	
			
			$qry2 = $this->db->get_where( 'unit_others_calc', $data );
			if ($qry2->num_rows() > 0)
				continue;
							
			$data['charge_type_id'] = $row->charge_type_id; 	
			$data['viracc'] 		= $row->viracc; 
			$data['coa_d'] 			= $row->coa_d; 	
			$data['coa_c'] 			= $row->coa_c; 	
			$data['bill_date'] 		= $row->bill_date; 	
			$data['bill_due'] 		= $row->bill_due; 	
			
			$data['date'] 			= $date; 	
			$data['tariff'] 		= $row->tariff; 	
			$data['factor_id'] 		= $row->factor_id; 	
			$data['factor'] 		= $row->factor; 	
			$data['bill_period'] 	= $row->bill_period; 	
			$data['total_amount'] 	= $row->total_amount; 	
			$data['date_begin'] 	= $row->date_begin; 	
			$data['date_end'] 		= $row->date_end; 	
			$data['create_by'] 		= sesUser()->id; 	
			$data['create_date'] 	= date('Y-m-d H:i:s');
			$this->db->insert( 'unit_others_calc', $data );
		}
		return;
	}

	function procCalculatePower( $period_id, $unit_id=NULL, $power_id=NULL, $customer_id=NULL, $force=FALSE ) 
	{
		
		$filter['period_id']  = $period_id;
		if ( !$force ) $filter['calculated'] = 0;
		if ( !empty($unit_id) ) $filter['unit_id'] = $unit_id;
		if ( !empty($power_id) ) $filter['power_id'] = $power_id;
		if ( !empty($customer_id) ) $filter['customer_id'] = $customer_id;
		$qry = $this->db->get_where('unit_power_calc', $filter);
		if ($qry->num_rows() < 1)
			return FALSE;
		
		foreach ($qry->result() as $row) 
		{
			// CALCULATE USAGE
			$usage = get_usage_value($row->last_value, $row->curr_value, $row->max_value);
		
			$rm_kwh = $row->kva * $row->rm_hours;
			$blok1_kwh = $row->kva * $row->saving_hours;
			$blok2_kwh = 0;
			$blok3_kwh = 0;
			if (($usage >= $rm_kwh) and ($usage <= $blok1_kwh)) 
			{
				$blok1_kwh = $usage;
				$blok2_kwh = 0;
				$blok3_kwh = 0;
			} 
			elseif ($usage < $rm_kwh) 
			{
				$blok1_kwh = $rm_kwh;
				$blok2_kwh = 0;
				$blok3_kwh = 0;
			} 
			elseif ($usage > $blok1_kwh) 
			{
				$left_usage = $usage - $blok1_kwh;
				if ($row->blok2_kwh == 0) 
				{
					$blok2_kwh = $left_usage;
					$blok3_kwh = 0;
				} 
				elseif ($left_usage < $row->blok2_kwh) 
				{
					$blok2_kwh = $left_usage;
					$blok3_kwh = 0;
				} 
				elseif ($left_usage > $row->blok2_kwh) 
				{
					$blok2_kwh = $row->blok2_kwh;
					$blok3_kwh = ($left_usage - $row->blok2_kwh);
				}
			}
			
			$blok1_amount = ($row->blok1 * $blok1_kwh);
			$blok2_amount = ($row->blok2 * $blok2_kwh);
			$blok3_amount = ($row->blok3 * $blok3_kwh);
			
			$sub_amount1 = ($blok1_amount + $blok2_amount + $blok3_amount);
			$ppj_amount  = ($sub_amount1 * $row->ppj_percent);
			
			$sub_amount2 = ($sub_amount1 + $ppj_amount);
			
			if ($sub_amount2 < 1000000) 
			{
				$stampduty_amount = 3000;
			} 
			elseif ($sub_amount2 >= 1000000) 
			{
				$stampduty_amount = 6000;
			}
			
			$total_amount = ($sub_amount2 + $stampduty_amount);
			
			$data['usage_value'] 	= $usage;
			$data['blok1_kwh'] 		= $blok1_kwh;
			$data['blok2_kwh'] 		= $blok2_kwh;
			$data['blok3_kwh'] 		= $blok3_kwh;
			$data['blok1_amount'] 	= $blok1_amount;
			$data['blok2_amount'] 	= $blok2_amount;
			$data['blok3_amount'] 	= $blok3_amount;
			$data['sub_amount1'] 	= $sub_amount1;
			$data['ppj_amount'] 	= $ppj_amount;
			$data['sub_amount2'] 	= $sub_amount2;
			$data['stampduty_amount'] = $stampduty_amount;
			$data['total_amount'] 	= $total_amount;
			$data['calculated'] 	= 1;
			$this->db->update('unit_power_calc', $data, array('id'=>$row->id));
		}
		return TRUE;
	}

	function procCalculateWater( $period_id, $unit_id=NULL, $water_id=NULL, $customer_id=NULL, $force=FALSE ) 
	{

		$filter['period_id']  = $period_id;
		if ( !$force ) $filter['calculated'] = 0;
		if ( !empty($unit_id) ) $filter['unit_id'] = $unit_id;
		if ( !empty($water_id) ) $filter['water_id'] = $water_id;
		if ( !empty($customer_id) ) $filter['customer_id'] = $customer_id;
		$qry = $this->db->get_where('unit_water_calc', $filter);
		if ($qry->num_rows() < 1)
			return FALSE;
			
		$row = $qry->row();
		foreach ($qry->result() as $row) 
		{
			// CALCULATE USAGE
			$usage = get_usage_value($row->last_value, $row->curr_value, $row->max_value, $row->min_usage);
			
			$filter2['period_id'] 	= $row->period_id;
			$filter2['unit_id'] 	= $row->unit_id;
			$filter2['water_id'] 	= $row->water_id;
			$filter2['customer_id'] = $row->customer_id;
			
			$data['usage_value'] 	= $usage;
			$data['total_amount'] 	= ($usage * $row->tariff);
			$data['calculated'] 	= 1;
			$this->db->update('unit_water_calc', $data, $filter2);
		}
		return TRUE;
	}
		
	function getPreviousPeriodById( $id )
	{
		$qry = $this->db->get_where('period', array('id'=>$id));
		if ( $qry->num_rows() > 0 )
			$date = $qry->row()->date_begin;
		else
			return FALSE;
			
		$date = strtotime($date);
		
		// GET PREVIOUS MONTH
		$year  = date( 'Y', mktime( 0, 0, 0, date('m',$date)-1, date('d',$date), date('Y',$date) ));
		$month = date( 'm', mktime( 0, 0, 0, date('m',$date)-1, date('d',$date), date('Y',$date) ));
	
		$qry = $this->db->get_where('period', array('period_year'=>$year, 'period_month'=>$month));
		if ( $qry->num_rows() > 0 )
			return $qry->row()->id;
		
		return FALSE;
	}
	
	function getPreviousPeriodByDate( $date )
	{
		$date = strtotime($date);
		
		// GET PREVIOUS MONTH
		$year  = date( 'Y', mktime( 0, 0, 0, date('m',$date)-1, date('d',$date), date('Y',$date) ));
		$month = date( 'm', mktime( 0, 0, 0, date('m',$date)-1, date('d',$date), date('Y',$date) ));
	
		$qry = $this->db->get_where('period', array('period_year'=>$year, 'period_month'=>$month));
		if ( $qry->num_rows() > 0 )
			return $qry->row()->id;
		
		return FALSE;
	}
	
    /**
     * 
     * 
     * @param <type> period_id, unit_id, customer_id, charge_type_id, invoice_id
     * 
     * @return <type>
     */
	function procFillPreviousBalance( $params=array() ) 
	{
		$filter['unit_id'] = $params['unit_id'];
		$filter['customer_id'] = $params['customer_id'];
		$filter['charge_type_id'] = $params['charge_type_id'];
		$filter['void'] = 0;
		
		// TOTAL PREVIOUS BALANCE
		$this->db->select('sum(total_amount) as prev_balance_amount');
		$this->db->from('invoice');
		$this->db->where('period_id < ', $params['period_id']);
		$this->db->where($filter);
		$qry = $this->db->get();
		$data['prev_balance'] = ( $qry->num_rows() > 0 ) ? $qry->row()->prev_balance_amount : 0;
		
		// FINE AMOUNT
		$prev_period_id = $this->getPreviousPeriodById($params['period_id']);
		$this->db->select('paid_amount, balance_amount');
		$this->db->from('invoice');
		$this->db->where('period_id', $prev_period_id);
		$this->db->where($filter);
		$qry = $this->db->get();
		$prev_fine_amount = ( $qry->num_rows() > 0 ) ? ($qry->row()->balance_amount * $this->config()->fine_percent) : 0;
		
		$data['prev_payment'] = ( $qry->num_rows() > 0 ) ? $qry->row()->paid_amount : 0;
		$this->db->update('invoice', $data, array('id'=>$params['invoice_id']));

		if ($prev_fine_amount > 0) 
		{
			$opt_invoice_type 		= $this->getOpt_Invoice_Type_ById(6);
			$data1['invoice_id']   	= $params['invoice_id'];
			$data1['invoice_type_id'] = 6;	// 1=>PWR
			$data1['ref_id'] 	   	= 0;
			$data1['amount'] 	   	= $prev_fine_amount;
			$data1['note'] 	   	   	= (($opt_invoice_type) ? $opt_invoice_type->name : '') .' (PERIOD '.$this->getPeriod_ById($prev_period_id)->code.')';
			$data1['coa_d'] 	   	= ($opt_invoice_type) ? $opt_invoice_type->coa_d : ''; 	
			$data1['coa_c'] 	   	= ($opt_invoice_type) ? $opt_invoice_type->coa_c : ''; 	
			$this->addNewInvoiceDt( $data1 );
		}
	}
	
	function procGenerateInvoice( $period_id, $unit_id=NULL, $customer_id=NULL, $charge_type_id=NULL ) 
	{

		
		$filter['period_id']  = $period_id;
		if ( !empty($unit_id) ) $filter['unit_id'] = $unit_id;
		if ( !empty($customer_id) ) $filter['customer_id'] = $customer_id;
		if ( !empty($charge_type_id) ) $filter['charge_type_id'] = $charge_type_id;
		$filter['generated']  = 0;

		$period = $this->getPeriod_ById($period_id);
		
		// UNIT_POWER_CALC
		$this->db->select('upc.*, p.code as power_code, p.name as power_name');
		$this->db->from('unit_power_calc as upc');
		$this->db->join('power as p', 'upc.power_id = p.id', 'left');
		$this->db->where('calculated', 1);
		$this->db->where($filter);
		$qry = $this->db->get();
		// $qry = $this->db->get_where( 'unit_power_calc', $filter );
		foreach ($qry->result() as $row) 
		{
			$data1 = array();
			$data1['period_id']   = $row->period_id;
			$data1['unit_id'] 	  = $row->unit_id;
			$data1['customer_id'] = $row->customer_id;
			$data1['charge_type_id'] = $row->charge_type_id;
			$data1['viracc'] 	  = $row->viracc;
			$data1['date_from']   = $period->date_begin;
			$data1['date_to']     = $period->date_end;
			$data1['date'] 	  	  = mk_invoice_date(NULL, $period->date_begin, $row->bill_date);
			$data1['due_date'] 	  = mk_invoice_date(NULL, $period->date_begin, $row->bill_due);
			$data1['code'] 	  	  = 'AUTO';
			$data1['auto'] 	  	  = 1;
			$data1['create_by']   = sesUser()->id;
			$data1['create_date'] = date('Y-m-d H:i:s');
			$invoice = $this->addNewInvoice( $data1 );
			
			$data2 = array();
			$data2['invoice_id']   = $invoice['id'];
			$data2['invoice_type_id'] = 1;	// 1=>PWR
			$data2['ref_id'] 	   = $row->id;
			$data2['amount'] 	   = $row->total_amount;
			$data2['note'] 	   	   = 'ELECTRICITY ('.$row->power_code.')';
			$data2['coa_d'] 	   = $row->coa_d; 	
			$data2['coa_c'] 	   = $row->coa_c; 	
			$this->addNewInvoiceDt( $data2 );

			$this->db->update( 'unit_power_calc', array('generated'=>1), array('id'=>$row->id) );
		}
		
		// UNIT_WATER_CALC
		$this->db->select('uwc.*, w.code as water_code, w.name as water_name');
		$this->db->from('unit_water_calc as uwc');
		$this->db->join('water as w', 'uwc.water_id = w.id', 'left');
		$this->db->where('calculated', 1);
		$this->db->where($filter);
		$qry = $this->db->get();
		// $qry = $this->db->get_where( 'unit_water_calc', $filter );
		foreach ($qry->result() as $row) 
		{
			$data1 = array();
			$data1['period_id']   = $row->period_id;
			$data1['unit_id'] 	  = $row->unit_id;
			$data1['customer_id'] = $row->customer_id;
			$data1['charge_type_id'] = $row->charge_type_id;
			$data1['viracc'] 	  = $row->viracc;
			$data1['date_from']   = $period->date_begin;
			$data1['date_to']     = $period->date_end;
			$data1['date'] 	  	  = mk_invoice_date(NULL, $period->date_begin, $row->bill_date);
			$data1['due_date'] 	  = mk_invoice_date(NULL, $period->date_begin, $row->bill_due);
			$data1['code'] 	  	  = 'AUTO';
			$data1['auto'] 	  	  = 1;
			$data1['create_by']   = sesUser()->id;
			$data1['create_date'] = date('Y-m-d H:i:s');
			$invoice = $this->addNewInvoice( $data1 );
			
			$data2 = array();
			$data2['invoice_id']   = $invoice['id'];
			$data2['invoice_type_id'] = 2;	// 2=>WTR
			$data2['ref_id'] 	   = $row->id;
			$data2['amount'] 	   = $row->total_amount;
			$data2['note'] 	   	   = $row->water_name;
			$data2['coa_d'] 	   = $row->coa_d; 	
			$data2['coa_c'] 	   = $row->coa_c; 	
			$this->addNewInvoiceDt( $data2 );

			$this->db->update( 'unit_water_calc', array('generated'=>1), array('id'=>$row->id) );
		}
		
		// UNIT_SERVICE_CALC
		$this->db->select('usc.*, s.code as service_code, s.name as service_name');
		$this->db->from('unit_service_calc as usc');
		$this->db->join('service as s', 'usc.service_id = s.id', 'left');
		$this->db->where($filter);
		$qry = $this->db->get();
		// $qry = $this->db->get_where( 'unit_service_calc', $filter );
		foreach ($qry->result() as $row) 
		{
			$data1 = array();
			$data1['period_id']   = $row->period_id;
			$data1['unit_id'] 	  = $row->unit_id;
			$data1['customer_id'] = $row->customer_id;
			$data1['charge_type_id'] = $row->charge_type_id;
			$data1['viracc'] 	  = $row->viracc;
			$data1['date_from']   = $period->date_begin;
			$data1['date_to']     = $period->date_end;
			$data1['date'] 	  	  = mk_invoice_date(NULL, $period->date_begin, $row->bill_date);
			$data1['due_date'] 	  = mk_invoice_date(NULL, $period->date_begin, $row->bill_due);
			$data1['code'] 	  	  = 'AUTO';
			$data1['auto'] 	  	  = 1;
			$data1['create_by']   = sesUser()->id;
			$data1['create_date'] = date('Y-m-d H:i:s');
			$invoice = $this->addNewInvoice( $data1 );
			
			$data2 = array();
			$data2['invoice_id']   = $invoice['id'];
			$data2['invoice_type_id'] = 3;	// 3=>SVC
			$data2['ref_id'] 	   = $row->id;
			$data2['amount'] 	   = $row->total_amount;
			$data2['note'] 	   	   = $row->service_name;
			$data2['coa_d'] 	   = $row->coa_d; 	
			$data2['coa_c'] 	   = $row->coa_c; 	
			$this->addNewInvoiceDt( $data2 );

			$this->db->update( 'unit_service_calc', array('generated'=>1), array('id'=>$row->id) );
		}
		
		// UNIT_OTHERS_CALC
		$this->db->select('uoc.*, o.code as others_code, uos.note as others_name');
		$this->db->from('unit_others_calc as uoc');
		$this->db->join('unit_others_setup as uos', 'uoc.unit_id = uos.unit_id and uoc.others_id = uos.others_id and uoc.charge_type_id = uos.charge_type_id', 'left');
		$this->db->join('others as o', 'uoc.others_id = o.id', 'left');
		$this->db->where($filter);
		$qry = $this->db->get();
		// $qry = $this->db->get_where( 'unit_others_calc', $filter );
		foreach ($qry->result() as $row) 
		{
			$data1 = array();
			$data1['period_id']   = $row->period_id;
			$data1['unit_id'] 	  = $row->unit_id;
			$data1['customer_id'] = $row->customer_id;
			$data1['charge_type_id'] = $row->charge_type_id;
			$data1['viracc'] 	  = $row->viracc;
			$data1['date_from']   = $period->date_begin;
			$data1['date_to']     = $period->date_end;
			$data1['date'] 	  	  = mk_invoice_date(NULL, $period->date_begin, $row->bill_date);
			$data1['due_date'] 	  = mk_invoice_date(NULL, $period->date_begin, $row->bill_due);
			$data1['code'] 	  	  = 'AUTO';
			$data1['auto'] 	  	  = 1;
			$data1['create_by']   = sesUser()->id;
			$data1['create_date'] = date('Y-m-d H:i:s');
			$invoice = $this->addNewInvoice( $data1 );
			
			$data2 = array();
			$data2['invoice_id']   = $invoice['id'];
			$data2['invoice_type_id'] = 4;	// 4=>OTR
			$data2['ref_id'] 	   = $row->id;
			$data2['amount'] 	   = $row->total_amount;
			$data2['note'] 	   	   = $row->others_name;
			$data2['coa_d'] 	   = $row->coa_d; 	
			$data2['coa_c'] 	   = $row->coa_c; 	
			$this->addNewInvoiceDt( $data2 );
			
			$this->db->update( 'unit_others_calc', array('generated'=>1), array('id'=>$row->id) );
		}
		
		// UPDATE INVOICE
		$this->updateInvoiceBalanceAmount($period_id);
		return;
	}        

	function procPostingInvoice($period_id, $auto=1, $id=NULL) 
	{
		
		$filter['i.period_id']  = $period_id;
		if ( !empty($id) ) $filter['i.id'] = $id;
		$filter['i.auto']   = $auto;
		$filter['i.void']   = 0;
		$filter['id.posted'] = 0;
		
		$this->db->select('i.id, i.period_id, i.note, p.code as period_code, u.code as unit_code, 
			id.id as invoice_dt_id, id.note as note_dt, id.coa_d, id.coa_c, id.amount');
		$this->db->from('invoice as i');
		$this->db->join('invoice_dt as id', 'i.id = id.invoice_id', 'left');
		$this->db->join('period as p', 'i.period_id = p.id', 'left');
		$this->db->join('unit as u', 'i.unit_id = u.id', 'left');
		$this->db->where($filter);
		$this->db->where('(id.coa_d is not null and id.coa_c is not null)');
		$qry = $this->db->get();
		$i = 1;
		foreach ($qry->result() as $row) 
		{
			if ($i==1)
			{
				$data['code'] 	  	 = 'AUTO';
				$data['period_id'] 	 = $row->period_id;
				$data['date'] 		 = date('Y-m-d');
				$data['journal_type_id'] = 8;	// SALES JOURNAL
				$data['auto'] 	  	 = $auto;
				$data['ref_no'] 	 = ($auto==1) ? $this->config()->batch_maintenance.' ('.$row->period_code.')' : $row->code . " - " . $row->note;
				$data['posted'] 	 = 1;
				$data['create_by']   = sesUser()->id;
				$data['create_date'] = date('Y-m-d H:i:s');
				$this->load->model('acc/acc_model');
				$gl = $this->acc_model->AddNewGL( $data );
			}
			$data1['gl_id'] 	  	  = $gl['id'];
			$data1['journal_type_id'] = 8;	// SALES JOURNAL
			$data1['ref_id'] 	  	  = $row->invoice_dt_id;
			$data1['coa_id'] 	  	  = $row->coa_d;
			$data1['note'] 	  	 	  = $row->unit_code.' - '.$row->note_dt;
			$data1['dc'] 	  	 	  = 'D';
			$data1['currency_id'] 	  = 1;
			$data1['currency_rate']   = 1;
			$data1['currency_amount'] = $row->amount;
			$data1['debit'] 	  	  = $row->amount;
			$data1['credit'] 	  	  = 0;
			$this->db->insert('gl_dt', $data1);
			$this->db->update('invoice_dt', array('posted'=>1), array('id'=>$row->invoice_dt_id));
			
			$data2['gl_id'] 	  	  = $gl['id'];
			$data1['journal_type_id'] = 8;	// SALES JOURNAL
			$data1['ref_id'] 	  	  = $row->invoice_dt_id;
			$data2['coa_id'] 	  	  = $row->coa_c;
			$data2['note'] 	  	 	  = $row->unit_code.' - '.$row->note_dt;
			$data2['dc'] 	  	 	  = 'C';
			$data2['currency_id'] 	  = 1;
			$data2['currency_rate']   = 1;
			$data2['currency_amount'] = $row->amount;
			$data2['debit'] 	  	  = 0;
			$data2['credit'] 	  	  = $row->amount;
			$this->db->insert('gl_dt', $data2);
			$this->db->update('invoice_dt', array('posted'=>1), array('id'=>$row->invoice_dt_id));
			
			$this->db->where(array('invoice_id'=>$row->id, 'posted'=>0));
			if ($this->db->count_all_results('invoice_dt') < 1)
				$this->db->update('invoice', array('posted'=>1), array('id'=>$row->id));
			
			$i++;
		}
		
		$this->db->where(array('period_id'=>$period_id, 'auto'=>1, 'void'=>0, 'posted'=>0));
		if ($this->db->count_all_results('invoice') < 1)
			$this->db->update('period', array('posted'=>1), array('id'=>$period_id));

		return TRUE;
	}
	
	function updateInvoiceBalanceAmount( $period_id, $invoice_id=NULL )
	{
		if ( !empty($period_id) ) $filter['period_id'] = $period_id;
		if ( !empty($invoice_id) ) $filter['id'] = $invoice_id;
		$qry = $this->db->get_where( 'invoice', $filter );
		foreach ($qry->result() as $row) 
		{
			$this->db->select_sum('amount', 'total_amount');
			$this->db->where('invoice_id', $row->id);
			$invoice_dt = $this->db->get('invoice_dt')->row();

			$data1 = array();
			$data1['total_amount'] 	 = $invoice_dt->total_amount;
			$data1['balance_amount'] = $invoice_dt->total_amount - $row->paid_amount;
			$this->db->update( 'invoice', $data1, array('id'=>$row->id) );
		}
		return;
	}
	
	function import_power( $file_full_path = '' ) 
	{
		$this->load->library('Excel');
		$this->load->dbforge();
		
		$period_id = $this->session->userdata('period_id');
		
		//trapping error: file_exists
		if ( ! file_exists($file_full_path) ) 
			return array('success'=>0, 'errorMsg'=>'error_file_not_exists');
			
		$objPHPExcel = PHPExcel_IOFactory::load($file_full_path);
		
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		// var_dump($sheetData);
		
		$this->dbforge->drop_table('ztmp_import_power');
		$fields = array(
                        'unit_id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'unit_code' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '120'
                                          ),
                        'last_value' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'curr_value' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          )
                );
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('ztmp_import_power', TRUE);
		
		$row 	 = count($sheetData);
		// echo $row;
		// return;
		for ( $x=2; $x <= $row; $x++ ) 
		{
			//var_dump($sheetData[$x]);
			
			$values = '';
			$col 	= 1;
			foreach ($sheetData[$x] as $key => $val) 
			{
				if ( $col == 1 ) 
					$values .= "'".$sheetData[$x][$key]."'";
				elseif ( $col > 1 && $col < 5)
					$values .= ", '".$sheetData[$x][$key]."'";
				//echo $values;
				
				$col++;
			} 
			
			$qry = "INSERT INTO ztmp_import_power (unit_id, unit_code, last_value, curr_value) ";
			$qry .= "VALUES ($values)";
			//echo $qry;
			$this->db->query($qry);
		}
			
		// UPDATE TABLE unit_power_calc
		$this->db->query("update unit_power_calc as upc, ztmp_import_power as zip 
			SET upc.curr_value = zip.curr_value 
			WHERE upc.unit_id = zip.unit_id and upc.period_id = $period_id");
		
		// CALCULATE
		$this->procCalculatePower($period_id, NULL, NULL, NULL, TRUE);
		
		// REMOVE FILE
		@unlink($file_full_path);
		
		return array('success'=>1);
	}

	function import_water( $file_full_path = '' ) 
	{
		$this->load->library('Excel');
		$this->load->dbforge();
		
		$period_id = $this->session->userdata('period_id');
		
		//trapping error: file_exists
		if ( ! file_exists($file_full_path) ) 
			return array('success'=>0, 'errorMsg'=>'error_file_not_exists');
			
		$objPHPExcel = PHPExcel_IOFactory::load($file_full_path);
		
		$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		// var_dump($sheetData);
		
		$this->dbforge->drop_table('ztmp_import_water');
		$fields = array(
                        'unit_id' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'unit_code' => array(
                                                 'type' =>'VARCHAR',
                                                 'constraint' => '120'
                                          ),
                        'last_value' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          ),
                        'curr_value' => array(
                                                 'type' => 'INT',
                                                 'constraint' => 11
                                          )
                );
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('ztmp_import_water', TRUE);
		
		$row 	 = count($sheetData);
		//echo '<br />';
		for ( $x=2; $x <= $row; $x++ ) {
			//var_dump($sheetData[$x]);
			
			$values = '';
			$col 	 = 1;
			foreach ($sheetData[$x] as $key => $val) {
				if ( $col == 1 ) 
					$values .= "'".$sheetData[$x][$key]."'";
				elseif ( $col > 1 && $col < 5)
					$values .= ", '".$sheetData[$x][$key]."'";
				//echo $values;
				
				$col++;
			} 
			
			$qry = "INSERT INTO ztmp_import_water (unit_id, unit_code, last_value, curr_value) ";
			$qry .= "VALUES ($values)";
			//echo $qry;
			$this->db->query($qry);
		}
			
		// UPDATE TABLE unit_water_calc
		$this->db->query("UPDATE unit_water_calc uwc, ztmp_import_water ziw 
			SET uwc.curr_value = ziw.curr_value 
			WHERE uwc.unit_id = ziw.unit_id and uwc.period_id = $period_id");
		
		// CALCULATE
		$this->procCalculateWater($period_id, NULL, NULL, NULL, TRUE);
		
		// REMOVE FILE
		@unlink($file_full_path);
		
		return array('success'=>1);
	}

    /**
     * 
     * 
     * @param <type> $type 			{'power', 'water'}
     * @param <type> $period_id 
     * 
     * @return <type>
     */
	function export_data_calc( $type, $period_id=NULL ) 
	{
		$this->load->library('Excel');

		if ( $type == 'power' )
			$this->db->select("upc.unit_id, u.code as unit_code, upc.last_value, upc.curr_value")
				->from("unit_power_calc as upc")
				->join("unit as u", "upc.unit_id = u.id", 'left')
				->where("upc.period_id = $period_id");
		else
			$this->db->select("uwc.unit_id, u.code as unit_code, uwc.last_value, uwc.curr_value")
				->from("unit_water_calc as uwc")
				->join("unit as u", "uwc.unit_id = u.id", 'left')
				->where("uwc.period_id = $period_id");
		$qry = $this->db->get();
		if( $qry->num_rows() < 1 )
			return array('success'=>0, 'errorMsg'=>'error_file_not_exists');
			
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
        $fields = $qry->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
		
		// Fetching the table data
        $row = 2;
        foreach($qry->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
            $row++;
        }
 
		// ================ AUTO SIZE ==================
		$columns = array('A');
		$current = 'A';
		while ($current != 'E') {
			$columns[] = ++$current;
		}
		foreach($columns as $column) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
		}
		// ================ AUTO SIZE ==================
		
		$period = $this->getPeriod_ById($period_id);
		// $filepath = "./attachments/".$type."_".$period->code.".xls";
        // Sending headers to force the user to download the file
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename='".$type."_".$period->code.".xls'");
		header("Cache-Control: max-age=0");
		
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('php://output');
        // $objWriter->save($filepath);
		// readfile($filepath);
	}
	
}