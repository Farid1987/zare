<div class="row">
  <div class="col-12">
    <div class="card m-b-30">
      <div class="card-body">
        <?php if ($this->session->flashdata('status') == 'success') { ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong><?= $this->session->flashdata('message')?></strong>
          </div>
        <?php } elseif ($this->session->flashdata('status') == 'error') {?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong><?= $this->session->flashdata('message')?></strong>
          </div>
        <?php } elseif ($this->session->flashdata('status') == 'warning') { ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong><?= $this->session->flashdata('message')?></strong>
          </div>
        <?php } ?>
        <!-- <a href="<?= site_url('admin/productAdd')?>" class="mb-4 btn btn-outline-dark waves-effect waves-light">Add Product</a> -->
        <table id="datatable-buttons" class="table table-striped table-bordered" width="100%">
          <thead>
            <tr>
              <th width="10">No</th>
              <th>Invoice</th>
              <th>Nama User</th>
              <th>Total Pembayaran</th>
              <th>Tanggal Pemesanan</th>
              <th>Status</th>
              <th width="120">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach ($transaksi as $key => $value) { ?>
              <tr>
                <td><?= $i?></td>
                <td><?= $value->id_invoice?></td>
                <td><?= $value->fullname?></td>
                <td>Rp <?= number_format($value->total_pembayaran, 0, '.', '.')?></td>
                <td><?= date("j F Y", strtotime($value->created_at))?></td>
                <td><?= ucwords($value->status)?></td>
                <td>
                  <a
                    href="<?= site_url('admin/orderDetail').'/'.$value->id_transaksi?>" 
                    class="btn btn-sm btn-primary"
                    style=" cursor: pointer;"
                    data-toggle="tooltip"
                    data-placement="bottom"
                    data-id="<?= $value->id_transaksi?>" 
                    title="Lihat Detail">
                    <i class="ti-eye"></i>
                  </a>
                  <?php if ($value->status == 'process') { ?>
                    <button
                      class="btn btn-sm btn-success btn-konfirmasi"
                      data-toggle="tooltip" 
                      data-placement="bottom"
                      title="Konfimasi Pembayaran"
                      data-id="<?= $value->id_transaksi?>"
                      style=" cursor: pointer;">
                      <i class="ti-check"></i>
                    </button>
                    <button
                      class="btn btn-sm btn-danger btn-cancel"
                      data-toggle="tooltip" 
                      data-placement="bottom"
                      title="Batalkan Transaksi"
                      data-id="<?= $value->id_transaksi?>"
                      style=" cursor: pointer;">
                      <i class="ti-close"></i>
                    </button>
                  <?php } ?>
                  <!-- <a
                    href="" 
                    class="btn btn-sm btn-primary btn-edit"
                    style=" cursor: pointer;"
                    data-toggle="tooltip"
                    data-placement="bottom"
                    data-id="<?= $value->id_transaksi?>" 
                    title="Edit Product">
                    <i class="ti-pencil-alt"></i>
                  </a> -->
                </td>
              </tr>
            <?php
              $i++;
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div> <!-- end col -->
</div> <!-- end row -->

<script type="text/javascript">
$(document).ready(function() {
  //  Konfirmasi Pembayaran
  $('.btn-konfirmasi').click(function(e) {
    e.preventDefault();
    var url = '<?= site_url('admin/konfirmasiPembayaran')?>';
    var id = $(this).data('id');
    swal({
      title: 'Apakah anda yakin ingin mengonfirmasi pembayaran?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result) {
        $.ajax({
          type: "POST",
          url,
          data: {id},
          success: function(res) {
            data = $.parseJSON(res);
            if (data.status == 'success') {
              swal({
                title: data.message,
                type: 'success',
                confirmButtonClass: 'btn btn-success',
                allowOutsideClick: !1
              }).then(function() {
                location.reload(true);
              })
            } else if (data.status == 'error') {
              swal({
                title: 'Failed!',
                text: data.message,
                type: 'warning',
                confirmButtonClass: 'btn btn-danger',
                allowOutsideClick: !1
              })
            }
          }
        })
      }
    })
  })

  //  Batalkan Transaksi
  $('.btn-cancel').click(function(e) {
    e.preventDefault();
    var url = '<?= site_url('admin/batalkanTransaksi')?>';
    var id = $(this).data('id');
    swal({
      title: 'Apakah anda yakin ingin membatalkan transaksi?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result) {
        $.ajax({
          type: "POST",
          url,
          data: {id},
          success: function(res) {
            data = $.parseJSON(res);
            if (data.status == 'success') {
              swal({
                title: data.message,
                type: 'success',
                confirmButtonClass: 'btn btn-success',
                allowOutsideClick: !1
              }).then(function() {
                location.reload(true);
              })
            } else if (data.status == 'error') {
              swal({
                title: 'Failed!',
                text: data.message,
                type: 'warning',
                confirmButtonClass: 'btn btn-danger',
                allowOutsideClick: !1
              })
            }
          }
        })
      }
    })
  })
})
</script>