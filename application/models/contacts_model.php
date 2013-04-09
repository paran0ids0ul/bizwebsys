<?php


class Contacts_model extends MY_Model {


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

    // HoraceLi 8/4/2013
    public function contact_list($single_attr = ''){

        $raw_contact_list = $this->contacts_model->get_ldap_contact_list();

        if ($single_attr === ''){
            return $raw_contact_list;
        } else {
            // Generates custom assoc array with uid as key and single attribute as value (e.g. /contacts/contact_list/cn)
            $contact_list = array();
            foreach ($raw_contact_list as $contact){
                if(isset($contact[$single_attr]) && $contact[$single_attr]['count'] > 0){
                    $contact_list[$contact['uid'][0]] = $contact[$single_attr][0];
                }
            }
            return $contact_list;
        }
    }

    // Added HoraceLi 7/4/2013 alternative to 'get_all_contact'
    public function get_ldap_contact_list() {

        return $this->get_all_contact();

    }


    public function get_contact_list()
    {
        // primary data source is DB
        $query = $this->db->get('Contact');
        return $query->result_array();

    }


	public function get_all_contact() {
		
		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();
		}


		$result = ldap_search($this->myldap->getLdapConnection(),"ou=contacts,dc=bizwebsys,dc=tk", "(cn=*)") or die ("Error in search query");
	    
	    $info = ldap_get_entries($this->myldap->getLdapConnection(), $result);
	    
