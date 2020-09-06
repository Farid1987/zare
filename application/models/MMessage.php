<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMessage extends CI_Model {
  
  /**
	 * 	get all data
	 *	@return array data message
	 */
	public function getAll(){
		$this->db->select('*');
		$query = $this->db->get('message');
		return $query->result();
  }
  /**
	 * 	add data message
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('message', $data);
		return $query;
  }
}

?>