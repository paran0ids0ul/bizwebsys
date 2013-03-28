<?php
include ("myLdap/MyLdap.php");

class Contacts extends MY_Controller {
	function __construct()
	{	

		parent::__construct();
		
		require_once('myLdap/MyLdap.php');
	
	}

	public function index(){		
		
		
		
		$this->data["custom_js"] ='			
		
							  
								    <script>
									   
									     
									   (function($) {
									   		$.fn.uniformHeight = function() {
									   			var maxHeight   = 0,
									   			max = Math.max;

									   			return this.each(function() {
									   				maxHeight = max(maxHeight, $(this).height());
									   			}).height(maxHeight);
									   		}
									   	})(jQuery);

									    
									   
									    $(document).ready(function() {   
									    	$(".thumbnails").find(".thumbnail").uniformHeight();
									    });
									   
									
									   
									   
									  									   
								    </script>';	

		
		
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
	
