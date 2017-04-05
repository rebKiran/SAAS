<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_Model extends CI_Model {
    #function to get category list from the database

    public function getCategoryDetails() {
        $this->db->select('*');
        $this->db->order_by('category_id', 'DESC');
        $query = $this->db->get(TABLES::$MST_CATEGORIES);
        return $query->result_array();
    }
    
	 public function getCategories() {
		 
		
		 $strSql = 'SELECT 
										c.category_id ,c.category_name, count(p.cat_id) as total			 
     									 
							FROM
										tbl_mst_product_categories c
										Left JOIN tbl_mst_products p ON ( p.cat_id = c.category_id )	
							WHERE
										p.status = 1
							GROUP BY
										c.category_id
							ORDER BY
										c.category_id asc
							LIMIT       0, 5
				';
		$arrData	=		$this->db->query( $strSql );
				
		return $arrData->result_array();
        
    }
	
	public function getBlogCategories() {
		 
		
		 $strSql = "SELECT 
										c.category_id ,c.category_name, count(p.blog_category) as total			 
     									 
							FROM
										tbl_mst_categories c
										Left JOIN tbl_mst_blog_posts p ON ( p.blog_category = c.category_id )	
							WHERE
										p.status = '1'
							GROUP BY
										c.category_id
							ORDER BY
										c.category_id asc
							LIMIT       0, 5			
				";

		$arrData	=		$this->db->query( $strSql );
				
		return $arrData->result_array();
        
    }
	
	public function getPopularPosts() {
		 
		
		 $strSql = "SELECT 
										p.post_id,c.post_title, c.blog_image,c.posted_on,c.slug,count(p.post_id) as total			 
     									 
							FROM
										tbl_mst_blog_posts c
										Left JOIN tbl_trans_blog_comments p ON ( p.post_id = c.post_id )
                                        WHERE p.post_id IS NOT NULL
                                GROUP BY
										p.post_id
                                        
                                        ORDER BY
										total desc
								LIMIT       0, 5		
				";
		$arrData	=		$this->db->query( $strSql );
				
		return $arrData->result_array();
        
    }
	
    public function getCategoryDetailById($category_id) {
        $this->db->select('*');
        $this->db->where('category_id', $category_id);
        $query = $this->db->get(TABLES::$MST_CATEGORIES);
        return $query->result_array();
    }
	
	public function getPaperCategoryDetailById($category_id) {
        $this->db->select('*');
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('tbl_mst_product_categories');
        return $query->result_array();
    }

	public function getProjectCategoryDetailById($category_id) {
        $this->db->select('*');
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('tbl_mst_project_categories');
        return $query->result_array();
    }

     /* Function To save data in category table. */
    function addCategory($data) {
        $this->db->insert(TABLES::$MST_CATEGORIES, $data);
    }

     /* Function To update data in category table. */
    function updateCategoryDetails($data, $condition) {
        $this->db->where($condition);
        $this->db->update(TABLES::$MST_CATEGORIES, $data);
        echo $this->db->last_query();
    }
    
    
    
    /* Function for subcategory detaisl*/
    public function getSubCategoryDetails() {
        
        $this->db->select('cat.category_name,tc.sub_category_name,tc.sub_category_id');
        $this->db->from(TABLES::$TRANS_SUB_CATEGORIES .' as tc');
        $this->db->join(TABLES::$MST_CATEGORIES .' as cat', 'tc.category_id=cat.category_id', 'left');
        $this->db->group_by('tc.sub_category_id');
        $result = $this->db->get();
        return $result->result_array();
    }
    
    public function getSubCategoryDetailById($category_id) {
        $this->db->select('*');
        $this->db->where('sub_category_id', $category_id);
        $query = $this->db->get(TABLES::$TRANS_SUB_CATEGORIES);
        return $query->result_array();
    }

     /* Function To save data in category table. */
    function addSubCategory($data) {
        $this->db->insert(TABLES::$TRANS_SUB_CATEGORIES, $data);
    }

     /* Function To update data in category table. */
    function updateSubCategoryDetails($data, $condition) {
        $this->db->where($condition);
        $this->db->update(TABLES::$TRANS_SUB_CATEGORIES, $data);
        echo $this->db->last_query();
    }

}

?>