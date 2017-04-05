<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Subscriber extends MX_Controller
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

    public function subscriberList()
    {
        $this->template->set('page', 'subscriber_list');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Subscriber List | Silo')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('subscriber_list');
    }

    /*
     * Load view for my subscribers
     */

    public function addSubscriber()
    {

        $this->template->set('page', 'add_subscriber');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Add subscriber | Silo')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('add_subscriber');
    }

}
