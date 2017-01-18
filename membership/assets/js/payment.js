
$(document).ready(function (){

	init();
					
});

function init()
{
	
	var urlpath = "get_user_id.php";
	$.ajax({
		type: 	"POST",
		dataType: "json",
		url: 	urlpath,
		success: function(result){
			
			if(result.success)
			{
				$("input[name='item_number']").val(result.id);
			}
			else 
			{
				$("input[name='item_number']").val('');
			}
		}
	});
	
	
	$('.bank_transfer').hide();
	$('input.close').hide();
	$('input.paypal').show();
	
	$("input[name='payment']").change(function(){
		if($(this).val() == "paypal")
		{
			$('.bank_transfer').hide();
			$('input.close').hide();
			$('input.paypal').show();
		}
		else
		{
			$('.bank_transfer').show();
			$('input.close').show();
			$('input.paypal').hide();
		}
	});
	
	
	$('input.close').click(function(event){
		event.preventDefault();
		parent.$(".fancybox").trigger("close_box");		
	});
	
	
	$('input#paypal').click(function(event){
		event.preventDefault();
		
		package = $("input[name='term']:checked").val();
		if(package == 1)
			package_name = "Package: 1 Year";
		else if(package == 2)
			package_name = "Package: 2 Years";
		else
			package_name = "Special Package";
			
				
		$("input[name='item_name']").val(package_name);
		$("#paypalForm").trigger("submit")
	
	});
	
}

