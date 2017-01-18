$(document).ready(function() {
	
	/*
	  var current = $('.festive ul.thumb a.current').attr("rel");
	  var size = $('.festive ul.thumb li').length;
		
	  $('#mycarousel ul.full').jcarousel({
		  wrap: 'circular',
		  scroll: 1,
		  easing: 'swing',
		  animation: 1000,
		  buttonNextHTML: null,
		  buttonPrevHTML: null
		  
	  });
	  var carousel = jQuery('#mycarousel ul.full').data('jcarousel');
	  
	  $('.festive ul.thumb a').click(function(event){
		  event.preventDefault();
		  
		  $('.festive ul.thumb a').removeClass('current');
		  $('.festive ul.thumb a[rel="'+ current +'"]').addClass('current');
		  
		  
		  current = $(this).attr("rel");
		  carousel.scroll($.jcarousel.intval(current));
	  });
	  */
	  
	  $('#top-carousel').carousel();
	  $('#thumb-carousel').carousel();
	  
	  
	  
	  $('#thumb-carousel .m-item').click(function(event){
		  event.preventDefault();
		  
		  var rel = $(this).attr("rel");
		  $('#top-carousel').carousel('move', rel);
	  });
		
});

