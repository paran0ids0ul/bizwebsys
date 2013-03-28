<?php


class Employee extends MY_Controller {

	function __construct()
	{	

		parent::__construct();
		$this->load->model('employee_model');
		
	
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

		
		
		
		$data['employees'] = $this->employee_model->get_all_employee();		
		$data['ldap'] = $this->employee_model->get_ldap();
		$data['x'] = 0;
	
		$this->_data_render('app/employee/employee',$data);
		
		
		ldap_close($data['ldap']->getLdapConnection());
		
		
	}
	
	
	
	public function new_employee(){	
		$this->_render('app/employee/new_employee');
	}

	public function display_employee(){	
		$this->_render('app/employee/display_employee');
	}
	
	
}