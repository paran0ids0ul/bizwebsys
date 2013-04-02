<?php

class Inventory extends MY_Controller {
	
	
	

	function __construct()
	{	
		
		parent::__construct();
		$this->load->model(array('inventory_model','contacts_model'));
		
		
		
	}

	//sales order
	public function index(){	
	
		
		$this->data["custom_js"] ='			
		
							  
								    <script>
									    $(document).ready(function(){
									  
									    
									    
									    $("tr").click( function() {
									    	window.location = $(this).attr("href") + $(this).attr("id");
									    }).hover( function() {
									    	$(this).toggleClass("hover");
									    });
									    
									   
									   
									   });
									   
								    </script>';
		
		
		$data['items'] = $this->inventory_model->get_item_list();
		
		
		$this->_data_render('app/inventory/inventory',$data);
		
		
		
	

		
		
	}


	public function gtin_check($gtin) {


		$gtin_chk = $this->inventory_model->gtin_exists($gtin);
		if ($gtin_chk) {
			$this->form_validation->set_message('gtin_check', 'The GTIN already exist in database');
			return FALSE;
		} else {
			return TRUE;
		}

	}

	public function gtin_check2($gtin) {


		$current_gtin = $this->input->post('item_gtin');

		if ($current_gtin != $gtin) {
			$gtin_chk = $this->inventory_model->gtin_exists($gtin);
			if ($gtin_chk) {
				$this->form_validation->set_message('gtin_check2', 'The GTIN already exist in database');
				return FALSE;
			} else {
				return TRUE;
			}
		} else {

			return TRUE;
		}

	}



	public function sku_check($sku) {



		$sku_chk = $this->inventory_model->sku_exists($sku);

		if ($sku_chk) {
			$this->form_validation->set_message('sku_check', 'The SKU already exist in database');
			return FALSE;
		} else {
			return TRUE;
		}



	}

	public function sku_check2($sku) {

		$current_sku = $this->input->post('item_sku');

		if ($current_sku != $sku)  {
			$sku_chk = $this->inventory_model->sku_exists($sku);

			if ($sku_chk) {
				$this->form_validation->set_message('sku_check2', 'The SKU already exist in database');
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			return TRUE;
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
									    	var id = $("#reference").val();
									    	
									    	$.ajax({
									    	type: "POST",
									    	url: "http://bizwebsys.cloudapp.net/inventory/stockup",
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
		$this->form_validation->set_rules('item_gtin', 'GTIN', 'callback_gtin_check2');
		$this->form_validation->set_rules('item_sku', 'SKU', 'callback_sku_check2');
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