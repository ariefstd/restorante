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
            <p><?php echo nl2br($resultdata["address"])?></p>
            <p>Dear Sir / Ms,</p>
            <p><strong><u>Membership Login Account<br />
            </u></strong>It's here! After months of preparations, we now proudly present to you our newly launched online membership website!</p>
<p>If you have a busy life style or want a hassle-free way to register/renew your New Hong Kong membership, from now on, you can register/renew your membership at http://www.nhkrestaurant.com/v3/membership.html </p>
<p>And to make the access even easier, we have also generated an username and temporary password for you. </p>
<p>Please find below your username and temporary password to access our online membership website.<br />
              Username: <?php echo $resultdata["username"]?><br />
            Password: <?php echo $resultdata["temp_pass"]?></p>
<p>&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&gt;&nbsp;</p>
            <p>亲爱的会员，</p>
            <p>经过数个月的筹备，让我们为您精彩呈现新香港的会员专页！</p>
            <p>如果您生活忙碌，无暇更新您的会员资格，又或者您想要一个更省时的方来注册成为新香港的会员，从今天开始，您可以选择到我们的会员专页来注册/更新您的会员资格。<br />
              网址是：http://www.nhkrestaurant.com/v3/membership.html</p>
            <p>为了更方便您的使用，我们已为您准备了用户名（username）和临时密码 （password）。（如下）            </p>
            <p>您可用以下的用户名与临时密码来访问我们的会员专页：</p>
            <p>Username: <?php echo $resultdata["username"]?><br />
            Password: <?php echo $resultdata["temp_pass"]?></p></td>
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
