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




    public function create_people($attributes)
    {
	    
		/* if (array_key_exists("userPassword",$add) && (!$this->adldap->getUseSSL() && !$this->adldap->getUseTLS())){ 
            throw new adLDAPException('SSL must be configured on your webserver and enabled in the class to set passwords.');
        }   */
	 
	 	
		$user['objectClass'][0] = 'inetOrgPerson';
		$user['objectClass'][1] = 'organizationalPerson';
		$user['objectClass'][2] = 'person';
		$user['objectClass'][3] = 'top';						// objectClass defines what fields are allowed for the object (user)
		$user['cn'] = $attributes['cn'];
		$user['sn'] = $attributes['sn'];
		$user['uid'] = $attributes['cn'].$attributes['sn'];
		$user['employeeNumber'] = $attributes['employeeNumber'];
		$user['homePhone'] = $attributes['homePhone'];
		$user['l'] = $attributes['l'];
		$user['mail'] = $user['uid']."@example.com";
		$user['mobile'] = $attributes['mobile'];
		$user['postalAddress'] = $attributes['postalAddress'];		// $ means new line - in your method, convert line breaks into the dollarsign
		$user['postalCode'] = $attributes['postalCode'];
		$user['title'] = $attributes['title'];
	
		$password = $user['uid'] . '123';			// default password e.g. horaceli123 - change this if you want
	
		$user['userPassword'] = '{SHA}' . base64_encode(sha1($password, TRUE));		// encodes the password in a hash
	
		$result = ldap_add($this->myldap->getLdapConnection(), 'uid=' . $user['uid'] . ',ou=people,dc=bizwebsys,dc=tk', $user);   
	    
	    if ($result != true) { 
            return false; 
        }
        
        return true;
	    
	    
    }
    
    public function getAll_people() 
    {
	    $result = ldap_search($this->myldap->getLdapConnection(),"ou=people,dc=bizwebsys,dc=tk", "(cn=*)") or die ("Error in search query"); 
	    
	    $info = ldap_get_entries($this->myldap->getLdapConnection(), $result);
	    
	    
	    return $info;
	    
    }
    
    
    public function getAll_contacts()
    {
	    $result = ldap_search($this->myldap->getLdapConnection(),"ou=contacts,dc=bizwebsys,dc=tk", "(cn=*)") or die ("Error in search query");
	    
	    $info = ldap_get_entries($this->myldap->getLdapConnection(), $result);
	    
 	   //print_r($info);
	    
	    return $info;
    }


    public function getContact_byID($id) 
    {

	    $result = ldap_search($this->myldap->getLdapConnection(),"ou=contacts,dc=bizwebsys,dc=tk", "(uid=".$id.")") or die ("Error in search query"); 

	    $entry = ldap_first_entry($this->myldap->getLdapConnection(), $result);
	    
	    $info = ldap_get_attributes($this->myldap->getLdapConnection(), $entry);
	    
	    return $info;
	    
    }
    
    
    


}




?>