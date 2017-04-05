<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Variant extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("product_model");
//        $this->load->library('form_validation');
    }

    /* Frontend : Manage Blog Start */

    public function variantList()
    {
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        #START Action :: Fetch all active Blog added by admin :   
        $data['arr_variant_data'] = $this->common_model->getRecords(TABLES::$MST_VARIANTS, '*',array('status'=>'1'));
//        print_r($data['arr_product_data']);


        $this->template->set('page', 'productlist');
        $this->template->set('arr_variant_data', $data['arr_variant_data']);
        $this->template->set('user_session', $data['user_session']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Razorclean | Blogs')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/variant/variant_list');
    }

    /* Function to add blog post end */

    public function addVariant()
    {

        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error_msg', "Please sign in to post your blog.");
            redirect('login');
        }
        $data = $this->common_model->commonFunction();
        if (count($_POST) > '0') {
            $arr_post_data = array(
                "variant_key" => $this->input->post('variant_key'),
                "variant_value" => serialize($_POST['variant_value']),
            );
            $this->common_model->insertRow($arr_post_data, TABLES::$MST_VARIANTS);
            $this->session->set_userdata('success_msg', "Your product has been updated successfully, Please wait for the admin approval.");
            redirect(base_url() . 'admin/variant-list');
        }
        $this->template->set('page', 'productlist');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Razorclean | Blogs')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/variant/add_variant');
    }

    /* Function to add blog post end */

    public function editVariant($edit_id)
    {

        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error_msg', "Please sign in to post your blog.");
            redirect('login');
        }

        $variant_data = $this->common_model->getRecords(TABLES::$MST_VARIANTS, '*', array('variant_id' => $edit_id));
        $data = $this->common_model->commonFunction();
        if (count($_POST) > '0') {


            $arr_post_data = array(
                "variant_key" => $this->input->post('variant_key'),
                "variant_value" => serialize($_POST['variant_value']),
            );
            $this->common_model->updateRow( TABLES::$MST_VARIANTS,$arr_post_data,array('variant_id'=>$edit_id));
            $this->session->set_userdata('success_msg', "Your product has been updated successfully, Please wait for the admin approval.");
            redirect(base_url() . 'admin/variant-list');
        }

        $this->template->set('variant_data', $variant_data);
        $this->template->set('edit_id', $edit_id);
        $this->template->set('page', 'productlist');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Razorclean | Blogs')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/variant/edit_variant');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
