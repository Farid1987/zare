<div class="main-wrapper">
  <div class="container">
    <div class="auth-wrapper box box-rounded-10">
      <h4 class="auth-title text-center">Edit Alamat</h4>
      <form action="<?php echo site_url('frontPage/editAlamat')?>" method="post" class="form-wrapper">
        <div class="form-group">
          <label for="" class="form-label">Provinsi</label>
          <select name="province" class="form-input select2 js-provinsi" data-placeholder="Pilih Provinsi" required id="provinsi">
            <option value=""></option>
            <?php if (isset($provinces)) {
              foreach ($provinces as $province) {?>
                <option value="<?= $province->id?>"><?= $province->name?></option>
            <?php }
            } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="" class="form-label">Kota</label>
          <select name="city" class="form-input select2 js-kota" data-placeholder="Pilih Kota" required id="kota">
            <option value=""></option>
          </select>
        </div>
        <div class="form-group">
          <label for="" class="form-label">Alamat Lengkap</label>
          <textarea name="address" class="form-input js-address" placeholder="Masukkan alamat lengkap anda" required id="alamat"><?= $user->address; ?></textarea>
        </div>
        <div class="form-group">
          <label for="" class="form-label">Kode Pos</label>
          <input type="text" name="zip_code" class="form-input js-kode-pos" value="<?= $user->zip_code; ?>" placeholder="Masukkan kode pos" required id="kode_pos">
        </div>
        
        <div class="form-group text-right">
          <a href="<?= site_url('frontPage/dashboardUser')?>" class="btn btn-default">Cancel</a>
          <button class="btn btn-primary" type="submit">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
(function() {
  window.addEventListener('load', function() {
    $('.select2').select2();

    $('.js-provinsi').on('change', function() {
      let option = `<option value=""></option>`;
      let prov = $(this).val();
      if (prov == '') {
        $('.js-kota').html(option);
      } else {
        let url = "<?= site_url('frontPage/getRegencies')?>";
        $.ajax({
          url,
          data: {idProv: prov},
          type: 'GET',
          success: function(res) {
            try {
              let data = $.parseJSON(res);
              option = '';
              data.forEach(dt => {
                option += `<option value="${dt.id}" ${('<?= $user->city?>' == dt.id) ? "selected":""}>${dt.name}</option>`;
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

    if ('<?= set_value('province')?>' != '') {
      $('.js-provinsi').val('<?= set_value('province')?>');
      $('.js-provinsi').trigger('change');
    } else if ('<?= $user->province?>' != '') {
      $('.js-provinsi').val('<?= $user->province?>');
      $('.js-provinsi').trigger('change');
    }
  })
})()
</script>