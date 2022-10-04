$(document).ready(function(){
	$("#btn_search").click(function() { 
		$(this).html("Mencari..").attr("disabled", "disabled");
		
		$.ajax({
			url: baseurl + 'pelatihan/search_peserta/',
			type: 'POST', 
			data: {keyword: $("#keyword").val()}, {id_pelatihan: $("#id_pelatihan").val()},
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},

			success: function(response){ 
				$("#view").html(response.hasil);
				$("#btn_search").html("OK").removeAttr("disabled");				
			},
			
			error: function (xhr, ajaxOptions, thrownError) { 
				alert(xhr.responseText); 
			}
		});	
	});	
});