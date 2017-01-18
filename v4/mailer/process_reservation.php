<?php

	//error_reporting(E_ALL);
	error_reporting(E_STRICT);
	
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	require_once('includes/class.phpmailer.php');
	include("includes/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

	$name 			= $_REQUEST['name'];
	$email 			= $_REQUEST['email'];
	$phone 			= $_REQUEST['phone'];
	$phone2 		= $_REQUEST['phone2'];
	$no_people 		= $_REQUEST['no_people'];
	$budget 		= $_REQUEST['budget'];
	$event_type 	= $_REQUEST['event_type'];
	$catering_type 	= $_REQUEST['catering_type'];
	$date 			= $_REQUEST['date'];
	$time 			= $_REQUEST['time'];
	$address 		= $_REQUEST['address'];
	$message 		= $_REQUEST['message'];	
	
	$body             = file_get_contents('reservation_copy.html');
	$body             = eregi_replace("[\]",'',$body);
	
	$body = str_replace('%%NAME%%', $name, $body ) ;
	$body = str_replace('%%EMAIL%%', $email, $body ) ;
	$body = str_replace('%%PHONE%%', $phone, $body ) ;
	$body = str_replace('%%PHONE2%%', $phone2, $body ) ;
	
	$body = str_replace('%%PEOPLE%%', $no_people, $body ) ;
	$body = str_replace('%%BUDGET%%', $budget, $body ) ;
	$body = str_replace('%%EVENT%%', $event_type, $body ) ;
	$body = str_replace('%%CATERING%%', $catering_type, $body ) ;
	$body = str_replace('%%DATE%%', $date, $body ) ;
	$body = str_replace('%%TIME%%', $time, $body ) ;
	$body = str_replace('%%ADDRESS%%', $address, $body ) ;
	$body = str_replace('%%MESSAGE%%', $message, $body ) ;


	
	
	
	$mail             = new PHPMailer(); // defaults to using php "mail()"
	
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "mail.nhkrestaurant.com"; // SMTP server
	$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Host       = "mail.nhkrestaurant.com"; // sets the SMTP server
	$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
	$mail->Username   = ""; 					// SMTP account username
	$mail->Password   = "";        				// SMTP account password
	

	
	$receiver = "nhk.enquiry@nhkrestaurant.com";
	$receiver_name = "New Hong Kong Restaurant";
	
	$mail->AddAddress($receiver, $receiver_name);
	$mail->AddCC("frances.lee@nhkrestaurant.com", "");
	$mail->AddCC("joe.tham@nhkrestaurant.com", "");
	$mail->AddCC("nancy.koh@nhkrestaurant.com", "");
	$mail->AddCC("sally.ng@nhkrestaurant.com", "");
	$mail->AddCC($email, "");
	$mail->SetFrom($email, $name);
	$mail->AddReplyTo($email, $name);
	$mail->Subject = "NHK Restaurant: Reservation Form";
	$mail->MsgHTML($body);
	//$mail->Send();
	//$mail->ClearAddresses();
		
		
	/*
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
	$mail->Subject    = "NHK Restaurant: Reservation Form";
	
	$mail->MsgHTML($body);
	*/
	if($mail->Send()) {
		echo "success";
	} else {
	  	echo "failed".$mail->ErrorInfo;
	}
	
?>