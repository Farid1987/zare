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
        <a href="<?= site_url('admin/eventAdd')?>" class="mb-4 btn btn-outline-dark waves-effect waves-light">Add Event</a>
        <table id="datatable-buttons" class="table table-striped table-bordered" width="100%">
          <thead>
            <tr>
              <th width="10">No</th>
              <th width="100">Thumbnail</th>
              <th>Title</th>
              <th>Deadline</th>
              <th>Price</th>
              <th>Status</th>
              <th>Type</th>
              <th width="80">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            foreach ($events as $key => $value) { ?>
              <tr>
                <td><?= $i?></td>
                <td>
                  <img src="<?= base_url().'/'.$value->featured_img?>" alt="" style="max-width: 100px">
                </td>
                <td><?= $value->title?></td>
                <td><?= $value->deadline?></td>
                <td><?= $value->price?></td>
                <td><?= $value->status?></td>
                <td><?= $value->type?></td>
                <td>
                  <a
                    href="" 
                    class="btn btn-sm btn-primary btn-edit"
                    style=" cursor: pointer;"
                    data-toggle="tooltip"
                    data-placement="bottom"
                    data-id="<?= $value->id_event?>" 
                    title="Edit Event">
                    <i class="ti-pencil-alt"></i>
                  </a>
                  <button
                    class="btn btn-sm btn-danger btn-delete"
                    data-toggle="tooltip" 
                    data-placement="bottom"
                    title="Delete Event"
                    data-id="<?= $value->id_event?>"
                    style=" cursor: pointer;">
                    <i class="ti-trash"></i>
                  </button>
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
   // Delete Product
  // $('.btn-delete').click(function(e) {
  //   e.preventDefault();
  //   var url = '<?= site_url('admin/deleteProduct')?>';
  //   var id = $(this).data('id');
  //   swal({
  //     title: 'Are you sure want to delete product?',
  //     type: 'warning',
  //     showCancelButton: true,
  //     confirmButtonColor: '#3085d6',
  //     cancelButtonColor: '#d33',
  //     confirmButtonText: 'Yes!'
  //   }).then((result) => {
  //     if (result) {
  //       $.ajax({
  //         type: "POST",
  //         url,
  //         data: {id},
  //         success: function(res) {
  //           data = $.parseJSON(res);
  //           if (data.status == 'success') {
  //             swal({
  //               title: data.message,
  //               type: 'success',
  //               confirmButtonClass: 'btn btn-success',
  //               allowOutsideClick: !1
  //             }).then(function() {
  //               location.reload(true);
  //             })
  //           } else if (data.status == 'error') {
  //             swal({
  //               title: 'Failed!',
  //               text: data.message,
  //               type: 'warning',
  //               confirmButtonClass: 'btn btn-danger',
  //               allowOutsideClick: !1
  //             })
  //           }
  //         }
  //       })
  //     }
  //   })
  // })
})
</script>