<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("product_model");
//        $this->load->library('form_validation');
    }

    /* Frontend : Manage Blog Start */

    public function productList() {
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        #START Action :: Fetch all active Blog added by admin :   
        $data['arr_product_data'] = $this->product_model->getAllProducts();
//        print_r($data['arr_product_data']);


        $this->template->set('page', 'productlist');
        $this->template->set('arr_product_data', $data['arr_product_data']);
        $this->template->set('user_session', $data['user_session']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sass Consultant | Blogs')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/product/product_list');
    }

    /* Function to add blog post end */

    public function addProduct() {

        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error_msg', "Please sign in to post your blog.");
            redirect('blog/list');
        }
        $category = $this->common_model->getRecords(TABLES::$MST_PRODUCT_CATEGORIES, '*', array('status' => '1'), $order_by = 'category_name DESC');
        $subcategory = $this->common_model->getRecords(TABLES::$TRANS_PRODUCT_SUB_CATEGORIES, '*', '', $order_by = 'sub_category_name DESC');
        $data = $this->common_model->commonFunction();
        if (count($_POST) > '0') {

            if ($_FILES['paper_file']['name'] != '') {
                $_FILES['paper_file']['name'];
                $_FILES['paper_file']['type'];
                $_FILES['paper_file']['tmp_name'];
                $_FILES['paper_file']['error'];
                $_FILES['paper_file']['size'];
                $config['file_name'] = time() . rand();
                $config['upload_path'] = 'uploads/papers';
                $config['allowed_types'] = 'pdf|doc|docx';
                $config['max_size'] = '9000000';
                $this->load->library('upload');
                $this->upload->initialize($config);
                if ($this->upload->do_upload('paper_file')) {
                    $data1['upload_data'] = $this->upload->data();
                    $upload_result = $this->upload->data();   
                    $img_path = $upload_result['file_name'];
                } else {
                    $error = array('error' => $this->upload->display_errors());
                }

                $data['user_session'] = $this->session->userdata('user_account');
                $config = array(
                    'field' => 'slug',
                    'slug' => 'slug',
                    'table' => TABLES::$MST_PRODUCTS,
                    'id' => 'product_id',
                );
                $this->load->library('slug', $config);
                $slugdata = array(
                    'slug' => $this->input->post('name'),
                );
                $slug = $this->slug->create_uri($slugdata);

                $arr_post_data = array(
                    "name" => $this->input->post('name'),
                    "long_desc" => $this->input->post('long_desc'),
                    "price" => $this->input->post('price'),
                    'cat_id' => $this->input->post('cat_id'),
                    'status' => $this->input->post('status'),
                    'paper_file' => $img_path,
                    'is_featured' => $this->input->post('is_featured'),
                    'slug' => $slug . ".html",
                    'created_by' => $data['user_session']['user_id']
                );
                $this->common_model->insertRow($arr_post_data, TABLES::$MST_PRODUCTS);
            }
            $this->session->set_userdata('success_msg', "Your product has been updated successfully.");
            redirect(base_url() . 'admin/product-list');
        }
        $data['arr_variant_data'] = $this->common_model->getRecords(TABLES::$MST_VARIANTS, '*', array('status' => '1'));
        $this->template->set('arr_variant_data', $data['arr_variant_data']);
        $this->template->set('category', $category);
        $this->template->set('subcategory', $subcategory);
        $this->template->set('page', 'productlist');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sass Consultant | Blogs')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/product/product_add');
    }

    private function upload_files($path, $files) {
        $config = array(
            'upload_path' => $path,
            'allowed_types' => 'jpg|jpeg|gif|png',
            'max_size' => '9000000',
        );

        $this->load->library('upload', $config);

        $images = array();
        $data1 = array();

        foreach ($files['name'] as $key => $image) {
            $_FILES['thumbnail[]']['name'] = $files['name'][$key];
            $_FILES['thumbnail[]']['type'] = $files['type'][$key];
            $_FILES['thumbnail[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['thumbnail[]']['error'] = $files['error'][$key];
            $_FILES['thumbnail[]']['size'] = $files['size'][$key];



            $this->upload->initialize($config);

            if ($this->upload->do_upload('thumbnail[]')) {
                $this->upload->data();
                $data1['upload_data'] = $this->upload->data();
                $fileName = $data1['upload_data'];

                $images[] = $fileName;

                $config['file_name'] = time() . rand();
                //$ar = list($width, $height) = getimagesize($data1['full_path']);
                $upload_result1 = $this->upload->data();
                $image_config1 = array(
                    'source_image' => $upload_result1['full_path'],
                    'new_image' => "uploads/products/thumbnails/135x163",
                    'maintain_ratio' => false,
                    'width' => 135,
                    'height' => 163
                );
                $this->load->library('image_lib');
                $this->image_lib->initialize($image_config1);
                $resize_rc = $this->image_lib->resize();
            } else {
                return false;
            }
        }

        return $images;
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
