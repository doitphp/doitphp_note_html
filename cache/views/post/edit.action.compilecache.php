<?php if(!defined('IN_DOIT')) exit(); ?>
<fieldset>
<legend>发表留言：</legend>
<div class="text-align-right"><a title="返回留言列表页" href="<?php echo $postListUrl; ?>">返回留言列表页</a> </div>
<table border="0" cellspacing="5" cellpadding="0">
<form name="submitForm" method="post" action="<?php echo $this->getActionUrl('ajax_edit'); ?>" id="editpost_form">
  <tbody>
    <tr>
      <td width="100" height="30" align="right">用户名：</td>
      <td align="left"><?php echo $postInfo['post_author']; ?><input type="hidden" name="id" value="<?php echo $postInfo['post_id']; ?>"></td>
    </tr>
    <tr>
      <td height="30" align="right">标 题：</td>
      <td align="left"><input type="text" name="title" class="text" id="title" value="<?php echo $postInfo['post_title']; ?>"></td>
    </tr>
    <tr>
      <td height="250" align="right">内 容：</td>
      <td align="left"><textarea name="content" id="content"><?php echo $postInfo['post_content']; ?></textarea></td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td align="left"><input type="reset" name="resetButton" value="重值"><input type="submit" name="submitButton" value="提交"></td>
    </tr>
  </tbody>
</form>
</table>
</fieldset>