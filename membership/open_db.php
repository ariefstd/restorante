<?php

$dbhost = '110.4.46.101';//110.4.46.101
$dbuser = 'nhkuser';//raydencha_rayden	nhk_cms
$dbpass = '123456';//5qHFrjSN	698230

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or  die('Could not connect: ' . mysql_error());

$dbname = 'nhkcms';//raydencha_beaubelle	nhk_cms	raydencha_nhkcms
mysql_select_db($dbname);

?>
