<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class FrontPage extends CI_Controller {

    public function __construct() {
      parent::__construct();
    }

    /////////////////////////////////////// PAGES ///////////////////////////////////////

    public function index() {
      
      $this->data['js_to_load'] = [
        base_url('assets/js/swiper-bundle.min.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/css/swiper-bundle.min.css'),
      ];;
      $this->data['header_class'] = 'header-scroll';
      // $this->data['ig'] = file_get_contents('https://www.instagram.com/zareindonesia/?__a=1');
      // var_dump(json_decode($this->data['ig']));die;
      $this->template->load('front/tempFront', 'front/homepage', $this->data);
    }

    public function products() {
      $this->load->model('MProduct');
      $this->load->model('MProductKategori');

      $this->data['kategori'] = $this->MProductKategori->getAll();

      $this->data['per_page'] = 6;
      $this->data['totalProducts'] = (!$this->input->get('kategori')) ? $this->MProduct->countDataProduct('all') : $this->MProduct->countDataProduct(['id_kategori' => $this->input->get('kategori')]);
      $this->data['products'] = $this->MProduct->getWithLimit($this->data['per_page'], 0, $this->input->get('kategori'));


      $this->data['header_class'] = 'header-white';
      $this->template->load('front/tempFront', 'front/products', $this->data);
    }

    /////////////////////////////////// END OF PAGES ///////////////////////////////////////
    
    ////////////////////////////////////// FUNCT ///////////////////////////////////////////
    public function getNextProduct() {
      $this->load->model('MProduct');

      $page = $this->input->get('page');
      $limit = $this->input->get('limit');
      $kategori = $this->input->get('kategori');
      $products = $this->MProduct->getWithLimit($limit, $page, $kategori);

      $res = array(
        'data' => $products,
        'nextPage' => $page + $limit,
        'limit' => $limit,
      );

      die(json_encode($res));
    }
    /////////////////////////////////// END OF FUNCT ///////////////////////////////////////
  }

?>