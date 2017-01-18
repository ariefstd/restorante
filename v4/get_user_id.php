<?php
	if(empty($_POST['order']))	{		$data = array(
			"success" => false,
			"id" => ''
		);
		echo json_encode($data);		die();
	}		$data = array(
		"success" 	=> true,		"id" => $_POST['order']
	);	
	echo json_encode($data);
?>