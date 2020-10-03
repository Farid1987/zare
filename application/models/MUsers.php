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
	public function getAll(){
    $this->db->select('users.*, provinces.name as province_name, regencies.name as city_name');
    $this->db->from('users');
    $this->db->join('provinces', 'users.province = provinces.id', 'left');
    $this->db->join('regencies', 'users.city = regencies.id', 'left');
		$query = $this->db->get();
		return $query->result();
  }
  
  /**
	 * 	add data user
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('users', $data);
		return $query;
  }

  /**
	 * 	get data with specific condition
	 *	@return array data regencies
	 */
	public function getWhere($condition) {
    $this->db->select('users.*, provinces.name as province_name, regencies.name as city_name');
    $this->db->from('users');
    $this->db->join('provinces', 'users.province = provinces.id', 'left');
    $this->db->join('regencies', 'users.city = regencies.id', 'left');
    $this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
	}
	
	/**
	 * 	get user address
	 *	@return array data regencies
	 */
	public function getUserAddress($idUser) {
    $this->db->select('users.address, users.province, users.city, users.zip_code');
    $this->db->from('users');
    $this->db->where(['id_user' => $idUser]);
		$query = $this->db->get();
		return $query->row();
	}
	
	/**
	 * 	get total data users with condition
	 *	@return array number / null
	 */
  public function countDataUsers($condition) {
    if ($condition == 'all') {
      $this->db->select('*');
      $query = $this->db->get('users');
    } else {
      $query = $this->db->get_where('users', $condition);
    }
    return count($query->result());
  }

  /**
	 * 	edit data user
   *	@return boolean
	 */
	public function edit($id, $data){
    $this->db->where('id_user', $id);                   
    $query = $this->db->update('users', $data);
		return $query;
  }

  /**
	 * 	delete data kategori
   *	@return boolean
	 */
	public function delete($data){
    $query = $this->db->delete('users', $data);
		return $query;
	}
}

?>