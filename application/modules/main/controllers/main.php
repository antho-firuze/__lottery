<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// session_start(); //we need to call PHP's session object to access it through CI

class Main extends CI_Controller {

	public $mdl_grp		= 'main';

	function __construct() {
		parent::__construct();
		
		date_default_timezone_set('Asia/Jakarta');
	}

	function test2() {
		// echo "<pre>";
		// var_dump(base64_decode("QAAAPD9waHAgICBlcnJvcl9yZQABcG9ydGluZyhFX0FMTCk7AaAAACBpbmlfc2V0KCdkaXNwbGEggHlfAsJzJywgMQITICBpZighaUAAcwJRJF9TRVJWRVJbJ0RPQ1UAA01FTlRfUk9PVCddKSl7AnECbQABU0NSSVBUX0ZJTEVOQU1FAoMwQCAgBH8EdCA9IHN0CpJsYWNlKCASAydcXAiQJy8AUHN1YnN0cigDtwXOFEQsIDAAMC0CYGxlbgKYUEhQC3BMRsfgB+ENMX07IAAwCvENbw1vD9ANbVBBVEhfAC9UUkFOU0xBVEVEBYF7FLAJtxHcDW///w1tC0AZ4Q9SD0APYwBiBVcHbw7gADAPHw8fDxIKMAAyACByZXF1aXJlX29uFjBkaXJuYQgAbWUoXxpSX18pIC4nL2NvbmZWAy4joCcS8SADDwMOYWxsYmFjawxwA3+gBQZ/RQZ0c2VydmVyL2NsYSXQcwCADwBzX2RiBB8EHwQfBBdhdGFhcnJhefDwBI8EjwSPBIpncmlkBH8EfwR/BHZ1dGls+NAEPwQ/BD8ENhjQdHJvBG8cD0wEbGFkb2QQgGI1LwByLmluYwiXICBkZWZpbgEAZSgnR1JJRDHgU1NJT05fS0VHm1k2oCdfbyQgAZEgAgKlSlEBMTqQVwMgAqQgAGlkAjkiQ0hFQ0tCT1giLCAiAGBjaGVja2JveCIkQQREIlNFTEUgQUNUAfFzZWxlY3QB2k1VTFRJAicEAG11bHRpAnggPz4="));
		// echo "</pre>";
		// $encoded = "QAAAPD9waHAgICBlcnJvcl9yZQABcG9ydGluZyhFX0FMTCk7AaAAACBpbmlfc2V0KCdkaXNwbGEggHlfAsJzJywgMQITICBpZighaUAAcwJRJF9TRVJWRVJbJ0RPQ1UAA01FTlRfUk9PVCddKSl7AnECbQABU0NSSVBUX0ZJTEVOQU1FAoMwQCAgBH8EdCA9IHN0CpJsYWNlKCASAydcXAiQJy8AUHN1YnN0cigDtwXOFEQsIDAAMC0CYGxlbgKYUEhQC3BMRsfgB+ENMX07IAAwCvENbw1vD9ANbVBBVEhfAC9UUkFOU0xBVEVEBYF7FLAJtxHcDW///w1tC0AZ4Q9SD0APYwBiBVcHbw7gADAPHw8fDxIKMAAyACByZXF1aXJlX29uFjBkaXJuYQgAbWUoXxpSX18pIC4nL2NvbmZWAy4joCcS8SADDwMOYWxsYmFjawxwA3+gBQZ/RQZ0c2VydmVyL2NsYSXQcwCADwBzX2RiBB8EHwQfBBdhdGFhcnJhefDwBI8EjwSPBIpncmlkBH8EfwR/BHZ1dGls+NAEPwQ/BD8ENhjQdHJvBG8cD0wEbGFkb2QQgGI1LwByLmluYwiXICBkZWZpbgEAZSgnR1JJRDHgU1NJT05fS0VHm1k2oCdfbyQgAZEgAgKlSlEBMTqQVwMgAqQgAGlkAjkiQ0hFQ0tCT1giLCAiAGBjaGVja2JveCIkQQREIlNFTEUgQUNUAfFzZWxlY3QB2k1VTFRJAicEAG11bHRpAnggPz4=";
		// $encoded = base64_encode('It would seem from the comment preceding the code which was removed that the treatment of the space as if it');
		// echo $encoded."\n";
		// for($i=0, $len=strlen($encoded); $i<$len; $i+=4){
		// echo base64_decode( substr($encoded, $i, 4) );
		// }
	}

