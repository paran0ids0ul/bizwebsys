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
										$("#form_container").height(viewportHeight-200);
								    </script>';							

	}
	
	public function index(){
		//load local js
		$this->data["custom_js"] =$this->data["custom_js"].'	
								    <script>
										//Add item to list
										$(\'.thumbnail\').click(function(){
											var pd_id=$(this).attr(\'id\');
											var item_name=$(this).children(\'label\').text();
											var item_price=$(this).children(\'span\').text();
											var item_tax=$(this).attr(\'value\');
											
											var total=parseFloat($(\'#total\').text())+ parseFloat(item_price.substr(1));
											var tax=parseFloat($(\'#tax\').text())+parseFloat(item_tax);
											
											total=toFixed(total,2);
											tax=toFixed(tax,2);
											
											var size = $(".item-list li").filter("[id=\'li_"+pd_id+"\']").size();
											if(size==0)       //No same item on list
											{
												if($(".item-list li").size()==0)            //Item list is empty
													$(\'.item-list\').append("<li value="+item_tax+" id=\'li_"+pd_id+"\' class=\'selected\'><div class=\'span2\'>"+item_name+"</div><div class=\'span1 price\' value="+item_price+">"+item_price+"</div></li>");
												else                   //Item list is not empty
													$(\'.item-list\').append("<li value="+item_tax+" id=\'li_"+pd_id+"\' ><div class=\'span2\'>"+item_name+"</div><div class=\'span1 price\' value="+item_price+">"+item_price+"</div></li>");
											}
											else    //Got same item on list
											{
												var li = $(".item-list li").filter("[id=\'li_"+pd_id+"\']");
												var price=parseFloat(li.children(\'.price\').text().substr(1));
												price=price+parseFloat(item_price.substr(1));												
												if(li.children(\'div .quantity\').size()==0)  //No quantity label display
												{
													li.append(\'<div class="quantity span2">quantity: x<b>2</b></div>\');
												}
												else   //Have quantity label display
												{
													var quantity = parseInt(li.children(\'div .quantity\').children(\'b\').text())+1;
													li.children(\'div .quantity\').children(\'b\').text(quantity);
												}	
												li.children(\'div .price\').text(\'£\'+price);
											}
											$(\'#total\').text(total);
											$(\'#tax\').text(tax);
										
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
											else if(id==\'btn_disc\')	
												button=2;
											else
												button=3;
											input="";	
										});
										
										//Press key buttons effect
										$(\'.key\').click(function(){
											var input="";
											if($(\'.selected\').size()>0)
											{
												var item_price = $(\'.selected\').children(\'div .price\').attr(\'value\');
												var item_tax = parseFloat($(\'.selected\').attr(\'value\'));
												var display_price =  $(\'.selected\').children(\'div .price\').text().substr(1);
												var total= $(\'#total\').text();
												var tax=parseFloat($(\'#tax\').text());
												var tax_without,tax_new,total_without, total_new;
												var quantity_num,discount_num;
												if($(\'.selected\').children(\'div .quantity\').size()==0)   //No quantity label display
												{
													quantity_num = 1;
												}
												else
												{
													quantity_num = parseInt($(\'.selected\').children(\'div .quantity\').children(\'b\').text());
												}
												
												if($(\'.selected\').children(\'div .discount\').size()==0)        //No discount label displayed
												{
													discount_num = 1;
												}
												else
												{
													discount_num =parseFloat($(\'.selected\').children(\'div .discount\').children(\'b\').text());
												}
												
												switch(button)
												{
													//Quantity button selected
													case 1:{    
																
																
																if($(\'.selected\').children(\'div .quantity\').size()==0)       //No quantity label display
																{
																	input = $(this).text();
																	num=parseInt(input);
																	var price= parseFloat(item_price.substr(1))*num*discount_num;
																	$(\'.selected\').append(\'<div class="quantity span2">quantity: x<b>\'+input+\'</b></div>\');
																	$(\'.selected\').children(\'div .price\').text(\'£\'+price);
																	tax_without = tax - item_tax;
																	tax_new = tax_without + item_tax * parseInt(input);
																}
																else
																{
																	input = $(\'.selected\').children(\'div .quantity\').children(\'b\').text()+$(this).text();
																	num=parseInt(input);
																	var price= parseFloat(item_price.substr(1))*num*discount_num;
																	$(\'.selected\').children(\'div .quantity\').children(\'b\').text(input);
																	$(\'.selected\').children(\'div .price\').text(\'£\'+price);
																	tax_without = tax - item_tax*quantity_num;
																	tax_new = tax_without + item_tax * parseInt(input);
																}
																//Calculate total and taxes
																total_without = parseFloat(total)-parseFloat(display_price);
																var display_price_new = parseFloat($(\'.selected\').children(\'div .price\').text().substr(1));
																total_new = total_without + display_price_new;
																
																//Update total and taxes
																total_new=toFixed(total_new,2);
																tax_new=toFixed(tax_new,2);												
																$(\'#total\').text(total_new);
																$(\'#tax\').text(tax_new);
																break;
															}
													//Discount button selected		
													case 2: {    
															
																
																if($(\'.selected\').children(\'div .discount\').size()==0)          //No discount label display
																{
																	input=\'0.\'+$(this).text();
																	var discount=parseFloat(input);
																	var price= parseFloat(item_price.substr(1))*discount*quantity_num;	
																	price = toFixed(price,2);	
																
																	$(\'.selected\').append(\'<div class="discount span2">discount: x<b>\'+input+\'</b></div>\');
																	$(\'.selected\').children(\'div .price\').text(\'£\'+price);
																	total_without = parseFloat(total)-parseFloat(item_price.substr(1)) * quantity_num;
																}
																else
																{
																	input=$(\'.selected\').children(\'div .discount\').children(\'b\').text()+$(this).text();
																	var discount=parseFloat(input);
																	var price= parseFloat(item_price.substr(1))*discount*quantity_num;	
																	$(\'.selected\').children(\'div .discount\').children(\'b\').text(input);
																	$(\'.selected\').children(\'div .price\').text(\'£\'+price);
																	total_without = parseFloat(total)-parseFloat(item_price.substr(1)) * quantity_num * discount_num;
																}
																//Calculate total and taxes
																
																total_new = total_without + price;
																//Update total and taxes
																total_new=toFixed(total_new,2);									
																$(\'#total\').text(total_new);															
																break;
															}
													default:break;
												}
												

											}
										});
										
										//Delete button effect
										$(\'#btn_del\').click(function(){
												
												var item_price = $(\'.selected\').children(\'div .price\').attr(\'value\').substr(1);
												var total = parseFloat($(\'#total\').text());
												var item_tax = parseFloat($(\'.selected\').attr(\'value\'));
												var tax = parseFloat($(\'#tax\').text());
												var total_new,tax_new,total_without,tax_without;	
												if($(\'.selected\').children(\'div .quantity\').size()==0)   //No quantity label display
												{
													quantity_num = 1;
												}
												else
												{
													quantity_num = parseInt($(\'.selected\').children(\'div .quantity\').children(\'b\').text());
												}
												
												if($(\'.selected\').children(\'div .discount\').size()==0)        //No discount label displayed
												{
													discount_num = 1;
												}
												else
												{
													discount_num =parseFloat($(\'.selected\').children(\'div .discount\').children(\'b\').text());
												}												
												switch(button)
												{
													//Quantity button selected
													case 1:{    	
																var pre_quantity = parseInt($(\'.selected\').children(\'div .quantity\').children(\'b\').text());
															    input = $(\'.selected\').children(\'div .quantity\').children(\'b\').text();
																if(input!="")
																{
																	if(input.length>1)
																	{
																		input = input.substr(0,input.length-1);
																		num=parseInt(input);
																	}
																	else if(input!="1")
																	{
																		input="1";
																		num=parseInt(input);
																	}
																	else
																	{
																		input="";
																	}
																}	
																
																var price= parseFloat(item_price)*num*discount_num;
	
																if($(\'.selected\').children(\'div .quantity\').size()==0)       //No quantity label display
																{
																	total_without = total - parseFloat(item_price)*discount_num;
																	tax_without = tax - item_tax;
																	$(\'.selected\').remove();
																	total_new = total_without;
																	tax_new = tax_without;
																}
																else   //Has quantity label display
																{
																	if(input=="")
																	{
																		$(\'.selected\').remove();
																		total_without = total - parseFloat(item_price)*discount_num;
																		tax_without = tax - item_tax;
																		total_new = total_without;
																		tax_new = tax_without;
																	}
																	else
																	{
																		total_without = total - parseFloat(item_price) * pre_quantity*discount_num;
																		tax_without = tax - item_tax * pre_quantity;
																		$(\'.selected\').children(\'div .quantity\').children(\'b\').text(input);
																		$(\'.selected\').children(\'div .price\').text(\'£\'+price);
																		total_new = total_without+item_price*parseInt(input)*discount_num;
																		tax_new = tax_without+item_tax*parseInt(input);
																	}
																}	
																total_new=toFixed(total_new,2);
																tax_new=toFixed(tax_new,2);	
																$(\'#total\').text(total_new);
																$(\'#tax\').text(tax_new);																
																break;
															}
													//Discount button selected		
													case 2: {   	
																var discount = parseFloat(input);
																var price= parseFloat(item_price)*discount*quantity_num;
																if($(\'.selected\').children(\'div .discount\').size()==0)        //No discount label displayed
																{
																	total_without = total - parseFloat(item_price)*quantity_num;
																	$(\'.selected\').remove();
																	total_new = total_without;
																}
																else
																{
																	input = $(\'.selected\').children(\'div .discount\').children(\'b\').text();	
																	input = input.substr(0,input.length-1);
																	total_without = total - parseFloat(item_price)*discount_num*quantity_num;
																	if(input=="")
																	{
																		$(\'.selected\').remove();
																		total_new = total_without;
																	}
																	var discount = parseFloat(input);
																	if(discount==0)
																	{
																		discount = 1;
																		var price= parseFloat(item_price)*discount*quantity_num;
																		$(\'.selected\').children(\'div .discount\').remove();
																		$(\'.selected\').children(\'div .price\').text(\'£\'+price);
																		total_new = total_without + price;
																	}
																	var price= parseFloat(item_price)*discount*quantity_num;
																	$(\'.selected\').children(\'div .discount\').children(\'b\').text(input);
																	$(\'.selected\').children(\'div .price\').text(\'£\'+price);
																	total_new = total_without + price;
																}			
																total_new=toFixed(total_new,2);
																$(\'#total\').text(total_new);
																break;
															}
													default:break;
												}				
												
													
												if($(".item-list li").size()==0)            //Item list is empty
												{
													$(\'#total\').text(\'0.0\');
													$(\'#tax\').text(\'0.0\');	
												}
												
										});
										
										$(\'#btn_cash\').click(function(){
											$("#content").empty();
											showPayment();
										});
											
										function showPayment()
										{
											var	total = $(\'#total\').text();
											
											$.ajax({
												url: \''. site_url('pos/payment') .'\',
												type: \'POST\',
												data: total,
												success: function(response) {
													$(\'#content\').html(response);
												}
											});
										}
								    </script>';	
									
		$data['items'] = $this->pos_model->get_items();
		
		$this->_data_render('app/pos/pos',$data);
	}
	public function payment(){	
		//$this->_render('app/pos/payment');
		$total = $this->input->post('total');
		$this->load->view('app/pos/payment');
	
	}
	public function receipt(){	
		$this->_render('app/pos/receipt');
	}
}