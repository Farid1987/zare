<div class="mw-1000">
  <div class="card mb-4">
    <div class="card-header">
      <strong>Order Information</strong>
    </div>
    <div class="card-body">
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Order Invoice</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" value="<?= $transaksi->id_invoice; ?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Status</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" value="<?= ucwords($transaksi->status); ?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Nama User</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" value="<?= $transaksi->fullname; ?>" readonly>
        </div>
      </div>
      <h5>Alamat Pengiriman</h5>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Alamat Lengkap</label>
        <div class="col-sm-9">
          <textarea name="" rows="2" class="form-control" readonly><?= $transaksi->address?></textarea>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Provinsi</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" value="<?= ucwords(strtolower($transaksi->province_name)); ?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Kota</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" value="<?= ucwords(strtolower($transaksi->city_name)); ?>" readonly>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-3 col-form-label">Kode Pos</label>
        <div class="col-sm-9">
          <input class="form-control" type="text" value="<?= $transaksi->zip_code; ?>" readonly>
        </div>
      </div>
    </div>
  </div>
  <div class="card mb-4">
    <div class="card-header">
      <strong>Order Item</strong>
    </div>
    <div class="card-body">
      <table class="table table-bordered table-stripped table-hover">
        <thead>
          <tr>
            <th width="20">No</th>
            <th width="80">Thumbnail</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $i = 1;
            foreach ($transaksiItem as $item) { ?>
            <tr>
              <td>
                <?= $i?>
              </td>
              <td>
                <img src="<?= base_url().'/'.$item->featured_img?>" alt="" style="max-width: 80px">
              </td>
              <td><?= $item->nama_product?></td>
              <td>Rp <?= number_format($item->harga_satuan, 0, '.', '.')?></td>
              <td><?= $item->jumlah_penjualan?></td>
              <td>Rp <?= number_format($item->total_harga, 0, '.', '.')?></td>
            </tr>
          <?php 
            $i++;
            } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>