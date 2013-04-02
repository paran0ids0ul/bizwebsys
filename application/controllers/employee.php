<?php


class Employee extends MY_Controller {

	function __construct()
	{	

		parent::__construct();
		$this->load->model('employee_model');
		
	
	}


	public function index(){	
	
	
		$data['employees'] = $this->employee_model->get_all_employee();		
		$data['ldap'] = $this->employee_model->get_ldap();
		$data['x'] = 0;
	
		$this->_data_render('app/employee/employee',$data);
		
		$this->employee_model->close_ldap();
		
	}


	public function username_check($toCheck)
	{
		
		$reference = $this->employee_model->get_employee($toCheck);

		if (isset($reference)) {
			if ($reference['uid'] == $toCheck) {
				$this->form_validation->set_message('username_check', 'The username already exist in server');
				return FALSE;
			}
		} 
		else {
  			return TRUE;
  		}
	}

	public function check2($toCheck,$id)
	{
		if ($toCheck != $id) {
			$reference = $this->employee_model->get_employee($toCheck);

			if (isset($reference)) {
				if ($reference['uid'] == $toCheck) {
					$this->form_validation->set_message('check2', 'The username already exist in server');
					return FALSE;
				}
			} 
			else {
  				return TRUE;
  			}
  		}
  		else {
  			return TRUE;
  		}
	}
	
