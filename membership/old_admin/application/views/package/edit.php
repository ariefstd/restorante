<div class="tab-title"><h1>Package</h1></div>
<div class="content">
   <div class="header">
       <h2>Add New Package</h2>
       <p style="padding-top:5px;">
       <a href="<?php echo base_url(); ?>index.php/package" class="buttonstyle1 green">View All Package</a>
       </p>
   </div>
   <div class="error"></div>
    <form id="addAwards" accept-charset="utf-8" method="post" action="<?php echo base_url("index.php/packageupdate"); ?>">
      <table cellpadding="0" cellspacing="0"  class="general_table" >
        <tr>    
          <td width="130">Main Category</td>
          <td>
            <select name="main_category" class="input_field" required="required">              
              <?php foreach ($data_main_category as $key => $value) { ?>
              <?php if($data_result->id_main == $value['id']) echo 'selected="selected"'.$data_result->id_main; else'' ;?>
                  <option  <?php if($data_result->id_main == $value['id']) echo 'selected="selected"'; else'' ;?> value="<?php echo $value['id']; ?>"><?php echo $value['name_main_category']; ?></option>
              <?php } ?>
            </select>
          </td>
        </tr>
        <tr>    
          <td width="130">Name Package</td>
          <td>
            <input required='required' type="text" name="package_name" id="package_name" value="<?php echo $data_result->name_package;?>" class="input_field"/>
            <input type="hidden" name="id_package" value="<?php echo $data_result->id;?>" class="input_field"/>
          </td>
        </tr>
        <tr>    
          <td width="130">Price</td>
          <td><input required='required' type="text" name="price" id="Price" value="<?php echo $data_result->price;?>" class="input_field"/></td>
        </tr>
        <tr>
          <td width="130">Description</td>
          <td>
            <textarea class="input_field" name="description" id="description" >
              <?php echo $data_result->descriptions;?>
            </textarea>
          </td>
        </tr>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" name="" id="" value="add" class="" />
          </td>
        </tr>
      </table>
    </form>
</div>