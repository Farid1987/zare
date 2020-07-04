<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MRegencies extends CI_Model {
  
  /**
	 * 	get all data
	 *	@return array data regencies
	 */
	public function getAll() {
		$this->db->select('*');
		$query = $this->db->get('regencies');
		return $query->result();
  }

  /**
	 * 	get data with specific condition
	 *	@return array data regencies
	 */
	public function getWhere($condition) {
		$query = $this->db->get_where('regencies', $condition);
		return $query->result();
  }
  
}

?>