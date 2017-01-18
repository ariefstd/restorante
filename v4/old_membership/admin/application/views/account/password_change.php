
    <div class="tab-title"><h1>Change password</h1></div>
	<div class="content">
	<?php
    
	if( isset($pwd_status))
	{
		
		if($pwd_status)
		{
			echo "<p style='margin-bottom:25px;'>Password updated.</p>";
			echo "<a href=". base_url("index.php/dashboard/") ." class='buttonstyle1' >Back</a>";
		}
		else
		{
			echo "<p style='margin-bottom:25px;'>Password error, please try again.</p>";
			echo "<a href=". base_url("index.php/account/password/") ." class='buttonstyle1'>Back</a>";
		}
		
		
	}
	else
	{
		
	}
    
    ?>
	
    </div>