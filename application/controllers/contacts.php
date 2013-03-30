<?php


class Contacts extends MY_Controller {
	function __construct()
	{	

		parent::__construct();
		$this->load->model('contacts_model');
		
	
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

		
		
		
		$data['contacts'] = $this->contacts_model->get_all_contact();		
		$data['ldap'] = $this->contacts_model->get_ldap();
		$data['x'] = 0;
		$data['customHead'] = '
		<style type="text/css">
		.thumbnail div {
			font-weight: bold;
			font-size: 120%;
			margin-top: 5%;
		}
		a.thumbnail:hover {
			text-decoration: none;
		}
		.thumbnail {
			
		}
		</style>';
		
	
		$this->_data_render('app/contacts/contacts',$data);
		
		ldap_close($data['ldap']->getLdapConnection());
	
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
	
