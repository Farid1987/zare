<div class="main-wrapper">
  <div class="container">
    <h1 class="page-title page-title__auth text-center">Zare Indonesia</h1>
    <div class="auth-wrapper box box-rounded-10">
      <h4 class="auth-title text-center">Login</h4>
      <div class="text-center text-error p-t-20 p-b-20">
        <span>
          <?php echo $this->session->flashdata('errorlog'); ?>
        </span>
      </div>
      <form action="<?php echo site_url('auth/checkLogin')?>" method="post" class="form-wrapper">
        <div class="form-group">
          <label for="" class="form-label">Email</label>
          <input type="email" name="email" class="form-input" placeholder="Input Email">
        </div>

        <div class="form-group">
          <label for="" class="form-label">Password</label>
          <input type="password" name="password" class="form-input">
        </div>

        <button class="btn btn-primary" type="submit">Login</button>
        <span class="auth-note">Belum memiliki akun? Daftar <a href="<?= site_url('auth/register')?>" class="text-primary">Disini</a></span>
      </form>
    </div>
  </div>
</div>