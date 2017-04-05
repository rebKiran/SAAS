<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Location_model extends CI_Model
{
    #function to get newsletter list from the database

    function getStates()
    {
        $this->db->select('id,name');
        $this->db->from('tbl_states');
        $this->db->where('country_id','202');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getData($loadType, $loadId)
    {
        if ($loadType == "state") {
            $fieldList = 'id, name';
            $table = 'tbl_states';
            $fieldName = 'country_id';
            $orderByField = 'name';
        } else {
            $fieldList = 'id,name';
            $table = 'tbl_cities';
            $fieldName = 'state_id';
            $orderByField = 'name';
        }
        $this->db->select($fieldList);
        $this->db->from($table);
        $this->db->where($fieldName, $loadId);
        $this->db->order_by($orderByField, 'asc');
        $query = $this->db->get();
        return $query;
    }

}

?>