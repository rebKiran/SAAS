<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogs extends CI_Controller {

    function __construct() { 
        parent::__construct();
        $this->global_setting = $this->common_model->getGlobalSettings();
		  $this->load->model("Blog_Model");
    }

	/*
     * Load view for Research page
     */
	public function blogsPage($pg = '', $cat = '', $page='' ) {  
		
		
		$this->load->model("Category_model");
		$this->load->model("Common_Model");
		
		$search = (isset($_POST['search_blog']) && !empty(trim($_POST['search_blog']))) ? trim(stripslashes($_POST['search_blog'])) : '';
		//$products = $this->product_model->getAllProducts();
		//$categories = $this->Category_model->getCategories();
		$blogs = $this->Blog_Model->getActiveBlog( $pg, $cat , $search );
		
		$categories = $this->Category_model->getBlogCategories();

		$blog_posts = $this->Common_Model->getRecords( 'tbl_mst_blog_posts' ,'', array('status'=> '1'), 'post_id desc ', 5 );
		
		$popular_posts = $this->Category_model->getPopularPosts();	
		
		$totalrows = count($blogs);
        #Start:: pagination 
        #load pagination library                            
        $this->load->library('pagination');
		
		if(!empty($cat)){
			$config['base_url'] = base_url() . "blog/cat/" . $cat;
		} else {
			$config['base_url'] = base_url() . "blog";
		}
		       
        $config['total_rows'] = $totalrows;
        $config['per_page'] = 5;
        $config['prev_link'] = "<span>«</span>";
        $config['next_link'] = "<span>»</span>";
		
		if(!empty($cat) && 'cat' == $pg ){ 
			 $config['cur_page'] = $page - 1;
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
			if ($pg === "") {
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
		
		//echo ' from : ' .$from . ' lenth :- ' . $lenth;die;
        if ($blogs != '') {
            $blogs = array_slice($blogs, $from, $lenth);
        }
		
		/*echo '<pre/>';
		 print_r( $blogs ); die; */
        $this->template->set('page', 'blog');
		$this->template->set('blogs', $blogs);
		$this->template->set('blog_posts', $blog_posts);
		$this->template->set('popular_posts', $popular_posts);
		
		$this->template->set('categories', $categories);
		$this->template->set('pg_link', $data['pg_link']);
        $this->template->set_theme('default_theme');
		$this->template->set_layout('frontend')
                ->title('Research Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('blog');
    }
}
