<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class FrontPage extends CI_Controller {

    public function __construct() {
      parent::__construct();
    }

    public function index() {
      
      $this->data['js_to_load'] = [
        base_url('assets/js/swiper-bundle.min.js'),
      ];
      $this->data['css_to_load'] = [
        base_url('assets/css/swiper-bundle.min.css'),
      ];;

      $this->template->load('front/tempFront', 'front/homepage', $this->data);
    }
  }

?>