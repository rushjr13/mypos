<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Data Pengguna</h3>
    <a href="<?=base_url('pengguna/tambah') ?>" class="btn btn-primary btn-flat btn-sm pull-right"><i class="fa fa-user-plus"></i> Tambah Pengguna</a>
  </div>
</div>

<div class="row">
  <?php foreach ($pengguna as $user): ?>
    <?php
      if($user['status_pengguna']=='Aktif'){
        $warna = 'primary';
        $warna_sts = 'danger';
        $icon = 'fa fa-power-off';
        $title = 'Non-Aktifkan';
        $status_pengguna = 'Tidak Aktif';
      }else{
        $warna = 'danger';
        $warna_sts = 'primary';
        $icon = 'fa fa-check';
        $title = 'Aktifkan';
        $status_pengguna = 'Aktif';
      }
    ?>
    <div class="col-md-3">
      <div class="box box-<?=$warna ?>">
        <div class="box-body box-profile">
          <?php if($user['foto']!=null){ ?>
            <img class="profile-user-img img-responsive img-circle" src="<?=base_url('uploads/pengguna/'.$user['foto']) ?>" alt="Foto <?=$user['nama_lengkap'] ?>">
          <?php }else{ ?>
            <img class="profile-user-img img-responsive img-circle" src="<?=base_url('uploads/pengguna/user.png') ?>" alt="Foto <?=$user['nama_lengkap'] ?>">
          <?php } ?>
          <h3 class="profile-username text-center"><?=$user['nama_lengkap'] ?></h3>
          <p class="text-muted text-center"><?=$user['nama_level'] ?></p>
          <p class="text-muted text-center"><?=$user['email'] ?></p>
          <p class="text-muted text-center"><?=tgl_indolengkaptime($user['tgl_masuk']) ?></p>
          <div class="text-center">
            <div class="btn-group">
              <a href="<?=base_url('pengguna/ubah/'.$user['username']) ?>" class="btn btn-<?=$warna ?>" title="Ubah"><i class="fa fa-edit"></i></a>
              <button type="button" class="btn btn-<?=$warna ?>" title="<?=$title ?>" id="tblstatuspengguna"  data-toggle="modal" data-target="#modalStatus" data-username="<?=$user['username'] ?>" data-nama="<?=$user['nama_lengkap'] ?>" data-status_pengguna="<?=$status_pengguna ?>" data-ket="<?=$title ?>" data-icon="<?=$icon ?>" data-warna="btn btn-<?=$warna_sts ?>"><i class="<?=$icon ?>"></i></button>
              <button type="button" id="tblhapuspengguna"  data-toggle="modal" data-target="#modalHapus" data-username="<?=$user['username'] ?>" data-nama="<?=$user['nama_lengkap'] ?>" class="btn btn-<?=$warna ?>" title="Hapus"><i class="fa fa-trash"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</div>

<!-- MODAL STATUS -->
<div class="modal fade" id="modalStatus">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="titlestatus">Ganti Status</h4>
      </div>
      <form id="formstatusmodal" action="" method="post">
        <div class="modal-body">
          <input type="hidden" name="nama_lengkap" id="nama_lengkap">
          <input type="hidden" name="sts_pengguna" id="sts_pengguna">
          <input type="hidden" name="ket_status" id="ket_status">
          <p class="text-center" id="ket">Anda yakin ingin keluar dari aplikasi?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="" id="tblsts"><i id="iconstatusmodal" class=""></i> <span id="tblstatusmodal">tbl</span></button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL HAPUS -->
<div class="modal fade" id="modalHapus">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="titlehapus">Hapus Pengguna</h4>
      </div>
      <form id="formhapusmodal" action="" method="post">
        <div class="modal-body">
          <input type="hidden" name="nama_lengkap" id="nama_lengkap">
          <p class="text-center" id="ket">Anda yakin ingin menghapus?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url() ?>assets/bower_components/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript">
  $(document).on("click", "#tblstatuspengguna", function(){
    var username = $(this).data('username');
    var nama = $(this).data('nama');
    var status_pengguna = $(this).data('status_pengguna');
    var ket = $(this).data('ket');
    var icon = $(this).data('icon');
    var warna = $(this).data('warna');
    $("#modalStatus #titlestatus").html("Ganti Status "+nama);
    $("#modalStatus #nama_lengkap").val(nama);
    $("#modalStatus #sts_pengguna").val(status_pengguna);
    $("#modalStatus #ket_status").val(ket);
    $("#modalStatus #ket").html(ket+" "+nama);
    $("#modalStatus #iconstatusmodal").attr("class",icon);
    $("#modalStatus #tblsts").attr("class",warna);
    $("#modalStatus #tblstatusmodal").html(ket);
    $("#modalStatus #formstatusmodal").attr("action","pengguna/status/"+username);
  })

  $(document).on("click", "#tblhapuspengguna", function(){
    var username = $(this).data('username');
    var nama = $(this).data('nama');
    $("#modalHapus #titlehapus").html("Anda yakin ingin menghapus "+nama+"?");
    $("#modalHapus #nama_lengkap").val(nama);
    $("#modalHapus #formhapusmodal").attr("action","pengguna/hapus/"+username);
  })
</script>