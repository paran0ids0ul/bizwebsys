<?php


class Home_model extends MY_Model {

	protected $myldap;

	public function __construct()
	{
		$this->load->database();

		$this->load->library('MyLdap');

		$this->load->model('employee_model');
		
		
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
		$email="";
		$employee_id="";
		$is_admin = false;
		$password = '{SHA}' . base64_encode(sha1($password, TRUE));
		$employees = $this->employee_model->get_all_employee(); 
		
		foreach ($employees as $k => $employee)
		{
			if (!is_array($employee)) continue; 
			if($username == $employee["uid"][0])
			{
				if($password == $employee["userpassword"][0])
				{
					$result = true;
					$username = $employee["uid"][0];
					$email = $employee["mail"][0];
					$employee_id = $employee["employeenumber"][0];
				}
			}
		}
		
		$data = array("result"=>$result,"username"=>$username,"email"=>$email,"employee_id"=>$employee_id);
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

		$employee = $this->employee_model->get_admin();
		$result = false;
		if ($employee != false) {
				foreach($employee as $e) {
					
					$pos = strpos($e, ',');
					$e_uid = substr($e, 4, $pos-4); 
					if($e_uid == $uid)
					{
						$result = true;
						break;
					}
				}
		}
		return $result;
	}

	public function check_email($email)
	{
		$uid = null;
		$employees = $this->employee_model->get_all_employee(); 
		foreach ($employees as $k => $employee)
		{
			if (!is_array($employee)) continue; 
			if($email == $employee["mail"][0])
			{
				$uid = $employee["uid"][0];
			}
		}
		return $uid;
	}
	
	public function reset_password($id,$new_pwd)
	{
		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}
		
		$result = ldap_search($this->myldap->getLdapConnection(),"ou=people,dc=bizwebsys,dc=tk", "(uid=".$id.")") or die ("Error in search query"); 

	    $entry = ldap_first_entry($this->myldap->getLdapConnection(), $result);
	    
	    $info = ldap_get_attributes($this->myldap->getLdapConnection(), $entry);
		
		$new_pwd = '{SHA}' . base64_encode(sha1($new_pwd, TRUE));
		
		$update['userPassword'][0] = $new_pwd;
		
		$result = ldap_modify($this->myldap->getLdapConnection(),'uid='.$id.',ou=people,dc=bizwebsys,dc=tk', $update);
		
		return $result;
	}
	
	public function change_password($id,$new_pwd,$old_pwd)
	{
		$auth = $this->authenticate($id,$old_pwd);
		if($auth["result"])
		{
			if($this->reset_password($id,$new_pwd))
				return "true";
			else
				return "false";
		}
		
		return "fail";
			
	}
}