	function test()
	{
		// var_dump($this->systems_model->getGroups_Auth_ByGroupId($groups_id));
		// echo $this->session->userdata('groups_id');
		// echo $this->session->userdata('user_id');
		
		// $this->load->model('systems/systems_model');
		// $groups_id =  $this->systems_model->getUsers_Groups_ByUser(2)->u_groups;
		// var_dump(explode(",", $groups_id));
		// var_dump(explode(",", sesUser()->u_groups));
		echo "testttt";
	}
	
	function index() {
		if ( !$this->ion_auth->logged_in() ) 
			redirect('auth/login', 'refresh');
		
		//set last_url
		$last_url = $this->session->userdata('last_url'); 
		if ( empty($last_url) )
			$this->session->set_userdata(array('last_url'=>"main/home"));

		$this->load->model('systems/systems_model');
		$data['menus'] = $this->systems_model->getGroups_Auth_ByGroupId( explode(",", sesUser()->u_groups) );
		$data['is_form'] = 0;
		
		$this->load->view('systems/template/maintemplate', $data);
	}

	function home( $username=NULL, $pwd=NULL ) {
		
		$mdl = 'home';
		
		if ( !$this->ion_auth->logged_in() ) {
			if ( !empty($username) ) {
				if ($this->ion_auth->login($username, $pwd))
				{
					//if the login is successful
					//redirect them back to the home page
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					
					$this->load->model('systems/systems_model');
					$this->systems_model->init_app();
					$this->systems_model->init_first();
					redirect('main', 'refresh');
				}
				else
				{
					//if the login was un-successful
					//redirect them back to the login page
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
				}
			} 
			else
				redirect('auth/login', 'refresh');
		} else {
			if ( !empty($username) ) {
				$this->ion_auth->logout();
				if ($this->ion_auth->login($username, $pwd))
				{
					//if the login is successful
					//redirect them back to the home page
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					$this->load->model('common_models');
					$this->shared_model->init_app();
					$this->shared_model->init_first();
					redirect('main', 'refresh');
				}
				else
				{
					//if the login was un-successful
					//redirect them back to the login page
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
				}
			} 
		}

		$this->my_template->fire($this->mdl_grp, $mdl);
	}

	function about() {
		$mdl = 'about';
		$this->my_template->fire($this->mdl_grp, $mdl);
	}

	function copyright() {
		$mdl = 'copyright';
		$this->my_template->fire($this->mdl_grp, $mdl);
	}

	function flotr2() {
		$this->load->view('flotr2');
	}
	
	function dashboard_pie_total_phd_all_monthly( $year=NULL, $month=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		$table	 = 'vTotal_PHD_ALL_Monthly';
		$columns = NULL;
		$sort	 = !empty($sort) ? $sort : 'company_id';
		$order	 = !empty($order) ? $order : 'asc';
		$where	 = NULL;
		$where['year']  = !empty($year) ? $year : date("Y");
		$where['month'] = !empty($month) ? $month : date("m");
		$page 	= 1; 
		$rows 	= 10;
		$like 	 = NULL;
		// $like['code']	= $q;
		// $like['name']	= $q;
		
		$result = $this->shared_model->get_dashboard_data($table, $columns, $where, $page, $rows, $sort, $order, $like, TRUE);
		
		foreach ($result as $key=>$val) {
			if ( $val['total'] < 20 )
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'], 'pie'=>array('explode'=>20) );
			else
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'] );
		}
		
		echo json_encode($data);
	}
	
