<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title"><?=$subjudul ?></h3>
    <a href="<?=base_url('pemasukan/tambah') ?>" class="btn btn-sm btn-primary btn-flat pull-right" title="Tambah"><i class="fa fa-plus"></i></a>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="table2" class="table table-bordered table-striped table-hover" width="100%">
      <thead>
        <tr>
          <th class="text-center" width="3%">NO</th>
          <th class="text-center" width="15%">TANGGAL</th>
          <th class="text-center">KETERANGAN</th>
          <th class="text-center" width="13%">JUMLAH (Rp)</th>
          <th class="text-center" width="8%">OPSI</th>
        </tr>
      </thead>
      <tbody>
        <?php $total = 0; if($pemasukan){ ?>
          <?php $no=1; foreach ($pemasukan as $msk): $total = $total+$msk['jumlah_masuk']; ?>
            <tr>
              <td class="text-center" style="vertical-align: middle;"><?=$no++ ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=tgl_indodate($msk['tgl_pemasukan']) ?></td>
              <td style="vertical-align: middle;"><?=$msk['keterangan'] ?></td>
              <td class="text-right" style="vertical-align: middle;"><?=number_format($msk['jumlah_masuk'], 0, ',', '.') ?></td>
              <td class="text-center" style="vertical-align: middle;">
                <a href="<?=base_url('pemasukan/ubah/'.$msk['id_pemasukan']) ?>" class="btn btn-sm btn-info btn-flat" title="Ubah"><i class="fa fa-edit"></i></a>
                <button type="button" class="btn btn-sm btn-danger btn-flat" id="hapuspemasukan" data-toggle="modal" data-target="#modalHapus" data-id="<?=$msk['id_pemasukan'] ?>" title="Hapus"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          <?php endforeach ?>
        <?php }else{ ?>
          <tr>
            <td class="text-center" style="vertical-align: middle;" colspan="5">Tidak ada data yang tersedia!</td>
          </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <tr>
          <th class="text-right" colspan="3">TOTAL (Rp)</th>
          <th class="text-right"><?=number_format($total, 0, ',', '.') ?></th>
          <th class="text-center">&nbsp;</th>
        </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->

<!-- MODAL HAPUS -->
<div class="modal fade" id="modalHapus">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="titlehapus">Hapus Pemasukan</h4>
      </div>
      <form id="formhapusmodal" action="" method="post">
        <div class="modal-body">
          <p class="text-center" id="ket">Anda yakin ingin menghapus data pemasukan ini?<br>Saldo Anda akan berkurang!</p>
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
  $(document).on("click", "#hapuspemasukan", function(){
    var id = $(this).data('id');
    $("#modalHapus #formhapusmodal").attr("action","pemasukan/hapus/"+id);
  })
</script>