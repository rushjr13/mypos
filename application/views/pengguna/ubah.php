<div class="box box-primary">
  <form class="form-horizontal" action="<?=base_url('pengguna/ubah/'.$pengguna['username']) ?>" method="post" enctype="multipart/form-data">
		<div class="box-header with-border">
	    <h3 class="box-title"><?=$subjudul ?> : <strong><?=$pengguna['nama_lengkap'] ?></strong></h3>
	    <a href="<?=base_url('pengguna') ?>" class="btn btn-danger btn-sm pull-right btn-flat"><i class="fa fa-times"></i> Kembali</a>
	    <button type="submit" class="btn btn-primary btn-flat btn-sm pull-right margin-r-5"><i class="fa fa-save"></i> Simpan</button>
	  </div>
    <div class="box-body row">
    	<div class="col-sm-6 col-sm-offset-3">
	      <div class="form-group">
	        <label for="username" class="col-sm-3 control-label">Nama Pengguna</label>
	        <div class="col-sm-9">
	          <input type="text" class="form-control" id="username" name="username" placeholder="Nama Pengguna" readonly autocomplete="off" value="<?=$pengguna['username'] ?>">
	          <?php echo form_error('username', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="password" class="col-sm-3 control-label">Kata Sandi</label>
	        <div class="col-sm-9">
	          <div class="input-group input-group-sm">
              <input type="password" class="form-control" id="password" name="password" value="<?=$pengguna['password'] ?>">
              <span class="input-group-btn">
                <button type="button" class="btn btn-info btn-flat" title="Tampilkan" id="btnpasslihat"><i id="iconpass" class="fa fa-fw fa-eye"></i></button>
              </span>
            </div>
            <?php echo form_error('password', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="nama_lengkap" class="col-sm-3 control-label">Nama Lengkap</label>
	        <div class="col-sm-9">
	          <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" autofocus autocomplete="off" value="<?=$pengguna['nama_lengkap'] ?>">
	          <?php echo form_error('nama_lengkap', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="email" class="col-sm-3 control-label">Email</label>
	        <div class="col-sm-9">
	          <input type="text" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off" value="<?=$pengguna['email'] ?>">
	          <?php echo form_error('email', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="jk" class="col-sm-3 control-label">Jenis Kelamin</label>
	        <div class="col-sm-9">
	          <select class="form-control select2" id="jk" name="jk" style="width: 100%;">
              <option value="">-- Pilih --</option>
              <option value="Laki-laki" <?php if($pengguna['jk']=='Laki-laki'){echo "selected";} ?>>Laki-laki</option>
              <option value="Perempuan" <?php if($pengguna['jk']=='Perempuan'){echo "selected";} ?>>Perempuan</option>
            </select>
            <?php echo form_error('jk', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="alamat" class="col-sm-3 control-label">Alamat</label>
	        <div class="col-sm-9">
	          <textarea class="form-control" rows="3" id="alamat" name="alamat" placeholder="Alamat lengkap ..."><?=$pengguna['alamat'] ?></textarea>
	          <?php echo form_error('alamat', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
	      <div class="form-group">
	        <label for="level" class="col-sm-3 control-label">Level</label>
	        <div class="col-sm-9">
	          <select class="form-control select2" id="level" name="level" style="width: 100%;">
              <option value="">-- Pilih --</option>
              <option value="1" <?php if($pengguna['level']=='1'){echo "selected";} ?>>Admin</option>
              <option value="2" <?php if($pengguna['level']=='2'){echo "selected";} ?>>Pengguna</option>
            </select>
            <?php echo form_error('level', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
	        </div>
	      </div>
    	</div>
    </div>
  </form>
</div>

<script src="<?php echo base_url() ?>assets/bower_components/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript">
  $(document).on("click", "#btnpasslihat", function(){
    $("#password").attr("type","text");
    $("#btnpasslihat").attr("title","Sembunyikan");
    $("#btnpasslihat").attr("id","btnpasssembunyi");
    $("#iconpass").attr("class","fa fa-eye-slash");
  })

  $(document).on("click", "#btnpasssembunyi", function(){
    $("#password").attr("type","password");
    $("#btnpasssembunyi").attr("title","Tampilkan");
    $("#btnpasssembunyi").attr("id","btnpasslihat");
    $("#iconpass").attr("class","fa fa-eye");
  })
</script>