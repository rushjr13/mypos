<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?=$subjudul ?></h3>
	</div>
	<form role="form" action="<?=base_url('stok/proses/keluar/') ?>" method="post" enctype="multipart/form-data">
		<div class="box-body row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="form-group">
	        <label for="id_stok">Kode Stok Masuk</label>
          <input type="text" class="form-control" id="id_stok" name="id_stok" value="STK<?=time() ?>" readonly>
	      </div>
	      <div class="form-group">
	        <label for="id_item">Kode Barang</label>
        	<div class="input-group">
	          <input type="text" id="id_item" name="id_item" class="form-control" readonly>
            <span class="input-group-btn">
              <button type="button" id="btnCariBarang" data-toggle="modal" data-target="#modalCariBarang" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
            </span>
        	</div>
          <?php echo form_error('id_item', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	      </div>
	      <div class="form-group">
	        <label for="nama_item">Nama Barang</label>
          <input type="text" class="form-control" id="nama_item" name="nama_item" readonly>
	      </div>
	      <div class="form-group row">
	      	<div class="col-sm-4">
		        <label for="stok">Stok Awal</label>
	          <input type="text" class="form-control" id="stok" name="stok" readonly>
	      	</div>
	      	<div class="col-sm-8">
		        <label for="satuan">Satuan/Unit</label>
	          <input type="text" class="form-control" id="satuan" name="satuan" readonly>
	      	</div>
	      </div>
			</div>
			<div class="col-sm-6">
				<div class="form-group row">
					<div class="col-sm-4">
						<label for="jumlah">Jumlah</label>
	          <input type="number" class="form-control" id="jumlah" value="0" name="jumlah" autofocus>
	          <?php echo form_error('jumlah', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
					</div>
					<div class="col-sm-8">
		        <label for="tanggal">Tanggal</label>
	          <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?=date('Y-m-d') ?>">
	          <?php echo form_error('tanggal', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
					</div>
	      </div>
	      <div class="form-group">
	        <label for="detail">Detail</label>
          <input type="text" class="form-control" id="detail" name="detail">
          <?php echo form_error('detail', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	      </div>
			</div>
		</div>
		<div class="box-footer">
      <a href="<?=base_url('stok/keluar') ?>" class="btn btn-sm btn-flat btn-default pull-right"><i class="fa fa-times"></i> Batal</a>
      <button type="submit" class="btn btn-sm btn-flat btn-primary pull-right margin-r-5"><i class="fa fa-save"></i> Simpan</button>
    </div>
	</form>
</div>

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
        			<th class="text-center">SATUAN</th>
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
	        			<td class="text-center"><?=$itm['nama_unit'] ?></td>
	        			<td class="text-center">
	        				<button type="button" id="tblpilih" data-id="<?=$itm['id_item'] ?>" data-nama="<?=$itm['nama_item'] ?>" data-stok="<?=$itm['stok'] ?>" data-satuan="<?=$itm['nama_unit'] ?>" class="btn btn-sm btn-info btn-flat"><i class="fa fa-check"></i></button>
	        			</td>
	        		</tr>
        		<?php endforeach ?>
        	</tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url() ?>assets/bower_components/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript">
  $(document).on("click", "#tblpilih", function(){
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    var stok = $(this).data('stok');
    var satuan = $(this).data('satuan');
    $("#id_item").val(id);
    $("#nama_item").val(nama);
    $("#stok").val(stok);
    $("#jumlah").val(stok);
    $("#satuan").val(satuan);
    $("#modalCariBarang").modal('hide');
  })
</script>