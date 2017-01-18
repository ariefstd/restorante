<div class="tab-title"><h1>Main Category</h1></div>
<div class="content">
   <div class="header">
       <h2>Add New Main Category</h2>
       <p style="padding-top:5px;">
       <a href="<?php echo base_url(); ?>index.php/main_category" class="buttonstyle1 green">View All Main Category</a>
       </p>
   </div>
   <div class="error"></div>
   	<form id="addAwards" accept-charset="utf-8" method="post" action="<?php echo base_url("index.php/submit_main_category"); ?>">
      <table cellpadding="0" cellspacing="0"  class="general_table" >
        <tr>		
          <td width="130">Name Main Category</td>
          <td><input required='required' type="text" name="name_main_category" id="name" value="" class="input_field" maxlength="255"/></td>
        </tr>
        <tr>
          <td width="130">Description</td>
          <td>
            <textarea class="input_field" name="description" id="description" >
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