<?php

include ("myLdap/MyLdap.php");

class Home_model extends MY_Model {

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
	
	public function authenticate($email,$password)
	{
		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}
		
		$result = false;
		$password = '{SHA}' . base64_encode(sha1($password, TRUE));
		$employees = $this->myldap->user()->getAll_user(); 
		
		
		foreach ($employees as $k => $employee)
		{
			if (!is_array($employee)) continue; 
			if($email == $employee["mail"][0])
			{
				if($password == $employee["userpassword"][0])
					$result = true;
			}
		}
		
		$data = array("result"=>$result,"username"=>$employee["uid"][0],"email"=>$employee["mail"][0]);
		return $data;
	}
	
	
	
	
}