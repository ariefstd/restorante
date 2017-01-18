<?php
$dbhost = 'localhost';//110.4.46.101
$dbuser = 'dev5_admin';//raydencha_rayden	nhk_cms
$dbpass = 'dev5admin';//5qHFrjSN	698230
$dbname = 'dev5_nhk';//raydencha_beaubelle	nhk_cms	raydencha_nhkcms
$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (mysqli_connect_errno()){
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
?>
