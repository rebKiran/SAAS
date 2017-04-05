<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProductDetails extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->global_setting = $this->common_model->getGlobalSettings();
		  
    }

	/*
     * Load view for Research page
     */
	public function productPage( $productId ) { 
		$this->load->model("product_model");
		//$this->load->model("Category_model");
		
		$products = $this->product_model->getProductDetails( $productId );
		
		//$categories = $this->Category_model->getCategories();
		 
        $this->template->set('page', 'productPage');
		$this->template->set('data', $products);
		//$this->template->set('categories', $categories);
        $this->template->set_theme('default_theme');
		$this->template->set_layout('frontend')
                ->title('Research Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('productPage');
    }
	
	

}
