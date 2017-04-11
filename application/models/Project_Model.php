<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *  Class will do all necessary action for blog functionalities
 */

class Project_Model extends CI_Model
{

    public function getProjectCategories()
    {
        $this->db->select('category_id,category_name');
        $this->db->from(TABLES::$PROJECT_CATEGORY);
        $this->db->where('status', '1');
        $query = $this->db->get();
        $row = $query->result();
        return $row;
    }

    public function saveProjectModel($cover_image, $media_file, $post)
    {
        $username = $this->session->userdata['user_account']['username'];
        $user_id = $this->session->userdata['user_account']['user_id'];

        $project_title = $post['project_title'];
        $short_description = $post['short_description'];
        $project_media = $post['project_media'];
        $project_category = $post['cat_id'];
        $project_description = $post['project_description'];
        $slug = $project_title . '.html';

        $data = array("project_title" => $project_title,
            "short_description" => $short_description,
            "cover_image" => $cover_image,
            "media_type" => $project_media,
            "user_id" => $user_id,
            "added_by" => $username,
            "project_category" => $project_category,
            "project_media" => $media_file,
            "project_description" => $project_description,
            "slug" => $slug,
        );


        $this->db->insert('tbl_mst_projects', $data);
        $project_id = $this->db->insert_id();

        if ($project_id != 0) {
            $session['msg'] = "Project Saved Successfully";
            $this->session->set_userdata($session);
        } else {
            $session['error'] = "Project Not Added Due TO Error";
            $this->session->set_userdata($session);
        }

        return $project_id;
    }

    public function getProjectListModelForUser($user_id)
    {
        $this->db->select('a.project_id,a.project_title,a.project_category,a.created_date,b.category_name');
        $this->db->from('tbl_mst_projects as a');
        $this->db->join('tbl_mst_project_categories as b', 'a.project_category=b.category_id', 'inner');
        $this->db->where('a.user_id', $user_id);
        $query = $this->db->get();
        $row = $query->result();
        return $row;
    }

    public function getProjectDetails($project_id)
    {
        $this->db->select('a.project_id,a.user_id,a.project_title,a.project_category,a.created_date,a.short_description,a.cover_image,a.media_type,a.project_media,a.project_description,b.category_name');
        $this->db->from('tbl_mst_projects as a');
        $this->db->join('tbl_mst_project_categories as b', 'a.project_category=b.category_id', 'inner');
        $this->db->where('a.project_id', $project_id);
        $query = $this->db->get();
        $row = $query->row();
        return $row;
    }

    public function getProjectFindingDetails($project_id)
    {
        $this->db->select('b.*');
        $this->db->from('tbl_mst_projects as a');
        $this->db->join('tbl_mst_project_donation as b', 'a.project_id = b.project_id', 'inner');
        $this->db->where('a.project_id', $project_id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function getProjectFund($project_id)
    {
        $this->db->select('sum(a.price) as total,count(a.project_id) as cnt_records');
        $this->db->from('tbl_mst_project_donation  a');
        $this->db->where('a.project_id', $project_id);
        $this->db->group_by('a.project_id');
        $query = $this->db->get();

        $row = $query->row();
        return $row;
    }

    public function getProjectOffers($project_id)
    {
        $this->db->select('offer_id,price,offers');
        $this->db->from('tbl_mst_project_offers');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function saveProjectOffers($post)
    {
        $project_id = $post['project_id'];
        $price = $post['price'];
        $offers = $post['offers'];
        $count = count($offers);

        // Deleting the previous all entries

        $this->db->where('project_id', $project_id);
        $this->db->delete('tbl_mst_project_offers');

        // Now Entrieng all new values

        for ($i = 0; $i < $count; $i++) {
            $data = array("project_id" => $project_id,
                "offers" => $offers[$i],
                "price" => $price[$i],
            );

            $this->db->insert('tbl_mst_project_offers', $data);
        }

        $session['msg'] = "Offers Saved Successfully";
        $this->session->set_userdata($session);
        return true;
    }

    function getAllProjects($pg, $cat, $search)
    {

        $this->db->select("mbp.*");
        if (!empty($search)) {
            $this->db->like('mbp.project_title', "$search");
        }
        $this->db->from('tbl_mst_projects as mbp');
        $this->db->order_by('mbp.created_date', 'desc');

        if (!empty($cat) && 'cat' == $pg) {
            $this->db->where('mbp.project_category', $cat);
        }
        // $this->db->where('mbp.status', '1');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getProjectsListByFund($user_id)
    {

        $this->db->select("mbp.project_id,mbp.user_id, mbp.project_title, IF(sum(b.price) ,sum(b.price), 0) as amount, max(b.created_date) as created_date");

        $this->db->from('tbl_mst_projects as mbp');
        $this->db->join('tbl_mst_project_donation as b', 'mbp.project_id=b.project_id');
        $this->db->where('b.user_id', $user_id);
        $this->db->group_by('mbp.project_id');
        $this->db->order_by('b.created_date', 'desc');


        // $this->db->where('mbp.status', '1');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function getConnectedUsersToProjects($userid)
    {
        $this->db->select('u.*');
        $this->db->from('tbl_users as u');
        $this->db->where('id', $userid);
        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }
    
    public function isConnected($projectid,$userid){        
        $this->db->select('u.*');
        $this->db->from('tbl_user_project_connection_mapping as u');
        $this->db->where('u.user_id', $userid);
        $this->db->where('u.project_id', $projectid);
        $query = $this->db->get();
        $num = $query->num_rows();
        if($num > 0){
            return 'true'; 
        }else{
            return 'false';
        }
    }

}
