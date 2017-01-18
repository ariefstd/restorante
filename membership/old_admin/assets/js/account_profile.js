
$(document).ready(function (){

	$("#profile_edit").show();
	$("#profile_update").hide();
	$("#profileTable .input_display").show();
	$("#profileTable .input_field").hide();
	
	$("#profile_edit").click(function(event){	
		event.preventDefault();
		$(this).hide();
		$("#profileTable .input_field").fadeIn("show");
		$("#profileTable .input_display").hide();
		$("#profile_update").fadeIn("show");
	});


	$("#profile_update").submit(function(event){	
		event.preventDefault();
		$(this).hide();
		$("#profile_edit").fadeIn("show");
		return false;
	});
	
});



