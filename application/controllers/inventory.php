<?php

class Inventory extends MY_Controller {




	function __construct()
	{	

		parent::__construct();
		$this->load->model(array('inventory_model','contacts_model'));



	}


	public function delete_items() {


		$toDelete = json_decode(stripslashes($_POST['items']));

		foreach($toDelete as $id){
			$this->inventory_model->delete_item($id);
		}

	}

	public function delete_an_item() {


		$id = $_POST['delete'];


		$this->inventory_model->delete_item($id);


	}

	public function product_list()
	{

		header('Content-type: application/json');

		echo json_encode($this->inventory_model->get_item_list());
	}

	//sales order
	public function index(){	


		$this->data["custom_js"] ='			


									<script>
										$(document).ready(function(){



										$(".tr_clickable").click( function(e) {
											if (e.target.type == "checkbox") {
												e.stopPropagation();
											} else {
												window.location = $(this).attr("href") + $(this).attr("id");
											}
										}).hover( function() {
											$(this).toggleClass("hover");
										});


										$("#check_all").change(function() {
											if ($(this).is(":checked")) {
												$(".check_boxes").prop("checked",true);
											} else {
												$(".check_boxes").prop("checked",false);
											}

										});



										$("#delete_button").on("click", function(e) {
											e.preventDefault();
											var href = this.href;
											var ids = [];


											$(".check_boxes").each(function() {
												if ($(this).is(":checked")) {
													ids.push($(this).attr("id"));
												}
											});

											if (ids.length > 0) {
												var confirm_string = "Are you sure you want to delete " + ids.length + " item(s)?";
												var checkstr =  confirm(confirm_string);
												var ajaxurl = "http://" + (document.location.hostname) + "/inventory/delete_items"; 


												if (checkstr == true) {
													var ajaxData = { items: JSON.stringify(ids) };
														$.ajax({
															type: "POST",
															url: ajaxurl,
															data: ajaxData,
															success: function(results){
																alert("The operation is successful !");
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
											}
										});


									   });

									</script>';

		$this->title = "Inventory";


		$data['items'] = $this->inventory_model->get_item_list();


		$this->_data_render('app/inventory/inventory',$data);







	}


	public function gtin_check($gtin) {

		if ($gtin) {
			$gtin_chk = $this->inventory_model->gtin_exists($gtin);
			if ($gtin_chk) {
				$this->form_validation->set_message('gtin_check', 'The GTIN already exist in database');
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	public function gtin_check_edit($gtin) {		//for edit purposes because the current item will already have a gtin, if the it is not modified, this gtin will not be checked
												//if the gtin is modified, the new gtin will be check against the database to prevent duplicate.
		if ($gtin) {
			$current_gtin = $this->input->post('item_gtin');

			if ($current_gtin != $gtin) {
				$gtin_chk = $this->inventory_model->gtin_exists($gtin);
				if ($gtin_chk) {
					$this->form_validation->set_message('gtin_check_edit', 'The GTIN already exist in database');
					return FALSE;
				} else {
					return TRUE;
				}
			} else {

				return TRUE;
			}
		}

	}



	public function sku_check($sku) {


		if ($sku) {
			$sku_chk = $this->inventory_model->sku_exists($sku);

			if ($sku_chk) {
				$this->form_validation->set_message('sku_check', 'The SKU already exist in database');
				return FALSE;
			} else {
				return TRUE;
			}
		}

	}

	public function sku_check_edit($sku) {		//for edit purposes because the current item will already have a sku, if the it is not modified, this sku will not be checked
											//if the sku is modified, the new sku will be check against the database to prevent duplicate.
		if ($sku) {
			$current_sku = $this->input->post('item_sku');

			if ($current_sku != $sku)  {
				$sku_chk = $this->inventory_model->sku_exists($sku);

				if ($sku_chk) {
					$this->form_validation->set_message('sku_check_edit', 'The SKU already exist in database');
					return FALSE;
				} else {
					return TRUE;
				}
			} else {
				return TRUE;
			}
		}



	}


	public function rate_check($rate) {


		if ($rate < 0 || $rate > 1) {
			$this->form_validation->set_message('rate_check', 'The rate value is invalid');
			return FALSE;
		} else {
			return TRUE;
		}


	}



	public function new_item() {	

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$this->form_validation->set_rules('item_name', 'Item Name', 'required');
		$this->form_validation->set_rules('item_costprice', 'Cost Price', 'greater_than[0]');
		$this->form_validation->set_rules('item_netprice', 'Net Price', 'greater_than[0]');
		$this->form_validation->set_rules('item_vatrate', 'Vat Rate', 'callback_rate_check');
		$this->form_validation->set_rules('item_disrate', 'Discount Rate', 'callback_rate_check');
		$this->form_validation->set_rules('item_stock', 'Stock', 'integer|greater_than[0]');
		$this->form_validation->set_rules('item_rop', 'ROP', 'integer|greater_than[0]');
		$this->form_validation->set_rules('item_gtin', 'GTIN', 'callback_gtin_check');
		$this->form_validation->set_rules('item_sku', 'SKU', 'callback_sku_check');
		$this->form_validation->set_rules('item_description', '', '');
		$this->form_validation->set_rules('file', '', '');


		$data['itemType'] = array("Animals","Arts & Entertainment","Baby & Toddler",
										"Business & Industrial","Cameras & Optics","Clothing & Accessories","Electronics","Food, Beverages & Tobacco","Furniture",
										"Hardware","Gifts","Home & Beauty","Come & Garden","Luggage & Bags","Mature","Media","Office Supplies",
										"Religious & Ceremonial","Software","Sporting Goods","Toys & Games","Vehicles & Parts","Other");

		$this->title = "New Item";


		if ($this->form_validation->run() === FALSE)
		{
			$data['contacts'] = $this->contacts_model->get_all_contact();
			$data['selected_category'] = $this->input->post('item_category');
			$data['selected_supplier'] = $this->input->post('supplier');

			$this->_data_render('app/inventory/new_item',$data);

			$this->contacts_model->close_ldap();

		}
		else 
		{

			$config['upload_path'] = 'resources/images/inventory/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = false;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);




			if ( ! $this->upload->do_upload('file'))
			{

				$error = array('error' => $this->upload->display_errors());


				$newID = $this->inventory_model->set_item();


				$this->display_item_byID($newID);


			}
			else
			{

				$newID = $this->inventory_model->set_item();


				$file_data  =   $this->upload->data();


				rename($file_data['file_path'].$file_data['file_name'], $file_data['file_path'].$newID.$file_data['file_ext']); 


				$this->inventory_model->set_imagepath($newID, $newID.$file_data['file_ext']);


				$this->display_item_byID($newID);
			}


		}


	}






	public function display_item_byID($itemID)
	{
		$data['item'] = $this->inventory_model->get_item_byID($itemID);


		$data['itemID'] = $data['item']['ItemID'];
		$data['name'] = $data['item']['Name'];
		$data['category'] = $data['item']['ItemType'];
		$data['contactID'] = $data['item']['ContactID'];
		$data['cost'] = $data['item']['Cost'];
		$data['net'] = $data['item']['NetPrice'];
		$data['vat'] = $data['item']['VATRate'];
		$data['dis'] = $data['item']['DiscountRate'];
		$data['stock'] = $data['item']['Stock'];
		$data['stockROP'] = $data['item']['StockROP'];
		$data['GTIN'] = $data['item']['GTIN'];
		$data['SKU'] = $data['item']['SKU'];
		$data['desc'] = $data['item']['Description'];
		$data['imgpath'] = $data['item']['Imagepath'];

		$this->title = "Item : ".$data['name'];

		$data['contacts'] = $this->contacts_model->get_all_contact();

		foreach ($data['contacts'] as $contact) {
			if ($contact['uid'][0] == $data['contactID']) {
				$data['supplier'] = $contact['cn'][0];
			}

		}

		$this->data["custom_js"] ='			


									<script>
										$(document).ready(function(){

											$("#stockup").click(function() {


												var addamount = $("#addstock").val();
												var id = $("#reference").text();
												var ajaxurl = "http://" + (document.location.hostname) + "/inventory/stockup";

												$.ajax({
												type: "POST",
												url: ajaxurl,
												data: { amount : addamount , itemID : id },
												success: function(results){

													$("#item_stock").html(results);

												},
												error: function(xhr, textStatus, error){
													alert(xhr.statusText);
													alert(textStatus);
													alert(error);
												}
												});

											});

											$("#delete_button").on("click", function(e) {
												e.preventDefault();
												var href = this.href;
												var id = $("#reference").text();

												var confirm_string = "Are you sure you want to delete this item?";
												var checkstr =  confirm(confirm_string);
												var ajaxurl = "http://" + (document.location.hostname) + "/inventory/delete_an_item";
												if (checkstr == true) {
														$.ajax({
															type: "POST",
															url: ajaxurl,
															data: {delete : id},
															success: function(results){
																alert("The operation is successful !");
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






		$this->_data_render('app/inventory/display_item',$data);

		$this->contacts_model->close_ldap();



	}


	public function stockup() {




		$toAdd = $_POST['amount'];
		$id = $_POST['itemID'];

		$newStock = $this->inventory_model->update_stock($id,$toAdd);

		echo $newStock;


	}

	public function edit_item($itemID)
	{

		$this->data["custom_js"] ='			


									<script>
										$(document).ready(function(){

										$("#changeImg").click(function() {
											if ($("#file").val() != "") {
												$("#imgThumbnail").attr("src","/resources/images/no_image.gif");
											}

										});





									   });

									</script>';



		$this->load->helper('form');
		$this->load->library('form_validation');		


		$this->form_validation->set_rules('item_name', 'Item Name', 'required');
		$this->form_validation->set_rules('item_costprice', 'Cost Price', 'greater_than[0]');
		$this->form_validation->set_rules('item_netprice', 'Net Price', 'greater_than[0]');
		$this->form_validation->set_rules('item_vatrate', 'Vat Rate', 'callback_rate_check');
		$this->form_validation->set_rules('item_disrate', 'Discount Rate', 'callback_rate_check');
		$this->form_validation->set_rules('item_stock', 'Stock', 'integer|greater_than[0]');
		$this->form_validation->set_rules('item_rop', 'ROP', 'integer|greater_than[0]');
		$this->form_validation->set_rules('item_gtin', 'GTIN', 'callback_gtin_check_edit');
		$this->form_validation->set_rules('item_sku', 'SKU', 'callback_sku_check_edit');
		$this->form_validation->set_rules('item_description', '', '');
		$this->form_validation->set_rules('file', '', '');


		$data['itemType'] = array("Animals","Arts & Entertainment","Baby & Toddler",
									"Business & Industrial","Cameras & Optics","Clothing & Accessories","Electronics","Food, Beverages & Tobacco","Furniture",
									"Hardware","Gifts","Home & Beauty","Come & Garden","Luggage & Bags","Mature","Media","Office Supplies",
									"Religious & Ceremonial","Software","Sporting Goods","Toys & Games","Vehicles & Parts","Other");

		$data['item'] = $this->inventory_model->get_item_byID($itemID);


		$data['itemID'] = $data['item']['ItemID'];
		$data['name'] = $data['item']['Name'];
		$data['category'] = $data['item']['ItemType'];
		$data['contactID'] = $data['item']['ContactID'];
		$data['cost'] = $data['item']['Cost'];
		$data['net'] = $data['item']['NetPrice'];
		$data['vat'] = $data['item']['VATRate'];
		$data['dis'] = $data['item']['DiscountRate'];
		$data['stock'] = $data['item']['Stock'];
		$data['stockROP'] = $data['item']['StockROP'];
		$data['GTIN'] = $data['item']['GTIN'];
		$data['SKU'] = $data['item']['SKU'];
		$data['desc'] = $data['item']['Description'];
		$data['imgpath'] = $data['item']['Imagepath'];

		$this->title = "Edit Item";


		if ($this->form_validation->run() === FALSE)
		{

			$data['contacts'] = $this->contacts_model->get_all_contact();

			$data['selected_category'] = $this->input->post('item_category');
			$data['selected_supplier'] = $this->input->post('supplier');

			$this->_data_render('app/inventory/edit_item',$data);

			$this->contacts_model->close_ldap();

		}
		else 
		{

			$config['upload_path'] = 'resources/images/inventory/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['overwrite'] = false;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);




			if ( ! $this->upload->do_upload('file'))
			{

				$error = array('error' => $this->upload->display_errors());


				$this->inventory_model->update_item($itemID);


				$this->display_item_byID($itemID);


			}
			else
			{
				$data['item'] = $this->inventory_model->get_item_byID($itemID);
				$path = $data['item']['Imagepath'];

				if ($path != "") {

					unlink("resources/images/inventory/$path");
				}

				$this->inventory_model->update_item($itemID);

				$file_data  =   $this->upload->data();


				rename($file_data['file_path'].$file_data['file_name'], $file_data['file_path'].$itemID.$file_data['file_ext']); 




				$this->inventory_model->set_imagepath($itemID, $itemID.$file_data['file_ext']);

				$this->display_item_byID($itemID);

			}


		}




	}




}