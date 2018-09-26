<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fin_Model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		
		// FOR MEMCACHED
		// $this->load->driver('cache');
		// $this->load->helper('billm');
	}
	
	function AddNewAR($data) 
	{
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		
		$data['company_id'] = $company_id;
		$data['branch_id']	= $branch_id;
		$data['code'] 		= get_doc_code($company_id, $branch_id, NULL, 'AR');
		
		$this->db->insert('ar', $data);
		return array('id'=>$this->db->insert_id(), 'code'=>$data['code']);
	}
	
	function AddNewCB($data) 
	{
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		
		$data['company_id'] = $company_id;
		$data['branch_id']	= $branch_id;
		$data['code'] 		= get_doc_code($company_id, $branch_id, NULL, 'CB');
		
		$this->db->insert('cb', $data);
		return array('id'=>$this->db->insert_id(), 'code'=>$data['code']);
	}
	
	function AddNewAP($data) 
	{
		$company_id	 	= $this->session->userdata('company_id');
		$branch_id	 	= $this->session->userdata('branch_id');
		
		$data['company_id'] = $company_id;
		$data['branch_id']	= $branch_id;
		$data['code'] 		= get_doc_code($company_id, $branch_id, NULL, 'AP');
		
		$this->db->insert('ap', $data);
		return array('id'=>$this->db->insert_id(), 'code'=>$data['code']);
	}
	
    /**
     * 
     * 
     * @param <type> $params ['table', 'where', 'like', 'page', 'rows', 'sort', 'order', 'req_new' ] 
     * 
     * @return <type>
     */
	function getAR($params=array()) 
	{
		
		$params['table'] = 'ar';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as ar');
		$this->db->join('users as u1', 'ar.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'ar.update_by = u2.id', 'left');
		$this->db->join('customer as cus', 'ar.customer_id = cus.id', 'left');
		$this->db->join('currency as cur', 'ar.currency_id = cur.id', 'left');
		$this->db->join('opt_cash_bank as ocb', 'ar.cash_bank_id = ocb.id', 'left');
		$this->db->join('coa as coa', 'ar.coa_id = coa.id', 'left');
		$this->db->join('opt_payment_type as opt', 'ar.payment_type_id = opt.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('ar.*, u1.username as create_by_name, u2.username as update_by_name, 
			cus.code as customer_code, cus.name as customer_name, cur.code as currency_code, cur.name as currency_name,
			ocb.code as cash_bank_code, ocb.name as cash_bank_name, coa.code as coa_code, coa.name as coa_name,
			opt.code as payment_type_code, opt.name as payment_type_name
			');
		$this->db->from($params['table'].' as ar');
		$this->db->join('users as u1', 'ar.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'ar.update_by = u2.id', 'left');
		$this->db->join('customer as cus', 'ar.customer_id = cus.id', 'left');
		$this->db->join('currency as cur', 'ar.currency_id = cur.id', 'left');
		$this->db->join('opt_cash_bank as ocb', 'ar.cash_bank_id = ocb.id', 'left');
		$this->db->join('coa as coa', 'ar.coa_id = coa.id', 'left');
		$this->db->join('opt_payment_type as opt', 'ar.payment_type_id = opt.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getAR_Dt($params=array()) 
	{
		
		$params['table'] = 'ar_dt';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as ad');
		$this->db->join('currency as cur', 'ad.currency_id = cur.id', 'left');
		$this->db->join('coa as coa', 'ad.coa_id = coa.id', 'left');
		$this->db->join('invoice_dt as id', 'ad.invoice_dt_id = id.id', 'left');
		$this->db->join('invoice as i', 'id.invoice_id = i.id', 'left');
		$this->db->join('unit as u', 'i.unit_id = u.id', 'left');
		$this->db->join('opt_invoice_type as oit', 'id.invoice_type_id = oit.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('ad.*, cur.code as currency_code, cur.name as currency_name,
			coa.code as coa_code, coa.name as coa_name, i.code as invoice_code, u.code as unit_code, u.name as unit_name,
			oit.code as invoice_type_code, oit.name as invoice_type_name
			');
		$this->db->from($params['table'].' as ad');
		$this->db->join('currency as cur', 'ad.currency_id = cur.id', 'left');
		$this->db->join('coa as coa', 'ad.coa_id = coa.id', 'left');
		$this->db->join('invoice_dt as id', 'ad.invoice_dt_id = id.id', 'left');
		$this->db->join('invoice as i', 'id.invoice_id = i.id', 'left');
		$this->db->join('unit as u', 'i.unit_id = u.id', 'left');
		$this->db->join('opt_invoice_type as oit', 'id.invoice_type_id = oit.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getAP($params=array()) 
	{
		
		$params['table'] = 'ap';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as ar');
		$this->db->join('users as u1', 'ar.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'ar.update_by = u2.id', 'left');
		$this->db->join('customer as cus', 'ar.customer_id = cus.id', 'left');
		$this->db->join('currency as cur', 'ar.currency_id = cur.id', 'left');
		$this->db->join('opt_cash_bank as ocb', 'ar.cash_bank_id = ocb.id', 'left');
		$this->db->join('coa as coa', 'ar.coa_id = coa.id', 'left');
		$this->db->join('opt_payment_type as opt', 'ar.payment_type_id = opt.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('ar.*, u1.username as create_by_name, u2.username as update_by_name, 
			cus.code as customer_code, cus.name as customer_name, cur.code as currency_code, cur.name as currency_name,
			ocb.code as cash_bank_code, ocb.name as cash_bank_name, coa.code as coa_code, coa.name as coa_name,
			opt.code as payment_type_code, opt.name as payment_type_name
			');
		$this->db->from($params['table'].' as ar');
		$this->db->join('users as u1', 'ar.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'ar.update_by = u2.id', 'left');
		$this->db->join('customer as cus', 'ar.customer_id = cus.id', 'left');
		$this->db->join('currency as cur', 'ar.currency_id = cur.id', 'left');
		$this->db->join('opt_cash_bank as ocb', 'ar.cash_bank_id = ocb.id', 'left');
		$this->db->join('coa as coa', 'ar.coa_id = coa.id', 'left');
		$this->db->join('opt_payment_type as opt', 'ar.payment_type_id = opt.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getAP_Dt($params=array()) 
	{
		
		$params['table'] = 'ap_dt';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as ad');
		$this->db->join('currency as cur', 'ad.currency_id = cur.id', 'left');
		$this->db->join('coa as coa', 'ad.coa_id = coa.id', 'left');
		$this->db->join('invoice_dt as id', 'ad.invoice_dt_id = id.id', 'left');
		$this->db->join('invoice as i', 'id.invoice_id = i.id', 'left');
		$this->db->join('unit as u', 'i.unit_id = u.id', 'left');
		$this->db->join('opt_invoice_type as oit', 'id.invoice_type_id = oit.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('ad.*, cur.code as currency_code, cur.name as currency_name,
			coa.code as coa_code, coa.name as coa_name, i.code as invoice_code, u.code as unit_code, u.name as unit_name,
			oit.code as invoice_type_code, oit.name as invoice_type_name
			');
		$this->db->from($params['table'].' as ad');
		$this->db->join('currency as cur', 'ad.currency_id = cur.id', 'left');
		$this->db->join('coa as coa', 'ad.coa_id = coa.id', 'left');
		$this->db->join('invoice_dt as id', 'ad.invoice_dt_id = id.id', 'left');
		$this->db->join('invoice as i', 'id.invoice_id = i.id', 'left');
		$this->db->join('unit as u', 'i.unit_id = u.id', 'left');
		$this->db->join('opt_invoice_type as oit', 'id.invoice_type_id = oit.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getCB($params=array()) 
	{
		
		$params['table'] = 'cb';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as cb');
		$this->db->join('users as u1', 'cb.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'cb.update_by = u2.id', 'left');
		$this->db->join('opt_paym_recv as opr', 'cb.paym_recv_id = opr.id', 'left');
		$this->db->join('currency as cur', 'cb.currency_id = cur.id', 'left');
		$this->db->join('opt_cash_bank as ocb', 'cb.cash_bank_id = ocb.id', 'left');
		$this->db->join('coa as coa', 'cb.coa_id = coa.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('cb.*, u1.username as create_by_name, u2.username as update_by_name, 
			opr.name as payment_receive, cur.code as currency_code, cur.name as currency_name,
			ocb.code as cash_bank_code, ocb.name as cash_bank_name, coa.code as coa_code, coa.name as coa_name
			');
		$this->db->from($params['table'].' as cb');
		$this->db->join('users as u1', 'cb.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'cb.update_by = u2.id', 'left');
		$this->db->join('opt_paym_recv as opr', 'cb.paym_recv_id = opr.id', 'left');
		$this->db->join('currency as cur', 'cb.currency_id = cur.id', 'left');
		$this->db->join('opt_cash_bank as ocb', 'cb.cash_bank_id = ocb.id', 'left');
		$this->db->join('coa as coa', 'cb.coa_id = coa.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}

	function getCB_Dt($params=array()) 
	{
		
		$params['table'] = 'cb_dt';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as cd');
		$this->db->join('coa as coa', 'cd.coa_id = coa.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('cd.*, coa.code as coa_code, coa.name as coa_name');
		$this->db->from($params['table'].' as cd');
		$this->db->join('coa as coa', 'cd.coa_id = coa.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getCurrency_Rate($params=array()) 
	{
		
		$params['table'] = 'currency_rate';
		
		$this->db->select('COUNT(*) AS rec_count');
		$this->db->from($params['table'].' as cr');
		$this->db->join('users as u1', 'cr.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'cr.update_by = u2.id', 'left');
		$this->db->join('currency as cur', 'cr.currency_id = cur.id', 'left');
		$num_row = $this->shared_model->get_rec_count($params);
		
		$this->db->select('cr.*, u1.username as create_by_name, u2.username as update_by_name, cur.code as currency_code, cur.name as currency_name
			');
		$this->db->from($params['table'].' as cr');
		$this->db->join('users as u1', 'cr.create_by = u1.id', 'left');
		$this->db->join('users as u2', 'cr.update_by = u2.id', 'left');
		$this->db->join('currency as cur', 'cr.currency_id = cur.id', 'left');
		$result = $this->shared_model->get_rec($params);
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function getOpt_Cash_Bank($params=NULL) 
	{
	
		$params['table'] = 'opt_cash_bank';
		
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
	
	function getOpt_Payment_Type($params=NULL) 
	{
	
		$params['table'] = 'opt_payment_type';
		
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
	
	function getOpt_Paym_Recv($params=NULL) 
	{
	
		$params['table'] = 'opt_paym_recv';
		
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
	
	function updateInvoicePaymentById($invoice_id) 
	{
		$qry = "update invoice set 
				paid_amount = (select ifnull(sum(amount), 0) from ar_dt where void = 0 and invoice_id = $invoice_id), 
				balance_amount = total_amount - paid_amount
				where id = $invoice_id";
		$this->db->query($qry);
	}
	
	function updateTotalAmount($table, $id)
	{
		$filter['id'] = $id;
		$qry = $this->db->get_where( $table, $filter );
		foreach ($qry->result() as $row) 
		{
			$this->db->select_sum('amount', 'total_amount');
			$this->db->where($table.'_id', $row->id);
			$this->db->where('void', 0);
			$summary = $this->db->get($table.'_dt')->row();

			$data1['total_amount'] = $summary->total_amount;
			$this->db->update( $table, $data1, $filter );
		}
		return;
	}

	function procPosting_AR($id)
	{
		$this->load->model('acc/acc_model');
		
		// $filter['a.void']    = 0;
		// $filter['ad.void']   = 0;
		// $filter['ad.posted'] = 0;
		
		$this->db->select('a.*, p.code as period_code, c.code as customer_code, ocb.code as cash_bank_code, opt.code as payment_type_code');
		$this->db->from('ar as a');
		$this->db->join('period as p', 'a.period_id = p.id', 'left');
		$this->db->join('customer as c', 'a.customer_id = c.id', 'left');
		$this->db->join('opt_cash_bank as ocb', 'a.cash_bank_id = ocb.id', 'left');
		$this->db->join('opt_payment_type as opt', 'a.payment_type_id = opt.id', 'left');
		// $this->db->where($filter);
		$this->db->where_in('a.id', $id);
		// $this->db->where('(a.coa_id is not null and ad.coa_id is not null)');
		$qry = $this->db->get();
		
		$err_log = '';
		foreach ($qry->result() as $row) 
		{
			// VALIDITY SECTION
			if ($row->void)
			{
				$err_log .= 'Error: '.$row->code.' has been voided.';
				continue;
			}
			
			if ($row->posted)
			{
				$err_log .= 'Error: '.$row->code.' has been posted.';
				continue;
			}
			
			if (empty($row->coa_id))
			{
				$err_log .= 'Error: '.$row->code.' account not set.';
				continue;
			}
			
			$this->db->where('ar_id', $row->id);
			$this->db->where('void', 0);
			$this->db->where('(coa_id is null)');
			if ($this->db->count_all_results('ar_dt') > 0)
			{
				$err_log .= 'Error: '.$row->code.', one of the detail does not have an account code.';
				continue;
			}
			
			// CRUD SECTION
			// HEADER
			$data['code'] 	  	 = 'AUTO';
			$data['period_id'] 	 = $row->period_id;
			$data['date'] 		 = date('Y-m-d');
			$data['journal_type_id'] = ($row->cash_bank_id==1) ? 6 : 4;	// 6=CRJ, 4=BRJ
			$data['auto'] 	  	 = 0;
			$data['ref_no'] 	 = $row->code;
			$data['note'] 	 	 = $row->note;
			$data['posted'] 	 = 1;
			$data['create_by']   = sesUser()->id;
			$data['create_date'] = date('Y-m-d H:i:s');
			$gl = $this->acc_model->AddNewGL( $data );
			
			// DETAIL DEBIT
			$coa = $this->acc_model->getCOA_ById($row->coa_id);
			$data1['gl_id'] 	  	  = $gl['id'];
			$data1['journal_type_id'] = ($row->cash_bank_id==1) ? 6 : 4;	// 6=CRJ, 4=BRJ
			$data1['ref_id'] 	  	  = $row->id;
			$data1['coa_id'] 	  	  = $row->coa_id;
			$data1['note'] 	  	 	  = ($coa) ? $coa->name : '';
			$data1['dc'] 	  	 	  = 'D';
			$data1['currency_id'] 	  = $row->currency_id;
			$data1['currency_rate']   = $row->currency_rate;
			$data1['currency_amount'] = $row->total_amount;
			$data1['debit'] 	  	  = $row->total_amount;
			$data1['credit'] 	  	  = 0;
			$this->db->insert('gl_dt', $data1);
			$this->db->update('ar', array('posted'=>1), array('id'=>$row->id));
					
			$this->db->select('*');
			$this->db->from('ar_dt');
			$this->db->where('ar_id', $row->id);
			$qry2 = $this->db->get();
			foreach ($qry2->result() as $row2)
			{
				$data2['gl_id'] 	  	  = $gl['id'];
				$data1['journal_type_id'] = ($row->cash_bank_id==1) ? 6 : 4;	// 6=CRJ, 4=BRJ
				$data1['ref_id'] 	  	  = $row2->id;
				$data2['coa_id'] 	  	  = $row2->coa_id;
				$data2['note'] 	  	 	  = $row2->note;
				$data2['dc'] 	  	 	  = 'C';
				$data2['currency_id'] 	  = $row2->currency_id;
				$data2['currency_rate']   = $row2->currency_rate;
				$data2['currency_amount'] = $row2->amount;
				$data2['debit'] 	  	  = 0;
				$data2['credit'] 	  	  = $row2->amount;
				$this->db->insert('gl_dt', $data2);
				$this->db->update('ar_dt', array('posted'=>1), array('id'=>$row2->id));
			}
		}
		
		return array('errorMsg'=>$err_log);
	}
	
}