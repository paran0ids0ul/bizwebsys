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
		
		$this->contacts_model->close_ldap();

		
	
	}
	
	public function new_contact(){
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
	
		$this->form_validation->set_rules('contact_fname', 'First Name', 'required');
	
		if ($this->form_validation->run() === FALSE)
		{
		
			$this->_render('app/contacts/new_contact');
		
		}
		else 
		{
		
			$config['upload_path'] = 'resources/images/contacts/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['overwrite'] = false;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
		
			
		
		
			if ( ! $this->upload->do_upload('file'))
			{
				
            	$error = array('error' => $this->upload->display_errors());
                        
            	$newID = $this->contacts_model->new_contactID_db();

            	$this->contacts_model->new_contact($newID);

            	$this->contacts_model->close_ldap();
            	
            	//$this->display_contact_byID($newID);
            	
            	
            }
            else 
            {
		
				$newID = $this->contacts_model->new_contactID_db();

				$this->contacts_model->new_contact($newID);
			
				$file_data  =   $this->upload->data();

				$fd = fopen($file_data['full_path'], 'r');

				$fsize=filesize($file_data['full_path']);

				$jpegStr = fread($fd, $fsize);
				
								
				$this->contacts_model->add_image($newID,$jpegStr);

				$this->contacts_model->close_ldap();

				fclose($fd);

				unlink($file_data['full_path']);

			
				//$this->display_contact_byID($newID);
			}
			
			
		}
	
		
	}
	
	public function display_contact_byID($id){

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
	
