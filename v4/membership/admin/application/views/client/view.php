<?php
	$permission = $this->session->userdata('permission');
?>

<div class="tab-title">
	<table width="100%">
		<tr>
			<td><h1>Client</h1></td>
			<td align="right">
				<form action="<?php echo base_url("index.php/client/search"); ?>" method="POST" id="frmSearch">
					<input type="text" name="q" id="q"> <input type="submit" name="btnSubmit" id="btnSubmit" value="Search">
				</form>
			</td>
		</tr>
	</table>
</div>

<div class="content">
   <div class="header">
       <h2>View All Client</h2>
       <p style="padding-top:5px;">
		<!--<a href="<?php echo base_url("index.php/client/add"); ?>" class="buttonstyle1">Add New Client</a>-->
       </p>
   </div>

   <?php 

		if(empty($result)) 
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
                            <th width="80" align="center">First Name</th>
                            <th width="150" align="center">Last Name</th>
                            <th width="150" align="center">Contact</th>
                            <th width="100" align="center">Email</th>
                            <?php if($permission == 1) { ?>
                            <th>Action</th>
                            <?php } ?>
                        </tr>                 
						<?php
                            $count = 1;
							foreach ($result as $resultdata)
							{
								?>
								<tr>
									<td width="50" class="center"><?php echo $count; ?></td>
									<td width="80" class="center"><?php echo $resultdata['client_firstname']; ?></td>
                                    <td width="150" class="center"><?php echo $resultdata['client_lastname']; ?></td>
                                    <td width="150" class="center"><?php echo $resultdata['client_contact']; ?></td>
									<td class="center"><?php echo $resultdata['client_email']; ?></td>
									<?php if($permission == 1) { ?>
                                    <td class="center">
                                        <!--<a href="<?php echo base_url("index.php/client/edit").'/'.$resultdata['client_id']; ?>">Edit</a>&nbsp;-->
                                        <a href="<?php echo base_url("index.php/client/delete").'/'.$resultdata['client_id']; ?>" class="deleteCheck">Delete</a>
                                    </td>
                                    <?php } ?>
								</tr>
								<?php
								$count++;
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