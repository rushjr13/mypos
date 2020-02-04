<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title"><?=$judul ?> <?=$subjudul ?></h3>
	</div>
	<div class="box-body table-responsive">
		<table class="table table-sm table-bordered table-striped table-hover" id="table2" width="100%">
			<thead>
				<tr>
					<th style="vertical-align: middle" class="text-center"  width="5%">NO</th>
					<th style="vertical-align: middle" class="text-center"  width="10%">KODE TRANSAKSI</th>
					<th style="vertical-align: middle" class="text-center"  width="13%">TANGGAL</th>
					<th style="vertical-align: middle" class="text-center">PELANGGAN</th>
					<th style="vertical-align: middle" class="text-center">KASIR</th>
					<th style="vertical-align: middle" class="text-center">CATATAN</th>
					<th style="vertical-align: middle" class="text-center"  width="8%">OPSI</th>
				</tr>
			</thead>
			<tbody>
				<?php if($penjualan){ ?>
					<?php $no=1; foreach ($penjualan as $pj): ?>
						<tr>
							<td class="text-center" style="vertical-align: middle"><?=$no++ ?></td>
							<td class="text-center" style="vertical-align: middle"><?=$pj['id_penjualan'] ?></td>
							<td class="text-center" style="vertical-align: middle"><?=tgl_indodate($pj['tgl_penjualan']) ?></td>
							<td class="text-center" style="vertical-align: middle"><?=$pj['nama'] ?></td>
							<td class="text-center" style="vertical-align: middle"><?=$pj['nama_lengkap'] ?></td>
							<td class="text-center" style="vertical-align: middle"><?=$pj['catatan'] ?></td>
							<td class="text-center" style="vertical-align: middle">
								<a href="<?=base_url('penjualan/cetak/'.$pj['id_penjualan']) ?>" target="_blank" class="btn btn-sm btn-flat btn-info" title="Cetak"><i class="fa fa-print"></i></a>
								<?php if($pengguna_masuk['level']==1){ ?>
									<button type="button" class="btn btn-sm btn-flat btn-danger" title="Hapus"><i class="fa fa-trash"></i></button>
								<?php } ?>
							</td>
						</tr>
					<?php endforeach ?>
				<?php }else{ ?>
					<tr>
						<td class="text-center" style="vertical-align: middle" colspan="7">Belum ada transaksi penjualan!</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>