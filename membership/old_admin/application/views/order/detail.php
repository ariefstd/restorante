<?php $id = $result['order_id'] ?>
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

		   		<tr><td width="130">Update Menu</td><td>			
		   			<table>
		   			<?php //echo $result['order_id'] ?>
		   			<!-- <select name='menuid' required='required' class="input_field" > -->

						<?php 
		   					foreach ($menuview as $menus) {
		   						//echo $cat['cateringtype_name'];	
		   				?>
							<tr>							
								<td><input type="checkbox" name="menu_id[]" value="<?=$menus['menu_id']?>" /> &nbsp;<?=$menus['menu_name']?></td>
							</tr>
						<?php		
		   					}
		   				?>		
		   				<!-- <option value='<?=$menus['menu_id']?>'><?=$menus['menu_name']?>   -   <?=$menus['minimum_order']?></option> -->
		   			<!-- </select> -->
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
		   				<textarea name="message">
		   					<?=$result['order_message']?>
		   				</textarea>
		   				
		   			</td>
		   		</tr>		   		
		   				   		
		   				   				   		
		   		<tr>		<td>&nbsp;</td>		<td>&nbsp;</td>    </tr>    
		   		<tr>		<td></td>		
		   			<td><input type="submit" name="" id="" value="update" class="" /></td>    
		   		</tr>    
		   		</table>    
		   	</form>
		   	<?php //} ?>
		 </div>