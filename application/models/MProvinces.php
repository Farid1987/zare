<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MProvinces extends CI_Model {
  
  /**
	 * 	get all data
	 *	@return array data provinces
	 */
	public function getAll(){
		$this->db->select('*');
		$query = $this->db->get('provinces');
		return $query->result();
  }
  
}

?>