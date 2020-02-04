<?php
	if($penjualan_template){
		$subtotal = 0;
		foreach ($penjualan_template as $jt) {
			$harga = $jt['harga_jual'];
			$jumlah = $jt['jumlah'];
			$diskon = $jt['diskon_item'];
			$total = ($harga*$jumlah)-$diskon;
			$subtotal = $subtotal+$total;
		}
	}else{
		$subtotal = 0;
	}
?>
<form class="form-horizontal" action="<?=base_url('penjualan/proses') ?>" method="post">
	<div class="row">
		<div class="col-sm-4">
			<div class="box box-primary">
	      <div class="box-body">
	        <div class="form-group">
	          <div class="col-sm-12">
	            <input type="text" class="form-control text-center" name="tglpenjualan" id="tglpenjualan" value="<?=tgl_indoharitime(time()) ?>" readonly>
	            <input type="hidden" class="form-control" name="tgl_jual" id="tgl_jual" value="<?=date('Y-m-d',time()) ?>" readonly>
	          </div>
	        </div>
	        <div class="form-group">
	          <label for="username" class="col-sm-3 control-label">Kasir</label>
	          <div class="col-sm-9">
	            <input type="text" class="form-control" id="username" name="username" value="<?=$pengguna_masuk['nama_lengkap'] ?>" readonly>
	          </div>
	        </div>
	        <div class="form-group" style="margin-bottom: 6px">
	          <label for="id_pelanggan" class="col-sm-3 control-label">Pelanggan</label>
	          <div class="col-sm-9">
	            <select class="form-control select2" id="id_pelanggan" name="id_pelanggan" style="width: 100%;">
	              <option value="">Umum</option>
	              <?php foreach ($pelanggan as $cs): ?>
	                <option value="<?=$cs['id_pelanggan'] ?>"><?=$cs['nama'] ?></option>
	              <?php endforeach ?>
	            </select>
	          </div>
	        </div>
	      </div>
			</div>
		</div>

		<div class="col-sm-4" id="brg">
			<div class="box box-primary">
	      <div class="box-body">
	        <div class="form-group">
	          <label for="id_item" class="col-sm-4 control-label">Kode Barang</label>
	          <div class="col-sm-8">
	          	<div class="input-group">
		            <input type="text" id="id_item" name="id_item" class="form-control" autofocus>
		            <span class="input-group-btn">
		              <button type="button" id="btnCariBarang" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modalCariBarang"><i class="fa fa-search"></i></button>
		            </span>
	          	</div>
	          </div>
	        </div>
	        <div class="form-group">
	          <label for="jumlah" class="col-sm-4 control-label">Jumlah</label>
	          <div class="col-sm-8">
	            <input type="number" min="0" class="form-control" id="jumlah" name="jumlah" value="0">
	          </div>
	        </div>
	        <button type="submit" id="tbltambahbarang" name="tbltambahbarang" class="btn btn-flat btn-primary pull-right"><i class="fa fa-cart-plus"></i> Tambah</button>
	      </div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="box box-primary">
				<div class="box-header">
	        <strong class="pull-right" style="font-size: 25px"><?=$id_penjualan ?></strong>
	        <input type="hidden" name="id_penjualan" value="<?=$id_penjualan ?>">
				</div>
	      <div class="box-body">
	      	<strong class="pull-right" style="font-size: 40px; margin-top:19px" id="grand_total">Rp. <?=number_format($subtotal, 0, ',', '.') ?>,-</strong>
	      </div>
			</div>
		</div>
	</div>

	<div class="box box-primary">
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped table-hover" width="100%">
				<thead>
					<tr>
						<th class="text-center" width="3%">NO</th>
						<th class="text-center" width="10%">KODE BARANG</th>
						<th class="text-center">NAMA BARANG</th>
						<th class="text-center" width="12%">HARGA (Rp)</th>
						<th class="text-center" width="7%">JUMLAH</th>
						<th class="text-center" width="12%">DISKON (Rp)</th>
						<th class="text-center" width="12%">TOTAL (Rp)</th>
						<th class="text-center" width="8%">OPSI</th>
					</tr>
				</thead>
				<tbody>
					<?php if($penjualan_template){ ?>
						<?php $no=1; foreach ($penjualan_template as $pt): ?>
							<tr>
								<td style="vertical-align: middle" class="text-center"><?=$no++ ?></td>
								<td style="vertical-align: middle" class="text-center"><?=$pt['id_item'] ?></td>
								<td style="vertical-align: middle"><?=$pt['nama_item'] ?></td>
								<td style="vertical-align: middle" class="text-right">Rp. <?=number_format($pt['harga_jual'], 0, ',', '.') ?>,-</td>
								<td style="vertical-align: middle" class="text-center"><?=number_format($pt['jumlah'], 0, ',', '.') ?></td>
								<td style="vertical-align: middle" class="text-right">Rp. <?=number_format($pt['diskon_item'], 0, ',', '.') ?>,-</td>
								<td style="vertical-align: middle" class="text-right">Rp. <?=number_format(($pt['harga_jual']*$pt['jumlah'])-$pt['diskon_item'], 0, ',', '.') ?>,-</td>
								<td style="vertical-align: middle" class="text-center">
									<button type="button" id="ubahbarang" data-toggle="modal" data-target="#modalUbahBarang" data-id="<?=$pt['id_item'] ?>" data-nama="<?=$pt['nama_item'] ?>" data-harga="<?=$pt['harga_jual'] ?>" data-jumlah="<?=$pt['jumlah'] ?>" data-diskon="<?=$pt['diskon_item'] ?>" class="btn btn-sm btn-info btn-flat" title="Ubah"><i class="fa fa-pencil"></i></button>
									<button type="button" id="hapusbarang" data-toggle="modal" data-target="#modalHapusBarang" data-id="<?=$pt['id_item'] ?>" data-nama="<?=$pt['nama_item'] ?>" class="btn btn-sm btn-danger btn-flat" title="Hapus"><i class="fa fa-trash"></i></button>
								</td>
							</tr>
						<?php endforeach ?>
					<?php }else{ ?>
						<tr>
								<td style="vertical-align: middle" class="text-center" colspan="8">Belum ada barang yang dipilih!</td>
							</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-4">
			<div class="box box-primary">
		    <div class="box-body">
		      <div class="form-group">
		        <label for="subtotal" class="col-sm-5 control-label">Sub Total (Rp)</label>
		        <div class="col-sm-7">
		          <input type="number" min="0" class="form-control" name="subtotal" id="subtotal" value="<?=$subtotal ?>" readonly>
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="diskon" class="col-sm-5 control-label">Diskon (Rp)</label>
		        <div class="col-sm-7">
		        	<?php if($penjualan_template){ ?>
			          <input type="number" min="0" onchange="diskon_penjualan()" onkeyup="diskon_penjualan()" class="form-control" name="diskon" id="diskon" value="0">
		        	<?php }else{ ?>
			          <input type="number" min="0" onchange="diskon_penjualan()" onkeyup="diskon_penjualan()" class="form-control" name="diskon" id="diskon" value="0" readonly>
		        	<?php } ?>
		        </div>
		      </div>
		      <div class="form-group" style="margin-bottom: 6px">
		        <label for="grandtotal" class="col-sm-5 control-label">Grand Total (Rp)</label>
		        <div class="col-sm-7">
		          <input type="number" min="0" class="form-control" name="grandtotal" id="grandtotal" value="<?=$subtotal ?>" readonly>
		        </div>
		      </div>
		    </div>
			</div>
		</div>

		<div class="col-sm-4">
			<div class="box box-primary">
		    <div class="box-body">
		      <div class="form-group">
		        <label for="tunai" class="col-sm-5 control-label">Uang Tunai (Rp)</label>
		        <div class="col-sm-7">
		        	<?php if($penjualan_template){ ?>
			          <input type="number" min="0" onchange="sisa_uang()" onkeyup="sisa_uang()" class="form-control" name="tunai" id="tunai" value="0">
		        	<?php }else{ ?>
			          <input type="number" min="0" onchange="sisa_uang()" onkeyup="sisa_uang()" class="form-control" name="tunai" id="tunai" value="0" readonly>
		        	<?php } ?>
		        </div>
		      </div>
		      <div class="form-group">
		        <label for="sisauang" class="col-sm-5 control-label">Kembalian (Rp)</label>
		        <div class="col-sm-7">
		          <input type="number" min="0" class="form-control" name="sisauang" id="sisauang" value="0" readonly>
		        </div>
		      </div>
		      <div class="form-group" style="margin-bottom: 6px">
		        <div class="col-sm-12">
		          <textarea class="form-control" name="catatan" id="catatan" rows="1" wrap="on"  placeholder="Masukkan catatan ..."></textarea>
		        </div>
		      </div>
		    </div>
			</div>
		</div>

		<div class="col-sm-4">
				<button type="submit" id="tblprosespenjualan" name="tblprosespenjualan" class="btn btn-flat btn-block btn-success btn-lg" <?php if(!$penjualan_template){echo "disabled";} ?>><i class="fa fa-paper-plane"></i> Proses Penjualan</button>
				<button type="button" id="batalpenjualan" data-toggle="modal" data-target="#modalBatalJual" class="btn btn-flat btn-block btn-warning" <?php if(!$penjualan_template){echo "disabled";} ?>><i class="fa fa-refresh"></i> Batal</button>
		</div>
	</div>
</form>

<div class="modal fade" id="modalCariBarang">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pilih Item/Barang</h4>
      </div>
      <div class="modal-body table-responsive">
        <table class="table table-bordered table-striped table-hover" id="table2" width="100%">
        	<thead>
        		<tr>
        			<th class="text-center" width="20%">NO</th>
        			<th class="text-center">KODE BARANG</th>
        			<th class="text-center">NAMA BARANG</th>
        			<th class="text-center">HARGA</th>
        			<th class="text-center">STOK</th>
        			<th class="text-center" width="20%">PILIH</th>
        		</tr>
        	</thead>
        	<tbody>
        		<?php $no=1; foreach ($item as $itm): ?>
	        		<tr>
	        			<td class="text-center"><?=$no++ ?></td>
	        			<td class="text-center"><?=$itm['id_item'] ?></td>
	        			<td><?=$itm['nama_item'] ?></td>
	        			<td class="text-right">Rp. <?=number_format($itm['harga_jual'], 0, ',', '.') ?>,-</td>
	        			<td class="text-center"><?=$itm['stok'] ?> <?=$itm['nama_unit'] ?></td>
	        			<td class="text-center">
	        				<button type="button" id="tblpilih" data-id="<?=$itm['id_item'] ?>" data-stok="<?=$itm['stok'] ?>" class="btn btn-sm btn-info btn-flat"><i class="fa fa-check"></i></button>
	        			</td>
	        		</tr>
        		<?php endforeach ?>
        	</tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- MODAL UBAH BARANG -->
<div class="modal fade" id="modalUbahBarang">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ubah Item/Barang</h4>
      </div>
      <form id="formubahbarang" action="<?=base_url('penjualan/proses') ?>" method="post">
	      <div class="modal-body">
	      	<div class="form-group">
            <label for="id_item">Kode Barang</label>
            <input type="text" class="form-control" id="id_item" name="id_item" readonly>
          </div>
          <div class="form-group">
            <label for="nama_item">Nama Barang</label>
            <input type="text" class="form-control" id="nama_item" name="nama_item" readonly>
          </div>
          <div class="form-group">
            <label for="harga_jual">Harga (Rp)</label>
            <input type="number" min="0" class="form-control" id="harga_jual" name="harga_jual" readonly>
          </div>
          <div class="form-group">
            <label for="jumlah">Jumlah</label>
            <input type="number" min="0" class="form-control" id="jumlah" name="jumlah">
          </div>
          <div class="form-group">
            <label for="diskon_item">Diskon (Rp)</label>
            <input type="number" min="0" class="form-control" id="diskon_item" name="diskon_item">
          </div>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-sm btn-flat btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
	      	<button type="submit" class="btn btn-sm btn-flat btn-info" name="tblubahbarang"><i class="fa fa-save"></i> Simpan</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL HAPUS BARANG -->
<div class="modal fade" id="modalHapusBarang">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Item/Barang</h4>
      </div>
      <form id="formhapusbarang" action="<?=base_url('penjualan/proses') ?>" method="post">
	      <div class="modal-body">
	      	<input type="hidden" name="id_item_hapus" id="id_item_hapus">
	        <p id="kethapus" class="text-center">Hapus item dari keranjang</p>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-sm btn-flat btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
	      	<button type="submit" class="btn btn-sm btn-flat btn-danger" name="tblhapusbarang"><i class="fa fa-trash"></i> Hapus</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL BATAL JUAL -->
<div class="modal fade" id="modalBatalJual">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Batalkan Penjualan</h4>
      </div>
      <form id="formbataljual" action="<?=base_url('penjualan/proses') ?>" method="post">
	      <div class="modal-body">
	      	<input type="hidden" name="id_item" id="id_item">
	      	<input type="hidden" name="id_penjualan" id="id_penjualan">
	        <p id="kethapus" class="text-center">Batalkan transaksi penjualan ini?</p>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-sm btn-flat btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
	      	<button type="submit" class="btn btn-sm btn-flat btn-warning" name="tblbatalpenjualan"><i class="fa fa-refresh"></i> Batalkan Penjualan</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url() ?>assets/bower_components/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript">
  $(document).on("click", "#tblpilih", function(){
    var id = $(this).data('id');
    var stok = $(this).data('stok');
    $("#brg #id_item").val(id);
    $("#brg #jumlah").val(stok);
    $("#modalCariBarang").modal('hide');
  });

  $(document).on("click", "#ubahbarang", function(){
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    var harga = $(this).data('harga');
    var jumlah = $(this).data('jumlah');
    var diskon = $(this).data('diskon');
    $("#formubahbarang #id_item").val(id);
    $("#formubahbarang #nama_item").val(nama);
    $("#formubahbarang #harga_jual").val(harga);
    $("#formubahbarang #jumlah").val(jumlah);
    $("#formubahbarang #diskon_item").val(diskon);
  });

  $(document).on("click", "#hapusbarang", function(){
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    $("#formhapusbarang #id_item_hapus").val(id);
    $("#formhapusbarang #kethapus").html("Anda ingin menghapus <strong>"+nama+"</strong> dari keranjang?");
  });

  function diskon_penjualan()
  {
  	var diskon = $("#diskon").val();
  	var subtotal = $("#subtotal").val();
    $("#grandtotal").val(subtotal-diskon);
    $("#sisauang").val(subtotal-diskon);
    $("#grand_total").html("Rp. "+formatNumber(subtotal-diskon)+",-");
  }

  function sisa_uang()
  {
  	var grandtotal = $("#grandtotal").val();
  	var tunai = $("#tunai").val();
    $("#sisauang").val(tunai-grandtotal);
  }

	function formatNumber(num) {
	  return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
	}
</script>