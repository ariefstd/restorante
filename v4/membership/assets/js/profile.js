
$(document).ready(function (){

	init();
					
});

function init()
{
	var urlpath = "validate_profile.php";
	$.ajax({
		type: 	"POST",
		dataType: "json",
		url: 	urlpath,
		success: function(result){
			
			if(result.success)
			{
				refill_data(result.record);
			}
			else 
			{
				window.location = result.url;
			}
		}
	});
	
	
	$('a#renew').click(function(event){
			event.preventDefault();
			
			window.location = 'payment.html';
	});
	
	$('a#edit_profile').click(function(event){
			event.preventDefault();
			
			window.location = 'edit_profile.html';
	});
	
	$('a#pwd_update').click(function(event){
			event.preventDefault();
			
			window.location = 'password_update.html';
	});
	
}

function refill_data($data)
{
	$('input[rel="uid"]').val($data.id);
	$('span[rel="date_join"]').html($data.date_join);
	$('span[rel="expiry_date"]').html($data.expiry_date);
	$('span[rel="username"]').html($data.username);
	$('span[rel="id"]').html($data.id);
	$('span[rel="full_name"]').html($data.full_name);
	$('span[rel="gender"]').html($data.gender);
	$('span[rel="email"]').html($data.email);
	$('span[rel="contact_no"]').html($data.contact_no);
	$('span[rel="mobile_no_1"]').html($data.mobile_no_1);
	$('span[rel="mobile_no_2"]').html($data.mobile_no_2);
	$('span[rel="nationality"]').html($data.nationality);
	$('span[rel="password"]').html($data.password);
	$('span[rel="address"]').html($data.address);
	$('span[rel="mailing_add"]').html($data.mailing_add);

	parent.$(".fancybox").trigger("update");		
}

