$(document).ready(function(){
	$("#SEARCH_SUBMIT").click(function() { 
		$(this).html("Mencari..").attr("disabled", "disabled");
		
		$.ajax({
			url: baseurl + 'app/jadwal/search_proc',
			type: 'POST', 
			data: {keyword: $("#SEARCH_TXT").val()}, 
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},

			success: function(response){ 
				$("#view").html(response.hasil);
				$("#SEARCH_SUBMIT").html("OK").removeAttr("disabled");				
			},
			
			error: function (xhr, ajaxOptions, thrownError) { 
				alert(xhr.responseText); 
			}
		});	
	});	
});