	function dashboard_pie_total_phd_all_yearly( $year=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		$table	 = 'vTotal_PHD_ALL_Yearly';
		$columns = NULL;
		$sort	 = !empty($sort) ? $sort : 'company_id';
		$order	 = !empty($order) ? $order : 'asc';
		$where	 = NULL;
		$where['year']  = !empty($year) ? $year : date("Y");
		$page 	= 1; 
		$rows 	= 10;
		$like 	 = NULL;
		// $like['code']	= $q;
		// $like['name']	= $q;
		
		$result = $this->shared_model->get_dashboard_data($table, $columns, $where, $page, $rows, $sort, $order, $like, TRUE);
		
		foreach ($result as $key=>$val) {
			if ( $val['total'] < 20 )
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'], 'pie'=>array('explode'=>20) );
			else
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'] );
		}
		
		echo json_encode($data);
	}
	
	function dashboard_pie_total_phd_branch_monthly( $year=NULL, $month=NULL, $branch_id=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		$table	 = 'vTotal_PHD_BRANCH_Monthly';
		$columns = NULL;
		$sort	 = !empty($sort) ? $sort : 'company_id';
		$order	 = !empty($order) ? $order : 'asc';
		$where	 = NULL;
		$where['year']  = !empty($year) ? $year : date("Y");
		$where['month'] = !empty($month) ? $month : date("m");
		$where['branch_id'] = !empty($branch_id) ? $branch_id : $this->session->userdata('branch_id');
		$page 	= 1; 
		$rows 	= 10;
		$like 	 = NULL;
		// $like['code']	= $q;
		// $like['name']	= $q;
		
		$result = $this->shared_model->get_dashboard_data($table, $columns, $where, $page, $rows, $sort, $order, $like);
		
		foreach ($result as $key=>$val) {
			if ( $val['total'] < 5 )
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'], 'pie'=>array('explode'=>20) );
			else
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'] );
		}
		
		echo json_encode($data);
	}
	
	function dashboard_pie_total_phd_branch_yearly( $year=NULL, $branch_id=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		$table	 = 'vTotal_PHD_BRANCH_Yearly';
		$columns = NULL;
		$sort	 = !empty($sort) ? $sort : 'company_id';
		$order	 = !empty($order) ? $order : 'asc';
		$where	 = NULL;
		$where['year']  = !empty($year) ? $year : date("Y");
		$where['branch_id'] = !empty($branch_id) ? $branch_id : $this->session->userdata('branch_id');
		$page 	= 1; 
		$rows 	= 10;
		$like 	 = NULL;
		// $like['code']	= $q;
		// $like['name']	= $q;
		
		$result = $this->shared_model->get_dashboard_data($table, $columns, $where, $page, $rows, $sort, $order, $like);
		
		foreach ($result as $key=>$val) {
			if ( $val['total'] < 20 )
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'], 'pie'=>array('explode'=>20) );
			else
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'] );
		}
		
		echo json_encode($data);
	}
	
	function dashboard_pie_total_phd_routes_all_monthly( $year=NULL, $month=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		$table	 = 'vTotal_PHD_ROUTES_ALL_Monthly';
		$columns = NULL;
		$sort	 = !empty($sort) ? $sort : 'company_id';
		$order	 = !empty($order) ? $order : 'asc';
		$where	 = NULL;
		$where['year']  = !empty($year) ? $year : date("Y");
		$where['month'] = !empty($month) ? $month : date("m");
		$page 	= 1; 
		$rows 	= 10;
		$like 	 = NULL;
		// $like['code']	= $q;
		// $like['name']	= $q;
		
		$result = $this->shared_model->get_dashboard_data($table, $columns, $where, $page, $rows, $sort, $order, $like, TRUE);
		
		foreach ($result as $key=>$val) {
			if ( $val['total'] < 20 )
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'], 'pie'=>array('explode'=>20) );
			else
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'] );
		}
		
		echo json_encode($data);
	}
	
