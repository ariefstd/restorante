<div class="tab-title"><h1>My profile</h1></div>
<div class="content">

	<div class="header">
       <p style="padding-top:5px;">
       <a href="" id="profile_edit" class="buttonstyle1">Edit Profile</a>
       </p> 
   </div>
   

	<?php
	
		$my_profile = $profile->row_array(); 
		
	?>
    
    <form action="<?php echo base_url("index.php/account/profile_update") ?>" method="post">
    <input type="hidden" name="id" id="" value="<?php echo $this->session->userdata('id'); ?>"/>
	<table cellpadding="0" cellspacing="0" border="1" class="general_table" id="profileTable">
    <tr>
    <td width="100">Username:</td>
    <td>
    <div class="input_display"><?php echo $my_profile['username']; ?></div>
    <input type="text" name="username" id="" value="<?php echo $my_profile['username']; ?>" class="input_field"/>
    </td>
    </tr>
    <tr>
    <td>Name:</td>
    <td>
    <div class="input_display"><?php echo $my_profile['name']; ?></div>
    <input type="text" name="name" id="" value="<?php echo $my_profile['name']; ?>" class="input_field"/>
    </td>
    </tr>
    <tr>
    <td>Email:</td>
    <td>
    <div class="input_display"><?php echo $my_profile['email']; ?></div>
    <input type="text" name="email" id="" value="<?php echo $my_profile['email']; ?>" class="input_field"/>
    </td>
    </tr>
    
    <?php
		$format = "%l %d %F %Y [%h:%i %A]";
	?>
    
    <tr>
    <td>Date created:</td>
    <td>
    <div class="static_display"><?php echo mdate( $format, $my_profile['date_created']); ?></div>
    </td>
    </tr>
    <!--
    <tr>
    <td>Last update:</td>
    <td>
    <div class="static_display"><?php //echo mdate( $format, $my_profile['last_login']); ?></div>
    </td>
    </tr>
    -->
    <tr>
    <td></td>
    <td><input type="submit" name="" id="profile_update" value="update" class="" /></td>
    </tr>
       
    </tr>
    </table>
    
    </form>


</div>


    
    