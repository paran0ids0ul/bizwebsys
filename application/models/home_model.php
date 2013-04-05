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
	
	public function authenticate($username,$password)
	{
		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}
		
		$result = false;
		$is_admin = false;
		$password = '{SHA}' . base64_encode(sha1($password, TRUE));
		$employees = $this->myldap->user()->getAll_user(); 
		
		
		foreach ($employees as $k => $employee)
		{
			if (!is_array($employee)) continue; 
			if($username == $employee["uid"][0])
			{
				if($password == $employee["userpassword"][0])
				{
					$result = true;
				}
			}
		}
		
		$data = array("result"=>$result,"username"=>$employee["uid"][0],"email"=>$employee["mail"][0]);
		return $data;
	}
	

	
	public function is_admin($uid) 
	{

		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$employee = $this->myldap->user()->get_admin();
        $result = false;
		if ($employee != false) {
			if (array_key_exists("uniqueMember", $employee)) {
				for ($y = 0 ; $y < $employee['uniqueMember']['count'] ; $y++) {
					$e = $employee['uniqueMember'][$y];
					$pos = strpos($e, ',');
					$e_uid = substr($e, 4, $pos-4); 
					if($e_uid == $uid)
					{
						$result = true;
						break;
					}
				}
			}
		}
		
		return $result;
	}

	
}