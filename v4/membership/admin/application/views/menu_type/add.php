
<div class="tab-title"><h1>Menu Category</h1></div>
<div class="content">
  <div class="header">
    <h2>Add New Menu Category</h2>
    <p style="padding-top:5px;">
      <a href="<?php echo base_url("index.php/menu_type/"); ?>" class="buttonstyle1 green">View All Menu Category</a>
    </p>
  </div>
  <div class="error"></div>
  <form enctype="multipart/form-data" id="addAwards" accept-charset="utf-8" method="post" action="<?php echo base_url("index.php/menu_type/do_add"); ?>">
    <table cellpadding="0" cellspacing="0"  class="general_table" >
      <tr>
        <td width="130">Name</td>
        <td><input required='required' type="text" name="name" id="name" value="" class="input_field" maxlength="255"/></td>
      </tr>
      <tr>
        <td width="130">Package</td>
        <td>
          <select name="package" class="input_field" required="required">
            <?php foreach ($package as $key => $value) { ?>
            <option value="<?php echo $value['id']; ?>"><?php echo $value['name_package']; ?></option>
            <?php } ?>
          </select>
        </td>
      </tr>
      <tr>
        <td width="130">Status</td>
        <td>
          <input checked='checked' type="radio" name="status" id="status1" value="1" class="input_field" /> <label for='status1'>Active </label><br/>
          <input type="radio" name="status" id="status2" value="0" class="input_field" /> <label for='status2'>Not Active</label>
        </td>
      </tr>
      <tr>
        <td width="130">Image</td>
        <td><input required='required' type="file" name="image" id="image" value="" class="input_field" maxlength="255"/></td>
      </tr>
      <tr>
        <td width="130">Description</td>
        <td><textarea class="input_field" name="description" id="description" ></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>		<td>&nbsp;</td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="" id="" value="add" class="" /></td></tr>
      </table>
    </form>
  </div>
