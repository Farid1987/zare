<div class="main-wrapper pembayaran-wrapper">
  <div class="container">
    <div class="order-invoice">
      Invoice: <strong><?= $transaksi->id_invoice?></strong>
    </div>
    <div class="flex justify-between order-info">
      <div class="order-info__item">
        <div class="order-info__label">
          Atas nama:
        </div>
        <div class="order-info__text"><?= $transaksi->fullname?></div>
      </div>
      <div class="order-info__item">
        <div class="order-info__text">
          <?= $transaksi->address?>
        </div>
        <div class="order-info__text">
          <?= ucwords(strtolower($transaksi->province_name)).', '.ucwords(strtolower($transaksi->city_name)).', '.$transaksi->zip_code?>
        </div>
      </div>
    </div>

    <table class="table-cart">
      <thead>
        <tr>
          <th>Pesanan</th>
          <th>Harga</th>
          <th width="250">Jumlah</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          foreach ($transaksiItem as $item) {
        ?>
          <tr>
            <td>
              <a href="<?= site_url('frontPage/productDetail').'/'.$item->id_product?>" class="cart-item items-center">
                <div class="cart-item__img">
                  <img src="<?= base_url().'/'.$item->featured_img?>" alt="">
                </div>
                <div class="cart-item__content">
                  <div class="cart-item__title"><?= $item->nama_product?></div>
                </div>
              </a>
            </td>
            <td>Rp <?= number_format($item->harga_satuan, 0, '.', '.')?></td>
            <td><?= $item->jumlah_penjualan?></td>
            <td><strong>Rp <?= number_format($item->total_harga, 0, '.', '.')?></strong></td>
          </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <td class="text-right" colspan="3"><strong>Subtotal</strong></td>
          <td><strong>Rp <?= number_format($transaksi->total_pembayaran, 0, '.', '.')?></strong></td>
        </tr>
      </tfoot>
    </table>

    <div class="row">
      <div class="col-md-5">
        <div class="transfer-info">
          <div class="transfer-info__title">
            Transfer Ke:
          </div>
          <table class="transfer-info__list">
            <?php foreach ($bank as $key => $value) { ?>
              <tr>
                <td><?= $value->nama?></td>
                <td width="15">:</td>
                <td><?= $value->rekening?> (<?= $value->atas_nama?>)</td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
      <div class="col-md-7">
        <div class="pembayaran-note">
          <p>Segera transfer dan jangan sampai anda salah memasukkan jumlah nominal pembayaran anda. Jika sudah transfer, silahkan hubungi admin WA/Line untuk konfirmasi. Bisa juga klik disini</p>
          <div class="text-right">
            <a href="javascrip:;" class="btn btn-primary" data-micromodal-trigger="modal-1">Konfirmasi Pembayaran</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">
          Konfirmasi pembayaran
        </h2>
      </header>
      <main class="modal__content" id="modal-1-content">
        <p>Silahkan melakukan konfirmasi pembayaran via Whatsapp atau Line dibawah ini.</p>

        <div class="row">
          <div class="col-md-6 text-center">
						<a href="https://line.me/R/ti/p/%40ddk2965h" target="__blank" class="social-icon">
							<i class="fab fa-line"></i>
						</a>
						<div>@zareid</div>
          </div>
          <div class="col-md-6 text-center">
						<a href="https://wa.me/6282327773818" target="__blank" class="social-icon">
							<i class="fab fa-whatsapp"></i>
						</a>
						<div>084938483748</div>
          </div>
        </div>
      </main>
      <footer class="modal__footer text-right">
        <button class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Close</button>
      </footer>
    </div>
  </div>
</div>