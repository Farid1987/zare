<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Admin extends CI_Controller {
    
    public function __construct() {
      parent::__construct();
      if ($this->session->userdata('role')!='admin') {
        redirect('LoginRahasia');
      }

      $this->data['fullname'] = $this->session->userdata('fullname');
      $this->data['title'] = "Admin | Zare.id";
    }

    /////////////////////////////////////// PAGES ///////////////////////////////////////

    public function index() {
      $this->data['active'] = "dashboard";
      $this->data['breadcrumb'] = [
        ['Dashboard', site_url('admin')]
      ];

      $this->template->load('admin/tempAdmin', 'admin/dashboard', $this->data);
    }

    public function users() {
      $this->load->model('MUsers');

      $this->data['users'] = $this->MUsers->getAll();
      $this->data['active'] = "users";
      $this->data['breadcrumb'] = [
        ['Users', site_url('admin/users')]
      ];
      $this->data['js_to_load'] = array_merge($this->datatableAssets()['js'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.js'),
      ]);
      $this->data['css_to_load'] = array_merge($this->datatableAssets()['css'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.css'),
      ]);

      $this->template->load('admin/tempAdmin', 'admin/user/users', $this->data);
    }
    public function userAdd() {
      $this->loadUserAddView();
    }
    public function userEdit($idUser) {
      $this->loadUserEditView($idUser);
    }

    public function kategoriProduct() {
      $this->load->model('MProductKategori');

      $this->data['kategori'] = $this->MProductKategori->getAll();
      $this->data['active'] = "masterdata";
      $this->data['breadcrumb'] = [
        ['Master Data', '#'],
        ['Kategori Product', site_url('admin/kategoriProduct')]
      ];
      $this->data['js_to_load'] = array_merge($this->datatableAssets()['js'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.js'),
      ]);
      $this->data['css_to_load'] = array_merge($this->datatableAssets()['css'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.css'),
      ]);

      $this->template->load('admin/tempAdmin', 'admin/datamaster/master_kategoriProduct', $this->data);
    }

    public function product() {
      $this->load->model('MProduct');
      
      $this->data['products'] = $this->MProduct->getAll();
      $this->data['active'] = "product";
      $this->data['breadcrumb'] = [
        ['Product', site_url('admin/product')]
      ];
      $this->data['js_to_load'] = array_merge($this->datatableAssets()['js'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.js'),
      ]);
      $this->data['css_to_load'] = array_merge($this->datatableAssets()['css'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.css'),
      ]);

      $this->template->load('admin/tempAdmin', 'admin/product/products', $this->data);
    }
    public function productAdd() {
      $this->loadProductAddView();
    }
    public function productEdit($idProduct) {
      $this->loadProductEditView($idProduct);
    }

    public function typeProject() {
      $this->load->model('MTypeProject');

      $this->data['typeProject'] = $this->MTypeProject->getAll();
      $this->data['active'] = "masterdata";
      $this->data['breadcrumb'] = [
        ['Master Data', '#'],
        ['Type Project', site_url('admin/typeProject')]
      ];
      $this->data['js_to_load'] = array_merge($this->datatableAssets()['js'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.js'),
      ]);
      $this->data['css_to_load'] = array_merge($this->datatableAssets()['css'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.css'),
      ]);

      $this->template->load('admin/tempAdmin', 'admin/datamaster/master_typeProject', $this->data);
    }

    public function event() {
      $this->load->model('MEvent');
      
      $this->data['events'] = $this->MEvent->getAll();
      $this->data['active'] = "event";
      $this->data['breadcrumb'] = [
        ['Event', site_url('admin/event')]
      ];
      $this->data['js_to_load'] = array_merge($this->datatableAssets()['js'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.js'),
      ]);
      $this->data['css_to_load'] = array_merge($this->datatableAssets()['css'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.css'),
      ]);

      $this->template->load('admin/tempAdmin', 'admin/event/events', $this->data);
    }
    public function eventAdd() {
      $this->loadEventAddView();
    }
    public function eventEdit($idEvent) {
      $this->loadEventEditView($idEvent);
    }

    public function bank() {
      $this->load->model('MBank');

      $this->data['bank'] = $this->MBank->getAll();
      $this->data['active'] = 'masterdata';
      $this->data['breadcrumb'] = [
        ['Master Data', '#'],
        ['Bank', site_url('admin/bank')]
      ];
      $this->data['js_to_load'] = array_merge($this->datatableAssets()['js'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.js'),
      ]);
      $this->data['css_to_load'] = array_merge($this->datatableAssets()['css'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.css'),
      ]);

      $this->template->load('admin/tempAdmin', 'admin/datamaster/master_bank', $this->data);
    }

    /////////////////////////////////// END OF PAGES ///////////////////////////////////////

    ////////////////////////////////////// FUNCT ///////////////////////////////////////////

    // User ============
    public function addUser() {
      $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
      $this->form_validation->set_rules('role', 'Role', 'required');
      $this->form_validation->set_rules('password', 'Password', 'required');

      if ($this->form_validation->run()) {
        $this->load->model('MUsers');

        $dataInsert = array(
          'email' => $this->input->post('email'),
          'password' => md5('123456'),
          'role' => 'member',
          'fullname' => $this->input->post('fullname'),
          'address' => $this->input->post('address'),
          'phone' => $this->input->post('no_telp'),
          'zip_code' => $this->input->post('kode_pos'),
          'province' => $this->input->post('provinsi'),
          'city' => $this->input->post('kota')
        );
        $insert = $this->MUsers->add($dataInsert);
        if ($insert) {
          $this->session->set_flashdata('status', 'success');
          $this->session->set_flashdata('message', 'Add user success!');
        } else {
          $this->session->set_flashdata('status', 'error');
          $this->session->set_flashdata('message', 'Add user failed!');
        }
        redirect(site_url('admin/users'));
      } else {
        $this->loadUserAddView();
      }
    }
    public function editUser($idUser) {
      $this->form_validation->set_rules('fullname', 'Nama Lengkap', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
      $this->form_validation->set_rules('role', 'Role', 'required');

      $this->load->model('MUsers');
      if ($this->form_validation->run()) {
        $dataEdit = array(
          'fullname' => $this->input->post('fullname'),
          'address' => $this->input->post('address'),
          'phone' => $this->input->post('no_telp'),
          'zip_code' => $this->input->post('kode_pos'),
          'province' => $this->input->post('provinsi'),
          'city' => $this->input->post('kota')
        );
        $edit = $this->MUsers->edit($idUser, $dataEdit);
        if ($edit) {
          $this->session->set_flashdata('status', 'success');
          $this->session->set_flashdata('message', 'Edit user success!');
        } else {
          $this->session->set_flashdata('status', 'error');
          $this->session->set_flashdata('message', 'Edit user failed!');
        }
        redirect(site_url('admin/users'));
      } else {
        $this->loadUserEditView($idUser);
      }
    }
    public function deleteUser() {
      $this->load->model('MUsers');

      $id_user = $this->input->post('id');
      $dataDelete = array('id_user' => $id_user);

      $res = $this->MUsers->delete($dataDelete);
      if ($res) {
          $data['status'] = 'success';
          $data['message'] = 'Delete user success!';
          die(json_encode($data));
      }else{
          $data['status'] = 'error';
          $data['message'] = 'Delete user failed!';
          die(json_encode($data));
      }
    }
    // User ============

    // Kategori Product ============
    public function addKategori() {
      $this->form_validation->set_rules('kategori', 'Kategori', 'required');
      $this->form_validation->set_rules('satuan_harga', 'Satuan Harga', 'required');

      if ($this->form_validation->run()) {
        $this->load->model('MProductKategori');

        $kategori = $this->input->post('kategori');
        $satuan = $this->input->post('satuan_harga');
        $dataInsert = array(
          'nama_kategori' => $kategori,
          'satuan_harga' => $satuan,
        );
        
        $this->MProductKategori->add($dataInsert);
        $data['status'] = 'success';
        die(json_encode($data));
      } else {
        $data['status'] = 'error';
        $data['message'] = $this->form_validation->error_array();
        die(json_encode($data));
      }
    }
    public function editKategori() {
      $this->form_validation->set_rules('kategori', 'Kategori', 'required');
      $this->form_validation->set_rules('satuan_harga', 'Satuan Harga', 'required');

      if ($this->form_validation->run()) {
        $this->load->model('MProductKategori');

        $kategori = $this->input->post('kategori');
        $id = $this->input->post('id_kategori');
        $satuan = $this->input->post('satuan_harga');
        $dataUpdate = array(
          'nama_kategori' => $kategori,
          'satuan_harga' => $satuan,
        );
        
        $this->MProductKategori->edit($id, $dataUpdate);
        $data['status'] = 'success';
        die(json_encode($data));
      } else {
        $data['status'] = 'error';
        $data['message'] = $this->form_validation->error_array();
        die(json_encode($data));
      }
    }
    public function deleteKategori() {
      $this->load->model('MProductKategori');

      $id_kategori = $this->input->post('id');
      $dataDelete = array('id_kategori' => $id_kategori);

      $res = $this->MProductKategori->delete($dataDelete);
      if ($res) {
        $data['status'] = 'success';
        $data['message'] = 'Delete kategori product success!';
        die(json_encode($data));
      }else{
        $data['status'] = 'error';
        $data['message'] = 'Delete kategori product Failed!';
        die(json_encode($data));
      }
    }
    // Kategori Product ============

    // Type Project ============
    public function addTypeProject() {
      $this->form_validation->set_rules('type', 'Type Project', 'required');

      if ($this->form_validation->run()) {
        $this->load->model('MTypeProject');

        $typeProject = $this->input->post('type');
        $dataInsert = array(
          'type_project' => $typeProject
        );
        
        $this->MTypeProject->add($dataInsert);
        $data['status'] = 'success';
        die(json_encode($data));
      } else {
        $data['status'] = 'error';
        $data['message'] = $this->form_validation->error_array();
        die(json_encode($data));
      }
    }
    public function editTypeProject() {
      $this->form_validation->set_rules('type', 'Type Project', 'required');

      if ($this->form_validation->run()) {
        $this->load->model('MTypeProject');

        $typeProject = $this->input->post('type');
        $id = $this->input->post('id_type_project');
        $dataUpdate = array(
          'type_project' => $typeProject
        );
        
        $this->MTypeProject->edit($id, $dataUpdate);
        $data['status'] = 'success';
        die(json_encode($data));
      } else {
        $data['status'] = 'error';
        $data['message'] = $this->form_validation->error_array();
        die(json_encode($data));
      }
    }
    public function deleteTypeProject() {
      $this->load->model('MTypeProject');

      $id_type_project = $this->input->post('id');
      $dataDelete = array('id_type_project' => $id_type_project);

      $res = $this->MTypeProject->delete($dataDelete);
      if ($res) {
        $data['status'] = 'success';
        $data['message'] = 'Delete kategori product success!';
        die(json_encode($data));
      }else{
        $data['status'] = 'error';
        $data['message'] = 'Delete kategori product Failed!';
        die(json_encode($data));
      }
    }
    // Type Project ============

    // Bank ============
    public function addBank() {
      $this->form_validation->set_rules('nama', 'Nama Bank', 'required');
      $this->form_validation->set_rules('rekening', 'Nomor Rekening', 'required');
      $this->form_validation->set_rules('atasNama', 'Atas Nama', 'required');

      if ($this->form_validation->run()) {
        $this->load->model('MBank');

        $nama = $this->input->post('nama');
        $rekening = $this->input->post('rekening');
        $atasNama = $this->input->post('atasNama');
        $dataInsert = array(
          'nama' => $nama,
          'rekening' => $rekening,
          'atas_nama' => $atasNama
        );
        
        $this->MBank->add($dataInsert);
        $data['status'] = 'success';
        die(json_encode($data));
      } else {
        $data['status'] = 'error';
        $data['message'] = $this->form_validation->error_array();
        die(json_encode($data));
      }
    }
    public function editBank() {
      $this->form_validation->set_rules('nama', 'Nama Bank', 'required');
      $this->form_validation->set_rules('rekening', 'Nomor Rekening', 'required');
      $this->form_validation->set_rules('atasNama', 'Atas Nama', 'required');

      if ($this->form_validation->run()) {
        $this->load->model('MBank');

        $id = $this->input->post('id_bank');
        $nama = $this->input->post('nama');
        $rekening = $this->input->post('rekening');
        $atasNama = $this->input->post('atasNama');
        
        $dataUpdate = array(
          'nama' => $nama,
          'rekening' => $rekening,
          'atas_nama' => $atasNama
        );
        
        $this->MBank->edit($id, $dataUpdate);
        $data['status'] = 'success';
        die(json_encode($data));
      } else {
        $data['status'] = 'error';
        $data['message'] = $this->form_validation->error_array();
        die(json_encode($data));
      }
    }
    public function deleteBank() {
      $this->load->model('MBank');

      $id_bank = $this->input->post('id');
      $dataDelete = array('id_bank' => $id_bank);

      $res = $this->MBank->delete($dataDelete);
      if ($res) {
        $data['status'] = 'success';
        $data['message'] = 'Delete Bank Account success!';
        die(json_encode($data));
      }else{
        $data['status'] = 'error';
        $data['message'] = 'Delete Bank Account Failed!';
        die(json_encode($data));
      }
    }
    // Bank ============

    // Regencies/city ============
    public function getRegencies() {
      $this->load->model('MRegencies');
      
      $idProv = $this->input->get('idProv');
      $condition = array('province_id' => $idProv);
      $result = $this->MRegencies->getWhere($condition);
      
      die(json_encode($result));
    }
    // Regencies/city ============

    // Product ============
    public function addProduct() {
      $this->form_validation->set_rules('nama_product', 'Nama Product', 'required');
      $this->form_validation->set_rules('kategori_product', 'Kategori Product', 'required');
      $this->form_validation->set_rules('short_desc', 'Short Description', 'required');
      $this->form_validation->set_rules('desc', 'Description', 'required');
      $this->form_validation->set_rules('stock', 'Stock', 'required');
      $this->form_validation->set_rules('price', 'Price', 'required');
      $this->form_validation->set_rules('featured_img', 'Featured Image', 'required');
      if ($this->form_validation->run()) {
        $this->load->model('MProduct');
        $this->load->model('MProductImages');

        $dataInsert = array(
          'nama_product' => $this->input->post('nama_product'),
          'id_kategori' => $this->input->post('kategori_product'),
          'stock' => $this->input->post('stock'),
          'featured_img' => $this->input->post('featured_img'),
          'short_description' => $this->input->post('short_desc'),
          'description' => $this->input->post('desc'),
          'price' => str_replace('.','',$this->input->post('price')),
        );
        
        $insertProduct = $this->MProduct->add($dataInsert);
        if ($insertProduct) {
          $last_id = $this->db->insert_id();
          $gallery = $this->input->post('gallery[]');
          if (count($gallery) > 0) {
            foreach ($gallery as $link) {
              $dataInsertImg = array(
                'id_product' => $last_id,
                'url' => $link,
              );
              $insertImg = $this->MProductImages->add($dataInsertImg);
            }
          }
        }
        
        if ($insertProduct) {
          $this->session->set_flashdata('status', 'success');
          $this->session->set_flashdata('message', 'Add Product success!');
        } else {
          $this->session->set_flashdata('status', 'error');
          $this->session->set_flashdata('message', 'Add Product failed!');
        }

        redirect(site_url('admin/product'));
      } else {
        $this->loadProductAddView();
      }
    }
    public function editProduct($idProduct) {
      $this->form_validation->set_rules('nama_product', 'Nama Product', 'required');
      $this->form_validation->set_rules('kategori_product', 'Kategori Product', 'required');
      $this->form_validation->set_rules('short_desc', 'Short Description', 'required');
      $this->form_validation->set_rules('desc', 'Description', 'required');
      $this->form_validation->set_rules('stock', 'Stock', 'required');
      $this->form_validation->set_rules('price', 'Price', 'required');
      if (!$this->input->post('featured_img_old')) {
        $this->form_validation->set_rules('featured_img_new', 'Featured Image', 'required');
      }

      if ($this->form_validation->run()) {
        $this->load->model('MProduct');
        $this->load->model('MProductImages');

        $featuredImg = ($this->input->post('featured_img_old')) ? $this->input->post('featured_img_old'):$this->input->post('featured_img_new');
        $dataEdit = array(
          'nama_product' => $this->input->post('nama_product'),
          'id_kategori' => $this->input->post('kategori_product'),
          'stock' => $this->input->post('stock'),
          'featured_img' => $featuredImg,
          'short_description' => $this->input->post('short_desc'),
          'description' => $this->input->post('desc'),
          'price' => str_replace('.','',$this->input->post('price')),
        );
        $oldFeaturedImg = $this->MProduct->getFeaturedImg($idProduct);

        $updateProduct = $this->MProduct->edit($idProduct, $dataEdit);
        if ($updateProduct) {
          if (!$this->input->post('featured_img_old')) unlink($oldFeaturedImg->featured_img);

          $deletedGallery = $this->input->post('deletedGallery[]');
          if (count($deletedGallery) > 0) {
            foreach ($deletedGallery as $idGallery) {
              $urlImg = $this->MProductImages->getUrlImg($idGallery);
              unlink($urlImg->url);

              $dataDelete = array(
                'id_product_images' => $idGallery,
                'id_product' => $idProduct
              );
              $this->MProductImages->delete($dataDelete);
            }
          }

          $gallery = $this->input->post('gallery[]');
          if (count($gallery) > 0) {
            foreach ($gallery as $link) {
              $dataInsertImg = array(
                'id_product' => $idProduct,
                'url' => $link,
              );
              $insertImg = $this->MProductImages->add($dataInsertImg);
            }
          }
        }
        
        if ($updateProduct) {
          $this->session->set_flashdata('status', 'success');
          $this->session->set_flashdata('message', 'Update Product success!');
        } else {
          $this->session->set_flashdata('status', 'error');
          $this->session->set_flashdata('message', 'Update Product failed!');
        }

        redirect(site_url('admin/product'));
      } else {
        $this->loadProductEditView($idProduct);
      }
    }
    public function deleteProduct() {
      $this->load->model('MProduct');
      $this->load->model('MProductImages');

      $id_product = $this->input->post('id');
      $dataDelete = array('id_product' => $id_product);
      $product = $this->MProduct->getWhere($dataDelete);
      $relatedImg = $this->MProductImages->getWhere($dataDelete);

      foreach ($relatedImg as $key => $value) {
        unlink($value->url);
      }
      unlink($product[0]->featured_img);

      $resImg = $this->MProductImages->delete($dataDelete);
      $res = $this->MProduct->delete($dataDelete);
      if ($res) {
        $data['status'] = 'success';
        $data['message'] = 'Delete product success!';
        die(json_encode($data));
      }else{
        $data['status'] = 'error';
        $data['message'] = 'Delete product Failed!';
        die(json_encode($data));
      }
    }
    // Product ============

    // Event ============
    public function addEvent() {
      $this->form_validation->set_rules('title', 'Title', 'required');
      $this->form_validation->set_rules('type_project', 'Event Type', 'required');
      $this->form_validation->set_rules('deadline', 'Deadline', 'required');
      $this->form_validation->set_rules('start_regis', 'Start Registration', 'required');
      $this->form_validation->set_rules('end_regis', 'End Registration', 'required');
      $this->form_validation->set_rules('short_desc', 'Short Description', 'required');
      $this->form_validation->set_rules('desc', 'Description', 'required');
      $this->form_validation->set_rules('note', 'Notes', 'required');
      $this->form_validation->set_rules('location', 'Location', 'required');
      $this->form_validation->set_rules('long', 'Longitude', 'required');
      $this->form_validation->set_rules('lat', 'Latitude', 'required');
      $this->form_validation->set_rules('price', 'Price', 'required');
      $this->form_validation->set_rules('featured_img', 'Featured Image', 'required');
      if ($this->form_validation->run()) {
        $this->load->model('MEvent');
        $this->load->model('MEventPhotos');

        $dataInsert = array(
          'title' => $this->input->post('title'),
          'id_type_project' => $this->input->post('type_project'),
          'featured_img' => $this->input->post('featured_img'),
          'deadline' => $this->input->post('deadline'),
          'start_registration' => $this->input->post('start_regis'),
          'finish_registration' => $this->input->post('end_regis'),
          'short_description' => $this->input->post('short_desc'),
          'description' => $this->input->post('desc'),
          'note' => $this->input->post('note'),
          'price' => str_replace('.','',$this->input->post('price')),
          'location' => $this->input->post('location'),
          'latitude' => $this->input->post('lat'),
          'longitude' => $this->input->post('long'),
          'registration_link' => $this->input->post('regis_link'),
          'status' => $this->input->post('status'),
        );
        
        $insertEvent = $this->MEvent->add($dataInsert);
        if ($insertEvent) {
          $last_id = $this->db->insert_id();
          $gallery = $this->input->post('gallery[]');
          if (count($gallery) > 0) {
            foreach ($gallery as $link) {
              $dataInsertImg = array(
                'id_event' => $last_id,
                'url' => $link,
              );
              $insertImg = $this->MEventPhotos->add($dataInsertImg);
            }
          }
        }
        
        if ($insertEvent) {
          $this->session->set_flashdata('status', 'success');
          $this->session->set_flashdata('message', 'Add Event success!');
        } else {
          $this->session->set_flashdata('status', 'error');
          $this->session->set_flashdata('message', 'Add Event failed!');
        }

        redirect(site_url('admin/event'));
      } else {
        $this->loadEventAddView();
      }
    }
    public function editEvent($idEvent) {
      $this->form_validation->set_rules('title', 'Title', 'required');
      $this->form_validation->set_rules('type_project', 'Event Type', 'required');
      $this->form_validation->set_rules('deadline', 'Deadline', 'required');
      $this->form_validation->set_rules('start_regis', 'Start Registration', 'required');
      $this->form_validation->set_rules('end_regis', 'End Registration', 'required');
      $this->form_validation->set_rules('short_desc', 'Short Description', 'required');
      $this->form_validation->set_rules('desc', 'Description', 'required');
      $this->form_validation->set_rules('note', 'Notes', 'required');
      $this->form_validation->set_rules('location', 'Location', 'required');
      $this->form_validation->set_rules('long', 'Longitude', 'required');
      $this->form_validation->set_rules('lat', 'Latitude', 'required');
      $this->form_validation->set_rules('price', 'Price', 'required');
      if (!$this->input->post('featured_img_old')) {
        $this->form_validation->set_rules('featured_img_new', 'Featured Image', 'required');
      }
      
      if ($this->form_validation->run()) {
        $this->load->model('MEvent');
        $this->load->model('MEventPhotos');

        $featuredImg = ($this->input->post('featured_img_old')) ? $this->input->post('featured_img_old'):$this->input->post('featured_img_new');
        $dataEdit = array(
          'title' => $this->input->post('title'),
          'id_type_project' => $this->input->post('type_project'),
          'featured_img' => $featuredImg,
          'deadline' => $this->input->post('deadline'),
          'start_registration' => $this->input->post('start_regis'),
          'finish_registration' => $this->input->post('end_regis'),
          'short_description' => $this->input->post('short_desc'),
          'description' => $this->input->post('desc'),
          'note' => $this->input->post('note'),
          'price' => str_replace('.','',$this->input->post('price')),
          'location' => $this->input->post('location'),
          'latitude' => $this->input->post('lat'),
          'longitude' => $this->input->post('long'),
          'registration_link' => $this->input->post('regis_link'),
          'status' => $this->input->post('status'),
        );
        $oldFeaturedImg = $this->MEvent->getFeaturedImg($idEvent);

        $updateEvent = $this->MEvent->edit($idEvent, $dataEdit);
        if ($updateEvent) {
          if (!$this->input->post('featured_img_old')) unlink($oldFeaturedImg->featured_img);

          $deletedGallery = $this->input->post('deletedGallery[]');
          if (count($deletedGallery) > 0) {
            foreach ($deletedGallery as $idGallery) {
              $urlImg = $this->MEventPhotos->getUrlImg($idGallery);
              unlink($urlImg->url);

              $dataDelete = array(
                'id_event_photos' => $idGallery,
                'id_event' => $idEvent
              );
              $this->MEventPhotos->delete($dataDelete);
            }
          }

          $gallery = $this->input->post('gallery[]');
          if (count($gallery) > 0) {
            foreach ($gallery as $link) {
              $dataInsertImg = array(
                'id_event' => $idEvent,
                'url' => $link,
              );
              $insertImg = $this->MEventPhotos->add($dataInsertImg);
            }
          }
        }
        
        if ($updateEvent) {
          $this->session->set_flashdata('status', 'success');
          $this->session->set_flashdata('message', 'Update Event success!');
        } else {
          $this->session->set_flashdata('status', 'error');
          $this->session->set_flashdata('message', 'Update Event failed!');
        }

        redirect(site_url('admin/event'));
      } else {
        $this->loadEventEditView($idEvent);
      }
    }
    public function deleteEvent() {
      $this->load->model('MEvent');
      $this->load->model('MEventPhotos');

      $id_event = $this->input->post('id');
      $dataDelete = array('id_event' => $id_event);
      $event = $this->MEvent->getWhere($dataDelete);
      $relatedImg = $this->MEventPhotos->getWhere($dataDelete);

      foreach ($relatedImg as $key => $value) {
        unlink($value->url);
      }
      unlink($event[0]->featured_img);

      $resImg = $this->MEventPhotos->delete($dataDelete);
      $res = $this->MEvent->delete($dataDelete);
      if ($res) {
        $data['status'] = 'success';
        $data['message'] = 'Delete event success!';
        die(json_encode($data));
      }else{
        $data['status'] = 'error';
        $data['message'] = 'Delete event Failed!';
        die(json_encode($data));
      }
    }
    // Event ============

    // Upload Img ============
    public function uploadImg() {
      $config['upload_path'] = 'assets/upload';
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
      $countFile = count($_FILES['files']['name']);
      
      $this->load->library('upload',$config);
      $data['img'] = [];
      for ($i=0; $i < $countFile; $i++) { 
        $_FILES['file']['name'] = time().str_replace(' ', '_', $_FILES['files']['name'][$i]);
        $_FILES['file']['type'] = $_FILES['files']['type'][$i];
        $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
        $_FILES['file']['error'] = $_FILES['files']['error'][$i];
        $_FILES['file']['size'] = $_FILES['files']['size'][$i];
        if($this->upload->do_upload('file')) {
          $temp = [
            "name" => $_FILES['files']['name'][$i],
            "size" => $_FILES['files']['size'][$i],
            "link" => $config['upload_path'].'/'.$_FILES['file']['name'],
          ];
          array_push($data['img'], $temp);
          // $this->output->set_status_header(500);
          // $this->output->set_output(strip_tags($this->upload->display_errors()));  
        }
      }
      die(json_encode($data));
    }
    public function removeImg() {
      if (unlink($this->input->post('imgLink'))) {
        die(json_encode(['status' => 'success']));
      } else {
        die(json_encode(['status' => 'failed']));
      }
    }
    // Upload Img ============
    
    // Private function ============
    private function datatableAssets() {
      $js = [
        base_url('assets/admin/plugins/datatables/jquery.dataTables.min.js'),
        base_url('assets/admin/plugins/datatables/dataTables.bootstrap4.min.js'),
        base_url('assets/admin/plugins/datatables/dataTables.buttons.min.js'),
        base_url('assets/admin/plugins/datatables/buttons.bootstrap4.min.js'),
        base_url('assets/admin/plugins/datatables/buttons.colVis.min.js'),
        base_url('assets/admin/plugins/datatables/dataTables.responsive.min.js'),
        base_url('assets/admin/plugins/datatables/responsive.bootstrap4.min.js'),
        base_url('assets/admin/pages/datatables.init.js'),
      ];
      $css = [
        base_url('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css'),
        base_url('assets/admin/plugins/datatables/buttons.bootstrap4.min.css'),
        base_url('assets/admin/plugins/datatables/responsive.bootstrap4.min.css'),
      ];

      $data = array('js' => $js, 'css' => $css);

      return $data;
    }

    private function loadUserAddView() {
      $this->load->model('MProvinces');

      $this->data['active'] = "users";
      $this->data['breadcrumb'] = [
        ['Users', site_url('admin/users')],
        ['Add Users', '#']
      ];
      $this->data['provinces'] = $this->MProvinces->getAll();
      $this->data['js_to_load'] = [
        base_url('assets/admin/js/select2.full.min.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/admin/css/select2.min.css'),
      ];

      $this->template->load('admin/tempAdmin', 'admin/user/userAdd', $this->data);
    }
    private function loadUserEditView($idUser) {
      $this->load->model('MUsers');
      
      $condition = array('id_user' => $idUser);
      $result = $this->MUsers->getWhere($condition);
      
      if (count($result) > 0) {
        $this->load->model('MProvinces');

        $this->data['active'] = "users";
        $this->data['breadcrumb'] = [
          ['Users', site_url('admin/users')],
          ['Edit Users', '#']
        ];
        $this->data['user'] = $result[0];
        $this->data['provinces'] = $this->MProvinces->getAll();
        $this->data['js_to_load'] = [
          base_url('assets/admin/js/select2.full.min.js'),
        ];
        $this->data['css_to_load'] = [
          base_url('assets/admin/css/select2.min.css'),
        ];

        $this->template->load('admin/tempAdmin', 'admin/user/userEdit', $this->data);
      } else {
        $this->session->set_flashdata('status', 'warning');
        $this->session->set_flashdata('message', 'User not found. Please check your database.');
        redirect('admin/users');
      }
    }

    private function loadProductAddView() {
      $this->load->model('MProductKategori');

      $this->data['active'] = "product";
      $this->data['breadcrumb'] = [
        ['Product', site_url('admin/product')],
        ['Add Product', site_url('admin/productAdd')]
      ];
      $this->data['js_to_load'] = [
        base_url('assets/admin/js/accounting.min.js'),
        base_url('assets/admin/plugins/ckeditor/ckeditor.js'),
        base_url('assets/admin/plugins/dropzone/dist/dropzone.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/admin/plugins/dropzone/dist/dropzone.css'),
      ];
      $this->data['allKategori'] = $this->MProductKategori->getAll();

      $this->template->load('admin/tempAdmin', 'admin/product/productAdd', $this->data);
    }
    private function loadProductEditView($idProduct) {
      $this->load->model('MProduct');
      
      $condition = array('id_product' => $idProduct);
      $result = $this->MProduct->getWhere($condition);
      
      if (count($result) > 0) {
        $this->load->model('MProductImages');
        $this->load->model('MProductKategori');

        $this->data['product'] = $result[0];
        $this->data['productGallery'] = $this->MProductImages->getWhere($condition);
        $this->data['allKategori'] = $this->MProductKategori->getAll();
        $this->data['active'] = 'product';
        $this->data['breadcrumb'] = [
          ['Product', site_url('admin/product')],
          ['Edit Product', site_url('admin/productEdit')]
        ];
        $this->data['js_to_load'] = [
          base_url('assets/admin/js/accounting.min.js'),
          base_url('assets/admin/plugins/ckeditor/ckeditor.js'),
          base_url('assets/admin/plugins/dropzone/dist/dropzone.js'),
        ];
        $this->data['css_to_load'] = [
          base_url('assets/admin/plugins/dropzone/dist/dropzone.css'),
        ];

        $this->template->load('admin/tempAdmin', 'admin/product/productEdit', $this->data);
      } else {
        $this->session->set_flashdata('status', 'warning');
        $this->session->set_flashdata('message', 'Product not found. Please check your database.');
        redirect('admin/product');
      }
    }

    private function loadEventAddView() {
      $this->load->model('MTypeProject');

      $this->data['active'] = "event";
      $this->data['breadcrumb'] = [
        ['Event', site_url('admin/event')],
        ['Add Event', site_url('admin/eventAdd')]
      ];
      $this->data['js_to_load'] = [
        base_url('assets/admin/js/accounting.min.js'),
        base_url('assets/admin/plugins/ckeditor/ckeditor.js'),
        base_url('assets/admin/plugins/dropzone/dist/dropzone.js'),
        base_url('assets/admin/plugins/bootstrap-datetimepicker/moment.js'),
        base_url('assets/admin/plugins/bootstrap-datetimepicker/tempusdominus-bootstrap-4.min.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/admin/plugins/dropzone/dist/dropzone.css'),
        base_url('assets/admin/plugins/bootstrap-datetimepicker/tempusdominus-bootstrap-4.min.css'),
      ];
      $this->data['allType'] = $this->MTypeProject->getAll();

      $this->template->load('admin/tempAdmin', 'admin/event/eventAdd', $this->data);
    }
    private function loadEventEditView($idEvent) {
      $this->load->model('MEvent');
      
      $condition = array('id_event' => $idEvent);
      $result = $this->MEvent->getWhere($condition);

      if (count($result) > 0) {
        $this->load->model('MEventPhotos');
        $this->load->model('MTypeProject');

        $this->data['event'] = $result[0];
        $this->data['eventPhotos'] = $this->MEventPhotos->getWhere($condition);
        $this->data['allType'] = $this->MTypeProject->getAll();
        $this->data['eventStatus'] = unserialize(EVENT_STATUS);
        $this->data['active'] = 'event';
        $this->data['breadcrumb'] = [
          ['Event', site_url('admin/event')],
          ['Edit Event', site_url('admin/eventEdit')]
        ];
        $this->data['js_to_load'] = [
          base_url('assets/admin/js/accounting.min.js'),
          base_url('assets/admin/plugins/ckeditor/ckeditor.js'),
          base_url('assets/admin/plugins/dropzone/dist/dropzone.js'),
          base_url('assets/admin/plugins/bootstrap-datetimepicker/moment.js'),
          base_url('assets/admin/plugins/bootstrap-datetimepicker/tempusdominus-bootstrap-4.min.js'),
        ];
        $this->data['css_to_load'] = [
          base_url('assets/admin/plugins/dropzone/dist/dropzone.css'),
          base_url('assets/admin/plugins/bootstrap-datetimepicker/tempusdominus-bootstrap-4.min.css'),
        ];

        $this->template->load('admin/tempAdmin', 'admin/event/eventEdit', $this->data);
      } else {
        $this->session->set_flashdata('status', 'warning');
        $this->session->set_flashdata('message', 'Event not found. Please check your database.');
        redirect('admin/event');
      }
    }
    // Private function ============
    /////////////////////////////////// END OF FUNCT ///////////////////////////////////////
  }
?>