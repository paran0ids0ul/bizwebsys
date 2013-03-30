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
	
	public function set_order($ref,$date,$payment_method)
	{
		$data = array(
			'Ref' => $ref,
			'DateOrdered' => $date,
			'PaymentDate' => $date,
			'PaymentMethod' => $payment_method
		);
		
		return $this->db->insert('salesorder', $data);
	}
	
	public function get_orderid($ref)
	{
		$query = $this->db->get_where('salesorder', array('Ref' => $ref));
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
		$data = array(
			'SalesOrderID' => $order_id,
			'ItemID' => $product_id,
			'Quantity' => $quantity,
			'NetPrice' => $net_price,
			'VAT' => $vat,
			'DiscountRate' => $discount
		);
		
		return $this->db->insert('salesorderline', $data);
	}
}