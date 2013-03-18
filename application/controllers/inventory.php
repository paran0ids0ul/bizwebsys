<?php


class Inventory extends MY_Controller {
	function __construct()
	{	

		parent::__construct();
		//$this->load->model('inventory');
	}

	//sales order
	public function index(){	
	
		
		//$data['items'] = $this->inventory->get_item_list();
		
		$this->_render('app/inventory/inventory');
		
		
		
		
		
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
									    
									    
									    $("#save_item").click(function () {
									    	if (! $("#new_item_form input").val() ) {
									    		alert("Please complete the form");
									    		return false;
									    	}
									    	
									    	if ( $("#item_category").val()=="null" ) {  
									    		alert("Please complete the form");
									    		return false;
									    	}
									    });
									    
									   
									    
									   
									   
									   });
									   
								    </script>';	
	
		$this->_render('app/inventory/new_item');
		
		
		
	}
	
	public function display_item(){
		$this->_render('app/inventory/display_item');
	}
	
}