<?php if(!defined('IN_DOIT')) exit(); ?>
<fieldset>
<legend>回复留言：</legend>
<div class="text-align-right"><a title="返回留言列表页" href="<?php echo $postListUrl; ?>">返回留言列表页</a> </div>
<table border="0" cellspacing="5" cellpadding="0">
<form name="replayForm" method="post" action="<?php echo $this->getActionUrl('ajax_reply'); ?>" id="relypost_form">
  <tbody>
    <tr>
      <td height="30" align="right">标 题：<input type="hidden" name="id" value="<?php echo $postInfo['post_id']; ?>"></td>
      <td align="left"><?php echo $postInfo['post_title']; ?></td>
    </tr>
    <tr>
      <td align="right">留言内容：</td>
      <td align="left">[ 来自：<span class="blue"><?php echo $postInfo['post_author']; ?></span> 留言时间：<span class="blue"><?php echo $postInfo['post_time']; ?></span> ]<br><?php echo $postInfo['post_content']; ?></td>
    </tr>
    <tr>
      <td height="250" align="right">回复内容：</td>
      <td align="left"><?php if ($postInfo['reply_content']) { ?>[ 回复时间: <?php echo $postInfo['reply_time']; ?> ]<br><?php } ?><textarea name="content" id="content"><?php echo $postInfo['reply_content']; ?></textarea></td>
    </tr>
    <tr>
      <td height="30">&nbsp;</td>
      <td align="left"><input type="reset" name="resetButton" value="重值"><input type="submit" name="submitButton" value="提交"></td>
    </tr>
  </tbody>
</form>
</table>
</fieldset>