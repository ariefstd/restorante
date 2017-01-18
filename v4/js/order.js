
$(document).ready(function (){
	$("input#reservation_btn").click(function(event){
		event.preventDefault();
		if(validateForm())
		{
			var $first 				= $.trim($('#first').attr('value'));			var $last 				= $.trim($('#last').attr('value'));			var $email 				= $.trim($('#email').attr('value'));			var $telp 				= $.trim($('#telp').attr('value'));			var $menu 				= $.trim($('#menu').attr('value'));			var $event			= $.trim($('#event').attr('value'));			var $catering		= $.trim($('#catering').attr('value'));
			var $day				= $.trim($('#day').attr('value'));			var $month				= $.trim($('#month').attr('value'));			var $year				= $.trim($('#year').attr('value'));			var $date				= $month + ' ' + $day + ' ' + $year;
			var $hour				= $.trim($('#hour').attr('value'));			var $minute				= $.trim($('#minute').attr('value'));			var $ampm				= $.trim($('#ampm').attr('value'));			var $time				= $hour + ':' + $minute + ' ' + $ampm;
			var $address 			= $.trim($('#address').attr('value'));			var $message 			= $.trim($('#message').attr('value'));
			
			$("input").attr('disabled','disabled');			$("textarea").attr('disabled','disabled');			$("#reservation_btn").hide();
			
			var dataArray = { 				first: $first, 				last: $last, 				email:$email, 				telp:$telp,				event:$event,				catering:$catering,				date:$date,				time:$time,				address:$address,				menu:$menu,				message:$message 
			 };
			
			$.ajax({
				type: "POST",				url: "process_order.php",				data: dataArray,
				success: function(feedback) {					
					
				  if(feedback.msg == "failed")
				  {					$("div#reservationThanks").hide();
					$("div#reservationFail").show();
										$("input").removeAttr('disabled');
					$("textarea").removeAttr('disabled');
					
					$("#reservation_btn").show();				  }
				  else
				  {

					 $("div#reservationThanks").show();					 $("div#reservationFail").hide();
										
				  }
				}
			  });
		}
	});
	

});

function validateForm(){
	$('.error').hide();	var _error = true;
	if ($.trim($('#address').attr('value')) === '') 	{  
		$("div#addressError").show();  		$("input#address").focus();  		_error =  false; 
	} 	
	var contact_no = $.trim($('#telp').attr('value'));	if (isNaN(contact_no) ||  contact_no == '' ) 	{  
		$("div#phoneError").show();  		$("input#phone").focus();  		_error =  false;  
	}  	
	if (!validateEmail($.trim($('#email').attr('value')))) 	{  
		$("div#emailError").show();  		$("input#email").focus(); 		_error = false; 
	} 
	
	if ($.trim($('#first').attr('value')) === '') 	{  
		$("div#nameError").show();  		$("input#name").focus();  		_error =  false;  
	}  
	
	return _error;
}

function validateEmail(email){
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;	if (email.search(emailRegEx) == -1) return false;	else return true;
}


