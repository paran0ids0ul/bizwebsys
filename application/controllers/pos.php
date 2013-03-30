<?php


class Pos extends MY_Controller {
	function __construct()
	{	
		parent::__construct();
		//load database model
		$this->load->model('pos_model');
		
		//load left column
		$this->data["left_column"] = $this->load->view("app/pos/left_column",'',true);
		
		//load POS header
		$this->template="main_no_header";
		$to_header["username"] = "Jing";          //TODO: Model method required: getUsername()
		$this->data["header"] = $this->load->view("app/pos/header",$to_header,true);
		
		//load local CSS
		$this->data["custom_css"] ='
									<style type="text/css">
									
									.keypad
									{
										margin-top:40px;
									}
									
									.keypad-button
									{
										width:50px;
									}
									.keypad-button-big
									{
										width:70px;
									}	
									#add-button
									{
										margin-left:20px;
									}
									.product-container
									{
										background-color:#F9F9F9;
										padding-bottom:20px;
									}
									.thumbnails
									{
										margin-left:1px;
										mouse:pointer;
									}
									.thumbnail
									{
										width:100px;
										height:100px;
										background-color:#FFFFFF;
									}
									.thumbnail img
									{
										width:65px;
										height:65px;
									}
									.label
									{
										position:relative;
									}
									.btn-block
									{
										margin:10px;
										height:120px;
									}
									.item-list
									{
										list-style:none;
										cursor:pointer;
									}
									.item-list li:hover
									{
										background-color:#F9F9F9;
									}
									.selected
									{
										background-color:#F9F9F9;
									}									
									.item-list div
									{
										background-color:inherit;
									}
									</style>';
		//load local js
		$this->data["custom_js"] ='								  
								    <script>
									    var viewportHeight = $(window).height();
										$("#left_column").height(viewportHeight);
										$("#product_container").height(viewportHeight);
								    </script>';							

	}
	
