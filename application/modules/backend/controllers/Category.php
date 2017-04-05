<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        $this->global_setting = $this->common_model->getGlobalSettings();
		
		$data['user_session'] = $this->session->userdata('user_account');
		
		if ($data['user_session']['role_id'] == '1') {
            $this->sidebar = 'partials/admin_sidebar';
        } else {
            $this->sidebar = 'partials/user_sidebar';
        }
		
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url());
        }
    }

    /*  Function For Admin Login Backend Start */

    public function list1() {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "admin/login");
        }
        if (count($this->input->post()) > 0) {
          
               
                $arr_category_ids = $this->input->post('checkbox');
                if (count($arr_category_ids) > 0) {
                    
                    $this->common_model->deleteRows($arr_category_ids, TABLES::$MST_CATEGORIES, "category_id");
                }
                $this->session->set_userdata('msg', 'Category has deleted successfully.');
                redirect(base_url() . "admin/category-list");
           
        }
        $data['cat_data'] = $this->category_model->getCategoryDetails();
        $data['arr_active_admin_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '', array('id' => '1'));        
        $this->template->set('page','category_list');
        $this->template->set('cat_data',$data['cat_data']);
        $this->template->set('arr_active_admin_details',$data['arr_active_admin_details']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                 ->title('Category List | '.$this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/category/category_list');
    }
    

    public function index() {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "admin/login");
        }
        if ($this->input->post()) {
            $cat_data = array(
                "category_name" => $this->input->post('cat_name'),
                "category_title" => $this->input->post('cat_title'),
                "category_metakeywords" => $this->input->post('cat_meta'),
                "category_metadesc" => $this->input->post('cat_desc')
            );
            $this->category_model->addCategory($cat_data);
            $this->session->set_userdata('msg', 'Category has added successfully.');
            redirect(base_url() . "admin/category-list");
        }
        $data['arr_active_admin_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '', array('id' => '1'));
       
        
        
        $this->template->set('page','add_category');
        $this->template->set('arr_active_admin_details',$data['arr_active_admin_details']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                 ->title('Category List | '.$this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/category/category_add');
    }

    public function editCategory($category_id) {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "admin/login");
        }

        #Getting Common data
        $data = $this->common_model->commonFunction();
        $this->load->model('category_model');
        $arr_newsletter_data = array();
        $arr_category_data = $this->category_model->getCategoryDetailById($category_id);
        if ($this->input->post()) {
            $category_details = array("category_name" => $this->input->post('cat_name'),
                "category_title" => $this->input->post('cat_title'),
                "category_metakeywords" => $this->input->post('cat_meta'),
                "category_metadesc" => $this->input->post('cat_desc'));
            $condition = array('category_id' => $category_id);
            $this->category_model->updateCategoryDetails($category_details, $condition);
            $this->session->set_userdata('msg', 'Category has updated successfully.');
            redirect(base_url() . "admin/category-list");
        }
        $data['arr_active_admin_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '', array('id' => '1'));

        
        $data['arr_category_data'] = $arr_category_data[0];      
        
        
        $this->template->set('page','edit_category');
        $this->template->set('edit_id',$category_id);
        $this->template->set('arr_active_admin_details',$data['arr_active_admin_details']);
        $this->template->set('arr_category_data',$data['arr_category_data']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                 ->title('Edit category | '.$this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/category/category_edit');
    }
    
    
    /* Code for subcategory details*/
    
    public function sub_category() { 
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        if ($this->input->post()) {
            $subcat_data = array(
                "category_id" => $this->input->post('cat_id'),
                "sub_category_name" => $this->input->post('sub_category_name')
            );
            $this->category_model->addSubCategory($subcat_data);
            $this->session->set_userdata('msg', 'Sub Category has added successfully.');
            redirect(base_url() . "backend/subcategory-list");
        }
        $data['title'] = "Add Sub Category";
        $data['category_data'] = $this->category_model->getCategoryDetails();
        $data['arr_active_admin_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '', array('id' => '1'));
        $data['main'] = 'backend/category/subcategory_add';
        $this->load->view('backend/index', $data);
    }
    public function subcat_list() {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        if (count($this->input->post()) > 0) {
            if (isset($_POST['btn_delete_all'])) {
                $arr_category_ids = $this->input->post('checkbox');
                if (count($arr_category_ids) > 0) {
                    $this->common_model->deleteRows($arr_category_ids, TABLES::$TRANS_SUB_CATEGORIES, "sub_category_id");
                }
                $this->session->set_userdata('msg', 'Sub Category has deleted successfully.');
            }
        }
        $data['title'] = "Category List";
        $data['subcat_data'] = $this->category_model->getSubCategoryDetails();
        $data['arr_active_admin_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '', array('id' => '1'));
        $data['main'] = 'backend/category/subcategory_list';
        $this->load->view('backend/index', $data);
    }
    public function editSubCategory($subcategory_id) {
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }

        #Getting Common data
        $data = $this->common_model->commonFunction();
        $this->load->model('category_model');
        $arr_newsletter_data = array();
        $arr_subcategory_data = $this->category_model->getSubCategoryDetailById($subcategory_id);
        if ($this->input->post()) {
            $subcategory_details = array("category_id" => $this->input->post('cat_id'),
                                         "sub_category_name" => $this->input->post('sub_category_name'));
            $condition = array('sub_category_id' => $subcategory_id);
            $this->category_model->updateSubCategoryDetails($subcategory_details, $condition);
            $this->session->set_userdata('msg', 'Sub Category has updated successfully.');
            redirect(base_url() . "backend/subcategory-list");
        }
        $data['arr_active_admin_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '', array('id' => '1'));
        $data['edit_id'] = $subcategory_id;
        $data['title'] = "Edit Sub Category";
        $data['category_data'] = $this->category_model->getCategoryDetails();
        $data['arr_subcategory_data'] = $arr_subcategory_data[0];
        $data['main'] = 'backend/category/subcategory_edit';
        $this->load->view('backend/index', $data);
    }

}
