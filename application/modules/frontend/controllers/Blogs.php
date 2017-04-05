<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogs extends CI_Controller {

    function __construct() { 
        parent::__construct();
        $this->global_setting = $this->common_model->getGlobalSettings();
		  
    }

	/*
     * Load view for Research page
     */
	public function blogsPage($pg = '', $cat = '', $page='' ) {  
		
		$this->load->model("Blog_Model");
		$this->load->model("Category_model");
		$this->load->model("Common_Model");
		
		$search = (isset($_POST['search_blog']) && !empty(trim($_POST['search_blog']))) ? trim(stripslashes($_POST['search_blog'])) : '';
		//$products = $this->product_model->getAllProducts();
		//$categories = $this->Category_model->getCategories();
		$blogs = $this->Blog_Model->getActiveBlog( $pg, $cat , $search );
		
		$categories = $this->Category_model->getBlogCategories();

		$paper_categories = array();
		
		if(!empty($cat) && 'cat' == $pg ) {
			$paper_categories = $this->Category_model->getCategoryDetailById( $cat );
			if( !empty($paper_categories)) {
				$paper_categories = $paper_categories[0];
			}
			//print_r( $paper_categories );die;
		}
		
		$blog_posts = $this->Common_Model->getRecords( 'tbl_mst_blog_posts' ,'', array('status'=> '1'), 'post_id desc ', 5 );
		
		$popular_posts = $this->Category_model->getPopularPosts();	
		
		$totalrows = count($blogs);
        #Start:: pagination 
        #load pagination library                            
        $this->load->library('pagination');
		
		if(!empty($cat)){
			$config['base_url'] = base_url() . "blog/cat/" . $cat;
		} else {
			$config['base_url'] = base_url() . "blog";
		}
		       
        $config['total_rows'] = $totalrows;
        $config['per_page'] = 5;
        $config['prev_link'] = "<span>«</span>";
        $config['next_link'] = "<span>»</span>";
		
		if(!empty($cat) && 'cat' == $pg ){ 
			 $config['cur_page'] = $page - 1;
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
			if ($pg === "") {
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
		
		//echo ' from : ' .$from . ' lenth :- ' . $lenth;die;
        if ($blogs != '') {
            $blogs = array_slice($blogs, $from, $lenth);
        }
		
		
        $this->template->set('page', 'blog');
		$this->template->set('blogs', $blogs);
		$this->template->set('blog_posts', $blog_posts);
		$this->template->set('popular_posts', $popular_posts);
		$this->template->set('search', $search);
		$this->template->set('paper_categories', $paper_categories);
	
		$this->template->set('categories', $categories);
		$this->template->set('pg_link', $data['pg_link']);
        $this->template->set_theme('default_theme');
		$this->template->set_layout('frontend')
                ->title('Research Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('blog');
    }
    
    private function getPostComments($post_id)
    {
        $condition_to_pass = array("`post_id`" => $post_id, "b.status" => "1");
        $order = ('comment_on desc');
//        $this->load->model("user_model");
        $arr_comments = $this->blog_model->getPostComments("", $condition_to_pass, $order, '');
        foreach ($arr_comments as $key => $value) {
            $arr_comments[$key]['user_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '*', array('id' => $value['commented_by']));
        }
        return $arr_comments;
    }

    /* function to add comments */

    public function addComment($post_id = '')
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('comment', 'Blog content', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_userdata('error_msg', validation_errors());
            redirect(base_url() . "/blog-page/".$post_id . "#msg");
        }
        $postid = $this->common_model->getRecords(TABLES::$MST_BLOG_POSTS, 'post_id', array('slug' => $post_id));
//        if (!$this->common_model->isLoggedIn()) {
//            $this->session->set_userdata('error_msg', 'Please login to post comment');
//            redirect(base_url() . $post_id . "#error_msg");
//        }
        $data['user_session'] = $this->session->userdata('user_account');
        #START Action :: Insert user comment on data base :
        $arr_to_insert = array(
            "post_id" => $postid[0]['post_id'],
            "commenter_email" => $this->input->post('email'),
            "commented_by" => $data['user_session']['user_id'],
            "comment" => $this->input->post('comment'),
            "comment_on" => date("Y-m-d H:i:s")
        );
        #inserting user details into the database
        $last_insert_id = $this->common_model->insertRow($arr_to_insert, TABLES::$TRANS_BLOG_COMMENTS);
        $this->session->set_userdata('success_msg', 'Your comment has been posted successfully');
        redirect(base_url() . "/blog-page/" .$post_id. "#msg");
    }

}
