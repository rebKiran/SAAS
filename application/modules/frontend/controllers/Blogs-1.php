<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogs extends CI_Controller {

    function __construct() { 
        parent::__construct();
        $this->global_setting = $this->common_model->getGlobalSettings();
		
    }

	/*
     * Load view for Research page
     */
	public function blogsPage() {
		
		//$this->load->model("Blog_Model");
		
		//$products = $this->product_model->getAllProducts();
		//$categories = $this->Category_model->getCategories();
		//$blogs = $this->Blog_Model->getAllActiveBlog();
		
		
		// print_r( $blogs ); die;
        $this->template->set('page', 'blog');
		//$this->template->set('blogs', $blogs);
        $this->template->set_theme('default_theme');
		$this->template->set_layout('frontend')
                ->title('Research Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('blog');
    }
	
	

}
