$(document).ready(function (){
		
	$("#password_form").submit(function(event){
		//event.preventDefault();
		old_pwd = $("#old_pwd").val();
		new_pwd = $("#new_pwd").val();
		cfm_pwd = $("#cfm_pwd").val();
		
		
		if(old_pwd.length < 5 || new_pwd.length < 5)
		{
			$("#passwordTable .error").html("Password length should not be lesser than 6 characters.");
			$("#passwordTable .error").hide();
			$("#passwordTable .error").fadeIn("fast");
			$("#passwordTable .error").delay(3000).fadeOut('slow');
			return false;
		}
		else
		{
			if(new_pwd != cfm_pwd)
			{
				$("#passwordTable .error").html("Password not matched. Please retype same password for verification.");
				$("#passwordTable .error").hide();
				$("#passwordTable .error").fadeIn("fast");
				$("#passwordTable .error").delay(3000).fadeOut('slow');
				return false;
			}
			
		}
		
		return true;
	});
});