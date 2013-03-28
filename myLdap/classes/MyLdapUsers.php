<?php

require_once(dirname(__FILE__) . '/../MyLdap.php');

class MyLdapUsers {
	
	
	protected $myldap;
    
    public function __construct(MyLdap $myldap) {
        $this->myldap = $myldap;
        
        
        
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
	
	
		$results = ldap_add($this->myldap->getLdapConnection(), 'uid=' . $user['uid'] . ',ou=people,dc=bizwebsys,dc=tk', $user);   
	    
	    if ($result != true) { 
            return false; 
        }
        
        return true;
	    
	    
    }
    
    public function getAll_people() 
    {
	    $result = ldap_search($this->myldap->getLdapConnection(),"ou=people,dc=bizwebsys,dc=tk", "(cn=*)") or die ("Error in search query"); 
	    $info = ldap_get_entries($this->myldap->getLdapConnection(), $result);
	    
	    print_r($info);
	    
    }
    
    
    public function getAll_contacts()
    {
	    $result = ldap_search($this->myldap->getLdapConnection(),"ou=contacts,dc=bizwebsys,dc=tk", "(cn=*)") or die ("Error in search query"); 
	    $info = ldap_get_entries($this->myldap->getLdapConnection(), $result);
	    
	    print_r($info);
    }
    
    
    


}




?>