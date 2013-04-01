<?php


class Contacts extends MY_Controller {
	function __construct()
	{	

		parent::__construct();
		$this->load->model('contacts_model');
		
	
	}

	public function index(){		
		

		/*$this->data["custom_js"] ='			
		
							  
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
									   
									
									   
									   
									  									   
								    </script>';	*/

		
		
		
		$data['contacts'] = $this->contacts_model->get_all_contact();		
		$data['ldap'] = $this->contacts_model->get_ldap();
		$data['x'] = 0;
		
	
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
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = false;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
		
			
		
		
			if ( ! $this->upload->do_upload('file'))
			{
				
            	$error = array('error' => $this->upload->display_errors());

            	$jpegStr = NULL;
                        
            	$newID = $this->contacts_model->new_contactID_db();

            	$this->contacts_model->new_contact($newID,$jpegStr);

            	$this->contacts_model->close_ldap();
            	
            	$this->display_contact_byID($newID);
            	
            	
            }
            else 
            {
		
				$newID = $this->contacts_model->new_contactID_db();
			
				$file_data  =   $this->upload->data();

				$fd = fopen($file_data['full_path'], 'r');

				$fsize=filesize($file_data['full_path']);

				$jpegStr = fread($fd, $fsize);
				
								
				$this->contacts_model->new_contact($newID,$jpegStr);

				$this->contacts_model->close_ldap();

				fclose($fd);

				unlink($file_data['full_path']);

				$this->display_contact_byID($newID);
			}
			
			
		}
	
		
	}
	
	public function display_contact_byID($id)
	{


		$data = $this->contacts_model->get_contact($id);

		$this->_data_render('app/contacts/display_contact',$data);

	}

	public function edit_contact($id)
	{


		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
	
		$this->form_validation->set_rules('contact_fname', 'First Name', 'required');
	
		if ($this->form_validation->run() === FALSE)
		{

			$data = $this->contacts_model->get_contact($id);

			$this->_data_render('app/contacts/edit_contact',$data);
		
		}
		else 
		{
		
			$config['upload_path'] = 'resources/images/contacts/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = false;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
		
			
		
		
			if ( ! $this->upload->do_upload('file'))
			{
				
            	$error = array('error' => $this->upload->display_errors());
                        
                $jpegStr = NULL;

            	$this->contacts_model->update_contact($id,$jpegStr);

            	$this->contacts_model->close_ldap();
            	
            	$this->display_contact_byID($id);
            	
            	
            }
            else 
            {
		
				$newID = $this->contacts_model->new_contactID_db();
			
				$file_data  =   $this->upload->data();

				$fd = fopen($file_data['full_path'], 'r');

				$fsize=filesize($file_data['full_path']);

				$jpegStr = fread($fd, $fsize);
				
				$this->contacts_model->update_contact($id,$jpegStr);

				$this->contacts_model->close_ldap();

				fclose($fd);

				unlink($file_data['full_path']);

				$this->display_contact_byID($id);
			}
			
			
		}


	}

}
	
