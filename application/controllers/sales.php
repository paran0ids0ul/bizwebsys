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
		$js_data = array();
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

	public function new_invoice()
	{

		$js_data['item_list'] = json_encode($this->inventory_model->get_item_list());
		$this->data['custom_js'] = $this->load->view('app/sales/js/new_invoice', $js_data, true);

		//customer list
		$this->data['customers'] = $this->contacts_model->contact_list('cn');


		$this->_data_render('app/sales/new_invoice', $this->data);
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

	public function asdf($salesorder)
	{

		//$this->data["orderid"] = $this->sales_model->get_by_sorderID($salesorder);
		print_r( $this->data['items'] = $this->sales_model->get_order_lines_by_id($salesorder));
	}

	//********************************************************************************************************/

	public function view_invoice($salesorder = "1")
	{

//        $something = $this->input->post('something');
        $order_id =  $this->input->post('orderid');
        $payment_type = $this->input->post("paymenttype");
        $date = $this->input->post("date");
        if(!empty($payment_type)){
            $this->sales_model->update_sales_payment($order_id,$payment_type,$date);
        }


		//display data
		$this->data['order'] = $this->sales_model->get_by_orderID($salesorder);
        $this->data['contact_list'] = $this->contacts_model->contact_list('cn');

//        $data['itemid'] = $data['order']['itemID'];
        $this->data['items'] = $this->sales_model->get_order_lines_by_id($salesorder);

        //insert data




//        $data['salesorder'] = $data['SalesOrder']['SalesOrderID'];


//		$data = $this->sales_model->get_order($orderid);
//		$data['salesorders'] = $this->sales_model->get_orders();


		$this->_render('app/sales/view_invoice', $this->data);
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

	public function sup_invoice($invoicelineid = "56")
	{
		//data
		$this->data['pinvoice'] = $this->sales_model->get_by_purchaselineID($invoicelineid);

		$this->data['supplier'] = $this->contacts_model->contact_list('cn');
		$this->data['items'] = $this->sales_model->get_invoice_lines_by_id($invoicelineid);

		$this->_render('app/sales/sup_invoice',$this->data);
	}

	public function ds($invoicelineid)
	{
		print_r( $this->data['pinvoice'] = $this->sales_model->get_by_purchaselineID($invoicelineid));
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

		$this->_data_render('app/sales/sup_payment', $data);
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