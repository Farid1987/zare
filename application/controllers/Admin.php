<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Admin extends CI_Controller {
    
    public function __construct() {
      parent::__construct();
      if ($this->session->userdata('role')!='admin') {
        redirect('loginAdmin');
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

      $this->data['users'] = $this->MUsers->getAllUsers();
      $this->data['active'] = "users";
      $this->data['breadcrumb'] = [
        ['Users', site_url('admin/users')]
      ];
      $this->data['js_to_load'] = [
        base_url('assets/admin/plugins/datatables/jquery.dataTables.min.js'),
        base_url('assets/admin/plugins/datatables/dataTables.bootstrap4.min.js'),
        base_url('assets/admin/plugins/datatables/dataTables.buttons.min.js'),
        base_url('assets/admin/plugins/datatables/buttons.bootstrap4.min.js'),
        base_url('assets/admin/plugins/datatables/buttons.colVis.min.js'),
        base_url('assets/admin/plugins/datatables/dataTables.responsive.min.js'),
        base_url('assets/admin/plugins/datatables/responsive.bootstrap4.min.js'),
        base_url('assets/admin/pages/datatables.init.js')
      ];
      $this->data['css_to_load'] = [
        base_url('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css'),
        base_url('assets/admin/plugins/datatables/buttons.bootstrap4.min.css'),
        base_url('assets/admin/plugins/datatables/responsive.bootstrap4.min.css')
      ];

      $this->template->load('admin/tempAdmin', 'admin/users', $this->data);

    }

    public function kategoriProduct() {
      $this->load->model('MKategoriProduct');

      $this->data['kategori'] = $this->MKategoriProduct->getAll();
      $this->data['active'] = "masterdata";
      $this->data['breadcrumb'] = [
        ['Master Data', '#'],
        ['Kategori Product', site_url('admin/kategoriProduct')]
      ];
      $this->data['js_to_load'] = [
        base_url('assets/admin/plugins/datatables/jquery.dataTables.min.js'),
        base_url('assets/admin/plugins/datatables/dataTables.bootstrap4.min.js'),
        base_url('assets/admin/plugins/datatables/dataTables.buttons.min.js'),
        base_url('assets/admin/plugins/datatables/buttons.bootstrap4.min.js'),
        base_url('assets/admin/plugins/datatables/buttons.colVis.min.js'),
        base_url('assets/admin/pages/datatables.init.js'),
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/admin/plugins/datatables/dataTables.bootstrap4.min.css'),
        base_url('assets/admin/plugins/datatables/buttons.bootstrap4.min.css'),
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.css'),
      ];

      $this->template->load('admin/tempAdmin', 'admin/master_kategoriProduct', $this->data);
    }

    /////////////////////////////////// END OF PAGES ///////////////////////////////////////

    ////////////////////////////////////// FUNCT ///////////////////////////////////////////

    public function addKategori() {
      $this->form_validation->set_rules('kategori', 'Kategori', 'required');

      if ($this->form_validation->run()) {
        $this->load->model('MKategoriProduct');

        $kategori = $this->input->post('kategori');
        $dataInsert = array('nama_kategori' => $kategori);
        
        $this->MKategoriProduct->add($dataInsert);
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

      if ($this->form_validation->run()) {
        $this->load->model('MKategoriProduct');

        $kategori = $this->input->post('kategori');
        $id = $this->input->post('id_kategori');
        $dataUpdate = array('nama_kategori' => $kategori);
        
        $this->MKategoriProduct->edit($id, $dataUpdate);
        $data['status'] = 'success';
        die(json_encode($data));
      } else {
        $data['status'] = 'error';
        $data['message'] = $this->form_validation->error_array();
        die(json_encode($data));
      }
    }

    public function deleteKategori() {
      $this->load->model('MKategoriProduct');

      $id_kategori = $this->input->post('id');
      $dataDelete = array('id_kategori' => $id_kategori);

      $res = $this->MKategoriProduct->delete($dataDelete);
      if ($res) {
          $data['status'] = 'success';
          die(json_encode($data));
      }else{
          $data['status'] = 'error';
          $data['message'] = 'Delete User Failed!';
          die(json_encode($data));
      }
    }
    /////////////////////////////////// END OF FUNCT ///////////////////////////////////////
  }
?>