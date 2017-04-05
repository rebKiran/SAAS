<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Donation extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
       
        $this->load->model("common_model");
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

    public function projectlist()
    {  
        $this->load->model('Project_Model');
        /*$data['user_session'] = $this->session->userdata('user_account');
		$user_id	= $data['user_session']['user_id'];*/
		$data['user_session'] = $this->session->userdata('user_account');
		$user_id = $data['user_session']['user_id'];
        $data = $this->Project_Model->getProjectsListByFund( $user_id );
		
        $this->template->set('project_list', $data); // data to be sent in front end

        $this->template->set('page', 'project_funding_list');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Funded Projects | sasconsultant')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('donation_list');
    }

	public function details( $id )
    {  
        $this->load->model('Project_Model');
       
		//$data = $this->common_model->commonFunction();
		//$projectDetails = $this->Project_Model->getProjectDetails($id);
		$fundingDetails = $this->Project_Model->getProjectFindingDetails($id);
		
		$data = $this->Project_Model->getProjectDetails($id);
        $offers = $this->Project_Model->getProjectOffers($id);
		$project_details = $this->Project_Model->getProjectFund($id);
		
		/* $this->common_mosdel->insertRow($arr_post_data, TABLES::$MST_PRODUCTS); */
		//$this->template->set('global', $data['global']);
		//$this->template->set('projectDetails', $projectDetails);
		$this->template->set('fundingDetails', $fundingDetails);
		
       $this->template->set('project', $data);
		$this->template->set('project_details', $project_details);
        $this->template->set('offers', $offers);
		
		$this->template->set('page', 'funded_projects');
		$this->template->set_theme('default_theme');
		$this->template->set_layout('backend')
				->title('Sass Consultant | Funded Projects')
				->set_partial('header', 'partials/header')
				->set_partial('sidebar', $this->sidebar)
				->set_partial('footer', 'partials/footer');
		$this->template->build('funding_details');
    }
    /*
     * Load view for my subscribers
     */

   

}
