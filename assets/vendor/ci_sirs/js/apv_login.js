$(document).ready(function(){
	$("#btn_submit").click(function() { 

		if ($("#keyword").val().length==0 || $.trim($("#keyword").val())=='') {
			location.reload(); 
		}

		$(this).html("Mencari..").attr("disabled", "disabled");
		
		$.ajax({
			url: baseurl + 'user/search',
			type: 'POST', 
			data: {keyword: $("#keyword").val()}, 
			dataType: "json",
			beforeSend: function(e) {
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},

			success: function(response){ 
				$("#view").html(response.hasil);
				$("#btn_submit").html("OK").removeAttr("disabled");				
			},
			
			error: function (xhr, ajaxOptions, thrownError) { 
				alert(xhr.responseText); 
			}
		});	
	});	
});

