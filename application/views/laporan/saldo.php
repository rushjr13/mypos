<div class="row">
	<!-- PENJUALAN -->
	<div class="col-sm-4">
		<div class="box box-primary">
			<div class="box-header">
				<h1 class="box-title">PENJUALAN</h1>
			</div>
			<div class="box-body table-responsive">
				<table class="table table-sm table-bordered table-striped table-hover" id="table3" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center" style="vertical-align: middle">NAMA BARANG</th>
							<th class="text-center" style="vertical-align: middle" width="30%">JUMLAH (Rp)</th>
						</tr>
					</thead>
					<tbody>
						<?php $total_penjualan=0; if($penjualan_item_data){ ?>
							<?php foreach ($penjualan_item_data as $pid): ?>
								<?php
									$harga_jual = $pid['harga_jual'];
									$jlh_jual = $pid['jumlah'];
									$disk_jual = $pid['diskon_item'];
									$subtotaljual = ($harga_jual*$jlh_jual)-$disk_jual;
									$total_penjualan = $total_penjualan+$subtotaljual;
								?>
								<tr>
									<td style="vertical-align: middle"><?=$pid['nama_item'] ?> <small class="pull-right">(<?=$jlh_jual ?>)</small></td>
									<td class="text-right" style="vertical-align: middle"><?=number_format($subtotaljual, 0, ',', '.') ?></td>
								</tr>
							<?php endforeach ?>
						<?php }else{ ?>
							<tr>
								<td class="text-center" style="vertical-align: middle" colspan="2">Tidak ada data penjualan!</td>
							</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th class="text-right" style="vertical-align: middle">TOTAL (Rp)</th>
							<th class="text-right" style="vertical-align: middle"><?=number_format($total_penjualan, 0, ',', '.') ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

	<!-- PEMASUKAN -->
	<div class="col-sm-4">
		<div class="box box-success">
			<div class="box-header">
				<h1 class="box-title">PEMASUKAN</h1>
			</div>
			<div class="box-body table-responsive">
				<table class="table table-sm table-bordered table-striped table-hover" id="table4" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center" style="vertical-align: middle">KETERANGAN</th>
							<th class="text-center" style="vertical-align: middle" width="30%">JUMLAH (Rp)</th>
						</tr>
					</thead>
					<tbody>
						<?php $total_pemasukan=0; if($pemasukan){ ?>
							<?php foreach ($pemasukan as $msk): ?>
								<?php
									$total_pemasukan = $total_pemasukan+$msk['jumlah_masuk'];
								?>
								<tr>
									<td style="vertical-align: middle"><small class="pull-right"><?=tgl_indodate($msk['tgl_pemasukan']) ?></small><?=$msk['keterangan'] ?></td>
									<td class="text-right" style="vertical-align: middle"><?=number_format($msk['jumlah_masuk'], 0, ',', '.') ?></td>
								</tr>
							<?php endforeach ?>
						<?php }else{ ?>
							<tr>
								<td class="text-center" style="vertical-align: middle" colspan="2">Tidak ada data pemasukan!</td>
							</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th class="text-right" style="vertical-align: middle">TOTAL (Rp)</th>
							<th class="text-right" style="vertical-align: middle"><?=number_format($total_pemasukan, 0, ',', '.') ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
	<!-- PENGELUARAN -->
	<div class="col-sm-4">
		<div class="box box-danger">
			<div class="box-header">
				<h1 class="box-title">PENGELUARAN</h1>
			</div>
			<div class="box-body table-responsive">
				<table class="table table-sm table-bordered table-striped table-hover" id="table5" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center" style="vertical-align: middle">KETERANGAN</th>
							<th class="text-center" style="vertical-align: middle" width="30%">JUMLAH (Rp)</th>
						</tr>
					</thead>
					<tbody>
						<?php $total_pengeluaran=0; if($pengeluaran){ ?>
							<?php foreach ($pengeluaran as $klr): ?>
								<?php
									$total_pengeluaran = $total_pengeluaran+$klr['jumlah_keluar'];
								?>
								<tr>
									<td style="vertical-align: middle"><small class="pull-right"><?=tgl_indodate($klr['tgl_pengeluaran']) ?></small><?=$klr['keterangan'] ?></td>
									<td class="text-right" style="vertical-align: middle"><?=number_format($klr['jumlah_keluar'], 0, ',', '.') ?></td>
								</tr>
							<?php endforeach ?>
						<?php }else{ ?>
							<tr>
								<td class="text-center" style="vertical-align: middle" colspan="2">Tidak ada data pengeluaran!</td>
							</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th class="text-right" style="vertical-align: middle">TOTAL (Rp)</th>
							<th class="text-right" style="vertical-align: middle"><?=number_format($total_pengeluaran, 0, ',', '.') ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="small-box bg-yellow">
  <div class="inner">
    <?php $saldo=$total_penjualan+$total_pemasukan-$total_pengeluaran; ?>
    <h3>Rp. <?=number_format($total_penjualan, 0, ',', '.') ?> + Rp. <?=number_format($total_pemasukan, 0, ',', '.') ?> - Rp. <?=number_format($total_pengeluaran, 0, ',', '.') ?> = Rp. <?=number_format($saldo, 0, ',', '.') ?></h3>
    <p>TOTAL PENJUALAN + TOTAL PEMASUKAN - TOTAL PENGELUARAN = SALDO KAS</p>
  </div>
  <div class="icon">
    <i class="fa fa-money"></i>
  </div>
  <a href="<?=base_url('beranda') ?>" class="small-box-footer">Kembali ke Beranda <i class="fa fa-home"></i></a>
</div>