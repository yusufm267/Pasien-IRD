<form method="post" action="<?= base_url('Hasil_nuklir/simpanHasilPemeriksaan') ?>">

<table class="table table-bordered table-striped text-center">
	<thead>
		<tr>
			<th colspan="3">PEMERIKSAAN</th>
			<th>NAMA HASIL</th>
			<th>KADAR HASIl</th>
			<th>KADAR NORMAL</th>
			<th>JENIS RF</th>
			<th>DOSIS RF</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($hasil as $hs) { ?>
			<tr>
				<td>
					<?= $hs->ID_JNS_LAYANAN ?>
					<input type="hidden" name="id_jenis_layanan[]" value="<?= $hs->ID_JNS_LAYANAN ?>">
					<input type="hidden" name="no_medrec[]" value="<?= $hs->NO_MEDREC ?>">
					<input type="hidden" name="tgl_kunjungan[]" value="<?= $hs->TGL_KUNJUNGAN ?>">
					

				</td>
				<td><?= $hs->NM_LAYANAN?></td>
				<td><?= $hs->KELOMPOK_NUK?></td>
				<td>
					<input type="text" name="nm_hasil[]" class="form-control searchHasil namaHasil-<?= $hs->ID_JNS_LAYANAN ?>"  value="<?= $hs->NM_HASIL ?>" data-id="<?= $hs->ID_JNS_LAYANAN ?>" autocomplete="off">
					<ul class="dropdown-menu txtHasil" style="margin-top:500px;margin-left:345px;margin-right:0px;padding-left:5px;padding-right:5px;" role="menu" aria-labelledby="dropdownMenu" id="DropdownHasil"></ul>
				</td>
				<td>
					<input type="text" name="kadar_hasil[]" class="form-control kadarHasil-<?= $hs->ID_JNS_LAYANAN ?>" value="<?= $hs->KADAR_HASIL ?>" autocomplete="off">
				</td>
				<td>
					<input type="text" name="kadar_normal[]" class="form-control kadarNormal-<?= $hs->ID_JNS_LAYANAN ?>" value="" readonly>
				</td>
				<td>
					<input type="text" name="jenis_rf[]" class="form-control searchJenis namaJenis-<?= $hs->ID_JNS_LAYANAN ?>" value="<?= $hs->JENIS_RF ?>" data-wawat="value" data-id="<?= $hs->ID_JNS_LAYANAN?>" autocomplete="off">
					<ul class="dropdown-menu txtJenis" style="margin-top:500px;margin-left:1000px;margin-right:-770px;padding-left:5px;padding-right:5px;" role="menu" aria-labelledby="dropdownMenu" id="DropdownJenis"></ul>	
				</td>
				<td>
					<input type="text" name="dosis_rf[]" class="form-control" value="<?= $hs->DOSIS_RF ?>">
				</td>
			</tr>
		

		<?php } ?>
		
		
	</tbody>
</table>
<button class="btn btn-primary" type="submit">Insert</button>
</form>

<script type="text/javascript">
	$(".searchHasil").keyup(function() {
	var base_url='<?=base_url()?>';
	let idnya = $(this).data("id");
	$(this).data("wawat");
	// alert('test');abc
	$.ajax({
		type: "POST",
		url: base_url+"Hasil_nuklir/getNamaHasilAutoComplete",
		data: {
			keyword: $(this).val().trim()
		},
		dataType: "json",
		success: function (data) {

			if (data.length > 0) {
				$('#DropdownHasil').empty();
				$('#DropdownHasil').dropdown('toggle');
				$('#DropdownHasil').show();
			}
			else if (data.length == 0) {

			}

			$.each(data, function(key,value){
				if (data.length >= 0)
					$('#DropdownHasil').append('<li role="displayCountries"><a  onclick="getValue(\''+idnya+'\', \''+value['NM_HASIL']+'\', \''+value['KADAR_NORMAL']+'\')" role="menuitem" dropdownCountryli" class="dropdownlivalue" style="color:black;" data-nama="'+value['NM_HASIL']+'" data-kadar="'+value['KADAR_NORMAL']+'"  data-id="'+idnya+'"  >' + value['ID_JENIS'] +' - '+value['NM_HASIL']+' - '+value['KADAR_NORMAL']+'</a></li>');
			});
		}
	});
});

function getValue(id, nama, kadar) {
	$('.namaHasil-'+id).val(nama);
	$('.kadarNormal-'+id).val(kadar);

	$('#DropdownHasil').hide();
}

	$(".searchJenis").keyup(function() {
	var base_url='<?=base_url()?>';
	let jenisnya = $(this).data("id");
	// alert('test');abc
	$.ajax({
		type: "POST",
		url: base_url+"Hasil_nuklir/getJenisRfAutoComplete",
		data: {
			keyword: $(this).val().trim()
		},
		dataType: "json",
		success: function (data) {

			if (data.length > 0) {
				$('#DropdownJenis').empty();
				$('#DropdownJenis').dropdown('toggle');
				$('#DropdownJenis').show();
			}
			else if (data.length == 0) {

			}

			$.each(data, function(key,value){
				if (data.length >= 0)
					$('#DropdownJenis').append('<li role="displayCountries"><a onclick="getValueJenis(\''+jenisnya+'\', \''+value['JENIS_RF']+'\')" role="menuitem" dropdownCountryli" class="dropdownlivalue" style="color:black;" data-jenis="'+value['JENIS_RF']+'" data-id="'+jenisnya+'"  >' + value['JENIS_RF'] +' </a></li>');
			});
		}
	});
});

function getValueJenis(id,jenis) {
	$('.namaJenis-'+id).val(jenis);

	$('#DropdownJenis').hide();
}
	
</script>