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
  
  /**
	 * 	add data kategori
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('kategori_product', $data);
		return $query;
  }
  
  /**
	 * 	edit data kategori
   *	@return boolean
	 */
	public function edit($id, $data){
    $this->db->where('id_kategori', $id);                   
    $query = $this->db->update('kategori_product', $data);
		return $query;
  }
  
  /**
	 * 	delete data kategori
   *	@return boolean
	 */
	public function delete($data){
    $query = $this->db->delete('kategori_product', $data);
		return $query;
	}
}

?>