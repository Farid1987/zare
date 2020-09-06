<div class="main-wrapper">
  <div class="container">
    <h1 class="dashboard-title">Welcome, <?= $user->fullname?></h1>

    <p class="dashboard-address">
      <strong>Alamat utama:</strong> <br>
      <?= $user->address?> <br>
      <?= ($user->province_name) ? ucwords(strtolower($user->province_name)).',':''?>
      <?= ($user->city_name) ? ucwords(strtolower($user->city_name)).',':''?>
      <?= ($user->zip_code) ? $user->zip_code:''?>
    </p>
    <a href="<?= site_url('frontPage/editAlamatUser')?>" class="btn btn-primary">Edit Alamat</a>
  </div>

  <div class="dashboard-table__wrapper">
    <div class="container">
      <div class="table-responsive">
        <table class="dashboard-table">
          <thead>
            <tr>
              <th>Invoice</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Total</th>
              <th width="110">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr class="spacer"></tr>
            <?php if (count($dataTransaksi) > 0) { ?>
              <?php foreach ($dataTransaksi as $key => $value) { ?>
                <tr>
                  <td><?= $value->id_invoice?></td>
                  <td><?= date("j F Y", strtotime($value->created_at))?></td>
                  <td><?= ucwords($value->status)?></td>
                  <td>Rp <?= number_format($value->total_pembayaran, 0, '.', '.')?></td>
                  <td>
                    <?php if ($value->status == 'process') { ?>
                      <a href="javascript:;" class="btn btn-icon-action" title="Konfirmasi Pembayaran" data-micromodal-trigger="modal-1"><i class="fa fa-comment"></i></a>
                    <?php } ?>
                  </td>
                </tr>
                <tr class="spacer"></tr>
              <?php } ?>
            <?php } else { ?>
              <tr>
                <td colspan="5" class="text-center"><strong>Tidak ada data transaksi</strong></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <div class="pagination-wrapper">
        <?= $pagination?>
      </div>
    </div>
  </div>
</div>

<div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
      <header class="modal__header">
        <h2 class="modal__title" id="modal-1-title">
          Hubungi admin
        </h2>
      </header>
      <main class="modal__content" id="modal-1-content">
        <p>Silahkan Hubungi admin untuk konfirmasi pembayaran atau membatalkan pesanan.</p>

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

<!-- <script>
  (function() {
    window.addEventListener('load', function() {
      $('.btn-cancel').on('click', function(e) {
        e.preventDefault();
    
        if (window.confirm('Apakah anda yakin ingin membatalkan transaksi?')) {
          
        }
      })
    })
  })()
</script> -->