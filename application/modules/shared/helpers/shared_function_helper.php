<?php

// EXPORT TO EXCELL ===============
if ( ! function_exists('export_to_xls'))
{
	function export_to_xls($qry, $filename) {
		$ci = get_instance();
		
		$ci->load->library('Excel');
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
 
		// ================ AUTO SIZE ==================
		$columns = array('A');
		$current = 'A';
		while ($current != 'AZ') {
			$columns[] = ++$current;
		}
		foreach($columns as $column) {
			$objPHPExcel->getActiveSheet()->getColumnDimension($column)->setAutoSize(true);
		}
		// ================ AUTO SIZE ==================
		
		// Sending headers to force the user to download the file
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename='$filename.xls'");
		header("Cache-Control: max-age=0");
		setcookie("fileDownload", "true");
		
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('php://output');
	}
}

// EXPORT TO PDF ===============
if ( ! function_exists('export_to_pdf'))
{
	function export_to_pdf($qry, $filename, $paper_size='A4', $is_portrait=TRUE) {
		$ci = get_instance();
		
		$company	= $ci->systems_model->getCompany_ById(sesCompany()->id);
		
		$ci->load->library('mpdf');
		//=====================================================================================================\\
		
		if ($paper_size == 'F4') 
			if ($is_portrait)
				$paper_setup = array(215.9,330.2);
			else
				$paper_setup = array(330.2,215.9);
		
		if ($paper_size == 'A3') 
			if ($is_portrait)
				$paper_setup = array(297,420);
			else
				$paper_setup = array(420,297);
		
		$mpdf = new mPDF( 'utf-8', $paper_setup,'','',15,15,35,16,10,10 ); 
		$mpdf->SetTitle("Example");
		$mpdf->SetAuthor("Example");
		$logo_path = base_url()."assets/images/logo-$company->code.png";
		
		$title = join(" ", explode("_", strtoupper($filename)));
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
				<tr><td><center><h1>$company->name</h1></center></td></tr>
				<tr><td><center>|||</center></td></tr>
				<tr><td><center><h3>$title</h3></center></td></tr>
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
				<td><strong>NO.</strong></td>";
			
		$fields = $qry->list_fields();
		$fields_count = count($fields);
		foreach ($fields as $field) {
			$header .= "<td><strong>$field</strong></td>";
		}
				
		$header .= "</tr>
		</thead>
		<tbody>";
		$mpdf->WriteHTML($header);

		if ($qry->num_rows() < 1) 
			crud_error( l('report_no_data') );
		
		$num = 1;
		foreach ( $qry->result() as $row ) {
			
			$detail .= "
				<tr>
					<td align='right'>$num</td>
					";
					
			foreach ($fields as $field) {
				$detail .= "<td>".$row->$field."</td>";
			}
			
			/* foreach ($fields as $field) {
				$detail .= "<td style='white-space: nowrap;>".$row->$field."</td>";
			} */
			
			$detail .= "
				</tr>
			";
			$num++;
		}
		$mpdf->WriteHTML($detail);
		
		$fields_count = $fields_count+1;
		$footer = "
				<tr>
					<td colspan=".$fields_count." class='blanktotal'>&nbsp;</td>
				</tr>
				</tbody>
			</table>";
		$mpdf->WriteHTML($footer);
		
		$mpdf->WriteHTML("</body></html>");
		
		// Sending headers to force the user to download the file
		setcookie("fileDownload", "true");
		
		// $mpdf->Output();
		$mpdf->Output($filename.'.pdf','D');
	}
}

// SESSION DATA ===================
if ( ! function_exists('sesUser'))
{
	function sesUser() {
		$ci = get_instance();
		
		$ci->load->model('systems/systems_model');
		return $ci->systems_model->getUsers_ById($ci->session->userdata('user_id'));
	}
}

if ( ! function_exists('sesCompany'))
{
	function sesCompany() {
		$ci = get_instance();
		
		$ci->load->model('systems/systems_model');
		return $ci->systems_model->getCompany_ById($ci->session->userdata('company_id'));
	}
}

if ( ! function_exists('sesBranch'))
{
	function sesBranch() {
		$ci = get_instance();
		
		$ci->load->model('systems/systems_model');
		return $ci->systems_model->getBranch_ById($ci->session->userdata('branch_id'));
	}
}

