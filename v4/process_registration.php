<?php

	include_once "open_db.php"; 
	
	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	require_once('mailer/includes/class.phpmailer.php');
	include("mailer/includes/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	
	
	$full_name = htmlspecialchars(strip_tags($_POST['full_name']));
	$ic_passport = htmlspecialchars(strip_tags($_POST['ic_passport']));
	$gender = htmlspecialchars(strip_tags($_POST['gender']));
	$email = htmlspecialchars(strip_tags($_POST['email']));
	$contact_no = htmlspecialchars(strip_tags($_POST['contact_no']));
	$mobile_no_1 = htmlspecialchars(strip_tags($_POST['mobile_no_1']));
	$mobile_no_2 = htmlspecialchars(strip_tags($_POST['mobile_no_2']));
	$nationality = htmlspecialchars(strip_tags($_POST['nationality']));
	$occupation = htmlspecialchars(strip_tags($_POST['occupation']));
	$username = htmlspecialchars(strip_tags($_POST['username']));
	$password = htmlspecialchars(strip_tags($_POST['password']));
	$address = htmlspecialchars(strip_tags($_POST['address']));
	$mailing_add = htmlspecialchars(strip_tags($_POST['mailing_add']));
	$card_collection = htmlspecialchars(strip_tags($_POST['card_collection']));
	$dob = htmlspecialchars(strip_tags($_POST['dob']));
	
	
	$sql = "SELECT * FROM membership WHERE username='$username' LIMIT 1";
	$result = mysql_query($sql)or die(mysql_error());
	
	if(mysql_num_rows($result) != 0)
	{
		$data = array(
		"success" => false,
		"error" 	=> "Sorry, username exist in our database."
		);
		
		echo json_encode($data);
		die();
	}
	
	if(isset($dob))
	{
		$seperator = explode("/",$dob);
		$new_date = $seperator[2]."-".$seperator[1]."-".$seperator[0];
		$dob = $new_date;
	}
	
	$date_join = time();
	$expiry_date = time();
	$status = 'inactive';
	$is_deleted = 0;
	
	$sql = "INSERT INTO membership (dob,full_name,ic_passport,gender,email,contact_no,mobile_no_1,mobile_no_2,nationality,occupation,username,password,address,mailing_add,card_collection,date_join,expiry_date,status,is_deleted) 
	VALUES ('$dob','$full_name','$ic_passport','$gender','$email','$contact_no','$mobile_no_1','$mobile_no_2','$nationality','$occupation','$username','$password','$address','$mailing_add','$card_collection','$date_join','$expiry_date','$status','$is_deleted')";
	$result = mysql_query($sql)or die(mysql_error());
		
	
	$data = array(
		"success" => true,
		"url" 	=> "payment.html"
	);
	
	$receiver = "membership@nhkrestaurant.com";
	$receiver_name = "New Hong Kong Restaurant";
	
	
	
	
	
	if(!empty($email))
	{
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
		
		
		
		$body = file_get_contents('user_registration_confirmation.html');
		$body = eregi_replace("[\]",'',$body);

		//$mail->AddReplyTo($receiver, $receiver_name);
		$mail->AddAddress($email, $full_name);
		$mail->SetFrom($receiver, $receiver_name);
		$mail->AddReplyTo($receiver, $receiver_name);
		$mail->Subject = "NHK: Registration Success";
		$mail->MsgHTML($body);
		$mail->Send();
		$mail->ClearAddresses();
		
		//echo $mail->ErrorInfo;
		
		$body = file_get_contents('client_registration_acknowledge.html');
		$body = eregi_replace("[\]",'',$body);
		
		$body = str_replace('%%NAME%%', $full_name, $body ) ;
		$body = str_replace('%%EMAIL%%', $email, $body ) ;

		//$mail->AddReplyTo($email, $full_name);
		$mail->AddAddress($receiver, $receiver_name);
		$mail->SetFrom($email, $full_name);
		$mail->AddReplyTo($email, $full_name);
		$mail->Subject = "NHK: New Registration";
		$mail->MsgHTML($body);
		$mail->Send();
		$mail->ClearAddresses();
		
		//echo $mail->ErrorInfo;
	}
	
	echo json_encode($data);
	
	

?>