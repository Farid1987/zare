<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MEventPhotos extends CI_Model {
  
   /**
	 * 	add data Event image
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('event_photos', $data);
		return $query;
  }

  /**
	 * 	get data with specific condition
	 *	@return array data event img
	 */
	public function getWhere($condition) {
		$query = $this->db->get_where('event_photos', $condition);
		return $query->result();
  }

  /**
	 * 	get url img
	 *	@return array data event url img
	 */
	public function getUrlImg($id) {
    $this->db->select('event_photos.url');
    $this->db->from('event_photos');
    $this->db->where(['id_event_photos' => $id]);
		$query = $this->db->get();
		return $query->row();
  }

  /**
	 * 	delete data event images
   *	@return boolean
	 */
	public function delete($data){
    $query = $this->db->delete('event_photos', $data);
		return $query;
	}
}

?>