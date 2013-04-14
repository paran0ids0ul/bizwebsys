<?php
class Sales_model extends MY_Model
{

	public function __construct()
	{
		$this->load->database();
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

		$query = $this->db->get_where('SalesOrder', array('SalesOrderID' => $SalesOrderID));
		return $query->row_array();


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
}