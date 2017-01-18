<?php


	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	require_once('mailer/includes/class.phpmailer.php');
	require_once("mailer/includes/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	

	$email = "squallray@hotmail.com";
	$full_name = "rayden";
	$receiver = "membership@nhkrestaurant.com";
	$receiver_name = "New Hong Kong Restaurant";
	
	
	if(!empty($email))
	{
		$mail = new PHPMailer(); 
		
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "mail.nhkrestaurant.com"; // SMTP server
		$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "mail.nhkrestaurant.com"; // sets the SMTP server
		$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
		$mail->Username   = ""; 					// SMTP account username
		$mail->Password   = "";        				// SMTP account password
		
		
		$body = file_get_contents('user_registration_confirmation.html');
		$body = eregi_replace("[\]",'',$body);
  
		$mail->AddReplyTo($receiver, $receiver_name);
		$mail->AddAddress($email, $full_name);
		$mail->SetFrom($receiver, $receiver_name);
		$mail->AddReplyTo($receiver, $receiver_name);
		$mail->Subject = "NHK: Registration Success";
		$mail->MsgHTML($body);
		$mail->Send();
		$mail->ClearAddresses();
		
		echo $mail->ErrorInfo;
		
		$body = file_get_contents('client_registration_acknowledge.html');
		$body = eregi_replace("[\]",'',$body);
		
		$body = str_replace('%%NAME%%', $full_name, $body ) ;
		$body = str_replace('%%EMAIL%%', $email, $body ) ;
  
		$mail->AddAddress($receiver, $receiver_name);
		$mail->SetFrom($email, $full_name);
		$mail->AddReplyTo($email, $full_name);
		$mail->Subject = "NHK: New Registration";
		$mail->MsgHTML($body);
		$mail->Send();
		$mail->ClearAddresses();
		
		echo $mail->ErrorInfo;
			
		
		
	}
	
	

?>