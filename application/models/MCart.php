<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MCart extends CI_Model {
  /**
	 * 	get data with specific condition
	 *	@return array data cart
	 */
	public function getWhere($condition) {
		$this->db->select('cart.*, product.nama_product, product.featured_img, product.price');
    $this->db->from('cart');
		$this->db->join('product', 'cart.id_product = product.id_product');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
  }

  /**
	 * 	add data cart
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('cart', $data);
		return $query;
  }

    /**
	 * 	edit data cart
   *	@return boolean
	 */
	public function edit($id, $data){
    $this->db->where('id_cart', $id);                   
    $query = $this->db->update('cart', $data);
		return $query;
	}
	
	/**
	 * 	delete data cart
   *	@return boolean
	 */
	public function delete($data){
    $query = $this->db->delete('cart', $data);
		return $query;
	}
}

?>