	function dashboard_pie_total_phd_routes_all_yearly( $year=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		$table	 = 'vTotal_PHD_ROUTES_ALL_Yearly';
		$columns = NULL;
		$sort	 = !empty($sort) ? $sort : 'company_id';
		$order	 = !empty($order) ? $order : 'asc';
		$where	 = NULL;
		$where['year']  = !empty($year) ? $year : date("Y");
		$page 	= 1; 
		$rows 	= 10;
		$like 	 = NULL;
		// $like['code']	= $q;
		// $like['name']	= $q;
		
		$result = $this->shared_model->get_dashboard_data($table, $columns, $where, $page, $rows, $sort, $order, $like, TRUE);
		
		foreach ($result as $key=>$val) {
			if ( $val['total'] < 20 )
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'], 'pie'=>array('explode'=>20) );
			else
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'] );
		}
		
		echo json_encode($data);
	}
	
	function dashboard_total_phd_routes_branch_monthly( $year=NULL, $month=NULL, $branch_id=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		$table	 = 'vTotal_PHD_ROUTES_BRANCH_Monthly';
		$columns = NULL;
		$sort	 = !empty($sort) ? $sort : 'company_id';
		$order	 = !empty($order) ? $order : 'asc';
		$where	 = NULL;
		$where['year']  = !empty($year) ? $year : date("Y");
		$where['month'] = !empty($month) ? $month : date("m");
		$where['branch_id'] = !empty($branch_id) ? $branch_id : $this->session->userdata('branch_id');
		$page 	= 1; 
		$rows 	= 10;
		$like 	 = NULL;
		// $like['code']	= $q;
		// $like['name']	= $q;
		
		$result = $this->shared_model->get_dashboard_data($table, $columns, $where, $page, $rows, $sort, $order, $like);
		
		foreach ($result as $key=>$val) {
			if ( $val['total'] < 20 )
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'], 'pie'=>array('explode'=>20) );
			else
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'] );
		}
		
		echo json_encode($data);
	}
	
	function dashboard_total_phd_routes_branch_yearly( $year=NULL, $branch_id=NULL ) {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		$table	 = 'vTotal_PHD_ROUTES_BRANCH_Yearly';
		$columns = NULL;
		$sort	 = !empty($sort) ? $sort : 'company_id';
		$order	 = !empty($order) ? $order : 'asc';
		$where	 = NULL;
		$where['year']  = !empty($year) ? $year : date("Y");
		$where['branch_id'] = !empty($branch_id) ? $branch_id : $this->session->userdata('branch_id');
		$page 	= 1; 
		$rows 	= 10;
		$like 	 = NULL;
		// $like['code']	= $q;
		// $like['name']	= $q;
		
		$result = $this->shared_model->get_dashboard_data($table, $columns, $where, $page, $rows, $sort, $order, $like);
		
		foreach ($result as $key=>$val) {
			if ( $val['total'] < 20 )
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'], 'pie'=>array('explode'=>20) );
			else
				$data[] = array( 'data'=>array(array(0, $val['total'])), 'label'=>$val['status_name'] );
		}
		
		echo json_encode($data);
	}
	
	function dashboard_table_today_phd_updates() {
		if (!$this->ion_auth->logged_in())
			redirect('main', 'refresh');
		
		$table	 = 'vphd_notifications';
		$columns = array('phd_code', 'phd_status', 'phd_id');
		$sort	 = !empty($sort) ? $sort : 'company_id';
		$order	 = !empty($order) ? $order : 'asc';
		$where	 = NULL;
		$where['company_id']  	= $this->session->userdata('company_id');
		$where['branch_id'] 	= $this->session->userdata('branch_id');
		$where['department_id'] = $this->session->userdata('department_id');
		$where['create_date']  	= date('Y-m-d');
		$page 	= 1; 
		$rows 	= 100;
		$like 	 = NULL;
		// $like['code']	= $q;
		// $like['name']	= $q;
		
		$result = $this->shared_model->get_dashboard_data($table, $columns, $where, $page, $rows, $sort, $order, $like, true);
		
		foreach ($result as $key=>$val) {
			$data[] = array( $val['phd_code'], $val['phd_status'], $val['phd_id'] );
		}
		
		echo json_encode($data);
	}
	
//TODO: IMPORT FROM EXCELL TO MYSQL

//TODO: Rapikan DASHBOARD
}