<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class FrontPage extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->data['fullname'] = $this->session->userdata('fullname');
      $this->data['emailUser'] = $this->session->userdata('email');
      $this->data['role'] = $this->session->userdata('role');

      $this->load->model('MCart');
      if ($this->session->userdata('id_user')) {
        $this->data['cart'] = $this->MCart->getWhere(['id_user' => $this->session->userdata('id_user')]);
        $this->data['countCart'] = count($this->data['cart']);
      }
    }

    /////////////////////////////////////// PAGES ///////////////////////////////////////

    public function index() {
      $this->load->model('MProduct');
      
      $this->data['products'] = $this->MProduct->getOtherProductWithLimit(null, 8);
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
    
    public function pengiriman() {
      if ($this->data['countCart'] <= 0) redirect('frontPage/products');
      $this->load->model('MProvinces');
      $this->load->model('MBank');
      $this->data['bank'] = $this->MBank->getAll();
      
      $this->data['js_to_load'] = [
        base_url('assets/js/jquery.min.js'),
        base_url('assets/js/select2.full.min.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/css/select2.min.css'),
      ];
      $this->data['provinces'] = $this->MProvinces->getAll();
      $this->data['header_class'] = 'header-white';
      $this->template->load('front/tempFront', 'front/pengiriman', $this->data);
    }

    public function pembayaran($idTransaksi) {
      $this->load->model('MTransaksi');
      
      $this->data['header_class'] = 'header-white';
      $this->template->load('front/tempFront', 'front/pembayaran', $this->data);
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
      if ($this->data['emailUser'] && $this->data['role'] == 'admin') redirect('frontPage');
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
      if (!$this->data['emailUser'] || $this->data['role'] == 'admin') redirect('frontPage');
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
      if (!$this->data['emailUser'] || $this->data['role'] == 'admin') redirect('frontPage');
      $data = array(
        'id_cart' => $idCart
      );
      $this->MCart->delete($data);
      $this->redirectPreviousPage();
    }

    public function getRegencies() {
      $this->load->model('MRegencies');
      
      $idProv = $this->input->get('idProv');
      $condition = array('province_id' => $idProv);
      $result = $this->MRegencies->getWhere($condition);
      
      die(json_encode($result));
    }
    
    public function checkout() {
      $this->form_validation->set_rules('province', 'Provinsi', 'required');
      $this->form_validation->set_rules('city', 'Kota', 'required');
      $this->form_validation->set_rules('address', 'Alamat Lengkap', 'required');
      $this->form_validation->set_rules('zip_code', 'Kode Pos', 'required');

      if ($this->form_validation->run()) {
        $this->load->model('MTransaksi');
        $this->load->model('MTransaksiDetail');

        $dataInsert = array(
          'id_user' => $this->session->userdata('id_user'),
          'total_pembayaran' => $this->input->post('total_pembayaran'),
          'address' => $this->input->post('address'),
          'province' => $this->input->post('province'),
          'city' => $this->input->post('city'),
          'zip_code' => $this->input->post('zip_code'),
        );

        $this->db->trans_begin();
        $insertTransaksi = $this->MTransaksi->add($dataInsert);
        if ($insertTransaksi) {
          $id_transaksi = $this->db->insert_id();
          foreach ($this->data['cart'] as $item) {
            $hargaSatuan = $item->price;
            $jumlahPenjualan = $item->quantity;
            $total_harga = $item->quantity * $item->price;

            $dataInsertDetail = array(
              'id_transaksi' => $id_transaksi,
              'id_product' => (isset($item->id_product)) ? $item->id_product:null,
              'id_event' => (isset($item->id_event)) ? $item->id_event:null,
              'harga_satuan' => $hargaSatuan,
              'jumlah_penjualan' => $jumlahPenjualan,
              'total_harga' => $total_harga,
            );

            $insertTransaksiDetail = $this->MTransaksiDetail->add($dataInsertDetail);
            if ($insertTransaksiDetail) {
              $this->load->model('MProduct');

              $this->MCart->delete(['id_cart' => $item->id_cart]);
              $product = $this->MProduct->getStock($item->id_product);
              if ($item->quantity > $product->stock) {
                $this->db->trans_rollback();
                $this->session->set_flashdata('errorlog', 'Product stock tidak mencukupi, silahkan check kembali stock product yang tersedia');
                redirect('frontPage/checkout');
              } else {
                $updatedStock = $product->stock - $item->quantity;
                $dataUpdate = array('stock' => $updatedStock);
                $updateProduct = $this->MProduct->edit($item->id_product, $dataUpdate);
                if (!$updateProduct) {
                  $this->db->trans_rollback();
                  $this->session->set_flashdata('errorlog', 'Error saat checkout. Silahkan coba beberapa saat lagi / hubungi admin.');
                  redirect('frontPage/checkout');
                }
              }
            }
          }
        }

        $this->db->trans_commit();


        if ($insertTransaksi) {
          $this->session->set_flashdata('status', 'success');
          $this->session->set_flashdata('message', 'Add Product success!');

          redirect('frontPage/pembayaran/'.$id_transaksi);
        } else {
          $this->session->set_flashdata('status', 'error');
          $this->session->set_flashdata('message', 'Add Product failed!');
          redirect('frontPage/checkout');
        }
      } else {
        $this->load->model('MProvinces');
        $this->load->model('MBank');
        $this->data['bank'] = $this->MBank->getAll();
        
        $this->data['js_to_load'] = [
          base_url('assets/js/jquery.min.js'),
          base_url('assets/js/select2.full.min.js'),
        ];
        $this->data['css_to_load'] = [
          base_url('assets/css/select2.min.css'),
        ];
        $this->data['provinces'] = $this->MProvinces->getAll();
        $this->data['header_class'] = 'header-white';
        $this->template->load('front/tempFront', 'front/pengiriman', $this->data);
      }
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