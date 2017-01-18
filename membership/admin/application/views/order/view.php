<?php
$permission = $this->session->userdata('permission');
$type = $this->session->userdata('type');
?>

<div class="tab-title">
    <table width="100%">
        <tr>
            <td><h1>Order</h1></td>
            <td align="right">
                <form action="<?php echo base_url("index.php/order/search"); ?>" method="POST" id="frmSearch">
                    <input type="text" name="q" id="q"> <input type="submit" name="btnSubmit" id="btnSubmit" value="Search">
                </form>
            </td>
        </tr>
    </table>
</div>

<div class="content">
    <div class="header">
        <h2>View All Order</h2>
        <p style="padding-top:5px;">
            <!--<a href="<?php echo base_url("index.php/order/add"); ?>" class="buttonstyle1">Add New Order</a>-->
        </p>
        <a href="<?php echo base_url("index.php/tuto1/testexcel/");?>" class="buttonstyle1">Export to Excel</a>
    </div>

    <?php

    if(empty($result))
    {
        ?>
        <div class="row">
            <p>Sorry, database is empty.</p>
        </div>
        <?php
    }
    else
    {
        ?>
        <table cellpadding="0" cellspacing="0" class="general_table" >
            <tr>
                <th width="50" align="center">No.</th>
                <th width="50" align="center">Package</th>
                <th width="50" align="center">Menu</th>
                <th width="150" align="center">Date & Time Order</th>
                <th width="150" align="center">Date & Time Event</th>
                <th width="150" align="center">Client</th>
                <th width="50" align="center">Available</th>
                <th width="100" align="center">Status</th>
                <?php if($permission == 1) { ?>
                <th>Action</th>
                <?php } ?>
            </tr>
            <?php
            $count = 1;
            foreach ($result as $resultdata)
            {
                ?>
                <tr>
                    <td width="50" class="center"><?php echo $count; ?></td>
                    <td width="100" class="center"><?php echo $resultdata['name_package']; ?></td>
                     <td width="250" class="center">
                    	<?php echo $resultdata['menu_name']; ?>
                    </td>
                    <!--
                    <td width="150" class="center">
                    	<a href="<?php echo base_url("index.php/order/order_detail").'/'.$resultdata['order_id']; ?>"><?php echo $resultdata['menu_name']; ?></a>
                    </td>
                    -->
                    <td width="200" class="center"><?php echo $resultdata['order_date'].' '.$resultdata['order_time']; ?></td>
                    <td width="200" class="center"><?php echo $resultdata['event_date'].' '.$resultdata['event_time']; ?></td>
                    <td class="center"><?php echo $resultdata['client_firstname'].' '.$resultdata['client_lastname']; ?></td>
                    <td width="50" class="center"><?php echo $resultdata['minimum_order']; ?></td>
                    <td class="center"><?php echo $resultdata['orderstatus_name']; ?></td>
                    <?php if($permission == 1) { ?>
                    <td width="200" class="center">
                        <?php
                        if($resultdata['order_statusid']==1 && $type=='manager')
                        {
                            ?>
                            <a href="<?php echo base_url("index.php/order/order_detail").'/'.$resultdata['order_id']; ?>">Edit</a>&nbsp;
                            <a href="<?php echo base_url("index.php/order/confirm").'/'.$resultdata['order_id']; ?>">Confirm</a>&nbsp;
                            <a href="<?php echo base_url("index.php/order/cancle").'/'.$resultdata['order_id']; ?>">Cancle</a>&nbsp;

                            <?php
                        }
                        if($resultdata['order_statusid']==2 && $type=='account')
                        {
                            ?>
                            <a href="<?php echo base_url("index.php/order/complete").'/'.$resultdata['order_id']; ?>">Complete</a>&nbsp;
                            <?php
                        }
                        ?>
                    </td>
                    <?php } ?>
                </tr>
                <?php
                $count++;
            }
            ?>
        </table>
        <?php
    }
    ?>
</div>
