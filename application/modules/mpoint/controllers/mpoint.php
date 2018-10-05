<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// session_start(); //we need to call PHP's session object to access it through CI

class MPoint extends CI_Controller 
{
	private $mdl_grp = 'mpoint';
		
	function __construct() 
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('mpoint_model');
		$this->load->model('systems/systems_model');
		$this->load->helper('mpoint_function');
	}

	function index() 
	{
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		redirect('main', 'refresh');
	}
	
	function test()
	{
		// $data['total_point'] = 0;
		// $data['total_value'] = 0;
		
		$this->db->select_sum('value');
		$this->db->from('pnt_receipt_dt');
		$this->db->where('receipt_id', 2);
		// if ( !empty($row->payment_type_ids) ) $this->db->where_in( 'payment_type_id', explode(",", $row->payment_type_ids) );
		// if ( !empty($row->store_type_ids) )	$this->db->where_in( 'store_type_id', explode(",", $row->store_type_ids) );
		// if ( !empty($row->store_ids) ) $this->db->where_in( 'store_id', explode(",", $row->store_ids) );
		$pnt_receipt_dt = $this->db->get()->row();
		$data['total_point'] += floor($pnt_receipt_dt->value / 100000) * 1;
		$data['total_value'] += $pnt_receipt_dt->value;
		
		echo $data['total_point'];
		echo $data['total_value'];
	}
	
	// OPTIONS
	
	function adrs_1country( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'adrs_1country';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getAdrs_1Country($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function adrs_2province( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'adrs_2province';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['country_id']) )
				$params['where']['country_id'] = $params['country_id'];
			else
				$params['where']['country_id'] = 0;
			
			if ( !empty($params['q']) )
			{
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getAdrs_2Province($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function adrs_3city( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'adrs_3city';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['province_id']) )
				$params['where']['province_id'] = $params['province_id'];
			else
				$params['where']['province_id'] = 0;
			
			if ( !empty($params['q']) )
			{
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getAdrs_3City($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function adrs_4district( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'adrs_4district';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['city_id']) )
				$params['where']['city_id'] = $params['city_id'];
			else
				$params['where']['city_id'] = 0;
			
			if ( !empty($params['q']) )
			{
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getAdrs_4District($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function adrs_5village( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'adrs_5village';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['district_id']) )
				$params['where']['district_id'] = $params['district_id'];
			else
				$params['where']['district_id'] = 0;
			
			if ( !empty($params['q']) )
			{
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getAdrs_5Village($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_store_type( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_store_type';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Store_Type($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_store_floor( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_store_floor';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Store_Floor($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_store_block( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_store_block';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Store_Block($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_education_level( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_education_level';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Education_Level($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_home_status( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_home_status';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Home_Status($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_job_title( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_job_title';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Job_Title($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_marital_status( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_marital_status';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Marital_Status($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_nationality( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_nationality';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Nationality($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_occupation( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_occupation';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Occupation($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_payment_type( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_payment_type';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['cash_bank_id'] = $data['cash_bank_id'];
				$data1['code'] 	   	= strtoupper($data['code']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$this->db->insert('opt_payment_type', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['cash_bank_id'] = 1;	// 1=CASH
			
			if ( !empty($params['q']) )
			{
				$params['like']['opt.id'] = $params['q'];
				$params['like']['opt.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['opt.id'] = $params['findVal'];
					$params['like']['opt.name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Payment_Type($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['cash_bank_id'] = 1;
				$data1['code'] 	   	= strtoupper($data['code']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$this->db->update('opt_payment_type', $data1, array('id'=>$data['id']));
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// $pnt_receipt = $this->db->get_where( 'pnt_receipt', array('period_id'=>$data['id']) );
			// if ($pnt_receipt->num_rows() > 0)
				// crud_error("This Period has been using for transaction !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$data1['deleted']     = 1;
				// $data1['update_by']   = sesUser()->id;
				// $data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'opt_payment_type', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_religion( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_religion';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Religion($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_sex( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_sex';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Sex($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function opt_draw_status( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'opt_draw_status';
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['code'] = $params['findVal'];
					$params['like']['name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getOpt_Draw_Status($params) );
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	// MASTERS
	
	function pnt_period( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'pnt_period';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   	= strtoupper($data['code']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['date_from'] = db_date_format( $data['date_from'] );
				$data1['date_to']  	= db_date_format( $data['date_to'] );
				$data1['max_receipt_daily'] = $data['max_receipt_daily'];
				$data1['note'] 	   	= strtoupper($data['note']);
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$period = $this->mpoint_model->addNewPeriod( $data1 );
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['a0.code'] = $params['q'];
				$params['like']['a0.name'] = $params['q'];
				$params['like']['a0.note'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['a0.code'] = $params['findVal'];
					$params['like']['a0.name'] = $params['findVal'];
					$params['like']['a0.note'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getPnt_Period($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['name'] 	   	  = strtoupper($data['name']);
				$data1['date_from']   = db_date_format( $data['date_from'] );
				$data1['date_to']  	  = db_date_format( $data['date_to'] );
				$data1['max_receipt_daily'] = $data['max_receipt_daily'];
				$data1['note'] 	   	  = strtoupper($data['note']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_period', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$pnt_receipt = $this->db->get_where( 'pnt_receipt', array('period_id'=>$data['id']) );
			if ($pnt_receipt->num_rows() > 0)
				crud_error("This Period has been using for transaction !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$data1['deleted']     = 1;
				// $data1['update_by']   = sesUser()->id;
				// $data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_period', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'default' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$this->db->update( 'pnt_period', array('default'=>0), array('default'=>1) );
				$this->db->update( 'pnt_period', array('default'=>1), array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			$this->session->set_userdata( array('period_id'=>$data['id']) );
			crud_success();
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function pnt_period_phase( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'pnt_period_phase';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['period_id'] = $data['period_id'];
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['date_from'] = db_date_format( $data['date_from'] );
				$data1['date_to']  	= db_date_format( $data['date_to'] );
				$this->db->insert( 'pnt_period_phase', $data1 );
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			// if ( array_key_exists('period_id', $params) )
			if ( !empty($params['period_id']) )
				$params['where']['period_id'] = $params['period_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['a0.id']   = $params['q'];
				$params['like']['a0.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['a0.name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getPnt_Period_Phase($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['date_from'] = db_date_format( $data['date_from'] );
				$data1['date_to']  	= db_date_format( $data['date_to'] );
				$this->db->update( 'pnt_period_phase', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			$pnt_receipt = $this->db->get_where( 'pnt_draw', array('id'=>$data['id'], 'period_id'=>$data['period_id']) );
			if ($pnt_receipt->num_rows() > 0)
				crud_error("This Phase has been using for Draw !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$data1['deleted']     = 1;
				// $data1['update_by']   = sesUser()->id;
				// $data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_period_phase', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function pnt_period_rule( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'pnt_period_rule';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['period_id']  	  = $data['period_id'];
				$data1['period_phase_id'] = $data['period_phase_id'];
				$data1['coef_rate_value'] = $data['coef_rate_value'];
				$data1['coef_rate_point'] = $data['coef_rate_point'];
				$data1['payment_type_cond'] = $data['payment_type_cond'];
				$data1['store_type_cond'] = $data['store_type_cond'];
				$data1['store_cond'] 	  = $data['store_cond'];
				$data1['create_by']   	  = sesUser()->id;
				$data1['create_date'] 	  = date('Y-m-d H:i:s');
				$this->db->insert('pnt_period_rule', $data1);
				$id = $this->db->insert_id();
				
				$data1['payment_type'] = empty($data['payment_type']) ? NULL : explode(",", $data['payment_type']);
				$data1['store_type']   = empty($data['store_type']) ? NULL : explode(",", $data['store_type']);
				$data1['store'] 	   = empty($data['store']) ? NULL : explode(",", $data['store']);
				$this->shared_model->update_relation_n_n( 'pnt_period_rule_payment_type', 'period_rule_id', $id, 'payment_type_id', $data1['payment_type'] );
				$this->shared_model->update_relation_n_n( 'pnt_period_rule_store_type', 'period_rule_id', $id, 'store_type_id', $data1['store_type'] );
				$this->shared_model->update_relation_n_n( 'pnt_period_rule_store', 'period_rule_id', $id, 'store_id', $data1['store'] );
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( array_key_exists('period_id', $params) )
				$params['where']['a0.period_id'] = $params['period_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['s.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['s.name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getPnt_Period_Rule($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['period_id']  	  = $data['period_id'];
				$data1['period_phase_id'] = $data['period_phase_id'];
				$data1['coef_rate_value'] = $data['coef_rate_value'];
				$data1['coef_rate_point'] = $data['coef_rate_point'];
				$data1['payment_type_cond'] = $data['payment_type_cond'];
				$data1['store_type_cond'] = $data['store_type_cond'];
				$data1['store_cond'] 	  = $data['store_cond'];
				$data1['update_by']   	  = sesUser()->id;
				$data1['update_date'] 	  = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_period_rule', $data1, array('id'=>$data['id']) );
				
				$id = $data['id'];
				$data1['payment_type'] = empty($data['payment_type']) ? NULL : explode(",", $data['payment_type']);
				$data1['store_type']   = empty($data['store_type']) ? NULL : explode(",", $data['store_type']);
				$data1['store'] 	   = empty($data['store']) ? NULL : explode(",", $data['store']);
				$this->shared_model->update_relation_n_n( 'pnt_period_rule_payment_type', 'period_rule_id', $id, 'payment_type_id', $data1['payment_type'] );
				$this->shared_model->update_relation_n_n( 'pnt_period_rule_store_type', 'period_rule_id', $id, 'store_type_id', $data1['store_type'] );
				$this->shared_model->update_relation_n_n( 'pnt_period_rule_store', 'period_rule_id', $id, 'store_id', $data1['store'] );

			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$data1['deleted']     = 1;
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_period_rule', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function pnt_prize( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'pnt_prize';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['period_id']   = $data['period_id'];
				$data1['period_phase_id'] = $data['period_phase_id'];
				$data1['name']  	  = strtoupper($data['name']);
				$data1['sort']  	  = $data['sort'];
				$data1['qty']  	  	  = $data['qty'];
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('pnt_prize', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['period_id']) ) $params['where']['period_id'] = $params['period_id'];
			if ( !empty($params['phase_id']) ) $params['where']['phase_id']  = $params['phase_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['a0.name'] = $params['q'];
				$params['like']['p.name'] = $params['q'];
				$params['like']['pp.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['a0.name'] = $params['findVal'];
					$params['like']['p.name'] = $params['findVal'];
					$params['like']['pp.name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getPnt_Prize($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['period_id']   = $data['period_id'];
				$data1['period_phase_id'] = $data['period_phase_id'];
				$data1['name']  	  = strtoupper($data['name']);
				$data1['sort']  	  = $data['sort'];
				$data1['qty']  	  	  = $data['qty'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_prize', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			$qry = $this->db->get_where( 'pnt_period_rule', array('id'=>$data['id']) )->row();
			
			$pnt_receipt = $this->db->get_where( 'pnt_receipt', array('period_id'=>$qry->period_id, 'payment_type_id'=>$qry->payment_type_id) );
			if ($pnt_receipt->num_rows() > 0)
				crud_error("This Coef. Rate has been using by Receipt Transaction !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$data1['deleted']     = 1;
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_prize', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function member( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'member';
		
		if ( in_array($action, ['c', 'u']) ) {
			$data = $this->input->post();
			foreach($data as $k => $v)
				if ($v == '' || empty($v))
					$data[$k] = NULL;
		}
		
		if ( $action == 'c' ) {
			// $data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			if ( $this->shared_model->is_duplicate_code($mdl, $data['code_new']) ) 
				crud_error("error_duplicate_code");
					
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   				= strtoupper($data['code_new']);
				$data1['first_name'] 	   	  	= strtoupper($data['first_name']);
				$data1['last_name'] 	   	  	= strtoupper($data['last_name']);
				$data1['join_date']  			= db_date_format( $data['join_date'] );
				$data1['birth_place'] 			= strtoupper($data['birth_place']);
				$data1['birth_date'] 			= db_date_format( $data['birth_date'] );
				$data1['email'] 				= $data['email'];
				$data1['pin_bbm'] 				= strtoupper($data['pin_bbm']);
				$data1['home_phone'] 			= $data['home_phone'];
				$data1['hand_phone'] 			= $data['hand_phone'];
				$data1['mother_name'] 			= strtoupper($data['mother_name']);
				$data1['sex_id'] 				= $data['sex_id'];
				$data1['religion_id'] 			= $data['religion_id'];
				$data1['marital_status_id'] 	= $data['marital_status_id'];
				$data1['occupation_id'] 		= $data['occupation_id'];
				$data1['education_level_id'] 	= $data['education_level_id'];
				$data1['home_status_id'] 		= $data['home_status_id'];
				$data1['nationality_id'] 		= $data['nationality_id'];
				$data1['identity_no'] 			= strtoupper($data['identity_no']);
				$data1['passport_no'] 			= strtoupper($data['passport_no']);
				
				$data1['address'] 				= strtoupper($data['address']);
				$data1['address_village'] 		= $data['address_village'];
				$data1['address_district'] 		= $data['address_district'];
				$data1['address_regency'] 		= $data['address_regency'];
				$data1['address_province'] 		= $data['address_province'];
				$data1['address_country'] 		= $data['address_country'];
				$data1['address_postal_code'] 	= $data['address_postal_code'];
				$data1['company_name'] 			= strtoupper($data['company_name']);
				$data1['company_field'] 		= strtoupper($data['company_field']);
				$data1['company_phone'] 		= $data['company_phone'];
				$data1['company_fax'] 			= $data['company_fax'];
				$data1['company_department'] 	= strtoupper($data['company_department']);
				$data1['company_job_title'] 	= strtoupper($data['company_job_title']);
				$data1['fixed_income'] 			= $data['fixed_income'];
				$data1['other_income'] 			= $data['other_income'];
				$data1['create_by']   			= sesUser()->id;
				$data1['create_date'] 			= date('Y-m-d H:i:s');
				$this->db->insert('member', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($params) ) 
				crud_error("Error: Empty Data !");

			// ============= FILTER SECTION
			if ( !empty($params['date_f']) && !empty($params['date_t']) ) {
				$params['where']['join_date >='] = db_date_format($params['date_f']);
				$params['where']['join_date <='] = db_date_format($params['date_t']);
			}
			
			if ( array_key_exists('is_active', $params) )
				if ( $params['is_active'] !== 'ALL' )
					$params['where']['is_active'] = $params['is_active'];
				
			if ( !empty($params['q']) )
			{
				$params['like']['a0.id'] = $params['q'];
				$params['like']['a0.code'] = $params['q'];
				$params['like']['a0.first_name'] = $params['q'];
				$params['like']['a0.last_name'] = $params['q'];
				$params['like']['a0.identity_no'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['a0.id'] = $params['findVal'];
					$params['like']['a0.code'] = $params['findVal'];
					$params['like']['a0.first_name'] = $params['findVal'];
					$params['like']['a0.last_name'] = $params['findVal'];
					$params['like']['a0.identity_no'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getMember($params) );
		}
		
		if ( $action == 'u' ) {
			// $data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code($mdl, $data['code_new']) ) 
					crud_error("error_duplicate_code");
					
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$data1['first_name'] 	   	  	= strtoupper($data['first_name']);
				$data1['last_name'] 	   	  	= strtoupper($data['last_name']);
				$data1['join_date']  			= db_date_format( $data['join_date'] );
				$data1['birth_place'] 			= strtoupper($data['birth_place']);
				$data1['birth_date'] 			= db_date_format( $data['birth_date'] );
				$data1['email'] 				= $data['email'];
				$data1['pin_bbm'] 				= strtoupper($data['pin_bbm']);
				$data1['home_phone'] 			= $data['home_phone'];
				$data1['hand_phone'] 			= $data['hand_phone'];
				$data1['mother_name'] 			= strtoupper($data['mother_name']);
				$data1['sex_id'] 				= $data['sex_id'];
				$data1['religion_id'] 			= $data['religion_id'];
				$data1['marital_status_id'] 	= $data['marital_status_id'];
				$data1['occupation_id'] 		= $data['occupation_id'];
				$data1['education_level_id'] 	= $data['education_level_id'];
				$data1['home_status_id'] 		= $data['home_status_id'];
				$data1['nationality_id'] 		= $data['nationality_id'];
				$data1['identity_no'] 			= strtoupper($data['identity_no']);
				$data1['passport_no'] 			= strtoupper($data['passport_no']);
				
				$data1['address'] 				= strtoupper($data['address']);
				$data1['address_village'] 		= $data['address_village'];
				$data1['address_district'] 		= $data['address_district'];
				$data1['address_regency'] 		= $data['address_regency'];
				$data1['address_province'] 		= $data['address_province'];
				$data1['address_country'] 		= $data['address_country'];
				$data1['address_postal_code'] 	= $data['address_postal_code'];
				$data1['company_name'] 			= strtoupper($data['company_name']);
				$data1['company_field'] 		= strtoupper($data['company_field']);
				$data1['company_phone'] 		= $data['company_phone'];
				$data1['company_fax'] 			= $data['company_fax'];
				$data1['company_department'] 	= strtoupper($data['company_department']);
				$data1['company_job_title'] 	= strtoupper($data['company_job_title']);
				$data1['fixed_income'] 			= $data['fixed_income'];
				$data1['other_income'] 			= $data['other_income'];
				$data1['update_by']   			= sesUser()->id;
				$data1['update_date'] 			= date('Y-m-d H:i:s');
				$this->db->update( 'member', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// $pnt_receipt = $this->db->get_where( 'pnt_receipt', array('member_id'=>$data['id']) );
			// if ($pnt_receipt->num_rows() > 0)
				// crud_error("Cannot be delete, because this Member has already data on Receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$data1['deleted']     = 1;
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'member', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'active' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->query('UPDATE member SET is_active = not is_active WHERE id = '.$data['id']);
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'listing' ) {
			$params = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($params) ) 
				crud_error("Error: Empty Data !");
			
			setcookie("fileDownload", "true", time()-3600);
			// ============= FILTER SECTION
			if ( !empty($params['date_f']) && !empty($params['date_t']) ) {
				$params['where']['join_date >='] = db_date_format($params['date_f']);
				$params['where']['join_date <='] = db_date_format($params['date_t']);
			}
			
			if ( $params['is_active'] !== 'ALL' )
				$params['where']['is_active'] = $params['is_active'];
				
			if ( !empty($params['q']) )
			{
				$params['like']['a0.id'] = $params['q'];
				$params['like']['a0.code'] = $params['q'];
				$params['like']['a0.first_name'] = $params['q'];
				$params['like']['a0.last_name'] = $params['q'];
				$params['like']['a0.identity_no'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['a0.id'] = $params['findVal'];
					$params['like']['a0.code'] = $params['findVal'];
					$params['like']['a0.first_name'] = $params['findVal'];
					$params['like']['a0.last_name'] = $params['findVal'];
					$params['like']['a0.identity_no'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			$qry = $this->mpoint_model->getMember_List($params);
			
			if ($params['output_type']==1)
				export_to_xls($qry, 'Member_Listing');
			else
				export_to_pdf($qry, 'Member_Listing', 'A3', FALSE);
				
			exit;
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function store( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'store';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// if ( $this->shared_model->is_duplicate_code($mdl, $data['code_new']) ) 
				// crud_error("error_duplicate_code");
				
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				// $data1['code'] 	   	  	 = strtoupper($data['code_new']);
				$data1['name'] 	   	  	 = strtoupper($data['name']);
				$data1['store_type_id']  = $data['store_type_id'];
				$data1['store_floor_id'] = $data['store_floor_id'];
				$data1['store_block_id'] = $data['store_block_id'];
				$data1['note'] 	   	  	 = strtoupper($data['note']);
				$data1['create_by']   	 = sesUser()->id;
				$data1['create_date'] 	 = date('Y-m-d H:i:s');
				$this->db->insert('store', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['a0.id'] = $params['q'];
				$params['like']['a0.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['a0.id'] = $params['findVal'];
					$params['like']['a0.name'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getStore($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// if ( $data['code'] != $data['code_new'] ) 
				// if ( $this->shared_model->is_duplicate_code($mdl, $data['code_new']) ) 
					// crud_error("error_duplicate_code");
				
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				// $data1['code'] 	   	  	 = strtoupper($data['code_new']);
				$data1['name'] 	   	  	 = strtoupper($data['name']);
				$data1['store_type_id']  = $data['store_type_id'];
				$data1['store_floor_id'] = $data['store_floor_id'];
				$data1['store_block_id'] = $data['store_block_id'];
				$data1['note'] 	   	  	 = strtoupper($data['note']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'store', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$data1['deleted']     = 1;
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'store', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	// TRANSACTIONS
	
	function pnt_receipt( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'pnt_receipt';
                                
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['period_id']   = $data['period_id'];
				$data1['period_phase_id'] = $data['period_phase_id'];
				$data1['member_id']   = $data['member_id'];
				$data1['date'] 		  = db_date_format($data['date']);
				$data1['note'] 	   	  = strtoupper($data['note']);
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('pnt_receipt', $data1);
				$result['id'] = $this->db->insert_id();
				
				$this->mpoint_model->update_point_and_value($result['id']);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success($result);
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			// ============= FILTER SECTION
			$params['where']['a0.period_id'] = mpoint_period_default()->id;
			
			if ( !empty($params['date_f']) && !empty($params['date_t']) ) {
				$params['where']['date >='] = db_date_format($params['date_f']);
				$params['where']['date <='] = db_date_format($params['date_t']);
			}
			
			if ( !empty($params['q']) )
			{
				$params['like']['a0.id'] = $params['q'];
				$params['like']['pp.name'] = $params['q'];
				$params['like']['opt.name'] = $params['q'];
				$params['like']['s.name'] = $params['q'];
				$params['like']['m.first_name'] = $params['q'];
				$params['like']['m.last_name'] = $params['q'];
				$params['like']['m.identity_no'] = $params['q'];
				$params['like']['a0.note'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['a0.id'] = $params['findVal'];
					$params['like']['pp.name'] = $params['findVal'];
					$params['like']['opt.name'] = $params['findVal'];
					$params['like']['s.name'] = $params['findVal'];
					$params['like']['m.first_name'] = $params['findVal'];
					$params['like']['m.last_name'] = $params['findVal'];
					$params['like']['m.identity_no'] = $params['findVal'];
					$params['like']['a0.note'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getPnt_Receipt($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['period_id']   = $data['period_id'];
				$data1['period_phase_id'] = $data['period_phase_id'];
				$data1['member_id']   = $data['member_id'];
				$data1['date'] 		  = db_date_format($data['date']);
				$data1['note'] 	   	  = strtoupper($data['note']);
				$data1['update_by'] 	  = sesUser()->id;
				$data1['update_date']  = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_receipt', $data1, array('id'=>$data['id']) );
			
				$this->mpoint_model->update_point_and_value($data['id']);
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$data1['deleted'] 	  = 1;
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_receipt', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function pnt_receipt_dt( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'pnt_receipt';
                                
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['receipt_id']   	  = $data['receipt_id'];
				$data1['payment_type_id'] = $data['payment_type_id'];
				$data1['store_id']   	  = $data['store_id'];
				$data1['store_type_id']   = $this->mpoint_model->getStore_ById($data['store_id'])->store_type_id;
				$data1['value']   		  = $data['value'];
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('pnt_receipt_dt', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			// ============= FILTER SECTION
			$params['where']['a0.receipt_id'] = $params['receipt_id'];
			
			crud_result( $this->mpoint_model->getPnt_Receipt_Dt($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['payment_type_id'] = $data['payment_type_id'];
				$data1['store_id']   	  = $data['store_id'];
				$data1['store_type_id']   = $this->mpoint_model->getStore_ById($data['store_id'])->store_type_id;
				$data1['value']   		  = $data['value'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_receipt_dt', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['deleted'] 	  = 1;
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_receipt_dt', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
	}

	function pnt_draw( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'pnt_draw';
                                
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['period_id']   = $data['period_id'];
				$data1['phase_id']    = $data['phase_id'];
				$data1['prize_id']    = $data['prize_id'];
				$data1['number']   	  = $data['number'];
				$data1['member_id']   = $data['member_id'];
				$data1['coupon_no']   = $data['coupon_no'];
				$data1['show_screen'] = array_key_exists('show_screen', $data) ? 1 : 0;
				$data1['status_id']   = $data['status_id'];
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('pnt_draw', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['d.period_id'] = mpoint_period_default()->id;
			
			if ( !empty($params['q']) )
			{
				$params['like']['m.code'] = $params['q'];
				$params['like']['m.name'] = $params['q'];
				$params['like']['m.identity_no'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['m.code'] = $params['findVal'];
					$params['like']['m.name'] = $params['findVal'];
					$params['like']['m.identity_no'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];
			
			crud_result( $this->mpoint_model->getPnt_Draw($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['period_id']   = $data['period_id'];
				$data1['phase_id']    = $data['phase_id'];
				$data1['prize_id']    = $data['prize_id'];
				$data1['number']   	  = $data['number'];
				$data1['member_id']   = $data['member_id'];
				$data1['coupon_no']   = $data['coupon_no'];
				$data1['show_screen'] = array_key_exists('show_screen', $data) ? 1 : 0;
				$data1['status_id']   = $data['status_id'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_draw', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$data1['deleted']     = 1;
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'pnt_draw', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'preview_draw' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$period = $this->db->get_where( 'pnt_period', array('id'=>$data['period_id2']) );
			if ( $period->num_rows() > 0 ) {
				$sess['period_id'] 	 = $period->row()->id;
				$sess['period_name'] = $period->row()->name;
			}
			
			$phase = $this->db->get_where( 'pnt_period_phase', array('id'=>$data['phase_id2']) );
			if ( $period->num_rows() > 0 ) {
				$sess['phase_id'] 	= $phase->row()->id;
				$sess['phase_name'] = $phase->row()->name;
			}
			
			$this->session->set_userdata($sess);
			
			crud_success();
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function pnt_report( $action=NULL )
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	= 'pnt_report';
                                
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}
	
	function preview_draw() 
	{
		$this->load->view('mpoint/preview_draw');
	}
	
	function preview_winner() 
	{
		$this->load->view('lottery/preview_winner');
	}

	// FUNCTION

	function check_point()
	{
		$params = $this->input->post();
		
		// ============= VALIDITY SECTION
		if ( empty($params) ) 
			crud_error("Error: Empty Data !");
			
		$result = (array) $this->mpoint_model->check_point($params['period_id'], $params['period_phase_id'], $params['member_id'], db_date_format($params['date']));
		crud_success( $result );
	}
		
	function get_active_period() 
	{
		
		$period 	  = $this->mpoint_model->getPnt_Period_ById( $this->session->userdata('period_id') );
		$period_phase = $this->mpoint_model->getPnt_Period_Phase_ById( $this->session->userdata('phase_id') );
			
		$data['success']	 	 = 1;
		$data['period_id'] 	 	 = ($period) ? $period->id : 0;
		$data['period_name'] 	 = ($period) ? $period->name : '';
		$data['phase_id'] 	 	 = ($period_phase) ? $period_phase->id : 0;
		$data['phase_name']  	 = ($period_phase) ? $period_phase->name : '';
		$data['coef_rate_value'] = ($period) ? $period->coef_rate_value : 0;
		$data['coef_rate_point'] = ($period) ? $period->coef_rate_point : 0;
		echo json_encode($data);
	}

	// REPORTS
}