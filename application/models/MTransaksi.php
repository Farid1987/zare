<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MTransaksi extends CI_Model {

  /**
	 * 	add data transaksi
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('transaksi', $data);
		return $query;
  }

	/**
	 * 	get spesific data transaksi
	 *	@return array data transaksi
	 */  
	public function getWhere($condition) {
		$this->db->select('transaksi.*, users.fullname, provinces.name as province_name, regencies.name as city_name, CONCAT( "ZR-", LPAD(transaksi.id_transaksi,7,"0") ) as id_invoice');
		$this->db->from('transaksi');
		$this->db->where($condition);
		$this->db->join('users', 'users.id_user = transaksi.id_user');
		$this->db->join('provinces', 'provinces.id = transaksi.province');
		$this->db->join('regencies', 'regencies.id = transaksi.city');
		$query = $this->db->get();

		return $query->result();
	}

	public function getWithLimit($limit, $start, $condition) {
		$this->db->select('transaksi.*, CONCAT( "ZR-", LPAD(transaksi.id_transaksi,7,"0") ) as id_invoice');
		$this->db->from('transaksi');
		$this->db->where($condition);
		$this->db->limit($limit, $start);
		$this->db->order_by('transaksi.created_at', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * 	get all data transaksi
	 *	@return array data transaksi
	 */  
	public function getAll() {
		$this->db->select('transaksi.*, users.fullname, CONCAT( "ZR-", LPAD(transaksi.id_transaksi,7,"0") ) as id_invoice');
		$this->db->from('transaksi');
		$this->db->join('users', 'users.id_user = transaksi.id_user');
		$this->db->order_by('transaksi.created_at', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}

	/**
	 * 	get total data transaksi with condition
	 *	@return array number / null
	 */
  public function countDataTransaksi($condition) {
    if ($condition == 'all') {
      $this->db->select('*');
      $query = $this->db->get('transaksi');
    } else {
      $query = $this->db->get_where('transaksi', $condition);
    }
    return count($query->result());
  }

	/**
	 * 	edit data transaksi
   *	@return boolean
	 */
	public function edit($id, $data){
    $this->db->where('id_transaksi', $id);                   
    $query = $this->db->update('transaksi', $data);
		return $query;
	}
	
}

?>