<?php $id = $result['order_id'] ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>assets/calendar/css/jsDatePick_ltr.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/calendar/js/jsDatePick.min.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/calendar/js/demo.js"></script>

<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"inputField",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
</script>


<div class="tab-title"><h1>Order</h1></div>
<div class="content">   
	<div class="header">       
	<h2>Detail Order</h2>       
	<p style="padding-top:5px;">
	<a href="<?php echo base_url("index.php/order/"); ?>" class="buttonstyle1 green">View All Order</a>
	
	</p>
	</div>   
		<div class="error"></div>
		<?php //foreach($detail as $dt){ ?>
		 <form id="addAwards" accept-charset="utf-8" method="post" action="<?php echo base_url("index.php/order/order_edit/".$result['order_id']); ?>">
		 
		   	<input type="hidden" name="id" id="id" value="<?=$result['order_id']?>" />
		   	<input type="hidden" value="<?php echo $result['order_id']; ?>" name="menu_id" />	
		   	<input type="hidden" value="<?php echo $result['cateringtype_id']; ?>" name="menu_id" />
		   	
		   	<table cellpadding="0" cellspacing="0"  class="general_table" >		   	
		   		<tr>		   				   		
		   			<td width="130">Client Name</td>
		   			<td><?=$result['client_firstname'].' '.$result['client_lastname']?></td>
		   		</tr>
				<tr>
					<td width="130">Client Email</td>		
					<td><?=$result['client_email']?></td>    
		   		</tr>		   		
				<tr>		<td width="130">Client Phone</td>		<td>			<?=$result['client_contact']?>		</td>    
		   		</tr>
				<tr>		<td width="130">Event</td>		<td>			<?=$result['event_name']?>		</td>    </tr>
				
				<tr>		<td width="130">Catering Type</td>		<td>			<?=$result['cateringtype_name']?>		</td>    
		   		</tr>	
				<tr>		<td width="130">Package Type</td>		
					<td>
		   			<table>
		   			<?php foreach($showtablemenu as $showtable)
		   				{
		   			?>
		   				<input type="hidden" value="<?php echo $showtable['order_id']; ?>" name="idorder" />			
		   			<?php
		   					echo "<tr><td>".$showtable['name_package'].' ['.$showtable['price']."]</td></tr>";
		   				}	
		   			?>			
		   			</table>					
					</td>    
		   		</tr>			   					  				   		
				<tr>		<td width="130">Category Type</td>		
					<td>
		   			<table>
		   			<?php foreach($showtablemenu as $showtable)
		   				{
		   					echo "<tr><td>[".$showtable['name_main_category']."]</td></tr>";
		   				}	
		   			?>			
		   			</table>					
					
					</td>    
		   		</tr>	
		   		
		   		<tr>
		   			<td width="130">Date & Time</td>		
		   			<td><?=$result['order_date'].' '.$result['order_time']?></td>    
		   		</tr>
		   		<tr>
		   			<td width="130">Address</td>
		   			<td><?=$result['order_address']?></td>    
		   		</tr>
		   		
		   		<tr><td width="130">Message</td>		
		   			<td>   				
		   				<?=$result['order_message']?>
		   				<!-- <input type="text" value="<?=$result['order_message']?>" name="message" /> -->
		   			</td>
		   		</tr>

 
		   		
		   		<tr><td width="130">Menu available</td>		
		   			<td>   	
		   			<?php foreach($ordermenu as $order){ ?>
						<?php $available = $order['minimum_order']; 
							if($available == 0){
							echo "<div class='text-01' style='font: 12px Verdana; color:#FF0000'>Menu not available</div>";
							}else{
							echo $available;
							} 
						?>	
						<input type="hidden" name="menuid" value="<?php echo $order['orderdetail_menuid']  ?>"/>	   				
		   			<?php } ?>	
		   				<!-- <input type="text" value="<?=$result['order_message']?>" name="message" /> -->
		   			</td>
		   		</tr>		   		
		   		<tr><td width="130">Seasson greetings promotion</td><td>			
		   			<table>
		   			<?php foreach($detail as $dt)
		   				{
		   					echo "<tr><td>".$dt['menutype_name']."</td><td>: [".$dt['menu_code'].'] '.$dt['menu_name']."</td></tr>";
		   				}	
		   			?>			
		   			</table>		
		   		</td>    
		   		</tr>
				
				<tr>
					<td>Alternate Package</td>
					<td>
		   			<?php foreach($alternatemenu as $alternate)
		   				{
		   			?>
		   					<?php echo $alternate['name_package']; ?>
		   			<?php } ?>						
					</td>
				</tr>
				<tr>
					<td>Alternate Category</td>
					<td>
		   			<?php foreach($alternatemenu as $alternate)
		   				{
		   			?>
		   					<?php echo $alternate['name_main_category']; ?>
		   			<?php } ?>						
					</td>
				</tr>

				<tr>
					<td>Alternate Price</td>
					<td>
		   			<?php foreach($alternatemenu as $alternate)
		   				{
		   			?>
		   					<?php echo $alternate['updatemenu_pricing']; ?>
		   			<?php } ?>						
					</td>
				</tr>
								
				<tr><td width="130">Alternate Menu </td>		
					<td>
						<table>
		   			<?php foreach($ordermenu2 as $om)
		   				{
		   			?>								
							<tr>							
								<td><?php echo $om['menu_name']; ?></td>
								<td>&nbsp;</td>
								<td><?php echo $om['testings_pax']; ?></td>
							</tr>
					<?php } ?>								
						</table>							
					</td>    
		   		</tr>

		   		<tr>
		   			<td>&nbsp;</td>
		   			<td>&nbsp;</td>
		   		</tr>
		   				   				   		
		   		<tr>
		   			<td>&nbsp;</td>
		   			<td><div class="text-01" style="font: 14px Verdana; color:#1b0ff0">Please update if menu not available</div></td>
		   		</tr>
		   		   				   						   				   		
		   		<!--
		   		<tr>
		   			
		   			<input type="text" value="<?php echo $result['order_id']; ?>" name="menu_id" />
		   			<td width="130">Available</td>	
		   		<td>		   		
		   		
		   		<input style='text-align:right;width:200px;' required='required' type="text" name="available" value="<?php //echo $dt['minimum_order']; ?>" class="input_field" maxlength="200"/>
		   		</td>
		   		
		   			
		   		</tr>

		   		<tr>
		   			
		   			<input type="text" value="<?php echo $result['cateringtype_id']; ?>" name="menu_id" />
		   			<td width="130">Menu change</td>	
		   		<td>		   		
		   		
		   		<input style='text-align:right;width:200px;' required='required' type="text" name="dishes" value="<?php //echo $dt['menu_name']; ?>" class="input_field" maxlength="200"/>
		   		</td>	   		
		   			
		   		</tr>
		   		-->

	   		
				<tr>
					<td>Date</td>
					<td>
						<div>
						<input name="datepicker" type="text" size="12" id="inputField" value="<?php $today = date("Y-m-d");echo $today; ?>" style="float: left;width:200px;height:20px" />
			
							
						</div>
					</td>
				</tr>
				<tr>
					<td>Test</td>
					<td>
