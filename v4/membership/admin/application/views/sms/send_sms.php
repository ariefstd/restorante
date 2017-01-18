<?php
	$group = array(
		"all"=>"All Member",
		"birthday"=>"Birthday",
		"expiredsoon"=>"Expiry Soon",
		"expired"=>"Expired Members",
		"newrenewer"=>"New & Renewer Members",
		"noemail"=>"No Email",
		"usernamepass"=>"No Password"
	);
	$days = array("Monday","Tuesday","Wednesday","Thrusday","Friday","Saturday","Sunday");
?>
<script>
	$(document).ready(function(){
		var base_url = '<?php echo base_url()?>';
		var $date = $("#date");
		var $time = $("#time");
		var $every = $("#every");
		var $start = $("#start");
		var $end = $("#end");
		var $hour = $("#hour");
		var $minute = $("#minute");
		
		$("#sms").submit(function(){
			if($("#txtTitle").val()==""){
				alert('Please input title');
				return false;
			}
		})
		var base_url = '<?php echo base_url()?>';
		$("#selTemplate").change(function(){
			var tempId = $("#selTemplate").val();
			$("#btnTemplate").attr("href",base_url+'index.php/sms/addedit_template/'+tempId);
			$("#txtMessage").val($("#temp"+tempId).val());
			$('#txtMessage').keyup();
			//alert($("#temp"+tempId).val());
		})
		
		$('#txtMessage').keyup(function() {
			var charLength = $(this).val().length+7;
			// Displays count
			$('#txtCharCount').val(charLength);
			if(charLength<=160)
				$("#txtSmsCount").val('1')
			else
				$("#txtSmsCount").val('2')
		});
		
		$("#start,#end").datepicker({dateFormat:"dd/mm/yy"});
		
		$("input[name='rdoFrequency']").click(function(){
			if($(this).val()=="oneoff"){
				$date.show();
				$end.attr('disabled',true);
				$time.show();
				$every.hide();
			}else if($(this).val()=="daily"){
				$date.show();
				$end.attr('disabled',false);
				$time.show();
				$every.show();
			}else if($(this).val()=="now"){
				$date.hide();
				$time.hide();
				$every.hide();
			}else if($(this).val()=="monthly"){
				$date.show();
				$end.attr('disabled',false);
				$time.show();
				$every.show();
			}
		})
	})
	
</script>
<div class="tab-title"><h1>Membership</h1></div>
<div class="content">
   
   <div class="header">
       <h2>Send SMS</h2>
   </div>
   
   	<form id="sms" method="post" action="<?php echo base_url("index.php/sms/store_sms"); ?>">
    <input type="hidden" name="active" id="active" value="0" />
	<table cellpadding="0" cellspacing="0"  class="general_table" >
    <tr>
    <td>Title</td>
    <td>
    <input type="text" name="txtTitle" id="txtTitle" value="" class="input_field" style="width:270px;"/>
    </td>
    </tr>
    <tr>
    <td colspan="2" class="section">To</td>
    </tr>
    <tr>
    <td width="130">Send By Bulk</td>
    <td><select name="selGroup" id="selGroup">
    	<?php foreach($group as $key=>$val){?>
    		<option value="<?php echo $key?>" <?php if($type==$key) echo "selected"; ?>><?php echo $val?></option>
    	<?php } ?>
    </select></td>
    </tr>
    <tr>
    <td>Mobile no.</td>
    <td>
    <input type="text" name="txtMsisdn" id="txtMsisdn" value="" class="input_field" style="width:270px;"/>
    <p style="padding:3px 0 0 5px; float:left;">Please include country code followed by the mobile number<br>Example: 6011213123 and use comma  as separator</p>
    </td>
    </tr>
    <tr>
    <td colspan="2" class="section">Schedule</td>
    </tr>
    <tr>
    <td>Frequency</td>
    <td><input type="radio" name="rdoFrequency" value="now" checked> Now <input type="radio" name="rdoFrequency" value="oneoff"> One-Off <input type="radio" name="rdoFrequency" value="daily"> Daily <input type="radio" name="rdoFrequency" value="monthly"> Monthly</td>
    </tr>
    <tr id="date" style="display:none">
    	<td>Date</td>
    	<td>Start From <input type="text" name="start" id="start" value="<?php echo date("d/m/Y")?>" readonly style="width:100px; padding-right: 10px; float:none"> End on <input readonly type="text" name="end" id="end" style="width:100px; float: none"></td>
    </tr>
    <tr id="time" style="display:none">
    	<td>Time</td>
    	<td>Hour <input type="text" name="hour" id="hour" value="00" style="width:20px; padding-right: 10px; float:none"> Minute <input type="text" name="minute" id="minute" value="00" style="width:20px; float:none"></td>
    </tr>
    <tr id="every" style="display:none">
    	<td>Every</td>
    	<td><select name="selEvery" id="selEvery">
    		<?php foreach($days as $day){ ?>
    		<option value="<?php echo $day?>"><?php echo $day?></option>	
    		<?php }?>
    	</select></td>
    </tr>
    <tr>
    <td colspan="2">Message</td>
    </tr>
    <tr>
    <td>Language Selection</td>
    <td>
    <input type="radio" value="roman" name="rdoEncoding" checked> Roman Characters <input type="radio" value="unicode" name="rdoEncoding"> Unicode
    </td>
    </tr>
    <tr>
    <td>Template</td>
    <td>
	<?php foreach($templates as $t){?>
		<input type="hidden" id="temp<?php echo $t["id"]?>" value="<?php echo $t["message"]?>">
	<?php } ?>	
    <select name="selTemplate" id="selTemplate">
    	<option value="0" selected>--Select Template--</option>
    	<?php foreach($templates as $t){?>
    		<option value="<?php echo $t["id"]?>"><?php echo $t["title"]?></option>
    	<?php } ?>	
    </select>
    <a id="btnTemplate" href="<?php echo base_url("index.php/sms/addedit_template"); ?>">Edit template</a>
    </td>
    </tr>
    </tr>
    <tr>
    <td>Message</td>
    <td><textarea name="txtMessage" id="txtMessage" class="mceNoEditor"></textarea></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td>
    	<input type="text" style="width:30px" value="1" name="txtSmsCount" id="txtSmsCount" disabled> <p style="float:left; padding: 0 10px;">Number of SMS</p>
    	<input type="text" style="width:30px" value="7" name="txtCharCount" id="txtCharCount" disabled> <p style="float:left; padding: 0 10px;">Number of Characters</p>
    </td>
    </tr>
   	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td></td>
    <td><input type="submit" name="" id="" value="Send" class="" /></td>
    </tr>
    </table>
    
    </form>
    
   
</div>

