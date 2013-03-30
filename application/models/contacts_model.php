<?php

include ("myLdap/MyLdap.php");

class Contacts_model extends MY_Model {


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
	
	public function get_all_contact() {
		
		

		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$results = $this->myldap->user()->getAll_contacts();	
		return $results;
		
	}
	
	public function get_contact_list()
	{
		
		$query = $this->db->get('Contact');
		return $query->result_array();
		
	}
	
	public function new_contactID_db() 
	{
		$this->db->insert('Contact', array('ContactID' => NULL) );

		$id = $this->db->insert_id();

		return $id;
	
	}

	public function new_contact($id)
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

		if ($hStreet1 != NULL && $hStreet2 == NULL) {
			$hStreet = $hStreet1;
		} elseif ($hStreet1 != NULL && $hStreet2 != NULL) {
			$hStreet = $hStreet1.",".$hStreet2;
		} elseif ($hStreet1 == NULL && $hStreet2 == NULL) {
			$hStreet = NULL;
		} 
		
	
		$attributes = array(
			'givenName' => $this->input->post('contact_fname'),
			'sn' => $this->input->post('contact_sname'),
			'cn' => $this->input->post('contact_cname'),
			'uid' => $id,
			'facsimileTelephoneNumber' => $this->input->post('contact_fax'),
			'telephoneNumber' => $this->input->post('contact_work'),
			'mobile' => $this->input->post('contact_mobile'),
			'street' => $hStreet,
			'st' => $this->input->post('contact_hstate'),
			'l' => $this->input->post('contact_hcountry'),
			'postalCode' => $this->input->post('contact_hpostcode'),
			'postalAddress' => $pAddress, 
			'mail' => $this->input->post('contact_email'),
			'o' => $this->input->post('contact_org')
		);



		$this->myldap->user()->create_contact($attributes);


	}	


	public function add_image($id,$bstring)
	{
		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$entry["jpegPhoto"][0] = "$bstring";

		$result = ldap_mod_add($this->myldap->getLdapConnection(), "uid=".$id.",ou=contacts,dc=bizwebsys,dc=tk", $entry);

	}
	
		
	
	
}