if ( ! function_exists('sesDepartment'))
{
	function sesDepartment() {
		$ci = get_instance();
		
		$ci->load->model('systems/systems_model');
		return $ci->systems_model->getDepartment_ById($ci->session->userdata('department_id'));
	}
}

if ( ! function_exists('title_case'))
{
	function title_case($string, $exceptions = array()) {
		$words = explode(" ", $string);
		$newwords = array();

		foreach ($words as $word)
		{
			if (!in_array($word, $exceptions)) {
				$word = strtolower($word);
				$word = ucfirst($word);
			}
			array_push($newwords, $word);

		}

		return ucfirst(join(" ", $newwords));
	}
}

// TERBILANG INDONESIAN & ENGLISH ===================
if ( ! function_exists('terbilang_ina'))
{
	function terbilang_ina($x)
	{
		$abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		if ($x < 12)
			$result = " " . $abil[$x];
		elseif ($x < 20)
			$result = terbilang_ina($x - 10) . "belas";
		elseif ($x < 100)
			$result = terbilang_ina($x / 10) . " puluh" . terbilang_ina($x % 10);
		elseif ($x < 200)
			$result = " seratus" . terbilang_ina($x - 100);
		elseif ($x < 1000)
			$result = terbilang_ina($x / 100) . " ratus" . terbilang_ina($x % 100);
		elseif ($x < 2000)
			$result = " seribu" . terbilang_ina($x - 1000);
		elseif ($x < 1000000)
			$result = terbilang_ina($x / 1000) . " ribu" . terbilang_ina($x % 1000);
		elseif ($x < 1000000000)
			$result = terbilang_ina($x / 1000000) . " juta" . terbilang_ina($x % 1000000);
		elseif ($x < 1000000000000)
			$result = terbilang_ina($x / 1000000000) . " miliar" . terbilang_ina($x % 1000000000);
		
		return ucwords($result);
	}	
}

if ( ! function_exists('terbilang_eng'))
{
	function terbilang_eng($number) {
		
		$hyphen      = '-';
		$conjunction = ' and ';
		$separator   = ', ';
		$negative    = 'negative ';
		$decimal     = ' point ';
		$dictionary  = array(
			0                   => 'zero',
			1                   => 'one',
			2                   => 'two',
			3                   => 'three',
			4                   => 'four',
			5                   => 'five',
			6                   => 'six',
			7                   => 'seven',
			8                   => 'eight',
			9                   => 'nine',
			10                  => 'ten',
			11                  => 'eleven',
			12                  => 'twelve',
			13                  => 'thirteen',
			14                  => 'fourteen',
			15                  => 'fifteen',
			16                  => 'sixteen',
			17                  => 'seventeen',
			18                  => 'eighteen',
			19                  => 'nineteen',
			20                  => 'twenty',
			30                  => 'thirty',
			40                  => 'fourty',
			50                  => 'fifty',
			60                  => 'sixty',
			70                  => 'seventy',
			80                  => 'eighty',
			90                  => 'ninety',
			100                 => 'hundred',
			1000                => 'thousand',
			1000000             => 'million',
			1000000000          => 'billion',
			1000000000000       => 'trillion',
			1000000000000000    => 'quadrillion',
			1000000000000000000 => 'quintillion'
		);
		
		if (!is_numeric($number)) {
			return false;
		}
		
		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
			// overflow
			trigger_error(
				'terbilang_eng only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
				E_USER_WARNING
			);
			return false;
		}

		if ($number < 0) {
			return $negative . terbilang_eng(abs($number));
		}
		
		$string = $fraction = null;
		
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		
		switch (true) {
			case $number < 21:
				$string = $dictionary[$number];
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $dictionary[$tens];
				if ($units) {
					$string .= $hyphen . $dictionary[$units];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
				if ($remainder) {
					$string .= $conjunction . terbilang_eng($remainder);
				}
				break;
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				$string = terbilang_eng($numBaseUnits) . ' ' . $dictionary[$baseUnit];
				if ($remainder) {
					$string .= $remainder < 100 ? $conjunction : $separator;
					$string .= terbilang_eng($remainder);
				}
				break;
		}
		
		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $dictionary[$number];
			}
			$string .= implode(' ', $words);
		}
		
		return $string;
	}
}

