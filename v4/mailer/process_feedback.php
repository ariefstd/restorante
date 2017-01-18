<?php

	//error_reporting(E_ALL);
	error_reporting(E_STRICT);
	
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	require_once('includes/class.phpmailer.php');
	include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

	$name 		= $_REQUEST['name'];
	$email 		= $_REQUEST['email'];
	$phone 		= $_REQUEST['phone'];
	$message 	= $_REQUEST['message'];
	
	$first_visit 	= $_REQUEST['first_visit'];
	$satisfy 		= $_REQUEST['satisfy'];
	$services 		= $_REQUEST['services'];
	$ambience 		= $_REQUEST['ambience'];
	$recommend 		= $_REQUEST['recommend'];
	$recommend_no 	= $_REQUEST['recommend_no'];
	
	$body             = file_get_contents('feedback_copy.html');
	$body             = eregi_replace("[\]",'',$body);
	
	$body = str_replace('%%NAME%%', $name, $body ) ;
	$body = str_replace('%%EMAIL%%', $email, $body ) ;
	$body = str_replace('%%PHONE%%', $phone, $body ) ;
	$body = str_replace('%%MESSAGE%%', $message, $body ) ;
	
	$body = str_replace('%%VISIT%%', $first_visit, $body ) ;
	$body = str_replace('%%SATISFY%%', $satisfy, $body ) ;
	$body = str_replace('%%SERVICES%%', $services, $body ) ;
	$body = str_replace('%%AMBIENCE%%', $ambience, $body ) ;
	$body = str_replace('%%RECOMMEND%%', $recommend, $body ) ;
	$body = str_replace('%%REASON%%', $recommend_no, $body ) ;

	$mail             = new PHPMailer(); // defaults to using php "mail()"
	
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "mail.nhkrestaurant.com"; 		// SMTP server
	//$mail->SMTPDebug  = 2;                     			// enables SMTP debug information (for testing)
											   			// 1 = errors and messages
											   			// 2 = messages only
	$mail->SMTPAuth   = true;                  			// enable SMTP authentication
	$mail->SMTPSecure = "tls";                 			// sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      			// sets GMAIL as the SMTP server
	$mail->Port       = 587;                   			// set the SMTP port for the GMAIL server
	$mail->Username   = "nhkrestaurant@gmail.com";  	// GMAIL username
	$mail->Password   = "nhk@2012";           			// GMAIL password
	
	//$mail->AddReplyTo($email, $name);
	$mail->AddAddress("nhkrestaurant@gmail.com", "NHK Restaurant");
	$mail->SetFrom("nhkrestaurant@gmail.com", "NHK Restaurant");
	$mail->AddReplyTo($email, $name);
	$mail->Subject    = "NHK Restaurant: Feedback Form";
	
	$mail->MsgHTML($body);
	
	if($mail->Send()) {
		echo "success";
	} else {
	  	echo "failed".$mail->ErrorInfo;
	}
	
?>