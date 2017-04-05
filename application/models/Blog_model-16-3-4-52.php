<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  Class will do all necessary action for blog functionalities
 */

class Blog_Model extends CI_Model
{

    public function getPosts($fields = '', $condition_to_pass = '', $order_by_to_pass = '', $limit_to_pass = '', $debug_to_pass = 0)
    {
        if ($fields == '')
            $fields = "b.*,mu.*";
        $this->db->select($fields, FALSE);
        $this->db->from(TABLES::$MST_BLOG_POSTS . " as b");
        $this->db->join(TABLES::$ADMIN_USER . ' as mu', 'mu.id=b.posted_by', 'left');

        if ($condition_to_pass != '')
            $this->db->where($condition_to_pass);


        if ($order_by_to_pass != '')
            $this->db->order_by($order_by_to_pass);


        if ($limit_to_pass != '')
            $this->db->limit($limit_to_pass);

        $query = $this->db->get();


        if ($debug_to_pass)
            echo $this->db->last_query();

        return $query->result_array();
    }

    public function searchPosts($searchKey)
    {
        $fields = "b.*,(select `url` from " . $this->db->dbprefix('mst_uri_map') . " u where u.rel_id=b.post_id and u.`type`='blog-post') as page_url";
        $this->db->select($fields, FALSE);
        $this->db->from("mst_blog_posts as b");
        $this->db->or_like(array('post_title' => $searchKey, 'post_short_description' => $searchKey, 'post_content' => $searchKey, 'post_tags' => $searchKey));

        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_comment($arr)
    {
        $this->db->insert("trans_blog_comments", $arr);
        return $this->db->insert_id();
    }

    public function update_comment($arr, $condition)
    {
        $this->db->update(TABLES::$TRANS_BLOG_COMMENTS, $arr, $condition);
    }

    public function getPostComments($fields = '', $condition = '', $order = '', $limit = '')
    {
        if ($fields == '')
            $fields = "*";

        $this->db->select($fields, FALSE);

        $this->db->from(TABLES::$TRANS_BLOG_COMMENTS . " as b");

        if ($condition != '')
            $this->db->where($condition);


        if ($order != '')
            $this->db->order_by($order);


        if ($limit != '')
            $this->db->limit($limit);

        $query = $this->db->get();


        return $query->result_array();
    }

    public function insertNewPost($arr)
    {
        $this->db->insert(TABLES::$MST_BLOG_POSTS, $arr);
        return $this->db->insert_id();
    }

    public function updatePost($arr, $condition)
    {
        $this->db->update("mst_blog_posts", $arr, $condition);
    }

    public function deletePost($arr)
    {
        $this->db->delete("mst_blog_posts", $arr);
    }

    public function deleteBlogPost($id)
    {
        $this->db->where("post_id", $id);

        $this->db->delete("mst_blog_posts");
    }

    public function deleteTransBlogPost($id)
    {
        $this->db->where("post_id", $id);
        $this->db->delete("trans_blog_posts");
    }

    public function deletePostComment($arr)
    {
        $this->db->delete("trans_blog_comments", $arr);
    }

    public function getLangValForPost($l, $p)
    {
        $this->db->select("*", FALSE);
        $this->db->from("trans_blog_posts");
        $this->db->where(array("lang_id" => $l, "post_id" => $p));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function updateLanguageValuesForPost($arr_fields, $arr_condition)
    {
        $this->db->update("trans_blog_posts", $arr_fields, $arr_condition);
    }

    public function insertLanguageValuesForPost($arr_fields)
    {
        $this->db->insert("trans_blog_posts", $arr_fields);
    }

    /*
     * START :: Write function which fetches blog to displys on front-end :
     */

    function getAllActiveBlogList($limit = '', $offset = '')
    {
        $lang_id = ($this->session->userdata('language_id') ? $this->session->userdata('language_id') : 17);
        if ($lang_id == "17") {
            $this->db->select("mbp.*,mu.*");
            $this->db->from(TABLES::$MST_BLOG_POSTS . ' as mbp');
            $this->db->join(TABLES::$ADMIN_USER . ' as mu', 'mu.id=mbp.posted_by', 'left');
            $this->db->where('mbp.status', '1');
            $this->db->order_by('mbp.posted_on', 'desc');
        } else {
            $this->db->select("mbp.*,mu.user_name,mu.profile_picture");
            $this->db->from(TABLES::$MST_BLOG_POSTS . ' as mbp');
            $this->db->join(TABLES::$ADMIN_USER . ' as mu', 'mu.id=mbp.posted_by', 'left');
            $this->db->where('mbp.status', '1');
            $this->db->order_by('mbp.posted_on', 'desc');
        }

        if (!$limit == '') {
            $this->db->limit($limit);
        }
        if (!$offset == '') {
            $this->db->offset($offset);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function getAllSearchBlog($search_term, $limit = '', $offset = '')
    {
        $where = "mbp.status='1' AND mbp.post_title like '%" . $search_term . "%' || mbp.post_content like '%" . $search_term . "%'";
        $this->db->select("mbp.*,mu.username");
        $this->db->from(TABLES::$MST_BLOG_POSTS . ' as mbp');
        $this->db->join(TABLES::$ADMIN_USER . ' as mu', 'mu.id=mbp.posted_by', 'left');
        $this->db->where($where);
        $this->db->order_by('mbp.posted_on', 'desc');

        if (!$limit == '') {
            $this->db->limit($limit);
        }
        if (!$offset == '') {
            $this->db->offset($offset);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function getArchiveBlogs($year, $month, $limit = '', $offset = '')
    {
        $where = "mbp.status='1' AND YEAR(mbp.posted_on) = '" . $year . "' AND MONTHNAME(mbp.posted_on) = '" . $month . "'";
        $this->db->select("mbp.*,mu.username");
        $this->db->from(TABLES::$MST_BLOG_POSTS . ' as mbp');
        $this->db->join(TABLES::$ADMIN_USER . ' as mu', 'mu.id=mbp.posted_by', 'left');
        $this->db->where($where);
        $this->db->order_by('mbp.posted_on', 'desc');

        if (!$limit == '') {
            $this->db->limit($limit);
        }
        if (!$offset == '') {
            $this->db->offset($offset);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function getAllActiveBlog($limit = '', $offset = '')
    {
        $lang_id = ($this->session->userdata('language_id') ? $this->session->userdata('language_id') : 17);
//        if ($lang_id == "17") {
        $this->db->select("mbp.*,mu.username");
        $this->db->from(TABLES::$MST_BLOG_POSTS . ' as mbp');
        $this->db->join(TABLES::$ADMIN_USER . ' as mu', 'mu.id=mbp.posted_by', 'left');
        $this->db->where('mbp.status', '1');
        $this->db->order_by('mbp.posted_on', 'desc');
        /* } else {
          $this->db->select("tbp.post_title,tbp.post_content,mbp.post_id,mbp.blog_image,mu.user_name");
          $this->db->from('mst_blog_posts as mbp');
          $this->db->join('mst_users as mu', 'mu.user_id=mbp.posted_by', 'left');
          $this->db->join('trans_blog_posts as tbp', 'mbp.post_id=tbp.post_id', 'left');
          $this->db->where('mbp.status', '1');
          $this->db->order_by('mbp.posted_on', 'desc');
          } */

        if (!$limit == '') {
            $this->db->limit($limit);
        }
        if (!$offset == '') {
            $this->db->offset($offset);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function getBlogDetails($post_id)
    {
        $this->db->select("mbp.*,mu.username as posted_by");
        $this->db->from(TABLES::$MST_BLOG_POSTS . ' as mbp');
        $this->db->join(TABLES::$ADMIN_USER . ' as mu', 'mu.id=mbp.posted_by', 'left');
        $this->db->join(TABLES::$TRANS_BLOG_POSTS . ' as tbp', 'mbp.post_id=tbp.post_id', 'left');
        $this->db->where('mbp.status', '1');
        $this->db->where('mbp.slug', $post_id);
        $this->db->order_by('mbp.posted_on', 'desc');

        $query = $this->db->get();
//        echo $this->db->last_query();
        return $query->result_array();
    }

    function getEditBlogDetails($post_id)
    {
        $lang_id = ($this->session->userdata('language_id') ? $this->session->userdata('language_id') : 17);
        if ($lang_id == "17") {
            $this->db->select("mbp.*,mu.othername");
            $this->db->from('mst_blog_posts as mbp');
            $this->db->join('user as mu', 'mu.id=mbp.posted_by', 'left');
//            $this->db->where('mbp.status', '1');
            $this->db->where('mbp.post_id', $post_id);
            $this->db->order_by('mbp.posted_on', 'desc');
        } else {
            $this->db->select("tbp.post_title,tbp.post_content,mbp.post_id,mbp.blog_image,mu.user_name");
            $this->db->from('mst_blog_posts as mbp');
            $this->db->join('mst_users as mu', 'mu.user_id=mbp.posted_by', 'left');
            $this->db->join('trans_blog_posts as tbp', 'mbp.post_id=tbp.post_id', 'left');
//            $this->db->where('mbp.status', '1');
            $this->db->where('mbp.post_id', $post_id);
            $this->db->order_by('mbp.posted_on', 'desc');
        }
        $query = $this->db->get();
        return $query->result_array();
    }

//    public function getArchiveDates()
//    {
//        $query = $this->db->query("SELECT Year(posted_on) as year, MONTHNAME(posted_on) as month FROM tbl_mst_blog_posts group by year, month ORDER BY posted_on DESC");
////        $query = $this->db->get();
//        return $query->result_array();
//    }

    public function getArchiveDates()
    {
        $this->db->select('Year(posted_on) as year, MONTHNAME(posted_on) as month,post_id,post_title');
        $this->db->where('status', '1');
        $this->db->order_by("YEAR(posted_on)", "desc");
        $this->db->order_by("MONTH(posted_on)", "desc");
        $this->db->group_by(array("year", "month"));
        $query = $this->db->get('tbl_mst_blog_posts');

        $magarchive = array();

        if ($results = $query->result()) {
            foreach ($results as $result) {
//                if (!isset($mag[$result->year])) {
//                    $magarchive[$result->year] = array();
//                }

                $magarchive[$result->year][] = $result;
            }
        }

        return $magarchive;
    }

}
