<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Global_Setting extends MX_Controller
{

    /**
     * constructor used to load all the models used in the controller.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('global_setting_model');
        $this->load->model('common_model');
        $this->global_setting = $this->common_model->getGlobalSettings();
    }

    /**
     * Function to list all the global setteings parameter
     */
    public function listGlobalSettings()
    {
        /* checking admin is logged in or not */
         if (!$this->common_model->isLoggedIn()) {
          redirect(base_url() . "admin/login");
          } 
        $data = $this->common_model->commonFunction();
         if ($data['user_account']['role_id'] != 1) {
          $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to manage global settings!</span>");
          redirect(base_url() . "admin/dashboard");
          } 
        $data['arr_global_settings'] = $this->global_setting_model->getGlobalSettingsGlobal('');
        $this->template->set('arr_global_settings', $data['arr_global_settings']);
        $this->template->set('page', 'global_setting');
        $this->template->set('global', $data['arr_global_settings']);
        $this->template->set_theme('default_theme');
        $this->template->set_layout('backend')
                ->title($this->global_setting['site_title'] . ' | Administrator Control Panel')
                ->set_partial('header', 'partials/header')
                ->set_partial('sidebar', 'partials/sidebar')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('global-setting/globle_setting_list');
    }

    /**
     * Function to edit global setteings parameter
     * 
     * @param string $edit_id
     */
    public function editGlobalSettings($edit_id = '')
    {
        /* checking admin is logged in or not */
        /* if (!$this->common_model->isLoggedIn()) {
          redirect(base_url() . "backend/login");
          }
          /* getting commen data required */
        $data = $this->common_model->commonFunction();

        /* checking user has privilige for the global settings */
        /* if ($data['user_account']['role_id'] != 1) {
          $this->session->set_userdata("msg", "<span class='error'>You doesn't have priviliges to manage global settings!</span>");
          redirect(base_url() . "backend/home");
          } */
        if ($this->input->post()) {
            if ($this->input->post('edit_id') != '') {
                $arr_to_update = array(
                    "value" => $this->input->post('value')
                );
                /* condition to update record	 */
                $condition_array = array('global_name_id' => intval(base64_decode($this->input->post('edit_id'))));

                /* updating the global setttings parameter value into database */
                $this->common_model->updateRow(TABLES::$TRANS_GLOBAL_SETTING, $arr_to_update, $condition_array);

                /* updating the global settings to the file for the default language English */
                $file_name = "global-settings";
                $fp = fopen($data['absolute_path'] . "application/config/" . $file_name, "w+");
                $global_setting_arr = $this->common_model->getGlobalSettings(17);
                fwrite($fp, serialize($global_setting_arr));
                fclose($fp);

                /* setting session for displaying notication message. */
                $this->session->set_userdata("msg", "<span class='success'>Global setting parameter updated successfully!</span>");
            }
            /* redirecting to global settings list */
            redirect(base_url() . "admin/global-setting");
        }
        //$data['arr_active_admin_details'] = $this->common_model->getRecords('mst_users', '', array('user_type' => '1', 'user_status' => '1'));

        if (($edit_id != '')) {
            $arr_global_settings = $this->global_setting_model->getGlobalSettingsGlobal(intval(base64_decode($edit_id)));
            /* single row fix */
            $data['arr_global_settings'] = end($arr_global_settings);
            $this->template->set('arr_global_settings', $data['arr_global_settings']);
            $this->template->set('edit_id', $edit_id);
             $this->template->set('page', 'global_setting');
            $this->template->set_theme('default_theme');
            $this->template->set_layout('backend')
                    ->title('vCard | Administrator control panel')
                    ->set_partial('header', 'partials/header')
                    ->set_partial('sidebar', 'partials/sidebar')
                    ->set_partial('footer', 'partials/footer');
            $this->template->build('global-setting/globle_setting_edit');
        } else {
            
        }
    }

}
