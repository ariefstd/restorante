<?php

	session_start(); 	
	
	if(empty($_SESSION['isLogin']))
	{
		$data = array(
			"success" => false,
			"id" => ''
		);
		echo json_encode($data);
		
		die();
	}
	
	$isLogin = $_SESSION['isLogin'];
	$uid = $_SESSION['id'];
	
	$data = array(
			"success" 	=> true,
			"id" => $uid
		);
	
	echo json_encode($data);

?>