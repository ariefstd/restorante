<?php
	$my_name = $this->session->userdata('name');
?>
    
<header>

    <div class="wrapper">
        <div class="logo"><h1>New Hong Kong Restaurant</h1></div>
        <div class="top_nav">
        You are currently logged in as: 
        <a href="<?php echo base_url("index.php/account/profile"); ?>"><?php echo $my_name; ?></a> | 
        <a href="<?php echo base_url("index.php/logout"); ?>">Log out</a> | 
        <a href="<?php echo base_url("./"); ?>" class="site_preview"> View Site</a> </div>
    </div>
    <div class="navigation">
    <?php
		$this->load->view("includes/nav");
	?>  
    </div>
    
</header>

<div id="main_content">
    <div class="wrapper">
    
        <div id="cms-container">
        	<?php
				$this->load->view($main_content);
			?>
            <!--<div class="tab-title"><h1>Dashboard</h1></div>
            <div class="content">hello world</div>-->     
        </div>
        
    </div>
</div>

