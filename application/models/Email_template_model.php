<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Email_Template_Model extends CI_Model {  

	/*
         * Function to get all email templates from email template table 
         * 
         */
	public function getEmailTemplateDetails()
	{	
		$this->db->select('*');
		$this->db->from(TABLES::$EMAIL_TEMPLATE .' as email');
                $this->db->where('email.status','Active');
		$result = $this->db->get();
		return $result->result_array();
	}	
	/*
         *  function to get  email templates from email template table by using id 
         */
	public function getEmailTemplateDetailsById($email_template_id='')
	{	
		$this->db->select('*');
		$this->db->from(TABLES::$EMAIL_TEMPLATE);
                $this->db->where('email_template_id',$email_template_id);
		$result = $this->db->get();
		return $result->result_array();
	}	
	/*
         * function to update  email templates  by using id 
        */
	public function updateEmailTemplateDetailsById($email_template_id='',$data)
	{	
		$this->db->where('email_template_id',$email_template_id);
                $this->db->update(TABLES::$EMAIL_TEMPLATE .' as email',$data);
		
	}	
}
