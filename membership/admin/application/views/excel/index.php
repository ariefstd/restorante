<table border='1' width="70%">
<tr>
<td>NO</td>
<td>PACKAGE</td>
<td>MENU</td>
<td>DATE & TIME ORDER</td>
<td>DATE & TIME EVENT</td>
<td>CLIENT</td>
<td>AVAILABLE</td>
<td>STATUS</td>
</tr>
<?php
$count = 1;
foreach($test as $row) {
	$package = $row['name_package'];
	$menu_name = $row['menu_name'];
	$order_date = $row['order_date'];
	$order_time = $row['order_time'];
	$event_date = $row['event_date'];
	$event_time = $row['event_time'];
	$first_name = $row['client_firstname'];
	$last_name = $row['client_lastname'];
	$minimum_order = $row['minimum_order'];
	$order_status = $row['orderstatus_name'];
	$client_email = $row['client_email'];
	$client_contact = $row['client_contact'];
?>
<tr>
<td><?=$count; ?></td>
<td><?=$package; ?></td>
<td><?=$menu_name ?></td>
<td><?=$order_date." ".$order_time ?></td>
<td><?=$event_date." ".$event_time ?></td>
<td><?=$first_name." ".$last_name ?></td>
<td><?=$minimum_order; ?></td>
<td><?=$order_status ?></td>
</tr>

<?php $count++; ?>
<?php
$micro_date = microtime();
$date_array = explode(" ",$micro_date);
$date = date("H:i:s",$date_array[1]);
//echo "Date: $date:" . $date_array[0]."<br>";
?>
<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$date.$date_array[0].".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<?php } ?>
</table>