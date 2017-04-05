<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Location_model");
    }

    public function loadData()
    {
        $loadType = $_POST['loadType'];
        $loadId = $_POST['loadId'];
        $result = $this->Location_model->getData($loadType, $loadId);
        $HTML = "";

        if ($result->num_rows() > 0) {
            foreach ($result->result() as $list) {
                $HTML.="<option value='" . $list->id . "'>" . $list->name . "</option>";
            }
        }
        echo $HTML;
    }

   
}
