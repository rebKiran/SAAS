<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Project extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->model("common_model");
        $this->load->model("Project_Model");
    }

    public function productPage()
    {
//$this->load->model("product_model");
//$this->load->model("Category_model");
//$products = $this->product_model->getProductDetails( $productId );
//$categories = $this->Category_model->getCategories();

        $this->template->set('page', 'productPage');
//$this->template->set('data', $products);
//$this->template->set('categories', $categories);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Project Detail | Sass')
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('projectDetail');
    }

    public function projectDetail($project_id)
    {

        $data = $this->Project_Model->getProjectDetails($project_id);
        //print_r($data);
        $offers = $this->Project_Model->getProjectOffers($project_id);
        $project_details = $this->Project_Model->getProjectFund($project_id);

        $this->template->set('page', 'productPage');
        $this->template->set('project', $data);
        $this->template->set('project_details', $project_details);
        $this->template->set('offers', $offers);

        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Project Detail | Sass')
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('projects/projectDetail');
    }

    public function backProject($project_id)
    {

        $offers = $this->Project_Model->getProjectOffers($project_id);
        $data = $this->Project_Model->getProjectDetails($project_id);

        /* echo '<pre/>';
          print_r( $data );die; */
        $this->template->set('offers', $offers);
        $this->template->set('project_id', $project_id);
        $this->template->set('data', $data);
        $this->template->set('page', 'productPage');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Back Project | Sass')
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('projects/backProject');
    }

    public function connectToProject()
    {
        $session_data = $this->session->userdata('user_account');

        $project_owner = $this->common_model->getRecords('tbl_mst_projects as p', 'p.project_title,p.project_id,p.user_id,(select username from tbl_users where id=p.user_id) as username,(select email from tbl_users where id=p.user_id) as project_owner_email', array('project_id' => $this->input->post('id')));
        $data['global'] = $this->common_model->getGlobalSettings();

        if ($session_data['user_id'] == $project_owner[0]['user_id']) {
            $map['status'] = '0';
            $map['msg'] = 'You can not connect to you own project';
            echo json_encode($map);
            exit();
        }

        $reserved_words = array(
            "||FULL_NAME||" => $project_owner[0]['username'],
            "||CONNECTED_USER_NAME||" => $session_data['username'],
            "||PROJECT_NAME||" => $project_owner[0]['project_title'],
            "||SITE_TITLE||" => $data['global']['site_title']
        );

        $email_content = $this->common_model->getEmailTemplateInfo('user-connect-to-project', $reserved_words);

        /* sending admin user mail for forgot password */

        /* 1.recipient array. 2.From array containing email and name, 3.Mail subject 4.Mail Body */

        $mail = $this->common_model->sendEmail($project_owner[0]['project_owner_email'], array("email" => $data['global']['site_email'], "name" => $data['global']['site_title']), $email_content['subject'], $email_content['content']);
        $this->common_model->insertRow(array('user_id' => $session_data['user_id'], 'project_id' => $project_owner[0]['project_id'], 'created_time' => date("Y-m-d H:i:s")), 'tbl_user_project_connection_mapping');
        if ($mail) {
            $map['status'] = '1';
            $map['msg'] = 'Success.';
            echo json_encode($map);
            exit();
        } else {
            $map['status'] = '0';
            $map['msg'] = 'Failed';
            echo json_encode($map);
            exit();
        }
    }

}
