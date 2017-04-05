<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->global_setting = $this->common_model->getGlobalSettings();
    }

    /*
     * Load view for homepage
     */

    public function home() {
        $this->template->set('page', 'home');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Home | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('homepage');
    }
	
	/*
     * Load view for About us
     */
	public function aboutUs() {
        $this->template->set('page', 'aboutUs');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('About Us | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('aboutUs');
    }
	
	/*
     * Load view for Contact us
     */
	public function contactUs() {
        $this->template->set('page', 'contactUs');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Contact us | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('contactUs');
    }
	
	
	/*
     * Load view for Blog
     */
	public function blog() {
        $this->template->set('page', 'blog');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Blogs | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('blog');
    }
	
	/*
     * Load view for Research page
     */
	public function researchPage() {
        $this->template->set('page', 'researchPage');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Research Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('researchPage');
    }
	
	/*
     * Load view for Management Consulting page
     */
	public function managementPage() {
        $this->template->set('page', 'managementPage');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Management Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('managementPage');
    }
	
	public function managementExpertisePage() {
        $this->template->set('page', 'management-expertise');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Our Expertise | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('management-expertise');
    }
	
	public function managementindustry() {
        $this->template->set('page', 'management-industry');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Industry Focus | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('management-industry');
    }
	
	/*
     * Load view for Management Consulting page
     */
	public function engineeringPage() {
        $this->template->set('page', 'engineeringPage');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Engineering Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('engineeringPage');
    }
	
	public function engineeringSucess() {
        $this->template->set('page', 'engineering-sucess-story');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Success Stories | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('engineering-sucess-story');
    }

	public function engineeringExpertise() {
        $this->template->set('page', 'engineering-expertise');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Our Expertise | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('engineering-expertise');
    }
	
	public function engineeringindustry() {
        $this->template->set('page', 'engineering-industry');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Industry Focus | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('engineering-industry');
    }
	
	/*
     * Load view for Contact us
     */
	public function fundraiser(  $pg = '', $cat = '', $page='' ) {
		
		$this->load->model("Common_Model");
		$this->load->model("Project_Model");
		$this->load->model("Category_model");
		
		/*$projects = $this->Common_Model->getRecords( 'tbl_mst_projects
' , array('project_id','project_title', 'short_description','cover_image'), '', 'project_id desc', '' );*/

		$categories = $this->Common_Model->getRecords( 'tbl_mst_project_categories
' , array('category_id','category_name', 'image'), array('status'=>'1'), 'category_id asc', '' );
		
		$project_categories = array();
		if(!empty($cat) && 'cat' == $pg ) {
			$project_categories = $this->Category_model->getProjectCategoryDetailById( $cat );
			if( !empty($project_categories)) {
				$project_categories = $project_categories[0];
			}
			
		}

		$search = "";
		$projects = $this->Project_Model->getAllProjects( $pg, $cat, $search  );
		$totalrows = count($projects);
	    $this->load->library('pagination');
		if(!empty($cat)){
			$config['base_url'] = base_url() . "fundraiser/cat/" . $cat;
		} else {
			$config['base_url'] = base_url() . "fundraiser";
		}
        
        $config['total_rows'] = $totalrows;
        $config['per_page'] = 8;
        $config['prev_link'] = "<span>«</span>";
        $config['next_link'] = "<span>»</span>";
		
		if(!empty($cat) && 'cat' == $pg ){ 
			 $config['cur_page'] = $page;
		} else {
			 $config['cur_page'] = $pg;
		}
       
        $config['num_links'] = 6;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="c-active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
		
		
		if(!empty($cat) && 'cat' == $pg ){ 
			if ($page == "") {
				$pg1 = "";
			} else {
				$pg1 = $page;
			}
		} else {		
			if ($pg == "") {
				$pg1 = "";
			} else {
				$pg1 = $pg;
			}
		}	
		
		if(!empty($cat)){
			$from = intval(($pg1));
		} else {	
			$from = intval(($pg1));
		}	
		
        if ($config['per_page'] == 1) {
            $lenth = 1;
        } else {
            $lenth = intval($config['per_page']);
        }
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
		
        if ($projects != '') {
            $projects = array_slice($projects, $from, $lenth);
        }
		
		$this->template->set('projects', $projects);
		$this->template->set('project_categories', $project_categories);
		
		$this->template->set('categories', $categories);
        $this->template->set('page', 'fundraiser');
		$this->template->set('pg_link', $data['pg_link']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Fundraiser | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('fundraiser');
    }
	
	public function loadprojects( $pg = '', $cat = '', $page=''	) { 

		$this->load->model("Project_model");
		
		$search = "";
		$projects = $this->Project_model->getAllProjects( $pg, $cat, $search  );

	    $this->load->library('pagination');
		if(!empty($cat)){
			$config['base_url'] = base_url() . "fundraiser/cat/" . $cat;
		} else {
			$config['base_url'] = base_url() . "fundraiser";
		}
        
        $config['total_rows'] = $totalrows;
        $config['per_page'] = 5;
        $config['prev_link'] = "<span>«</span>";
        $config['next_link'] = "<span>»</span>";
		
		if(!empty($cat) && 'cat' == $pg ){ 
			 $config['cur_page'] = $page;
		} else {
			 $config['cur_page'] = $pg;
		}
       
        $config['num_links'] = 6;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="c-active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
		
		
		if(!empty($cat) && 'cat' == $pg ){ 
			if ($page == "") {
				$pg1 = "";
			} else {
				$pg1 = $page;
			}
		} else {		
			if ($pg == "") {
				$pg1 = "";
			} else {
				$pg1 = $pg;
			}
		}	
		
		if(!empty($cat)){
			$from = intval(($pg1));
		} else {	
			$from = intval(($pg1));
		}	
		
        if ($config['per_page'] == 1) {
            $lenth = 1;
        } else {
            $lenth = intval($config['per_page']);
        }
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
		
        if ($products != '') {
            $products = array_slice($products, $from, $lenth);
        }
		
        $this->template->set('page', 'fundraiser');
		$this->template->set('data', $products);
		$this->template->set('categories', $categories);
		$this->template->set('pg_link', $data['pg_link']);
		$this->template->set('blogs', $blogs);
		$this->template->set('popular_posts', $popular_posts);
		$this->template->set('search', $search);
		$this->template->set('paper_categories', $paper_categories);
		
		$this->template->set_theme('default_theme');
		$this->template->set_layout('frontend')
                ->title('Research Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('researchPage');
    }

}
