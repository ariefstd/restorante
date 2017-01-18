/***************************/
//@Author: Rayden Chan
//@license: Forget about it					
/***************************/

$(document).ready(function (){
	
	var searchBox = $("input.search");
	var searchBoxDefault = "Search...";
	
	searchBox.focus(function(e){
		$(this).addClass("active");
		if($(this).attr("value") == searchBoxDefault) $(this).attr("value", "");
		$(this).css("display","none");
		$(this).fadeIn("slow");
	});
	searchBox.blur(function(e){
		$(this).removeClass("active");
		if($(this).attr("value") == "") $(this).attr("value", searchBoxDefault);
		$(this).css("display","none");
		$(this).fadeIn("slow");
	});

});


