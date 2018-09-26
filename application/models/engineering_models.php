<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Engineering_Models extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->driver('cache');
	}
	
    /**
     * 
     * 
     * @param1 <type> 1/0
     * @param2 <type> flange/belt 
     * @param3 <type> $id 
     * 
     * @return <type> true/false
     */
	function rectangular_splicing_kits( $true=NULL, $type=NULL, $id=NULL ) {
	
		if ($true) {
			if ( $type=='flange' ) {
				
				$q = $this->db->get_where( 'ejf_rect_flange', array('id'=>$id) );
				if ( $q->num_rows < 1 )
					return FALSE;
				
				$q2 = $this->db->get_where( 'ejf_rect_flange_splicing', array('rect_flange_id'=>$id) );
				if ( $q2->num_rows > 0 )
					return FALSE;
				
				$r = $q->row();
			
				// GUNTING
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>34) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_rect_flange_splicing', array('rect_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// JARUM
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>33) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_rect_flange_splicing', array('rect_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// KEVLAR YARN
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>32) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 25;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_rect_flange_splicing', array('rect_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// PFA FOIL
				$size_l 		   = ((2*$r->rec_flange)+$r->rec_oal)+0.03;
				$size_w 		   = 0.15;
				$area			   = $size_l * $size_w;
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>7) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $area * $qty * $price;
				$this->db->insert( 'ejf_rect_flange_splicing', array('rect_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>$size_l, 'size_w'=>$size_w, 'area'=>$area, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			}
			
			elseif ( $type=='belt' ) {
				
				$q = $this->db->get_where( 'ejf_rect_belt', array('id'=>$id) );
				if ( $q->num_rows < 1 )
					return FALSE;
				
				$q2 = $this->db->get_where( 'ejf_rect_belt_splicing', array('rect_belt_id'=>$id) );
				if ( $q2->num_rows > 0 )
					return FALSE;
				
				$r = $q->row();
			
				// GUNTING
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>34) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_rect_belt_splicing', array('rect_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// JARUM
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>33) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_rect_belt_splicing', array('rect_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// KEVLAR YARN
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>32) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 25;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_rect_belt_splicing', array('rect_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// PFA FOIL
				$size_l 		   = ((2*$r->rec_flange)+$r->rec_oal)+0.03;
				$size_w 		   = 0.15;
				$area			   = $size_l * $size_w;
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>7) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $area * $qty * $price;
				$this->db->insert( 'ejf_rect_belt_splicing', array('rect_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>$size_l, 'size_w'=>$size_w, 'area'=>$area, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			}
		} else {
		
			if ( $type=='flange' ) {
				$this->db->delete( 'ejf_rect_flange_splicing', array('rect_flange_id'=>$id) );
			}
			elseif ( $type=='belt' ) {
				$this->db->delete( 'ejf_rect_belt_splicing', array('rect_belt_id'=>$id) );
			}
		}
	}
	
	function rectangular_packaging( $type=NULL, $id=NULL ) {
	
		if ( $type=='flange' ) {
			
			$this->db->delete( 'ejf_rect_flange_packaging', array('rect_flange_id'=>$id) );
			
			$q = $this->db->get_where( 'ejf_rect_flange', array('id'=>$id) );
			if ( $q->num_rows < 1 )
				return FALSE;
			
			$r = $q->row();
			
			// FABRIKASI
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>41) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil($r->pac_area*0.5); // ALWAYS ROUND UP
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_flange_packaging', array('rect_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAKU 10
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>40) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = $r->pac_area*0.25;
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_flange_packaging', array('rect_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAKU 7
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>39) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = $r->pac_area*0.25;
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_flange_packaging', array('rect_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// TRIPLEX 4T
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>38) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil($r->pac_area/2.88);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_flange_packaging', array('rect_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// BALOK 5/10
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>37) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil((($r->pac_length/0.75)*$r->pac_width)/4);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_flange_packaging', array('rect_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// KASO 4/6
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>36) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil(((2*($r->pac_length+$r->pac_width)/0.75)*$r->pac_thick)+(((2*$r->pac_width)/0.75)*$r->pac_length)/4);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_flange_packaging', array('rect_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAPAN 2/20
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>35) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			// $qty 			   = ceil($r->pac_area*0.8/0.6);
			$qty 			   = ceil(number_format($r->pac_area*0.8/0.6,14));
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_flange_packaging', array('rect_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
		}
		elseif ( $type=='belt' ) {
			
			$this->db->delete( 'ejf_rect_belt_packaging', array('rect_belt_id'=>$id) );
			
			$q = $this->db->get_where( 'ejf_rect_belt', array('id'=>$id) );
			if ( $q->num_rows < 1 )
				return FALSE;
			
			$r = $q->row();
			
			// FABRIKASI
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>41) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil($r->pac_area*0.5); // ALWAYS ROUND UP
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_belt_packaging', array('rect_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAKU 10
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>40) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = $r->pac_area*0.25;
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_belt_packaging', array('rect_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAKU 7
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>39) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = $r->pac_area*0.25;
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_belt_packaging', array('rect_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// TRIPLEX 4T
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>38) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil($r->pac_area/2.88);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_belt_packaging', array('rect_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// BALOK 5/10
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>37) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil((($r->pac_length/0.75)*$r->pac_width)/4);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_belt_packaging', array('rect_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// KASO 4/6
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>36) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil(((2*($r->pac_length+$r->pac_width)/0.75)*$r->pac_thick)+(((2*$r->pac_width)/0.75)*$r->pac_length)/4);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_belt_packaging', array('rect_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAPAN 2/20
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>35) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			// $qty 			   = ceil($r->pac_area*0.8/0.6);
			$qty 			   = ceil(number_format($r->pac_area*0.8/0.6,14));
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_rect_belt_packaging', array('rect_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
		}
	}
	
	function circular_splicing_kits( $true=NULL, $type=NULL, $id=NULL ) {
	
		if ($true) {
			if ( $type=='flange' ) {
				
				$q = $this->db->get_where( 'ejf_circ_flange', array('id'=>$id) );
				if ( $q->num_rows < 1 )
					return FALSE;
				
				$q2 = $this->db->get_where( 'ejf_circ_flange_splicing', array('circ_flange_id'=>$id) );
				if ( $q2->num_rows > 0 )
					return FALSE;
				
				$r = $q->row();
			
				// GUNTING
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>34) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_circ_flange_splicing', array('circ_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// JARUM
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>33) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_circ_flange_splicing', array('circ_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// KEVLAR YARN
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>32) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 25;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_circ_flange_splicing', array('circ_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// PFA FOIL
				$size_l 		   = $r->cir_width;
				$size_w 		   = 0.15;
				$area			   = $size_l * $size_w;
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>7) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $area * $qty * $price;
				$this->db->insert( 'ejf_circ_flange_splicing', array('circ_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>$size_l, 'size_w'=>$size_w, 'area'=>$area, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			} 
			
			elseif ( $type=='belt' ) {
				
				$q = $this->db->get_where( 'ejf_circ_belt', array('id'=>$id) );
				if ( $q->num_rows < 1 )
					return FALSE;
				
				$q2 = $this->db->get_where( 'ejf_circ_belt_splicing', array('circ_belt_id'=>$id) );
				if ( $q2->num_rows > 0 )
					return FALSE;
				
				$r = $q->row();
			
				// GUNTING
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>34) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_circ_belt_splicing', array('circ_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// JARUM
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>33) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_circ_belt_splicing', array('circ_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// KEVLAR YARN
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>32) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 25;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $qty * $price;
				$this->db->insert( 'ejf_circ_belt_splicing', array('circ_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
				// PFA FOIL
				$size_l 		   = $r->cir_width;
				$size_w 		   = 0.15;
				$area			   = $size_l * $size_w;
				$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>7) )->row();
				$material_id 	   = $mat->id;
				$material_class_id = NULL;
				$qty 			   = 1;
				$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
				$t_price 		   = $area * $qty * $price;
				$this->db->insert( 'ejf_circ_belt_splicing', array('circ_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>$size_l, 'size_w'=>$size_w, 'area'=>$area, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			}
			
		} else {
		
			if ( $type=='flange' ) {
				$this->db->delete( 'ejf_circ_flange_splicing', array('circ_flange_id'=>$id) );
			}
			
			elseif ( $type=='belt' ) {
				$this->db->delete( 'ejf_circ_belt_splicing', array('circ_belt_id'=>$id) );
			}
		}
	}
	
	function circular_packaging( $type=NULL, $id=NULL ) {
	
		if ( $type=='flange' ) {
			
			$this->db->delete( 'ejf_circ_flange_packaging', array('circ_flange_id'=>$id) );
			
			$q = $this->db->get_where( 'ejf_circ_flange', array('id'=>$id) );
			if ( $q->num_rows < 1 )
				return FALSE;
			
			$r = $q->row();
			
			// FABRIKASI
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>41) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil($r->pac_area*0.5); // ALWAYS ROUND UP
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_flange_packaging', array('circ_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAKU 10
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>40) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = $r->pac_area*0.25;
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_flange_packaging', array('circ_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAKU 7
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>39) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = $r->pac_area*0.25;
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_flange_packaging', array('circ_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// TRIPLEX 4T
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>38) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil($r->pac_area/2.88);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_flange_packaging', array('circ_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// BALOK 5/10
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>37) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil((($r->pac_length/0.75)*$r->pac_width)/4);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_flange_packaging', array('circ_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// KASO 4/6
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>36) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil(((2*($r->pac_length+$r->pac_width)/0.75)*$r->pac_thick)+(((2*$r->pac_width)/0.75)*$r->pac_length)/4);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_flange_packaging', array('circ_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAPAN 2/20
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>35) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			// $qty 			   = ceil($r->pac_area*0.8/0.6);
			$qty 			   = ceil(number_format($r->pac_area*0.8/0.6,14));
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_flange_packaging', array('circ_flange_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
		}
		elseif ( $type=='belt' ) {
			
			$this->db->delete( 'ejf_circ_belt_packaging', array('circ_belt_id'=>$id) );
			
			$q = $this->db->get_where( 'ejf_circ_belt', array('id'=>$id) );
			if ( $q->num_rows < 1 )
				return FALSE;
			
			$r = $q->row();
			
			// FABRIKASI
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>41) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil($r->pac_area*0.5); // ALWAYS ROUND UP
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_belt_packaging', array('circ_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAKU 10
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>40) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = $r->pac_area*0.25;
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_belt_packaging', array('circ_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAKU 7
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>39) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = $r->pac_area*0.25;
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_belt_packaging', array('circ_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// TRIPLEX 4T
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>38) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil($r->pac_area/2.88);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_belt_packaging', array('circ_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// BALOK 5/10
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>37) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil((($r->pac_length/0.75)*$r->pac_width)/4);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_belt_packaging', array('circ_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// KASO 4/6
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>36) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			$qty 			   = ceil(((2*($r->pac_length+$r->pac_width)/0.75)*$r->pac_thick)+(((2*$r->pac_width)/0.75)*$r->pac_length)/4);
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_belt_packaging', array('circ_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
			// PAPAN 2/20
			$mat 			   = $this->db->get_where( 'ejf_material', array('id'=>35) )->row();
			$material_id 	   = $mat->id;
			$material_class_id = NULL;
			// $qty 			   = ceil($r->pac_area*0.8/0.6);
			$qty 			   = ceil(number_format($r->pac_area*0.8/0.6,14));
			$price 			   = empty($mat->price_usd) ? 0 : $mat->price_usd;
			$t_price 		   = $qty * $price;
			$this->db->insert( 'ejf_circ_belt_packaging', array('circ_belt_id'=>$id, 'material_class_id'=>$material_class_id, 'material_id'=>$material_id, 'size_l'=>0, 'size_w'=>0, 'area'=>0, 'qty'=>$qty, 'measure_id'=>$mat->measure_id, 'price'=>$price, 'total_price'=>$t_price) ); 
		}
	}
	
}