	    return $info;
		
	}
	

	public function get_contact($id) 
	{

		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}


		$result = ldap_search($this->myldap->getLdapConnection(),"ou=contacts,dc=bizwebsys,dc=tk", "(uid=".$id.")") or die ("Error in search query"); 

	    $entry = ldap_first_entry($this->myldap->getLdapConnection(), $result);

	    if ($entry != false) {

	    	$contact = ldap_get_attributes($this->myldap->getLdapConnection(), $entry);

	    	if ($contact != NULL) {

				$dt['uid'] = $contact['uid'][0];
				$dt['cn'] = $contact['cn'][0];
				$dt['sn'] = $contact['sn'][0];
		 		$dt['gn'] = array_key_exists("givenName",$contact) ? $contact['givenName'][0] : NULL;
				$dt['facs'] = array_key_exists("facsimileTelephoneNumber",$contact) ? $contact['facsimileTelephoneNumber'][0] : NULL;
				$dt['tel'] = array_key_exists("telephoneNumber",$contact) ? $contact['telephoneNumber'][0] : NULL;
				$dt['mob'] = array_key_exists("mobile",$contact) ? $contact['mobile'][0] : NULL;
				$street = array_key_exists("street",$contact) ? $contact['street'][0] : NULL;
				if ($street != NULL) {
					$street1and2 = explode("$", $street);
					$dt['street1'] = $street1and2[0];
					$dt['street2'] = is_null($street1and2[1]) ? NULL : $street1and2[1];
				}
				else {
					$dt['street1'] = NULL;
					$dt['street2'] = NULL;	
				}
				$dt['jpeg'] =  array_key_exists("jpegPhoto",$contact) ? $contact['jpegPhoto'][0] : NULL;
				$dt['st'] = array_key_exists("st",$contact) ? $contact['st'][0] : NULL;
				$dt['l'] = array_key_exists("l",$contact) ? $contact['l'][0] : NULL;
				$dt['postalCode'] = array_key_exists("postalCode",$contact) ? $contact['postalCode'][0] : NULL;
				$dt['postalAddress'] = array_key_exists("postalAddress",$contact) ? $contact['postalAddress'][0] : NULL;
				$dt['mail'] = array_key_exists("mail",$contact) ? $contact['mail'][0] : NULL;
				$dt['o'] = array_key_exists("o",$contact) ? $contact['o'][0] : NULL;

				return $dt;

			}


	    }
	    return false;




		

	}
	
	public function new_contact_id_db() 
	{
		$this->db->insert('Contact', array('ContactID' => NULL) );

		$id = $this->db->insert_id();

		return $id;
	
	}

	public function new_contact($id,$jpegStr)
	{
		

		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$this->load->helper('url');

		$hStreet1 = $this->input->post('contact_hstreet1');
		$hStreet2 = $this->input->post('contact_hstreet2');

		$hStreet = $hStreet1."$".$hStreet2;
		if ($hStreet == "$") {
			$hStreet = NULL;
		}
		
	
		$attributes = array(
			'givenName' => $this->input->post('contact_fname'),
			'sn' => $this->input->post('contact_sname'),
			'cn' => $this->input->post('contact_cname'),
			'uid' => $id,
			'jpegPhoto' => $jpegStr,
			'facsimileTelephoneNumber' => $this->input->post('contact_fax'),
			'telephoneNumber' => $this->input->post('contact_work'),
			'mobile' => $this->input->post('contact_mobile'),
			'street' => $hStreet,
			'st' => $this->input->post('contact_hstate'),
			'l' => $this->input->post('contact_hcountry'),
			'postalCode' => $this->input->post('contact_hpostcode'),
			'postalAddress' => $this->input->post('contact_paddress'), 
			'mail' => $this->input->post('contact_email'),
			'o' => $this->input->post('contact_org')
		);


    	$user['objectClass'][0] = 'inetOrgPerson';
		$user['objectClass'][1] = 'top';						// objectClass defines what fields are allowed for the object (user)
		if ($attributes['givenName']) {	$user['givenName'][0] = $attributes['givenName'];	}
		if ($attributes['sn']) { $user['sn'][0] = $attributes['sn']; }
		if ($attributes['cn']) { $user['cn'][0] = $attributes['cn']; }
		if ($attributes['uid']) { $user['uid'] = $attributes['uid']; }
		if ($attributes['jpegPhoto']) { $user['jpegPhoto'][0] = $attributes['jpegPhoto']; }
		if ($attributes['facsimileTelephoneNumber']) { $user['facsimileTelephoneNumber'][0] = $attributes['facsimileTelephoneNumber']; }
		if ($attributes['telephoneNumber']) { $user['telephoneNumber'][0] = $attributes['telephoneNumber']; }
		if ($attributes['mobile']) { $user['mobile'][0] = $attributes['mobile']; }
		if ($attributes['street']) { $user['street'][0] = $attributes['street']; }
		if ($attributes['st']) { $user['st'][0] = $attributes['st']; }
		if ($attributes['l']) { $user['l'][0] = $attributes['l']; }// $ means new line - in your method, convert line breaks into the dollarsign
		if ($attributes['postalCode']) { $user['postalCode'][0] = $attributes['postalCode']; }
		if ($attributes['postalAddress']) { $user['postalAddress'][0] = $attributes['postalAddress']; }
		if ($attributes['mail']) { $user['mail'][0] = $attributes['mail']; }
		if ($attributes['o']) { $user['o'][0] = $attributes['o']; }
		
	
		$result = ldap_add($this->myldap->getLdapConnection(), 'uid=' . $user['uid'] . ',ou=contacts,dc=bizwebsys,dc=tk', $user);  

	    if ($result != true) { 
            return false; 
        }
        
        return true;

	}	



	public function update_contact($id,$jpegStr) 
	{

		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$this->load->helper('url');

		$hStreet1 = $this->input->post('contact_hstreet1');
		$hStreet2 = $this->input->post('contact_hstreet2');

		$hStreet = $hStreet1."$".$hStreet2;
		if ($hStreet == "$") {
			$hStreet = NULL;
		}
		
	
		$attributes = array(
			'givenName' => $this->input->post('contact_fname'),
			'sn' => $this->input->post('contact_sname'),
			'cn' => $this->input->post('contact_cname'),
			'uid' => $id,
			'jpegPhoto' => $jpegStr,
			'facsimileTelephoneNumber' => $this->input->post('contact_fax'),
			'telephoneNumber' => $this->input->post('contact_work'),
			'mobile' => $this->input->post('contact_mobile'),
			'street' => $hStreet,
			'st' => $this->input->post('contact_hstate'),
			'l' => $this->input->post('contact_hcountry'),
			'postalCode' => $this->input->post('contact_hpostcode'),
			'postalAddress' => $this->input->post('contact_paddress'), 
			'mail' => $this->input->post('contact_email'),
			'o' => $this->input->post('contact_org')
		);



		$result = ldap_search($this->myldap->getLdapConnection(),"ou=contacts,dc=bizwebsys,dc=tk", "(uid=".$id.")") or die ("Error in search query"); 

	    $entry = ldap_first_entry($this->myldap->getLdapConnection(), $result);
	    
	    $info = ldap_get_attributes($this->myldap->getLdapConnection(), $entry);


	    $update['sn'][0] = $attributes['sn']; 
	    $update['cn'][0] = $attributes['cn'];

	    if (array_key_exists("givenName",$info)) {
	    	if ($attributes['givenName']) {
	    		$update['givenName'][0] = $attributes['givenName']; 
	    	} else {
	    		$remove['givenName'] = array();
	    	}
	    } else {
	    	if ($attributes['givenName']) {	$add['givenName'][0] = $attributes['givenName']; }
	    }

	    if (array_key_exists("jpegPhoto",$info)) {
	    	if ($attributes['jpegPhoto'])
	    	{
	    		$update['jpegPhoto'][0] = $attributes['jpegPhoto']; 
	    	}
	    } else {
	    	if ($attributes['jpegPhoto']) {	$add['jpegPhoto'][0] = $attributes['jpegPhoto']; }
	    }

	    if (array_key_exists("facsimileTelephoneNumber",$info)) { 
	    	if ($attributes['facsimileTelephoneNumber']) {
	    		$update['facsimileTelephoneNumber'][0] = $attributes['facsimileTelephoneNumber']; 
	    	} else {
	    		$remove['facsimileTelephoneNumber'] = array();
	    	}
	    } else {
	    	if ($attributes['facsimileTelephoneNumber']) { $add['facsimileTelephoneNumber'][0] = $attributes['facsimileTelephoneNumber']; }
	    }

	    if (array_key_exists("telephoneNumber",$info)) {
	    	if ($attributes['telephoneNumber']) {
	    		$update['telephoneNumber'][0] = $attributes['telephoneNumber']; 
	    	} else {
	    		$remove['telephoneNumber'] = array();
	    	}
	    } else {
	    	if ($attributes['telephoneNumber']) { $add['telephoneNumber'][0] = $attributes['telephoneNumber']; }
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

	    if (array_key_exists("street",$info)) {
	    	if ($attributes['street']) {
	    		$update['street'][0] = $attributes['street']; 
	    	} else {
	    		$remove['street'] = array();
	    	} 
	    } else {
	    	if ($attributes['street']) {	$add['street'][0] = $attributes['street']; }
	    }

	    if (array_key_exists("st",$info)) {
	    	if ($attributes['st']) {
	    		$update['st'][0] = $attributes['st']; 
	    	} else {
	    		$remove['st'] = array();
	    	}
	    } else {
	    	if ($attributes['st']) {	$add['st'][0] = $attributes['st']; }
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
	     
	    if (array_key_exists("mail",$info)) {
	    	if ($attributes['mail']) {
	    		$update['mail'][0] = $attributes['mail']; 
	    	} else {
	    		$remove['mail'] = array();
	    	}
	    } else {
	    	if ($attributes['mail']) {	$add['mail'][0] = $attributes['mail']; }
	    }

	    if (array_key_exists("o",$info)) {
	    	if ($attributes['o']) {
	    		$update['o'][0] = $attributes['o']; 
	    	} else {
	    		$remove['o'] = array();
	    	}
	    } else {
	    	if ($attributes['o']) {	$add['o'][0] = $attributes['o']; }
	    }
		
		
		$result1 = ldap_modify($this->myldap->getLdapConnection(),'uid='.$id.',ou=contacts,dc=bizwebsys,dc=tk', $update);
		$result2 = true;
		if (isset($add)) { $result2 = ldap_mod_add($this->myldap->getLdapConnection(), "uid=".$id.",ou=contacts,dc=bizwebsys,dc=tk", $add); }
		$result3 = true;
		if (isset($remove)) { $result3 = ldap_mod_del($this->myldap->getLdapConnection(), "uid=".$id.",ou=contacts,dc=bizwebsys,dc=tk", $remove); } 

	    if ($result1 != true || $result2 != true || $result3 != true) { 
            return false; 
        }

        return true;



	}


	public function delete_contact($id) {
		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$result = ldap_delete($this->myldap->getLdapConnection(), 'uid=' .$id. ',ou=contacts,dc=bizwebsys,dc=tk');   
	    
	    if ($result != true) { 
            return false; 
        }
        
        return true;

	}
	
		
	
	
}