<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?=$subjudul ?><?php if($hal=='ubah'){ ?> : <strong><?=$id_supplier ?> - <?=$nama ?><?php } ?></strong></h3>
	</div>
	<form class="form-horizontal" action="<?=base_url('supplier/proses/'.$hal.'/'.$id_supplier) ?>" method="post">
		<div class="box-body row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="form-group">
	        <label for="id_supplier" class="col-sm-3 control-label">Kode Supplier</label>
	        <div class="col-sm-9">
	          <input type="text" class="form-control" id="id_supplier" name="id_supplier" value="<?=$id_supplier ?>" readonly>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="nama" class="col-sm-3 control-label">Nama Supplier</label>
	        <div class="col-sm-9">
	          <input type="text" class="form-control" id="nama" name="nama" value="<?=$nama ?>" autofocus>
	          <?php echo form_error('nama', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="telpon" class="col-sm-3 control-label">No. Telepon</label>
	        <div class="col-sm-9">
	          <input type="text" class="form-control" id="telpon" name="telpon" value="<?=$telpon ?>">
	          <?php echo form_error('telpon', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="email" class="col-sm-3 control-label">Email</label>
	        <div class="col-sm-9">
	          <input type="text" class="form-control" id="email" name="email" value="<?=$email ?>">
	          <?php echo form_error('email', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="alamat" class="col-sm-3 control-label">Alamat</label>
	        <div class="col-sm-9">
	          <textarea class="form-control" id="alamat" name="alamat" rows="3"><?=$alamat ?></textarea>
	          <?php echo form_error('alamat', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="deskripsi" class="col-sm-3 control-label">Deskripsi</label>
	        <div class="col-sm-9">
	          <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?=$deskripsi ?></textarea>
	        </div>
	      </div>
			</div>
		</div>
		<div class="box-footer">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
		      <a href="<?=base_url('supplier') ?>" class="btn btn-sm btn-flat btn-default pull-right"><i class="fa fa-times"></i> Batal</a>
		      <button type="submit" class="btn btn-sm btn-flat <?php if($hal=='tambah'){echo "btn-primary";}else{echo "btn-info";} ?> pull-right margin-r-5"><i class="fa fa-save"></i> <?php if($hal=='tambah'){echo "Simpan";}else{echo "Perbarui";} ?></button>
				</div>
			</div>
    </div>
	</form>
</div>