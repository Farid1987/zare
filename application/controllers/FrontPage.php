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
      $this->load->model('MTypeProject');
      $this->load->model('MEvent');
      
      $workshop = $this->MTypeProject->getWhere(['type_project' => 'workshop'])[0];
      $this->data['otherEvent'] = $this->MEvent->getWhereWithLimit(['event.status !=' => 'draft', 'event.id_type_project !=' => $workshop->id_type_project], 6);
      $this->data['workshop'] = $this->MEvent->getWhereWithLimit(['event.status !=' => 'draft', 'event.id_type_project' => $workshop->id_type_project], 6);
      $this->data['products'] = $this->MProduct->getOtherProductWithLimit(null, 8);
      $this->data['js_to_load'] = [
        base_url('assets/js/swiper-bundle.min.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/css/swiper-bundle.min.css'),
      ];
      $this->data['header_class'] = 'header-scroll';
      $this->data['blog'] = [
        ['link' => 'https://blog.zare.id/blog/open-farm-dipenghujung-tahun-part-1', 'image' => base_url('/assets/img/blog1.jpeg'), 'title' => 'Open Farm Dipenghujung Tahun Part 1', 'short_desc' => 'Tanggal 7 desember 2019 adalah waktu yang paling tepat untuk merasakan dinginnya sepoi hembusan angin dan indahnya pe...', 'type' => 'Open Farm', 'date'=>'Dec 08'],
        ['link' => 'https://blog.zare.id/blog/sektor-pertanian-banyuwangi-mampu-surplus-di-tengah-pandemi', 'image' => base_url('/assets/img/blog2.jpeg'), 'title' => 'Sektor Pertanian Banyuwangi Mampu Surplus Di Tengah Pandemi', 'short_desc' => 'Di tengah pandemi COVID-19, sektor pertanian Banyuwangi mencatat pertumbuhan positif.', 'type' => 'Open Farm', 'date'=>'Jun 08']
      ];
      $this->data['active'] = 'home';

      $this->template->load('front/tempFront', 'front/homepage', $this->data);
    }

    public function products() {
      $this->load->model('MProduct');
      $this->load->model('MProductKategori');

      $this->data['kategori'] = $this->MProductKategori->getAll();

      $this->data['per_page'] = 6;
      $this->data['totalProducts'] = (!$this->input->get('kategori')) ? $this->MProduct->countDataProduct('all') : $this->MProduct->countDataProduct(['id_kategori' => $this->input->get('kategori')]);
      $this->data['products'] = $this->MProduct->getWithLimit($this->data['per_page'], 0, $this->input->get('kategori'));
      $this->data['productTerlaris'] = $this->MProduct->getProductTerlaris();

      $this->data['header_class'] = 'header-white';
      $this->data['active'] = 'product';
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
      $this->data['active'] = 'product';
      $this->template->load('front/tempFront', 'front/productDetail', $this->data);
    }

    public function events() {
      $this->load->model('MEvent');
      $this->load->model('MTypeProject');

      $this->data['allType'] = $this->MTypeProject->getAll();

      $this->data['per_page'] = 6;
      $this->data['totalEvents'] = (!$this->input->get('type')) ? $this->MEvent->countDataEvent('all') : $this->MEvent->countDataEvent(['id_type_project' => $this->input->get('type')]);

      $condition = ['event.status !=' => 'draft'];
      if ($this->input->get('type')) {
        $condition = ['event.status !=' => 'draft','event.id_type_project' => $this->input->get('type')];
      }
      
      $this->data['events'] = $this->MEvent->getWhereWithLimit($condition, $this->data['per_page'], 0);

      $this->data['header_class'] = 'header-white';
      $this->data['active'] = 'event';
      $this->template->load('front/tempFront', 'front/events', $this->data);
    }

    public function eventDetail($idEvent) {
      $this->load->model('MEvent');

      $this->data['event'] = $this->MEvent->getDetailEvent($idEvent);
      $this->data['event_gallery'] = ($this->data['event']->image_url) ? explode(',', $this->data['event']->image_url):null;

      $this->data['js_to_load'] = [
        base_url('assets/js/swiper-bundle.min.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/css/swiper-bundle.min.css'),
      ];
      $this->data['header_class'] = 'header-white';
      $this->data['active'] = 'event';
      $this->template->load('front/tempFront', 'front/eventDetail', $this->data);
    }

    public function cart() {
      if (!$this->session->userdata('email')) redirect('auth');
      
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
      if (!$this->session->userdata('id_user')) redirect('/');
      $this->load->model('MBank');
      $this->load->model('MTransaksi');
      $this->load->model('MTransaksiDetail');

      $this->data['transaksi'] = $this->MTransaksi->getWhere(['transaksi.id_transaksi' => $idTransaksi])[0];
      $this->data['transaksiItem'] = $this->MTransaksiDetail->getWhere(['id_transaksi' => $idTransaksi]);
      $this->data['bank'] = $this->MBank->getAll();

      $this->data['js_to_load'] = [
        base_url('assets/js/micromodal.min.js'),
      ];
      $this->data['header_class'] = 'header-white';
      $this->template->load('front/tempFront', 'front/pembayaran', $this->data);
    }

    public function dashboardUser() {
      if (!$this->session->userdata('id_user')) redirect('/');

      $this->load->library('pagination');
      $this->load->model('MUsers');
      $this->load->model('MTransaksi');

      $this->data['user'] = $this->MUsers->getWhere(['id_user' => $this->session->userdata('id_user')])[0];
      $allTransaksi = $this->MTransaksi->getWhere(['transaksi.id_user' => $this->session->userdata('id_user')]);

      //konfigurasi pagination
      $config['base_url'] = site_url('frontPage/dashboardUser'); //site url
      $config['total_rows'] = count($allTransaksi); //total row
      $config['per_page'] = 5;  //show record per halaman
      $config["uri_segment"] = 3;  // uri parameter
      $choice = $config["total_rows"] / $config["per_page"];
      $config["num_links"] = floor($choice);

      $this->pagination->initialize($config);
      $condition = ['id_user' => $this->session->userdata('id_user')];
      $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
      
      $this->data['dataTransaksi'] = $this->MTransaksi->getWithLimit($config["per_page"], $data['page'], $condition);
      $this->data['pagination'] = $this->pagination->create_links();

      $this->data['js_to_load'] = [
        base_url('assets/js/jquery.min.js'),
        base_url('assets/js/micromodal.min.js'),
      ];
      $this->data['header_class'] = 'header-white';
      $this->template->load('front/tempFront', 'front/dashboard', $this->data);
    }

    public function editAlamatUser() {
      if (!$this->session->userdata('id_user')) redirect('/');

      $this->load->model('MUsers');
      $this->load->model('MProvinces');

      $this->data['user'] = $this->MUsers->getWhere(['id_user' => $this->session->userdata('id_user')])[0];
      $this->data['provinces'] = $this->MProvinces->getAll();

      $this->data['js_to_load'] = [
        base_url('assets/js/jquery.min.js'),
        base_url('assets/js/select2.full.min.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/css/select2.min.css'),
      ];

      $this->data['header_class'] = 'header-white';
      $this->template->load('front/tempFront', 'front/editAlamat', $this->data);
    }

    public function contactUs() {
      $this->data['header_class'] = 'header-white';
      $this->data['active'] = 'contact';
      $this->template->load('front/tempFront', 'front/contactUs', $this->data);
    }

    public function aboutUs() {
      $this->data['header_class'] = 'header-white';
      $this->data['active'] = 'about';
      $this->template->load('front/tempFront', 'front/aboutUs', $this->data);
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

    public function getNextEvent() {
      $this->load->model('MEvent');

      $page = $this->input->get('page');
      $limit = $this->input->get('limit');
      $type = $this->input->get('type');
      $products = $this->MEvent->getWithLimit($limit, $page, $type);

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

      $this->load->model('MProduct');

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
        $stock = $this->MProduct->getStock($id);
        
        if ($updatedQty <= $stock->stock) {
          $dataUpdate = array(
            'quantity' => $updatedQty
          );
          $this->MCart->edit($current[0]->id_cart, $dataUpdate);
        }
        
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
          'status' => 'process'
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

    public function getUserAddress() {
      $this->load->model('MUsers');

      $address = $this->MUsers->getUserAddress($this->session->userdata('id_user'));

      $fill = true;
      if ($address->address == NULL && $address->province == NULL && $address->city == NULL && $address->zip_code == NULL) {
        $fill = false;
      }
      
      $res = array(
        'data' => $address,
        'fill' => $fill
      );

      die(json_encode($res));
    }

    public function editAlamat() {
      $this->load->model('MUsers');
      $dataEdit = array(
        'address' => $this->input->post('address'),
        'zip_code' => $this->input->post('zip_code'),
        'province' => $this->input->post('province'),
        'city' => $this->input->post('city')
      );
      $edit = $this->MUsers->edit($this->session->userdata('id_user'), $dataEdit);
      if ($edit) {
        $this->session->set_flashdata('status', 'success');
        $this->session->set_flashdata('message', 'Edit user success!');
      } else {
        $this->session->set_flashdata('status', 'error');
        $this->session->set_flashdata('message', 'Edit user failed!');
      }
      redirect(site_url('frontPage/dashboardUser'));
    }

    public function batalkanTransaksi($idTransaksi) {
      if (!$this->session->userdata('id_user')) redirect('/');

      $this->load->model('MTransaksi');
      $dataUpdate = array('status' => 'cancelled');
      $konfirmasi = $this->MTransaksi->edit($idTransaksi, $dataUpdate);
      if ($konfirmasi) {
        $this->load->model('MTransaksiDetail');
        $this->load->model('MProduct');
        $transaksiItem = $this->MTransaksiDetail->getWhere(['id_transaksi' => $idTransaksi]);
        
        if (count($transaksiItem) > 0) {
          foreach ($transaksiItem as $item) {
            if ($item->id_product) {
              $currentStock = $this->MProduct->getStock($item->id_product);
              $newStock = $currentStock->stock + $item->jumlah_penjualan;

              $this->MProduct->edit($item->id_product, ['stock' => $newStock]);
            }
          }
        } 
      }

      redirect(site_url('frontPage/dashboardUser'));
    }

    public function addMessage() {
      $this->form_validation->set_rules('nama', 'Nama', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required');
      $this->form_validation->set_rules('pesan', 'Pesan', 'required');

      $this->data['header_class'] = 'header-white';
      if ($this->form_validation->run()) {
        $this->load->model('MMessage');

        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $pesan = $this->input->post('pesan');
        $dataInsert = array(
          'nama' => $nama,
          'email' => $email,
          'pesan' => $pesan
        );
        
        $insertMessage = $this->MMessage->add($dataInsert);

        if ($insertMessage) {
          $this->session->set_flashdata('status', 'success');
          $this->session->set_flashdata('message', 'Pesan berhasil dikirim.');
        } else {
          $this->session->set_flashdata('status', 'error');
          $this->session->set_flashdata('message', 'Pesan gagal dikirim.');
        }

        redirect(site_url('frontPage/contactUs'));
      } else {
        $this->template->load('front/tempFront', 'front/contactUs', $this->data);
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