<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Data <?=$subjudul ?></h3>
    <a href="<?=base_url('unit/tambah') ?>" class="btn btn-sm btn-primary btn-flat pull-right" title="Tambah"><i class="fa fa-plus"></i></a>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="table2" class="table table-bordered table-striped table-hover" width="100%">
      <thead>
        <tr>
          <th class="text-center" width="3%">NO</th>
          <th>SATUAN</th>
          <th class="text-center" width="8%">OPSI</th>
        </tr>
      </thead>
      <tbody>
        <?php if($unit){ ?>
          <?php $no=1; foreach ($unit as $ktg): ?>
            <tr>
              <td class="text-center" style="vertical-align: middle;"><?=$no++ ?></td>
              <td style="vertical-align: middle;"><?=$ktg['nama_unit'] ?></td>
              <td class="text-center" style="vertical-align: middle;">
                <a href="<?=base_url('unit/ubah/'.$ktg['id_unit']) ?>" class="btn btn-sm btn-info btn-flat" title="Ubah"><i class="fa fa-edit"></i></a>
                <button type="button" class="btn btn-sm btn-danger btn-flat" id="hapusunit" data-toggle="modal" data-target="#modalHapus" data-id="<?=$ktg['id_unit'] ?>" data-nama_unit="<?=$ktg['nama_unit'] ?>" title="Hapus"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          <?php endforeach ?>
        <?php }else{ ?>
          <tr>
            <td class="text-center" style="vertical-align: middle;" colspan="3">Tidak ada data yang tersedia!</td>
          </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th class="text-center">NO</th>
          <th>SATUAN</th>
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
        <h4 class="modal-title" id="titlehapus">Hapus Unit</h4>
      </div>
      <form id="formhapusmodal" action="" method="post">
        <div class="modal-body">
          <input type="hidden" name="nama_unit" id="nama_unit">
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
  $(document).on("click", "#hapusunit", function(){
    var id = $(this).data('id');
    var nama_unit = $(this).data('nama_unit');
    $("#modalHapus #nama_unit").val(nama_unit);
    $("#modalHapus #ket").html("Anda yakin ingin menghapus satuan "+nama_unit+"?");
    $("#modalHapus #formhapusmodal").attr("action","unit/hapus/"+id);
  })
</script>