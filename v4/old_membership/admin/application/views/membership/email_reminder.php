<?php
	$permission = $this->session->userdata('permission');
	$group = array(
		"all"=>"All Member",
		"birthday"=>"Birthday",
		"expiredsoon"=>"Expiry Soon",
		"expired"=>"Expired Members",
		"newrenewer"=>"New & Renewer Members",
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
		
		$("#addAwards").submit(function(){
			var $freq = $("input[name='rdoFrequency']:checked").val();
			if($("#txtTitle").val()==""){
				alert('Please input title');
				return false;
			}
			if($freq=="oneoff"){
				if($start.val()==""){
					alert('Please select start date');
					return false;
				}
			}else if($freq=="daily" || $freq=="monthly"){
				if($start.val()==""){
					alert('Please select start date');
					return false;
				}
				if($end.val()==""){
					alert('Please select end date');
					return false;
				}
			}
		})
		$("#selTemplate").change(function(){
			var tempId = $("#selTemplate").val();
			$("#btnTemplate").attr("href",base_url+'index.php/membership/addedit_template/'+tempId);
			$("#txtMessage").val($("#temp"+tempId).val());
			tinyMCE.activeEditor.setContent($("#temp"+tempId).val());
			//alert($("#temp"+tempId).val());
		})
		
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
       <h2>Send Email Reminder</h2>
   </div>
   
   	<form id="addAwards" enctype="multipart/form-data" accept-charset="utf-8" method="post" action="<?php echo base_url("index.php/membership/store_email"); ?>">
    <input type="hidden" name="active" id="active" value="0" />
	<table cellpadding="0" cellspacing="0"  class="general_table" >
    <tr>
    <td>Title</td>
    <td>
    <input type="text" name="txtTitle" id="txtTitle" value="" class="input_field" style="width:270px;"/>
    </td>
    </tr>
    <tr>
    <td>Send By Bulk</td>
    <td><select name="selGroup" id="selGroup">
    	<?php foreach($group as $key=>$val){?>
    		<option value="<?php echo $key?>" <?php if($type==$key) echo "selected"; ?>><?php echo $val?></option>
    	<?php } ?>
    </select></td>
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
    <a id="btnTemplate" href="<?php echo base_url("index.php/membership/addedit_template"); ?>">Edit template</a>
    </td>
    </tr>
    <tr>
    <td width="130">Reminder Message</td>
    <td>
    <textarea name="txtMessage" id="txtMessage" ></textarea>
    </td>
    </tr>
    <?php if($type=="birthday" || $type=="newrenewer" || $type==""){ ?>
    	<tr>
    		<td> Attachment</td>
    		<td><input type="file" name="fl" id="fl"></td>
    	</tr>	
    <?php } ?>
    <tr>
    <td></td>
    <td><input type="submit" name="" id="" value="Send Email" class="" /></td>
    </tr>    
    </table>
    
    </form>
      
   
</div>

