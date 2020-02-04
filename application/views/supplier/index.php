<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Data <?=$subjudul ?></h3>
    <a href="<?=base_url('supplier/tambah') ?>" class="btn btn-sm btn-primary btn-flat pull-right" title="Tambah"><i class="fa fa-plus"></i></a>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="table2" class="table table-bordered table-striped table-hover" width="100%">
      <thead>
        <tr>
          <th class="text-center" width="3%">NO</th>
          <th class="text-center">NAMA</th>
          <th class="text-center" width="20%">KONTAK</th>
          <th class="text-center">ALAMAT</th>
          <th class="text-center">DESKRIPSI</th>
          <th class="text-center" width="8%">OPSI</th>
        </tr>
      </thead>
      <tbody>
        <?php if($supplier){ ?>
          <?php $no=1; foreach ($supplier as $sp): ?>
            <tr>
              <td class="text-center" style="vertical-align: middle;"><?=$no++ ?></td>
              <td style="vertical-align: middle;"><?=$sp['nama'] ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=$sp['telpon'] ?><br><?=$sp['email'] ?></td>
              <td style="vertical-align: middle;"><?=$sp['alamat'] ?></td>
              <td style="vertical-align: middle;"><?=$sp['deskripsi'] ?></td>
              <td class="text-center" style="vertical-align: middle;">
                <a href="<?=base_url('supplier/ubah/'.$sp['id_supplier']) ?>" class="btn btn-sm btn-info btn-flat" title="Ubah"><i class="fa fa-edit"></i></a>
                <button type="button" class="btn btn-sm btn-danger btn-flat" id="hapussupplier" data-toggle="modal" data-target="#modalHapus" data-id="<?=$sp['id_supplier'] ?>" data-nama="<?=$sp['nama'] ?>" title="Hapus"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          <?php endforeach ?>
        <?php }else{ ?>
          <tr>
            <td class="text-center" style="vertical-align: middle;" colspan="6">Tidak ada data yang tersedia!</td>
          </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th class="text-center">NO</th>
          <th class="text-center">NAMA</th>
          <th class="text-center">KONTAK</th>
          <th class="text-center">ALAMAT</th>
          <th class="text-center">DESKRIPSI</th>
          <th class="text-center">OPSI</th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->

<!-- MODAL HAPUS -->
<div class="modal fade" id="modalHapus">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="titlehapus">Hapus Supplier</h4>
      </div>
      <form id="formhapusmodal" action="" method="post">
        <div class="modal-body">
          <input type="hidden" name="nama" id="nama">
          <p class="text-center" id="ket">Anda yakin ingin menghapus?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-flat btn-sm pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
          <button type="submit" class="btn btn-danger btn-flat btn-sm"><i class="fa fa-trash"></i> Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="<?php echo base_url() ?>assets/bower_components/jquery/jquery-1.10.2.js"></script>
<script type="text/javascript">
  $(document).on("click", "#hapussupplier", function(){
    var id = $(this).data('id');
    var nama = $(this).data('nama');
    $("#modalHapus #nama").val(nama);
    $("#modalHapus #ket").html("Anda yakin ingin menghapus "+nama+"?");
    $("#modalHapus #formhapusmodal").attr("action","supplier/hapus/"+id);
  })
</script>