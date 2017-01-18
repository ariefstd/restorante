<?php

	include_once "open_db.php"; 
	session_start(); 	
	
	if(empty($_SESSION['isLogin']))
	{
		$data = array(
			"success" => false,
			"url" 	=> "login.html"
		);
		echo json_encode($data);
		
		die();
	}
	
	$isLogin = $_SESSION['isLogin'];
	$uid = $_SESSION['id'];
	
	$sql = "SELECT * FROM membership WHERE id='$uid' LIMIT 1";
	$result =mysql_query($sql)or die(mysql_error());
	
	if(mysql_num_rows($result) == 0)
	{
		$data = array(
			"success" => false,
			"url" 	=> "login.html"
		);
	}
	else
	{
		$records = mysql_fetch_assoc($result);
		$records['date_join'] = date("d/m/Y",$records['date_join']);
		$records['expiry_date'] = date("d/m/Y",$records['expiry_date']);
		
		$data = array(
			"success" 	=> true,
			"record"	=> $records
		);
	}
	
	echo json_encode($data);

?>