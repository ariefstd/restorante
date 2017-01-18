
	<div class="tab-title"><h1>Change password</h1></div>
	<div class="content">
  
   
   	<form id="password_form" action="<?php echo base_url("index.php/account/password_change") ?>" method="post">
    <input type="hidden" name="id" id="" value="<?php echo $this->session->userdata('id'); ?>"/>
	<table cellpadding="0" cellspacing="0" class="general_table" id="passwordTable">
    <tr>
    <td>Old password</td>
    <td><input type="password" name="old_pwd" id="old_pwd" value="" class="input_field" maxlength="20"/></td>
    </tr>
    <tr>
    <td>New password</td>
    <td><input type="password" name="new_pwd" id="new_pwd" value="" class="input_field" maxlength="20"/></td>
    </tr>
    <tr>
    <td>Confirm password</td>
    <td><input type="password" name="cfm_pwd" id="cfm_pwd" value="" class="input_field" maxlength="20"/></td>
    </tr>
    
    <tr>
    <td></td>
    <td><input type="submit" name="" id="" value="submit" class="" /></td>
    </tr>
    
    <tr>
    <td colspan="2"><div class="error"></div></td>
    </tr>
    
    </table>
    </form>
    
    </div>
    