
$(document).ready(function (){

	var validate_error = "*wrong username &amp; password";
	var login_error	= "Login failed. <br/>Please check your username and password again.";	

	$("#login_form").submit(function(event) {
		event.preventDefault();
		if(validateForm())
		{
			//this.submit();
			var urlpath 	= "login/validate_login";
			var userName 	= $.trim($('input#username').val());
			var userPword 	= $.trim($('input#password').val());
		
			$.ajax({
				type: 	"POST",
				dataType: "json",
				url: 	urlpath,
				data: 	{
					username:	userName, 
					password:	userPword
				},
				success: function(result){
					//console.log(result.url);
					if(result.success){
						window.location = result.url;
					}
					else {
						$("#login_container .error").html(login_error);
						$("#login_container .error").css("display", "block");
						$("#login_container .error").delay(3000).fadeOut('slow');
						//console.log(result.success);
						//window.location = result.url;
					}
				}
			});
			
		}
	});
	
	function validateForm()
	{
		var $errorLog = false;
		$("#login_wrapper .error").css("display", "none");

		var userName 	= $.trim($('input#username').val());
		var userPword 	= $.trim($('input#password').val());
	
		if(userName ==='') 
		{
			$errorLog = true;
			$("#login_container .error").html(validate_error);
			$("#login_container .error").css("display", "block");
		}
		
		if(userPword ==='') 
		{
			$errorLog = true;
			$("#login_container .error").html(validate_error);
			$("#login_container .error").css("display", "block");
		}
	
		return !$errorLog;	
	}

});



