<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Download_data extends MX_Controller
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

    public function index()
    {
        $this->template->set('page', 'download_data');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Download Data | Silo')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('download_data');
    }

    
}
