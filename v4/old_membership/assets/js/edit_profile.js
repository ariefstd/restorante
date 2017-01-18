
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
	
	
	$('input#profile_update_btn').click(function(event){
			event.preventDefault();
			
			var $id 			= $.trim($('#uid').attr('value'));
			var $nationality	= $.trim($('#nationality').attr('value'));
			var $full_name		= $.trim($('#full_name').attr('value'));
			var $gender			= $.trim($('#gender').attr('value'));
			var $email			= $.trim($('#email').attr('value'));
			var $contact_no		= $.trim($('#contact_no').attr('value'));
			var $mobile_no_1	= $.trim($('#mobile_no_1').attr('value'));
			var $mobile_no_2	= $.trim($('#mobile_no_2').attr('value'));
			var $address		= $.trim($('#address').val());
			var $mailing_add	= $.trim($('#mailing_add').val());
			
			var dataArray = { id: $id, nationality:$nationality, full_name:$full_name, gender:$gender, email:$email, contact_no:$contact_no, mobile_no_1:$mobile_no_1, mobile_no_2:$mobile_no_2, address:$address, mailing_add:$mailing_add };
			console.log(dataArray);
			
			var urlpath = "process_profile_update.php";
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
			
			
			
	});
	
}

function refill_data($data)
{
	$('input[rel="uid"]').val($data.id);
	$('span[rel="username"]').html($data.username);
	$('input[rel="nationality"]').val($data.nationality);
	$('input[rel="full_name"]').val($data.full_name);
	$('input[rel="gender"]').val($data.gender);
	$('input[rel="email"]').val($data.email);
	$('input[rel="contact_no"]').val($data.contact_no);
	$('input[rel="mobile_no_1"]').val($data.mobile_no_1);
	$('input[rel="mobile_no_2"]').val($data.mobile_no_2);
	
	$('textarea[rel="address"]').text($data.address.replace(/(<([^>]+)>)/ig,""));
	$('textarea[rel="mailing_add"]').text($data.mailing_add.replace(/(<([^>]+)>)/ig,""));

	parent.$(".fancybox").trigger("update");		
}

