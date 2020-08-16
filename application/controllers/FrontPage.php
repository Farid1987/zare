<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class FrontPage extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->data['fullname'] = $this->session->userdata('fullname');
      $this->data['emailUser'] = $this->session->userdata('email');

      $this->load->model('MCart');
      if ($this->session->userdata('id_user')) {
        $this->data['cart'] = $this->MCart->getWhere(['id_user' => $this->session->userdata('id_user')]);
        $this->data['countCart'] = count($this->data['cart']);
      }

      // var_dump($this->data['cart']);die;
    }

    /////////////////////////////////////// PAGES ///////////////////////////////////////

    public function index() {
      
      $this->data['js_to_load'] = [
        base_url('assets/js/swiper-bundle.min.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/css/swiper-bundle.min.css'),
      ];
      $this->data['header_class'] = 'header-scroll';

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

    public function productDetail($idProduct) {
      $this->load->model('MProduct');
      $this->load->model('MProductKategori');

      $this->data['product'] = $this->MProduct->getDetailProduct($idProduct);
      $this->data['otherProducts'] = $this->MProduct->getOtherProductWithLimit($idProduct, 4);
      $this->data['productKategori'] = $this->MProductKategori->getAll();

      $this->data['js_to_load'] = [
        base_url('assets/js/swiper-bundle.min.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/css/swiper-bundle.min.css'),
      ];
      $this->data['product_gallery'] = ($this->data['product']->image_url) ? explode(',', $this->data['product']->image_url):null;

      $this->data['header_class'] = 'header-white';
      $this->template->load('front/tempFront', 'front/productDetail', $this->data);
    }

    public function cart() {

      $this->data['header_class'] = 'header-white';
      $this->template->load('front/tempFront', 'front/cart', $this->data);
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

    public function addToCart() {
      if (!isset($this->data['emailUser'])) redirect('auth');

      $id = $this->input->post('id');
      $qty = $this->input->post('qty');
      $data = array(
        'cart.id_user' => $this->session->userdata('id_user'),
        'cart.id_product' => $id
      );
      
      $current = $this->MCart->getWhere($data);
      if (count($current) <= 0) {
        $dataInsert = array(
          'id_user' => $this->session->userdata('id_user'),
          'id_product' => $id,
          'quantity' => $qty
        );

        $this->MCart->add($dataInsert);
        $this->redirectPreviousPage();
      } else {
        $updatedQty = $current[0]->quantity + $qty;
        $dataUpdate = array(
          'quantity' => $updatedQty
        );
        $this->MCart->edit($current[0]->id_cart, $dataUpdate);
        $this->redirectPreviousPage();
      }

    }

    public function updateCart() {
      $this->load->model('MProduct');

      $idCart = $this->input->post('idCart');
      $idProduct = $this->input->post('idProduct');
      $qty = $this->input->post('qty');

      $stock = $this->MProduct->getStock($idProduct)->stock;

      // var_dump($qty, $stock); die;
      if ($qty > $stock) {
        $this->session->set_flashdata('errorlog', 'Input melebihi stock yang tersedia, maksimal '.$stock.' item');
        redirect('frontPage/cart');
      } else {
        $dataUpdate = array('quantity' => $qty);
        $this->MCart->edit($idCart, $dataUpdate);
        redirect('frontPage/cart');
      }
    }

    public function removeFromCart($idCart) {
      
      $data = array(
        'id_cart' => $idCart
      );
      $this->MCart->delete($data);
      $this->redirectPreviousPage();
    }

    private function redirectPreviousPage() {
      if (isset($_SERVER['HTTP_REFERER'])) {
        header('Location: '.$_SERVER['HTTP_REFERER']);
      } else {
        header('Location: http://'.$_SERVER['SERVER_NAME']);
      }
      
      exit;
    }
    /////////////////////////////////// END OF FUNCT ///////////////////////////////////////
  }

?>