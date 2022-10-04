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
         <!--  <a href="<?php echo base_url(). 'users/view_insert'?>" type="button" id="btn_to_action" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> <b>Tambah Data</b></a> -->
          <a href="" type="button" id="btn_to_action" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#userModal"><i class="fas fa-plus"></i> <b>Tambah Data</b></a>
      </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
	<div class="table-responsive">
	<table class="table table-bordered table-striped" id="datatable1" style="width:100%" >
        <thead>
        <tr>
      <th class="bg-default">NO</th>
			<th class="bg-default">NIP</th>
			<th class="bg-default">NIP2</th>
			<th class="bg-default">NAMA PEGAWAI</th>
      <th class="bg-default">ALIAS</th>
      <!-- <th class="bg-danger">PASSWORD</th> -->
      <!-- <th class="bg-danger">REAL PASSWORD</th> -->
      <th class="bg-default">AKSES</th>
      <th class="bg-default">AKTIF</th>
      <th class="bg-default">STAF</th>
      <th class="bg-default">STATUS</th>
      <th class="bg-default">ACTION</th>
		</tr>
         </thead>
         <tbody> 
           <?php
           $no=1;
           foreach ($data_users_nuklir as $data) {
           	?>
    <tr>
      <td class=""><?=$no++;?></td>
			<td class=""><?=$data->NIP?></td>
			<td class=""><?=$data->NIP2?></td>
			<td class=""><?=$data->NM_PEGAWAI?></td>
      <td class=""><?=$data->ALIAS?></td>
      <!-- <td class=""><?=$data->PASSWORD?></td> -->
      <!-- <td class=""><?=$data->REAL_PASSWORD?></td> -->
      <td class="">
        <?php if ($data->AKSES == 1 ) { ?>
          <span class="badge badge-success">ADMIN</span>
        <?php } else { ?>
          <span class="badge badge-warning">USER</span>
        <?php } ?>
      </td>
      <td class="">
        <?php if ($data->AKTIF == 1) { ?>
          <span class="badge badge-primary">AKTIF</span>
        <?php } else { ?>
          <span class="badge badge-danger">TIDAK AKTIF</span>
        <?php } ?>
      </td>
      <td class="">
        <?php if ($data->F_STAFF == 'Y') { ?>
          <span class="badge badge-primary">YA</span>
        <?php } else { ?>
          <span class="badge badge-danger">TIDAK</span>
        <?php } ?>
      </td>
      <td class=""><?=$data->STATUS?></td>
			<!-- <td class=""><?=$data->SHOW_IN_LIST?></td> -->
      <td class="">
        <!-- <?php echo anchor('users/view_update/' .$data->NIP, "<i class='nav-icon fas fa-edit'></i>"); ?> &nbsp;&nbsp;|&nbsp;&nbsp; <?php echo anchor('users/delete/' .$data->NIP, "<i class='nav-icon fas fa-trash'></i>"); ?> -->
        <a class="btn btn-info btn-xs" id="detail" data-toggle="modal" data-target="#detailModal" data-nip="<?=$data->NIP?>" data-nip2="<?=$data->NIP2?>" data-nama="<?=$data->NM_PEGAWAI?>" data-alias="<?=$data->ALIAS?>" data-akses="<?=$data->AKSES?>" data-aktif="<?=$data->AKTIF?>" data-staf="<?=$data->F_STAFF?>" data-status="<?=$data->STATUS?>"><i class="nav-icon fas fa-eye"></i></a> &nbsp;&nbsp;|
        &nbsp;&nbsp;<a class="btn btn-danger btn-xs" href="<?=base_url('users/delete/' .$data->NIP); ?>"><i class="nav-icon fas fa-trash"></i></a> &nbsp;&nbsp;|
        &nbsp;&nbsp;<a class="btn btn-primary btn-xs" href="<?=base_url('users/view_update/'.$data->NIP);?>"><i class="nav-icon fas fa-edit"></i></a>
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

<!-- MODAL INPUT USER -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Input Data User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo base_url("users/insert_user") ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                          <label for="inputError">NIP</label>
                          <input type="text" class="form-control <?=form_error('NIP') ? 'is-invalid' : null ?>" name="NIP" placeholder="Masukan NIP" value="<?=set_value('NIP'); ?>">
                          <?=form_error('NIP'); ?>
                      </div>
                </div>
                <div class="col-lg-6 col-md-6">
                      <div class="form-group">
                          <label for="exampleInputEmail1">ALIAS</label>
                          <input type="text" class="form-control <?=form_error('ALIAS') ? 'is-invalid' : null ?>" name="ALIAS" placeholder="Masukan ALIAS" value="<?=set_value('ALIAS'); ?>">
                          <?=form_error('ALIAS'); ?>
                      </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">AKSES</label>
                        <select class="form-control select"  name="AKSES">
                            <option value="">-- SELECT AKSES --</option> 
                            <option value=1>ADMIN</option>
                            <option value=2>STAFF</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">AKTIF</label>           
                        <select class="form-control select" name="AKTIF">
                            <option value="">-- SELECT AKTIF --</option>
                            <option value=1>AKTIF</option>
                            <option value=0>TIDAK AKTIF</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">STATUS</label>
                        <input type="text" class="form-control" name="STATUS" placeholder="Contoh : Dokter">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">STAF</label>
                        <select class="form-control select" name="STAF">
                            <option value="">-- SELECT STAF --</option>
                            <option value="Y">YA</option>
                            <option value="N">TIDAK</option>    
                        </select>
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
<!-- END MODAL INPUT USERS -->



<!-- MODAL DETAIL USERS -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-outline card-success">
    <!-- form start -->
    <form method="post" action="<?php echo base_url("users/update/" . $data->NIP) ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">NIP</label>
                        <input type="text" class="form-control" name="NIP" id="nip" value="<?=set_value('NIP'); ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">NIP2</label>
                        <input type="text" class="form-control" name="NIP2" id="nip2" value="<?=set_value('NIP2'); ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">NAMA PEGAWAI</label>
                        <input type="text" class="form-control" name="NM_PEGAWAI" id="nama_pegawai" value="<?=set_value('NM_PEGAWAI'); ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ALIAS</label>
                        <input type="text" class="form-control" name="ALIAS" id="alias" value="<?=set_value('ALIAS'); ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">AKSES</label>
                        <!-- <input type="text" class="form-control" id="exampleInputEmail1" name="REAL_PASSWORD" value="<?php echo $data_users_nuklir->AKSES; ?>" placeholder="Example : Z1"> -->
                        <select class="form-control select" id="akses" name="AKSES">
                            <option value="">-- SELECT AKSES --</option>
                            <?php foreach ($users_nuklir_akses as $data) { ?>
                            <?php
                                    $selected = "";
                                    if ($data->AKSES == $data_users_nuklir->AKSES) {
                                        $selected="selected";
                                    }
                            ?>
                            <option value="<?=set_value('$data->AKSES') ?>" <?= $selected ?> ><?php echo ($data->AKSES == 1) ? 'ADMIN' : 'USER' ; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">AKTIF</label>
                        <select class="form-control select" id="aktif" name="AKTIF">
                            <option value="">-- SELECT AKTIF --</option>
                            <?php foreach ($users_nuklir_aktif as $data) { ?>
                            <?php
                                    $selected = "";
                                    if ($data->AKTIF == $data_users_nuklir->AKTIF) {
                                        $selected = "selected";
                                    } 
                                ?>
                                <option value="<?php echo $data->AKTIF; ?>"  <?= $selected ?> ><?php echo ($data->AKTIF) ? 'YA' : 'TIDAK' ; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">STATUS</label>
                        <input type="text" class="form-control" id="status" name="STATUS" value="<?=set_value('STATUS'); ?>">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="exampleInputEmail1">STAFF</label>
                        <select class="form-control select" id="staf" name="F_STAFF">
                            <option value="">-- SELECT STAF --</option>
                            <?php foreach ($users_nuklir_staff as $data) { ?>
                                <?php
                                    $selected = "";
                                    if ($data->F_STAFF == $data_users_nuklir->F_STAFF) {
                                        $selected = "selected";
                                    } 
                                ?>
                                <option value="<?php echo $data->F_STAFF; ?>"  <?= $selected ?> ><?php echo ($data->F_STAFF) ? 'YA' : 'TIDAK' ; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Update Data</button>
    </div>
    </form>
      </div>
    </div>
  </div>
  
</div>
<!-- END MODAL DETAIL USERS -->


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
      var nip = $(this).data('nip');
      var nip2 = $(this).data('nip2');
      var nama = $(this).data('nama');
      var alias = $(this).data('alias');
      var akses = $(this).data('akses');
      var aktif = $(this).data('aktif');
      var staf = $(this).data('staf');
      var status = $(this).data('status');
      $('#nip').val(nip);
      $('#nip2').val(nip2);
      $('#nama_pegawai').val(nama);
      $('#alias').val(alias);
      $('#akses').val(akses);
      $('#aktif').val(aktif);
      $('#staf').val(staf);
      $('#status').val(status);
      $('#editModal').modal('hide');
    })
  })

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});
 

</script>