	public function new_employee(){	

		$this->data["custom_js"] ='			
								  
								    <script>
									   
									    $(document).ready(function() {   


									    	$("#employee_uname").keyup(function() {
									    		var uname = $("#employee_uname").val();
									    		var email = $("#employee_uname").val() + "@bizwebsys.tk";
  												$("#employee_email").val(email);
											});

										
									    });
									  									   
								    </script>';

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$data['job_titles'] = array("Chief Executive Officer (CEO)","Chief Operating Officer (COO)","Chief Financial Officer (CFO)",
							    	"Vice President of Marketing","Vice President of Production","Operations manager","Quality control, safety, environmental manager",
							    	"Accountant, bookkeeper","Office manager","Receptionist","Foreperson, supervisor, lead person","Marketing manager",
							    	"Purchasing manager","Shipping and receiving manager","Professional staff");

		$data['country_list'] = array(
				"Afghanistan",
				"Albania",
				"Algeria",
				"Andorra",
				"Angola",
				"Antigua and Barbuda",
				"Argentina",
				"Armenia",
				"Australia",
				"Austria",
				"Azerbaijan",
				"Bahamas",
				"Bahrain",
				"Bangladesh",
				"Barbados",
				"Belarus",
				"Belgium",
				"Belize",
				"Benin",
				"Bhutan",
				"Bolivia",
				"Bosnia and Herzegovina",
				"Botswana",
				"Brazil",
				"Brunei",
				"Bulgaria",
				"Burkina Faso",
				"Burundi",
				"Cambodia",
				"Cameroon",
				"Canada",
				"Cape Verde",
				"Central African Republic",
				"Chad",
				"Chile",
				"China",
				"Colombi",
				"Comoros",
				"Congo (Brazzaville)",
				"Congo",
				"Costa Rica",
				"Cote d'Ivoire",
				"Croatia",
				"Cuba",
				"Cyprus",
				"Czech Republic",
				"Denmark",
				"Djibouti",
				"Dominica",
				"Dominican Republic",
				"East Timor (Timor Timur)",
				"Ecuador",
				"Egypt",
				"El Salvador",
				"Equatorial Guinea",
				"Eritrea",
				"Estonia",
				"Ethiopia",
				"Fiji",
				"Finland",
				"France",
				"Gabon",
				"Gambia, The",
				"Georgia",
				"Germany",
				"Ghana",
				"Greece",
				"Grenada",
				"Guatemala",
				"Guinea",
				"Guinea-Bissau",
				"Guyana",
				"Haiti",
				"Honduras",
				"Hungary",
				"Iceland",
				"India",
				"Indonesia",
				"Iran",
				"Iraq",
				"Ireland",
				"Israel",
				"Italy",
				"Jamaica",
				"Japan",
				"Jordan",
				"Kazakhstan",
				"Kenya",
				"Kiribati",
				"Korea, North",
				"Korea, South",
				"Kuwait",
				"Kyrgyzstan",
				"Laos",
				"Latvia",
				"Lebanon",
				"Lesotho",
				"Liberia",
				"Libya",
				"Liechtenstein",
				"Lithuania",
				"Luxembourg",
				"Macedonia",
				"Madagascar",
				"Malawi",
				"Malaysia",
				"Maldives",
				"Mali",
				"Malta",
				"Marshall Islands",
				"Mauritania",
				"Mauritius",
				"Mexico",
				"Micronesia",
				"Moldova",
				"Monaco",
				"Mongolia",
				"Morocco",
				"Mozambique",
				"Myanmar",
				"Namibia",
				"Nauru",
				"Nepal",
				"Netherlands",
				"New Zealand",
				"Nicaragua",
				"Niger",
				"Nigeria",
				"Norway",
				"Oman",
				"Pakistan",
				"Palau",
				"Panama",
				"Papua New Guinea",
				"Paraguay",
				"Peru",
				"Philippines",
				"Poland",
				"Portugal",
				"Qatar",
				"Romania",
				"Russia",
				"Rwanda",
				"Saint Kitts and Nevis",
				"Saint Lucia",
				"Saint Vincent",
				"Samoa",
				"San Marino",
				"Sao Tome and Principe",
				"Saudi Arabia",
				"Senegal",
				"Serbia and Montenegro",
				"Seychelles",
				"Sierra Leone",
				"Singapore",
				"Slovakia",
				"Slovenia",
				"Solomon Islands",
				"Somalia",
				"South Africa",
				"Spain",
				"Sri Lanka",
				"Sudan",
				"Suriname",
				"Swaziland",
				"Sweden",
				"Switzerland",
				"Syria",
				"Taiwan",
				"Tajikistan",
				"Tanzania",
				"Thailand",
				"Togo",
				"Tonga",
				"Trinidad and Tobago",
				"Tunisia",
				"Turkey",
				"Turkmenistan",
				"Tuvalu",
				"Uganda",
				"Ukraine",
				"United Arab Emirates",
				"United Kingdom",
				"United States",
				"Uruguay",
				"Uzbekistan",
				"Vanuatu",
				"Vatican City",
				"Venezuela",
				"Vietnam",
				"Yemen",
				"Zambia",
				"Zimbabwe"
			);
		
		$this->form_validation->set_rules('employee_fname', 'First Name', 'required');
		$this->form_validation->set_rules('employee_sname', 'Surname', 'required');
		$this->form_validation->set_rules('employee_cname', 'Common Name', 'required');
		$this->form_validation->set_rules('employee_uname', 'Username', 'required|callback_username_check');
		$this->form_validation->set_rules('employee_email','','');
		$this->form_validation->set_rules('employee_homephone','','');
		$this->form_validation->set_rules('employee_mobile','','');
		$this->form_validation->set_rules('employee_paddress','','');
		$this->form_validation->set_rules('employee_postcode','','');
		$this->form_validation->set_rules('contact_mobile','','');
		$this->form_validation->set_rules('file','','');


		if ($this->form_validation->run() === FALSE)
		{
		
			$data['selected_country'] = $this->input->post('employee_country');
			$data['selected_title'] = $this->input->post('employee_title');
			$this->_data_render('app/employee/new_employee',$data);
		
		}
		else 
		{
		
			$config['upload_path'] = 'resources/images/employee/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = false;
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
		
			
		
		
			if ( ! $this->upload->do_upload('file'))
			{
				
            	$error = array('error' => $this->upload->display_errors());

            	$jpegStr = NULL;
                        
            	$newID = $this->employee_model->new_employeeID_db();

            	$username = $this->employee_model->new_employee($newID,$jpegStr);

            	$this->employee_model->close_ldap();
            	
            	$this->display_employee_byID($username);
            	
            	
            }
            else 
            {
		
				$newID = $this->employee_model->new_employeeID_db();
			
				$file_data  =   $this->upload->data();

				$fd = fopen($file_data['full_path'], 'r');

				$fsize=filesize($file_data['full_path']);

				$jpegStr = fread($fd, $fsize);
				
								
				$username = $this->employee_model->new_employee($newID,$jpegStr);

				$this->employee_model->close_ldap();

				fclose($fd);

				unlink($file_data['full_path']);

				$this->display_employee_byID($username);
			}
			
			
		}

	}

