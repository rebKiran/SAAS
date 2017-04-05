<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blog extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("common_model");
        $this->load->model("blog_model");
//        $this->load->library('form_validation');
    }

    /* Frontend : Manage Blog Start */

    public function viewBlogList($pg = '')
    {
        $data['global'] = $this->common_model->getGlobalSettings();
        $data = $this->common_model->commonFunction();
        $data['user_session'] = $this->session->userdata('user_account');
        #START Action :: Fetch all active Blog added by admin :   
        $data['arr_blog_data'] = $this->blog_model->getAllActiveBlogList($limit = '', $offset = '');
        foreach ($data["arr_blog_data"] as $key => $value) {
            $data['arr_blog_data'][$key]['user_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '*', array('id' => $value['posted_by']));
            $data['arr_blog_data'][$key]['comment'] = $this->common_model->getRecords(TABLES::$TRANS_BLOG_COMMENTS, 'comment_id', array('post_id' => $value['post_id'], 'status' => '1'));
        }
        $totalrows = count($data['arr_blog_data']);
        #Start:: pagination 
        #load pagination library                            
        $this->load->library('pagination');
        $config['base_url'] = base_url() . "blog/list";
        $config['total_rows'] = $totalrows;
        $config['per_page'] = 6;
        $config['prev_link'] = "<span>«</span>";
        $config['next_link'] = "<span>»</span>";
        $config['cur_page'] = $pg;
        $config['num_links'] = 6;
        $config['first_link'] = FALSE;
        $config['last_link'] = FALSE;
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        if ($pg == "") {
            $pg1 = "";
        } else {
            $pg1 = $pg - 1;
        }
        $from = intval(($pg1));
        if ($config['per_page'] == 1) {
            $lenth = 1;
        } else {
            $lenth = intval($config['per_page']);
        }
        $this->pagination->initialize($config);
        $data['pg_link'] = $this->pagination->create_links();
        if ($data['arr_blog_data'] != '') {
            $data['arr_blog_data'] = array_slice($data['arr_blog_data'], $from, $lenth);
        }

//        if ($this->session->userdata('language_id') == '17') {
//            $data['header'] = array("title" => "Blog List", "keywords" => "", "description" => "", "dashboard" => '1');
//        } elseif ($this->session->userdata('language_id') == '12') {
//            $data['header'] = array("title" => "قائمة بلوق", "keywords" => "", "description" => "", "dashboard" => '1');
//        } else {
//            $data['header'] = array("title" => "�?�客列表", "keywords" => "", "description" => "", "dashboard" => '1');
//        }


        $this->template->set('page', 'bloglist');
        $this->template->set('arr_blog_data', $data['arr_blog_data']);
        $this->template->set('user_session', $data['user_session']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sass Consultant | Blogs')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/blog/blog_list');
    }

    public function getBlogDetails($post_id = '')
    {
        $data = $this->common_model->commonFunction();
        $data['lang'] = $this->lang->language;
        $data['header'] = array("title" => 'Blog Details', "keywords" => "", "description" => "");
        $data['blog_posts'] = $this->blog_model->getBlogDetails($post_id);
//        print_r(  $data['blog_posts']); die;
        if (!empty($data['blog_posts'])) {
            $data['blog_posts'][0]['user_details'] = $this->common_model->getRecords('user', 'id,firstname,lastname,profileimage', array('id' => $data['blog_posts'][0]['posted_by']));
            foreach ($data["blog_posts"] as $key => $value) {
                $data['blog_posts'][$key]['comments'] = $this->common_model->getRecords('trans_blog_comments', '*', array('post_id' => $post_id, 'status' => '1'), $order_by = 'comment_id DESC', $limit = '', $debug = 0);
            }
            foreach ($data["blog_posts"][0]['comments'] as $key => $value) {
                $user = $this->common_model->getRecords('user', 'id,firstname,lastname,profileimage,user_name', array('id' => $value['commented_by']));
                $data["blog_posts"][0]['comments'][$key]['commented_user'] = ucfirst($user[0]['user_name']);
                $data["blog_posts"][0]['comments'][$key]['commented_user_profile'] = $user[0]['profileimage'];
                $data["blog_posts"][0]['comments'][$key]['user_id'] = $user[0]['user_id'];
            }
            /* START:: Fetch data form mst blog table for image */
            $data["mst_blog_posts"] = $this->common_model->getRecords("mst_blog_posts", "", array("post_id" => $post_id), 'posted_on DESC', '', '');
        } else {
            $this->session->set_userdata('error_msg', "Blogs is either deleted by admin or currently unavailable.");
            redirect(base_url() . 'blog/list');
        }



        if ($this->session->userdata('language_id') == '17') {
            $data['header'] = array("title" => "Blog Details", "keywords" => "", "description" => "", "dashboard" => 1);
        } elseif ($this->session->userdata('language_id') == '12') {
            $data['header'] = array("title" => "ت�?اصيل بلوق", "keywords" => "", "description" => "", "dashboard" => '1');
        } else {
            $data['header'] = array("title" => "�?�客详细", "keywords" => "", "description" => "", "dashboard" => '1');
        }

        $data['arr_blog_details'] = $this->blog_model->getAllActiveBlogList($limit = '5', $offset = '');
        $data['post_id'] = $post_id;
        $data['post_comments'] = $this->getPostComments($post_id);
        $data['user_session'] = $this->session->userdata('user_account');
        $this->load->view('front/includes/header', $data);
//        $this->load->view('front/includes/header-2', $data);
        $this->load->view('front/blog/blogs-details', $data);
        $this->load->view('front/includes/footer');
    }

    public function blogPost()
    {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error_msg', "Please sign in to post your blog.");
            redirect('blog/list');
        }
        $data = $this->common_model->commonFunction();
        if (count($_POST) > '0') {
            if ($_FILES['blog_image']['name'] != '') {
                $_FILES['blog_image']['name'];
                $_FILES['blog_image']['type'];
                $_FILES['blog_image']['tmp_name'];
                $_FILES['blog_image']['error'];
                $_FILES['blog_image']['size'];
                $config['file_name'] = time() . rand();
                $config['upload_path'] = 'media/front/img/blog-images/';
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['max_size'] = '9000000';
                $this->load->library('upload');
                $this->upload->initialize($config);
                if ($this->upload->do_upload('blog_image')) {
                    $data['upload_data'] = $this->upload->data();
                    $ar = list($width, $height) = getimagesize($data['full_path']);
                    $upload_result = $this->upload->data();
                    $image_config = array(
                        'source_image' => $upload_result['full_path'],
                        'new_image' => "media/front/img/blog-images/537x400",
                        'maintain_ratio' => false,
                        'width' => 537,
                        'height' => 400
                    );
                    $this->load->library('image_lib');
                    $this->image_lib->initialize($image_config);
                    $resize_rc = $this->image_lib->resize();
                    $img_path = $upload_result['file_name'];
                } else {
                    $error = array('error' => $this->upload->display_errors());
                }
                $data['user_session'] = $this->session->userdata('user_account');
                $arr_post_data = array(
                    "post_title" => $this->input->post('blog_title'),
                    "blog_image" => $img_path,
                    'post_content' => $this->input->post('inputPostDescription'),
                    'posted_by' => $data['user_session']['user_id'],
                    'posted_on' => date("Y-m-d H:i:s"),
                    'status' => '0'
                );
                $new_post_id = $this->blog_model->insertNewPost($arr_post_data);
            }
            $this->session->set_userdata('success_msg', "Your blog post has been added successfully, Please wait for the admin approval.");
            redirect(base_url() . 'blog/list');
        }


        if ($this->session->userdata('language_id') == '17') {
            $data['header'] = array("title" => "Blog Details", "keywords" => "", "description" => "", "dashboard" => 1);
        } elseif ($this->session->userdata('language_id') == '12') {
            $data['header'] = array("title" => "ت�?اصيل بلوق", "keywords" => "", "description" => "", "dashboard" => '1');
        } else {
            $data['header'] = array("title" => "�?�客详细", "keywords" => "", "description" => "", "dashboard" => '1');
        }

        $this->load->view('front/includes/header', $data);
//        $this->load->view('front/includes/header-2', $data);
        $this->load->view('front/blog/blog-post', $data);
        $this->load->view('front/includes/footer');
    }

    /* Function to add blog post start */

    public function addPost($post_id)
    {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error_msg', "Please sign in to post your blog.");
            redirect('blog/list');
        }

        $data = $this->common_model->commonFunction();
        if (count($_POST) > '0') {
            if ($_FILES['blog_image']['name'] != '') {
                $_FILES['blog_image']['name'];
                $_FILES['blog_image']['type'];
                $_FILES['blog_image']['tmp_name'];
                $_FILES['blog_image']['error'];
                $_FILES['blog_image']['size'];
                $config['file_name'] = time() . rand();
                $config['upload_path'] = 'assets/frontend/img/blog-images/';
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['max_size'] = '9000000';
                $this->load->library('upload');
                $this->upload->initialize($config);
                if ($this->upload->do_upload('blog_image')) {
                    $data['upload_data'] = $this->upload->data();
                    $ar = list($width, $height) = getimagesize($data['full_path']);
                    $upload_result = $this->upload->data();
                    $image_config = array(
                        'source_image' => $upload_result['full_path'],
                        'new_image' => "media/front/img/blog-images/537x400",
                        'maintain_ratio' => false,
                        'width' => 537,
                        'height' => 400
                    );
                    $this->load->library('image_lib');
                    $this->image_lib->initialize($image_config);
                    $resize_rc = $this->image_lib->resize();
                    $img_path = $upload_result['file_name'];
                    unlink('media/front/img/blog-images/537x400/' . $this->input->post('old_blog_image'));
                    unlink('media/front/img/blog-images/' . $this->input->post('old_blog_image'));
                } else {
                    $error = array('error' => $this->upload->display_errors());
                }
                $data['user_session'] = $this->session->userdata('user_account');
                $arr_post_data = array(
                    "post_title" => $this->input->post('blog_title'),
                    "blog_image" => $img_path,
                    'post_content' => $this->input->post('inputPostDescription'),
                    'posted_by' => $data['user_session']['user_id'],
                    'posted_on' => date("Y-m-d H:i:s"),
                );
                $condition = array('post_id' => $post_id);
                $this->blog_model->updatePost($arr_post_data, $condition);
            }
            $this->session->set_userdata('success_msg', "Your blog post has been updated successfully, Please wait for the admin approval.");
            redirect(base_url() . 'blog/list');
        }
        $data['blog_posts'] = $this->blog_model->getEditBlogDetails($post_id);
        $data['header'] = array("title" => "Edit Blog Post", "keywords" => "", "description" => "", "dashboard" => '');
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/includes/header-2', $data);
        $this->load->view('front/blog/edit-post', $data);
        $this->load->view('front/includes/footer');
    }

    /* Function to add blog post end */

    public function editPost($post_id)
    {
        if (!$this->common_model->isLoggedIn()) {
            $this->session->set_userdata('error_msg', "Please sign in to post your blog.");
            redirect('blog/list');
        }
        $data = $this->common_model->commonFunction();
        if (count($_POST) > '0') {
            if ($_FILES['blog_image']['name'] != '') {
                $_FILES['blog_image']['name'];
                $_FILES['blog_image']['type'];
                $_FILES['blog_image']['tmp_name'];
                $_FILES['blog_image']['error'];
                $_FILES['blog_image']['size'];
                $config['file_name'] = time() . rand();
                $config['upload_path'] = 'media/front/img/blog-images/';
                $config['allowed_types'] = 'jpg|jpeg|gif|png';
                $config['max_size'] = '9000000';
                $this->load->library('upload');
                $this->upload->initialize($config);
                if ($this->upload->do_upload('blog_image')) {
                    $data['upload_data'] = $this->upload->data();
                    $ar = list($width, $height) = getimagesize($data['full_path']);
                    $upload_result = $this->upload->data();
                    $image_config = array(
                        'source_image' => $upload_result['full_path'],
                        'new_image' => "media/front/img/blog-images/537x400",
                        'maintain_ratio' => false,
                        'width' => 537,
                        'height' => 400
                    );
                    $this->load->library('image_lib');
                    $this->image_lib->initialize($image_config);
                    $resize_rc = $this->image_lib->resize();
                    $img_path = $upload_result['file_name'];
                    unlink('media/front/img/blog-images/537x400/' . $this->input->post('old_blog_image'));
                    unlink('media/front/img/blog-images/' . $this->input->post('old_blog_image'));
                } else {
                    $error = array('error' => $this->upload->display_errors());
                }
                $data['user_session'] = $this->session->userdata('user_account');
                $arr_post_data = array(
                    "post_title" => $this->input->post('blog_title'),
                    "blog_image" => $img_path,
                    'post_content' => $this->input->post('inputPostDescription'),
                    'posted_by' => $data['user_session']['user_id'],
                    'posted_on' => date("Y-m-d H:i:s"),
                );
                $condition = array('post_id' => $post_id);
                $this->blog_model->updatePost($arr_post_data, $condition);
            }
            $this->session->set_userdata('success_msg', "Your blog post has been updated successfully, Please wait for the admin approval.");
            redirect(base_url() . 'blog/list');
        }
        $data['blog_posts'] = $this->blog_model->getEditBlogDetails($post_id);
        $data['header'] = array("title" => "Edit Blog Post", "keywords" => "", "description" => "", "dashboard" => '');
        $this->load->view('front/includes/header', $data);
        $this->load->view('front/includes/header-2', $data);
        $this->load->view('front/blog/edit-post', $data);
        $this->load->view('front/includes/footer');
    }

    /*  Function to get all blog posts     */

    private function getPosts($fields = '', $condition = '', $order_by_to_pass = '')
    {
        return $this->blog_model->getPosts($fields, $condition, $order_by_to_pass);
    }

    /*     *  Function to search blog posts     */

    private function searchPosts($searchKey)
    {
        return $this->blog_model->searchPosts($searchKey);
    }

    private function getPostComments($post_id)
    {
        $condition_to_pass = array("`post_id`" => $post_id, "b.status" => "1");
        $order = ('comment_on desc');
        $this->load->model("user_model");
        $arr_comments = $this->blog_model->getPostComments("", $condition_to_pass, $order, '');
        foreach ($arr_comments as $key => $value) {
            $arr_comments[$key]['user_details'] = $this->common_model->getRecords('user', 'id,first_name,last_name,profileimage', array('user_id' => $value['commented_by']));
        }
        return $arr_comments;
    }

    


    /* Function to manage blog post at backend start */

    public function manage_blog_posts()
    {
        $this->load->model("common_model");
        /** checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();
        /*
         * START Action :: Code for delete all functionality on blog-listing page :
         */
        if (count($_POST) > 0) {
            if ($this->input->post('btn_delete_all') != "") {
                /* getting all ides selected */
                $arr_blog_ids = $this->input->post('checkbox');
                if (count($arr_blog_ids) > 0) {
                    /* deleting the blog from the backend */
                    foreach ($arr_blog_ids as $blog_id) {
                        $blog_image = $this->common_model->getRecords(TABLES::$MST_BLOG_POSTS, "blog_image", array("post_id" => $blog_id));
                        @unlink("media/front/img/blog-images/" . $blog_image[0]['blog_image']);
                        @unlink("media/front/img/blog-images/537x400/" . $blog_image[0]['blog_image']);
                    }
                    $this->common_model->deleteRows($arr_blog_ids, TABLES::$MST_BLOG_POSTS, "post_id");
                    $this->common_model->deleteRows($arr_blog_ids, TABLES::$TRANS_BLOG_POSTS, "post_id");
                    $this->common_model->deleteRows($arr_blog_ids, "trans_blog_comments", "post_id");
                    $this->session->set_userdata("msg", "<span class='success'>Blog deleted successfully!</span>");
                    redirect(base_url() . 'backend/blog');
                }
            }
        }
        $data['arr_active_admin_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '', array('id' => '1'));
        $data['blog_posts'] = $this->getPosts('', '', 'post_id desc');


        $this->template->set('page', 'bloglist');
        $this->template->set('blog_posts', $data['blog_posts']);
        $this->template->set('arr_active_admin_details', $data['arr_active_admin_details']);
        $this->template->set('global', $data['global']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sass Consultant | Blogs')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/blog/blog_list');
    }

    /* Function to manage blog post at backend end */




    /* function to change Blog Status */

    public function changeStatus()
    {
        if ($this->input->post('post_id') != "") {
            #updating the user status.
            $arr_to_update = array(
                "status" => $this->input->post('post_status')
            );
            #condition to update record	for the user status
            $condition_array = array('post_id' => intval($this->input->post('post_id')));
            $this->common_model->updateRow(TABLES::$MST_BLOG_POSTS, $arr_to_update, $condition_array);
            echo json_encode(array("error" => "0", "error_message" => "Status has changed successflly."));
        } else {
            #if something going wrong providing error message. 
            echo json_encode(array("error" => "1", "error_message" => "Sorry, your request can not be fulfilled this time. Please try again later"));
        }
    }

    /* Function to add and update blog post start */

    public function edit_post($post_id = '')
    {
        $this->load->model("common_model");

        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "admin/login");
        }

        $data = $this->common_model->commonFunction();

        $post_title = $this->input->post("inputName");

        if ($post_title != "") {
            $edit_id = $this->input->post("edit_id");
            if ($edit_id != "") {

                if ($_FILES['img_file']['name'] != '') {
                    $_FILES['img_file']['name'];
                    $_FILES['img_file']['type'];
                    $_FILES['img_file']['tmp_name'];
                    $_FILES['img_file']['error'];
                    $_FILES['img_file']['size'];
                    $config['file_name'] = time() . rand();
                    $config['upload_path'] = 'uploads/blogs';
                    $config['allowed_types'] = 'jpg|jpeg|gif|png';
                    $config['max_size'] = '9000000';
                    $old_image = $this->input->post("old_img_file");
                    @unlink('assets/frontend/img/blog-images/' . $old_image);
                    @unlink('assets/frontend/img/blog-images/537x400/' . $old_image);
                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('img_file')) {
                        $data = $this->upload->data();
                        $ar = list($width, $height) = getimagesize($data['full_path']);
                        $upload_result = $this->upload->data();
                        /* for image */
                        $image_config = array(
                            'source_image' => $upload_result['full_path'],
                            'new_image' => FCPATH . "uploads/blogs/233x155/",
                            'maintain_ratio' => false,
                            'width' => 233,
                            'height' => 155
                        );
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($image_config);
                        $resize_rc = $this->image_lib->resize();
                        /* for image  540x360*/
                        $image_config1 = array(
                            'source_image' => $upload_result['full_path'],
                            'new_image' => FCPATH . "uploads/blogs/540x360/",
                            'maintain_ratio' => false,
                            'width' => 540,
                            'height' => 360
                        );
                        $this->image_lib->initialize($image_config1);
                        $resize_rc1 = $this->image_lib->resize();
                        /* for image  670x470*/
                        $image_config2 = array(
                            'source_image' => $upload_result['full_path'],
                            'new_image' => FCPATH . "uploads/blogs/670x470/",
                            'maintain_ratio' => false,
                            'width' => 670,
                            'height' => 470
                        );
                        
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($image_config2);
                        $resize_rc2 = $this->image_lib->resize();
                        $img_path = $upload_result['file_name'];
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                    }
                } else {
                    $img_path = $this->input->post('old_img_file');
                }
                $update_data = array(
                    "post_title" => $this->input->post('inputName'),
                    "blog_category" => $this->input->post('blog_category'),
                    "blog_image" => $img_path,
                    'post_content' => $this->input->post('inputPostDescription'),
                    'status' => "" . intval($this->input->post('blog_status'))
                );
                $condition = array("post_id" => $edit_id);
                $this->common_model->updateRow(TABLES::$MST_BLOG_POSTS, $update_data, $condition);
                $this->session->set_userdata("msg", "<span class='success'>Blog updated successfully!</span>");
                redirect(base_url() . "admin/blog");
            } else {

                if ($_FILES['img_file']['name'] != '') {
                    $_FILES['img_file']['name'];
                    $_FILES['img_file']['type'];
                    $_FILES['img_file']['tmp_name'];
                    $_FILES['img_file']['error'];
                    $_FILES['img_file']['size'];
                    $config['file_name'] = time() . rand();
                    $config['upload_path'] = FCPATH . 'uploads/blogs/';
                    $config['allowed_types'] = 'jpg|jpeg|gif|png';
                    $config['max_size'] = '9000000';
                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('img_file')) {
                        $data['upload_data'] = $this->upload->data();
                        $ar = list($width, $height) = getimagesize($data['full_path']);
                        $upload_result = $this->upload->data();
                        /* for image */
                        $image_config = array(
                            'source_image' => $upload_result['full_path'],
                            'new_image' => FCPATH . "uploads/blogs/233x155/",
                            'maintain_ratio' => false,
                            'width' => 233,
                            'height' => 155
                        );
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($image_config);
                        $resize_rc = $this->image_lib->resize();
                        /* for image  540x360*/
                        $image_config1 = array(
                            'source_image' => $upload_result['full_path'],
                            'new_image' => FCPATH . "uploads/blogs/540x360/",
                            'maintain_ratio' => false,
                            'width' => 540,
                            'height' => 360
                        );
                        $this->image_lib->initialize($image_config1);
                        $resize_rc1 = $this->image_lib->resize();
                        /* for image  670x470*/
                        $image_config2 = array(
                            'source_image' => $upload_result['full_path'],
                            'new_image' => FCPATH . "uploads/blogs/670x470/",
                            'maintain_ratio' => false,
                            'width' => 670,
                            'height' => 470
                        );
                        
                        $this->load->library('image_lib');
                        $this->image_lib->initialize($image_config2);
                        $resize_rc2 = $this->image_lib->resize();
                        
                        
                        $img_path = $upload_result['file_name'];
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                    }
                    $config = array(
                        'field' => 'slug',
                        'slug' => 'slug',
                        'table' => TABLES::$MST_BLOG_POSTS,
                        'id' => 'id',
                    );
                    $this->load->library('slug', $config);
                    $slugdata = array(
                        'slug' => $this->input->post('inputName'),
                    );
                    $slug = $this->slug->create_uri($slugdata);
                    $arr_post_data = array(
                        "post_title" => $this->input->post('inputName'),
                        "blog_category" => $this->input->post('blog_category'),
                        "blog_image" => $img_path,
                        'post_content' => $this->input->post('inputPostDescription'),
                        'posted_by' => $data['user_account']['user_id'],
                        'posted_on' => date("Y-m-d H:i:s"),
                        'status' => $this->input->post('blog_status'),
                        'slug' => $slug
                    );
                    $new_post_id = $this->blog_model->insertNewPost($arr_post_data);
                }
            }
            $this->session->set_userdata("msg", "<span class='success'>Blog added successfully!</span>");
            redirect(base_url() . "admin/blog");
        }

        $category = $this->common_model->getRecords(TABLES::$MST_CATEGORIES, '*', array("status" => '1'));
        $data['users'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, 'id, email', array("id" => '1'), '', '', '');
        $data['users_list'] = array();
        foreach ($data['users'] as $key => $value) {
            $data['users_list'][] = $value['id'] . "*" . $value['email'];
        }
        $data['user_list'] = json_encode($data['users_list']);

        $data["post_id"] = $post_id;
        $arr_post_info = $this->blog_model->getPosts("", array("post_id" => $post_id));
        if ($post_id != '') {
            $data['users_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, 'id, email', array("id" => $arr_post_info[0]['posted_by']), '', '', '');
            $data["title"] = "Update Blog";
        } else {
            $data["title"] = "Add Blog";
        }
        if (!empty($arr_post_info[0])) {
            $data["post_info"] = $arr_post_info[0];
            $this->template->set('post_info', $data["post_info"]);
        }
        $data['arr_active_admin_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '', array('id' => '1'));
        if ($post_id != '') {
            $data['main'] = 'blog_edit';
        } else {
            $data['main'] = 'blog_add';
        }


        $this->template->set('page', 'bloglist');
//        $this->template->set('blog_posts',$data['blog_posts']);
        $this->template->set('arr_active_admin_details', $data['arr_active_admin_details']);
        $this->template->set('global', $data['global']);
        $this->template->set('category', $category);
        $this->template->set('post_id', $post_id);

        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sass Consultant | ' . $data["title"])
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/blog/' . $data['main']);
    }

    public function delete_post()
    {
        $post_id = $this->input->post("post_id");
        $post_ids[] = $this->input->post("post_ids");
        if ($post_id != "") {
            $this->blog_model->deleteBlogPost($post_id);
            $this->blog_model->deleteTransBlogPost($post_id);
        } elseif ($post_ids != "") {
            foreach ($post_ids as $post_id) {
                $this->common_model->deleteRows($post_id, "mst_blog_posts", "post_id");
                $this->common_model->deleteRows($post_id, "trans_blog_posts", "post_id");
            }
        }
        $this->session->set_userdata("msg", "<span class='error'>Blog deleted successfully.</span>");
        echo json_encode(array("msg" => "success", "error" => "0"));
    }

    public function delete_post_comment()
    {
        $comment_id = $this->input->post("comment_id");
        $comment_ids = $this->input->post("comment_ids");
        if ($comment_id != "")
            $this->blog_model->deletePostComment(array("comment_id" => "" . intval($comment_id)));
        elseif ($comment_ids != "") {
            foreach ($comment_ids as $comment_id) {
                $arr_delete = array("comment_id" => "" . intval($comment_id));
                $this->blog_model->deletePostComment($arr_delete);
            }
        }
        echo json_encode(array("msg" => "success", "error" => "0"));
    }

    public function view_post_comments($post_id)
    {
        $this->load->model("common_model");
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "admin/login");
        }
        /** using the email template model ** */
        $data = $this->common_model->commonFunction();

        if (count($_POST) > 0) {
            if ($this->input->post('btn_delete_all') != "") {
                /* getting all ides selected */
                $arr_blog_comment_ids = $this->input->post('checkbox');
                if (count($arr_blog_comment_ids) > 0) {
                    /* deleting the blog from the backend */
                    $this->common_model->deleteRows($arr_blog_comment_ids, TABLES::$TRANS_BLOG_COMMENTS, "comment_id");
                    $this->session->set_userdata("msg", "<span class='success'>Blog comment deleted successfully!</span>");
                }
            }
        }

        $order = 'b.comment_id desc';
        $post_comments = $this->blog_model->getPostComments("", array("post_id" => $post_id), $order);
        $data["title"] = "Blog Comments Management ";
        $data["post_id"] = $post_id;
        $data["arr_post_comments"] = $post_comments;
        if (!empty($data["arr_post_comments"])) {
            foreach ($data["arr_post_comments"] as $key => $value) {
                $data['arr_post_comments'][$key]['user_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '*', array('id' => $value['commented_by']));
            }
        }
        $data['arr_active_admin_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '', array('id' => '1'));


        $this->template->set('arr_post_comments', $data["arr_post_comments"]);
        $this->template->set('arr_active_admin_details', $data['arr_active_admin_details']);
        $this->template->set('page', 'commentlist');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sass Consultant | Comments')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/blog/comment_list');
    }

    public function add_post_comment($post_id)
    {
        $this->load->model("common_model");
        /*         * checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /*         * using the email template model ** */

        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /*         * getting all privileges ** */
        $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
        if ($data['user_account']['role_id'] != 1) {
            /* checking user has privilege to access the manage testimonial */
            $user_account = $this->session->userdata('user_account');
            /* getting user Privileges from the session array */
            $user_priviliges = unserialize($user_account['user_privileges']);
            if (!in_array(16, $user_priviliges)) {
                /* setting session for displaying notiication message. */
                $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage Blog !</span>");
                redirect(base_url() . "backend/home");
            }
        }
        $post_comment = $this->input->post("inputComment");
        /*  Post request check  */
        if ($post_comment != "") {
            $post_id = $this->input->post('post_id');
            $arr_blog_comment = array();
            $arr_blog_comment["post_id"] = $post_id;
            $arr_blog_comment["comment"] = $post_comment;
            $arr_blog_comment["comment_on"] = date("Y-m-d H:i:s");
            $arr_blog_comment["commented_by"] = "Moderator";
            $arr_blog_comment["status"] = "" . $this->input->post("inputPublishStatus");
            $this->blog_model->add_comment($arr_blog_comment);
            redirect(base_url() . "backend/blogs/view-comments/" . $post_id);
        }
        $data["title"] = "Blog Module-Post Comments Management ";
        $data["post_id"] = $post_id;
        $this->load->view('backend/blog/add-post-comment', $data);
    }

    public function edit_post_comment($post_id, $comment_id)
    {
        $this->load->model("common_model");
        /** checking admin is logged in or not ** */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "admin/login");
        }
        /**  using the email template model  ** */
        $data = $this->common_model->commonFunction();
        $arr_privileges = array();
        /**  getting all privileges  ** */
        /* $data['arr_privileges'] = $this->common_model->getRecords('mst_privileges');
          if ($data['user_account']['role_id'] != 1) {
          $user_account = $this->session->userdata('user_account');
          /* getting user Privileges from the session array
          $user_priviliges = unserialize($user_account['user_privileges']);
          if (!in_array(16, $user_priviliges)) {
          /* setting session for displaying notiication message.
          $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to  manage Blog!</span>");
          redirect(base_url() . "backend/home");
          }
          } */
        $post_comment = $this->input->post("inputComment");
        /* Post request check */
        if ($post_comment != "") {
            $post_id = $this->input->post('post_id');
            $comment_id = $this->input->post("comment_id");
            $arr_blog_comment = array();
            $arr_blog_comment["comment"] = addslashes($post_comment);
            $arr_blog_comment["status"] = "" . $this->input->post("inputPublishStatus");
            $this->blog_model->update_comment($arr_blog_comment, array("post_id" => $post_id, "comment_id" => $comment_id));
            $this->session->set_userdata("msg", "<span class='success'>Blog comment edited successfully.</span>");
            redirect(base_url() . "admin/blog/view-comments/" . $post_id);
        }
        $post_comment_info = $this->blog_model->getPostComments("*", array("comment_id" => $comment_id));
        $data["arr_post_comment_info"] = $post_comment_info[0];
        $data['arr_active_admin_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '', array('id' => '1'));



        $this->template->set('arr_post_comment_info', $data['arr_post_comment_info']);
        $this->template->set('arr_active_admin_details', $data['arr_active_admin_details']);
        $this->template->set('comment_id', $comment_id);
        $this->template->set('page', 'bloglist');
        $this->template->set('post_id', $post_id);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title('Sass Consultant | Comments')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('admin/blog/edit-post-comment');
    }

    public function check_empty_post()
    {
        if ($this->input->post('inputPostDescription') != '')
            $request = strip_tags($this->input->post('inputPostDescription'));
        if ($request == '') {
            echo 'false';
        } else {
            echo 'true';
        }
    }

    public function editBlogLanguage($post_id)
    {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        /* getting commen data required */
        $data = $this->common_model->commonFunction();
        if (count($_POST) > 0) {

            if ($this->input->post('post_title') != "") {
                if ($this->input->post('post_id') != '' && $this->input->post('lang_id') != '') {
                    $arr_collection = $this->common_model->getRecords("trans_blog_posts", "*", array('post_id' => $this->input->post('post_id'), 'lang_id' => $this->input->post('lang_id')));
                    if ($arr_collection[0]['post_title'] != '') {
                        $arr_to_update = array("post_title" => $this->input->post('post_title'),
                            'posted_on' => date("Y-m-d H:i:s"),
                            "post_content" => $this->input->post('inputPostDescription'));
                        $condition_array = array('lang_id' => intval($this->input->post('lang_id')), 'post_id' => intval(($this->input->post('post_id'))));
                        $this->common_model->updateRow('trans_blog_posts', $arr_to_update, $condition_array);
                    } else {
                        $arr_to_insert = array(
                            "post_title" => $this->input->post('post_title'),
                            "lang_id" => $this->input->post('lang_id'),
                            "post_id" => $this->input->post('post_id'),
                            'posted_on' => date("Y-m-d H:i:s"),
                            "post_content" => $this->input->post('inputPostDescription')
                        );
                        $this->common_model->insertRow($arr_to_insert, 'trans_blog_posts');
                    }
                    /* setting session for displaying notiication message. */
                    $this->session->set_userdata('msg', "<span class='success'>Blog updated successfully.</span>");
                }
                /* redirecting to cms list */
                redirect(base_url() . "backend/blog");
            }
        }
        $data['title'] = "Edit Multilingual Blog";
        $data['post_id'] = base64_decode($post_id);
        /* getting all the active languages from the database */
        $data['arr_languages'] = $this->common_model->getRecords("mst_languages", "", array("status" => 'A', "lang_id !=" => '17'));
        $this->load->view('backend/blog/edit-language-post', $data);
    }

    function getBlogLanguage()
    {
        /* checking admin is logged in or not */
        if (!$this->common_model->isLoggedIn()) {
            redirect(base_url() . "backend/login");
        }
        $data = $this->common_model->commonFunction();
        if ($this->input->post('lang_id') != '') {
            $blog_language = $this->common_model->getRecords("trans_blog_posts", "*", array("lang_id" => $this->input->post('lang_id'), "post_id" => $this->input->post('post_id'),));
            $arr_to_return = array();
            if (count($blog_language) > 0) {
                $arr_to_return["post_title"] = stripslashes($blog_language [0]["post_title"]);
                $arr_to_return["post_content"] = stripslashes($blog_language [0]["post_content"]);
            } else {
                $arr_to_return["post_title"] = "";
                $arr_to_return["post_content"] = "";
            }
            echo json_encode($arr_to_return);
        }
    }

    /* Backend : Manage Blog End */
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
