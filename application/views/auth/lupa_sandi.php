<p class="login-box-msg">Silahkan masukkan Email Anda untuk mendapatkan link ubah kata sandi</p>
<form action="<?=base_url('auth/lupa_sandi')?>" method="post">
  <div class="form-group has-feedback">
    <input type="text" class="form-control" name="email" id="email" placeholder="Email" autofocus>
    <span class="fa fa-envelope form-control-feedback"></span>
  </div>
  <div class="row">
    <div class="col-xs-8">
      <a href="<?=base_url('auth')?>">Sudah Punya Akun</a><br>
      <a href="<?=base_url('auth/daftar')?>" class="text-center">Daftar Pengguna Baru</a>
    </div>
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Kirim</button>
    </div>
  </div>
</form>