<?php
$query = $this->db->query("SELECT * FROM
  `main_category`
  INNER JOIN `update_menu`
    ON `main_category`.`id` = `update_menu`.`updatemenu_idcat`
  INNER JOIN `package` ON `package`.`id` = `update_menu`.`updatemenu_idpac`
  INNER JOIN `order` ON `order`.`order_id` = `update_menu`.`updatemenu_idorder`
  INNER JOIN `order_detail`
    ON `order`.`order_id` = `order_detail`.`orderdetail_orderid`
  INNER JOIN `testings` ON `order`.`order_id` = `testings`.`testing_orderid`
  INNER JOIN `menu` ON `menu`.`menu_id` = `testings`.`menu_id` 
  
  WHERE `order_detail`.`orderdetail_id` = $id GROUP BY `order`.`order_id`");
  
$users = array();

if ($query->num_rows() > 0)
{
	// Loop through all rows
	foreach ($query->result() as $row)
	{
		$users[] = array(
			'orderdetail_id' => $row->orderdetail_id,
			'menu_name' => $row->menu_name,
			'name_package' => $row->name_package,
			// OK, how many times am I going to have to do this..?
		);
	}
}
?>						
						
					</td>
					
				</tr>
				<tr>
					<td>Time</td>
					<td>
			  <span>
              <select name="hour" style="float: left;width:50px">
                <option value="1">01</option>
                <option value="2">02</option>
                <option value="3">03</option>
                <option value="4">04</option>
                <option value="5">05</option>
                <option value="6">06</option>
                <option value="7">07</option>
                <option value="8">08</option>
                <option value="9">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
              </span>
              <span class="arial12_brown">
                <select name="minute" style="float: left;width:50px">
                  <option value="0">00</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="30">30</option>
                  <option value="40">40</option>
                  <option value="50">50</option>
                  <option value="60">60</option>
                </select>
                </span>
                  <select name="ampm" style="float: left;width:50px">
                    <option value="AM">AM</option>                    
                    <option value="PM">PM</option>
                  </select>						
						
					</td>
				</tr>

		   		<tr><td width="130">Update Package</td><td>			
		   			<table>
		   			<select name='idpac' required='required' class="input_field" >
		   				<?php 
		   					foreach ($package as $pack) {
		   						//echo $cat['cateringtype_name'];	
		   				?>
		   				<option value='<?=$pack['id']?>'><?=$pack['name_package']?></option>
		   				<?php		
		   					}
		   				?>
		   			</select>			
		   			</table>		
		   		</td>    
		   		</tr>

		   		<tr><td width="130">Update Category</td><td>			
		   			<table>
		   			<select name='idcat' required='required' class="input_field" >
		   				<?php 
		   					foreach ($category as $cat) {
		   						//echo $cat['cateringtype_name'];	
		   				?>
		   				<option value='<?=$cat['id']?>'><?=$cat['name_main_category']?></option>
		   				<?php		
		   					}
		   				?>
		   			</select>			
		   			</table>		
		   		</td>    
		   		</tr>

		   		<tr><td width="130">Update Menu</td><td>			
		   			<table>
		   			<?php //echo $result['order_id'] ?>
		   			<!-- <select name='menuid' required='required' class="input_field" > -->

						<?php 
		   					foreach ($menuview as $menus) {
		   						//echo $cat['cateringtype_name'];	
		   				?>
							<tr>							
								<td><input  class="single" type="checkbox" name="menu_id[]" value="<?=$menus['menu_id']?>" /> &nbsp;<?=$menus['menu_name']?></td>
							</tr>
						<?php		
		   					}
		   				?>		
		   				<!-- <option value='<?=$menus['menu_id']?>'><?=$menus['menu_name']?>   -   <?=$menus['minimum_order']?></option> -->
		   			<!-- </select> -->
		   			</table>		
		   		</td>    
		   		</tr>

		   		<tr><td width="30">No Pax</td><td>			
	   			<table>
	   			<select name='pax' required='required' class="input_field" >
   				  <option value='10'>10</option>
                  <option value='20'>20</option>
                  <option value='30'>30</option>
                  <option value='40'>40</option>
                  <option value='50'>50</option>
                  <option value='60'>60</option>
                  <option value='70'>70</option>
                  <option value='80'>80</option>
                  <option value='90'>90</option>
                  <option value='100'>100</option>
		   		</select>			
		   		</table>		
		   		</td>    
		   		</tr>
		   		
		   		<tr>
		   			<td>Remarks</td>
		   			<td>
		   				<textarea name="message"><?=$result['order_message']?></textarea>
		   				
		   			</td>
		   		</tr>

		   		<tr><td width="130">Update Pricing</td><td>			
		   			<table>
		   			<input type="text" value="" name="pricing" class="single" style="float: left; width:200px" />			
		   			</table>		
		   		</td>    
		   		</tr>

				<!--
		   		<tr><td width="130">Update Menu</td><td>
		   					
		   			<table>
		   			<?php //echo $result['order_id'] ?>
		   			<select name='menuid' required='required' class="input_field" >
		   				<?php 
		   					foreach ($menuview as $menus) {
		   						//echo $cat['cateringtype_name'];	
		   				?>
		   				<option value='<?=$menus['menu_id']?>'><?=$menus['menu_name']?>   -   <?=$menus['minimum_order']?></option>
		   				<?php		
		   					}
		   				?>
		   			</select>			
		   			</table>
		   		</td>    
		   		</tr>
		   		-->
		   		
		   		<!--		   		
		   		<tr><td width="130">Update Catering</td><td>			
		   			<table>
		   			<select name='type' required='required' class="input_field" >
		   				<?php 
		   					foreach ($catering as $cat) {
		   						//echo $cat['cateringtype_name'];	
		   				?>
		   				<option value='<?=$cat['cateringtype_id']?>'><?=$cat['cateringtype_name']?></option>
		   				<?php		
		   					}
		   				?>
		   			</select>			
		   			</table>		
		   		</td>    
		   		</tr>
				-->
				
				<!--
		   		<tr><td width="130">Update Promotion</td><td>			
		   			<table>
		   			<select name='promo' required='required' class="input_field" >
		   				<?php 
		   					foreach ($promotion as $promo) {
		   						//echo $cat['cateringtype_name'];	
		   				?>
		   				<option value='<?=$promo['menutype_id']?>'><?=$promo['menutype_name']?></option>
		   				<?php		
		   					}
		   				?>
		   			</select>			
		   			</table>		
		   		</td>    
		   		</tr>
				-->
				
				<!--
		   		<tr><td width="130">Update Event</td><td>			
		   			<table>
		   			<select name='event' required='required' class="input_field" >
		   				<?php 
		   					foreach ($event as $events) {
		   						//echo $cat['cateringtype_name'];	
		   				?>
		   				<option value='<?=$events['event_id']?>'><?=$events['event_name']?></option>
		   				<?php		
		   					}
		   				?>
		   			</select>			
		   			</table>		
		   		</td>    
		   		</tr>
				-->		   		
		   				   		
		   				   				   		
		   		<tr>		<td>&nbsp;</td>		<td>&nbsp;</td>    </tr>    
		   		<tr>		<td></td>		
		   			<td><input type="submit" name="" id="" value="update" /></td>    
		   		</tr>    
		   		</table>    
		   	</form>
		   	<?php //} ?>
		 </div>