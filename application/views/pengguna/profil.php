<div class="row">
  <div class="col-md-3">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <?php if($pengguna_masuk['foto']==null){ ?>
          <img class="profile-user-img img-responsive img-circle" src="<?=base_url('uploads/pengguna/user.png') ?>" alt="Foto <?=$pengguna_masuk['nama_lengkap'] ?>">
        <?php }else{ ?>
          <img class="profile-user-img img-responsive img-circle" src="<?=base_url('uploads/pengguna/').$pengguna_masuk['foto'] ?>" alt="Foto <?=$pengguna_masuk['nama_lengkap'] ?>">
        <?php } ?>
        <h3 class="profile-username text-center"><?=$pengguna_masuk['nama_lengkap'] ?></h3>
        <p class="text-muted text-center"><?=$pengguna_masuk['nama_level'] ?></p>
        <button type="button" id="keluar" data-toggle="modal" data-target="#modalKeluar" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-out"></i> Ganti Akun</button>
      </div>
    </div>

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Tentang Saya</h3>
      </div>
      <div class="box-body">
        <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
        <p class="text-muted"><?=$pengguna_masuk['email'] ?></p>
        <hr>
        <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat</strong>
        <p class="text-muted"><?=$pengguna_masuk['alamat'] ?></p>
        <hr>
        <strong><i class="fa fa-clock-o margin-r-5"></i> Aktif Sejak</strong>
        <p class="text-muted"><?=tgl_indolengkaptime($pengguna_masuk['tgl_masuk']) ?></p>
      </div>
    </div>
  </div>

  <div class="col-md-9">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#umum" data-toggle="tab">Umum</a></li>
        <!-- <li><a href="#foto" data-toggle="tab">Foto Profil</a></li> -->
      </ul>
      <div class="tab-content">
        <div class="active tab-pane" id="umum">
          <form class="form-horizontal" action="<?=base_url('pengguna/profil/').$pengguna_masuk['username'] ?>" method="post">
            <div class="form-group">
              <label for="username" class="col-sm-4 control-label">Nama Pengguna</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="username" name="username" placeholder="Nama Pengguna" value="<?=$pengguna_masuk['username'] ?>" readonly>
              </div>
            </div>
            <div class="form-group">
              <label for="password" class="col-sm-4 control-label">Kata Sandi</label>
              <div class="col-sm-6">
                <div class="input-group input-group-sm">
                  <input type="password" class="form-control" id="password" name="password" value="<?=$pengguna_masuk['password'] ?>">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat" title="Tampilkan" id="btnpasslihat"><i id="iconpass" class="fa fa-eye"></i></button>
                  </span>
                </div>
                <?php echo form_error('password', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="nama_lengkap" class="col-sm-4 control-label">Nama Lengkap</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required placeholder="Nama Lengkap" value="<?=$pengguna_masuk['nama_lengkap'] ?>" autofocus>
                <?php echo form_error('nama_lengkap', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-4 control-label">Email</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="email" name="email" required placeholder="Email" value="<?=$pengguna_masuk['email'] ?>">
                <?php echo form_error('email', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="alamat" class="col-sm-4 control-label">Alamat</label>
              <div class="col-sm-6">
                <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"><?=$pengguna_masuk['alamat'] ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="jk" class="col-sm-4 control-label">Jenis Kelamin</label>
              <div class="col-sm-6">
                <select class="form-control select2" id="jk" name="jk" style="width: 100%;">
                  <option value="">-- Pilih --</option>
                  <option value="Laki-Laki" <?php if($pengguna_masuk['jk']=="Laki-laki"){echo "selected";} ?>>Laki-Laki</option>
                  <option value="Perempuan" <?php if($pengguna_masuk['jk']=="Perempuan"){echo "selected";} ?>>Perempuan</option>
                </select>
                <?php echo form_error('jk', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="level" class="col-sm-4 control-label">Level</label>
              <div class="col-sm-6">
                <?php if($pengguna_masuk['level']==1){ ?>
                  <select class="form-control select2" id="level" name="level" style="width: 100%;">
                    <option value="">-- Pilih --</option>
                    <option value="1" <?php if($pengguna_masuk['level']=="1"){echo "selected";} ?>>Admin</option>
                    <option value="2" <?php if($pengguna_masuk['level']=="2"){echo "selected";} ?>>Pengguna</option>
                  </select>
                  <?php echo form_error('level', '<small class="text-danger margin-l-5" style="font-style:italic;"><i class="fa fa-fw fa-exclamation-triangle"></i> ', '</small>'); ?>
                <?php }else{ ?>
                  <select class="form-control select2" id="lvl" name="lvl" style="width: 100%;" disabled>
                    <option value="">-- Pilih --</option>
                    <option value="1" <?php if($pengguna_masuk['level']=="1"){echo "selected";} ?>>Admin</option>
                    <option value="2" <?php if($pengguna_masuk['level']=="2"){echo "selected";} ?>>Pengguna</option>
                  </select>
                  <input type="hidden" name="level" id="level" value="<?=$pengguna_masuk['level'] ?>">
                <?php } ?>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-6 text-right">
                <button type="submit" class="btn btn-primary btn-flat" name="ubahprofilumum"><i class="fa fa-save"></i> Simpan</button>
              </div>
            </div>
          </form>
        </div>

        <div class="tab-pane" id="foto">
          <form class="form-horizontal" action="<?=base_url('pengguna/ubah_profil/').$pengguna_masuk['username'] ?>" method="post" enctype="multipart/form-data">
            <div class="text-center" style="margin-bottom: 10px;">
              <?php if($pengguna_masuk['foto']==null){ ?>
                <img src="<?=base_url('uploads/pengguna/user.png') ?>" class="img-circle img-thumbnail" width="250px" alt="<?=$pengguna_masuk['nama_lengkap'] ?>">
              <?php }else{ ?>
                <img src="<?=base_url('uploads/pengguna/').$pengguna_masuk['foto'] ?>" class="img-circle img-thumbnail" width="250px" alt="<?=$pengguna_masuk['nama_lengkap'] ?>">
              <?php } ?>
            </div>
            <div class="form-group">
              <label for="fotoprofil" class="col-sm-4 control-label">Foto Profil</label>
              <div class="col-sm-6">
                <input type="file" class="form-control" id="fotoprofil" name="fotoprofil">
                <span class="text-primary"><small>*Kosongkan jika tidak ingin mengganti foto profil!</small></span>
                <br>
                <span class="text-primary"><small>*pilih format file .png, .jpg, .jpeg, .gif!</small></span>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-6 text-right">
                <button type="submit" class="btn btn-primary btn-flat" name="ubahprofilfoto"><i class="fa fa-save"></i> Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
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