<div class="main-wrapper">
  <div class="container">
    <div class="flex">
      <div class="product-gallery__wrapper">
        <div class="swiper-container product-gallery__top">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="<?= base_url().'/'.$product->featured_img?>" alt="">
            </div>
            <?php for ($i=0; $i < count($product_gallery); $i++) { ?>
              <div class="swiper-slide">
                <img src="<?= base_url().'/'.$product_gallery[$i]?>" alt="">
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="swiper-container product-gallery__thumbs">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="<?= base_url().'/'.$product->featured_img?>" alt="">
            </div>
            <?php for ($i=0; $i < count($product_gallery); $i++) { ?>
              <div class="swiper-slide">
                <img src="<?= base_url().'/'.$product_gallery[$i]?>" alt="">
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="product-detail__wrapper">
        <span class="label"><?= strtoupper($product->kategori)?></span>

        <h1 class="product-detail__title text-primary"><?= $product->nama_product?></h1>
        <p class="product-detail__short-desc"><?= $product->short_description?></p>
        
        <div class="product-detail__price">Rp <?= $product->price?> /<?= $product->satuan?></div>
        <div class="product-detail__stock">stock : <?= ($product->stock > 0) ? '<span class="text-primary">tersedia(10)</span>':'<span class="text-secondary">habis</span>'?> </div>

        <div class="add-cart">
          <div class="add-cart__title">Masukkan Jumlah</div>
          
          <div class="flex">
            <div class="add-cart__count flex">
              <span class="minus flex items-center justify-center"><i class="fa fa-minus"></i></span>
              <input type="text" value="0" class="input" readonly>
              <span class="plus flex items-center justify-center"><i class="fa fa-plus"></i></span>
            </div>
            <a href="" class="btn btn-primary btn-icon">
              <i class="fa fa-shopping-cart"></i>
              BELI SEKARANG
            </a>
          </div>
        </div>

        <a href="" class="btn btn-rounded btn-primary--outline btn-icon">
          <i class="fa fa-commenting"></i>
          Tanya-tanya dulu
        </a>
      </div>
    </div>
    <div class="product-detail__desc flex">
      <div class="detail-wrapper">
        <div class="detail-title">DESKRIPSI</div>
        <div class="detail-content">
          <?= $product->description?>
        </div>
      </div>
      <div class="product-category__wrapper">
        <h4 class="category-title">PRODUK KATEGORI</h4>

        <div class="category-list">
          <a href="" class="category-list__item active">KOMBUCHA</a>
          <a href="" class="category-list__item">KEFIR</a>
          <a href="" class="category-list__item">SAYUR SEHAT</a>
          <a href="" class="category-list__item">TELUR AYAM AFRIKA</a>
        </div>
      </div>
    </div>

    <div class="product-terlaris">
      <h2 class="section-title section-title--sm">
        Product Terbaik Lainnya
      </h2>
      <div class="row">
        <?php for ($i=0; $i < 4; $i++) { ?>
          <div class="col-md-3 col-sm-6">
            <div class="box box-product box-product--sm">
              <a href="" class="box-thumb img-rasio r-100">
                <img src="<?= base_url()?>/assets/img/product1.png" alt="">
              </a>
              <div class="box-content">
                <a href="" class="label">KATEGORI</a>
                <h4 class="box-title text-primary">
                  <a href="">Kombucha Sirsak</a>
                </h4>
                <p class="box-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                <div class="flex justify-between box-product__info">
                  <div class="box-product__info-item">
                    <p class="product-price">12.000/Kg</p>
                    <p class="product-stock">stok : <span class="text-primary">tersedia</span></p>
                  </div>
                  <div class="box-product__info-item">
                    <a href="" class="btn btn-primary btn-icon">
                      <i class="fa fa-shopping-cart"></i>
                      AMBIL
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>