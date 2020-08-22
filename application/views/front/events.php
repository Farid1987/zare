<div class="main-wrapper">
  <div class="container">
    <h1 class="page-title text-center">Berkolaborasi Besama Zare</h1>
    <div class="page-subtitle text-center">- Zare Indonesia</div>

    <div class="product-filter flex flex-wrap items-center justify-center">
      <?php $currentType = $this->input->get('type');?>
      <a href="<?= site_url('/frontPage/events')?>" class="product-filter__item <?= (!isset($currentType)) ? 'active' : ''?>">SEMUA</a>
      <?php foreach ($allType as $key => $value) { ?>
        <a href="<?= site_url('/frontPage/events')?>?type=<?=$value->id_type_project?>" class="product-filter__item <?= (isset($currentType) && $currentType==$value->id_type_project) ? 'active' : ''?>"><?= strtoupper($value->type_project)?></a>
      <?php } ?>
    </div>

    <div class="product-list row">
      <?php foreach ($events as $key => $value) { ?>
        <div class="col-md-4 col-sm-6">
          <div class="box box-transparent box-event">
            <a href="" class="box-thumb img-rasio r-63">
              <img src="<?= base_url().'/'.$value->featured_img?>" alt="">
            </a>
            <div class="box-content">
              <div class="box-info flex flex-wrap@md justify-between">
                <div class="box-info__cat flex items-center">
                  <span class="circle circle-primary"></span>
                  <?= $value->type?>
                  <?php if (time() >= strtotime($value->start_registration) && time() <= strtotime($value->finish_registration)) { ?>
                    <span class="event-status text-primary">Open</span>
                  <?php } elseif (time() < strtotime($value->start_registration)) { ?>
                    <span class="event-status">Coming soon</span>
                  <?php } else { ?>
                    <span class="event-status text-secondary">Closed</span>
                  <?php } ?>
                </div>
                <div class="box-info__date">
                  <i class="fa fa-calendar"></i>
                  <?= date('F j', strtotime($value->start_registration))?> - <?= date('F j', strtotime($value->finish_registration))?>
                </div>
              </div>
              <h4 class="box-title text-primary">
                <a href=""><?= $value->title?></a>
              </h4>
              <span class="event-location"><?= $value->location?></span>
              <p class="box-desc"><?= $value->short_description?></p>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>

    <div class="text-center load-more">
      <?php if ($totalEvents > $per_page) { ?>
        <a href="" class="btn btn-primary btn-load-more">LIHAT LEBIH BANYAK</a>
        <input type="text" hidden id="limit" value="<?= $per_page?>">
        <input type="text" hidden id="page" value="<?= $per_page?>">
      <?php } ?>
    </div>
  </div>
</div>

<script type="text/javascript">
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    const btnLoadMore = document.querySelector('.btn-load-more');
    if (btnLoadMore) {
      btnLoadMore.addEventListener('click', function(e) {
        e.preventDefault();
        const url = '<?= site_url('frontPage/getNextEvent')?>';
        const type = '<?= $this->input->get('type')?>';
        const page = document.getElementById('page');
        const limit = document.getElementById('limit');
        const container = document.querySelector('.product-list');
        let xhr = new XMLHttpRequest();

        this.innerText = 'LOADING...';
        this.classList.add('disabled');
        xhr.open(
          'GET',
          url + '?page=' + page.value + '&limit=' + limit.value + '&type=' + type
        );
        xhr.onload = function() {
          if ( xhr.status === 200 ) {
            try {
              const res = JSON.parse(xhr.response);
              const newProduct = getHTMLProduct(res.data);
              const totalProduct = '<?= $totalEvents?>';
              page.value = res.nextPage;
              limit.value = res.limit;

              container.insertAdjacentHTML( 'beforeend', newProduct );
              btnLoadMore.classList.remove('disabled');
              (res.nextPage >= Number(totalProduct)) ? btnLoadMore.remove() : btnLoadMore.innerText='LIHAT LEBIH BANYAK';
            } catch (err) {
              console.log(err);
            }
          }
        }
        xhr.send();
      })
    }

    function getHTMLProduct(data) {
      let html = '';
      data.forEach(el => {
        const currentDate = new Date();
        const start = new Date(el.start_registration).toLocaleString('default', { month: 'long' }) +' '+new Date(el.start_registration).getDate();
        const end = new Date(el.finish_registration).toLocaleString('default', { month: 'long' }) +' '+new Date(el.finish_registration).getDate();
        html += `<div class="col-md-4 col-sm-6">
          <div class="box box-transparent box-event">
            <a href="" class="box-thumb img-rasio r-63">
              <img src="<?= base_url()?>/${el.featured_img}" alt="">
            </a>
            <div class="box-content">
              <div class="box-info flex flex-wrap@md justify-between">
                <div class="box-info__cat flex items-center">
                  <span class="circle circle-primary"></span>
                  ${el.type}

                  ${
                    (currentDate.getTime() >= new Date(el.start_registration).getTime() && currentDate.getTime() <= new Date(el.finish_registration).getTime()) ? `<span class="event-status text-primary">Open</span>` 
                    : currentDate.getTime() < new Date(el.start_registration).getTime() ? `<span class="event-status">Coming soon</span>`
                    : `<span class="event-status text-secondary">Closed</span>`
                  }
                </div>
                <div class="box-info__date">
                  <i class="fa fa-calendar"></i>
                  ${start} - ${end}
                </div>
              </div>
              <h4 class="box-title text-primary">
                <a href="">${el.title}</a>
              </h4>
              <span class="event-location">${el.location}</span>
              <p class="box-desc">${el.short_description}</p>
            </div>
          </div>
        </div>`;
      });

      return html;
    }
  })
})()
</script>