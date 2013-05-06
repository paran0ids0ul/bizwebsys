<?php

class Employee_model extends MY_Model {


	protected $myldap;

	public function __construct()
	{
		$this->load->database();

		$this->load->library('MyLdap');
		
	}

	public function close_ldap() {

		ldap_close($this->myldap->getLdapConnection());

	}
	
	public function get_ldap() {
	
		return $this->myldap;
	}
	
	public function new_employee_id_db() 
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

		$user['objectClass'][0] = 'inetOrgPerson';
		$user['objectClass'][1] = 'organizationalPerson';
		$user['objectClass'][2] = 'person';
		$user['objectClass'][3] = 'top';	
		$user['employeeNumber'] = $attributes['employeeNumber'];
		$user['uid'] = $attributes['uid'];
		$user['userPassword'] = $attributes['userPassword'];
		$user['sn'][0] = $attributes['sn'];
		$user['cn'][0] = $attributes['cn'];
		$user['givenName'][0] = $attributes['givenName'];
		$user['mail'][0] = $attributes['mail'];
		if ($attributes['homePhone']) {	$user['homePhone'][0] = $attributes['homePhone'];	}
		if ($attributes['mobile']) { $user['mobile'][0] = $attributes['mobile']; }
		if ($attributes['l']) { $user['l'][0] = $attributes['l']; }
		if ($attributes['postalAddress']) { $user['postalAddress'][0] = $attributes['postalAddress']; }
		if ($attributes['postalCode']) { $user['postalCode'][0] = $attributes['postalCode']; }
		if ($attributes['jpegPhoto']) { $user['jpegPhoto'][0] = $attributes['jpegPhoto']; }
		if ($attributes['title']) { $user['title'][0] = $attributes['title']; }
		
		$result = ldap_add($this->myldap->getLdapConnection(), 'uid=' . $user['uid'] . ',ou=people,dc=bizwebsys,dc=tk', $user);   
	    
	    if ($result != true) { 
            return false; 
        }

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



		$result = ldap_search($this->myldap->getLdapConnection(),"ou=people,dc=bizwebsys,dc=tk", "(uid=".$uid.")") or die ("Error in search query"); 

	    $entry = ldap_first_entry($this->myldap->getLdapConnection(), $result);
	    
	    if ($entry != false) {

	    	$employee = ldap_get_attributes($this->myldap->getLdapConnection(), $entry);

	    	if ($employee != false) {

				$dt['uid'] = $employee['uid'][0];
				$dt['cn'] = $employee['cn'][0];
				$dt['sn'] = $employee['sn'][0];
		 		$dt['mail'] = $employee['mail'][0];
		 		$dt['employeeNumber'] = array_key_exists("employeeNumber",$employee) ? $employee['employeeNumber'][0] : NULL;
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

	    }

	    return false;		

	}


	public function get_admin() 
	{

		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$result = ldap_search($this->myldap->getLdapConnection(),"ou=groups,dc=bizwebsys,dc=tk", "(cn=admins)") or die ("Error in search query"); 

	    $entry = ldap_first_entry($this->myldap->getLdapConnection(), $result);


	    if ($entry != false) {

	    	$employee = ldap_get_attributes($this->myldap->getLdapConnection(), $entry);

	    	if ($employee != false) {
				if (array_key_exists("uniqueMember", $employee)) {
					for ($y = 0 ; $y < $employee['uniqueMember']['count'] ; $y++) {
						$admin[$y] = $employee['uniqueMember'][$y];
					}

					return $admin;
				}

			}
	    	
	    }

	    return false;

	}

    // HoraceLi 8/4/2013
    public function employee_list($single_attr = '')
    {

        $raw_employee_list = $this->employee_model->get_ldap_employee_list();

        if ($single_attr === ''){
            return $raw_employee_list;
        } else {
            // Generates custom assoc array with employeenumber as key and single attribute as value (e.g. /employee/employee_list/cn)
            $employee_list = array();
            foreach ($raw_employee_list as $employee){
                if((isset($employee[$single_attr]) && $employee[$single_attr]['count'] > 0) && (isset($employee['employeenumber']) && $employee['employeenumber']['count'] > 0)){
                    $employee_list[$employee['employeenumber'][0]] = $employee[$single_attr][0];
                }
            }
            return $employee_list;
        }
    }

    // HoraceLi 8/4/2013
    public function get_ldap_employee_list() {

        return $this->get_all_employee();

    }

	public function get_all_employee() {
		
		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}


		$result = ldap_search($this->myldap->getLdapConnection(),"ou=people,dc=bizwebsys,dc=tk", "(cn=*)") or die ("Error in search query"); 
	    
	    $info = ldap_get_entries($this->myldap->getLdapConnection(), $result);
	    