// GENERATE AUTO CODE ===============================
if ( ! function_exists('get_doc_code'))
{
	function get_doc_code( $company_id, $branch_id=NULL, $department_id=NULL, $code, $save_num=1, $custom_1=NULL, $custom_2=NULL, $custom_3=NULL ) {
		$ci = get_instance();
		
		$filter['company_id']   = $company_id;
		$filter['code'] 		= $code;
		if ( !empty($branch_id) ) $filter['branch_id'] = $branch_id;
		if ( !empty($department_id) ) $filter['department_id'] = $department_id;
		$qry = $ci->db->get_where( 'setup_documents', $filter );
		if ($qry->num_rows() < 1) 
			return FALSE;
		
		$row = $qry->row();
		
		$last_year   = $row->last_year;
		$last_number = $row->last_number;
		$prefix_code_length = $row->prefix_code_length;
		for ($i = 1; $i <= $prefix_code_length; $i++){
			if ($i==1) {
				if ( !empty($row->prefix_code1) )
					$newcode[$i] = get_doc_prefix($row->prefix_code1, $last_year, $row->number_digit, $last_number, $custom_1, $custom_2, $custom_3);
			} elseif ($i==2) {
				if ( !empty($row->prefix_code2) )
					$newcode[$i] = get_doc_prefix($row->prefix_code2, $last_year, $row->number_digit, $last_number, $custom_1, $custom_2, $custom_3);
			} elseif ($i==3) {
				if ( !empty($row->prefix_code3) )
					$newcode[$i] = get_doc_prefix($row->prefix_code3, $last_year, $row->number_digit, $last_number, $custom_1, $custom_2, $custom_3);
			} elseif ($i==4) {
				if ( !empty($row->prefix_code4) )
					$newcode[$i] = get_doc_prefix($row->prefix_code4, $last_year, $row->number_digit, $last_number, $custom_1, $custom_2, $custom_3);
			} elseif ($i==5) {
				if ( !empty($row->prefix_code5) )
					$newcode[$i] = get_doc_prefix($row->prefix_code5, $last_year, $row->number_digit, $last_number, $custom_1, $custom_2, $custom_3);
			} elseif ($i==6) {
				if ( !empty($row->prefix_code6) )
					$newcode[$i] = get_doc_prefix($row->prefix_code6, $last_year, $row->number_digit, $last_number, $custom_1, $custom_2, $custom_3);
			}
		}
		
		// UPDATE & SAVE LAST NUMBER
		if ( $save_num==1 ) 
		{
			$data1['last_year']   = date('Y');
			$data1['last_number'] = ( $last_year != date('Y') ) ? 1 : $last_number+1;
			$ci->db->update( 'setup_documents', $data1, $filter );
		}
		
		return implode($row->separator,$newcode);
	}
}

if ( ! function_exists('number_code'))
{
	function number_code($num, $len = 5) {
		
		for ($i = 1, $n = (string)$num; strlen($n) < $len; $i++)
			$n = '0'.$n;
			
		return $n;
	}
}

if ( ! function_exists('get_doc_prefix'))
{
	function get_doc_prefix( $prefix_code, $last_year=NULL, $number_digit=NULL, $number=NULL, $custom_1=NULL, $custom_2=NULL, $custom_3=NULL ) {
		if ($prefix_code=='YYYY') 
			return date('Y');
		elseif ($prefix_code=='MM') 
			return number_code((int)date('m'), 2);
		elseif ($prefix_code=='NUMBER') 
			return ( $last_year != date('Y') ) ? number_code(1, $number_digit) : number_code($number+1, $number_digit);
		elseif ($prefix_code=='CUSTOM_1') 
			return $custom_1;
		elseif ($prefix_code=='CUSTOM_2') 
			return $custom_2;
		elseif ($prefix_code=='CUSTOM_3') 
			return $custom_3;
		else
			return $prefix_code;
	}
}

