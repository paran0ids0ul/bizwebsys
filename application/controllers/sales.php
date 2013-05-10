<?php

class Sales extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('sales_model');
		$this->load->model('contacts_model');
		$this->load->model('employee_model');
		$this->load->model('inventory_model');
//		unit test
		$this->load->library('unit_test');
//		side menu
		$this->data["sidemenu"] = $this->load->view("app/sales/sidemenu", '', true);
	}

	public function dispatch_now($id)
	{
		if ($this->sales_model->dispatch_order($id, date('Y-m-d'))) {
			header("HTTP/1.1 201 OK");
		} else {
			header("HTTP/1.1 400 OK");
		}
	}

	//Display Sales Order
	public function index()
	{
		//get JavaScript from another file
		$js_data = array();
		$this->data['custom_js'] = $this->load->view('app/sales/js/sales', $js_data, true);

		//get contacts, employee and sales orders
		$data['contact_list'] = $this->contacts_model->contact_list('cn');
		$data['employee_list'] = $this->employee_model->employee_list('cn');
		$data['salesorders'] = $this->sales_model->get_orders();

		$this->_data_render('app/sales/sales', $data);

		//test for salesorders retrieval datatype
		$test = $this->sales_model->get_orders();
		$test_name = "check salesorder array";
		echo $this->unit->run($test,'is_array',$test_name);

	}

	public function display_order_by_id($salesorderID)
	{

		//get contacts and employee names
		$contact_list = $this->contacts_model->contact_list('cn');
		$employee_list = $this->employee_model->employee_list('cn');

		//get sales orders
		$data['salesorder'] = $this->sales_model->get_by_orderID($salesorderID);

		//get the correspinding data
		$data['contactCN'] = $contact_list[$data['salesorder']['ContactID']];
		$data['dateinvoiced'] = $data['salesorder']['DateInvoiced'];
		$data['ref'] = $data['salesorder']['Ref'];
		$data['employeeCN'] = $employee_list[$data['salesorder']['EmployeeID']];
		$data['datepaymentdue'] = $data['salesorder']['DatePaymentDue'];
		$data['total'] = $data['salesorder']['Total'];

		$data['contacts'] = $this->contacts_model->get_all_contact();
	}


	//Create New Order
	public function new_invoice()
	{

		//get items from inventory and load JavaScript in another file
		$js_data['item_list'] = json_encode($this->inventory_model->get_item_list());
		$this->data['custom_js'] = $this->load->view('app/sales/js/new_invoice', $js_data, true);

		//get customer list
		$this->data['customers'] = $this->contacts_model->contact_list('cn');

		$this->_data_render('app/sales/new_invoice', $this->data);
	}



	//Display sales invoice
	public function view_invoice($salesorder = "1")
	{

		//for the modal, update payment type and paid date in database
		$order_id = $this->input->post('orderid');
		$payment_type = $this->input->post("paymenttype");
		$date = $this->input->post("date");
		if (!empty($payment_type)) {
			$this->sales_model->update_sales_payment($order_id, $payment_type, $date);
		}

		//display data
		$this->data['order'] = $this->sales_model->get_by_orderID($salesorder);
		$this->data['contact_list'] = $this->contacts_model->contact_list('cn');

		$this->data['items'] = $this->sales_model->get_order_lines_by_id($salesorder);

		$this->_render('app/sales/view_invoice', $this->data);
	}


	//Supplier Payment
	public function sup_invoice($invoicelineid = "56")
	{
		//data
		$js_data['item_list'] = json_encode($this->inventory_model->get_item_list());
		$this->data['supplier_js'] = $this->load->view('app/sales/js/sup_invoice', $js_data, true);

		//customer list
		$this->data['suppliers'] = $this->contacts_model->contact_list('cn');

		$this->_data_render('app/sales/sup_invoice', $this->data);
	}


	//Display Supplier Invoice
	public function sup_payment()
	{
		$this->data["custom_js"] = '
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

		$data['contact_list'] = $this->contacts_model->contact_list('cn');

		$data['purchaseinvoices'] = $this->sales_model->get_cust_orders();

		$this->_data_render('app/sales/sup_payment', $data);
	}

	public function display_cust_order_by_id($purchaseinvoiceID)
	{

		$contact_list = $this->contacts_model->contact_list('cn');

		$data['purchaseinvoice'] = $this->sales_model->get_by_cust_orderID($purchaseinvoiceID);

		$data['datepaymentdue'] = $data['purchaseinvoice']['DatePaymentDue'];
		$data['contactCN'] = $contact_list[$data['purchaseinvoice']['ContactID']];
		$data['intref'] = $data['purchaseinvoice']['IntRef'];

		$data['contacts'] = $this->contacts_model->get_all_contact();
	}

	//Create new purchases invoice
	public function sup_new_payment()
	{
		$this->data['suppliers'] = $this->contacts_model->contact_list('cn');
		$this->_data_render('app/sales/sup_new_payment', $this->data);
	}

	//Display purchases invoice
	public function sup_display_payment($orderid = "BNK2/2013/0001", $supplier = "cust1", $date = "7/03/2013", $paidamount = "00.00", $paidmethod = "EUR", $paymentref = "none")
	{
		//data
		$this->data["orderid"] = $orderid;
		$this->data["supplier"] = $supplier;
		$this->data["date"] = $date;
		$this->data["paidamount"] = $paidamount;
		$this->data["paidmethod"] = $paidmethod;
		$this->data["paymentref"] = $paymentref;


		$this->_data_render('app/sales/sup_display_payment', $this->data);
	}
}