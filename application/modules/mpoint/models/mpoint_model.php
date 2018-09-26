<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPoint_Model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	// OPTIONS
	
	function getAdrs_1Country($params) 
	{
		$params['table'] = 'adrs_1country';
		
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

	function getAdrs_2Province($params) 
	{
		$params['table'] = 'adrs_2province';
		
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

	function getAdrs_3City($params) 
	{
		$params['table'] = 'adrs_3city';
		
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

	function getAdrs_4District($params) 
	{
		$params['table'] = 'adrs_4district';
		
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

	function getAdrs_5Village($params) 
	{
		$params['table'] = 'adrs_5village';
		
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

	function getOpt_Store_Type($params) 
	{
		$params['table'] = 'opt_store_type';
		
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

	function getOpt_Store_Floor($params) 
	{
		$params['table'] = 'opt_store_floor';
		
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

	function getOpt_Store_Block($params) 
	{
		$params['table'] = 'opt_store_block';
		
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

	function getOpt_Education_Level($params) 
	{
		$params['table'] = 'opt_education_level';
		
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

	function getOpt_Home_Status($params) 
	{
		$params['table'] = 'opt_home_status';
		
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

	function getOpt_Job_Title($params) 
	{
		$params['table'] = 'opt_job_title';
		
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

	function getOpt_Marital_Status($params) 
	{
		$params['table'] = 'opt_marital_status';
		
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

	function getOpt_Nationality($params) 
	{
		$params['table'] = 'opt_nationality';
		
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

	function getOpt_Occupation($params) 
	{
		$params['table'] = 'opt_occupation';
		
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

	function getOpt_Payment_Type($params) 
	{
		$params['table'] = 'opt_payment_type';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as opt');
		$this->db->join('opt_cash_bank as ocb', 'opt.cash_bank_id = ocb.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('opt.*, ocb.code as cash_bank_code, ocb.name as cash_bank_name');
		$this->db->from($params['table'].' as opt');
		$this->db->join('opt_cash_bank as ocb', 'opt.cash_bank_id = ocb.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getOpt_Payment_Type_FCombo($params) 
	{
		$params['table'] = 'opt_payment_type';
		
		$this->db->select('a0.id, a0.name');
		$this->db->from($params['table'].' as a0');
		return $this->shared_model->get_rec($params);
	}

	function getOpt_Religion($params) 
	{
		$params['table'] = 'opt_religion';
		
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

	function getOpt_Sex($params) 
	{
		$params['table'] = 'opt_sex';
		
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

	function getOpt_Draw_Status($params) 
	{
		$params['table'] = 'opt_draw_status';
		
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

	// MASTERS
	
	function addNewPeriod($data)
	{
		$this->db->insert('pnt_period', $data);
		return array('id'=>$this->db->insert_id());
	}
	
  /**
     * 
     * 
     * @param <type> $params ['table', 'where', 'like', 'page', 'rows', 'sort', 'order', 'req_new' ] 
     * 
     * @return <type>
     */
	function getMember($params) 
	{
		$params['table'] = 'member';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('opt_sex as os', 'a0.sex_id = os.id', 'left');
		$this->db->join('opt_religion as orl', 'a0.religion_id = orl.id', 'left');
		$this->db->join('opt_marital_status as oms', 'a0.marital_status_id = oms.id', 'left');
		$this->db->join('opt_occupation as oo', 'a0.occupation_id = oo.id', 'left');
		$this->db->join('opt_education_level as oel', 'a0.education_level_id = oel.id', 'left');
		$this->db->join('opt_home_status as ohs', 'a0.home_status_id = ohs.id', 'left');
		$this->db->join('opt_nationality as ona', 'a0.nationality_id = ona.id', 'left');
		$this->db->join('adrs_1country as a1', 'a0.address_country = a1.id', 'left');
		$this->db->join('adrs_2province as a2', 'a0.address_province = a2.id', 'left');
		$this->db->join('adrs_3city as a3', 'a0.address_regency = a3.id', 'left');
		$this->db->join('adrs_4district as a4', 'a0.address_district = a4.id', 'left');
		$this->db->join('adrs_5village as a5', 'a0.address_village = a5.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.*, u1.username as create_by_name, u2.username as update_by_name,
			os.code as sex_code, os.name as sex_name, 
			orl.code as religion_code, orl.name as religion_name, 
			oms.code as marital_status_code, oms.name as marital_status_name, 
			oo.code as occupation_code, oo.name as occupation_name, 
			oel.code as education_level_code, oel.name as education_level_name, 
			ohs.code as home_status_code, ohs.name as home_status_name,
			ona.code as nationality_code, ona.name as nationality_name,
			a1.name as address_country_name, a2.name as address_province_name, a3.name as address_regency_name, a4.name as address_district_name, a5.name as address_village_name
			');
		$this->db->from($params['table'].' as a0');
		$this->db->join('opt_sex as os', 'a0.sex_id = os.id', 'left');
		$this->db->join('opt_religion as orl', 'a0.religion_id = orl.id', 'left');
		$this->db->join('opt_marital_status as oms', 'a0.marital_status_id = oms.id', 'left');
		$this->db->join('opt_occupation as oo', 'a0.occupation_id = oo.id', 'left');
		$this->db->join('opt_education_level as oel', 'a0.education_level_id = oel.id', 'left');
		$this->db->join('opt_home_status as ohs', 'a0.home_status_id = ohs.id', 'left');
		$this->db->join('opt_nationality as ona', 'a0.nationality_id = ona.id', 'left');
		$this->db->join('adrs_1country as a1', 'a0.address_country = a1.id', 'left');
		$this->db->join('adrs_2province as a2', 'a0.address_province = a2.id', 'left');
		$this->db->join('adrs_3city as a3', 'a0.address_regency = a3.id', 'left');
		$this->db->join('adrs_4district as a4', 'a0.address_district = a4.id', 'left');
		$this->db->join('adrs_5village as a5', 'a0.address_village = a5.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getMember_List($params) 
	{
		$params['table'] = 'member';
		
		$this->db->select('a0.is_active, a0.code, a0.first_name, a0.last_name, a0.join_date, a0.birth_place, a0.birth_date, a0.email, a0.pin_bbm, 
			a0.home_phone, a0.hand_phone, a0.mother_name, os.name as sex, orl.name as religion, oms.name as marital_status, oo.name as occupation, 
			oel.name as education_level, ohs.name as home_status, ona.name as nationality, 
			a0.identity_no, a0.passport_no, a0.address, 
			a1.name as address_country_name, a2.name as address_province_name, a3.name as address_regency_name, a4.name as address_district_name, a5.name as address_village_name,
			a0.address_postal_code,
			a0.company_name, a0.company_field, a0.company_phone, a0.company_fax, a0.company_department, a0.company_job_title, a0.fixed_income, a0.other_income, a0.note,
			u1.username as create_by, a0.create_date, u2.username as update_by, a0.update_date
			');
		$this->db->from($params['table'].' as a0');
		$this->db->join('opt_sex as os', 'a0.sex_id = os.id', 'left');
		$this->db->join('opt_religion as orl', 'a0.religion_id = orl.id', 'left');
		$this->db->join('opt_marital_status as oms', 'a0.marital_status_id = oms.id', 'left');
		$this->db->join('opt_occupation as oo', 'a0.occupation_id = oo.id', 'left');
		$this->db->join('opt_education_level as oel', 'a0.education_level_id = oel.id', 'left');
		$this->db->join('opt_home_status as ohs', 'a0.home_status_id = ohs.id', 'left');
		$this->db->join('opt_nationality as ona', 'a0.nationality_id = ona.id', 'left');
		$this->db->join('adrs_1country as a1', 'a0.address_country = a1.id', 'left');
		$this->db->join('adrs_2province as a2', 'a0.address_province = a2.id', 'left');
		$this->db->join('adrs_3city as a3', 'a0.address_regency = a3.id', 'left');
		$this->db->join('adrs_4district as a4', 'a0.address_district = a4.id', 'left');
		$this->db->join('adrs_5village as a5', 'a0.address_village = a5.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		return $this->shared_model->get_rec_rep($params);
	}

	function getStore($params) 
	{
		$params['table'] = 'store';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('opt_store_type as ost', 'a0.store_type_id = ost.id', 'left');
		$this->db->join('opt_store_floor as osf', 'a0.store_floor_id = osf.id', 'left');
		$this->db->join('opt_store_block as osb', 'a0.store_block_id = osb.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.*, u1.username as create_by_name, u2.username as update_by_name,
			ost.name as store_type_name, osf.name as store_floor_name, osb.name as store_block_name
			');
		$this->db->from($params['table'].' as a0');
		$this->db->join('opt_store_type as ost', 'a0.store_type_id = ost.id', 'left');
		$this->db->join('opt_store_floor as osf', 'a0.store_floor_id = osf.id', 'left');
		$this->db->join('opt_store_block as osb', 'a0.store_block_id = osb.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getStore_ById($id) 
	{
		$params['table'] = 'store';
		
		$this->db->select('a0.*, u1.username as create_by_name, u2.username as update_by_name,
			ost.name as store_type_name, osf.name as store_floor_name, osb.name as store_block_name
			');
		$this->db->from($params['table'].' as a0');
		$this->db->join('opt_store_type as ost', 'a0.store_type_id = ost.id', 'left');
		$this->db->join('opt_store_floor as osf', 'a0.store_floor_id = osf.id', 'left');
		$this->db->join('opt_store_block as osb', 'a0.store_block_id = osb.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$this->db->where('a0.id', $id);
		return $this->db->get()->row();
	}

	function getPnt_Period($params) 
	{
		$params['table'] = 'pnt_period';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as a0');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getPnt_Period_ById($id) 
	{
		$params['table'] = 'pnt_period';
		
		$this->db->select('p.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as p');
		$this->db->join('users as u1', 'p.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'p.update_by = u2.id', 'left');
		$this->db->where('p.id', $id);
		return $this->db->get()->row();
	}

	function getPnt_Period_Default() 
	{
		$params['table'] = 'pnt_period';
		
		$this->db->select('p.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as p');
		$this->db->join('users as u1', 'p.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'p.update_by = u2.id', 'left');
		$this->db->where('p.default', 1);
		return $this->db->get()->row();
	}

	function getPnt_Period_Phase($params) 
	{
		$params['table'] = 'pnt_period_phase';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as p', 'a0.period_id = p.id', 'left');
		$this->db->where('a0.deleted', 0);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.*, p.code as period_code, p.name as period_name');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as p', 'a0.period_id = p.id', 'left');
		$this->db->where('a0.deleted', 0);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getPnt_Period_Phase_ById($id) 
	{
		$params['table'] = 'pnt_period_phase';
		
		$this->db->select('a0.*, p.code as period_code, p.name as period_name');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as p', 'a0.period_id = p.id', 'left');
		$this->db->where('a0.id', $id);
		return $this->db->get()->row();
	}

	function getPnt_Period_Rule($params) 
	{
		$params['table'] = 'pnt_period_rule';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as p', 'a0.period_id = p.id', 'left');
		$this->db->join('pnt_period_phase as pp', 'a0.period_phase_id = pp.id', 'left');
		$this->db->join('pnt_period_rule_payment_type as prpt', 'a0.id = prpt.period_rule_id', 'left');
		$this->db->join('pnt_period_rule_store_type as prst', 'a0.id = prst.period_rule_id', 'left');
		$this->db->join('pnt_period_rule_store as prs', 'a0.id = prs.period_rule_id', 'left');
		$this->db->join('opt_payment_type as opt', 'prpt.payment_type_id = opt.id', 'left');
		$this->db->join('opt_store_type as ost', 'prst.store_type_id = ost.id', 'left');
		$this->db->join('store as s', 'prs.store_id = s.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->group_by('a0.id, a0.period_id, a0.period_phase_id, a0.coef_rate_value, a0.coef_rate_point, u1.username, u2.username, p.code, p.name, pp.name');
		$this->db->where('a0.deleted', 0);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.id, a0.period_id, a0.period_phase_id, a0.coef_rate_value, a0.coef_rate_point, 
			a0.payment_type_cond, a0.store_type_cond, a0.store_cond, 
			u1.username as create_by_name, u2.username as update_by_name, 
			p.code as period_code, p.name as period_name,
			pp.name as phase_name,
			GROUP_CONCAT(DISTINCT prpt.payment_type_id ORDER BY prpt.id) as payment_type_ids,
			GROUP_CONCAT(DISTINCT opt.name ORDER BY prpt.id) as payment_type_names,
			GROUP_CONCAT(DISTINCT prst.store_type_id ORDER BY prst.id) as store_type_ids,
			GROUP_CONCAT(DISTINCT ost.name ORDER BY prst.id) as store_type_names,
			GROUP_CONCAT(DISTINCT prs.store_id ORDER BY prs.id) as store_ids,
			GROUP_CONCAT(DISTINCT s.name ORDER BY prs.id) as store_names
			');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as p', 'a0.period_id = p.id', 'left');
		$this->db->join('pnt_period_phase as pp', 'a0.period_phase_id = pp.id', 'left');
		$this->db->join('pnt_period_rule_payment_type as prpt', 'a0.id = prpt.period_rule_id', 'left');
		$this->db->join('pnt_period_rule_store_type as prst', 'a0.id = prst.period_rule_id', 'left');
		$this->db->join('pnt_period_rule_store as prs', 'a0.id = prs.period_rule_id', 'left');
		$this->db->join('opt_payment_type as opt', 'prpt.payment_type_id = opt.id', 'left');
		$this->db->join('opt_store_type as ost', 'prst.store_type_id = ost.id', 'left');
		$this->db->join('store as s', 'prs.store_id = s.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->group_by('a0.id, a0.period_id, a0.period_phase_id, a0.coef_rate_value, a0.coef_rate_point, a0.payment_type_cond, a0.store_type_cond, a0.store_cond, u1.username, u2.username, p.code, p.name, pp.name');
		$this->db->where('a0.deleted', 0);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getPnt_Period_Rule_By_PeriodId($period_id) 
	{
		$params['table'] = 'pnt_period_rule';
		
		$this->db->select('a0.id, a0.period_id, a0.period_phase_id, a0.coef_rate_value, a0.coef_rate_point, 
			a0.payment_type_cond, a0.store_type_cond, a0.store_cond, 
			u1.username as create_by_name, u2.username as update_by_name, 
			p.code as period_code, p.name as period_name,
			pp.name as phase_name,
			GROUP_CONCAT(DISTINCT prpt.payment_type_id ORDER BY prpt.id) as payment_type_ids,
			GROUP_CONCAT(DISTINCT opt.name ORDER BY prpt.id) as payment_type_names,
			GROUP_CONCAT(DISTINCT prst.store_type_id ORDER BY prst.id) as store_type_ids,
			GROUP_CONCAT(DISTINCT ost.name ORDER BY prst.id) as store_type_names,
			GROUP_CONCAT(DISTINCT prs.store_id ORDER BY prs.id) as store_ids,
			GROUP_CONCAT(DISTINCT s.name ORDER BY prs.id) as store_names
			');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as p', 'a0.period_id = p.id', 'left');
		$this->db->join('pnt_period_phase as pp', 'a0.period_phase_id = pp.id', 'left');
		$this->db->join('pnt_period_rule_payment_type as prpt', 'a0.id = prpt.period_rule_id', 'left');
		$this->db->join('pnt_period_rule_store_type as prst', 'a0.id = prst.period_rule_id', 'left');
		$this->db->join('pnt_period_rule_store as prs', 'a0.id = prs.period_rule_id', 'left');
		$this->db->join('opt_payment_type as opt', 'prpt.payment_type_id = opt.id', 'left');
		$this->db->join('opt_store_type as ost', 'prst.store_type_id = ost.id', 'left');
		$this->db->join('store as s', 'prs.store_id = s.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->group_by('a0.id, a0.period_id, a0.period_phase_id, a0.coef_rate_value, a0.coef_rate_point, a0.payment_type_cond, a0.store_type_cond, a0.store_cond, u1.username, u2.username, p.code, p.name, pp.name');
		$this->db->where('a0.period_id', $period_id);
		$this->db->where('a0.deleted', 0);
		return $this->db->get()->result();
	}

	function getPnt_Prize($params) 
	{
		$params['table'] = 'pnt_prize';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as p', 'a0.period_id = p.id', 'left');
		$this->db->join('pnt_period_phase as pp', 'a0.period_phase_id = pp.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.*, u1.username as create_by_name, u2.username as update_by_name, 
			p.code as period_code, p.name as period_name,
			pp.name as phase_name
			');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as p', 'a0.period_id = p.id', 'left');
		$this->db->join('pnt_period_phase as pp', 'a0.period_phase_id = pp.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	// TRANSACTIONS
	
	function getPnt_Receipt($params) 
	{
		$params['table'] = 'pnt_receipt';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as pp', 'a0.period_id = pp.id', 'left');
		$this->db->join('pnt_period_phase as ppp', 'a0.period_phase_id = ppp.id', 'left');
		$this->db->join('member as m', 'a0.member_id = m.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.*, u1.username as create_by_name, u2.username as update_by_name,
			pp.code as period_code, pp.name as period_name, pp.max_receipt_daily,
			ppp.name as period_phase_name, ppp.date_from, ppp.date_to, 
			m.code as member_code, m.first_name as member_first_name,  m.last_name as member_last_name,  
			m.name_on_card as member_name_on_card, m.identity_no as member_identity_no');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as pp', 'a0.period_id = pp.id', 'left');
		$this->db->join('pnt_period_phase as ppp', 'a0.period_phase_id = ppp.id', 'left');
		$this->db->join('member as m', 'a0.member_id = m.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getPnt_Receipt_ById($id) 
	{
		$params['table'] = 'pnt_receipt';
		
		$this->db->select('a0.*, u1.username as create_by_name, u2.username as update_by_name,
			pp.code as period_code, pp.name as period_name, pp.max_receipt_daily, pp.max_receipt_periodic, 
			m.code as member_code, m.first_name as member_first_name,  m.last_name as member_last_name,  
			m.name_on_card as member_name_on_card, m.identity_no as member_identity_no');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as pp', 'a0.period_id = pp.id', 'left');
		$this->db->join('member as m', 'a0.member_id = m.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$this->db->where('a0.id', $id);
		return $this->db->get()->row();
	}

	function getPnt_Receipt_Dt($params) 
	{
		$params['table'] = 'pnt_receipt_dt';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('opt_payment_type as opt', 'a0.payment_type_id = opt.id', 'left');
		$this->db->join('store as s', 'a0.store_id = s.id', 'left');
		$this->db->join('opt_store_type as ost', 's.store_type_id = ost.id', 'left');
		$this->db->where('a0.deleted', 0);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.*,
			opt.code as payment_type_code, opt.name as payment_type_name,
			s.code as store_code, s.name as store_name,
			ost.code as store_type_code, ost.name as store_type_name
			');
		$this->db->from($params['table'].' as a0');
		$this->db->join('opt_payment_type as opt', 'a0.payment_type_id = opt.id', 'left');
		$this->db->join('store as s', 'a0.store_id = s.id', 'left');
		$this->db->join('opt_store_type as ost', 's.store_type_id = ost.id', 'left');
		$this->db->where('a0.deleted', 0);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getPnt_Draw($params) 
	{
		$params['table'] = 'pnt_draw';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as p', 'a0.period_id = p.id', 'left');
		$this->db->join('pnt_period_phase as pp', 'a0.phase_id = pp.id', 'left');
		$this->db->join('pnt_prize as pz', 'a0.prize_id = pz.id', 'left');
		$this->db->join('member as m', 'a0.member_id = m.id', 'left');
		$this->db->join('opt_draw_status as ods', 'a0.status_id = ods.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('a0.*, u1.username as create_by_name, u2.username as update_by_name,
			p.code as period_code, p.name as period_name,
			pp.name as phase_name,
			pz.code as prize_code, pz.name as prize_name,
			m.code as member_code, m.name as member_name, m.identity_no, 
			ods.code as status_code, ods.name as status_name
			');
		$this->db->from($params['table'].' as a0');
		$this->db->join('pnt_period as p', 'a0.period_id = p.id', 'left');
		$this->db->join('pnt_period_phase as pp', 'a0.phase_id = pp.id', 'left');
		$this->db->join('pnt_prize as pz', 'a0.prize_id = pz.id', 'left');
		$this->db->join('member as m', 'a0.member_id = m.id', 'left');
		$this->db->join('opt_draw_status as ods', 'a0.status_id = ods.id', 'left');
		$this->db->join('users as u1', 'a0.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'a0.update_by = u2.id', 'left');
		$this->db->where('a0.deleted', 0);
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getPnt_Blocked($params) 
	{
		$params['table'] = 'pnt_blocked';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as pb');
		$this->db->join('member as m', 'pb.member_id = m.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('pb.*, m.code as member_code, m.name as member_name');
		$this->db->from($params['table'].' as pb');
		$this->db->join('member as m', 'pb.member_id = m.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getPnt_Coupon($params) 
	{
		$params['table'] = 'pnt_coupon';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as pc');
		$this->db->join('users as u1', 'pc.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'pc.update_by = u2.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('pc.*, u1.username as create_by_name, u2.username as update_by_name');
		$this->db->from($params['table'].' as pc');
		$this->db->join('users as u1', 'pc.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'pc.update_by = u2.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getPnt_Preview($params) 
	{
		$params['table'] = 'pnt_preview';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as pp');
		$this->db->join('pnt_prize as ppz', 'pp.prize_id = ppz.id', 'left');
		$this->db->join('member as m', 'pp.member_id = m.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('pp.*, 
			m.code as member_code, m.name as member_name, m.identity_no as member_identity_no');
		$this->db->from($params['table'].' as pp');
		$this->db->join('pnt_prize as ppz', 'pp.prize_id = ppz.id', 'left');
		$this->db->join('member as m', 'pp.member_id = m.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	// REPORTS
	
	// FUNCTION 
	
	function update_point_and_value($receipt_id)
	{
		$data['total_point'] = 0;
		$data['total_value'] = 0;
		$pnt_receipt = $this->getPnt_Receipt_ById($receipt_id);
		$pnt_period_rule = $this->getPnt_Period_Rule_By_PeriodId($pnt_receipt->period_id);
		foreach ($pnt_period_rule as $row)
		{
			$this->db->select('sum(rd.value) as value', FALSE);
			$this->db->from('pnt_receipt as a0');
			$this->db->join('pnt_receipt_dt as rd','a0.id = rd.receipt_id','inner');
			$this->db->where('a0.id', $receipt_id);
			if ( !empty($row->period_phase_id) ) 
				$this->db->where('period_phase_id', $row->period_phase_id);
			if ( !empty($row->payment_type_ids) ) 
				if ( $row->payment_type_cond )
					$this->db->where_not_in( 'payment_type_id', explode(",", $row->payment_type_ids) );
				else
					$this->db->where_in( 'payment_type_id', explode(",", $row->payment_type_ids) );
			if ( !empty($row->store_type_ids) )	
				if ( $row->store_type_cond )
					$this->db->where_not_in( 'store_type_id', explode(",", $row->store_type_ids) );
				else
					$this->db->where_in( 'store_type_id', explode(",", $row->store_type_ids) );
			if ( !empty($row->store_ids) ) 
				if ( $row->store_cond )
					$this->db->where_not_in( 'store_id', explode(",", $row->store_ids) );
				else
					$this->db->where_in( 'store_id', explode(",", $row->store_ids) );
			$pnt_receipt_dt = $this->db->get()->row();
			$data['total_point'] += floor($pnt_receipt_dt->value / $row->coef_rate_value) * $row->coef_rate_point;
			$data['total_value'] += $pnt_receipt_dt->value;
		}
		
		$check_point = $this->check_point( $pnt_receipt->period_id, $pnt_receipt->period_phase_id, $pnt_receipt->member_id, $pnt_receipt->date, $receipt_id );
		if ($check_point->this_day >= $pnt_receipt->max_receipt_daily) {
			$data['total_point'] = 0;
			$data['note']  = " * SORRY, YOU HAS REACH MAXIMUM DAILY RECEIPT !";
		} else {
			$point_now = $data['total_point'] + $check_point->this_day;
			if ($point_now > $pnt_receipt->max_receipt_daily) {
				$data['total_point'] = ($pnt_receipt->max_receipt_daily - $check_point->this_day);
				$data['note']  = "SORRY, YOUR POINT AUTOMATICALLY REDUCE, BECAUSE HAS REACH MAXIMUM DAILY RECEIPT !";
			} 
		}
		$this->db->update( 'pnt_receipt', $data, array('id'=>$receipt_id) );
		return true;
	}
	
	function check_point($period_id, $period_phase_id=NULL, $member_id, $date=NULL, $receipt_id=NULL)
	{
		// DAILY
		$this->db->select('sum(total_point) AS total_point', FALSE);
		$this->db->from('pnt_receipt');
		$this->db->where('period_id', $period_id);
		$this->db->where('member_id', $member_id);
		$this->db->where('date', $date);
		$this->db->where('deleted', 0);
		if ( !empty($period_phase_id) ) 
			$this->db->where('period_phase_id', $period_phase_id);
			
		if ( !empty($receipt_id) )
			$this->db->where('id <>', $receipt_id);
		$this_day = $this->db->get()->row()->total_point;
		
		// PERIOD
		$this->db->select('sum(total_point) AS total_point', FALSE);
		$this->db->from('pnt_receipt');
		$this->db->where('deleted', 0);
		$this->db->where('period_id', $period_id);
		$this->db->where('member_id', $member_id);
		if ( !empty($period_phase_id) ) 
			$this->db->where('period_phase_id', $period_phase_id);
			
		if ( !empty($receipt_id) )
			$this->db->where('id <>', $receipt_id);
		$this_period = $this->db->get()->row()->total_point;
		
		$response = new stdClass();
		$response->this_day    = $this_day;
		$response->this_period = $this_period;
		return $response;
	}
	
}