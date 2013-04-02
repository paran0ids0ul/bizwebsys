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
		$this->form_validation->set_rules('contact_sname', ' Surname', 'required');
		$this->form_validation->set_rules('contact_cname', 'Common Name', 'required');
		$this->form_validation->set_rules('contact_hstreet1','','');
		$this->form_validation->set_rules('contact_hstreet2','','');
		$this->form_validation->set_rules('contact_hstate','','');
		$this->form_validation->set_rules('contact_hpostcode','','');
		$this->form_validation->set_rules('contact_work','','');
		$this->form_validation->set_rules('contact_mobile','','');
		$this->form_validation->set_rules('contact_fax','','');
		$this->form_validation->set_rules('contact_email','','');
		$this->form_validation->set_rules('contact_org','','');
		$this->form_validation->set_rules('contact_paddress','','');

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
		
			$data['selected_country'] = $this->input->post('contact_hcountry');
			$this->_data_render('app/contacts/new_contact',$data);
		
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
		$this->form_validation->set_rules('contact_sname', ' Surname', 'required');
		$this->form_validation->set_rules('contact_cname', 'Common Name', 'required');
		$this->form_validation->set_rules('contact_hstreet1','','');
		$this->form_validation->set_rules('contact_hstreet2','','');
		$this->form_validation->set_rules('contact_hstate','','');
		$this->form_validation->set_rules('contact_hpostcode','','');
		$this->form_validation->set_rules('contact_work','','');
		$this->form_validation->set_rules('contact_mobile','','');
		$this->form_validation->set_rules('contact_fax','','');
		$this->form_validation->set_rules('contact_email','','');
		$this->form_validation->set_rules('contact_org','','');
		$this->form_validation->set_rules('contact_paddress','','');



		$data = $this->contacts_model->get_contact($id);

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
			
			$data['selected_country'] = $this->input->post('contact_hcountry');

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
	
