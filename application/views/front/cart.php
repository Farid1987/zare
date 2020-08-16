<div class="main-wrapper">
  <div class="container">
    <h1 class="page-title text-center">Keranjang Belanja</h1>

    <table class="table-cart">
      <thead>
        <tr>
          <th>Pesanan</th>
          <th>Harga</th>
          <th width="250">Jumlah</th>
          <th>Total</th>
          <th width="50"></th>
        </tr>
      </thead>
      <tbody>
        <?php
          $total = 0;
        ?>
        <?php if ($countCart <= 0) { ?>
          <tr>
            <td class="text-center" colspan="5">Tidak ada item.</td>
          </tr>
        <?php } else { ?>
          <?php 
            foreach ($cart as $item) { 
            $total += ($item->price * $item->quantity);
          ?>
            <tr>
              <td>
                <a href="<?= site_url('frontPage/productDetal').'/'.$item->id_product?>" class="cart-item items-center">
                  <div class="cart-item__img">
                    <img src="<?= base_url().'/'.$item->featured_img?>" alt="">
                  </div>
                  <div class="cart-item__content">
                    <div class="cart-item__title"><?= $item->nama_product?></div>
                  </div>
                </a>
              </td>
              <td>Rp <?= number_format($item->price, 0, '.', '.')?></td>
              <td>
                <form action="<?= site_url('frontPage/updateCart')?>" method="post" class="flex">
                  <input type="hidden" name="idCart" value="<?= $item->id_cart?>">
                  <input type="hidden" name="idProduct" value="<?= $item->id_product?>">
                  <div class="add-cart__count flex">
                    <span class="minus flex items-center justify-center"><i class="fa fa-minus"></i></span>
                    <input type="number" name="qty" value="<?= $item->quantity?>" class="input" min="1" readonly id="qty">
                    <span class="plus flex items-center justify-center"><i class="fa fa-plus"></i></span>
                  </div>
                  <button class="btn btn-primary" type="submit">Save</button>
                </form>

                <span class="form-error-message text-danger"><?php echo $this->session->flashdata('errorlog'); ?></span>
              </td>
              <td><strong>Rp <?= number_format($item->price * $item->quantity, 0, '.', '.')?></strong></td>
              <td>
                <a href="<?= site_url('frontPage/removeFromCart').'/'.$item->id_cart?>" class="remove-cart-item flex items-center justify-center" onclick="return window.confirm('Are you sure want to delete this item?')">
                  <i class="fa fa-close"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <td class="text-right" colspan="3"><strong>Subtotal</strong></td>
          <td colspan="2"><strong>Rp <?= number_format($total, 0, '.', '.')?></strong></td>
        </tr>
      </tfoot>
    </table>
    
    <div class="text-right mb-20">
      <a href="<?= site_url('frontPage/products')?>" class="btn btn-primary">Lanjut Belanja</a>
    </div>
    <div class="text-right">
      <a href="<?= site_url('frontPage/pengiriman')?>" class="btn btn-primary">Lanjut Pengiriman</a>
    </div>
  </div>
</div>
<!-- <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">
          Pilih rekening pembayaran
        </h2>
      </header>
      <main class="modal__content" id="modal-1-content">
        <form action="" id="form-bank">
          <?php foreach ($bank as $key => $value) { ?>
            <div class="form-group">
              <input type="radio" name="bank" value="<?= $value->id_bank?>"> <?= $value->nama?>
            </div>
          <?php } ?>
        </form>
      </main>
      <footer class="modal__footer">
        <button class="btn btn-primary" form="form-bank">Lanjutkan Pembayaran</button>
        <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Close</button>
      </footer>
    </div>
  </div>
</div> -->