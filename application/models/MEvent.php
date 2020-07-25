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

  
}

?>