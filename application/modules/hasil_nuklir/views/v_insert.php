<!-- general form elements -->
<div class="card card-outline card-primary">
	<!-- START card-header -->
	<div class="card-header">
		<h3 class="card-title">Tambah Hasil Jenis Nuklir</h3>
	</div>
	<!-- END card-header -->

	<!-- FORM START -->
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
		<div class="card-footer">
			<button type="submit" class="btn btn-primary">Insert Data</button>
			<button type="reset" class="btn btn-default">Reset</button>
			<div class="float-sm-right">
				<a href="<?php echo base_url().'hasil_nuklir/' ?>" type="button" id="btn_to_action" class="btn btn-danger"><b>Back</b></a>
			</div>
		</div>
	</form>
	
</div>