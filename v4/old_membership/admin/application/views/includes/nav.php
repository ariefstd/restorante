<?php
	$permission = $this->session->userdata('permission');
?>


<nav id="user-nav">
    <ul>
    	<li><a href="<?php echo base_url("index.php/dashboard"); ?>">Dashboard</a></li>
        <li><a href="<?php echo base_url("index.php/membership"); ?>">Membership</a>
        
        	<ul>
                <li><a href="<?php echo base_url("index.php/membership/add"); ?>">Add New Member</a></li>
                <li><a href="<?php echo base_url("index.php/membership/"); ?>">View Members</a></li>
                <li><a href="<?php echo base_url("index.php/membership/newrenewer"); ?>">New & Renewer Members</a></li>
                <li><a href="<?php echo base_url("index.php/membership/birthday"); ?>">Birthday Members</a></li>
                <li><a href="<?php echo base_url("index.php/membership/view_expiry"); ?>">Expired Soon</a></li>
                <li><a href="<?php echo base_url("index.php/membership/view_expired"); ?>">Expired Members</a></li>
                <li><a href="<?php echo base_url("index.php/membership/usernamepass"); ?>">Create Username & Password</a></li>
                <li><a href="<?php echo base_url("index.php/membership/noemail"); ?>">No email Address</a></li>
        	</ul>
        
        </li>
        <li><a href="<?php echo base_url("index.php/sms"); ?>">Bulk SMS</a>
        	<ul>
                <li><a href="<?php echo base_url("index.php/sms/send_sms"); ?>">Send SMS</a></li>
                <li><a href="<?php echo base_url("index.php/sms"); ?>">Report</a></li>
        	</ul>
        </li>
        <li><a href="<?php echo base_url("index.php/membership/email"); ?>">Bulk Email</a>
        	<ul>
                <li><a href="<?php echo base_url("index.php/membership/email_reminder"); ?>">Send Email</a></li>
                <li><a href="<?php echo base_url("index.php/membership/email"); ?>">Report</a></li>
        	</ul>
        </li>
    </ul>
</nav>
<nav id="system-nav">
    <ul>
    <li><a href="<?php echo base_url("index.php/account/profile"); ?>">Account</a>
    	<ul>
        	<li><a href="<?php echo base_url("index.php/account/profile"); ?>">My Profile</a></li>
            <li><a href="<?php echo base_url("index.php/account/password"); ?>">Change Password</a></li>
            <li><a href="<?php echo base_url("index.php/account/settings"); ?>">Settings</a></li>
        </ul>
    </li>
    </ul>
</nav>