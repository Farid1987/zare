<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MTransaksiDetail extends CI_Model {
  /**
	 * 	add data transaksi detail
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('transaksi_detail', $data);
		return $query;
	}
	
	/**
	 * 	get data transaksi detail
   *	@return data detail
	 */
	public function getWhere($idTransaksi) {
		$this->db->select('transaksi_detail.*, product.nama_product, product.featured_img');
		$this->db->from('transaksi_detail');
		$this->db->where(['id_transaksi' => $idTransaksi]);
		$this->db->join('product', 'product.id_product = transaksi_detail.id_product');
		$query = $this->db->get();
		return $query->result();
	}
}

?>