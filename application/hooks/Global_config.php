<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_config
{

    private $CI;

    function load_config()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('common_model');
        $config_data = $this->global_setting = $this->CI->common_model->getGlobalSettings();
        return $config_data;
    }

    

}
