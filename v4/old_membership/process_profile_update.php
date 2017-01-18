<?php

	include_once "open_db.php"; 
	
	$id = htmlspecialchars(strip_tags($_POST['id']));
	$nationality = htmlspecialchars(strip_tags($_POST['nationality']));
	$full_name = htmlspecialchars(strip_tags($_POST['full_name']));
	$gender = htmlspecialchars(strip_tags($_POST['gender']));
	$email = htmlspecialchars(strip_tags($_POST['email']));
	$contact_no = htmlspecialchars(strip_tags($_POST['contact_no']));
	$mobile_no_1 = htmlspecialchars(strip_tags($_POST['mobile_no_1']));
	$mobile_no_2 = htmlspecialchars(strip_tags($_POST['mobile_no_2']));
	$address = htmlspecialchars(strip_tags($_POST['address']));
	$mailing_add = htmlspecialchars(strip_tags($_POST['mailing_add']));

	
	$sql = "UPDATE membership SET nationality='$nationality',full_name='$full_name',gender='$gender',email='$email',contact_no='$contact_no',mobile_no_1='$mobile_no_1',mobile_no_2='$mobile_no_2',address='$address',mailing_add='$mailing_add' WHERE id='$id'";
	
	$result =mysql_query($sql)or die(mysql_error());
	
	if(!$result)
	{
		$data = array(
			"success"	=> false,
			"error" 	=> "Sorry, update failed."
		);
	}
	else
	{
		
		$data = array(
			"success" => true,
			"url" 	=> "profile.html"
		);	
		
	}
	
	echo json_encode($data);

?>