<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Register extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->model("common_model");
    }

    public function admin()
    {
        
    }

    public function employee()
    {
        $this->load->helper('utility_helper');
        $this->load->model('common_model');
        $this->load->helper(array(
            'form',
            'url'
        ));
        $errors = array();
        $this->load->library('form_validation');
        $errorMsg = array();
        $err_num = 0;

        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[tbl_users.username]');
        $this->form_validation->set_message('is_unique', 'The %s is already registered. Please try with different usernmae');
        $this->form_validation->set_rules('password', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tbl_users.email]');
        $this->form_validation->set_message('is_unique', 'The %s is already registered. Please try with different %s');

        if ($this->form_validation->run() == FALSE) {
            $msg = validation_errors();
            $this->session->set_userdata('msg', $msg);
            redirect("login#signup");
        } else {
            $map = array();
            $user = array();
            $user['username'] = $this->input->post('first_name');
            $user['email'] = $this->input->post('email');
            $user['password'] = md5($this->input->post('password'));
            $user['created_time'] = date('Y-m-d H:i:s');

            $uid = $this->common_model->insertRow($user,TABLES::ADMIN_USERS);
            if ($uid) {
                $msg = "You have registered successfully. Please login";
                $this->session->set_userdata('msg', $msg);
                redirect("login");
            }
        }
    }

}
