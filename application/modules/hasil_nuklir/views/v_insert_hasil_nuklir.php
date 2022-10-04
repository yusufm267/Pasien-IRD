<?php
  if ($this->session->userdata('message'))
  {
    echo "<script>showSwal('".($this->session->userdata('message')['type'])."','".($this->session->userdata('message')['message'])."','".($this->session->userdata('message')['head'])."');</script>";
  }
?>



<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><?=$subtitle?></h3>
	</div>
	<form method="POST" action="">
	<div class="card-body">
		<div class="row">
			<div class=" col-lg-12 col-md-12">
				<div class="info-box box-light">
					<div class="info-box-content">
						<span class="info-box-text text-center text-muted">PENGISIAN HASIL PEMERIKSAAN KEDOKTERAN NUKLIR</span>
						<span class="info-box-number text-center text-muted">NO MEDREC : 10 Digit (Pasien Instalasi Rawat Jalan) <br> NO IPD : 8 Digit (Pasien Instalasi Rawat Inap)</span>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<label>NO MEDREC</label>
					<input type="number" class="form-control" name="medrec" placeholder="NO MEDREC" id="medrec" autocomplete="off">
					<ul class="dropdown-menu txtnik" style="margin-top: -85px;margin-left:10px;margin-right:0px;padding-left:10px;padding-right:10px;" role="menu" aria-labelledby="dropdownMenu" id="DropdownMedrec"></ul>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<label>NAMA PASIEN</label>
					<input type="text" class="form-control" name="nama" placeholder="NAMA PASIEN" id="nama" readonly>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<label>UMUR PASIEN</label>
					<input type="text" class="form-control" name="umur" placeholder="UMUR PASIEN" id="umur" readonly>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<div class="form-group">
					<label>TANGGAL LAHIR PASIEN</label>
					<input type="text" class="form-control" name="tgl_lahir" placeholder="TANGGAL LAHIR" id="tgl_lahir" readonly>
				</div>
			</div>
			<div class="col-lg-3 col-md-3">
				<label>TANGGAL KUNJUNGAN</label>
				<input type="date" class="form-control" value="<?php echo date('Y-m-d')?>" name="" placeholder="TANGGAL KUNJUNGAN" id="tanggal_kunjungan">
			</div>
			<div class="col-lg-3 col-md-3">
				<label>DOKTER PENGIRIM</label>
				<input type="text" class="form-control" name="" placeholder="DOKTER PENGIRIM">
			</div>
			<div class="col-lg-3 col-md-3">
				<label>DOKTER PERIKSA</label>
				<input type="text" class="form-control" value="" name="dokter_periksa" placeholder="DOKTER PERIKSA" id="dokter_periksa" autocomplete="off">
				<ul class="dropdown-menu txtDok" style="margin-top: -85px;margin-left:10px;margin-right:0px;padding-left:10px;padding-right:10px;" role="menu" aria-labelledby="dropdownMenu" id="DropdownDokter"></ul>
			</div>
			<div class="col-lg-3 col-md-3">
				<label>PENGETIK HASIL</label>
				<input type="text" class="form-control" value="<?php echo $this->session->userdata('alias')?>" name="pengetik_hasil" placeholder="PENGETIK HASIL" readonly>
			</div>
		</div>
	</div>
	<!-- <div class="card-footer">
		<button type="submit" class="btn btn-primary">Insert Data</button>
		<button type="reset" value="Reset" class="btn btn-default">Reset</button>
			<div class="float-right">
				<a href="<?php echo base_url(). 'dashboard/'?>" type="button" id="btn_to_action" class="btn btn-danger">Back</a>
			</div>
	</div> -->
	<!-- </form> -->
</div>

<!-- <div class="card card-outline card-danger">
	<div class="card-header">
		<h3 class="card-title">HASIL PEMERIKSAAN NUKLIR</h3>
	</div>

	<div class="card-body">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<table class="table-bordered table-striped" id="main_table" style="width:100%">
					<thead>
						<th class="bg-danger text-center" colspan="3">PEMERIKSAAN</th>
						<th class="bg-danger text-center">NAMA HASIL</th>
						<th class="bg-danger text-center">KADAR HASIL</th>
						<th class="bg-danger text-center">KADAR NORMAL</th>
						<th class="bg-danger text-center">JENIS RF</th>
						<th class="bg-danger text-center">DOSIS RF</th>
						<th class="bg-danger text-center">#</th>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div> 
		<div class="float-right">
			<button type="button" id="btn_add" class="btn btn-success btn-sm float-sm-right"><i class="fas fa-plus"></i></button>
		</div>
	</div>

	<div class="card-footer">
		<button type="submit" class="btn btn-primary">Insert</button>
		<button type="reset" class="btn btn-default">Reset</button>
	</div>
</div> -->

</form>

<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Hasil Pemeriksaan</h3>
	</div>
	<div class="card-body">
		<div id="content-pemeriksaan"></div>
	</div>
</div>

