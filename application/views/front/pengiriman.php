<div class="main-wrapper pengiriman-wrapper">
  <div class="container">
    <form action="<?= site_url('frontPage/checkout')?>" method="post" id="form-pengiriman">
      <div class="row justify-between">
        <div class="col-md-6">
          <h1 class="pengiriman-title">Data Pengiriman</h1>

          <div class="form-address">
            <div class="form-group">
              <label for="" class="form-label">Provinsi</label>
              <select name="province" class="form-input select2 js-provinsi" data-placeholder="Pilih Provinsi" required>
                <option value=""></option>
                <?php if (isset($provinces)) {
                  foreach ($provinces as $province) {?>
                    <option value="<?= $province->id?>"><?= $province->name?></option>
                <?php }
                } ?>
              </select>
              <span class="form-error-message text-danger"><?php echo form_error('province'); ?></span>
            </div>
            <div class="form-group">
              <label for="" class="form-label">Kota</label>
              <select name="city" class="form-input select2 js-kota" data-placeholder="Pilih Kota" required>
                <option value=""></option>
              </select>
              <span class="form-error-message text-danger"><?php echo form_error('city'); ?></span>
            </div>
            <div class="form-group">
              <label for="" class="form-label">Alamat Lengkap</label>
              <textarea name="address" class="form-input js-address" placeholder="Masukkan alamat lengkap anda" required><?= set_value('address'); ?></textarea>
              <span class="form-error-message text-danger"><?php echo form_error('address'); ?></span>
            </div>
            <div class="form-group">
              <label for="" class="form-label">Kode Pos</label>
              <input type="text" name="zip_code" class="form-input js-kode-pos" value="<?= set_value('zip_code'); ?>" placeholder="Masukkan kode pos" required>
              <span class="form-error-message text-danger"><?php echo form_error('zip_code'); ?></span>
            </div>
          </div>
          <div class="form-group mb-0">
            <label for="fill-address">
              <input type="checkbox" name="fillAddress" id="fill-address"> Samakan dengan data akun
            </label>
          </div>
        </div>
        <div class="col-md-4">
          <?php if ($this->session->flashdata('errorlog')) { ?>
            <div class="text-danger"><?= $this->session->flashdata('errorlog')?></div>
          <?php } ?>
          <div class="cart-list">
            <?php 
            $total = 0;
            foreach ($cart as $item) { 
              $total += $item->price * $item->quantity;
            ?>
              <a href="<?= site_url('frontPage/productDetail').'/'.$item->id_product?>" class="cart-item items-start">
                <div class="cart-item__img">
                  <img src="<?= base_url().'/'.$item->featured_img?>" alt="">
                </div>
                <div class="cart-item__content">
                  <div class="cart-item__title"><?= $item->nama_product?></div>
                  <div class="cart-item__qty">Qty: <strong><?= $item->quantity?></strong></div>
                  <div class="cart-item__price">Rp <?= number_format($item->price * $item->quantity, 0, '.', '.')?></div>
                </div>
              </a>
              <!-- <input type="hidden" name="id_product" value="<?= $item->id_product?>">
              <input type="hidden" name="price" value="<?= $item->price?>">
              <input type="hidden" name="quantity" value="<?= $item->quantity?>">
              <input type="hidden" name="total_price" value="<?= $item->price * $item->quantity?>"> -->
            <?php } ?>
          </div>
          <table width="100%" style="max-width: 300px; margin-left: auto">
            <tr>
              <td class="text-right">Total Pesanan</td>
              <td width="20" class="text-center">:</td>
              <td class="text-right">
                <input type="hidden" name="total_pembayaran" value="<?= $total?>">
                <strong>Rp <?= number_format($total, 0, '.', '.')?></strong>
              </td>
            </tr>
            <tr>
              <td colspan="3" class="text-right">
                <button class="btn btn-primary" type="submit">Checkout</button>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </form>
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
                option += `<option value="${dt.id}" ${('<?= set_value('city')?>' == dt.id) ? "selected":""}>${dt.name}</option>`;
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
    }
  })
})()
</script>