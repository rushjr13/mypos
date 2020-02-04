<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?=$subjudul ?><?php if($hal=='ubah'){ ?> : <strong><?=$id_unit ?> - <?=$nama_unit ?><?php } ?></strong></h3>
	</div>
	<form class="form-horizontal" action="<?=base_url('unit/proses/'.$hal.'/'.$id_unit) ?>" method="post">
		<div class="box-body row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="form-group">
	        <label for="id_unit" class="col-sm-3 control-label">Kode Kategori</label>
	        <div class="col-sm-9">
	          <input type="text" class="form-control" id="id_unit" name="id_unit" value="<?=$id_unit ?>" readonly>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="nama_unit" class="col-sm-3 control-label">Nama Kategori</label>
	        <div class="col-sm-9">
	          <input type="text" class="form-control" id="nama_unit" name="nama_unit" value="<?=$nama_unit ?>" autofocus>
	          <?php echo form_error('nama_unit', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
			</div>
		</div>
		<div class="box-footer">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
		      <a href="<?=base_url('unit') ?>" class="btn btn-sm btn-flat btn-default pull-right"><i class="fa fa-times"></i> Batal</a>
		      <button type="submit" class="btn btn-sm btn-flat <?php if($hal=='tambah'){echo "btn-primary";}else{echo "btn-info";} ?> pull-right margin-r-5"><i class="fa fa-save"></i> <?php if($hal=='tambah'){echo "Simpan";}else{echo "Perbarui";} ?></button>
				</div>
			</div>
    </div>
	</form>
</div>