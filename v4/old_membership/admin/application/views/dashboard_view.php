<?php
	$my_name = $this->session->userdata('name');
?>

<div class="tab-title"><h1>Dashboard</h1></div>
<div class="content">
   
   <div class="header">
       <h2 style="float:left;">Welcome!</h2>
       <p style="float:left; padding:2px 0 0 10px;"><a href="<?php echo base_url("index.php/account/profile"); ?>" class="buttonstyle1 orange"><?php echo $my_name; ?></a> </p>
   </div>
   
</div>
   