<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class DBSeeder extends CI_Controller {
    public function products() {
      include APPPATH.'/third_party/faker/autoload.php';
      $faker = Faker\Factory::create();
      
      $this->load->model('MProduct');
      $this->load->model('MProductKategori');
      
      $allKategori = $this->MProductKategori->getAll();
      $idKategori = [];
      $img = ['assets/upload/1596308320product1.png', 'assets/upload/1596829132product2.png', 'assets/upload/1596829132product3.png'];
      foreach ($allKategori as $key => $value) {
        array_push($idKategori, $value->id_kategori);
      }

      for($i=0;$i<30;$i++) {
        $dataInsert = array(
          'nama_product' => $faker->sentence($nbWords = 3, $variableNbWords = true),
          'id_kategori' => $faker->randomElement($idKategori),
          'stock' => $faker->numberBetween($min = 0, $max = 50),
          'featured_img' => $faker->randomElement($img),
          'short_description' => $faker->sentence($nbWords = 10, $variableNbWords = true),
          'description' => '<p>Description<p>',
          'price' => $faker->numberBetween($min = 10000, $max = 50000),
        );
        
        $insert = $this->MProduct->add($dataInsert);
        if ($insert) {
          echo "success";
        } else {
          echo "failed";
        }
      }
    }

    public function events() {
      include APPPATH.'/third_party/faker/autoload.php';
      $faker = Faker\Factory::create();

      $this->load->model('MEvent');
      $this->load->model('MTypeProject');

      $allType = $this->MTypeProject->getAll();
      $idType = [];

      foreach ($allType as $key => $value) {
        array_push($idType, $value->id_type_project);
      }
      for ($i=0; $i < 20; $i++) { 
        $deadline = $faker->dateTimeThisYear($timezone = null);
        $startRegis = $faker->dateTimeBetween($startDate = '-1 years', $endDate = $deadline, $timezone = null);
        // $startRegis = $faker->dateTimeThisYear($max = $deadline, $timezone = null);
        $finishRegis = $faker->dateTimeBetween($startDate = $startRegis, $endDate = $deadline, $timezone = null);
        
        $dataInsert = array(
          'title' => $faker->sentence($nbWords = 3, $variableNbWords = true),
          'id_type_project' => $faker->randomElement($idType),
          'featured_img' => 'assets/upload/15969092605GK0KjhBLs4.png',
          'deadline' => $deadline->format('Y-m-d H:i:s'),
          'start_registration' => $startRegis->format('Y-m-d H:i:s'),
          'finish_registration' => $finishRegis->format('Y-m-d H:i:s'),
          'short_description' => $faker->sentence($nbWords = 10, $variableNbWords = true),
          'description' => '<p>Description<p>',
          'note' => $faker->sentence($nbWords = 10, $variableNbWords = true),
          'price' => $faker->numberBetween($min = 20000, $max = 50000),
          'location' => 'Location',
          'latitude' => $faker->numberBetween($min = 10000, $max = 50000),
          'longitude' => $faker->numberBetween($min = 10000, $max = 50000),
          'registration_link' => '',
          'status' => (time() > strtotime($deadline->format('Y-m-d H:i:s'))) ? 'complete':'process'
        );

        
        $insert = $this->MEvent->add($dataInsert);
        if ($insert) {
          echo "success";
        } else {
          echo "failed";
        }
      }
    }
  }
?>