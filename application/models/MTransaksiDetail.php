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
}

?>