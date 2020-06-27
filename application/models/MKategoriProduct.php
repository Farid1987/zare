<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MKategoriProduct extends CI_Model {
  
  /**
	 * 	get all data
	 *	@return array data user
	 */
	public function getAll(){
		$this->db->select('*');
		$query = $this->db->get('kategori_product');
		return $query->result();
	}
}

?>