<div class="modal fade modal-kategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
  data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mt-0" id="myModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal row-fluid" action="" method="POST" id="formKategori">
          <input type="hidden" name="id_kategori" id="val-id">

          <div class="form-group" id="nama-kategori">
            <label class="control-label">Nama Kategori</label>
            <div class="controls">
              <input class="form-control" type="text" name="kategori" placeholder="Masukkan Nama Kategori"
                id="val-kategori">
              <span class="help-block text-danger" id="errors-kategori"></span>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <div class="form-group">
          <div>
            <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Close</button>
            <button class="btn btn-outline-dark waves-effect waves-light submit-form">
              Submit
            </button>
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
$(document).ready(function() {
  $('.modal-kategori').on('shown.bs.modal', function () {
    $(this).find('input[type!=hidden]').focus();
  })

  // Add Kategori
  $('.btn-add').on('click', openModal)
  // Edit Kategori
  $('.btn-edit').on('click', openModal)

  // Submit Form
  $('.submit-form').on('click', function(e) {
    e.preventDefault();
    $('#formKategori').submit();
  });
  $('#formKategori').on('submit', function(e) {
    e.preventDefault();
    let $btn = $(this).parents('.modal').find('.submit-form:first');
    let url = ($btn.data('type') == 'add') ? '<?= site_url('admin/addKategori ')?>': '<?= site_url('admin/editKategori')?>';

    ajax_data($(this), url);
  })

  // Delete Kategori
  $('.btn-delete').click(function(e) {
    e.preventDefault();
    var url = '<?= site_url('admin/deleteKategori')?>';
    var id = $(this).data('id');
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
                title: 'Delete Data Success!',
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

  // Functions
  function ajax_data($form, url) {
    $.ajax({
      url,
      data: $form.serialize(),
      type: 'POST',
      beforeSend: function() {
        $("#errors-kategori").html("");
        $("#nama-kategori").removeClass("has-error");
        $form.parents('.modal').addClass('loading');
      },
      success: function(res) {
        $form.parents('.modal').removeClass('loading');
        try {
          let data = $.parseJSON(res);
          if (data.status == 'success') {
            $('.modal-kategori').modal('hide');
            swal({
              title:"Update data success!",                        
              type:"success",                        
              confirmButtonClass:"btn btn-success",                        
              allowOutsideClick:!1 
            }).then(function(){
              location.reload(true);
            })
          } else if (data.status == 'error') {
            if (data.message.kategori) {
              $("#errors-kategori").html(data.message.kategori);
              $("#nama-kategori").addClass("has-error");
            }
          }
        } catch (error) {
          $('.modal-kategori').modal('hide');
          console.error('Error while returning reponse. Please contact admin.');
        }
      },
      error: function(err) {
        alert('Server error. Please contact admin.');
        $('.modal-kategori').modal('hide');
        console.error(err)
      }
    })
  }

  function openModal() {
    let type = $(this).data('type');
    
    if (type == 'add') {
      let title = 'Add Data';
      
      $('.modal-kategori').find('.modal-title:first').text(title);
      $('#val-id').val('').attr('disabled', true);
      $('#val-kategori').val('');
      $('.modal-kategori').find('.submit-form').data('type', 'add');
    } else if (type == 'edit') {
      let title = 'Edit Data';
      let kategori = $(this).data('kategori');
      let id = $(this).data('id');

      $('.modal-kategori').find('.modal-title:first').text(title);
      $('#val-id').val(id).attr('disabled', false);
      $('#val-kategori').val(kategori);
      $('.modal-kategori').find('.submit-form').data('type', 'edit');
    }
    $('.modal-kategori').modal('show');
  }
})
</script>