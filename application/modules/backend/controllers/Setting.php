<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Setting extends MX_Controller
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

    public function setStoreName()
    {
        $this->template->set('page', 'set_store_name');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Set Store Name | Silo')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('set_store_name');
    }

    /*
     * Load view for my subscribers
     */

    public function paymentDetails()
    {

        $this->template->set('page', 'payment_details');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Payment Details | Silo')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('payment_details');
    }
    /*
     * Load view for my subscribers
     */

    public function syncWithCard()
    {

        $this->template->set('page', 'sync_with_card');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sync With Card | Silo')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('sync_with_card');
    }

}
