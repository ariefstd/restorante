<div class="tab-title"><h1>Menu</h1></div>
<div class="content">
  <div class="header">
    <h2>Add New Menu</h2>
    <p style="padding-top:5px;">
      <a href="<?php echo base_url("index.php/menu/"); ?>" class="buttonstyle1 green">View All Menu</a>
    </p>
  </div>
  <div class="error"></div>
  <form id="addAwards" accept-charset="utf-8" method="post" action="<?php echo base_url("index.php/menu/do_add"); ?>">
    <table cellpadding="0" cellspacing="0"  class="general_table" >
      <tr><td width="130">Menu Code</td>
        <td><input required='required' type="text" name="code" id="code" value="" class="input_field" maxlength="255"/></td>
      </tr>
      <tr>
        <td width="130">Menu Name</td><td><input required='required' type="text" name="name" id="name" value="" class="input_field" maxlength="255"/>		</td>
      </tr>
      <tr>
        <td width="130">
          Minimum Order
        </td>
        <td>
          <input required='required' type="text" name="minimum_order" id="Minimum_order" value="" class="input_field" maxlength="255"/>
        </td>
      </tr>
      <tr>
        <td width="130">Menu Type</td><td><select name='type' required='required' class="input_field" >
        <?php
        foreach($type as $dt)
        {
          ?>
          <option value='<?=$dt['menutype_id']?>'><?=$dt['menutype_name']?></option>
          <?php
        }
        ?>
      </select></td>
    </tr>
    <tr><td width="130">Status</td><td><input checked='checked' type="radio" name="status" id="status1" value="1" class="input_field" /> <label for='status1'>Active </label><br/>
      <input type="radio" name="status" id="status2" value="0" class="input_field" /> <label for='status2'>Not Active</label>		</td>
    </tr>
    <tr>
      <td>&nbsp;</td><td>&nbsp;</td>
    </tr>
    <tr><td></td><td><input type="submit" name="" id="" value="add" class="" /></td></tr>
  </table>
</form>
</div>
