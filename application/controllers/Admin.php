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
      $this->data['js_to_load'] = array_merge($this->datatableAssets()['js'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.js'),
      ]);
      $this->data['css_to_load'] = array_merge($this->datatableAssets()['css'], [
        base_url('assets/admin/plugins/sweet-alert2/sweetalert2.min.css'),
      ]);

      $this->template->load('admin/tempAdmin', 'admin/user/users', $this->data);
    }

    public function userAdd() {
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

    public function userEdit($idUser) {
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

    /////////////////////////////////// END OF PAGES ///////////////////////////////////////

    ////////////////////////////////////// FUNCT ///////////////////////////////////////////

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
        $this->load->model('MProvinces');
      
        $condition = array('id_user' => $idUser);
        $result = $this->MUsers->getWhere($condition);

        $this->data['active'] = "users";
        $this->data['breadcrumb'] = [
          ['Users', site_url('admin/users')],
          ['Add Users', '#']
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

    public function addKategori() {
      $this->form_validation->set_rules('kategori', 'Kategori', 'required');

      if ($this->form_validation->run()) {
        $this->load->model('MProductKategori');

        $kategori = $this->input->post('kategori');
        $dataInsert = array('nama_kategori' => $kategori);
        
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

      if ($this->form_validation->run()) {
        $this->load->model('MProductKategori');

        $kategori = $this->input->post('kategori');
        $id = $this->input->post('id_kategori');
        $dataUpdate = array('nama_kategori' => $kategori);
        
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

    public function getRegencies() {
      $this->load->model('MRegencies');
      
      $idProv = $this->input->get('idProv');
      $condition = array('province_id' => $idProv);
      $result = $this->MRegencies->getWhere($condition);
      
      die(json_encode($result));
    }
    
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
    /////////////////////////////////// END OF FUNCT ///////////////////////////////////////
  }
?>