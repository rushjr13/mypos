<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>POS - Makaleka</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
	
<div class="wrapper">
  <header class="main-header">
    <a href="<?=base_url()?>" class="logo">
      <span class="logo-mini"><b>MK</b>pos</span>
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
              <img src="<?=base_url()?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Administrator</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?=base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Administrator - Admin
                  <small>Member Seja Januari 2010</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-success btn-flat"><i class="fa fa-user"></i> Profil</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-danger btn-flat"><i class="fa fa-sign-out"></i> Keluar</a>
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
          <img src="<?=base_url()?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Administrator</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
        <li><a href="<?=base_url() ?>"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
        <li><a href="<?=base_url('supplier') ?>"><i class="fa fa-truck"></i> <span>Supplier</span></a></li>
        <li><a href="<?=base_url('pelanggan') ?>"><i class="fa fa-users"></i> <span>Pelanggan</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-archive"></i>
            <span>Produk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url('produk/kategori') ?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
            <li><a href="<?=base_url('produk/unit') ?>"><i class="fa fa-circle-o"></i> Unit</a></li>
            <li><a href="<?=base_url('produk/item') ?>"><i class="fa fa-circle-o"></i> Item</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url('transaksi/penjualan') ?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li><a href="<?=base_url('transaksi/stok_masuk') ?>"><i class="fa fa-circle-o"></i> Stok Masuk</a></li>
            <li><a href="<?=base_url('transaksi/stok_keluar') ?>"><i class="fa fa-circle-o"></i> Stok Keluar</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=base_url('laporan/penjualan') ?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li><a href="<?=base_url('laporan/stok') ?>"><i class="fa fa-circle-o"></i> Stok</a></li>
          </ul>
        </li>
        <li class="header">PENGATURAN</li>
        <li><a href="<?=base_url('pengguna') ?>"><i class="fa fa-users"></i> <span>Pengguna</span></a></li>
      </ul>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Beranda
        <small>Makaleka POS v.1.0.0</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li class="active">Beranda</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-th"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Item</span>
              <span class="info-box-number">90</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Suplier</span>
              <span class="info-box-number">4</span>
            </div>
          </div>
        </div>
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pelanggan</span>
              <span class="info-box-number">1</span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-user-secret"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pengguna</span>
              <span class="info-box-number">2</span>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versi</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?=date('Y',time()) ?> <a href="https://rushjr.wordpress.com" target="_blank">Rush Jr. Studio</a>.</strong> All rights reserved.
  </footer>
</div>

<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
<script src="<?=base_url()?>assets/dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
