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
	public function getWhere($idTransaksi) {
		$this->db->select('transaksi.*, users.fullname, provinces.name as province_name, regencies.name as city_name, CONCAT( "ZR-", LPAD(transaksi.id_transaksi,7,"0") ) as id_invoice');
		$this->db->from('transaksi');
		$this->db->where(['transaksi.id_transaksi' => $idTransaksi]);
		$this->db->join('users', 'users.id_user = transaksi.id_user');
		$this->db->join('provinces', 'provinces.id = transaksi.province');
		$this->db->join('regencies', 'regencies.id = transaksi.city');
		$query = $this->db->get();

		return $query->row();
	}
}

?>