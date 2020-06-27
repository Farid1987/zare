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

      $this->template->load('admin/tempAdmin', 'admin/users', $this->data);

    }

    /////////////////////////////////// END OF PAGES ///////////////////////////////////////

    ////////////////////////////////////// FUNCT ///////////////////////////////////////////

    /////////////////////////////////// END OF FUNCT ///////////////////////////////////////
  }
?>