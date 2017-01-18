<?php

	include_once "open_db.php"; 
	session_start(); 	
	
	$uid = $_SESSION['id'];
	$password = htmlspecialchars(strip_tags($_POST['password']));
	
	$sql = "UPDATE membership SET password='$password' WHERE id='$uid'";
	
	$result =mysql_query($sql)or die(mysql_error());
	
	if(!$result)
	{
		$data = array(
			"success"	=> false
		);
	}
	else
	{
		
		$data = array(
			"success" => true
		);	
		
	}
	
	echo json_encode($data);

?>