<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// session_start(); //we need to call PHP's session object to access it through CI

class Billm extends CI_Controller {

	private $mdl_grp = 'billm';
		
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('billm_model');
		// $this->load->model('shared/shared_model');
		$this->load->model('systems/systems_model');
	}

	function index() {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		redirect('main', 'refresh');
	}

	function get_period_active() {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		$params = $this->input->post();
		
		$params['where']['posted'] = 0;
		
		if ( !empty($params['q']) )
		{
			$params['like']['p.id']  = $params['q'];
			$params['like']['p.code'] = $params['q'];
			$params['like']['p.name'] = $params['q'];
		}	
		
		crud_result( $this->billm_model->getPeriod($params) );
	}

	function set_period_active() {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		$data = $this->input->post();
		if ( empty($data) ) 
			return;
			
		$this->session->set_userdata($data);
	}

	function opt_charge_type( $action=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
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

			crud_result( $this->billm_model->getOpt_Charge_Type($params) );
		}
	}

	function opt_invoice_type( $action=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');

		$mdl 	 = 'opt_invoice_type';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $this->shared_model->is_duplicate_code('opt_invoice_type', $data['code_new']) ) 
				crud_error("error_duplicate_code");
				
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$count = $this->db->count_all_results('opt_invoice_type');
				
				$data1['code'] = strtoupper($data['code_new']);
				$data1['name'] = strtoupper($data['name']);
				$data1['coa_d'] = $data['coa_d'];
				$data1['coa_c'] = $data['coa_c'];
				$data1['sort_no'] = $count + 1;
				$data1['auto'] = 0;
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('opt_invoice_type', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['auto'] = 0;
			
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

			crud_result( $this->billm_model->getOpt_Invoice_Type($params) );
		}

		if ( $action == 'u' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('unit', $data['code_new']) ) 	
					crud_error("error_duplicate_code");
					
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$count = $this->db->count_all_results('opt_invoice_type');
				
				$data1['code'] = strtoupper($data['code_new']);
				$data1['name'] = strtoupper($data['name']);
				$data1['coa_d'] = $data['coa_d'];
				$data1['coa_c'] = $data['coa_c'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update('opt_invoice_type', $data1, array('id'=>$data['id']));
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('opt_invoice_type', array('id'=>$data['id']));
			if ($qry->row()->auto) crud_error('Error: Protected!');
			
			
			$count = $this->db->where('invoice_type_id', $data['id'])->count_all_results('invoice_dt');
			if ($count > 0)
				crud_error("Error: This data has transaction!");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'opt_invoice_type', array('id'=>$data['id']) );
				
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

	function opt_factor( $action=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
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

			crud_result( $this->billm_model->getOpt_Factor($params) );
		}
	}

	function period( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'period';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code']		  = $data['period_year'].'-'.$data['period_month'];
				$data1['period_year'] = $data['period_year'];
				$data1['period_month'] = $data['period_month'];
				$data1['date_begin']  = db_date_format( mktime (0, 0, 0, $data['period_month'], 1, $data['period_year']) );
				$data1['date_end'] 	  = db_date_format( mktime (0, 0, 0, $data['period_month'], date('t'), $data['period_year']) );
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$result = $this->billm_model->addNewPeriod($data1);
				
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
				$params['like']['p.id']  = $params['q'];
				$params['like']['p.code'] = $params['q'];
				$params['like']['p.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['p.id']  = $params['findVal'];
					$params['like']['p.code'] = $params['findVal'];
					$params['like']['p.name'] = $params['findVal'];
				} 
				else
					$params['like']['p.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->billm_model->getPeriod($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				// $data1['name'] 	   	= strtoupper($data['name']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'period', $data1, array('id'=>$data['id']) );
				
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
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				// $this->db->delete( 'period', array('id'=>$data['id']) );
				
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

	function bill_setup( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'bill_setup';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['desc'] 	   	= strtoupper($data['desc']);
				$data1['sqm'] 	   	= $data['sqm'];
				$data1['watt'] 	   	= $data['watt'];
				$data1['power_bill'] = $data['power_bill'];
				$data1['water_bill'] = $data['water_bill'];
				$data1['service_bill'] = $data['service_bill'];
				$data1['bill_date'] = $data['bill_date'];
				$data1['bill_due'] = $data['bill_due'];
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('unit', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['u.id']   = $params['findVal'];
					$params['like']['u.code'] = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
					$params['like']['u.desc'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
					
			$this->load->model('assetm/assetm_model');
			crud_result( $this->assetm_model->getUnit($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('unit', $data['code_new']) ) 	
					crud_error("error_duplicate_code");
					
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['desc'] 	   	= strtoupper($data['desc']);
				$data1['sqm'] 	   	= $data['sqm'];
				$data1['watt'] 	   	= $data['watt'];
				$data1['power_bill'] = $data['power_bill'];
				$data1['water_bill'] = $data['water_bill'];
				$data1['service_bill'] = $data['service_bill'];
				$data1['bill_date'] = $data['bill_date'];
				$data1['bill_due'] = $data['bill_due'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'unit', $data1, array('id'=>$data['id']) );
				
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
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'unit', array('id'=>$data['id']) );
				
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

	function bill_setup_power( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'bill_setup_power';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] = $data['unit_id'];
				$data1['power_id'] = $data['power_id'];
				$this->db->insert('unit_power_setup', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['unit_id'] = $params['unit_id'];
			
			crud_result( $this->billm_model->getUnit_Power_Setup($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] = $data['unit_id'];
				$data1['power_id'] = $data['power_id'];
				$this->db->update( 'unit_power_setup', $data1, array('id'=>$data['id']) );
				
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
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'unit_power_setup', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}

	function bill_setup_water( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'bill_setup_water';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] = $data['unit_id'];
				$data1['water_id'] = $data['water_id'];
				$this->db->insert('unit_water_setup', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['unit_id'] = $params['unit_id'];
			
			crud_result( $this->billm_model->getUnit_Water_Setup($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] = $data['unit_id'];
				$data1['water_id'] = $data['water_id'];
				$this->db->update( 'unit_water_setup', $data1, array('id'=>$data['id']) );
				
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
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'unit_water_setup', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}

	function bill_setup_service( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'bill_setup_service';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] = $data['unit_id'];
				$data1['service_id'] = $data['service_id'];
				$data1['date_begin'] = db_date_format($data['date_begin']);
				$data1['date_end'] = db_date_format($data['date_end']);
				$this->db->insert('unit_service_setup', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['unit_id'] = $params['unit_id'];
			
			crud_result( $this->billm_model->getUnit_Service_Setup($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] = $data['unit_id'];
				$data1['service_id'] = $data['service_id'];
				$data1['date_begin'] = db_date_format($data['date_begin']);
				$data1['date_end'] = db_date_format($data['date_end']);
				$this->db->update( 'unit_service_setup', $data1, array('id'=>$data['id']) );
				
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
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'unit_service_setup', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}

	function bill_setup_others( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'bill_setup_others';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		 = $data['unit_id'];
				$data1['others_id'] 	 = $data['others_id'];
				$data1['charge_type_id'] = $data['charge_type_id'];
				$data1['note'] 			 = strtoupper($data['note']);
				$data1['date_begin'] 	 = db_date_format($data['date_begin']);
				$data1['date_end'] 		 = db_date_format($data['date_end']);
				$data1['tariff'] 		 = $data['tariff'];
				$data1['factor_id'] 	 = $data['factor_id'];
				$data1['bill_period'] 	 = $data['bill_period'];
				$data1['coa_d'] 	 	 = $data['coa_d'];
				$data1['coa_c'] 	 	 = $data['coa_c'];
				$this->db->insert('unit_others_setup', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['unit_id'] = $params['unit_id'];
			
			crud_result( $this->billm_model->getUnit_Others_Setup($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		 = $data['unit_id'];
				$data1['others_id'] 	 = $data['others_id'];
				$data1['charge_type_id'] = $data['charge_type_id'];
				$data1['note'] 			 = strtoupper($data['note']);
				$data1['date_begin'] 	 = db_date_format($data['date_begin']);
				$data1['date_end'] 		 = db_date_format($data['date_end']);
				$data1['tariff'] 		 = $data['tariff'];
				$data1['factor_id'] 	 = $data['factor_id'];
				$data1['bill_period'] 	 = $data['bill_period'];
				$data1['coa_d'] 	 	 = $data['coa_d'];
				$data1['coa_c'] 	 	 = $data['coa_c'];
				$this->db->update( 'unit_others_setup', $data1, array('id'=>$data['id']) );
				
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
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'unit_others_setup', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}

	function bill_setup_parking( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'bill_setup_parking';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] = $data['unit_id'];
				$data1['parking_id'] = $data['parking_id'];
				$this->db->insert('unit_parking_setup', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['unit_id'] = $params['unit_id'];
			
			crud_result( $this->billm_model->getUnit_Parking_Setup($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] = $data['unit_id'];
				$data1['parking_id'] = $data['parking_id'];
				$this->db->update( 'unit_parking_setup', $data1, array('id'=>$data['id']) );
				
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
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'unit_parking_setup', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}

	function bill_calc( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'bill_calc';
		
		if ( $action == 'retrieve' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$this->billm_model->procRetrievePower( $data['period_id'] );
				
				$this->billm_model->procRetrieveWater( $data['period_id'] );
				
				$this->billm_model->procRetrieveService( $data['period_id'] );
				
				$this->billm_model->procRetrieveOthers( $data['period_id'] );
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'calculate' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$this->billm_model->procCalculatePower( $data['period_id'] );
				
				$this->billm_model->procCalculateWater( $data['period_id'] );
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'generate' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$this->billm_model->procGenerateInvoice( $data['period_id'] );
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'posting' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$result = $this->billm_model->procPostingInvoice( $data['period_id'], 1 );
				if ( $result !== TRUE  )
					crud_error($result['errorMsg']);
					
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

	function bill_calc_power( $action=NULL, $period_id=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	   = 'bill_calc_power';
		sesUser()->id   = $this->session->userdata('user_id');
		$period_id = $this->session->userdata('period_id');
		
		/* if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				// $data1['unit_id'] = $data['unit_id'];
				// $data1['power_id'] = $data['power_id'];
				// $data1['last_value'] = $data['last_value'];
				$this->db->insert('unit_power_calc', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		} */
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['period_id'] = $params['period_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['c.code'] = $params['q'];
				$params['like']['c.name'] = $params['q'];
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['c.code']  = $params['findVal'];
					$params['like']['c.name'] = $params['findVal'];
					$params['like']['u.code']  = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->billm_model->getUnit_Power_Calc($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['curr_value']  = $data['curr_value'];
				$data1['usage_value'] = $data['curr_value'] - $data['last_value'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'unit_power_calc', $data1, array('id'=>$data['id']) );
				
				$this->billm_model->procCalculatePower($data['period_id'], $data['unit_id'], $data['power_id'], $data['customer_id'], TRUE);
				
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
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'unit_power_calc', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'download' ) {

			$this->billm_model->export_data_calc('power', $period_id);
		}
		
		if ( $action == 'upload' ) {

			$this->db->trans_begin();
			try {
			
				$filepath = NULL;
				$filename = NULL;
				if ( isset($_FILES['userfile']) ) 
				{
					$filepath = "./attachments/";
					if ( !is_dir($filepath) )
						if ( !mkdir($filepath, 0777, true) ) 	// mkdir if not exists
							crud_error("Error: Failed to create folders...! !");
							
					$config['upload_path'] 	 = $filepath;
					$config['allowed_types'] = 'xls|xlsx';
					$config['max_size']		 = '8120';
					$config['overwrite']	 = true;
					$this->load->library('upload', $config);
					$result_upload = $this->upload->do_upload('userfile');
					if ( !$result_upload ) 
						crud_error( $this->upload->display_errors('', '') );
					
					$upload_data = $this->upload->data();	// get data from upload library
					$filename 	 = $upload_data['file_name'];
					$full_path	 = $upload_data['full_path'];
				}

				$result = $this->billm_model->import_power($full_path);
				if ( ! $result['success'] )
					crud_error($result['errorMsg']);
			
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			// $this->shared_model->set_comet('phd_files');
			crud_success();
		}
		
	}
	
	function bill_calc_water( $action=NULL, $period_id=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'bill_calc_water';
		
		/* if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				// $data1['unit_id'] = $data['unit_id'];
				// $data1['water_id'] = $data['water_id'];
				// $data1['last_value'] = $data['last_value'];
				$this->db->insert('unit_water_calc', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		} */
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['period_id'] = $params['period_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['c.code'] = $params['q'];
				$params['like']['c.name'] = $params['q'];
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['c.code']  = $params['findVal'];
					$params['like']['c.name'] = $params['findVal'];
					$params['like']['u.code']  = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->billm_model->getUnit_Water_Calc($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['curr_value'] = $data['curr_value'];
				$data1['usage_value'] = $data['curr_value'] - $data['last_value'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'unit_water_calc', $data1, array('id'=>$data['id']) );
				
				$this->billm_model->procCalculateWater($data['period_id'], $data['unit_id'], $data['water_id'], $data['customer_id'], TRUE);
				
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
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'unit_water_calc', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'download' ) {

			$this->billm_model->export_data_calc('water', $period_id);
		}
		
		if ( $action == 'upload' ) {

			$this->db->trans_begin();
			try {
			
				$filepath = NULL;
				$filename = NULL;
				if ( isset($_FILES['userfile']) ) 
				{
					$filepath = "./attachments/";
					if ( !is_dir($filepath) )
						if ( !mkdir($filepath, 0777, true) ) 	// mkdir if not exists
							crud_error("Error: Failed to create folders...! !");
							
					$config['upload_path'] 	 = $filepath;
					$config['allowed_types'] = 'xls|xlsx';
					$config['max_size']		 = '8120';
					$config['overwrite']	 = true;
					$this->load->library('upload', $config);
					$result_upload = $this->upload->do_upload('userfile');
					if ( !$result_upload ) 
						crud_error( $this->upload->display_errors('', '') );
					
					$upload_data = $this->upload->data();	// get data from upload library
					$filename 	 = $upload_data['file_name'];
					$full_path	 = $upload_data['full_path'];
				}

				$result = $this->billm_model->import_water($full_path);
				if ( ! $result['success'] )
					crud_error($result['errorMsg']);
			
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			// $this->shared_model->set_comet('phd_files');
			crud_success();
		}
		
	}

	function bill_calc_service( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'bill_calc_service';
		
		/* if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				// $data1['unit_id'] = $data['unit_id'];
				// $data1['service_id'] = $data['service_id'];
				// $data1['last_value'] = $data['last_value'];
				$this->db->insert('unit_service_calc', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		} */
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['period_id'] = $params['period_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['c.code'] = $params['q'];
				$params['like']['c.name'] = $params['q'];
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['c.code']  = $params['findVal'];
					$params['like']['c.name'] = $params['findVal'];
					$params['like']['u.code']  = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->billm_model->getUnit_Service_Calc($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] = $data['unit_id'];
				$data1['service_id'] = $data['service_id'];
				$data1['last_value'] = $data['last_value'];
				$this->db->update( 'unit_service_calc', $data1, array('id'=>$data['id']) );
				
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
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'unit_service_calc', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}

	function bill_calc_others( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'bill_calc_others';
		
		/* if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				// $data1['unit_id'] = $data['unit_id'];
				// $data1['others_id'] = $data['others_id'];
				// $data1['last_value'] = $data['last_value'];
				$this->db->insert('unit_others_calc', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		} */
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['period_id'] = $params['period_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['c.code'] = $params['q'];
				$params['like']['c.name'] = $params['q'];
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['c.code']  = $params['findVal'];
					$params['like']['c.name'] = $params['findVal'];
					$params['like']['u.code']  = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->billm_model->getUnit_Others_Calc($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] = $data['unit_id'];
				$data1['others_id'] = $data['others_id'];
				$data1['last_value'] = $data['last_value'];
				$this->db->update( 'unit_others_calc', $data1, array('id'=>$data['id']) );
				
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
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'unit_others_calc', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}

	function invoice( $action=NULL, $auto=1 ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'invoice';
		$period_id = $this->session->userdata('period_id');
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$period = $this->billm_model->getPeriod_ById($period_id);
				
				$data1['period_id']   = $period_id;
				$data1['date_from']   = $period->date_begin;
				$data1['date_to'] 	  = $period->date_end;
				$data1['code'] 	  	  = 'AUTO';
				$data1['auto'] 	  	  = 0;
				
				$data1['unit_id'] 	  = $data['unit_id'];
				$data1['customer_id'] = $data['customer_id'];
				if ( array_key_exists('charge_type_id', $data) ) $data1['charge_type_id'] = $data['charge_type_id'];
				if ( array_key_exists('viracc', $data) ) $data1['viracc'] = $data['viracc'];
				$data1['date'] 	  	  = db_date_format($data['date']);
				$data1['due_date'] 	  = add_date(NULL, $data['date'], $this->billm_model->config()->due_days);
				$data1['note'] 	  	  = strtoupper($data['note']);
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$invoice = $this->billm_model->addNewInvoice( $data1 );
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success($invoice);
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['auto'] = $auto;
			
			if ( !empty($params['period_id']) ) $params['where']['period_id'] = $params['period_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['c.code'] = $params['q'];
				$params['like']['c.name'] = $params['q'];
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['c.code']  = $params['findVal'];
					$params['like']['c.name'] = $params['findVal'];
					$params['like']['u.code']  = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->billm_model->getInvoice($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('invoice', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 	  = $data['unit_id'];
				$data1['customer_id'] = $data['customer_id'];
				if ( array_key_exists('charge_type_id', $data) ) $data1['charge_type_id'] = $data['charge_type_id'];
				if ( array_key_exists('viracc', $data) ) $data1['viracc'] = $data['viracc'];
				$data1['date'] 	  	  = db_date_format($data['date']);
				$data1['due_date'] 	  = add_date(NULL, $data['date'], $this->billm_model->config()->due_days);
				$data1['note'] 	  	  = strtoupper($data['note']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'invoice', $data1, array('id'=>$data['id']) );
				
				$this->billm_model->updateInvoiceBalanceAmount(NULL, $data['id']);
				
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
			
			$qry = $this->db->get_where('invoice', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$this->db->delete( 'invoice_dt', array('invoice_id'=>$data['id']) );
				$this->db->delete( 'invoice', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'v' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('invoice', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['void'] 		  = 1;
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'invoice', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'p' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('invoice', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$result = $this->billm_model->procPostingInvoice( $qry->period_id, 0, $data['id'] );
				if ( $result !== TRUE  )
					crud_error($result['errorMsg']);
					
				$data1['posted'] 	  = 1;
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'invoice', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'up' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('invoice', array('id'=>$data['id']));
			if (!$qry->row()->posted) crud_error('error_data_unposted');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['posted'] 	  = 0;
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'invoice', $data1, array('id'=>$data['id']) );
				
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

	function invoice_dt( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'invoice';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('invoice', array('id'=>$data['invoice_id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['invoice_id'] = $data['invoice_id'];
				if ( array_key_exists('invoice_type_id', $data) ) $data1['invoice_type_id'] = $data['invoice_type_id'];
				if ( array_key_exists('ref_id', $data) ) $data1['ref_id'] = $data['ref_id'];
				$data1['note'] 		 = strtoupper($data['note']);
				$data1['coa_d'] 	 = $data['coa_d'];
				$data1['coa_c'] 	 = $data['coa_c'];
				$data1['amount'] 	 = $data['amount'];
				$this->db->insert('invoice_dt', $data1);
				
				$this->billm_model->updateInvoiceBalanceAmount(NULL, $data['invoice_id']);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['invoice_id'] = $params['invoice_id'];
			
			$result = $this->billm_model->getInvoice_Dt($params);
			
			// ADDING FOOTER
			$total_amount = 0;
			foreach ($result->rows as $row)
			{
				$total_amount += $row->amount;
			}
			$footer[0]['note']   = 'TOTAL';
			$footer[0]['amount'] = $total_amount;
			
			$result->footer = $footer;
			crud_result($result);
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('invoice_dt', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['invoice_id'] = $data['invoice_id'];
				if ( array_key_exists('invoice_type_id', $data) ) $data1['invoice_type_id'] = $data['invoice_type_id'];
				if ( array_key_exists('ref_id', $data) ) $data1['ref_id'] = $data['ref_id'];
				$data1['note'] 		 = strtoupper($data['note']);
				$data1['coa_d'] 	 = $data['coa_d'];
				$data1['coa_c'] 	 = $data['coa_c'];
				$data1['amount'] 	 = $data['amount'];
				$this->db->update( 'invoice_dt', $data1, array('id'=>$data['id']) );
				
				$this->billm_model->updateInvoiceBalanceAmount(NULL, $data['invoice_id']);
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'u2' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$data = json_decode($data['data']);
				
			$qry = $this->db->get_where('invoice_dt', array('id'=>$data[0]->id));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['invoice_type_id'] = $data[0]->invoice_type_id;
				if ( array_key_exists('ref_id', $data) ) $data1['ref_id'] = $data[0]->ref_id;
				$data1['note'] 			  = strtoupper($data[0]->note);
				$data1['coa_d'] 		  = $data[0]->coa_d;
				$data1['coa_c'] 		  = $data[0]->coa_c;
				$data1['amount'] 		  = $data[0]->amount;
				$this->db->update( 'invoice_dt', $data1, array('id'=>$data[0]->id) );
				
				$this->billm_model->updateInvoiceBalanceAmount(NULL, $data[0]->invoice_id);
				
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
			
			$qry = $this->db->get_where('invoice_dt', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				$this->db->delete( 'invoice_dt', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}

	function form_invoice_auto( $period_id, $id=NULL, $void=NULL ) {
		
		$company_id = $this->session->userdata('company_id');
		
		$filter['i.period_id']  = $period_id;
		if ( !empty($id) ) $filter['i.id'] = $id;
		if ( isset($void) ) $filter['void'] = $void;

		// ob_end_clean();
		$this->db->select( 'i.*, 
			p.name AS period_name, u.name AS unit_name, 
			c.name AS customer_name, c.contact_person, c.address, c.phone, c.fax, c.bill_address, c.bill_phone, c.bill_fax, 
			oc.name as charge_type_name, 
			id.invoice_type_id, id.ref_id, id.note, id.amount, 
			oit.name as invoice_type_name');
		$this->db->from('invoice as i');
		$this->db->join('invoice_dt as id', 'i.id = id.invoice_id', 'left');
		$this->db->join('period as p', 'i.period_id = p.id', 'left');
		$this->db->join('unit as u', 'i.unit_id = u.id', 'left');
		$this->db->join('customer as c', 'i.customer_id = c.id', 'left');
		$this->db->join('opt_charge_type as oc', 'i.charge_type_id = oc.id', 'left');
		$this->db->join('opt_invoice_type as oit', 'id.invoice_type_id = oit.id', 'left');
		$this->db->where($filter);
		$this->db->order_by('u.code', 'asc');
		$query = $this->db->get();
		if ($query->num_rows() < 1) 
			return;
		
		$company = $this->db->get_where('company', array('id'=>$company_id))->row();
		
		$this->load->library('mpdf');
		$mpdf = new mPDF('utf-8','A4', 0, 'Courier');
		$mpdf->SetTitle("$company->name - Invoice");
		$mpdf->SetAuthor($company->name);
		
		$html_head = '
		<html><head>
		<style>
		body {font-family: Courier;
			font-size: 10pt;
		}
		p {    margin: 0pt;		}
		td { vertical-align: top; }
		.items td {
			border-left: 0.1mm solid #000000;
			border-right: 0.1mm solid #000000;
		}
		.top-border {
			border-top: 0.1mm solid #000000;
		}
		.bottom-border {
			border-bottom: 0.1mm solid #000000;
		}
		.left-border {
			border-left: 0.1mm solid #000000;
		}
		.right-border {
			border-right: 0.1mm solid #000000;
		}
		.box td {
			border: 0.1mm solid #000000;
		}
		table thead td { background-color: #EEEEEE;
			text-align: center;
			border: 0.1mm solid #000000;
			border-collapse: collapse;
		}
		.items td.totals {
			text-align: right;
			border: 0.1mm solid #000000;
		}
		.fixed-bottom {
			/* bottom: 1;
			position: fixed; */
			
		}
		</style>
		</head>
		<body>
		
		<!--mpdf
			<htmlpageheader name="myheader">
				<table width="100%">
					<tr>
						<td><h2>'.$company->name.'</h2></td><td style="text-align: right;"><h2>INVOICE</h2></td>
					</tr>
					<tr>
						<td>'.$company->address.'<br>
						Phone: '.$company->phone1.' '.$company->phone2.' '.$company->phone3.'<br> 
						Fax: '.$company->fax.'</td>
						<td style="text-align: right;"></td>
					</tr>
				</table>
			</htmlpageheader>

			<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
		mpdf-->';
		$html_foot = '</body></html>';
		$mpdf->WriteHTML($html_head);
		$mpdf->SetFooter("|Page {PAGENO} of {nb}|Printed @ ". date('d M Y H:i'));
		
		$header_id 	= 0;
		$page		= 0;
		$row_count	= 0;
		$num_row 	= $query->num_rows();
		$ft_power 	= '';
		$ft_water 	= '';
		foreach ($query->result() as $row) {
			
			$row_count++;
			if ($header_id !== $row->id) 
			{
				if ($page > 0) 
				{
					$new_charge = format_rupiah($total_amount);
					$due_date 	= set_date('d-m-Y', $row->due_date);
					$footer = '
						</tbody>
						<tr>
							<td class="totals">TAGIHAN BULAN INI:</td><td class="totals">'.$new_charge.'</td>
						</tr>
						<tr>
							<td class="totals">TANGGAL JATUH TEMPO:</td><td class="totals">'.$due_date.'</td>
						</tr>
					</table>';
					if ($ft_water !== '') 
					{
						$footer .= '
						<table class="box" style="width: 100%;" style="margin-top: 1.25em; font-size: 9pt; border-collapse: collapse;" cellpadding="8">
							<tr><td colspan=6>DETAIL AIR</td></tr>
							<tr>
								<td style="text-align: center; width: 40%;">CODE/NAME</td>
								<td style="text-align: center; width: 15%;">LAST<br>(a)</td>
								<td style="text-align: center; width: 15%;">CURR<br>(b)</td>
								<td style="text-align: center; width: 15%;">USAGE<br>(c)=(b-a)</td>
								<td style="text-align: center; width: 15%;">TARIF<br>(d)</td>
								<td style="text-align: center; width: 20%;">TOTAL AMOUNT<br>(e)=(c*d)</td>
							</tr>
							'.$ft_water.'
						</table>';
					}
					if ($ft_power !== '') {
						$footer .= '
						<table class="box" style="width: 100%;" style="margin-top: 1.25em; font-size: 9pt; border-collapse: collapse;" cellpadding="8">
							<tr><td colspan=12>DETAIL LISTRIK</td></tr>
							<tr>
								<td>CODE/NAME</td><td style="text-align: center;">LAST<br><br>(a)</td>
								<td style="text-align: center;">CURR<br><br>(b)</td>
								<td style="text-align: center;">USAGE<br><br>(c)=(b-a)</td>
								<td style="text-align: center;">KVA<br><br>(d)</td><td style="text-align: center;">LWBP<br><br>(e)</td>
								<td style="text-align: center;">WBP<br><br>(f)</td><td style="text-align: center;">KVART<br><br>(g)</td>
								<td style="text-align: center;">SUB AMOUNT<br><br>(h)=(e+f+g)</td>
								<td style="text-align: center;">PPJ<br>(i)=<br>(h*3%)</td>
								<td style="text-align: center;">STAMP DUTY<br>(j)</td>
								<td style="text-align: center;">TOTAL AMOUNT<br>(k)=(h+i+j)</td>
							</tr>
							'.$ft_power.'
						</table>';
					}
					$mpdf->WriteHTML($footer);
					$ft_power = '';
					$ft_water = '';
					$mpdf->addpage();
				}
				
				$print_date = set_date('d-m-Y', $row->date);
				$due_date 	= set_date('d-m-Y', $row->due_date);
				$bill_address = str_replace(chr(13), "<br />", $row->bill_address);
				$header = '
				<div style="text-align: right;">'.$row->code.'</div>
				<div style="margin-top: 5mm; text-align: right;">TANGGAL CETAK : '.$print_date.'</div>
				<div style="margin-top: 0mm; text-align: right;">TANGGAL JATUH TEMPO : '.$due_date.'</div>
				<table style="width: 100%; margin-top: 10mm; border: 0.1mm; border-collapse: collapse;" cellpadding="5">
					<tr>
						<td class="left-border top-border" style="width: 15%;">Invoice</td><td class="top-border" style="width: 35%;">: <strong>'.$row->code.'</strong></td>
						<td class="left-border top-border" style="width: 20%;">Unit</td><td class="right-border top-border" style="width: 25%;">: <strong>'.$row->unit_name.'</strong></td>
					</tr>
					<tr>
						<td class="left-border">Name</td><td>: <strong>'.$row->customer_name.'</strong></td>
						<td class="left-border">Vir. Account</td><td class="right-border">: <strong>'.$row->viracc.'</strong></td>
					</tr>
					<tr>
						<td class="left-border">Address</td><td>: &nbsp;</td>
						<td class="left-border">Contact Person</td><td class="right-border">: <strong>'.$row->contact_person.'</strong></td>
					</tr>
					<tr>
						<td colspan=2 class="left-border bottom-border"><strong>'.$bill_address.'</strong></td>
						<td class="left-border bottom-border">&nbsp;</td><td class="right-border bottom-border">&nbsp;</td>
					</tr>
				</table>
				
				<table class="items" width="100%" style="margin-top: 1.25em; border-collapse: collapse;" cellpadding="8">
				<thead>
					<tr>
						<td style="width:25%;"><strong>TAGIHAN SEBELUMNYA</strong></td>
						<td style="width:25%;"><strong>PEMBAYARAN</strong></td>
						<td style="width:25%;"><strong>TAGIHAN BARU</strong></td>
						<td style="width:25%;"><strong>JUMLAH TERHUTANG</strong></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="text-align: right;" class="totals">'.format_rupiah($row->prev_balance).'</td>
						<td style="text-align: right;" class="totals">'.format_rupiah($row->prev_payment).'</td>
						<td style="text-align: right;" class="totals">'.format_rupiah($row->total_amount).'</td>
						<td style="text-align: right;" class="totals">'.format_rupiah($row->prev_balance - $row->prev_payment + $row->total_amount).'</td>
					</tr>
				</tbody>
				</table>
				
				<table class="items" width="100%" style="margin-top: 1.25em; border-collapse: collapse;" cellpadding="8">
				<thead>
					<tr>
						<td style="width:70%;"><strong>KETERANGAN</strong></td><td style="width:30%;"><strong>JUMLAH</strong></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>PERIODE : '.set_date('d-m-Y', $row->date_from).' - '.set_date('d-m-Y', $row->date_to).'</td>
						<td></td>
					</tr>';
				$mpdf->WriteHTML($header);
				if ($row->void==1) 
				{
					$mpdf->SetWatermarkText("Void");
					$mpdf->showWatermarkText = true;
					$mpdf->watermark_font = 'DejaVuSansCondensed';
					$mpdf->watermarkTextAlpha = 0.1;
				}
				$page++;
				$header_id = $row->id;
			} 
			
			//start detail scoops
			$detail = '
			<tr>
				<td>'.$row->note.'</td>
				<td align="right">'.format_rupiah($row->amount).'</td>
			</tr>';
			$mpdf->WriteHTML($detail);
			
			// $mpdf->WriteHTML($query_pwr->num_rows());
			if ($row->invoice_type_id == 1) 	// POWER
			{
				$this->db->select('upc.*, p.name');
				$this->db->from('unit_power_calc as upc');
				$this->db->join('power as p', 'upc.power_id = p.id', 'left');
				$this->db->where('upc.id', $row->ref_id);
				$query_pwr = $this->db->get();
				foreach ( $query_pwr->result() as $row_pwr )
				{
					$ft_power .= '					
					<tr>
						<td>'.$row_pwr->name.'</td><td style="text-align: center;">'.$row_pwr->last_value.'</td>
						<td style="text-align: center;">'.$row_pwr->curr_value.'</td><td style="text-align: center;">'.$row_pwr->usage_value.'</td>
						<td>'.$row_pwr->kva.'</td><td style="text-align: right;">'.format_rupiah($row_pwr->blok1_amount).'</td>
						<td style="text-align: right;">'.format_rupiah($row_pwr->blok2_amount).'</td><td style="text-align: right;">'.format_rupiah($row_pwr->blok3_amount).'</td>
						<td style="text-align: right;">'.format_rupiah($row_pwr->sub_amount1).'</td><td style="text-align: right;">'.format_rupiah($row_pwr->ppj_amount).'</td>
						<td style="text-align: right;">'.format_rupiah($row_pwr->stampduty_amount).'</td><td style="text-align: right;">'.format_rupiah($row_pwr->total_amount).'</td>
					</tr>';
				}
			}
			
			if ($row->invoice_type_id == 2) 	// WATER
			{
				$this->db->select('uwc.*, w.name');
				$this->db->from('unit_water_calc as uwc');
				$this->db->join('water as w', 'uwc.water_id = w.id', 'left');
				$this->db->where('uwc.id', $row->ref_id);
				$query_wtr = $this->db->get();
				foreach ( $query_wtr->result() as $row_wtr )
				{
					$ft_water .= '					
					<tr>
						<td>'.$row_wtr->name.'</td><td style="text-align: center;">'.$row_wtr->last_value.'</td>
						<td style="text-align: center;">'.$row_wtr->curr_value.'</td><td style="text-align: center;">'.$row_wtr->usage_value.'</td>
						<td style="text-align: right;">'.format_rupiah($row_wtr->tariff).'</td><td style="text-align: right;">'.format_rupiah($row_wtr->total_amount).'</td>
					</tr>
					';
				}
			}
			
			//end detail scoops
			
			$total_amount = $row->total_amount;
			
			if ($row_count == $num_row) 
			{
				$due_date = set_date('d-m-Y', $row->due_date);
				$footer = '
					</tbody>
					<tr>
						<td class="totals">TAGIHAN BULAN INI:</td><td class="totals">'.format_rupiah($total_amount).'</td>
					</tr>
					<tr>
						<td class="totals">TANGGAL JATUH TEMPO:</td><td class="totals">'.$due_date.'</td>
					</tr>
				</table>';
				if ($ft_water !== '') 
				{
					$footer .= '
					<table class="box" style="width: 100%;" style="margin-top: 1.25em; font-size: 9pt; border-collapse: collapse;" cellpadding="8">
						<tr><td colspan=6>DETAIL AIR</td></tr>
						<tr>
							<td style="text-align: center; width: 40%;">CODE/NAME</td>
							<td style="text-align: center; width: 15%;">LAST<br>(a)</td>
							<td style="text-align: center; width: 15%;">CURR<br>(b)</td>
							<td style="text-align: center; width: 15%;">USAGE<br>(c)=(b-a)</td>
							<td style="text-align: center; width: 15%;">TARIF<br>(d)</td>
							<td style="text-align: center; width: 20%;">TOTAL AMOUNT<br>(e)=(c*d)</td>
						</tr>
						'.$ft_water.'
					</table>';
				}
				if ($ft_power !== '') 
				{
					$footer .= '
					<table class="box" style="width: 100%;" style="margin-top: 1.25em; font-size: 9pt; border-collapse: collapse;" cellpadding="8">
						<tr><td colspan=12>DETAIL LISTRIK</td></tr>
						<tr>
							<td>CODE/NAME</td><td style="text-align: center;">LAST<br><br>(a)</td>
							<td style="text-align: center;">CURR<br><br>(b)</td>
							<td style="text-align: center;">USAGE<br><br>(c)=(b-a)</td>
							<td style="text-align: center;">KVA<br><br>(d)</td><td style="text-align: center;">LWBP<br><br>(e)</td>
							<td style="text-align: center;">WBP<br><br>(f)</td><td style="text-align: center;">KVART<br><br>(g)</td>
							<td style="text-align: center;">SUB AMOUNT<br><br>(h)=(e+f+g)</td>
							<td style="text-align: center;">PPJ<br>(i)=<br>(h*3%)</td>
							<td style="text-align: center;">STAMP DUTY<br>(j)</td>
							<td style="text-align: center;">TOTAL AMOUNT<br>(k)=(h+i+j)</td>
						</tr>
						'.$ft_power.'
					</table>';
				}
				$mpdf->WriteHTML($footer);
				$ft_power = '';
				$ft_water = '';
			}
		}
		
		$mpdf->WriteHTML($html_foot);
		$mpdf->Output();
	}
	
	function form_invoice_manual( $period_id, $id=NULL, $void=NULL ) {

		$company_id = $this->session->userdata('company_id');
		
		$filter['i.period_id']  = $period_id;
		if ( !empty($id) ) $filter['i.id'] = $id;
		if ( !empty($void) ) $filter['void'] = $void;
		
		// ob_end_clean();
		// $invoice_range = "(i.period_id = '$period_id') and (i.id BETWEEN '$invoice_from' AND '$invoice_to') and (void = 0)";
		$this->db->select( 'i.*, 
			p.name AS period_name, u.code AS unit_code, u.name AS unit_name, 
			c.name AS customer_name, c.contact_person, c.address, c.phone, c.fax, c.bill_address, c.bill_phone, c.bill_fax, 
			oc.name as charge_type_name, 
			id.invoice_type_id, id.ref_id, id.note, id.amount,
			oit.name as invoice_type_name')
		->from('invoice as i')
		->join('invoice_dt as id', 'i.id = id.invoice_id')
		->join('period as p', 'i.period_id = p.id', 'left')
		->join('unit as u', 'i.unit_id = u.id', 'left')
		->join('customer as c', 'i.customer_id = c.id', 'left')
		->join('opt_charge_type as oc', 'i.charge_type_id = oc.id', 'left')
		->join('opt_invoice_type as oit', 'id.invoice_type_id = oit.id', 'left')
		// ->where($invoice_range, null, false)
		->where($filter)
		->order_by("u.code", "asc");
		$query = $this->db->get();
		if ($query->num_rows() < 1) 
			return;
		
		$company = $this->db->get_where('company', array('id'=>$company_id))->row();
		
		$this->load->library('mpdf');
		$mpdf = new mPDF('utf-8','A4', 0, 'Courier');
		$mpdf->SetTitle("$company->name - Invoice");
		$mpdf->SetAuthor($company->name);
		
		$html_head = '
		<html><head>
		<style>
		body {font-family: Courier;
			font-size: 10pt;
		}
		p {    margin: 0pt;		}
		td { vertical-align: top; }
		.top-border {
			border-top: 0.1mm solid #000000;
		}
		.bottom-border {
			border-bottom: 0.1mm solid #000000;
		}
		.left-border {
			border-left: 0.1mm solid #000000;
		}
		.right-border {
			border-right: 0.1mm solid #000000;
		}
		.items td {
			border-left: 0.1mm solid #000000;
			border-right: 0.1mm solid #000000;
		}
		table thead td { background-color: #EEEEEE;
			text-align: center;
			border: 0.1mm solid #000000;
			border-collapse: collapse;
		}
		.items td.totals {
			text-align: right;
			border: 0.1mm solid #000000;
		}
		</style>
		</head>
		<body>
		
		<!--mpdf
			<htmlpageheader name="myheader">
				<table width="100%">
					<tr>
						<td><h2>'.$company->name.'</h2></td><td style="text-align: right;"><h2>INVOICE</h2></td>
					</tr>
					<tr>
						<td>'.$company->address.'<br>
						Phone: '.$company->phone1.' '.$company->phone2.' '.$company->phone3.'<br> 
						Fax: '.$company->fax.'</td>
						<td style="text-align: right;"></td>
					</tr>
				</table>
			</htmlpageheader>

			<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
		mpdf-->';
		$html_foot = '</body></html>';
		$mpdf->WriteHTML($html_head);
		$mpdf->SetFooter("|Page {PAGENO} of {nb}|Printed @ ". date('d M Y H:i'));
		
		$header_id 	= 0;
		$page		= 0;
		$row_count	= 0;
		$num_row 	= $query->num_rows();
		foreach ($query->result() as $row) {
			
			$row_count++;
			if ($header_id !== $row->id) 
			{
				if ($page > 0) 
				{
					$due_date = set_date('d-m-Y', $row->due_date);
					$footer = '
						</tbody>
						<tr>
						<td class="totals">TOTAL TAGIHAN:</td><td class="totals">'.format_rupiah($total_amount).'</td></tr>
						<tr>
						<td class="totals">TANGGAL JATUH TEMPO:</td><td class="totals">'. $due_date .'</td></tr>
					</table>';
					$mpdf->WriteHTML($footer);
					$mpdf->addpage();
				}
				
				$print_date = set_date('d-m-Y', $row->date);
				$due_date 	= set_date('d-m-Y', $row->due_date);
				$bill_address = str_replace(chr(13), "<br />", $row->bill_address);
				$header = '
				<div style="text-align: right;">'.$row->code.'</div>
				<div style="margin-top: 5mm; text-align: right;">TANGGAL CETAK : '.$print_date.'</div>
				<div style="margin-top: 0mm; text-align: right;">TANGGAL JATUH TEMPO : '.$due_date.'</div>
				<table style="width: 100%; margin-top: 10mm; border: 0.1mm; border-collapse: collapse;" cellpadding="5">
					<tr>
						<td class="left-border top-border" style="width: 15%;">Invoice</td><td class="top-border" style="width: 30%;">: <strong>'.$row->code.'</strong></td>
						<td class="left-border top-border" style="width: 20%;">Name</td><td class="right-border top-border" style="width: 35%;">: <strong>'.$row->customer_name.'</strong></td>
					</tr>
					<tr>
						<td class="left-border">Unit</td><td>: <strong>'.$row->unit_name.'</strong></td>
						<td class="left-border">Vir. Account</td><td class="right-border">: <strong>'.$row->viracc.'</strong></td>
					</tr>
					<tr>
						<td class="left-border">Address</td><td>: &nbsp;</td>
						<td class="left-border">Contact Person</td><td class="right-border">: <strong>'.$row->contact_person.'</strong></td>
					</tr>
					<tr>
						<td colspan=2 class="left-border bottom-border"><strong>'.$bill_address.'</strong></td>
						<td class="left-border bottom-border">&nbsp;</td><td class="right-border bottom-border">&nbsp;</td>
					</tr>
				</table>
				
				<table class="items" width="100%" style="margin-top: 1.25em; border-collapse: collapse;" cellpadding="8">
				<thead>
					<tr>
					<td style="width:70%;"><strong>KETERANGAN</strong></td><td style="width:30%;"><strong>JUMLAH</strong></td></tr>
				</thead>
				<tbody>
				';
				$mpdf->WriteHTML($header);
				if ($row->void==1) {
					$mpdf->SetWatermarkText("Void");
					$mpdf->showWatermarkText = true;
					$mpdf->watermark_font = 'DejaVuSansCondensed';
					$mpdf->watermarkTextAlpha = 0.1;
				}
				$page++;
				$header_id = $row->id;
			} 
				
			$detail = '
			<tr>
				<td>'.$row->note.'</td>
				<td align="right">'.format_rupiah($row->amount).'</td>
			</tr>';
			$mpdf->WriteHTML($detail);
			
			$total_amount = $row->total_amount;
			
			if ($row_count == $num_row) 
			{
				$due_date 	= set_date('d-m-Y', $row->due_date);
				$footer = '
					</tbody>
					<tr>
					<td class="totals">TOTAL TAGIHAN:</td><td class="totals">'.format_rupiah($total_amount).'</td></tr>
					<tr>
					<td class="totals">TANGGAL JATUH TEMPO:</td><td class="totals">'. $due_date .'</td></tr>
				</table>';
				$mpdf->WriteHTML($footer);
			}
		}
		
		$mpdf->WriteHTML($html_foot);
		$mpdf->Output();
	}
	
	function getCustomerListAR( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			crud_result( $this->billm_model->getCustomerListAR($params) );
		}
	}

	function getInvoiceListAR( $action=NULL, $customer_id=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($customer_id) ) 
				$params['where']['customer_id'] = $customer_id;
			else
				$params['where']['customer_id'] = $params['customer_id'];
			// $params['where']['customer_id'] = 104;
			// $params['where']['customer_id'] = 245;
				
			if ( !empty($params['q']) )
			{
				$params['like']['i.code'] = $params['q'];
				$params['like']['u.code'] = $params['q'];
				$params['like']['oit.code'] = $params['q'];
				$params['like']['oit.name'] = $params['q'];
			}	
			
			crud_result( $this->billm_model->getInvoiceListAR($params) );
		}
	}
	
	function mtr_reading( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'mtr_reading';
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->my_template->fire( $this->mdl_grp, $mdl );
	}

}