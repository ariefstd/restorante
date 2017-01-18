<!doctype html>
<html class="no-js" lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>New Hong Kong Restaurant | CMS</title>
    
    <meta name="title" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="<?php echo base_url("assets/img/favicon.ico"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/style.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/global.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/global-theme.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/css/font.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/js/jqueryui/css/smoothness/jquery-ui-1.9.2.custom.min.css"); ?>">
    
    <link rel="stylesheet" href="<?php echo base_url("assets/js/fancybox/jquery.fancybox.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assets/js/fancybox/helpers/jquery.fancybox-buttons.css"); ?>">
    
    <script src="<?php echo base_url("assets/js/modernizr-1.7.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/jquery-1.8.2.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/jqueryui/js/jquery-ui-1.9.2.custom.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/tiny_mce/tiny_mce.js"); ?>"></script>
    
    <script src="<?php echo base_url("assets/js/jquery.easing.compatibility.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/fancybox/jquery.fancybox.js"); ?>"></script>
    <script src="<?php echo base_url("assets/js/fancybox/helpers/jquery.fancybox-buttons.js"); ?>"></script>
    
	<script>
	
	$(document).ready(function (){
    	$('.fancybox').fancybox();
		$("#printpost").fancybox({'type' : 'iframe', 'width' : '500', 'autoScale' : false});
		$("#btnTemplate").fancybox({
			'type':'iframe',
			'afterClose' : function() {
              window.location.reload();
              }
		});
		tinyMCE.init({
			theme : "advanced",
			mode : "textareas",
			formats: { bold : {inline : 'b' }},
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,link,unlink,code",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
        	editor_deselector : "mceNoEditor"
			//theme_advanced_disable : "image,hr,anchor,removeformat,help,formatselect,cleanup,visualaid,styleselect,charmap,sub,sup",
			
		});
	});
	
	</script>
    
    <script src="<?php echo base_url("assets/js/account_profile.js"); ?>"></script>
	<script src="<?php echo base_url("assets/js/account_password.js"); ?>"></script>

    
    <?php
		if($current_page == "login" || $current_page == "logout" || $current_page == "expired" && $current_page != "popup")
		{
			?>
				<link rel="stylesheet" href="<?php echo base_url("assets/css/login.css"); ?>">
    			<script src="<?php echo base_url("assets/js/login.js"); ?>"></script>
            <?php
		}
	?>
    

</head>
<body>

<?php

	if(isset($current_page))
	{
		if($current_page != "login" && $current_page != "logout" && $current_page != "expired" && $current_page != "popup")
		{
			$this->load->view('index_view');
		}
	}
			
?>

