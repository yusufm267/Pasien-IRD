	// ambil elemen2 yg dibutuhkan
var txt_search = document.getElementById('txt_search');
var btn_submit = document.getElementById('btn_submit');
var ajax_content = document.getElementById('ajax_content');

txt_search.addEventListener('keyup', function() {
	//console.log(txt_keyword.value);

	// buat objek ajax
	var xhr = new XMLHttpRequest();
	// cek kesiapan ajax 
	xhr.onreadystatechange = function() {
		if ( xhr.readyState == 4 && xhr.status == 200 ) {
			//console.log(xhr.responseText);


			ajax_content.innerHTML=xhr.responseText; 
		}
	}

	// eksekusi ajax. true = asynchronous
	xhr.open('GET','http://localhost/pelatihan/pegawai/search/'+txt_search.value,true); 
	xhr.send();

	if (txt_search.value=='') {
		document.location.href='http://localhost/pelatihan/pegawai/';
	}

});
