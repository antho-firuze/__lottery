<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// session_start(); //we need to call PHP's session object to access it through CI

class Fin extends CI_Controller {

	private $mdl_grp = 'fin';
		
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('fin_model');
		$this->load->model('shared/shared_model');
		$this->load->model('systems/systems_model');
	}

	function index() {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		redirect('main', 'refresh');
	}
	
	function ar( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	   = 'ar';
		$user_id   = $this->session->userdata('user_id');
		$period_id = $this->session->userdata('period_id');
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				
			// DETAIL
			$details = json_decode($data['detail']);
			if ( empty($details) )
				crud_error('Detail is empty !');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['period_id']   = $data['period_id'];
				$data1['date'] 		  = db_date_format($data['date']);
				$data1['customer_id'] = $data['customer_id'];
				$data1['currency_id'] = $data['currency_id'];
				$data1['currency_rate'] = getCurrencyById($data['currency_id'])->rate;
				$data1['cash_bank_id'] = $data['cash_bank_id'];
				if ( array_key_exists('coa_id', $data) ) $data1['coa_id'] = $data['coa_id'];
				if ( array_key_exists('payment_type_id', $data) ) $data1['payment_type_id'] = $data['payment_type_id'];
				$data1['ref_no'] 	  = strtoupper($data['ref_no']);
				$data1['note'] 		  = strtoupper($data['note']);
				$data1['create_by']   = $user_id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$result = $this->fin_model->AddNewAR($data1);
				if ( ! $result['success'] )
					crud_error($result['errorMsg']);
					
				foreach ($details as $row)
				{
					$data2['ar_id'] 	    = $result['id'];
					$data2['invoice_id'] 	= $row->invoice_id;
					$data2['invoice_dt_id'] = $row->id;
					$data2['currency_id']   = $data['currency_id'];
					$data2['currency_rate']   = getCurrencyById($data['currency_id'])->rate; 
					if ( array_key_exists('coa_c', $row) ) $data2['coa_id'] = $row->coa_c;
					if ( array_key_exists('doc_no', $row) ) $data2['doc_no'] = strtoupper($row->doc_no);
					if ( array_key_exists('note', $row) ) $data2['note'] = strtoupper($row->note);
					$data2['doc_amount'] 	 = $row->balance_amount;
					$data2['amount'] 		 = $row->pay_amount;
					$data2['doc_balance'] = $row->balance_amount - $row->pay_amount;
					$this->db->insert('ar_dt', $data2);
					
					$this->fin_model->updateInvoicePaymentById( $row->invoice_id );
				}
				
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
				$params['like']['ar.code'] = $params['q'];
				$params['like']['ar.ref_no'] = $params['q'];
				$params['like']['ar.note'] = $params['q'];
				$params['like']['cus.name'] = $params['q'];
			}	
			
			if ( !empty($params['date_f']) && !empty($params['date_t']) ) {
				$params['where']['date >='] = db_date_format($params['date_f']);
				$params['where']['date <='] =db_date_format($params['date_t']);
			}
			
			if ( $params['status'] == 1 )
				$params['where']['void'] = 1;
			if ( $params['status'] == 2 )
				$params['where']['posted'] = 1;
				
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['ar.code']  = $params['findVal'];
					$params['like']['ar.ref_no']  = $params['findVal'];
					$params['like']['ar.note']  = $params['findVal'];
					$params['like']['cus.name'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->fin_model->getAR($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				// crud_error($data['date']);
			
			$qry = $this->db->get_where('ar', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['currency_id'] = $data['currency_id'];
				$data1['cash_bank_id'] = $data['cash_bank_id'];
				if ( array_key_exists('coa_id', $data) ) $data1['coa_id'] = $data['coa_id'];
				if ( array_key_exists('payment_type_id', $data) ) $data1['payment_type_id'] = ($data['cash_bank_id']==1) ? 0 : $data['payment_type_id'];
				$data1['ref_no'] 	  = strtoupper($data['ref_no']);
				if ( array_key_exists('note', $data) ) $data1['note'] = strtoupper($data['note']);
				$data1['update_by']   = $user_id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'ar', $data1, array('id'=>$data['id']) );
				
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
			
			$qry = $this->db->get_where('ar', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			
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
		
		if ( $action == 'v' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('ar', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['void'] = 1;
				$this->db->update( 'ar', $data1, array('id'=>$data['id']) );
				$this->db->update( 'ar_dt', $data1, array('ar_id'=>$data['id']) );
				
				$this->db->distinct('invoice_id');
				$this->db->from('ar_dt');
				$this->db->where('ar_id', $data['id']);
				$qry = $this->db->get();
				foreach ($qry->result() as $row)
				{
					$this->fin_model->updateInvoicePaymentById( $row->invoice_id );
				}
					
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
			
			$qry = $this->db->get_where('ar', array('id'=>$data['id']));
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$result = $this->fin_model->procPosting_AR( $data['id'] );
				if ( !empty($result['errorMsg'])  )
					crud_error($result['errorMsg']);
					
				// $data1['posted'] = 1;
				// $this->db->update( 'ar', $data1, array('id'=>$data['id']) );
				
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
			
			$qry = $this->db->get_where('ar', array('id'=>$data['id']));
			if (!$qry->row()->posted) crud_error('error_data_unposted');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['posted'] = 0;
				$this->db->update( 'ar', $data1, array('id'=>$data['id']) );
				
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

	function ar_dt( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'ar';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['ar_id'] 	  	= $data['ar_id'];
				$data1['invoice_id']  	= $data['invoice_id'];
				$data1['invoice_dt_id'] = $data['invoice_dt_id'];
				$data1['currency_id'] 	= $data['currency_id'];
				$data1['currency_rate'] = getCurrencyById($data['currency_id'])->rate;
				$data1['doc_amount']  	= $data['doc_amount'];
				$data1['amount'] 	  	= $data['amount'];
				if ( array_key_exists('coa_id', $data) ) $data1['coa_id'] = $data['coa_id'];
				if ( array_key_exists('doc_no', $data) ) $data1['doc_no'] = strtoupper($data['doc_no']);
				if ( array_key_exists('note', $data) ) $data1['note'] = strtoupper($data['note']);
				$this->db->insert('ar_dt', $data1);
				
				$this->fin_model->updateInvoicePaymentById( $data['invoice_id'] );
					
				$this->fin_model->updateTotalAmount('ar', $data['ar_id']);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['ar_id'] = $params['ar_id'];
			
			$result = $this->fin_model->getAR_Dt($params);
			
			// ADDING FOOTER
			$total_amount 	= 0;
			$doc_amount 	= 0;
			$doc_balance 	= 0;
			foreach ($result->rows as $row)
			{
				$total_amount 	+= $row->amount;
				$doc_amount 	+= $row->doc_amount;
				$doc_balance 	+= $row->doc_balance;
			}
			$footer[0]['currency_code'] = 'TOTAL';
			$footer[0]['doc_amount'] 	= $doc_amount;
			$footer[0]['doc_balance'] 	= $doc_balance;
			$footer[0]['amount'] 		= $total_amount;
			
			$result->footer = $footer;
			crud_result( $result );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$data = json_decode($data['data']);
				
			$qry = $this->db->get_where('ar', array('id'=>$data[0]->ar_id));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// GET PAYMENT AMOUNT BEFORE UPDATE
			// $old_amount = $this->db->get_where('ar_dt', array('id'=>$data[0]->id))->row()->amount;
			// $new_amount = $data[0]->amount;
			
			// if ( ($old_amount - $new_amount) < 0 ) 
				// $new_amount = abs($old_amount - $new_amount);
			// else
				// $new_amount = -($old_amount - $new_amount);
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['currency_id'] = $data[0]->currency_id;
				$data1['currency_rate'] = getCurrencyById($data[0]->currency_id)->rate; 
				if ( array_key_exists('coa_id', $data[0]) ) $data1['coa_id'] = $data[0]->coa_id;
				$data1['doc_no'] 	  = strtoupper($data[0]->doc_no);
				$data1['doc_amount']  = $data[0]->doc_amount;
				$data1['doc_balance'] = $data[0]->doc_balance;
				$data1['amount'] 	  = $data[0]->amount;
				$data1['note'] 	  	  = strtoupper($data[0]->note);
				$this->db->update( 'ar_dt', $data1, array('id'=>$data[0]->id) );
				
				$this->fin_model->updateInvoicePaymentById( $data[0]->invoice_id );
				
				$this->fin_model->updateTotalAmount('ar', $data[0]->ar_id);
				
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
			
				$this->db->delete( 'ar_dt', array('id'=>$data['id']) );
				
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
			
			$qry = $this->db->get_where('ar', array('id'=>$data['ar_id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['void'] = 1;
				$this->db->update( 'ar_dt', $data1, array('id'=>$data['id']) );
				
				$this->fin_model->updateInvoicePaymentById( $data['invoice_id'] );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
	}

	function opt_cash_bank( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			crud_result( $this->fin_model->getOpt_Cash_Bank($params) );
		}
	}

	function opt_payment_type( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['cash_bank_id'] = 2;	// 2=BANK
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			crud_result( $this->fin_model->getOpt_Payment_Type($params) );
		}
	}

	function opt_paym_recv( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			crud_result( $this->fin_model->getOpt_Paym_Recv($params) );
		}
	}

	function cb( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'cb';
		$user_id 		= $this->session->userdata('user_id');
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				
			// DETAIL
			// $details = json_decode($data['detail']);
			// if ( empty($details) )
				// crud_error('Detail is empty !');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['date'] 		  = db_date_format($data['date']);
				$data1['paym_recv_id'] = $data['paym_recv_id'];
				$data1['currency_id'] = $data['currency_id'];
				$data1['currency_rate'] = getCurrencyById($data['currency_id'])->rate;
				$data1['cash_bank_id'] = $data['cash_bank_id'];
				if ( array_key_exists('coa_id', $data) ) $data1['coa_id'] = $data['coa_id'];
				$data1['ref_no'] 	  = strtoupper($data['ref_no']);
				$data1['note'] 		  = strtoupper($data['note']);
				$data1['create_by']   = $user_id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$result = $this->fin_model->AddNewCB($data1);
				
				// foreach ($details as $row)
				// {
					// $data2['cb_id']  = $result['id'];
					// if ( array_key_exists('coa_id', $row) ) $data2['coa_id'] = $row->coa_id;
					// if ( array_key_exists('coa_type_id', $row) ) $data2['coa_type_id'] = strtoupper($row->coa_type_id);
					// if ( array_key_exists('note', $row) ) $data2['note'] = strtoupper($row->note);
					// $data2['amount'] = $row->amount;
					// $this->db->insert('cb_dt', $data2);
				// }
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success($result);
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['cb.code'] = $params['q'];
				$params['like']['cb.ref_no'] = $params['q'];
				$params['like']['cb.note'] = $params['q'];
			}	
			
			if ( !empty($params['date_f']) && !empty($params['date_t']) ) {
				$params['where']['date >='] = db_date_format($params['date_f']);
				$params['where']['date <='] =db_date_format($params['date_t']);
			}
			
			if ( $params['status'] == 1 )
				$params['where']['void'] = 1;
			if ( $params['status'] == 2 )
				$params['where']['posted'] = 1;
				
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['cb.code']  = $params['findVal'];
					$params['like']['cb.ref_no'] = $params['findVal'];
					$params['like']['cb.note'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->fin_model->getCB($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				// crud_error($data['date']);
			
			$qry = $this->db->get_where('cb', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['date'] 		  = db_date_format($data['date']);
				$data1['paym_recv_id'] = $data['paym_recv_id'];
				$data1['currency_id'] = $data['currency_id'];
				$data1['currency_rate'] = getCurrencyById($data['currency_id'])->rate;
				$data1['cash_bank_id'] = $data['cash_bank_id'];
				if ( array_key_exists('coa_id', $data) ) $data1['coa_id'] = $data['coa_id'];
				$data1['ref_no'] 	  = strtoupper($data['ref_no']);
				$data1['note'] 		  = strtoupper($data['note']);
				$data1['update_by']   = $user_id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'cb', $data1, array('id'=>$data['id']) );
				
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
			
			$qry = $this->db->get_where('cb', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				// $this->db->delete( 'cb', array('id'=>$data['id']) );
				
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
			
			$qry = $this->db->get_where('cb', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['void'] = 1;
				$this->db->update( 'cb', $data1, array('id'=>$data['id']) );
				$this->db->update( 'cb_dt', $data1, array('cb_id'=>$data['id']) );
				
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
			
			$qry = $this->db->get_where('cb', array('id'=>$data['id']));
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['posted'] = 1;
				$this->db->update( 'cb', $data1, array('id'=>$data['id']) );
				
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
			
			$qry = $this->db->get_where('cb', array('id'=>$data['id']));
			if (!$qry->row()->posted) crud_error('error_data_unposted');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['posted'] = 0;
				$this->db->update( 'cb', $data1, array('id'=>$data['id']) );
				
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

	function cb_dt( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'cb';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['cb_id']  = $data['cb_id'];
				if ( array_key_exists('coa_id', $data) ) $data1['coa_id'] = $data['coa_id'];
				$data1['amount'] = $data['amount'];
				$data1['ref_no'] = strtoupper($data['ref_no']);
				$data1['note'] 	 = strtoupper($data['note']);
				$this->db->insert('cb_dt', $data1);
					
				$this->fin_model->updateTotalAmount('cb', $data['cb_id']);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['cb_id'] = $params['cb_id'];
			
			$result = $this->fin_model->getCB_Dt($params);
			
			// ADDING FOOTER
			$total_amount 	= 0;
			foreach ($result->rows as $row)
			{
				$total_amount 	+= $row->amount;
			}
			$footer[0]['coa_code'] = 'TOTAL';
			$footer[0]['amount']   = $total_amount;
			
			$result->footer = $footer;
			crud_result( $result );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('cb', array('id'=>$data['cb_id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				if ( array_key_exists('coa_id', $data[0]) ) $data1['coa_id'] = $data['coa_id'];
				$data1['amount'] = $data['amount'];
				$data1['ref_no'] = strtoupper($data['ref_no']);
				$data1['note'] 	 = strtoupper($data['note']);
				$this->db->update( 'cb_dt', $data1, array('id'=>$data['id']) );
				
				$this->fin_model->updateTotalAmount('cb', $data['cb_id']);
				
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
			
				// $this->db->delete( 'cb_dt', array('id'=>$data['id']) );
				
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
			
			$qry = $this->db->get_where('cb', array('id'=>$data['cb_id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['void'] = 1;
				$this->db->update( 'cb_dt', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
	}

}