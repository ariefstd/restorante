<?php
	$permission = $this->session->userdata('permission');
?>


<div class="tab-title"><h1>SMS</h1></div>
<div class="content">
   
   <div class="header">
       <h2>SMS List (<?php echo $balance?>)</h2>
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
                            <th width="180" align="center">Title</th>
                            <th width="150" align="center">Category</th>
                            <th width="150" align="center">Frequency</th>
                            <th width="100" align="center">Status</th>
                            <th width="100" align="center">Created At</th>
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
									<td width="180" class="center"><?php echo $resultdata['title']; ?></td>
                                    <td width="150" class="center"><?php echo ucfirst($resultdata['category']); ?></td>
                                    <td width="150" class="center"><?php echo ucfirst($resultdata['frequency']); ?></td>
                                    <td width="100" class="center"><?php echo $resultdata['status']; ?></td>
                                    <td width="100" class="center"><?php echo date("d/m/Y",strtotime($resultdata['created_at'])); ?></td>
									<?php if($permission == 1) { ?>
                                    <td class="center">
                                        <a href="<?php echo base_url("index.php/sms/detail").'/'.$resultdata['id']; ?>">Detail</a>
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