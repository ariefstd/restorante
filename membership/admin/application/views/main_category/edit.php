<div class="tab-title"><h1>Main Category</h1></div>
<div class="content">
   <div class="header">
       <h2>Add New Main Category</h2>
       <p style="padding-top:5px;">
       <a href="<?php echo base_url(); ?>index.php/main_category" class="buttonstyle1 green">View All Main Category</a>
       </p>
   </div>
   <div class="error"></div>
   	<form id="addAwards" accept-charset="utf-8" method="post" action="<?php echo base_url("index.php/maincategoryupdate"); ?>">
      <table cellpadding="0" cellspacing="0"  class="general_table" >
        <tr>		
          <td width="130">Name Main Category</td>
          <td>
            <input required='required' type="text" name="name_main_category" id="name" value="<?php echo $data_result->name_main_category; ?>" class="input_field" maxlength="255"/>
            <input type="hidden" name="id" value="<?php echo $data_result->id; ?>" />
            </td>
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
            <input type="submit" name="" id="" value="update" class="" />
          </td>
        </tr>
      </table>
    </form>
</div>