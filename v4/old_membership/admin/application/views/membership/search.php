<?php
	$permission = $this->session->userdata('permission');
?>


<div class="tab-title">
	<table width="100%">
		<tr>
			<td><h1>Membership</h1></td>
			<td align="right">
				<form action="<?php echo base_url("index.php/membership/search"); ?>" method="GET" id="frmSearch">
					<input type="text" name="q" id="q"> <input type="submit" name="btnSubmit" id="btnSubmit" value="Search">
				</form>
			</td>
		</tr>
	</table>
</div>
<div class="content">
   
   <div class="header">
       <h2>View All Members</h2>
       <p style="padding-top:5px;">
       <a href="<?php echo base_url("index.php/membership/add"); ?>" class="buttonstyle1">Add New Member</a>
       </p>
   </div>
   
   <?php 
	
		if($result == false) 
		{
				
				?>
				
                	<div class="row">
                        <p>Sorry, database is empty.</p>
                   	</div>
					
				
				<?php
		}
		
		else
		{
				?>
				
                	<table cellpadding="0" cellspacing="0" class="general_table" >
                    	<tr>
                        	<th width="50" align="center">No.</th>
                            <th width="80" align="center">Member Card No.</th>
                            <th width="150" align="center">Username</th>
                            <th width="150" align="center">Full Name</th>
                            <th width="100" align="center">IC/Passport No.</th>
                            <th width="100" align="center">Member Since</th>
                            <th width="100" align="center">Expiry Date</th>
                            <th >Status</th>
                            <?php if($permission == 1) { ?>
                            <th>Action</th>
                            <?php } ?>
                        </tr>
                        
						<?php
                        $size_of_record = sizeof($result->result_array());
                        
                        if($size_of_record > 0)
                        {
                            $count = 1;
							foreach ($result->result_array() as $resultdata)
							{
								?>
								<tr>
									<td width="50" class="center"><?php echo $count; ?></td>
									<td width="80" class="center"><?php echo $resultdata['member_card_no']; ?></td>
                                    <td width="150" class="center"><?php echo $resultdata['username']; ?></td>
                                    <td width="150" class="center"><?php echo $resultdata['full_name']; ?></td>
                                    <!--<td width="80" class="center"><?php echo date("d/m/Y",$resultdata['date']); ?></td>-->
                                    
                                    <td width="100" class="center"><?php echo $resultdata['ic_passport']; ?></td>
                                    <td width="100" class="center"><?php echo date("d/m/Y",$resultdata['date_join']); ?></td>
                                    <td width="100" class="center"><?php echo date("d/m/Y",$resultdata['expiry_date']); ?></td>
									<td class="center"><?php echo $resultdata['status']; ?></td>
									<?php if($permission == 1) { ?>
                                    <td class="center">
                                        <a href="<?php echo base_url("index.php/membership/edit").'/'.$resultdata['id']; ?>">Edit</a>&nbsp;
                                        <a href="<?php echo base_url("index.php/membership/delete").'/'.$resultdata['id']; ?>" class="deleteCheck">Delete</a>
                                    </td>
                                    <?php } ?>
								</tr>
                                
								<?php
								$count++;
							}
                        }
                        ?> 

                    </table>

				
				<?php
		}
		
	?>
      
   
</div>

<script>

	$(document).ready(function (){
		
		$("table.general_table tr:even").css("background-color","#F0F0EE");
		
		$("a.deleteCheck").click(function(event){
			
			
			var answer = confirm("Are you sure you want to delete this?")
			if (answer){
				return true;
			}
			return false;
			
		});
		
	});	

</script>