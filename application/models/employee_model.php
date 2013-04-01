<?php

include ("myLdap/MyLdap.php");

class Employee_model extends MY_Model {


	protected $myldap = false;

	public function __construct()
	{
		$this->load->database();
		
		require_once('myLdap/MyLdap.php');
		
	}

	public function close_ldap() {

		ldap_close($this->myldap->getLdapConnection());

	}
	
	public function get_ldap() {
	
		return $this->myldap;
	}
	
	public function new_employeeID_db() 
	{
		$this->db->insert('Employee', array('EmployeeID' => NULL) );

		$id = $this->db->insert_id();

		return $id;
	
	}

	public function new_employee($id,$jpegStr)
	{
		

		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$this->load->helper('url');

		$uid = $this->input->post('employee_uname');

		$password = $uid .'123';			// default password e.g. horaceli123 - change this if you want
	
		$userPassword = '{SHA}' . base64_encode(sha1($password, TRUE));		// encodes the password in a hash
	
		$attributes = array(
			'uid' => $uid,
			'sn' => $this->input->post('employee_sname'),
			'cn' => $this->input->post('employee_cname'),
			'givenName' => $this->input->post('employee_fname'),
			'employeeNumber' => $id,
			'homePhone' => $this->input->post('employee_homephone'),
			'mobile' => $this->input->post('employee_mobile'),
			'l' => $this->input->post('employee_country'),
			'postalAddress' => $this->input->post('employee_paddress'),
			'postalCode' => $this->input->post('employee_postcode'),
			'jpegPhoto' => $jpegStr,
			'mail' => $this->input->post('employee_email'),
			'title' => $this->input->post('employee_title'),
			'userPassword' => $userPassword
		);

		$this->myldap->user()->create_user($attributes);

		return $uid;
	}

	public function get_employee($uid) 
	{

		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$employee = $this->myldap->user()->getUser_byID($uid);

		$dt['uid'] = $employee['uid'][0];
		$dt['cn'] = $employee['cn'][0];
		$dt['sn'] = $employee['sn'][0];
 		$dt['mail'] = $employee['mail'][0];
 		$dt['gn'] = array_key_exists("givenName",$employee) ? $employee['givenName'][0] : NULL;
		$dt['homephone'] = array_key_exists("homePhone",$employee) ? $employee['homePhone'][0] : NULL;
		$dt['mobile'] = array_key_exists("mobile",$employee) ? $employee['mobile'][0] : NULL;
		$dt['l'] = array_key_exists("l",$employee) ? $employee['l'][0] : NULL;
		$dt['jpeg'] =  array_key_exists("jpegPhoto",$employee) ? $employee['jpegPhoto'][0] : NULL;
		$dt['paddress'] = array_key_exists("postalAddress",$employee) ? $employee['postalAddress'][0] : NULL;
		$dt['postalCode'] = array_key_exists("postalCode",$employee) ? $employee['postalCode'][0] : NULL;
		$dt['jobtitle'] = array_key_exists("title",$employee) ? $employee['title'][0] : NULL;

		return $dt;

	}


	public function get_all_employee() {
		
		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$results = $this->myldap->user()->getAll_user(); 	
		return $results;
		
	}
	


	public function update_employee($id,$jpegStr) 
	{

		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$this->load->helper('url');
		
	
		$uid = $this->input->post('employee_uname');

		$password = $this->input->post('employee_password');		// default password e.g. horaceli123 - change this if you want
		
		$attributes = array(
			'uid' => $uid,
			'sn' => $this->input->post('employee_sname'),
			'cn' => $this->input->post('employee_cname'),
			'givenName' => $this->input->post('employee_fname'),
			'homePhone' => $this->input->post('employee_homephone'),
			'mobile' => $this->input->post('employee_mobile'),
			'l' => $this->input->post('employee_country'),
			'postalAddress' => $this->input->post('employee_paddress'),
			'postalCode' => $this->input->post('employee_postcode'),
			'jpegPhoto' => $jpegStr,
			'mail' => $this->input->post('employee_email'),
			'title' => $this->input->post('employee_title'),
			//'userPassword' => $userPassword
		);

		if ($password) {
			$attributes['userPassword'] = '{SHA}' . base64_encode(sha1($password, TRUE));		// encodes the password in a hash
		} else {
			$attributes['userPassword'] = $password;
		}

		$this->myldap->user()->update_employee($attributes,$id);

		return $uid;
	}
	
	
	
		
	
	
}