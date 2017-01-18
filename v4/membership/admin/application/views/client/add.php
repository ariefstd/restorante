
<div class="tab-title"><h1>Client</h1></div>
<div class="content">
   <div class="header">
       <h2>Add New Client</h2>
       <p style="padding-top:5px;">
       <a href="<?php echo base_url("index.php/client/"); ?>" class="buttonstyle1 green">View All Client</a>
       </p>
   </div>
   <div class="error"></div>
   	<form id="addAwards" accept-charset="utf-8" method="post" action="<?php echo base_url("index.php/client/do_add"); ?>">
	<table cellpadding="0" cellspacing="0"  class="general_table" >
    <tr>		<td width="130">First Name</td>		<td>			<input required='required' type="text" name="first" id="first" value="" class="input_field" maxlength="255"/>		</td>
    </tr>
    <tr>		<td width="130">Last Name</td>		<td>			<input type="text" name="last" id="last" value="" class="input_field" maxlength="255"/>		</td>
    </tr>
    <tr>		<td width="130">Contact</td>		<td>			<input type="text" name="telp" id="telp" value="" class="input_field" maxlength="255"/>		</td>
    </tr>
    <tr>		<td width="130">Email</td>		<td>			<input required='required' type="text" name="email" id="email" value="" class="input_field" maxlength="255"/>		</td>
    </tr>
    <tr>
		<td>&nbsp;</td>		<td>&nbsp;</td>
    </tr>
    <tr>		<td></td>		<td><input type="submit" name="" id="" value="add" class="" /></td>    </tr>
    </table>
    </form>
</div>

