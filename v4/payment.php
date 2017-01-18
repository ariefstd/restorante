<?php	$order_id=$_GET['order'];		include_once "open_db.php"; 		$sql = "SELECT * 			FROM `order`			LEFT JOIN order_detail ON orderdetail_orderid=order_id			LEFT JOIN menu ON menu_id=orderdetail_menuid			LEFT JOIN menu_type ON menutype_id=menu_typeid			WHERE order_id=$order_id AND order_statusid=2			";	$result =mysqli_query($con,$sql)or die(mysqli_error($con));	$order = mysqli_fetch_assoc($result);		$price=$order['order_totalprice']/2;	?><!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head id="www-sitename-com" data-template-set="html5-reset">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>New Hong Kong Restaurant</title>
    
    <meta name="title" content="">
    <meta name="description" content="">

    <link rel="stylesheet" href="membership/assets/css/style.css">
    <link rel="stylesheet" href="membership/assets/css/global.css">
    <link rel="stylesheet" href="membership/assets/css/font.css">
    <script src="js/vendor/jquery-1.5.1.min.js"></script>

</head>
<body>
	<div id="main_wrapper">		
        <div class="header">
        	<h1>Payment</h1>
        </div>
        
        <div class="promo">
   	    <img src="membership/assets/img/promo.png" width="480" height="212">
        </div>
        		<?php		if(!empty($order))		{		?>
			<div class="container">
				<table>
					<tr>
						<td width="80"><strong>Your Order</strong></td>
						<td>: [<?=$order['menutype_name']?>] <?=$order['menu_name']?> (RM <?=$order['order_totalprice']?>) </td>
					</tr>
				</table> 
				<div class="row" >				
					<form id="paypalForm" target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post"> 					
					<input type="hidden" name="cmd" value="_xclick">					
					<input type="hidden" name="no_note" value="1">					
					<input type="hidden" name="business" value="frances.lee@nhkrestaurant.com">										
					<input type="hidden" name="item_number" value="<?=$order_id?>-NHK Order">
					<input type="hidden" name="item_name" id="item_name" value="<?=$order['menutype_name']?>: <?=$order['menu_name']?>">
					<input type="hidden" name="amount" id="amount" value="<?=$price?>">					
					<input type="hidden" name="currency_code" value="MYR">										
					<input type="hidden" name="return" value="thank_you.php">					
					<input onclick='hide();' type="submit" class="paypal" id="paypal"  value="Continue"/>					
					</form>
				</div>
			</div>		<?php		}		?>
        
	</div>
	<!-- eol:wrapper -->	<script>		function hide()		{			$('#paypal').hide();		}	</script>
</body>
</html>
