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
//		$this->load->helper(array('form', 'url'));
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

	public function index()
	{
		$js_data = [];
		$this->data['custom_js'] = $this->load->view('app/sales/js/sales', $js_data, true);

		$data['contact_list'] = $this->contacts_model->contact_list('cn');
		$data['employee_list'] = $this->employee_model->employee_list('cn');
		$data['salesorders'] = $this->sales_model->get_orders();

		$this->_data_render('app/sales/sales', $data);
	}

	public function display_order_by_id($salesorderID)
	{

		$contact_list = $this->contacts_model->contact_list('cn');
		$employee_list = $this->employee_model->employee_list('cn');

		$data['salesorder'] = $this->sales_model->get_by_orderID($salesorderID);


		$data['contactCN'] = $contact_list[$data['salesorder']['ContactID']];
		$data['dateinvoiced'] = $data['salesorder']['DateInvoiced'];
		$data['ref'] = $data['salesorder']['Ref'];
		$data['employeeCN'] = $employee_list[$data['salesorder']['EmployeeID']];
		$data['datepaymentdue'] = $data['salesorder']['DatePaymentDue'];
		$data['total'] = $data['salesorder']['Total'];


		$data['contacts'] = $this->contacts_model->get_all_contact();

		/*foreach ($data['contacts'] as $contact) {
			if ($contact['uid'][0] == $data['contactID']) {
				$data['supplier'] = $contact['cn'][0];
			}

		}
		*/


		//$this->_data_render('app/inventory/display_item',$data);

		//$this->sales_model->close_ldap(); TODO


	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//display invoice

	public function display_invoice()
	{

		$js_data['item_list'] = json_encode($this->inventory_model->get_item_list());
		$this->data['custom_js'] = $this->load->view('app/sales/js/display_invoice', $js_data, true);

		//customer list
		$this->data['customers'] = $this->contacts_model->contact_list('cn');


		$this->_data_render('app/sales/display_invoice', $this->data);
	}

	public function get_item_list()
	{
		$item_list = $this->db->get('Inventory')->result_array();
		header("Content-type: application/json");

		echo json_encode($item_list);
	}

	public function get_contact_list()
	{
//		$customers = $this->

	}

	//********************************************************************************************************/

	public function super_invoice($orderid)
	{
		//data


		$data = $this->sales_model->get_order($orderid);
		$data['salesorders'] = $this->sales_model->get_orders();


		$this->_render('app/sales/super_invoice');
	}

	public function edit_invoice($orderid = "SAJ/2013/002", $customer = "cust1", $date = "7/03/2013", $paymentterm = "12 days", $additioninfo = "none")
	{
		//data
		$this->data["orderid"] = $orderid;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		$this->data["paymentterm"] = $paymentterm;
		$this->data["additioninfo"] = $additioninfo;

		$data['salesorders'] = $this->sales_model->get_orders();

		$this->_render('app/sales/edit_invoice');
	}

	public function payed_super_invoice($orderid = "SAJ/2013/002", $customer = "cust1", $date = "7/03/2013", $paymentterm = "12 days", $additioninfo = "none")
	{
		//data
		$this->data["orderid"] = $orderid;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;
		$this->data["paymentterm"] = $paymentterm;
		$this->data["additioninfo"] = $additioninfo;

		$this->_render('app/sales/payed_super_invoice');
	}

	//customer payment

	public function cust_payment()
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

			$("tr").click( function() {
				window.location = $(this).attr("href") + $(this).attr("id");
				}).hover( function() {
					$(this).toggleClass("hover");
				});

			});

			</script>';


		$data['contact_list'] = $this->contacts_model->contact_list('cn');

		$data['salesorders'] = $this->sales_model->get_orders();
		$this->_data_render('app/sales/cust_payment', $data);
	}




	public function new_payment()
	{
		$this->_render('app/sales/new_payment');
	}

	public function display_payment($orderid = "BNK2/2013/0001", $customer = "cust1", $date = "7/03/2013", $paidamount = "00.00", $paidmethod = "EUR", $paymentref = "none")
	{
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

	public function sup_invoice($invoiceid = "EXJ/2013/0001", $supplier = "cust1", $invdate = "7/03/2013", $supplierno = "012345", $duedate = "09/03/2013")
	{
		//data
		$this->data["invoiceid"] = $invoiceid;
		$this->data["supplier"] = $supplier;
		$this->data["invdate"] = $invdate;
		$this->data["duedate"] = $duedate;
		$this->data["supplierno"] = $supplierno;


		$this->_render('app/sales/sup_invoice');
	}

	//supplier payment

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

		$this->_data_render('app/sales/sup_payment',$data);
	}

	public function display_cust_order_by_id($purchaseinvoiceID)
	{

		$contact_list = $this->contacts_model->contact_list('cn');

		$data['purchaseinvoice'] = $this->sales_model->get_by_cust_orderID($purchaseinvoiceID);


		$data['datepaymentdue'] = $data['purchaseinvoice']['DatePaymentDue'];
		$data['contactCN'] = $contact_list[$data['purchaseinvoice']['ContactID']];
		$data['intref'] = $data['purchaseinvoice']['IntRef'];
//	    $data['total'] = $data['purchaseinvoice']['Total'];


		$data['contacts'] = $this->contacts_model->get_all_contact();

		//foreach ($data['contacts'] as $contact) {
		//	if ($contact['uid'][0] == $data['contactID']) {
//				$data['supplier'] = $contact['cn'][0];
//			}

	}

	public function sup_new_payment()
	{
		$this->_render('app/sales/sup_new_payment');
	}

	public function sup_display_payment($orderid = "BNK2/2013/0001", $supplier = "cust1", $date = "7/03/2013", $paidamount = "00.00", $paidmethod = "EUR", $paymentref = "none")
	{
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