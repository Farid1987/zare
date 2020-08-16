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
          <input type="hidden" name="id_bank" id="val-id">

          <div class="form-group" id="nama">
            <label class="control-label">Nama Bank</label>
            <div class="controls">
              <input class="form-control" type="text" name="nama" placeholder="Masukkan nama bank"
                id="val-nama">
              <span class="help-block text-danger" id="errors-nama"></span>
            </div>
          </div>

          <div class="form-group" id="rekening">
            <label class="control-label">Nomor Rekening</label>
            <div class="controls">
              <input class="form-control" type="text" name="rekening" placeholder="Masukkan nomor rekening"
                id="val-rekening">
              <span class="help-block text-danger" id="errors-rekening"></span>
            </div>
          </div>

          <div class="form-group" id="atas_nama">
            <label class="control-label">Atas Nama</label>
            <div class="controls">
              <input class="form-control" type="text" name="atasNama" placeholder="Masukkan nama pemilik rekening"
                id="val-atas-nama">
              <span class="help-block text-danger" id="errors-atas-nama"></span>
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
    $(this).find('input[type!=hidden]:first').focus();
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
    let url = ($btn.data('type') == 'add') ? '<?= site_url('admin/addBank ')?>': '<?= site_url('admin/editBank')?>';

    ajax_data($(this), url);
  })

  // Delete Kategori
  $('.btn-delete').click(function(e) {
    e.preventDefault();
    let url = '<?= site_url('admin/deleteBank')?>';
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
        $("#errors-nama").html("");
        $("#nama").removeClass("has-error");
        $("#errors-rekening").html("");
        $("#rekening").removeClass("has-error");
        $("#errors-atas-nama").html("");
        $("#atas-nama").removeClass("has-error");
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
            if (data.message.nama) {
              $("#errors-nama").html(data.message.nama);
              $("#nama").addClass("has-error");
            } else if (data.message.rekening) {
              $("#errors-rekening").html(data.message.rekening);
              $("#rekening").addClass("has-error");
            } else if (data.message.atasNama) {
              $("#errors-atas-nama").html(data.message.atasNama);
              $("#atas-nama").addClass("has-error");
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
      $('#val-nama').val('');
      $('#val-rekening').val('');
      $('#val-atas-nama').val('');
      $('.modal-kategori').find('.submit-form').data('type', 'add');
    } else if (type == 'edit') {
      let title = 'Edit Data';
      let nama = $(this).data('nama');
      let rekening = $(this).data('rekening');
      let atas_nama = $(this).data('atas-nama');
      let id = $(this).data('id');

      $('.modal-kategori').find('.modal-title:first').text(title);
      $('#val-id').val(id).attr('disabled', false);
      $('#val-nama').val(nama);
      $('#val-rekening').val(rekening);
      $('#val-atas-nama').val(atas_nama);
      $('.modal-kategori').find('.submit-form').data('type', 'edit');
    }
    $('.modal-kategori').modal('show');
  }
})
</script>