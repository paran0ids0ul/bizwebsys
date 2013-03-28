<?php

include ("myLdap/MyLdap.php");

class Contacts_model extends MY_Model {


	protected $myldap = false;

	public function __construct()
	{
		$this->load->database();
		
		require_once('myLdap/MyLdap.php');
		
		try {
			global $myldap;
			$myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}
		
	}
	
	public function get_ldap() {
		
		global $myldap;
		return $myldap;
	}
	
	public function get_all_contact() {
		
		global $myldap;
		$results = $myldap->user()->getAll_contacts();	
		return $results;
		
	}
	
	public function get_contact_list()
	{
		
		$query = $this->db->get('Contact');
		return $query->result_array();
		
	}
	
	public function set_item() 
	{
				
		$this->db->insert('Contact', NULL);

		$id = $this->db->insert_id();
		
		return $id;
	
	}
	
	
		
	
	
}