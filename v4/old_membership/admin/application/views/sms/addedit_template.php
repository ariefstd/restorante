<?php
$this->load->view('includes/header');
$id = isset($result) ? $result->id : "";
?>
<script>
	$(document).ready(function (){
		$("#btnDelete").click(function(){
			var answer = confirm("Are you sure you want to delete this?")
			if (answer){
				$.get('<?php echo base_url("index.php/sms/delete_template/".$id); ?>',function(data){
					parent.jQuery.fancybox.close();					
				});
			}
			return false;
		});
		$("#btnSave").click(function(){
			$.post('<?php echo base_url("index.php/sms/saveupdate_template"); ?>',$("#sms").serialize(),function(data){
				parent.jQuery.fancybox.close();					
			});
			return false;
		});	
	});	
</script>
   	<form id="sms" method="post" action="<?php echo base_url("index.php/sms/saveupdate_template"); ?>">
	<table cellpadding="0" cellspacing="0" class="general_table" >
    <input type="hidden" name="mode" value="<?php echo isset($result) ? "edit" : "add"?>">
    <input type="hidden" name="template_id" value="<?php echo $id?>">
    <tr><td colspan="2">Add / Edit Template</td></tr>
    <tr>
    <td>Title</td>
    <td>
    <input type="text" name="txtTitle" id="txtTitle" value="<?php echo isset($result) ? $result->title : ""?>" class="input_field" style="width:270px;"/>
    </td>
    </tr>
    <tr>
    <td>Message</td>
    <td><textarea name="txtMessage" id="txtMessage" class="mceNoEditor"><?php echo isset($result) ? $result->message : ""?></textarea></td>
    </tr>
   	<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td></td>
    <td><input type="submit" name="" id="btnSave" value="Save" class="" /> <input type="button" name="" id="btnCancel" onclick="javascript:parent.jQuery.fancybox.close();" value="Cancel" class="" /> 
    	<?php if(isset($result)){?>
    	<input type="button" name="" id="btnDelete" value="Delete" class="" />
    	<?php } ?>
    </td>
    </tr>
    </table>
    </form>
<?php
$this->load->view('includes/footer');
?>
