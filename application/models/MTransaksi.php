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

}

?>