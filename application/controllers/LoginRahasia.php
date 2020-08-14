<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class LoginRahasia extends CI_Controller {
    
    public function __construct() {
      parent::__construct();
    }

    /////////////////////////////////////// PAGES ///////////////////////////////////////

    public function index() {
      if ($this->session->userdata('role')!=null) {
				if ($this->session->userdata('role')=='admin'){
					redirect('admin');
				} else if ($this->session->userdata('role')=='member') {
          redirect('frontPage');
        }
			}
      $this->load->view('auth/loginAdmin.php');
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

      if ($res->num_rows() == 1) {
        foreach ($res->result() as $sess) {
          $sess_data['fullname'] = $sess->fullname;
          $sess_data['email'] = $sess->email;
          $sess_data['role'] = $sess->role;
          $sess_data['id_user'] = $sess->id_user;
          $this->session->set_userdata($sess_data);
        }

        if ($sess_data['role'] == 'admin') {
          redirect('admin');
        }
      } else {
        $this->session->set_flashdata('errorlog', 'Incorrect username or password');
				$this->session->set_flashdata('erroruser', $data['username']);
				redirect('loginRahasia');
      }
    }

    public function logout(){
			$this->session->sess_destroy();
			redirect('loginRahasia');
    }
    
    /////////////////////////////////// END OF FUNCT ///////////////////////////////////////
  }
?>