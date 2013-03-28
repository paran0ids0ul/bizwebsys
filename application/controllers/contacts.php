<?php


class Contacts extends MY_Controller {
	function __construct()
	{	

		parent::__construct();
		
		require_once('myLdap/MyLdap.php');
	
	}

	public function index(){	
	
	
		
		
		
		try {
			$myldap = new MyLdap();
		}
		catch (adLDAPException $e) {
			echo $e;
			exit();   
		}
		
		$data['contacts'] = $myldap->user()->getAll_contacts();		
		$data['ldap'] = $myldap;
		$data['x'] = 0;
		
		
	
		$this->_data_render('app/contacts/contacts',$data);
		
		ldap_close($myldap->getLdapConnection());
	
	}
	
	public function new_contact(){
		
		
		
		
		$this->data["custom_js"] ='			
		
							  
								    <script>
									    $(document).ready(function(){
									    
									    
									    var seloption ="";
									    
									    var business_category = ["Airport","Arts/Entertainment/Nightlife","Attractions/Things to do",
									    "Automotive","Bank/Financial Services","Bar","Book Store","Business Services","Church","Religious Organization",
									    "Club","Community/Government","Concert Venue","Doctor","Education","Event Planning/Event Services",
									    "Food/Grocery","Health/Medical/Pharmacy","Home Improvement","Hospital/Clinic","Hotel","Landmark","Lawyer",
									    "Library","Local Business","Movie Theater","Museum/Art Gallery","Outdoor Gear/Sporting Goods",
									    "Pet Services","Professional Services","Public Places","Real Estate","Restaurant/Cafe","School",
									    "Shopping/Retail","Spas/Beauty/Personal Care","Sports Venue","Sports/Recreation/Activities",
									    "Tours/Sightseeing","Transportation","University","Other"];
									    
									    $.each(business_category, function(i) {
								
									    	seloption += \'<option value="\'+business_category[i]+\'">\'+business_category[i]+\'</option>\';
									    	
									    }); 						     
									    
									    $("#contact_business").append(seloption);
									   
									   
									   });
									   
								    </script>';	
								    
		
								    
								    
		$this->_render('app/contacts/new_contact');
		
		
	}
	
	public function display_contact(){
		$this->_render('app/contacts/display_contact');

	}
}
	
	/*
	public function display_order($order_id="SO0001",$customer="cust1",$date="7/03/2013"){
		//data
		$this->data["order_id"] = $order_id;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		
		$this->_render('app/sales/display_order');
	}
	
		public function display_invoice(){
		$this->_render('app/sales/display_invoice');
	}
	
	public function cust_invoice(){
		$this->_render('app/sales/cust_invoice');
	}

	public function cust_payment(){
		$this->_render('app/sales/cust_payment');
	}

	public function sup_invoice(){
		$this->_render('app/sales/sup_invoice');
	}

	public function sup_payment(){
		$this->_render('app/sales/sup_payment');
	}	*/
	
