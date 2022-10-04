<?php
  if ($this->session->userdata('message'))
  {
    echo "<script>showSwal('".($this->session->userdata('message')['type'])."','".($this->session->userdata('message')['message'])."','".($this->session->userdata('message')['head'])."');</script>";
  }
?>

<div class="card card-outline card-primary">
  <div class="card-header">
      <h3 class="card-title"><?=$subtitle?></h3>
      <div class="float-sm-right">
          <!-- <button type="button" id="btn_call_search" class="btn btn-success btn-sm"><i class="fas fa-search"></i> Pencarian</button> -->
          <!-- <a href="<?php echo base_url(). 'hasil_nuklir/view_insert'?>" type="button" id="btn_to_action" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> <b>Tambah Data</b></a> -->
          <a href="" type="button" id="btn_to_action" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#insertModal"><i class="fas fa-plus"></i> <b>Tambah Data</b></a>
      </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
	<div class="table-responsive">
	<table class="table table-bordered table-striped" id="datatable1" style="width:100%" >
        <thead>
        <tr>
      <th class="bg-default">NO</th>
			<th class="bg-default">NAMA HASIL</th>
			<th class="bg-default">KADAR NORMAL</th>
			<th class="bg-default">SATUAN</th>
      <th class="bg-default">ACTION</th>
		</tr>
         </thead>
         <tbody> 
           <?php
           $no=1;
           foreach ($data_hasil_nuklir as $data) {
           	?>
    <tr>
      <td class=""><?=$no++;?></td>
			<td class=""><?=$data->NM_HASIL?></td>
			<td class=""><?=$data->KADAR_NORMAL?></td>
			<td class=""><?=$data->SATUAN?></td>
      <td class="">
        <!-- <?php echo anchor('hasil_nuklir/view_update/' .$data->ID_JENIS, "<i class='nav-icon fas fa-edit' data-toggle='modal' data-target='#exampleModal'></i>"); ?> &nbsp;&nbsp;|
        &nbsp;&nbsp; <?php echo anchor('hasil_nuklir/delete/' .$data->ID_JENIS, "<i class='nav-icon fas fa-trash'></i>"); ?> &nbsp;&nbsp;|
        &nbsp;&nbsp; <?php echo anchor('hasil_nuklir/cetakJenisHasilPemeriksaan/' .$data->ID_JENIS, "<i class='nav-icon fas fa-file'></i>"); ?> &nbsp;&nbsp;| -->
        <a class="btn btn-info btn-xs" id="detail" data-toggle="modal" data-target="#detailModal" data-nama="<?=$data->NM_HASIL?>" data-kadar="<?=$data->KADAR_NORMAL?>" data-satuan="<?=$data->SATUAN?>"><i class="fas fa-eye"></i></a> &nbsp;&nbsp;|
        &nbsp;&nbsp; <a class="btn btn-danger btn-xs" href="<?=base_url('hasil_nuklir/delete/' .$data->ID_JENIS) ?>"><i class="fas fa-trash"></i></a> &nbsp;&nbsp;|
        &nbsp;&nbsp; <a class="btn btn-default btn-xs" href="<?=base_url('hasil_nuklir/cetakJenisHasilPemeriksaan/' .$data->ID_JENIS) ?>" onClick="clickMe(this)" id="clicks"><i class="fas fa-print"></i></a>
        <span class="show"></span>
      </td>
		</tr>
           	<?php
           }
           ?>
         </tbody>
   	</table>
    </div>
  </div>
  <!-- /.card-body -->
</div>

<!-- MODAL INPUT JENIS HASIL NUKLIR -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Input Jenis Hasil Pemeriksaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url("hasil_nuklir/insert") ?>">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label>NAMA HASIL</label>
                  <input type="text" class="form-control" name="NM_HASIL" placeholder="Masukan Nama Hasil" value="<?=set_value('NM_HASIL'); ?>">
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label>KADAR NORMAL</label>
                  <input type="text" class="form-control" name="KADAR_NORMAL" placeholder="Masukan Kadar Normal" value="<?=set_value('KADAR_NORMAL'); ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label>SATUAN</label>
                  <input type="text" class="form-control" name="SATUAN" placeholder="Masukan Satuan" value="<?=set_value('SATUAN'); ?>">
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label>ID JENIS PEMERIKSAAN</label>
                  <input type="text" class="form-control" name="ID_JNS_PEMERIKSAAN" placeholder="Masukan ID Jenis Pemeriksaan" value="<?=set_value('ID_JNS_PEMERIKSAAN'); ?>">
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Insert Data</button>
        <button type="reset" class="btn btn-default">Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- END MODAL INPUT JENIS HASIL NUKLIR -->


<!-- MODAL EDIT JENIS HASIL NUKLIR -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Hasil Pemeriksaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url("hasil_nuklir/update/" . $data->ID_JENIS) ?>">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label>NAMA HASIL</label>
                  <input type="text" class="form-control" name="NM_HASIL" placeholder="Masukan Nama Hasil" id="nama_hasil" value="<?=set_value('NM_HASIL'); ?>">
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label>KADAR NORMAL</label>
                  <input type="text" class="form-control" name="KADAR_NORMAL" placeholder="Masukan Kadar Normal" id="kadar_normal" value="<?=set_value('KADAR_NORMAL'); ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label>SATUAN</label>
                  <input type="text" class="form-control" name="SATUAN" placeholder="Masukan Satuan" id="satuan" value="<?=set_value('SATUAN'); ?>">
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label>ID JENIS PEMERIKSAAN</label>
                  <input type="text" class="form-control" name="ID_JNS_PEMERIKSAAN" placeholder="Masukan ID Jenis Pemeriksaan" value="<?=set_value('ID_JNS_PEMERIKSAAN'); ?>">
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Data</button>
        <button type="reset" class="btn btn-default">Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>
  </div>
</div>
<!-- END MODAL EDIT JENIS HASIL NUKLIR -->

<script>
  $(function () {
    $("#datatable1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#datatable1_wrapper .col-md-6:eq(0)');
    $('#datatable2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });


  $(document).ready(function(){
    $(document).on('click','#detail',function(){
      var nama = $(this).data('nama');
      var kadar = $(this).data('kadar');
      var satuan = $(this).data('satuan');
      $('#nama_hasil').val(nama);
      $('#kadar_normal').val(kadar);
      $('#satuan').val(satuan);
      $('#editModal').modal('hide');
    })
  })

  var counter=0;
function count()
{
 $(".show").html(counter);
}
 $('.btn').on('click',function(){
      counter++
      count();
 })
</script>