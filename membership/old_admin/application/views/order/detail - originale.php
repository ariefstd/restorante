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
		<?php foreach($detail as $dt){ ?>
		   	<form id="addAwards" accept-charset="utf-8" method="post" action="<?php echo base_url("index.php/order/order_edit/".$dt['menu_id']); ?>">	
		   	<input type="hidden" name="id" id="id" value="<?=$result['order_id']?>" />	
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
		   			<td><?=$result['order_message']?>		</td>
		   		</tr>				   				   		
		   		
		   		<tr>
		   			
		   			<input type="hidden" value="<?php echo $dt['menu_id']; ?>" name="menu_id" />
		   			<td width="130">Available</td>	
		   		<td>		   		
		   		
		   		<input style='text-align:right;width:200px;' required='required' type="text" name="available" value="<?php echo $dt['minimum_order']; ?>" class="input_field" maxlength="200"/>
		   		</td>
		   		
		   			
		   		</tr>
		   		
		   		<tr>		<td width="130">Seasson greetings promotion</td>		<td>			
		   			<table>
		   			<?php foreach($detail as $dt)
		   				{
		   					echo "<tr><td>".$dt['menutype_name']."</td><td>: [".$dt['menu_code'].'] '.$dt['menu_name']."</td></tr>";
		   				}	
		   			?>			
		   			</table>		
		   		</td>    
		   		</tr>		   		
		   		<tr>		<td>&nbsp;</td>		<td>&nbsp;</td>    </tr>    
		   		<tr>		<td></td>		
		   			<td><input type="submit" name="" id="" value="update" class="" /></td>    
		   		</tr>    
		   		</table>    
		   	</form>
		   	<?php } ?>
		 </div>