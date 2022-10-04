<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><?=$subtitle?></h3>
		<!-- <div class="float-sm-right">
			<select class="form-control">
				<option value=""> </option>
				<option value="">Test1</option>
			</select>
		</div> -->
		<div class="float-sm-right">
			<select class="form-control">
				<option value="">-- TAHUN --</option>
				<option value="">2016</option>
				<option value="">2017</option>
				<option value="">2018</option>
				<option value="">2019</option>
				<option value="">2020</option>
				<option value="">2021</option>
				<option value="">2022</option>
			</select>
		</div>
	</div>
<div class="card-body">
	<div class="table-responsive">
		<table class="table table-bordered table-striped" id="datatable1" style="width:100%">
			<thead>
				<tr>
					<th class="bg-default">NO</th>
					<th class="bg-default">ID JENIS LAYANAN</th>
					<th class="bg-default">TANGGAL KUNJUNGAN</th>
					<th class="bg-default">NO MEDREC</th>
					<th class="bg-default">NAMA PASIEN</th>
					<th class="bg-default">NAMA HASIL</th>
					<th class="bg-default">KADAR HASIL</th>
					<th class="bg-default">JENIS RF</th>
					<th class="bg-default">DOSIS RF</th>
					<th class="bg-default">ACTION</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no=1;
				foreach ($data_pemeriksaan_nuklir as $data) { ?>
				<tr> 
					<td class=""><?=$no++?></td>
					<td class=""><?=$data->ID_JNS_LAYANAN?></td>
					<td class=""><?=$data->TGL_KUNJUNGAN?></td>
					<td class=""><?=$data->NO_MEDREC?></td>
					<td class="">
						<?php if (strlen($data->NO_MEDREC)==10) { ?>
							<?php echo $data->NAMA ?>
						<?php } else { ?>
							<?php echo $data->NAMARI ?>
						<?php }?>
					</td>
					<td class=""><?=$data->NM_HASIL?></td>
					<td class=""><?=$data->KADAR_HASIL?></td>
					<td class=""><?=$data->JENIS_RF?></td>
					<td class=""><?=$data->DOSIS_RF?></td>
					<td class="">
						<?php echo anchor('hasil_nuklir/view_update/' .$data->NO_MEDREC, "<i class='nav-icon fas fa-edit'></i>"); ?> &nbsp;&nbsp;|
		        &nbsp;&nbsp; <?php echo anchor('Hasil_nuklir/cetakHasilPemeriksaanNuk/' . $data->NO_MEDREC . '/' . $data->TGL_KUNJUNGAN, "<i class='nav-icon fas fa-print'></i>"); ?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
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