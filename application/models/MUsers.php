<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MUsers extends CI_Model {


  /**
	 * 	check user availability
	 *	@param array login data
	 *	@return array data from database
	 */
	public function checkUser($data) {
		$query = $this->db->get_where('users', $data);
		return $query;
  }
  
  /**
	 * 	get all data user
	 *	@return array data user
	 */
	public function getAllUsers(){
		$this->db->select('*');
		$query = $this->db->get('users');
		return $query->result();
	}
}

?>