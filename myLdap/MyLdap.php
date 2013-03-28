<?php


require_once(dirname(__FILE__) . '/classes/myLDAPUsers.php');



class MyLdap {

const ADLDAP_LDAP_PORT = '389';
    /**
    * The default port for LDAPS SSL connections
    */
    const ADLDAP_LDAPS_PORT = '636';
    
    /**
    * The account suffix for your domain, can be set when the class is invoked
    * 
    * @var string
    */   
	protected $accountSuffix = "";
    
    /**
    * The base dn for your domain
    * 
    * If this is set to null then adLDAP will attempt to obtain this automatically from the rootDSE
    * 
    * @var string
    */
	protected $baseDn = "DC=bizwebsys,DC=tk"; 
    
    /** 
    * Port used to talk to the domain controllers. 
    *  
    * @var int 
    */ 
    protected $adPort = self::ADLDAP_LDAP_PORT; 
	
    /**
    * Array of domain controllers. Specifiy multiple controllers if you
    * would like the class to balance the LDAP queries amongst multiple servers
    * 
    * @var array
    */
    protected $domainController = "bizwebsys.tk";
	
    /**
    * Optional account with higher privileges for searching
    * This should be set to a domain admin account
    * 
    * @var string
    * @var string
    */
	protected $adminUsername = "cn=admin,dc=bizwebsys,dc=tk";
    protected $adminPassword = "Abcd1234*";
    
    /**
    * AD does not return the primary group. http://support.microsoft.com/?kbid=321360
    * This tweak will resolve the real primary group. 
    * Setting to false will fudge "Domain Users" and is much faster. Keep in mind though that if
    * someone's primary group is NOT domain users, this is obviously going to mess up the results
    * 
    * @var bool
    */
	protected $realPrimaryGroup = true;
	
    /**
    * Use SSL (LDAPS), your server needs to be setup, please see
    * http://adldap.sourceforge.net/wiki/doku.php?id=ldap_over_ssl
    * 
    * @var bool
    */
	protected $useSSL = false;
    
    /**
    * Use TLS
    * If you wish to use TLS you should ensure that $useSSL is set to false and vice-versa
    * 
    * @var bool
    */
    protected $useTLS = false;
    
    /**
    * Use SSO  
    * To indicate to adLDAP to reuse password set by the brower through NTLM or Kerberos 
    * 
    * @var bool
    */
    protected $useSSO = false;
    
    /**
    * When querying group memberships, do it recursively 
    * eg. User Fred is a member of Group A, which is a member of Group B, which is a member of Group C
    * user_ingroup("Fred","C") will returns true with this option turned on, false if turned off     
    * 
    * @var bool
    */
	protected $recursiveGroups = true;
	
	// You should not need to edit anything below this line
	//******************************************************************************************
	
	/**
    * Connection and bind default variables
    * 
    * @var mixed
    * @var mixed
    */
	protected $ldapConnection;
	protected $ldapBind;
	
	
	
	
	public function getLdapConnection() {
        if ($this->ldapConnection) {
            return $this->ldapConnection;   
        }
        return false;
    }
    
	
	
	public function setUseSSL($useSSL)
    {
          $this->useSSL = $useSSL;
          // Set the default port correctly 
          if($this->useSSL) { 
            $this->setPort(self::ADLDAP_LDAPS_PORT); 
          }
          else { 
            $this->setPort(self::ADLDAP_LDAP_PORT); 
          } 
    }
    
    public function setPort($adPort) 
    { 
        $this->adPort = $adPort; 
    } 
    
    public function setUseSSO($useSSO)
    {
          if ($useSSO === true && !$this->ldapSaslSupported()) {
              throw new adLDAPException('No LDAP SASL support for PHP.  See: http://www.php.net/ldap_sasl_bind');
          }
          $this->useSSO = $useSSO;
    }

    protected function ldapSaslSupported()
    {
        if (!function_exists('ldap_sasl_bind')) {
            return false;
        }
        return true;
    }
    
    
    protected function ldapSupported()
    {
        if (!function_exists('ldap_connect')) {
            return false;   
        }
        return true;
    }
    
    
    public function getLastError() {
        return @ldap_error($this->ldapConnection);
    }
    
