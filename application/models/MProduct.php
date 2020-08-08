<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MProduct extends CI_Model {
  
  /**
	 * 	get all data product
	 *	@return array data product
	 */
	public function getAll(){
    $this->db->select('product.*, product_kategori.nama_kategori as kategori, product_kategori.satuan_harga as satuan');
    $this->db->from('product');
    $this->db->join('product_kategori', 'product.id_kategori = product_kategori.id_kategori', 'left');
		$query = $this->db->get();
		return $query->result();
  }

  /**
	 * 	get data product with limit data
	 *	@return array data product
	 */
  public function getWithLimit($limit, $start, $idKategori) {
    $this->db->select('product.*, product_kategori.nama_kategori as kategori, product_kategori.satuan_harga as satuan');
    $this->db->from('product');
    $this->db->join('product_kategori', 'product.id_kategori = product_kategori.id_kategori', 'left');
    if ($idKategori) {
      $this->db->where(['product.id_kategori' => $idKategori]);  
    }
    $this->db->limit($limit, $start);
    $query = $this->db->get();
		return $query->result();
  }

  /**
	 * 	get detail data product
	 *	@return array data product
	 */  
  public function getDetailProduct($idProduct) {
    $this->db->select('product.*, product_kategori.nama_kategori as kategori, product_kategori.satuan_harga as satuan, GROUP_CONCAT(product_images.url) as image_url');
    // $this->db->select('product.*, product_kategori.nama_kategori as kategori, product_kategori.satuan_harga as satuan, CONCAT("[",GROUP_CONCAT(product_images.url) ,"]") as image_url');
    $this->db->from('product');
    $this->db->where(['product.id_product' => $idProduct]);
    $this->db->join('product_kategori', 'product.id_kategori = product_kategori.id_kategori', 'left');
    $this->db->join('product_images', 'product_images.id_product = product.id_product', 'left');
    $query = $this->db->get();
    return $query->row();
  }

  /**
	 * 	get total data product with condition
	 *	@return array number / null
	 */
  public function countDataProduct($condition) {
    if ($condition == 'all') {
      $this->db->select('*');
      $query = $this->db->get('product');
    } else {
      $query = $this->db->get_where('product', $condition);
    }
    return count($query->result());
  }

   /**
	 * 	add data product
   *	@return boolean
	 */
	public function add($data){
		$query = $this->db->insert('product', $data);
		return $query;
  }
  
  /**
	 * 	get data with specific condition
	 *	@return array data product
	 */
	public function getWhere($condition) {
		$query = $this->db->get_where('product', $condition);
		return $query->result();
  }

  /**
	 * 	get featured img
	 *	@return array data product featured img
	 */
	public function getFeaturedImg($id) {
    $this->db->select('product.featured_img');
    $this->db->from('product');
    $this->db->where(['id_product' => $id]);
		$query = $this->db->get();
		return $query->row();
  }

  /**
	 * 	edit data product
   *	@return boolean
	 */
	public function edit($id, $data){
    $this->db->where('id_product', $id);                   
    $query = $this->db->update('product', $data);
		return $query;
  }

  /**
	 * 	delete data product
   *	@return boolean
	 */
	public function delete($data){
    $query = $this->db->delete('product', $data);
		return $query;
	}
}

?>