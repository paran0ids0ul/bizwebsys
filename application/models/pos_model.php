<?php
class Pos_model extends MY_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_items()  
	{
		$query = $this->db->get('Inventory');
		return $query->result_array();
	}
	
	public function set_order($ref,$date,$payment_method,$employee_id)
	{
		$data = array(
			'Ref' => $ref,
			'DateInvoiced' => $date,
			'DatePaid' => $date, 
			'PaymentMethod' => $payment_method,
			'EmployeeID' => $employee_id
		);
		
		return $this->db->insert('SalesOrder', $data);
	}
	
	public function get_orderid($ref)
	{
		$query = $this->db->get_where('SalesOrder', array('Ref' => $ref));
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
			  return $row->SalesOrderID;
		   }
		}
		return null;
	}	
	
	public function set_lineorder($order_id,$product_id,$quantity,$net_price,$discount,$vat)
	{
		//deduct stock from inventory
		$query = $this->db->get_where('Inventory', array('ItemID' => $product_id));
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
			  $row->Stock -= $quantity;
			  $this->db->update('Inventory', $row, array('ItemID' => $product_id));
		   }
		}
	
		$data = array(
			'SalesOrderID' => $order_id,
			'ItemID' => $product_id,
			'Quantity' => $quantity,
			'NetPrice' => $net_price,
			'VAT' => $vat,
			'DiscountRate' => $discount
		);
		
		return $this->db->insert('SalesOrderLine', $data);
	}
}