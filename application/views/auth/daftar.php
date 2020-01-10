
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>POS - Makaleka || <?=$judul ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=base_url()?>"><b>Makaleka</b>POS</a>
  </div>
  <div class="login-box-body">
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
  </div>
</div>
</body>
</html>
