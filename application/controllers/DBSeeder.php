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
  }
?>