<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?=$subjudul ?></strong></h3>
	</div>
	<form class="form-horizontal" action="<?=base_url('pemasukan/proses/'.$hal.'/'.$id_pemasukan) ?>" method="post">
		<div class="box-body row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="form-group">
	        <label for="id_pemasukan" class="col-sm-4 control-label">Kode Transaksi</label>
	        <div class="col-sm-8">
	          <input type="text" class="form-control" id="id_pemasukan" name="id_pemasukan" value="<?=$id_pemasukan ?>" readonly>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="tgl_pemasukan" class="col-sm-4 control-label">Tanggal Transaksi</label>
	        <div class="col-sm-8">
	          <input type="date" class="form-control" id="tgl_pemasukan" name="tgl_pemasukan" value="<?=$tgl_pemasukan ?>" autofocus>
	          <?php echo form_error('tgl_pemasukan', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="keterangan" class="col-sm-4 control-label">Keterangan</label>
	        <div class="col-sm-8">
	          <textarea class="form-control" rows="3" id="keterangan" name="keterangan"><?=$keterangan ?></textarea>
	          <?php echo form_error('keterangan', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="jumlah_masuk" class="col-sm-4 control-label">Jumlah</label>
	        <div class="col-sm-8">
	          <input type="number" class="form-control" id="jumlah_masuk" name="jumlah_masuk" value="<?=$jumlah_masuk ?>">
	          <?php echo form_error('jumlah_masuk', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
			</div>
		</div>
		<div class="box-footer">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
		      <a href="<?=base_url('pemasukan') ?>" class="btn btn-sm btn-flat btn-default pull-right"><i class="fa fa-times"></i> Batal</a>
		      <button type="submit" class="btn btn-sm btn-flat <?php if($hal=='tambah'){echo "btn-primary";}else{echo "btn-info";} ?> pull-right margin-r-5"><i class="fa fa-save"></i> <?php if($hal=='tambah'){echo "Simpan";}else{echo "Perbarui";} ?></button>
				</div>
			</div>
    </div>
	</form>
</div>