<?php
class Sales_model extends MY_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function dispatch_order($id, $date)
	{

		// check paid already "SELECT DatePaid,DateDispatched from SalesOrder WHERE SalesOrderID = $id"
		$this->db->select('DatePaid, DateDispatched');
		$this->db->where('SalesOrderID', $id);
		$query = $this->db->get('SalesOrder');

		// check stock "SELECT Inventory.ItemID from Inventory (INNER JOIN SalesOrderLine USING ItemID) (INNER JOIN SalesOrder USING SalesOrderID) WHERE SalesOrder.SalesOrderID=$id AND Inventory.Stock < SalesOrderLine.Quantity"
		$this->db->select('ItemID');
		$this->db->from('Inventory');
		$this->db->join('SalesOrderLine', 'Inventory.ItemID = SalesOrderLine.ItemID');
		$this->db->join('SalesOrder','SalesOrderLine.SalesOrderID = SalesOrder.SalesOrderID');
		$this->db->where('Inventory.Stock <', 'SalesOrderLine.Quantity');

		$query = $this->db->get();
		print_r($query->result_array());
		$rowcount = $query->num_rows();

		$data = array(
			'DateDispatched' => $date
		);

		$this->db->where('SalesOrderID', $id);
		return $this->db->update('SalesOrder', $data);

	}

	//return 2D array: cust_id,invoice_date,internal_ref,sales_person,due_date,outstanding,total
	public function get_orders()
	{
		$query = $this->db->get('SalesOrder');
		return $query->result_array();
	}

	//get sales order with SalesOrderID
	public function get_by_orderID($SalesOrderID)
	{

		$query = $this->db->get_where('SalesOrder', array('SalesOrderID' => $SalesOrderID));
		return $query->row_array();

	}

	//update payment method and date paid
	public function update_sales_payment($order_id,$payment_type,$date){
		$data = array(
			'PaymentMethod' =>$payment_type,
			'DatePaid'=>$date

		);
		$this->db->where('SalesOrderID',$order_id);
		return
			$this->db->update('SalesOrder',$data);

	}

	//join Inventory and SalesOrderLine
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

//return 2D array: cust_id,invoice_date,internal_ref,sales_person,due_date,outstanding,total
	public function get_cust_orders()
	{
		$query = $this->db->get('PurchaseInvoice');
		return $query->result_array();
	}

	public function get_by_cust_orderID($PurchaseInvoiceID)
	{

		$query = $this->db->get_where('PurchaseInvoice', array('PurchaseInvoiceID' => $PurchaseInvoiceID));
		return $query->row_array();

	}

	//join PurchaseInvoiceLine and PurchaseInvoice
	public function get_by_purchaselineID($invoicelineid)
	{
		$this->db->select('*');
		$this->db->from('PurchaseInvoice');
		$this->db->join('PurchaseInvoiceLine', 'PurchaseInvoiceLine.PurchaseInvoiceID = PurchaseInvoice.PurchaseInvoiceID');
		$this->db->where( array('PurchaseInvoiceLine.PurchaseInvoiceID' => $invoicelineid));
		$query = $this->db->get();
		return $query->result_array();
	}

	//join PurchaseInvoiceLine and Inventory
	public function get_invoice_lines_by_id($invoicelineid){
		$this->db->select('*');
		$this->db->from('Inventory');
		$this->db->join('PurchaseInvoiceLine', 'PurchaseInvoiceLine.SKU = Inventory.SKU');
		$this->db->where( array('PurchaseInvoiceID' => $invoicelineid));
		$query = $this->db->get();
		return $query->result_array();

	}
}