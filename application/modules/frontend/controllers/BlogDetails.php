<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BlogDetails extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->global_setting = $this->common_model->getGlobalSettings();
        $this->load->model("Blog_Model");
        $this->load->model("Category_model");
        $this->load->model("Common_Model");
    }

    /*
     * Load view for Research page
     */

    public function blogPage($blogId) {



        $blogs = $this->Blog_Model->getBlogDetails($blogId);

        $categories = $this->Category_model->getBlogCategories();

        $blog_posts = $this->Common_Model->getRecords('tbl_mst_blog_posts', '', array('status' => '1'), 'post_id desc ', 5);

        $popular_posts = $this->Category_model->getPopularPosts();
         $blogid = $this->common_model->getRecords(TABLES::$MST_BLOG_POSTS, 'post_id', array('slug' => $blogId));
        //$categories = $this->Category_model->getCategories();
        $data['blog_posts'] = $this->Blog_Model->getBlogDetails($blogId);
        $this->template->set('page', 'blogdetailPage');
        $this->template->set('data', $blogs);
       
        $post_comments = $this->getPostComments($blogid[0]['post_id']);
        foreach ($data["blog_posts"] as $key => $value) {
                $data['blog_posts'][$key]['comments'] = $this->common_model->getRecords(TABLES::$TRANS_BLOG_COMMENTS, '*', array('post_id' => $data['blog_posts'][0]['post_id'], 'status' => '1'), $order_by = 'comment_id DESC', $limit = '', $debug = 0);
            }
        foreach ($data["blog_posts"][0]['comments'] as $key => $value) {
            $user = $this->common_model->getRecords(TABLES::$ADMIN_USER, '*', array('id' => $value['commented_by']));
            $data["blog_posts"][0]['comments'][$key]['commented_user'] = ucfirst($user[0]['username']);
            $data["blog_posts"][0]['comments'][$key]['id'] = $user[0]['id'];
        }
        
        
        $this->template->set('blog_posts', $data["blog_posts"]);
        $this->template->set('popular_posts', $popular_posts);
        $this->template->set('post_comments', $post_comments);

        $this->template->set('categories', $categories);
        //$this->template->set('categories', $categories);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Research Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('blogdetailPage');
    }

    private function getPostComments($post_id) {
        $condition_to_pass = array("`post_id`" => $post_id, "b.status" => "1");
        $order = ('comment_on desc');
//        $this->load->model("user_model");
        $arr_comments = $this->Blog_Model->getPostComments("", $condition_to_pass, $order, '');
        foreach ($arr_comments as $key => $value) {
            $arr_comments[$key]['user_details'] = $this->common_model->getRecords(TABLES::$ADMIN_USER, '*', array('id' => $value['commented_by']));
        }
        return $arr_comments;
    }

}
