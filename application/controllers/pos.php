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
		$to_header["username"] = $this->session->userdata('username');         
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
										color:#A4A4EB;
									}									
									.item-list div
									{
										background-color:inherit;
									}
									.small-font
									{
										font-size:12px;
									}
									.label-warning
									{
										background-color:#F5F118;
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

										function item(ProductID,name,NetPrice,VATRate,stock,quantity,discount,selected)
										{
											this.ProductID = ProductID;
											this.name = name;
											this.NetPrice = NetPrice;
											this.VATRate = VATRate;
											this.stock = stock;
											this.quantity = quantity;
											this.discount = discount;
											this.selected = selected;
											this.QuantityString = quantity.toString();
											this.DiscountString = discount.toString();

											this.getDisplayPrice = getDisplayPrice;
											this.getTax = getTax;
											this.getTotal = getTotal;

											function getDisplayPrice()
											{
												var DisplayPrice = this.NetPrice * this.quantity * this.discount;
												return toFixed(DisplayPrice, 2);
											}

											function getTax()
											{
												var tax = this.NetPrice * this.quantity * this.discount * this.VATRate;
												return toFixed(tax, 2);
											}

											function getTotal()
											{
												var total = this.getDisplayPrice()+this.getTax();
												return toFixed(total, 2);
											}
										}

										function getTotal()
										{
											var total=0;
											for(i=0;i<items.length;i++)
											{
												total += items[i].getTotal(); 
											}
											return toFixed(total, 2);
										}

										function getTax()
										{
											var tax = 0;
											for(i=0;i<items.length;i++)
											{
												tax += items[i].getTax(); 
											}
											return toFixed(tax, 2);
										}

										function renderItemList()
										{
											$(\'#ItemList\').empty();
											for(i=0;i<items.length;i++)
											{
												if(items[i].selected==true)
												{
													var html = "<li value="+items[i].VATRate+" id=\'li_"+items[i].ProductID+"\' class=\'selected\'><div class=\'span2\'>"+items[i].name+"</div><div class=\'span1 price\'>£"+items[i].getDisplayPrice()+"</div>";
													if(items[i].quantity>1)
														html += "<div class=\"quantity span2\">quantity: x<b>"+items[i].QuantityString+"</b></div>";
													if(items[i].discount<1)
														html += "<div class=\"discount span2\">discount: x<b>"+items[i].DiscountString+"</b></div>";
													html += "</li>"	
													$(\'.item-list\').append(html);
												}
												else
												{
													var html = "<li value="+items[i].VATRate+" id=\'li_"+items[i].ProductID+"\'><div class=\'span2\'>"+items[i].name+"</div><div class=\'span1 price\'>£"+items[i].getDisplayPrice()+"</div>";
													if(items[i].quantity>1)
														html += "<div class=\"quantity span2\">quantity: x<b>"+items[i].QuantityString+"</b></div>";
													if(items[i].discount<1)
														html += "<div class=\"discount span2\">discount: x<b>"+items[i].DiscountString+"</b></div>";
													html += "</li>"	
													$(\'.item-list\').append(html);												
												}
											}
											$(\'#total\').text(getTotal());
											$(\'#tax\').text(getTax());
										}

										function renderReceiptItemList()
										{
											for(i=0;i<items.length;i++)
											{
												var html = "<tr><td class=\'span2\'>"+items[i].name+"</td><td class=\'span2\'>£"+items[i].getDisplayPrice()+"</td></tr>"
												if(items[i].quantity>1)
													html += "<tr><td class=\'span2 small-font\'>quantity: x"+items[i].quantity+"</td></tr>";
												if(items[i].discount<1)
													html += "<tr><td class=\'span2 small-font\'>discount: x"+items[i].discount+"</td></tr>";
												$(\'#receiptItemList\').append(html);	
											}
										}

									


										//Click on list item effect
										$(\'.item-list\').on(\'click\', \'li\', function () { 
											var i = getSelectedItemIndex();
											items[i].selected = false;

											$(\'li\').removeClass(\'selected\');
											$(this).addClass(\'selected\');	
											input="";

											i = getSelectedItemIndex();
											items[i].selected = true;
										});

										function getSelectedItemIndex()
										{
											var ProductID = $(\'.selected\').attr(\'id\').substr(3);
											for(i=0;i<items.length;i++)
											{
												if(ProductID == items[i].ProductID)
													break;
											}


											return i;
										}

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
													if($(this).text()=="0")
														return;
													
													var quantity = $(this).text();
												}
												else
												{
													var quantity = items[i].QuantityString;
													quantity += $(this).text();
												}
												items[i].QuantityString = quantity;
												items[i].quantity = parseInt(quantity);

											}
											else             //discount button selected
											{
												if(items[i].discount == 1)
												{
													if($(this).text()=="0")
														return;
													var discount = "0."+ $(this).text();
												}
												else
												{
													var discount = items[i].DiscountString;
													discount += $(this).text();
												}
												items[i].DiscountString = discount;
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
													if(items.length>=1)
														items[0].selected = true;
												}
												else
												{
													var quantity = items[i].QuantityString;
													if(quantity.length==1)
													{
														quantity = "1";
													}
													else
													{
														quantity = quantity.substr(0,quantity.length-1);
													}
													items[i].QuantityString = quantity;
													items[i].quantity = parseInt(quantity);
												}
											}
											else             //discount button selected
											{
												if(items[i].discount == 1)
												{
													items.splice(i,1);
													if(items.length>=1)
														items[0].selected = true;
												}
												else
												{
													var discount = items[i].DiscountString;
													if(discount.length <= 3)
													{
														discount = 1;
													}
													else
													{
														discount = discount.substr(0,discount.length-1);
													}
													items[i].DiscountString = discount;
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
															change = toFixed(change,2);
														}
														else
														{
															$(\'#btn_validate\').addClass("disabled");
															remain = total - cash;
															remain = toFixed(remain,2);
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
														var stock=parseFloat($(this).attr(\'stock\'));
														var DiscountRate=parseFloat($(this).attr(\'rel\'));
														
														appendItem(ProductID, name, NetPrice, VATRate, stock,DiscountRate);
													});


													function appendItem(ProductID, name, NetPrice, VATRate,stock, DiscountRate) {

														var isOnList = false;
														for(i=0;i<items.length;i++)
														{
															if(items[i].ProductID == ProductID)
															{
																isOnList = true;
																if(items[i].quantity<items[i].stock)
																{
																	items[i].quantity+=1;
																	items[i].QuantityString = items[i].quantity.toString();
																	break;
																}
																else
																{
																	alert("Sorry! Product is out of stock.");
																	break;
																}
															}
														}

														if(!isOnList) 
														{
															if(items.length==0)
																NewItem = new item(ProductID,name,NetPrice,VATRate,stock,1,DiscountRate,true);
															else
																NewItem = new item(ProductID,name,NetPrice,VATRate,stock,1,DiscountRate,false);
															items.push(NewItem);
														}
														renderItemList();

													}
												
													// Start HoraceLi




													var productListings = $(\'#product-list li\');

													$(\'#searchbox\').keyup(function() {
														var val = $.trim($(this).val()).replace(/ +/g, \' \').toLowerCase();

														productListings.show().filter(function() {
															var text = $(this).find(\'label\').text().replace(/\s+/g, \' \').toLowerCase();
															return !~text.indexOf(val);
														}).hide();
													});

												

													$(function(){

														var productList;

														$.ajax({
															url: \''. site_url('inventory/product_list') .'\',
															dataType: \'json\',
															success: function(JSONstream) {
															   productList = JSONstream;
															   $(\'#search button\').removeAttr("disabled");
																$(\'#search-feedback\').text("Ready").show(0).delay(1000).hide(0).text();
															}
														});

													   $("form#search").submit(function(event){

															event.preventDefault();

															var val = $(\'#searchbox\').val();
															$(\'#searchbox\').val("");

															for (var i = 0; i < productList.length; i++){
																if (productList[i].GTIN == val){
																	appendItem(productList[i].ItemID, productList[i].Name, productList[i].NetPrice, productList[i].VATRate, productList[i].DiscountRate);
																	return;
																}
															}

															$(\'#search-feedback\').text("No products found with GTIN " + val).show(0).delay(1000).hide(0).text();

															return;

														});


													});


													// End HoraceLi
												
												}
											});
										}



										function saveOrderShowReceipt()
										{
											var cash = parseFloat($(\'#input_cash\').val());
											var jsonItems = $.toJSON(items); 
											$.ajax({
												url: \''. site_url('pos/process_order') .'\',
												type: \'POST\',
												data: {items:jsonItems,cash:cash},
												success: function(response) {
													//load receipt to content
													$(\'#content\').html(response);
													renderReceiptItemList();
													receiptButtonFunc();
												}
											});
										}

										function receiptButtonFunc()
										{
											$(\'#btn_nextorder\').click(function(){
												window.location.href=\''.site_url('pos').'\';
											});

											$(\'#btn_print\').click(function() {
												//var prtContent = document.getElementById(\'receipt\');
												var html="<html>";
												html+="<head>";
												html+="<style type=\'text/css\'>.small-font {font-size:12px;} .text-center{text-align:center} .label{position:relative;}.span5{width:380px}.span4{width:300px}.span2{width:140px}.span1{width:60px}.offset1{margin-left:100px}.row{margin-left:-20px;*zoom:1;width:380px}</style>";
												html+="</head>";
												html+= document.getElementById(\'receipt\').innerHTML;
												html+="</html>";
												var WinPrint = window.open(\'\', \'\', \'letf=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0\');
												WinPrint.document.write(html);
												WinPrint.document.close();
												WinPrint.focus();
												WinPrint.print();
												WinPrint.close();
											});
										}

										$(function(){
											showProducts();
										});


										

									</script>';

		$this->_render('app/pos/pos');
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
				if(!(isset($_POST["items"]) && isset($_POST["cash"])))
			return;

		$date = date("Y_m_d");
		$payment_method = "Cash";
		$ref = "POS".date("d_m_Y_H_i_s");
		$employee_id = $this->session->userdata('employee_id');
		
		//create new order in salesorder table
		$this->pos_model->set_order($ref,$date,$payment_method,$employee_id);
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
		}

		$total = $subtotal + $tax;

		$data["items"] = $items;
		$data["date"] = date("d/m/Y");
		$data["time"] = date("H:i:s");
		$data["order_id"] = $order_id;
		$data["subtotal"] = round($subtotal,2);
		$data["tax"] = round($tax,2);
		$data["total"] = round($total,2);
		$data["cash"] = $_POST["cash"];
		$data["change"] = round($data["cash"] - $total,2);

		$this->load->view('app/pos/receipt',$data);
	}




}