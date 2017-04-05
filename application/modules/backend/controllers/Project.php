<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Project extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("Project_Model");
        $data['user_session'] = $this->session->userdata('user_account');
        //echo $this->session->userdata['user_account']['username']; die;

        if ($data['user_session']['role_id'] == '1') {
            $this->sidebar = 'partials/admin_sidebar';
        } else {
            $this->sidebar = 'partials/user_sidebar';
        }

        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url());
        }
    }

    /*
     * Add New Project User
     */

    public function addProject() {
        $category = $this->Project_Model->getProjectCategories();


        $this->template->set('page', 'add_project');
        $this->template->set('category', $category);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Add Project | Sass')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('user/project/add_project');
    }

    public function saveNewProject() {
        if (!empty($_FILES['cover_image']['name'])) {

            $cover_image = time() . $_FILES["cover_image"]['name'];
            $cover_image = str_replace(" ", "_", $cover_image);
            $cover_image = str_replace("#", "", $cover_image);
            $cover_image = str_replace("-", "", $cover_image);
            $cover_image = str_replace("(", "", $cover_image);
            $cover_image = str_replace(")", "", $cover_image);

            $config['file_name'] = $cover_image;
            $config['upload_path'] = './uploads/projects/cover_image';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '10000';
            $config['max_width'] = '';
            $config['max_height'] = '';
            $config['overwrite'] = TRUE;
            $config['remove_spaces'] = TRUE;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('cover_image')) {
                $data['upload_data'] = $this->upload->data();

                $image_path = $data['upload_data']['file_name'];
                $ar = list($width, $height) = getimagesize($data['upload_data']['full_path']);


                $image_config = array(
                    'source_image' => $data['upload_data']['full_path'],
                    'new_image' => "./uploads/projects/cover_image/thumbnail",
                    'maintain_ratio' => false,
                    'width' => 262,
                    'height' => 262
                );
                $this->load->library('image_lib');
                $this->image_lib->initialize($image_config);
                $resize_rc = $this->image_lib->resize();
                $image_path = $data['upload_data']['file_name'];
            }
        } else {
            $cover_image = '';
        }

        if ($_POST['project_media'] == 1) {
            if (!empty($_FILES['project_image']['name'])) {
                $project_image = time() . $_FILES["project_image"]['name'];
                $project_image = str_replace(" ", "_", $project_image);
                $project_image = str_replace("#", "", $project_image);
                $project_image = str_replace("-", "", $project_image);
                $project_image = str_replace("(", "", $project_image);
                $project_image = str_replace(")", "", $project_image);

                $path = './uploads/projects/project_media/';
                move_uploaded_file($_FILES['project_image']['tmp_name'], $path . $project_image);

                $media_file = $project_image;
            }
        } else {
            if (!empty($_FILES['project_video']['name'])) {
                $project_video = time() . $_FILES["project_video"]['name'];
                $project_video = str_replace(" ", "_", $project_video);
                $project_video = str_replace("#", "", $project_video);
                $project_video = str_replace("-", "", $project_video);
                $project_video = str_replace("(", "", $project_video);
                $project_video = str_replace(")", "", $project_video);

                $path = './uploads/projects/project_media/';
                move_uploaded_file($_FILES['project_video']['tmp_name'], $path . $project_video);

                $media_file = $project_video;
            }
        }

        $data = $this->Project_Model->saveProjectModel($cover_image, $media_file, $_POST);

        redirect('user/add-project');
    }

    public function projectList() {

        $user_id = $this->session->userdata['user_account']['user_id'];
        $data = $this->Project_Model->getProjectListModelForUser($user_id);
        $this->template->set('project_list', $data); // data to be sent in front end

        $this->template->set('page', 'project_list');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Project List | SassConsultants')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('user/project/project_list');
    }

    public function editProject($project_id) {


        $category = $this->Project_Model->getProjectCategories();
        $data = $this->Project_Model->getProjectDetails($project_id);
        $offers = $this->Project_Model->getProjectOffers($project_id);

        $this->template->set('offers', $offers);
        $this->template->set('category', $category);
        $this->template->set('project_data', $data); // data to be sent in front end
        $this->template->set('page', 'Edit Project');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Edit Project | SassConsultants')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('user/project/editProject');
    }

    public function saveProjectOffers() {
        $project_id = $_POST['project_id'];
        $data = $this->Project_Model->saveProjectOffers($_POST);
        redirect('user/edit-project/' . $project_id);
    }

    public function connectedUsers($projectid) {
        $connected_users['data'] = array();
        $userid = $this->common_model->getRecords('tbl_user_project_connection_mapping', '', array('project_id' => $projectid));
        foreach ($userid as $userid) {
            $connected_users['data'] = $this->Project_Model->getConnectedUsersToProjects($userid['user_id']);
        }
        if ($connected_users['data'] != '') {
            $this->template->set('connected_users', $connected_users['data']);
        }
        $this->template->set('projectid', $projectid);
        $this->template->set('page', 'Edit Project');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Edit Project | SassConsultants')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', $this->sidebar)
                ->set_partial('footer', 'partials/footer');
        $this->template->build('user/project/connected_users');
    }

    public function getConnectedChats() {
        $user_id = $this->session->userdata['user_account']['user_id'];
        $condition = '(from_id = ' . $user_id . ' or to_id = ' . $user_id . ') and project_id=' . $this->input->post('project_id') . ' and (from_id = ' . $this->input->post('user_id') . ' or to_id = ' . $this->input->post('user_id') . ')';
        $data = $this->common_model->getRecords('tbl_project_connected_users_chat as pcu', 'pcu.message,pcu.from_id,pcu.send_time,(select username from tbl_users where id=pcu.from_id) as powner_username,(select username from tbl_users where id=pcu.to_id) as cuser_username', $condition);
//        echo $this->db->last_query();
        $msgd = '<ul class="chat">';
        $i = 0;
        foreach ($data as $data) {
            $i++;
            if ($user_id == $data['from_id']) {
                $class_li = 'right';
                $class_pull = 'pull-left';
                $class_pull1 = 'pull-right';
                $msgd .= '<li class="right clearfix"><span class="chat-img pull-right">
                            <div class="circle_init" style="background:#ff876c">'.substr(ucfirst($data['powner_username']),'0','1').'</div>
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>'.$this->common_model->daysAgo($data['send_time']).'</small>
                                    <strong class="pull-right primary-font">'.ucfirst($data['powner_username']).'</strong>
                                </div>
                                <p>'.$data['message'].'
                                </p>
                            </div>
                        </li>';
            } else {
                $class_li = 'left';
                $class_pull = 'pull-right';
                $class_pull1 = 'pull-left';
                $msgd .= '<li class="left clearfix"><span class="chat-img pull-left">
                             <div style="background: #5acbea;" class="circle_init">'.substr(ucfirst($data['powner_username']),'0','1').'</div>
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">'.ucfirst($data['powner_username']).'</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>'.$this->common_model->daysAgo($data['send_time']).'</small>
                                </div>
                                <p>
                                    '.$data['message'].'
                                </p>
                            </div>
                        </li>';
            }
        }
        $msgd .= ' </ul>';
        if ($data) {
            $map['status'] = '1';
            $map['msg'] = 'Success.';
            $map['data'] = $msgd;
            echo json_encode($map);
            exit();
        } else {
            $map['status'] = '0';
            $map['msg'] = $data;
            echo json_encode($map);
            exit();
        }
    }
    
    
    public function sendMsg(){
        $user_id = $this->session->userdata['user_account']['user_id'];
        $insert = $this->common_model->insertRow(array('from_id'=>$user_id,'to_id'=>$this->input->post('userid'),'message'=>$this->input->post('message'),'project_id'=>$this->input->post('project_id')),'tbl_project_connected_users_chat');
        if ($insert) {
            $map['status'] = '1';
            $map['msg'] = 'Success.';
            echo json_encode($map);
            exit();
        } else {
            $map['status'] = '0';
            $map['msg'] = $data;
            echo json_encode($map);
            exit();
        }
    }

}
