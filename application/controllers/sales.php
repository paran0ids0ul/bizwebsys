<?php


class Sales extends MY_Controller {
	function __construct()
	{	
		parent::__construct();
	///	$this->load->model('sales_model');
		//side menu
		$this->data["sidemenu"] = $this->load->view("app/sales/sidemenu",'',true);
	}

	//sales order
	public function index(){	
		$data['orders'] = $this->sales_model->get_orders();
		$this->_data_render('app/sales/sales',$data);
	}
	
	public function neworder(){
		$this->_render('app/sales/neworder');
	}
	
	public function displayorder($orderid="SO0001",$customer="cust1",$date="7/03/2013"){
		//data
		$this->data["orderid"] = $orderid;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		
		$this->_render('app/sales/displayorder');
	}
	
	//customer invoice
		public function custinvoice(){
		$this->_render('app/sales/custinvoice');
	}
	
		public function displayinvoice(){
		$this->_render('app/sales/displayinvoice');
	}
	
	public function superinvoice($orderid="SAJ/2013/002",$customer="cust1",$date="7/03/2013",$paymentterm="12 days",$additioninfo="none"){
		//data
		$this->data["orderid"] = $orderid;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		$this->data["paymentterm"] = $paymentterm;
		$this->data["additioninfo"] = $additioninfo;
	
		$this->_render('app/sales/superinvoice');
	}
	
	public function payedsuperinvoice($orderid="SAJ/2013/002",$customer="cust1",$date="7/03/2013",$paymentterm="12 days",$additioninfo="none"){
		//data
		$this->data["orderid"] = $orderid;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		$this->data["paymentterm"] = $paymentterm;
		$this->data["additioninfo"] = $additioninfo;
	
		$this->_render('app/sales/payedsuperinvoice');
	}

	//customer payment
	public function custpayment(){
		$this->_render('app/sales/custpayment');
	}

	public function newpayment(){
		$this->_render('app/sales/newpayment');
	}
	
	public function displaypayment($orderid="BNK2/2013/0001",$customer="cust1",$date="7/03/2013",$paidamount="00.00",$paidmethod="EUR",$paymentref="none"){
		//data
		$this->data["orderid"] = $orderid;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		$this->data["paidamount"] = $paidamount;
		$this->data["paidmethod"] = $paidmethod;
		$this->data["paymentref"] = $paymentref;
		
		$this->_render('app/sales/displaypayment');
	}
	
	//supplier invoice
	public function supinvoice($invoiceid="EXJ/2013/0001",$supplier="cust1",$invdate="7/03/2013",$supplierno="012345",$duedate="09/03/2013"){
		//data
		$this->data["invoiceid"] = $invoiceid;
		$this->data["supplier"] = $supplier;
		$this->data["invdate"] = $invdate;
		$this->data["duedate"] = $duedate;
		$this->data["supplierno"] = $supplierno;

		
		$this->_render('app/sales/supinvoice');
	}

	//supplier payment
	public function suppayment(){
		$this->_render('app/sales/suppayment');
	}	
	
	public function supnewpayment(){
		$this->_render('app/sales/supnewpayment');
	}
	
	public function supdisplaypayment($orderid="BNK2/2013/0001",$supplier="cust1",$date="7/03/2013",$paidamount="00.00",$paidmethod="EUR",$paymentref="none"){
		//data
		$this->data["orderid"] = $orderid;
		$this->data["supplier"] = $supplier;
		$this->data["date"] = $date;
		$this->data["paidamount"] = $paidamount;
		$this->data["paidmethod"] = $paidmethod;
		$this->data["paymentref"] = $paymentref;
		
		$this->_render('app/sales/supdisplaypayment');
	}
}