<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// session_start(); //we need to call PHP's session object to access it through CI

class Sales extends CI_Controller {

	private $mdl_grp	= 'sales';
		
	function __construct() {
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		// $this->load->model('common_models');
	}

	function index() {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		redirect('main', 'refresh');
	}

	function so( $action=NULL ) {
		if (!$this->ion_auth->logged_in()) 
			redirect('main', 'refresh');

		$mdl = 'so';
		$mod = $this->shared_model->get_module_name($this->mdl_grp, $mdl);
		
		$user_id	 	= $this->session->userdata('user_id');
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		$department_id	= $this->session->userdata('department_id');
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");

			$this->db->trans_begin();
			
			try {
				
				$doc_code = get_doc_code($company_id, $branch_id, $department_id, 'SO');
				if (!$doc_code)
					crud_error("error_get_doc_code");
				
				$data1['company_id']	= $company_id;
				$data1['branch_id'] 	= $branch_id;
				$data1['department_id'] = $department_id;
				$data1['code'] 	   		= $doc_code;
				$tmp = explode('/', $data['date']);
				$data1['date'] 			= $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
				$data1['note'] 	   		= array_key_exists('note', $data) ? strtoupper($data['note']) : NULL;
				$data1['customer_id'] 	= $data['customer_id'];
				$data1['status_id'] 	= 1;
				$data1['draft'] 		= array_key_exists('draft', $data) ? 1 : 0;
				$data1['create_by'] 	= $user_id;
				$data1['create_date'] 	= date('Y-m-d H:i:s');
				$this->db->insert('so', $data1);
				
				$result = set_doc_last_number($company_id, $branch_id, $department_id, 'SO', $doc_code);
				if (!$result)
					crud_error("error_set_doc_last_number");
				
			} catch (Exception $e) {  
				crud_error($e->getMessage());
			} 
			
			$this->db->trans_commit();
			echo json_encode(array("success"=>1));
			return;
		}
		
