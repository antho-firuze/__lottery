<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common_Libraries  extends CI_Controller {

	function my_uploader( $uploadDirectory="./tmp/", $fileType='*' ) {
		// $config = new stdClass();
		$config['upload_path'] 		= $uploadDirectory;
		$config['allowed_types'] 	= $fileType;
		$config['max_size']			= 0;
		$this->load->library('upload', $config);

		if ( !$this->upload->do_upload('userfile') ) {
			throw new Exception($this->upload->display_errors('', ''), 12);
			return false;
		}
		
		return true;
	}

}