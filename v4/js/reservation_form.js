// remap jQuery to $
(function($){})(window.jQuery);

$(document).ready(function (){

	$("input#reservation_btn").click(function(event){
		
		event.preventDefault();
		
		if(validateForm())
		{
			var $name 				= $.trim($('#name').attr('value'));
			var $email 				= $.trim($('#email').attr('value'));
			var $phone 				= $.trim($('#phone').attr('value'));
			var $phone2				= $.trim($('#phone2').attr('value'));
			
			var $no_people			= $.trim($('#people_no').attr('value'));
			var $budget				= $.trim($('#budget_person').attr('value'));
			var $event_type			= $.trim($('#event_type').attr('value'));
			var $catering_type		= $.trim($('#catering_type').attr('value'));
			
			var $day				= $.trim($('#day').attr('value'));
			var $month				= $.trim($('#month').attr('value'));
			var $year				= $.trim($('#year').attr('value'));
			var $date				= $month + ' ' + $day + ' ' + $year;
			
			var $hour				= $.trim($('#hour').attr('value'));
			var $minute				= $.trim($('#minute').attr('value'));
			var $ampm				= $.trim($('#ampm').attr('value'));
			var $time				= $hour + ':' + $minute + ' ' + $ampm;
			
			var $address 			= $.trim($('#address').attr('value'));
			var $message 			= $.trim($('#message').attr('value'));
			
			$("input").attr('disabled','disabled');
			$("textarea").attr('disabled','disabled');
			$("#contact_btn").hide();
			
			var dataArray = { 
			name: $name, 
			email:$email, 
			phone:$phone,
			phone2:$phone2,
			no_people:$no_people,
			budget:$budget,
			event_type:$event_type,
			catering_type:$catering_type,
			date:$date,
			time:$time,
			address:$address,
			message:$message 
			 };
			
			$.ajax({
				type: "POST",
				url: "mailer/process_reservation.php",
				data: dataArray,
				success: function(feedback) {
				    
				  if(feedback == "success")
				  {
					 $("div#reservationThanks").show();
					 $("div#reservationFail").hide();
				  }
				  else
				  {
					$("div#reservationThanks").hide();
					$("div#reservationFail").show();

					$("input").removeAttr('disabled');
					$("textarea").removeAttr('disabled');
					
					$("input#contact_btn").show();
				  }
				}
			  });
		}
	});
	

});

function validateForm(){
	
	$('.error').hide();
	var _error = true;
	
	if ($.trim($('#message').attr('value')) === '') 
	{  
		$("div#messageError").show();  
		$("textarea#message").focus();  
		_error =  false; 
	} 
	
	if ($.trim($('#address').attr('value')) === '') 
	{  
		$("div#addressError").show();  
		$("input#address").focus();  
		_error =  false; 
	} 
	
	if ($.trim($('#day').attr('value')) == 0 || $.trim($('#month').attr('value')) == 0 || $.trim($('#year').attr('value')) == 0) 
	{  
		$("div#dateError").show();   
		_error =  false; 
	} 
	
	if ($.trim($('#hour').attr('value')) == -1 || $.trim($('#minute').attr('value')) == -1 || $.trim($('#ampm').attr('value')) == 0) 
	{  
		$("div#timeError").show();   
		_error =  false; 
	} 
	
	var people = $.trim($('#people_no').attr('value'));
	var budget = $.trim($('#budget_person').attr('value'));
	console.log("my people:"+people);
	console.log("my budget:"+budget);
	if (isNaN(people) ||  people == '' || isNaN(budget) ||  budget == '') 
	{  
		$("div#peoplebudgetError").show();  
		_error =  false;  
	}  
	
	var contact_no = $.trim($('#phone').attr('value'));
	if (isNaN(contact_no) ||  contact_no == '' ) 
	{  
		$("div#phoneError").show();  
		$("input#phone").focus();  
		_error =  false;  
	}  
	
	var contact_no2 = $.trim($('#phone2').attr('value'));
	if (isNaN(contact_no2) ||  contact_no2 == '' ) 
	{  
		$("div#phoneError2").show();  
		$("input#phone2").focus();  
		_error =  false;  
	}  
	
	if (!validateEmail($.trim($('#email').attr('value')))) 
	{  
		$("div#emailError").show();  
		$("input#email").focus(); 
		_error = false; 
	} 
	
	if ($.trim($('#name').attr('value')) === '') 
	{  
		$("div#nameError").show();  
		$("input#name").focus();  
		_error =  false;  
	}  
	
	return _error;
}

function validateEmail(email){
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if (email.search(emailRegEx) == -1) return false;
	else return true;
}


