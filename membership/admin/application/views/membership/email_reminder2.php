<?php
	$permission = $this->session->userdata('permission');
?>


<div class="tab-title"><h1>Membership</h1></div>
<div class="content">
   
   <div class="header">
       <h2>Send Email Reminder</h2>

   </div>
   
   	<form id="addAwards" enctype="multipart/form-data" accept-charset="utf-8" method="post" action="<?php echo base_url("index.php/membership/process_email2"); ?>">
    <input type="hidden" name="active" id="active" value="0" />
	<table cellpadding="0" cellspacing="0"  class="general_table" >
    <tr>
    <td width="130">Reminder Message</td>
    <td>
    <textarea name="reminder" id="reminder" ><?php echo $data; ?></textarea>
    </td>
    </tr>
    
    <tr>
    <tr>
    <td></td>
    <td><input type="submit" name="" id="" value="Send Email" class="" /></td>
    </tr>    
    </table>
    
    </form>
      
   
</div>

