<?php

	include_once "open_db.php"; 
	
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	require_once('mailer/includes/class.phpmailer.php');
	include("mailer/includes/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	
		
	$email = htmlspecialchars(strip_tags($_POST['email']));
	
	$sql = "SELECT * FROM membership WHERE email='$email' LIMIT 1";
	$result =mysql_query($sql)or die(mysql_error());
	
	if(mysql_num_rows($result) == 0)
	{
		$data = array(
			"success"	=> false
		);
	}
	else
	{
		
		while ($row = mysql_fetch_assoc($result)) {	
			$password = $row['password'];
			$email = $row['email'];
		}	
		
		$data = array(
			"success" => true
		);
		
		
		$receiver = "membership@nhkrestaurant.com";
		$receiver_name = "New Hong Kong Restaurant";
		
		$mail = new PHPMailer(); 
		
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host       = "mail.nhkrestaurant.com"; // SMTP server
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
												   // 1 = errors and messages
												   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Host       = "mail.nhkrestaurant.com"; // sets the SMTP server
		$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
		$mail->Username   = ""; 					// SMTP account username
		$mail->Password   = "";        				// SMTP account password
		
		$body = file_get_contents('user_password_recovery.html');
		$body = eregi_replace("[\]",'',$body);
		
		$body = str_replace('%%EMAIL%%', $email, $body ) ;
		$body = str_replace('%%PASSWORD%%', $password, $body ) ;

		//$mail->AddReplyTo($receiver, $receiver_name);
		$mail->AddAddress($email, $full_name);
		$mail->SetFrom($receiver, $receiver_name);
		$mail->AddReplyTo($receiver, $receiver_name);
		$mail->Subject = "NHK: Password Recovery";
		$mail->MsgHTML($body);
		$mail->Send();
		$mail->ClearAddresses();
		
	}
	
	echo json_encode($data);

?>