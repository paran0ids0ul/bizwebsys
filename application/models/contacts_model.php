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

	public function get_contact($id) 
	{

		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$contact = $this->myldap->user()->getContact_byID($id);

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
	
	public function new_contactID_db() 
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



		$this->myldap->user()->update_contact($attributes,$id);


	}


	public function delete_contact($id) {
		try {
			$this->myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}

		$result = $this->myldap->user()->delete_contact($id);

		return $result;

	}
	
		
	
	
}