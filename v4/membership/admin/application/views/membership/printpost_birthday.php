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
</style>
</head>

<body>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
	<!--Change Table Height-->
    <td height="1050" align="left" valign="top" style="padding:20px 100px 20px 100px"><table width="600" border="0" cellspacing="0" cellpadding="0">
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
          <td height="860" align="left" valign="top" class="times16"><p>Date: <?php echo date("d M Y")?></p>
            <p>To : <?php echo $resultdata["full_name"]?></p>
            <p><?php echo ($resultdata["address"])?></p>
            <p><strong><u>Subject: Happy Birthday</u></strong></p>
            <p>Dear <?php echo $resultdata["full_name"]?>,</p>
            <p>The management of New Hong Kong Restaurant would like to take this opportunity to wish you happy birthday for the month of <?php echo date("M",strtotime($resultdata["dob"]))?>. <br />
              A complimentary meal voucher worth RM30 will be given to you as a token of appreciation for your continuous support to us.  <br />
              Once again, we wish you a very good health and all your dreams come true.            </p>
            <p>&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&nbsp;</p>
            <p><strong><u>RM30</u></strong><strong><u>优惠券</u></strong><strong><u> </u></strong></p>
            <p>尊敬的<?php echo $resultdata["full_name"]?>， </p>
            <p>本酒楼衷心的祝贺您<?php echo date("m",strtotime($resultdata["dob"]))?>月份生日快乐。 <br />
              特此献上RM30礼券。供你在本酒楼享用，以感谢您一直以来对本酒楼的支持及照顾。 <br />
              再一次，希望您身体健康和美梦成真。</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p></td>
        </tr>
    </table>
      <table width="600" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19">*This is computer generated, no signature required</td>
        </tr>
        <tr>
          <td height="19"></td>
        </tr>
        <tr>
          <td height="19"><img src="<?php echo base_url('assets/img/print/temp.png')?>" width="600" height="2" alt="Line" /></td>
        </tr>
        <tr>
          <td height="19" align="center" class="times16"><strong>69 A,B,C, Jalan Ibrahim sultan, 80300 Johor Bahru T: 07-2222608  F:07-2247208</strong></td>
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