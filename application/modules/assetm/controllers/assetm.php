<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// session_start(); //we need to call PHP's session object to access it through CI

class Assetm extends CI_Controller {

	private $mdl_grp = 'assetm';
		
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		
		$this->load->model('assetm_model');
		$this->load->model('systems/systems_model');
	}

	function index() {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		redirect('main', 'refresh');
	}

	// OPTIONS
	
	// MASTERS
	function unit( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'unit';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
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
				if ( array_key_exists('gas_bill', $data) ) $data1['gas_bill'] = $data['gas_bill'];
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
			
			if ( !empty($params['q']) )
			{
				$params['like']['u.id'] = $params['q'];
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
				$params['like']['u.desc'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['u.id'] = $params['findVal'];
					$params['like']['u.code'] = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
					$params['like']['u.desc'] = $params['findVal'];
				} 
				else
					$params['like']['u.'.$params['findKey']] = $params['findVal'];

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
				if ( array_key_exists('gas_bill', $data) ) $data1['gas_bill'] = $data['gas_bill'];
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

	// TRANSACTIONS
	function by_unit( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'by_unit';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
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
				$data1['gas_bill'] = $data['gas_bill'];
				$data1['bill_date'] = $data['bill_date'];
				$data1['bill_due'] = $data['bill_due'];
				$data1['coa_pwr_d'] = $data['coa_pwr_d'];
				$data1['coa_pwr_c'] = $data['coa_pwr_c'];
				$data1['coa_wtr_d'] = $data['coa_wtr_d'];
				$data1['coa_wtr_c'] = $data['coa_wtr_c'];
				$data1['coa_svc_d'] = $data['coa_svc_d'];
				$data1['coa_svc_c'] = $data['coa_svc_c'];
				$data1['coa_gas_d'] = $data['coa_gas_d'];
				$data1['coa_gas_c'] = $data['coa_gas_c'];
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
			
			if ( !empty($params['q']) )
			{
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
				$params['like']['u.desc'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['u.code'] = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
					$params['like']['u.desc'] = $params['findVal'];
				} 
				else
					$params['like']['u.'.$params['findKey']] = $params['findVal'];

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
				$data1['gas_bill'] = $data['gas_bill'];
				$data1['bill_date'] = $data['bill_date'];
				$data1['bill_due'] = $data['bill_due'];
				$data1['coa_pwr_d'] = $data['coa_pwr_d'];
				$data1['coa_pwr_c'] = $data['coa_pwr_c'];
				$data1['coa_wtr_d'] = $data['coa_wtr_d'];
				$data1['coa_wtr_c'] = $data['coa_wtr_c'];
				$data1['coa_svc_d'] = $data['coa_svc_d'];
				$data1['coa_svc_c'] = $data['coa_svc_c'];
				$data1['coa_gas_d'] = $data['coa_gas_d'];
				$data1['coa_gas_c'] = $data['coa_gas_c'];
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

	function by_unit_owner( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'by_unit_owner';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		= $data['unit_id'];
				$data1['customer_id'] 	= $data['customer_id'];
				$data1['date_from'] 	= db_date_format($data['date_from']);
				$data1['date_to'] 		= db_date_format($data['date_to']);
				$data1['note'] 			= strtoupper($data['note']);
				$data1['create_by']   	= sesUser()->id;
				$data1['create_date'] 	= date('Y-m-d H:i:s');
				$this->db->insert('unit_owner', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['unit_id'] = $params['unit_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
				$params['like']['u.desc'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['u.code'] = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
					$params['like']['u.desc'] = $params['findVal'];
				} 
				else
					$params['like']['u.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->assetm_model->getUnitOwnerAll($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		= $data['unit_id'];
				$data1['customer_id'] 	= $data['customer_id'];
				$data1['date_from'] 	= db_date_format($data['date_from']);
				$data1['date_to'] 		= db_date_format($data['date_to']);
				$data1['note'] 			= strtoupper($data['note']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'unit_owner', $data1, array('id'=>$data['id']) );
				
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
			
				$this->db->delete( 'unit_owner', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}

	function by_unit_tenant( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'by_unit_tenant';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		= $data['unit_id'];
				$data1['customer_id'] 	= $data['customer_id'];
				$data1['date_from'] 	= db_date_format($data['date_from']);
				$data1['date_to'] 		= db_date_format($data['date_to']);
				$data1['note'] 			= strtoupper($data['note']);
				$data1['create_by']   	= sesUser()->id;
				$data1['create_date'] 	= date('Y-m-d H:i:s');
				$this->db->insert('unit_tenant', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['unit_id'] = $params['unit_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
				$params['like']['u.desc'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['u.code'] = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
					$params['like']['u.desc'] = $params['findVal'];
				} 
				else
					$params['like']['u.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->assetm_model->getUnitTenantAll($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		= $data['unit_id'];
				$data1['customer_id'] 	= $data['customer_id'];
				$data1['date_from'] 	= db_date_format($data['date_from']);
				$data1['date_to'] 		= db_date_format($data['date_to']);
				$data1['note'] 			= strtoupper($data['note']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'unit_tenant', $data1, array('id'=>$data['id']) );
				
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
			
				$this->db->delete( 'unit_tenant', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}

	function by_owner( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'by_owner';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		= $data['unit_id'];
				$data1['customer_id'] 	= $data['customer_id'];
				$data1['date_from'] 	= db_date_format($data['date_from']);
				$data1['date_to'] 		= db_date_format($data['date_to']);
				$data1['note'] 			= strtoupper($data['note']);
				$data1['create_by']   	= sesUser()->id;
				$data1['create_date'] 	= date('Y-m-d H:i:s');
				$this->db->insert('unit_owner', $data1);
				
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
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
				$params['like']['u.desc'] = $params['q'];
				$params['like']['c.contact_person'] = $params['q'];
				$params['like']['c.address'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['u.code'] = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
					$params['like']['u.desc'] = $params['findVal'];
					$params['like']['c.contact_person'] = $params['findVal'];
					$params['like']['c.address'] = $params['findVal'];
				} 
				// else
					// $params['like']['u.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->assetm_model->getUnitOwnerDistinctAll($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['name'] 	   		 = strtoupper($data['customer_name']);
				$data1['npwp'] 	   		 = $data['npwp'];
				$data1['npwp_name'] 	 = strtoupper($data['npwp_name']);
				$data1['npwp_address'] 	 = strtoupper($data['npwp_address']);
				$data1['email'] 	   	 = $data['email'];
				$data1['contact_person'] = strtoupper($data['contact_person']);
				$data1['address'] 	   	 = strtoupper($data['address']);
				$data1['phone'] 	   	 = $data['phone'];
				$data1['fax'] 	   		 = $data['fax'];
				if ( array_key_exists('virtual_acc', $data) ) $data1['virtual_acc'] = strtoupper($data['virtual_acc']);
				if ( array_key_exists('bill_address', $data) ) $data1['bill_address'] = strtoupper($data['bill_address']);
				if ( array_key_exists('bill_phone', $data) ) $data1['bill_phone'] = strtoupper($data['bill_phone']);
				if ( array_key_exists('bill_fax', $data) ) $data1['bill_fax'] = strtoupper($data['bill_fax']);
				if ( array_key_exists('ship_address', $data) ) $data1['ship_address'] = strtoupper($data['ship_address']);
				if ( array_key_exists('ship_phone', $data) ) $data1['ship_phone'] = strtoupper($data['ship_phone']);
				if ( array_key_exists('ship_fax', $data) ) $data1['ship_fax'] = strtoupper($data['ship_fax']);
				$data1['update_by']   	 = sesUser()->id;
				$data1['update_date'] 	 = date('Y-m-d H:i:s');
				$this->db->update( 'customer', $data1, array('id'=>$data['id']) );
				
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
			
				$this->db->delete( 'unit_owner', array('id'=>$data['id']) );
				
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

	function by_owner_unit( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'by_owner_unit';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		= $data['unit_id'];
				$data1['customer_id'] 	= $data['customer_id'];
				$data1['date_from'] 	= db_date_format($data['date_from']);
				$data1['date_to'] 		= db_date_format($data['date_to']);
				$data1['note'] 			= strtoupper($data['note']);
				$data1['create_by']   	= sesUser()->id;
				$data1['create_date'] 	= date('Y-m-d H:i:s');
				$this->db->insert('unit_owner', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['customer_id'] = $params['customer_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
				$params['like']['u.desc'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['u.code'] = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
					$params['like']['u.desc'] = $params['findVal'];
				} 
				else
					$params['like']['u.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->assetm_model->getUnitOwnerAll($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		= $data['unit_id'];
				$data1['customer_id'] 	= $data['customer_id'];
				$data1['date_from'] 	= db_date_format($data['date_from']);
				$data1['date_to'] 		= db_date_format($data['date_to']);
				$data1['note'] 			= strtoupper($data['note']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'unit_owner', $data1, array('id'=>$data['id']) );
				
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
			
				$this->db->delete( 'unit_owner', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}

	function by_tenant( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'by_tenant';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		= $data['unit_id'];
				$data1['customer_id'] 	= $data['customer_id'];
				$data1['date_from'] 	= db_date_format($data['date_from']);
				$data1['date_to'] 		= db_date_format($data['date_to']);
				$data1['note'] 			= strtoupper($data['note']);
				$data1['create_by']   	= sesUser()->id;
				$data1['create_date'] 	= date('Y-m-d H:i:s');
				$this->db->insert('unit_tenant', $data1);
				
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
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
				$params['like']['u.desc'] = $params['q'];
				$params['like']['c.contact_person'] = $params['q'];
				$params['like']['c.address'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['u.code'] = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
					$params['like']['u.desc'] = $params['findVal'];
					$params['like']['c.contact_person'] = $params['findVal'];
					$params['like']['c.address'] = $params['findVal'];
				} 
				// else
					// $params['like']['u.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->assetm_model->getUnitTenantDistinctAll($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['name'] 	   		 = strtoupper($data['customer_name']);
				$data1['npwp'] 	   		 = $data['npwp'];
				$data1['npwp_name'] 	 = strtoupper($data['npwp_name']);
				$data1['npwp_address'] 	 = strtoupper($data['npwp_address']);
				$data1['email'] 	   	 = $data['email'];
				$data1['contact_person'] = strtoupper($data['contact_person']);
				$data1['address'] 	   	 = strtoupper($data['address']);
				$data1['phone'] 	   	 = $data['phone'];
				$data1['fax'] 	   		 = $data['fax'];
				if ( array_key_exists('virtual_acc', $data) ) $data1['virtual_acc'] = strtoupper($data['virtual_acc']);
				if ( array_key_exists('bill_address', $data) ) $data1['bill_address'] = strtoupper($data['bill_address']);
				if ( array_key_exists('bill_phone', $data) ) $data1['bill_phone'] = strtoupper($data['bill_phone']);
				if ( array_key_exists('bill_fax', $data) ) $data1['bill_fax'] = strtoupper($data['bill_fax']);
				if ( array_key_exists('ship_address', $data) ) $data1['ship_address'] = strtoupper($data['ship_address']);
				if ( array_key_exists('ship_phone', $data) ) $data1['ship_phone'] = strtoupper($data['ship_phone']);
				if ( array_key_exists('ship_fax', $data) ) $data1['ship_fax'] = strtoupper($data['ship_fax']);
				$data1['update_by']   	 = sesUser()->id;
				$data1['update_date'] 	 = date('Y-m-d H:i:s');
				$this->db->update( 'customer', $data1, array('id'=>$data['id']) );
				
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
			
				$this->db->delete( 'unit_tenant', array('id'=>$data['id']) );
				
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

	function by_tenant_unit( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'by_tenant_unit';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		= $data['unit_id'];
				$data1['customer_id'] 	= $data['customer_id'];
				$data1['date_from'] 	= db_date_format($data['date_from']);
				$data1['date_to'] 		= db_date_format($data['date_to']);
				$data1['note'] 			= strtoupper($data['note']);
				$data1['create_by']   	= sesUser()->id;
				$data1['create_date'] 	= date('Y-m-d H:i:s');
				$this->db->insert('unit_tenant', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['customer_id'] = $params['customer_id'];
			
			if ( !empty($params['q']) )
			{
				$params['like']['u.code'] = $params['q'];
				$params['like']['u.name'] = $params['q'];
				$params['like']['u.desc'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['u.code'] = $params['findVal'];
					$params['like']['u.name'] = $params['findVal'];
					$params['like']['u.desc'] = $params['findVal'];
				} 
				else
					$params['like']['u.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->assetm_model->getUnitTenantAll($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['unit_id'] 		= $data['unit_id'];
				$data1['customer_id'] 	= $data['customer_id'];
				$data1['date_from'] 	= db_date_format($data['date_from']);
				$data1['date_to'] 		= db_date_format($data['date_to']);
				$data1['note'] 			= strtoupper($data['note']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'unit_tenant', $data1, array('id'=>$data['id']) );
				
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
			
				$this->db->delete( 'unit_tenant', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
	}
	
	// REPORTS

}