<?php


class Inventory extends MY_Controller {
	function __construct()
	{	
		
		parent::__construct();
		$this->load->model('inventory_model');
		
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
	
	public function new_item(){
	
	
	
		$this->data["custom_js"] ='			
		
							  
								    <script>
									    $(document).ready(function(){
									    
									    
									    var seloption ="";
									    
									    var item_category = ["Animals","Arts & Entertainment","Baby & Toddler",
									    "Business & Industrial","Cameras & Optics","Clothing & Accessories","Electronics","Food, Beverages & Tobacco","Furniture",
									    "Hardware","Gifts","Home & Beauty","Come & Garden","Luggage & Bags","Mature","Media","Office Supplies",
									    "Religious & Ceremonial","Software","Sporting Goods","Toys & Games","Vehicles & Parts","Other"];
									    
									    $.each(item_category, function(i) {
								
									    	seloption += \'<option value="\'+item_category[i]+\'">\'+item_category[i]+\'</option>\';
									    	
									    }); 						     
									    
									    $("#item_category").append(seloption);
									    
									   
									   
									    
									   
									   
									   });
									   
								    </script>';	
	
		$this->_render('app/inventory/new_item');
		
		
		
	}
	
	
	public function create() {
		
		
		$this->inventory->set_item();
		
		
		
	}
	
	
	public function display_item(){
		$this->_render('app/inventory/display_item');
	}
	
	
	public function display_item_byID($itemID)
	{
		$data['item'] = $this->inventory_model->get_item_byID($itemID);
		
		
		
		$data['name'] = $data['item']['Name'];
		$data['category'] = $data['item']['ItemType'];
		$data['supplier'] = $data['item']['contact_id'];
		$data['cost'] = $data['item']['Cost'];
		$data['net'] = $data['item']['NetPrice'];
		$data['vat'] = $data['item']['VATRate'];
		$data['stock'] = $data['item']['Stock'];
		$data['stockROP'] = $data['item']['StockROP'];
		$data['GTIN'] = $data['item']['GTIN'];
		$data['SKU'] = $data['item']['SKU'];
		$data['description'] = $data['item']['Description'];
		

		
		
		$this->_data_render('app/inventory/display_item',$data);
	
		
		
	}
	
}