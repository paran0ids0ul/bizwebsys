<?php


class Sales extends MY_Controller {
	function __construct()
	{	

		parent::__construct();
		$this->load->model('sales_model');
//		side menu
		$this->data["sidemenu"] = $this->load->view("app/sales/sidemenu",'',true);
	}

	//sales order
	public function index(){	
//		$data['orders'] = $this->sales_model->get_orders();
		$this->data["custom_js"] ='			
		  <script>
		 $(document).ready(function(){
		  
			$("#sales_all").click(function(){
				if ($(this).prop("checked") == true) { 
					$(".checkboxs").each(function() {
						$(this).prop("checked", true);
					});
				}
				else { 
					$(".checkboxs").each(function() {
						$(this).prop("checked", false);
					});
				}
			});
			
			
			});
			</script>';	
		
//		$this->_data_render('app/sales/sales',$data);
		$this->_render('app/sales/sales');
	}
	
	public function new_order(){
		$data['customers'] = $this->sales_model->get_contact_list();
	
		$this->_render('app/sales/new_order');
	}
	
	public function display_order($orderid="SO0001",$customer="cust1",$date="7/03/2013"){
		//data
		$this->data["orderid"] = $orderid;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		
		$this->_render('app/sales/display_order');
	}
	
	//customer invoice
		public function cust_invoice(){
		
		$this->data["custom_js"] ='			
		  <script>
		 $(document).ready(function(){
		  
			$("#cust_invoice_all").click(function(){
				if ($(this).prop("checked") == true) { 
					$(".checkboxs").each(function() {
						$(this).prop("checked", true);
					});
				}
				else { 
					$(".checkboxs").each(function() {
						$(this).prop("checked", false);
					});
				}
			});
			
			
			});
			</script>';	
		  
		$this->_render('app/sales/cust_invoice');
	}
	
		public function display_invoice(){
		$this->_render('app/sales/display_invoice');
	}
	
	public function super_invoice($orderid="SAJ/2013/002",$customer="cust1",$date="7/03/2013",$paymentterm="12 days",$additioninfo="none"){
		//data
		$this->data["orderid"] = $orderid;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		$this->data["paymentterm"] = $paymentterm;
		$this->data["additioninfo"] = $additioninfo;
	
		$this->_render('app/sales/super_invoice');
	}
	
	public function payed_super_invoice($orderid="SAJ/2013/002",$customer="cust1",$date="7/03/2013",$paymentterm="12 days",$additioninfo="none"){
		//data
		$this->data["orderid"] = $orderid;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		$this->data["paymentterm"] = $paymentterm;
		$this->data["additioninfo"] = $additioninfo;
	
		$this->_render('app/sales/payed_super_invoice');
	}

	//customer payment
	public function cust_payment(){
		$this->data["custom_js"] ='			
		  <script>
		 $(document).ready(function(){
		  
			$("#cust_payment_all").click(function(){
				if ($(this).prop("checked") == true) { 
					$(".checkboxs").each(function() {
						$(this).prop("checked", true);
					});
				}
				else { 
					$(".checkboxs").each(function() {
						$(this).prop("checked", false);
					});
				}
			});
			
			
			});
			</script>';	
	
		$this->_render('app/sales/cust_payment');
	}

	public function new_payment(){
		$this->_render('app/sales/new_payment');
	}
	
	public function display_payment($orderid="BNK2/2013/0001",$customer="cust1",$date="7/03/2013",$paidamount="00.00",$paidmethod="EUR",$paymentref="none"){
		//data
		$this->data["orderid"] = $orderid;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		$this->data["paidamount"] = $paidamount;
		$this->data["paidmethod"] = $paidmethod;
		$this->data["paymentref"] = $paymentref;
		
		$this->_render('app/sales/display_payment');
	}
	
	//supplier invoice
	public function sup_invoice($invoiceid="EXJ/2013/0001",$supplier="cust1",$invdate="7/03/2013",$supplierno="012345",$duedate="09/03/2013"){
		//data
		$this->data["invoiceid"] = $invoiceid;
		$this->data["supplier"] = $supplier;
		$this->data["invdate"] = $invdate;
		$this->data["duedate"] = $duedate;
		$this->data["supplierno"] = $supplierno;

		
		$this->_render('app/sales/sup_invoice');
	}

	//supplier payment
	public function sup_payment(){
		$this->data["custom_js"] ='			
		  <script>
		 $(document).ready(function(){
		  
			$("#cust_payment_all").click(function(){
				if ($(this).prop("checked") == true) { 
					$(".checkboxs").each(function() {
						$(this).prop("checked", true);
					});
				}
				else { 
					$(".checkboxs").each(function() {
						$(this).prop("checked", false);
					});
				}
			});
			
			
			});
			</script>';	
	
		$this->_render('app/sales/sup_payment');
	}	
	
	public function sup_new_payment(){
		$this->_render('app/sales/sup_new_payment');
	}
	
	public function sup_display_payment($orderid="BNK2/2013/0001",$supplier="cust1",$date="7/03/2013",$paidamount="00.00",$paidmethod="EUR",$paymentref="none"){
		//data
		$this->data["orderid"] = $orderid;
		$this->data["supplier"] = $supplier;
		$this->data["date"] = $date;
		$this->data["paidamount"] = $paidamount;
		$this->data["paidmethod"] = $paidmethod;
		$this->data["paymentref"] = $paymentref;
		
		$this->_render('app/sales/sup_display_payment');
	}
}