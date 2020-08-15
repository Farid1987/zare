<div class="main-wrapper">
  <div class="container">
    <h1 class="page-title text-center">Sehat dan bergizi</h1>
    <div class="page-subtitle text-center">- Zare Indonesia</div>

    <div class="product-filter flex flex-wrap items-center justify-center">
      <?php $currentKategori = $this->input->get('kategori');?>
      <a href="<?= site_url('/frontPage/products')?>" class="product-filter__item <?= (!isset($currentKategori)) ? 'active' : ''?>">SEMUA</a>
      <?php foreach ($kategori as $key => $value) { ?>
        <a href="<?= site_url('/frontPage/products')?>?kategori=<?=$value->id_kategori?>" class="product-filter__item <?= (isset($currentKategori) && $currentKategori==$value->id_kategori) ? 'active' : ''?>"><?= strtoupper($value->nama_kategori)?></a>
      <?php } ?>
    </div>

    <div class="product-list row">
      <?php foreach ($products as $key => $value) { ?>
        <div class="col-md-4 col-sm-6">
          <a href="<?= site_url('frontPage/productDetail/'.$value->id_product)?>" class="box box-hover box-rounded-10 box-product">
            <div class="box-thumb img-rasio r-100 mb-0">
              <img src="<?= base_url().'/'.$value->featured_img?>" alt="">
            </div>
            <div class="box-content box-content__product">
              <h4 class="box-title text-primary">
                <?= $value->nama_product?>
              </h4>
              <span class="label"><?= $value->kategori?></span>
              <div class="flex justify-between items-center box-product__info">
                <div class="box-product__info-item">
                  <p class="product-price text-secondary"><?= number_format($value->price, 0, '.', '.').' /'.$value->satuan?></p>
                </div>
                <div class="box-product__info-item">
                  <p class="product-stock flex items-center">
                    <?php if ($value->stock > 0) { ?>
                      <span class="circle circle-primary"></span><span class="text-primary">tersedia</span>
                    <?php } else {?>
                      <span class="circle circle-secondary"></span><span class="text-secondary">habis</span>
                    <?php } ?>
                  </p>
                </div>
              </div>
            </div>
          </a>
        </div>
      <?php } ?>
    </div>

    <div class="text-center load-more">
      <?php if ($totalProducts > $per_page) { ?>
        <a href="" class="btn btn-primary btn-load-more">LIHAT LEBIH BANYAK</a>
        <input type="text" hidden id="limit" value="<?= $per_page?>">
        <input type="text" hidden id="page" value="<?= $per_page?>">
      <?php } ?>
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

<script type="text/javascript">
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    const btnLoadMore = document.querySelector('.btn-load-more');
    if (btnLoadMore) {
      btnLoadMore.addEventListener('click', function(e) {
        e.preventDefault();
        const url = '<?= site_url('frontPage/getNextProduct')?>';
        const kategori = '<?= $this->input->get('kategori')?>';
        const page = document.getElementById('page');
        const limit = document.getElementById('limit');
        const container = document.querySelector('.product-list');
        let xhr = new XMLHttpRequest();

        this.innerText = 'LOADING...';
        this.classList.add('disabled');
        xhr.open(
          'GET',
          url + '?page=' + page.value + '&limit=' + limit.value + '&kategori=' + kategori
        );
        xhr.onload = function() {
          if ( xhr.status === 200 ) {
            try {
              const res = JSON.parse(xhr.response);
              const newProduct = getHTMLProduct(res.data);
              const totalProduct = '<?= $totalProducts?>';
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
        html += `<div class="col-md-4 col-sm-6">
          <a href="<?= site_url('frontPage/productDetail/')?>/${el.id_product}" class="box box-hover box-rounded-10 box-product">
            <div class="box-thumb img-rasio r-100 mb-0">
              <img src="<?= base_url()?>/${el.featured_img}" alt="">
            </div>
            <div class="box-content box-content__product">
              <h4 class="box-title text-primary">
                ${el.nama_product}
              </h4>
              <span class="label">${el.kategori}</span>
              <div class="flex justify-between items-center box-product__info">
                <div class="box-product__info-item">
                  <p class="product-price text-secondary">${window.customHelper.formatMoney(el.price, 0, ',', '.')} /${el.satuan}</p>
                </div>
                <div class="box-product__info-item">
                  <p class="product-stock flex items-center">
                    ${(el.stock > 0) ? '<span class="circle circle-primary"></span><span class="text-primary">tersedia</span>' : '<span class="circle circle-secondary"></span><span class="text-secondary">habis</span>'}
                  </p>
                </div>
              </div>
            </div>
          </a>
        </div>`;
      });

      return html;
    }
  })
})()
</script>