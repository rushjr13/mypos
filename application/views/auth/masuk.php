<p class="login-box-msg">Silahkan Masuk</p>
<form action="<?=base_url('auth/proses')?>" method="post">
  <div class="form-group has-feedback">
    <input type="text" class="form-control" name="username" id="username" placeholder="Nama Pengguna" required autofocus>
    <span class="fa fa-user form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <input type="password" class="form-control" name="password" id="password" placeholder="Kata Sandi" required>
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="row">
    <div class="col-xs-8">
      <a href="<?=base_url('auth/lupa_sandi')?>">Lupa Kata Sandi</a><br>
      <a href="<?=base_url('auth/daftar')?>" class="text-center">Daftar Pengguna Baru</a>
    </div>
    <div class="col-xs-4">
      <button type="submit" name="masuk" id="masuk" class="btn btn-primary btn-block btn-flat">Masuk</button>
    </div>
  </div>
</form>