    public function findBaseDn() 
    {
        $namingContext = $this->getRootDse(array('defaultnamingcontext'));   
        return $namingContext[0]['defaultnamingcontext'][0];
    }
    
    
    public function getRootDse($attributes = array("*", "+")) {
        if (!$this->ldapBind){ return (false); }
        
        $sr = @ldap_read($this->ldapConnection, NULL, 'objectClass=*', $attributes);
        $entries = @ldap_get_entries($this->ldapConnection, $sr);
        return $entries;
    }
    
    
    
    
    
    
    
    protected $userClass;
    
    
    public function user() {
        if (!$this->userClass) {
            $this->userClass = new MyLdapUsers($this);
        }   
        return $this->userClass;
    }
    
    
    
    
	
	function __construct($options = array()) {
        // You can specifically overide any of the default configuration options setup above
        if (count($options) > 0) {
            if (array_key_exists("account_suffix",$options)){ $this->accountSuffix = $options["account_suffix"]; }
            if (array_key_exists("base_dn",$options)){ $this->baseDn = $options["base_dn"]; }
            if (array_key_exists("domain_controllers",$options)){ 
                if (!is_array($options["domain_controllers"])) { 
                    throw new adLDAPException('[domain_controllers] option must be an array');
                }
                $this->domainControllers = $options["domain_controllers"]; 
            }
            if (array_key_exists("admin_username",$options)){ $this->adminUsername = $options["admin_username"]; }
            if (array_key_exists("admin_password",$options)){ $this->adminPassword = $options["admin_password"]; }
            if (array_key_exists("real_primarygroup",$options)){ $this->realPrimaryGroup = $options["real_primarygroup"]; }
            if (array_key_exists("use_ssl",$options)){ $this->setUseSSL($options["use_ssl"]); }
            if (array_key_exists("use_tls",$options)){ $this->useTLS = $options["use_tls"]; }
            if (array_key_exists("recursive_groups",$options)){ $this->recursiveGroups = $options["recursive_groups"]; }
            if (array_key_exists("ad_port",$options)){ $this->setPort($options["ad_port"]); } 
            if (array_key_exists("sso",$options)) { 
                $this->setUseSSO($options["sso"]);
                if (!$this->ldapSaslSupported()) {
                    $this->setUseSSO(false);
                }
            } 
        }
        
        if ($this->ldapSupported() === false) {
            throw new adLDAPException('No LDAP support for PHP.  See: http://www.php.net/ldap');
        }

        return $this->connect();
    }
	
	
	
	
	
	
	
	public function connect() 
    {
        // Connect to the AD/LDAP server as the username/password
        if ($this->useSSL) {
            $this->ldapConnection = ldap_connect("ldaps://" . $this->domainController, $this->adPort);
        } else {
            $this->ldapConnection = ldap_connect($this->domainController, $this->adPort);
        }
               
        // Set some ldap options for talking to AD
        ldap_set_option($this->ldapConnection, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($this->ldapConnection, LDAP_OPT_REFERRALS, 0);
        
        if ($this->useTLS) {
            ldap_start_tls($this->ldapConnection);
        }
               
        // Bind as a domain admin if they've set it up
        if ($this->adminUsername !== NULL && $this->adminPassword !== NULL) {
            $this->ldapBind = ldap_bind($this->ldapConnection, $this->adminUsername, $this->adminPassword);
            if (!$this->ldapBind) {
                if ($this->useSSL && !$this->useTLS) {
                    // If you have problems troubleshooting, remove the @ character from the ldapldapBind command above to get the actual error message
                    throw new adLDAPException('Bind to Active Directory failed. Either the LDAPs connection failed or the login credentials are incorrect. AD said: ' . $this->getLastError());
                }
                else {
                    throw new adLDAPException('Bind to Active Directory failed. Check the login credentials and/or server details. AD said: ' . $this->getLastError());
                }
            }
        }
        if ($this->useSSO && $_SERVER['REMOTE_USER'] && $this->adminUsername === null && $_SERVER['KRB5CCNAME']) {
            putenv("KRB5CCNAME=" . $_SERVER['KRB5CCNAME']);  
            $this->ldapBind = @ldap_sasl_bind($this->ldapConnection, NULL, NULL, "GSSAPI"); 
            if (!$this->ldapBind){ 
                throw new adLDAPException('Rebind to Active Directory failed. AD said: ' . $this->getLastError()); 
            }
            else {
                return true;
            }
        }
                
        
        if ($this->baseDn == NULL) {
            $this->baseDn = $this->findBaseDn();   
        }
        
        return true;
    }
	
	
	
	

}



class adLDAPException extends Exception {}


?>