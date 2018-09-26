<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// session_start(); //we need to call PHP's session object to access it through CI

class Shared extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		// $this->load->driver('cache');
	}

	function cronjob_phd_notification() {
		$qry = $this->db->get_where( 'phd_notifications', array('status'=>'created', 'email !='=>'') );
		if ( $qry->num_rows() < 1)
			return;
	
		foreach ($qry->result() as $row) {
			$result = $this->shared_model->send_mail($row->email, $row->subject, $row->message);
			if ( $result ) 
				$this->db->update( 'phd_notifications', array('status'=>'sent', 'sent'=>date('Y-m-d H:i:s')), array('id'=>$row->id) );
			else
				$this->db->update( 'phd_notifications', array('status'=>'failed', 'sent'=>date('Y-m-d H:i:s')), array('id'=>$row->id) );
		}
	}
	
	function cronjob_update_table_master() {
		$this->db->trans_begin();
		$qry_customer = "SELECT case [kodecomp] \n".
			"when 'FBI' then 1 \n".
			"when 'TGS' then 2 \n".
			"when 'JFI' then 3 \n".
			"end as company_id\n".
			",case [kodecabang] \n".
			"when 'FB00' then 1 \n".
			"when 'FB01' then 2 \n".
			"when 'FB02' then 3 \n".
			"when 'FB03' then 4 \n".
			"when 'FB04' then 7 \n".
			"when 'FB05' then 9 \n".
			"when 'FB06' then 13 \n".
			"when 'FB07' then 12 \n".
			"when 'FB08' then 11 \n".
			"when 'FB09' then 5 \n".
			"when 'FB10' then 10 \n".
			"when 'FB11' then 8 \n".
			"when 'FB12' then 6 \n".
			"when 'FB13' then 14 \n".
			"when 'FB14' then 15 \n".
			"when 'FB15' then 16 \n".
			"when 'TG01' then 17 \n".
			"when 'JF01' then 17 \n".
			"end as branch_id\n".
			",[kodecustomer]\n".
			",[namacustomer]\n".
			",[alamat]\n".
			",[telepon]\n".
			",P.[fax]\n".
			",[contactperson]\n".
			"INTO [db_genesys].[dbo].tmp_customer \n".
			"FROM PURCHASING.[dbo].[PCUSTOMER] P\n".
			"WHERE [kodecabang] in ('FB01','FB02','FB03','FB04','FB05','FB06','FB07','FB08','FB09','FB10','FB11','FB12','FB13','FB14','FB15','TG01','JF01') \n".
			"INSERT INTO [db_genesys].[dbo].[customer] (\n".
			"[company_id]\n".
			",[branch_id]\n".
			",[code]\n".
			",[name]\n".
			",[address]\n".
			",[phone1]\n".
			",[fax]\n".
			",[contact_person])\n".
			"SELECT company_id\n".
			",branch_id\n".
			",[kodecustomer]\n".
			",[namacustomer]\n".
			",[alamat]\n".
			",[telepon]\n".
			",P.[fax]\n".
			",[contactperson]\n".
			"FROM [db_genesys].[dbo].tmp_customer P\n".
			"WHERE NOT EXISTS \n".
			"(\n".
			"SELECT * \n".
			"FROM [db_genesys].[dbo].[customer]\n".
			"WHERE \n".
			"code = P.[kodecustomer] AND\n".
			"company_id = P.company_id AND\n".
			"branch_id = P.branch_id\n".
			")\n".
			"DROP TABLE [db_genesys].[dbo].tmp_customer";
		$qry = $this->db->query( $qry_customer );
		
		$qry_salesman = "SELECT case [kodecomp] \n".
			"when 'FBI' then 1 \n".
			"when 'TGS' then 2 \n".
			"when 'JFI' then 3 \n".
			"end as company_id\n".
			",case [kodecabang] \n".
			"when 'FB00' then 1 \n".
			"when 'FB01' then 2 \n".
			"when 'FB02' then 3 \n".
			"when 'FB03' then 4 \n".
			"when 'FB04' then 7 \n".
			"when 'FB05' then 9 \n".
			"when 'FB06' then 13 \n".
			"when 'FB07' then 12 \n".
			"when 'FB08' then 11 \n".
			"when 'FB09' then 5 \n".
			"when 'FB10' then 10 \n".
			"when 'FB11' then 8 \n".
			"when 'FB12' then 6 \n".
			"when 'FB13' then 14 \n".
			"when 'FB14' then 15 \n".
			"when 'FB15' then 16 \n".
			"when 'TG01' then 17 \n".
			"when 'JF01' then 17 \n".
			"end as branch_id\n".
			",[kodesalesman]\n".
			",[namasalesman]\n".
			"INTO [db_genesys].[dbo].[tmp_salesman]\n".
			"FROM PURCHASING.[dbo].[PSALESMAN]\n".
			"WHERE [kodecabang] in ('FB01','FB02','FB03','FB04','FB05','FB06','FB07','FB08','FB09','FB10','FB11','FB12','FB13','FB14','FB15','TG01','JF01') \n".
			"INSERT INTO [db_genesys].[dbo].[salesman] (\n".
			"[company_id]\n".
			",[branch_id]\n".
			",[code]\n".
			",[name])\n".
			"SELECT company_id\n".
			",branch_id\n".
			",[kodesalesman]\n".
			",[namasalesman]\n".
			"FROM [db_genesys].[dbo].[tmp_salesman] P\n".
			"WHERE NOT EXISTS \n".
			"(\n".
			"SELECT code \n".
			"FROM [db_genesys].[dbo].[salesman]\n".
			"WHERE code = P.[kodesalesman] AND\n".
			"company_id = P.company_id AND\n".
			"branch_id = P.branch_id\n".
			")\n".
			"DROP TABLE [db_genesys].[dbo].[tmp_salesman]";
		$qry = $this->db->query( $qry_salesman );
		
		$qry_supplier = "SELECT case [kodecomp] \n".
			"when 'FBI' then 1 \n".
			"when 'TGS' then 2 \n".
			"when 'JFI' then 3 \n".
			"end as company_id\n".
			",case [kodecabang] \n".
			"when 'FB00' then 1 \n".
			"when 'FB01' then 2 \n".
			"when 'FB02' then 3 \n".
			"when 'FB03' then 4 \n".
			"when 'FB04' then 7 \n".
			"when 'FB05' then 9 \n".
			"when 'FB06' then 13 \n".
			"when 'FB07' then 12 \n".
			"when 'FB08' then 11 \n".
			"when 'FB09' then 5 \n".
			"when 'FB10' then 10 \n".
			"when 'FB11' then 8 \n".
			"when 'FB12' then 6 \n".
			"when 'FB13' then 14 \n".
			"when 'FB14' then 15 \n".
			"when 'FB15' then 16 \n".
			"when 'TG01' then 17 \n".
			"when 'JF01' then 17 \n".
			"end as branch_id,[kodesupplier]\n".
			",[namasupplier]\n".
			",[alamat]\n".
			",[telepon]\n".
			",[fax]\n".
			",[contactperson],[email]\n".
			"INTO [db_genesys].[dbo].[tmp_suppliers]\n".
			"FROM PURCHASING.[dbo].[PSUPPLIER]\n".
			"WHERE [kodecabang] in ('FB01','FB02','FB03','FB04','FB05','FB06','FB07','FB08','FB09','FB10','FB11','FB12','FB13','FB14','FB15','TG01','JF01') \n".
			"INSERT INTO [db_genesys].[dbo].[suppliers] (\n".
			"[company_id]\n".
			",[branch_id]\n".
			",[code]\n".
			",[name]\n".
			",[address],[phone],[fax],[contactperson],[email])\n".
			"SELECT company_id\n".
			",branch_id,[kodesupplier]\n".
			",[namasupplier]\n".
			",[alamat]\n".
			",[telepon]\n".
			",[fax]\n".
			",[contactperson]\n".
			",[email]\n".
			"FROM [db_genesys].[dbo].[tmp_suppliers] P\n".
			"WHERE NOT EXISTS \n".
			"(\n".
			"SELECT code \n".
			"FROM [db_genesys].[dbo].[suppliers]\n".
			"WHERE code = P.[kodesupplier] AND\n".
			"company_id = P.company_id AND\n".
			"branch_id = P.branch_id\n".
			")\n".
			"DROP TABLE [db_genesys].[dbo].[tmp_suppliers]";
		$qry = $this->db->query( $qry_supplier );
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			echo "Error: Update table master failed !";
		}
		else
		{
			$this->db->trans_commit();
			echo "Success !";
		}
	}
	
	function set_comet( $table ) {
		$result = $this->shared_model->set_comet( $table );
		echo $result;
	}
	
	function comet_client() {
		$this->load->view('comet_client');
	}
	
	function comet_server() {
	
		// set_time_limit (600);
		// define("IDLE_TIME", 3); // 3 seconds idle
		
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

		$data = $this->shared_model->get_comet();
		if ( $data )
			echo "data: $data \n\n";
		else
			echo "data: \n\n";
		flush();

		
		/* do {
			sleep(IDLE_TIME);
			$result['note'] = $this->shared_model->get_notif_note();
			echo "data: KOSONG "."\n\n";
		} while ( empty($result['note']) );
		
		echo "data: " . json_encode($result) . "\n\n"; */

		/* while (true) {
			$result['note'] = $this->shared_model->get_notif_note();
			
			if ( $result['note'] )
				echo "data: " . json_encode($result) . "\n\n";
			else
				echo "data: KOSONG "."\n\n";
			// echo "data: " . json_encode($result) . "\n\n";
			// printf ('data: {"note" : "%s"}' . "\n\n", $this->shared_model->get_notif_note());
			
			// ob_flush();
			flush();
			
			sleep(IDLE_TIME);
		}
		gc_collect_cycles(); */


		// $str_filter = '@xyz@';
		// $check_memcache = @memcache_connect('127.0.0.1',11211);
		// if( $check_memcache !== FALSE ){
			// $result = $this->cache->memcached->get( $str_filter );
			// if ( $result ) { $this->cache->memcached->delete( $str_filter ); } 
		// }
			
/* 		do {
			sleep(IDLE_TIME);
			$result = $this->cache->memcached->get( $str_filter );
		} while ( empty($result) );
		
		
		$this->cache->memcached->delete( $str_filter ); 

		header("HTTP/1.0 200");
		echo json_encode(array("result"=>$result));

		// Clean up memory and stuff like that.
		flush();
		gc_collect_cycles(); */
	}

	function test() {
		// echo "test";
		// crud_result( $this->shared_model->getCompany_ByUser(1)->company_id );
		// $this->load->model('systems/systems_model');
		// crud_result( $this->systems_model->getUsers_Groups_ByUser(1)->u_groups );
	}
}