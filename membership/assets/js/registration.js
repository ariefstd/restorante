$(document).ready(function (){

	$('#register_submit').click(function(event){
		event.preventDefault();
		
		if(validateForm())
		{
			var $title		= $.trim($('input:radio[name=title]:checked').val());
			var $f_name 	= $.trim($('#first_name').attr('value'));
			var $l_name 	= $.trim($('#last_name').attr('value'));
			
			var $full_name  = $title + '' + $f_name + ' ' + $l_name;
			
			var $ic_passport = $.trim($('#ic_passport').attr('value'));
			var $gender		= $.trim($('#gender').attr('value'));
			var $email		= $.trim($('#email').attr('value'));
			var $contact_no	= $.trim($('#contact_no').attr('value'));
			var $mobile_no_1	= $.trim($('#mobile_no_1').attr('value'));
			var $mobile_no_2	= $.trim($('#mobile_no_2').attr('value'));
			var $nationality	= $.trim($('#nationality').attr('value'));
			var $occupation	= $.trim($('#occupation').attr('value'));
			
			var $username	= $.trim($('#username').attr('value'));
			var $password	= $.trim($('#password').attr('value'));
			
			
			var $add_1		= $.trim($('#add_1').attr('value'));
			var $postal		= $.trim($('#postal').attr('value'));
			var $city		= $.trim($('#city').attr('value'));
			var $state		= $.trim($('#state').attr('value'));
			var $country		= $.trim($('#country').attr('value'));

			var $add_2		= $.trim($('#add_2').attr('value'));
			var $postal2	= $.trim($('#postal2').attr('value'));
			var $city2		= $.trim($('#city2').attr('value'));
			var $state2		= $.trim($('#state2').attr('value'));
			var $country2	= $.trim($('#country2').attr('value'));
			
			var $address		= $add_1 + ', ' + $postal + ', ' + $city + ', ' + $state + ', ' + $country;
			var $mailing_add = $add_2 + ', ' + $postal2 + ', ' + $city2 + ', ' + $state2 + ', ' + $country2;
			
			var $card_collection = $.trim($('input:radio[name=card_collection]:checked').val());
			
			var $dob	= $.trim($('#dob').attr('value'));
			
			var dataArray = { dob: $dob, full_name: $full_name, ic_passport:$ic_passport, gender:$gender, email:$email, contact_no:$contact_no, mobile_no_1:$mobile_no_1, mobile_no_2:$mobile_no_2, nationality:$nationality, occupation:$occupation, username:$username, password:$password, address:$address, mailing_add:$mailing_add, card_collection:$card_collection };
			
			var urlpath = "process_registration.php";
			$.ajax({
				type: 	"POST",
				dataType: "json",
				url: 	urlpath,
				data:	dataArray,
				success: function(result){

					if(result.success)
					{
						window.location = result.url;
					}
					else 
					{
						$('div.error').html(result.error);
						$('div.error').show();
						$('div.error').css("display", "block");
						$('div.error').delay(3000).fadeOut('slow');
						//window.location = result.url;
					}
				}
			});
			
			
		}
		
	});
					
});


function validateForm(){
	
	$('.error').hide();
	$("div.error").html('');
	var _error = true;
	
	if ($.trim($('#first_name').attr('value')) === '') 
	{  
		$("div.error").html('First Name field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if ($.trim($('#last_name').attr('value')) === '') 
	{  
		$("div.error").html('Last Name field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if ($.trim($('#gender').attr('value')) === '') 
	{  
		$("div.error").html('Gender field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if ($.trim($('#email').attr('value')) === '') 
	{  
		$("div.error").html('Email field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if ($.trim($('#mobile_no_1').attr('value')) === '') 
	{  
		$("div.error").html('Mobile 1 No. field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
  
 	if ($.trim($('#nationality').attr('value')) === '') 
	{  
		$("div.error").html('Nationality field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if ($.trim($('#occupation').attr('value')) === '')
	{  
		$("div.error").html('Occupation field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if ($.trim($('#dob').attr('value')) === '')
	{  
		$("div.error").html('Birthday field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}

	if ($.trim($('#add_1').attr('value')) === '')
	{  
		$("div.error").html('Address field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if ($.trim($('#postal').attr('value')) === '')
	{  
		$("div.error").html('Postal Code field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if ($.trim($('#city').attr('value')) === '')
	{  
		$("div.error").html('City field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if ($.trim($('#state').attr('value')) === '')
	{  
		$("div.error").html('State field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if ($.trim($('#country').attr('value')) === '')
	{  
		$("div.error").html('Country field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if ($.trim($('#username').attr('value')) === '') 
	{  
		$("div.error").html('Username field is empty.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	} 
	
	if ($.trim($('#password').attr('value')) != $.trim($('#c_password').attr('value')))
	{  
		$("div.error").html('Password does not match the confirm password.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	if (!$('#tnc').is(':checked'))
	{
		$("div.error").html('Please accept all Terms &amp; Conditions.');
		$("div.error").fadeIn("slow");  
		_error =  false; 
		return _error;
	}
	
	
	return _error;
}

function validateEmail(email){
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if (email.search(emailRegEx) == -1) return false;
	else return true;
}