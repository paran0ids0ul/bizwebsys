<?php
class Sales_model extends MY_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function dispatch_order($id, $date)
	{

		// check paid already
		$this->db->select('DatePaid, DateDispatched');
		$this->db->where('SalesOrderID', $id);
		$query = $this->db->get('SalesOrder');

	//	"SELECT DatePaid,DateDispatched from SalesOrder WHERE SalesOrderID = $id"

		// check not dispatched yet


		// check stock

		$this->db->select('ItemID');
		$this->db->from('Inventory');
		$this->db->join('SalesOrderLine', 'Inventory.ItemID = SalesOrderLine.ItemID');
		$this->db->join('SalesOrder','SalesOrderLine.SalesOrderID = SalesOrder.SalesOrderID');
		//$this->db->where('SalesOrder.SalesOrderID', $id);
		$this->db->where('Inventory.Stock <', 'SalesOrderLine.Quantity');
		//$this->db->count_all_results();
//		$query->row()->ItemID;
		$query = $this->db->get();
		print_r($query->result_array());
		$rowcount = $query->num_rows();



		//"SELECT Inventory.ItemID from Inventory (INNER JOIN SalesOrderLine USING ItemID) (INNER JOIN SalesOrder USING SalesOrderID) WHERE SalesOrder.SalesOrderID=$id AND Inventory.Stock < SalesOrderLine.Quantity"

		$data = array(
			'DateDispatched' => $date
		);

		$this->db->where('SalesOrderID', $id);
		return $this->db->update('SalesOrder', $data);

	}

	public function set_item()
	{
		$this->load->helper('url');


		$data = array(
			'Name' => $this->input->post('item_name'),
			//	'ItemType' => $this->input->post('item_category'),
			'ContactID' => $this->input->post('customer'),
			'DateOrdered' => $this->input->post('item_date'),
			//	'Description' => $this->input->post('item_description'),
			//'Stock' => $this->input->post('item_stock'),
			//'StockROP' => $this->input->post('item_rop'),
			//'Cost' => $this->input->post('item_costprice'),
			//'VATRate' => $this->input->post('item_vatrate'),
			//'GTIN' => $this->input->post('item_gtin'),
			//'NetPrice' => $this->input->post('item_netprice')

		);


		$this->db->insert('SalesOrder', $data);

		$id = $this->db->insert_id();

		return $id;

	}

	public function get_item_byID($itemID)
	{

		$query = $this->db->get_where('Inventory', array('ItemID' => $itemID));
		return $query->row_array();


	}

	public function get_orders() //return 2D array: cust_name,invoice_date,internal_ref,sales_person,due_date,outstanding,total(plz don't change the names)
	{
		$query = $this->db->get('SalesOrder');
		return $query->result_array();
	}

	public function get_order_list()
	{

		$query = $this->db->get('SalesOrder');
		return $query->result_array();

	}

	public function get_by_orderID($SalesOrderID)
	{

//        $this->db->select('SalesOrderID');
//        $this->db->where( 'ContactID = 4');
//        $this->db->where( 'DateInvoiced'== "2013-04-16");
//        $query = $this->db->get('SalesOrder');
		$query = $this->db->get_where('SalesOrder', array('SalesOrderID' => $SalesOrderID));


		return $query->row_array();

//        get_item_by_id($ItemID);

//        $SalesOrderID = [SalesOrderID];


	}

    public function get_order_lines_by_id($SalesOrderID){
        $this->db->select('*');
        $this->db->from('Inventory');
        $this->db->join('SalesOrderLine', 'SalesOrderLine.ItemID = Inventory.ItemID');
        $this->db->where( array('SalesOrderID' => $SalesOrderID));
        $query = $this->db->get();
        return $query->result_array();

    }

	public function close_ldap()
	{
		//TODO
	}

	/* public function get_order($orderid) {

			$query = $this->db->get_where('Inventory', array('ItemID' => $itemID));
			return $query->row_array();


		}
	*/

	public function get_cust_orders() //return 2D array: cust_name,invoice_date,internal_ref,sales_person,due_date,outstanding,total(plz don't change the names)
	{
		$query = $this->db->get('PurchaseInvoice');
		return $query->result_array();
	}

	public function get_by_cust_orderID($PurchaseInvoiceID)
	{

		$query = $this->db->get_where('PurchaseInvoice', array('PurchaseInvoiceID' => $PurchaseInvoiceID));
		return $query->row_array();


	}

    public function update_sales_payment($order_id,$payment_type,$date){
        $data = array(
            'PaymentMethod' =>$payment_type,
            'DatePaid'=>$date

        );
        $this->db->where('SalesOrderID',$order_id);
        return
            $this->db->update('SalesOrder',$data);

    }

	public function get_by_purchaselineID($invoicelineid)
	{
		$this->db->select('*');
		$this->db->from('PurchaseInvoice');
		$this->db->join('PurchaseInvoiceLine', 'PurchaseInvoiceLine.PurchaseInvoiceID = PurchaseInvoice.PurchaseInvoiceID');
		$this->db->where( array('PurchaseInvoiceLine.PurchaseInvoiceID' => $invoicelineid));
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_invoice_lines_by_id($invoicelineid){
		$this->db->select('*');
		$this->db->from('Inventory');
		$this->db->join('PurchaseInvoiceLine', 'PurchaseInvoiceLine.SKU = Inventory.SKU');
		$this->db->where( array('PurchaseInvoiceID' => $invoicelineid));
		$query = $this->db->get();
		return $query->result_array();

	}
}