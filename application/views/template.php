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
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
  <header class="main-header">
    <a href="<?=base_url()?>" class="logo">
      <span class="logo-mini"><b>MK</b></span>
      <span class="logo-lg"><b>Makaleka</b>POS</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-danger">1</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Anda memiliki 1 pemberitahuan baru</li>
              <li>
                <ul class="menu">
                  <li>
                    <a href="#">5 new members joined today</a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">Lihat Semua</a></li>
            </ul>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php if($pengguna_masuk['foto']==null){ ?>
                <img src="<?=base_url('uploads/pengguna/user.png')?>" class="user-image" alt="Foto <?=$pengguna_masuk['nama_lengkap'] ?>">
              <?php }else{ ?>
                <img src="<?=base_url('uploads/pengguna/').$pengguna_masuk['foto'] ?>" class="user-image" alt="Foto <?=$pengguna_masuk['nama_lengkap'] ?>">
              <?php } ?>
              <span class="hidden-xs"><?=$pengguna_masuk['nama_lengkap'] ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <?php if($pengguna_masuk['foto']==null){ ?>
                  <img src="<?=base_url('uploads/pengguna/user.png')?>" class="img-circle" alt="Foto <?=$pengguna_masuk['nama_lengkap'] ?>">
                <?php }else{ ?>
                  <img src="<?=base_url('uploads/pengguna/').$pengguna_masuk['foto'] ?>" class="img-circle" alt="Foto <?=$pengguna_masuk['nama_lengkap'] ?>">
                <?php } ?>
                <p>
                  <?=$pengguna_masuk['nama_lengkap'] ?> (<?=$pengguna_masuk['nama_level'] ?>)
                  <!-- <small>Terdaftar Sejak <?=date('Y', $pengguna_masuk['tgl_masuk']) ?></small> -->
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=base_url('pengguna/profil/').$pengguna_masuk['username'] ?>" class="btn btn-success btn-flat"><i class="fa fa-user"></i> Profil</a>
                </div>
                <div class="pull-right">
                  <button type="button" id="keluar" data-toggle="modal" data-target="#modalKeluar" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Keluar</button>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <?php if($pengguna_masuk['foto']==null){ ?>
                <img src="<?=base_url('uploads/pengguna/user.png')?>" class="img-circle" alt="Foto <?=$pengguna_masuk['nama_lengkap'] ?>">
              <?php }else{ ?>
                <img src="<?=base_url('uploads/pengguna/').$pengguna_masuk['foto'] ?>" class="img-circle" alt="Foto <?=$pengguna_masuk['nama_lengkap'] ?>">
              <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?=$pengguna_masuk['nama_lengkap'] ?></p>
          <a href="#" data-toggle="modal" data-target="#modalKeluar"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        <li class="<?php if($judul=='Beranda'){echo 'active';} ?>"><a href="<?=base_url() ?>"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
        <li class="<?php if($judul=='Supplier'){echo 'active';} ?>"><a href="<?=base_url('supplier') ?>"><i class="fa fa-truck"></i> <span>Supplier</span></a></li>
        <li class="<?php if($judul=='Pelanggan'){echo 'active';} ?>"><a href="<?=base_url('pelanggan') ?>"><i class="fa fa-users"></i> <span>Pelanggan</span></a></li>
        <li class="treeview <?php if($judul=='Kategori' || $judul=='Unit' || $judul=='item'){echo 'active';} ?>">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span>Produk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($judul=='Kategori'){echo 'active';} ?>"><a href="<?=base_url('produk/kategori') ?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
            <li class="<?php if($judul=='Unit'){echo 'active';} ?>"><a href="<?=base_url('produk/unit') ?>"><i class="fa fa-circle-o"></i> Unit</a></li>
            <li class="<?php if($judul=='Item'){echo 'active';} ?>"><a href="<?=base_url('produk/item') ?>"><i class="fa fa-circle-o"></i> Item</a></li>
          </ul>
        </li>
        <li class="treeview <?php if($judul=='Penjualan' || $judul=='Stok Masuk' || $judul=='Stok Keluar'){echo 'active';} ?>">
          <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($judul=='Penjualan'){echo 'active';} ?>"><a href="<?=base_url('transaksi/penjualan') ?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li class="<?php if($judul=='Stok Masuk'){echo 'active';} ?>"><a href="<?=base_url('transaksi/stok_masuk') ?>"><i class="fa fa-circle-o"></i> Stok Masuk</a></li>
            <li class="<?php if($judul=='Stok Keluar'){echo 'active';} ?>"><a href="<?=base_url('transaksi/stok_keluar') ?>"><i class="fa fa-circle-o"></i> Stok Keluar</a></li>
          </ul>
        </li>
        <li class="treeview <?php if($judul=='Penjualan' || $judul=='Stok'){echo 'active';} ?>">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if($judul=='Penjualan'){echo 'active';} ?>"><a href="<?=base_url('laporan/penjualan') ?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li class="<?php if($judul=='Stok'){echo 'active';} ?>"><a href="<?=base_url('laporan/stok') ?>"><i class="fa fa-circle-o"></i> Stok</a></li>
          </ul>
        </li>
        <?php if($pengguna_masuk['level']==1){ ?>
          <li class="header">PENGATURAN</li>
          <li class="<?php if($judul=='Pengguna'){echo 'active';} ?>"><a href="<?=base_url('pengguna') ?>"><i class="fa fa-users"></i> <span>Pengguna</span></a></li>
        <?php } ?>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?=$judul ?>
        <small><?=$subjudul ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?=$judul ?></a></li>
        <?php if($subjudul!=null){ ?>
          <li class="active"><?=$subjudul ?></li>
        <?php } ?>
      </ol>
    </section>
    <section class="content">
      <?= $this->session->flashdata('info'); ?>
      <?=$contents ?>
    </section>
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versi</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?=date('Y',time()) ?> <a href="https://rushjr.wordpress.com" target="_blank">Rush Jr. Studio</a>.</strong> All rights reserved.
  </footer>
</div>

<!-- MODAL KELUAR -->
<div class="modal fade" id="modalKeluar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Konfirmasi Keluar</h4>
      </div>
      <div class="modal-body">
        <p class="text-center">Anda yakin ingin keluar dari aplikasi?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
        <a href="<?=base_url('auth/keluar') ?>" type="button" class="btn btn-danger"><i class="fa fa-sign-out"></i> Keluar</a>
      </div>
    </div>
  </div>
</div>

<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?=base_url()?>assets/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?=base_url()?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?=base_url()?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="<?=base_url()?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?=base_url()?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
<script src="<?=base_url()?>assets/dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
