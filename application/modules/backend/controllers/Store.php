<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Store extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->model("common_model");
        $this->session = $this->session->userdata('user_account');
        if ($this->session['purchase_pack'] == '1') {
            $this->sidebar = 'partials/marketplace_sidebar';
        } else if ($this->session['purchase_pack'] == '2') {
            $this->sidebar = 'partials/hosting_sidebar';
        } else {
            $this->sidebar = 'partials/both_sidebar';
        }
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url());
        }
    }

    public function productList()
    {
        $this->template->set('page', 'product_list');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Product List | Silo')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('product_list');
    }

    /*
     * Load view for my subscribers
     */

    public function pendingOrders()
    {

        $this->template->set('page', 'pending_orders');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Pending Orders | Silo')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('pending_orders');
    }

    /*
     * Load view for order history
     */

    public function revenue()
    {

        $this->template->set('page', 'revenue');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Revenue | Silo')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('revenue');
    }

}
