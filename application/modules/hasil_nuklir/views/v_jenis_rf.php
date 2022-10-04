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
		<a href="" type="button" id="btn_to_action" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#insertModal"><i class="fas fa-plus"></i><b> Tambah Data</b></a>
		</div>
	</div>


<div class="card-body">
	<div class="table-responsive">
		<table class="table table-bordered table-striped" id="datatable1" style="width:100%">
			<thead>
				<tr>
					<th>NO</th>
					<th class="bg-default">JENIS RF</th>
					<th class="bg-default">ACTION</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				foreach ($data_jenis_rf as $rf) {
				?>
				<tr>
					<td class=""><?=$no++;?></td>
					<td class=""><?=$rf->JENIS_RF?></td>
					<td>
						<?php echo anchor('hasil_nuklir/view_update_jenis_rf/' .$rf->JENIS_RF, "<i class='nav-icon fas fa-edit'></i>"); ?> &nbsp;&nbsp;|
        				&nbsp;&nbsp; <?php echo anchor('hasil_nuklir/delete_jenis_rf/' .$rf->JENIS_RF, "<i class='nav-icon fas fa-trash'></i>"); ?>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
</div>

<!-- MODAL INPUT JENIS RADIO FARMA -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Input Jenis Radiofarma</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

				<form method="post" action="<?php echo base_url("hasil_nuklir/insert_jenis_rf") ?>">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>JENIS RADIOFARMA</label>
									<input type="text" class="form-control" name="JENIS_RF" placeholder="Masukan Jenis RF">
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
</script>