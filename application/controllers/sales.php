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

	public function new_order()
	{

//		$this->load->helper(array('form', 'url'));
//		$this->load->library('form_validation');


		//display items
		$this->data["custom_js"] = '
		   <script>var item_list = ' . json_encode($this->inventory_model->get_item_list()) . '
		   
		   function updateRow(row){
				alert(row.find(\':selected\').val());
		   
		   
		   }
		   

		   
		   	function addRow() {
					var value = \'<tr><td><select class="item_select">\';
					
					for (var i = 0; i < item_list.length; i++){
						value += \'<option value="\' + item_list[i].ItemID + \'">\' + item_list[i].Name + \'</option>\';
					}
					
					
					
					value += \'</select></td>\';
					
					value += \'<td><input type="text" name="quantity"/></td>\';
					
					value += \'<td class="tax">VATRate * NetPrice * DiscountRate</td>\';
					
					value += \'<td class="unitprice">NetPrice * DiscountRate</td>\';
					
					value += \'<td class="amount">Quantity * NetPrice * DiscountRate</td></tr>\';
					
					$("#table tr:last").before(value);
					
					
					
					$(\'.item_select\').on("change", function(event){
						updateRow($(event.target).parentsUntil(\'tr\').parent());
				
					});
			};
		  
			$("#add").click(function(){
				addRow();
				
			});
			
			
		  
			$(document).ready(function(){
				
				$.ajax({
				
					url: \'' . site_url("sales/get_item_list") . '\',
					dataType: \'json\',
					success: function(stream){
						item_list = stream;
					}
				
				});
			


			});

				
			
		</script>';


		//customer list
		$data['customers'] = $this->sales_model->get_contact_list();
		$this->_data_render('app/sales/new_order', $data);


		//	$newID = $this->sales_model->set_item();
		//	$file_data = $this->upload->data();


		//$this->load->library('upload', $config);
		//$this->upload->initialize($config);
		/*if ( ! $this->upload->do_upload('file'))
			{
            	$error = array('error' => $this->upload->display_errors());
            	$newID = $this->sales_model->set_item();
            	$this->display_item_byID($newID);
            }
            else 
            {
				$newID = $this->sales_model->set_item();
				$file_data = $this->upload->data();
				rename($file_data['file_path'].$file_data['file_name'], $file_data['file_path'].$newID.$file_data['file_ext']); 
				$this->sales_model->set_imagepath($newID, $newID.$file_data['file_ext']);
				$this->display_item_byID($newID);
			}
	*/
		//	$this->_render('app/sales/new_order');
	}

	//display order

	public function display_order($orderid = "SO0001", $customer = "cust1", $date = "7/03/2013")
	{
		//data
		$this->data["orderid"] = $orderid;
		$this->data["customer"] = $customer;
		$this->data["date"] = $date;

		$this->_render('app/sales/display_order');
	}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//sales

	public function index()
	{

		$this->data["custom_js"] = '
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
			
			$("tr").click( function() {
				window.location = $(this).attr("href") + $(this).attr("id");
				}).hover( function() {
					$(this).toggleClass("hover");
				});
			
			});
			</script>';


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
		//  print_r( $data['customers'] = $this->contacts_model->contact_list('cn'));


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

		$data['$purchaseinvoices'] = $this->sales_model->get_cust_orders();
		$this->_data_render('app/sales/cust_payment', $data);
	}

	public function display_cust_order_by_id($purchaseinvoiceID)
	{

		$contact_list = $this->contacts_model->contact_list('cn');

		$data['purchaseinvoice'] = $this->sales_model->get_by_cust_orderID($purchaseinvoiceID);


		$data['datepaymentdue'] = $data['purchaseinvoice']['DatePaymentDue'];
		$data['ref'] = $data['purchaseinvoice']['Ref'];
		$data['contactCN'] = $contact_list[$data['purchaseinvoice']['ContactID']];
		$data['intref'] = $data['purchaseinvoice']['IntRef'];
		//     $data['total'] = $data['purchaseorder']['Total'];


		$data['contacts'] = $this->contacts_model->get_all_contact();

		/*foreach ($data['contacts'] as $contact) {
			if ($contact['uid'][0] == $data['contactID']) {
				$data['supplier'] = $contact['cn'][0];
			}
*/
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

		$this->_render('app/sales/sup_payment');
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