if ( ! function_exists('set_doc_last_number'))
{
	function set_doc_last_number( $company_id, $branch_id, $department_id, $code, $auto_code ) {
		$ci = get_instance();
		
		$data['company_id']    = $company_id;
		$data['branch_id'] 	   = $branch_id;
		$data['department_id'] = $department_id;
		$data['department_id'] = $department_id;
		$data['code'] 		   = $code;
		$qry = $ci->db->get_where( 'setup_documents', $data );
		if ($qry->num_rows() < 1) 
			return FALSE;
		
		$row = $qry->row();
		if ( empty($row->separator) ) {
			$start = 0;
			for ($i = 1; $i <= $row->prefix_code_length; $i++){
				if ($i==1) {
					$prefix_code = $row->prefix_code1;
				} elseif ($i==2) {
					$prefix_code = $row->prefix_code2;
				} elseif ($i==3) {
					$prefix_code = $row->prefix_code3;
				} elseif ($i==4) {
					$prefix_code = $row->prefix_code4;
				} elseif ($i==5) {
					$prefix_code = $row->prefix_code5;
				} elseif ($i==6) {
					$prefix_code = $row->prefix_code6;
				}
				
				if ($prefix_code=='YYYY') {
					$year = (int)substr($auto_code, $start, 4);
					$start += 4;
				} elseif ($prefix_code=='MM') {
					$start += 2;
				} elseif ($prefix_code=='NUMBER') {
					$num = (int)substr($auto_code, $start, $row->number_digit);
					$start += $row->number_digit;
				} else {
					$start += strlen($prefix_code);
				}
			}
		} else {
		
			$tmp = explode($row->separator, $auto_code);
			for ($i = 1, $a = 0; $a < $row->prefix_code_length; $i++, $a++){
				if ($i==1) {
					$prefix_code = $row->prefix_code1;
				} elseif ($i==2) {
					$prefix_code = $row->prefix_code2;
				} elseif ($i==3) {
					$prefix_code = $row->prefix_code3;
				} elseif ($i==4) {
					$prefix_code = $row->prefix_code4;
				} elseif ($i==5) {
					$prefix_code = $row->prefix_code5;
				} elseif ($i==6) {
					$prefix_code = $row->prefix_code6;
				}
				
				if ($prefix_code=='YYYY') {
					$year = (int)$tmp[$a];
				} elseif ($prefix_code=='MM') { 
					$month = (int)$tmp[$a];
				} elseif ($prefix_code=='NUMBER') {
					$num = (int)$tmp[$a];
				} else {
					$cod = $tmp[$a];
				}
			}
		}
		
		$data1['last_year'] = $year;
		$data1['last_number'] = $num;
		$ci->db->update( 'setup_documents', $data1, $data );
		
		return TRUE;
	}
}
// CRUD STATUS ======================================
if ( ! function_exists('crud_error'))
{
	function crud_error($err_message)
	{
		echo json_encode( array('isError' => true,"errorMsg"=>l($err_message)) );
		exit;
	}
}

if ( ! function_exists('crud_success'))
{
	function crud_success($result=array())
	{
		$result['success'] = 1;
		echo json_encode( $result );
		exit;
	}
}

if ( ! function_exists('crud_result'))
{
	function crud_result($result)
	{
		echo json_encode( $result );
		exit;
	}
}

// DATE & TIME ===========================
if ( ! function_exists('first_date'))
{
	function first_date($format=NULL, $y, $m) {
		
		if (empty($format)) 
			$format = 'Y-m-d';
			
		return date( $format, mktime(0, 0, 0, $m, 1, $y) );
	}
}

if ( ! function_exists('last_date'))
{
	function last_date($format=NULL, $y, $m) {
		
		if (empty($format)) 
			$format = 'Y-m-d';
			
		$d = cal_days_in_month(CAL_GREGORIAN, $m, $y);
		return date( $format, mktime(0, 0, 0, $m, $d, $y) );
	}
}

if ( ! function_exists('db_date_format'))
{
	function db_date_format($date=NULL)
	{
		if ( empty($date) )
			return NULL;
		
		// dd/mm/yyyy => yyyy-mm-dd
		// $tmp = explode('/', $date);
		// return $tmp[2].'-'.$tmp[1].'-'.$tmp[0];
		
		// dd/mm/yyyy => yyyy-mm-dd
		// list($tmp[2], $tmp[1], $tmp[0]) = explode('/', $date);
		list($d, $m, $y) = explode('/', $date);
		// return implode('-', $tmp);
		return implode('-', [$y, $m, $d]);
	}
}

