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
          <input type="hidden" name="id_type_project" id="val-id">

          <div class="form-group" id="type-project">
            <label class="control-label">Type Project</label>
            <div class="controls">
              <input class="form-control" type="text" name="type" placeholder="Masukkan nama tipe project"
                id="val-type-project">
              <span class="help-block text-danger" id="errors-type-project"></span>
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
    let url = ($btn.data('type') == 'add') ? '<?= site_url('admin/addTypeProject ')?>': '<?= site_url('admin/editTypeProject')?>';

    ajax_data($(this), url);
  })

  // Delete Kategori
  $('.btn-delete').click(function(e) {
    e.preventDefault();
    let url = '<?= site_url('admin/deleteTypeProject')?>';
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
        $("#errors-type-project").html("");
        $("#type-project").removeClass("has-error");
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
            if (data.message.type) {
              $("#errors-type-project").html(data.message.type);
              $("#type-project").addClass("has-error");
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
      $('#val-type-project').val('');
      $('.modal-kategori').find('.submit-form').data('type', 'add');
    } else if (type == 'edit') {
      let title = 'Edit Data';
      let typeProject = $(this).data('type-project');
      let id = $(this).data('id');

      $('.modal-kategori').find('.modal-title:first').text(title);
      $('#val-id').val(id).attr('disabled', false);
      $('#val-type-project').val(typeProject);
      $('.modal-kategori').find('.submit-form').data('type', 'edit');
    }
    $('.modal-kategori').modal('show');
  }
})
</script>