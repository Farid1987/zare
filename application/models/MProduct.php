<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MProduct extends CI_Model {
  
  /**
	 * 	get all data product
	 *	@return array data product
	 */
	public function getAll(){
    $this->db->select('product.*, product_kategori.nama_kategori as kategori');
    $this->db->from('product');
    $this->db->join('product_kategori', 'product.id_kategori = product_kategori.id_kategori', 'left');
		$query = $this->db->get();
		return $query->result();
  }

   /**
	 * 	add data product
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('product', $data);
		return $query;
  }
  
  /**
	 * 	get data with specific condition
	 *	@return array data regencies
	 */
	public function getWhere($condition) {
		$query = $this->db->get_where('product', $condition);
		return $query->result();
  }

  /**
	 * 	delete data product
   *	@return boolean
	 */
	public function delete($data){
    $query = $this->db->delete('product', $data);
		return $query;
	}
}

?>