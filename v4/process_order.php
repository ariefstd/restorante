<?php
include_once "open_db.php";
$result =true;
$first=$_POST['first'];
$hp=$_POST['telp'];
$email=$_POST['email'];
$menu_name=$_POST['menu_name'];
$sql = "SELECT * FROM client WHERE client_firstname='$first' AND client_contact='$hp' AND client_isdeleted != 1 AND client_email='$email'LIMIT 1";
$temp=mysqli_query($con,$sql);
$check=mysqli_fetch_assoc($temp);
mysqli_autocommit($con,FALSE);
if(empty($check))
{
	$sql = "INSERT INTO `client`(`client_firstname`,`client_lastname`,`client_contact`,`client_email`,`client_address`)
	VALUES ('".$_POST['first']."','".$_POST['last']."','".$_POST['telp']."','".$_POST['email']."',				'".$_POST['address']."'			)";
	$result=mysqli_query($con,$sql);		
	$client_id=mysqli_insert_id($con);
}
else
{
	$client_id=$check['client_id'];		$sql = "			UPDATE `client`			SET 			  `client_lastname` = '".$_POST['last']."',			  `client_address` = '".$_POST['address']."'			WHERE `client_id` = '$client_id'			";
	$result=mysqli_query($con,$sql);
}
if($result)	{
	$sql = "INSERT INTO `order`(`order_date`,`order_time`,`event_date`,`event_time`,`order_address`,`order_message`,`order_clientid`,`order_statusid`,`order_eventid`,`order_cateringtypeid`)
	VALUES ('".date("Y-m-d")."','".date("H:i:s")."','".$_POST['date']."','".$_POST['time']."','".$_POST['address']."','".$_POST['message']."',".$client_id.",1,".$_POST['event'].",".$_POST['catering'].")";

	$result=mysqli_query($con,$sql);
	$order_id=mysqli_insert_id($con);

	if($result){
		$sql = "INSERT INTO `order_detail`(`orderdetail_menuid`,`orderdetail_orderid`)
		VALUES (".$_POST['menu'].",$order_id)";
		$result = $result && mysqli_query($con,$sql);
	}
}
else
	{		die(mysqli_error($con));	}
if($result)
{
	require_once('mailer/includes/class.phpmailer.php');
	include("mailer/includes/class.smtp.php");
	if(!empty($email))
	{
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host       = "smtp.gmail.com";
		$mail->SMTPDebug  = 0;
		$mail->SMTPAuth   = true;
		$mail->SMTPSecure = 'tls';

		$mail->Port       = 587;
		$mail->Username   = "nhkcal@gmail.com";
		$mail->Password   = "nhkcal12345";
		$mail->Priority    = 1;
		$mail->CharSet     = 'UTF-8';
		$mail->Encoding    = '8bit';

		$sql = "SELECT * FROM order_detail
		LEFT JOIN menu ON menu_id=orderdetail_menuid
		LEFT JOIN menu_type ON menutype_id=menu_typeid WHERE orderdetail_orderid='$order_id'
		ORDER BY menutype_name, menu_code";
		$temp=mysqli_query($con,$sql);
		$tr="";
		while ($row = mysqli_fetch_assoc($temp)) {
			$tr.="<tr><td align='left'>".$row['menutype_name'].":</td><td style='color:#0033FF;padding:5px 0 5px 0;'>[".$row['menu_code']."] ".$row['menu_name']."</td></tr>";
		//}
		$sql = "SELECT * FROM `order` LEFT JOIN client ON client_id=order_clientid LEFT JOIN event ON event_id=order_eventid LEFT JOIN catering_type ON cateringtype_id=order_cateringtypeid				WHERE order_id='$order_id'				";
$sqlstr = "INSERT INTO `order_status`(`orderstatus_name`) VALUES ('1')";
		
		//$sql = "INSERT INTO confirm_online VALUES ('".$_POST['email']."','".$_POST['contact']."','".$_POST['event_name']."','".$_POST['date']."','".$_POST['time']."','".$_POST['menu_name']."','".$_POST['minimum_order']."','1')";		
		
		$temp2=mysqli_query($con,$sql);
		$order=mysqli_fetch_assoc($temp2);
		$body = file_get_contents('mailer/order.html');
		$body = str_replace('%%NAME%%', $order['client_firstname'].' '.$order['client_lastname'], $body ) ;
		$body = str_replace('%%EMAIL%%', $order['client_email'], $body ) ;
		$body = str_replace('%%PHONE%%', $order['client_contact'], $body ) ;
		$body = str_replace('%%EVENT%%', $order['event_name'], $body ) ;
		$body = str_replace('%%CATERING%%', $order['cateringtype_name'], $body ) ;
		$body = str_replace('%%DATE%%', $order['order_date'], $body ) ;
		$body = str_replace('%%TIME%%', $order['order_time'], $body ) ;
                //$body = str_replace('%%AVAILABLE%%', $row['minimum_order'], $body ) ;
                   
                if ($row['minimum_order'] < 1) {
                   $body = str_replace('%%AVAILABLE%%', '0', $body ) ;
                }else{
                   $body = str_replace('%%AVAILABLE%%', $row['minimum_order'], $body ) ;
                }
		
        
        $body = str_replace('%%ADDRESS%%', $order['order_address'], $body ) ;
		$body = str_replace('%%MESSAGE%%', $order['order_message'], $body ) ;
                
		$body = str_replace('%%LIST%%', $tr, $body ) ;
		$man_email='shawn@wirednest.com';
		$personal_mail = 'ariefstd.2006@gmail.com';
		$personal_name = 'Mr. Gendonz Wemz';
		$man_name='Ms.Nancy';
		$mail->AddAddress($order['client_email'], $order['client_firstname'].' '.$order['client_lastname']);
		
		//$mail->AddCC($man_email, $man_name);
		$mail->addBCC($personal_mail, $personal_name);  
		$mail->SetFrom($mail->Username, 'New Hong Kong Restaurant');
		$mail->AddReplyTo($mail->Username, 'New Hong Kong Restaurant');
		$mail->Subject = "NHK: New Order";
		$mail->MsgHTML($body);
		if($mail->Send())
		{
			mysqli_commit($con);
			echo json_encode(array('msg'=>"success"));
		}
		else
		{
			mysqli_rollback($con);
			echo json_encode(array('msg'=>"failed"));
		}
            }
	}
	else
	{
		mysqli_rollback($con);
		echo json_encode(array('msg'=>"failed"));
	}
}
else
{
	mysqli_rollback($con);
	echo json_encode(array('msg'=>"failed"));
	die(mysqli_error($con));
}
mysqli_close($con);
?>
