<div class="main-wrapper">
  <div class="container">
    <h1 class="page-title text-center">Sehat dan bergizi</h1>
    <div class="page-subtitle text-center">- Zare Indonesia</div>

    <div class="product-filter flex flex-wrap items-center justify-center">
      <a href="" class="product-filter__item active">SEMUA</a>
      <a href="" class="product-filter__item">KOMBUCHA</a>
      <a href="" class="product-filter__item">KEFIR</a>
    </div>

    <div class="product-list row">
      <?php for ($i=0; $i < 6; $i++) { ?>
        <div class="col-md-4 col-sm-6">
          <a href="" class="box box-hover box-rounded-10 box-product">
            <div class="box-thumb img-rasio r-100 mb-0">
              <img src="<?= base_url()?>/assets/img/product1-big.jpg" alt="">
            </div>
            <div class="box-content box-content__product">
              <h4 class="box-title text-primary">
                Kombucha Sirsak
              </h4>
              <span class="label">KATEGORI</span>
              <div class="flex justify-between items-center box-product__info">
                <div class="box-product__info-item">
                  <p class="product-price text-secondary">12.000/Kg</p>
                </div>
                <div class="box-product__info-item">
                  <p class="product-stock flex items-center">
                    <span class="circle circle-primary"></span><span class="text-primary">tersedia</span>
                  </p>
                </div>
              </div>
            </div>
          </a>
        </div>
      <?php } ?>
    </div>

    <div class="text-center load-more">
      <a href="" class="btn btn-primary btn-load-more">LIHAT LEBIH BANYAK</a>
    </div>
    
    <div class="product-terlaris">
      <h2 class="section-title section-title--sm">
        Product Terlaris
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