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

/*

	$(document).ready(function(){
		$("#btncari").click(function() { 
			
		});

		$("table tr").each(function(index) {
      	if (index != 0) {
            $row = $(this);
            var id = $row.find("td.nama").text();
            console.log(id); 
            
            --if (id.indexOf(value) != 0) {
              --  $(this).hide();
            --} else {
              --  $(this).show();
            --}
            
        	}
    	});

	});  

	$("#cari").on("keyup", function() {
   
   	var value = $(this).val().toLowerCase();

    	$("table tr.data").filter(function() {
      	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    	});

    
   	--$("table tr").each(function(index) {
      	--if (index != 0) {
           -- $row = $(this);
           -- var id = $row.find("td.nama").text();

            --if (id.indexOf(value) != 0) {
              --  $(this).hide();
            --} else {
             --   $(this).show();
            --}
        	--}
    	--});
    	
	--});		

*/