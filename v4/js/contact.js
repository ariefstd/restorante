
$(document).ready(function() {
	
	var map;
	function initialize() {
	  var mapOptions = {
		zoom: 18,
		center: new google.maps.LatLng(1.462965,103.774034),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	  };
	  map = new google.maps.Map(document.getElementById('map-canvas'),
		  mapOptions);
	}

	google.maps.event.addDomListener(window, 'load', initialize);


	
	$("#contactForm").submit(function(event){
		event.preventDefault();
		
		if(validateForm())
		{
			var $name 		= $.trim($('#name').val());
			var $email 		= $.trim($('#email').val());
			var $phone 		= $.trim($('#phone').val());
			var $message 	= $.trim($('#message').val());
			
			$("input").attr('disabled','disabled');
			$("textarea").attr('disabled','disabled');
			$("#resetBtn").hide();
			$("#submitBtn").hide();
			
			var dataArray = { name: $name, email:$email, phone:$phone, message:$message };
			
			$.ajax({
				type: "POST",
				url: "mailer/process_contact.php",
				data: dataArray,
				success: function(feedback) {
				    
				  if(feedback == "success")
				  {
					 $("div#contactThanks").show();
					 $("div#contactFail").hide();
				  }
				  else
				  {
					$("div#contactThanks").hide();
					$("div#contactFail").show();
					$("input").removeAttr('disabled');
					$("textarea").removeAttr('disabled');
					$("input#resetBtn").show();
					$("input#submitBtn").show();
				  }
				}
			  });
		}
	});//end of #contactForm
	
});

function validateForm(){
	
	$('.error').hide();
	$(".errorCol").hide();
	var _error = true;
	
	
	if ($.trim($('#message').val()) === '') 
	{  
		$(".errorCol").show();
		$("div#messageError").show();  
		_error =  false; 
	} 
	
	if ($.trim($('#phone').val()) === '') 
	{  
		$(".errorCol").show();
		$("div#phoneError").show();   
		_error =  false;  
	}  
	
	if (!validateEmail($.trim($('#email').val()))) 
	{  
		$(".errorCol").show();
		$("div#emailError").show();  
		_error = false; 
	} 
	
	if ($.trim($('#name').val()) === '') 
	{  
		$(".errorCol").show();
		$("div#nameError").show();  
		_error =  false;  
	}  
	
	return _error;
}

function validateEmail(email){
	var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
	if (email.search(emailRegEx) == -1) return false;
	else return true;
}


