<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title"><?=$subjudul ?></h3>
  </div>
  <form class="form-horizontal" action="<?=base_url('pengaturan/proses') ?>" method="post" enctype="multipart/form-data">
    <div class="box-body row">
      <div class="col-sm-4">
        <div class="text-center" style="margin-bottom: 10px;">
          <img src="<?=base_url('uploads/').$pengaturan['icon'] ?>" class="img-circle img-responsive img-thumbnail" width="100px" alt="<?=$pengaturan['nama_aplikasi'] ?>">
        </div>
        <div class="form-group">
          <label for="icon" class="col-sm-2 control-label">Icon</label>
          <div class="col-sm-10">
            <input type="hidden" class="form-control" id="ikon" name="ikon" value="<?=$pengaturan['icon'] ?>">
            <input type="file" class="form-control" id="icon" name="icon">
            <span class="text-primary"><small>*Kosongkan jika tidak ingin mengganti icon!</small></span>
            <br>
            <span class="text-primary"><small>*pilih format file .png!</small></span>
          </div>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="form-group">
          <label for="nama_aplikasi" class="col-sm-3 control-label">Nama Aplikasi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_aplikasi" name="nama_aplikasi" placeholder="Nama Aplikasi" value="<?=$pengaturan['nama_aplikasi'] ?>" autofocus>
            <?php echo form_error('nama_aplikasi', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="nama_alias" class="col-sm-3 control-label">Alias</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nama_alias" name="nama_alias" maxlength="3" placeholder="Alias" value="<?=$pengaturan['nama_alias'] ?>">
            <?php echo form_error('nama_alias', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="url" class="col-sm-3 control-label">URL / Link Aplikasi</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="url" name="url" placeholder="URL / Link Aplikasi" value="<?=$pengaturan['url'] ?>">
            <?php echo form_error('url', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
          </div>
        </div>
        <div class="form-group">
          <label for="db" class="col-sm-3 control-label">Database</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="db" name="db" placeholder="Database" value="<?=$pengaturan['db'] ?>">
            <?php echo form_error('db', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="box-footer">
      <button type="reset" class="btn btn-sm btn-flat btn-default"><i class="fa fa-refresh"></i> Atur Ulang</button>
      <button type="submit" class="btn btn-sm btn-flat btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </form>
</div>