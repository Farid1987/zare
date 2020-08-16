<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MBank extends CI_Model {
  
  /**
	 * 	get all data
	 *	@return array data bank
	 */
	public function getAll(){
		$this->db->select('*');
		$query = $this->db->get('bank');
		return $query->result();
  }
  
  /**
	 * 	add data bank
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('bank', $data);
		return $query;
  }
  
  /**
	 * 	edit data bank
   *	@return boolean
	 */
	public function edit($id, $data){
    $this->db->where('id_bank', $id);                   
    $query = $this->db->update('bank', $data);
		return $query;
  }
  
  /**
	 * 	delete data bank
   *	@return boolean
	 */
	public function delete($data){
    $query = $this->db->delete('bank', $data);
		return $query;
	}
}

?>