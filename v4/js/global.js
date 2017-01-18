$(document).ready(function() {
		
	$('.fancybox').fancybox(
	{
		width:'520',
		height:'90%',
		  type: 'iframe',
		  autoSize: true,
		  autoHeight: true,
		  autoWidth: true,
		  autoResize: true,
		  autoCenter: true,
		  'closeBtn' : true,
		  maxWidth: '100%',
		  maxHeight: '100%',

		helpers:  {
			title:  null,
			overlay : {
				closeClick : false,
				showEarly  : false
			}
		},
		
		'beforeShow': function () { 
		
			$('.fancybox-wrap div').removeClass('fancybox-skin');
		}
	});
	
	$('.fancybox').bind('close_box', function() {
		$.fancybox.close();
	});
	
	$('.fancybox').bind('update', function() {
		$.fancybox.update();
	});
	
	
	$mobile = isMobile();
	
	if($mobile === false)
	{
		init_fancybox();
		
	}
	else
	{
		init_mobile_fancybox();
	}

	supersized();
	mobileMenu();
	
	
			
});

function init_fancybox()
{
	$(".products_fancybox").fancybox({
    		
			width:'960',
			type: 'iframe',
			autoSize: true,
			autoHeight: true,
			autoWidth: true,
			autoResize: true,
			autoCenter: true,
			'closeBtn' : true,
			maxWidth: '90%',
			maxHeight: '90%',
			padding: 0,
			
			helpers:  {
				title:  null,
				overlay : {
					closeClick : true,
					showEarly  : false
				}
			},
			'beforeShow': function () { 
			
				$('.fancybox-wrap div').removeClass('fancybox-skin');
			}
	});
}

function init_mobile_fancybox()
{
	$(".products_fancybox").fancybox({
    		
			width:'90%',
			height:'90%',
			type: 'iframe',
			autoSize: true,
			autoHeight: true,
			autoWidth: true,
			autoResize: true,
			autoCenter: true,
			'closeBtn' : true,
			scrolling : 'no',
			maxWidth: '100%',
		 	maxHeight: '100%',
			padding: 0,
			
			helpers:  {
				title:  null,
				overlay : {
					closeClick : true,
					showEarly  : false
				}
			},
			'beforeShow': function () { 
			
				$('.fancybox-wrap div').removeClass('fancybox-skin');
			}
	});
}


function supersized()
{
	var imagedb = new Array();
	var key = new Object();
	$("div#slideshow img").each(function(index) {
    	source = $(this).attr('src');
		key = new Object();
		key.image = source;
		imagedb.push(key);
	});
	
	$.supersized({
				
	  slide_interval    :   5000,		
	  transition        :   1, 		
	  performance		:	0,
	  transition_speed	:	1000,		
	  image_protect		:	1,		
	  start_slide		: 	1,	
												 
	  fit_landscape:0,	
	  fit_portrait:0,									 
						
	  slides 			:  	imagedb,
	  
	  mouse_scrub		:	0
								  				
	});
	
	$("div.slide-list a").click(function(event){
		event.preventDefault();
		var slide = $(this).attr("rel");
		api.goTo(slide);
	});
	
}

function mobileMenu()
{
	$('header.main .menu-button').click(function(event){
		event.preventDefault();
		$('header.main nav').show();
	});
	
	$('header.main .close-menu').click(function(event){
		event.preventDefault();
		$('header.main nav').hide();
	});
}

function isMobile() {
  var index = navigator.appVersion.indexOf("Mobile");
  return (index > -1);
}

