<p class="login-box-msg">Daftarkan Diri Anda</p>
<form action="<?=base_url('auth/daftar')?>" method="post">
  <div class="form-group has-feedback">
    <input type="text" class="form-control" name="username" id="username" placeholder="Nama Pengguna" autofocus>
    <span class="fa fa-user form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input type="password" class="form-control" name="password" id="password" placeholder="Kata Sandi">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input type="password" class="form-control" name="password2" id="password2" placeholder="Ulangi Kata Sandi">
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap">
    <span class="fa fa-user form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
    <span class="fa fa-envelope form-control-feedback"></span>
  </div>
  <div class="row">
    <div class="col-xs-8">
      <a href="<?=base_url('auth/lupa_sandi')?>">Lupa Kata Sandi</a><br>
      <a href="<?=base_url('auth')?>" class="text-center">Sudah Punya Akun</a>
    </div>
    <div class="col-xs-4">
      <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
    </div>
  </div>
</form>