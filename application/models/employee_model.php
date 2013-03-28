<?php

include ("myLdap/MyLdap.php");

class Employee_model extends MY_Model {


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
	
	public function get_all_employee() {
		
		global $myldap;
		$results = $myldap->user()->getAll_people(); 	
		return $results;
		
	}
	
	
	
	
		
	
	
}