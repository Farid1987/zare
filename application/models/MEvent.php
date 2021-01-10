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
		$this->db->order_by('event.created_at', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
	// /**
	//  * 	get all data event except 
	//  *	@return array data event
	//  */
	// public function getAllNotDraft(){
  //   $this->db->select('event.*, type_project.type_project as type');
  //   $this->db->from('event');
	// 	$this->db->join('type_project', 'event.id_type_project = type_project.id_type_project', 'left');
	// 	$this->db->where('event.status !=', 'draft');
	// 	$query = $this->db->get();
	// 	return $query->result();
  // }

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
		$this->db->select('event.*, type_project.type_project as type');
    $this->db->from('event');
		$this->db->join('type_project', 'event.id_type_project = type_project.id_type_project', 'left');
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->result();
		// $query = $this->db->get_where('event', $condition);
		// return $query->result();
	}
	
	public function getWhereWithLimit($condition, $limit, $start = 0) {
		$this->db->select('event.*, type_project.type_project as type');
    $this->db->from('event');
		$this->db->join('type_project', 'event.id_type_project = type_project.id_type_project', 'left');
		$this->db->where($condition);
		$this->db->limit($limit, $start);
		$this->db->order_by('event.created_at', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getDetailEvent($idEvent) {
		$this->db->select('event.*, type_project.type_project as type, GROUP_CONCAT(event_photos.url) as image_url');
    $this->db->from('event');
    $this->db->where(['event.id_event' => $idEvent]);
    $this->db->join('type_project', 'event.id_type_project = type_project.id_type_project', 'left');
    $this->db->join('event_photos', 'event_photos.id_event = event.id_event', 'left');
    $query = $this->db->get();
    return $query->row();
	}

	/**
	 * 	get data event with limit data
	 *	@return array data product
	 */
  public function getWithLimit($limit, $start, $idType) {
    $this->db->select('event.*, type_project.type_project as type');
    $this->db->from('event');
    $this->db->join('type_project', 'event.id_type_project = type_project.id_type_project', 'left');
    if ($idType) {
      $this->db->where(['event.id_type_project' => $idType]);  
    }
    $this->db->limit($limit, $start);
    $query = $this->db->get();
		return $query->result();
  }
	
	/**
	 * 	get total data event with condition
	 *	@return array number / null
	 */
  public function countDataEvent($condition) {
    if ($condition == 'all') {
      $this->db->select('*');
      $query = $this->db->get('event');
    } else {
      $query = $this->db->get_where('event', $condition);
    }
    return count($query->result());
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