	public function display_employee_byID($id){

		$data = $this->employee_model->get_employee($id);

		$this->_data_render('app/employee/display_employee',$data);
	}





	public function edit_employee($id)
	{

		$this->data["custom_js"] ='			
								  
								    <script>
									   
									    $(document).ready(function() {   

									    	$("#employee_uname").keyup(function() {
									    		var email = $("#employee_uname").val() + "@bizwebsys.tk";
  												$("#employee_email").val(email);
											});

									    });
									  									   
								    </script>';

		
		

				

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		
		
		$this->form_validation->set_rules('employee_fname', 'First Name', 'required');
		$this->form_validation->set_rules('employee_sname', 'Surname', 'required');
		$this->form_validation->set_rules('employee_cname', 'Common Name', 'required');
		$this->form_validation->set_rules('employee_uname', 'Username', 'required|callback_check2['.$id.']');
		$this->form_validation->set_rules('employee_email','','');
		$this->form_validation->set_rules('employee_homephone','','');
		$this->form_validation->set_rules('employee_mobile','','');
		$this->form_validation->set_rules('employee_paddress','','');
		$this->form_validation->set_rules('employee_postcode','','');
		$this->form_validation->set_rules('contact_mobile','','');
		$this->form_validation->set_rules('file','','');


		$data = $this->employee_model->get_employee($id);

		$data['job_titles'] = array("Chief Executive Officer (CEO)","Chief Operating Officer (COO)","Chief Financial Officer (CFO)",
							    	"Vice President of Marketing","Vice President of Production","Operations manager","Quality control, safety, environmental manager",
							    	"Accountant, bookkeeper","Office manager","Receptionist","Foreperson, supervisor, lead person","Marketing manager",
							    	"Purchasing manager","Shipping and receiving manager","Professional staff");

		$data['country_list'] = array(
				"Afghanistan",
				"Albania",
				"Algeria",
				"Andorra",
				"Angola",
				"Antigua and Barbuda",
				"Argentina",
				"Armenia",
				"Australia",
				"Austria",
				"Azerbaijan",
				"Bahamas",
				"Bahrain",
				"Bangladesh",
				"Barbados",
				"Belarus",
				"Belgium",
				"Belize",
				"Benin",
				"Bhutan",
				"Bolivia",
				"Bosnia and Herzegovina",
				"Botswana",
				"Brazil",
				"Brunei",
				"Bulgaria",
				"Burkina Faso",
				"Burundi",
				"Cambodia",
				"Cameroon",
				"Canada",
				"Cape Verde",
				"Central African Republic",
				"Chad",
				"Chile",
				"China",
				"Colombi",
				"Comoros",
				"Congo (Brazzaville)",
				"Congo",
				"Costa Rica",
				"Cote d'Ivoire",
				"Croatia",
				"Cuba",
				"Cyprus",
				"Czech Republic",
				"Denmark",
				"Djibouti",
				"Dominica",
				"Dominican Republic",
				"East Timor (Timor Timur)",
				"Ecuador",
				"Egypt",
				"El Salvador",
				"Equatorial Guinea",
				"Eritrea",
				"Estonia",
				"Ethiopia",
				"Fiji",
				"Finland",
				"France",
				"Gabon",
				"Gambia, The",
				"Georgia",
				"Germany",
				"Ghana",
				"Greece",
				"Grenada",
				"Guatemala",
				"Guinea",
				"Guinea-Bissau",
				"Guyana",
				"Haiti",
				"Honduras",
				"Hungary",
				"Iceland",
				"India",
				"Indonesia",
				"Iran",
				"Iraq",
				"Ireland",
				"Israel",
				"Italy",
				"Jamaica",
				"Japan",
				"Jordan",
				"Kazakhstan",
				"Kenya",
				"Kiribati",
				"Korea, North",
				"Korea, South",
				"Kuwait",
				"Kyrgyzstan",
				"Laos",
				"Latvia",
				"Lebanon",
				"Lesotho",
				"Liberia",
				"Libya",
				"Liechtenstein",
				"Lithuania",
				"Luxembourg",
				"Macedonia",
				"Madagascar",
				"Malawi",
				"Malaysia",
				"Maldives",
				"Mali",
				"Malta",
				"Marshall Islands",
				"Mauritania",
				"Mauritius",
				"Mexico",
				"Micronesia",
				"Moldova",
				"Monaco",
				"Mongolia",
				"Morocco",
				"Mozambique",
				"Myanmar",
				"Namibia",
				"Nauru",
				"Nepal",
				"Netherlands",
				"New Zealand",
				"Nicaragua",
				"Niger",
				"Nigeria",
				"Norway",
				"Oman",
				"Pakistan",
				"Palau",
				"Panama",
				"Papua New Guinea",
				"Paraguay",
				"Peru",
				"Philippines",
				"Poland",
				"Portugal",
				"Qatar",
				"Romania",
				"Russia",
				"Rwanda",
				"Saint Kitts and Nevis",
				"Saint Lucia",
				"Saint Vincent",
				"Samoa",
				"San Marino",
				"Sao Tome and Principe",
				"Saudi Arabia",
				"Senegal",
				"Serbia and Montenegro",
				"Seychelles",
				"Sierra Leone",
				"Singapore",
				"Slovakia",
				"Slovenia",
				"Solomon Islands",
				"Somalia",
				"South Africa",
				"Spain",
				"Sri Lanka",
				"Sudan",
				"Suriname",
				"Swaziland",
				"Sweden",
				"Switzerland",
				"Syria",
				"Taiwan",
				"Tajikistan",
				"Tanzania",
				"Thailand",
				"Togo",
				"Tonga",
				"Trinidad and Tobago",
				"Tunisia",
				"Turkey",
				"Turkmenistan",
				"Tuvalu",
				"Uganda",
				"Ukraine",
				"United Arab Emirates",
				"United Kingdom",
				"United States",
				"Uruguay",
				"Uzbekistan",
				"Vanuatu",
				"Vatican City",
				"Venezuela",
				"Vietnam",
				"Yemen",
				"Zambia",
				"Zimbabwe"
			);



		if ($this->form_validation->run() === FALSE)
		{	

			$data['selected_country'] = $this->input->post('employee_country');
			$data['selected_title'] = $this->input->post('employee_title');
			$this->_data_render('app/employee/edit_employee',$data);
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

            	$newID = $this->employee_model->update_employee($id,$jpegStr);

            	$this->employee_model->close_ldap();
            	
            	$this->display_employee_byID($newID);
            	
            	
            }
            else 
            {
					
				$file_data  =   $this->upload->data();

				$fd = fopen($file_data['full_path'], 'r');

				$fsize=filesize($file_data['full_path']);

				$jpegStr = fread($fd, $fsize);
				
				$newID = $this->employee_model->update_employee($id,$jpegStr);

				$this->employee_model->close_ldap();

				fclose($fd);

				unlink($file_data['full_path']);

				$this->display_employee_byID($newID);
			}
			
			
		}


	}
	
	
}