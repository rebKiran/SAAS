<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Dashboard extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->model("common_model");
        $this->session = $this->session->userdata('user_account');
        if ($this->session['role_id'] == '1') {
            $this->sidebar = 'partials/admin_sidebar';
        } else {
            $this->sidebar = 'partials/user_sidebar';
        }
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url());
        }
    }

    public function admin() {
        $this->template->set('page', 'dashboard');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sass Consultant | Admin Dashboard')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/dashboard');
    }

    public function user() {
        $this->template->set('page', 'dashboard');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Admin Dashboard | Sass Consultant')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('dashboard');
    }

}
