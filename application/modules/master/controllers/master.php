<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// session_start(); //we need to call PHP's session object to access it through CI

class Master extends CI_Controller {

	private $mdl_grp = 'master';
		
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('master_model');
	}

	function index() {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		redirect('main', 'refresh');
	}

	// CRUD MASTER =====
	function customer( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 		= 'customer';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			// {begin} => procedure check duplicate value [code]
			// if ( $this->shared_model->is_duplicate_code('customer', $data['code_new']) ) 
				// crud_error("error_duplicate_code");
				
			$this->db->trans_begin();
			
			try {
				
				$doc_code = get_doc_code(sesCompany()->id, sesBranch()->id, sesDepartment()->id, 'CUST');
				if (!$doc_code)
					crud_error("error_get_doc_code");
				
				$data1['company_id']	 = sesCompany()->id;
				$data1['branch_id'] 	 = sesBranch()->id;
				$data1['code'] 	   		 = $doc_code;
				$data1['name'] 	   		 = strtoupper($data['name']);
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
				$data1['create_by']   	 = sesUser()->id;
				$data1['create_date'] 	 = date('Y-m-d H:i:s');
				$this->db->insert('customer', $data1);
				
				$result = set_doc_last_number(sesCompany()->id, sesBranch()->id, sesDepartment()->id, 'CUST', $doc_code);
				if (!$result)
					crud_error("error_set_doc_last_number");
				
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
				$params['like']['c.code'] = $params['q'];
				$params['like']['c.name'] = $params['q'];
				$params['like']['c.contact_person'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['c.code'] = $params['findVal'];
					$params['like']['c.name'] = $params['findVal'];
					$params['like']['c.contact_person'] = $params['findVal'];
				} 
				else
					$params['like']['c.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->master_model->getCustomer($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// {begin} => procedure check duplicate value [code]
			// if ( $data['code'] != $data['code_new'] ) 
				// if ( $this->shared_model->is_duplicate_code('customer', $data['code_new']) ) 	//check duplicate value [code]
					// crud_error("error_duplicate_code");
					
			try {
				
				// $data1['code'] 	   		 = strtoupper($data['code_new']);
				$data1['name'] 	   		 = strtoupper($data['name']);
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
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			try {
			
				$this->db->delete('customer', array('id'=>$data['id']));
				
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

	function item( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 	= 'item';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			$this->db->trans_begin();
			
			// {begin} => procedure check duplicate value [code]
			if ( $this->shared_model->is_duplicate_code('item', $data['code_new']) ) 
				crud_error("error_duplicate_code");
				
			if ( !empty($data['expired_date']) ) {
				$tmp = explode('/', $data['expired_date']);
				$data1['expired_date'] = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
			} else {
				$data1['expired_date'] = NULL;
			}

			try {
				
				$data1['company_id']  = sesCompany()->id;
				$data1['item_cat_id'] = strtoupper($data['item_cat_id']);
				$data1['measure_id']  = strtoupper($data['measure_id']);
				$data1['code'] 	   	  = strtoupper($data['code_new']);
				$data1['name'] 	   	  = strtoupper($data['name']);
				$data1['price_buy']   = $data['price_buy'];
				$data1['price_sell']  = $data['price_sell'];
				$data1['stock_val']   = $data['stock_val'];
				$data1['stock_min']   = $data['stock_min'];
				$data1['stock_max']   = $data['stock_max'];
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('item', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['company_id'] = sesCompany()->id;
			
			if ( !empty($params['q']) )
			{
				$params['like']['i.id'] = $params['q'];
				$params['like']['i.code'] = $params['q'];
				$params['like']['i.name'] = $params['q'];
				$params['like']['i.size'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['i.id'] = $params['findVal'];
					$params['like']['i.code'] = $params['findVal'];
					$params['like']['i.name'] = $params['findVal'];
					$params['like']['i.size'] = $params['findVal'];
				} 
				else
					$params['like'][$params['findKey']] = $params['findVal'];

			crud_result( $this->master_model->getItem($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// {begin} => procedure check duplicate value [code]
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('item', $data['code_new']) ) 	//check duplicate value [code]
					crud_error("error_duplicate_code");
			
			if ( !empty($data['expired_date']) ) {
				$tmp = explode('/', $data['expired_date']);
				$data1['expired_date'] = $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
			} else {
				$data1['expired_date'] = NULL;
			}

			try {
				
				$data1['company_id']  = sesCompany()->id;
				$data1['item_cat_id'] = strtoupper($data['item_cat_id']);
				$data1['measure_id']  = strtoupper($data['measure_id']);
				$data1['code'] 	   	  = strtoupper($data['code_new']);
				$data1['name'] 	   	  = strtoupper($data['name']);
				$data1['price_buy']   = $data['price_buy'];
				$data1['price_sell']  = $data['price_sell'];
				$data1['stock_val']   = $data['stock_val'];
				$data1['stock_min']   = $data['stock_min'];
				$data1['stock_max']   = $data['stock_max'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'item', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			try {
			
				// $this->db->delete('item', array('id'=>$data['id']));
				
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

	function item_cat( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'item_cat';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			$this->db->trans_begin();
			
			// {begin} => procedure check duplicate value [code]
			if ( $this->shared_model->is_duplicate_code('item_cat', $data['code_new']) ) 
				crud_error("error_duplicate_code");
				
			try {
				
				$data1['code'] 		 = strtoupper($data['code_new']);
				$data1['name'] 		 = strtoupper($data['name']);
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
			
				$this->db->insert('item_cat', $data1);
				
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
				$params['like']['i.code'] = $params['q'];
				$params['like']['i.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['i.code'] = $params['findVal'];
					$params['like']['i.name'] = $params['findVal'];
				} 
				else
					$params['like']['i.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->master_model->getItem_Cat($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// {begin} => procedure check duplicate value [code]
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('item_cat', $data['code_new']) ) 	//check duplicate value [code]
					crud_error("error_duplicate_code");
					
			try {
				
				$data1['code'] 	   	 = strtoupper($data['code_new']);
				$data1['name'] 	   	 = strtoupper($data['name']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
			
				$this->db->update( 'item_cat', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			try {
			
				$this->db->delete('item_cat', array('id'=>$data['id']));
				
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

	function measure( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'measure';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			$this->db->trans_begin();
			
			// {begin} => procedure check duplicate value [code]
			if ( $this->shared_model->is_duplicate_code('measure', $data['code_new']) ) 
				crud_error("error_duplicate_code");
				
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('measure', $data1);
				
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
				$params['like']['m.code'] = $params['q'];
				$params['like']['m.name'] = $params['q'];
			}	
			// echo json_encode($params);
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['m.code'] = $params['findVal'];
					$params['like']['m.name'] = $params['findVal'];
				} 
				else
					$params['like']['m.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->master_model->getMeasure($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// {begin} => procedure check duplicate value [code]
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('measure', $data['code_new']) ) 	//check duplicate value [code]
					crud_error("error_duplicate_code");
					
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'measure', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			try {
			
				$this->db->delete( 'measure', array('id'=>$data['id']) );
				
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

	function salesman( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 	= 'salesman';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			$this->db->trans_begin();
			
			// {begin} => procedure check duplicate value [code]
			if ( $this->shared_model->is_duplicate_code('salesman', $data['code_new']) ) 
				crud_error("error_duplicate_code");
				
			try {
				
				$data1['company_id'] = sesCompany()->id;
				$data1['branch_id'] = sesBranch()->id;
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('salesman', $data1);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['company_id'] = sesCompany()->id;
			$params['where']['branch_id']  = sesBranch()->id;
			
			if ( !empty($params['q']) )
			{
				$params['like']['s.code'] = $params['q'];
				$params['like']['s.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['s.code'] = $params['findVal'];
					$params['like']['s.name'] = $params['findVal'];
				} 
				else
					$params['like']['s.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->master_model->getSalesman($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// {begin} => procedure check duplicate value [code]
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('salesman', $data['code_new']) ) 	//check duplicate value [code]
					crud_error("error_duplicate_code");
					
			try {
				
				$data1['company_id']  = sesCompany()->id;
				$data1['branch_id']   = sesBranch()->id;
				$data1['code'] 	   	  = strtoupper($data['code_new']);
				$data1['name'] 	   	  = strtoupper($data['name']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'salesman', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			try {
			
				$this->db->delete('salesman', array('id'=>$data['id']));
				
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

	function suppliers( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 	= 'suppliers';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			$this->db->trans_begin();
			
			// {begin} => procedure check duplicate value [code]
			if ( $this->shared_model->is_duplicate_code('suppliers', $data['code_new']) ) 
				crud_error("error_duplicate_code");
				
			try {
				
				$data1['company_id'] 	= sesCompany()->id;
				$data1['branch_id'] 	= sesBranch()->id;
				$data1['code'] 	   		= strtoupper($data['code_new']);
				$data1['name'] 	   		= strtoupper($data['name']);
				$data1['address'] 	   	= strtoupper($data['address']);
				$data1['phone'] 		= $data['phone'];
				$data1['fax'] 			= $data['fax'];
				$data1['contactperson'] = strtoupper($data['contactperson']);
				$data1['email']			= $data['email'];
				$data1['term_id'] 		= array_key_exists( 'term_id', $data ) ? $data['term_id'] : NULL; 
				$data1['create_by']   	= sesUser()->id;
				$data1['create_date'] 	= date('Y-m-d H:i:s');
				$this->db->insert('suppliers', $data1);
				
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
				$params['like']['s.code'] = $params['q'];
				$params['like']['s.name'] = $params['q'];
				$params['like']['s.contact_person'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['s.code'] = $params['findVal'];
					$params['like']['s.name'] = $params['findVal'];
					$params['like']['s.contact_person'] = $params['findVal'];
				} 
				else
					$params['like']['s.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->master_model->getSupplier($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// {begin} => procedure check duplicate value [code]
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('suppliers', $data['code_new']) ) 	//check duplicate value [code]
					crud_error("error_duplicate_code");
					
			try {
				
				$data1['company_id'] 	= sesCompany()->id;
				$data1['branch_id'] 	= sesBranch()->id;
				$data1['code'] 	   		= strtoupper($data['code_new']);
				$data1['name'] 	   		= strtoupper($data['name']);
				$data1['address'] 	   	= strtoupper($data['address']);
				$data1['phone'] 		= $data['phone'];
				$data1['fax'] 			= $data['fax'];
				$data1['contactperson'] = strtoupper($data['contactperson']);
				$data1['email']			= $data['email'];
				$data1['term_id'] 		= array_key_exists( 'term_id', $data ) ? $data['term_id'] : NULL; 
				$data1['update_by']   	= sesUser()->id;
				$data1['update_date'] 	= date('Y-m-d H:i:s');
				$this->db->update( 'suppliers', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			try {
			
				$this->db->delete( 'suppliers', array('id'=>$data['id']) );
				
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

	function power( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'power';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $this->shared_model->is_duplicate_code('power', $data['code_new']) ) 
				crud_error("error_duplicate_code");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   		= strtoupper($data['code_new']);
				$data1['name'] 	   		= strtoupper($data['name']);
				$data1['kva'] 	   		= $data['kva'];
				$data1['load_tariff'] 	= $data['load_tariff'];
				$data1['rm_hours'] 	  	= $data['rm_hours'];
				$data1['rm_kwh'] 	  	= $data['rm_kwh'];
				$data1['saving_hours'] 	= $data['saving_hours'];
				$data1['blok1'] 	   	= $data['blok1'];
				$data1['blok2'] 	   	= $data['blok2'];
				$data1['blok3'] 	   	= $data['blok3'];
				$data1['blok1_kwh'] 	= $data['blok1_kwh'];
				$data1['blok2_kwh'] 	= $data['blok2_kwh'];
				$data1['blok3_kwh'] 	= $data['blok3_kwh'];
				$data1['ppj_percent'] 	= $data['ppj_percent'];
				$data1['admin_amount'] 	= $data['admin_amount'];
				$data1['max_value'] 	= $data['max_value'];
				$data1['active'] 	   	= !empty($data['active']) ? 1 : 0;
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('power', $data1);
				
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
				$params['like']['p.id']   = $params['q'];
				$params['like']['p.code'] = $params['q'];
				$params['like']['p.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['p.id']   = $params['findVal'];
					$params['like']['p.code'] = $params['findVal'];
					$params['like']['p.name'] = $params['findVal'];
				} 
				else
					$params['like']['p.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->master_model->getPower($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('power', $data['code_new']) ) 	
					crud_error("error_duplicate_code");
					
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   		= strtoupper($data['code_new']);
				$data1['name'] 	   		= strtoupper($data['name']);
				$data1['kva'] 	   		= $data['kva'];
				$data1['load_tariff'] 	= $data['load_tariff'];
				$data1['rm_hours'] 	  	= $data['rm_hours'];
				$data1['rm_kwh'] 	  	= $data['rm_kwh'];
				$data1['saving_hours'] 	= $data['saving_hours'];
				$data1['blok1'] 	   	= $data['blok1'];
				$data1['blok2'] 	   	= $data['blok2'];
				$data1['blok3'] 	   	= $data['blok3'];
				$data1['blok1_kwh'] 	= $data['blok1_kwh'];
				$data1['blok2_kwh'] 	= $data['blok2_kwh'];
				$data1['blok3_kwh'] 	= $data['blok3_kwh'];
				$data1['ppj_percent'] 	= $data['ppj_percent'];
				$data1['admin_amount'] 	= $data['admin_amount'];
				$data1['max_value'] 	= $data['max_value'];
				$data1['active'] 	   	= !empty($data['active']) ? 1 : 0;
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'power', $data1, array('id'=>$data['id']) );
				
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
			
				// $this->db->delete( 'power', array('id'=>$data['id']) );
				
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

	function water( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'water';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $this->shared_model->is_duplicate_code('water', $data['code_new']) ) 
				crud_error("error_duplicate_code");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['tariff'] 	= $data['tariff'];
				$data1['min_usage'] = $data['min_usage'];
				$data1['max_value'] = $data['max_value'];
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('water', $data1);
				
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
				$params['like']['w.id']   = $params['q'];
				$params['like']['w.code'] = $params['q'];
				$params['like']['w.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['w.id']   = $params['findVal'];
					$params['like']['w.code'] = $params['findVal'];
					$params['like']['w.name'] = $params['findVal'];
				} 
				else
					$params['like']['w.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->master_model->getWater($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('water', $data['code_new']) ) 	
					crud_error("error_duplicate_code");
					
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['tariff'] 	= $data['tariff'];
				$data1['min_usage'] = $data['min_usage'];
				$data1['max_value'] = $data['max_value'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'water', $data1, array('id'=>$data['id']) );
				
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
			
				// $this->db->delete( 'water', array('id'=>$data['id']) );
				
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

	function service( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'service';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $this->shared_model->is_duplicate_code('service', $data['code_new']) ) 
				crud_error("error_duplicate_code");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['tariff'] 	= $data['tariff'];
				$data1['factor_id'] = $data['factor_id'];
				$data1['bill_period'] = $data['bill_period'];
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('service', $data1);
				
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
				$params['like']['s.id']   = $params['q'];
				$params['like']['s.code'] = $params['q'];
				$params['like']['s.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['s.id']   = $params['findVal'];
					$params['like']['s.code'] = $params['findVal'];
					$params['like']['s.name'] = $params['findVal'];
				} 
				else
					$params['like']['s.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->master_model->getService($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('service', $data['code_new']) ) 	
					crud_error("error_duplicate_code");
					
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['tariff'] 	= $data['tariff'];
				$data1['factor_id'] = $data['factor_id'];
				$data1['bill_period'] = $data['bill_period'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'service', $data1, array('id'=>$data['id']) );
				
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
			
				// $this->db->delete( 'service', array('id'=>$data['id']) );
				
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

	function parking( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'parking';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $this->shared_model->is_duplicate_code('parking', $data['code_new']) ) 
				crud_error("error_duplicate_code");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['desc'] 	   	= strtoupper($data['desc']);
				$data1['lot'] 	   	= $data['lot'];
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('parking', $data1);
				
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
				$params['like']['p.id']   = $params['q'];
				$params['like']['p.code'] = $params['q'];
				$params['like']['p.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['p.id']   = $params['findVal'];
					$params['like']['p.code'] = $params['findVal'];
					$params['like']['p.name'] = $params['findVal'];
				} 
				else
					$params['like']['p.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->master_model->getParking($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('parking', $data['code_new']) ) 	
					crud_error("error_duplicate_code");
					
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['desc'] 	   	= strtoupper($data['desc']);
				$data1['lot'] 	   	= $data['lot'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'parking', $data1, array('id'=>$data['id']) );
				
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
			
				$this->db->delete( 'parking', array('id'=>$data['id']) );
				
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

	function others( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'others';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $this->shared_model->is_duplicate_code('others', $data['code_new']) ) 
				crud_error("error_duplicate_code");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['tariff'] 	= $data['tariff'];
				$data1['factor_id'] = $data['factor_id'];
				$data1['bill_period'] = $data['bill_period'];
				$data1['coa_d'] 	= $data['coa_d'];
				$data1['coa_c'] 	= $data['coa_c'];
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->db->insert('others', $data1);
				
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
				$params['like']['o.id']   = $params['q'];
				$params['like']['o.code'] = $params['q'];
				$params['like']['o.name'] = $params['q'];
			}	
			
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['o.id']   = $params['findVal'];
					$params['like']['o.code'] = $params['findVal'];
					$params['like']['o.name'] = $params['findVal'];
				} 
				else
					$params['like']['o.'.$params['findKey']] = $params['findVal'];

			crud_result( $this->master_model->getOthers($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( $data['code'] != $data['code_new'] ) 
				if ( $this->shared_model->is_duplicate_code('others', $data['code_new']) ) 	
					crud_error("error_duplicate_code");
					
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['code'] 	   	= strtoupper($data['code_new']);
				$data1['name'] 	   	= strtoupper($data['name']);
				$data1['tariff'] 	= $data['tariff'];
				$data1['factor_id'] = $data['factor_id'];
				$data1['bill_period'] = $data['bill_period'];
				$data1['coa_d'] 	= $data['coa_d'];
				$data1['coa_c'] 	= $data['coa_c'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'others', $data1, array('id'=>$data['id']) );
				
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
			
				$this->db->delete( 'others', array('id'=>$data['id']) );
				
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

// =============================== REPORTS =============================

	function item_expired_pdf( $givendate ) {
		$this->load->library('mpdf');
		
		// ob_end_clean();
		
		$doc_code		= 'STOCK_EXP';
		
		//GET COMPANY
		$data = $this->shared_model->get_company_code( sesCompany()->id );
		if ( $data==FALSE )
			show_error("ERROR: Table Company has been changed or removed !");
			
		$company_code = $data->code;
		$company_name = $data->name;
		
		//GET BRANCH
		$data = $this->shared_model->get_branch_code( sesBranch()->id );
		if ( $data==FALSE )
			show_error("ERROR: Table Branch has been changed or removed !");
			
		$branch_code = $data->code;
		$branch_name = $data->name;
		
		//GET DEPARTMENT
		$data = $this->shared_model->get_department_code( sesDepartment()->id );
		if ( $data==FALSE )
			show_error("ERROR: Table Department has been changed or removed !");
		
		$department_code = $data->code;
		$department_name = $data->name;

		//GET SIGN
		$data = $this->shared_model->get_document_sign( sesCompany()->id, sesBranch()->id, sesDepartment()->id, $doc_code );
		$sign1 = $data['sign1'];
		
		//=====================================================================================================\\
		$mpdf = new mPDF( 'utf-8', 'A4-L','','',15,15,40,16,10,10 ); 
		// $mpdf = new mPDF( 'utf-8', 'A4-L' );
		$mpdf->SetTitle(strtoupper($company_name));
		$mpdf->SetAuthor($company_name);
		$logo_path = base_url()."assets/images/logo-$company_code.png";
		
		$html_head = "<html><head>
		<style>
		.logo 	{ float: left; margin-top: -80px; width: 100px; height: 100px; }
		body  	{ font-family: Courier; font-size: 10pt; }
		td 		{ vertical-align: top; }
		.top-border 	{ border-top: 0.1mm solid #000000; }
		.bottom-border 	{ border-bottom: 0.1mm solid #000000; }
		.left-border 	{ border-left: 0.1mm solid #000000; }
		.right-border 	{ border-right: 0.1mm solid #000000; }
		table thead td { 
			text-align: center;
			border: 0.1mm solid #000000;
			border-collapse: collapse;
		}
		.items td {
			border-left: 0.1mm solid #000000;
			border-right: 0.1mm solid #000000;
		}
		.items td.blanktotal {
			background-color: #FFFFFF;
			border: 0mm none #000000;
			border-top: 0.1mm solid #000000;
			/* border-right: 0.1mm solid #000000; */
		}		
		.items td.totals {
			text-align: right;
			border: 0.1mm solid #000000;
		}
		</style>
		</head>
		<body>
		
		<!--mpdf
		<htmlpageheader name='myheader'>
			<div class='logo'><img src='$logo_path' width='100' /></div>
			<table width='100%'>
				<tr><td><center><h1>$company_name</h1></center></td></tr>
				<tr><td><center>|||</center></td></tr>
				<tr><td><center><h3>LAPORAN DATA OBAT EXPIRED</h3></center></td></tr>
			</table>
		</htmlpageheader>

		<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
		mpdf-->";
		$mpdf->WriteHTML($html_head);
		$mpdf->SetFooter("|Page {PAGENO} of {nb}|Printed @ ". date('d M Y H:i'));
		
		$givendate_0  = set_date('d-m-Y', $givendate);
		$header = "
		<table class='items' width='100%' style='margin-top: 1.25em; border-collapse: collapse;' cellpadding='8'>
		<thead>
			<tr>
				<td rowspan=2 style='width:5%;'><strong>NO.</strong></td>
				<td rowspan=2 style='width:10%;'><strong>KODE ITEM</strong></td>
				<td rowspan=2 style='width:10%;'><strong>NAMA ITEM</strong></td>
				<td rowspan=2 style='width:10%;'><strong>KATEGORI</strong></td>
				<td rowspan=2 style='width:10%;'><strong>JUMLAH</strong></td>
				<td rowspan=2 style='width:10%;'><strong>SATUAN</strong></td>
				<td rowspan=2 style='width:10%;'><strong>HARGA BELI</strong></td>
				
				<td colspan=6 style='width:10%;'><strong>EXPIRED DATE</strong></td>
			</tr>
			<tr>
				<td style='width:10%;'><strong>HARI INI<br>$givendate_0</strong></td>
				<td style='width:10%;'><strong>1 - 7</strong></td>
				<td style='width:10%;'><strong>8 - 14</strong></td>
				<td style='width:10%;'><strong>15 - 21</strong></td>
				<td style='width:10%;'><strong>22 - 28</strong></td>
				<td style='width:10%;'><strong>29 - 3 BULAN</strong></td>
			</tr>
		</thead>
		<tbody>";
		$mpdf->WriteHTML($header);
		
		// function add_date($format = NULL, $givendate,$d=0,$m=0,$y=0) {
		$givendate_1  = add_date('Y-m-d', $givendate, 1);
		$givendate_7  = add_date('Y-m-d', $givendate, 7);
		$givendate_8  = add_date('Y-m-d', $givendate, 8);
		$givendate_14  = add_date('Y-m-d', $givendate, 14);
		$givendate_15  = add_date('Y-m-d', $givendate, 15);
		$givendate_21  = add_date('Y-m-d', $givendate, 21);
		$givendate_22  = add_date('Y-m-d', $givendate, 28);
		$givendate_29  = add_date('Y-m-d', $givendate, 29);
		$givendate_90  = add_date('Y-m-d', $givendate, 90);
		
		$query = "select `item`.`id` AS `id`,`item`.`company_id` AS `company_id`,`item`.`item_cat_id` AS `item_cat_id`,`item_cat`.`code` AS `item_cat_code`,`item_cat`.`name` AS `item_cat_name`,`item`.`code` AS `code`,`item`.`name` AS `name`,`item`.`size` AS `size`,`item`.`measure_id` AS `measure_id`,`measure`.`code` AS `measure_code`,`measure`.`name` AS `measure_name`,`item`.`price_buy` AS `price_buy`,`item`.`price_sell` AS `price_sell`,`item`.`expired_date` AS `expired_date`,(case when (`item`.`expired_date` <= '$givendate') then `item`.`expired_date` end) AS `today`,(case when (`item`.`expired_date` between '$givendate_1' and '$givendate_7') then `item`.`expired_date` end) AS `today_7`,(case when (`item`.`expired_date` between '$givendate_8' and '$givendate_14') then `item`.`expired_date` end) AS `today_14`,(case when (`item`.`expired_date` between '$givendate_15' and '$givendate_21') then `item`.`expired_date` end) AS `today_21`,(case when (`item`.`expired_date` between '$givendate_22' and '$givendate_28') then `item`.`expired_date` end) AS `today_28`,(case when (`item`.`expired_date` between '$givendate_29' and '$givendate_90') then `item`.`expired_date` end) AS `today_90`,`item`.`stock_val` AS `stock_val`,`item`.`stock_min` AS `stock_min`,`item`.`stock_max` AS `stock_max`,`item`.`create_by` AS `create_by`,`item`.`create_date` AS `create_date`,`item`.`update_by` AS `update_by`,`item`.`update_date` AS `update_date` from ((`item` left join `item_cat` on((`item`.`item_cat_id` = `item_cat`.`id`))) left join `measure` on((`item`.`measure_id` = `measure`.`id`))) where (`item`.`expired_date` <= '$givendate_90')";
		
		$qry_h = $this->db->query($query);
		if ($qry_h->num_rows() < 1) 
			show_error( l('report_no_data') );
		
		$num = 1;
		foreach ( $qry_h->result() as $row_h ) {
			$col01 = $num;
			$col02 = $row_h->code;
			$col03 = $row_h->name;
			$col04 = $row_h->item_cat_name;
			$col05 = number_format($row_h->stock_val, 0, '.', '');
			$col06 = $row_h->measure_code;
			$col07 = number_format($row_h->price_buy, 2, '.', '');
			
			$col08 = empty($row_h->today) ? NULL : add_date('d-m-Y', $row_h->today);
			$col09 = empty($row_h->today_7) ? NULL : add_date('d-m-Y', $row_h->today_7);
			$col10 = empty($row_h->today_14) ? NULL : add_date('d-m-Y', $row_h->today_14);
			$col11 = empty($row_h->today_21) ? NULL : add_date('d-m-Y', $row_h->today_21);
			$col12 = empty($row_h->today_28) ? NULL : add_date('d-m-Y', $row_h->today_28);
			$col13 = empty($row_h->today_90) ? NULL : add_date('d-m-Y', $row_h->today_90);
			$detail = "
				<tr>
					<td align='right'>$col01</td>
					<td>$col02</td>
					<td>$col03</td>
					<td>$col04</td>
					<td align='right'>$col05</td>
					<td align='center'>$col06</td>
					<td align='right'>$col07</td>
					<td align='center'>$col08</td>
					<td align='center'>$col09</td>
					<td align='center'>$col10</td>
					<td align='center'>$col11</td>
					<td align='center'>$col12</td>
					<td align='center'>$col13</td>
				</tr>
			";
			$mpdf->WriteHTML($detail);
			$num++;
		}
			
		$footer = "
				<tr>
					<td colspan='13' class='blanktotal'></td>
				</tr>
				</tbody>
			</table>";
		$mpdf->WriteHTML($footer);
			
		$mpdf->WriteHTML("</body></html>");
		$mpdf->Output();
	}
	
	function item_top_50_pdf( $date_f, $date_t ) {
		$this->load->library('mpdf');
		// ob_end_clean();
		
		$doc_code		= 'STOCK_TOP_50';
		
		//GET COMPANY
		$data = $this->shared_model->get_company_code( sesCompany()->id );
		if ( $data==FALSE )
			show_error("ERROR: Table Company has been changed or removed !");
			
		$company_code = $data->code;
		$company_name = $data->name;
		
		//GET BRANCH
		$data = $this->shared_model->get_branch_code( sesBranch()->id );
		if ( $data==FALSE )
			show_error("ERROR: Table Branch has been changed or removed !");
			
		$branch_code = $data->code;
		$branch_name = $data->name;
		
		//GET DEPARTMENT
		$data = $this->shared_model->get_department_code( sesDepartment()->id );
		if ( $data==FALSE )
			show_error("ERROR: Table Department has been changed or removed !");
		
		$department_code = $data->code;
		$department_name = $data->name;

		//GET SIGN
		$data = $this->shared_model->get_document_sign( sesCompany()->id, sesBranch()->id, sesDepartment()->id, $doc_code );
		$sign1 = $data['sign1'];
		
		//=====================================================================================================\\
		$mpdf = new mPDF( 'utf-8', 'A4','','',15,15,40,16,10,10 ); 
		// $mpdf = new mPDF( 'utf-8', 'A4-L' );
		$mpdf->SetTitle(strtoupper($company_name));
		$mpdf->SetAuthor($company_name);
		$logo_path = base_url()."assets/images/logo-$company_code.png";
		
		$date_f0  = set_date('d-m-Y', $date_f);
		$date_t0  = set_date('d-m-Y', $date_t);
		$html_head = "<html><head>
		<style>
		.logo 	{ float: left; margin-top: -80px; width: 100px; height: 100px; }
		body  	{ font-family: Courier; font-size: 10pt; }
		td 		{ vertical-align: top; }
		.top-border 	{ border-top: 0.1mm solid #000000; }
		.bottom-border 	{ border-bottom: 0.1mm solid #000000; }
		.left-border 	{ border-left: 0.1mm solid #000000; }
		.right-border 	{ border-right: 0.1mm solid #000000; }
		table thead td { 
			text-align: center;
			border: 0.1mm solid #000000;
			border-collapse: collapse;
		}
		.items td {
			border-left: 0.1mm solid #000000;
			border-right: 0.1mm solid #000000;
		}
		.items td.blanktotal {
			background-color: #FFFFFF;
			border: 0mm none #000000;
			border-top: 0.1mm solid #000000;
			/* border-right: 0.1mm solid #000000; */
		}		
		.items td.totals {
			text-align: right;
			border: 0.1mm solid #000000;
		}
		</style>
		</head>
		<body>
		
		<!--mpdf
		<htmlpageheader name='myheader'>
			<div class='logo'><img src='$logo_path' width='100' /></div>
			<table width='100%'>
				<tr><td><center><h1>$company_name</h1></center></td></tr>
				<tr><td><center>|||</center></td></tr>
				<tr><td><center><h3>LAPORAN STOCK TERLARIS (TOP 50)</h3></center></td></tr>
				<tr><td><center>PERIODE : $date_f0 S/D $date_t0</center></td></tr>
			</table>
		</htmlpageheader>

		<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
		mpdf-->";
		$mpdf->WriteHTML($html_head);
		$mpdf->SetFooter("|Page {PAGENO} of {nb}|Printed @ ". date('d M Y H:i'));
		
		$header = "
		<table class='items' width='100%' style='margin-top: 1.25em; border-collapse: collapse;' cellpadding='8'>
		<thead>
			<tr>
				<td style='width:5%;'><strong>NO.</strong></td>
				<td style='width:10%;'><strong>KODE ITEM</strong></td>
				<td style='width:10%;'><strong>NAMA ITEM</strong></td>
				<td style='width:10%;'><strong>KATEGORI</strong></td>
				<td style='width:10%;'><strong>HARGA</strong></td>
				<td style='width:10%;'><strong>QTY</strong></td>
				<td style='width:10%;'><strong>DISC.</strong></td>
				<td style='width:10%;'><strong>TOTAL</strong></td>
			</tr>
		</thead>
		<tbody>";
		$mpdf->WriteHTML($header);
		
		$query = "SELECT * ".
				"FROM vitem_top_50 ".
				"WHERE vitem_top_50.date BETWEEN '$date_f' AND '$date_t' ".
				"LIMIT 0, 50";
		
		$qry_h = $this->db->query($query);
		if ($qry_h->num_rows() < 1) 
			show_error( l('report_no_data') );
		
		$num = 1;
		foreach ( $qry_h->result() as $row_h ) {
			$col01 = $num;
			$col02 = $row_h->item_code;
			$col03 = $row_h->item_name;
			$col04 = $row_h->item_cat_name;
			$col05 = number_format($row_h->price_sell, 2, '.', ',');
			$col06 = number_format($row_h->item_qty, 0, '.', '');
			$col07 = number_format($row_h->disc_amount, 2, '.', ',');
			$col08 = number_format($row_h->sub_total, 2, '.', ',');
			
			$detail = "
				<tr>
					<td align='right'>$col01</td>
					<td>$col02</td>
					<td>$col03</td>
					<td>$col04</td>
					<td align='right'>$col05</td>
					<td align='right'>$col06</td>
					<td align='right'>$col07</td>
					<td align='right'>$col08</td>
				</tr>
			";
			$mpdf->WriteHTML($detail);
			$num++;
		}
			
		$footer = "
				<tr>
					<td colspan='8' class='blanktotal'></td>
				</tr>
				</tbody>
			</table>";
		$mpdf->WriteHTML($footer);
			
		$mpdf->WriteHTML("</body></html>");
		$mpdf->Output();
	}
	
	
//TODO: IMPORT FROM EXCELL TO MYSQL

//TODO: Rapikan DASHBOARD
}