<script>
$("#medrec").keyup(function() {
	var base_url='<?=base_url()?>';
	// alert('test');abc
	$.ajax({
		type: "POST",
		url: base_url+"Hasil_nuklir/getMedrecAutoComplete",
		data: {
			keyword: $("#medrec").val().trim()
		},
		dataType: "json",
		success: function (data) {
			if (data.length > 0) {
				$('#DropdownMedrec').empty();
				$('#DropdownMedrec').dropdown('toggle');
				$('#DropdownMedrec').show();
			}
			else if (data.length == 0) {

			}

			$.each(data, function(key,value){
				if (data.length >= 0)
					$('#DropdownMedrec').append('<li role="displayCountries"><a role="menuitem" dropdownCountryli" class="dropdownlivalue" style="color:black;">' + value['NO_MEDREC'] +' - '+value['NAMA']+' - '+value['UMUR']+' - '+value['TGL_LAHIR']+'</a></li>');
			});
		}
	});
});


$('ul.txtnik').on('click','li a',function(){
	if ($(this).text()!='NOT FOUND')
	{
		var res=$(this).text().split(' - ');
		medrec=typeof res[0]!='undefined'?res[0]:'';
		$('#medrec').val(medrec);
		nama=typeof res[1]!='undefined'?res[1]:'';
		$('#nama').val(nama);
		umur=typeof res[2]!='undefined'?res[2]:'';
		$('#umur').val(umur);
		tgl_lahir=typeof res[3]!='undefined'?res[3]:'';
		$('#tgl_lahir').val(tgl_lahir);

		var $td = $(this).closest('li').children('a');
	}else{

	}
	$('#DropdownMedrec').hide();
});



$("#dokter_periksa").keyup(function() {
	var base_url='<?=base_url()?>';
	// alert('test');abc
	$.ajax({
		type: "POST",
		url: base_url+"Hasil_nuklir/getDokterPeriksaAutoComplete",
		data: {
			keyword: $("#dokter_periksa").val().trim()
		},
		dataType: "json",
		success: function (data) {
			if (data.length > 0) {
				$('#DropdownDokter').empty();
				$('#DropdownDokter').dropdown('toggle');
				$('#DropdownDokter').show();
			}
			else if (data.length == 0) {

			}

			$.each(data, function(key,value){
				if (data.length >= 0)
					$('#DropdownDokter').append('<li role="displayCountries"><a role="menuitem" dropdownCountryli" class="dropdownlivalue" style="color:black;">' + value['ID_DOKTER'] +' - '+value['NM_DOKTER']+'</a></li>');
			});
		}
	});
});

$('ul.txtDok').on('click','li a',function(){
	if ($(this).text()!='NOT FOUND')
	{
		var res=$(this).text().split(' - ');
		console.log(res);
		dokter_periksa=typeof res[1]!='undefined'?res[1]:'';
		$('#dokter_periksa').val(dokter_periksa);
		var $td = $(this).closest('li').children('a');
	}else{

	}
	$('#DropdownDokter').hide();
});



$('#tanggal_kunjungan').change(function(e) {
	let medrec = $('#medrec').val();
	let nama = $('#nama').val();
	let tanggal = $(this).val();

	let url = "<?=base_url()?>hasil_nuklir/getHasilPemeriksaan";
	url = url + "?medrec=" + medrec + "&tanggal=" + tanggal;

	console.log(url);

	
	if (medrec == "" || nama == "" || tanggal == "") {
		alert('kolom No Medrec, Nama Pasien dan Tanggal Kunjungan harus diisi !');
		return
	}


	$("#content-pemeriksaan").load(url, function(response,status, http){
        if(status == "success")
            alert("Periksa Data Pada Tabel Dibawah");
        if(status == "error")
            alert("Error: " + http.status + ": " 
                                           + http.statusText);
    });

});


let no=1;

$("#btn_add").click(function() {
	newRowContent='<tr>'+
					// '<td class="text-center">'+no+'</td>'+
					'<td>'+
						'<div class="input-group">'+
							'<input type="text" class="form-control" name="" auctocomplete="off" />'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<div class="input-group">'+
							'<input type="text" class="form-control" name="" auctocomplete="off" />'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<div class="input-group">'+
							'<input type="text" class="form-control" name="" auctocomplete="off" />'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<div class="input-group">'+
							'<input type="text" class="form-control" name="" auctocomplete="off" />'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<div class="input-group">'+
							'<input type="text" class="form-control" name="" auctocomplete="off" />'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<div class="input-group">'+
							'<input type="text" class="form-control" name="" auctocomplete="off" />'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<div class="input-group">'+
							'<input type="text" class="form-control" name="" auctocomplete="off" />'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<div class="input-group">'+
							'<input type="text" class="form-control" name="" auctocomplete="off" />'+
						'</div>'+
					'</td>'+
					'<td><button type="button" onClick="deleteRow(this)" class="btn btn-danger btn-sm float-sm-right"><i class="fas fa-trash"> </i></button></td>'+

				  '</tr>';
jQuery("#main_table tbody").append(newRowContent);

	no++;
});

function deleteRow(r)
{
	let i = r.parentNode.parentNode.rowIndex;
	document.getElementById("main_table").deleteRow(i);
	console.log(i);
}

</script>