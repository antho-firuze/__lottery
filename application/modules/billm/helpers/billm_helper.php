<?php

if ( ! function_exists('mk_invoice_date'))
{
	function mk_invoice_date($format=NULL, $date, $d=0) {
		
		if (empty($format)) 
			$format = 'Y-m-d';
			
		if (empty($date))
			$date = strtotime(date('Y-m-d'));
		else
			$date = strtotime($date);
			
		return date( $format, mktime(
				0,
				0,
				0,
				date('m',$date)+1,
				$d, 
				date('Y',$date)
			));
	}
}

if ( ! function_exists('date_on_period'))
{
	function date_on_period($date, $period_from, $period_to) {
		
		if (($date >= $period_from) and ($date <= $period_to))
			return TRUE;
		else
			return FALSE;
	}
}

if ( ! function_exists('get_usage_value'))
{
	function get_usage_value($last, $curr, $max, $min=NULL) {
		
		if ($curr >= $last)
		{
			$usage = $curr - $last;
			if ( !empty($min) )
				if ($usage < $min)
					return $min;
			return $usage;
		}
		else 
		{
			$usage = ($max - $last) + $curr;
			if ( !empty($min) )
				if ($usage < $min)
					return $min;
			return $usage;
		}
	}
}

if ( ! function_exists('get_real_curr_value'))
{
	function get_real_curr_value($last, $curr, $max, $min=NULL) {
		
		if ($curr >= $last)
		{
			$usage = $curr - $last;
			if ( !empty($min) )
				if ($usage < $min)
					return $min + $last;
			return $usage + $last;
		}
		else 
		{
			$usage = ($max - $last) + $curr;
			if ( !empty($min) )
				if ($usage < $min)
					return $min - ($max - $last);
			return $usage - ($max - $last);
		}
	}
}

if ( ! function_exists('get_invoice_code'))
{
	function get_invoice_code( $company_id, $branch_id=NULL, $department_id=NULL, $code, $invoice_date, $custom_1=NULL, $custom_2=NULL ) {
		$ci = get_instance();
		
		$filter['company_id']   = $company_id;
		$filter['code'] 		= $code;
		if ( !empty($branch_id) ) $filter['branch_id'] = $branch_id;
		if ( !empty($department_id) ) $filter['department_id'] = $department_id;
		$qry = $ci->db->get_where( 'setup_documents', $filter );
		if ($qry->num_rows() < 1) 
			return FALSE;
		
		$row = $qry->row();
		
		$invoice_date   = strtotime($invoice_date);
		$prefix_code_length = $row->prefix_code_length;
		for ($i = 1; $i <= $prefix_code_length; $i++){
			if ($i==1) {
				if ( !empty($row->prefix_code1) )
					$newcode[$i] = get_doc_prefix_invoice($row->prefix_code1, $invoice_date, $custom_1, $custom_2);
			} elseif ($i==2) {
				if ( !empty($row->prefix_code2) )
					$newcode[$i] = get_doc_prefix_invoice($row->prefix_code2, $invoice_date, $custom_1, $custom_2);
			} elseif ($i==3) {
				if ( !empty($row->prefix_code3) )
					$newcode[$i] = get_doc_prefix_invoice($row->prefix_code3, $invoice_date, $custom_1, $custom_2);
			} elseif ($i==4) {
				if ( !empty($row->prefix_code4) )
					$newcode[$i] = get_doc_prefix_invoice($row->prefix_code4, $invoice_date, $custom_1, $custom_2);
			} elseif ($i==5) {
				if ( !empty($row->prefix_code5) )
					$newcode[$i] = get_doc_prefix_invoice($row->prefix_code5, $invoice_date, $custom_1, $custom_2);
			} elseif ($i==6) {
				if ( !empty($row->prefix_code6) )
					$newcode[$i] = get_doc_prefix_invoice($row->prefix_code6, $invoice_date, $custom_1, $custom_2);
			}
		}
		
		return implode($row->separator,$newcode);
	}
}

if ( ! function_exists('get_doc_prefix_invoice'))
{
	function get_doc_prefix_invoice( $prefix_code, $invoice_date=NULL, $custom_1=NULL, $custom_2=NULL ) {
		if ($prefix_code=='YYYY') 
			return date('Y', $invoice_date);
		elseif ($prefix_code=='MM') 
			return date('m', $invoice_date);
		elseif ($prefix_code=='CUSTOM_1') 
			return $custom_1;
		elseif ($prefix_code=='CUSTOM_2') 
			return $custom_2;
		else
			return $prefix_code;
	}
}


