<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Coupon extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("product_model");
        $this->load->library('cart');
//        $this->load->library('form_validation');
    }

    /* Frontend : Manage Blog Start */

    public function couponList()
    {
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        #START Action :: Fetch all active Blog added by admin :   
        $data['arr_coupon_data'] = $this->common_model->getRecords(TABLES::$MST_COUPON, '*');
//        print_r($data['arr_product_data']);


        $this->template->set('page', 'couponlist');
        $this->template->set('arr_coupon_data', $data['arr_coupon_data']);
        $this->template->set('user_session', $data['user_session']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Razorclean | Blogs')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/coupon/coupon_list');
    }

    /* Function to add blog post end */

    public function addCoupon()
    {

        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error_msg', "Please sign in to post your blog.");
            redirect('login');
        }
        $data = $this->common_model->commonFunction();
        if (count($_POST) > '0') {
            $arr_post_data = array(
                "coupon_code" => $this->input->post('coupon_code'),
                "coupon_desc" => $_POST['coupon_desc'],
                "valid_from" => $_POST['valid_from'],
                "valid_to" => $_POST['valid_to'],
                "discount_type" => $_POST['discount_type'],
                "discount_rate" => $_POST['discount_rate']
            );
            $this->common_model->insertRow($arr_post_data, TABLES::$MST_COUPON);
            $this->session->set_userdata('success_msg', "Coupon added successfully");
            redirect(base_url() . 'admin/coupon-list');
        }
        $this->template->set('page', 'add_coupon');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Razorclean | Add Coupon')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/coupon/add_coupon');
    }

    /* Function to add blog post end */

    public function editCoupon($edit_id)
    {

        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error_msg', "Please sign in to post your blog.");
            redirect('login');
        }

        $variant_data = $this->common_model->getRecords(TABLES::$MST_COUPON, '*', array('variant_id' => $edit_id));
        $data = $this->common_model->commonFunction();
        if (count($_POST) > '0') {


            $arr_post_data = array(
                "variant_key" => $this->input->post('variant_key'),
                "variant_value" => serialize($_POST['variant_value']),
            );
            $this->common_model->updateRow(TABLES::$MST_COUPON, $arr_post_data, array('variant_id' => $edit_id));
            $this->session->set_userdata('success_msg', "Your product has been updated successfully, Please wait for the admin approval.");
            redirect(base_url() . 'admin/variant-list');
        }

        $this->template->set('variant_data', $variant_data);
        $this->template->set('edit_id', $edit_id);
        $this->template->set('page', 'edit_coupon');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Razorclean | Edit Coupon')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/coupon/edit_coupon');
    }

    public function validateCoupon()
    {
        $cart_total = $this->cart->total();
        $coupon = $this->common_model->getRecords(TABLES::$MST_COUPON, '*', array('coupon_code' => $this->input->post('code'), 'status' => '1'));
        if (count($coupon) < 1) {
            $map['status'] = '0';
            $map['msg'] = 'Not valid coupon!';
            echo json_encode($map);
            exit();
        }
        $today = date('Y-m-d');
        $today = date('Y-m-d', strtotime($today));

        //echo $paymentDate; // echos today! 
        $valid_from = date('Y-m-d', strtotime($coupon[0]['valid_from']));
        $valid_to = date('Y-m-d', strtotime($coupon[0]['valid_to']));

        if (($today >= $valid_from) && ($today <= $valid_to)) {
            if ($coupon[0]['discount_type'] == '1') {
                $discount_amount = $cart_total - $coupon[0]['discount_rate'];
            } else {
                
            }
            $map['status'] = '1';
            $map['discounted_amount'] = $discount_amount;
            $map['msg'] = 'Success.';
            echo json_encode($map);
            exit();
        } else {
            $map['status'] = '0';
            $map['msg'] = 'This coupon is expired';
            echo json_encode($map);
            exit();
        }
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
