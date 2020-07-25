<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MTypeProject extends CI_Model {
  
  /**
	 * 	get all data
	 *	@return array data kategori
	 */
	public function getAll(){
		$this->db->select('*');
		$query = $this->db->get('type_project');
		return $query->result();
  }
  
  /**
	 * 	add data kategori
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('type_project', $data);
		return $query;
  }
  
  /**
	 * 	edit data kategori
   *	@return boolean
	 */
	public function edit($id, $data){
    $this->db->where('id_type_project', $id);                   
    $query = $this->db->update('type_project', $data);
		return $query;
  }
  
  /**
	 * 	delete data kategori
   *	@return boolean
	 */
	public function delete($data){
    $query = $this->db->delete('type_project', $data);
		return $query;
	}
}

?>