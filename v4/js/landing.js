


/* trigger when page is ready */
$(document).ready(function (){
		intro();
		bg_Changer();
});

function bg_Changer()
{
		var allBackground = $("#landingPage div.bg_image ul li");
		allBackground.hide();	// hide all the background images
		
		$("#landingPage div.bg_image ul li.1").show();	// show only the first one
		
		var targetID 	= 0;
		var interval 	= 0;
		var timeout		= 5000;
		var fadetime	= 1000;
		var title 		= "";
		
		var bgdummy		= "";
		
		bgdummy = $("#landingPage div.bg_image li." + 1 + " img").attr("src");
		$("#landingPage div.bg_image").css('background-image', 'url("'+ bgdummy +'")');
		
		$("#longLanding ul li a").click(function(event){
			event.preventDefault();
			$("#longLanding ul li a." + targetID).removeClass("current");
			bgdummy = $("#landingPage div.bg_image li." + targetID + " img").attr("src");
			$("#landingPage div.bg_image").css('background-image', 'url("'+ bgdummy +'")');
			
			targetID = $(this).attr("class");
			
			allBackground.hide();
			updateHeader();
			
			clearTimeout(interval);
			interval = 0;
			interval = setTimeout(function(){
				loopBGImage();
			},timeout);
		});
		
		function loopBGImage()
		{
			$("#longLanding ul li a." + targetID).removeClass("current");
			bgdummy = $("#landingPage div.bg_image li." + targetID + " img").attr("src");
			$("#landingPage div.bg_image").css('background-image', 'url("'+ bgdummy +'")');
			
			if(targetID >= 7)
				targetID = 0;
			targetID++;
			
			allBackground.hide();
			updateHeader();
			
			interval = setTimeout(function(){
				loopBGImage();
			},timeout);
		}
		
		function updateHeader()
		{
			title = $("#longLanding ul li a." + targetID + " img").attr("alt");
			$("#longLanding h1").text(title);
			//$("#longLanding h1").hide();
			//$("#longLanding h1").fadeIn(fadetime);
			$("#longLanding h1").css("opacity",0);
			$("#longLanding h1").animate({opacity:1},fadetime);
			$("#landingPage div.bg_image ul li." + targetID).fadeIn(fadetime);
			$("#longLanding ul li a." + targetID).addClass("current");
		}
		
		loopBGImage();
		
}


function intro()
{
		$("#longLanding").hide();
		$("#shortLanding").show();
		
		
		$("#shortLanding h1").click(function()
		{	
			$("#shortLanding").animate(
				{ right: -400},
				500
			);
			
			$("#longLanding").css( "right", "-1000px");
			$("#longLanding").show();
			
			$("#longLanding").animate(
				{ right: 0},
				500
			);

		});
		
		$("#longLanding h1").click(function()
		{
			$("#longLanding").animate(
				{ right: -1000},
				500
			);
			
			$("#shortLanding").css( "right", "-400px");
			$("#shortLanding").show();
			
			$("#shortLanding").animate(
				{ right: 0},
				500
			);
		});
			
}