<?php 
	if($result->num_rows){
		foreach ($result->result_array() as $resultdata){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>New Hong Kong</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.times22 {
	font-family:"Times New Roman", Times, serif;
	font-size:22px;
	color:#000;
}
.times16 {
	font-family:"Times New Roman", Times, serif;
	font-size:16px;
	color:#000;
}
.times14 {
	font-family:"Times New Roman", Times, serif;
	font-size:14px;
	color:#000;
}
</style>
</head>

<body>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
	<!--Change Table Height-->
    <td height="1060" align="center" valign="middle" style="padding:20px 100px 20px 100px"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="90" height="19"><img src="<?php echo base_url('assets/img/print/logo.png')?>" width="70" height="100" alt="Logo" /></td>
        <td width="510" align="center" class="times22">新香港酒家（柔）私人有限公司<br />Sing Siang Kang Restaurant (Johor) Sdn Bhd (34531-U)</td>
      </tr>
      <tr>
        <td height="50" colspan="2"></td>
      </tr>
    </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
		  <!--Change Table Height-->
          <td height="810" align="left" valign="top" class="times14"><p>Date : <?php echo date("d M, Y")?></p>
            <p>To : <?php echo $resultdata["full_name"]?></p>
            <p><?php echo ($resultdata["address"])?></p>
            <p>Dear <?php echo $resultdata["full_name"]?>,</p>
            <p><strong><u>New Hong Kong Previllage Card</u></strong><br />
              The management of New Hong Kong Restaurant would like to extend our deepest gratitude for your continuous support to our restaurant these past years and looking forward to another great year with you.</p>
            <p>Attached, please find your Previllage Card (Card No: <?php echo $resultdata["member_card_no"]?>) which will take effective from <?php echo date("d/m/Y",$resultdata["date_join"])?> till <?php echo date("d/m/Y",$resultdata["expiry_date"])?>. As our Previllage Card holder, you will enjoy special rate on selected items dining at our restaurant. You will also be the 1st to be notified on all our promotional activities and great deals.</p>
            <p>To celebrate the New Year with you as our Previllage Customers, we have enclosed a dining voucher for your use when you come to our restaurant.</p>
            <p>We wish you a prosperous New Year.</p>
            <p>Your sincerely,</p>
            <p>&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&nbsp;</p>
            <p><strong><u>新香港酒楼贵宾卡</u></strong><br />
衷心的感谢您这几年来对新香港酒楼不间断的支持和鼓励，为表谢意，特此献上您的贵宾卡（贵宾卡号码: <?php echo $resultdata["member_card_no"]?>.）。 此贵宾卡将从2011年1月1日起生效，有效期为一年。</p>
            <p>尊贵的贵宾卡持有人，您将享用新香港酒楼指定的餐饮优惠，以及各类的筹办活动讯息。</p>
            <p>为了和我们的 VIP 顾客庆祝来临的新年，我们也准备了优惠券值来给您享用。</p>
            <p>本管理层由衷的感谢您长期的支持和鞭策，希望您新年快乐和身体健康。</p>
            <p>&nbsp;</p>
            <p>Yours Sincerely,</p>
            <p>&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&nbsp;</p>
            <p><u>New Hong Kong Previllage Card</u></p><br />
            </td>
        </tr>
    </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" class="times14">*This is computer generated, no signature required.<br />
   这是电脑打印的文件，将不附上签名。</td>
        </tr>
        <tr>
          <td height="19"></td>
        </tr>
        <tr>
          <td height="19"><img src="<?php echo base_url('assets/img/print/temp.png')?>" width="600" height="2" alt="Line" /></td>
        </tr>
        <tr>
          <td height="19" align="center" class="times14"><strong>69 A,B,C, Jalan Ibrahim sultan, 80300 Johor Bahru T: 07-2222608  F:07-2247208</strong></td>
        </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
<?php
		}
	}
?>
