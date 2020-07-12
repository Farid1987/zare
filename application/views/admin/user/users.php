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
        <a href="<?= site_url('admin/userAdd')?>" class="mb-4 btn btn-outline-dark waves-effect   waves-light">Add User</a>
        <table id="datatable-buttons" class="table table-striped table-bordered" width="100%">
          <thead>
            <tr>
              <th width="10">No</th>
              <th>Nama Lengkap</th>
              <th>Email</th>
              <th>Role</th>
              <th>Alamat</th>
              <th>No Telp</th>
              <th>Kode Pos</th>
              <th>Provinsi</th>
              <th>Kota</th>
              <th width="80">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach ($users as $key => $value) { ?>
              <tr>
                <td><?= $i?></td>
                <td><?= $value->fullname?></td>
                <td><?= $value->email?></td>
                <td class="text-capitalize"><?= $value->role?></td>
                <td><?= $value->address?></td>
                <td><?= $value->phone?></td>
                <td><?= $value->zip_code?></td>
                <td class="text-capitalize"><?= strtolower($value->province_name)?></td>
                <td class="text-capitalize"><?= strtolower($value->city_name)?></td>
                <td>
                  <?php if ($this->session->userdata("email") != $value->email) { ?>
                    <a
                      href="<?= site_url('admin/userEdit/'.$value->id_user.'')?>" 
                      class="btn btn-sm btn-primary btn-edit"
                      style=" cursor: pointer;"
                      data-toggle="tooltip"
                      data-placement="bottom" 
                      title="Edit User">
                      <i class="ti-pencil-alt"></i>
                    </a>
                    <button
                      class="btn btn-sm btn-danger btn-delete"
                      data-toggle="tooltip" 
                      data-placement="bottom"
                      title="Delete User"
                      data-id="<?= $value->id_user?>"
                      style=" cursor: pointer;">
                      <i class="ti-trash"></i>
                    </button>
                  <?php } ?>
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
   // Delete User
   $('.btn-delete').click(function(e) {
    e.preventDefault();
    let url = '<?= site_url('admin/deleteUser')?>';
    let id = $(this).data('id');
    swal({
      title: 'Are you sure want to delete?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes!'
    }).then((result) => {
      if (result) {
        $.ajax({
          type: "POST",
          url,
          data: {id},
          success: function(data) {
            res = $.parseJSON(data);
            if (res.status == 'success') {
              swal({
                title: res.message,
                type: 'success',
                confirmButtonClass: 'btn btn-success',
                allowOutsideClick: !1
              }).then(function() {
                location.reload(true);
              })
            } else if (res.status == 'error') {
              swal({
                title: 'Failed!',
                text: res.message,
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