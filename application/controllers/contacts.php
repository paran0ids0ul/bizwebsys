<?php


class Contacts extends MY_Controller {
	function __construct()
    {
		parent::__construct();
		$this->load->model('contacts_model');
	
	}

    // HoraceLi 8/4/2013
    public function contact_list($single_attr = '')
    {

        header('Content-type: application/json');

        $raw_contact_list = $this->contacts_model->get_ldap_contact_list();

        if ($single_attr === ''){
            echo @json_encode($raw_contact_list);
        } else {
            // Generates custom assoc array with uid as key and single attribute as value (e.g. /contacts/contact_list/cn)
            $contact_list = array();
            foreach ($raw_contact_list as $contact){
                if(isset($contact[$single_attr]) && $contact[$single_attr]['count'] > 0){
                    $contact_list[$contact['uid'][0]] = $contact[$single_attr][0];
                }
            }
            echo @json_encode($contact_list);
        }

        // Known "json_encode(): Invalid UTF-8 sequence in argument" error (currently suppressed) TODO

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

		$this->title = "Contacts";
		
	
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
		$this->form_validation->set_rules('contact_email','','valid_email');
		$this->form_validation->set_rules('contact_org','','');
		$this->form_validation->set_rules('contact_paddress','','');
		$this->form_validation->set_rules('file','','');

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
	
			$this->title = "New Contact";

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
                        
            	$newID = $this->contacts_model->new_contact_id_db();

            	$this->contacts_model->new_contact($newID,$jpegStr);

            	$this->contacts_model->close_ldap();
            	
            	$this->display_contact_by_id($newID);
            	
            	
            }
            else 
            {
		
				$newID = $this->contacts_model->new_contact_id_db();
			
				$file_data  =   $this->upload->data();

				$fd = fopen($file_data['full_path'], 'r');

				$fsize=filesize($file_data['full_path']);

				$jpegStr = fread($fd, $fsize);
				
								
				$this->contacts_model->new_contact($newID,$jpegStr);

				$this->contacts_model->close_ldap();

				fclose($fd);

				unlink($file_data['full_path']);

				$this->display_contact_by_id($newID);
			}
			
			
		}
	
		
	}

	public function delete_contact() {

		$id = $_POST['delete'];

		$result = $this->contacts_model->delete_contact($id);

		$this->contacts_model->close_ldap();

		if ($result == true) {
			echo "Contact has been successfully deleted !";
		} else 
		{
			echo "Unsuccessful !";
		}

	}


	
	public function display_contact_by_id($id)
	{

		$this->data["custom_js"] ='			
		
							  
								    <script>
									    $(document).ready(function(){
									    
										    
		
											$("#delete_button").on("click", function(e) {
										    	e.preventDefault();
	        									var href = this.href;
										    	var id = $("#reference").text();
										    	alert(id);
										    	var ajaxurl = "http://" + (document.location.hostname) + "/contacts/delete_contact"; 

												var confirm_string = "Are you sure you want to delete this contact?";
												var checkstr =  confirm(confirm_string);
												if (checkstr == true) {
														$.ajax({
													    	type: "POST",
													    	url: ajaxurl,
													    	data: {delete : id},
													    	success: function(results){ 
													    		alert(results);
													    		document.location.href = href;
													    	},
													    	error: function(xhr, textStatus, error){
													    		alert(xhr.statusText);
													    		alert(textStatus);
													    		alert(error);
													    	}
											    		});
												} else {
													return false;
												}
												
										    });

									   });
									   
								    </script>';	
		
		



		$data = $this->contacts_model->get_contact($id);

		$this->title = "Contact : ".$data['sn'];

		$this->_data_render('app/contacts/display_contact',$data);

		$this->contacts_model->close_ldap();
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
		$this->form_validation->set_rules('contact_email','','valid_email');
		$this->form_validation->set_rules('contact_org','','');
		$this->form_validation->set_rules('contact_paddress','','');
		$this->form_validation->set_rules('file','','');



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

		$this->title = "Edit Contact";
		
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
            	
            	$this->display_contact_by_id($id);
            	
            	
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

				$this->display_contact_by_id($id);
			}
			
			
		}


	}

}
	
