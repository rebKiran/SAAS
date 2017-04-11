<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  Class will do all necessary action for blog functionalities
 */

class Order_Model extends CI_Model
{
    /*
     * START :: Write function which fetches blog to displys on front-end :
     */

    function getAllOrders( $user_id )
    {

        $this->db->select("os.*, sum(od.ord_det_quantity) as purchased, s.name as state, c.name as city");
		
        $this->db->from(TABLES::$ORDER_SUMMARY . ' as os');
		$this->db->join(TABLES::$ORDER_DETAILS . ' as od', 'os.ord_order_number = od.ord_det_order_number_fk');
		$this->db->join('tbl_states as s', 's.id = os.ord_bill_state');
		$this->db->join('tbl_cities as c', 'c.id = os.ord_bill_city');
		 $this->db->where('os.user_id',  $user_id );
        $this->db->order_by('os.ord_date', 'desc');
  	    $this->db->group_by(array("os.ord_order_number"));
        $query = $this->db->get();
		
		
        return $query->result_array();
    }

    function getOrderDetails( $post_id )
    {
        $this->db->select("os.*,s.name as state, c.name as city, od.ord_det_item_fk, od.ord_det_item_name, od.ord_det_quantity, od.ord_det_non_discount_quantity, od.ord_det_discount_quantity, od.ord_det_stock_quantity, od.ord_det_price, od.ord_det_price_total, od.ord_det_discount_price, od.ord_det_discount_price_total, od.ord_det_discount_description");
		
        $this->db->from(TABLES::$ORDER_SUMMARY . ' as os');
		$this->db->join(TABLES::$ORDER_DETAILS . ' as od', 'os.ord_order_number = od.ord_det_order_number_fk');
		$this->db->join('tbl_states as s', 's.id = os.ord_bill_state');
		$this->db->join('tbl_cities as c', 'c.id = os.ord_bill_city');
		$this->db->where('os.ord_order_number',  $post_id );
        $this->db->order_by('os.ord_date', 'desc');
		 
  	   // $this->db->group_by(array("os.ord_order_number"));
        $query = $this->db->get();
		/*echo $this->db->last_query();
		 die;*/
     
        return $query->result_array();
    }

	function getOrderById($post_id)
    {
         $this->db->select("os.*,s.name as state, c.name as city, od.ord_det_item_fk, od.ord_det_item_name, od.ord_det_quantity, od.ord_det_non_discount_quantity, od.ord_det_discount_quantity, od.ord_det_stock_quantity, od.ord_det_price, od.ord_det_price_total, od.ord_det_discount_price, od.ord_det_discount_price_total, od.ord_det_discount_description");
		
        $this->db->from(TABLES::$ORDER_SUMMARY . ' as os');
		$this->db->join(TABLES::$ORDER_DETAILS . ' as od', 'os.ord_order_number = od.ord_det_order_number_fk');
		$this->db->join('tbl_states as s', 's.id = os.ord_bill_state');
		$this->db->join('tbl_cities as c', 'c.id = os.ord_bill_city');
		$this->db->where('os.ord_order_number',  $post_id );
        $this->db->order_by('os.ord_date', 'desc');

        $query = $this->db->get();
     
        return $query->result_array();
    }
    
	function fetchPaperDetailsbyOrders( $user_id ) {
		
		$this->db->select("od.*, p.*, os.ord_date, os.ord_order_number");
		$this->db->from(TABLES::$ORDER_SUMMARY . ' as os');
        $this->db->join(TABLES::$ORDER_DETAILS . ' as od', 'os.ord_order_number = od.ord_det_order_number_fk');
		$this->db->join(TABLES::$MST_PRODUCTS . ' as p', 'od.ord_det_item_fk = p.product_id');
		$this->db->where('os.user_id',  $user_id );
		$this->db->group_by(array("p.product_id", "os.ord_order_number"));
        $this->db->order_by('os.ord_date', 'DESC');

        $query = $this->db->get();
    /* echo $this->db->last_query();
		 die;*/
        return $query->result_array();
	}

}
