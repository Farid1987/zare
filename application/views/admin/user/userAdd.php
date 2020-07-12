<div class="row">
  <div class="col-md-8 col-12">
    <form action="<?= site_url('admin/addUser')?>" method="POST">
      <div class="card">
        <div class="card-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="fullname" value="<?= set_value('fullname'); ?>" required>
              <span class="help-block text-danger"><?php echo form_error('fullname'); ?></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input class="form-control" type="email" name="email" value="<?= set_value('email'); ?>" required>
              <span class="help-block text-danger"><?php echo form_error('email'); ?></span>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
              <input class="form-control" type="text" name="role" readonly value="member" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
              <textarea name="address" rows="3" class="form-control"><?= set_value('address'); ?></textarea>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">No Telp</label>
            <div class="col-sm-10">
              <input type="text" class="form-control js-telp" name="no_telp" value="<?= set_value('no_telp'); ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kode Pos</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="kode_pos" value="<?= set_value('kode_pos'); ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Provinsi</label>
            <div class="col-sm-10">
              <select name="provinsi" class="form-control select2 js-provinsi" data-placeholder="Pilih Provinsi">
                <option value=""></option>
                <?php if (isset($provinces)) {
                  foreach ($provinces as $province) {?>
                    <option value="<?= $province->id?>"><?= $province->name?></option>
                <?php }
                } ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kota</label>
            <div class="col-sm-10">
              <select name="kota" class="form-control select2 js-kota" data-placeholder="Pilih Kota">
                <option value=""></option>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="password" value="123456" readonly required>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="text-right">
            <a href="<?= site_url('admin/users')?>" class="btn btn-outline-secondary waves-effect">Cancel</a>
            <button type="submit" class="btn btn-outline-dark waves-effect waves-light">Submit</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2();

  // validate telp
  $('.js-telp').on('keyup', validateTelp);
  $('.js-telp').on('change', validateTelp);

  function validateTelp(e) {
    let amount = $(this).val().replace(/[^\d\+]/g,'');
    if (amount.length > 1) {
      let arr = [...amount];
      arr = arr.filter((value, index) => {
        return !(value=='+' && index >0)
      })
      amount = arr.join("");
    }
    $(this).val(amount);
  }

  $('.js-provinsi').on('change', function() {
    let option = `<option value=""></option>`;
    let prov = $(this).val();
    if (prov == '') {
      $('.js-kota').html(option);
    } else {
      let url = "<?= site_url('admin/getRegencies')?>";
      $.ajax({
        url,
        data: {idProv: prov},
        type: 'GET',
        success: function(res) {
          try {
            let data = $.parseJSON(res);
            option = '';
            data.forEach(dt => {
              option += `<option value="${dt.id}" ${('<?= set_value('kota')?>' == dt.id) ? "selected":""}>${dt.name}</option>`;
            });
            $('.js-kota').html(option);
          } catch (error) {
            console.error('Error while parsing data');
          }
        },
        error: function(err) {
          console.log(err);
        }
      })
    }
  });
  if ('<?= set_value('provinsi')?>' != '') {
    $('.js-provinsi').val('<?= set_value('provinsi')?>');
    $('.js-provinsi').trigger('change');
  }
})
</script>