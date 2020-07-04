<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MProductKategori extends CI_Model {
  
  /**
	 * 	get all data
	 *	@return array data kategori
	 */
	public function getAll(){
		$this->db->select('*');
		$query = $this->db->get('product_kategori');
		return $query->result();
  }
  
  /**
	 * 	add data kategori
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('product_kategori', $data);
		return $query;
  }
  
  /**
	 * 	edit data kategori
   *	@return boolean
	 */
	public function edit($id, $data){
    $this->db->where('id_kategori', $id);                   
    $query = $this->db->update('product_kategori', $data);
		return $query;
  }
  
  /**
	 * 	delete data kategori
   *	@return boolean
	 */
	public function delete($data){
    $query = $this->db->delete('product_kategori', $data);
		return $query;
	}
}

?>