<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MEvent extends CI_Model {
  
  /**
	 * 	get all data event
	 *	@return array data event
	 */
	public function getAll(){
    $this->db->select('event.*, type_project.type_project as type');
    $this->db->from('event');
    $this->db->join('type_project', 'event.id_type_project = type_project.id_type_project', 'left');
		$query = $this->db->get();
		return $query->result();
  }

  /**
	 * 	add data event
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('event', $data);
		return $query;
  }

  /**
	 * 	get data with specific condition
	 *	@return array data event
	 */
	public function getWhere($condition) {
		$query = $this->db->get_where('event', $condition);
		return $query->result();
  }

  /**
	 * 	get featured img
	 *	@return array data event featured img
	 */
	public function getFeaturedImg($id) {
    $this->db->select('event.featured_img');
    $this->db->from('event');
    $this->db->where(['id_event' => $id]);
		$query = $this->db->get();
		return $query->row();
  }

  /**
	 * 	edit data event
   *	@return boolean
	 */
	public function edit($id, $data){
    $this->db->where('id_event', $id);                   
    $query = $this->db->update('event', $data);
		return $query;
  }
  
  /**
	 * 	delete data event
   *	@return boolean
	 */
	public function delete($data){
    $query = $this->db->delete('event', $data);
		return $query;
	}
}

?>