	public function index(){
		
		//load local js
		$this->data["custom_js"] =$this->data["custom_js"].'	
								    <script>
										var items=new Array(); 
										function item(ProductID,name,NetPrice,VATRate,quantity,discount)
										{
											this.ProductID = ProductID;
											this.name = name;
											this.NetPrice = NetPrice;
											this.VATRate = VATRate;
											this.quantity = quantity;
											this.discount = discount;
											
											this.getDisplayPrice = getDisplayPrice;
											this.getTax = getTax;
											this.getTotal = getTotal;
											
											function getDisplayPrice()
											{
												return (this.NetPrice * this.quantity * this.discount);
											}
											
											function getTax()
											{
												return (this.NetPrice * this.quantity * this.discount * this.VATRate);
											}
											
											function getTotal()
											{
												return (this.getDisplayPrice()+this.getTax());
											}
										}
										
										function getTotal()
										{
											var total=0;
											for(i=0;i<items.length;i++)
											{
												total += items[i].getTotal(); 
											}
											return total;
										}
										
										function getTax()
										{
											var tax = 0;
											for(i=0;i<items.length;i++)
											{
												tax += items[i].getTax(); 
											}
											return tax;
										}
										
										function renderItemList()
										{
											$(\'#ItemList\').empty();
											for(i=0;i<items.length;i++)
											{
												if(i==0)
												{
													var html = "<li value="+items[i].VATRate+" id=\'li_"+items[i].ProductID+"\' class=\'selected\'><div class=\'span2\'>"+items[i].name+"</div><div class=\'span1 price\'>£"+items[i].getDisplayPrice()+"</div>";
													if(items[i].quantity>1)
														html += "<div class=\"quantity span2\">quantity: x<b>"+items[i].quantity+"</b></div>";
													if(items[i].discount<1)
														html += "<div class=\"discount span2\">discount: x<b>"+items[i].discount+"</b></div>";
													html += "</li>"	
													$(\'.item-list\').append(html);
												}
												else
												{
													var html = "<li value="+items[i].VATRate+" id=\'li_"+items[i].ProductID+"\'><div class=\'span2\'>"+items[i].name+"</div><div class=\'span1 price\'>£"+items[i].getDisplayPrice()+"</div>";
													if(items[i].quantity>1)
														html += "<div class=\"quantity span2\">quantity: x<b>"+items[i].quantity+"</b></div>";
													if(items[i].discount<1)
														html += "<div class=\"discount span2\">discount: x<b>"+items[i].discount+"</b></div>";
													html += "</li>"	
													$(\'.item-list\').append(html);												
												}
											}
											$(\'#total\').text(getTotal());
											$(\'#tax\').text(getTax());
										}
										
										//Add item to list
										$(\'.thumbnail\').click(function(){
											var ProductID=$(this).attr(\'id\');
											var name=$(this).children(\'label\').text();
											var NetPrice=parseFloat($(this).children(\'span\').text().substr(1));
											var VATRate=parseFloat($(this).attr(\'value\'));
											
											var isOnList = false;
											for(i=0;i<items.length;i++)
											{
												if(items[i].ProductID == ProductID)
												{
													isOnList = true;
													items[i].quantity+=1;
													break;
												}
											}
											
											if(isOnList == false)
											{
												NewItem = new item(ProductID,name,NetPrice,VATRate,1,1);
												items.push(NewItem);
											}
											renderItemList();
								
										});
										
										
										//Click on list item effect
										$(\'.item-list\').on(\'click\', \'li\', function () { 
											$(\'li\').removeClass(\'selected\');
											$(this).addClass(\'selected\');	
											input="";
										});
										
										//Round float number to fixed decimal places
										function toFixed(num, fixed) {
											fixed = fixed || 0;
											fixed = Math.pow(10, fixed);
											return Math.floor(num * fixed) / fixed;
										}
										
										var button=1;
										
										//Toggle control buttons in keypad
										$(\'.control\').click(function(){
											$(\'.control\').removeClass(\'btn-primary\');
											$(this).addClass(\'btn-primary\');	
											var id=$(this).attr(\'id\')
											if(id==\'btn_qty\')
												button=1;
											else 	
												button=2;
										});
										
										//Press key buttons effect
										$(\'.key\').click(function(){
										
											if($(\'.selected\').size()==0)
												return;
												
											var ProductID = $(\'.selected\').attr(\'id\').substr(3);
											for(i=0;i<items.length;i++)
											{
												if(ProductID == items[i].ProductID)
													break;
											}
											
											if(button == 1)      //quantity button selected
											{
												if(items[i].quantity == 1)
												{
													var quantity = $(this).text();
												}
												else
												{
													var quantity = items[i].quantity.toString();
													quantity += $(this).text();
												}
												items[i].quantity = parseInt(quantity);
												
											}
											else             //discount button selected
											{
												if(items[i].discount == 1)
												{
													var discount = "0."+ $(this).text();
												}
												else
												{
													var discount = items[i].discount.toString();
													discount += $(this).text();
												}
												items[i].discount = parseFloat(discount);
											}
											
											renderItemList();
										});
										
										//Delete button effect
										$(\'#btn_del\').click(function(){
											if($(\'.selected\').size()==0)
												return;
												
											var ProductID = $(\'.selected\').attr(\'id\').substr(3);
											for(i=0;i<items.length;i++)
											{
												if(ProductID == items[i].ProductID)
													break;
											}
											
											if(button == 1)      //quantity button selected
											{
												if(items[i].quantity == 1)
												{
													items.splice(i,1);
												}
												else
												{
													var quantity = items[i].quantity.toString();
													if(quantity.length==1)
													{
														quantity = "1";
													}
													else
													{
														quantity = quantity.substr(0,quantity.length-1);
													}
													items[i].quantity = parseInt(quantity);
												}
											}
											else             //discount button selected
											{
												if(items[i].discount == 1)
												{
													items.splice(i,1);
												}
												else
												{
													var discount = items[i].discount.toString();
													if(discount.length <= 3)
													{
														discount = 1;
													}
													else
													{
														discount = discount.substr(0,discount.length-1);
													}
													items[i].discount = parseFloat(discount);
												}
											}
											
											renderItemList();	
												
										});
										
										$(\'#btn_cash\').click(function(){
											showPayment();
										});
											
										function showPayment()
										{
											$.ajax({
												url: \''. site_url('pos/payment') .'\',
												type: \'POST\',
												data: { total: $(\'#total\').text()},
												success: function(response) {
													//load payment to content
													$(\'#content\').html(response);
													$("#form_container").height(viewportHeight-200);
													
													//js for payment
													$(\'#btn_validate\').addClass("disabled");
													
													$(\'#input_cash\').keyup(function(){
														var cash = parseFloat($(\'#input_cash\').val());
														var total =  parseFloat($(\'#total\').text());
														var paid = cash;
														var remain,change;
														if(cash>=total)
														{
															$(\'#btn_validate\').removeClass("disabled");
															remain = 0.0;
															change = cash - total;
														}
														else
														{
															remain = total - cash;
															change = 0.0;
														}
														$(\'#paid\').text(paid);
														$(\'#remain\').text(remain);
														$(\'#change\').text(change);
													});
													
													$(\'#btn_back\').click(function(){
														showProducts();
													});
													
													$(\'#btn_validate\').click(function(){
														if($(this).hasClass(\'disabled\'))
															return;
														saveOrderShowReceipt();
													});
												}
											});
										}
										
										function showProducts()
										{
											$.ajax({
												url: \''. site_url('pos/products') .'\',
												type: \'POST\',
												success: function(response) {
													//load payment to content
													$(\'#content\').html(response);
													$("#product_container").height(viewportHeight);
													//Add item to list
										$(\'.thumbnail\').click(function(){
											var ProductID=$(this).attr(\'id\');
											var name=$(this).children(\'label\').text();
											var NetPrice=parseFloat($(this).children(\'span\').text().substr(1));
											var VATRate=parseFloat($(this).attr(\'value\'));
											
											var isOnList = false;
											for(i=0;i<items.length;i++)
											{
												if(items[i].ProductID == ProductID)
												{
													isOnList = true;
													items[i].quantity+=1;
													break;
												}
											}
											
											if(isOnList == false)
											{
												NewItem = new item(ProductID,name,NetPrice,VATRate,1,1);
												items.push(NewItem);
											}
											renderItemList();
								
										});
												}
											});
										}
										
										
										
										function saveOrderShowReceipt()
										{
											//var order_data = { 
												//				items:items,
												//				total:getTotal(),
											     //               tax:getTax()
												//			};
												
										//	var	jsonObj = items[0];
										//	var postData = JSON.stringify(jsonObj);
										//	var postArray = {json:postData};
										
											var jsonItems = $.toJSON(items); 
											$.ajax({
												url: \''. site_url('pos/process_order') .'\',
												type: \'POST\',
												data: {items:jsonItems},
												success: function(orderID) {
													
												
												
												
												
													//load receipt to content
													$(\'#content\').html(response);
												}
											});
										}
								    </script>';	
		$data['items'] = $this->pos_model->get_items();
		$param['toProducts'] =  $this->load->view('app/pos/products',$data,true);							
		
		$this->_data_render('app/pos/pos',$param);
	}
	public function products(){	
		$data['items'] = $this->pos_model->get_items();
		$this->load->view('app/pos/products',$data);
	}
	public function payment(){	
		$data["total"] = $_POST["total"];
		$this->load->view('app/pos/payment',$data);
	}
	
	public function process_order(){	
		if(!isset($_POST["items"]))
			return;
		$date = date("Y_m_d");
		$payment_method = "Cash";
		$ref = "POS".date("d_m_Y_H_i_s");
		
		//create new order in salesorder table
		$this->pos_model->set_order($ref,$date,$payment_method);
		$order_id = $this->pos_model->get_orderid($ref);
		
		//save items in salesorderline table
		$items = json_decode($_POST["items"]);
		
		$subtotal=0;
		$tax=0;
		foreach ($items as $item)
		{
			$product_id = $item->ProductID;
			$quantity = $item->quantity;
			$net_price = $item->NetPrice;
			$vat_rate = $item->VATRate;
			$discount = $item->discount;
			$vat = $net_price * $quantity * $discount * $vat_rate;
			
			$subtotal +=  $net_price * $quantity * $discount;
			$tax += $vat;
			$this->pos_model->set_lineorder($order_id,$product_id,$quantity,$net_price,$discount,$vat);
		//	$this->pos_model->set_lineorder($order_id-1,$product_id,$quantity,$net_price,$discount,$vat);
		//	$this->pos_model->set_lineorder($order_id-2,$product_id,$quantity,$net_price,$discount,$vat);
		}
		
		 $total = $subtotal + $tax;
		
		$data["items"] = $items;
		$data["date"] = $date;
		$data["time"] = date("H_i_s");
		$data["order_id"] = $order_id;
		$data["subtotal"] = $subtotal;
		$data["tax"] = $tax;
		$data["total"] = $total;
		$data["cash"] = $cash;
		$data["change"] = $cash - $total;
		
		
		$this->load->view('app/pos/receipt',$data);
	}
	
	
}