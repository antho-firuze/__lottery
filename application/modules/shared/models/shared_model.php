<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shared_Model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		
		// FOR MEMCACHED
		$this->load->driver('cache');
	}
	
	function get_rec( $params ) {
		if ( is_array($params) )
		{
			if ( array_key_exists('where', $params) ) $this->db->where($params['where']);
			if ( array_key_exists('like', $params) ) 
			{
				$this->db->bracket('open','like');
				$this->db->or_like($params['like']);
				$this->db->bracket('close','like');
			}
			if ( array_key_exists('sort', $params) ) $this->db->order_by($params['sort'], $params['order']);
			if ( array_key_exists('page', $params) && array_key_exists('rows', $params) )
			{
				$params['page'] = empty($params['page']) ? 1 : $params['page'];
				$offset = ($params['page']-1)*$params['rows'];
				$this->db->limit($params['rows'], $offset);
			}
		}
		return $this->db->get()->result();
	}
	
	function get_rec_count( $params ) {
		if ( is_array($params) )
		{
			if ( array_key_exists('where', $params) ) $this->db->where($params['where']);
			if ( array_key_exists('like', $params) ) 
			{
				$this->db->bracket('open','like');
				$this->db->or_like($params['like']);
				$this->db->bracket('close','like');
			}
		}
		$result = $this->db->get();
		return ($result->num_rows() > 0) ? $result->row()->rec_count : 0;
	}
	
	function get_rec_rep( $params ) {
		if ( is_array($params) )
		{
			if ( array_key_exists('where', $params) ) $this->db->where($params['where']);
			if ( array_key_exists('like', $params) ) 
			{
				$this->db->bracket('open','like');
				$this->db->or_like($params['like']);
				$this->db->bracket('close','like');
			}
			if ( array_key_exists('sort', $params) ) $this->db->order_by($params['sort'], $params['order']);
			if ( array_key_exists('page', $params) && array_key_exists('rows', $params) )
			{
				$offset = ($params['page']-1)*$params['rows'];
				$this->db->limit($params['rows'], $offset);
			}
		}
		return $this->db->get();
	}
	
    /**
     * fungsi loading data untuk easyui "datagrid, combogrid"
     * with memcache enabled
     *
     *
     *
     */
	function get_easyui_data( $table=NULL, $columns=NULL, $where=NULL, $page=1, $rows=10, $sidx='', $sord='desc', $like=NULL, $req_new=FALSE ) { 
		$page   = !empty($page) ? intval($page) : 1;  
		$rows   = !empty($rows) ? intval($rows) : 100;  //if pagination=false. They not send page & rows. Jadi harus ditampilkan semua !
		$offset = ($page-1)*$rows;
		
		// $schema = $this->db->database;
		if ( is_null($table) ) return;
		if ( is_null($columns) ) 
			$columns = '*';
		else
			$columns = implode(",", $columns);
			
		// CLEARING CACHE
		// $this->cache->memcached->clean();
		
		// $check_memcache = @memcache_connect('127.0.0.1',11211);
		$check_memcache = FALSE;
		if( $check_memcache !== FALSE ){
		
			// USING CACHE
			$filter[0] = $table;
			$filter[1] = $page;
			$filter[2] = $rows;
			$filter[3] = $sord;
			if ( !empty($where) ) $filter[4] = implode(';', $where);
			if ( !empty($like) ) $filter[5] = implode(';', $like);
			$str_filter = implode(';',$filter);
		
			if ( $req_new ) $this->cache->memcached->delete( $str_filter );
			$result = $this->cache->memcached->get( $str_filter );
			if ( !$result ) {
				$this->db->select($columns)->from($table)->order_by($sidx, $sord)->limit($rows, $offset);
				if ( !empty($where) ) $this->db->where($where);
				if ( !empty($like) ) 
				{ 
					$this->db->bracket('open','like');
					$this->db->or_like($like);
					$this->db->bracket('close','like');
				}
				$result = $this->db->get()->result_array();

				$this->cache->memcached->save($str_filter, $result, 60);
			}
			
			$filter[6] = 'rec_count';
			$str_filter = implode(';',$filter);
			
			if ( $req_new ) $this->cache->memcached->delete( $str_filter );
			$num_row = $this->cache->memcached->get($str_filter);
			if ( !$num_row ) {
				$this->db->flush_cache();
				$this->db->select('COUNT(*) AS rec_count', FALSE)->from($table);
				if ( !empty($where) ) $this->db->where($where);
				if ( !empty($like) ) { 
					$this->db->bracket('open','like');
					$this->db->or_like($like);
					$this->db->bracket('close','like');
				}
				$num_row = $this->db->get()->row()->rec_count;

				$this->cache->memcached->save($str_filter, $num_row, 60);
			}
		} else {
		    // memcached is _probably_ not running
			
			$this->db->select($columns)->from($table)->order_by($sidx, $sord)->limit($rows, $offset);
			if ( !empty($where) ) $this->db->where($where);
			if ( !empty($like) ) 
			{ 
				// $this->db->where($like, NULL);
				$this->db->bracket('open','like');
				$this->db->or_like($like);
				$this->db->bracket('close','like');
			}
			$result = $this->db->get()->result_array();
			
			$this->db->flush_cache();
			
			$this->db->select('COUNT(*) AS rec_count', FALSE)->from($table);
			if ( !empty($where) ) $this->db->where($where);
			if ( !empty($like) ) { 
				// $this->db->where($like, NULL);
				$this->db->bracket('open','like');
				$this->db->or_like($like);
				$this->db->bracket('close','like');
			}
			$num_row = $this->db->get()->row()->rec_count;
		}
		
		$response = new stdClass();
		$response->total = $num_row;
		$response->rows  = $result;
		return $response;
	}
	
	function get_dashboard_data( $table=NULL, $columns=NULL, $where=NULL, $page=1, $rows=10, $sidx='', $sord='desc', $like=NULL, $req_new=FALSE ) { 
		$page   = !empty($page) ? intval($page) : 1;  
		$rows   = !empty($rows) ? intval($rows) : 100;  //if pagination=false. They not send page & rows. Jadi harus ditampilkan semua !
		$offset = ($page-1)*$rows;
		
		// $schema = $this->db->database;
		if ( is_null($table) ) return;
		if ( is_null($columns) ) 
			$columns = '*';
		else
			$columns = implode(",", $columns);
			
		// CLEARING CACHE
		// $this->cache->memcached->clean();
		
		// $check_memcache = @memcache_connect('127.0.0.1',11211);
		$check_memcache = FALSE;
		if( $check_memcache !== FALSE ){
		
			// USING CACHE
			$filter[0] = $table;
			$filter[1] = $page;
			$filter[2] = $rows;
			$filter[3] = $sord;
			if ( !empty($where) ) 
				$filter[4] = implode(';', $where);
			if ( !empty($like) ) 
				$filter[5] = implode(';', $like);
			$str_filter = implode(';',$filter);
		
			if ( $req_new ) $this->cache->memcached->delete( $str_filter );
			$result = $this->cache->memcached->get( $str_filter );
			if ( !$result ) {
				$this->db->select($columns)->from($table)->order_by($sidx, $sord)->limit($rows, $offset);
				if ( !empty($where) ) $this->db->where($where);
				if ( !empty($like) ) { 
					$this->db->or_like($like);
					$this->db->bracket('close','like');
				}
				$result = $this->db->get()->result_array();

				$this->cache->memcached->save($str_filter, $result, 60);
			}
			
			$filter[6] = 'rec_count';
			$str_filter = implode(';',$filter);
			
			if ( $req_new ) $this->cache->memcached->delete( $str_filter );
			$num_row = $this->cache->memcached->get($str_filter);
			if ( !$num_row ) {
				$this->db->flush_cache();
				$this->db->select('COUNT(*) AS rec_count', FALSE)->from($table);
				if ( !empty($where) ) $this->db->where($where);
				if ( !empty($like) ) { 
					$this->db->or_like($like);
					$this->db->bracket('close','like');
				}
				$num_row = $this->db->get()->row()->rec_count;

				$this->cache->memcached->save($str_filter, $num_row, 60);
			}
		} else {
		    // memcached is _probably_ not running
			
			$this->db->select($columns)->from($table)->order_by($sidx, $sord)->limit($rows, $offset);
			if ( !empty($where) ) $this->db->where($where);
			if ( !empty($like) ) { 
				$this->db->or_like($like);
				$this->db->bracket('close','like');
			}
			$result = $this->db->get()->result_array();
			
			$this->db->flush_cache();
			
			$this->db->select('COUNT(*) AS rec_count', FALSE)->from($table);
			if ( !empty($where) ) $this->db->where($where);
			if ( !empty($like) ) { 
				$this->db->or_like($like);
				$this->db->bracket('close','like');
			}
			$num_row = $this->db->get()->row()->rec_count;
		}
		
		// $response = new stdClass();
		// $response->total = $num_row;
		// $response->rows  = $result;
		// return $response;
		
		return $result;
	}
	
	function get_easyui_data_tree( $table=NULL, $columns=NULL, $where=NULL, $page=1, $rows=10, $sidx=0, $sord='asc', $like=NULL, $id=NULL, $req_new=FALSE ) { 
		$page   = !empty($page) ? intval($page) : 1;  
		$rows   = !empty($rows) ? intval($rows) : 100;  //if pagination=false. They not send page & rows. Jadi harus ditampilkan semua !
		$offset = ($page-1)*$rows;

		if ( is_null($table) ) return;
		if ( is_null($columns) ) 
			$columns = '*';
		else
			$columns = implode(",", $columns);
		
		// CLEARING CACHE
		// $this->cache->memcached->clean();
		
		// $id = !empty($id) ? intval($id) : 0;
		if (empty($id)) $id = 0;

		// USING CACHE
		$filter[0] = $table;
		$filter[1] = $page;
		$filter[2] = $rows;
		$filter[3] = $sord;
		$filter[4] = $id;
		if ( !empty($where) ) 
			$filter[5] = implode(';', $where);
		if ( !empty($like) ) 
			$filter[6] = implode(';', $like);
		$str_filter = implode(';',$filter);
		
		// $check_memcache = @memcache_connect('127.0.0.1',11211);
		$check_memcache = FALSE;
		if( $check_memcache !== FALSE ){
		
		    // memcached is _probably_ not running
			
			if ( $req_new ) $this->cache->memcached->delete( $str_filter );
			$result = $this->cache->memcached->get( $str_filter );
			if ( !$result ) {
				
				if ( $id==0 ) {
					$this->db->select($columns)->from($table)->order_by($sidx, $sord)->limit($rows, $offset);
					if ( !empty($where) ) $this->db->where($where);
					if ( !empty($like) ) { 
						$this->db->or_like($like);
						$this->db->bracket('close','like');
					}
					$this->db->where('parent_id', 0);
					$result = $this->db->get()->result_array();

					$items = array();
					foreach ( $result as $r ) {
						$r['state'] = ($this->has_child( $table, $r['id'] )) ? 'closed' : 'open';
						array_push($items, $r);
					}
					$result = $items;
					
					$filter[7] = 'rec_count';
					$str_filter = implode(';',$filter);
					if ( $req_new ) $this->cache->memcached->delete( $str_filter );
					$num_row = $this->cache->memcached->get($str_filter);
					if ( !$num_row ) {
						$this->db->flush_cache();
						$this->db->select('COUNT(*) AS rec_count', FALSE)->from($table);
						if ( !empty($where) ) $this->db->where($where);
						if ( !empty($like) ) { 
							$this->db->or_like($like);
							$this->db->bracket('close','like');
						}
						$this->db->where('parent_id', 0);
						$num_row = $this->db->get()->row()->rec_count;

						$this->cache->memcached->save($str_filter, $num_row, 60);
					}
			
					$response = new stdClass();
					$response->total = $num_row;
					$response->rows  = $result; 
				} else {
				
					$this->db->select($columns)->from($table)->order_by($sidx, $sord);
					if ( !empty($where) ) $this->db->where($where);
					if ( !empty($like) ) { 
						$this->db->or_like($like);
						$this->db->bracket('close','like');
					}
					$this->db->where('parent_id', $id);
					$result = $this->db->get()->result_array();

					$items = array();
					foreach ( $result as $r ) {
						$r['state'] = ($this->has_child( $table, $r['id'] )) ? 'closed' : 'open';
						array_push($items, $r);
					}
					$result = $items;
					$response = $result;
				}
				
				$this->cache->memcached->save($str_filter, $result, 60);
			}
		} else {
		
			if ( $id==0 ) {
				$this->db->select($columns)->from($table)->order_by($sidx, $sord)->limit($rows, $offset);
				if ( !empty($where) ) $this->db->where($where);
				if ( !empty($like) ) { 
					$this->db->or_like($like);
					$this->db->bracket('close','like');
				}
				$this->db->where('parent_id', 0);
				$result = $this->db->get()->result_array();

				$items = array();
				foreach ( $result as $r ) {
					$r['state'] = ($this->has_child( $table, $r['id'] )) ? 'closed' : 'open';
					array_push($items, $r);
				}
				$result = $items;
				
				$this->db->flush_cache();
				$this->db->select('COUNT(*) AS rec_count', FALSE)->from($table);
				if ( !empty($where) ) $this->db->where($where);
				if ( !empty($like) ) { 
					$this->db->or_like($like);
					$this->db->bracket('close','like');
				}
				$this->db->where('parent_id', 0);
				$num_row = $this->db->get()->row()->rec_count;

				$response = new stdClass();
				$response->total = $num_row;
				$response->rows  = $result; 
			} else {
			
				$this->db->select($columns)->from($table)->order_by($sidx, $sord);
				if ( !empty($where) ) $this->db->where($where);
				if ( !empty($like) ) { 
					$this->db->or_like($like);
					$this->db->bracket('close','like');
				}
				$this->db->where('parent_id', $id);
				$result = $this->db->get()->result_array();

				$items = array();
				foreach ( $result as $r ) {
					$r['state'] = ($this->has_child( $table, $r['id'] )) ? 'closed' : 'open';
					array_push($items, $r);
				}
				$result = $items;
				$response = $result;
			}
		}
		
		return $response;
	}
	
	function has_child( $table, $id ) {
		// $qry = $this->db->get_where( $table, array('parent_id'=>$id) );
		// return ($qry->num_rows() > 0) ? TRUE : FALSE;
		
		$this->db->select('COUNT(*) AS rec_count', FALSE)->from($table)->where('parent_id', $id);
		$num_row = $this->db->get()->row()->rec_count;
		return ($num_row > 0) ? TRUE : FALSE;
	}

	function get_jqgrid_data( $table=NULL, $columns=NULL, $where=NULL, $page=1, $limit=10, $sidx=1, $sord='desc' ) { 
		$schema = $this->db->database;
		if ( is_null($table) ) return;
		if ( is_null($columns) ) 
			$columns = '*';
		else
			$columns = implode(",", $columns);

		// $count = $this->db->get_where($table, $where)->num_rows();
		$this->db->select('COUNT(*) AS rec_count', FALSE)->from($table);
		if ( !empty($where) ) $this->db->where($where);
		if ( !empty($like) ) { 
			$this->db->or_like($like);
			$this->db->bracket('close','like');
		}
		$count = $this->db->get()->row()->rec_count;
		if( $count > 0 ) 
			$total_pages = ceil($count/$limit);
		else 
			$total_pages = 0;

		if ($page > $total_pages) 
			$page = $total_pages;

		$start = $limit*$page - $limit;
		if ($start<0) $start=0;
		// ** end calculate page
		
		// METODE KEDUA
		$sidx = (int)$sidx;
		$this->db->select($columns)->from($table)->order_by($columns[$sidx], $sord)->limit($limit, $start);
		if ( ! is_null($where) ) $this->db->where($where);
		$rows = $this->db->get()->result_array();
		 
		// ** end build query

		$response = new stdClass();
		$response->page 	= $page;
		$response->total 	= $total_pages;
		$response->records 	= $count;

		$i=0; 
		foreach ($rows as $row) {
			$columnData = array();
			foreach( $columns as $column ){
				array_push( $columnData, $row[$column] );
			}
			$response->rows[$i]['id']	= $row['id'];
			$response->rows[$i]['cell']	= $columnData;
			$i++;
		}
		
		return $response;
	}
	
	function get_dhtmlx_data( $table=NULL, $id=NULL, $columns=NULL, $where=NULL ) {
		$cols = $columns;
		array_unshift($cols, $id);
		
		$sel_col = implode(",", $cols);
		$this->db->select($sel_col)->from($table);
		
		if ( ! is_null($where) ) 
			$this->db->where($where);
		
		// $this->db->order_by($columns[$sidx], $sord);
		
		$rows = $this->db->get()->result_array();
		
		if ( ! $rows) return array();

		$i=0; 
		foreach ($rows as $row) {
			$columnData = array();
			foreach( $columns as $column ){
				array_push( $columnData, $row[$column] );
			}
			$response->rows[$i]['id']	= $row[$id];
			$response->rows[$i]['data']	= $columnData;
			$i++;
		}
		return $response;
	}

	function send_mail( $email=NULL, $subject=NULL, $message=NULL ){
		if ( empty($email) )
			return FALSE;
		
		$this->load->library('email');

		$this->email->clear();
		
		$this->email->set_newline("\r\n");
		$this->email->from('genesys0681@gmail.com', 'G.ENE.SYS');
		$this->email->to($email); 
		// $this->email->cc('antho.firuze@gmail.com'); 

		$this->email->subject($subject);
		$this->email->message($message);	

		return $this->email->send();
	}
	
	function get_module_name( $mdl_grp=NULL, $mdl=NULL ){
	
		// $check_memcache = @memcache_connect('127.0.0.1',11211);
		$check_memcache = FALSE;
		if( $check_memcache !== FALSE ){
		
			// USING CACHE
			$filter[0] = $mdl_grp;
			$filter[1] = $mdl;
			$str_filter = implode(';',$filter);
		
			$result = $this->cache->memcached->get( $str_filter );
			if ( !$result ) {
				$result = new stdClass();
				$result->mdl_grp_name = $this->db->get_where( 'modules_groups', array('code'=>$mdl_grp) )->row()->name;
				$result->mdl_name 	  = $this->db->get_where( 'modules', array('code'=>$mdl) )->row()->name;

				$this->cache->memcached->save($str_filter, $result, 3600);
			}
		} else {
		    // memcached is _probably_ not running
			
				$result = new stdClass();
				$result->mdl_grp_name = $this->db->get_where( 'modules_groups', array('code'=>$mdl_grp) )->row()->name;
				$result->mdl_name 	  = $this->db->get_where( 'modules', array('code'=>$mdl) )->row()->name;
		}
		return $result;
	}
	
	function set_comet( $table ) {
		$data['param1'] = '@xyz@';
		$data['param2'] = $table;
		// $check_memcache = @memcache_connect('127.0.0.1',11211);
		$check_memcache = FALSE;
		if( $check_memcache !== FALSE ){
			$this->cache->memcached->save($data['param1'], $data['param2'], 4);
		} else {
			$this->db->insert('comet', $data);
		}
	}
	
	function get_comet() {
		$data['param1'] = '@xyz@';
		// $check_memcache = @memcache_connect('127.0.0.1',11211);
		$check_memcache = FALSE;
		if( $check_memcache !== FALSE ){
			$result = $this->cache->memcached->get( $data['param1'] );
			// $this->cache->memcached->delete( $data['param1'] );
			return $result;
		} else {
			$qry = $this->db->get_where('comet', $data);
			if ($qry->num_rows() > 0) {
				$param2 = $qry->row()->param2;
				// sleep for 5 seconds
				sleep(5);
				$this->db->delete('comet', $data);
				return $param2;
			}
		}
	}
	
	function update_relation_n_n( $table=NULL, $primary_field=NULL, $primary_value=NULL, $foreign_field=NULL, $foreign_values=NULL ) {

		$this->db->delete( $table, array($primary_field=>$primary_value));
		if ( !empty($foreign_values) ) {
			foreach ($foreign_values as $value) {	
				$this->db->insert( $table, array($primary_field=>$primary_value, $foreign_field=>$value));
			}
			return TRUE;
		}
		return FALSE;
	}
	
	function get_notif_note() {
		
		$notif = $this->db->get( 'notif' );
		if ( $notif->num_rows() < 1 )
			return FALSE;
			
		return $notif->row()->note;
	}
	
	function get_document_sign( $company_id, $branch_id, $department_id, $doc_code ) {
		$filter['company_id'] 	 = $company_id;
		$filter['branch_id'] 	 = $branch_id;
		$filter['department_id'] = $department_id;
		$filter['code'] 	 	 = $doc_code;
		
		$qry = $this->db->get_where( 'setup_documents', $filter );
		if ($qry->num_rows() < 1) {
			$data['sign1'] = NULL;
			$data['sign2'] = NULL;
			$data['sign3'] = NULL;
		} else {
			$row = $qry->row();
			$data['sign1'] = $row->sign1;
			$data['sign2'] = $row->sign2;
			$data['sign3'] = $row->sign3;
		}
		
		return $data;
	}
	
	function is_duplicate_code( $table=NULL, $code=NULL ) {
		return empty($this->db->get_where($table, array('code'=>$code), 1)->row()->id) ? FALSE : TRUE;
	}
	
	function is_duplicate_username( $table=NULL, $username=NULL ) {
		return empty($this->db->get_where($table, array('username'=>$username), 1)->row()->id) ? FALSE : TRUE;
	}
	
	function is_customer_exists( $company_id=NULL, $customer_id=NULL ) {
		$qry = $this->db->get_where( 'customer', array('id'=>intval($customer_id), 'company_id'=>$company_id) );
		return ($qry->num_rows() < 1) ? FALSE : TRUE;
		if ( $qry->num_rows() < 1 ) 
			return FALSE;
		else
			return TRUE;
	}
	
	function is_data_exists_on( $table=NULL, $fields=NULL, $search_value=NULL ) {
		$f = array();
		foreach ( $fields as $field ) {
			$f[$field] = $search_value;
		}
		return empty($this->db->get_where($table, $f, 1)->row()->id) ? FALSE : TRUE;
	}
	
	// ================================ FUNCTION FOR CLINIC =============================================
	
	function recalc_transaction_per_id( $type, $id ){
		$this->db->trans_begin();
		
		if ( $type=='so' ) {
			$q_dt = $this->db->get_where( 'so_dt', array('so_id'=>$id, 'recalc'=>0) );
			if ( $q_dt->num_rows() > 0 ) {
				foreach ( $q_dt->result() as $r_dt ) {
				
					$q_item = $this->db->get_where( 'item', array('id'=>$r_dt->item_id) );
					if ( $q_item->num_rows() > 0 ) {
					
						$r_item = $q_item->row();
						// SALES => MENGURANGI STOCK
						$data['stock_val'] = $r_item->stock_val - $r_dt->item_qty;
						$this->db->update( 'item', $data, array('id'=>$r_item->id) );
					}
					
					$this->db->update( 'so_dt', array('recalc'=>1), array('id'=>$r_dt->id) );
				}
			}
		} elseif ( $type=='po' ) {
			$q_dt = $this->db->get_where( 'po_dt', array('po_id'=>$id, 'recalc'=>0) );
			if ( $q_dt->num_rows() > 0 ) {
				foreach ( $q_dt->result() as $r_dt ) {
				
					$q_item = $this->db->get_where( 'item', array('id'=>$r_dt->item_id) );
					if ( $q_item->num_rows() > 0 ) {
					
						$r_item = $q_item->row();
						// PURCHASE => MENAMBAH STOCK
						$data['stock_val'] = $r_item->stock_val + $r_dt->item_qty;
						$this->db->update( 'item', $data, array('id'=>$r_item->id) );
					}
					
					$this->db->update( 'po_dt', array('recalc'=>1), array('id'=>$r_dt->id) );
				}
			}
		}
			
		$this->db->trans_commit();
		return TRUE;
	}
	
	function recalc_transaction_per_date( $type, $date ){
		$this->db->trans_begin();
		
		if ( $type=='so' ) {
			$q_hd = $this->db->get_where( 'so', array('date'=>$date, 'status_id'=>0) );
			if ( $q_hd->num_rows() > 0 ) {
				foreach ( $q_hd->result() as $r_hd ) {

					$q_dt = $this->db->get_where( 'so_dt', array('so_id'=>$r_hd->id, 'recalc'=>0) );
					if ( $q_dt->num_rows() > 0 ) {
						foreach ( $q_dt->result() as $r_dt ) {
						
							$q_item = $this->db->get_where( 'item', array('id'=>$r_dt->item_id) );
							if ( $q_item->num_rows() > 0 ) {
							
								$r_item = $q_item->row();
								// SALES => MENGURANGI STOCK
								$data['stock_val'] = $r_item->stock_val - $r_dt->item_qty;
								$this->db->update( 'item', $data, array('id'=>$r_item->id) );
							}
							
							$this->db->update( 'so_dt', array('recalc'=>1), array('id'=>$r_dt->id) );
						}
					}
				}
			}
		} elseif ( $type=='po' ) {
			$q_hd = $this->db->get_where( 'po', array('date'=>$date, 'status_id'=>0) );
			if ( $q_hd->num_rows() > 0 ) {
				foreach ( $q_hd->result() as $r_hd ) {

					$q_dt = $this->db->get_where( 'po_dt', array('po_id'=>$r_hd->id, 'recalc'=>0) );
					if ( $q_dt->num_rows() > 0 ) {
						foreach ( $q_dt->result() as $r_dt ) {
						
							$q_item = $this->db->get_where( 'item', array('id'=>$r_dt->item_id) );
							if ( $q_item->num_rows() > 0 ) {
							
								$r_item = $q_item->row();
								// PURCHASE => MENAMBAH STOCK
								$data['stock_val'] = $r_item->stock_val + $r_dt->item_qty;
								$this->db->update( 'item', $data, array('id'=>$r_item->id) );
							}
							
							$this->db->update( 'po_dt', array('recalc'=>1), array('id'=>$r_dt->id) );
						}
					}
				}
			}
		}
			
		$this->db->trans_commit();
		return TRUE;
	}
	
	// ================================ FUNCTION FOR PROPERTY =============================================
	
}