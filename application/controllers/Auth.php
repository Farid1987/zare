<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Auth extends CI_Controller {

    public function __construct() {
      parent::__construct();
    }

    /////////////////////////////////////// PAGES ///////////////////////////////////////

    public function index() {
      if ($this->session->userdata('role')!=null && $this->session->userdata('role')=='member') {
        redirect('frontPage');
			}
      $this->data['header_class'] = 'header-white';
      $this->template->load('front/tempFront', 'auth/login', $this->data);
    }

    public function register() {
      if ($this->session->userdata('role')!=null && $this->session->userdata('role')=='member') {
        redirect('frontPage');
			}
      $this->data['header_class'] = 'header-white';
      $this->template->load('front/tempFront', 'auth/register', $this->data);
    }

    /////////////////////////////////// END OF PAGES ///////////////////////////////////////
    
    ////////////////////////////////////// FUNCT ///////////////////////////////////////////
    
    public function checkLogin() {
      $this->load->model('MUsers');

      $data = array(
        'email' => $this->input->post('email'),
        'password' => md5($this->input->post('password'))
      );
      $res = $this->MUsers->checkUser($data);
      $data = $res->result();

      // var_dump($data[0]->role);die;

      if ($res->num_rows() == 1 && $data[0]->role == 'member') {
        foreach ($res->result() as $sess) {
          $sess_data['fullname'] = $sess->fullname;
          $sess_data['email'] = $sess->email;
          $sess_data['role'] = $sess->role;
          $sess_data['id_user'] = $sess->id_user;
          $this->session->set_userdata($sess_data);
        }

        redirect('frontPage');
      } else {
        $this->session->set_flashdata('errorlog', 'Incorrect username or password');
				$this->session->set_flashdata('erroruser', $data['username']);
				redirect('auth');
      }
    }

    public function addUser() {
      $this->form_validation->set_rules('fullname', 'Fullname', 'required');
      $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
      $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

      if ($this->form_validation->run()) {
        $this->load->model('MUsers');

        $dataInsert = array(
          'email' => $this->input->post('email'),
          'password' => md5($this->input->post('password')),
          'role' => 'member',
          'fullname' => $this->input->post('fullname')
        );
        $insert = $this->MUsers->add($dataInsert);
        if ($insert) {
          $this->session->set_flashdata('status', 'success');
          $this->session->set_flashdata('message', 'Register success, please login with your account.');
        }
        redirect(site_url('auth'));
      } else {
        $this->data['header_class'] = 'header-white';
        $this->template->load('front/tempFront', 'auth/register', $this->data);
      }
    }

    public function logout(){
			$this->session->sess_destroy();
			redirect('frontPage');
    }

    /////////////////////////////////// END OF FUNCT ///////////////////////////////////////
  
  }