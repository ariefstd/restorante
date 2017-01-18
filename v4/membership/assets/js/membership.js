
$(document).ready(function (){

			$('a.close').click(function(event){
				event.preventDefault();
				parent.$(".fancybox").trigger("close_box");		
			});
			
			$('input.cancel').click(function(event){
				event.preventDefault();
				parent.$(".fancybox").trigger("close_box");		
			});
			
			$('a.redirect').click(function(event){
				event.preventDefault();
				window.location = 'register.html';
			});
			
			
			$('input#login_submit').click(function(event){
				event.preventDefault();
				
				var urlpath 	= "process_login.php";
				$username = $.trim($('input#username').val());
				$password = $.trim($('input#password').val());
				
				if($username ==='' || $password ==='')
				{
					$('div.error').show();
					$('div.error').css("display", "block");
					$('div.error').delay(3000).fadeOut('slow');
				}
				else
				{
					$.ajax({
						type: 	"POST",
						dataType: "json",
						url: 	urlpath,
						data: 	{
							username:	$username, 
							password:	$password
						},
						success: function(result){
	
							if(result.success){
								window.location = result.url;
							}
							else {
									$('div.error').html(result.error);
									$('div.error').show();
									$('div.error').css("display", "block");
									$('div.error').delay(3000).fadeOut('slow');
								}
						}
					});
				}
			});
			
			$('#password_recovery').click(function(event){
				event.preventDefault();
				window.location = 'password_recovery.html';
			});
			
			
			$('input#recover_submit').click(function(event){
				event.preventDefault();
				
				var urlpath 	= "get_password.php";
				$email_1 = $.trim($('input#email_1').val());
				$email_2 = $.trim($('input#email_2').val());
				
				if($email_1 != $email_2)
				{
						$("div.error").html('Email does not match the confirm email.');
						$('div.error').show();
						$('div.error').css("display", "block");
						$('div.error').delay(3000).fadeOut('slow');
				}
				else
				{
						$.ajax({
							type: 	"POST",
							dataType: "json",
							url: 	urlpath,
							data: 	{
								email:	$email_1
							},
							success: function(result){
								
								if(result.success)
								{
									$('form.password_recovery_form').hide();
									$('div.thankyou').html('You password has been send to your email. Thank you.');
									$('div.thankyou').show();
								}
								else
								{
									$('form.password_recovery_form').hide();
									$('div.thankyou').html('Email account does not exist. Please try again.');
									$('div.thankyou').show();
								}
								
							}
						});
				}
				
			});
			
			
			$('input#password_update').click(function(event){
				event.preventDefault();
				
				var urlpath 	= "update_password.php";
				$password_1 = $.trim($('input#password_1').val());
				$password_2 = $.trim($('input#password_2').val());
				
				if($password_1 != $password_2)
				{
						$("div.error").html('Password does not match the confirm password.');
						$('div.error').show();
						$('div.error').css("display", "block");
						$('div.error').delay(3000).fadeOut('slow');
				}
				else
				{
						$.ajax({
							type: 	"POST",
							dataType: "json",
							url: 	urlpath,
							data: 	{
								password:	$password_1
							},
							success: function(result){
								
								if(result.success)
								{
									$('form.password_update_form').hide();
									$('div.password_change').html('You password has been updated. Thank you.');
									$('div.password_change').show();
								}
								else
								{
									$('form.password_update_form').hide();
									$('div.password_change').html('Fail to update your password. Please try again.');
									$('div.password_change').show();
								}
								
							}
						});
				}
				
			});
});


function validateEmail(email){
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if (email.search(emailRegEx) == -1) return false;
	else return true;
}