if ( ! function_exists('mk_date'))
{
	function mk_date($format=NULL, $d=0, $m=0, $y=0) {
		
		if (empty($format)) 
			$format = 'Y-m-d';
			
		return date( $format, mktime(
				0,
				0,
				0,
				$m,
				$d, 
				$y
			));
	}
}

if ( ! function_exists('set_date'))
{
	function set_date($format=NULL, $date, $d=0,$m=0,$y=0) {
		
		if (empty($format)) 
			$format = 'Y-m-d';
		
		if (!empty($date))
		{
			$date = strtotime($date);
			return date( $format, mktime( 0, 0, 0, date('m',$date), date('d',$date), date('Y',$date) ));
		}
		else
		{
			return date( $format, mktime( 0, 0, 0, $m, $d, $y ));
		}
	}
}

if ( ! function_exists('add_date'))
{
	function add_date($format=NULL, $date, $d=0,$m=0,$y=0) {
		
		if (empty($format)) 
			$format = 'Y-m-d';
			
		$date = strtotime($date);
		return date( $format, mktime( 0, 0, 0, date('m',$date)+$m, date('d',$date)+$d, date('Y',$date)+$y ));
	}
}

if ( ! function_exists('add_datetime'))
{
	function add_datetime($date,$d=0,$m=0,$y=0,$h=0,$i=0,$s=0) {

		$cd = strtotime($date);
		return date(
			'Y-m-d h:i:s', 
			mktime(
				date('h',$cd)+$h, 
				date('i',$cd)+$i, 
				date('s',$cd)+$s, 
				date('m',$cd)+$m,
				date('d',$cd)+$d, 
				date('Y',$cd)+$y)
			);
	}
}

// CURRENCY ====================================
if ( ! function_exists('getCurrencyById'))
{
	function getCurrencyById($id) {
		$ci = get_instance();
		
		$params['table'] = 'currency';
		
		$ci->db->select('c.*, COALESCE((select rate from currency_rate as cr where cr.currency_id = c.id and date = curdate()),
			(select rate from currency_rate as cr where cr.currency_id = c.id order by id desc limit 1)) as rate', FALSE);
		$ci->db->from($params['table'].' as c');
		$ci->db->where('id', $id);
		return $ci->db->get()->row();
	
	}
}

if ( ! function_exists('format_rupiah'))
{
	function format_rupiah($val, $precision = 0) {
		//1. cek apakah negatif?
		$n = '';
		if(strstr($val,"-")) { 
			$val = str_replace("-","",$val); 
			$n = "-"; 
		} 
		//2. cek apakah pecahan?
		$val = round((float) $val, (int) $precision);
		if (strpos($val, '.') !== false) {
			list($a, $b) = explode('.', $val); 
		} else {
			$a = $val;
			$b = '';
		}
		//3. format rupiah ! (cara pertama)
		$x = '';
		$i = strlen($a);
		while ($i > 3) {
			$x = "." . substr($a, -3) . $x;
			$a = substr($a, 0, strlen($a)-3);
			$i = strlen($a);
		}
		$a = $a . $x;
		
/* 		//3. format rupiah ! (cara kedua)
		for ($i=0, $j=1, $x=''; $i<strlen($a); $i++, $j++) {
			if (($j % 3) == 0) 
				$x = '.'.substr(strrev($a), $i,1).$x;
			else
				$x = substr(strrev($a), $i,1).$x;
		}
		if ((strlen($a) % 3) == 0)
			$x = substr($x, 1, strlen($x));
		$a = $x;
 */		
		//4. pembulatan
		if (strlen($b) < $precision) $b = str_pad($b, $precision, '0', STR_PAD_RIGHT); 
		
		return $precision ? "$n$a,$b" : "$n$a"; 
	}
}

