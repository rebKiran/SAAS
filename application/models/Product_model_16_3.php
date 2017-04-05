<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  Class will do all necessary action for blog functionalities
 */

class Product_Model extends CI_Model
{
    /*
     * START :: Write function which fetches blog to displys on front-end :
     */

    function getAllProducts( $pg, $cat, $search )
    {

        $this->db->select("mbp.*");
		if(!empty($search) ){ 
			$this->db->like('mbp.name',"$search");
		}
        $this->db->from(TABLES::$MST_PRODUCTS . ' as mbp');
        $this->db->order_by('mbp.created_on', 'desc');
		if(!empty($cat) && 'cat' == $pg ){ 
			$this->db->where('mbp.cat_id', $cat);
		}
		
        $query = $this->db->get();
        return $query->result_array();
    }

    function getProductDetails($post_id)
    {
        $this->db->select("mbp.*");
        $this->db->from(TABLES::$MST_PRODUCTS . ' as mbp');
        $this->db->where('mbp.status', '1');
        $this->db->where('mbp.slug', $post_id);

        $query = $this->db->get();
     
        return $query->result_array();
    }

    function getProductCategories()
    {
        $this->db->select("mbp.*");
        $this->db->from(TABLES::$MST_PRODUCT_CATEGORIES . ' as mbp');
        $this->db->where('mbp.status', '1');
        $this->db->order_by('category_id', 'desc');
        $this->db->limit('4');

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function productsBycategory($limit = '', $offset = '', $id)
    {
        $this->db->select("mbp.*");
        $this->db->from(TABLES::$MST_PRODUCTS . ' as mbp');
        $this->db->where('mbp.status', '1');
        $this->db->where('mbp.cat_id', $id);

        if (!$limit == '') {
            $this->db->limit($limit);
        }
        if (!$offset == '') {
            $this->db->offset($offset);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

}
