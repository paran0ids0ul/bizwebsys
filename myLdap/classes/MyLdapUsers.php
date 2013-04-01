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
    
    
    public function update_contact($attributes,$id)
    {

    	$result = ldap_search($this->myldap->getLdapConnection(),"ou=contacts,dc=bizwebsys,dc=tk", "(uid=".$id.")") or die ("Error in search query"); 

	    $entry = ldap_first_entry($this->myldap->getLdapConnection(), $result);
	    
	    $info = ldap_get_attributes($this->myldap->getLdapConnection(), $entry);


	    $update['sn'][0] = $attributes['sn'] == NULL ? "" : $attributes['sn']; 
	    $update['cn'][0] = $attributes['cn'] == NULL ? "" : $attributes['cn'];

	    if (array_key_exists("givenName",$info)) {
	    	$update['givenName'][0] = $attributes['givenName'] == NULL ? "" : $attributes['givenName']; 
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
	    	$update['facsimileTelephoneNumber'][0] = $attributes['facsimileTelephoneNumber'] == NULL ? "" : $attributes['facsimileTelephoneNumber']; 
	    } else {
	    	if ($attributes['facsimileTelephoneNumber']) { $add['facsimileTelephoneNumber'][0] = $attributes['facsimileTelephoneNumber']; }
	    }

	    if (array_key_exists("telephoneNumber",$info)) {
	    	$update['telephoneNumber'][0] = $attributes['telephoneNumber'] == NULL ? "" : $attributes['telephoneNumber']; 
	    } else {
	    	if ($attributes['telephoneNumber']) { $add['telephoneNumber'][0] = $attributes['telephoneNumber']; }
	    }

	    if (array_key_exists("mobile",$info)) {
	    	$update['mobile'][0] = $attributes['mobile'] == NULL ? "" : $attributes['mobile']; 
	    } else {
	    	if ($attributes['mobile']) {	$add['mobile'][0] = $attributes['mobile']; }
	    }

	    if (array_key_exists("street",$info)) {
	    	$update['street'][0] = $attributes['street'] == NULL ? "" : $attributes['street']; 
	    } else {
	    	if ($attributes['street']) {	$add['street'][0] = $attributes['street']; }
	    }

	    if (array_key_exists("st",$info)) {
	    	$update['st'][0] = $attributes['st'] == NULL ? "" : $attributes['st']; 
	    } else {
	    	if ($attributes['st']) {	$add['st'][0] = $attributes['st']; }
	    }

	    if (array_key_exists("l",$info)) {
	    	$update['l'][0] = $attributes['l'] == NULL ? "" : $attributes['l']; 
	    } else {
	    	if ($attributes['l']) {	$add['l'][0] = $attributes['l']; }
	    }

	    if (array_key_exists("postalCode",$info)) {
	    	$update['postalCode'][0] = $attributes['postalCode'] == NULL ? "" : $attributes['postalCode']; 
	    } else {
	    	if ($attributes['postalCode']) {	$add['postalCode'][0] = $attributes['postalCode']; }
	    }

	    if (array_key_exists("postalAddress",$info)) {
	    	$update['postalAddress'][0] = $attributes['postalAddress'] == NULL ? "" : $attributes['postalAddress']; 
	    } else {
	    	if ($attributes['postalAddress']) {	$add['postalAddress'][0] = $attributes['postalAddress']; }
	    }
	     
	    if (array_key_exists("mail",$info)) {
	    	$update['mail'][0] = $attributes['mail'] == NULL ? "" : $attributes['mail']; 
	    } else {
	    	if ($attributes['mail']) {	$add['mail'][0] = $attributes['mail']; }
	    }

	    if (array_key_exists("o",$info)) {
	    	$update['o'][0] = $attributes['o'] == NULL ? "" : $attributes['o']; 
	    } else {
	    	if ($attributes['o']) {	$add['o'][0] = $attributes['o']; }
	    }
		
		
		$result1 = ldap_modify($this->myldap->getLdapConnection(),'uid='.$id.',ou=contacts,dc=bizwebsys,dc=tk', $update);
		$result2 = true;
		if (isset($add)) { $result2 = ldap_mod_add($this->myldap->getLdapConnection(), "uid=".$id.",ou=contacts,dc=bizwebsys,dc=tk", $add); }
		 

	    if (($result1 != true) || $result2 != true) { 
            return false; 
        }
        
        return true;
    	

    }
    


}




?>