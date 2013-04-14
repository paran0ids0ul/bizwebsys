<?php
class Inventory_model extends MY_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function get_item_list()
	{

		$query = $this->db->get('Inventory');
		return $query->result_array();

	}

	public function get_contact_list()
	{

		$query = $this->db->get('Contact');
		return $query->result_array();

	}

	public function set_item()
	{
		$this->load->helper('url');


		$costprice = ($this->input->post('item_costprice') == NULL ? NULL : $this->input->post('item_costprice'));
		$netprice = ($this->input->post('item_netprice') == NULL ? NULL : $this->input->post('item_netprice'));
		$vatrate = ($this->input->post('item_vatrate') == NULL ? NULL : $this->input->post('item_vatrate'));
		$disrate = ($this->input->post('item_disrate') == NULL ? 1 : $this->input->post('item_disrate'));
		$stock = ($this->input->post('item_stock') == NULL ? NULL : $this->input->post('item_stock'));
		$stockrop = ($this->input->post('item_rop') == NULL ? NULL : $this->input->post('item_rop'));
		$SKU = ($this->input->post('item_sku') == NULL ? NULL : $this->input->post('item_sku'));
		$GTIN = ($this->input->post('item_gtin') == NULL ? NULL : $this->input->post('item_gtin'));


		$data = array(
			'Name' => $this->input->post('item_name'),
			'ItemType' => $this->input->post('item_category'),
			'ContactID' => $this->input->post('supplier'),
			'Cost' => $costprice,
			'NetPrice' => $netprice,
			'VATRate' => $vatrate,
			'DiscountRate' => $disrate,
			'Stock' => $stock,
			'StockROP' => $stockrop,
			'GTIN' => $GTIN,
			'SKU' => $SKU,
			'Description' => $this->input->post('item_description')


		);


		$this->db->insert('Inventory', $data);

		$id = $this->db->insert_id();

		return $id;

	}

	public function update_item($id)
	{

		$this->load->helper('url');

		$costprice = ($this->input->post('item_costprice') == NULL ? NULL : $this->input->post('item_costprice'));
		$netprice = ($this->input->post('item_netprice') == NULL ? NULL : $this->input->post('item_netprice'));
		$vatrate = ($this->input->post('item_vatrate') == NULL ? NULL : $this->input->post('item_vatrate'));
		$disrate = ($this->input->post('item_disrate') == NULL ? 1 : $this->input->post('item_disrate'));
		$stock = ($this->input->post('item_stock') == NULL ? NULL : $this->input->post('item_stock'));
		$stockrop = ($this->input->post('item_rop') == NULL ? NULL : $this->input->post('item_rop'));
		$SKU = ($this->input->post('item_sku') == NULL ? NULL : $this->input->post('item_sku'));
		$GTIN = ($this->input->post('item_gtin') == NULL ? NULL : $this->input->post('item_gtin'));


		$data = array(
			'Name' => $this->input->post('item_name'),
			'ItemType' => $this->input->post('item_category'),
			'ContactID' => $this->input->post('supplier'),
			'Cost' => $costprice,
			'NetPrice' => $netprice,
			'VATRate' => $vatrate,
			'DiscountRate' => $disrate,
			'Stock' => $stock,
			'StockROP' => $stockrop,
			'GTIN' => $GTIN,
			'SKU' => $SKU,
			'Description' => $this->input->post('item_description')


		);


		$this->db->where('ItemID', $id);
		$this->db->update('Inventory', $data);

	}

	public function set_imagepath($id, $path)
	{

		$data = array('Imagepath' => $path);


		$this->db->where('ItemID', $id);
		$this->db->update('Inventory', $data);


	}

	public function gtin_exists($gtin)
	{

		$this->db->where('GTIN', $gtin);
		$query = $this->db->get('Inventory');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}


	}

	public function sku_exists($sku)
	{

		$this->db->where('SKU', $sku);
		$query = $this->db->get('Inventory');
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}


	}

	public function update_stock($id, $toAdd)
	{


		$this->db->where('ItemID', $id);
		$this->db->set('Stock', "Stock + $toAdd", FALSE);
		$this->db->update('Inventory');


		$query = $this->db->query("SELECT Stock FROM Inventory WHERE ItemID = $id");


		$row = $query->row();

		return $row->Stock;

	}

	public function get_item_by_id($itemID)
	{

		$query = $this->db->get_where('Inventory', array('ItemID' => $itemID));
		return $query->row_array();

	}

	public function delete_item($itemID)
	{

		$this->db->where('ItemID', $itemID);
		$this->db->delete('Inventory');
	}


}