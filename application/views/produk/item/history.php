<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">History Stok <?=$item['nama_item'] ?></h3>
    <a href="<?=base_url('item') ?>" class="btn btn-sm btn-danger btn-flat pull-right" title="Kembali"><i class="fa fa-times"></i></a>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="table2" class="table table-bordered" width="100%">
      <thead>
        <tr>
          <th class="text-center" width="3%">NO</th>
          <th class="text-center" width="15%">TANGGAL</th>
          <th class="text-center" width="5%">STOK</th>
          <th class="text-center" width="8%">JUMLAH</th>
          <th class="text-center">KETERANGAN</th>
          <th class="text-center">SUPPLIER</th>
          <th class="text-center"width="15%">PENGGUNA</th>
        </tr>
      </thead>
      <tbody>
        <?php if($stok){ ?>
          <?php $no=1; foreach ($stok as $stk): ?>
            <tr class="<?php if($stk['tipe']=='masuk'){echo 'bg-success';}else{echo 'bg-danger';} ?>">
              <td class="text-center" style="vertical-align: middle;"><?=$no++ ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=tgl_indodate($stk['tanggal']) ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=ucfirst($stk['tipe']) ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=$stk['jumlah'] ?> <?=$item['nama_unit'] ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=$stk['detail'] ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=$stk['nama'] ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=$stk['nama_lengkap'] ?></td>
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
        <h4 class="modal-title" id="titlehapus">Hapus Item Barang</h4>
      </div>
      <form id="formhapusmodal" action="" method="post">
        <div class="modal-body">
          <input type="hidden" name="nama_item" id="nama_item">
          <input type="hidden" name="gambar_item" id="gambar_item">
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
  $(document).on("click", "#hapusitem", function(){
    var id = $(this).data('id');
    var nama_item = $(this).data('nama_item');
    var gambar_item = $(this).data('gambar_item');
    $("#modalHapus #nama_item").val(nama_item);
    $("#modalHapus #gambar_item").val(gambar_item);
    $("#modalHapus #ket").html("Anda yakin ingin menghapus barang "+nama_item+"?");
    $("#modalHapus #formhapusmodal").attr("action","item/hapus/"+id);
  })
</script>