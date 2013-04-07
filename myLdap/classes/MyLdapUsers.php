<?php

require_once(dirname(__FILE__) . '/../MyLdap.php');

class MyLdapUsers {
	
	
	protected $myldap;
    
    public function __construct(MyLdap $myldap) {
        $this->myldap = $myldap;
        
        
        
    }
    
    	
    public function create_contact($attributes)
    {


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




    public function create_user($attributes)
    {
	    
		/* if (array_key_exists("userPassword",$add) && (!$this->adldap->getUseSSL() && !$this->adldap->getUseTLS())){ 
            throw new adLDAPException('SSL must be configured on your webserver and enabled in the class to set passwords.');
        }   */
	 
	 	// objectClass defines what fields are allowed for the object (user)
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
        
        return true;
	    
	    
    }

    public function get_admin() {

    	$result = ldap_search($this->myldap->getLdapConnection(),"ou=groups,dc=bizwebsys,dc=tk", "(cn=admins)") or die ("Error in search query"); 

	    $entry = ldap_first_entry($this->myldap->getLdapConnection(), $result);


	    if ($entry != false) {
	    	$info = ldap_get_attributes($this->myldap->getLdapConnection(), $entry);
	    	return $info;
	    }
	    return false;


    }
    
    public function get_all_user() 
    {
	    $result = ldap_search($this->myldap->getLdapConnection(),"ou=people,dc=bizwebsys,dc=tk", "(cn=*)") or die ("Error in search query"); 
	    
	    $info = ldap_get_entries($this->myldap->getLdapConnection(), $result);
	    
	    
	    return $info;
	    
    }
    
    
    public function get_all_contacts()
    {
	    $result = ldap_search($this->myldap->getLdapConnection(),"ou=contacts,dc=bizwebsys,dc=tk", "(cn=*)") or die ("Error in search query");
	    
	    $info = ldap_get_entries($this->myldap->getLdapConnection(), $result);
	    
 	   //print_r($info);
	    
	    return $info;
    }
	

    public function get_contact_by_id($id) 
    {

	    $result = ldap_search($this->myldap->getLdapConnection(),"ou=contacts,dc=bizwebsys,dc=tk", "(uid=".$id.")") or die ("Error in search query"); 

	    $entry = ldap_first_entry($this->myldap->getLdapConnection(), $result);

	    if ($entry != false) {
	    	$info = ldap_get_attributes($this->myldap->getLdapConnection(), $entry);
	    	return $info;
	    }
	    return false;
	    
    }
    

    public function get_user_by_id($uid) 
    {

	    $result = ldap_search($this->myldap->getLdapConnection(),"ou=people,dc=bizwebsys,dc=tk", "(uid=".$uid.")") or die ("Error in search query"); 

	    $entry = ldap_first_entry($this->myldap->getLdapConnection(), $result);
	    
	    if ($entry != false) {
	    	$info = ldap_get_attributes($this->myldap->getLdapConnection(), $entry);
	    	return $info;
	    }
	    return false;
	    
	    
    }
    

    
    public function update_contact($attributes,$id)
    {

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






    public function update_employee($attributes,$id)
    {

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
        
        return true;
    	

    }



    public function delete_contact($id) {


    	$result = ldap_delete($this->myldap->getLdapConnection(), 'uid=' .$id. ',ou=contacts,dc=bizwebsys,dc=tk');   
	    
	    if ($result != true) { 
            return false; 
        }
        
        return true;

    }


    public function delete_employee($id) {


    	$result = ldap_delete($this->myldap->getLdapConnection(), 'uid=' .$id. ',ou=people,dc=bizwebsys,dc=tk');   
	    
	    if ($result != true) { 
            return false; 
        }
        
        return true;

    }
    


}




?>