if ( ! function_exists('seo_friendly'))
{
	function seo_friendly($realname) {

		$seoname = preg_replace('/\%/',' percentage',$realname); 
		$seoname = preg_replace('/\@/',' at ',$seoname); 
		$seoname = preg_replace('/\&/',' and ',$seoname); 
		$seoname = preg_replace('/\s[\s]+/','-',$seoname);    // Strip off multiple spaces 
		$seoname = preg_replace('/[\s\W]+/','-',$seoname);    // Strip off spaces and non-alpha-numeric 
		$seoname = preg_replace('/^[\-]+/','',$seoname); // Strip off the starting hyphens 
		$seoname = preg_replace('/[\-]+$/','',$seoname); // // Strip off the ending hyphens 
		$seoname = strtolower($seoname); 
		return $seoname;
	}
}

if ( ! function_exists('open_pdf'))
{
	function open_pdf($file) {
		
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename='.basename($file));
		//header('Content-Disposition: attachment; filename='.basename($file));
		header('Content-Length: ' . filesize($file));
		//@readfile($file);			
		readfile($file);			
	}
}

if ( ! function_exists('tempnam_sfx'))
{
   function tempnam_sfx($path, $suffix) 
   { 
      do 
      { 
         $file = $path."/".mt_rand().$suffix; 
         $fp = @fopen($file, 'x'); 
      } 
      while(!$fp); 

      fclose($fp); 
      return $file; 
   } 

   // call it like this: 
   //$file = tempnam_sfx("/tmp", ".jpg"); 
 }

if ( ! function_exists('is_allow'))
{
	function is_allow($crud=NULL, $mdl_grp=NULL, $mdl=NULL) {
		$ci = get_instance();
		
		$user_id = $ci->session->userdata('user_id');
		
		// {begin} cek module_group, apakah sudah ada?
		$qry = $ci->db->get_where( 'modules_groups', array('code'=>$mdl_grp) );
		if ( $qry->num_rows() < 1 ) {
			$ci->db->insert( 'modules_groups', array('code'=>strtoupper($mdl_grp), 'name'=>strtoupper($mdl_grp), 'active'=>1));
			$module_group_id = $ci->db->insert_id();
		} else {
			$module_group_id = $qry->row()->id;
		}
		
		// {begin} cek module, apakah sudah ada?
		$qry = $ci->db->get_where( 'modules', array('code'=>$mdl, 'module_group_id'=>$module_group_id) );
		if ( $qry->num_rows() < 1 ) {
			$ci->db->insert('modules', array('module_group_id'=>$module_group_id, 'code'=>strtoupper($mdl), 'name'=>strtoupper($mdl), 'active'=>1));
			$module_id = $ci->db->insert_id();
		} else {
			$module_id = $qry->row()->id;
		}
		
		$query = $ci->db->query("select group_id from users_groups where user_id = $user_id");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$query2 = $ci->db->query("select * from groups_auth where group_id = $row->group_id and module_id = $module_id and $crud = 1");
				if ($query2->num_rows() > 0) 
					return TRUE;
			}
		}
		return FALSE;
	}
}

if ( ! function_exists('set_upload_folder'))
{
	function set_upload_folder( $filepath=NULL ) {
		$ci = get_instance();
		
		$user_id 		 = $ci->session->userdata('user_id');
		$module_group_id = $ci->db->get_where('modules_groups', array('name'=>$mdl_grp))->row()->id;
		
		// {begin} cek module, apakah sudah ada?
		$module_id 	= $ci->db->get_where('modules', array('code'=>$mdl))->row()->id;
		if ( empty($module_id) ) {
			$ci->db->insert('modules', array('module_group_id'=>$module_group_id, 'code'=>strtoupper($mdl), 'name'=>strtoupper($mdl), 'active'=>1));
			$module_id = $ci->db->insert_id();
		} // {end}
		
		$query = $ci->db->query("select group_id from users_groups where user_id = $user_id");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$query2 = $ci->db->query("select * from groups_auth where group_id = $row->group_id and module_id = $module_id and $crud = 1");
				if ($query2->num_rows() > 0) 
					return TRUE;
			}
		}
		return FALSE;
	}
}

// DEBUGGING 
if ( ! function_exists('console_log'))
{
	function console_log($message='')
	{
		echo '<script>console.log("' . $message. '")</script>';
	}
}

if ( ! function_exists('l'))
{
	function l($langkey)
	{
		include('assets/languages/english.php');
		return empty($lang[$langkey]) ? "Undefined language: $langkey" : $lang[$langkey];
	}
}

