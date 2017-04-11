<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("Order_model");
		$data['user_session'] = $this->session->userdata('user_account');
		
		if ($data['user_session']['role_id'] == '1') {
            $this->sidebar = 'partials/admin_sidebar';
        } else {
            $this->sidebar = 'partials/user_sidebar';
        }
		
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url());
        }
//        $this->load->library('form_validation');
    }

    /* Frontend : Manage Blog Start */

    public function orderList() {
        $data['global'] = $this->common_model->getGlobalSettings();
		
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
		
        #START Action :: Fetch all active Blog added by admin :   
        $data['arr_product_data'] = $this->Order_model->getAllOrders($data['user_session']['user_id']);

        $this->template->set('page', 'orderlist');
		$this->template->set('global', $data['global']);
        $this->template->set('arr_product_data', $data['arr_product_data']);
        $this->template->set('user_session', $data['user_session']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sass Consultant | Blogs')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('user/order/order_list');
    }

	 public function orderDetails($post_id)
     {  
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error_msg', "Please sign in to post your blog.");
            redirect('product-list');
        }
		
        $data = $this->common_model->commonFunction();
		
		$arrOrderData = $this->Order_model->getOrderDetails($post_id);
		$order = $this->Order_model->getOrderById($post_id);
		
		/* $this->common_model->insertRow($arr_post_data, TABLES::$MST_PRODUCTS); */
		$this->template->set('global', $data['global']);
		$this->template->set('post_info', $arrOrderData);
		$this->template->set('order', $order);
     
		$this->template->set('page', 'orderdetails');
		$this->template->set_theme('default_theme');
		$this->template->set_layout('backend')
				->title('Sass Consultant | Search paper')
				->set_partial('header', 'partials/header')
				->set_partial('sidebar', $this->sidebar)
				->set_partial('footer', 'partials/footer');
		$this->template->build('user/order/order_details');
		
	}

    /* Function to add blog post end */

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
