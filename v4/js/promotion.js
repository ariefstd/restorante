$(document).ready(function() {
	
	var timeout=null;
	$('#promotion-carousel').carousel();
	$('#promotion-carousel .m-item').click(function(event){
		$('#promotion-carousel .promo-title').fadeOut();
		clearTimeout(timeout);
        timeout=setTimeout(function()
		{
			var rel = $('#promotion-carousel .m-active img').attr('rel');
			$('#promotion-carousel .promo-title').text(rel);
			$('#promotion-carousel .promo-title').fadeIn();
			
		}, 500);
	});
	
	$init_PROMO();
	
	$("div.promotion div.promo div.tab a").click(function(event){
		
		event.preventDefault();
		var rel = $(this).attr("rel");
		$("div.promotion div.promo div.tab a").removeClass("current");
		$(this).addClass("current");
		
		$("div.promotion div.promo div.select-list ul").hide();
		$("div.promotion div.promo div.select-list ul[rel='"+ rel +"']").fadeIn();	
	});
	
	$("div.promotion div.promo div.select-list a").click(function(event){
		event.preventDefault();
		var href = $(this).attr('href');
		$("div.promotion div.promo div.main-display").empty();
		$("div.promotion div.promo div.main-display").append("<img src='"+ href +"'>");
		$("div.promotion div.promo div.main-display").hide();
		$("div.promotion div.promo div.main-display").fadeIn();
		
	});
			
});

$init_PROMO = function()
{
	var $starter = $("div.promotion div.promo div.tab a.current");
	var rel = $starter.attr("rel");
	
	$("div.promotion div.promo div.select-list ul").hide();
	$("div.promotion div.promo div.select-list ul[rel='"+ rel +"']").fadeIn();	
	
	var href = $("div.promotion div.promo div.select-list ul[rel='"+ rel +"']:first-child a").attr('href');
	$("div.promotion div.promo div.main-display").empty();
	$("div.promotion div.promo div.main-display").append("<img src='"+ href +"'>");
	$("div.promotion div.promo div.main-display").show();
	//$("div.promotion div.promo div.main-display").fadeIn();
}
