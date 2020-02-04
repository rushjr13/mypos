<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Data <?=$subjudul ?></h3>
    <a href="<?=base_url('item/tambah') ?>" class="btn btn-sm btn-primary btn-flat pull-right" title="Tambah"><i class="fa fa-plus"></i></a>
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive">
    <table id="table2" class="table table-bordered table-striped table-hover" width="100%">
      <thead>
        <tr>
          <th class="text-center" width="3%">NO</th>
          <th class="text-center" width="6%">GAMBAR</th>
          <th>NAMA BARANG</th>
          <th class="text-center" width="10%">KATEGORI</th>
          <th class="text-center" width="9%">STOK</th>
          <th class="text-center" width="10%">HARGA</th>
          <th class="text-center" width="8%">OPSI</th>
        </tr>
      </thead>
      <tbody>
        <?php if($item){ ?>
          <?php $no=1; foreach ($item as $itm): ?>
            <tr>
              <td class="text-center" style="vertical-align: middle;"><?=$no++ ?></td>
              <td class="text-center" style="vertical-align: middle;">
                <?php if($itm['gambar_item']){ ?>
                  <img src="<?=base_url('uploads/item/'.$itm['gambar_item']) ?>" class="img img-thumbnail" width="100%">
                <?php }else{echo '<small class="text-muted">No Image</small>';} ?>
              </td>
              <td style="vertical-align: middle;"><?=$itm['nama_item'] ?></td>
              <td class="text-center" style="vertical-align: middle;"><?=$itm['nama_kategori'] ?></td>
              <td class="text-center" style="vertical-align: middle;">
                <a href="<?=base_url('item/history/'.$itm['id_item']) ?>" class="btn btn-sm btn-flat btn-success" title="History">
                  <?=$itm['stok'] ?> <?=$itm['nama_unit'] ?>
                </a>
              </td>
              <td class="text-right" style="vertical-align: middle;">Rp. <?=number_format($itm['harga_jual'], 0,',', '.') ?>,-</td>
              <td class="text-center" style="vertical-align: middle;">
                <a href="<?=base_url('item/ubah/'.$itm['id_item']) ?>" class="btn btn-sm btn-info btn-flat" title="Ubah"><i class="fa fa-edit"></i></a>
                <button type="button" class="btn btn-sm btn-danger btn-flat" id="hapusitem" data-toggle="modal" data-target="#modalHapus" data-id="<?=$itm['id_item'] ?>" data-nama_item="<?=$itm['nama_item'] ?>" data-gambar_item="<?=$itm['gambar_item'] ?>" title="Hapus"><i class="fa fa-trash"></i></button>
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
          <th class="text-center">GAMBAR</th>
          <th>NAMA BARANG</th>
          <th class="text-center">KATEGORI</th>
          <th class="text-center">STOK</th>
          <th class="text-center">HARGA</th>
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