<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Publications extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->global_setting = $this->common_model->getGlobalSettings();
		  
    }

	/*
     * Load view for Research page
     */
	public function researchPage( $pg = '', $cat = '', $page=''	) { 

		$this->load->model("product_model");
		$this->load->model("Category_model");
		$this->load->model("Common_Model");
		
		$search = (isset($_POST['search_paper']) && !empty(trim($_POST['search_paper']))) ? trim(stripslashes($_POST['search_paper'])) : '';
		
		$products = $this->product_model->getAllProducts( $pg, $cat, $search );
		
		$paper_categories = array();
		if(!empty($cat) && 'cat' == $pg ) {
			$paper_categories = $this->Category_model->getPaperCategoryDetailById( $cat );
			if( !empty($paper_categories)) {
				$paper_categories = $paper_categories[0];
			}
			//print_r( $paper_categories );die;
		}
		
		$categories = $this->Category_model->getCategories();
		$blogs = $this->Common_Model->getRecords( 'tbl_mst_products' ,'', array('status'=> 1), 'product_id desc ', 5 );
		
		$popular_posts = $this->Common_Model->getRecords( 'tbl_mst_products' ,'', array('is_featured'=>'1'), 'product_id desc ', 5 );
		$totalrows = count($products);
        #Start:: pagination 
        #load pagination library                            
        $this->load->library('pagination');
		if(!empty($cat)){
			$config['base_url'] = base_url() . "research-page/cat/" . $cat;
		} else {
			$config['base_url'] = base_url() . "research-page";
		}
        
        $config['total_rows'] = $totalrows;
        $config['per_page'] = 5;
        $config['prev_link'] = "<span>«</span>";
        $config['next_link'] = "<span>»</span>";
		
		if(!empty($cat) && 'cat' == $pg ){ 
			 $config['cur_page'] = $page;
		} else {
			 $config['cur_page'] = $pg;
		}
       
        $config['num_links'] = 6;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="c-active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
		
		
		if(!empty($cat) && 'cat' == $pg ){ 
			if ($page == "") {
				$pg1 = "";
			} else {
				$pg1 = $page;
			}
		} else {		
			if ($pg == "") {
				$pg1 = "";
			} else {
				$pg1 = $pg;
			}
		}	
		
		if(!empty($cat)){
			$from = intval(($pg1));
		} else {	
			$from = intval(($pg1));
		}	
		
        if ($config['per_page'] == 1) {
            $lenth = 1;
        } else {
            $lenth = intval($config['per_page']);
        }
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
		
        if ($products != '') {
            $products = array_slice($products, $from, $lenth);
        }
		
        $this->template->set('page', 'researchPage');
		$this->template->set('data', $products);
		$this->template->set('categories', $categories);
		$this->template->set('pg_link', $data['pg_link']);
		$this->template->set('blogs', $blogs);
		$this->template->set('popular_posts', $popular_posts);
		$this->template->set('search', $search);
		$this->template->set('paper_categories', $paper_categories);
		
        $this->template->set_theme('default_theme');
		$this->template->set_layout('frontend')
                ->title('Research Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('researchPage');
    }
	
	

}
