<div class="main-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="box box-body box-border">
          <div class="row">
            <div class="col-md-5">
              <div class="swiper-container product-gallery__top">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <img src="<?= base_url().'/'.$event->featured_img?>" alt="">
                  </div>
                  <?php if ($event_gallery != null) {
                    for ($i=0; $i < count($event_gallery); $i++) { ?>
                    <div class="swiper-slide">
                      <img src="<?= base_url().'/'.$event_gallery[$i]?>" alt="">
                    </div>
                  <?php }
                  } ?>
                </div>
              </div>
              <div class="swiper-container product-gallery__thumbs" data-space="10">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="img-rasio r-100">
                      <img src="<?= base_url().'/'.$event->featured_img?>" alt="">
                    </div>
                  </div>
                  <?php if ($event_gallery != null) {
                    for ($i=0; $i < count($event_gallery); $i++) { ?>
                    <div class="swiper-slide">
                      <div class="img-rasio r-100">
                        <img src="<?= base_url().'/'.$event_gallery[$i]?>" alt="">
                      </div>
                    </div>
                  <?php }
                  } ?>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <h1 class="event-title text-primary"><?= $event->title?></h1>
              <div class="event-location flex items-baseline">
                <i class="fa fa-map-marker-alt"></i>
                <?= $event->location?>
              </div>
              <div class="flex justify-between mb-10">
                <strong>Deadline pendaftaran</strong>
                <span><?= date('j F Y', strtotime($event->finish_registration))?></span>
              </div>
              <div class="flex justify-between mb-10">
                <strong>Status</strong>
                <span class="mb-0 label"><?= $event->status?></span>
              </div>
              <div class="flex justify-between mb-10">
                <strong>Jenis</strong>
                <span class="mb-0 label"><?= $event->type?></span>
              </div>
            </div>
          </div>

          <div class="event-description">
            <?= $event->description?>
          </div>
          <div class="event-note">
            <strong>Note :</strong>
            <div class="event-note__content">
              <?= $event->note?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="box box-body box-border">
          <h2 class="event-price text-secondary">
            Rp <?= number_format($event->price, 0, '.', '.')?>
          </h2>
          <div class="flex items-center event-info">
            <i class="fa fa-calendar-alt"></i>
            <?= $event->deadline?>
          </div>
          <a href="https://www.google.com/maps/search/?api=1&query=<?= $event->latitude?>,<?= $event->longitude?>" target="blank" class="flex items-center event-info mb-20">
            <i class="fa fa-map-marker-alt"></i>
            Lihat map
          </a>
          
          <?php if ($event->status == 'process') { ?>
            <a href="<?= ($event->registration_link) ? $event->registration_link:'#'?>" class="btn btn-primary btn-block <?= (time() < strtotime($event->start_registration)) ? 'disabled':''?>">Daftar sekarang</a>
            <?php if (time() < strtotime($event->start_registration)) { ?>
              <small class="text-danger">* pendaftaran dibuka tanggal <?= date('j F Y', strtotime($event->start_registration))?></small>
            <?php } ?>
          <?php } else { ?>
            <span class="btn btn-block btn-secondary">Event Selesai</span>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>