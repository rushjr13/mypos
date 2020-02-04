
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=$pengaturan['nama_aplikasi'] ?>POS || <?=$subjudul ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shortcut icon" href="<?=base_url('uploads/').$pengaturan['icon'] ?>">
  <link rel="stylesheet" href="<?=base_url()?>assets//bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets//bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets//bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets//dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!--  -->
<body onload="window.print();">
<div class="wrapper">
  <section class="invoice">
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <img src="<?=base_url('uploads/'.$pengaturan['icon']) ?>" class="img img-responsive" width="5%" style="margin-top: 0px "> <?=$pengaturan['nama_aplikasi'] ?>.
        <small class="pull-right">Gorontalo, <?=tgl_indodate($penjualan['tgl_penjualan']) ?></small>
      </h2>
    </div>
  </div>
  <div class="row" style="margin-bottom: 15px">
    <div class="col-xs-7">
      Telah diterima dari
      <address>
        <?php if($penjualan['id_pelanggan']==null){ ?>
          <strong>Pelanggan Umum</strong>
        <?php }else{ ?>
          <strong><?=$penjualan['nama'] ?></strong><br>
          <?=$penjualan['alamat'] ?><br>
          Telepon : <?=$penjualan['telpon'] ?><br>
          Email : <?=$penjualan['email'] ?>
        <?php } ?>
      </address>
    </div>
    <div class="col-xs-5 text-right">
      <b>NO. TRANSAKSI #<?=$penjualan['id_penjualan'] ?></b><br>
      <br>
      <b>Tanggal Pembayaran :</b> <?=tgl_indodate($penjualan['tgl_penjualan']) ?>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th class="text-center" style="vertical-align: middle" width="4%">No</th>
            <th class="text-center" style="vertical-align: middle" width="12%">Kode Barang</th>
            <th class="text-center" style="vertical-align: middle">Nama Barang</th>
            <th class="text-center" style="vertical-align: middle" width="15%">Harga (Rp)</th>
            <th class="text-center" style="vertical-align: middle" width="7%">Jumlah</th>
            <th class="text-center" style="vertical-align: middle" width="15%">Diskon (Rp)</th>
            <th class="text-center" style="vertical-align: middle" width="15%">Total (Rp)</th>
          </tr>
        </thead>
        <tbody>
          <?php $subtotal=0; $no=1; foreach ($penjualan_item as $pi): ?>
          <?php
            $harga = $pi['harga_jual'];
            $jumlah = $pi['jumlah'];
            $diskon_item = $pi['diskon_item'];
            $total = ($pi['harga_jual']*$pi['jumlah'])-$pi['diskon_item'];
            $subtotal = $subtotal+$total;
          ?>
            <tr>
              <td style="vertical-align: middle" class="text-center"><?=$no++ ?></td>
              <td style="vertical-align: middle" class="text-center"><?=$pi['id_item'] ?></td>
              <td style="vertical-align: middle"><?=$pi['nama_item'] ?></td>
              <td style="vertical-align: middle" class="text-right">Rp. <?=number_format($harga, 0, ',', '.') ?>,-</td>
              <td style="vertical-align: middle" class="text-center"><?=number_format($jumlah, 0, ',', '.') ?></td>
              <td style="vertical-align: middle" class="text-right">Rp. <?=number_format($diskon_item, 0, ',', '.') ?>,-</td>
              <td style="vertical-align: middle" class="text-right">Rp. <?=number_format($total, 0, ',', '.') ?>,-</td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <p class="lead" style="margin-bottom: 0px;">Transaksi</p>
      <div class="table-responsive">
        <table class="table" style="margin-bottom: 0px; margin-top: 0px">
          <tr>
            <th style="width:50%">Subtotal (Rp)</th>
            <td class="text-right">Rp. <?=number_format($subtotal, 0, ',', '.') ?>,-</td>
          </tr>
          <tr>
            <th>Diskon (Rp)</th>
            <td class="text-right">Rp. <?=number_format($penjualan['diskon_penjualan'], 0, ',', '.') ?>,-</td>
          </tr>
          <?php $grandtotal = $subtotal-$penjualan['diskon_penjualan']; ?>
          <tr>
            <th>Grand Total (Rp)</th>
            <td class="text-right">Rp. <?=number_format($grandtotal, 0, ',', '.') ?>,-</td>
          </tr>
        </table>
        <p class="text-muted well well-sm no-shadow">
        <strong>Terbilang :</strong><br>
        <em># <?=terbilang($grandtotal) ?> rupiah #</em>
      </p>
      </div>
    </div>
    <div class="col-xs-6">
      <p class="lead" style="margin-bottom: 0px;">Pembayaran</p>
      <div class="table-responsive">
        <table class="table" style="margin-bottom: 0px; margin-top: 0px">
          <tr>
            <th style="width:50%">Uang Tunai (Rp)</th>
            <td class="text-right">Rp. <?=number_format($penjualan['tunai'], 0, ',', '.') ?>,-</td>
          </tr>
          <?php $sisauang = $penjualan['tunai']-$grandtotal; ?>
          <tr>
            <th>Kembalian (Rp)</th>
            <td class="text-right">Rp. <?=number_format($sisauang, 0, ',', '.') ?>,-</td>
          </tr>
        </table>
      </div>
      <p class="lead text-center" style="margin-bottom: 35px; margin-top: 20px;">Kasir</p>
      <p class="text-center"><strong><u><?=$penjualan['nama_lengkap'] ?></u></strong></p>
    </div>
  </div>
  <div style="margin-bottom: 0px; margin-top: 0px;" class="page-header"></div>
</section>
</div>
</body>
</html>