	    return $info;
		
	}

    // HoraceLi 8/4/2013
    public function get_employee_list()
    {
        // primary data source is DB
        $query = $this->db->get('Employee');
        return $query->result_array();

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




		//getting the record of current employee. if the username is modified. rename record (next 6 stmts)
		$result = ldap_search($this->myldap->getLdapConnection(),"ou=people,dc=bizwebsys,dc=tk", "(uid=".$id.")") or die ("Error in search query"); 

	    $entry = ldap_first_entry($this->myldap->getLdapConnection(), $result);
	    
	    $info = ldap_get_attributes($this->myldap->getLdapConnection(), $entry);

	    $newID = $attributes['uid'];

	    if ($info['uid'][0] != $newID)
	    {
	    	ldap_rename($this->myldap->getLdapConnection(),'uid='.$id.',ou=people,dc=bizwebsys,dc=tk', 'uid='.$newID, NULL, TRUE);
	    }

	    $update['sn'][0] = $attributes['sn']; 
	    $update['cn'][0] = $attributes['cn'];
	    if ($attributes['userPassword']) {	$update['userPassword'][0] = $attributes['userPassword']; }
	    $update['givenName'][0] = $attributes['givenName'];
	    if ($attributes['mail']) {	$update['mail'][0] = $attributes['mail']; }


	    if (array_key_exists("homePhone",$info)) {
	    	if ($attributes['homePhone']) {
	    		$update['homePhone'][0] = $attributes['homePhone']; 
	    	} else {
	    		$remove['homePhone'] = array();
	    	}
	    } else {
	    	if ($attributes['homePhone']) {	$add['homePhone'][0] = $attributes['homePhone']; }
	    }

	    if (array_key_exists("jpegPhoto",$info)) {
	    	if ($attributes['jpegPhoto'])
	    	{
	    		$update['jpegPhoto'][0] = $attributes['jpegPhoto']; 
	    	}
	    } else {
	    	if ($attributes['jpegPhoto']) {	$add['jpegPhoto'][0] = $attributes['jpegPhoto']; }
	    }

	    if (array_key_exists("mobile",$info)) {
	    	if ($attributes['mobile']) {
	    		$update['mobile'][0] = $attributes['mobile']; 
	    	} else {
	    		$remove['mobile'] = array();
	    	}
	    } else {
	    	if ($attributes['mobile']) {	$add['mobile'][0] = $attributes['mobile']; }
	    }

	    if (array_key_exists("l",$info)) {
	    	if ($attributes['l']) {
	    		$update['l'][0] = $attributes['l']; 
	    	} else {
	    		$remove['l'] = array();
	    	}
	    } else {
	    	if ($attributes['l']) {	$add['l'][0] = $attributes['l']; }
	    }

	    if (array_key_exists("postalCode",$info)) {
	    	if ($attributes['postalCode']) {
	    		$update['postalCode'][0] = $attributes['postalCode']; 
	    	} else {
	    		$remove['postalCode'] = array();
	    	}
	    } else {
	    	if ($attributes['postalCode']) {	$add['postalCode'][0] = $attributes['postalCode']; }
	    }

	    if (array_key_exists("postalAddress",$info)) {
	    	if ($attributes['postalAddress']) {
	    		$update['postalAddress'][0] = $attributes['postalAddress']; 
	    	} else {
	    		$remove['postalAddress'] = array();
	    	}
	    } else {
	    	if ($attributes['postalAddress']) {	$add['postalAddress'][0] = $attributes['postalAddress']; }
	    }

	    if (array_key_exists("title",$info)) {
	    	if ($attributes['title']) {
	    		$update['title'][0] = $attributes['title']; 
	    	} else {
	    		$remove['title'] = array();
	    	}
	    } else {
	    	if ($attributes['title']) {	$add['title'][0] = $attributes['title']; }
	    }


		$result1 = ldap_modify($this->myldap->getLdapConnection(),'uid='.$newID.',ou=people,dc=bizwebsys,dc=tk', $update);
		$result2 = true;
		if (isset($add)) { $result2 = ldap_mod_add($this->myldap->getLdapConnection(), "uid=".$newID.",ou=people,dc=bizwebsys,dc=tk", $add); }
		$result3 = true;
		if (isset($remove)) { $result3 = ldap_mod_del($this->myldap->getLdapConnection(), "uid=".$newID.",ou=people,dc=bizwebsys,dc=tk", $remove); } 

	    if ($result1 != true || $result2 != true || $result3 != true) { 
            return false; 
        }
        
		return $newID;

	}
	

	public function delete_employee($uid,$idnum) {
		
		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$result = ldap_delete($this->myldap->getLdapConnection(), 'uid=' .$uid. ',ou=people,dc=bizwebsys,dc=tk');   
	    
	    if ($result != true) { 
            return false; 
        }

        $this->db->where('EmployeeID', $idnum);
		$this->db->delete('Employee');
        
        return true;

	}
	
	
		
	
	
}