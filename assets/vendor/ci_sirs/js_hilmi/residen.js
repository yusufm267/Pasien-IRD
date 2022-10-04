$(document).ready(function(){
	$("#btn_submit").click(function() { 

		if ($("#keyword").val().length==0 || $.trim($("#keyword").val())=='') {
			location.reload(); 
		}

		//$(this).html("Mencari..").attr("disabled", "disabled");

		
		$.ajax({
//yang diganti didalam '.../search' sesuai dengan fungsi 
			url: baseurl + 'residen/search',
			type: 'POST', 
			data: {keyword: $("#keyword").val()}, 
			dataType: "json",
			beforeSend: function(e) {
				$("#view").html('');
				if(e && e.overrideMimeType) {
					e.overrideMimeType("application/json;charset=UTF-8");
				}
			},

			success: function(response){ 
				console.log('error : ',response);
				$("#view").html(response.hasil);
				$("#btn_submit").html("OK").removeAttr("disabled");
		
			},
			// document.getElementById("btn_submit").disabled = false;
			// document.getElementById("btn_submit").disabled = true;

			error: function (xhr, ajaxOptions, thrownError) { 
				alert(xhr.responseText); 
			}
		});	
	});	
});

function get_search(){
	//alert('coba');
	$("#btn_submit").click();
}

