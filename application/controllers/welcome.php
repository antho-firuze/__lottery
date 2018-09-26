<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start(); //we need to call PHP's session object to access it through CI

class Welcome extends CI_Controller {

	private $mdl_grp	= 'marketing';
		
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function uploader()
	{
		// $filepath = "./attachments/$company_id/$branch_id/$department_id/$user_id/";
		$filepath = "./attachments/";
		$config['upload_path'] 	 = $filepath;
		$config['allowed_types'] = 'jpeg|jpg|gif|png|doc|docx|xls|xlsx|pdf';
		$config['max_size']		 = 0;
		$config['overwrite']	 = true;
		$this->load->library('upload', $config);
		
		if ( !$this->upload->do_upload('userfile') ) {
			// echo json_encode( array("errorMsg"=>$this->upload->display_errors('', '')) );
			echo json_encode( array('success' => 0, 'msg' => 'Period ID is not Set !') );
			return;
		}
		$filename = $this->upload->data()['file_name'];
		// echo json_encode(array("success"=>1));
		echo json_encode( array('success' => 1, 'msg' => "Importing $filename successfully !") );
		return; 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */