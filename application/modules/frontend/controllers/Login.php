<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Login extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->model("common_model");
        $this->load->library('form_validation');
    }

    public function frontLogin() {
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required');
        $response = array();
        if ($this->form_validation->run() == FALSE) {
            $response['msg'] = validation_errors();
            $response['status'] = '0';
            echo json_encode($response);
            exit();
        }
        $user_name = trim($this->input->post('user_name'));
        $user_password = $this->input->post('user_password');
        $user_details = $this->common_model->getRecords(TABLES::$ADMIN_USER, '*', array('username' => $user_name, 'role_id' => '2', 'password' => md5($user_password)));
        $map = array();
        if (count($user_details) > 0) {
            if (MD5($user_password) === $user_details[0]['password']) {
                if ($user_details[0]['verified'] == 1) {
                    $user = array();
                    $user['username'] = $user_details[0]['username'];
                    $user['email'] = $user_details[0]['email'];
                    $user['user_id'] = $user_details[0]['id'];
                    $user['role_id'] = $user_details[0]['role_id'];
                    $this->session->set_userdata('user_account', $user);
                    $msg = "Login success...";
                    $status = "1";
                } else {
                    $msg = "Login to this site have been blocked by Admin.";
                    $status = "0";
                }
            } else {
                $msg = "Email or password is wrong.";
                $status = "0";
            }
        } else {
            $msg = "Email or password is wrong.";
            $status = "0";
        }
        $response['msg'] = $msg;
        $response['status'] = $status;
        echo json_encode($response);
        exit();
    }

    /**
     * Code For Logout Functionality
     */
    public function logout() {
        $session_data = $this->session->userdata('user_account');
        if ($session_data['role_id'] == '1') {
            $this->session->unset_userdata('user_account');
            redirect(base_url() . "backend/login");
        } else {
            $this->session->unset_userdata('user_account');
            redirect(base_url());
        }
    }

    public function checkoutSignup() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('email', 'Password', 'trim|required');
        $response = array();
        if ($this->form_validation->run() == FALSE) {
            $response['msg'] = validation_errors();
            $response['status'] = '0';
            echo json_encode($response);
            exit();
        } else {
            $map = array();
            $user = array();
            $user['username'] = $this->input->post('username');
            $user['email'] = $this->input->post('email');
            $user['password'] = md5($this->input->post('password'));
            $user['role_id'] = '2';
            $user['verified'] = '1';
            $user['user_status'] = '1';
            $user['created_time'] = date("Y-m-d H:i:s");
            $insert = $this->common_model->insertRow($user, TABLES::$ADMIN_USER);
            $userid = $this->db->insert_id();
            if ($insert) :
                $user1 = array();
                $user1['username'] = $user['username'];
                $user1['email'] = $user['email'];
                $user1['user_id'] = $userid;
                $user1['role_id'] = $user['role_id'];
                $this->session->set_userdata('user_account', $user1);
                $response['msg'] = "Registration successfull. Redirecting...";
                $response['status'] = '1';
                echo json_encode($response);
                exit();
            endif;
        }
    }

    public function checkoutLogin() {
        $this->form_validation->set_rules('user_name', 'Username', 'trim|required');
        $this->form_validation->set_rules('user_password', 'Password', 'trim|required');
        $response = array();
        if ($this->form_validation->run() == FALSE) {
            $response['msg'] = validation_errors();
            $response['status'] = '0';
            echo json_encode($response);
            exit();
        }
        $user_name = trim($this->input->post('user_name'));
        $user_password = $this->input->post('user_password');
        $user_details = $this->common_model->getRecords(TABLES::$ADMIN_USER, '*', array('username' => $user_name, 'role_id' => '2', 'password' => md5($user_password)));
        $map = array();
        if (count($user_details) > 0) {
            if (MD5($user_password) === $user_details[0]['password']) {
                if ($user_details[0]['verified'] == 1) {
                    $user = array();
                    $user['username'] = $user_details[0]['username'];
                    $user['email'] = $user_details[0]['email'];
                    $user['user_id'] = $user_details[0]['id'];
                    $user['role_id'] = $user_details[0]['role_id'];
                    $this->session->set_userdata('user_account', $user);
                    $msg = "Login success...";
                    $status = "1";
                } else {
                    $msg = "Login to this site have been blocked by Admin.";
                    $status = "0";
                }
            } else {
                $msg = "Email or password is wrong.";
                $status = "0";
            }
        } else {
            $msg = "Email or password is wrong.";
            $status = "0";
        }
        $response['msg'] = $msg;
        $response['status'] = $status;
        echo json_encode($response);
        exit();
    }

}
