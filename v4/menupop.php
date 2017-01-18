<?php

	include_once "open_db.php";
	$sql = "SELECT * FROM
  `package`
  INNER JOIN `menu_type` ON `package`.`id_main_category` =
    `menu_type`.`package_id`
  INNER JOIN `menu` ON `menu_type`.`menutype_id` = `menu`.`menu_typeid`
WHERE
  `menu`.`menu_typeid`=".$_GET['cat']."
			";
	$det =mysqli_query($con,$sql)or die(mysqli_error($con));
	$det = mysqli_fetch_assoc($det);
	
	$sql = "SELECT * FROM
  `package`
  INNER JOIN `menu_type` ON `package`.`id_main_category` =
    `menu_type`.`package_id`
  INNER JOIN `menu` ON `menu_type`.`menutype_id` = `menu`.`menu_typeid`
WHERE
  `menu`.`menu_typeid` = ".$_GET['cat']." AND menu_isactive=1 AND menu_isdeleted!=1
			ORDER BY menu_name
			";

	$result =mysqli_query($con,$sql)or die(mysqli_error($con));
	
	
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head id="www-sitename-com" data-template-set="html5-reset">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>New Hong Kong Restaurant </title>
    
    <meta name="title" content="">
    <meta name="description" content="">

    <link rel="stylesheet" href="assets/css/mystyle.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/font.css">
	
    <script src="assets/js/modernizr-1.7.min.js"></script>
    <script src="js/vendor/jquery-1.5.1.min.js"></script>
    <script src="js/vendor/jquery.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Open+Sans::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>
<style>
.hrt{
z-index:100;

color:#e9c787;
font-size:14pt;
font-family:"times_italic";
font-size:24pt;

}
</style> 

	<script>
	$(document).ready(function () {
		$("input[class='ids']").change(function () {
			var maxAllowed = 2;
			var cnt = $("input[class='ids']:checked").length;
			if ((cnt > maxAllowed)) {

				$(this).prop("checked", "");
				//$(this).hide();
				$('.checkbox:hidden').prop('checked', false);
							
				//$("input:checkbox:not(:checked)").closest('div').slideUp(); 
				//alert('You can select maximum ' + maxAllowed + ' technologies!!');
			}
		});
	});

	</script>


</head>

<body >
	<div style="border:31px solid;border-color:#fff;">


<table width="100%" style="background-color:#fff;font-size:10pt;text-align:justify;">
		<tr>
			<td colspan="3" style="border-bottom:1px solid;border-color:#e9c787;">
			<span class="hrt"><?php echo $det['menutype_id']?> - <?php echo $det['menutype_name']?> &nbsp; - &nbsp; RM<?php echo $det['price']?></span>
			</td>
		</tr>
		
	<tr>
		<td rowspan="2" style="width:25%;"><img src="<?php echo $det['menutype_path']?>"></img></td>
		<td colspan="2" style="vertical-align:top;">
			<span style="color:grey;font-family: 'Open Sans', sans-serif;"><?=$det['menutype_description']?></span>
		</td>		
	</tr>

	<tr>		
		<td colspan="2" valign="top">
			<table style="float: none;top:0px">
			<tr>
				<td><hr></td>
			</tr>					
			<tr style="color:grey;font-family: 'Open Sans', sans-serif;">
				<td>Main Course Menu</td>
			</tr>
			<tr>
				<td><hr></td>
			</tr>						
			<?php
			$cek="checked='checked'";
			$menu='';
			$name='';
			while ($row = mysqli_fetch_assoc($result)) 
			{
				if($cek!='')
					$menu=$row['menu_id'];
					$name=$row['menu_name'];
			?>			
				<tr valign="top">					
					<td style="width:100%;">
					<span style="color:grey;font-family: 'Open Sans', sans-serif;">
						<label for='radio_<?=$row['menu_id']?>'><?=$row['menu_name']?></label>
					</span> 
					</td>
					<td align="right" style="width:25%;">
					<label class="radio-inline" style="float: right; margin-right: 15px;"> 
					<input type="checkbox" class="ids" id="weleh" name="menuid[]" onchange="pick(<?=$row['menu_id']?>);" value="<?=$row['menu_id']?>"/>
					<!-- <input type="checkbox" name="menutype[]" value="<?=$row['menutype_id']?>" class="ids" onchange="pick(<?=$row['menu_id']?>);"/> -->
					</label>
					</td>			
				</tr>
			<?php
				$cek='';
			}
			?>

			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td><hr></td>
			</tr>
			<tr>
				<td>
			<?php
			if(!empty($menu))
			{
			?>
	
				<!-- <a id='link' href='client.php?menu=<?=$menu?>' class="fancybox" ><button style="border:1px solid;height:34px;width:111px;background:#7b5919;color:#fff;border-color:#7b5919;float:right;" type="button" class="btn btn-default">Submit </button></a> -->
				<a id='link' href='reservation.html' class="fancybox" ><button style="border:1px solid;height:34px;width:111px;background:#7b5919;color:#fff;border-color:#7b5919;float:right;" type="button" class="btn btn-default">Submit </button></a>

			<?php
			}
			?>							
			<?php
			if (!empty($name)){
			?>

<div id="response"></div>
<input type="text" name="menutype" value="<?php echo $det['menutype_id'] ?>" />
<!--
<button id="submit">Submit</button>
-->
			<?php } ?>			
				</td>
			</tr>													
			</table>			

		</td>

	</tr>
	
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>		
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>		
</table>


	</div>
	<!-- eol:wrapper -->

	<script>
		function pick(id)
		{
			$('#link').attr('href','client.php?menu='+id);
		}
	</script>

<script>

$('.ids').click(function() {
$.ajax({
    url: "do_client.php",
    type: "post",
    data: $('.ids:checked').serialize(),
    success: function(data) {
    $('#response').html(data);
    }
});


});
</script>
    

</body>
</html>
