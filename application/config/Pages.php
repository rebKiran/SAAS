<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->global_setting = $this->common_model->getGlobalSettings();
    }

    /*
     * Load view for homepage
     */

    public function home() {
        $this->template->set('page', 'home');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Home | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('homepage');
    }
	
	/*
     * Load view for About us
     */
	public function aboutUs() {
        $this->template->set('page', 'aboutUs');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('About Us | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('aboutUs');
    }
	
	/*
     * Load view for Contact us
     */
	public function contactUs() {
        $this->template->set('page', 'contactUs');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Contact us | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('contactUs');
    }
	
	
	/*
     * Load view for Blog
     */
	public function blog() {
        $this->template->set('page', 'blog');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Blogs | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('blog');
    }
	
	/*
     * Load view for Research page
     */
	public function researchPage() {
        $this->template->set('page', 'researchPage');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Research Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('researchPage');
    }
	
	/*
     * Load view for Management Consulting page
     */
	public function managementPage() {
        $this->template->set('page', 'managementPage');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Management Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('managementPage');
    }
	
	public function managementExpertisePage() {
        $this->template->set('page', 'management-expertise');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Management Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('management-expertise');
    }
	
	public function managementindustry() {
        $this->template->set('page', 'management-industry');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Management Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('management-industry');
    }
	/*
     * Load view for Management Consulting page
     */
	public function engineeringPage() {
        $this->template->set('page', 'engineeringPage');
        $this->template->set_theme('default_theme');
        $this->template->set_layout('frontend')
                ->title('Engineering Page | ' . $this->global_setting['site_title'])
                ->set_partial('header', 'partials/header')
                ->set_partial('footer', 'partials/footer');
        $this->template->build('engineeringPage');
    }

}
