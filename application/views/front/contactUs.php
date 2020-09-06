<div class="main-wrapper">
  <div class="container">
    <h1 class="page-title text-center">Contact Us</h1>

    <div class="row contact-wrapper">
      <div class="col-md-7">
        <?php if ($this->session->flashdata('status') == 'success') { ?>
          <div class="alert alert-success flex items-baseline justify-between" role="alert">
            <span><?= $this->session->flashdata('message')?></span>
            <a href="" class="alert-close">×</a>
          </div>
        <?php } elseif ($this->session->flashdata('status') == 'error') {?>
          <div class="alert alert-danger flex items-baseline justify-between" role="alert">
            <span><?= $this->session->flashdata('message')?></span>
            <a href="" class="alert-close">×</a>
          </div>
        <?php } ?>
        <form action="<?= site_url('frontPage/addMessage')?>" method="post">
          <div class="form-group">
            <label for="" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-input" placeholder="Input Nama" required value="<?= set_value('nama'); ?>">
            <span class="form-error-message text-danger"><?php echo form_error('nama'); ?></span>
          </div>
          <div class="form-group">
            <label for="" class="form-label">Email</label>
            <input type="email" name="email" class="form-input" placeholder="Input Email" required value="<?= set_value('email'); ?>">
            <span class="form-error-message text-danger"><?php echo form_error('email'); ?></span>
          </div>
          <div class="form-group">
            <label for="" class="form-label">Pesan</label>
            <textarea name="pesan" rows="5" class="form-input" required><?= set_value('pesan'); ?></textarea>
            <span class="form-error-message text-danger"><?php echo form_error('pesan'); ?></span>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
          </div>
        </form>
      </div>
      <div class="col-md-5">
        <div class="form-group">
          <label for="" class="form-label">Alamat</label>
          <div>JL. Piranha Raya No. 7 Minomartani, Ngaglik, Sleman</div>
        </div>

        <div class="form-group">
          <label for="" class="form-label">Email</label>
          <div><a href="mailto:zareindonesia@gmail.com">zareindonesia@gmail.com</a></div>
        </div>

        <div class="form-group">
          <label for="" class="form-label">Telpon</label>
          <div><a href="tel:082132899582">0821 3289 9582</a></div>
        </div>
      </div>
    </div>
    <div class="contact-map">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.443124235034!2d110.4063110370815!3d-7.742732408908439!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a597277ca5855%3A0x389f9610cf9fdd1f!2sJl.%20Piranha%20Raya%20No.7%2C%20Mladangan%2C%20Minomartani%2C%20Kec.%20Ngaglik%2C%20Kabupaten%20Sleman%2C%20Daerah%20Istimewa%20Yogyakarta%2055281!5e0!3m2!1sen!2sid!4v1599373647655!5m2!1sen!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
  </div>
</div>