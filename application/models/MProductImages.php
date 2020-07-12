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
	 *	@return array data regencies
	 */
	public function getWhere($condition) {
		$query = $this->db->get_where('product_images', $condition);
		return $query->result();
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