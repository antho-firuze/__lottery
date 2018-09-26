<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// session_start(); //we need to call PHP's session object to access it through CI

class Acc extends CI_Controller {

	private $mdl_grp = 'acc';
		
	function __construct() 
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');

		$this->load->model('acc_model');
		$this->load->model('shared/shared_model');
		$this->load->model('systems/systems_model');
	}

	function index() 
	{
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		redirect('main', 'refresh');
	}
	
	function opt_journal_type( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			if ( !empty($params['q']) )
			{
				$params['like']['code'] = $params['q'];
				$params['like']['name'] = $params['q'];
			}	
			
			crud_result( $this->acc_model->getOpt_Ledger_Type($params) );
		}
	}

	function coa( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');
		
		$mdl 	 = 'coa';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// if ( $this->shared_model->is_duplicate_code('opt_invoice_type', $data['code_new']) ) 
				// crud_error("error_duplicate_code");
				
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$count = $this->db->count_all_results('opt_invoice_type');
				
				$data1['code'] = strtoupper($data['code_new']);
				$data1['name'] = strtoupper($data['name']);
				$data1['parent_id'] = $data['parent_id'];
				$data1['depth_level'] = $data['depth_level'];
				$data1['has_child'] = $data['has_child'];
				$data1['is_default'] = array_key_exists('is_default', $data) ? 1 : 0;
				$data1['is_cash'] = array_key_exists('is_cash', $data) ? 1 : 0;
				$data1['is_debit'] = array_key_exists('is_debit', $data) ? 1 : 0;
				$data1['is_balance'] = array_key_exists('is_balance', $data) ? 1 : 0;
				$data1['is_profit_lost'] = array_key_exists('is_profit_lost', $data) ? 1 : 0;
				$data1['beginning_balance_d'] = $data['beginning_balance_d'];
				$data1['beginning_balance_c'] = $data['beginning_balance_c'];
				$data1['mutasi_d'] = $data['mutasi_d'];
				$data1['mutasi_c'] = $data['mutasi_c'];
				$data1['final_balance_d'] = $data['final_balance_d'];
				$data1['final_balance_c'] = $data['final_balance_c'];
				$data1['currency_id'] = $data['currency_id'];
				$data1['coa_type_id'] = $data['coa_type_id'];
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$this->acc_model->AddNewCOA($data1);
				
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
				$params['like']['c.id'] = $params['q'];
				$params['like']['c.code'] = $params['q'];
				$params['like']['c.name'] = $params['q'];
			}	
			
			crud_result( $this->acc_model->getCOA($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// if ( $this->shared_model->is_duplicate_code('opt_invoice_type', $data['code_new']) ) 
				// crud_error("error_duplicate_code");
				
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$count = $this->db->count_all_results('opt_invoice_type');
				
				$data1['code'] = strtoupper($data['code_new']);
				$data1['name'] = strtoupper($data['name']);
				$data1['parent_id'] = $data['parent_id'];
				$data1['depth_level'] = $data['depth_level'];
				$data1['has_child'] = $data['has_child'];
				$data1['is_default'] = array_key_exists('is_default', $data) ? 1 : 0;
				$data1['is_cash'] = array_key_exists('is_cash', $data) ? 1 : 0;
				$data1['is_debit'] = array_key_exists('is_debit', $data) ? 1 : 0;
				$data1['is_balance'] = array_key_exists('is_balance', $data) ? 1 : 0;
				$data1['is_profit_lost'] = array_key_exists('is_profit_lost', $data) ? 1 : 0;
				$data1['beginning_balance_d'] = $data['beginning_balance_d'];
				$data1['beginning_balance_c'] = $data['beginning_balance_c'];
				$data1['mutasi_d'] = $data['mutasi_d'];
				$data1['mutasi_c'] = $data['mutasi_c'];
				$data1['final_balance_d'] = $data['final_balance_d'];
				$data1['final_balance_c'] = $data['final_balance_c'];
				$data1['currency_id'] = $data['currency_id'];
				$data1['coa_type_id'] = $data['coa_type_id'];
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->acc_model->AddNewCOA($data1);
				
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
			
			// $qry = $this->db->get_where('coa', array('id'=>$data['id']));
			// if ($qry->row()->auto) crud_error('Error: Protected!');
			
			
			// $count = $this->db->where('invoice_type_id', $data['id'])->count_all_results('invoice_dt');
			// if ($count > 0)
				// crud_error("Error: This data has transaction!");
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				// $this->db->delete( 'coa', array('id'=>$data['id']) );
				
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

	function gl( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'gl';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['date'] 		  = db_date_format($data['date']);
				// $data1['currency_id'] = $data['currency_id'];
				// $data1['currency_rate'] = getCurrencyById($data['currency_id'])->rate;
				$data1['journal_type_id'] = $data['journal_type_id'];
				$data1['ref_no'] 	  = strtoupper($data['ref_no']);
				$data1['note'] 		  = strtoupper($data['note']);
				$data1['create_by']   = sesUser()->id;
				$data1['create_date'] = date('Y-m-d H:i:s');
				$result = $this->acc_model->AddNewGL($data1);
				
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
				$params['like']['gl.code'] = $params['q'];
				$params['like']['gl.ref_no'] = $params['q'];
				$params['like']['gl.note'] = $params['q'];
			}	
			
			if ( !empty($params['date_f']) && !empty($params['date_t']) ) {
				$params['where']['date >='] = db_date_format($params['date_f']);
				$params['where']['date <='] = db_date_format($params['date_t']);
			}
			
			if ( $params['status'] == 1 )
				$params['where']['void'] = 1;
			if ( $params['status'] == 2 )
				$params['where']['posted'] = 1;
				
			if ( !empty($params['findKey']) && !empty($params['findVal']) )
				if ( $params['findKey']=='ALL' ) 
				{
					$params['like']['gl.code']  = $params['findVal'];
					$params['like']['gl.ref_no'] = $params['findVal'];
					$params['like']['gl.note'] = $params['findVal'];
				} 
				// else
					// $params['like']['p.'.$params['findKey']] = $params['findVal'];
			
			crud_result( $this->acc_model->getGL($params) );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				// crud_error($data['date']);
			
			$qry = $this->db->get_where('gl', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['date'] 		  = db_date_format($data['date']);
				// $data1['currency_id'] = $data['currency_id'];
				// $data1['currency_rate'] = getCurrencyById($data['currency_id'])->rate;
				$data1['journal_type_id'] = $data['journal_type_id'];
				$data1['ref_no'] 	  = strtoupper($data['ref_no']);
				$data1['note'] 		  = strtoupper($data['note']);
				$data1['update_by']   = sesUser()->id;
				$data1['update_date'] = date('Y-m-d H:i:s');
				$this->db->update( 'gl', $data1, array('id'=>$data['id']) );
				
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
			
			$qry = $this->db->get_where('gl', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
			
				// $this->db->delete( 'gl', array('id'=>$data['id']) );
				
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
			
			$qry = $this->db->get_where('gl', array('id'=>$data['id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['void'] = 1;
				$this->db->update( 'gl', $data1, array('id'=>$data['id']) );
				$this->db->update( 'gl_dt', $data1, array('gl_id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'post' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('gl', array('id'=>$data['id']));
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['posted'] = 1;
				$this->db->update( 'gl', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'unpost' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('gl', array('id'=>$data['id']));
			if (!$qry->row()->posted) crud_error('error_data_unposted');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['posted'] = 0;
				$this->db->update( 'gl', $data1, array('id'=>$data['id']) );
				
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

	function gl_dt( $action=NULL ) 
	{
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl 	 = 'gl';
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			
			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				// crud_error($data['gl_id']);
				
				$data1['gl_id']  		= $data['gl_id'];
				if ( array_key_exists('coa_id', $data) ) $data1['coa_id'] = $data['coa_id'];
				$data1['dc'] 			= $data['dc'];
				$data1['currency_id'] 	= $data['currency_id'];
				$data1['currency_rate'] = $data['currency_rate'];
				$data1['currency_amount'] = $data['currency_amount'];
				$data1['debit']  		= ( $data['dc'] == 'D' ) ? $data['currency_amount'] : 0;
				$data1['credit'] 		= ( $data['dc'] == 'C' ) ? $data['currency_amount'] : 0;
				// $data1['ref_no'] 		= strtoupper($data['ref_no']);
				$data1['note'] 	 		= strtoupper($data['note']);
				$this->db->insert('gl_dt', $data1);
					
				// $this->acc_model->updateTotalAmount('gl', $data['gl_id']);
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
		
		if ( $action == 'r' ) {
			$params = $this->input->post();
			
			$params['where']['gl_id'] = $params['gl_id'];
			
			$result = $this->acc_model->getGL_Dt($params);
			
			// ADDING FOOTER
			$total_db 	= 0;
			$total_cr 	= 0;
			foreach ($result->rows as $row)
			{
				$total_db 	+= $row->debit;
				$total_cr 	+= $row->credit;
			}
			$footer[0]['coa_code'] = 'TOTAL';
			$footer[0]['debit']    = $total_db;
			$footer[0]['credit']   = $total_cr;
			$footer[1]['coa_code'] = 'BALANCE';
			$footer[1]['debit']	   = '';
			$footer[1]['credit']   = $total_db - $total_cr;
			
			$result->footer = $footer;
			crud_result( $result );
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();

			// ============= VALIDITY SECTION
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$qry = $this->db->get_where('gl', array('id'=>$data['gl_id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['gl_id']  		= $data['gl_id'];
				if ( array_key_exists('coa_id', $data) ) $data1['coa_id'] = $data['coa_id'];
				$data1['dc'] 			= $data['dc'];
				$data1['currency_id'] 	= $data['currency_id'];
				$data1['currency_rate'] = $data['currency_rate'];
				$data1['currency_amount'] = $data['currency_amount'];
				$data1['debit']  		= ( $data['dc'] == 'D' ) ? $data['currency_amount'] : 0;
				$data1['credit'] 		= ( $data['dc'] == 'C' ) ? $data['currency_amount'] : 0;
				// $data1['ref_no'] 		= strtoupper($data['ref_no']);
				$data1['note'] 	 		= strtoupper($data['note']);
				$this->db->update( 'gl_dt', $data1, array('id'=>$data['id']) );
				
				// $this->acc_model->updateTotalAmount('gl', $data['gl_id']);
				
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
			
				// $this->db->delete( 'gl_dt', array('id'=>$data['id']) );
				
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
			
			$qry = $this->db->get_where('gl', array('id'=>$data['gl_id']));
			if ($qry->row()->posted) crud_error('error_data_posted');
			if ($qry->row()->void) crud_error('error_data_void');
			
			// ============= CRUD SECTION
			$this->db->trans_begin();
			try {
				
				$data1['void'] = 1;
				$this->db->update( 'gl_dt', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			crud_success();
		}
	}

	function form_journal_voucher($id)
	{
		$this->load->library('mpdf');
		// ob_end_clean();

		$company	= $this->systems_model->getCompany_ById($this->session->userdata('company_id'));
		$branch		= $this->systems_model->getBranch_ById($this->session->userdata('branch_id'));
		$department	= $this->systems_model->getDepartment_ById($this->session->userdata('department_id'));
		$document	= $this->systems_model->getSetup_Documents_ByCode('GL');
		
		//=====================================================================================================\\
		// DEFAULT Values
		// margin_left 15
		// margin_right 15
		// margin_top 16
		// margin_bottom 16
		// margin_header 9
		// margin_footer 9
		$mpdf = new mPDF( 'utf-8', array(210,297),'','',15,15,40,16,10,10 ); 	//	FORMAT A4 
		$mpdf->SetTitle(strtoupper($company->name)." - ".$document->name);
		$mpdf->SetAuthor($company->name);
		$logo_path = base_url()."assets/images/logo-$company->code.png";
		
		$html_head = "<html><head>
		<style>
		.logo 	{ float: left; margin-top: -80px; width: 100px; height: 100px; }
		body  	{ font-family: Courier; font-size: 10pt; }
		td 		{ vertical-align: top; padding-bottom:2px; }
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
			border-bottom: 0.1mm solid #000000;
		}
		.items td.blanktotal {
			background-color: #FFFFFF;
			border: 0mm none #000000;
			border-top: 0.1mm none #000000;
			border-right: 0.1mm solid #000000;
		}		
		.items td.totals_label {
			text-align: left;
			border: 0.1mm solid #000000;
		}
		.items td.totals_value {
			text-align: right;
			border: 0.1mm solid #000000;
		}
		p {
			margin-top:0px;
			margin-left:30px;
		}
		</style>
		</head>
		<body>
		
		<!--mpdf
		<htmlpageheader name='myheader'>
			<div class='logo'><img src='$logo_path' width='100' /></div>
			<table width='100%'>
				<tr>
					<td align='left'><h2>$company->name</h2></td>
					<td align='right'><h2>JOURNAL VOUCHER</h2></td>
				</tr>
			</table>
		</htmlpageheader>

		<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
		mpdf-->";
		$mpdf->WriteHTML($html_head);
		$mpdf->SetFooter("|Page {PAGENO} of {nb}|Printed @ ". date('d M Y H:i'));
		
		$row_h = $this->acc_model->getGL_ById($id);
		if ( !$row_h ) 
			show_error( l('report_no_data') );
		
		if ( $row_h->void ) 
		{
			$mpdf->SetWatermarkText('VOID');
			$mpdf->showWatermarkText = true;
		}
		
		$L1C1 = $row_h->code;
		$L1C2 = date('d M Y', strtotime($row_h->date));
		$L2C1 = title_case($row_h->ref_no);
		$L2C2 = title_case($row_h->ledger_type_name);
		$L3C1 = title_case(str_replace(chr(13),"<br />",$row_h->note)); 
		// $note_h = str_replace(chr(13),"<br />",$row_h->note);
		
		$header = "
		<table style='width: 100%; margin-top:0px; border:0; border-collapse:collapse;'>
			<tr>
				<td style='width: 15%;'><strong>Doc. No :</strong></td>
				<td style='width: 40%;'>$L1C1</td>
				<td style='width: 10%;'><strong>Date :</strong></td>
				<td style='width: 35%;'>$L1C2</td>
			</tr>
			<tr>
				<td><strong>Reference :</strong></td>				
				<td>$L2C1</td>
				<td><strong>Type :</strong></td>					
				<td>$L2C2</td>					
			</tr>
			<tr>
				<td><strong>Note :</strong></td>
				<td colspan='3'>$L3C1</td>
			</tr>
		</table>
		
		<table class='items' width='100%' style='margin-top: 1.25em; border-collapse: collapse;' cellpadding='8'>
		<thead>
			<tr>
				<td align='left' style='width:17%;'><strong>Account Code</strong></td>
				<td style='width:35%;'><strong>Description</strong></td>
				<td rowspan='2' style='width:10%;'><strong>Curr</strong></td>
				<td rowspan='2' style='width:15%;'><strong>Rate</strong></td>
				<td rowspan='2' style='width:20%;'><strong>Debit</strong></td>
				<td rowspan='2' style='width:20%;'><strong>Credit</strong></td>
			</tr>
			<tr>
				<td colspan='2' align='left'><strong>Account Name</strong></td>
			</tr>
			<tr>
				<td colspan='6' align='left' style='height:5px;'>&nbsp;</td>
			</tr>
		</thead>
		<tbody>";
		$mpdf->WriteHTML($header);
		
		$this->db->select('gd.*, c.code as coa_code, c.name as coa_name, cu.code as currency_code, cu.name as currency_name');
		$this->db->from('gl_dt as gd');
		$this->db->join('coa as c', 'gd.coa_id = c.id', 'left');
		$this->db->join('currency as cu', 'gd.currency_id = cu.id', 'left');
		$this->db->where('gd.gl_id', $row_h->id);
		$this->db->order_by('id');
		$qry_d = $this->db->get();
		if ( $qry_d->num_rows() > 0 ) {
			$num = 1;
			$tot_d = 0;
			$tot_c = 0;
			foreach ( $qry_d->result() as $row_d ) {
				$col01 = $row_d->coa_code;
				$col02 = $row_d->coa_name;
				$col03 = title_case($row_d->note);
				$col04 = $row_d->currency_code;
				$col05 = number_format($row_d->currency_rate, 2, '.', ',');
				$col06 = number_format($row_d->debit, 2, '.', ',');
				$col07 = number_format($row_d->credit, 2, '.', ',');
				$detail = "
					<tr>
						<td>$col01</td>
						<td>$col03</td>
						<td align='center'>$col04</td>
						<td align='right'>$col05</td>
						<td align='right'>$col06</td>
						<td align='right'>$col07</td>
					</tr>
					<tr>
						<td colspan='2'>$col02</td>
						<td colspan='4'>&nbsp;</td>
					</tr>
					";
				$mpdf->WriteHTML($detail);
				$tot_d += $row_d->debit;
				$tot_c += $row_d->credit;
				$num++;
			}
		}
		
		$create_by_name = empty($row_h->create_by_name) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : title_case($row_h->create_by_name);
		$sign1 = empty($document->sign1) ? '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : title_case($document->sign1);
		$footer = "
				<tr>
					<td colspan='4' class='totals_label'><strong>Total</strong></td>
					<td class='totals_value'><strong>". number_format($tot_d, 2, '.', ',') ."</strong></td>
					<td class='totals_value'><strong>". number_format($tot_c, 2, '.', ',') ."</strong></td>
				</tr>
				</tbody>
			</table>
			<br><br><br><br>
			<table width='100%' border='0'>
				<tr>
					<td width='60%'>This Journal Voucher was prepared by <strong><u>$create_by_name</u></strong></td>
					<td width='5%'>&nbsp;</td>
					<td width='35%'>APPROVED BY <u>$sign1</u></td>
				</tr>
			</table>
		";
		$mpdf->WriteHTML($footer);
		
		$mpdf->WriteHTML("</body></html>");
		$mpdf->Output();
	}
}