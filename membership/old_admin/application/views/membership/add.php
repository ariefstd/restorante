<script>
	$(document).ready(function(){
		$("#renewal_date, #expiry_date, #dob").datepicker({dateFormat:"dd/mm/yy"});
		$("#nationality").change(function(){
			if($(this).val()!="Singapore" && $(this).val()!="Malaysia"){
				$("#other").val('');
				$("#other").show();
			}else
				$("#other").hide();
		})
		$("#addAwards").submit(function(){
			if(validateForm()){
				return true;
			}
			return false;
		})
	})
	
	function validateForm(){
		$('.error').hide();
		var _error = true;
		if ($.trim($('#dob').attr('value')) === '')
		{  
			alert('Birthday field is empty.');
			_error =  false; 
			return _error;
		}
		
		if ($.trim($('#expiry_date').attr('value')) === '') 
		{  
			alert('Expired date field is empty.');
			_error =  false; 
			return _error;
		}
		
		
		if ($.trim($('#username').attr('value')) === '') 
		{  
			alert('Username field is empty.');
			_error =  false; 
			return _error;
		}
		
		if ($.trim($('#gender').attr('value')) === '') 
		{  
			alert('Gender field is empty.');
			_error =  false; 
			return _error;
		}
		
		if ($.trim($('#mobile_no_1').attr('value')) === '') 
		{  
			alert('Mobile 1 No. field is empty.');
			_error =  false; 
			return _error;
		}
	  
	 	if ($.trim($('#nationality').attr('value')) === '') 
		{  
			alert('Nationality field is empty.');
			_error =  false; 
			return _error;
		}
		
		if ($.trim($('#occupation').attr('value')) === '')
		{  
			alert('Occupation field is empty.');
			_error =  false; 
			return _error;
		}
				
	
		if ($.trim($('#address').attr('value')) === '')
		{  
			alert('Address field is empty.');
			_error =  false; 
			return _error;
		}
		return _error;
	}
</script>
<div class="tab-title"><h1>Membership</h1></div>
<div class="content">
   
   <div class="header">
       <h2>Add New Member</h2>
       <p style="padding-top:5px;">
       <a href="<?php echo base_url("index.php/membership/"); ?>" class="buttonstyle1 green">View All Members</a>
       </p>
   </div>
   <div class="error"></div>
   	<form id="addAwards" enctype="multipart/form-data" accept-charset="utf-8" method="post" action="<?php echo base_url("index.php/membership/insert"); ?>">
    <input type="hidden" name="active" id="active" value="0" />
	<table cellpadding="0" cellspacing="0"  class="general_table" >
    <tr>
    <td width="130">Member Card No.</td>
    <td>
    <input type="text" name="member_card_no" id="member_card_no" value="" class="input_field" maxlength="255"/>
    </td>
    </tr>
    <tr>
    <td>Member Since</td>
    <td>
    <?php
		$now = now();
		$date = date("d/m/Y",$now); 
	?>
    <input type="text" name="date_join" id="date_join" value="<?php echo $date; ?>" class="input_field" maxlength="25" style="width:270px;"/>
    <p style="padding:3px 0 0 5px; float:left;">example: 01/01/2012</p>
    </td>
    </tr>
    <tr>
    <td>Renewal Date</td>
    <td>
    <?php
		$now = now();
		$date = date("d/m/Y",$now); 
	?>
    <input type="text" name="renewal_date" id="renewal_date" value="<?php echo $date; ?>" class="input_field" maxlength="25" style="width:270px;"/>
    <p style="padding:3px 0 0 5px; float:left;">example: 01/01/2012</p>
    </td>
    </tr>
    <tr>
    <td>Expired Date</td>
    <td>
    <input type="text" name="expiry_date" id="expiry_date" value="" class="input_field" maxlength="25" style="width:270px;"/>
    <p style="padding:3px 0 0 5px; float:left;">example: 01/01/2012</p>
    </td>
    </tr>
    <tr>
    <td>Birthday</td>
    <td>
    <input type="text" name="dob" id="dob" value="" class="input_field" maxlength="25" style="width:270px;"/>
    <p style="padding:3px 0 0 5px; float:left;">example: 01/01/2012</p>
    </td>
    </tr>
    <tr>
    <td width="130">Username</td>
    <td>
    <input type="text" name="username" id="username" value="" class="input_field" maxlength="255"/>
    </td>
    </tr>
    <tr>
    <td width="130">Password</td>
    <td>
    <input type="password" name="password" id="password" value="" class="input_field" maxlength="255"/>
    </td>
    </tr>
    <tr>
    <td width="130">Full Name</td>
    <td>
    <input type="text" name="full_name" id="full_name" value="" class="input_field" maxlength="255"/>
    </td>
    </tr>
    <tr>
    <td width="130">IC/Passport No.</td>
    <td>
    <input type="text" name="ic_passport" id="ic_passport" value="" class="input_field" maxlength="255"/>
    </td>
    </tr>
    </tr>
    <tr>
    <td width="130">Gender</td>
    <td>
    <select name="gender" id="gender">
    	<option value="male">Male</option>
        <option value="female">Female</option>
    </select>
    </td>
    </tr>
    </tr>
    <tr>
    <td width="130">Email</td>
    <td>
    <input type="text" name="email" id="email" value="" class="input_field" maxlength="255"/>
    </td>
    </tr>
    <tr>
    <td width="130">Contact No.</td>
    <td>
    <input type="text" name="contact_no" id="contact_no" value="" class="input_field" maxlength="255"/>
    </td>
    </tr>
    <tr>
    <td width="130">Mobile 1 No.</td>
    <td>
    <input type="text" name="mobile_no_1" id="mobile_no_1" value="" class="input_field" maxlength="255"/>
    </td>
    </tr>
    <tr>
    <td width="130">Mobile 2 No.</td>
    <td>
    <input type="text" name="mobile_no_2" id="mobile_no_2" value="" class="input_field" maxlength="255"/>
    </td>
    </tr>
    <tr>
    <td width="130">Nationality</td>
    <td>
    <select name="nationality" id="nationality" style="float:left">
    	<option value="Malaysia" selected>Malaysia</option>
    	<option value="Singapore">Singapore</option>
    	<option value="Others">Others</option>
    </select>
    <input type="text" name="other" id="other" style="width:100px;margin-left:10px;display:none" value="" class="input_field" maxlength="255"/>
    </td>
    </tr>
    <tr>
    <td width="130">Occupation</td>
    <td>
    <input type="text" name="occupation" id="occupation" value="" class="input_field" maxlength="255"/>
    </td>
    </tr>
    <tr>
    <td width="130">Address</td>
    <td>
    <textarea name="address" id="address" class="mceEditor"></textarea>
    </td>
    </tr>
    <tr>
    <td width="130">Mailing Address</td>
    <td>
    <textarea name="mailing_add" id="mailing_add" class="mceEditor"></textarea>
    </td>
    </tr>
    <tr>
    <td width="130">Card Collection Option</td>
    <td>
    <select name="card_collection" id="card_collection">
    	<option value="self_collection">Self collection</option>
        <option value="by_post">By post</option>
    </select>
    </td>
    </tr>
   	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
	<tr>
    <td>Account Status</td>
    <td>
    <select name="status" id="status">
    	<option value="active">Active</option>
        <option value="inactive">Inactive</option>
    </select>
    </td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
	<tr>
    <tr>
    <td></td>
    <td><input type="submit" name="" id="" value="add" class="" /></td>
    </tr>
    </table>
    
    </form>
    
   
</div>

