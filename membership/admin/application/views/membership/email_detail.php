<?php
	$permission = $this->session->userdata('permission');
?>


<div class="tab-title"><h1>Email</h1></div>
<div class="content">
   
   <div class="header">
       <h2>Email Detail</h2>
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
                            <th width="180" align="center">Email</th>
                            <th width="100" align="center">Date</th>
                            <th width="300" align="center">Message</th>
                            <th width="100" align="center">Status</th>
                        </tr>
                        
						<?php
                        $size_of_record = sizeof($result);
                        if($size_of_record > 0)
                        {
                            $count = 1;
							foreach ($result as $resultdata)
							{
								?>
								<tr>
									<td width="50" class="center"><?php echo $count; ?></td>
									<td width="180" class="center"><?php echo $resultdata['email']; ?></td>
                                    <td width="100" class="center"><?php echo date("d M Y H:i:s",strtotime($resultdata['sent_at'])); ?></td>
                                    <td width="300" class="center"><?php echo $resultdata['message']; ?></td>
                                    <td width="100" class="center"><?php echo $resultdata['status']; ?></td>
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