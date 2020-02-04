<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Data <?=$subjudul ?></h3>
    <a href="<?=base_url('stok/keluar/tambah') ?>" class="btn btn-sm btn-primary btn-flat pull-right" title="Tambah"><i class="fa fa-plus"></i></a>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="table2" class="table table-bordered table-striped table-hover" width="100%">
      <thead>
        <tr>
          <th class="text-center" width="3%">NO</th>
          <th class="text-center" width="10%">KODE BARANG</th>
          <th>NAMA BARANG</th>
          <th class="text-center" width="7%">JUMLAH</th>
          <th class="text-center">KETERANGAN</th>
          <th class="text-center" width="15%">TANGGAL</th>
          <th class="text-center" width="5%">OPSI</th>
        </tr>
      </thead>
      <tbody>
        <?php if($stok){ ?>
          <?php $no=1; foreach ($stok as $stk): ?>
            <tr>
              <td class="text-center" style="vertical-align: middle;"><?=$no++ ?></td>
              <td style="vertical-align: middle;"><?=$stk['id_item'] ?></td>
              <td style="vertical-align: middle;"><?=$stk['nama_item'] ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=$stk['jumlah'] ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=$stk['detail'] ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=tgl_indodate($stk['tanggal']) ?></td>
              <td class="text-center" style="vertical-align: middle;">
                <button type="button" class="btn btn-sm btn-danger btn-flat" id="hapusstok" data-toggle="modal" data-target="#modalHapus" data-id_stok="<?=$stk['id_stok'] ?>" data-id_item="<?=$stk['id_item'] ?>" data-nama_item="<?=$stk['nama_item'] ?>" data-jumlah="<?=$stk['jumlah'] ?>" title="Hapus"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          <?php endforeach ?>
        <?php }else{ ?>
          <tr>
            <td class="text-center" style="vertical-align: middle;" colspan="7">Tidak ada data yang tersedia!</td>
          </tr>
        <?php } ?>
      </tbody>
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
        <h4 class="modal-title" id="titlehapus">Hapus Stok Masuk Barang</h4>
      </div>
      <form id="formhapusmodal" action="" method="post">
        <div class="modal-body">
          <input type="hidden" name="id_stok" id="id_stok">
          <input type="hidden" name="id_item" id="id_item">
          <input type="hidden" name="nama_item" id="nama_item">
          <input type="hidden" name="jumlah" id="jumlah">
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
  $(document).on("click", "#hapusstok", function(){
    var id_stok = $(this).data('id_stok');
    var id_item = $(this).data('id_item');
    var nama_item = $(this).data('nama_item');
    var jumlah = $(this).data('jumlah');
    $("#modalHapus #id_stok").val(id_stok);
    $("#modalHapus #id_item").val(id_item);
    $("#modalHapus #nama_item").val(nama_item);
    $("#modalHapus #jumlah").val(jumlah);
    $("#modalHapus #ket").html("Anda yakin ingin menghapus stok keluar "+nama_item+" sejumlah "+jumlah+" ?");
    $("#modalHapus #formhapusmodal").attr("action","<?=base_url() ?>stok/stok_keluar_hapus/"+id_stok);
  })
</script>