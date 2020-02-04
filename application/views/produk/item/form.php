<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><?=$subjudul ?><?php if($hal=='ubah'){ ?> : <strong><?=$id_item ?> - <?=$nama_item ?><?php } ?></strong></h3>
	</div>
	<form class="form-horizontal" action="<?=base_url('item/proses/'.$hal.'/'.$id_item) ?>" method="post" enctype="multipart/form-data">
		<div class="box-body row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="form-group">
	        <label for="id_item" class="col-sm-3 control-label">Kode Barang</label>
	        <div class="col-sm-9">
	          <input type="text" class="form-control" id="id_item" name="id_item" value="<?=$id_item ?>" readonly>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="nama_item" class="col-sm-3 control-label">Nama Barang</label>
	        <div class="col-sm-9">
	          <input type="text" class="form-control" id="nama_item" name="nama_item" value="<?=$nama_item ?>" autofocus>
	          <?php echo form_error('nama_item', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="id_kategori" class="col-sm-3 control-label">Kategori</label>
	        <div class="col-sm-9">
	          <select class="form-control select2" id="id_kategori" name="id_kategori" style="width: 100%;">
              <option value="" <?php if($id_kategori==''){echo "selected";} ?>>-- Pilih --</option>
              <?php foreach ($kategori as $ktg): ?>
	              <option value="<?=$ktg['id_kategori'] ?>" <?php if($id_kategori==$ktg['id_kategori']){echo "selected";} ?>><?=$ktg['nama_kategori'] ?></option>
              <?php endforeach ?>
            </select>
	          <?php echo form_error('id_kategori', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="id_unit" class="col-sm-3 control-label">Unit/Satuan</label>
	        <div class="col-sm-9">
	          <select class="form-control select2" id="id_unit" name="id_unit" style="width: 100%;">
              <option value="" <?php if($id_unit==''){echo "selected";} ?>>-- Pilih --</option>
              <?php foreach ($unit as $unt): ?>
	              <option value="<?=$unt['id_unit'] ?>" <?php if($id_unit==$unt['id_unit']){echo "selected";} ?>><?=$unt['nama_unit'] ?></option>
              <?php endforeach ?>
            </select>
	          <?php echo form_error('id_unit', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="harga_jual" class="col-sm-3 control-label">Harga (Rp)</label>
	        <div class="col-sm-9">
	          <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="<?=$harga_jual ?>">
	          <?php echo form_error('harga_jual', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="gambar_item" class="col-sm-3 control-label">Gambar</label>
	        	<?php if($hal=='ubah'){ if($gambar_item){ ?>
			        <div class="col-sm-2">
		        		<img src="<?=base_url('uploads/item/'.$gambar_item) ?>" class="img img-thumbnail" width="100%">
			        </div>
		          <input type="hidden" class="form-control" id="gambar" name="gambar" value="<?=$gambar_item ?>">
			        <div class="col-sm-7">
        		<?php }else{ ?>
			        <div class="col-sm-9">
        		<?php } }else{ ?>
			        <div class="col-sm-9">
        		<?php } ?>
	          <input type="file" class="form-control" id="gambar_item" name="gambar_item" >
	          <small class="text-muted"><i class="fa fa-fw fa-info-circle"></i> Kosongkan jika <?=$hal=='ubah' ? 'gambar tidak diganti' : 'tidak ada gambar' ?>!</small>
	        </div>
	      </div>
			</div>
		</div>
		<div class="box-footer">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
		      <a href="<?=base_url('item') ?>" class="btn btn-sm btn-flat btn-default pull-right"><i class="fa fa-times"></i> Batal</a>
		      <button type="submit" class="btn btn-sm btn-flat <?php if($hal=='tambah'){echo "btn-primary";}else{echo "btn-info";} ?> pull-right margin-r-5"><i class="fa fa-save"></i> <?php if($hal=='tambah'){echo "Simpan";}else{echo "Perbarui";} ?></button>
				</div>
			</div>
    </div>
	</form>
</div>