<div class="main-wrapper">
  <div class="container">
    <h1 class="page-title page-title__auth text-center">Zare Indonesia</h1>
    <div class="auth-wrapper box box-rounded-10">
      <h4 class="auth-title text-center">Register</h4>
      <form action="<?php echo site_url('auth/addUser')?>" method="post" class="form-wrapper">
        <div class="form-group">
          <label for="" class="form-label">Fullname</label>
          <input type="name" name="fullname" class="form-input" placeholder="Input Your Fullname" value="<?= set_value('fullname'); ?>" required>
          <span class="form-error-message text-danger"><?php echo form_error('fullname'); ?></span>
        </div>

        <div class="form-group">
          <label for="" class="form-label">Email</label>
          <input type="email" name="email" class="form-input" placeholder="Input Email" value="<?= set_value('email'); ?>" required>
          <span class="form-error-message text-danger"><?php echo form_error('email'); ?></span>
        </div>

        <div class="form-group">
          <label for="" class="form-label">Password</label>
          <input type="password" name="password" class="form-input" required>
          <span class="form-error-message text-danger"><?php echo form_error('password'); ?></span>
        </div>

        <div class="form-group">
          <label for="" class="form-label">Password Confirmation</label>
          <input type="password" name="passconf" class="form-input" required>
          <span class="form-error-message text-danger"><?php echo form_error('passconf'); ?></span>
        </div>

        <button class="btn btn-primary" type="submit">Daftar</button>
        <span class="auth-note">Sudah memiliki akun? Login <a href="<?= site_url('auth')?>" class="text-primary">Disini</a></span>
      </form>
    </div>
  </div>
</div>