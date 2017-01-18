<?php
session_start();
require("open_db.php");
$user = htmlspecialchars(strip_tags($_POST['username']));
$pwd = htmlspecialchars(strip_tags($_POST['password']));
$sql = "SELECT * FROM membership WHERE username='$user' AND password='$pwd' AND is_deleted = 0 AND status='active' LIMIT 1";
$result =mysql_query($sql);
var_dump(mysql_num_rows($result));
if(mysql_num_rows($result) == 0)
{
	$data = array(
		"success"	=> false,
		"error" => '*Wrong username and password. Please try again.'
		);
}
else
{
	$_SESSION['isLogin'] 	= true;
	while ($row = mysql_fetch_assoc($result)) {
		$_SESSION['id'] 	= $row["id"];
	}
	$data = array(
		"success" => true,
		"url" 		=> "profile.html"
		);
}
echo json_encode($data);
?>
