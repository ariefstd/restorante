<?php	include_once "open_db.php";	$sql = "SELECT * 			FROM catering_type			ORDER BY cateringtype_name			";	$cat =mysqli_query($con,$sql)or die(mysqli_error($con));		$sql = "SELECT * 			FROM event			ORDER BY event_name			";	$eve =mysqli_query($con,$sql)or die(mysqli_error($con));		?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="style/mystyle.css" rel="stylesheet" type="text/css" />
<link href="style/form_style.css" rel="stylesheet" type="text/css" />
<script src="js/vendor/jquery-1.5.1.min.js"></script>
<script src="js/order.js"></script>

</head>

<body>
<?php
	$menu_id = $_GET['menu'];
	$sqlstr = "SELECT * FROM menu WHERE menu_id = ".$menu_id."";
	$result =mysqli_query($con,$sqlstr)or die(mysqli_error($con));
	//echo $_GET['menu'];
?>
<form action="#" id="reservationForm" method="post">
<input name="menu" type="text" id="menu" value='<?=$_GET['menu']?>' />
<?php
while ($rows = mysqli_fetch_array($result)) 
{
?>		
<input name="menu_name" type="text" id="menu" value='<?php echo $rows['menu_name'];?>' /> 
<?php
}	
?>
<table width="480" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="450" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="5" class=""></td>
      </tr>
      <tr>
        <td height="5" class=""></td>
      </tr>
      <tr>
        <td height="5" class="lineH">Order</td>
      </tr>
      <tr>
        <td><table width="450" border="0" align="center" cellpadding="0" cellspacing="0">          <tr>            <td height="19" colspan="5" align="left" class="signika_14a">            <div class="note3" id="reservationThanks">THANKS! Your order has been successfully sent.<br />We will be in touch with you soon.<br><a href="#">close</a></div>           <div class="note3" id="reservationFail">SORRY! Your request has been not be sent.<br />Please try again later.</div>            </td>          </tr>
          <tr>
            <td height="19" align="left" class="signika_14a">First Name</td>
            <td width="20" height="19"></td>
            <td colspan="3"><span class="signika_14a">Last Name </span></td>
          </tr>
          <tr>
            <td width="215" height="19" align="left" class="arial12_brown">				<input required='required' name="first" type="text" class="arialgray_12a" id="first" style="width:210px;" maxlength="255"/>			</td>            <td height="19"><label for="textfield16"></label></td>            <td height="19" colspan="3"><span class="arial12_brown">              <input name="last" type="text" class="arialgray_12a" id="last" style="width:210px;"  maxlength="255"/>            </span></td>
          </tr>          <tr>            <td height="19" align="left"><div class="error" id="nameError">* Please enter a valid name.</div></td>            <td width="20" height="19"></td>            <td colspan="3"></td>          </tr>
          <tr>            <td height="10" colspan="5" class="arial12_brown"></td>          </tr>
          <tr>
            <td height="19" align="left" class="signika_14a">Contact</td>
            <td height="19"></td><td colspan="3"><span class="signika_14a">Email</span></td>
          </tr>
          <tr>
            <td height="19" align="left" class="arial12_brown">				
             <?php
			//$menu='';

			?>
            	<input required='required' name="telp" type="text" class="arialgray_12a" id="telp" style="width:210px;" maxlength="12"/>			
			
            </td>
   <td height="19"></td>            <td height="19" colspan="3"><span class="arial12_brown">              <input required='required' name="email" type="text" class="arialgray_12a" id="email" style="width:210px;" />          </span></td>
          </tr>
          <tr>          	<td height="19" align="left" valign="top"><div class="error" id="phoneError">* Please enter a valid contact.</div></td>            <td height="19"></td>            <td height="19" colspan="3"><div class="error" id="emailError">* Please enter a valid email.</div></td>          </tr>
          <tr>
            <td height="19" align="left" class="signika_14a">Type of Event</td>
            <td height="19"></td>
            <td colspan="3"><span class="signika_14a">Type of Catering</span></td>

          </tr>
          
          <tr>
            <td height="19" align="left" class="arial12_brown"><label for="select"></label>
              <select name="event" class="arialgray_12a" id="event" style="width:210px;">				<?php								while ($row = mysqli_fetch_assoc($eve)) 				{								?>
					<option value="<?=$row['event_id']?>"><?=$row['event_name']?></option>				<?php				}				?>
              </select></td>
            <td height="19"><label for="textfield17"></label></td>
            <td height="19" colspan="3"><span class="arial12_brown">
              <select name="catering" class="arialgray_12a" id="catering" style="width:210px;">				<?php								while ($row = mysqli_fetch_assoc($cat)) 				{								?>
					<option value="<?=$row['cateringtype_id']?>"><?=$row['cateringtype_name']?></option>
					
									<?php				}				?>
              </select>
            </span></td>
          </tr>
             
          <tr>
            <td height="10" colspan="5" class="arial12_brown"></td>
          </tr>
          <tr>
            <td height="19" align="left" class="signika_14a">Date of Event</td>
            <td height="19"></td>
            <td colspan="3"><span class="signika_14a">Time of Event</span></td>
          </tr>
          <tr>
            <td height="19" align="left" class="arial12_brown"><label for="select"></label>
              <select name="month" id="month" class="arialgray_12a">
                <option value="Jan">Jan </option>                <option value="Feb">Feb </option>                <option value="Mar">Mar </option>                <option value="April">April </option>                <option value="May">May </option>                <option value="June">June </option>                <option value="July">July </option>                <option value="Aug">Aug </option>                <option value="Sep">Sep </option>                <option value="Oct">Oct </option>                <option value="Nov">Nov </option>                <option value="Dec">Dec </option>
              </select>
              <select name="day" id="day" class="arialgray_12a">
                <option value="1">1 </option>                <option value="2">2 </option>                <option value="3">3 </option>                <option value="4">4 </option>                <option value="5">5 </option>                <option value="6">6 </option>                <option value="7">7 </option>                <option value="8">8 </option>                <option value="9">9 </option>                <option value="10">10 </option>                <option value="11">11 </option>                <option value="12">12 </option>                <option value="13">13 </option>                <option value="14">14 </option>                <option value="15">15 </option>                <option value="16">16 </option>                <option value="17">17 </option>                <option value="18">18 </option>                <option value="19">19 </option>                <option value="20">20 </option>                <option value="21">21 </option>                <option value="22">22 </option>                <option value="23">23 </option>                <option value="24">24 </option>                <option value="25">25 </option>                <option value="26">26 </option>                <option value="27">27 </option>                <option value="28">28 </option>                <option value="29">29 </option>                <option value="30">30 </option>                <option value="31">31 </option>
              </select>
              <select name="year" id="year" class="arialgray_12a">                <option value="2014">2014</option>                <option value="2015">2015</option>                <option value="2016">2016</option>                <option value="2017">2017</option>                <option value="2018">2018</option>                <option value="2019">2019</option>                <option value="2020">2020</option>                <option value="2021">2021</option>                <option value="2022">2022</option>                <option value="2023">2023</option>                <option value="2024">2024</option>                <option value="2025">2025</option>
              </select></td>
            <td height="19"><label for="textfield18"></label></td>
            <td height="19" colspan="3"><span class="arial12_brown">
              <select name="hour" id="hour" class="arialgray_12a">
                <option value="1">01</option>                <option value="2">02</option>                <option value="3">03</option>                <option value="4">04</option>                <option value="5">05</option>                <option value="6">06</option>                <option value="7">07</option>                <option value="8">08</option>                <option value="9">09</option>                <option value="10">10</option>                <option value="11">11</option>                <option value="12">12</option>
              </select>
              </span><span class="arial12_brown">
                <select name="minute" id="minute" class="arialgray_12a">
                  <option value="0">00</option>                  <option value="10">10</option>                  <option value="20">20</option>                  <option value="30">30</option>                  <option value="40">40</option>                  <option value="50">50</option>                  <option value="60">60</option>
                </select>
                </span><span class="arial12_brown">
                  <select name="ampm" id="ampm" class="arialgray_12a">
                    <option value="AM">AM</option>                    <option value="PM">PM</option>
                  </select>
                </span></td>
          </tr>
          
          <tr>            <td height="10" colspan="5" class="arial12_brown"></td>          </tr>
          <tr>            <td height="19" colspan="5" align="left" class="signika_14a">Address</td>          </tr>
          <tr>
            <td height="19" colspan="5" align="left" class="arial12_brown">				<input required='required' name="address" type="text" class="arialgray_12a" id="address" style="width:440px;" maxlength="255"/>			</td>
          </tr>          <tr>          <td colspan="5"><div class="error" id="addressError">* Please enter an address.</div></td>          </tr>
          <tr>
            <td height="10" colspan="5" class="arial12_brown"></td>
          </tr>
          <tr>
            <td height="19" colspan="5" align="left" valign="top" class="signika_14a">Message</td>
          </tr>
          <tr>
            <td height="19" colspan="5" align="left" valign="top" class="arial12_brown">				<textarea name="message" rows="4" class="arialgray_12a" id="message" style="width:445px; height:60px;"  maxlength="255"></textarea>			</td>
          </tr>
          
          <tr>
            <td height="10" colspan="5" class="arial12_brown" style="background-image:url(images/line_dot10.gif)"></td>
          </tr>
          <tr>
            <td height="19" colspan="5" align="right" class="arial12_brown">
            <input name="button" type="submit" class="clean-gray" id="reservation_btn" value="Submit" />
            <input name="button" type="button" class="clean-gray" id="reservationFail" value="Close" />
			</td>
          </tr>
          <tr>
            <td height="10" colspan="5"></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
