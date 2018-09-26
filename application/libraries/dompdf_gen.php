<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Name:  DOMPDF
* 
* Author: Jd Fiscus
* 	 	  jdfiscus@gmail.com
*         @iamfiscus
*          
*
* Origin API Class: http://code.google.com/p/dompdf/
* 
* Location: http://github.com/iamfiscus/Codeigniter-DOMPDF/
*          
* Created:  06.22.2010 
* 
* Description:  This is a Codeigniter library which allows you to convert HTML to PDF with the DOMPDF library
* 
*/

class Dompdf_gen extends CI_Controller {

	public $dompdf_root	= '';
	public $tmp 		= '';
		
	function __construct() {
		
		parent::__construct();

		require_once APPPATH.'third_party/dompdf/dompdf_config.inc.php';

		$this->load->helper('file');
		$this->load->helper('myfunction');
		
		$this->dompdf_root	= 'dompdf/';
		$this->tmp 			= 'tmp/';
		//$this->tmp 			= 'dompdf/tmp/';

		
		//$pdf = new DOMPDF();
		
		//$CI =& get_instance();
		//$CI->dompdf = $pdf;
		
	}
	
	function pdf_create($html, $filename, $stream=TRUE, $orientation="portrait") {

		$dompdf = new DOMPDF();
		$dompdf->set_paper("a4", $orientation);
		$dompdf->set_base_path(APPPATH.'views/reports/');
		$dompdf->load_html($html);
		$dompdf->render();
		
		//$dompdf
		//	->set_paper("a4", $orientation)
		//	->set_base_path(APPPATH.'views/reports/')
		//	->load_html($html)
		//	->render();
		
		if ($stream) { //save only
		
			$dompdf->stream($filename . ".pdf");
		} else { // preview in a browser

			$filename	.= '.pdf';
			$tmpfile 	= $this->tmp.$filename;
			write_file($tmpfile, $dompdf->output());
			open_pdf(base_url().$tmpfile);
			
/*
			// open file pdf menggunakan dompdf.php
			//========================================
			$filename	.= '.html';
			$tmpfile 	= $this->dompdf_root.$this->tmp.$filename;
			write_file($tmpfile, $html);
			$base_path 	= rawurlencode($this->tmp);
			$input_file = rawurlencode($filename);
			$options	= 'dompdf.php?base_path='.$base_path.'&amp;options[Attachment]=0&amp;input_file=' .$input_file. '#toolbar=1&amp;view=FitH&amp;statusbar=0&amp;messages=0&amp;navpanes=1';
			$a			= $this->dompdf_root.$options;
			header(base_url().$a);
*/			

			//echo $_SERVER["HTTP_HOST"]."<br>";
			//echo $_SERVER["PHP_SELF"]."<br>";
			//echo APPPATH."<br>";
			//echo BASEPATH."<br>";
			//echo base_url()."<br>";
			//echo site_url()."<br>";
/*
			if ( ! write_file('tmp/test.txt', $data))
			{
				 echo 'Unable to write the file ';
			}
			else
			{
				 echo 'File written! ';
			}	
*/			
		}
	}

}