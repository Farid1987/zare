<div class="main-wrapper">
  <div class="container">
    <div class="flex">
      <div class="product-gallery__wrapper">
        <div class="swiper-container product-gallery__top">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img src="<?= base_url().'/'.$product->featured_img?>" alt="">
            </div>
            <?php if ($product_gallery != null) {
              for ($i=0; $i < count($product_gallery); $i++) { ?>
              <div class="swiper-slide">
                <img src="<?= base_url().'/'.$product_gallery[$i]?>" alt="">
              </div>
            <?php }
            } ?>
          </div>
        </div>
        <div class="swiper-container product-gallery__thumbs">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="img-rasio r-100">
                <img src="<?= base_url().'/'.$product->featured_img?>" alt="">
              </div>
            </div>
            <?php if ($product_gallery != null) {
              for ($i=0; $i < count($product_gallery); $i++) { 
            ?>
              <div class="swiper-slide">
                <div class="img-rasio r-100">
                  <img src="<?= base_url().'/'.$product_gallery[$i]?>" alt="">
                </div>
              </div>
            <?php }
            } ?>
          </div>
        </div>
      </div>
      <div class="product-detail__wrapper">
        <span class="label"><?= strtoupper($product->kategori)?></span>

        <h1 class="product-detail__title text-primary"><?= $product->nama_product?></h1>
        <p class="product-detail__short-desc"><?= $product->short_description?></p>
        
        <div class="product-detail__price">Rp <?= number_format($product->price, 0, '.', '.')?> /<?= $product->satuan?></div>
        <div class="product-detail__stock">stock : <?= ($product->stock > 0) ? '<span class="text-primary">tersedia('.$product->stock.')</span>':'<span class="text-secondary">habis</span>'?> </div>

        <div class="add-cart">
          <form action="<?= site_url('frontPage/addToCart')?>" method="post">
            <input type="hidden" name="id" value="<?= $product->id_product?>">
            <div class="add-cart__title">Masukkan Jumlah</div>
            
            <div class="flex">
              <div class="add-cart__count flex">
                <span class="minus flex items-center justify-center"><i class="fa fa-minus"></i></span>
                <input type="number" name="qty" value="0" class="input" min="0" max="<?= $product->stock?>" readonly id="qty">
                <span class="plus flex items-center justify-center"><i class="fa fa-plus"></i></span>
              </div>
              <button type="submit" class="btn btn-primary btn-icon btn-buy">
                <i class="fa fa-shopping-cart"></i>
                BELI SEKARANG
              </button>
            </div>
          </form>
        </div>

        <a href="https://wa.me/6282327773818" target="__blank" class="btn btn-rounded btn-primary--outline btn-icon">
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
          <?php foreach ($productKategori as $kategori) { ?>
            <a href="<?= site_url('frontPage/products')?>?kategori=<?= $kategori->id_kategori?>" class="category-list__item <?= ($kategori->id_kategori == $product->id_kategori) ? 'active':''?>"><?= strtoupper($kategori->nama_kategori)?></a>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="product-terlaris">
      <h2 class="section-title section-title--sm">
        Product Terbaik Lainnya
      </h2>
      <div class="row">
        <?php foreach ($otherProducts as $other) { ?>
          <div class="col-md-3 col-sm-6">
            <div class="box box-product box-product--sm">
              <a href="<?= site_url('frontPage/productDetail/'.$other->id_product)?>" class="box-thumb img-rasio r-100">
                <img src="<?= base_url()?>/<?= $other->featured_img?>" alt="">
              </a>
              <div class="box-content">
                <a href="<?= site_url('frontPage/products')?>?kategori=<?= $other->id_kategori?>" class="label"><?= $other->kategori?></a>
                <h4 class="box-title text-primary">
                  <a href="<?= site_url('frontPage/productDetail/'.$other->id_product)?>"><?= $other->nama_product?></a>
                </h4>
                <p class="box-desc"><?= $other->short_description?></p>
                <div class="flex justify-between box-product__info">
                  <div class="box-product__info-item">
                    <p class="product-price"><?= number_format($other->price, 0, '.', '.')?>/<?= $other->satuan?></p>
                    <p class="product-stock">stok :
                      <?php if ($other->stock > 0) { ?>
                        <span class="text-primary">tersedia</span>
                      <?php } else {?>
                        <span class="text-secondary">habis</span>
                      <?php } ?> 
                    </p>
                  </div>
                  <div class="box-product__info-item">
                    <form action="<?= site_url('frontPage/addToCart')?>" method="post">
                      <input type="hidden" name="id" value="<?= $other->id_product?>">
                      <input type="hidden" name="qty" value="1">
                      <button type="submit" href="" class="btn btn-primary btn-icon">
                        <i class="fa fa-shopping-cart"></i>
                        AMBIL
                      </button>
                    </form>
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
    const btnBuy = document.querySelector('.btn-buy');
    if (btnBuy) {
      btnBuy.addEventListener('click', function(e) {
        const qty = document.getElementById('qty');
        if (qty && qty.value <= 0) {
          alert('Tambah jumlah barang');
          e.preventDefault();
        }
      })
    }
  })
})()
</script>