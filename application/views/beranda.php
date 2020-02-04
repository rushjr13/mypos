<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-th"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Item</span>
        <span class="info-box-number"><?=$jumlah_item ?> Barang</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Supplier</span>
        <span class="info-box-number"><?=$jumlah_supplier ?> Pemasok</span>
      </div>
    </div>
  </div>
  <div class="clearfix visible-sm-block"></div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Pelanggan</span>
        <span class="info-box-number"><?=$jumlah_pelanggan ?> Orang</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-user-secret"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Pengguna</span>
        <span class="info-box-number"><?=$jumlah_pengguna ?> Orang</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="small-box bg-aqua">
      <div class="inner">
        <?php $total_penjualan=0; foreach ($penjualan_item_data as $pid) {
          $jumlah = $pid['jumlah'];
          $diskon_item = $pid['diskon_item'];
          $harga_jual = $pid['harga_jual'];
          $subtotal = ($jumlah*$harga_jual)-$diskon_item;
          $total_penjualan = $total_penjualan+$subtotal;
        } ?>
        <h3>Rp. <?=number_format($total_penjualan, 0, ',', '.') ?>,-</h3>
        <p>PENJUALAN</p>
      </div>
      <div class="icon">
        <i class="fa fa-money"></i>
      </div>
      <a href="<?=base_url('laporan/penjualan') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="small-box bg-green">
      <div class="inner">
        <?php $total_masuk=0; foreach ($pemasukan as $msk) {
          $total_masuk = $total_masuk+$msk['jumlah_masuk'];
        } ?>
        <h3>Rp. <?=number_format($total_masuk, 0, ',', '.') ?>,-</h3>
        <p>PEMASUKAN LAIN</p>
      </div>
      <div class="icon">
        <i class="fa fa-money"></i>
      </div>
      <a href="<?=base_url('pemasukan') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="small-box bg-red">
      <div class="inner">
        <?php $total_keluar=0; foreach ($pengeluaran as $klr) {
          $total_keluar = $total_keluar+$klr['jumlah_keluar'];
        } ?>
        <h3>Rp. <?=number_format($total_keluar, 0, ',', '.') ?>,-</h3>
        <p>PENGELUARAN</p>
      </div>
      <div class="icon">
        <i class="fa fa-money"></i>
      </div>
      <a href="<?=base_url('pengeluaran') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <?php $saldo=$total_penjualan+$total_masuk-$total_keluar; ?>
        <h3>Rp. <?=number_format($saldo, 0, ',', '.') ?>,-</h3>
        <p>SALDO</p>
      </div>
      <div class="icon">
        <i class="fa fa-money"></i>
      </div>
      <a href="<?=base_url('saldo') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>

<?=time() ?>