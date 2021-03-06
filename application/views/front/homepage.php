<section class="section-home-slider swiper-container js-swiper swiper-item-1">
  <!-- Additional required wrapper -->
  <div class="swiper-wrapper">
    <!-- Slides -->
    <?php for ($i=0; $i < 2; $i++) { ?>
      <div class="swiper-slide">
        <div class="home-slider__item flex items-center">
          <img class="home-slider__bg" src="<?= base_url()?>/assets/img/home-slider.jpg" alt="">
          <div class="container">
            <div class="home-slider__content">
              <h1 class="home-slider__title">Zare Indonesia</h1>
              <h4 class="home-slider__subtitle">INSPIRE EVERYONE TO HELP EACH OTHER AND LIFE HEALTHIER</h4>
              <p class="home-slider__desc">Berangkat dari meningkatnya minat masyarakat akan produk pertanian yang sehat. zare.id berfokus menyediakan bacaan seputar pertanian, mengadakan event kolaborasi, juga produk-produk sehat yang terjangkau. Kami mengajak masyarakat indonesia terutama millenials untuk hidup lebih sehat dan bisa memberikan aksi nyata untuk kemajuan pertanian Indonesia.</p>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <!-- If we need pagination -->
  <div class="swiper-pagination"></div>
</section>

<section class="section-our-journey">
  <div class="container">
    <h2 class="section-title text-center">Welcome to Our Journey</h2>
  
    <div class="row gap-50">
      <div class="col-md-4">
        <div class="box box-rounded-15 box-hover box-journey text-center">
          <div class="box-thumb">
            <img src="<?= base_url()?>/assets/img/health_product.svg" alt="">
          </div>
          <div class="box-content">
            <h4 class="box-journey__title text-primary">HEALTH PRODUCT</h4>
            <p class="box-journey__desc">Temukan produk sehat homemade, hasil petani dan produsen lokal</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-rounded-15 box-hover box-journey text-center">
          <div class="box-thumb">
            <img src="<?= base_url()?>/assets/img/workshop.svg" alt="">
          </div>
          <div class="box-content">
            <h4 class="box-journey__title text-primary">WORKSHOP KOLABORASI</h4>
            <p class="box-journey__desc">Terjun langsung ke lahan dan desa untuk memberikan aksi nyata bagi kemajuan indonesia</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-rounded-15 box-hover box-journey text-center">
          <div class="box-thumb">
            <img src="<?= base_url()?>/assets/img/blog.svg" alt="">
          </div>
          <div class="box-content">
            <h4 class="box-journey__title text-primary">BLOG</h4>
            <p class="box-journey__desc">Temukan fakta dan data menarik tentang pertanian indonesia</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container">
  <section class="section-health-product">
    <div class="box box-grey box-rounded-20 box-health-product flex justify-between">
      <div class="box-content">
        <h2 class="section-title text-primary">Health Product</h2>
        <div class="health-product__desc">
          <p>Kami memiliki banyak pilihan macam produk sehat, pick your choice</p>
          
          <div class="health-product__list flex">
            <img src="<?= base_url()?>/assets/img/check.svg" alt="">
            <span>Sehat, kaya nutrisi, dan terjangkau</span>
          </div>
          <div class="health-product__list flex">
            <img src="<?= base_url()?>/assets/img/check.svg" alt="">
            <span>Dari petani dan produsen lokal</span>
          </div>
          <div class="health-product__list flex">
            <img src="<?= base_url()?>/assets/img/check.svg" alt="">
            <span>Banyak pilihan macam produk, dari produk pertanian organik, sampai dengan produk homemade</span>
          </div>
        </div>
      </div>
      <div class="box-img">
        <img src="<?= base_url()?>/assets/img/health-section.png" alt="">
      </div>
    </div>
  </section>
</div>

<section class="section-product">
  <div class="container">
    <h2 class="section-title section-title--sm flex items-center justify-between">
      Product Kami

      <a href="<?= site_url('frontPage/products')?>" class="section-title__link text-primary flex items-center">
        LIHAT SEMUA
        <i class="fa fa-arrow-right"></i>
      </a>
    </h2>
    
    <div class="swiper-arrow__wrapper">
      <div class="swiper-container js-swiper swiper-item-4 product-slider" data-items="4" data-space="35">
        <div class="swiper-wrapper">
          <?php foreach ($products as $key => $value) { ?>
            <div class="swiper-slide">
              <div class="box box-product box-product--sm">
                <a href="" class="box-thumb img-rasio r-100">
                  <img src="<?= base_url().'/'.$value->featured_img?>" alt="">
                </a>
                <div class="box-content">
                  <a href="<?= site_url('frontPage/products')?>?kategori=<?= $value->id_kategori?>" class="label"><?= $value->kategori?></a>
                  <h4 class="box-title text-primary">
                    <a href=""><?= $value->nama_product?></a>
                  </h4>
                  <p class="box-desc"><?= $value->short_description?></p>
                  <div class="flex justify-between box-product__info">
                    <div class="box-product__info-item">
                      <p class="product-price">Rp <?= number_format($value->price, 0, '.', '.').' /'.$value->satuan?></p>
                      <?php if ($value->stock > 0) { ?>
                        <p class="product-stock">stok : <span class="text-primary">tersedia</span></p>
                      <?php } else {?>
                        <p class="product-stock">stok : <span class="text-secondary">habis</span></p>
                      <?php } ?>
                    </div>
                    <div class="box-product__info-item">
                      <?php if ($value->stock > 0) { ?>
                        <form action="<?= site_url('frontPage/addToCart')?>" method="post">
                          <input type="hidden" name="id" value="<?= $value->id_product?>">
                          <input type="hidden" name="qty" value="1">
                          <button type="submit" href="" class="btn btn-primary btn-icon">
                            <i class="fa fa-shopping-cart"></i>
                            AMBIL
                          </button>
                        </form>
                      <?php } else { ?>
                        <a href="" class="btn btn-primary btn-icon" onclick="alert('Product habis'); return false;">
                          <i class="fa fa-shopping-cart"></i>
                          AMBIL
                        </a>
                      <?php } ?>
                      <!-- <a href="" class="btn btn-primary btn-icon">
                        <i class="fa fa-shopping-cart"></i>
                        AMBIL
                      </a> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="swiper-button-next">
        <i class="fa fa-arrow-right"></i>
      </div>
      <div class="swiper-button-prev">
        <i class="fa fa-arrow-left"></i>
      </div>
    </div>
  </div>
</section>

<section class="section-blog">
  <div class="container">
    <h2 class="section-title section-title--sm flex items-center justify-between">
      Aku, kamu dan Pertanian Berkelanjutan

      <a href="" class="section-title__link text-primary flex items-center">
        LIHAT SEMUA
        <i class="fa fa-arrow-right"></i>
      </a>
    </h2>

    <div class="swiper-arrow__wrapper">
      <div class="swiper-container js-swiper swiper-item-3" data-items="3" data-space="45">
        <div class="swiper-wrapper">
          <?php for ($i=0; $i < count($blog); $i++) { ?>
            <div class="swiper-slide">
              <div class="box box-transparent box-blog">
                <a href="<?= $blog[$i]['link']?>" target="_blank" class="box-thumb img-rasio r-63">
                  <img src="<?= $blog[$i]['image']?>" alt="">
                </a>
                <div class="box-content">
                  <div class="box-info flex justify-between">
                    <span class="box-info__cat"><?= $blog[$i]['type']?></span>
                    <span class="box-info__date"><?= $blog[$i]['date']?></span>
                  </div>
                  <h4 class="box-title text-primary">
                    <a href="<?= $blog[$i]['link']?>" target="_blank"><?= $blog[$i]['title']?></a>
                  </h4>
                  <p class="box-desc"><?= $blog[$i]['short_desc']?></p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
      <div class="swiper-button-next">
        <i class="fa fa-arrow-right"></i>
      </div>
      <div class="swiper-button-prev">
        <i class="fa fa-arrow-left"></i>
      </div>
    </div>
  </div>
</section>

<section class="section-event">
  <div class="container">
    <h2 class="section-title section-title--sm flex items-center justify-between">
      Berkolaborasi bersama Zare

      <a href="<?= site_url('frontPage/events')?>" class="section-title__link text-primary flex items-center">
        LIHAT SEMUA
        <i class="fa fa-arrow-right"></i>
      </a>
    </h2>

    <div class="event-toggle flex justify-center">
      <a href="" class="event-toggle__item active" data-target="#event">EVENT</a>
      <a href="" class="event-toggle__item" data-target="#workshop">WORKSHOP</a>
    </div>

    <div class="swiper-arrow__wrapper" id="event">
      <div class="swiper-container js-swiper swiper-item-3" data-items="3" data-space="45">
        <div class="swiper-wrapper">
          <?php for ($i=0; $i < count($otherEvent); $i++) { ?>
            <div class="swiper-slide">
              <div class="box box-transparent box-event">
                <a href="<?= site_url('frontPage/eventDetail').'/'.$otherEvent[$i]->id_event?>" class="box-thumb img-rasio r-63">
                  <img src="<?= base_url().'/'.$otherEvent[$i]->featured_img?>" alt="">
                </a>
                <div class="box-content">
                  <div class="box-info flex flex-wrap@md justify-between">
                    <div class="box-info__cat flex items-center">
                      <span class="circle circle-primary"></span>
                      <?= $otherEvent[$i]->type?>
                      <?php if (time() < strtotime($otherEvent[$i]->finish_registration)) { ?>
                        <span class="event-status text-primary">Open</span>
                      <?php } else { ?>
                        <span class="event-status text-secondary">Closed</span>
                      <?php } ?>
                    </div>
                    <div class="box-info__date">
                      <i class="fa fa-calendar"></i>
                      <?= date('F j', strtotime($otherEvent[$i]->start_registration))?> - <?= date('F j', strtotime($otherEvent[$i]->finish_registration))?>
                    </div>
                  </div>
                  <h4 class="box-title text-primary">
                    <a href="<?= site_url('frontPage/eventDetail').'/'.$otherEvent[$i]->id_event?>"><?= $otherEvent[$i]->title?></a>
                  </h4>
                  <span class="event-location"><?= $otherEvent[$i]->location?></span>
                  <p class="box-desc"><?= $otherEvent[$i]->short_description?></p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
      
      <div class="swiper-button-next">
        <i class="fa fa-arrow-right"></i>
      </div>
      <div class="swiper-button-prev">
        <i class="fa fa-arrow-left"></i>
      </div>
    </div>
    
    <div class="swiper-arrow__wrapper" id="workshop">
      <div class="swiper-container js-swiper swiper-item-3" data-items="3" data-space="45" data-display="none">
        <div class="swiper-wrapper">
          <?php for ($i=0; $i < count($workshop); $i++) { ?>
            <div class="swiper-slide">
              <div class="box box-transparent box-event">
                <a href="" class="box-thumb img-rasio r-63">
                  <img src="<?= base_url().'/'.$workshop[$i]->featured_img?>" alt="">
                </a>
                <div class="box-content">
                  <div class="box-info flex flex-wrap@md justify-between">
                    <div class="box-info__cat flex items-center">
                      <span class="circle circle-primary"></span>
                      <?= $workshop[$i]->type?>
                      <?php if (time() < strtotime($workshop[$i]->finish_registration)) { ?>
                        <span class="event-status text-primary">Open</span>
                      <?php } else { ?>
                        <span class="event-status text-secondary">Closed</span>
                      <?php } ?>
                    </div>
                    <div class="box-info__date">
                      <i class="fa fa-calendar"></i>
                      <?= date('F j', strtotime($workshop[$i]->start_registration))?> - <?= date('F j', strtotime($workshop[$i]->finish_registration))?>
                    </div>
                  </div>
                  <h4 class="box-title text-primary">
                    <a href=""><?= $workshop[$i]->title?></a>
                  </h4>
                  <span class="event-location"><?= $workshop[$i]->location?></span>
                  <p class="box-desc"><?= $workshop[$i]->short_description?></p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
      
      <div class="swiper-button-next">
        <i class="fa fa-arrow-right"></i>
      </div>
      <div class="swiper-button-prev">
        <i class="fa fa-arrow-left"></i>
      </div>
    </div>
  </div>
</section>

<section class="section-follow">
  <div class="container">
    <h2 class="section-title section-title--sm flex items-center justify-between">
      Kenapa bersama Zare.id

      <a href="https://www.instagram.com/zareindonesia/" target="__blank" class="btn btn-primary btn-rounded">
        Follow Instagram Zare
      </a>
    </h2>

    <div class="row">
      <div class="col-md-7">
        <?php for ($i=0; $i < 2; $i++) { ?>
          <div class="flex items-start partner-wrapper">
            <a href="<?= $blog[$i]['link']?>" target="_blank" class="partner-thumb">
              <div class="img-rasio r-100">
                <img src="<?= $blog[$i]['image']?>" alt="">
              </div>
            </a>
            <div class="partner-content">
              <h4 class="partner-title"><?= $blog[$i]['title']?></h4>
              <p class="partner-desc"><?= $blog[$i]['short_desc']?></p>
              <a href="<?= $blog[$i]['link']?>" target="_blank" class="btn btn-primary">Baca Selengkapnya</a>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="col-md-5">
        <div class="ig-feed flex flex-wrap" data-url="https://www.instagram.com/zareindonesia/?__a=1">
          <?php for ($i=0; $i < 6; $i++) { ?>
            <a href="https://www.instagram.com/p/CDdWR8Snzka/" target="__blank" class="ig-feed__item">
              <div class="img-rasio r-100">
                <img src="https://instagram.fsoc1-1.fna.fbcdn.net/v/t51.2885-15/e35/116582099_955440678262959_9078401629976227098_n.jpg?_nc_ht=instagram.fsoc1-1.fna.fbcdn.net&_nc_cat=103&_nc_ohc=3fn6xhKotBUAX8skajr&_nc_tp=18&oh=8c4b85b87cb9df2f0cbf26616ff295b6&oe=5FA0F371" alt="">
              </div>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section-subscribe text-center">
  <div class="container">
    <h2 class="section-subscribe__title">Let’s get healthier and help each others</h2>
    <p class="section-subscribe__desc">lets join the movement <i class="fa fa-thumbs-up"></i></p>

    <div class="section-subscribe__form">
      <form action="">
        <input type="email" placeholder="Masukkan email anda">
        <button type="submit" class="btn btn-primary">Jalin Kolaborasi!</button>
      </form>
    </div>
  </div>
</section>