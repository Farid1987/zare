<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MProductImages extends CI_Model {
  
   /**
	 * 	add data product image
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('product_images', $data);
		return $query;
  }

  /**
	 * 	get data with specific condition
	 *	@return array data product img
	 */
	public function getWhere($condition) {
		$query = $this->db->get_where('product_images', $condition);
		return $query->result();
  }

  /**
	 * 	get url img
	 *	@return array data product url img
	 */
	public function getUrlImg($id) {
    $this->db->select('product_images.url');
    $this->db->from('product_images');
    $this->db->where(['id_product_images' => $id]);
		$query = $this->db->get();
		return $query->row();
  }

  /**
	 * 	delete data product images
   *	@return boolean
	 */
	public function delete($data){
    $query = $this->db->delete('product_images', $data);
		return $query;
	}
}

?>