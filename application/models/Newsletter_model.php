<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsletter_Model extends CI_Model {
    #function to get newsletter list from the database

    public function getNewsletterDetails() {
        $this->db->select('*');
        $this->db->order_by('newsletter_id', 'DESC');
        $query = $this->db->get(TABLES::$MST_NEWSLETTER);
        return $query->result_array();
    }

    public function getNewsletterDetailById($newsletter_id) {
        $this->db->select('*');
        $this->db->where('newsletter_id', $newsletter_id);
        $query = $this->db->get(TABLES::$MST_NEWSLETTER);
        return $query->result_array();
    }

    function addNewsletterDetails($data) {
        $this->db->insert(TABLES::$MST_NEWSLETTER, $data);
    }

    function updateNewsletterDetails($data, $condition) {
        $this->db->where($condition);
        $this->db->update(TABLES::$MST_NEWSLETTER, $data);
    }

    function getNewsletterDetailsById($id) {
        $this->db->select('*');
        $this->db->where('newsletter_id', $id);
        $query = $this->db->get(TABLES::$MST_NEWSLETTER);
        return $query->result_array();
    }

    function sendNewsletterDetails($data) {
        $this->db->insert('trans_newsletter_send', $data);
    }

    function getAllUsersByStatus($user_status) {
        $this->db->where('user_status', $user_status);
        $query = $this->db->get('mst_users');
        return $query->result_array();
    }

    function addNewsletters($data) {
        $this->db->insert('trans_newsletter', $data);
    }

    function deleteNewsletters($data) {
        $this->db->delete('trans_newsletter', $data);
    }

    function SendNewsletters2($newsletter_id) {

        $this->db->select('mst_news.*,trans_news.*');
        $this->db->from('mst_users as mst_news');
        $this->db->join('trans_newsletter as trans_news', 'mst_news.user_id=trans_news.user_id', 'left');
        if ($newsletter_id != '') { #if edit id not blank passed it will return all records
            $this->db->where("trans_news.newsletter_id", $newsletter_id);
        }


        $result = $this->db->get();
        return $result->result_array();
    }

    public function getNewsletterDetailsbyID2($id, $user_id) {
        $this->db->select('*');

        $this->db->from('trans_newsletter as trans_news');
        if ($id != '') { #if edit id not blank passed it will return all records
            $this->db->where("trans_news.newsletter_id", $id);
        }
        if ($user_id != '') { #if edit id not blank passed it will return all records
            $this->db->where("trans_news.user_id", $user_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    /* Function To Get Newsletter Subscribers List. */

    public function getNewsLetterRegisteredUserListByNewsletterId() {
        $this->db->select('*');
        $this->db->from(TABLES::$ADMIN_USER .' as mu');
        $this->db->where('mu.verified','1');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function getNewsLetterVisitorUserListByNewsletterId() {
        $this->db->select('*');
        $this->db->from(TABLES::$NEWSLETTER_SUBSCRIBER);
        $result = $this->db->get();
        return $result->result_array();
    }

}

?>