		if ( $action == 'r' ) {
			// $this->session->set_userdata(array('last_url'=>"$this->mdl_grp/phd_central"));
			$page 	= $this->input->post('page');
			$rows 	= $this->input->post('rows');
			$sort 	= $this->input->post('sort');
			$order 	= $this->input->post('order');
			$page   = !empty($page) ? intval($page) : 1;  
			$rows   = !empty($rows) ? intval($rows) : 100;  //if pagination=false. They not send page & rows. Jadi harus ditampilkan semua !
			$offset = ($page-1)*$rows;
			
			// {begin} additional filter
			$date_f	= $this->input->post('date_f');
			$date_t	= $this->input->post('date_t');
			$status	= $this->input->post('status');
			$findKey = $this->input->post('findKey');
			$findVal = $this->input->post('findVal');
			// {end}
			
			$table	 = 'vso';
			$columns = NULL;
			$sort	 = !empty($sort)?$sort:'id';
			$order	 = !empty($order)?$order:'desc';
			$where	 = array('company_id'=>$company_id, 'branch_id'=>$branch_id, 'department_id'=>$department_id);
			$like	 = NULL;
			
			if ( !empty($date_f) && !empty($date_t) ) {
				$where['date >='] = $date_f;
				$where['date <='] = $date_t;
			}
			
			if ( $status!=0 )
				$where['status_id'] = $status;
				
			if ( !empty($findKey) && !empty($findVal) )
				if ( $findKey=='ALL' ) {
					$like['code'] = $findVal;
					$like['note'] = $findVal;
					$like['customer_name'] = $findVal;
					$like['create_by_name'] = $findVal;
					$like['update_by_name'] = $findVal;
				} else
					$like[$findKey] = $findVal;
			
			$result = $this->shared_model->get_easyui_data($table, $columns, $where, $page, $rows, $sort, $order, $like, TRUE);
			
			echo json_encode($result);
			return;
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				
			// if ( !in_array($data['status_id'], array(2, 4, 11, 12, 29)) )
				// crud_error('error_save');
			
			$this->db->trans_begin();
			
			try {
			
				$tmp = explode('/', $data['date']);
				$data1['date'] 			= $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
				$data1['note'] 	   		= array_key_exists('note', $data) ? strtoupper($data['note']) : NULL;
				$data1['customer_id'] 	= empty($data['customer_id']) ? NULL : $data['customer_id'];
				$data1['draft'] 		= array_key_exists('draft', $data) ? 1 : 0;
				$data1['update_by'] 	= $user_id;
				$data1['update_date'] 	= date('Y-m-d H:i:s');
				$this->db->update( 'so', $data1, array('id'=>$data['id']) ); 
				 
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			$this->shared_model->set_comet('so');
			echo json_encode(array("success"=>1));
			return;
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( !in_array($data['status_id'], array(9)) )
				crud_error('error_data_locked');
				
			// $lot_receipt = $this->db->get_where( 'lot_receipt', array('member_id'=>$data['id']) );
			// if ($lot_receipt->num_rows() > 0)
				// crud_error("This Member has made a receipt !");
				
			$this->db->trans_begin();
			
			try {
			
				// $this->db->delete( 'so_dt', array('so_id'=>$data['id']));
				// $this->db->delete( 'so', array('id'=>$data['id']));
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			echo json_encode(array("success"=>1));
			return;
		}
		
		if ( $action == 'recalc' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// if ( !in_array($data['status_id'], array(1)) )
				// crud_error('error_data_locked');
				
			$this->db->trans_begin();
			
			try {
			
				$result = $this->shared_model->recalc_transaction_per_id( 'so', $data['id'] );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			$this->shared_model->set_comet('so');
			echo json_encode(array("success"=>1));
			return;
		}
		
		if ( $action == 'p' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// if ( !in_array($data['status_id'], array(1)) )
				// crud_error('error_data_locked');
				
			$this->db->trans_begin();
			
			try {
			
				// $result = $this->shared_model->recalc_transaction_per_id( 'so', $data['id'] );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			$this->shared_model->set_comet('so');
			echo json_encode(array("success"=>1));
			return;
		}
		
		if ( !is_allow('r', $this->mdl_grp, $mdl) )
			show_error(l('permission_failed_menu'));
		
		$this->mytemplate->title("$mod->mdl_grp_name :: ".anchor("$this->mdl_grp/$mdl", $mod->mdl_name));
		$this->mytemplate->fire( '', "$this->mdl_grp/$mdl" );
	}
	
	function so_dt( $action=NULL, $so_id=0 ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');

		$mdl 	= 'so_dt';
		
		$user_id	 	= $this->session->userdata('user_id');
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		$department_id	= $this->session->userdata('department_id');
		
		if ( $action == 'c' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			$this->db->trans_begin();
			
			try {
				
				$data1['so_id'] 		= $data['so_id'];
				$data1['item_cat_id'] 	= $data['item_cat_id'];
				$data1['item_id'] 		= $data['item_id'];
				$data1['item_price'] 	= $data['item_price'];
				$data1['item_qty'] 		= $data['item_qty'];
				$data1['measure_id'] 	= $data['measure_id'];
				$data1['currency_id'] 	= $data['currency_id'];
				$data1['currency_rate'] = $data['currency_rate'];
				$data1['disc_percent'] 	= $data['disc_percent'];
				$data1['disc_amount'] 	= $data['disc_amount'];
				$data1['sub_total'] 	= $data['sub_total'];
				$this->db->insert( 'so_dt', $data1 );
				$id = $this->db->insert_id();
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			echo json_encode(array("success"=>1, "result"=>$id));
			return;
		}
		
		if ( $action == 'r' ) {
			$page 	= $this->input->post('page');
			$rows 	= $this->input->post('rows');
			$sort 	= $this->input->post('sort');
			$order 	= $this->input->post('order');
			
			$table	 = 'vso_dt';
			$columns = NULL;
			$sort	 = !empty($sort)?$sort:'id';
			$order	 = !empty($order)?$order:'desc';
			$where	 = array('so_id'=>$so_id);
			$like 	 = NULL;
			
			$result = $this->shared_model->get_easyui_data($table, $columns, $where, $page, $rows, $sort, $order, $like, TRUE);
			
			echo json_encode($result);
			return;
		}
		
		if ( $action == 'u' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			// $row = $this->db->get_where( 'so_dt', array('id'=>$data['id']) )->row();
			//6=DON, 7=REV, 11=NRE, 12=PBP
			// if ( in_array($row->status_id, array(6, 7, 11, 12)) ) 
				// if ( empty($row->code) )
					// crud_error("error_save_before_resp");
				// else
					// crud_error("error_save");
			
			$this->db->trans_begin();
			
			try {

				$data1['so_id'] 		= $data['so_id'];
				$data1['item_cat_id'] 	= $data['item_cat_id'];
				$data1['item_id'] 		= $data['item_id'];
				$data1['item_price'] 	= $data['item_price'];
				$data1['item_qty'] 		= $data['item_qty'];
				$data1['measure_id'] 	= $data['measure_id'];
				$data1['currency_id'] 	= $data['currency_id'];
				$data1['currency_rate'] = $data['currency_rate'];
				$data1['disc_percent'] 	= $data['disc_percent'];
				$data1['disc_amount'] 	= $data['disc_amount'];
				$data1['sub_total'] 	= $data['sub_total'];
				$this->db->update( 'so_dt', $data1, array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			echo json_encode(array("success"=>1));
			return;
		}
		
		if ( $action == 'd' ) {
			$data = $this->input->post();
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
			
			if ( !in_array($data['status_id'], array(9)) )
				crud_error('error_data_locked');
				
			$this->db->trans_begin();
			
			try {
			
				$this->db->delete( 'so_dt', array('id'=>$data['id']) );
				
			} catch (Exception $e) {  
				crud_error( $e->getMessage() );
			} 
			
			$this->db->trans_commit();
			echo json_encode(array("success"=>1));
			return;
		}
		
		// $this->mytemplate->title(strtoupper($this->mdl_grp).' :: '.anchor("$this->mdl_grp/phd_branch", strtoupper("PHD BRANCH")));
		// $this->mytemplate->fire('', 'marketing/phd_branch');
	}
	
	function rpt_phd_list( $type=NULL, $preview=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
			
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		$department_id	= $this->session->userdata('department_id');
		
		if ( $type == 'summary' ) {
			$data = $this->input->post();	// get data from ajax
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				
			$type = strtoupper($type);
			$where['company_id'] = $company_id;
			$where['branch_id']  = $branch_id;
			$where['department_id']  = $department_id;
			$where['DATE_HO >='] = db_date_format($data['date_fr']);
			$where['DATE_HO <='] = db_date_format($data['date_to']);
			if ( !array_key_exists('all_cat', $data) )
				$where['[group]'] = $data['group'];
			if ( !array_key_exists('all_status', $data) )
				$where['[status_id]'] = $data['status'];
			
			// $qry = $this->db->get_where( 'vrpt_phd_routes_list_summary', $where );
			$select = "BRANCH,REGIONAL,PHD_CODE,[DATE],APPROVE_DATE,CLOSE_DATE,[MONTH],[YEAR],[GROUP],CUSTOMER,PHD_CODE_HO,DATE_HO,DATE_ANSWER,\n".
					  "SALES_NAME,SUPPLIER,PRINC_CODE,PRICE_IDR,PRICE_USD,USD_RATE,TOTAL_PRICE,STATUS,STATUS_DATE,NOTE";
			$this->db->select($select)->from('vrpt_phd_routes_list_summary')->where($where);
			$qry = $this->db->get();
			if ($qry->num_rows() < 1) 
				crud_error( l('report_no_data') );
		}
		
		if ( $type == 'detail' ) {
			$data = $this->input->post();	// get data from ajax
			if ( empty($data) ) 
				crud_error("Error: Empty Data !");
				
			$type = strtoupper($type);
			$where['company_id'] = $company_id;
			$where['branch_id']  = $branch_id;
			$where['department_id']  = $department_id;
			$where['DATE_HO >='] = db_date_format($data['date_fr']);
			$where['DATE_HO <='] = db_date_format($data['date_to']);
			if ( !array_key_exists('all_cat', $data) )
				$where['[group]'] = $data['group'];
			if ( !array_key_exists('all_status', $data) )
				$where['[status_id]'] = $data['status'];
			
			// $qry = $this->db->get_where( 'vrpt_phd_routes_list_detail', $where );
			$select = "BRANCH,REGIONAL,PHD_CODE,[DATE],APPROVE_DATE,CLOSE_DATE,[MONTH],[YEAR],[GROUP],CUSTOMER,PHD_CODE_HO,DATE_HO,DATE_ANSWER,SALES_NAME,PRINC_CODE,STATUS,\n".
					  "STATUS_DATE,STOCK_NAME,STOCK_SIZE,QTY,MEASURE,SUPPLIER,DELIVERY_TIME,DELIVERY_PERIOD,CONDITION,VALIDITY,CURRENCY,BUY_PRICE,SELL_PRICE";
			$this->db->select($select)->from('vrpt_phd_routes_list_detail')->where($where);
			$qry = $this->db->get();
			if ($qry->num_rows() < 1) 
				crud_error( l('report_no_data') );
		}
		
		if ( !$preview ) {
			echo json_encode( array("success"=>1) );
			return;
		}
		
		// ================================================================================================
		$this->load->library('Excel');
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
		$objPHPExcel->setActiveSheetIndex(0);
		// Field names in the first row
		$fields = $qry->list_fields();
		$col = 0;
		foreach ($fields as $field) {
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
			$col++;
		}
		
		// Fetching the table data
		$row = 2;
		foreach($qry->result() as $data) {
			$col = 0;
			foreach ($fields as $field) {
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
				$col++;
			}
			$row++;
		}
 
		// Sending headers to force the user to download the file
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment;filename='LOGBOOK_PHD_$type.xls'");
		header("Cache-Control: max-age=0");
		
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('php://output');
		
	}

	function form_so( $id=NULL ) {
		$this->load->library('mpdf');
		// ob_end_clean();
		
		$doc_code		= 'FORM_SO';
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		$department_id	= $this->session->userdata('department_id');
		
		//GET COMPANY
		$data = $this->shared_model->get_company_code( $company_id );
		if ( $data==FALSE )
			show_error("ERROR: Table Company has been changed or removed !");
			
		$company_code = $data->code;
		$company_name = $data->name;
		
		//GET BRANCH
		$data = $this->shared_model->get_branch_code( $branch_id );
		if ( $data==FALSE )
			show_error("ERROR: Table Branch has been changed or removed !");
			
		$branch_code = $data->code;
		$branch_name = $data->name;
		
		//GET DEPARTMENT
		$data = $this->shared_model->get_department_code( $department_id );
		if ( $data==FALSE )
			show_error("ERROR: Table Department has been changed or removed !");
		
		$department_code = $data->code;
		$department_name = $data->name;

		//GET SIGN
		$data = $this->shared_model->get_document_sign( $company_id, $branch_id, $department_id, $doc_code );
		$sign1 = $data['sign1'];
		
		//=====================================================================================================\\
		$mpdf = new mPDF( 'utf-8', 'A4','','',15,15,40,16,10,10 ); //FORMAT F4 (FOLIO)
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
				<tr><td><center><h3>FORM SALES ORDER</h3></center></td></tr>
			</table>
		</htmlpageheader>

		<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
		mpdf-->";
		$mpdf->WriteHTML($html_head);
		$mpdf->SetFooter("|Page {PAGENO} of {nb}|Printed @ ". date('d M Y H:i'));
		
		$qry_h = $this->db->get_where( 'vso', array('id'=>$id) );
		if ($qry_h->num_rows() < 1) 
			show_error( l('report_no_data') );
		
		$row_h = $qry_h->row();
		if ( $row_h->status_id==8 ) {
			$mpdf->SetWatermarkText('VOID');
			$mpdf->showWatermarkText = true;
		}
		
		$L1C1 = $row_h->code;
		$L1C2 = $row_h->date;
		$L2C1 = $row_h->phd_branch_name;
		$L2C2 = $row_h->phd_princ_code;
		$L3C1 = empty($row_h->phd_date) ? "-" : strtoupper(date('d M Y', strtotime($row_h->phd_date)));
		$L3C2 = $row_h->customer_name;
		$L4C1 = $row_h->item_cat_name;
		$L4C2 = empty($row_h->date) ? "-" : strtoupper(date('d M Y', strtotime($row_h->date)));
		$L7C1 = empty($row_h->create_by) ? "( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )" : "( $row_h->create_by )";
		$L7C2 = empty($sign1) ? "( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )" : "( $sign1 )";;

		$header = "
		<table style='width: 100%; margin-top:20mm; border:0.1mm; border-collapse:collapse;' cellpadding='5'>
			<tr>
				<td class='left-border top-border' style='width: 17%;'>NO SO</td>
				<td class='top-border' style='width: 30%;'>: <strong>$L1C1</strong></td>
				<td class='left-border top-border' style='width: 17%;'>NO PHD PUSAT</td>
				<td class='right-border top-border' style='width: 30%;'>: <strong>$L1C2</strong></td>
			</tr>
			<tr>
				<td class='left-border'>CABANG</td>
				<td>: <strong>$L2C1</strong></td>
				<td class='left-border'>NO PHD PRINC</td>
				<td class='right-border'>: <strong>$L2C2</strong></td>
			</tr>
			<tr>
				<td class='left-border'>TANGGAL</td>
				<td>: <strong>$L3C1</strong></td>
				<td class='left-border'>CUSTOMER</td>
				<td class='right-border'>: <strong>$L3C2</strong></td></tr>
			</tr>
			<tr>
				<td class='left-border'>KATEGORI</td>
				<td>: <strong>$L4C1</strong></td>
				<td class='left-border'>TANGGAL</td>
				<td class='right-border'>: <strong>$L4C2</strong></td>
			</tr>
			<tr>
				<td class='left-border'>DIBUAT</td>
				<td>: <strong>&nbsp;</strong></td>
				<td class='left-border'>DISETUJUI</td>
				<td class='right-border'>: <strong>&nbsp;</strong></td>
			</tr>
			<tr>
				<td colspan=2 class='left-border'>&nbsp;</td>
				<td colspan=2 class='left-border right-border'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2 class='left-border bottom-border'><center>$L7C1</center></td>
				<td colspan=2 class='left-border right-border bottom-border'><center>$L7C2</center></td>
			</tr>
		</table>
		
		<table class='items' width='100%' style='margin-top: 1.25em; border-collapse: collapse;' cellpadding='8'>
		<thead>
			<tr>
				<td style='width:5%;'><strong>NO.</strong></td>
				<td style='width:70%;'><strong>JENIS BARANG</strong></td>
				<td style='width:30%;'><strong>QUANTITAS</strong></td>
			</tr>
		</thead>
		<tbody>
		";
		$mpdf->WriteHTML($header);

		$qry_d = $this->db->get_where( 'vphd_routes_dt', array('phd_routes_id'=>$row_h->id) );
		if ( $qry_d->num_rows() > 0 ) {
			$num = 1;
			foreach ( $qry_d->result() as $row_d ) {
				$col01 = $num;
				$col02 = "$row_d->item_name<br />$row_d->item_size<br />$row_d->note";
				$col03 = number_format($row_d->item_qty, 2, '.', '')." ".$row_d->measure_code;
				$detail = "
					<tr>
						<td align='right'>$col01</td>
						<td>$col02</td>
						<td align='center'>$col03</td>
					</tr>
				";
				$mpdf->WriteHTML($detail);
				$num++;
			}
		}
			
		$with_installation = NULL;
		if ($row_h->with_installation) 
			$with_installation = "MOHON DI TAWARKAN ESTIMASI BIAYA PEMASANGAN. <br /><br />";

		$footer = "
				<tr>
					<td class='blanktotal' colspan='3'>&nbsp;</td>
				</tr>
				</tbody>
			</table>
			NOTE: <br />
			$with_installation
			$row_h->note";
		$mpdf->WriteHTML($footer);
			
		$mpdf->WriteHTML("</body></html>");
		$mpdf->Output();
	}
	
	function form_phd_pur_nprinc( $id=NULL ) {
		$this->load->library('mpdf');
		// ob_end_clean();
		
		$doc_code		= 'PHD';
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		$department_id	= $this->session->userdata('department_id');
		
		//GET COMPANY
		$data = $this->shared_model->get_company_code( $company_id );
		if ( $data==FALSE )
			show_error("ERROR: Table Company has been changed or removed !");
			
		$company_code = $data->code;
		$company_name = $data->name;
		
		//GET BRANCH
		$data = $this->shared_model->get_branch_code( $branch_id );
		if ( $data==FALSE )
			show_error("ERROR: Table Branch has been changed or removed !");
			
		$branch_code = $data->code;
		$branch_name = $data->name;
		
		//GET DEPARTMENT
		$data = $this->shared_model->get_department_code( $department_id );
		if ( $data==FALSE )
			show_error("ERROR: Table Department has been changed or removed !");
		
		$department_code = $data->code;
		$department_name = $data->name;

		//GET SIGN
		$data = $this->shared_model->get_document_sign( $company_id, $branch_id, $department_id, $doc_code );
		$sign1 = $data['sign1'];
		
		//=====================================================================================================\\
		$mpdf = new mPDF( 'utf-8', array(215.9,330.2),'','',15,15,40,16,10,10 ); //FORMAT F4 (FOLIO)
		$mpdf->SetTitle(strtoupper($company_name)." - PHD");
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
				<tr><td><center><h3>FORM PERMINTAAN HARGA DAN DELIVERY (PHD)</h3></center></td></tr>
			</table>
		</htmlpageheader>

		<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
		mpdf-->";
		$mpdf->WriteHTML($html_head);
		$mpdf->SetFooter("|Page {PAGENO} of {nb}|Printed @ ". date('d M Y H:i'));
		
		$qry_h = $this->db->get_where( 'vphd_routes', array('id'=>$id) );
		if ($qry_h->num_rows() < 1) 
			show_error( l('report_no_data') );
		
		$row_h = $qry_h->row();
		if ( $row_h->status_id==8 ) {
			$mpdf->SetWatermarkText('VOID');
			$mpdf->showWatermarkText = true;
		}
		
		$L1C1 = $row_h->phd_code;
		$L1C2 = $row_h->code;
		$L2C1 = empty($row_h->phd_date) ? "-" : strtoupper(date('d M Y', strtotime($row_h->phd_date)));
		$L2C2 = empty($row_h->date) ? "-" : strtoupper(date('d M Y', strtotime($row_h->date)));
		$L3C1 = $row_h->item_cat_name;
		$L3C2 = NULL;
		$L6C1 = empty($row_h->create_by) ? "( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )" : "( $row_h->create_by )";
		$L6C2 = empty($sign1) ? "( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )" : "( $sign1 )";;

		$header = "
		<table style='width: 100%; margin-top:20mm; border:0.1mm; border-collapse:collapse;' cellpadding='5'>
			<tr>
				<td class='left-border top-border' style='width: 17%;'>NO PHD CABANG</td>
				<td class='top-border' style='width: 30%;'>: <strong>$L1C1</strong></td>
				<td class='left-border top-border' style='width: 17%;'>NO PHD PUSAT</td>
				<td class='right-border top-border' style='width: 30%;'>: <strong>$L1C2</strong></td>
			</tr>
			<tr>
				<td class='left-border'>TANGGAL</td>
				<td>: <strong>$L2C1</strong></td>
				<td class='left-border'>TANGGAL</td>
				<td class='right-border'>: <strong>$L2C2</strong></td>
			</tr>
			<tr>
				<td class='left-border'>KATEGORI</td>
				<td>: <strong>$L3C1</strong></td>
				<td class='left-border'>&nbsp;</td>
				<td class='right-border'>&nbsp;</td>
			</tr>
			<tr>
				<td class='left-border'>DIBUAT</td>
				<td>: <strong>&nbsp;</strong></td>
				<td class='left-border'>DISETUJUI</td>
				<td class='right-border'>: <strong>&nbsp;</strong></td>
			</tr>
			<tr>
				<td colspan=2 class='left-border'>&nbsp;</td>
				<td colspan=2 class='left-border right-border'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2 class='left-border bottom-border'><center>$L6C1</center></td>
				<td colspan=2 class='left-border right-border bottom-border'><center>$L6C2</center></td>
			</tr>
		</table>
		
		<table class='items' width='100%' style='margin-top: 1.25em; border-collapse: collapse;' cellpadding='8'>
		<thead>
			<tr>
				<td style='width:5%;'><strong>NO.</strong></td>
				<td style='width:70%;'><strong>JENIS BARANG</strong></td>
				<td style='width:30%;'><strong>QUANTITAS</strong></td>
			</tr>
		</thead>
		<tbody>
		";
		$mpdf->WriteHTML($header);

		$qry_d = $this->db->get_where( 'vphd_routes_dt', array('phd_routes_id'=>$row_h->id) );
		if ( $qry_d->num_rows() > 0 ) {
			$num = 1;
			foreach ( $qry_d->result() as $row_d ) {
				$col01 = $num;
				$col02 = "$row_d->item_name<br />$row_d->item_size<br />$row_d->note";
				$col03 = number_format($row_d->item_qty, 2, '.', '')." ".$row_d->measure_code;
				$detail = "
					<tr>
						<td align='right'>$col01</td>
						<td>$col02</td>
						<td align='center'>$col03</td>
					</tr>
				";
				$mpdf->WriteHTML($detail);
				$num++;
			}
		}
			
		$with_installation = NULL;
		if ($row_h->with_installation) 
			$with_installation = "MOHON DI TAWARKAN ESTIMASI BIAYA PEMASANGAN. <br /><br />";
			
		$footer = "
				<tr>
					<td class='blanktotal' colspan='3'>&nbsp;</td>
				</tr>
				</tbody>
			</table>
			NOTE: <br />
			$with_installation
			$row_h->note";
		$mpdf->WriteHTML($footer);
			
		$mpdf->WriteHTML("</body></html>");
		$mpdf->Output();
	}
	
	function form_phd_pur_ans( $id=NULL ) {
		$this->load->library('mpdf');
		// ob_end_clean();
		
		$doc_code		= 'PHD';
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		$department_id	= $this->session->userdata('department_id');
		
		//GET COMPANY
		$data = $this->shared_model->get_company_code( $company_id );
		if ( $data==FALSE )
			show_error("ERROR: Table Company has been changed or removed !");
			
		$company_code = $data->code;
		$company_name = $data->name;
		
		//GET BRANCH
		$data = $this->shared_model->get_branch_code( $branch_id );
		if ( $data==FALSE )
			show_error("ERROR: Table Branch has been changed or removed !");
			
		$branch_code = $data->code;
		$branch_name = $data->name;
		
		//GET DEPARTMENT
		$data = $this->shared_model->get_department_code( $department_id );
		if ( $data==FALSE )
			show_error("ERROR: Table Department has been changed or removed !");
		
		$department_code = $data->code;
		$department_name = $data->name;

		//GET SIGN
		$data = $this->shared_model->get_document_sign( $company_id, $branch_id, $department_id, $doc_code );
		$sign1 = $data['sign1'];
		
		//GET CURRENCY CODE
		$this->db->select('currency_code')->from('vphd_routes_dt')->where(array('phd_routes_id'=>$id))->order_by('id desc');
		$currency_code = $this->db->get()->row()->currency_code;
		
		//=====================================================================================================\\
		$mpdf = new mPDF( 'utf-8', array(215.9,330.2),'','',15,15,35,16,10,10 ); //FORMAT F4 (FOLIO)
		$mpdf->SetTitle(strtoupper($company_name)." - PHD");
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
			border-right: 0.1mm solid #000000;
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
				<tr><td><center><h3>FORM JAWABAN HARGA DAN DELIVERY</h3></center></td></tr>
			</table>
		</htmlpageheader>

		<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
		mpdf-->";
		$mpdf->WriteHTML($html_head);
		$mpdf->SetFooter("|Page {PAGENO} of {nb}|Printed @ ". date('d M Y H:i'));
		
		$qry_h = $this->db->get_where( 'vphd_routes', array('id'=>$id) );
		if ($qry_h->num_rows() < 1) 
			show_error( l('report_no_data') );
		
		$row_h = $qry_h->row();
		if ( $row_h->status_id==8 ) {
			$mpdf->SetWatermarkText('VOID');
			$mpdf->showWatermarkText = true;
		}
		
		$L1C1 = $row_h->phd_code;
		$L1C2 = $row_h->code;
		$L2C1 = $row_h->phd_branch_name;
		$L2C2 = $row_h->phd_princ_code;
		$L3C1 = empty($row_h->phd_date) ? "-" : strtoupper(date('d M Y', strtotime($row_h->phd_date)));
		$L3C2 = $row_h->customer_name;
		$L4C1 = $row_h->item_cat_name;
		$L4C2 = empty($row_h->date) ? "-" : strtoupper(date('d M Y', strtotime($row_h->date)));
		$L5C1 = NULL;
		$L5C2 = NULL;
		$L6C1 = empty($row_h->create_by) ? "( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )" : "( $row_h->create_by )";
		$L6C2 = empty($sign1) ? "( &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; )" : "( $sign1 )";;

		$header = "
		<table style='width: 100%; margin-top:20mm; border:0.1mm; border-collapse:collapse;' cellpadding='5'>
			<tr>
				<td class='left-border top-border' style='width: 17%;'>NO PHD CABANG</td>
				<td class='top-border' style='width: 30%;'>: <strong>$L1C1</strong></td>
				<td class='left-border top-border' style='width: 17%;'>NO PHD PUSAT</td>
				<td class='right-border top-border' style='width: 30%;'>: <strong>$L1C2</strong></td>
			</tr>
			<tr>
				<td class='left-border'>CABANG</td>
				<td>: <strong>$L2C1</strong></td>
				<td class='left-border'>NO PHD PRINC</td>
				<td class='right-border'>: <strong>$L2C2</strong></td>
			</tr>
			<tr>
				<td class='left-border'>TANGGAL</td>
				<td>: <strong>$L3C1</strong></td>
				<td class='left-border'>CUSTOMER</td>
				<td class='right-border'>: <strong>$L3C2</strong></td>
			</tr>
			<tr>
				<td class='left-border'>KATEGORI</td>
				<td>: <strong>$L4C1</strong></td>
				<td class='left-border'>TANGGAL</td>
				<td class='right-border'>: <strong>$L4C2</strong></td>
			</tr>
			<tr>
				<td class='left-border'>DIBUAT</td>
				<td>: <strong>&nbsp;</strong></td>
				<td class='left-border'>DISETUJUI</td>
				<td class='right-border'>: <strong>&nbsp;</strong></td>
			</tr>
			<tr>
				<td colspan=2 class='left-border'>&nbsp;</td>
				<td colspan=2 class='left-border right-border'>&nbsp;</td>
			</tr>
			<tr>
				<td colspan=2 class='left-border bottom-border'><center>$L6C1</center></td>
				<td colspan=2 class='left-border right-border bottom-border'><center>$L6C2</center></td>
			</tr>
		</table>
		
		<table class='items' width='100%' style='margin-top: 1.25em; border-collapse: collapse;' cellpadding='8'>
		<thead>
			<tr>
				<td style='width:5%;'><strong>NO.</strong></td>
				<!--
				<td style='width:55%;'><strong>JENIS BARANG</strong></td>
				-->
				<td style='width:55%;'><strong>JENIS BARANG</strong></td>
				<td style='width:17%;'><strong>QUANTITAS</strong></td>
				<td style='width:20%;'><strong>HARGA SATUAN<br>($currency_code)</strong></td>
				<td style='width:20%;'><strong>TOTAL<br>($currency_code)</strong></td>
			</tr>
		</thead>
		<tbody>";
		$mpdf->WriteHTML($header);

		$qry_d = $this->db->get_where( 'vphd_routes_dt', array('phd_routes_id'=>$row_h->id) );
		if ( $qry_d->num_rows() > 0 ) {
			$num = 1;
			$tot = 0;
			foreach ( $qry_d->result() as $row_d ) {
				$DT  = empty($row_d->dt_value) ? "-" : number_format($row_d->dt_value, 0, '.', ',')." ".$row_d->period_name;
				$VAL = empty($row_d->validity) ? "-" : number_format($row_d->validity, 0, '.', ',')." ".$row_d->period_name;
				$note_d = empty($row_d->note) ? NULL : "<br>".str_replace(chr(13),"<br>",$row_d->note);
				// $note_d = empty($row_d->note) ? NULL : "<br>".$row_d->note;
				$col01 = $num;
				$col02 = "$row_d->item_name 
					<br>$row_d->item_size
					$note_d
					<br><br>KONDISI: $row_d->condition_name, VAL: $VAL, DT: $DT";
				$col03 = number_format($row_d->item_qty, 2, '.', '')." ".$row_d->measure_code;
				$col04 = number_format($row_d->item_price_sell, 2, '.', ',');
				$col05 = number_format( ($row_d->item_qty * $row_d->item_price_sell), 2, '.', ',');
				$detail = "
					<tr>
						<td align='right'>$col01</td>
						<td>$col02</td>
						<td align='right' style='white-space: nowrap;'>$col03</td>
						<td align='right' style='white-space: nowrap;'>$col04</td>
						<td align='right' style='white-space: nowrap;'>$col05</td>
					</tr>
				";
				$mpdf->WriteHTML($detail);
				$tot += ($row_d->item_qty * $row_d->item_price_sell);
				$num++;
			}
		}
			
		// $with_options = NULL;
		if ($row_h->with_installation) 
			$with_options = "MOHON DI TAWARKAN ESTIMASI BIAYA PEMASANGAN. <br />";
		
		if ($row_h->with_delivery) 
			$with_options .= empty($with_options) ? "MOHON DI HITUNGKAN BIAYA PENGIRIMAN. <br />" : "DAN JUGA DI HITUNGKAN BIAYA PENGIRIMAN. <br />";
		
		if ($row_h->with_other_cost) 
			$with_options .= empty($with_options) ? "MOHON DI HITUNGKAN UNTUK BIAYA LAINNYA. <br />" : "MOHON JUGA DI HITUNGKAN UNTUK BIAYA LAINNYA. <br />";
		
		$with_options = empty($with_options) ? NULL : $with_options." <br /><br />";
					
		$note_h = str_replace(chr(13),"<br />",$row_h->note);
		$footer = "
				<tr>
					<td class='blanktotal' colspan='3'>&nbsp;</td>
					<td class='totals'>GRAND TOTAL</td>
					<td class='totals'>". number_format($tot, 2, '.', ',') ."</td>
				</tr>
				</tbody>
			</table>
			NOTE: <br />
			$with_options
			$note_h";
		$mpdf->WriteHTML($footer);
		
		$mpdf->WriteHTML("</body></html>");
		$mpdf->Output();
	}
	
}