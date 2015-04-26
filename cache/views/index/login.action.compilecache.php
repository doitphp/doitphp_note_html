<?php if(!defined('IN_DOIT')) exit(); ?>
<fieldset>
<legend>管理员登陆：</legend>
<table border="0" cellspacing="5" cellpadding="0">
<form name="loginForm" method="post" action="<?php echo $this->getActionUrl('ajax_login'); ?>" id="login_form">
  <tbody>
    <tr>
      <td width="100" height="30" align="right">管理帐号：</td>
      <td colspan="2" align="left"><input type="text" name="username" class="text" id="user_name"></td>
    </tr>
    <tr>
      <td height="30" align="right">密 码：</td>
      <td colspan="2" align="left"><input type="password" name="password" class="text" id="user_password"></td>
    </tr>
    <tr>
      <td height="24" align="right">验证码：</td>
      <td width="80" align="left"><input type="text" name="pincode" class="text" style="width:70px;" id="vd_code"></td>
      <td align="left"><img title="点击图片更新验证码" src="<?php echo $this->getActionUrl('captcha'); ?>/?time=<?php echo time(); ?>" style="border:none; cursor:pointer;" onclick="this.src='<?php echo $this->getActionUrl('captcha'); ?>/?time='+Math.round(Math.random()*10);" ></td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td colspan="2" align="left"><input type="reset" name="resetButton" value="重值"><input type="submit" name="submitButton" value="提交"></td>
    </tr>
  </tbody>
</form>
</table>
</fieldset>