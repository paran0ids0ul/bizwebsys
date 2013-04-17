<?php

class Settings extends MY_Controller {

	function __construct()
	{	
		parent::__construct();
		$this->load->model('settings_model');
	}

	public function index() {

		$this->edit_company();
	}

	public function edit_company() {


		$this->title = "My Company";

		$this->load->helper('form');
		$this->load->library('form_validation');


		$this->form_validation->set_rules('company_name', 'Company Name', 'required');
		$this->form_validation->set_rules('company_street1', '', '');
		$this->form_validation->set_rules('company_street2', '', '');
		$this->form_validation->set_rules('company_city', '', '');
		$this->form_validation->set_rules('company_state', '', '');
		$this->form_validation->set_rules('company_zip',  '', '');
		$this->form_validation->set_rules('company_country', '', '');
		$this->form_validation->set_rules('company_phone', '', '');
		$this->form_validation->set_rules('company_vatcode',  '', '');
		$this->form_validation->set_rules('file', '', '');


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



		$data['info'] = $this->settings_model->get_company_info();

		$data['name'] = $data['info']['Name'];
		$data['street1'] = $data['info']['Street1'];
		$data['street2'] = $data['info']['Street2'];
		$data['city'] = $data['info']['City'];
		$data['state'] = $data['info']['State'];
		$data['zip'] = $data['info']['Zip'];
		$data['country'] = $data['info']['Country'];
		$data['phone'] = $data['info']['Phone'];
		$data['vatcode'] = $data['info']['VATCode'];
		$data['imgpath'] = $data['info']['ImagePath'];

		if ($this->form_validation->run() === FALSE)
		{
			$data['selected_country'] = $this->input->post('company_country');

			$this->_data_render('panel/settings/settings_admin',$data);

		}
		else
		{
			$config['file_name'] = "company_logo";
			$config['upload_path'] = 'resources/images/company_logo/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = true;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);


			if ( ! $this->upload->do_upload('file'))
			{

				$error = array('error' => $this->upload->display_errors());


				$this->settings_model->update_company_info();


				$this->index();


			}
			else
			{

				$file_data  =   $this->upload->data();

				$filepath = $file_data['file_name'].$file_data['file_ext'];

				$this->settings_model->update_company_info_with_logo($filepath);

				$this->index();

			}


		}

	}
	
}	